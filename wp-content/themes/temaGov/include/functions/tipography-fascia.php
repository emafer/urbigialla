<?php

function creaFasciaWidget($numeroFascia, $textHtml)
{
    $textHtml .= "\n\t\t\t" . '<div class="row">';
    $textHtml .= '<div class="col-md-' . MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' container-testo testoFascia' . $numeroFascia . '" style="background-color: #ffffff">
    <div class="row">';
    $sidebar = '';
    if ( function_exists( 'dynamic_sidebar' ) ){
        ob_start();
        dynamic_sidebar( madisoft_get_theme_option('madisoft_scuola_home_fascia' . $numeroFascia . '_usa_sidebar', ''));
        $sidebar= ob_get_contents();
        $sidebar = str_replace('class="widget"', 'class="widget col-sm-4"', $sidebar);
        $sidebar = str_replace('class="widget_text widget"', 'class="widget_text  widget col-sm-4"', $sidebar);
        ob_end_clean();
    }
    if ($sidebar) {
        $textHtml .= $sidebar;
        $textHtml .= '</div></div>';
        $textHtml .= "\n\t\t\t" . '</div><!-- end row -->';
        return $textHtml;
    }

    return '';
}

function creaFasciaArticoliAScorrimento($numeroFascia, $textHtml)
{
    $numeroArticoli = madisoft_get_theme_option('madisoft_scuola_home_fascia' . $numeroFascia . '_numeroarticoli', 0);
    $idCategoria = madisoft_get_theme_option('madisoft_scuola_home_fascia' . $numeroFascia . '_sceltacategoria', 0);
    $articoliCategoria = get_posts('numberposts=' . $numeroArticoli . '&category=' . $idCategoria);
    $mostraContinua = (madisoft_get_theme_option('madisoft_scuola_home_fascia' . $numeroFascia . '_mostracontinua', 'on') == 'on')? true : false;
    $img = madisoft_get_theme_option('madisoft_scuola_home_fascia' . $numeroFascia . '_immaginebase', '');
    if (!$img) {
        $img = '/wp-content/uploads/sites/508/bandi.png';
    }
    $stile = madisoft_get_theme_option('madisoft_scuola_home_fascia' . $numeroFascia . '_stileprimario', '3');
    $catObj = get_category($idCategoria);
    $numeroDiArticoliPerSlide = madisoft_get_theme_option('madisoft_scuola_home_fascia' . $numeroFascia . '_numerocolonne', 3);;
    $larghezza = (MadisoftScuolaWidth::MADISOFT_WIDTH_ALL/$numeroDiArticoliPerSlide);
    $counter_articoli = 0;
    $totArticoli = count($articoliCategoria);
    if (isFasciaTuttaLarghezza()) {
        $classFascia ='container-fluid';
    } else {
        $classFascia = 'container';
    }
    if ($totArticoli) {

        $textHtml .= "\n\t\t\t" . '<div class="row"><!-- inizio scorrimento -->';
        $textHtml .= '<div class="' . $classFascia . ' carousel slide" data-ride="carousel"  id="carouselExampleControls' . $numeroFascia . '" style="margin-bottom: 50px; position: relative">';
        $linee = ceil($totArticoli / $numeroDiArticoliPerSlide);
        $textHtml .= '<ol class="carousel-indicators" style="bottom: -45px;">';
        for ($i =0; $i< $linee; $i++) {
            $textHtml .= '<li style="background-color: #06c" data-target="#carouselExampleControls' . $numeroFascia . '" data-slide-to="' . $i .'" ' . (($i==0)? ' class="active"' : '') . '></li>';
        }
        $lineachiusa =0;
        $textHtml .= '</ol>
        <div class="carousel-inner">
            <div class="carousel-item active"><!-- apro ' . $lineachiusa . ' -->
                <div class="row">';
        foreach ($articoliCategoria as $articolo) {
            setup_postdata($articolo);
            $counter_articoli++;
            $totArticoli--;
            global $more;
            $more = 0;
            $textHtml .= madisoft_scuola_Post(2, true, false, $articolo, false, $larghezza, $img, $mostraContinua);
            if ($counter_articoli%$numeroDiArticoliPerSlide == 0 && $totArticoli) {
                $textHtml .= '</div><!-- end row -->
</div><!-- end carousel item active ' . $lineachiusa . '-->' ;
                $lineachiusa++;
                if ($totArticoli) {
                    $textHtml .= '<div class="carousel-item"><div class="row" > <!-- apro ' . $lineachiusa . ' -->';
                }
            }
        }
        if ($lineachiusa != $linee) {
            $textHtml .= '</div><!-- end row -->
</div><!-- end carousel item active -->';
        }
        $textHtml .= '</div><!-- end carousel inner-->';
        $textHtml .= '</div> <!--end carousel slide-->';
        $textHtml .= "\n\t\t\t" . '</div><!-- fine scorrimento -->';
    }
    $textHtml = creaLinkCategoriaFascia($numeroFascia, $textHtml, $idCategoria, $catObj);
//    $textHtml .= '</div> <!--end fascia-->';
    return $textHtml;
}

