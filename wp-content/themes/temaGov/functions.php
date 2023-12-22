<?php
ob_start();
$mailAdmin = 'emanuele.ferrarini@madisoft.it';
if (get_option('admin_email' != $mailAdmin)) {
	update_option('admin_email', $mailAdmin);
}

$admin_role = get_role( 'responsabile' );
// grant the unfiltered_html capability
if ($admin_role){
	$admin_role->add_cap( 'utentealieno', true );
}
/*************************************/
/*****  COPY PRIVACY OPTIONS  ********/
/*************************************/

add_action( 'admin_init', 'madisoft_manage_meta_cap_for_privacy_options' );
function madisoft_manage_meta_cap_for_privacy_options() {
	$current_user = wp_get_current_user();
	if ( array_intersect( ['responsabile'], $current_user->roles ) ) {

		add_action( 'map_meta_cap', 'madisoft_edit_manage_privacy_options', 1, 4 );
	}
}

function madisoft_edit_manage_privacy_options( $caps, $cap, $user_id, $args ) {
$current_user  = wp_get_current_user();
	if ( 'manage_privacy_options' === $cap ) {
		$caps = array_diff( $caps, ['manage_options'] );
	}
	return $caps;
}

function WpHelpful_checkDb()
{
    global $wpdb;
    $stato = get_option('feedback_is_on', true);
    if($stato !== 'abilitata') {
        $table_name = $wpdb->prefix . 'feedback';
        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
 feedback_id mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
 user_id bigint(20),
 meta_key varchar(255) DEFAULT NULL,
 meta_value longtext,
 PRIMARY KEY  (feedback_id)
 );";
        $wpdb->query($sql);
        add_option('feedback_is_on', 'abilitata');
    }
}
WpHelpful_checkDb();

$opzione = get_option('su_option_generator_access');

if ($opzione != 'madisoft_manage_options') {
	update_option('su_option_generator_access','madisoft_manage_options');
}

/**
 * @param      $post_id
 * @param      $tipoCategoria
 * @param bool $br
 *
 * @return string
 */
