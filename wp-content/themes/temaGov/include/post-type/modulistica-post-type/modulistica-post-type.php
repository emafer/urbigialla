<?php
if ( madisoft_get_theme_option('madisoft_scuola_modulistica_uso', 'on') == 'on' ) {
    add_action( 'init', 'modulistica_init' );
}


function modulistica_init() {
    global $madisoftTheme;
    $modulisticaPostType 				= new ModulisticaPostType( new MadisoftPostTypeClass(), new MadisoftThemeFieldCreateClass() );
    $DestinatariModulisticaTaxonomie 	= new DestinatariModulisticaTaxonomie( $modulisticaPostType );
    $TipologiaModulisticaTaxonomy 		= new TipologiamodulisticaTaxonomie( $modulisticaPostType );

    madisoft_get_theme_class()->addGlobalVar( 'modulistica_post_type', $modulisticaPostType );
    madisoft_get_theme_class()->addGlobalVar( 'modulistica_destinatari_taxonomy', $DestinatariModulisticaTaxonomie );
    madisoft_get_theme_class()->addGlobalVar( 'modulistica_tipologia_taxonomy', $TipologiaModulisticaTaxonomy );
    add_filter('manage_scuola_modulistica_posts_columns' , 'madisoft_theme_aggiungi_colonna_riservato');

}

class ModulisticaPostType extends MadisoftThemeCustomPostTypeExtendClass {

    public function  __construct( \MadisoftPostTypeClass $PostTypeCLass, \MadisoftThemeFieldCreateClass $madisoftThemeFieldCreate ) {
        $this->setPostTypeCLass( $PostTypeCLass );
        $this->setCreateFieldClass( $madisoftThemeFieldCreate );
        $this->setPostTypeName( 'scuola_modulistica' );
        $this->setSlug( 'tutta_la_modulistica' );
        $this->getPostTypeCLass()->setSlug( 'tutta_la_modulistica' );
        $this->getPostTypeCLass()->setSupportEditor( false );
        $this->getPostTypeCLass()->setPostTypeName( 'scuola_modulistica' );
        $this->getPostTypeCLass()->setSupportThumbnail( false );
        $this->getPostTypeCLass()->setExcludeFromSearch( true );
        $this->setPosition( dirname( __FILE__ ) );
        $labels = array(
            'name'               => _x( 'Modulistica', 'post type general name', 'madisoft_scuola' ),
            'singular_name'      => _x( 'Modulistica', 'post type singular name', 'madisoft_scuola' ),
            'menu_name'          => _x( 'Modulistica', 'admin menu', 'madisoft_scuola' ),
            'name_admin_bar'     => _x( 'Modulistica', 'add new on admin bar', 'madisoft_scuola' ),
            'add_new'            => _x( 'Nuova', 'modulistica', 'madisoft_scuola' ),
            'add_new_item'       => __( 'Aggiungi modulistica', 'madisoft_scuola' ),
            'new_item'           => __( 'Nuova modulistica', 'madisoft_scuola' ),
            'edit_item'          => __( 'Modifica modulistica', 'madisoft_scuola' ),
            'view_item'          => __( 'Leggi Modulistica', 'madisoft_scuola' ),
            'all_items'          => __( 'Tutta la modulistica', 'madisoft_scuola' ),
            'search_items'       => __( 'Cerca modulistica', 'madisoft_scuola' ),
            'parent_item_colon'  => __( 'Modulistica superiori:', 'madisoft_scuola' ),
            'not_found'          => __( 'Nessuna modulistica trovata.', 'madisoft_scuola' ),
            'not_found_in_trash' => __( 'Nessuna modulistica cestinata.', 'madisoft_scuola' ),
        );
        $this->setTemplatePages();
        $this->getPostTypeCLass()->setLabels( $labels );
        $this->getPostTypeCLass()->setPublic( true );
        $this->getPostTypeCLass()->register_post_type();
        add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
        add_action( 'save_post', array( $this, 'save_meta_data' ) );
        add_filter( 'post_updated_messages', array( $this, 'create_updated_messages' ) );
    }

