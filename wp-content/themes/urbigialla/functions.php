<?php
include __DIR__ . '/include/post-type/attivita.php';
function register_navwalker(){
    require_once get_template_directory() . '/vendor/wp-bootstrap/wp-bootstrap-navwalker/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );

function getAssetUri(string $type, bool $uri = true) : string
{
    $dir = '/assets/';
    switch ($type) {
        case 'images':
            $dir .= 'images/';
            break;
        case 'js':
            $dir .= 'js/';
            break;
        case 'bootstrap':
            return get_template_directory_uri() . '/vendor/twbs/bootstrap/dist/css/bootstrap.css';
            break;
        default:
            throw new Exception('Attenzione, assetType ' . $type .' non riconosciuto');
            break;
    }
    if ($uri) {
        return get_template_directory_uri() . $dir;
    }

    return get_template_directory() . $dir;
}

function getAssetFile(string $type, string $file,bool $uri = true) {
    $file = getAssetUri($type, $uri) . $file;
    if (!$uri && !is_file($file)) {
        throw new Exception('Stai cercando il file ' . $file . 'ma non mi risulta esistere');
    }

    return $file;
}

function register_my_menus() {
    register_nav_menus(
        array(
            'menu-1' => __( 'Men&ugrave; superiore' ),
            'menu-2' => __( 'Men&ugrave; inferiore' ),
        )
    );
}
add_action( 'init', 'register_my_menus' );
add_theme_support( 'post-thumbnails' );


function madisoft_custom_admin_css() {
    wp_register_style( 'bootstrap-style-css', getAssetUri('bootstrap' ));
    wp_enqueue_style( 'bootstrap-style-css' );

}
//add_action( 'admin_enqueue_scripts', 'madisoft_custom_admin_css', 10 );
wp_enqueue_script( 'jquery-ui_js',  'https://code.jquery.com/ui/1.11.2/jquery-ui.js', ['jquery' ] );



function ugialla_get_top_template()
{
    get_header();
}

function ugialla_get_bottom_template()
{
    get_footer();
}

function print_categorie_attivita($post) {
    ?>
    <div id="lista_categorie">
        <strong>Categorie</strong><br/>
        <ul>
            <?php
            foreach (get_the_terms($post, 'att_categorie') as $term) {
                echo '<li>' . $term->name . '</li>';
            }
            ?>
        </ul>
    </div>
<?php
}

function print_contatti_attivita($post) {
    $metaAll = get_post_meta($post->ID, '_attivita_meta_data');
    $meta = $metaAll[0];
   echo'
    <div id="contatti_attivita">
        <strong>Contatti</strong><br/>';
        if ($meta['cellulare']) {
            echo '<i class="fa-solid fa-mobile-screen-button" style="color: #fcca4f"></i> <a href="tel:' . $meta['cellulare'] . '">' . $meta['cellulare'] . '</a><br/>';
        }
        if ($meta['telefono']) {
            echo '<i class="fa-solid fa-phone" style="color: #fcca4f"></i>  <a href="tel:' . $meta['telefono'] . '">' . $meta['telefono'] . '</a><br/>';
        }
        if ($meta['email']) {
            echo '<i class="fa-solid fa-envelope" style="color: #fcca4f"></i>  <a href="mailto:' . $meta['email'] . '">' . $meta['email'] . '</a><br/>';
        }
        echo '
    </div>
    ';
}