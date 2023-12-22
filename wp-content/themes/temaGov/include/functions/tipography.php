<?php
/**
 * @return array|string
 */
function madisoft_theme_favicon(){
    $opzioneFavicon = madisoft_get_theme_option('madisoft_scuola_favicon', '');
    if ($opzioneFavicon){
        return $opzioneFavicon;
    }

    return madisoft_scuola_get_assets_directory('img', true, 'favicon.ico');
}

/**
 * @param bool $rendiCliccabileIlTitolo
 * @param string $header
 * @param bool $show_data
 * @param $elemento
 * @param bool $data
 * @return string
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function madisoft_scuola_scrivi_titolo($rendiCliccabileIlTitolo = false, $header = '3' , $show_data = true, $elemento = null, $data = false ) {

    if (!$elemento){
	    global $post;
    } else {
	    $post = $elemento;
    }
    $titolo = madisoft_scuola_protect_title($post);
    if (!$data) {
        $data = '<span class="dataGiorno">' .get_the_time('j',    $post) . '</span> '
        . '<span class="dataMese">' .get_the_time('F',    $post) . '</span> '
        . '<span class="dataAnno">' .get_the_time('Y',    $post) . '</span> ';
    }
    $sottotitolo = get_post_meta($post->ID, '_sottotitolo', true);
    return madisoft_scuola_scrivi_titolo_int($titolo, $sottotitolo, get_the_permalink($post), $rendiCliccabileIlTitolo, $header, $show_data, $data);
}

/**
 * @param $titolo
 * @param $sottotitolo
 * @param $permalink
 * @param bool $rendiCliccabileIlTitolo
 * @param string $header
 * @param bool $show_data
 * @param string $data
 * @return string
 */
function madisoft_scuola_scrivi_titolo_int($titolo, $sottotitolo, $permalink, $rendiCliccabileIlTitolo = false, $header = '3' , $show_data = true, $data = '' ) {

    $headerSottotitolo = 'h' . ( intval( $header ) + 1 );

    $testoHtml = '';;
    if ( possoMostrareLaData($show_data) || $titolo ) {
        $testoHtml .= '<header>' . "\n\t";
        if (possoMostrareLaData($show_data) ) {
            $testoHtml .= '<h' . $header . ' class="header-titolo-articolo">'. "\n\t"
                .'<span class="dataArticolo"><span class="fa fa-clock" aria-hidden="true"></span>&nbsp;&nbsp;';
            $testoHtml .= $data;
            $testoHtml .=  '</span> ';
        } else {
            $testoHtml .= '<h' . $header . ' class="postTitle">';
        }
        if ($rendiCliccabileIlTitolo && $titolo) {
            $testoHtml .= '<span class="titolo"><a href="';
            $testoHtml .= $permalink;
            $testoHtml .= '" class="postTitle" title="' . $titolo . '">';
            $testoHtml .= $titolo;
            $testoHtml .= '</a></span>';
        } else {
            $testoHtml .= '<span class="titolo">' . $titolo . '</span>';
        }
        $testoHtml .= '</h' . $header . '><div style="clear:both"></div>';
        $testoHtml .= madisoft_scuola_scrivi_titolo_divisore();
        $testoHtml .= madisoft_scuola_scrivi_sottotitolo_int($headerSottotitolo, $sottotitolo);
        $testoHtml .= "\n\t" . '</header>'. "\n\t";
    }
    return $testoHtml;
}

/**
 * @param $show_data
 * @return bool
 */
function possoMostrareLaData($show_data)
{
    return (madisoft_get_theme_option('madisoft_scuola_mostra_data_nei_post', 'on') == 'on' && $show_data);
}

/**
 * @return bool
 */
function madisoft_scuola_scrivi_titolo_divisore(){
	if (madisoft_get_theme_option('madisoft_scuola_usa_divisore', 'off') == 'off'){
		return false;
	}
	return '<div class="title-divisor">&nbsp;</div>';
}

/**
 * @param $headerSottotitolo
 * @param $elemento
 * @return string
 */
function madisoft_scuola_scrivi_sottotitolo($headerSottotitolo, $elemento = false){
    if (!$elemento){
        global $post;
    } else {
        $post = $elemento;
    }
    $sottotitolo = get_post_meta($post->ID, '_sottotitolo', true);
    return madisoft_scuola_scrivi_sottotitolo_int($headerSottotitolo, $sottotitolo);
    }

 function madisoft_scuola_scrivi_sottotitolo_int($headerSottotitolo, $sottotitolo) {
    if (madisoft_get_theme_option('madisoft_scuola_usa_sottotitolo', 'off') == 'on') {
        if ($sottotitolo != '') {
            return '<' . $headerSottotitolo . ' class="subtitle">' . $sottotitolo . '</' . $headerSottotitolo . '>';
        }
    }
}

/**
 * @param string $titolo
 * @return string
 */
function madisoft_scuola_get_testo_per_continua_a_leggere($titolo = '') {
    if ($titolo == ''){
        $titolo = get_the_title();
    }
	return stripslashes( madisoft_get_theme_option( 'madisoft_scuola_testo_per_continua_a_leggere', 'Continua a leggere...' ) ) . '<span class="screen-reader-text">' . $titolo.'</span>';
}

/**
 * @param bool $rendiCliccabileIlTItolo
 * @param bool $mostraIlContenuto
 * @param bool $elemento
 * @param bool $soloIlTitolo
 * @return string
 */