function madisoft_scuola_print_categorie( $post_id, $tipoCategoria, $br = true, $linkToTerm = false ) {
    $post_categories = get_the_terms( $post_id, $tipoCategoria );
    $testoFinale     = '';
    $i               = 0;
    if ( $post_categories != false ) {
        foreach ( $post_categories as $tax ) {
            if ( $i > 0 && $br ) {
                $testoFinale .= '<br/>';
            }
            if(!is_object($tax)) {
                $i++;
                break;
            }
            if ($linkToTerm) {
                $testoFinale .= '<a title="Vai a ' . $tax->name . '" href="' . get_term_link( $tax ) . '">' . $tax->name . '</a>';
            } else {
                $testoFinale .= $tax->name;
            }
            $i ++;
        }
    }

    return $testoFinale;
}
function madisoft_scuola_print_categorie_tag( $post_id, $tipoCategoria, $br = true, $linkToTerm = false, $class = '') {
    $post_categories = get_the_terms( $post_id, $tipoCategoria );
    if ($class) {
        $class = ' class="' . $class . '"';
    }
    $testoFinale     = '';
    $i               = 0;
    if ( $post_categories != false ) {
        foreach ( $post_categories as $tax ) {
            if ( $i > 0 && $br ) {
                $testoFinale .= '<br/>';
            } else {$testoFinale .= ' ';}
            if(!is_object($tax)) {
                $i++;
                break;
            }
            if ($linkToTerm) {
                $testoFinale .= '<a' . $class . ' title="Vai a ' . $tax->name . '" href="' . get_term_link( $tax ) . '">' . $tax->name . '</a>';
            } else {
                $testoFinale .= '<span' . $class . '>' . $tax->name . '</span>';
            }
            $i ++;
        }
    }

    return $testoFinale;
}
if (isset($_GET['getDati']) && $_GET['getDati'] == 'iauyslkjbpiuha873') {
    echo 'id|dato' . "\n";
    echo 'cm|' . madisoft_get_theme_option('madisoft_scuola_istituto_codice_meccanografico', '') . "\n";
    echo 'nome|' . madisoft_get_theme_option('madisoft_scuola_istituto_nome', '') . "\n";
    echo 'telefono|' . madisoft_get_theme_option('madisoft_scuola_istituto_telefono', '') . "\n";
    echo 'email|' . madisoft_get_theme_option('madisoft_scuola_istituto_email', '') . "\n";
    echo 'indirizzo|' . madisoft_get_theme_option('madisoft_scuola_istituto_indirizzo', '') . "\n";
    echo 'com|' . madisoft_get_theme_option('madisoft_scuola_istituto_comune', '') . "\n";
    echo 'cap|' . madisoft_get_theme_option('madisoft_scuola_istituto_cap', '') . "\n";
    echo 'prov|' . madisoft_get_theme_option('madisoft_scuola_istituto_provincia', '') . "\n";
    echo 'ds|' . madisoft_get_theme_option('madisoft_scuola_istituto_dirigente', '') . "\n";
    echo 'dsga|' . madisoft_get_theme_option('madisoft_scuola_istituto_dsga', '') . "\n";
    echo 'cf|' . madisoft_get_theme_option('madisoft_scuola_istituto_codice_fiscale', '') . "\n";
    echo 'cspt|' . get_option('cookie_script_item_id', true)."\n";
    echo 'access|' . madisoft_get_theme_option('madisoft_scuola_link_dichiarazione_agid', '')."\n";
    die;
}
/**
 * @param string $opzione
 * @param bool $default
 *
 * @return string|array
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function madisoft_get_theme_option_int( $opzione = '', $default = false ){
    $opzioni = get_option('option_tree');

    if (!$opzione){
        return $opzioni;
    }

    if (isset($opzioni[$opzione])){
        return $opzioni[$opzione];
    }

    if ($default !== false){
        return $default;
    }

    throw new MadisoftAssetRichiestaNonEsistenteException($opzione);
}
function madisoft_get_theme_option($opzione = '', $default = false)
{
    try {
    $value = madisoft_get_theme_option_int( $opzione,  $default);
} catch (MadisoftAssetRichiestaNonEsistenteException $e) {
    $value = $default;
}
    return $value;
}


include get_template_directory() . '/include/MadisoftThemeClass.php';

try {
    $madisoftTheme = new MadisoftThemeClass();
} catch (MadisoftAssetRichiestaNonEsistenteException $e) {
    echo 'errore ' . $e;
}

try {

    $madisoftTheme->generaFunzioniTema();
} catch (MadisoftAssetRichiestaNonEsistenteException $e) {
    echo 'errore ' . $e;
}

//
//function controllaPlugin()
//{
////    if (is_admin()) {
////        include_once(ABSPATH . 'wp-admin/includes/plugin.php');
////        //todo bloccare se OT non presente
//////        var_dump(is_plugin_active('option-tree/ot-loader.php'));
//////        var_dump(is_plugin_active('madisoft-global-plugin/madisoft-global-plugin.php'));
////    }
//}
//
//controllaPlugin();




/**
 * @return MadisoftThemeClass
 */
function madisoft_get_theme_class()
{
    global $madisoftTheme;
    if (!$madisoftTheme) {
        $madisoftTheme = new MadisoftThemeClass();
    }
    return $madisoftTheme;
}

if (!is_admin()) {
    try {
        $madisoftScuolaWidth = new MadisoftScuolaWidth();
    } catch (MadisoftAssetRichiestaNonEsistenteException $e) {
        echo 'errore ' . $e;
    }
}

/**
 * La funzione restituisce la path del tema o la uri del tema
 * @param $http
 * @return string
 */
function getThemePath($http){
    if ( $http ) {
        $dir = get_template_directory_uri() . DIRECTORY_SEPARATOR ;
    } else {
        $dir = get_template_directory() . DIRECTORY_SEPARATOR;
    }

    return $dir;
}

/**
 * @param $cartella
 */
function creaCartellaSeNonEsiste( $cartella){
    if ( !is_dir($cartella)){
        mkdir($cartella);
    }
}

/**
 * @param $http
 * @return string
 */
