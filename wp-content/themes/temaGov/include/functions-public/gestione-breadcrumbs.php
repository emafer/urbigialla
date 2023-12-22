<?php
/**
 * @return string
 */
function custom_breadcrumbs() {
    $textHtml = '';
    // Settings
    $breadcrumbs_id      = 'breadcrumbs';
    $breadcrumbs_class   = 'breadcrumb';
    $home_title          = 'Home';
    $prefix              = '';

    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = '';

    // Get the query & post information
    global $post,$wp_query;

    // Do not display on the homepage
    if ( is_front_page() ) {
        return '';
    }
    // Build the breadcrums
    $textHtml .= '<ol id="' . $breadcrumbs_id . '" class="' . $breadcrumbs_class . '">' . "\n";

    // Home page
    $textHtml .= '<li class="breadcrumb-item bread-home"><a href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>' . "\n";

    if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {

        $textHtml .= '<li class="breadcrumb-item active">' . post_type_archive_title($prefix, false) . '</li>';

    }
    else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {
        // If post is a custom post type
        $post_type = get_post_type();

        if (!$post_type && get_query_var('taxonomy') == 'tipologie'){
            $post_type = 'amm-trasparente';
        }

        // If it is a custom post type display name and link
        if($post_type != 'post') {

            $post_type_object = get_post_type_object($post_type);
            if ($post_type == 'amm-trasparente'){
                $post_type_archive = '/amministrazione-trasparente';
            } else {
                $post_type_archive = get_post_type_archive_link($post_type);
            }
            $textHtml .= '<li class="breadcrumb-item item-custom-post-type-' . $post_type . '"><a href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>' . "\n";

        }
        $custom_tax_name = get_queried_object()->name;
        $textHtml .= '<li class="breadcrumb-item active">' . $custom_tax_name . '</li>';

    }
    else if ( is_single() ) {

        // If post is a custom post type
        $post_type = get_post_type();

        // If it is a custom post type display name and link
        if($post_type != 'post') {

            $post_type_object = get_post_type_object($post_type);
            if ($post_type == 'amm-trasparente'){
                $post_type_archive = '/amministrazione-trasparente';
            } else {
                $post_type_archive = get_post_type_archive_link($post_type);
            }

            $textHtml .= '<li class="breadcrumb-item"><a href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';

        }

        // Get post category info
        $category = get_the_category();

        if(!empty($category)) {

            // Get last category post is in
            $last_category = $category[( count($category) - 1 )];

            // Get parent any categories and create array
            $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
            $cat_parents = explode(',',$get_cat_parents);

            // Loop through parent categories and store in variable $cat_display
            $cat_display = '';
            foreach($cat_parents as $parents) {
                $cat_display .= '<li class="breadcrumb-item">'.$parents.'</li>';
            }

        }

        // If it's a custom post type within a custom taxonomy
        $taxonomy_exists = taxonomy_exists($custom_taxonomy);
        if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {

            $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
            $cat_id         = $taxonomy_terms[0]->term_id;
            $cat_nicename   = $taxonomy_terms[0]->slug;
            $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
            $cat_name       = $taxonomy_terms[0]->name;

        }

        // Check if the post is in a category
        if(!empty($last_category)) {
            $textHtml .= $cat_display;
        } else if(!empty($cat_id)) {
            $textHtml .= '<li class="breadcrumb-item"><a href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a>&nbsp;/&nbsp;</li>' . "\n";
        }
        $textHtml .= '<li class="bread-crumb-item active">&nbsp;/&nbsp;' . madisoft_scuola_protect_title() . '</li>';

    }
    else if ( is_category() ) {
        // Category page
        $textHtml .= '<li class="breadcrumb-item active">' . single_cat_title('', false) . '</li>' . "\n";

    }
    else if ( is_page() ) {

        // Standard page
        if( $post->post_parent ) {

            // If child page, get parents
            $anc = get_post_ancestors($post->ID);

            // Get parents in the right order
            $anc = array_reverse($anc);

            // Parent page loop
            if (!isset($parents)) $parents = null;
            foreach ($anc as $ancestor) {
                $parents .= '<li class="breadcrumb-item"><a href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>' . "\n";
            }

            // Display parent pages
            $textHtml .= $parents;
        }
        // Current page
        $textHtml .= '<li class="breadcrumb-item active"> ' . madisoft_scuola_protect_title() . '</li>';
    }
    else if ( is_tag() ) {

        // Tag page

        // Get tag information
        $term_id        = get_query_var('tag_id');
        $taxonomy       = 'post_tag';
        $args           = 'include=' . $term_id;
        $terms          = get_terms( $taxonomy, $args );
        $get_term_id    = $terms[0]->term_id;
        $get_term_slug  = $terms[0]->slug;
        $get_term_name  = $terms[0]->name;

        // Display the tag name
        $textHtml .= '<li class="breadcrumb-item active">' . $get_term_name . '</li>';

    }
    elseif ( is_day() ) {

        // Day archive

        // Year link
        $textHtml .= '<li class="breadcrumb-item><a href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . '</a></li>' . "\n";

        // Month link
        $textHtml .= '<li class="breadcrumb-item><a href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('m') . '">' . get_the_time('M') . '</a></li>' . "\n";

        // Day display
        $textHtml .= '<li class="item-current item-' . get_the_time('j') . '"><strong class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</strong></li>';

    }
    else if ( is_month() ) {

        // Month Archive

        // Year link
        $textHtml .= '<li class="breadcrumb-item><a href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . '</a></li>' . "\n";

        // Month display
        $textHtml .= '<li class="breadcrumb-item active">' . get_the_time('M') . '</li>';

    }
    else if ( is_year() ) {

        // Display year archive
        $textHtml .= '<li class="breadcrumb-item active">' . get_the_time('Y') . '</li>';

    }
    else if ( is_author() ) {

        // Auhor archive

        // Get the author information
        global $author;
        $userdata = get_userdata( $author );

        // Display author name
        $textHtml .= '<li class="breadcrumb-item active">' . 'Autore: ' . $userdata->display_name . '</li>';

    }
    else if ( get_query_var('paged') ) {

        // Paginated archives
        $textHtml .= '<li class="breadcrumb-item active">'.__('Page') . ' ' . get_query_var('paged') . '</li>';

    }
    else if ( is_search() ) {

        // Search results page
        $textHtml .= '<li class="breadcrumb-item active">Ricerca per: "' . get_search_query() . '"</li>';

    }
    elseif ( is_404() ) {

        // 404 page
        $textHtml .= '<li class="breadcrumb-item">' . 'Error 404' . '</li>';
    }

    $textHtml .= '</ol>';

    return $textHtml;
}

/**
 * @return bool
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function madisoft_theme_can_i_show_breadcrumb(){
    if (!is_page()  ){
        return ( madisoft_get_theme_option('madisoft_scuola_grafica_mostra_breadcrumb', 'on') == 'on');
    } else
    {
        return
            ( madisoft_get_theme_option('madisoft_scuola_grafica_mostra_breadcrumb', 'on') == 'on'
                && madisoftThemePluginOpzioniPagine::checkIfOptionIsActive('page_show_breadcrumb', 1) );
    }
}

/**
 * @return bool
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function mostraBreadcrumbATuttaLarghezza(){
    return ( madisoft_get_theme_option('page_breadcrumb_in_content', 'on') == 'off' );
}

/**
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function mostraBreadCrumbInContentSeNecessario ()
{
    if (!mostraBreadcrumbATuttaLarghezza ()) {
       get_template_part ( 'breadcrumbs' );
    }
}

/**
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function mostraBreadcrumbATuttaPaginaSeNecessario ()
{
    if (mostraBreadcrumbATuttaLarghezza ()) {
        get_template_part ( 'breadcrumbs' );
    }
}