function madisoft_scuola_Post($style = 2, $rendiCliccabileIlTItolo = false, $mostraIlContenuto = true , $elemento = false, $soloIlTitolo = false, $larghezza = '', $imgBase = '', $mostraContinua = true, $colore = '')
{
    if (!$elemento) {
        global $post;
    } else {
        $post = $elemento;
    }
    $textHtml = '';
    setup_postdata($post);
    if(possoVisualizzareQuestoContenuto($post->ID)){
        $titolo =  madisoft_scuola_protect_title($post);
        $permalink = get_the_permalink($post);
        if (!$larghezza) {
            $larghezza = calcolaDimensioneColonneArticoli();
        }
		if ($style == 98 || ($style==2 && $larghezza == '12')) {
			$dimensione = 'large';
		} else {
			$dimensione = 'medium';
		}
        $immagine = madisoft_scuola_get_immagine_in_evidenza($post, $imgBase, $dimensione);
        if (!$immagine && $imgBase) {
            $immagine = $imgBase;
        }
        $data = '<span class="dataGiorno">' .get_the_time('j',    $post) . '</span> '
                . '<span class="dataMese">' .get_the_time('F',    $post) . '</span> '
                . '<span class="dataAnno">' .get_the_time('Y',    $post) . '</span> ';
        $dataTime = get_post_time('U',true,  $post);
        $function = 'scriviArticoloStyle' . $style;
        $textHtml.= $function($titolo, $larghezza, $immagine, $permalink, $data, $dataTime, $post, $mostraContinua, $colore);
    }

    return $textHtml;
}

/**
 * @param $dataTime
 * @return string
 */
function getLastAccessClass($dataTime)
{
    global $madisoftTheme;
    $timeStart = $madisoftTheme->getGlobalVar('lastaccessClass', time()-300);
    if ($dataTime > $timeStart && ($dataTime-$timeStart <=(86400*30))) {
        return ' newPost';
    }

    return ' ' . abs($dataTime-$timeStart);
}


/**
 * la funzione stampa a video i dati da inserirsi nella testata o nel piede della pagina,
 * a seconda della posizione richiesta
 * @param $posizione (header|footer)
 * @return string
 */
function madisoft_scuola_print_dati_istituto_in_pagina($posizione)
{
    $textHtml = '';
    if ($posizione == 'header') {
        $opzione_mostra    = 'madisoft_scuola_testata_mostra_dati_istituto';
        $opzione           = 'madisoft_scuola_testata_testo_per_dati_istituto';
        $id_del_div        = 'testataDatiIstituto';
    } else {
        $opzione_mostra    = 'madisoft_scuola_pie_di_pagina_mostra_dati_istituto';
        $opzione           = 'madisoft_scuola_pie_di_pagina_testo_per_dati_istituto';
        $id_del_div        = 'pieDiPaginaDatiIstituto';
    }
    if ( madisoft_get_theme_option( $opzione_mostra, '0' ) == 'on' ) {
        /** @var  $datiClasse MadisoftDatiIstituto */
        $datiClasse = madisoft_get_theme_class()->getGlobalVar('datiIstitutoClass');
        $textHtml = "\n"
            .'<div id="' . $id_del_div . '">'. "\n"
            . $datiClasse->getDatiPerTestata( madisoft_get_theme_option( $opzione, '' ) ) . "\n"
            . '</div>';
    }

    return $textHtml;
}

/**
 * @param bool $getClassAttribute
 *
 * @return string
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function madisoft_scuola_get_class_fixed( $getClassAttribute = true ) {
	$class = '';
	if ( madisoft_get_theme_option( 'madisoft_scuola_testata_template', 1 ) == 2
        && madisoft_get_theme_option( 'madisoft_scuola_testata_fixed_topbar', 0 ) == 1 ) {
		$class = 'fixed_top';
	}

	if ( $getClassAttribute ) {
		$class = ' class="' . $class . '"';
	}

	return $class;
}


/**
 * @return string
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function madisoft_scuola_get_immagine_header( $screen = 'all' ) {
	$immagine = madisoft_get_theme_option( 'madisoft_scuola_testata_immagine', "" );

	if ( get_post_type() == 'page' && get_post_thumbnail_id() ) {
		$immagine = madisoft_scuola_get_immagine_in_evidenza();
	}

	return $immagine;
}

/**
 * @return string
 */
function madisoft_scuola_get_immagine_in_evidenza($articolo = false, $img_base = '', $dimensione = 'medium') {
	if (!$dimensione) {
		$dimensione = 'medium';
	}
    if (!$articolo){
        global $post;
    } else {
        $post = $articolo;
    }
	$immagine = '';

	if ( get_post_thumbnail_id($post) ) {
		$immagine = wp_get_attachment_image_url( get_post_thumbnail_id($post), $dimensione);
	}

	if (!$img_base) {
        $img_base = getImmagineBasePerEvidenza();
    }

	if (!$immagine) {
        /** @var WP_Term $term */
        $term = get_the_category($post->ID);
        if (!isset($term[0])) {
            $meta = get_option("category_" . get_option('default_category', true));
        } else {
            $term = $term[0];
            $meta = get_option("category_" . $term->term_id);
        }
            if (!is_array($meta)) {
                $meta = [];
            }
            if (isset($meta['img'])) {
                $immagine = $meta['img'];
            }

    }

	if (!$immagine) {
            $immagine = $img_base;
    }

	return $immagine;
}