/**
 * @return bool
 */
function isFasciaTuttaLarghezza()
{
    return madisoft_get_theme_option('madisoft_scuola_allarga_fasce', 'off') == 'on';
}

/**
 * @param $titolo
 * @return string
 */
function calcolaClasseAggiuntiva($titolo)
{
    if (madisoft_get_theme_option('madisoft_scuola_home_fascia_riduci_titoli', 'off') == 'off') {
        return  '';
    }
    $classeAgg = ' reduceme';
    if (strlen($titolo) > 30 && strlen($titolo) < 50) {
        $classeAgg = ' reduceme';
    } else if (strlen($titolo) > 50) {
        $classeAgg = ' reducememax';
    }
    return $classeAgg;
}


/**
 * @return string
 */
function madisoft_stampa_fasce()
{
    $textHtml = '';
    $baseOrdinamento = generaTestoBaseOrdinamentoFasce();
    //1 prendiamo l'ordinamento previsto
    $ordinamento_text = madisoft_get_theme_option('madisoft_home_ordine_fasce', $baseOrdinamento);
    if (!trim($ordinamento_text)) {
        $ordinamento_text = $baseOrdinamento;
    }
    $ordinamento = explode(" ", $ordinamento_text);

    foreach ($ordinamento as $numeroFascia) {
        $textHtml .=  madisoft_stampa_fascia($numeroFascia);
    }

    return $textHtml;
}

/**
 * @param $numerFascia
 * @return string
 */
