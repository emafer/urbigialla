<?php

function madisoft_theme_print_page_content(){
    if ( have_posts() ) {
        while (have_posts()) {
            the_post();
            madisoft_scuola_Pagina();
        }
    }
}
function madisoft_theme_print_page_content_solo(){
    echo '
        <div class="row">
            <div class="col-xs-12 col-sm-12">';
    madisoft_theme_print_page_content();
    echo '
            </div>
        </div>';
}


/**
 * @return array|string
 */
function possoMostrareLaNavigazioneDellaCategoriaSecondaria()
{
    return madisoft_get_theme_option('madisoft_scuola_categoria_secondaria_nav_link', 'on') == 'on';
}

/**
 * @return bool
 */
function possoMostrareLaNavigazioneDellaCategoriaPrincipale()
{
    return madisoft_get_theme_option('madisoft_scuola_categoria_principale_nav_link', 'on') == 'on';
}

$categorie =[
    'principale' => [
        'img'       => madisoft_get_theme_option( 'madisoft_scuola_home_immagine_articoli', null ),
        'id'        => madisoft_get_theme_option( 'madisoft_scuola_home_categoria_principale', null ),
        'numArt'    => madisoft_get_theme_option( 'madisoft_scuola_home_categoria_principale_numero_articoli', 0 ),
        'titolo_si' => madisoft_get_theme_option( 'madisoft_scuola_home_categoria_principale_titolo_mostra', 1 ),
        'titolo'    => madisoft_get_theme_option( 'madisoft_scuola_home_categoria_principale_titolo', '' ),
        'navlink'    => possoMostrareLaNavigazioneDellaCategoriaPrincipale(),
        'solo_titolo'=> madisoft_get_theme_option('madisoft_scuola_categoria_principale_solo_titoli', 'off'),
        'class'     => 'principale',
    ],
    'secondaria' => [
        'img'       => madisoft_get_theme_option( 'madisoft_scuola_home_immagine_articoli_secondaria', null ),
        'id'        => madisoft_get_theme_option( 'madisoft_scuola_home_categoria_secondaria', null ),
        'numArt'    => madisoft_get_theme_option( 'madisoft_scuola_home_categoria_secondaria_numero_articoli', 0 ),
        'titolo_si' => madisoft_get_theme_option( 'madisoft_scuola_home_categoria_secondaria_titolo_mostra', 1 ),
        'solo_titolo'=> madisoft_get_theme_option('madisoft_scuola_categoria_secondaria_solo_titoli', 'off'),
        'titolo'    => madisoft_get_theme_option( 'madisoft_scuola_home_categoria_secondaria_titolo', '' ),
        'navlink'    => possoMostrareLaNavigazioneDellaCategoriaSecondaria(),
        'class'     => 'secondaria',
    ]
];

if ( madisoft_get_theme_option('madisoft_scuola_home_static_page', 'on') == 'off'){
    mostraContenutiConArticoli($categorie);
} else {
    madisoft_theme_print_page_content_solo();
}

function mostraContenutiConArticoli($categorie){

    $isMostraEventi     = madisoft_get_theme_option( 'madisoft_scuola_home_eventi_mostra', null );
    $eventiNumArticoli  = madisoft_get_theme_option( 'madisoft_scuola_home_eventi_numero', 0 );
    $eventiTitolo       = madisoft_get_theme_option( 'madisoft_scuola_home_eventi_titolo', '' );
    switch (madisoft_get_theme_option('madisoft_scuola_home_page_numero_colonne', 2)) {
        case '1':
            //        UNICA
            ?>

            <?php mostraArticoliInEvidenza(true); ?>
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <?php
                    mostraArticoliDellaCategoria($categorie['principale']);
                    mostraArticoliDellaCategoria($categorie['secondaria']);
                    mostraEventiSeNecessario('column', $isMostraEventi, $eventiNumArticoli, $eventiTitolo );
                    ?>
                </div>
            </div>
            <?php
            break;
        case '2':
            //NEWS, PAGE_CONTENT su 2 colonne+
            mostraArticoliInEvidenza(true);
            ?>
            <div class="row">
                <div id="home-left" class="col-xs-12 col-sm-6">
                    <?php
                    mostraArticoliDellaCategoria($categorie['principale']);
                    mostraArticoliDellaCategoria($categorie['secondaria']);
                    mostraEventiSeNecessario('column', $isMostraEventi, $eventiNumArticoli, $eventiTitolo );
                    ?>
                </div>
                <div class="col-xs-12 col-sm-6 bordedLeftColumn">
                    <?php
                    madisoft_theme_print_page_content();
                    ?>
                </div>
            </div>
            <?php
            break;
        case '3':
            //STATIC COL1, COL2
            ?>
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <?php
                    madisoft_theme_print_page_content();
                    ?>
                </div>
            </div>
            <div class="divisoreSezione">&nbsp;</div>
            <?php mostraArticoliInEvidenza(true); ?>
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <?php
                    mostraArticoliDellaCategoria($categorie['principale']);
                    ?>
                </div>
                <div class="col-xs-12 col-sm-6 bordedLeftColum">
                    <?php
                    mostraArticoliDellaCategoria($categorie['secondaria']);
                    mostraEventiSeNecessario('column', $isMostraEventi, $eventiNumArticoli, $eventiTitolo );
                    ?>
                </div>
            </div>
            <?php
            break;
        case '4':
            //STATIC C+ new con 1 sezioni
            ?>
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <?php
                    madisoft_theme_print_page_content();
                    ?>
                </div>
            </div>
            <?php mostraArticoliInEvidenza(true); ?>
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <?php
                    mostraArticoliDellaCategoria($categorie['principale']);
                    mostraArticoliDellaCategoria($categorie['secondaria']);
                    mostraEventiSeNecessario('column', $isMostraEventi, $eventiNumArticoli, $eventiTitolo );
                    ?>
                </div>
            </div>
            <?php
            break;
        case '5':
            //NEWS colonna unica + statica
            ?>
            <?php mostraArticoliInEvidenza(true); ?>
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <?php
                    mostraArticoliDellaCategoria($categorie['principale']);
                    mostraArticoliDellaCategoria($categorie['secondaria']);
                    mostraEventiSeNecessario('column', $isMostraEventi, $eventiNumArticoli, $eventiTitolo );
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <?php
                    madisoft_theme_print_page_content();
                    ?>
                </div>
            </div>
            <?php
            break;
        case '6':
            //NEWS colonne  + statica
            mostraArticoliInEvidenza(true);
            ?>
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <?php
                    mostraArticoliDellaCategoria($categorie['principale']);
                    ?>
                </div>
                <div class="col-xs-12 col-sm-6 bordedLeftColum">
                    <?php
                    mostraArticoliDellaCategoria($categorie['secondaria']);
                    mostraEventiSeNecessario('column', $isMostraEventi, $eventiNumArticoli, $eventiTitolo );
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <?php
                    madisoft_theme_print_page_content();
                    ?>
                </div>
            </div>
            <?php
            break;
    }
}