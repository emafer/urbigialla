<?php

class Scuola_In_Chiaro_Widget extends MadisoftThemeImageWidgetClass implements MadisoftFinalImageWidgetInterface {

	public function __construct() {
        parent::__construct('COLLEGAMENTI - SCUOLA IN CHIARO', 'Scuola in chiaro', $this->prepareImage(),$this->preparelink() );;

    }

	public function prepareLink(){
	    $codiceMeccanografico = madisoft_get_theme_option( 'madisoft_scuola_istituto_codice_meccanografico', '' );
		$linkScuola = madisoft_get_theme_option( 'madisoft_scuola_istituto_scuola_in_chiaro', '' );
		if ($linkScuola) {
			return $linkScuola;
		}
	    return 'http://cercalatuascuola.istruzione.it/cercalatuascuola/ricerca/risultati?rapida=' . $codiceMeccanografico . '&tipoRicerca=RAPIDA&gidf=1';
    }

    public function prepareImage(){
	    $image = new MadisoftImageClass(madisoft_scuola_get_assets_directory('img') . 'banner-scuola-in-chiaro.jpg');
        $image->setAlt('la scuola in chiaro');

        return $image;
    }
}

function scuolaInChiaro_register_widgets() {
	register_widget( 'Scuola_In_Chiaro_Widget' );
}

add_action( 'widgets_init', 'scuolaInChiaro_register_widgets' );

