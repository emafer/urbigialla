<?php
if ( madisoft_get_theme_option('madisoft_scuola_circolari_uso', 'on') == 'on' ) {
    add_action( 'init', 'circolari_init' );
    add_filter( 'manage_posts_custom_column', 'madisoft_scuola_circolari_list_post_value', 10, 2 );
    add_filter( 'manage_scuola_circolari_posts_columns', 'scuola_circolari_set_columns_progetto' );
}
function circolari_init() {
    $CircolariPostType              = new CircolariPostType( new MadisoftPostTypeClass(), new MadisoftThemeFieldCreateClass() );
    $DestinatariCircolariTaxonomie  = new DestinatariCircolariTaxonomie( $CircolariPostType );
    $TipologiaCircolariTaxonomy     = new TipologiaCircolariTaxonomie( $CircolariPostType );
    madisoft_get_theme_class()->addGlobalVar( 'circolari_post_type', $CircolariPostType );
    madisoft_get_theme_class()->addGlobalVar( 'circolari_destinatari_taxonomy', $DestinatariCircolariTaxonomie );
    madisoft_get_theme_class()->addGlobalVar( 'circolari_tipologia_taxonomy', $TipologiaCircolariTaxonomy );
    add_filter('manage_scuola_circolari_posts_columns' , 'madisoft_theme_aggiungi_colonna_riservato');
    add_filter('manage_scuola_circolari_posts_columns' , 'madisoft_theme_aggiungi_colonna_destinatari');
    add_action('manage_posts_custom_column', 'madisoft_theme_valore_colonna_destinatari', 10, 2);

}

class CircolariPostType extends MadisoftThemeCustomPostTypeExtendClass {

    public function  __construct( \MadisoftPostTypeClass $PostTypeCLass, \MadisoftThemeFieldCreateClass $madisoftThemeFieldCreate ) {
        $this->setPosition( dirname( __FILE__ ) );
        $this->setPostTypeCLass( $PostTypeCLass );
        $this->setCreateFieldClass( $madisoftThemeFieldCreate );
        $this->setSlug( 'tutte_le_circolari' );
        $this->setPostTypeName( 'scuola_circolari' );
        $this->getPostTypeCLass()->setSlug( 'tutte_le_circolari' );
        $this->getPostTypeCLass()->setPostTypeName( 'scuola_circolari' );
        $this->getPostTypeCLass()->setSupportThumbnail( false );
        $this->getPostTypeCLass()->setSupportEditor( false );
        $labels = array(
            'name'               => _x( 'Circolari', 'post type general name', 'madisoft_scuola' ),
            'singular_name'      => _x( 'Circolare', 'post type singular name', 'madisoft_scuola' ),
            'menu_name'          => _x( 'Circolari', 'admin menu', 'madisoft_scuola' ),
            'name_admin_bar'     => _x( 'Circolare', 'add new on admin bar', 'madisoft_scuola' ),
            'add_new'            => _x( 'Nuova', 'circolare', 'madisoft_scuola' ),
            'add_new_item'       => __( 'Aggiungi circolare', 'madisoft_scuola' ),
            'new_item'           => __( 'Nuova circolare', 'madisoft_scuola' ),
            'edit_item'          => __( 'Modifica circolare', 'madisoft_scuola' ),
            'view_item'          => __( 'Leggi Circolare', 'madisoft_scuola' ),
            'all_items'          => __( 'Tutte le circolari', 'madisoft_scuola' ),
            'search_items'       => __( 'Cerca circolari', 'madisoft_scuola' ),
            'parent_item_colon'  => __( 'Circolari superiori:', 'madisoft_scuola' ),
            'not_found'          => __( 'Nessuna circolare trovata.', 'madisoft_scuola' ),
            'not_found_in_trash' => __( 'Nessuna circolare cestinata.', 'madisoft_scuola' ),
        );
        $this->getPostTypeCLass()->setLabels( $labels );
        $this->getPostTypeCLass()->setPublic( true );
        $this->getPostTypeCLass()->register_post_type();
        $this->setPostTitle( 'Oggetto' );
        add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
        add_action( 'save_post', array( $this, 'save_meta_data' ) );
        add_filter( 'post_updated_messages', array( $this, 'create_updated_messages' ) );

        $this->setTemplatePages();
    }
    public function crea_form() {
        $this->preparaIlForm();
        $this->getCreateFieldClass()->scriviIlForm();
    }

    public function add_meta_boxes() {
        add_meta_box(
            'dati_circolari',
            'Dati Circolare',
            array( $this, 'crea_form' ),
            'scuola_circolari',
            'normal',
            'high'
        );

    }

    public function save_meta_data( $id ) {
        $this->preparaIlForm();
        $this->getCreateFieldClass()->salvaIlForm( $id );
    }