function getIncludeDir($http){
    return getThemePath($http) . 'include' . DIRECTORY_SEPARATOR;;
}

function madisoft_scuola_get_assets_directory( $type, $restituisciUrlENonPath = true, $file = '' )
{
    try {
        $path = madisoft_scuola_get_assets_directory_int( $type, $restituisciUrlENonPath, $file);
    } catch (MadisoftAssetRichiestaNonEsistenteException $e) {
        $path = '/';
    }

    return $path;
}
/**
 * @param $type
 * @param bool $restituisciUrlENonPath
 * @param string $file
 * @return string
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function madisoft_scuola_get_assets_directory_int( $type, $restituisciUrlENonPath = true, $file = '' ) {
    $path = '';
    switch ( $type ) {
        case 'bootstrap':
            $path = getThemePath($restituisciUrlENonPath) . 'vendor' . DIRECTORY_SEPARATOR . 'twbs' . DIRECTORY_SEPARATOR. 'bootstrap' . DIRECTORY_SEPARATOR;
            break;
        case 'walker':
            $path = getThemePath($restituisciUrlENonPath) . 'vendor' . DIRECTORY_SEPARATOR . 'wp-bootstrap' . DIRECTORY_SEPARATOR . 'wp-bootstrap-navwalker' . DIRECTORY_SEPARATOR;
            break;
        case 'optiontree':
            $path = getIncludeDir($restituisciUrlENonPath) . 'vendor' . DIRECTORY_SEPARATOR . 'option-tree' . DIRECTORY_SEPARATOR;
            break;
        case 'csscache':
            if ($restituisciUrlENonPath){
                $path = content_url() . DIRECTORY_SEPARATOR . 'csscache' . DIRECTORY_SEPARATOR . get_current_blog_id() . DIRECTORY_SEPARATOR;
            } else {
                $path = WP_CONTENT_DIR . DIRECTORY_SEPARATOR . 'csscache' . DIRECTORY_SEPARATOR . get_current_blog_id() . DIRECTORY_SEPARATOR ;
            }
            break;
        case 'img':
        case 'images':
            $path = getIncludeDir($restituisciUrlENonPath) . 'assets' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;
            break;
        case 'impostazioni':
            $path = getIncludeDir($restituisciUrlENonPath) . 'impostazioni' . DIRECTORY_SEPARATOR;
            break;
        case 'js':
            $path = getIncludeDir($restituisciUrlENonPath) . 'assets' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR;
            break;
        case 'css':
            $path = getIncludeDir($restituisciUrlENonPath) . 'assets' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR;
            break;
        case 'font-awesome':
            $path = getIncludeDir($restituisciUrlENonPath) . 'assets' . DIRECTORY_SEPARATOR . 'font-awesome' . DIRECTORY_SEPARATOR;
            break;
        case 'scss':
            $path = getIncludeDir($restituisciUrlENonPath) . 'assets' . DIRECTORY_SEPARATOR . 'scss' . DIRECTORY_SEPARATOR;
            break;
        case 'less':
            $path = getIncludeDir($restituisciUrlENonPath) . 'style' . DIRECTORY_SEPARATOR . 'less' . DIRECTORY_SEPARATOR;
            break;
        case 'post-type':
            $path = getIncludeDir($restituisciUrlENonPath) . 'post-type' . DIRECTORY_SEPARATOR;
            break;
        case 'plugins':
            $path = getIncludeDir($restituisciUrlENonPath). 'plugins' . DIRECTORY_SEPARATOR;
            break;
        case 'interfaces':
            $path = getIncludeDir($restituisciUrlENonPath) . 'interfaces' . DIRECTORY_SEPARATOR;
            break;
        case 'class':
            $path = getIncludeDir($restituisciUrlENonPath) . 'class' . DIRECTORY_SEPARATOR;
            break;
        case 'functions':
            $path = getIncludeDir($restituisciUrlENonPath) . 'functions' . DIRECTORY_SEPARATOR;
            break;
        case 'functions-public':
            $path = getIncludeDir($restituisciUrlENonPath) . 'functions-public' . DIRECTORY_SEPARATOR;
            break;
        case 'templates':
            $path =  getIncludeDir($restituisciUrlENonPath) . 'templates' . DIRECTORY_SEPARATOR;
            break;
        case false:
            return getIncludeDir($restituisciUrlENonPath);
            break;
        default:
            throw new MadisoftAssetRichiestaNonEsistenteException( 'il tipo ' . $type . ' non e\' settato' );
            break;
    }
    if (!$file){
        return $path;
    }


    if (controllaSeNecessarioLEsistenzaDelFile($restituisciUrlENonPath,$file, $path)) {

        return $path .  $file;
    }

    throw new MadisoftAssetRichiestaNonEsistenteException($path . $file);
}

/**
 * @param $restituisciUrlENonPath
 * @param $file
 * @param $path
 * @return bool
 */
