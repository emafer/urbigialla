<?php

function madisoft_scuola_get_variabile_less( $campo, $valore_di_default = '', $dependencies = array() ) {
	if ( function_exists( 'get_variabile_less_' . $campo ) ) {
		$nome_funzione = 'get_variabile_less_' . $campo;

		return $nome_funzione( $valore_di_default, $dependencies );
	}

	foreach ( $dependencies as $dipendenza => $valore ) {
		if ( madisoft_get_theme_option( $dipendenza, $valore_di_default ) != $valore ) {
			return $valore_di_default;
		}
	}

	return madisoft_get_theme_option( $campo, $valore_di_default );
}

/**
 * Menu Superiore
 * @param string $status
 * @return string
 */
function get_variabile_less_madisoft_scuola_grafica_mostra_menu_superiore( $status = 'on' ) {
	$menu_superiore_is_visibile = madisoft_get_theme_option( 'madisoft_scuola_grafica_mostra_menu_superiore', $status );
	if ( $menu_superiore_is_visibile == 'off' ) {
		return 'none';
	}

	return 'block';
}

/**
 * Box shadow Wrapper
 * @param string $status
 * @return string
 */
function get_variabile_less_madisoft_scuola_grafica_mostra_box_shadow( $status = 'on' ) {
	if( madisoft_get_theme_option( 'madisoft_scuola_grafica_box_shadow', $status ) == 'on') {
		return '0 2px 10px #222222';
	}

	return '0 0px 0px #222222';
}



if ( class_exists( 'WPLessPlugin' ) ) {
	$less = WPLessPlugin::getInstance();

	$less->setVariables( madisoft_theme_getVariabili() );
}

function cleanNomeCarattere( $nomeCarattere ) {
	$type = false;
	if ( strpos( $nomeCarattere, ',' ) ) {
		list( $carattere, $type ) = explode( ',', $nomeCarattere );
	} else {
		$carattere = $nomeCarattere;
	}
	$carattere_pulito = trim( str_replace( "'", "", $carattere ) );
	$nome             = "'" . $carattere_pulito . "'";
	if ( $type ) {
		$nome .= ", " . trim( $type );
	}

	return $nome;
}

