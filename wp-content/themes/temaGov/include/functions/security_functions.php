<?php

/**
 * @param bool $post_id
 * @return bool
 */
function possoVisualizzareQuestoContenuto($post_id = false)
{
    if (!$post_id){
        global $post;
        $post_id = $post->ID;
    }
    $roles = get_post_meta( $post_id, '_members_access_role' );
    if ( !empty( $roles ) && is_array( $roles ) ) {
        foreach( $roles as $role ) {
            if ( !is_feed() && ( current_user_can( $role ) || current_user_can( 'restrict_content' ) ) ){
                return true;
            }
        }
        return false;
    }
    return true;
}


add_action( 'admin_enqueue_scripts', 'madisoftAvoidWeakPass' );
function madisoftAvoidWeakPass()
{
    wp_enqueue_style('avoidWeak', madisoft_scuola_get_assets_directory('css' ) . 'admin.css');
}