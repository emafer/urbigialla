<?php

class Mad_Widget extends MadisoftThemeImageWidgetClass implements MadisoftFinalImageWidgetInterface {

	public function __construct() {
        parent::__construct('COLLEGAMENTI - MAD', 'MAD', $this->prepareImage(),$this->preparelink() );;

    }

	public function prepareLink(){
	    $codiceMeccanografico = madisoft_get_theme_option( 'madisoft_scuola_istituto_codice_meccanografico', '' );

	    return 'https://nuvola.madisoft.it/mad/' . $codiceMeccanografico . '/inserisci';
    }

    public function prepareImage(){
	    $image = new MadisoftImageClass(madisoft_scuola_get_assets_directory('img') . 'mad.jpg');
        $image->setAlt('compilazione MAD');

        return $image;
    }
}

function mad_register_widgets() {
	register_widget( 'Mad_Widget' );
}

add_action( 'widgets_init', 'mad_register_widgets' );

