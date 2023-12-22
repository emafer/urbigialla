<?php
/**
 * @param $IdPagina
 *
 * @return bool
 */

$post = WP_Post::get_instance(get_the_ID());

madisoft_scuola_crea_struttura_superiore();

$IdPagina = $post->ID;
$TitoloPagina = $post->post_title;
$categoria_pagina = 0;

if ( $post) {
        madisoft_scuola_Pagina($post);
} else {
    get_template_part( 'include/templates/not_found_template_part' );
}

// la pagina &egrave; associata a una categoria?
if ( madisoft_theme_is_page_linked_to_category($IdPagina)  ) {
    $categoria_pagina = get_post_meta( $IdPagina, 'usrlo_pagina_categoria', true );
}
    if (possoVisualizzareQuestoContenuto($IdPagina) && $categoria_pagina > 0) {
    $title = '';
    if (CategoriaCollegataPossoMostrareIlTitoloDellaPagina()){
        $title .= $TitoloPagina;
    }
    if (CatogoriaCollegataGetSuffisso()){
        if ($title){
            $title .= ' - ';
        }
        $title .= CatogoriaCollegataGetSuffisso();
    }
    echo '<div class="title-divisor">&nbsp;</div>';
        $idCategoria = $categoria_pagina;
        $numeroArticoli = madisoft_get_theme_option('madisoft_scuola_categoria_collegata_numero_articoli', 8);
		$numeroArticoliPagina = get_post_meta( $IdPagina, 'page_numero_articoli', true );
		if ($numeroArticoliPagina == 99) {
			$numeroArticoliPagina = $numeroArticoli;
		}
        $catObj = get_category($idCategoria);
        $articoliCategoria = get_posts('numberposts=' . $numeroArticoliPagina . '&category=' . $idCategoria);
        
        $larghezza = MadisoftScuolaWidth::MADISOFT_WIDTH_ALL / madisoft_get_theme_option('madisoft_scuola_numero_colonne_articoli', '4');

        $meta = get_option("category_" . $idCategoria);
        if (!$meta) {
            $meta = ['img' => ''];
        }
        if ($meta['img']) {
            $img = $meta['img'];
        } else {
            $img = "/wp-content/uploads/sites/371/Default-News-2-scaled.jpg";
        }
        $textHtml = '<div class="row">';
        $counter_articoli = 0;
        $styleView = madisoft_get_theme_option('madisoft_scuola_categoria_collegata_stile', 'categoria');
        $stylePage = get_post_meta( $IdPagina, 'page_stile_categoria', true );
        $style = madisoft_get_theme_option('madisoft_scuola_categoria_collegata_stile_articoli', '3');
        if ($stylePage == 99) {
            $stylePage = $styleView;
        }
        if ($stylePage == 'archivio-categoria') {
            foreach ($articoliCategoria as $articolo) {
                setup_postdata($articolo);
                $counter_articoli++;
                global $more;
                $more = 0;
                if ($counter_articoli ==1) {
                    $textHtml .= '<div class="col-sm-24 col-md-12"> '. madisoft_scuola_Post(98, true, false, $articolo, false, $larghezza, $img) . '</div><!-- chiudi colonna 1 -->
                    <div class="col-sm-24 col-md-12">';
                } else {
                    $textHtml .= madisoft_scuola_Post(99, true, false, $articolo, false, $larghezza, $img);
                }
            }
            $textHtml .="</div><!-- chiudi colonna2> -->";
        } else {
            foreach ($articoliCategoria as $articolo) {
                setup_postdata($articolo);
                $counter_articoli++;
                global $more;
                $more = 0;
                $textHtml .= madisoft_scuola_Post($style, true, false, $articolo, false, $larghezza, $img);
                $textHtml .= inserisciSeparatoreRigaArticoliSeNecessario($counter_articoli);
            }
        }
        $textHtml .= '</div>';
        if (madisoft_get_theme_option('madisoft_scuola_categoria_collegata_nav_link', 'on') == 'on') {
            $textHtml = creaLinkCategoria($textHtml, $idCategoria, $catObj);
        }
        echo $textHtml;
}
madisoft_scuola_crea_struttura_inferiore();
/**
 * @return bool
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function CategoriaCollegataPossoMostrareIlTitoloDellaPagina(){
    return madisoft_get_theme_option('madisoft_scuola_categoria_collegata_titolo_categoria', 'on') == 'on';
}

/**
 * @return array|string
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function CatogoriaCollegataGetSuffisso(){
    return madisoft_get_theme_option('madisoft_scuola_categoria_collegata_titolo', 'Articoli recenti');
}