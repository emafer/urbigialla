<?php

class Io_Scelgo_Widget extends MadisoftThemeImageWidgetClass implements MadisoftFinalImageWidgetInterface {

    public function __construct() {
        parent::__construct('COLLEGAMENTI - IO SCELGO', 'Io scelgo', $this->prepareImage(),$this->preparelink() );;

    }

    /**
     * @return string Link per il collegamento
     */
    function prepareLink ()
    {
        return 'https://www.orientamentoistruzione.it/';
    }

    /**
     * @return MadisoftImageClass L'immagine da mostrare
     */
    function prepareImage ()
    {
        $image = new MadisoftImageClass( madisoft_scuola_get_assets_directory('img') . 'Banner_IoScelgoIoStudio_02.png');
        $image->setAlt('Io Scelgo: orientamento scolastico');

        return $image;
    }
}

function ioscelgo_register_widgets() {
	register_widget( 'Io_Scelgo_Widget' );
}

add_action( 'widgets_init', 'ioscelgo_register_widgets' );
