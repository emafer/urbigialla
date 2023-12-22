<div class="row">
    <?php
	echo '<div class="col-sm-1"></div>';
        madsoft_scuola_get_logo();
         echo '<div class="col-xs-' . MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' col-sm-' . (madisoft_scuola_get_larghezza('header-text')-2) . '">';
         echo '<div class="row">';
        $widthDivText = 24;
         if ( madisoft_get_theme_option('madisoft_scuola_logomin', 'on') == 'on') {
             $widthDivText = 22;
             echo '<div class="logo_wrapper col-lg-2 col-sm-2 text-center d-none d-sm-block">
											<a href="' . get_option('home', true) . '" title="Torna alla pagina iniziale"> 
												<img src="' . madisoft_scuola_get_assets_directory('img') . 'logo-repubblica-italiana.svg" alt="Torna alla pagina iniziale">
											</a>
										</div>';
         }
         echo  '<div class="logo_text col-sm-' . $widthDivText . '">
										<h1>' . madisoft_get_theme_option('madisoft_scuola_istituto_nome', '') . '</h1>';
    if (madisoft_get_theme_option('madisoft_scuola_testata_mostra_testata_comune', 'on') == 'on') {
										echo '<h2> ' . madisoft_get_theme_option('madisoft_scuola_istituto_comune', '')
             . ' <span id="provinciaIstituto">(' .  madisoft_get_theme_option('madisoft_scuola_istituto_provincia', '') .')</span></h2>'; }
    echo '</div></div>';

        echo '</div>';
         madisoft_get_text_sidebar();
    ?>
	<div class="col-sm-1"></div>
</div>