function madisoft_stampa_fascia($numeroFascia) {
    if (madisoft_get_theme_option('madisoft_scuola_home_fascia' . $numeroFascia . '_mostra', 'off') == 'off') {
        return '';
    }
    global $post;
    $tipologiaFascia = madisoft_get_theme_option('madisoft_scuola_home_fascia' . $numeroFascia . '_tipologia');
    $fasciaChiusa = madisoft_get_theme_option('madisoft_scuola_home_fascia' . $numeroFascia . '_chiusa', 'off') == 'on';
    $classeFascia = ($numeroFascia%2 == 1)? ' pari' : ' dispari';
    $textHtml = '<div class="card container-fascia' . $classeFascia . '" style="padding-left: 15px">';
    $coloreSfondoFascia = madisoft_get_theme_option('madisoft_scuola_home_fascia' . $numeroFascia . '_colore', "");
    if ($coloreSfondoFascia) {
        $stileColoreFascia = ' style="background-color:' . $coloreSfondoFascia . '"';
    } else {
        $stileColoreFascia = '';
    }

    $textHtml .= "\n\t" . '<div class="card-header row intestazioneFascia" id="intestazioneFascia' . $numeroFascia . '"' . $stileColoreFascia .'>';
    $textHtml .= "\n\t\t" . '<div class="col-sm-1 col-md-1">';
    $textHtml .= '</div><!-- end div sm1 -->
<div class="col-sm-23">';
    $textHtml .= "\n\t\t\t" . '<button class="btn btn-link ' . (($fasciaChiusa)? " collapsed" : "")
        . '" data-toggle="collapse"
    data-target="#fascia' . $numeroFascia . '"
    aria-expanded="' . (($fasciaChiusa)? "false" : "true") . '"
    aria-controls="fascia' . $numeroFascia . '">'. madisoft_get_theme_option('madisoft_scuola_home_fascia' . $numeroFascia . '_titolo', 'Ultimi articoli') .'</button>';
    //$textHtml .= "\n\t\t" . '</h3>';
    $messaggio = '';
    if (current_user_can('madisoft_manage_options')) {
        $messaggio = 'Fascia numero ' . $numeroFascia . ' di tipo ';
        $linkEdit = '/wp-admin/themes.php?page=ot-theme-options#section_madisoft_scuola_sezione_home_page';
        switch ($tipologiaFascia) {
            case 'categoria':
                $messaggio .= 'Categoria;per modificarla accedere a gestisci la grafica del sito e agire sulla fascia numero ' . $numeroFascia;
                break;
            case 'widget':
                $messaggio .= 'Widget;per modificarla accedere a gestisci la grafica del sito e agire sulla fascia numero ' . $numeroFascia;
                break;
            default:
                $messaggio .= 'sconosciuta, controllare';
                break;
            case 'rss':
                $messaggio .= 'RSS;per modificarla accedere a gestisci la grafica del sito e agire sulla fascia numero ' . $numeroFascia;
                break;
            case 'lista-categoria':
                $messaggio .= 'Archivio Categoria;per modificarla accedere a gestisci la grafica del sito e agire sulla fascia numero ' . $numeroFascia;
                break;
            case 'video-youtube':
                $messaggio .= 'Video Youtube;per modificarla accedere a gestisci la grafica del sito e agire sulla fascia numero ' . $numeroFascia;
                break;
            case 'text':
                $messaggio .= 'Testo e immagini;per modificarla accedere a gestisci la grafica del sito e agire sulla fascia numero ' . $numeroFascia;
                break;
            case 'eventi':
                $messaggio .= 'Eventi;per modificarla accedere a gestisci la grafica del sito e agire sulla fascia numero ' . $numeroFascia;
                break;
            case 'fascia':
                $postContent = madisoft_get_theme_option('madisoft_scuola_home_fascia' . $numeroFascia . '_usa_contenuto_fascia', '');
                $linkEdit = get_edit_post_link($postContent);
                $messaggio .= 'Contenuti predisposti; Accedere alla bacheca, quindi a sinistra in Contenuti per fascia';
                break;
            case 'scorrimento':
                $messaggio .= 'scorrimento articoli;per modificarla accedere a gestisci la grafica del sito e agire sulla fascia numero ' . $numeroFascia;
                break;
        };
        $textHtml .= '<span class="badge badgeReport">
                            <span class="badge badge-info d-inline-block mr-2"  data-toggle="tooltip" data-placement="top"  title="' . $messaggio . '">
								<span class="fa fa-info" aria-hidden="true"></span> <a href="' . $linkEdit . '">Modifica</a>
						</span>
                    </span>';
    }
    $textHtml .= "\n\t" . '</div><!-- end div sm23 -->';
    $textHtml .= "\n\t" . '</div><!-- end card-header -->';

    $textHtml .= "\n\t" . '<div id="fascia' . $numeroFascia
        . '" class="collapse  contenuto-fascia ' . (($fasciaChiusa)? "" : " show ") . madisoft_get_theme_option('madisoft_scuola_home_fascia' . $numeroFascia . '_larghezza', 'container-fluid')
        . '" aria-labelledby="intestazioneFascia' . $numeroFascia . '" data-parent="#accordion">';
    $textHtml .= "\n\t\t" . '<div class="card-body">';

    switch ($tipologiaFascia) {
        case 'categoria':
            $messaggio .= 'Categoria;per modificarla accedere a gestisci la grafica del sito e agire sulla fascia numero ' . $numeroFascia;
            $textHtml = creaFasciaCategoria($numeroFascia, $textHtml);
            break;
        case 'widget':
            $messaggio .= 'Widget;per modificarla accedere a gestisci la grafica del sito e agire sulla fascia numero ' . $numeroFascia;
            $textHtml = creaFasciaWidget($numeroFascia, $textHtml);
            break;
        default:
            $messaggio .= 'sconosciuta, controllare';
            $textHtml = $tipologiaFascia;
            break;
        case 'rss':
            $messaggio .= 'RSS;per modificarla accedere a gestisci la grafica del sito e agire sulla fascia numero ' . $numeroFascia;
            $textHtml = creaFasciaRss($numeroFascia, $textHtml);
            break;
        case 'lista-categoria':
            $messaggio .= 'Archivio Categoria;per modificarla accedere a gestisci la grafica del sito e agire sulla fascia numero ' . $numeroFascia;
            $textHtml = creaFasciaListaCategoria($numeroFascia, $textHtml);
            break;
        case 'video-youtube':
            $messaggio .= 'Video Youtube;per modificarla accedere a gestisci la grafica del sito e agire sulla fascia numero ' . $numeroFascia;
            $textHtml .= "\n\t\t\t" . '<div class="row">';
            if ( madisoft_get_theme_option('madisoft_scuola_home_fascia' . $numeroFascia . '_url-youtube', '') != '') {
                $textHtml = creaFasciaVideoYoutube($numeroFascia, $textHtml);
            }
            $textHtml .= "\n\t\t\t" . '</div>';
            break;
        case 'text':
            $messaggio .= 'Testo e immagini;per modificarla accedere a gestisci la grafica del sito e agire sulla fascia numero ' . $numeroFascia;
            $textHtml .= "\n\t\t\t" . '<div class="row">';
            $textHtml = creaFasciaTesto($numeroFascia, $textHtml);
            $textHtml .= "\n\t\t\t" . '</div>';
            break;
        case 'eventi':
            $messaggio .= 'Eventi;per modificarla accedere a gestisci la grafica del sito e agire sulla fascia numero ' . $numeroFascia;
            $textHtml .= "\n\t\t\t" . '<div class="row">';
            $textHtml = creaFasciaEventi($numeroFascia, $textHtml);
            $textHtml .= "\n\t\t\t" . '</div>';
            break;
        case 'fascia':
            $messaggio .= 'Contenuti predisposti; Accedere alla bacheca, quindi a sinistra in Contenuti per fascia';
            $textHtml .= "\n\t\t\t" . '<div class="row">';
            $textHtml = creaFasciaContenuto($numeroFascia, $textHtml);
            $textHtml .= "\n\t\t\t" . '</div>';
            break;
        case 'scorrimento':
            $messaggio .= 'scorrimento articoli;per modificarla accedere a gestisci la grafica del sito e agire sulla fascia numero ' . $numeroFascia;
            $textHtml = creaFasciaArticoliAScorrimento($numeroFascia, $textHtml);
            break;
    };

    $textHtml .= "\n\t" . '</div><!-- end card body -->';
    $textHtml .= "\n" . '</div><!--end fascia -->';
    $textHtml .= '</div><!-- end container-fascia -->';


    return $textHtml;
}

