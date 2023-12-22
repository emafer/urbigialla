<?php

class madisoftThemePluginPostInEvidenza extends madisoftThemePluginClass implements madisoftThemePluginInterface
{
    function initFunction()
    {
        add_action('add_meta_boxes', [$this, 'add_in_evidenza_meta_boxes']);
        add_action('save_post', [$this, 'save_in_evidenza_meta_data']);
    }

    function add_in_evidenza_meta_boxes()
    {

        add_meta_box(
            'post_evidenza',
            'In evidenza',
            [$this, 'in_evidenza_callback'],
            'post',
            'side',
            'high'
        );
    }

    function in_evidenza_callback()
    {
        global $post, $madisoftTheme;
        wp_nonce_field(plugin_basename(__FILE__), 'in_evidenza_nonce');
        $inEvidenza = get_post_meta($post->ID, 'post_in_evidenza', true);
        $expires = get_post_meta($post->ID, 'post_in_evidenza_expires', true);
        if ($expires) {
            $data = new DateTime($expires);
            $expires = $data->format('d/m/Y');
        }
        $html = '<p class="description">';
        $html .= 'Imposta l\'articolo in evidenza per vederlo sempre in alto nella pagina inziale del sito';
        $html .= '</p>';
        $html .= '<div class="tipopubblicazione" id="post_evidenza">';
        $html .= '<label for="pe_evidenza">In Evidenza: </label>';
        $html .= '<select name="post_in_evidenza" id="pe_evidenza">';
        $html .= '    <option value="0"' . $this->selected(0, $inEvidenza) . '>NO</option>';
        $html .= '    <option value="1"' . $this->selected(1, $inEvidenza) . '>SI</option>';
        $html .= '</select><br/>';
        $html .= '<label for="pe_evidenza">In Evidenza fino al: </label>';
        $html .= '<input type="text" class="datepicker" name="post_in_evidenza_expires" value="' . $expires . '"/>';
        $html .= '</div>';
        echo $html;

    }

    function save_in_evidenza_meta_data($id)
    {
        if (!isset($_POST['in_evidenza_nonce']) || !isset($_POST['post_in_evidenza_expires'])) {
            return $id;
        }
        /* --- security verification --- */
        if (!wp_verify_nonce($_POST['in_evidenza_nonce'], plugin_basename(__FILE__))) {
            return $id;
        } // end if


        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $id;
        }
        // Make sure the file array isn't empty
        update_post_meta($id, 'post_in_evidenza', $_POST['post_in_evidenza']);

        if (!empty($_POST['post_in_evidenza_expires'])) {
            if (!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $_POST['post_in_evidenza_expires'])) {
                $d = DateTime::createFromFormat('d/m/Y', $_POST['post_in_evidenza_expires']);
                $_POST['post_in_evidenza_expires'] = $d->format('Y-m-d');
            }
            update_post_meta($id, 'post_in_evidenza_expires', $_POST['post_in_evidenza_expires']);
        } else{
            //annullo la messa in evidenza
           update_post_meta($id, 'post_in_evidenza', '0' );
        }


    }

}

if ( LOpzioneUsaPostInEvidenzaEAttiva() ){
    $madisoftThemePluginPostInEvidenza = new madisoftThemePluginPostInEvidenza();
}

/**
 * @param $post
 * @return bool
 */
function madisoft_theme_check_if_in_evidenza( $post ) {

    if (!LOpzioneUsaPostInEvidenzaEAttiva() || !is_front_page()){
        return false;
    }

    $inEvidenza     = get_post_meta( $post->ID, 'post_in_evidenza', true );
    if ($inEvidenza == '0'){
        return false;
    }

    $inEvidenzaData = get_post_meta( $post->ID, 'post_in_evidenza_expires', true );
    if ( $inEvidenzaData ) {
        $checkdata = new DateTime($inEvidenzaData);
        $checkdata->modify('+1 day');

        if (new DateTime() < $checkdata) {
            return true;
        }
    } else {
        delete_post_meta($post->ID, 'post_in_evidenza');
    }

    return false;
}

