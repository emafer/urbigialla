<?php
wp_nav_menu( array(
    'theme_location'  => 'menu-1',
    'depth'           => 1, // 1 = no dropdowns, 2 = with dropdowns.
    'container'       => 'div',
    'container_class' => 'collapse navbar-collapse',
    'container_id'    => 'navbarSupportedContent',
    'menu_class'      => 'navbar-nav mr-auto',
    'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
    'walker'          => new WP_Bootstrap_Navwalker(),
) );