<?php
/**
 * @param $element
 * @return int
 */
function madisoft_scuola_get_larghezza($element) {
    try {
       $larghezza = madisoft_scuola_get_larghezza_int($element);
    } catch (MadisoftLarghezzaRichiestaNonEsistenteException $e) {
        $larghezza = MadisoftScuolaWidth::MADISOFT_WIDTH_1_4;
    }

    return $larghezza;
}

/**
 * @param $element
 * @return int
 * @throws MadisoftLarghezzaRichiestaNonEsistenteException
 */
function madisoft_scuola_get_larghezza_int($element)
{
    /** @var $madisoftScuolaWidth MadisoftScuolaWidth*/
    global $madisoftScuolaWidth;
    switch ($element){
        case 'logo':
            return $madisoftScuolaWidth->getLarghezzaLogoHeader();
            break;
        case 'header-text':
            return $madisoftScuolaWidth->getLarghezzaTextHeader();
            break;
        case 'header-slide':
            return $madisoftScuolaWidth->getLarghezzaSlideHeader();
            break;
        case 'text-sidebar':
            return $madisoftScuolaWidth->getLarghezzaTextSidebar();
            break;
        case 'top-sidebar':
            return $madisoftScuolaWidth->getLarghezzaTopSidebar();
            break;
        case 'content':
            return $madisoftScuolaWidth->getLarghezzaContent();
            break;
        case 'right':
            return $madisoftScuolaWidth->getLarghezzaSidebarRight();
            break;
        case 'left':
            return $madisoftScuolaWidth->getLarghezzaSidebarLeft();
            break;
        default:
            throw new MadisoftLarghezzaRichiestaNonEsistenteException();
    }

}

/**
 * @return string
 */
function madisoft_calcolate_maincontent_class(){
    if (madisoft_get_theme_option('larghezza_totale', 'on') == 'on') {
//        return 'container-fluid';
    return '';
    }

    return 'container';
}


function aggiornaValoreTemplate(){
global $post;
if (!$post) {
    $idPost = $_GET['post'];
} else {
    $idPost = $post->ID;
}
    $template = get_post_meta($idPost, '_wp_page_template', true);

    switch ($template){
        case 'tmpl_home.php':
        case 'tmpl_mappa.php':
        case 'tmpl_contatti.php':
            case 'default';
        default:
            break;
        case 'tmpl_nobars.php':
            delete_post_meta($idPost, '_wp_page_template');
            update_post_meta(get_the_ID(), 'page_struttura_colonne', '1');
            break;
        case 'tmpl_noleft.php':
            delete_post_meta($idPost, '_wp_page_template');
            update_post_meta(get_the_ID(), 'page_struttura_colonne', '2r');
            break;
        case 'tmpl_noright.php':
            delete_post_meta($idPost, '_wp_page_template');
            update_post_meta(get_the_ID(), 'page_struttura_colonne', '2l');
            break;
    }
}