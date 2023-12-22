<?php

class Iscrizioni_Infanzia_Widget extends MadisoftThemeImageWidgetClass implements MadisoftFinalImageWidgetInterface {

    public function __construct() {
        parent::__construct('COLLEGAMENTI - ISCRIZIONI INFANZIA NUVOLA', 'Iscrizioni Infanzia', $this->prepareImage(),$this->preparelink() );;

    }

    /**
     * @return string Link per il collegamento
     */
    function prepareLink ()
    {
		$codiceMeccanografico = madisoft_get_theme_option( 'madisoft_scuola_istituto_codice_meccanografico', '' );
        return 'https://nuvola.madisoft.it/iscrizioni/' . $codiceMeccanografico . '/inserisci';
    }

    /**
     * @return MadisoftImageClass L'immagine da mostrare
     */
    function prepareImage ()
    {
        $image = new MadisoftImageClass( madisoft_scuola_get_assets_directory('img') . 'iscrizioni-infanzia.webp');
        $image->setAlt('Iscrizioni on line');

        return $image;
    }
}

function iscrizioniInfanzia_register_widgets() {
	register_widget( 'Iscrizioni_Infanzia_Widget' );
}

add_action( 'widgets_init', 'iscrizioniInfanzia_register_widgets' );
