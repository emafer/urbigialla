<?php
/*
Plugin Name: Madisoft Global Plugin
Version: 0.1
Description: Plugin che raccoglie tutte le funzioni globali per i siti delle Scuole Madisoft. L'obiettivo è quello di omogeneizzare le funzioni indipendentemente dal tema usato.
Author: Salvatore D'Agostino
Author URI: http://madisoft.it
*/


/*
	Funzione per rinominare voci del backend Wordpress. 
	Inizialmente creata per rinominare il ThemeOptions del OptionTree
	può essere usata per rinominare qualsiasi voce menu.
*/

function madisoft_rename_admin_menu_items( $menu ) {

	$menu = str_ireplace( 'Theme options', 'Gestisci la grafica del sito', $menu );
	

	return $menu;
}
add_filter('gettext', 'madisoft_rename_admin_menu_items');
add_filter('ngettext', 'madisoft_rename_admin_menu_items');

/*
	Funzione per eliminare voci dal backend Wordpress.
	Inizialmente creata per eliminare OptionTree dalla dashboard.
	Per recuperare il nome della variabile da passare alla funzione utilizzare
	snippet qui sotto (il secondo valore è quello che ci interessa):

	add_action( 'admin_init', 'wpse_136058_debug_admin_menu' );

	function wpse_136058_debug_admin_menu() {

	    echo '<pre>' . print_r( $GLOBALS[ 'menu' ], TRUE) . '</pre>';
	}

*/
function madisoft_remove_menu_pages() {

    global $user_ID;
	if ( !current_user_can( 'administrator' ) ) {

		remove_menu_page( 'ot-settings' );

	}

}
add_action( 'admin_init', 'madisoft_remove_menu_pages' );



/*
	Funzione per embeddare file css e js nella pagina
	delle impostazioni di option tree.

*/

function madisoft_enqueue_option_tree($hook) {

    if ( 'appearance_page_ot-theme-options' != $hook ) {
        return;
    }
    wp_enqueue_script( 'theme-options-script', madisoft_scuola_get_assets_directory('js').'theme-options.js', array('jquery'));

    wp_register_style( 'theme-options-style', madisoft_scuola_get_assets_directory('css').'theme-options.css' );
    wp_enqueue_style( 'theme-options-style');
    
}
add_action( 'admin_enqueue_scripts', 'madisoft_enqueue_option_tree' );