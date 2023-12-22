<?php
	add_action( 'admin_init', 'madisoft_datepicker_admin' );
	add_action( 'init', 'register_my_menus' );

if (!file_exists( madisoft_scuola_get_assets_directory( 'walker', false) . 'class-wp-bootstrap-navwalker.php' )) {
    throw new ParametroNonSettatoException('non esiste il file boostrap-navwalker');
}
require madisoft_scuola_get_assets_directory( 'walker', false) . 'class-wp-bootstrap-navwalker.php';

function register_my_menus() {
		register_nav_menus(
			array(
                'menu-1' => __( 'Menu 1' ),
                'menu-2' => __( 'Menu 2' ),
                'menu-3' => __( 'Menu 3' ),
                'menu-mobile' => 'Menu Mobile'
			)
		);
	}
	/* prima creo le sidebar per le barre laterali */
	if ( function_exists( 'register_sidebar' ) ) {
		register_sidebar(
			array(
				'name' => 'Barra Laterale Sinistra',
				'id'            => 'sidebar-1',
				'description'   => '',
				'class'         => '',
				'before_widget' => '<div class="widget">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widgettitle">',
				'after_title'   => madisoft_scuola_add_title_divisor_widget('sidebar-1')
			) );
		register_sidebar(
			array(
			'name' => 'Barra Laterale Destra',
			'id'            => 'sidebar-2',
			'description'   => '',
			'class'         => '',
                'before_widget' => '<div class="widget">',
                'after_widget'  => '</div>',
                'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => madisoft_scuola_add_title_divisor_widget('sidebar-2')
		)
		);
		$numeroColonne = madisoft_get_theme_option('madisoft_scuola_numero_footer_inferiore_widget', 6 );
        $larghezzaWidget = MadisoftScuolaWidth::MADISOFT_WIDTH_ALL/$numeroColonne;
        register_sidebar(
            [
                'name' => __('Barra Inferiore', 'MadisoftScuola'),
                'id' => 'downwidget',
                'description' => 'Gli elementi mostrati qui verranno inseriti nella parte bassa della pagina
								sopra al pie\' di pagina',
                'class' => '',
                'before_widget' => '<div class="col-sm-' . $larghezzaWidget. ' widget"><div>',
                'after_widget' => '</div></div>',
                'before_title' => '<h2 class="widgettitle">',
                'after_title' => madisoft_scuola_add_title_divisor_widget('downwidget')
            ]
        );
        register_sidebar(
            [
                'name' => __('Footer', 'MadisoftScuola'),
                'id' => 'footer-widget',
                'description' => 'Gli elementi inseriti qui verranno mostrati nel     pie\' di pagina',
                'class' => '',
                'before_widget' => '<div class="col-sm-' . calcolaDimensioneColonneFooter() . '"><div>',
                'after_widget' => '</div></div>',
                'before_title' => '<h2 class="widgettitle">',
                'after_title' => madisoft_scuola_add_title_divisor_widget('footer-widget')
            ]
        );
        if ( madisoft_get_theme_option('madisoft_scuola_usa_footer_interno', 'on' ) == 'on') {
            register_sidebar(
                [
                    'name' => __('Footer Interno', 'MadisoftScuola'),
                    'id' => 'footer-interno',
                    'description' => 'Gli elementi mostrati qui verranno inseriti nella parte bassa della pagina
								sopra al pie\' di pagina',
                    'class' => '',
                    'before_widget' => '<div class="col-sm-8 widget"><div>',
                    'after_widget' => '</div></div>',
                    'before_title' => '<h2 class="widgettitle">',
                    'after_title' => madisoft_scuola_add_title_divisor_widget('footer-interno')
                ]
            );
        }
	}

	function madisoft_datepicker_admin() {
		wp_enqueue_style( 'jquery-ui-css', madisoft_scuola_get_assets_directory( 'css' ) . 'jquery-ui/jquery-ui.css' );
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui' );
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script( 'my-datepicker', madisoft_scuola_get_assets_directory( 'js' ) . 'jqueryDatepicker.js' );
	}

add_action('init', 'setCss');
add_action( 'wp_footer', 'setJs' );
add_action('ot_after_theme_options_save', 'generaLessFile');

function madisoft_scuola_add_title_divisor_widget($idSidebar){
    $sidebar = [
        'sidebar-1' =>'madisoft_scuola_leftsidebar_usa_divisore',
        'sidebar-2' =>'madisoft_scuola_rightsidebar_usa_divisore',
        'footer-interno' =>'madisoft_scuola_footerinterno_usa_divisore',
        'footer-widget' =>'madisoft_scuola_footer_usa_divisore',
        'sidebar-testata' =>'madisoft_scuola_headerwidget_usa_divisore',
        'downwidget' =>'madisoft_scuola_downwidget_usa_divisore',
    ];

    $html = '</h2>';
    if ( madisoft_get_theme_option($sidebar[$idSidebar], 'off') == 'on' ){
        $html .= '<div class="title-divisor">&nbsp;</div>';
    }

    return $html;
}

