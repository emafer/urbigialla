<?php

class Pnsd_Widget extends MadisoftThemeImageWidgetClass implements MadisoftFinalImageWidgetInterface {

    public function __construct() {
        // Instantiate the parent object
        parent::__construct('COLLEGAMENTI - PNSD', 'PNSD', $this->prepareImage(),$this->preparelink() );
    }

    /**
     * @return string Link per il collegamento
     */
    function prepareLink ()
    {
        return 'http://www.istruzione.it/scuola_digitale/index.shtml';
    }

    /**
     * @return MadisoftImageClass L'immagine da mostrare
     */
    function prepareImage ()
    {
        $image = new MadisoftImageClass(madisoft_scuola_get_assets_directory('img') . 'logo-pnsd.jpg');
        $image->setAlt('Logo Piano Scuola Digitale');

        return $image;
    }
}

function pnsd_register_widgets() {
	register_widget( 'Pnsd_Widget' );
}

add_action( 'widgets_init', 'pnsd_register_widgets' );
