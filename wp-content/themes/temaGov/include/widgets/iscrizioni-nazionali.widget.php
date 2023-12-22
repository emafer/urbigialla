<?php

class Iscrizioni_Nazionali_Widget extends MadisoftThemeImageWidgetClass implements MadisoftFinalImageWidgetInterface {

    public function __construct() {
        parent::__construct('COLLEGAMENTI - ISCRIZIONI ON LINE', 'Iscrizioni', $this->prepareImage(),$this->preparelink() );;

    }

    /**
     * @return string Link per il collegamento
     */
    function prepareLink ()
    {
        return 'https://www.istruzione.it/iscrizionionline/';
    }

    /**
     * @return MadisoftImageClass L'immagine da mostrare
     */
    function prepareImage ()
    {
        $image = new MadisoftImageClass( madisoft_scuola_get_assets_directory('img') . 'logo_IOL_conData_23-24.svg');
        $image->setAlt('Iscrizioni on line');

        return $image;
    }
}

function iscrizioniNazionali_register_widgets() {
	register_widget( 'Iscrizioni_Nazionali_Widget' );
}

add_action( 'widgets_init', 'iscrizioniNazionali_register_widgets' );
