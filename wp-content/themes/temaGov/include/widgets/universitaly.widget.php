<?php

class Universitaly_Widget extends MadisoftThemeImageWidgetClass implements MadisoftFinalImageWidgetInterface {

	public function __construct() {

        parent::__construct('COLLEGAMENTI - UNIVERSITALY', 'Universitaly', $this->prepareImage(),$this->preparelink() );;

    }


    /**
     * @return string Link per il collegamento
     */
    function prepareLink ()
    {
        return 'http://www.universitaly.it/';
    }

    /**
     * @return MadisoftImageClass L'immagine da mostrare
     */
    function prepareImage ()
    {
        $image = new MadisoftImageClass(madisoft_scuola_get_assets_directory('img') . 'banner_universitaly.gif');
        $image->setAlt('Universitaly: l\'universit&agrave; italiana a portata di click');

        return $image;
    }
}

function universitaly_register_widgets() {
	register_widget( 'Universitaly_Widget' );
}

add_action( 'widgets_init', 'universitaly_register_widgets' );