    public function create_updated_messages( $messages ) {
        $post             = get_post();
        $post_type        = get_post_type( $post );
        $post_type_object = get_post_type_object( $post_type );
        $messages['scuola_circolari'] = array(
            0  => '', // Unused. Messages start at index 1.
            1  => __( 'Circolare modificata.', 'madisoft_scuola' ),
            2  => __( 'Campo modificato.', 'madisoft_scuola' ),
            3  => __( 'Campo eliminato.', 'madisoft_scuola' ),
            4  => __( 'Circolare modificata.', 'madisoft_scuola' ),
            /* translators: %s: date and time of the revision */
            5  => isset( $_GET['revision'] ) ? sprintf( __( 'Circolare ripristinata alla revisione del %s', 'madisoft_scuola' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
            6  => __( 'Circolare pubblicata.', 'madisoft_scuola' ),
            7  => __( 'Circolare salvata.', 'madisoft_scuola' ),
            8  => __( 'Circolare inviata.', 'madisoft_scuola' ),
            9  => sprintf(
                __( 'La circolare sar&agrave; pubblicata il: <strong>%1$s</strong>.', 'madisoft_scuola' ),
                // translators: Publish box date format, see http://php.net/date
                date_i18n( __( 'M j, Y @ G:i', 'madisoft_scuola' ), strtotime( $post->post_date ) )
            ),
            10 => __( 'Bozza modificata.', 'madisoft_scuola' ),
        );
        if ( isset( $post->circolare_data_nonce ) ) {
            if ( $post_type_object->publicly_queryable ) {
                $permalink = get_permalink( $post->ID );
                $view_link = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), __( 'Guarda circolare', 'madisoft_scuola' ) );
                $messages[ $post_type ][1] .= $view_link;
                $messages[ $post_type ][6] .= $view_link;
                $messages[ $post_type ][9] .= $view_link;
                $preview_permalink = add_query_arg( 'preview', 'true', $permalink );
                $preview_link      = sprintf( ' <a target="_blank" href="%s">%s</a>', esc_url( $preview_permalink ), __( 'Anteprima della circolare', 'madisoft_scuola' ) );
                $messages[ $post_type ][8] .= $preview_link;
                $messages[ $post_type ][10] .= $preview_link;
            }
        }
        return $messages;
    }