    public function crea_form() {
        global $post;
        $this->getCreateFieldClass()->addNoncefield( 'modulistica_allegato_nonce' );
        $form = [ ];
        $form = $this->settaIlForm( $post, $form );

        $this->getCreateFieldClass()->setListOfField( $form );
        $this->getCreateFieldClass()->scriviIlForm();
    }

    public function add_meta_boxes() {
        add_meta_box(
            'allegato_modulistica',
            'Allegato',
            array( $this, 'crea_form' ),
            'scuola_modulistica',
            'normal',
            'high'
        );

    }

    public function save_meta_data( $id ) {
        global $post;
        $this->getCreateFieldClass()->addNoncefield( 'modulistica_allegato_nonce' );
        $form = [ ];
        $form = $this->settaIlForm( $post, $form );

        $this->getCreateFieldClass()->setListOfField( $form );
        $this->getCreateFieldClass()->salvaIlForm( $id );
    }

    public function create_updated_messages( $messages ) {
        $post             = get_post();
        $post_type        = get_post_type( $post );
        $post_type_object = get_post_type_object( $post_type );

        $messages['scuola_modulistica'] = array(
            0  => '', // Unused. Messages start at index 1.
            1  => __( 'Modulistica modificata.', 'madisoft_scuola' ),
            2  => __( 'Campo modificato.', 'madisoft_scuola' ),
            3  => __( 'Campo eliminato.', 'madisoft_scuola' ),
            4  => __( 'Modulistica modificata.', 'madisoft_scuola' ),
            /* translators: %s: date and time of the revision */
            5  => isset( $_GET['revision'] ) ? sprintf( __( 'Modulistica ripristinata alla revisione del %s', 'madisoft_scuola' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
            6  => __( 'Modulistica pubblicata.', 'madisoft_scuola' ),
            7  => __( 'Modulistica salvata.', 'madisoft_scuola' ),
            8  => __( 'Modulistica inviata.', 'madisoft_scuola' ),
            9  => sprintf(
                __( 'La modulistica sar&agrave; pubblicata il: <strong>%1$s</strong>.', 'madisoft_scuola' ),
                // translators: Publish box date format, see http://php.net/date
                date_i18n( __( 'M j, Y @ G:i', 'madisoft_scuola' ), strtotime( $post->post_date ) )
            ),
            10 => __( 'Bozza modificata.', 'madisoft_scuola' ),
        );
        if ( isset( $post->modulistica_data_nonce ) ) {

            if ( $post_type_object->publicly_queryable ) {
                $permalink = get_permalink( $post->ID );

                $view_link = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), __( 'Guarda modulistica', 'madisoft_scuola' ) );
                $messages[ $post_type ][1] .= $view_link;
                $messages[ $post_type ][6] .= $view_link;
                $messages[ $post_type ][9] .= $view_link;

                $preview_permalink = add_query_arg( 'preview', 'true', $permalink );
                $preview_link      = sprintf( ' <a target="_blank" href="%s">%s</a>', esc_url( $preview_permalink ), __( 'Anteprima della modulistica', 'madisoft_scuola' ) );
                $messages[ $post_type ][8] .= $preview_link;
                $messages[ $post_type ][10] .= $preview_link;
            }
        }

        return $messages;
    }

    /**
     * Restituisce la query per effettuare la ricerca delle circolari filtrando per tipologia, destinatario e data
     * @return WP_Query
     */
    static function getAll() {

        return showModulistica::getAll();
    }

    /**
     * @param $post
     * @param $form
     *
     * @return array
     */
    protected function settaIlForm( $post, $form ) {
        $form[] = [
            'alegato_media' => [
                0 => [
                    'id'        => 'modulistica_allegato',
                    'title'     => 'Carica Allegato',
                    'value'     => $this->getValueOfOption( $post, 'modulistica_allegato', true ),
                    'type'      => 'media',
                    'separator' => '',
                ],
            ]
        ];

        return $form;
    }

    /**
     * @param      $post
     *
     * @param      $id_of_option
     * @param bool $single
     *
     * @return mixed
     */
    protected function getValueOfOption( $post, $id_of_option, $single = false ) {
        if ( ! $post ) {
            return '';
        }

        return get_post_meta( $post->ID, $id_of_option, $single );
    }

}