function madisoft_theme_getVariabili(){
    switch (madisoft_scuola_get_variabile_less('madisoft_scuola_layout_modello_1_altezza_immagine', '2')) {
        case '1':
            $altezzaImmagineEvidenza = '56.28%';
            break;
        case '2':
            $altezzaImmagineEvidenza = '75%';
            break;
        case '3':
            $altezzaImmagineEvidenza = '100%';
            break;
        case '4':
            $altezzaImmagineEvidenza = '66.66%';
            break;
        case '5':
            $altezzaImmagineEvidenza = '62.5%';
            break;
    }
	$fontPrincipale                     = cleanNomeCarattere( madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_font_general', "Lucida Grande, sans-serif" ) );
	$colorePrincipale                   = madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_colore_principale', '#0066cc' );
	if (!trim($colorePrincipale)) {
		$colorePrincipale = '#0066cc';
	}
	$coloreCaratterePrincipale          = madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_colore_carattere_principale', '#ffffff' );
	$opzioniAvanzate                    = madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_opzioni_avanzate', 'off' ) == 'off' ? false : true;
	$sfondoHeader                       = madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_colore_sfondo_header', $colorePrincipale );
	$sfondoWrapper                      = madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_colore_sfondo_wrapper', '#ffffff' );
	$dimensioneCarattere                = madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_font_general_dimensioni', 0.9, array( 'madisoft_scuola_grafica_fonts_opzioni_avanzate' => 'off' ) );
	$variabili = array(
	    'primary'                       => $colorePrincipale,
		'coloreDiPartenzaSfondo'		=> madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_colore_sfondo_partenza', madisoft_get_theme_option( 'madisoft_scuola_grafica_colore_sfondo', '#66A3FF' ), array('madisoft_scuola_grafica_sfondo_sfumato'=> 'on')),
		'coloreDiArrivoSfondo'			=> madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_colore_sfondo_arrivo', madisoft_get_theme_option( 'madisoft_scuola_grafica_colore_sfondo', '#ffffff' ), array('madisoft_scuola_grafica_sfondo_sfumato'=> 'on')),
		'boxShadow'						=> madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_mostra_box_shadow', 'on'),
		'sfondoHeader'                  => $sfondoHeader,
		'sfondoWrapper'                 => $sfondoWrapper,
		'colorePrincipale'              => $colorePrincipale,
		'coloreLink'         			=> madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_colore_link', $colorePrincipale, array( 'madisoft_scuola_grafica_opzioni_avanzate' => 'on' ) ),
		'vistaTopMenu'                  => madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_mostra_menu_superiore' ),
		'coloreSfondoTopMenu'           => madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_colore_sfondo_menu_superiore', $colorePrincipale, array( 'madisoft_scuola_grafica_opzioni_avanzate' => 'on' ) ),
		'coloreCarattereTopMenu'        => madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_colore_carattere_menu_superiore', $coloreCaratterePrincipale, array( 'madisoft_scuola_grafica_opzioni_avanzate' => 'on' ) ),
		'coloreFondoMenuPrincipale'     => madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_colore_sfondo_menu_principale', $colorePrincipale, array( 'madisoft_scuola_grafica_opzioni_avanzate' => 'on' ) ),
		'coloreCarattereMenuPrincipale' => madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_colore_carattere_menu_principale', $coloreCaratterePrincipale, array( 'madisoft_scuola_grafica_opzioni_avanzate' => 'on' ) ),
		'coloreFondoMenuFooter'         => madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_colore_sfondo_footer', $colorePrincipale, array( 'madisoft_scuola_grafica_opzioni_avanzate' => 'on' ) ),
		'coloreCarattereFooter'         => madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_colore_font_footer', $coloreCaratterePrincipale, array( 'madisoft_scuola_grafica_opzioni_avanzate' => 'on' ) ),
		'coloreFondoLeftBar'            => madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_colore_sfondo_leftbar', $sfondoWrapper, array( 'madisoft_scuola_grafica_opzioni_avanzate' => 'on', 'madisoft_scuola_grafica_leftbar' => 'on' ) ),
		'coloreWidgetleftbar'           => madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_colore_widget_leftbar', $colorePrincipale, array( 'madisoft_scuola_grafica_opzioni_avanzate' => 'on', 'madisoft_scuola_grafica_leftbar' => 'on' ) ),
		'coloreCarattereleftbar'        => madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_colore_widget_leftbar_font', $coloreCaratterePrincipale, array( 'madisoft_scuola_grafica_opzioni_avanzate' => 'on', 'madisoft_scuola_grafica_leftbar' => 'on' ) ),
		'spessoreBordoWidgetLeftbar'    => madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_spessore_bordo_widget_leftbar', 0, array( 'madisoft_scuola_grafica_opzioni_avanzate' => 'on', 'madisoft_scuola_grafica_leftbar' => 'on', 'madisoft_scuola_grafica_bordi_leftbar' => 'on' ) ) . 'px',
		'coloreBordoWidgetLeftbar'      => madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_colore_bordo_widget_leftbar', $coloreCaratterePrincipale, array( 'madisoft_scuola_grafica_opzioni_avanzate' => 'on', 'madisoft_scuola_grafica_leftbar' => 'on', 'madisoft_scuola_grafica_bordi_leftbar' => 'on' ) ),
		'coloreFondoRightBar'           => madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_colore_sfondo_rightbar', $sfondoWrapper, array( 'madisoft_scuola_grafica_opzioni_avanzate' => 'on', 'madisoft_scuola_grafica_rightbar' => 'on' ) ),
		'coloreWidgetRightbar'          => madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_colore_widget_rightbar', $colorePrincipale, array( 'madisoft_scuola_grafica_opzioni_avanzate' => 'on', 'madisoft_scuola_grafica_rightbar' => 'on', ) ),
		'coloreCarattereRightbar'       => madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_colore_widget_rightbar_font', $coloreCaratterePrincipale, array( 'madisoft_scuola_grafica_opzioni_avanzate' => 'on', 'madisoft_scuola_grafica_rightbar' => 'on', ) ),
		'spessoreBordoWidgetRightbar'   => madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_spessore_bordo_widget_rightbar', 0, array( 'madisoft_scuola_grafica_opzioni_avanzate' => 'on', 'madisoft_scuola_grafica_rightbar' => 'on', 'madisoft_scuola_grafica_bordi_rightbar' => 'on', ) ) . 'px',
		'coloreBordoWidgetRightbar'     => madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_colore_bordo_widget_rightbar', $coloreCaratterePrincipale, array( 'madisoft_scuola_grafica_opzioni_avanzate' => 'on', 'madisoft_scuola_grafica_rightbar' => 'on', 'madisoft_scuola_grafica_bordi_rightbar' => 'on', ) ),
		'coloreGrigio'                  => '#999999',
		'white'                         => '#ffffff',
		'caratterePrincipale'           => $fontPrincipale,
		'font-family-base'              => $fontPrincipale,
		'dimensioneCaratterePrincipale' => $dimensioneCarattere . 'em',
		'fontTitoli'                    => cleanNomeCarattere( madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_font_titoli', $fontPrincipale, array( 'madisoft_scuola_grafica_fonts_opzioni_avanzate' => 'on' ) ) ),
		'fontTesto'                     => cleanNomeCarattere( madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_font_testo', $fontPrincipale, array( 'madisoft_scuola_grafica_fonts_opzioni_avanzate' => 'on' ) ) ),
		'fontDate'                      => cleanNomeCarattere( madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_font_date', $fontPrincipale, array( 'madisoft_scuola_grafica_fonts_opzioni_avanzate' => 'on' ) ) ),
		'fontMenu'                      => cleanNomeCarattere( madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_font_elenchi', $fontPrincipale, array( 'madisoft_scuola_grafica_fonts_opzioni_avanzate' => 'on' ) ) ),
		'fontMenuTop'                   => cleanNomeCarattere( madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_font_menu_top', $fontPrincipale, array( 'madisoft_scuola_grafica_fonts_opzioni_avanzate' => 'on' ) ) ),
		'fontMenuPrincipale'            => cleanNomeCarattere( madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_font_menu_principale', $fontPrincipale, array( 'madisoft_scuola_grafica_fonts_opzioni_avanzate' => 'on' ) ) ),
		'fontMenuFooter'                => cleanNomeCarattere( madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_font_menu_footer', $fontPrincipale, array( 'madisoft_scuola_grafica_fonts_opzioni_avanzate' => 'on' ) ) ),
		'fontTitoliDimensioni'          => madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_font_titoli_dimensioni', ( $dimensioneCarattere ) + 0.3, array( 'madisoft_scuola_grafica_fonts_opzioni_avanzate' => 'on' ) ) . 'em',
		'fontTestoDimensioni'           => madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_font_testo_dimensioni', $dimensioneCarattere, array( 'madisoft_scuola_grafica_fonts_opzioni_avanzate' => 'on' ) ) . 'em',
		'fontDateDimensioni'            => madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_font_date_dimensioni', ( $dimensioneCarattere - 0.1 ), array( 'madisoft_scuola_grafica_fonts_opzioni_avanzate' => 'on' ) ) . 'em',
		'fontMenuDimensioni'            => madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_font_elenchi_dimensioni', $dimensioneCarattere, array( 'madisoft_scuola_grafica_fonts_opzioni_avanzate' => 'on' ) ) . 'em',
		'fontMenuTopDimensioni'         => madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_font_menu_top_dimensioni', $dimensioneCarattere, array( 'madisoft_scuola_grafica_fonts_opzioni_avanzate' => 'on' ) ) . 'em',
		'fontMenuPrincipaleDimensioni'  => madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_font_menu_principale_dimensioni', $dimensioneCarattere, array( 'madisoft_scuola_grafica_fonts_opzioni_avanzate' => 'on' ) ) . 'em',
		'fontMenuFooterDimensioni'      => madisoft_scuola_get_variabile_less( 'madisoft_scuola_grafica_font_menu_footer_dimensioni', $dimensioneCarattere, array( 'madisoft_scuola_grafica_fonts_opzioni_avanzate' => 'on' ) ) . 'em',
        'altezzaImmagineEvidenzaArticolo' => $altezzaImmagineEvidenza,
        'grid-columns' => '24',
        'font-family-sans-serif' => '"Titillium web", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji" !default;',
        'opposite' => '#ffffff', //colore da mettere sul principale
        'pathImg' => madisoft_scuola_get_assets_directory('img', true, 'new.png')
	);
    return $variabili;
}