/**
 * @param bool $creaLaSezione
 * @return bool
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function mostraArticoliInEvidenza($creaLaSezione = false){
    $postInEvidenza = getPostInEvidenza();

    $textHtml = '';

    if (!LOpzioneUsaPostInEvidenzaEAttiva() || !count($postInEvidenza  )){
        return false;
    }

    $textHtml .= '<div class="row box_evidenza">
                <div class="col-xs-'. MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' col-sm-'. MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . '">';
    $textHtml .= '<section class="articoli_categoria_evidenza">';
    $textHtml .= evidenzaMostraLImmagine();
    $textHtml .= evidenzaMostraIlTitoloSezione();

    $counter_articoli = 0;
    foreach ( $postInEvidenza as $articolo ) {
        if ($counter_articoli >= evidenzaGetNumeroDiArticoli()){
            continue;
        }
        $more = 0;
        setup_postdata( $articolo );
        global $more;
        $textHtml .= madisoft_scuola_Post( 2, true, true, $articolo);
       $counter_articoli++;
    }
    $textHtml .= '</section>';
    $textHtml .= '</div>
            </div>';
    $textHtml .= mostraDivisoreSezioneSeRichiesto();

    return $textHtml;

}

/**
 * @param $categoriaArray array
 *
 * @return bool
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function mostraArticoliDellaCategoria ($categoriaArray, $mostraIlContenuto = true, $mostraLinkNavigazione = true){
    $textHtml = '';
    if (isset($categoriaArray['navlink'])){
        $mostraLinkNavigazione = $categoriaArray['navlink'];
    }
    if (!isset($categoriaArray['solo_titolo'])){
        $categoriaArray['solo_titolo'] = 'off';
    }
    ($categoriaArray['solo_titolo'] == 'off')? $soloTitolo = false: $soloTitolo = true;
    if (  ( $categoriaArray['id'] ) && $categoriaArray['numArt'] > 0 ) {
		$articoliCategoria = get_posts( 'numberposts=' . $categoriaArray['numArt'] . '&category=' . $categoriaArray['id'] );
		$catObj            = get_category( $categoriaArray['id'] );

		if ( !count( $articoliCategoria ) ){
			return false;
		}

        $textHtml .= '<section class="articoli_categoria_' . $categoriaArray['class']. '">';
		if ( $categoriaArray['img'] ) {
            $textHtml .='<div class="box_immagine_articoli">
				<img class="immagine_articoli" src="'. $categoriaArray['img']
                . '" alt="immagine per la categoria '. $categoriaArray['titolo'] . '"/>
			</div>';
		}
		if ( $categoriaArray['titolo'] && ( $categoriaArray['titolo_si'] == '1' || $categoriaArray['titolo_si'] == 'on') ) {
				$textHtml .= '<h2 class="homeTitleCategorie">
			    		<a href="/category/' . $catObj->slug . '/" title="Clicca qui per visualizzare tutti gli articoli">'
    . $categoriaArray['titolo'] . '</a>
				</h2><div class="container"><div class="row">'; }

		$counter_articoli = 0;
		foreach ( $articoliCategoria as $articolo ) {
			setup_postdata( $articolo );
			if ( madisoft_theme_check_if_in_evidenza( $articolo ) ) {
				continue;
			}
            $counter_articoli++;
            global $more;
            $more = 0;
            $textHtml .= madisoft_scuola_Post( 2,true, $mostraIlContenuto, $articolo , $soloTitolo);
            $textHtml .= inserisciSeparatoreRigaArticoliSeNecessario($counter_articoli);
        }
        if ($mostraLinkNavigazione){
            $textHtml .= "\n" . '<div style="clear:both"></div>';
            $textHtml .= '<div class="alignright"><a href="' . esc_url( get_category_link( $categoriaArray['id'] ) ) . '&paged=2">Altri articoli in ' . $catObj->name . '</a></div>';
        }
		if ($counter_articoli) {
            $textHtml .= '</div></div></section><!-- categoria ' . $categoriaArray['class'] . '	 -->';

            $textHtml .= mostraDivisoreSezioneSeRichiesto();
        }
	}
    return $textHtml ;
}

/**
 * @param $counter_articoli
 * @return string
 */
function inserisciSeparatoreRigaArticoliSeNecessario($counter_articoli)
{
    $textHtml = '';
    if (madisoft_get_theme_option('madisoft_scuola_numero_colonne_articoli', 1) > 1
        && $counter_articoli > 1
        && ($counter_articoli % (madisoft_get_theme_option('madisoft_scuola_numero_colonne_articoli', 1)) == 0)) {
        $textHtml .= "\n" . '<div style="clear:both"></div>';
    }

    return $textHtml;
}

/**
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function mostraDivisoreSezioneSeRichiesto()
{
    $textHtml = '';
    if ( madisoft_get_theme_option('madisoft_scuola_home_categoria_mostra_divisore', 'off') == 'on' ){
        $textHtml .='<div class="divisoreSezione">&nbsp;</div>';
    }

    return $textHtml;
}

/**
 * @param $isMostraEventi
 * @param $eventiNumArticoli
 * @param $eventiTitolo
 */
function mostraEventiHomePage( $eventiNumArticoli = 5) {
    $textHtml = '';
	if ( $eventiNumArticoli > 0 ) {
		if ( function_exists( 'em_get_events' ) ) {
			if (mostraEventiComeArticoli()){
                    $textHtml .= stampEventi();
                } else {
                    $args = [
                            'limit' => $eventiNumArticoli
                    ];
                    $textHtml .=  em_get_events($args);
                }
		}

	}
	return $textHtml;
}

/**
 *
 */
function madisoft_theme_home_page_content(){
	get_template_part('include/templates/home-page');
}