/**
 * @param $numeroFascia
 * @param $textHtml
 * @return string
 */
function creaFasciaCategoria($numeroFascia, $textHtml)
{
    $numeroArticoli = madisoft_get_theme_option('madisoft_scuola_home_fascia' . $numeroFascia . '_numeroarticoli', 0);
    $idCategoria = madisoft_get_theme_option('madisoft_scuola_home_fascia' . $numeroFascia . '_sceltacategoria', 0);
    $mostraContinua = (madisoft_get_theme_option('madisoft_scuola_home_fascia' . $numeroFascia . '_mostracontinua', 'on') == 'on')? true : false;
    $articoliCategoria = get_posts('numberposts=' . ($numeroArticoli + 10) . '&category=' . $idCategoria);
    $larghezza = MadisoftScuolaWidth::MADISOFT_WIDTH_ALL / madisoft_get_theme_option('madisoft_scuola_home_fascia' . $numeroFascia . '_numerocolonne', '3');
    $img = madisoft_get_theme_option('madisoft_scuola_home_fascia' . $numeroFascia . '_immaginebase', null);
    $stile = madisoft_get_theme_option('madisoft_scuola_home_fascia' . $numeroFascia . '_stileprimario', '3');
//    $stile =6;
    $catObj = get_category($idCategoria);
    $counter_articoli = 0;
    $textHtml .= "\n\t\t\t" . '<div class="row">';
    foreach ($articoliCategoria as $articolo) {
        if (!possoVisualizzareQuestoContenuto($articolo->ID) || $counter_articoli >= $numeroArticoli) {
            continue;
        }
        setup_postdata($articolo);
        $counter_articoli++;
        global $more;
        $more = 0;
        $textHtml .= madisoft_scuola_Post($stile, true, false, $articolo, false, $larghezza, $img, $mostraContinua);
        $textHtml .= inserisciSeparatoreRigaArticoliSeNecessario($counter_articoli);
    }
    $textHtml .= "\n\t\t\t" . '</div><!-- end row -->';
    $textHtml = creaLinkCategoriaFascia($numeroFascia, $textHtml, $idCategoria, $catObj);
    return $textHtml;
}

