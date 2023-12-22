<?php

if ( introPossoMostrareLaFasciaDiIntro() ) {
    ?>
        <div class="row" id="intro">
            <?php
            if ( introPossoMostrareIlBoxLaterale() ) {
                $width1 = MadisoftScuolaWidth::MADISOFT_WIDTH_3_4;
                $width2 = MadisoftScuolaWidth::MADISOFT_WIDTH_1_4;
            } else {
                $width1 = MadisoftScuolaWidth::MADISOFT_WIDTH_ALL;
                $width2 = 0;
            }
            ?>
            <div class="col-xs-<?php echo MadisoftScuolaWidth::MADISOFT_WIDTH_ALL;?> col-sm-<?php echo $width1 ?>">
                <?php
                switch ( introTipoFascia() ){
                    case 'immagine':
                        get_template_part('include/templates/intro/immagini');
                        break;
                    case 'youtube':
                        get_template_part('include/templates/intro/youtube');
                        break;
                }

                ?>
            </div>
            <?php if ($width2 > 0) { ?>
                <div class="hidden-xs col-sm-<?php echo $width2 ?>" id="intro-text">
                    <?php
                    switch (madisoft_get_theme_option('page_intro_tipo_box', 'immagine')) {
                        case 'immagine':
                            ?>
                            <img alt="Intro" width="100%"
                                 src="<?php echo madisoft_get_theme_option('madisoft_scuola_intro_box_immagine', ''); ?>"/>
                            <?php
                            break;
                        case 'testo':
                            get_template_part('include/templates/intro/testo');
                            break;
                    };
                    ?>
                </div>
            <?php } ?>
        </div>
    <?php
}
else if (madisoft_scuola_get_immagine_per_intro_personalizzata()){
    // non devo mostrare la fascia, ma se la pagina prevede un'immagine personalizzata allora la piazzo
    ?>
    <div class="row" id="intro">
            <?php
            if ( introPossoMostrareIlBoxLaterale() ) {
                $width1 = MadisoftScuolaWidth::MADISOFT_WIDTH_3_4;
                $width2 = MadisoftScuolaWidth::MADISOFT_WIDTH_1_4;
            } else {
                $width1 = MadisoftScuolaWidth::MADISOFT_WIDTH_ALL;
                $width2 = 0;
            }
            ?>
            <div class="col-xs-<?php echo MadisoftScuolaWidth::MADISOFT_WIDTH_ALL;?> col-sm-<?php echo $width1 ?>">
                <?php
                    get_template_part('include/templates/intro/immagini');
                ?>
            </div>
            <?php if ($width2 > 0) { ?>
                <div class="hidden-xs col-sm-<?php echo $width2 ?>" id="intro-text">
                    <?php
                    switch (madisoft_get_theme_option('page_intro_tipo_box', 'immagine')) {
                        case 'immagine':
                            ?>
                            <img alt="Intro" width="100%"
                                 src="<?php echo madisoft_get_theme_option('madisoft_scuola_intro_box_immagine', ''); ?>"/>
                            <?php
                            break;
                        case 'testo':
                            get_template_part('include/templates/intro/testo');
                            break;
                    };
                    ?>
                </div>
            <?php } ?>
        </div>
<?php
}