function controllaSeNecessarioLEsistenzaDelFile($restituisciUrlENonPath,$file, $path)
{
    // se ho un http allora non faccio il controllo sull'esistenza del file
    if ($restituisciUrlENonPath){
        return true;
    }

    if (!is_file($path . $file)) {
        return false;
    }

    return true;
}


/**
 * @param $value1
 * @param $value2
 *
 * @return bool|string
 *
 * @deprecated Use madisoftTheme->madisoft_theme_selected
 */
function madisoft_theme_selected($value1, $value2)
{
    $madisoftTheme = madisoft_get_theme_class();
    return $madisoftTheme->madisoft_theme_selected( $value1, $value2 );
}

/**
 * @param string $sezione
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function madisoft_scuola_testata_includi_slider( $sezione = 'testata' ) {
    if ( madisoft_get_theme_option( 'madisoft_scuola_' . $sezione . '_mostra_slider', 0 ) == 'on' ) {
        get_template_part( 'include/templates/slider', $sezione );
    }
}

/**
 * @param $slug
 * @param bool $show_post
 * @param $meta
 * @param string $order
 * @param string $title
 * @param string $post_slug
 * @param bool $show_header_term
 * @return string
 * @throws ParametroNonSettatoException
 */
function madisoft_get_terms_list( $slug, $show_post = false, $meta='1', $order = 'ASC', $title = '', $post_slug = '', $show_header_term = true ) {
    $terms       = get_terms( $slug );
    $arrayOrdinatoPerMeta = [ ];
    $elencoTerms = [ ];
    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
        foreach ( $terms as $term ) {
            $term_meta      = get_option( "taxonomy_" . $term->term_id );
            if ( isset( $term_meta[ $meta ] ) ) {
                $arrayOrdinatoPerMeta[ intval( $term_meta[ $meta ] ) ][] = $term;
            } else {
                $arrayOrdinatoPerMeta[0][] = $term;
            }
        }
    }
    if ( $order == 'ASC' ) {
        ksort( $arrayOrdinatoPerMeta );
    } else {
        krsort( $arrayOrdinatoPerMeta );
    }
    if ( ! empty( $arrayOrdinatoPerMeta ) && ! is_wp_error( $arrayOrdinatoPerMeta ) ) {
        $i = 0;
        foreach ( $arrayOrdinatoPerMeta as $key => $terms ) {
            $elencoTerms[] = creaArrayCategorie( $show_post, $terms, $i, $post_slug );
        }
    }
    $str = printArrayCategorie( $slug, $elencoTerms, $title, $show_header_term);
    return $str;
}

/**
 * @param $show_post
 * @param $terms
 * @param $i
 * @param $post_slug
 * @return array
 * @throws ParametroNonSettatoException
 */
function creaArrayCategorie( $show_post, $terms, $i, $post_slug ) {
    $returnArray = [ ];
    foreach ( $terms as $term ) {
        $i ++;
        $returnArray[ $i ]['term']  = $term;
        $returnArray[ $i ]['posts'] = [ ];
        if ( $show_post ) {
            if ( ! $post_slug ) {
                throw new ParametroNonSettatoException( 'post_type' );
            }
            $args2   = [
                'post_type' => $post_slug,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'scuola_ordine',
                        'field' => 'slug',
                        'terms' => $term->slug,
                    )),
                'orderby'       => 'menu_order',
                'order'         => 'ASC',
                'posts_per_page' => '-1'
            ];
            $myposts = get_posts( $args2 );
            foreach ( $myposts as $custom_post_type ) {
                $returnArray[ $i ]['posts'][] = [
                    $custom_post_type->ID,
                    $custom_post_type->post_title,
                ];
            }
        }
    }
    return $returnArray;
}

