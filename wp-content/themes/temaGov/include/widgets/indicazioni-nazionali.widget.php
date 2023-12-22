<?php

class Indicazioni_Nazionali_Widget  extends MadisoftThemeImageWidgetClass implements MadisoftFinalImageWidgetInterface {

	public function __construct() {
        // Instantiate the parent object
        parent::__construct('COLLEGAMENTI - INDICAZIONI NAZIONALI', 'Indicazioni Nazionali', $this->prepareImage(),$this->preparelink() );;
	}

    /**
     * @return string Link per il collegamento
     */
    function prepareLink ()
    {
        return 'https://www.miur.gov.it/documents/20182/51310/DM+254_2012.pdf/1f967360-0ca6-48fb-95e9-c15d49f18831?version=1.0&t=1480418494262';
    }

    /**
     * @return MadisoftImageClass L'immagine da mostrare
     */
    function prepareImage ()
    {
        $image = new MadisoftImageClass(madisoft_scuola_get_assets_directory('img') . 'banner_indicazioninazionali.gif');
        $image->setAlt('Indicazioni Nazionali');

        return $image;
    }
}

function indicazioniNazionali_register_widgets() {
	register_widget( 'Indicazioni_Nazionali_Widget' );
}

add_action( 'widgets_init', 'indicazioniNazionali_register_widgets' );