function creaRimandiAlleSidebar(){
    echo '<div id="rimandi" class="hidden-sm hidden-md hidden-lg">
            <span id="mostra-menu-popup">';
                if ( madisoft_scuola_get_larghezza('left') > 0 ) {
                    echo creaButton('show-left-sidebar', 'Mostra men&ugrave; di sinistra', 'fa-menu-right', 'btn btn-default');
                }
                if( madisoft_scuola_get_larghezza('right') > 0 ) {
                    echo creaButton('show-right-sidebar', 'Mostra men&ugrave; di destra', 'fa-menu-left', 'btn btn-default');
                }
                if( madisoft_scuola_get_larghezza('top-sidebar') > 0 ) {
                    echo creaButton('show-top-sidebar', 'Mostra men&ugrave; aggiuntivo', 'fa-align-justify', 'btn btn-default');
                }
                echo '</span>
            </div>';
}

function creaButton($id, $text, $icona, $class=''){
    if ($class){
        $class = ' class="' . $class. '"';
    }
    return '<button id="' . $id . '"' . $class . '><i class="fa ' . $icona . '"></i><span class="titleMenu">' . $text . '</span></button>';
}

function calcolaDimensioneColonneFooter(){
    return ( MadisoftScuolaWidth::MADISOFT_WIDTH_ALL/madisoft_get_theme_option('madisoft_scuola_numero_footer_widget', 3) );
}

add_filter( 'map_meta_cap', 'permettiDiusareHtml', 1, 3 );

function permettiDiusareHtml( $caps, $cap, $user_id ) {

    if ( 'unfiltered_html' === $cap && user_can( $user_id, 'edit_posts' ) )
        $caps = ['unfiltered_html'];

    return $caps;
}

function rimuoviLaVersioneDiWPDagliScript( $src ) {
    global $wp_version;
	$parsedUrl= parse_url($src, PHP_URL_QUERY);
	if ($parsedUrl) {
		parse_str($parsedUrl, $query);
		if ( !empty($query['ver']) && $query['ver'] === $wp_version ) {
			$src = remove_query_arg('ver', $src);
		}
	}
	
    return $src;
}

add_filter( 'script_loader_src', 'rimuoviLaVersioneDiWPDagliScript' );
add_filter( 'style_loader_src', 'rimuoviLaVersioneDiWPDagliScript' );

function rimuoviLaVersioneDiWP() {
    return '';
}
add_filter('the_generator', 'rimuoviLaVersioneDiWP');

add_filter( 'tiny_mce_before_init', 'font_choices' );
/**
 * @param $init
 * @return mixed
 */
function font_choices( $init ) {
    $init['font_formats'] =
        'Andale Mono=andale mono,times;' .
        'Arial=arial,helvetica,sans-serif;' .
        'Arial Black=arial black,avant garde;' .
        'Book Antiqua=book antiqua,palatino;' .
        'Comic Sans MS=comic sans ms,sans-serif;' .
        'Courier New=courier new,courier;' .
        'EB Garamond=EB Garamand,serif;' .
        'Georgia=georgia,palatino;' .
        'Helvetica=helvetica;' .
        'Impact=impact,chicago;' .
        'Gloria Hallelujah=Gloria Hallelujah,cursive;' .
        'Josefin Slab=Josefin Slab,serif;' .
        'Lato=Lato,sans-serif;' .
        'Libre Baskerville=Libre Baskerville, serif;' .
        'Lobster=Lobster,cursive;' .
        'Lucida Grande=Lucida Grande, sans-serif;' .
        'Lucida Sans unicode=Lucida Sans unicode;' .
        'Shadows Into Light=Shadows Into Light,cursive;' .
        'Symbol=symbol;' .
        'Tahoma=tahoma,arial,helvetica,sans-serif;' .
        'Terminal=terminal,monaco;' .
        'Times New Roman=times new roman,times;' .
        'Titillium web=Titillium Web;' .
        'Trebuchet MS=trebuchet ms,geneva;' .
        'Verdana=verdana,geneva;' .
        'Webdings=webdings;' .
        'Wingdings=wingdings,zapf dingbats;' .
        '';

    return $init;
}

//remove_action('rest_api_init', 'create_initial_rest_routes', 99);


function run_activate_plugin( $plugin ) {
    $current = get_option( 'active_plugins' );
    $plugin = plugin_basename( trim( $plugin ) );

    if ( !in_array( $plugin, $current ) ) {
        $current[] = $plugin;
        sort( $current );
        do_action( 'activate_plugin', trim( $plugin ) );
        update_option( 'active_plugins', $current );
        do_action( 'activate_' . trim( $plugin ) );
        do_action( 'activated_plugin', trim( $plugin) );
    }

    return null;
}
//
if (madisoft_get_theme_option('madisoft_scuola_eventi_usa_plugin_standard', 'on') == 'on') {
    run_activate_plugin('events-manager/events-manager.php');
}
if (madisoft_get_theme_option('madisoft_scuola_usa_plugin_ammtrasp', 'on') == 'on') {
    run_activate_plugin('amministrazione-trasparente/amministrazionetrasparente.php');
}