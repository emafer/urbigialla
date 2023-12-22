<?php

class madisoftThemePluginOpzioniPagine extends madisoftThemePluginClass implements madisoftThemePluginInterface
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
        $this->addOpzione('page_intro_fascia', 'siNo', 'Intro');
        $this->addOpzione('page_show_breadcrumb', 'siNo', 'Briciole di pane');
        $this->addOpzione('page_show_titolo', 'siNo', 'Mostra il titolo');
        $opzioni = [
            [
                'value' => '99',
                'label' => 'auto',
            ],
            [
                'value' => '3',
                'label' => '3',
            ],
            [
                'value' => '2r',
                'label' => '2, barra a destra',
            ],
            [
                'value' => '2l',
                'label' => '2, barra a sinistra',
            ],
            [
                'value' => '1',
                'label' => 'Senza barre',
            ]
        ];
        $this->addOpzione('page_struttura_colonne', 'select', 'Struttura colonne', 99, $opzioni);

        add_action('add_meta_boxes', [$this, 'add_opzioni_pagine_meta_boxes']);
        add_action('save_post', [$this, 'save_opzioni_pagine_meta_data']);

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

    function add_opzioni_pagine_meta_boxes()
    {

        // Define the custom attachment for posts
        add_meta_box(
            'opzioni_pagine',
            'Opzioni pagina',
            [$this,'opzioni_pagine_callback'],
            ['page'],
            'side',
            'high'
        );


    }

    function opzioni_pagine_callback() {
        wp_nonce_field( plugin_basename( __FILE__ ), 'opzioni_pagine_nonce' );

        $html = '<p class="description">';
        $html .= 'Imposta le opzioni di visualizzazione della pagina';
        $html .= '</p>';
        $html .= '<div class="tipopubblicazione" id="opzioni_pagine">';
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

    function save_opzioni_pagine_meta_data( $id ) {

        if ( ! isset( $_POST['opzioni_pagine_nonce'] ) ) {
            return $id;
        }
        /* --- security verification --- */
        if ( ! wp_verify_nonce( $_POST['opzioni_pagine_nonce'], plugin_basename( __FILE__ ) ) ) {
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
    function renderSelect($idOpzione)
    {
        $opzione = $this->getOpzioni($idOpzione);
        $html = '<label for="' . $idOpzione . '">' . $opzione['label'] . ':</label>';
        $html .= '<select name="' . $idOpzione . '" id="' . $idOpzione . '">';
        foreach ($opzione['choices'] as $choice) {
            $html .= '    <option value="' . $choice['value'] . '"' . $this->selected($choice['value'], $this->getValue($idOpzione, $opzione['value'])) . '>' . $choice['label'] . '</option>';
        }
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

$madisoftThemePluginOpzioniPagine = new madisoftThemePluginOpzioniPagine();




