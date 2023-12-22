<?php


/**
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function madisoft_scuola_codice_custom_js() {
    $js = madisoft_get_theme_option( 'madisoft_scuola_codice_custom_js', false );

    if ( $js ) {
        echo '<script>' . "\n" . $js . "\n" . '</script>' . "\n";
    }
}
add_action('admin_head', 'editor_full_width_gutenberg');

function editor_full_width_gutenberg() {
  echo '<style>
    body.gutenberg-editor-page .editor-post-title__block, body.gutenberg-editor-page .editor-default-block-appender, body.gutenberg-editor-page .editor-block-list__block {
		max-width: none !important;
	}
    .block-editor__container .wp-block {
        max-width: none !important;
    }
  </style>';
}

/**
 * @param int $codiceDiControllo
 * @param string $nomeDominio
 */
function generaLessFile($codiceDiControllo = 999)
{
    $dir = '/csscache';
	if (get_current_blog_id() == '552') {
	//return ''; 
	}
    if (!is_dir(WP_CONTENT_DIR . $dir)) {
        mkdir($dir);
    }

    $subDir = madisoft_scuola_get_assets_directory('csscache', false);

    if (!is_dir($subDir)) {
        mkdir($subDir);
    }
    $fileName = $subDir . '/' . get_option('generated_bootstrap_file', true);
    if (occorreRicreareIlCss()) {
        if (is_file($fileName)) {
            unlink($fileName);
        }
        if (is_file($subDir . '/customStyle.scss')) {
            unlink($subDir . '/customStyle.scss');
        }
        update_option('generated_bootstrap_file', 'style_'.time() . '.css');
        $fileName = $subDir . '/' . get_option('generated_bootstrap_file', true);
    }
    if (!is_file($fileName)) {
        update_option('generated_bootstrap_file', 'style_'.time() . '.css');
        $fileName = $subDir . '/' . get_option('generated_bootstrap_file', true);
        require get_template_directory() . '/vendor/scssphp/scssphp/scss.inc.php';
        include_once madisoft_scuola_get_assets_directory(
            'templates',
            false,
            'variabili-stile.php'
        );
        $scss = new ScssPhp\ScssPhp\Compiler();
        $scss->setIgnoreErrors(false);
        $scss->setVariables(madisoft_theme_getVariabili());
        $scss->setImportPaths( [
            get_template_directory() . '/vendor/twbs/bootstrap/scss/',
            madisoft_scuola_get_assets_directory('scss', false),
            $subDir,

        ]);
		/**
		
		if (get_current_blog_id() == 56) {
			echo '<!-- ' ;
			var_dump(madisoft_theme_getVariabili());	
			echo	 '-->';
			//die('Pagina in aggiornamento');
		}
		*/
        $fileToImport = '@import "bootstrap.scss", "style.scss"';
        if (madisoft_get_theme_option('madisoft_scuola_codice_custom_css', '')) {
            file_put_contents(
               $subDir . '/customStyle.scss',
                str_replace("&gt;", ">", madisoft_get_theme_option('madisoft_scuola_codice_custom_css', ''))
            );
        }

        if (is_file($subDir . '/customStyle.scss') && validaCustomCss($subDir)) {
            $fileToImport .= ', "customStyle.scss"';
        }

        if ( madisoft_get_theme_option( 'madisoft_scuola_testata_mostra_slider', 0 ) == 'on' ||
            madisoft_get_theme_option( 'madisoft_scuola_intro_mostra_slider', 0 ) == 'on' ) {
            $fileToImport .= ', "flexslider.scss"';
        }
        $content = $scss->compile($fileToImport . ';');
        file_put_contents($fileName, $content);
    }

    if (is_file($fileName) && !defined('CSS_PATH')) {
        define('CSS_PATH', madisoft_scuola_get_assets_directory('csscache', true) . get_option('generated_bootstrap_file', true));
    }

    if (!defined('CSS_PATH')) {
        echo 'aaaaaaaaaaa'; //TODO ERRORE MANCA
    }

if ($codiceDiControllo == 999) {
    $codiceDiControllo = get_option('madisoft_versione_css', true);
}
    update_option('madisoft_versione_css', $codiceDiControllo);
    pulisciFileincsscache();

}

