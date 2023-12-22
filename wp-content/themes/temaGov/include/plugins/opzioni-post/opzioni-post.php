<?php

class madisoftThemePluginOpzioniPost extends madisoftThemePluginClass implements madisoftThemePluginInterface
{
    protected $opzioni = [];

    static function checkIfOptionIsActive($idOpzione, $default, $controlloSuAutomatica = true)
    {
        global $post;
        $val = get_post_meta($post->ID, $idOpzione, true);
        if($controlloSuAutomatica && $val == 99){
            $val = $default;
        }

        return ($val == $default || empty($val));
    }
    static function getValueOfOption($idOpzione, $default, $controlloSuAutomatica = false){
        global $post;
        $val = get_post_meta($post->ID, $idOpzione, true);
        if ($controlloSuAutomatica && $val == 99) {
            $val = $default;
        }
        return empty($val) ? $default : $val;
    }

    function initFunction()
    {
        global $post;
        //TODO aggiungere opzioni per nascondere questa informazione
        $this->addOpzione('post_show_titolo', 'siNo', 'Mostra il titolo');
        add_action('add_meta_boxes', [$this, 'add_opzioni_post_meta_boxes']);
        add_action('save_post', [$this, 'save_opzioni_post_meta_data']);

    } // end add_custom_meta_boxes

    function addOpzione($id, $type, $label, $value = '', $opzioni = [])
    {

        $this->opzioni[$id] = [
            'id'    => $id,
            'type'  => $type,
            'label' => $label,
            'value' => $value,
            'choices'   => $opzioni,
        ];
    }

    function add_opzioni_post_meta_boxes()
    {

        // Define the custom attachment for posts
        add_meta_box(
            'opzioni_post',
            'Opzioni post',
            [$this,'opzioni_post_callback'],
            ['post', 'le_scuole'],
            'side',
            'high'
        );


    }

    function opzioni_post_callback() {
        wp_nonce_field( plugin_basename( __FILE__ ), 'opzioni_post_nonce' );

        $html = '<p class="description">';
        $html .= 'Imposta le opzioni di visualizzazione dell\'articolo';
        $html .= '</p>';
        $html .= '<div class="tipopubblicazione" id="opzioni_post">';
        foreach ($this->getOpzioni() as $opzione) {
            $function = 'render' . ucfirst($opzione['type']);
            $html .= $this->$function($opzione['id']);
        }
        $html .= '</div>';
        echo $html;

    }

    /**
     * @return array
     */
    public function getOpzioni($id = '')
    {
        if (!empty($id)) {
            return $this->opzioni[$id];
        }

        return $this->opzioni;
    }

    /**
     * @param array $opzioni
     */
    public function setOpzioni($opzioni)
    {
        $this->opzioni = $opzioni;
    }

    function save_opzioni_post_meta_data( $id ) {

        if ( ! isset( $_POST['opzioni_post_nonce'] ) ) {
            return $id;
        }
        /* --- security verification --- */
        if ( ! wp_verify_nonce( $_POST['opzioni_post_nonce'], plugin_basename( __FILE__ ) ) ) {
            return $id;
        } // end if


        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $id;
        }
        // Make sure the file array isn't empty

        foreach ($this->getOpzioni() as $opzione) {
                $this->saveValue($id, $opzione['id'], $_POST[$opzione['id']]);
        }
    }


    function saveValue($idPage, $idOpzione, $value)
    {
        update_post_meta($idPage, $idOpzione, $value);
    }

    function renderSiNo($idOpzione)
    {
        $opzione = $this->getOpzioni($idOpzione);
        $html = '<label for="' . $idOpzione . '">' . $opzione['label'] . ':</label>';
        $html .= '<select name="' . $idOpzione . '" id="' . $idOpzione . '">';
        $html .= '    <option value="99"' . $this->selected(3, $this->getValue($idOpzione, 99)) . '>auto</option>';
        $html .= '    <option value="1"' . $this->selected(1, $this->getValue($idOpzione, 99)) . '>SI</option>';
        $html .= '    <option value="2"' . $this->selected(2, $this->getValue($idOpzione, 99)) . '>NO</option>';
        $html .= '</select><br/>';

        return $html;
    }


    function getValue($idOpzione, $default)
    {
        global $post;
        $val = get_post_meta($post->ID, $idOpzione, true);
        return empty($val) ? $default : $val;
    }
}

$madisoftThemePluginOpzioniPost = new madisoftThemePluginOpzioniPost();




