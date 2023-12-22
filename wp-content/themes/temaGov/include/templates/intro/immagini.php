<?php
$immagine = madisoft_scuola_get_immagine_per_intro_personalizzata();
if ( madisoft_get_theme_option( 'madisoft_scuola_intro_mostra_slider', 'on' ) == 'on' && !$immagine) {
	madisoft_scuola_testata_includi_slider( 'intro' );
} else {
    if (!$immagine) {
        $immagine = calcola_immagine_per_intro();
    }

	if ( $immagine ) {
		?>
		<a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>"><img src="<?php echo $immagine; ?>" alt="<?php bloginfo( 'name' ); ?>" class="img_slide" style="width: 100%" /></a>
	<?php }
}

/**
 * @return array|string
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function calcola_immagine_per_intro()
{
    if (madisoft_get_theme_option( 'madisoft_scuola_intro_immagine_not_home', '' ) != '' && !is_front_page()) {
        $immagine = madisoft_get_theme_option( 'madisoft_scuola_intro_immagine_not_home', '' );
    } else {
        $immagine = madisoft_get_theme_option( 'madisoft_scuola_intro_immagine', '' );
    }

    return $immagine;
}
