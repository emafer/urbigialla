<?php
if (!function_exists('is_plugin_active')) {
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
}
add_action( 'admin_bar_menu', 'madisoft_scuola_aggiunta_link_adminbar', 0 );
if (is_plugin_active('pafacile/tosendit-pa.php')){
    add_action( 'admin_bar_menu', 'madisoft_scuola_aggiunta_link_nuovoalbo_admin_bar', 999 );
}
add_action( 'admin_bar_menu', 'remove_wp_logo', 999 );
add_action( 'admin_bar_menu', 'unset_add_new_content_link', 999);
add_action( 'admin_bar_menu', 'madisoft_scuola_aggiunta_link_update_url', 999);

/**
 * @param WP_Admin_Bar $wp_admin_bar
 */
function madisoft_scuola_aggiunta_link_adminbar( WP_Admin_Bar $wp_admin_bar ) {
    $args = array(
        'id'    => 'madisoft_page',
        'title' =>  __('<img src="'. madisoft_scuola_get_assets_directory('img') . 'nuv.png" style="max-height: 50%; vertical-align:middle;margin-right:5px" alt="Madisoft logo" title="Madisoft" />Madisoft','madisoft_scuola' ),
        'href' => 'http://scuoladigitale.info/',
        'meta'  => array(
            'target' => 'blank' )
    );
    $wp_admin_bar->add_node( $args );
}

/**
 * @param WP_Admin_Bar $wp_admin_bar
 */
function madisoft_scuola_aggiunta_link_nuovoalbo_admin_bar( WP_Admin_Bar $wp_admin_bar ) {
    $args = array(
        'id'     => 'nuovo_atto', // id of the existing child node (New > Post)
        'title'  => 'Atto Albo Pretorio', // alter the title of existing node
        'href'   => home_url() . '/wp-admin/admin.php?page=toSendItPAFacile-alboPretorio-new',
        'parent' => 'new-content',
        'meta'   => array(
            'class' => 'ab-item' )
    );
    if ( current_user_can( 'tosendit_pafacile_role_albo_pretorio' ) ) {
        $wp_admin_bar->add_node( $args );
    }
}

/**
 * @param WP_Admin_Bar $wp_admin_bar
 */
function madisoft_scuola_aggiunta_link_update_url( WP_Admin_Bar $wp_admin_bar ) {
    $args = array(
        'id'     => 'update_url_adminbar', // id of the existing child node (New > Post)
        'title'  => 'Aggiorna urls', // alter the title of existing node
        'href'   => home_url() . '/wp-admin/tools.php?page=searchReplace.php',
        'parent' => 'site-name',
        'meta'   => array(
            'class' => 'ab-item' )
    );
    if ( current_user_can( 'administrator' ) ) {
        $wp_admin_bar->add_node( $args );
    }
}

/**
 * @param WP_Admin_Bar $wp_admin_bar
 */
function remove_wp_logo( WP_Admin_Bar $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'wp-logo' );
//	if (!is_admin()){
//		$wp_admin_bar->remove_node( 'my-sites' );
//	}
}


function unset_add_new_content_link(WP_Admin_Bar $wp_admin_bar){
	$new_content_node = $wp_admin_bar->get_node('new-content');
    if ($new_content_node){
        $new_content_node->href = '#';
        $wp_admin_bar->add_node($new_content_node);
    }
}

// remove links/menus from the admin bar
function mytheme_admin_bar_render() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('my-sites');
}
//add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );
