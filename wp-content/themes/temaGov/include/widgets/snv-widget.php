<?php

class Snv_Widget extends MadisoftThemeImageWidgetClass implements MadisoftFinalImageWidgetInterface {

    public function __construct() {
        // Instantiate the parent object
        parent::__construct('COLLEGAMENTI - SNV', 'SNV', $this->prepareImage(),$this->preparelink() );
    }

    /**
     * @return string Link per il collegamento
     */
    function prepareLink ()
    {
        return 'http://www.istruzione.it/snv/index.shtml';
    }

    /**
     * @return MadisoftImageClass L'immagine da mostrare
     */
    function prepareImage ()
    {
        $image = new MadisoftImageClass(madisoft_scuola_get_assets_directory('img') . 'logo_portale_snv.jpg');
        $image->setAlt('Logo Portale Sistema di valutazione Nazionale');

        return $image;
    }
}

function snv_register_widgets() {
	register_widget( 'Snv_Widget' );
}

add_action( 'widgets_init', 'snv_register_widgets' );