function controllaLEsistenzaDeiFileGeneratiECrealiSeNecessario(){
    $codiceDiControllo = '1.7';
//    $nomeStyle = get_option('generated_css_style', true);
//    $style_css = madisoft_scuola_get_assets_directory( 'csscache', false) .$nomeStyle ;
    $nomeBootstrapFile = get_option('generated_bootstrap_file', true);
    $bootstrap_css = madisoft_scuola_get_assets_directory( 'csscache', false) . $nomeBootstrapFile;

    /**
     * La cartella esiste ....
     * il file esiste
     * l'opzione è settata
     */

    if ( is_dir(madisoft_scuola_get_assets_directory( 'csscache', false))
//            && is_file( $style_css )
//            && $nomeStyle
            && is_file( $bootstrap_css )
            && $nomeBootstrapFile
            && $codiceDiControllo === get_option('madisoft_versione_css', true)
    ){
        if (defined('CSS_PATH')) {
            if (CSS_PATH != madisoft_scuola_get_assets_directory( 'csscache') . get_option('generated_bootstrap_file', true)) {
                define('CSS_PATH', madisoft_scuola_get_assets_directory( 'csscache') . get_option('generated_bootstrap_file', true));
            }
        }
        // tutto in ordine
    } else  {
        GeneraLessFile($codiceDiControllo);
    }
    if (!defined('CSS_PATH')) {
        define('CSS_PATH', madisoft_scuola_get_assets_directory('csscache', true) . get_option('generated_bootstrap_file', true));
    }
}

function setCss(){
    controllaLEsistenzaDeiFileGeneratiECrealiSeNecessario();
    if ( ! is_admin() ) {
        //todo porcaccia la miseria
        wp_register_style( 'bootstrap-style-css', madisoft_scuola_get_assets_directory('csscache') . get_option('generated_bootstrap_file', true) );
        wp_register_style( 'jquery-ui-style', madisoft_scuola_get_assets_directory('css') .'jquery-ui.css' );
        wp_register_style('print-style-css', madisoft_scuola_get_assets_directory( 'css' ) . 'print.css', array(), false, 'print' );
        wp_register_style('accessibilita-css', madisoft_scuola_get_assets_directory( 'css' ) . 'accessibilita.css', array() );
        wp_enqueue_style( 'jquery-ui-style' );
        wp_enqueue_style( 'print-style-css' );
        wp_enqueue_style( 'accessibilita-css' );
        wp_enqueue_style( 'canvas_css' );
        wp_enqueue_style( 'bootstrap-style-css' );
    } else {
        wp_register_style('admin-css', madisoft_scuola_get_assets_directory( 'css' ) . 'admin-theme/css/bootstrap.min.css', array() );
        wp_enqueue_style( 'admin-css' );
    }
}

controllaLEsistenzaDeiFileGeneratiECrealiSeNecessario();
add_editor_style( madisoft_scuola_get_assets_directory( 'csscache') . get_option('generated_bootstrap_file', true) );
add_editor_style( madisoft_scuola_get_assets_directory( 'css') . 'editor-style.css' );
function madisoft_custom_admin_css() {
    wp_register_style( 'bootstrap-style-css', madisoft_scuola_get_assets_directory('csscache') . get_option('generated_bootstrap_file', true) );
    wp_enqueue_style( 'bootstrap-style-css' );
}
add_action( 'login_enqueue_scripts', 'madisoft_custom_admin_css', 10 );
//add_action( 'admin_enqueue_scripts', 'madisoft_custom_admin_css', 10 );
//add_action( 'admin_enqueue_scripts', 'madisoft_custom_admin_css', 10 );
function pulisciFileincsscache($all = false){
    $directories = glob( madisoft_scuola_get_assets_directory('csscache', false) . '*' );
    foreach ( $directories as $fileDaControllare ) {
        if ($all){
            unlink($fileDaControllare);
        } else if ( pathinfo($fileDaControllare, PATHINFO_EXTENSION) != 'css' ){
            unlink($fileDaControllare);
        }
    }

    return true;
}

