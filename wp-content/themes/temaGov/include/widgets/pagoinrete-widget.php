<?php

class PagoInRete_Widget extends MadisoftThemeImageWidgetClass implements MadisoftFinalImageWidgetInterface {

    public function __construct() {
        // Instantiate the parent object
        parent::__construct('COLLEGAMENTI - PAGO IN RETE', 'Pago in rete', $this->prepareImage(),$this->preparelink() );
    }

    /**
     * @return string Link per il collegamento
     */
    function prepareLink ()
    {
        return 'https://www.istruzione.it/pagoinrete/';
    }

    /**
     * @return MadisoftImageClass L'immagine da mostrare
     */
    function prepareImage ()
    {
        $image = new MadisoftImageClass(madisoft_scuola_get_assets_directory('img') . 'pago-in-rete.png');
        $image->setAlt('Logo Pago in rete');

        return $image;
    }
}

function pagoInRete_register_widgets() {
	register_widget( 'PagoInRete_Widget' );
}

add_action( 'widgets_init', 'pagoInRete_register_widgets' );