/**
 * @return bool
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function possoUsareLImmagineInEvidenza(){
    return ( madisoft_get_theme_option('madisoft_scuola_mostra_immagine_in_evidenza', 'off') == 'on' );
}

/**
 * @param $slides
 * @param bool $usaImmagineInEvidenza
 * @param string $class
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function creaSliderDiv($slides, $usaImmagineInEvidenza = true, $class = 'flexslider'){
    if ( !($usaImmagineInEvidenza && intestazionePersonalizzataPossoUtilizzarla()) ){
        $usaImmagineInEvidenza = false;
    }
    ?>
    <div class="row-fluid text-center">
        <section class="slider">
            <div class="<?php echo $class; ?>">
                <ul class="slides">
                    <?php
                    $immagineInEvidenzaPagina = madisoft_scuola_get_immagine_per_intestazione_personalizzata();
                    if ( $immagineInEvidenzaPagina && $usaImmagineInEvidenza ) {
                        echo "\n" . '<li>' . "\n";
                        $img = '<img style="display:none;" src="' . $immagineInEvidenzaPagina . '"  class="img_slide" alt="immagine personalizzata della pagina"/>';
                        echo "\t" . $img . "\n";
                        echo '</li>' . "\n";
                    }
                    foreach ( $slides as $slide ) {
                        echo "\n" . '<li>' . "\n";
                        $title = ' title="' . ( $slide['title'] ? $slide['title'] : "immagine intestazione" ) . '"';
                        $alt   = ' alt="' . ( $slide['description'] ? $slide['description'] : "immagine intestazione" ) . '"';
                        $img = '<img style="display:none;"' . $title . $alt . ' src="' . $slide['image'] . '"  class="img_slide"/>';
                        if ( $slide['link'] ) {
                            echo "\t" . '<a href="' . $slide['link'] . '" target="_blank">' . $img . '</a>';
                        } else {
                            echo "\t" . $img . "\n";
                        }
			if ($class == 'flexslider-intro' && madisoft_get_theme_option('page_intro_fascia_immagini_text', 'off') == 'on' && $slide['title'] ) {
                            echo "\t" . '<p class="flex-caption" style="margin-bottom: -38px">' . $slide['title'] . '</p>';
                        }
                        echo '</li>' . "\n";
                    }
                    ?>
                </ul>
            </div>
        </section>
    </div>
    <?php
}

/**
 * @param $idDivMenu
 * @param $menu
 * @param $themeLocation
 */
function madisoftThemeCreaMenu($idDivMenu, $menu, $themeLocation, $creaBoostrap = true, $linkMobile = false) {
    //TODO rimuovere opzione menu non bootstrap
    if ($creaBoostrap) {
        madisoftCreaMenuBootstrap($idDivMenu, $menu, $themeLocation, $linkMobile);
    } else {
        madisoftCreaMenuMobile($idDivMenu, $menu, $themeLocation);
    }

}
function madisoft_get_immagine_per_menu()
{
    return madisoft_get_theme_option('madisoft_scuola_dati_logo', madisoft_theme_favicon());
}

/**
 * @param $themeLocation
 * @return string
 */
function getImmagineEvidenzaSeMenuPrincipale($themeLocation)
{
    if ($themeLocation == 'menu-2' && madisoft_get_immagine_per_menu()) {
        return '<a class="navbar-brand" href="' . get_option('home', true) . '" aria-hidden="true">
                <img src="'. madisoft_get_immagine_per_menu().'"  alt="logo dell\'Istituto" width="30" height="30">
            </a>';
    }

    return '';
}