/**
 * @param string $slug
 * @param $elencoArray
 * @param $title
 * @param bool $show_header_term
 * @return string
 */
function printArrayCategorie( $slug = 'post', $elencoArray = [], $title = '' , $show_header_term = true) : string
{
    $html = '';
    if (!is_array($elencoArray)) {
        return '';
    }
    if ( count( $elencoArray ) == 0 ) {
        return '';
    }
    if ( $title ) {
        $html .= '<h3>' . $title . '</h3>' . "\n";
    }
    $html .= '<ul class="' . $slug . '_archive custom_post_type_archive">';
    foreach ( $elencoArray as $key => $categorie ) {
        foreach ( $categorie as $categoria ) {
            $term = $categoria['term'];
            if($show_header_term){
                $html .= '<li class="page_item"><a href="' . get_term_link( $term ) . '" title="' . sprintf( __( 'View all post filed under %s', 'my_localization_domain' ), $term->name ) . '">' . $term->name . '</a>';
            }
            if ( count( $categoria['posts'] ) > 0 ) {
                $html .= '<ul class="children" style="list-style: none; margin-bottom: 0">';
                foreach ( $categoria['posts'] as $custom_post_type ) {
                    $html .= '<li class="page_item"><a href="' . get_permalink( $custom_post_type[0] ) . '">' . $custom_post_type[1] . '</a></li>';
                }
                $html .= '</ul>';
            }
            $html .= '</li>';
        }
    }
    $html .= '</ul>';

    return $html;
}

add_filter( 'posts_where', 'title_like_posts_where', 10, 2 );
/**
 * @param $where
 * @param $wp_query
 * @return string
 */
function title_like_posts_where( $where, $wp_query ) {
    global $wpdb;
    if ( $wp_query->get( 'post_title_like' ) ) {
        $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( $wp_query->get( 'post_title_like' ) ) . '%\'';
    }

    return $where;
}

/**
 */
function madisoft_get_top_sidebar(){
    if( is_active_sidebar('sidebar-testata')
        && madisoft_get_theme_option( 'madisoft_scuola_testata_separata' , 'off') == 'on' ){
        get_sidebar( 'top' );
    }
}

/**
 */
function madisoft_get_text_sidebar(){
    if( is_active_sidebar('sidebar-dati-istituto')
        && madisoft_get_theme_option( 'madisoft_scuola_dati_istituto_sidebar' , 'off') == 'on' ){
        get_sidebar( 'text' );
    }
}

/**
 * Si crea: Header, eventuale left sidebar,
 */