class showModulistica {

    static function cercaEMostra($print = false, $destinatari = false, $tipologia = false, $mostraDestinatari = true, $linkDiretto = false, $id = 'modulisticaTable'){
        $query = self::getAll($destinatari, $tipologia);
        $html = self::createTable($query, $print, $mostraDestinatari, $linkDiretto, $id);

        if($print){
            echo $html;
        }

        return $html;

    }

    static function getAll($destinatari = false, $tipologia = false) {
        global $wp_query;
        $taxonomy = array();
        $category = get_queried_object();
        if ( isset( $category->taxonomy ) ) {
            if ( $category->taxonomy != 'destinatari_modulistica' && $category->taxonomy != 'tipologia_modulistica' && ( $category->taxonomy != 'category' && $category->slug == 'scuola_modulistica' ) ) {
                return $wp_query;
            }
        }
        if ( isset( $category->query_var ) && $category->query_var != 'scuola_modulistica' ) {
            return $wp_query;
        }
        if ( isset( $category->term_id ) ) {
            $_POST['dest'] = isset( $_POST['dest'] ) ? filter_var ( $_POST['dest'], FILTER_SANITIZE_STRING) : $category->term_id;
            $_POST['tipologia'] = isset( $_POST['tipologia'] ) ? filter_var ( $_POST['tipologia'], FILTER_SANITIZE_STRING) : 0;
        } else {
            $_POST['dest'] = isset( $_POST['dest'] ) ? filter_var ( $_POST['dest'], FILTER_SANITIZE_STRING) : 0;
            $_POST['tipologia'] = isset( $_POST['tipologia'] ) ?filter_var ( $_POST['tipologia'], FILTER_SANITIZE_STRING) : '';
        }
        if ( isset( $wp_query->query_vars['taxonomy'] ) && $wp_query->query_vars['taxonomy'] ) {
            $taxonomy[ $wp_query->query_vars['taxonomy'] ] = $wp_query->query[ $wp_query->query_vars['taxonomy'] ];
        }
        $args = array(
            'post_type' => 'scuola_modulistica',
            'posts_per_page' => - 1,
            'tax_query'  => array(),
            'meta_query' => array(),
            'orderby' 	 => 'title',
            'order'      => 'ASC'
        );
        if ( $_POST['tipologia'] ) {
            $args['tax_query'][] = array(
                'taxonomy' => 'tipologia_modulistica',
                'terms' => filter_var ( $_POST['tipologia'], FILTER_SANITIZE_STRING),
                'field'    => 'id',
                'compare'  => 'in'
            );
        }
        if ( $_POST['dest'] != 0 ) {
            $args['tax_query'][] = array(
                'taxonomy' => 'destinatari_modulistica',
                'terms' => filter_var ( $_POST['dest'], FILTER_SANITIZE_STRING),
                'field'    => 'id',
                'compare'  => 'in'
            );
        }

        if ( isset( $_POST['titolo'] ) && $_POST['titolo'] ) {
            $args['post_title_like'] = filter_var ( $_POST['titolo'], FILTER_SANITIZE_STRING);
        }

        if ($destinatari) {
            $destinatari_slugs = explode(',', $destinatari);
            $destinatari_category = [];
            foreach ($destinatari_slugs as $find) {
                //trovare lo slug giusto
                $term = get_term_by('slug', $find, 'destinatari_modulistica');
                if ($term) {
                    $destinatari_category[] = $term->term_id;
                }

            }

            if (count($destinatari_category) > 0) {
                $args['tax_query'][] = array(
                    'taxonomy' => 'destinatari_modulistica',
                    'terms' => $destinatari_category,
                    'field' => 'id',
                    'compare' => 'in'
                );
            }
        }
        if ($tipologia) {
            $tipologia_slugs = explode(',', $tipologia);
            $tipologia_category = [];
            foreach ($tipologia_slugs as $find) {
                //trovare lo slug giusto
                $term = get_term_by('slug', $find, 'tipologia_modulistica');
                if ($term) {
                    $tipologia_category[] = $term->term_id;
                }

            }

            if (count($tipologia_category) > 0) {
                $args['tax_query'][] = array(
                    'taxonomy' => 'tipologia_modulistica',
                    'terms' => $tipologia_category,
                    'field' => 'id',
                    'compare' => 'in'
                );
            }
        }
        $query = new WP_Query( $args );
        return $query;
    }