/**
 * @param $idDivMenu
 * @param $menu
 * @param $themeLocation
 */
    function madisoftCreaMenuMobile($idDivMenu, $menu, $themeLocation){
        $idDivMenu .= '-mobile';
        ?>
            <div id="<?php echo $idDivMenu; ?>-c" class="<?php echo $idDivMenu; ?>">
                <a href="javascript:void(0)" class="closeButton" onclick="closeNav('solomobile')">&times;</a>
                <!-- Brand and toggle get grouped for better mobile display -->
                <?php
                $menu_principale = [
                    'menu'              => $menu,
                    'theme_location'    => $themeLocation,
                    'depth'             => 2,
                    'container'         => 'div',
                    'container_class'   => '',
                    'container_id'      => $idDivMenu,
                    'menu_class'        => ''
                ];
                wp_nav_menu($menu_principale);
                ?>
            </div>
        <?php
}
/**
 * @param $idDivMenu
 * @param $menu
 * @param $themeLocation
 * @param string $addClass
 */
    function madisoftCreaMenuBootstrap($idDivMenu, $menu, $themeLocation, $linkMobile = false){
        $classPosition = ($menu == 'menu-3')? 'mr-sm-0 ml-auto' : 'mr-auto';
        ?>
        <nav class="navbar navbar-expand-lg <?php echo $idDivMenu; ?>-nav justify-content-between" role="menubar">
           <?php
            echo getImmagineEvidenzaSeMenuPrincipale($themeLocation);
            if ($linkMobile) {
                ?>
                    <script>
                        function openNav(id) {
                            document.getElementById(id).style.width = '100%';
                        }
                        function closeNav(id) {
                            document.getElementById(id).style.width = '0';
                        }
                    </script>
                <button  style="color: #fff" class="navbar-toggler" type="button" onclick="openNav('solomobile');">
                    <span class="navbar-toggler-icon"><span class="fa fa-bars"></span></span>
					<?php echo madisoft_get_theme_option('madisoft_scuola_menu_nome_menu1', '');?>
                </button>
                    <?php
            } else {
               ?>
                <button style="color: #fff" title="mostra menu di navigazione" class="navbar-toggler " type="button" data-toggle="collapse" data-target="#<?php echo $idDivMenu ?>-container" aria-controls="<?php echo $idDivMenu ?>-container" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"><span class="fa fa-bars"></span></span>
			
                </button>
                    <?php
            }

        if (ottieniClasseNoPaddingLeft()) {
            $larghezzaSidebar = madisoft_scuola_get_larghezza('left');
        ?>
        <script>
                var positionX = 0;
            function showMe(id) {
                if (jQuery('#'+id).hasClass('d-none')) {
                    positionX = jQuery(window).scrollTop();
                    jQuery('#contenuto-centrale').hide();
                    jQuery('#rightsidebar').hide();
                    jQuery('#footer').hide();
                    jQuery('#header').hide();
                    jQuery('#'+id).removeClass('d-none col-sm-<?php echo $larghezzaSidebar; ?> d-md-block').addClass('col-24');
                    jQuery('html, body').scrollTop(60);
                } else {
                    jQuery('#'+id).removeClass('col-24').addClass('d-none col-sm-<?php echo $larghezzaSidebar; ?> d-md-block');
                    jQuery('#contenuto-centrale').show();
                    jQuery('#rightsidebar').show();
                    jQuery('#footer').show();
                    jQuery('#header').show();
                    jQuery('html, body').animate({scrollTop: (positionX)}, 10);
                }
            }

        </script>
        <?php
    }
            $classeMenu = "container-fluid";
            if ($menu == 'menu-2'
                && madisoft_get_theme_option('madisoft_scuola_menu_center', 'off') == 'on') {
                $classeMenu = "mx-auto";
            }
            ?>
			<?php
			if ($menu == 'menu-2' && madisoft_scuola_get_larghezza('left') > 0 
			&& ((is_front_page() &&  madisoft_get_theme_option('madisoft_scuola_home_sidebar_mostra', 'off') == 'on')
			|| (!is_front_page())
			)) {
				?>
				<button class="navbar-toggler" type="button" onclick="showMe('leftsidebar');" title="Mostra barra laterale">
            <span class="navbar-toggler-icon" style="color: #fff"><?php echo madisoft_get_theme_option('madisoft_scuola_menu_nome_menu2', 'Men&ugrave; laterale')?></span>
        </button>
				<?php
			}
			?>
            <div class="<?php echo $classeMenu; ?> <?php echo $idDivMenu; ?>-container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <?php
                $menu_principale = [
                    'menu'              => $menu,
                    'theme_location'    => $themeLocation,
                    'depth'             => 2,
                    'container'         => 'div',
                    'container_class'   => 'collapse navbar-collapse',
                    'container_id'      => $idDivMenu . '-container',
                    'menu_class'        => 'navbar-nav ' . $classPosition,
                    'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                    'walker'            => new WP_Bootstrap_Navwalker(),
                ];
                wp_nav_menu($menu_principale);
                ?>
            </div>
        </nav>
        <?php
}
//TODO Less per i menu non bootsptrap
/**
 * @param $post
 * @return bool
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function possoMostrareIMetaDati($post){

        if( !possoVisualizzareQuestoContenuto( $post->ID ) ) {
            return false;
        }
    return (madisoft_get_theme_option('madisoft_scuola_mostra_meta', 'off') == 'on') && (
            possoMostrareLaDataDellArticolo() ||
            possoMostrareLAutoreDellArticolo() ||
            possoMostrareLeCategorieDellArticolo()
        );
}

/**
 * @param $post
 * @return bool
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function possoMostrareIMetaDatiDellaPagina($post){

        if( !possoVisualizzareQuestoContenuto( $post->ID ) ) {
            return false;
        }
    return (madisoft_get_theme_option('madisoft_scuola_mostra_meta_pagina', 'off') == 'on') && (
            possoMostrareLaDataDellaPagina() ||
            possoMostrareLAutoreDellaPagina()
        );
}

/**
 * @return bool
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function possoMostrareLaDataDellArticolo(){
         return madisoft_get_theme_option('madisoft_scuola_mostra_meta_data', 'on') == 'on';
}

/**
 * @return bool
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function possoMostrareLaDataDellapagina(){
         return madisoft_get_theme_option('madisoft_scuola_mostra_meta_data_pagina', 'off') == 'on';
}

/**
 * @return bool
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function possoMostrareLAutoreDellArticolo(){
         return madisoft_get_theme_option('madisoft_scuola_mostra_meta_autore', 'off') == 'on';
}

/**
 * @return bool
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function possoMostrareLAutoreDellaPagina(){
         return madisoft_get_theme_option('madisoft_scuola_mostra_meta_autore_pagina', 'off') == 'on';
}

/**
 * @return bool
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function possoMostrareLeCategorieDellArticolo(){
         return madisoft_get_theme_option('madisoft_scuola_mostra_meta_categorie', 'on') == 'on';
}

/**
 * @param $post WP_Post
 * @return string
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function madisoft_scuola_mostra_meta($post){

    if ( !possoMostrareIMetaDati($post) ) {
        return '';
    }
	if (is_front_page() && (madisoft_get_theme_option('madisoft_scuola_mostra_meta_data_home', 'off') == 'off')) {
		return '';
	}
    $textHtml  = '';
    $textHtml .= '<p class="postmeta">' . "\n\t";
    $textHtml .= 'Pubblicato';

        if (possoMostrareLAutoreDellArticolo()) {
            $autoreArticolo = get_user_by('ID', $post->post_author);
            $textHtml .= ' <span class="AutoreArticoloMeta"> da ' . $autoreArticolo->display_name . '</span>';
        }

    if (possoMostrareLaDataDellArticolo()) {
        $textHtml .= '<span class="dataArticoloMeta">';
        if (possoMostrareLOrario()) {
            $textHtml .= ' alle ' . get_the_date(madisoft_get_theme_option('madisoft_scuola_formato_data_orario', 'H:i'), $post->ID ) . ' di ';
            } else {
            $textHtml .= ' '
                    . madisoft_get_theme_option('madisoft_scuola_prefix_data_metadata', 'di')
                    . ' ';
            }
        $textHtml .=  get_the_date( madisoft_get_theme_option('madisoft_scuola_formato_data_metadata', 'l j F Y'), $post->ID );
        $textHtml .= '</span>';
   }
        if (possoMostrareLeCategorieDellArticolo()) { ?>

            <?php if ( ! is_page() ) {
                $textHtml .= ' in ' . get_the_category_list( ', ' );
            $posttags = get_the_tags( $post->ID );
            if ( $posttags ) {
                $textHtml .=' <span>- Tag:</span>';
                foreach ( $posttags as $tag ) {
                    $textHtml .= '<a href="';
                    $textHtml .= get_tag_link( $tag );
                    $textHtml .= '">';
                    $textHtml .= $tag->name . '';
                    $textHtml .= '</a> ';
                }
            }

            }
        }
        if (get_edit_post_link( $post->ID, ' edit')) {
            $textHtml .= ' <a href="'. get_edit_post_link( $post->ID, ' edit') .'">Modifica</a>';
        }
    $textHtml .= '</p>';

    echo $textHtml;
}

/**
 * @param $post WP_Post
 * @return string
 */
