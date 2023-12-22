<?php

class Invalsi_Widget extends MadisoftThemeImageWidgetClass implements MadisoftFinalImageWidgetInterface {

    public function __construct() {
        // Instantiate the parent object
        parent::__construct('COLLEGAMENTI - INVALSI', 'INVALSI', $this->prepareImage(),$this->preparelink() );
    }

    /**
     * @return string Link per il collegamento
     */
    function prepareLink ()
    {
        return 'https://www.invalsi.it/invalsi/';
    }

    /**
     * @return MadisoftImageClass L'immagine da mostrare
     */
    function prepareImage ()
    {
        $image = new MadisoftImageClass(madisoft_scuola_get_assets_directory('img') . 'banner_invalsi.gif');
        $image->setAlt('Logo Portale Invalsi');

        return $image;
    }
}

function invalsi_register_widgets() {
	register_widget( 'Invalsi_Widget' );
}

add_action( 'widgets_init', 'invalsi_register_widgets' );
