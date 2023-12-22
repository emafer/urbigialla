<?php
    add_action( 'init', 'fascia_post_type_init' );
function fascia_post_type_init() {
    global $madisoftTheme;
    $fasciaPostType              = new FasciaPostType( new MadisoftPostTypeClass(), new MadisoftThemeFieldCreateClass() );

}

class FasciaPostType extends MadisoftThemeCustomPostTypeExtendClass {

    public function  __construct( \MadisoftPostTypeClass $PostTypeCLass, \MadisoftThemeFieldCreateClass $madisoftThemeFieldCreate ) {
        $this->setPosition( dirname( __FILE__ ) );
        $this->setPostTypeCLass( $PostTypeCLass );
        $this->setCreateFieldClass( $madisoftThemeFieldCreate );
        $this->setSlug( 'tutte_le_fasce' );
        $PostTypeCLass->setPublic(true);
        $PostTypeCLass->setShowInRest(true);
        $this->setPostTypeName( 'fascia_home' );
        $this->getPostTypeCLass()->setSlug( 'tutte_le_fasce' );
        $this->getPostTypeCLass()->setPostTypeName( 'fascia_home' );
        $this->getPostTypeCLass()->setSupportThumbnail( false );
        $this->getPostTypeCLass()->setSupportEditor( true );
        $labels = array(
            'name'               => _x( 'Fascia home', 'post type general name', 'madisoft_scuola' ),
            'singular_name'      => _x( 'Fascia Home', 'post type singular name', 'madisoft_scuola' ),
            'menu_name'          => _x( 'Contenuto per Fascia', 'admin menu', 'madisoft_scuola' ),
            'name_admin_bar'     => _x( 'Fascia', 'add new on admin bar', 'madisoft_scuola' ),
            'add_new'            => _x( 'Nuova', 'circolare', 'madisoft_scuola' ),
            'add_new_item'       => __( 'Nuova fascia', 'madisoft_scuola' ),
            'new_item'           => __( 'Nuova fascia', 'madisoft_scuola' ),
            'edit_item'          => __( 'Modifica fascia', 'madisoft_scuola' ),
            'view_item'          => __( 'Leggi Fascia', 'madisoft_scuola' ),
            'all_items'          => __( 'Tutte le fasce', 'madisoft_scuola' ),
            'search_items'       => __( 'Cerca fasce', 'madisoft_scuola' ),
            'parent_item_colon'  => __( '--', 'madisoft_scuola' ),
            'not_found'          => __( 'Nessuna fascia trovata.', 'madisoft_scuola' ),
            'not_found_in_trash' => __( 'Nessuna fascia cestinata.', 'madisoft_scuola' ),
        );
        $this->getPostTypeCLass()->setLabels( $labels );
        $this->getPostTypeCLass()->setPublic( true );
        $this->getPostTypeCLass()->register_post_type();
        $this->setPostTitle( 'Contenuto per la fascia' );
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
    }


    public function save_meta_data( $id ) {
        $this->preparaIlForm();
        $this->getCreateFieldClass()->salvaIlForm( $id );
    }

    public function create_updated_messages( $messages ) {
        $post             = get_post();
        $post_type        = get_post_type( $post );
        $post_type_object = get_post_type_object( $post_type );
        $messages['scuola_fasce'] = array(
            0  => '', // Unused. Messages start at index 1.
            1  => __( 'Fascia modificata.', 'madisoft_scuola' ),
            2  => __( 'Campo modificato.', 'madisoft_scuola' ),
            3  => __( 'Campo eliminato.', 'madisoft_scuola' ),
            4  => __( 'Contenuto fascia modificata.', 'madisoft_scuola' ),
            /* translators: %s: date and time of the revision */
            5  => isset( $_GET['revision'] ) ? sprintf( __( 'Fascia ripristinata alla revisione del %s', 'madisoft_scuola' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
            6  => __( 'Fascia pubblicata.', 'madisoft_scuola' ),
            7  => __( 'Fascia salvata.', 'madisoft_scuola' ),
            8  => __( 'Fascia inviata.', 'madisoft_scuola' ),
            9  => sprintf(
                __( 'La Fascia sar&agrave; pubblicata il: <strong>%1$s</strong>.', 'madisoft_scuola' ),
                // translators: Publish box date format, see http://php.net/date
                date_i18n( __( 'M j, Y @ G:i', 'madisoft_scuola' ), strtotime( $post->post_date ) )
            ),
            10 => __( 'Bozza modificata.', 'madisoft_scuola' ),
        );
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


    /**
     * @param $post
     * @param $form
     *
     * @return array
     */
    protected function settaIlForm( $post ) {

        $this->getCreateFieldClass()->addNoncefield( 'dati_fascia_nonce' );
        $form   = [ ];

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
}