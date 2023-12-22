<?php
    $slides = madisoft_get_theme_option( 'madisoft_scuola_testata_slider_immagini', array() );
	$immagineInEvidenzaPagina = madisoft_scuola_get_immagine_header();
?>
<?php
if (madisoft_get_theme_option('madisoft_scuola_testata_separata', 'off') == 'on' ){
	$class =' testata_separata1';
} else {
	$class = '';
}
?>
<div class="row-fluid text-center<?php echo $class; ?>">
	<section class="slider">
		<div class="flexslider">
			<ul class="slides">
				<?php
				$immagineInEvidenzaPagina = madisoft_scuola_get_immagine_in_evidenza();
				if ( $immagineInEvidenzaPagina ) {
					echo "\n" . '<li>' . "\n";
					$img = '<img src="' . $immagineInEvidenzaPagina . '"  class="img_slide"/>';
					echo "\t" . $img . "\n";
					echo '</li>' . "\n";
				}
				foreach ( $slides as $slide ) {
					echo "\n" . '<li>' . "\n";
					$title = ' title="' . ( $slide['title'] ? $slide['title'] : "" ) . '"';
					$alt   = ' alt="' . ( $slide['description'] ? $slide['description'] : "" ) . '"';
					$img = '<img' . $title . $alt . ' src="' . $slide['image'] . '"  class="img_slide"/>';
					if ( $slide['link'] ) {
						echo "\t" . '<a href="' . $slide['link'] . '" target="_blank">' . $img . '</a>';
					} else {
						echo "\t" . $img . "\n";
					}
					echo '</li>' . "\n";
				}
				?>
			</ul>
		</div>
	</section>
</div>
<?php
if (madisoft_get_theme_option('madisoft_scuola_testata_separata', 'off') == 'on' ){
	?>
	<div id="testatasidebar" class="testata_separata2">
		<ul>
		<?php if ( function_exists( 'dynamic_sidebar' ) && dynamic_sidebar( 'sidebar-testata' ) ) : ?>
		<?php endif; ?>
		</ul>
	</div>
	<div class="clearfix"></div>
<?php
}