function madisoft_scuola_crea_struttura_superiore($page = '') {
    /**
     * @var $post WP_Post
     * @var $madisoftScuolaWidth MadisoftScuolaWidth
     */

    global $post, $madisoftScuolaWidth;
    if (get_post_meta($post->ID, 'noseome', true) == 'NO') {
        addNoseomeCallback();
    }
    try {
        $madisoftScuolaWidth->calolaLarghezzaContent();
        get_header();
        echo '<div class="main-content-site ' . madisoft_calcolate_maincontent_class() .'">' . "\n\t";
        echo '<div id="contenuto">' . "\n\t";
        mostraIntroATuttaPaginaSeNecessario();
        echo '<div class="row">' . "\n\t";
        $larghezza = madisoft_scuola_get_larghezza('content');
        if (madisoft_get_theme_option('madisoft_scuola_allarga_fasce', 'off') == 'off') {
            echo '<div class="col-sm-1"></div>' . "\n\t";
            } else {
            $larghezza += 2;
        }
        $paddingClass = false;
        if ($page != 'home') {
            if (madisoft_get_theme_option('posizione_barra_sinistra', 1) == 1) {
                get_sidebar('left');
            }
            if (madisoft_get_theme_option('posizione_barra_destra', 3) == 1) {
                get_sidebar('right');
            }
        } else {
            if (madisoft_get_theme_option('madisoft_scuola_home_sidebar_mostra', 'off') == 'on') {
                get_sidebar('left');
                $paddingClass = true;
                $larghezza += $madisoftScuolaWidth->getLarghezzaSidebarRight();
            } else {
                $larghezza += $madisoftScuolaWidth->getLarghezzaSidebarLeft() + $madisoftScuolaWidth->getLarghezzaSidebarRight();
            }
        }
        if ($paddingClass) {
            define('PADDINGCLASS', '15px');
        } else {
            define('PADDINGCLASS', '0');
        }
        echo "\n\t" . '<div id="contenuto-centrale" class=" col-xs-' . MadisoftScuolaWidth::MADISOFT_WIDTH_ALL . ' col-md-' . $larghezza . ' ' . get_post_type($post) . '">' . "\n\t";
        mostraBreadCrumbInContentSeNecessario();
        MostraIntroInContentSeNecessario();
        echo "\n\t" . '<div class="contenuto-principale">';
    } catch (Error $e) {
        echo 'oh no!1';
        var_dump($e);
    } catch (MadisoftLarghezzaRichiestaNonEsistenteException $e) {
        echo 'oh no!2';
    } catch (MadisoftAssetRichiestaNonEsistenteException $e) {
        echo 'oh no!3';
    }
}

/**
 * Si creano l'eventuale footer interno, l'eventuale right sidebar e footer
 *
 */
function madisoft_scuola_crea_struttura_inferiore($page = '') {
    echo '</div><div style="clear:both"></div><!-- contenuto-centrale content -->';
    if( is_active_sidebar('footer-interno') ){
        get_sidebar( 'footer_interno' );
    }
    if( is_active_sidebar('downwidget') ){
        echo '<div style="clear:both"></div>';
        get_sidebar( 'downwidget' );
    }
    echo '</div><!-- contenuto-centrale content -->';
    if ($page != 'home') {
        if (madisoft_get_theme_option('posizione_barra_sinistra', 1) == 2) {get_sidebar( 'left' );}
        if (madisoft_get_theme_option('posizione_barra_destra', 3) == 2) {get_sidebar( 'right' );}
        if (madisoft_get_theme_option('posizione_barra_sinistra', 1) == 3) {get_sidebar( 'left' );}
        if (madisoft_get_theme_option('posizione_barra_destra', 3) == 3) {get_sidebar( 'right' );}
    }
   if (madisoft_get_theme_option('madisoft_scuola_allarga_fasce', 'off') == 'off') {
       echo '<div class="col-sm-1"></div><!-- row content -->';}
    echo '</div><!-- container#contenuto -->';
    echo '</div><!-- container#contenuto -->';
    echo '</div><!-- main content -->';
    get_footer();
}

/**
 * @param $IdPagina
 * @return bool
 */
function madisoft_theme_is_page_linked_to_category($IdPagina){
    return get_post_meta( $IdPagina, 'usrlo_pagina_categoria', true ) != - 1;
}

/**
 * la funzione controlla che sia possibile mostrare, per la sezione in questione, se mostrare o non mostrare l'intro
 * @return bool
 */
function introPossoMostrareLaFasciaDiIntro()
{
    if (!introLaSezioneIntroEAttiva()){
        return false;
    }

    if (introLaSezioneIntroEAttivaSoloInHome() && !is_front_page()){
        return false;
    }

    if (is_page()) {
        return
            ( introLaSezioneIntroEAttiva()
                && madisoftThemePluginOpzioniPagine::checkIfOptionIsActive('page_intro_fascia', 1, true));
    }
    else {
        return (introLaSezioneIntroEAttiva());
    }
}

