<?php


madisoft_get_theme_class()->getImpostazioniClass()->aggiungiImpostazione('general',  [
    'id'           => 'madisoft_scuola_user_can_change_password',
    'label'        => 'PERMETTERE MODIFICA PASSWORD AGLI UTENTI NON RESPONSABILI',
    'desc'         => 'Si consiglia di lasciare a OFF questa opzione, perch&egrave; manterrete alto lo status di accessibilit&agrave;',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'general',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);

madisoft_get_theme_class()->getImpostazioniClass()->aggiungiImpostazione('general',  [
    'id'           => 'madisoft_scuola_user_can_view_admin',
    'label'        => 'PERMETTERE L\'ACCESSO ALL\'AREA RISERVATA AGLI UTENTI NON RESPONSABILI',
    'desc'         => '',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'general',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);

//On-off possibilità di modifica password agli utenti con permessi "edit_posts"
if( !current_user_can( 'edit_posts' ) ) {
    if ( !lUtentePuoCambiarsiLaPassword() ){
        add_filter( 'show_password_fields', '__return_false' );
    }
}

function lUtentePuoCambiarsiLaPassword(){
    return ( madisoft_get_theme_option('madisoft_scuola_user_can_change_password', 'off') == 'on');
}

function lUtentePuoAccedereAllAreaAdmin(){
    return ( madisoft_get_theme_option('madisoft_scuola_user_can_view_admin', 'off') != 'off');
}


function no_admin_init() {
    global $pagenow;
    $required_capability = 'edit_posts';
    $required_capability2 = 'edit_pages';
    $redirect_to = get_option('home');
    if ( is_admin() && $pagenow != 'admin-ajax.php' ) {
        if (!current_user_can($required_capability) && !current_user_can($required_capability2)) {
            wp_redirect($redirect_to,302);
        }
    }
}
if(!lUtentePuoAccedereAllAreaAdmin()){
    add_action('init','no_admin_init',0);
}