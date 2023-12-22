    <div class="container">
        <div
                aria-label="Sidebar di fondo"
                class="row"
                id="footer-widget">
        <?php
            if ( function_exists( 'dynamic_sidebar' ) ){
                dynamic_sidebar( 'footer-widget' );
            }
        ?>
        </div>
    </div>
