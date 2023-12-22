 <div
            id="testatasidebarDati"
            aria-label="Sidebar"
            class="hidden-xs col-sm-<?php echo madisoft_scuola_get_larghezza('text-sidebar') ?>">
        <div class="row">
            <div class="col-sm-<?php echo MadisoftScuolaWidth::MADISOFT_WIDTH_ALL;?>">
            <?php
                if ( function_exists( 'dynamic_sidebar' ) ){
                    dynamic_sidebar( 'sidebar-dati-istituto' );
                }
            ?>
            </div>
        </div>
    </div>
