<?php

class Tasso_Assenze_Widget  extends MadisoftThemeImageWidgetClass implements MadisoftFinalImageWidgetInterface {

	public function __construct() {
        parent::__construct('COLLEGAMENTI - TASSI DI ASSENZA', 'Tassi di assenza', $this->prepareImage(),$this->preparelink() );;

	}

    /**
     * @return string Link per il collegamento
     */
    function prepareLink ()
    {
        $str = 'https://oc4jesemvlas2.pubblica.istruzione.it/trasparenzaPubb/ricercaassenze.do?codScuUt='
            . madisoft_get_theme_option( 'madisoft_scuola_istituto_codice_meccanografico', '' ) . '&amp;paramDesNomScu='
            . urlencode(madisoft_get_theme_option( 'madisoft_scuola_istituto_nome', '' ) ) . '&amp;paramDatAnnScoRil='
            . 1617 . '&amp;tipoRicerca=S&amp;paramCodScuUt='
            . strtoupper( madisoft_get_theme_option( 'madisoft_scuola_istituto_codice_meccanografico', '' ) );
        return $str;
    }

    /**
     * @return MadisoftImageClass L'immagine da mostrare
     */
    function prepareImage ()
    {
        $image = new MadisoftImageClass(madisoft_scuola_get_assets_directory('img') . 'Banner_TassoAssenze.png');
        $image->setAlt('tasso di assenze: logo al portale MIUR');

        return $image;
    }

}

function tassoAssenze_register_widgets() {
	register_widget( 'Tasso_Assenze_Widget' );
}

add_action( 'widgets_init', 'tassoAssenze_register_widgets' );
