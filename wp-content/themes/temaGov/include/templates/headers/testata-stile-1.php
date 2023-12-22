<?php
$larghezzaLogoLeft = madisoft_get_theme_option('madisoft_scuola_testata_stile_logo_left_width', MadisoftScuolaWidth::MADISOFT_WIDTH_1_8);
$imgLeft = madisoft_get_theme_option( 'madisoft_scuola_testata_stile_logo_left' , '');
if (!$imgLeft) {
    $larghezzaLogoLeft = 0;
}
$imgRight = madisoft_get_theme_option( 'madisoft_scuola_testata_stile_logo_right' , '');
$larghezzaLogoRight = madisoft_get_theme_option('madisoft_scuola_testata_stile_logo_right_width', MadisoftScuolaWidth::MADISOFT_WIDTH_1_8);
if (!$imgRight) {
    $larghezzaLogoRight = 0;
}
$larghezzaIstituto = MadisoftScuolaWidth::MADISOFT_WIDTH_ALL - $larghezzaLogoLeft - $larghezzaLogoRight - 2;
?>
<div class="row align-items-center">
    <div class="col-sm-1"></div>
    <?php if ($larghezzaLogoLeft) { ?>
    <div class="logo text-center col-sm-<?php echo $larghezzaLogoLeft; ?>">
        <a href="<?php echo get_option('home', true);?>" title="Torna alla pagina iniziale">
            <img class="logo" src="<?php echo madisoft_get_theme_option( 'madisoft_scuola_testata_stile_logo_left' , madisoft_get_theme_option('madisoft_scuola_dati_logo', ''));?>"/>
        </a>
    </div>
    <?php }
    get_template_part ( 'include/templates/headers/intitolazione-istituto',
        null, [
            'larghezzaIstituto' => $larghezzaIstituto
    ]);
    if ($larghezzaLogoRight) { ?>
    <div class="logo-right col-sm-<?php echo $larghezzaLogoRight; ?> centermobile">
	<?php if (madisoft_get_theme_option( 'madisoft_scuola_testata_stile_logo_right_link', '')) {
		echo '<a href="' . madisoft_get_theme_option( 'madisoft_scuola_testata_stile_logo_right_link', '#') . '">';
	} ?>
        <img class="logo" src="<?php echo madisoft_get_theme_option( 'madisoft_scuola_testata_stile_logo_right' , madisoft_scuola_get_assets_directory('img') . 'logo-repubblica-italiana.svg');?>"/>
		<?php if (madisoft_get_theme_option( 'madisoft_scuola_testata_stile_logo_right_link', '')) {
		echo '</a>';
	} ?>
    </div>
    <?php } ?>
    <div class="col-sm-1"></div>
</div>
<div style="clear: both"></div>