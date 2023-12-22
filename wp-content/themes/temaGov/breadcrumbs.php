<?php
if ( madisoft_theme_can_i_show_breadcrumb() ) {
	?>
	<!-- breadcrumbs -->

	<div id="path">
		<?php
        echo custom_breadcrumbs();
		?>
	</div>
	<!-- fine breadcrumbs -->
<?php
}