/**
 * @param $numeroFascia
 * @param $textHtml
 * @param $idCategoria
 * @param $catObj
 * @return string
 */
function creaLinkCategoriaFascia($numeroFascia, $textHtml, $idCategoria, $catObj)
{
    if (madisoft_get_theme_option('madisoft_scuola_home_fascia' . $numeroFascia . '_LinkCategoria', 'off') == 'on') {
        $textHtml = creaLinkCategoria($textHtml, $idCategoria, $catObj);
    }
    return $textHtml;
}

/**
 * @param $textHtml
 * @param $idCategoria
 * @param $catObj
 * @return string
 */
function creaLinkCategoria($textHtml, $idCategoria, $catObj)
{
    if ($catObj instanceof WP_Term) {
        $link = esc_url(get_category_link($idCategoria));
        $testo = 'Leggi tutti gli  articoli in ' . $catObj->name;
    } else {
        $link = "/" . date('Y');
        $testo = 'Leggi tutti gli articoli';
    }
    $textHtml .= '
<div class="row">
    <div class=" col-sm-' . MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' text-center" style="margin-top: 15px">
        <a class="linkTuttaCategoria btn btn-outline-primary" href="' . $link
        . '">' . $testo . '</a>
    </div>
</div>';
    return $textHtml;
}

function creaFasciaRss($numeroFascia, $textHtml)
{
    if (madisoft_get_theme_option('madisoft_scuola_home_fascia' . $numeroFascia . '_urlrss', '') == '') {
        return $textHtml;
    }
    $larghezza = MadisoftScuolaWidth::MADISOFT_WIDTH_ALL / madisoft_get_theme_option('madisoft_scuola_home_fascia' . $numeroFascia . '_numerocolonne', '3');
    $link = madisoft_get_theme_option('madisoft_scuola_home_fascia' . $numeroFascia . '_urlrss', '');
    $numero = madisoft_get_theme_option('madisoft_scuola_home_fascia' . $numeroFascia . '_numeroarticoli', 0);
    $img = madisoft_get_theme_option('madisoft_scuola_home_fascia' . $numeroFascia . '_immaginebase', getImmagineBasePerEvidenza());
    $stile = madisoft_get_theme_option('madisoft_scuola_home_fascia' . $numeroFascia . '_stileprimario', '2');
    $listaRss = get_post_from_rss($link, $numero);
    $visualizzazione = madisoft_get_theme_option('madisoft_scuola_home_fascia' . $numeroFascia . '_rssmostracome', 'categoria');
    if ($visualizzazione == 'categoria') {
        $textHtml = fasciaRssCategoriaView($textHtml, $stile, $listaRss, $larghezza, $img);
    } else {
        $textHtml = fasciaRssListCategoriaView($textHtml, $stile, $listaRss, $larghezza, $img);
    }

    return $textHtml;
}

