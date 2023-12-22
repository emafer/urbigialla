<div class="row" id="header">
    <div class="container-fluid no-padding-left">
        <?php

            get_template_part( 'include/templates/headers/immagini' );
            caricaDatiIstitutoSeNecessario();
        ?>
    </div>
</div>
<?php
function caricaDatiIstitutoSeNecessario() {
	if (madisoft_get_theme_option('madisoft_scuola_forza_dati_testata', 'off') == 'on') {
            get_template_part('include/templates/headers/dati-testata');
        } else {
    if ( madisoft_get_theme_option('madisoft_scuola_testata_mostra_testata_standard', 'on' ) == 'on' ) {
        get_template_part('include/templates/headers/testata-stile-' . madisoft_get_theme_option('madisoft_scuola_testata_stile', 'standard' ));
    } 
    }
}