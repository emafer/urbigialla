<?php

/**
 * @param $post
 * @param bool $mostraIlContenuto
 * @return string
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function scriviArticolo1($post, $mostraIlContenuto = false){
    $titolo = madisoft_scuola_protect_title($post);
    $col = [
        'img'  => 0,
        'text' => MadisoftScuolaWidth::MADISOFT_WIDTH_ALL,
    ];
    if (get_post_thumbnail_id($post)) {
        $larghezza = madisoft_get_theme_option('madisoft_scuola_layout_modello_1_larghezza_immagine', MadisoftScuolaWidth::MADISOFT_WIDTH_1_6);
        $col = [
            'img'  => $larghezza,
            'text' => MadisoftScuolaWidth::MADISOFT_WIDTH_ALL - $larghezza,
        ];
    }
    $textHtml = '<div class="post_preview layout-articolo1 col-xs-12 col-md-8 col-sm-' . calcolaDimensioneColonneArticoli() . '">' . "\n";
    $textHtml .= "\t" . '<div class="container-fluid">' ."\n";
    $textHtml .= "\t\t" . '<div class="row post_preview_borded">' ."\n";
    $textHtml .= "\t\t" . '<div class="container-fluid">' ."\n";
    $textHtml .= "\t\t" . '<div class="row">' ."\n";
    if ($col['img']){
        $textHtml .= "\t\t\t" . '<div class="col-xs-'. MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' col-sm-' . $col['img'] . ' immagine-articolo">' ."\n";
        $textHtml .= inserisciImmagineSeNecessario($post, $titolo, true);
        $textHtml .= "\t\t\t" . '</div>' . "\n";
    }
    $textHtml .= "\t\t\t" . '<div class="col-xs-'. MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' col-sm-' . $col['text'] . '  body-articolo">' ."\n";
    $textHtml .= madisoft_scuola_scrivi_titolo(true, '3', true, $post);
    $textHtml .= wp_trim_words( madisoft_get_the_content(
        madisoft_scuola_get_testo_per_continua_a_leggere($titolo), true, $post),
        madisoft_get_theme_option('madisoft_scuola_lunghezza_parole_preview_articolo', 50)
    );
    $textHtml .= "\t\t\t" . '</div>' . "\n";
    $textHtml .= "\t\t\t" . '</div>' . "\n";
    $textHtml .= "\t\t" . '<div class="row text-right">' ."\n";
    $textHtml .= madisoft_scuola_mostra_meta ($post);
    $textHtml .= "\t\t" . '</div>' . "\n";
    $textHtml .= "\t\t" . '</div>' . "\n";
    $textHtml .= "\t\t" . '</div>' . "\n";
    $textHtml .= "\t" . '</div>' . "\n";
    $textHtml .= '</div>' . "\n";

    return $textHtml;
}
function scriviArticoloStyle1($titolo, $larghezza, $immagine, $permalink, $data, $dataTime, $elemento, $mostraContinua, $colore ='') {
    $textHtml = '<div class="post_preview layout-articolo1 col-xs-12 col-sm-' . $larghezza . getLastAccessClass($dataTime) . '">' . "\n";
    $textHtml .= "\t" . '<div class="container layout-articolo-inner">' ."\n";
    $textHtml .= "\t\t" . '<div class="row post_preview_inner">' ."\n";
    $textHtml .= "\t\t\t" . '<div class="col-xs-'. MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' col-sm-' . MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . '  body-articolo">' ."\n";
    $textHtml .= madisoft_scuola_scrivi_titolo_int($titolo, "", $permalink, true, '3', true, $data);
    $textHtml .= "\t\t\t" . '</div>' . "\n";
    $textHtml .= "\t\t\t" . '<div class="col-xs-'. MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' col-sm-' . MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . '  body-articolo">' ."\n";
    if ($elemento) {
        global $multipage;
        $textHtml .= "\t\t\t" .madisoft_get_the_content(madisoft_scuola_get_testo_per_continua_a_leggere($titolo), true, $elemento);
        if( $multipage) {
            $more_link_text = madisoft_scuola_get_testo_per_continua_a_leggere($titolo);
            $textHtml .= apply_filters( 'the_content_more_link', ' <a href="' . get_permalink( $elemento ) . "#more-{$elemento->ID}\" class=\"linkMadisoft readAll\">$more_link_text</a>", $more_link_text );
        }
    }
    $textHtml .= "\t\t\t" . '</div>' . "\n";
    $textHtml .= "\t\t" . '</div>' . "\n";
    $textHtml .= "\t" . '</div>' . "\n";
    $textHtml .= '</div>' . "\n";

    return $textHtml;
}
function scriviArticoloStyle3($titolo, $larghezza, $immagine, $permalink, $data, $dataTime, $post, $mostraContinua, $colore = '') {

    $textHtml = '<div class="post_preview layout-articolo3 col-xs-12 col-md-8 col-lg-' . $larghezza . getLastAccessClass($dataTime) . '">' . "\n";
    $textHtml .= "\t" . '<div class="container layout-articolo-inner">' ."\n";
    $textHtml .= "\t\t" . '<div class="row post_preview_inner">' ."\n";
    $textHtml .= "\t\t\t" . '<div class="col-xs-'. MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' col-sm-' . MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . '  body-articolo">' ."\n";
    $textHtml .= madisoft_scuola_scrivi_titolo_int($titolo, "", $permalink, true, '3', true, $data);
    $textHtml .= "\t\t\t" . '</div>' . "\n";
    if ($mostraContinua) {
        $textHtml .= "\t\t\t" . '<div class="col-xs-'. MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' col-sm-' . MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . '  body-articolo readAllContainer">' ."\n";
        $textHtml .= "\t\t\t" . '<a href="' . $permalink . '" class="linkMadisoft readAll">' . madisoft_scuola_get_testo_per_continua_a_leggere() . '</a>';
        $textHtml .= "\t\t\t" . '</div>' . "\n";
    }
    $textHtml .= "\t\t" . '</div>' . "\n";
    $textHtml .= "\t" . '</div>' . "\n";
    $textHtml .= '</div>' . "\n";

    return $textHtml;
}
function scriviArticoloStyle2($titolo, $larghezza, $immagine, $permalink, $data, $dataTime, $post, $mostraContinua, $colore = '') {
    $classeAgg = calcolaClasseAggiuntiva($titolo);
    $textHtml = '<div class="post_preview layout-articolo2 col-xs-12  col-md-8 col-lg-' . $larghezza . getLastAccessClass($dataTime) . '">' . "\n";
    $textHtml .= "\t" . '<div class="container layout-articolo-inner">' ."\n";
    $textHtml .= "\t\t" . '<div class="row post_preview_inner">' ."\n";
    $textHtml .= "\t\t\t" . '<div class="col-xs-'. MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' col-md-'. MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' col-sm-' . MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' immagine-articolo">' ."\n";
    $textHtml = printImmagineEvidenza($permalink, $immagine, $textHtml);
    $textHtml .= "\t\t\t" . '</div>' . "\n";
    $textHtml .= "\t\t\t" . '<div class="col-xs-'. MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' col-md-'. MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' col-sm-' . MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . '  body-articolo' . $classeAgg . '">' ."\n";
    $textHtml .= madisoft_scuola_scrivi_titolo_int($titolo, "", $permalink, true, '3', true, $data);
    $textHtml .= "\t\t\t" . '</div>' . "\n";
    if ($mostraContinua) {
        $textHtml .= "\t\t\t" . '<div class="col-xs-'. MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' col-md-'. MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' col-sm-' . MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . '  body-articolo readAllContainer">' ."\n";
        $textHtml .= "\t\t\t\t" . '<a href="' . $permalink . '" class="linkMadisoft readAll">' . madisoft_scuola_get_testo_per_continua_a_leggere() . '</a>';
        $textHtml .= "\t\t\t" . '</div>' . "\n";
    }
    $textHtml .= "\t\t" . '</div>' . "\n";
    $textHtml .= "\t" . '</div>' . "\n";
    $textHtml .= '</div>' . "\n";

    return $textHtml;
}
function scriviArticoloStyle4($titolo, $larghezza, $immagine, $permalink, $data, $dataTime, $post, $mostraContinua, $colore = '') {
    $textHtml = '<div class="post_preview layout-articolo4 col-xs-12 col-lg-' . $larghezza . getLastAccessClass($dataTime) . ' no-padding-left no-padding-right">' . "\n";
    $textHtml .= "\t" . '<div class="container layout-articolo-inner">' ."\n";
    $textHtml .= "\t\t" . '<div class="row post_preview_inner">' ."\n";
    $textHtml .= "\t\t\t" . '<div class="col-xs-'. MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' col-sm-' . MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' immagine-articolo no-padding-left no-padding-right">' ."\n";
    $textHtml = printImmagineEvidenza($permalink, $immagine, $textHtml);
    $textHtml .= "\t\t\t" . '</div>' . "\n";
    $textHtml .= '<div class="titoloGhost">' . madisoft_scuola_scrivi_titolo_int($titolo, "", $permalink, true, '3', true, $data) .'</div>';
    $textHtml .= "\t\t" . '</div>' . "\n";
    $textHtml .= "\t" . '</div>' . "\n";
    $textHtml .= '</div>' . "\n";

    return $textHtml;
}
function scriviArticoloStyle5($titolo, $larghezza, $immagine, $permalink, $data, $dataTime, $post, $mostraContinua, $colore= '') {
    /**

    <div class="carousel-item active">
    <img src="https://picsum.photos/id/102/200/60" class="d-block w-100" alt="...">
    <div class="carousel-caption d-none d-md-block">
    <h5>First slide label</h5>
    <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
    </div>
    </div>
     *
     */

    $textHtml = '<div class="post_preview layout-articolo5 col-xs-12 col-lg-' . $larghezza . getLastAccessClass($dataTime) . ' no-padding-left no-padding-right">' . "\n";
    $textHtml .= "\t" . '<div class="container layout-articolo-inner">' ."\n";
    $textHtml .= "\t\t" . '<div class="row post_preview_inner">' ."\n";
    $textHtml .= "\t\t\t" . '<div class="col-xs-'. MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' col-sm-' . MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' immagine-articolo no-padding-left no-padding-right">' ."\n";
    $textHtml = printImmagineEvidenza($permalink, $immagine, $textHtml);
    $textHtml .= "\t\t\t" . '</div>' . "\n";
    $textHtml .= '<div class="titoloGhost">' . madisoft_scuola_scrivi_titolo_int($titolo, "", $permalink, true, '3', true, $data) .'</div>';
    $textHtml .= "\t\t" . '</div>' . "\n";
    $textHtml .= "\t" . '</div>' . "\n";
    $textHtml .= '</div>' . "\n";

    return $textHtml;
}
function scriviArticoloStyle6($titolo, $larghezza, $immagine, $permalink, $data, $dataTime, $post, $mostraContinua, $colore= '') {
    /**
     */
    $textHtml = '<div class="post_preview layout-articolo6 col-xs-12 col-md-12'. getLastAccessClass($dataTime) . ' no-padding-left no-padding-right">' . "\n";
    $textHtml .= "\t" . '<div class="container layout-articolo-inner">' ."\n";
    $textHtml .= "\t\t" . '<div class="row post_preview_inner">' ."\n";
    $textHtml .= "\t\t\t" . '<div class="col-xs-'. MadisoftScuolaWidth::MADISOFT_WIDTH_1_4 . ' col-sm-' . MadisoftScuolaWidth::MADISOFT_WIDTH_1_4 . ' immagine-articolo no-padding-left no-padding-right">' ."\n";
    $textHtml = printImmagineEvidenza($permalink, $immagine, $textHtml);
    $textHtml .= "\t\t\t" . '</div><!-- chiusura immagine in evidenza -->' . "\n";
    $textHtml .= "\t\t\t" . '<div class="col-xs-' . MadisoftScuolaWidth::MADISOFT_WIDTH_3_4 . ' col-sm-' . MadisoftScuolaWidth::MADISOFT_WIDTH_3_4 . '">' . "\n";
    $textHtml .= "\t\t\t\t" .'<div class="postTitle">' . madisoft_scuola_scrivi_titolo_int($titolo, "", $permalink, true, '3', true, $data) .'</div>';
    $textHtml .= "\t\t\t" . '</div><!-- chiusura testo -->' . "\n";
    $textHtml .= "\t\t" . '</div><!-- chiusura row -->' . "\n";
    $textHtml .= "\t" . '</div><!-- chiusura container -->' . "\n";
    $textHtml .= '</div><!-- chiusura post_prev -->' . "\n";
    return $textHtml;
}

