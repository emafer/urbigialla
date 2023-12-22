<?php
if ( function_exists( 'dynamic_sidebar' ) ) {
?>    <div class="container-fluid order-4">
        <?php
        if (madisoft_get_theme_option('barra_inferiore_titolo', '') != '') {
            echo '<div id="barra_inferiore_titolo" class="row titoloBarra">
                        <h3>' . madisoft_get_theme_option('barra_inferiore_titolo', '') . '</h3>
                      </div>';
        }
        ?>
        <div
                aria-label="Sidebar di fondo"
                class="row carousel slide" data-ride="carousel"
                id="downwidget">
        <?php
                dynamic_sidebar( 'downwidget' );
        ?>
        </div>
    </div>
    <?php
}
?>
