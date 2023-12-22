<?php
if ( madisoft_get_theme_option('madisoft_scuola_scuole_uso', 'on') == 'on' && madisoft_get_theme_option( 'madisoft_scuola_visualizza_servizi', 'on' ) == 'on'){

    register_post_type('scuola_service',array(
    'label'=>_x('Servizi Scolastici','smooththemes'),
    'labels'=>array(
        'singular_name'=>_x('Servizio scolastico','smooththemes'),
        'menu_name'=>_x('Servizi','smooththemes'),
        'all_items'=>_x('Tutti i servizi','smooththemes'),
        'add_new'=>_x('Aggiungi altri servizi','smooththemes'),
        'add_new_item'=>_x('Aggiungi nuovo servizio','smooththemes'),
        'edit_item'=>_x('Modifica ','smooththemes'),
        'new_item'=>_x('Nuovo servizio','smooththemes'),
        'view_item'=>_x('Guarda servizio','smooththemes'),
        'search_items'=>_x('Cerca servzi','smooththemes'),
        'not_found'=>_x('Nessun servizio trovato','smooththemes'),
        'not_found_in_trash'=>_x('Nessun servizio nel cestino','smooththemes')
    ),
    'public' => true,
    'show_ui'=>true,
    'show_in_nav_menus'=>false,
    'supports' => array( 'title', 'thumbnail', 'editor' ),
    'menu_position' => 5
));

    add_action('do_meta_boxes', 'change_image_servizi_box');
    add_filter( 'enter_title_here', 'madisoft_scuola_service_change_default_title' );
    //add_filter( 'manage_posts_columns', 'madisoft_scuola_service_list_post', 10, 2 );
    add_filter( 'manage_posts_custom_column', 'madisoft_scuola_service_list_post_value', 10, 2 );

    add_filter( 'manage_scuola_service_posts_columns', 'scuola_service_set_columns_progetto' );

    function change_image_servizi_box()
    {  remove_meta_box( 'postimagediv', 'scuola_service', 'side' );
        add_meta_box('postimagediv', 'Immagine', 'post_thumbnail_meta_box', 'scuola_service', 'side', 'high');
    }

    function madisoft_scuola_service_list_post( $columns ) {
        if ( isset( $_GET['post_type'] ) && 'scuola_service' == $_GET['post_type'] ) {
            $columns['immagine'] = 'Immagine';
        }
        $columns['title'] = 'Nome';

        unset( $columns['date'] );

        return $columns;
    }

    function madisoft_scuola_service_list_post_value( $column_name, $id ) {

        if ( isset( $_GET['post_type'] ) && 'scuola_service' != $_GET['post_type'] ) {
            return false;
        }

        if ( $column_name === 'immagine' ) {
            $ed = get_the_post_thumbnail( $id, array( 32, 32 ) );
            echo $ed;
        }


    }

    function madisoft_scuola_service_change_default_title( $title ) {

        $screen = get_current_screen();

        if ( isset( $_GET['post_type'] ) && 'scuola_service' == $_GET['post_type'] ) {
            $title = 'Nome';
        }

        return $title;
    }

    function scuola_service_set_columns_progetto( $old_columns ) {
    $progetti_col = array(
        'cb'       => '<input type="checkbox">',
        'immagine' => 'Immagine',
        'title'    => __( 'Nome' ),
    );

    return $progetti_col;
}

}