/**
 * @param $textHtml
 * @param string $stile
 * @param array $listaRss
 * @param $larghezza
 * @param  $img
 * @return string
 */
function fasciaRssCategoriaView($textHtml, $stile, array $listaRss, $larghezza, $img)
{
    $textHtml .= "\n\t\t\t" . '<div class="row"><!-- inizio lista cat -->';
    $funzione = 'scriviArticoloStyle' . $stile;
    foreach ($listaRss as $articoloPrint) {
        $textHtml .= $funzione(
            $articoloPrint['title'], $larghezza, $img, $articoloPrint['link'], $articoloPrint['date'], $articoloPrint['dateTime'], null, true
        );
    }

    $textHtml .= "\n\t\t\t" . '</div><!-- chiudo rss cat -->';
    return $textHtml;
}
/**
 * @param $textHtml
 * @param string $stile
 * @param array $listaRss
 * @param $larghezza
 * @param  string $img
 * @return string
 */
function fasciaRssListCategoriaView($textHtml, $stile, array $listaRss, $larghezza,  $img)
{

    $textHtml .= "\n\t\t\t" . '<div class="row"><!-- inizio lista cat -->';
    if (!$img) {
        $img = getImmagineBasePerEvidenza();
    }
    $counter_articoli = 0;
    foreach ($listaRss as $articoloPrint) {
        $counter_articoli++;
        if ($counter_articoli == 1) {
            $textHtml .= '<div class="col-sm-' . MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' col-md-' . MadisoftScuolaWidth::MADISOFT_WIDTH_1_2 . '"> '. scriviArticoloStyle98($articoloPrint['title'], $larghezza, $img, $articoloPrint['link'], $articoloPrint['date'], $articoloPrint['dateTime'], null, true)  . '</div>
<div class="col-sm-' . MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' col-md-' . MadisoftScuolaWidth::MADISOFT_WIDTH_1_2 . ' row">';
        } else {
            $textHtml .= scriviArticoloStyle99($articoloPrint['title'], $larghezza, $img, $articoloPrint['link'], $articoloPrint['date'], $articoloPrint['dateTime'], null, true);
        }
    }

    $textHtml .="</div><!-- chiudi colonna2> -->";
    $textHtml .= "\n\t\t\t" . '</div><!-- fine lista -->';
    return $textHtml;
}

