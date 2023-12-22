<?php
echo '<div class="row">
    <div class="col-xs-' . MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' col-sm-' . madisoft_scuola_get_larghezza('header-slide') . ' text-center">';
        if ( madisoft_get_theme_option( 'madisoft_scuola_testata_mostra_slider', 0 ) == 'on' ) {
            madisoft_scuola_testata_includi_slider();
        } else {
            $immagine = madisoft_scuola_get_immagine_per_intestazione_personalizzata();
            if ( $immagine ) {
                ?>
                <a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>"><img src="<?php echo $immagine; ?>" alt="<?php bloginfo( 'name' ); ?>" class="img_slide" /></a>
            <?php }
        }
echo "\n\t" . '</div>';
madisoft_get_top_sidebar();
echo '</div>';
