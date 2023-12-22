<?php

class Sofia_Widget extends MadisoftThemeImageWidgetClass implements MadisoftFinalImageWidgetInterface {

    public function __construct() {
        // Instantiate the parent object
        parent::__construct('COLLEGAMENTI - SOFIA', 'SOFIA', $this->prepareImage(),$this->preparelink() );
    }

    /**
     * @return string Link per il collegamento
     */
    function prepareLink ()
    {
        return 'http://www.istruzione.it/pdgf/';
    }

    /**
     * @return MadisoftImageClass L'immagine da mostrare
     */
    function prepareImage ()
    {
        $image = new MadisoftImageClass(madisoft_scuola_get_assets_directory('img') . 'piattoforma-sofia.jpg');
        $image->setAlt('Logo Piattaforma Sofia');

        return $image;
    }
}

function sofia_register_widgets() {
	register_widget( 'Sofia_Widget' );
}

add_action( 'widgets_init', 'sofia_register_widgets' );
