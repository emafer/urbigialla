<?php
global $madisoftTheme;

class ServizioOnLineGenerator extends MadisoftThemeCustomPostTypeExtendClass implements MadisoftPostTypeInterface
{

    function  __construct( \MadisoftPostTypeClass $PostTypeCLass, \MadisoftThemeFieldCreateClass $madisoftThemeFieldCreate ) {
        $this->setPosition( dirname( __FILE__ ) );
        $this->setPostTypeCLass( $PostTypeCLass );
        $this->setCreateFieldClass( $madisoftThemeFieldCreate );
        $this->setSlug( 'servizi_online' );
        $this->setPostTypeName( 'servizio_online' );
        $this->setPostTitle( 'Nome' );
        $this->getPostTypeCLass()->setShowInRest(false);
        $this->getPostTypeCLass()->setMenuPosition( 6 );
        $this->getPostTypeCLass()->setSlug( 'servizi_online' );
        $this->getPostTypeCLass()->setPostTypeName( 'servizio_online' );
        $this->getPostTypeCLass()->setSupportAuthor( false );
        $this->getPostTypeCLass()->setSupportPageAttributes( false);
        $this->getPostTypeCLass()->setSupportEditor(false);
        $this->getPostTypeCLass()->setPublic(false);
        $this->getPostTypeCLass()->setExcludeFromSearch(true);
        $this->setTemplatePages();
        $labels = [
            'singular_name' => 'Servizio',
            'menu_name'     => 'Servizi online',
            'all_items'     => 'Tutti i servizi',
            'add_new'       => 'Crea servizio',
            'add_new_item'  => 'Crea nuovo',
            'edit_item'     => 'Modifica',
            'new_item'      => 'Nuovo servizio',
            'view_item'     => 'Guarda servizio',
            'search_items'  => 'Cerca servzi',
            'not_found'     => 'Nessun servizio trovato',
            'not_found_in_trash'    => 'Nessun servizio nel cestino'
        ];

        $this->getPostTypeCLass()->setLabels($labels);
        $this->getPostTypeCLass()->register_post_type();
        add_action( 'admin_enqueue_scripts', array( $this, 'load_admin_styles' ) );
        add_action( 'add_meta_boxes', array( $this, 'add_servizio_meta_boxes' ) );
        add_action( 'save_post', array( $this, 'save_servizio_meta_data' ) );

        add_filter( 'post_updated_messages', array( $this, 'servizio_updated_messages' ) );
        add_filter( "single_template", array( $this, "get_servizio_online_post_type_template" ) );

        add_action('manage_edit-servizio_online_sortable_columns', array( $this,'aggiungi_colonna_ordinamento_alle_sortable_columns'));
        add_action('manage_edit-lservizio_online_columns', array( $this,'aggiungi_colonna_ordinamento'));
        add_action('manage_posts_custom_column', array( $this,'valore_colonna_ordinamento'));

    }

    function aggiungi_colonna_ordinamento_alle_sortable_columns( $columns ) {
        $columns['menu_order'] = 'Ordinamento';
        return $columns;
    }

    public function aggiungi_colonna_ordinamento($columns)
    {
        $columns['menu_order'] = "Ordinamento";
        return $columns;
    }

    public function valore_colonna_ordinamento($column)
    {
        global $post;
        switch ($column) {
            case 'menu_order':
                $ordinamento = $post->menu_order;
                echo $ordinamento;
                break;
        }
    }

    public function get_servizio_online_post_type_template( $single_template ) {
        global $post;

        if ( $post->post_type == 'le_scuole' ) {
            $single_template = dirname( __FILE__ ) . '/single.php';
        }

        return $single_template;
    }

    public function servizio_updated_messages( $messages ) {
        $post             = get_post();
        $post_type        = get_post_type( $post );
        $post_type_object = get_post_type_object( $post_type );

        $messages['servizio_online'] = array(
            0  => '', // Unused. Messages start at index 1.
            1  => 'Servizio aggiornato',
            2  => __( 'Campo modificato.', 'madisoft_scuola' ),
            3  => __( 'Campo eliminato.', 'madisoft_scuola' ),
            4  => __( 'Servizio modificata.', 'madisoft_scuola' ),
            /* translators: %s: date and time of the revision */
            5  => isset( $_GET['revision'] ) ? sprintf( __( 'servizio ripristinato alla revisione del %s', 'madisoft_scuola' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
            6  => __( 'Servizio pubblicato.', 'madisoft_scuola' ),
            7  => __( 'Servizio salvato.', 'madisoft_scuola' ),
            8  => __( 'Servizio inviato.', 'madisoft_scuola' ),
            9  => sprintf(
                __( 'Il servizio sar&agrave; pubblicato il: <strong>%1$s</strong>.', 'madisoft_scuola' ),
                // translators: Publish box date format, see http://php.net/date
                date_i18n( __( 'M j, Y @ G:i', 'madisoft_scuola' ), strtotime( $post->post_date ) )
            ),
            10 => __( 'Bozza modificata.', 'madisoft_scuola' ),
        );

        return $messages;
    }


    public function load_admin_styles() {
        wp_enqueue_style( 'admin_css_scuola', madisoft_scuola_get_assets_directory( 'post-type' ) . 'scuola-post-type/assets/admin/scuola.css', false, '1.0.0' );
    }

    public function servizio_dati_aggiuntivi_form() {
        global $post;
        $this->getCreateFieldClass()->addNoncefield( 'servizio_dati_aggiuntivi' );
        $form = [ ];
        $form = $this->settaIlForm( $post, $form );

        $this->getCreateFieldClass()->setListOfField( $form );
        $this->getCreateFieldClass()->scriviIlForm();
    }

    public function add_servizio_meta_boxes() {
        add_meta_box(
            'servizio_dati_aggiuntivi',
            'link',
            array( $this, 'servizio_dati_aggiuntivi_form' ),
            'servizio_online',
            'normal',
            'high'
        );

    }

    public function save_servizio_meta_data( $id ) {
        global $post;
        $this->getCreateFieldClass()->addNoncefield( 'servizio_dati_aggiuntivi' );
        $form = [ ];
        $form = $this->settaIlForm( $post, $form );

        $this->getCreateFieldClass()->setListOfField( $form );
        $this->getCreateFieldClass()->salvaIlForm( $id );
    }

    /**
     * @param $post
     * @param $form
     *
     * @return array
     */
    protected function settaIlForm( $post, $form ) {
        $form[0]= [
            'dati_scolastici' => [
                0 => [
                    'id'             => 'servizio_link',
                    'title'          => 'Link del servizio',
                    'value'          => $this->getValueOfOption( $post, 'servizio_link', true ),
                    'type'           => 'text',
                    'separator'      => '<br/>',
                    'htmlAttributes' => [
                        ],
                    ],
                1=> [
                    'id'             => 'servizio_descrizione',
                    'title'          => 'descrizione del servizio',
                    'value'          => $this->getValueOfOption( $post, 'servizio_descrizione', true ),
                    'type'           => 'text',
                    'separator'      => '<br/>',
                    'htmlAttributes' => [
                    ],
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

$servizioOnLinePT = new ServizioOnLineGenerator( new MadisoftPostTypeClass(), new MadisoftThemeFieldCreateClass() );

madisoft_get_theme_class()->addGlobalVar( 'servizioonline_post_type', $servizioOnLinePT );

