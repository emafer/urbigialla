<aside>
   <div
            id="testatasidebar"
            aria-label="Sidebar"
            class="hidden-xs col-sm-<?php echo madisoft_scuola_get_larghezza('top-sidebar') ?>">
        <div class="row">
            <div class="col-sm-<?php echo MadisoftScuolaWidth::MADISOFT_WIDTH_ALL;?>">
            <?php
                if ( function_exists( 'dynamic_sidebar' ) ){
                    dynamic_sidebar( 'sidebar-testata' );
                }
            ?>
            </div>
        </div>
    </div>
</aside>