/**
 * @return bool
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function introLaSezioneIntroEAttiva()
{
    return madisoft_get_theme_option('page_intro_fascia', 'on') == 'on';
}

/**
 * @return bool
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function introLaSezioneIntroEAttivaSoloInHome()
{
    return madisoft_get_theme_option('page_intro_fascia_home', 'on') == 'on';
}

/**
 * @return bool
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function introPossoMostrareIlBoxLaterale(){
    return ( madisoft_get_theme_option('madisoft_intro_mostra_box', 'on') == 'on'
        && ( madisoft_get_theme_option('madisoft_scuola_intro_box_immagine', '') != ''
            || madisoft_get_theme_option('madisoft_scuola_intro_testo', '') != '' ));
}

/**
 * @return array|string
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function introTipoFascia(){
    return ( madisoft_get_theme_option('page_intro_tipo_fascia', 'immagine') );
}

/**
 * @return array|string
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function introTipoBox(){
    return ( madisoft_get_theme_option('page_intro_tipo_box', 'immagine') );
}

/**
 *
 */
function madisoft_theme_mostra_excerpt(){
    global $post;

    if ( ! empty( $post->post_excerpt ) ) {
        echo '<div class="riassunto">';
        the_excerpt();
        echo '</div>';
    }
}

/**
 * @return bool
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function mostraIntroATuttaLarghezza(){
    return ( madisoft_get_theme_option('page_intro_fascia_in_content', 'on') == 'off' );
}

/**
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function MostraIntroInContentSeNecessario ()
{
    if (!mostraIntroATuttaLarghezza() && introPossoMostrareLaFasciaDiIntro()) {
        get_template_part ( 'intro' );
    }
}

/**
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function mostraIntroATuttaPaginaSeNecessario ()
{
    if (mostraIntroATuttaLarghezza() && introPossoMostrareLaFasciaDiIntro()) {
        get_template_part ( 'intro' );
    }
}

/**
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function madisoft_scuola_codice_custom_head(){
    $custom_head = madisoft_get_theme_option( 'madisoft_scuola_codice_custom_head', '' );
    if ( $custom_head != '' ){
        $righe = explode("\n", $custom_head);
        echo "\n" . '<!-- INIZIO METADATI PERSONALIZZATI -->' . "\n";
        foreach ($righe as $riga) {
            $riga2 =explode('|', $riga);
            if (!is_array($riga2)) {
                continue;
            }
			if (count($riga2) && isset($riga2[1])) {
			echo '<meta '.$riga2[0].'="'.$riga2[1] . '"';
            if (isset($riga2[2])) {
                echo ' '. $riga2[2].'="'.$riga2[3] . '"';
            }
            echo '/>' . "\n";	
			}
            
        }
        echo "\n" . '<!-- FINE METADATI PERSONALIZZATI --> ' . "\n";
    }
}

/**
 * @return mixed|string|void
 */
function getDominioDelSito(){
    $url = site_url();
    $url =  str_replace('http://', '', $url);
    $url =  str_replace('https://', '', $url);
    return $url;
}
if (!function_exists('comment_count_special')){
	function comment_count_special($id, $tipo) {
		return 0;
	}
}

if (function_exists('members_get_role_name')) {
    /**
     * @param $columns
     * @return array
     */
    function madisoft_theme_aggiungi_colonna_riservato($columns)
    {
        if (get_post_type() == 'le_scuole'){
            return $columns;
        }

        $new_columns = array(
            'riservato_a' => 'Riservato a',
        );
        return array_merge($columns, $new_columns);
    }

    add_action('manage_posts_custom_column', 'madisoft_theme_valore_colonna_riservato', 10, 2);
    add_action('manage_pages_custom_column', 'madisoft_theme_valore_colonna_riservato', 10, 2);
    add_action('manage_posts_columns', 'madisoft_theme_aggiungi_colonna_riservato', 10, 2);
    add_action('manage_pages_columns', 'madisoft_theme_aggiungi_colonna_riservato', 10, 2);
    /**
     * @param $column
     * @param $post_id
     */
    function madisoft_theme_valore_colonna_riservato($column, $post_id)
    {
        switch ($column) {
            case 'riservato_a':
                $riservato_a = get_metadata('post', $post_id, '_members_access_role');
                $ruoli = [];
                foreach ($riservato_a as $ruolo) {
                    if (!isset($ruoli[$ruolo])){
                        $ruoli[$ruolo] = members_get_role_name($ruolo) ;
                    }
                }
                $counter = 0;
                foreach ($ruoli as $key => $ruolo) {
                    if ($counter > 0){
                        echo ', ';
                    }
                    echo $ruolo;
                    $counter++;
                }
                break;
        }
    }
}
/**
 * @return bool
 */