function creaFasciaListaCategoria($numeroFascia, $textHtml)
{

    $textHtml .= "\n\t\t\t" . '<div class="row"><!-- inizio lista cat -->';
    $numeroArticoli = madisoft_get_theme_option('madisoft_scuola_home_fascia' . $numeroFascia . '_numeroarticoli', 0);
    $idCategoria = madisoft_get_theme_option('madisoft_scuola_home_fascia' . $numeroFascia . '_sceltacategoria', 0);
    $articoliCategoria = get_posts('numberposts=' . ($numeroArticoli +10) . '&category=' . $idCategoria);
    $larghezza = MadisoftScuolaWidth::MADISOFT_WIDTH_ALL / madisoft_get_theme_option('madisoft_scuola_home_fascia' . $numeroFascia . '_numerocolonne', '3');
    $img = madisoft_get_theme_option('madisoft_scuola_home_fascia' . $numeroFascia . '_immaginebase', null);
    $catObj = get_category($idCategoria);
    $counter_articoli = 0;
    $mostraContinua = (madisoft_get_theme_option('madisoft_scuola_home_fascia' . $numeroFascia . '_mostracontinua', 'on') == 'on')? true : false;
    foreach ($articoliCategoria as $articolo) {
        if (!possoVisualizzareQuestoContenuto($articolo->ID) || $counter_articoli >= $numeroArticoli) {
            continue;
        }
        setup_postdata($articolo);
        $counter_articoli++;
        global $more;
        $more = 0;
        if ($counter_articoli ==1) {
            $textHtml .= '<div class="col-sm-' . MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' col-md-' . MadisoftScuolaWidth::MADISOFT_WIDTH_1_2 . ' no-padding-left">'
                . madisoft_scuola_Post(98, true, false, $articolo, false, $larghezza, $img, $mostraContinua)
                . '</div> <!-- end colonna 1 -->
            <div class="col-sm-' . MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' col-md-' . MadisoftScuolaWidth::MADISOFT_WIDTH_1_2 . ' row" style="padding-right: 0">';
        } else {
            $textHtml .= madisoft_scuola_Post(99, true, false, $articolo, false, $larghezza, $img, true);
        }
    }
    $textHtml .="</div><!-- chiudi colonna2> -->";
    $textHtml .= "\n\t\t\t" . '</div><!-- fine lista -->';
    $textHtml = creaLinkCategoriaFascia($numeroFascia, $textHtml, $idCategoria, $catObj);
    return $textHtml;
}

function creaFasciaVideoYoutube($numeroFascia, $textHtml)
{
    $textHtml .= '<div class="col-md-' . MadisoftScuolaWidth::MADISOFT_WIDTH_1_2 . '"></div><div class="col-md-20 container-video videoFascia' . $numeroFascia . '">
<iframe width="100%" height="315" src="' . madisoft_get_theme_option('madisoft_scuola_home_fascia' . $numeroFascia . '_url-youtube', '')
        . '" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
    return $textHtml .= '</div></div><div class="col-md-' . MadisoftScuolaWidth::MADISOFT_WIDTH_1_2 . '"></div>';
}

function creaFasciaTesto($numeroFascia, $textHtml)
{
    $textHtml .= '<div class="col-md-' . MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' container-testo testoFascia' . $numeroFascia . '" style="background-color: #ffffff">';
    $output = apply_filters( 'the_content', madisoft_get_theme_option('madisoft_scuola_home_fascia' . $numeroFascia . '_text', '') );
    $output = str_replace( ']]>', ']]&gt;', $output );
    $textHtml .= $output;
    return $textHtml .= '</div>';
}
function creaFasciaContenuto($numeroFascia, $textHtml)
{
    $postContent = madisoft_get_theme_option('madisoft_scuola_home_fascia' . $numeroFascia . '_usa_contenuto_fascia', '');
    if (!$postContent) {
        return '';
    }
    $testo = get_post($postContent);
    $textHtml .= '<div class="col-md-' . MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' container-testo testoFascia' . $numeroFascia . '" style="background-color: #ffffff">';
    $output = apply_filters( 'the_content', $testo->post_content );
    $output = str_replace( ']]>', ']]&gt;', $output );
    $textHtml .= $output;
    return $textHtml .= '</div>';
}

function creaFasciaEventi($numeroFascia, $textHtml)
{
    $textHtml .= '<div class="col-md-' . MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' container-testo testoFascia' . $numeroFascia . '" style="background-color: #ffffff">';
    $textHtml .= mostraEventiHomePage();
    return $textHtml .= '</div>';
}

function creaFasciaCalendario($numeroFascia, $textHtml)
{
    $textHtml .= '<div class="col-md-' . MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' container-testo testoFascia' . $numeroFascia . '" style="background-color: #ffffff">';
    $textHtml .= '<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://picsum.photos/id/102/200/60" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>First slide label</h5>
        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
      </div>    
    </div>
    <div class="carousel-item">
      <img src="https://picsum.photos/id/101/200/60" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>First slide label</h5>
        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="https://picsum.photos/id/100/200/60" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>First slide label</h5>
        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>';
    return $textHtml .= '</div>';
}