function madisoft_scuola_mostra_meta_pagina($post){
    if ( !possoMostrareIMetaDatidellaPagina($post) ) {
        return '';
    }
    ?>
    <p class="postmeta">
        Pubblicato
        <?php
		$current_user = wp_get_current_user();
        if (possoMostrareLAutoreDellaPagina()) { ?>
            <span class="AutoreArticoloMeta updated"> da <?php echo the_author_meta( 'nickname', $current_user->ID ); ?></span>
            <?php
        }

        if (possoMostrareLaDataDellapagina()) { ?>
            <span class="dataArticoloMeta"> il <?php $post->date; the_time( 'l j F Y' ); ?> <?php _e( 'alle' ); ?> <?php the_time() ?></span>
        <?php }

        edit_post_link( __( 'Edit' ), ' &#183; ', '' ); ?>
    </p>
    <?php
}

/**
 * @param bool $elemento
 * @return string
 */
function madisoft_scuola_protect_title($elemento = false) {
    if (!$elemento){
        global $post;
    } else {
        $post = $elemento;
    };
    $title = get_the_title($post->ID);

    if (possoVisualizzareQuestoContenuto($post->ID)){
        return $title;
    } else {
        return 'Post a contenuto riservato';
    }
}

/**
 * @return float|int
 */
function calcolaDimensioneColonneArticoli(){
    return ( MadisoftScuolaWidth::MADISOFT_WIDTH_ALL/madisoft_get_theme_option('madisoft_scuola_numero_colonne_articoli', 1) );
}

/**
 * @return string
 */
function nomeClassePostPreview(){
    if ( madisoft_get_theme_option('madisoft_scuola_mostra_bordo_inferiore_articoli', 'off') == 'on'){
        return 'post_preview_borded';
    } else {
        return 'post_preview';
    }
}

/**
 * @return bool
 */
function madsoft_scuola_get_logo(){
    if (madisoft_get_theme_option( 'madisoft_scuola_dati_logo' , 'off') == 'off'
        || madisoft_get_theme_option('madisoft_scuola_dati_mostra_logo', 'off') == 'off'
        || madisoft_get_theme_option( 'madisoft_scuola_dati_logo' , '') == '' ){
        return false;
    }
    echo "\n" .'<div class="text-center col-xs-'. MadisoftScuolaWidth::MADISOFT_WIDTH_1_6 . ' logo col-md-' . madisoft_scuola_get_larghezza('logo') . ' col-sm-' . madisoft_scuola_get_larghezza('logo') .  '">';
    echo "\n\t" . '<a href="' . get_option('home', true) . '" title="Torna alla pagina iniziale"> <img class="logo" src="'. madisoft_get_theme_option( 'madisoft_scuola_dati_logo' , '') . '" alt="logo dell\'Istituto"/></a>';
    echo "\n" .'</div>';
}

/**
 *
 */
function mostraLaBarraDelMenuFooterSeNecessario(){

    if (has_nav_menu( 'menu-3' )) {
        get_template_part('menu-footer');
    }
}

/**
 *
 */
function mostraIWidgetDelFooterSeNecessario(){
    if( is_active_sidebar('footer-widget') ){
        get_sidebar( 'footer' );
    }
}

/**
 * @return bool
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function possoMostrareIlContenutoDellArticolo(){
    return ( madisoft_get_theme_option('madisoft_scuola_content_in_categoria_collegata', 'off') == 'on' );
}

/**
 * @param null $more_link_text
 * @param bool $strip_teaser
 * @param null $elemento
 * @return mixed|null|string|string[]
 */
