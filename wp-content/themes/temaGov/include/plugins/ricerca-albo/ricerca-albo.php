<?php

class madisoftThemeRicercaAlbo extends madisoftThemePluginClass implements madisoftThemePluginInterface
{
    function initFunction()
    {
        add_action('save_post', [$this, 'save_ricerca_albo_meta_data']);
        add_filter('the_content', [$this, 'madisoft_scuola_ricerca_albo_check'], 0);
        add_action('add_meta_boxes', [$this, 'add_ricerca_albo_meta_boxes']);
    }


    function add_ricerca_albo_meta_boxes()
    {
        add_meta_box(
            'ricercaAlbo',
            'Filtro per ricerca Albo Pretorio',
            [$this, 'ricerca_albo_callback'],
            'page',
            'side',
            'high'
        );
    }
    function ricerca_albo_callback()
    {
        global $post;
        wp_nonce_field(plugin_basename(__FILE__), 'tipo_atto_search_nonce');
        $tipo = get_post_meta($post->ID, 'tipo_atto_search', true);
        $html = '<p class="description">';
        $html .= 'Se la pagina &egrave; collegata all\'albo pretorio, puoi selezionare la tipologia di atto
    per filtrare la ricerca';
        $html .= '</p>';
        $html .= '<div class="tipopubblicazione" id="ap-tipopubblicazione">';
        $html .= '<label for="pa_tipo">Tipo di pubblicazione:</label>';
        $html .= '<select name="tipo_atto_search" id="pa_tipo">';
        $html .= '<option value="">Non Attivare</option>';
        if (isset($tipo) && $tipo == 'all') {
            $selected = ' selected="selected"';
        } else {
            $selected = '';
        }
        $html .= '<option value="all"' . $selected . '>Tutte</option>';
        global $wpdb;
        $tblTipiAtto = $wpdb->prefix . TOSENDIT_PAFACILE_DB_TIPO_ATTO;
        $sql = "select codice,descrizione,raggruppamento from $tblTipiAtto order by raggruppamento, descrizione";
        $results = $wpdb->get_results($sql);
        $raggruppamento = '';
        foreach ($results as $result) {
            if ($raggruppamento != $result->raggruppamento) {
                if ($raggruppamento != '') {
                    $html .= '</optgroup>';
                }
                $raggruppamento = $result->raggruppamento;
                $html .= '<optgroup label="' . $raggruppamento . '">';
            }
            ($tipo == $result->codice) ? $selected = 'selected="selected"' : $selected = '';
            $html .= '<option value="' . $result->codice . '"' . $selected . '>' . $result->descrizione . '</option>';
        }
        if ($raggruppamento != '') $html .= '</optgroup>';
        $html .= '</select>
    </div>';


        echo $html;

    }


    function save_ricerca_albo_meta_data($id)
    {
        if (!isset($_POST['tipo_atto_search_nonce'])) {
            return $id;
        }
        /* --- security verification --- */
        if (!wp_verify_nonce($_POST['tipo_atto_search_nonce'], plugin_basename(__FILE__))) {

            return $id;
        } // end if


        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $id;
        }
        // Make sure the file array isn't empty
        if (isset($_POST['tipo_atto_search'])) {
            update_post_meta($id, 'tipo_atto_search', $_POST['tipo_atto_search']);
        } else {
        }

    }


    function madisoft_scuola_ricerca_albo_check($content)
    {
        global $post;

        $tipo = get_post_meta($post->ID, 'tipo_atto_search', true);
        if ($tipo && !isset($_GET['tipo'])) {
            if ($tipo != 'all') {
                $_GET['tipo'] = $tipo;
            }
            $_GET['dpa_yy'] = date('Y') + 4;
            $_GET['dpa_dd'] = '';
            $_GET['dpa_mm'] = date('m') + 1;
        }

        return $content;
    }

}
if (is_plugin_active('pafacile/tosendit-pa.php')){
    $madisoftThemeRicercaAlbo = new madisoftThemeRicercaAlbo();
}