function getPostInEvidenza() {
    $args                 = [
        'post_type'     => 'post',
        'meta_query'    => [ ]
    ];
    $args['meta_query'][] = array(
        'key'     => 'post_in_evidenza',
        'value'   => '1',
        'compare' => '=',
    );
    $args['meta_query'][] = array(
        'key'     => 'post_in_evidenza_expires',
        'value'   => date( 'Y-m-d' ),
        'compare' => '>=',
    );
    $query                = new WP_Query( $args );

    $postInEvidenza = [];
    foreach ($query->posts as $articolo){
        if (madisoft_theme_check_if_in_evidenza($articolo)){
            $postInEvidenza[] = $articolo;
        }
    }
    return $postInEvidenza;
}

function LOpzioneUsaPostInEvidenzaEAttiva(){
        return ( madisoft_get_theme_option('madisoft_scuola_usa_post_in_evidenza', 'off') == 'on' );
}

function evidenzaPossoMostrareIlTitolo(){
    return ( madisoft_get_theme_option('madisoft_scuola_post_in_evidenza_titolo_mostra', 'on') == 'on'
    &&
        evidenzaGetTitoloSezione() != '');
}

function evidenzaGetTitoloSezione(){
    return madisoft_get_theme_option('madisoft_scuola_post_in_evidenza_titolo', 'In evidenza');
}

function evidenzaPossoMostrareLImmagine(){
    return evidenzaGetImmagine() != '' ;
}

function evidenzaGetImmagine(){
    return madisoft_get_theme_option('madisoft_scuola_posti_in_evidenza_immagine', '');
}
function evidenzaMostraIlTitoloSezione()
{
    if (evidenzaPossoMostrareIlTitolo()) {
        echo '<h2 class="homeTitleCategorie"><a href="#">' . evidenzaGetTitoloSezione() . '</a></h2>';
    }
}

function evidenzaMostraLImmagine(){
    if ( evidenzaPossoMostrareLImmagine() ) {
        ?>
        <div class="box_immagine_articoli">
            <img class="immagine_articoli" src="<?php echo evidenzaGetImmagine() ?>" alt="immagine per mostrare gli articoli in evidenza"/>
        </div>
        <?php
    }
}

function evidenzaGetNumeroDiArticoli(){
    return madisoft_get_theme_option('madisoft_scuola_post_in_evidenza_numero_articoli', 5);
}

if (LOpzioneUsaPostInEvidenzaEAttiva()){


    function madisoft_theme_aggiungi_colonna_evidenza($columns)
    {
        if (get_post_type() != 'post'){
        return $columns;
    }

        $new_columns = array(
            'in_evidenza' => 'In evidenza',
            'in_evidenza_fino_al' => 'In evidenza fino al',
        );
        return array_merge($columns, $new_columns);
    }

    add_action('manage_posts_columns', 'madisoft_theme_aggiungi_colonna_evidenza', 10, 2);
    add_action('manage_posts_custom_column', 'madisoft_theme_valore_colonne_evidenza', 10, 2);

    function madisoft_theme_valore_colonne_evidenza($column, $post_id)
    {
        if (get_post_type($post_id) != 'post'){
            return '';
        }
        switch ($column) {
            case 'in_evidenza':
                $inEvidenza = get_post_meta($post_id,'post_in_evidenza', true);
                if ($inEvidenza){
                    echo 'SI';
                }
                break;
            case 'in_evidenza_fino_al':
                $scadenza = get_post_meta($post_id,'post_in_evidenza_expires', true);
                if ($scadenza){
                    $scadenzaClasse = new DateTime($scadenza);
                    echo $scadenzaClasse->format('d/m/Y');
                }
                break;
        }
    }
}