<div class="row">
    <?php
	echo '<div class="col-sm-1"></div>';
        madsoft_scuola_get_logo();
         echo '<div class="col-' . MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' col-sm-' . (madisoft_scuola_get_larghezza('header-text')-2) . '">';
         echo '<div class="row align-items-center">';
        $widthDivText = 24;
         if ( madisoft_get_theme_option('madisoft_scuola_logomin', 'on') == 'on') {
             $widthDivText = 22;
             echo
'<div class="logo_wrapper col-' . MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' col-lg-2 col-sm-2 text-center d-sm-block">
    <a href="' . get_option('home', true) . '" title="Torna alla pagina iniziale"> 
	    <img src="' . madisoft_scuola_get_assets_directory('img') . 'logo-repubblica-italiana.svg" alt="Torna alla pagina iniziale" class="mobile20">
	</a>
</div>';
         }
    get_template_part ( 'include/templates/headers/intitolazione-istituto',
        null, [
            'larghezzaIstituto' => $widthDivText
        ]);
    echo '</div>';
        echo '</div>';
         madisoft_get_text_sidebar();
    ?>
	<div class="col-sm-1"></div>
</div>