function madisoft_get_the_content( $more_link_text = null, $strip_teaser = false , $elemento = null) {
    global $page, $more, $preview, $pages, $multipage, $numpages;

    $_post = get_post( $elemento );

    if ( ! ( $_post instanceof WP_Post ) ) {
        return '';
    }

    // Use the globals if the $post parameter was not specified,
    // but only after they have been set up in setup_postdata().
    if ( null === $elemento && did_action( 'the_post' ) ) {
        $elements = compact( 'page', 'more', 'preview', 'pages', 'multipage' );
    } else {
        $elements = generate_postdata( $_post );
    }

    if ( null === $more_link_text ) {
        $more_link_text = sprintf(
            '<span aria-label="%1$s">%2$s</span>',
            sprintf(
            /* translators: %s: Post title. */
                __( 'Continue reading %s' ),
                the_title_attribute(
                    array(
                        'echo' => false,
                        'post' => $_post,
                    )
                )
            ),
            __( '(more&hellip;)' )
        );
    }

    $output     = '';
    $has_teaser = false;

    // If post password required and it doesn't match the cookie.
    if ( post_password_required( $_post ) ) {
        return get_the_password_form( $_post );
    }

    // If the requested page doesn't exist.
    if ( $elements['page'] > count( $elements['pages'] ) ) {
        // Give them the highest numbered page that DOES exist.
        $elements['page'] = count( $elements['pages'] );
    }
    if (count( $elements['pages'] ) > 1) {
        $multipage = true;
        $numpages = count( $elements['pages'] );
    }
    $page_no = $elements['page'];
    $content = $elements['pages'][ $page_no - 1 ];
    if ( preg_match( '/<!--more(.*?)?-->/', $content, $matches ) ) {
        if ( has_block( 'more', $content ) ) {
            // Remove the core/more block delimiters. They will be left over after $content is split up.
            $content = preg_replace( '/<!-- \/?wp:more(.*?) -->/', '', $content );
        }

        $content = explode( $matches[0], $content, 2 );

        if ( ! empty( $matches[1] ) && ! empty( $more_link_text ) ) {
            $more_link_text = strip_tags( wp_kses_no_null( trim( $matches[1] ) ) );
        }

        $has_teaser = true;
    } else {
        $content = array( $content );
    }

    if ( false !== strpos( $_post->post_content, '<!--noteaser-->' ) && ( ! $elements['multipage'] || 1 == $elements['page'] ) ) {
        $strip_teaser = true;
    }

    $teaser = $content[0];

    if ( $elements['more'] && $strip_teaser && $has_teaser ) {
        $teaser = '';
    }

    $output .= $teaser;
    if (!is_array($content)) {
        return '';
    }
    if ( count( $content ) > 1 ) {
        if ( $elements['more'] ) {
            $output .= '<span id="more-' . $_post->ID . '"></span>' . $content[1];
        } else {
            if ( ! empty( $more_link_text ) ) {

                /**
                 * Filters the Read More link text.
                 *
                 * @since 2.8.0
                 *
                 * @param string $more_link_element Read More link element.
                 * @param string $more_link_text    Read More text.
                 */
                $output .= apply_filters( 'the_content_more_link', ' <a href="' . get_permalink( $_post ) . "#more-{$_post->ID}\" class=\"more-link\">$more_link_text</a>", $more_link_text );
            }
            $output = force_balance_tags( $output );
        }
    }
    if ( $preview ) // Preview fix for JavaScript bug with foreign languages.
	{$output =	preg_replace_callback( '/\%u([0-9A-F]{4})/', '_convert_urlencoded_to_entities', $output );}
	if (!$output) {
		$output = '<!-- wp:tadv/classic-paragraph /-->';
	}
    $output = apply_filters( 'the_content', $output );
    $output = str_replace( ']]>', ']]&gt;', $output );
    return $output;
}

if (!function_exists('_convert_urlencoded_to_entities')) {
    function _convert_urlencoded_to_entities( $match ) {
        return '&#' . base_convert( $match[1], 16, 10 ) . ';';
    }
}

/**
 * @param null $more_link_text
 * @param bool $strip_teaser
 * @param null $elemento
 */
function madisoft_the_content( $more_link_text = null, $strip_teaser = false, $elemento = null) {
    if (!$elemento){
        global $post;
    } else {
        $post = $elemento;
    };
    $content = madisoft_get_the_content( $more_link_text, $strip_teaser, $post );

    /**
     * Filter the post content.
     *
     * @since 0.71
     *
     * @param string $content Content of the current post.
     */
    return $content;
}

/**
 * @param bool $elemento WP_Post
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function madisoft_scuola_Pagina ($elemento = false){
    if (!$elemento){
        global $post;
    } else {
        $post = $elemento;
    };
    ?>
    <article>
    <div class="post" id="post-<?php echo $post->ID; ?>">
                            <?php
                            if (!is_front_page() && madisoftThemePluginOpzioniPagine::checkIfOptionIsActive('page_show_titolo', 1) ) {
                            echo madisoft_scuola_scrivi_titolo( '', '2', false, $post );
                            }
                            madisoft_scuola_mostra_meta_pagina($post);
                            ?>
        <div class="postentry page">
            <?php
            if ( is_search() ){
                the_excerpt();
            } else {
                mostraPulsanteStampaSePossibile();
                echo madisoft_the_content( null, false, $post );
                $defaults = array(
                    'before'           => '<div style="clear:both"></div><div class="alignright"><p>' . __( 'Pages:' ),
                    'after'            => '</p></div><div style="clear:both"></div>',
                    'link_before'      => '',
                    'link_after'       => '',
                    'next_or_number'   => 'number',
                    'separator'        => ' ',
                    'nextpagelink'     => __( 'Next page' ),
                    'previouspagelink' => __( 'Previous page' ),
                    'pagelink'         => '%',
                    'echo'             => 1
                );
                    wp_link_pages($defaults);
            } ?>
        </div>
    </div>
    </article>
<?php
}

/**
 * @param $categoriaId
 * @param string $title
 * @param int $numLoop
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function madisoftLoopCategoriaCollegata($categoriaId, $title = '', $numLoop = 10){

    $categoriaArray = [
        'img'       => null,
        'id'        => $categoriaId,
        'numArt'    => madisoft_get_theme_option('madisoft_scuola_categoria_collegata_numero_articoli', 10),
        'titolo_si' => madisoft_get_theme_option('madisoft_scuola_categoria_collegata_titolo_mostra', 'on'),
        'titolo'    => $title,
        'solo_titolo' =>'off',
        'class'     => 'category',
    ];
    $mostraIlContenuto = madisoft_get_theme_option('madisoft_scuola_content_in_categoria_collegata', 'off') == 'on';
    $mostraLinkNavigazione = madisoft_get_theme_option('madisoft_scuola_categoria_collegata_nav_link', 'on') == 'on';

    return mostraArticoliDellaCategoria($categoriaArray, $mostraIlContenuto, $mostraLinkNavigazione)
        ;
}

/**
 *
 */