function setJs(){
    if ( !is_admin() ) {
        if ( madisoft_get_theme_option( 'madisoft_scuola_testata_mostra_slider', 0 ) == 'on' ||
            madisoft_get_theme_option( 'madisoft_scuola_intro_mostra_slider', 0 ) == 'on' ) {

            wp_enqueue_script(
                'slider_js', // name your script so that you can attach other scripts and de-register, etc.
                madisoft_scuola_get_assets_directory( 'js' ) . 'slider.js', // this is the location of your script file
                array( 'jquery' ), // this array lists the scripts upon which your script depends,
                2
            );
        }

        wp_register_script( 'temScuolaFunctions', madisoft_scuola_get_assets_directory( 'js', true ) . 'temaScuola_functions.js', array( 'jquery' ) );
        wp_register_script( 'datePickerjs', madisoft_scuola_get_assets_directory( 'js', true ) . 'jqueryDatepicker.js', array( 'jquery' ) );
        wp_register_script( 'popperjs', madisoft_scuola_get_assets_directory( 'js', true ) . 'popper-2023.min.js', array( 'jquery' ) );
        wp_register_script( 'bootstrapjs', madisoft_scuola_get_assets_directory( 'bootstrap', true ) . 'js/dist/util.js', array( 'jquery' ) );
        wp_register_script( 'carouseljs', madisoft_scuola_get_assets_directory( 'bootstrap', true ) . 'js/dist/carousel.js', array( 'jquery', 'bootstrapjs' ) );
//        wp_register_script( 'ieportjs', madisoft_scuola_get_assets_directory( 'bootstrap', true ) . 'js/ie10-viewport-bug-workaround.js', array( 'jquery' ) );

        wp_enqueue_script( 'slider2_js',  madisoft_scuola_get_assets_directory( 'js' ) . 'jquery.flexslider-min.js', array( 'jquery' )  );
        wp_enqueue_script( 'temScuolaFunctions' );
        wp_enqueue_script( 'datePickerjs' );
        wp_enqueue_script( 'popperjs' );
        wp_enqueue_script( 'bootstrapjs' );
        wp_enqueue_script( 'carouseljs' );
        wp_enqueue_script( 'ieportjs' );

        wp_enqueue_script( 'jquery-ui_js',  madisoft_scuola_get_assets_directory( 'js' ) . 'jquery-ui.js', ['jquery' ] );
        $array_opzioni = array(
            'sliderTime'      => madisoft_get_theme_option( 'madisoft_scuola_testata_slider_intervallo_temporale', 4 ) * 1000,
            'sliderAnimation' => madisoft_get_theme_option( 'madisoft_scuola_testata_slider_tipo_animazione', 'slide' ),
            'sliderTimeIntro'      => madisoft_get_theme_option( 'madisoft_scuola_intro_slider_intervallo_temporale', 4 ) * 1000,
            'sliderAnimationIntro' => madisoft_get_theme_option( 'madisoft_scuola_intro_slider_tipo_animazione', 'slide' ),
        );

        wp_localize_script( 'slider_js', 'sliderVariabili', $array_opzioni );
        wp_enqueue_script('jquery-ui-button');
        wp_enqueue_script('jquery-ui-menu');
        wp_enqueue_script('jquery-ui-autocomplete');

    }
    wp_enqueue_script( 'calendario', madisoft_scuola_get_assets_directory( 'js' ) . 'calendario.js', array( 'jquery' )  );
}



/**
 * @return bool
 */
function occorreRicreareIlCss() {
    if (madisoft_get_theme_option('madisoft_scuola_aggiornaCss', '1') != '99') {
            $opzioni = madisoft_get_theme_option();
            $opzioni['madisoft_scuola_aggiornaCss'] = '1';
            update_option('option_tree', $opzioni);
            if (is_file(madisoft_scuola_get_assets_directory('csscache', false) . 'customStyle.scss')) {
                unlink(madisoft_scuola_get_assets_directory('csscache', false) . 'customStyle.scss');
            }
        $directories = glob(madisoft_scuola_get_assets_directory('csscache', false) . '*');
        foreach ($directories as $fileDaRimuovere) {
            if (is_file($fileDaRimuovere)) {
                unlink($fileDaRimuovere);
            }
        }
        return true;
    }


    return false;
}

function validaCustomCss($subDir){
    require get_template_directory() . '/vendor/scssphp/scssphp/scss.inc.php';
    include_once madisoft_scuola_get_assets_directory(
        'templates',
        false,
        'variabili-stile.php'
    );
    $scss = new ScssPhp\ScssPhp\Compiler();
    $scss->setIgnoreErrors(false);
    $scss->setVariables(madisoft_theme_getVariabili());
    $scss->setImportPaths( [
        get_template_directory() . '/vendor/twbs/bootstrap/scss/',
        madisoft_scuola_get_assets_directory('scss', false),
        $subDir,

    ]);
    $fileToImport = '@import "bootstrap.scss", "style.scss", "customStyle.scss"';

    try
        {
            $scss->compile($fileToImport);
        }
    catch (ScssPhp\ScssPhp\Exception\ParserException $e) {
        add_action('admin_notices', 'avvisoCssErrato');
        return false;
    }
    return true;

}
function avvisoCssErrato(){
        echo '<div class="notice notice-error is-dismissible">
             <p>Attenzione: il css personalizzato presenta errori, il css personalizzato non  &egrave; stato elaborato</p>
         </div>';
}

/**
 * @return string
 */
function ottieniClasseNoPaddingLeft(): string
{
    $classelarghezza = '';
    if (madisoft_scuola_get_larghezza('left')) {
        $classelarghezza = ' no-padding-left';
    }
    if (is_front_page() && madisoft_get_theme_option('madisoft_scuola_home_sidebar_mostra', 'off') == 'off') {
        $classelarghezza = '';
    }
    return $classelarghezza;
}
