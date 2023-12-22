<?php
if ( madisoft_get_theme_option('madisoft_scuola_grafica_mostra_menu_superiore', 'on') == 'on'
    && has_nav_menu( 'menu-1' )) {
    echo  '<div class="row">
    <div class="container-fluid">';
    madisoftThemeCreaMenu('topnavmenu', 'menu-1', 'menu-1');
    echo '</div></div>';
}