    static function createTable($query, $print, $mostraDestinatari = true, $linkDiretto = false, $id='modulisticaTable') {
	
        $html = '<table class="table table-bordered table-hover table_modulistica" id="'. $id . '">
            <thead>
            <tr>';

        if ( madisoft_get_theme_option( 'madisoft_scuola_modulistica_mostra_data', 'off' ) == 'on' ) {
            $html .= '<th>Data</th>';
        }
        $html .= '<th>Titolo</th>
                <th>Allegato</th>';

        if ( madisoft_get_theme_option( 'madisoft_scuola_modulistica_tipologia', '1' ) == '1' ) {
            $html .= '<th>' . madisoft_get_theme_option('madisoft_scuola_modulistica_tipologia_nome', 'Tipologia') . '</th>';
        }
        if ($mostraDestinatari){
            $html .= '<th>Destinatari</th>';
        }
        $html .='</tr>
            </thead>
            <tbody>'
            . self::creaCorpoTabella( $query, $mostraDestinatari, $linkDiretto) .
            '   </tbody>
        </table>';
        if ($print){
            echo $html;
        } else {
            return $html;
        }

    }

    static protected function creaCorpoTabella( $wp_query, $mostraDestinatari = true, $linkDiretto = false ) {
        global $madisoftTheme;
        $html = "";
        $destinari_tax = $madisoftTheme->getGlobalVar( 'modulistica_destinatari_taxonomy' );
        foreach ($wp_query->posts as $modulistica) {
            if (possoVisualizzareQuestoContenuto( $modulistica->ID )) {
                if ($linkDiretto){
                    $destinazioneLink = get_post_meta($modulistica->ID, 'modulistica_allegato', true);
                } else {
                    $destinazioneLink = get_post_permalink($modulistica->ID);
                }
                $html .= '<tr>';
                if ( madisoft_get_theme_option( 'madisoft_scuola_modulistica_mostra_data', 'off' ) == 'on' ) {
                    $data =  new DateTime($modulistica->post_date);
                    $html .= '<td>' .  $data->format('d/m/Y') . '</td>';
                }
                $html .= '<td>' . $modulistica->post_title  .'</td>
                    <td>
                        <a target="_blank"
                           href="' . $destinazioneLink .'">'.  madisoft_get_theme_option('madisoft_scuola_modulistica_testo', 'Scarica') . '</a>
                    </td>';
                if (madisoft_get_theme_option('madisoft_scuola_modulistica_tipologia', '1') == '1') {

                    $html .= '<td>' . madisoft_scuola_print_categorie($modulistica->ID, 'tipologia_modulistica') .'</td>';
                }
                if ($mostraDestinatari){
                    $html .= '<td>' . madisoft_scuola_print_categorie($modulistica->ID, $destinari_tax::TAXONOMIA, true, false) . '</td>';
                }
                $html .= '</tr>';

            }
        }
        return $html;
    }

}

class DestinatariModulisticaTaxonomie extends MadisoftTaxonomyClass implements MadisoftTaxonomyInterface {

    const TAXONOMIA = 'destinatari_modulistica';

    public function __construct( $parentClass ) {

        $this->crea_taxonomy();
        $this->setPosition( dirname( __FILE__ ) );
        $this->setTaxonomyName( 'destinatari_modulistica' );
        new MadisoftCustomTaxonomyFieldClass( $this->getTaxonomyName(), 'destinatari_modulistica_order' );
        add_filter( "taxonomy_template", array( $this, "get_post_type_archive_template" ) );
        $this->setParentCustomPostTypeClass( $parentClass );
        $this->setTaxonomyName( self::TAXONOMIA );
        $this->getParentCustomPostTypeClass()->addTaxonomyChilds( self::TAXONOMIA );
    }

