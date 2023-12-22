<?php
class Esame_Di_Stato_Widget extends MadisoftThemeImageWidgetClass implements MadisoftFinalImageWidgetInterface{

    function __construct ()
    {
        // Instantiate the parent object
        parent::__construct('COLLEGAMENTI - ESAME DI STATO','Esame di Stato',$this->prepareImage(), $this->prepareLink() );
    }

    /**
     * @return string
     */
    function prepareLink ()
    {
        return 'http://www.istruzione.it/esame_di_stato/';
    }

    function prepareImage ()
    {
        $image = new MadisoftImageClass( madisoft_scuola_get_assets_directory('img') . 'banner_esamedistato.gif' );
        $image->setAlt('Esame di stato - collegamento');
        return $image;
    }
}

function esame_di_stato_register_widgets() {
	register_widget( 'Esame_Di_Stato_Widget' );
}

add_action( 'widgets_init', 'esame_di_stato_register_widgets' );
