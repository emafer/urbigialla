<?php
madisoft_scuola_crea_struttura_superiore();

$term = get_queried_object();
$visualizzazione = madisoft_get_theme_option('madisoft_scuola_layout_style_categoria', 2);
$larghezza = MadisoftScuolaWidth::MADISOFT_WIDTH_ALL / madisoft_get_theme_option('madisoft_scuola_numero_colonne_articoli', '4');
$imgBase = '';
$colore = '';

if (function_exists('recuperaMetaCategoria')) {
    $meta = recuperaMetaCategoria($term->term_id);

    if (isset($meta['stile']) && $meta['stile'] && $meta['stile'] != 'default') {
        $visualizzazione = $meta['stile'];
    }

    if (isset($meta['numcol']) && $meta['numcol'] && $meta['numcol'] != 'default') {
        $larghezza = MadisoftScuolaWidth::MADISOFT_WIDTH_ALL / $meta['numcol'];
    }
    if (isset($meta['img']) && $meta['img']) {
        $imgBase = $meta['img'];
    }
    if (isset($meta['color']) && $meta['color']) {
        $colore = $meta['color'];
    }
}
if ( have_posts() ) {
    //opzione di lettura
    ?>

	<h2 class="postTitle"> <?php single_cat_title(); ?></h2>
<div class="title-divisor">&nbsp;</div>
<?php if ($term->description) { ?>
<div class="row" style="padding-left: 15px; padding-right: 15px; margin-bottom: 30px">
	<div class="text-left col-<?php echo MadisoftScuolaWidth::MADISOFT_WIDTH_ALL; ?>">
	<?php  echo $term->description; 	?>
	</div>
</div>
<?php } ?>
    <div class="row" style="padding-left: 15px; padding-right: 15px">
	<?php
	while ( have_posts() ) {
		the_post();
		echo madisoft_scuola_Post(
		        $visualizzazione,
                true,
                mostraTestoCompletoArticoloInCategorie(),
            false,
            false,
            $larghezza,
            $imgBase,
                true,
                $colore
        );
	}
	?>
    </div>
	<div class="nav row">
        <div class="text-left col-<?php echo MadisoftScuolaWidth::MADISOFT_WIDTH_1_2; ?>"><?php next_posts_link( '&laquo; ' . single_cat_title( '', false ) . ' precedenti' ) ?></div>
		<div
			class="text-right col-<?php echo MadisoftScuolaWidth::MADISOFT_WIDTH_1_2; ?>"><?php previous_posts_link( single_cat_title( '', false ) . ' successive &raquo;' ) ?></div>
	</div>
	<div style="clear:both"></div>
<?php } else {
	get_template_part( 'include/templates/not_found_template_part' );
}
madisoft_scuola_crea_struttura_inferiore();