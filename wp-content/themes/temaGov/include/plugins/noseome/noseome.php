<?php
function addNoseomeCallback(){
    add_filter('wp_robots', 'avoid_seo');
}

function avoid_seo($robots) {
        return [
            'noindex' => true,
            'nofollow' => true
        ];
}

class madisoftThemePluginNoSeo extends madisoftThemePluginClass implements madisoftThemePluginInterface
{
    function initFunction()
    {
        add_action('add_meta_boxes', [$this, 'add_no_seo_meta_boxes']);
        add_action('save_post', [$this, 'save_no_seo_meta_data']);
    }

    function add_no_seo_meta_boxes()
    {

        add_meta_box(
            'noseo_box',
            'INDICIZZAZIONE',
            [$this, 'no_seo_callback'],
            ['post', 'page'],
            'side',
            'high'
        );
    }

    function no_seo_callback()
    {
        global $post;
        wp_nonce_field(plugin_basename(__FILE__), 'no_seo_nonce');
        $Indicizza = get_post_meta($post->ID, 'noseome', true);
        if (!$Indicizza) {
            $Indicizza = 'SI';
        }
        $html = '<p class="description">';
        $html .= 'Indica come questo contenuto come non indicizzabile';
        $html .= '</p>';
        $html .= '<div class="tipopubblicazione" id="post_no_seo">';
        $html .= '<label for="pe_evidenza">INDICIZZA: </label>';
        $html .= '<select name="noseome" id="noseome">';
        $html .= '    <option value="SI"' . $this->selected('SI', $Indicizza) . '>SI</option>';
        $html .= '    <option value="NO"' . $this->selected('NO', $Indicizza) . '>NO</option>';
        $html .= '</select>';
        $html .= '</div>';
        echo $html;

    }

    function save_no_seo_meta_data($id)
    {
        if (!isset($_POST['no_seo_nonce']) || !isset($_POST['noseome'])) {
            return $id;
        }
        /* --- security verification --- */
        if (!wp_verify_nonce($_POST['no_seo_nonce'], plugin_basename(__FILE__))) {
            return $id;
        } // end if


        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $id;
        }
        // Make sure the file array isn't empty
        update_post_meta($id, 'noseome', $_POST['noseome']);
    }
}

    $madisoftThemePluginNoSeo = new madisoftThemePluginNoSeo();
