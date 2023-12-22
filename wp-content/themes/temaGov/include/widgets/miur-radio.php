<?php

class Miur_radio_Widget extends MadisoftThemeImageWidgetClass implements MadisoftFinalImageWidgetInterface {

    public function __construct() {
        parent::__construct('COLLEGAMENTI - Miur Radio', 'Miur Radio', $this->prepareImage(),$this->preparelink() );;

    }

    /**
     * @return string Link per il collegamento
     */
    function prepareLink ()
    {
        return 'http://www.miurradionetwork.it';
    }

    /**
     * @return MadisoftImageClass L'immagine da mostrare
     */
    function prepareImage ()
    {
        $image = new MadisoftImageClass( madisoft_scuola_get_assets_directory('img') . 'miur-radio.jpg');
        $image->setAlt('MIUR Radio network');

        return $image;
    }
}

function miur_radio_register_widgets() {
	register_widget( 'Miur_radio_Widget' );
}

add_action( 'widgets_init', 'miur_radio_register_widgets' );
