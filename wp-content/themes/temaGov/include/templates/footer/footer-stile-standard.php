<div id="line_widget_footer" class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-6<?php echo ottieniClasseNoPaddingLeft(); ?> centermobile">
        <?php
        global $madisoftTheme;
        /** @var MadisoftDatiIstituto $testo */
        $testo =  $madisoftTheme->getGlobalVar('datiIstitutoClass');
        echo $testo->getDatiPerFooter();
        ?>
    </div>
    <div class="col-sm-16"><?php
        mostraIWidgetDelFooterSeNecessario();
        ?></div>
    <div class="col-sm-1"></div>
</div>
<div class="row">
    <div class="col-sm-1"></div>
    <div class="col-md-6 mt-auto mb-sm-0<?php echo ottieniClasseNoPaddingLeft(); ?> centermobile">
        <p>Tutti i diritti riservati ©<?php echo date('Y'); ?></p>
    </div>
    <?php
    $larghezzaFooter = calcolaDimensioneColonneFooter();
    $restante = MadisoftScuolaWidth::MADISOFT_WIDTH_ALL - 1 - $larghezzaFooter;
    ?>
    <div class="col-sm-16">
        <div class="container">
            <div class="row">
               <div class="col-md-<?php echo calcolaDimensioneColonneFooter();?> mt-auto mb-sm-0">
                    <p class="codiceFiscale">Codice Fiscale: <?php echo madisoft_get_theme_option( 'madisoft_scuola_istituto_codice_fiscale', '' ); ?></p>
                </div>
                <div class="col-sm-<?php echo $restante ?>">
                    <?php
                    get_template_part ( 'include/templates/menu-social');
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-23">
        <?php get_template_part('menu-footer'); ?>
    </div>
    <div class="col-sm-1"></div>
</div>

<div class="subfooter">
    <div class="text-center">
        <div id="loghiW3C">
            <a href="https://validator.w3.org/nu/?doc=https://<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>" target="_blank" title="HTML 5 Valido!"><img src="<?php echo madisoft_scuola_get_assets_directory('img'); ?>valid-xhtml10.png" alt="XHTML5 Valido!"/></a>&nbsp;<a href="http://jigsaw.w3.org/css-validator/validator?uri=https://<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>" target="_blank" title="CSS Valido!"><img src="<?php echo madisoft_scuola_get_assets_directory('img'); ?>vcss-blue.gif" alt="CSS Valido!"/></a>
            <?php
            if (madisoft_get_theme_option('madisoft_scuola_link_dichiarazione_agid', '') != '') {
                echo '<a href="' . madisoft_get_theme_option('madisoft_scuola_link_dichiarazione_agid', '') .'"
           target="_blank" title="Dichiarazione di accessibilit&agrave; del sito web">
            <span class="fontsize2"><span class="fa fa-universal-access" aria-hidden="true"></span></span>
        </a>'; }
            ?>
        </div>
        <div>
            <p id="credits">Sito realizzato da
                <a href="http://scuoladigitale.info" target="_blank" title="Madisoft">Madisoft</a>
                <?php
                if (madisoft_get_theme_option('madisoft_scuola_webmaster', '') != '') {
                    echo ' - referente del sito: <strong><em>' .
                        madisoft_get_theme_option('madisoft_scuola_webmaster', '') . '</em></strong>';
                }
                ?>
            </p>

        </div>
    </div>
</div>