function scriviArticoloStyle98($titolo, $larghezza, $immagine, $permalink, $data, $dataTime, $post, $mostraContinua, $colore = '') {
    $textHtml = '<div class="post_preview layout-articolo98 col-xs-' . MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' col-sm-' . MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ''. getLastAccessClass($dataTime) . '">' . "\n";
    $textHtml .= "\t" . '<div class="container layout-articolo-inner">' ."\n";
    $textHtml .= "\t\t" . '<div class="row post_preview_inner">' ."\n";
    $textHtml .= "\t\t\t" . '<div class="col-xs-'. MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' col-sm-' . MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' immagine-articolo">' ."\n";
    $textHtml = printImmagineEvidenza($permalink, $immagine, $textHtml);
    $textHtml .= "\t\t\t" . '</div>' . "\n";
    $textHtml .= "\t\t\t" . '<div class="col-xs-'. MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' col-sm-' . MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . '  body-articolo">' ."\n";
    $textHtml .= madisoft_scuola_scrivi_titolo_int($titolo, "", $permalink, true, '3', true, $data);
    $textHtml .= "\t\t\t" . '</div>' . "\n";
    if ($mostraContinua) {
        $textHtml .= "\t\t\t" . '<div class="col-xs-'. MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' col-sm-' . MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . '  body-articolo readAllContainer">' ."\n";
        $textHtml .= "\t\t\t\t" . '<a href="' . $permalink . '" class="linkMadisoft readAll">' . madisoft_scuola_get_testo_per_continua_a_leggere() . '</a>';
        $textHtml .= "\t\t\t" . '</div>' . "\n";
    }
    $textHtml .= "\t\t" . '</div>' . "\n";
    $textHtml .= "\t" . '</div>' . "\n";
    $textHtml .= '</div>' . "\n";

    return $textHtml;
}
function scriviArticoloStyle99($titolo, $larghezza, $immagine, $permalink, $data, $dataTime, $post, $mostraContinua, $color = '') {

    if ($color) {
        $style=' style="border-left: 5px solid ' . $color .'"';
    } else {
        $style = '';
    }
    $textHtml = '<div class="post_preview layout-articolo99 col-xs-' . MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' col-sm-' . MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ''. getLastAccessClass($dataTime) . '">' . "\n";
    $textHtml .= "\t" . '<div class="container layout-articolo-inner"' . $style . '>' ."\n";
    $textHtml .= "\t\t" . '<div class="row post_preview_inner">' ."\n";
    $textHtml .= "\t\t\t" . '<div class="col-xs-'. MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' col-sm-' . MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . '  body-articolo">' ."\n";
    $textHtml .= madisoft_scuola_scrivi_titolo_int($titolo, "", $permalink, true, '3', true, $data);
    $textHtml .= "\t\t\t" . '</div>' . "\n";
    $textHtml .= "\t\t" . '</div>' . "\n";
    $textHtml .= "\t" . '</div>' . "\n";
    $textHtml .= '</div>' . "\n";

    return $textHtml;
}
/**
 * @param $rendiCliccabileIlTItolo
 * @param $mostraIlContenuto
 * @param $soloIlTitolo
 * @param $post
 * @return string
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function scriviArticoloStandard($rendiCliccabileIlTItolo, $mostraIlContenuto, $soloIlTitolo, $post)
{
    $textHtml =  "\n" . '<div class="' . nomeClassePostPreview() . ' col-xs-'. MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' col-sm-' . calcolaDimensioneColonneArticoli() . '">' . "\n";
    $textHtml .= "\t" . '<article>';

    $titolo = madisoft_scuola_protect_title($post);
    $textHtml .= scriviTitoloEImmagineInEvidenza($rendiCliccabileIlTItolo, $post, $titolo);
    // se rendiCliccabile il titolo è true, sicuramente siamo in preview dell'articolo,
    // quindi aggiungiamo un contenitore esplicativo
    if ($rendiCliccabileIlTItolo) {
        $textHtml .= "\n" . '<div class="article_preview">';
    }
    if (!$soloIlTitolo) {
        if ($mostraIlContenuto) {
            $textHtml .= madisoft_the_content(madisoft_scuola_get_testo_per_continua_a_leggere($titolo), false, $post);
        } else {
            $textHtml .= get_the_excerpt($post);
        }
    }
    if ($rendiCliccabileIlTItolo) {
        $textHtml .= "\n" . '</div>';
    }
    $textHtml .= '<div style="clear:both"></div>';
    $textHtml .= '<footer>';
    $textHtml .= "\t\t" . '<div class="row text-right">' ."\n";
    $textHtml .= madisoft_scuola_mostra_meta ($post);
    $textHtml .= "\t\t" . '</div>' . "\n";
    $textHtml .= '</footer>';
    $textHtml .= '</article>' . "\n\t";
    $textHtml .= "\n" . '<div style="clear:both"></div>';
    $textHtml .=  "\n" . '</div>' .  "\n";

    return $textHtml;
}
/**
 * @param $rendiCliccabileIlTItolo
 * @param $post
 * @param $titolo
 * @return string
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function scriviTitoloEImmagineInEvidenza($rendiCliccabileIlTItolo, $post, $titolo, $header = 3, $show_data = true, $single = false)
{
    $textHtml = '';
    if (usareImmagineInEvidenza() && mostrareImmagineInEvidenzaSopraIlTitolo())
    {
        $textHtml .= madisoft_scuola_scrivi_titolo($rendiCliccabileIlTItolo, $header, $show_data, $post);
        $textHtml .= inserisciImmagineSeNecessario($post, $titolo, false, $single);
    } else {
        $textHtml .= inserisciImmagineSeNecessario($post, $titolo,false, $single);
        $textHtml .= madisoft_scuola_scrivi_titolo($rendiCliccabileIlTItolo, $header, $show_data, $post);
    }

    return $textHtml;
}
/**
 * @return bool
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function mostrareImmagineInEvidenzaSopraIlTitolo()
{
    return madisoft_get_theme_option('madisoft_scuola_mostra_immagine_in_evidenza_sottosopra_titolo', '1') == '1';
}


/**
 * @return bool
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function usareImmagineInEvidenza()
{
    return ( madisoft_get_theme_option('madisoft_scuola_mostra_immagine_in_evidenza', 'off')  == 'on' );
}

/**
 * @param $post
 * @param $titolo
 * @param bool $ignoraOpzione
 * @param bool $singleView
 * @return string
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function inserisciImmagineSeNecessario($post, $titolo, $ignoraOpzione = false, $singleView = false)
{
    $usaImmagine = usareImmagineInEvidenza();
    $textHtml = '';
    if ($ignoraOpzione) {
        $usaImmagine = true;
    }
    if ($usaImmagine ) {
        $immagine = madisoft_scuola_get_immagine_in_evidenza($post);
        if ($singleView && $immagine) {
            $textHtml = printImmagineEvidenza('#', $immagine, $textHtml);
        } else {
            $permalink = get_permalink($post);
            $textHtml = printImmagineEvidenza($permalink, $immagine, $textHtml);
        }
    }
    return $textHtml;
}

/**
 * @param $permalink
 * @param $immagine
 * @param $textHtml
 * @return string
 */function printImmagineEvidenza($permalink, $immagine, $textHtml)
{
    $textHtml .= '<div class="immagine_post post_evidence_img text-center" data-target="' . $permalink . '" 
        style="background-image: url(' . $immagine . ');">
        </div>';
    return $textHtml;
}
