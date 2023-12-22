<?php
if( madisoft_scuola_get_larghezza('left') > 0 ) {?>
        <div
                aria-label="Sidebar di sinistra"
                class="col-sm-<?php echo madisoft_scuola_get_larghezza('left'); ?> d-none d-md-block no-padding-left no-padding-right"
                id="leftsidebar">
                    <?php
                    if ( function_exists( 'dynamic_sidebar' ) ){
                        dynamic_sidebar( 'sidebar-1' );
                    }
                    ?>
        </div>
<?php }