    public function crea_taxonomy() {
        $destinatari      = array(
            'name'                       => _x( 'Destinatari modulistica', 'taxonomy general name' ),
            'singular_name'              => _x( 'Destinatario modulistica   ', 'taxonomy singular name' ),
            'search_items'               => __( 'Cerca destinari' ),
            'popular_items'              => __( 'Destinatari pi&ugrave; usati' ),
            'all_items'                  => __( 'Tutti i destinatari' ),
            'parent_item'                => __( 'Macro destinatari' ),
            'parent_item_colon'          => __( 'Destinatari' ),
            'edit_item'                  => __( 'Modifica destinatario' ),
            'update_item'                => __( 'Aggiorna destinatario' ),
            'add_new_item'               => __( 'Aggiungi un nuovo destinatario' ),
            'new_item_name'              => __( 'Nuovo destinatario modulistica' ),
            'separate_items_with_commas' => __( 'Separa i destinatri con le virgole' ),
            'add_or_remove_items'        => __( 'Aggiungi o rimuovi destinatari' ),
            'choose_from_most_used'      => __( 'Scegli uno dei pi&grave; usati destinatari' ),
            'not_found'                  => __( 'Nessun destinatario trovato.' ),
            'menu_name'                  => __( 'Destinatari Modulistica' ),
        );
        $args_destinatari = array(
            'hierarchical'      => true,
            'labels'            => $destinatari,
            'show_ui'           => true,
            'show_admin_column' => true,
            'support'           => array( 'title' ),
            'query_var'         => true,
            'rewrite'           => array(
                'slug' => self::TAXONOMIA,
                'with_front' => true
            ),
            'public'            => true,
            'show_in_nav_menus' => true,
        );

        register_taxonomy( self::TAXONOMIA, array( 'scuola_modulistica' ), $args_destinatari );
    }

}

class TipologiamodulisticaTaxonomie extends MadisoftTaxonomyClass implements MadisoftTaxonomyInterface {

    const TAXONOMIA = 'tipologia_modulistica';

    function __construct( $parentClass ) {
        $this->setPosition( dirname( __FILE__ ) );
        $this->crea_taxonomy();
        $this->setTaxonomyName( self::TAXONOMIA );
        $this->setParentCustomPostTypeClass( $parentClass );
        $this->getParentCustomPostTypeClass()->addTaxonomyChilds( self::TAXONOMIA );
        add_filter( "taxonomy_template", array( $this, "get_post_type_archive_template" ) );
    }

    public function crea_taxonomy() {
        $tipologie = array(
            'name'                       => _x( 'Tipologie Modulistica', 'taxonomy general name' ),
            'singular_name'              => _x( 'Tipologia Modulistica', 'taxonomy singular name' ),
            'search_items'               => __( 'Cerca tipologie' ),
            'popular_items'              => __( 'Tipologie pi&ugrave; usate' ),
            'all_items'                  => __( 'Tutte le tipologie' ),
            'parent_item'                => __( 'Tipologia - genitore' ),
            'parent_item_colon'          => __( 'Tipologie' ),
            'edit_item'                  => __( 'Modifica Tipologia' ),
            'update_item'                => __( 'Aggiorna Tipoloia' ),
            'add_new_item'               => __( 'Aggiungi una nuova Tipologia' ),
            'new_item_name'              => __( 'Nuova Tipologia' ),
            'separate_items_with_commas' => __( 'Separa le tipologie con le virgole' ),
            'add_or_remove_items'        => __( 'Aggiungi o rimuovi tipologie' ),
            'choose_from_most_used'      => __( 'Scegli una  delle tipologie pi&grave; usate' ),
            'not_found'                  => __( 'Nessuna tipologia Trovata.' ),
            'menu_name'                  => __( 'Tipologie' ),
        );

        $args_tipologie = array(
            'hierarchical'      => true,
            'labels'            => $tipologie,
            'show_ui'           => true,
            'show_admin_column' => true,
            'support'           => array( 'title' ),
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'tipologia_modulistica' ),
            'public'            => true,
            'show_in_nav_menus' => true,
        );

        register_taxonomy( self::TAXONOMIA, array( 'scuola_modulistica' ), $args_tipologie );
    }
}
