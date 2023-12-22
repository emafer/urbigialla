<?php
madisoft_scuola_crea_struttura_superiore();
	//verifica se &egrave; una categoria
	if ( isset( $_GET['catid'] ) && ! empty( $_GET['catid'] ) ) {
		$catid        = $_GET['catid'];
		$categoryname = get_cat_name( $catid ) . " ";
		$category     = "catid=" . $catid;
	}
	?>
	<?php if ( have_posts() ) : ?>
		<?php /* If this is a category archive */
		if ( is_category() ) {
			?>
			<h2 class="pageTitle">Archivio per la categoria '<?php echo single_cat_title(); ?>'</h2>
			<?php /* If this is a daily archive */
		} elseif ( is_day() ) {
			?>
			<h2 class="pageTitle">Archivio <?php echo $categoryname ?>del <?php the_time( 'F jS, Y' ); ?></h2>
			<?php /* If this is a monthly archive */
		} elseif ( is_month() ) {
			?>
			<h2 class="pageTitle">Archivio <?php echo $categoryname ?> <?php the_time( 'F Y' ); ?></h2>
			<?php /* If this is a yearly archive */
		} elseif ( is_year() ) {
			?>
			<h2 class="pageTitle">Archivio <?php echo $categoryname ?> anno <?php the_time( 'Y' ); ?></h2>
			<?php /* If this is a search */
		} elseif ( is_search() ) {
			?>
			<h2 class="pageTitle">Risultati della ricerca</h2>
			<?php /* If this is an author archive */
		} elseif ( is_author() ) {
			?>
			<h2 class="pageTitle">Archivio autore</h2>
			<?php /* If this is a paged archive */
		} elseif ( isset( $_GET['paged'] ) && ! empty( $_GET['paged'] ) ) {
			?>
			<h2 class="pageTitle">Archivi</h2>
			<?php /* If this is a tag archive */
		} elseif ( is_tag() ) {
			?>
			<h2 class="pageTitle">Archivi per argomento (tag) '<?php single_tag_title(); ?>'</h2>
		<?php } ?>
    <div class="row">

		<?php while ( have_posts() ) {
		the_post();
		echo madisoft_scuola_Post( madisoft_get_theme_option('madisoft_scuola_layout_style_categoria', 2) ,true, mostraTestoCompletoArticoloInCategorie() );
		} ?>
	<?php endif; ?>
</div>
	<div class="nav">
		<div class="alignleft"><?php next_posts_link( '&laquo; Comunicazioni precedenti' ) ?></div>
		<div class="alignright"><?php previous_posts_link( 'Comunicazioni successive &raquo;' ) ?></div>
	</div>
	<div style="clear:both"></div>
<?php madisoft_scuola_crea_struttura_inferiore();