function mostraPulsanteStampaSePossibile(){
    $textHtml = '';
    if (!is_front_page() && function_exists( 'pf_show_link' ) ) {
        $textHtml .= pf_show_link();
        $textHtml .= '<div style="clear:both"></div>';
    }
}

/**
 * @return bool
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function mostraTestoCompletoArticoloInCategorie(){
    return ( madisoft_get_theme_option('madisoft_scuola_content_in_categoria', 'on') == 'on');
}

/**
 * @param bool $rendiCliccabileIlTItolo
 * @param bool $mostraIlContenuto
 * @return string
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function stampEventi($rendiCliccabileIlTItolo= true, $mostraIlContenuto= true ){
    $rendiCliccabileIlTItolo = rendiCliccabileIlTitoloDegliEventi();
    $args                 = [
        'post_type'     => 'event',
        'meta_query'    => [ ],
    ];
    $inizioRicerca = strtotime(date('d-m-Y'));
    $args['meta_query'][] = array(
        'key'     => '_end_ts',
        'value'   => $inizioRicerca,
        'compare' => '>=',
        'order'   => 'ASC',
        'orderby' => '_start_ts',
        'numberposts' =>  madisoft_get_theme_option( 'madisoft_scuola_home_eventi_numero', 0 )
    );
    $querys               = new WP_Query( $args );
    $eventi = [];
    foreach ($querys->posts as $eventoDaOrdinare) {
        /** @var $eventoDaOrdinare WP_Post */
        $timestampEvento = get_post_meta($eventoDaOrdinare->ID, '_start_ts', true);
        if (isset($eventi[$timestampEvento])) {
            $eventi[$timestampEvento] = [];
        }
        $eventi[$timestampEvento][] = $eventoDaOrdinare;
    }
    ksort($eventi);
    $textHtml = '';
    foreach ($eventi as $time => $eventoArray){
        /** @var  $evento  WP_Post*/
        $evento = $eventoArray[0];
        setup_postdata( $evento );
        $textHtml .=  '<article name="evento" id="evento_' . $evento->ID. '">' . "\n\t";
        $titolo = madisoft_scuola_protect_title($evento);
        $data = date('d/m/Y', $time);
        $textHtml .= madisoft_scuola_scrivi_titolo( $rendiCliccabileIlTItolo, '3', true, $evento, $data);
        if( get_post_thumbnail_id($evento)
            && madisoft_get_theme_option( 'madisoft_scuola_mostra_immagine_in_evidenza','off') =='on'){
            $immagine = madisoft_scuola_get_immagine_in_evidenza($evento);
            $textHtml .= '<div class="immagine_post"><img width="100%" alt="' . $titolo . '" title="' . $titolo . '" src="'. $immagine . '"/></div>';
        }
        if($rendiCliccabileIlTItolo){
            $textHtml .= "\n" . '<div class="article_preview">';
        }
        if(!eventiMostraSoloTitolo()) {
            if ($mostraIlContenuto) {
                $textHtml .= madisoft_the_content(madisoft_scuola_get_testo_per_continua_a_leggere($titolo), false, $evento);
            } else {
                $textHtml .= get_the_excerpt($evento);
            }
        }
        if($rendiCliccabileIlTItolo){
            $textHtml .= "\n" . '</div>';
        }
        $textHtml .= '<div style="clear:both"></div>';
        $textHtml .= '</article>' . "\n\t";

    }
    return $textHtml;
}

/**
 * @return bool
 */
function eventiMostraSoloTitolo(){
    return madisoft_get_theme_option('madisoft_scuola_home_eventi_solo_titoli', 'off') == 'on';
}

/**
 * @return bool
 */
function mostraEventiComeArticoli(){
    return madisoft_get_theme_option('madisoft_scuola_home_eventi_mostra_come_articoli', 'off') == 'on';
}

/**
 * @return bool
 */
function rendiCliccabileIlTitoloDegliEventi(){
    return madisoft_get_theme_option('madisoft_scuola_home_eventi_rendi_cliccabile_titolo', 'on') == 'on';
}

/**
 * @return bool
 */
function mostraAncheIlContenutoDegliEventi(){
    return madisoft_get_theme_option('madisoft_scuola_home_eventi_mostra_contenuto_articoli', 'off') == 'on';
}

/**
 * @return array|string
 */
function possoUsareIlMenuBootstrap()
{
    return !madisoft_get_theme_option('madisoft_scuola_usa_bootstrap', 'off');
}


/**
 * @return bool
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function possoMostrareLOrario()
{
    return madisoft_get_theme_option('madisoft_scuola_mostra_meta_data_orario', 'on') == 'on';
}

function getImmagineBasePerEvidenza()
{
    return madisoft_get_theme_option('madisoft_scuola_evidenza_immaginebase', madisoft_scuola_get_assets_directory('img') . 'news.png');
}


function generaTestoBaseOrdinamentoFasce()
{
    $baseNumFasce = '';
    for ($nf = 1; $nf <= madisoft_get_theme_option('madisoft_home_numero_fasce', 3); $nf++) {
        $baseNumFasce .= $nf . " ";
    }
    return $baseNumFasce;
}