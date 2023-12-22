<?php

class madisoftThemePluginHeaderPersonalizzato extends madisoftThemePluginClass implements madisoftThemePluginBaseInterface {
    function initFunction()
    {
        add_action( 'add_meta_boxes', [$this, 'add_image_header']);
        add_action( 'save_post', [$this,'save_add_image_header_meta_box'] );
    }

    /**
     * @throws MadisoftAssetRichiestaNonEsistenteException
     */
    function add_image_header() {
    $screens = array( 'post', 'page', 'le_scuole' );
    wp_enqueue_media();
    wp_register_script( 'jqueryUpload', madisoft_scuola_get_assets_directory( 'js', true ) . 'jqueryUpload.js', array( 'jquery' ) );
    wp_enqueue_script( 'jqueryUpload' );
    foreach ( $screens as $screen ) {
        add_meta_box(
            'post_image_header',
            'Immagine in intestazione',
            [$this,'madisoft_scuola_image_header_box'],
            $screen,
            'normal',
            'high'
        );
    }
}

    /**
     *
     */
    function madisoft_scuola_image_header_box() {
        global $post;
        echo '<label for="upload_image" class="label_madisoft_form">Immagine da inserire in intestazione: </label>';
        $id = 'add_image_header';
        wp_nonce_field( plugin_basename( __FILE__ ), 'add_image_header_nonce' );
        $value = get_post_meta( $post->ID, '_image_header', true );
        $value_head = get_post_meta( $post->ID, '_mostra_in_sezione_benvenuto', true );
        if ($value_head == 'on' ) {
            $addHeadClass = ' checked="checked"';
        } else {
            $addHeadClass = '';
        }
        if ( $value ) {
            echo '<img width="250px" id="' . $id . '_image" src="' . $value . '"/><br/>';
        }
        echo '<input class="inputMedia" id="' . $id . '" type="hidden" name="' . $id . '" value="' . $value . '" />
	<input id="upload_media_button_' . $id . '" class="addMediaMadiButton" type="button" data-target="' . $id . '" value="Immagine per intestazione" />';
        echo '<br/><input name="mostra_in_sezione_benvenuto" id="mostra_in_sezione_benvenuto" type="checkbox"' . $addHeadClass . '/>
        <label for="mostra_in_sezione_benvenuto">mostra nello spazio "Sezione di benvenuto"</label>';
        if ($value) {
            echo '<br/><input name="delete_modulistica_allegato" id="delete_modulistica_allegato" type="checkbox"/><label for="delete_modulistica_allegato">Rimuovi immagine</label>';
         }
    }

    /**
     * @param $id
     * @return bool
     */
    function save_add_image_header_meta_box( $id ) {


        if ( isset( $_POST['post_type'] )
            && ( 'post' != $_POST['post_type'] && 'page' != $_POST['post_type'] ) ) {
            return false;
        }
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $id;
        }

        if ( ! isset( $_POST['add_image_header_nonce'] ) ) {
            return $id;
        }
        if ( ! wp_verify_nonce( $_POST['add_image_header_nonce'], plugin_basename( __FILE__ ) ) ) {
            return $id;
        }
        if (isset( $_POST['delete_modulistica_allegato'])) {
            delete_post_meta($id, '_image_header');
            delete_post_meta($id, '_mostra_in_sezione_benvenuto');
        } else {
            update_post_meta( $id, '_image_header', $_POST['add_image_header'] );
            update_post_meta($id, '_mostra_in_sezione_benvenuto', $_POST['mostra_in_sezione_benvenuto']);
        }

    }
}

if ( intestazionePersonalizzataEAttiva()){
    new madisoftThemePluginHeaderPersonalizzato();
}

/**
 * @return bool
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function intestazionePersonalizzataEAttiva(){
     return (madisoft_get_theme_option('madisoft_scuola_usa_intestazione_personalizata', 'off') == 'on');
}

/**
 * @param bool $elemento
 * @return bool
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function intestazionePersonalizzataPossoUtilizzarla($elemento = false){
    if (!$elemento){
        global $post;
    } else {
        $post = $elemento;
    }

    return (intestazionePersonalizzataEAttiva() && (is_single() || is_page($post)) && !is_404() && !is_archive() && in_array(get_post_type($post), ['page', 'post', 'le_scuole'] ));
}

/**
 * @param bool $articolo
 * @return array|mixed|string
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function madisoft_scuola_get_immagine_per_intestazione_personalizzata($articolo = false){
    $immagine = madisoft_get_theme_option('madisoft_scuola_testata_immagine', '');
    if (is_front_page() && madisoft_get_theme_option('madisoft_scuola_testata_immagine_home', '') != '') {
        $immagine = madisoft_get_theme_option('madisoft_scuola_testata_immagine_home', '');
    }
    if (!$articolo){
        global $post;
    } else {
        $post = $articolo;
    }
    if ( !intestazionePersonalizzataPossoUtilizzarla() ){
        return $immagine;
    }


    if ( get_post_meta($post->ID, '_image_header', true)
        && get_post_meta($post->ID, '_mostra_in_sezione_benvenuto', true) != 'on') {
        $immagine = get_post_meta($post->ID, '_image_header', true);
    }

    return $immagine;
}

function madisoft_scuola_get_immagine_per_intro_personalizzata($articolo = false){
    $immagine = madisoft_get_theme_option('madisoft_scuola_intro_immagine', '');
    if (!is_front_page() && madisoft_get_theme_option('madisoft_scuola_intro_immagine_not_home', '') != '') {
        $immagine = madisoft_get_theme_option('madisoft_scuola_intro_immagine_not_home', '');
    }
    if (!$articolo) {
        global $post;
    } else {
        $post = $articolo;
    }
    if ( !intestazionePersonalizzataPossoUtilizzarla() ){
        return $immagine;
    }


    if ( get_post_meta($post->ID, '_image_header', true)
        && get_post_meta($post->ID, '_mostra_in_sezione_benvenuto', true) == 'on') {
        $immagine = get_post_meta($post->ID, '_image_header', true);
    }

    return $immagine;
}
