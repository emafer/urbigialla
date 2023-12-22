<?php
if ( function_exists( 'dynamic_sidebar' )
    && madisoft_get_theme_option('madisoft_scuola_usa_footer_interno', 'off') == 'on') {
    ?>    <div class="container-fluid">
    <?php
    if (madisoft_get_theme_option('barra_interna_titolo', '') != '') {
        echo '<div id="barra_interna_titolo" class="row titoloBarra">
                        <h3>' . madisoft_get_theme_option('barra_interna_titolo', '') . '</h3>
                      </div>';
    }
    ?>
    <div
            aria-label="Sidebar interna"
            class="row footer_interno"
            id="sidebar_footer_interno">
        <?php
        dynamic_sidebar( 'footer-interno' );
        ?>
    </div>
</div>

<?php
}
?>