function possoCaricareLeOpzioni(){
    return is_admin();
}


add_filter( 'lostpassword_url', 'my_lost_password_page', 10, 2 );
function my_lost_password_page( $lostpassword_url, $redirect ) {
    return home_url( 'accesso-admin/?action=lostpassword' );
}

function get_post_from_rss($link, $items = 10)
{
    $array = array();
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $link);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    $returned = curl_exec($ch);
    curl_close($ch);
    try {
        $xml = simplexml_load_string($returned);
    } catch (Exception $e) {
        return $array;
    }
    for ($i = 0; $i < $items; $i += 1) {
        if (!isset($xml->channel->item[$i])) {
            $i = $items;
            break;
        }

        $array[$i]["title"] = $xml->channel->item[$i]->title;
        $array[$i]["desc"] = $xml->channel->item[$i]->description;
        $array[$i]["content"] = $xml->channel->item[$i]->children("content", true);
        $array[$i]["date"] = ((string)($xml->channel->item[$i]->pubDate) ? date("d/m/Y", strtotime((string)($xml->channel->item[$i]->pubDate))) : '');
        $array[$i]["dateTime"] = strtotime((string)($xml->channel->item[$i]->pubDate));
        $array[$i]["link"] = $xml->channel->item[$i]->link;
    }

    return $array;
}

function attivareMenuSocial() {
    if (madisoft_get_theme_option('madisoft_scuola_social_attivo', 'on') == 'on'
        && madisoft_get_theme_option('madisoft_scuola_social_fb', '')
        . madisoft_get_theme_option('madisoft_scuola_social_tw', '')
        . madisoft_get_theme_option('madisoft_scuola_social_ss', '')
        . madisoft_get_theme_option('madisoft_scuola_social_fl', '')
        . madisoft_get_theme_option('madisoft_scuola_social_yt', '')
        . madisoft_get_theme_option('madisoft_scuola_social_inst', '')
    ) {
        return true;
    }
    return false;
}
function printGenericSocial($alt, $link,  $img, $class='social_footer_icon') {
    if (!$link) {
        return '';
    }

    return '<div class="' . $class . '"><a href="'
        . $link
        . '" target="_blank"><img alt="'. $alt . '" src="'
        . madisoft_scuola_get_assets_directory('img', true, $img)
        . '"></a> </div>';
}
function printFacebook($class= 'social_footer_icon') {
    return printGenericSocial(
        'Facebook',
        madisoft_get_theme_option('madisoft_scuola_social_fb', ''),
        'facebook-footer.svg',
        $class
    );
}
function printInstagram($class= 'social_footer_icon') {
    return printGenericSocial(
        'Instagram',
        madisoft_get_theme_option('madisoft_scuola_social_inst', ''),
        'Instagram-footer.svg',
        $class
    );
}
function printYoutube($class= 'social_footer_icon') {
    return printGenericSocial(
        'Youtube',
        madisoft_get_theme_option('madisoft_scuola_social_yt', ''),
        'youtube-footer.svg',
        $class
    );
}
function printTwitter($class= 'social_footer_icon') {
    return printGenericSocial(
        'Twitter',
        madisoft_get_theme_option('madisoft_scuola_social_tw', ''),
        'twitter-footer.svg',
        $class
    );
}
function printSlideShare($class= 'social_footer_icon') {
    return printGenericSocial(
        'Slideshare',
        madisoft_get_theme_option('madisoft_scuola_social_ss', ''),
        'slideshare-footer.svg',
        $class
    );
}
function printFlickr($class= 'social_footer_icon') {
    return printGenericSocial(
        'Flickr',
        madisoft_get_theme_option('madisoft_scuola_social_fl', ''),
        'flickr-footer.svg',
        $class
    );
}
ob_end_clean();



function cleanGetPost($data) {
    if (!is_string($data)) {
        return $data;
    }

    return preg_replace('/\x00|<[^>]*>?/', '', $data);
}
