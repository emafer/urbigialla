<?php
if ( madisoft_scuola_get_larghezza('right') > 0 ) {
	?>
        <div
                aria-label="Sidebar di destra"
                class="hidden-xs  no-padding-left no-padding-right col-sm-<?php echo madisoft_scuola_get_larghezza('right'); ?>"
                id="rightsidebar">
            <?php
            if ( function_exists( 'dynamic_sidebar' ) ){
                dynamic_sidebar( 'sidebar-2' );
            }
            ?>
        </div>
    <?php
}