    /**
     * Restituisce la query per effettuare la ricerca delle circolari filtrando per tipologia, destinatario e data
     *
     * @param $max numero limite circolari da mostrare
     *
     *@return WP_Query
     *
     */
    static function getAll( $maxLimitSearch = -1) {

        global $wp_query;
        $category = get_queried_object();
        if ( isset( $category->taxonomy ) ) {
            if ( $category->taxonomy != 'destinatari_circolari' && $category->taxonomy != 'tipologia_circolari' && ( $category->taxonomy != 'category' && $category->slug == 'scuola_circolari' ) ) {
                return $wp_query;
            }
        }
        if ( isset( $category->query_var ) && $category->query_var != 'scuola_circolari' ) {
            return $wp_query;
        }
        if ( isset( $category->term_id ) ) {
            if ( $category->taxonomy == 'destinatari_circolari' ) {
                $_POST['destinatari'] = isset( $_POST['destinatari'] ) ? filter_var ( $_POST['destinatari'], FILTER_SANITIZE_STRING) : $category->term_id;
                $_POST['tipologia'] = isset( $_POST['tipologia'] ) ? filter_var ( $_POST['tipologia'], FILTER_SANITIZE_STRING) : 0;
            } else {
                $_POST['tipologia']   = isset( $_POST['tipologia'] ) ? filter_var ( $_POST['tipologia'], FILTER_SANITIZE_STRING) : $category->term_id;
                $_POST['destinatari'] = isset( $_POST['destinatari'] ) ? filter_var ( $_POST['destinatari'], FILTER_SANITIZE_STRING) : 0;
            }
        } else {
            $_POST['tipologia']   = isset( $_POST['tipologia'] ) ? filter_var ( $_POST['tipologia'], FILTER_SANITIZE_STRING) : 0;
            $_POST['destinatari'] = isset( $_POST['destinatari'] ) ? filter_var ( $_POST['destinatari'], FILTER_SANITIZE_STRING) : 0;
        }

        $taxonomy = array();
        if ( isset( $wp_query->query_vars['taxonomy'] ) && $wp_query->query_vars['taxonomy'] ) {
            $taxonomy[ $wp_query->query_vars['taxonomy'] ] = $wp_query->query[ $wp_query->query_vars['taxonomy'] ];
        }
        $args = array(
            'post_type' => 'scuola_circolari',
            'posts_per_page' => $maxLimitSearch,
            'orderby'  => 'meta_value',
            'meta_key' => 'circolare_data',
            'tax_query'  => array(),
            'meta_query' => array()
        );

        if ( isset( $_POST['titolo'] ) && $_POST['titolo'] != '' ) {
            $args['post_title_like'] = filter_var ( $_POST['titolo'], FILTER_SANITIZE_STRING);
        }
        if ( $_POST['tipologia'] ) {
            $args['tax_query'][] = array(
                'taxonomy' => 'tipologia_circolari',
                'terms' => $_POST['tipologia'],
                'field'    => 'id',
                'compare'  => 'in'
            );
        }
        if ( $_POST['destinatari'] ) {
            $args['tax_query'][] = array(
                'taxonomy' => 'destinatari_circolari',
                'terms' => $_POST['destinatari'],
                'field'    => 'id',
                'compare'  => 'in'
            );
        }
        if ( isset( $_POST['data_da'] ) && $_POST['data_da'] != '' ) {
            $date = $_POST['data_da'];
            if ( ! preg_match( '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $date ) ) {
                $d    = DateTime::createFromFormat( 'd/m/Y', $_POST['data_da'] );
                $_POST['data_da'] = $d->format( 'Y-m-d' );
            }
        } else {
            $_POST['data_da'] = date( 'Y-m-d', mktime( 0, 0, 0, date( 'm' ) - 1, 1, date( 'Y' ) ) );
        }
        if ( isset( $_POST['data_a'] ) && $_POST['data_a'] != '' ) {
            $date = $_POST['data_a'];
            if ( ! preg_match( '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $date ) ) {
                $d    = DateTime::createFromFormat( 'd/m/Y', $_POST['data_a'] );
                $_POST['data_a'] = $d->format( 'Y-m-d' );
            }
        } else {
            $_POST['data_a'] = date( 'Y-m-d' );
        }

        $args['meta_query'][] = array(
            'key'     => 'circolare_data',
            'value'   => $_POST['data_da'],
            'compare' => '>=',
        );
        $args['meta_query'][] = array(
            'key'     => 'circolare_data',
            'value'   => $_POST['data_a'],
            'compare' => '<=',
        );
        $query = new WP_Query( $args );

        return $query;
    }


    /**
     * @param $post
     * @param $form
     *
     * @return array
     */
    protected function settaIlForm( $post ) {

        $this->getCreateFieldClass()->addNoncefield( 'dati_circolari_nonce' );
        $form   = [ ];
        $data   = $this->getValueOfOption( $post, 'circolare_data', true );
        $form[] = [
            'allegato_media' => [
                0 => [
                    'id'        => 'circolare_numero',
                    'title'     => 'Numero Circolare',
                    'value'     => $this->getValueOfOption( $post, 'circolare_numero', true ),
                    'type'      => 'text',
                    'separator' => '<br/>',
                ],
                1 => [
                    'id'        => 'circolare_data',
                    'title'     => 'Data Circolare',
                    'value'     => ( $data ) ? $data : date( 'Y-m-d' ),
                    'type' => 'date',
                    'separator' => '<br/>',
                ],
                2 => [
                    'id'        => 'circolare_allegato',
                    'title'     => 'Carica Allegato',
                    'value'     => $this->getValueOfOption( $post, 'circolare_allegato', true ),
                    'type'      => 'media',
                    'separator' => '<br/>',
                ],
            3 => [
                'id'        => 'circolare_allegato2',
                'title'     => 'Carica Allegato',
                'value'     => $this->getValueOfOption( $post, 'circolare_allegato2', true ),
                'type'      => 'media',
                'separator' => '<br/>',
            ],
            4 => [
                'id'        => 'circolare_allegato3',
                'title'     => 'Carica Allegato',
                'value'     => $this->getValueOfOption( $post, 'circolare_allegato3', true ),
                'type'      => 'media',
                'separator' => '<br/>',
            ],
            5 => [
                'id'        => 'circolare_allegato4',
                'title'     => 'Carica Allegato',
                'value'     => $this->getValueOfOption( $post, 'circolare_allegato4', true ),
                'type'      => 'media',
                'separator' => '<br/>',
            ],
            6 => [
                'id'        => 'circolare_allegato5',
                'title'     => 'Carica Allegato',
                'value'     => $this->getValueOfOption( $post, 'circolare_allegato5', true ),
                'type'      => 'media',
                'separator' => '<br/>',
            ],
			
            7 => [
                'id'        => 'circolare_allegato6',
                'title'     => 'Carica Allegato',
                'value'     => $this->getValueOfOption( $post, 'circolare_allegato6', true ),
                'type'      => 'media',
                'separator' => '<br/>',
            ],
			
            8 => [
                'id'        => 'circolare_allegato7',
                'title'     => 'Carica Allegato',
                'value'     => $this->getValueOfOption( $post, 'circolare_allegato7', true ),
                'type'      => 'media',
                'separator' => '<br/>',
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

    protected function preparaIlForm() {
        global $post;
        $form = $this->settaIlForm( $post );
        $this->getCreateFieldClass()->setListOfField( $form );
    }

    public function createTable() {
        wp_register_style('circolari-css', madisoft_scuola_get_assets_directory( 'css' ) . 'circolari.css', array() );
        wp_enqueue_style( 'circolari-css' );
        echo '<div class="risultatiCircolari">';
        $this->creaCorpoTabella2();
        echo '</div>';
        echo '<div style="clear: both"></div>';
    }
    protected function creaCorpoTabella2() {
        global $post;
        $array = [ ];
        while ( have_posts() ) {
            the_post();
            $data   = get_post_meta( $post->ID, 'circolare_data', true );
            $numero = get_post_meta( $post->ID, 'circolare_numero', true );
            if ( madisoft_get_theme_option( 'madisoft_scuola_circolari_ordine', '1' ) == 1 ) {
                $array = $this->ordinaCircolariPerDataENumero( $array, $data, $numero, $post );
                krsort( $array );
            } else {
                $array = $this->ordinaCircolariPerNumero( $array, $data, $numero, $post );
                krsort( $array );
            }
        }

        foreach ( $array as $circolareData => $circolari ) {
            krsort($circolari);
            foreach ( $circolari as $circolareArray ) {
                foreach ( $circolareArray as $circolare ) {
                    if ( possoVisualizzareQuestoContenuto( $circolare['id'] ) ) {
                        ?>
                            <div class="circolare row" id="circolare_<?php echo $circolare['id'];?>">
                                <div class="data_circolare_container col-<?php echo MadisoftScuolaWidth::MADISOFT_WIDTH_1_2; ?>  col-md-<?php echo MadisoftScuolaWidth::MADISOFT_WIDTH_1_12; ?>"><span class="data_circolare">
                                    <?php $dataFormattata = new DateTime( $circolare['data'] );
                                        echo $dataFormattata->format( 'd/m/Y' );
                                    ?></span>
                                </div>
                        <div class="numero_circolare_container col-<?php echo MadisoftScuolaWidth::MADISOFT_WIDTH_1_2; ?>  col-md-<?php echo MadisoftScuolaWidth::MADISOFT_WIDTH_1_12; ?>"><span class="numero_circolare">Circ. <?php echo $circolare['numero']; ?></span></div>
                                <div class="dati-circolare col-<?php echo MadisoftScuolaWidth::MADISOFT_WIDTH_ALL; ?>  col-md-<?php echo MadisoftScuolaWidth::MADISOFT_WIDTH_5_6; ?> row">
                                    <div class="titolo_circolare col-<?php echo MadisoftScuolaWidth::MADISOFT_WIDTH_ALL; ?>  col-md-<?php echo MadisoftScuolaWidth::MADISOFT_WIDTH_ALL; ?>">
                                        <a href="<?php echo get_permalink( $circolare['id']); ?>"><?php echo $circolare['titolo']; ?></a>
                                    </div>
                                    <?php
                                    if ( madisoft_get_theme_option( 'madisoft_scuola_circolari_tipologia', '1' ) == '1' ) {
                                        ?>
                                        <div class="col-<?php echo MadisoftScuolaWidth::MADISOFT_WIDTH_ALL; ?> col-md-<?php echo MadisoftScuolaWidth::MADISOFT_WIDTH_1_2; ?> tipologia_circolare"><?php echo madisoft_scuola_print_categorie_tag( $circolare['id'], 'tipologia_circolari', false); ?></div>
                                        <?php
                                    }
                                    if ( madisoft_get_theme_option( 'madisoft_scuola_circolari_destinatari', '1' ) == '1' ) {
                                        ?>
                                        <div class="col-<?php echo MadisoftScuolaWidth::MADISOFT_WIDTH_ALL; ?> col-md-<?php echo MadisoftScuolaWidth::MADISOFT_WIDTH_1_2; ?> destinatari_circolare text-right offset-md-<?php echo MadisoftScuolaWidth::MADISOFT_WIDTH_1_2; ?>"><?php echo madisoft_scuola_print_categorie_tag( $circolare['id'], 'destinatari_circolari', false); ?></div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php
                    }
                }
            }
        }
    }

    /**
     * @param $array
     * @param $data
     * @param $numero
     * @param $post
     *
     * @return mixed
     */
    protected function ordinaCircolariPerDataENumero( $array, $data, $numero, $post ) {

        if ( ! isset( $array[ $data ] ) ) {
            $array[ $data ] = [ ];
        }
        $array[ $data ][ intval( $numero ) ][] = [
            'numero' => $numero,
            'data'   => $data,
            'titolo' => get_the_title(),
            'link'   => get_post_meta( $post->ID, 'circolare_allegato', true ),
            'id'     => $post->ID
        ];

        return $array;
    }

    /**
     * @param $array
     * @param $data
     * @param $numero
     * @param $post
     *
     * @return mixed
     */
    protected function ordinaCircolariPerNumero( $array, $data, $numero, $post ) {

        if ( ! isset( $array[ $numero ] ) ) {
            $array[ $numero ] = [ ];
        }
        if ( ! isset( $array[ $numero ] [ $data ] ) ) {
            $array[ $numero ][ $data ] = [ ];
        }
        $array[ intval( $numero ) ][ $data ][] = [
            'numero' => $numero,
            'data'   => $data,
            'titolo' => get_the_title(),
            'link'   => get_post_meta( $post->ID, 'circolare_allegato', true ),
            'id'     => $post->ID
        ];

        return $array;
    }

}

class DestinatariCircolariTaxonomie extends MadisoftTaxonomyClass implements MadisoftTaxonomyInterface {

    const TAXONOMIA = 'destinatari_circolari';

    public function __construct( $parentClass ) {
        $this->crea_taxonomy();
        new MadisoftCustomTaxonomyFieldClass( self::TAXONOMIA, 'destinatari_circolari_order' );
        $this->setPosition( dirname( __FILE__ ) );
        $this->setParentCustomPostTypeClass( $parentClass );
        $this->setTaxonomyName( self::TAXONOMIA );
        $this->getParentCustomPostTypeClass()->addTaxonomyChilds( self::TAXONOMIA );
    }

    function crea_taxonomy() {
        $destinatari = array(
            'name'                       => _x( 'Destinatari Circolari', 'taxonomy general name' ),
            'singular_name'              => _x( 'Destinatario circ. ', 'taxonomy singular name' ),
            'search_items'               => __( 'Cerca destinari circolari' ),
            'popular_items'              => __( 'Destinatari pi&ugrave; usati' ),
            'all_items'                  => __( 'Tutti i destinatari' ),
            'parent_item'                => __( 'Macro destinatari' ),
            'parent_item_colon'          => __( 'Destinatari' ),
            'edit_item'                  => __( 'Modifica destinatario' ),
            'update_item'                => __( 'Aggiorna destinatario' ),
            'add_new_item'               => __( 'Aggiungi un nuovo destinatario' ),
            'new_item_name'              => __( 'Nuovo destinatario' ),
            'separate_items_with_commas' => __( 'Separa i destinatri con le virgole' ),
            'add_or_remove_items'        => __( 'Aggiungi o rimuovi destinatari' ),
            'choose_from_most_used'      => __( 'Scegli uno dei pi&grave; usati destinatari' ),
            'not_found'                  => __( 'Nessun destinatario trovato.' ),
            'menu_name'                  => __( 'Destinatari Circolari' ),
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
                'with_front'   => true,
                'hierarchical' => true
            ),
            'public'            => true,
            'show_in_nav_menus' => true,
        );

        register_taxonomy( self::TAXONOMIA, array( 'scuola_circolari' ), $args_destinatari );
    }

}

class TipologiaCircolariTaxonomie extends MadisoftTaxonomyClass implements MadisoftTaxonomyInterface {

    const TAXONOMIA = 'tipologia_circolari';

    public function __construct( $parentClass ) {
        $this->setPosition( dirname( __FILE__ ) );
        $this->crea_taxonomy();
        $this->setTaxonomyName( self::TAXONOMIA );
        $this->setParentCustomPostTypeClass( $parentClass );
        $this->getParentCustomPostTypeClass()->addTaxonomyChilds( self::TAXONOMIA );
        add_filter( "taxonomy_template", array( $this, "get_post_type_archive_template" ) );
    }

    public function crea_taxonomy() {
        $tipologie = array(
            'name'                       => _x( 'Tipologie Circolari', 'taxonomy general name' ),
            'singular_name'              => _x( 'Tipologia Circolari ', 'taxonomy singular name' ),
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
            'rewrite'           => array( 'slug' => 'tipologie_circolari' ),
            'public'            => true,
            'show_in_nav_menus' => true,
        );

        register_taxonomy( self::TAXONOMIA, array( 'scuola_circolari' ), $args_tipologie );
    }
}

function madisoft_scuola_circolari_list_post_value( $column_name, $id ) {

    if ( isset( $_GET['post_type'] ) && 'scuola_circolari' != cleanGetPost($_GET['post_type']) ) {
        return false;
    }
    if ( $column_name === 'data' ) {
        $data = new DateTime( get_post_meta( $id, 'circolare_data', true ) );
        $ed   = $data->format( 'd/m/Y' );
        echo $ed;
    }
    if ( $column_name === 'numero' ) {
        $ed = get_post_meta( $id, 'circolare_numero', true );
        echo $ed;
    }

    if ( $column_name === 'title' ) {
        $ed = get_the_title( $id );
        echo $ed;
    }

    if ( $column_name === 'allegato' ) {
        $ed = basename( get_post_meta( $id, 'circolare_allegato', true ) );
        echo $ed;
        if ( get_post_meta ( $id, 'circolare_allegato2', true ) ){
            echo ", " . basename( get_post_meta( $id, 'circolare_allegato2', true ) );
        }
        if ( get_post_meta ( $id, 'circolare_allegato3', true ) ){
            echo ", " . basename( get_post_meta( $id, 'circolare_allegato3', true ) );
        }
        if ( get_post_meta ( $id, 'circolare_allegato4', true ) ){
            echo ", " . basename( get_post_meta( $id, 'circolare_allegato4', true ) );
        }
        if ( get_post_meta ( $id, 'circolare_allegato5', true ) ){
            echo ", " . basename( get_post_meta( $id, 'circolare_allegato5', true ) );
        }
        if ( get_post_meta ( $id, 'circolare_allegato6', true ) ){
            echo ", " . basename( get_post_meta( $id, 'circolare_allegato6', true ) );
        }
        if ( get_post_meta ( $id, 'circolare_allegato7', true ) ){
            echo ", " . basename( get_post_meta( $id, 'circolare_allegato7', true ) );
        }
    }

}

function scuola_circolari_set_columns_progetto( $old_columns ) {
    $progetti_col = array(
        'cb'       => '<input type="checkbox">',
        'data'     => 'Data',
        'numero'   => 'Numero',
        'title'    => __( 'Oggetto' ),
        'allegato' => 'Allegato'
    );

    return $progetti_col;
}


class CircolariSearchAndShow {

    /**
     * @var WP_Query
     */
    protected $query;
    function __construct() {

    }

    function getLastNumber() {
        global $wpdb;
        $results = $wpdb->get_results("SELECT ID FROM $wpdb->posts WHERE $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'scuola_circolari' ORDER BY $wpdb->posts.ID DESC LIMIT 1 ");
        $numero = '';
        if ($results){
            $circolareObQ = $results[0];
            $numero = get_post_meta( $circolareObQ->ID, 'circolare_numero', true );
        }

        return $numero;
    }

    function getAll( $thisMonth = true) {

        global $wp_query;
        $category = get_queried_object();
        if ( isset( $category->taxonomy ) ) {
            if ( $category->taxonomy != 'destinatari_circolari' && $category->taxonomy != 'tipologia_circolari' && ( $category->taxonomy != 'category' && $category->slug == 'scuola_circolari' ) ) {
                return $wp_query;
            }
        }
        if ( isset( $category->query_var ) && $category->query_var != 'scuola_circolari' ) {
            return $wp_query;
        }
        if ( isset( $category->term_id ) ) {
            if ( $category->taxonomy == 'destinatari_circolari' ) {
                $_POST['destinatari'] = isset( $_POST['destinatari'] ) ? filter_var( $_POST['destinatari'], FILTER_SANITIZE_STRING) : $category->term_id;
                $_POST['tipologia']   = isset( $_POST['tipologia'] ) ? filter_var( $_POST['tipologia'], FILTER_SANITIZE_STRING) : 0;
            } else {
                $_POST['tipologia']   = isset( $_POST['tipologia'] ) ? filter_var( $_POST['tipologia'], FILTER_SANITIZE_STRING) : $category->term_id;
                $_POST['destinatari'] = isset( $_POST['destinatari'] ) ? filter_var( $_POST['destinatari'], FILTER_SANITIZE_STRING) : 0;
            }
        } else {
            $_POST['tipologia']   = isset( $_POST['tipologia'] ) ? filter_var( $_POST['tipologia'], FILTER_SANITIZE_STRING) : 0;
            $_POST['destinatari'] = isset( $_POST['destinatari'] ) ? filter_var( $_POST['destinatari'], FILTER_SANITIZE_STRING) : 0;
        }

        $taxonomy = array();
        if ( isset( $wp_query->query_vars['taxonomy'] ) && $wp_query->query_vars['taxonomy'] ) {
            $taxonomy[ $wp_query->query_vars['taxonomy'] ] = $wp_query->query[ $wp_query->query_vars['taxonomy'] ];
        }
        $args = array(
            'post_type'      => 'scuola_circolari',
            'posts_per_page' => - 1,
            'orderby'        => 'meta_value',
            'meta_key'       => 'circolare_data',
            'tax_query'      => array(),
            'meta_query'     => array()
        );

        if ( isset( $_POST['titolo'] ) && $_POST['titolo'] != '' ) {
            $args['post_title_like'] = filter_var ( $_POST['titolo'], FILTER_SANITIZE_STRING);
        }
        if ( $_POST['tipologia'] ) {
            $args['tax_query'][] = array(
                'taxonomy' => 'tipologia_circolari',
                'terms'    => filter_var ( $_POST['tipologia'], FILTER_SANITIZE_STRING),
                'field'    => 'id',
                'compare'  => 'in'
            );
        }
        if ( $_POST['destinatari'] ) {
            $args['tax_query'][] = array(
                'taxonomy' => 'destinatari_circolari',
                'terms'    => filter_var ( $_POST['destinatari'], FILTER_SANITIZE_STRING),
                'field'    => 'id',
                'compare'  => 'in'
            );
        }
        if ($thisMonth) {
            if (isset($_POST['data_da']) && $_POST['data_da'] != '') {
                $date = $_POST['data_da'];
                if (!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $date)) {
                    $d = DateTime::createFromFormat('d/m/Y', $_POST['data_da']);
                    $_POST['data_da'] = $d->format('Y-m-d');
                }
            } else {
                $_POST['data_da'] = date('Y-m-d', mktime(0, 0, 0, date('m') -1, 1, date('Y')));
            }
            if (isset($_POST['data_a']) && $_POST['data_a'] != '') {
                $date = $_POST['data_a'];
                if (!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $date)) {
                    $d = DateTime::createFromFormat('d/m/Y', $_POST['data_a']);
                    $_POST['data_a'] = $d->format('Y-m-d');
                }
            } else {
                $_POST['data_a'] = date('Y-m-d');
            }

            $args['meta_query'][] = array(
                'key' => 'circolare_data',
                'value' => $_POST['data_da'],
                'compare' => '>=',
            );
            $args['meta_query'][] = array(
                'key' => 'circolare_data',
                'value' => $_POST['data_a'],
                'compare' => '<=',
            );
        }
        $this->query = new WP_Query( $args );

        return $this->query;
    }

    public function createTable( $maxLimitSearch = false, $mostraTipologia = true, $mostraDestinatari = true, $largeWidth = true ) {
        ?>
        <table class="table table-bordered table-hover table-responsive">
            <thead>
            <tr>
                <th><?php
                    if ( $largeWidth ) {
                        echo 'Numero';
                    } else {
                        echo 'Num.';
                    }
                    ?></th>
                <th>Data</th>
                <th>Oggetto</th>
                <?php
                if ( $mostraTipologia && possoMostrareLaTipologiaDelleCircolari() ) {
                    echo '<th>' . madisoft_get_theme_option('madisoft_scuola_circolari_tipologia_nome', 'Tipologia') . '</th>';
                }
                if ( $largeWidth) {
                    ?>
                    <th>Allegato</th><?php
                }
                if ( $mostraDestinatari && madisoft_get_theme_option( 'madisoft_scuola_circolari_destinatari', '1' ) == '1' ) {
                    ?>
                    <th>Destinatari</th>
                    <?php
                }
                ?>
            </tr>
            </thead>
            <tbody>
            <?php $this->creaCorpoTabella( $maxLimitSearch, $mostraTipologia, $mostraDestinatari, $largeWidth); ?>
            </tbody>
        </table>
        <?php
    }

    protected function creaCorpoTabella( $maxLimitSearch, $mostraTipologia = true, $mostraDestinatari = true, $largeWidth = true) {
        global $post;
        $array             = [ ];
        $counter_circolari = 0;
        foreach ( $this->query->posts as $post) {
            $data   = get_post_meta( $post->ID, 'circolare_data', true );
            $numero   = get_post_meta( $post->ID, 'circolare_numero', true );
            if ( madisoft_get_theme_option( 'madisoft_scuola_circolari_ordine', '1' ) == 1 ) {
                $array = $this->ordinaCircolariPerDataENumero( $array, $data, $numero, $post );
                krsort( $array );
            } else {
                $array = $this->ordinaCircolariPerNumero( $array, $data, $numero, $post );
                krsort( $array );
            }
        }
        foreach ( $array as $circolareData => $circolari ) {

            ksort($circolari);
            foreach ( $circolari as $circolareArray ) {
                foreach ( $circolareArray as $circolare ) {
                    if ( $maxLimitSearch > 0 ) {
                        $counter_circolari ++;
                        if ( $counter_circolari > $maxLimitSearch ) {
                            return;
                        }
                    }
                    ?>
                    <tr>
                        <td><?php if ($largeWidth){
                            echo $circolare['numero'];
                            } else {
                                echo '<a target="_blank" href="' . get_permalink($circolare['id']) .'">' . $circolare['numero'] . '</a>';
                            } ?></td>
                        <td><?php $dataFormattata = new DateTime( $circolare['data'] );
                            echo $dataFormattata->format( 'd/m/Y' );
                            ?></td>
                        <td><?php echo $circolare['titolo']; ?></td>
                        <?php
                        if ( $mostraTipologia && madisoft_get_theme_option( 'madisoft_scuola_circolari_tipologia', '1' ) == '1' ) {
                            ?>
                            <td><?php echo madisoft_scuola_print_categorie( $circolare['id'], 'tipologia_circolari' ); ?></td>
                            <?php
                        }
                        if( $largeWidth ) {
                            ?>
                            <td>
                            <a target="_blank"
                               href="<?php echo get_permalink($circolare['id']) ?>"><?php echo madisoft_get_theme_option('madisoft_scuola_circolari_testo', 'Visualizza'); ?></a>
                            </td>
                            <?php
                        }
                        if (  $mostraDestinatari && possoMostrareIDestinatariDelleCircolari() ) {
                            ?>
                            <td>
                                <?php echo madisoft_scuola_print_categorie( $circolare['id'], 'destinatari_circolari' ); ?>
                            </td>
                            <?php
                        }
                        ?>
                    </tr>
                    <?php
                }
            }
        }
    }


    /**
     * @param $array
     * @param $data
     * @param $numero
     * @param $post
     *
     * @return mixed
     */
    protected function ordinaCircolariPerDataENumero( $array, $data, $numero, $post ) {

        if ( ! isset( $array[ $data ] ) ) {
            $array[ $data ] = [ ];
        }
        $array[ $data ][ intval( $numero ) ][] = [
            'numero' => $numero,
            'data'   => $data,
            'titolo' => get_the_title(),
            'link'   => get_post_meta( $post->ID, 'circolare_allegato', true ),
            'id'     => $post->ID
        ];
        
        rsort($array[$data]);
        
        return $array;
    }

    /**
     * @param $array
     * @param $data
     * @param $numero
     * @param $post
     *
     * @return mixed
     */
    protected function ordinaCircolariPerNumero( $array, $data, $numero, $post ) {

        if ( ! isset( $array[ $numero ] ) ) {
            $array[ $numero ] = [ ];
        }
        if ( ! isset( $array[ $numero ] [ $data ] ) ) {
            $array[ $numero ][ $data ] = [ ];
        }
        $array[ intval( $numero ) ][ $data ][] = [
            'numero' => $numero,
            'data'   => $data,
            'titolo' => get_the_title(),
            'link'   => get_post_meta( $post->ID, 'circolare_allegato', true ),
            'id'     => $post->ID
        ];

        return $array;
    }
}


function madisoft_scuola_circolari_mostra_lista_home_page()
{
    $isMostraCircolari = madisoft_get_theme_option( 'madisoft_scuola_home_circolari_mostra', null );
    $circolariNumArticoli = madisoft_get_theme_option( 'madisoft_scuola_home_circolari_numero', 0 );
    $circolariTitolo = madisoft_get_theme_option( 'madisoft_scuola_home_circolari_titolo', '' );

    if ( $isMostraCircolari == 'on' && $circolariNumArticoli > 0 ) {
        ?>
        <div id="circolari-homePage">
            <h2 class="homeTitleCategorie lista-circolari"><?php echo $circolariTitolo; ?></h2>
            <?php
            $circolari = new CircolariSearchAndShow();
            $wp_query = $circolari->getAll(false);
            if ($wp_query->have_posts()) {
                $circolari->createTable($circolariNumArticoli, false, false, false);
            }
            wp_reset_query();
            ?>
        </div>
        <?php
    }
}


/**
 * @return bool
 */
function possoMostrareLaTipologiaDelleCircolari()
{
    return madisoft_get_theme_option('madisoft_scuola_circolari_tipologia', '1') == '1';
}
/**
 * @return bool
 */
function possoMostrareIDestinatariDelleCircolari()
{
    return madisoft_get_theme_option('madisoft_scuola_circolari_destinatari', '1') == '1';
}

function madisoft_theme_aggiungi_colonna_destinatari($columns)
{
    if (get_post_type() != 'scuola_circolari'){
        return $columns;
    }

    $new_columns = array(
        'destinatari_circolari' => 'Destinatari',
    );
    return array_merge($columns, $new_columns);
}

function madisoft_theme_valore_colonna_destinatari($column, $post_id){
    switch ($column){
        case 'destinatari_circolari':
            $post_categories = get_the_terms( $post_id, 'destinatari_circolari' );
            $testoFinale = [];
            if ( $post_categories != false ) {
                foreach ( $post_categories as $tax ) {
                    if(!is_object($tax)) {
                        break;
                    }
                    $testoFinale[] = $tax->name;
                }
            }
            echo implode(', ', $testoFinale);
            break;
        default:
            break;

    }
}
