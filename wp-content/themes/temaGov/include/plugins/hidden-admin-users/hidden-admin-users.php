<?php

class madisoftThemePluginHiddenAdminUser extends madisoftThemePluginClass implements madisoftThemePluginInterface{
    function initFunction()
    {
        add_filter( 'map_meta_cap', [$this, 'mc_admin_users_caps'], 1, 4 );
        remove_all_filters( 'enable_edit_any_user_configuration' );
        add_filter( 'enable_edit_any_user_configuration', '__return_true' );
        add_filter( 'admin_head', [$this, 'mc_edit_permission_check'], 1, 4 );
    }

    function mc_admin_users_caps( $caps, $cap, $user_id, $args ) {

        foreach ( $caps as $key => $capability ) {

            if ( $capability != 'do_not_allow' ) {
                continue;
            }

            switch ( $cap ) {
                case 'edit_user':
                case 'edit_users':
                    $caps[$key] = 'edit_users';
                    break;
                case 'delete_user':
                case 'delete_users':
                    $caps[$key] = 'delete_users';
                    break;
                case 'create_users':
                    $caps[$key] = $cap;
                    break;
            }
        }

        return $caps;
    }
    /**
 * Checks that both the editing user and the user being edited are
 * members of the blog and prevents the super admin being edited.
 */
    function mc_edit_permission_check() {
        global $current_user, $profileuser;

        $screen = get_current_screen();

        wp_get_current_user();

        if ( ! is_super_admin( $current_user->ID ) && in_array( $screen->base, array( 'user-edit', 'user-edit-network' ) ) ) { // editing a user profile
            if ( is_super_admin( $profileuser->ID ) ) { // trying to edit a superadmin while less than a superadmin
                wp_die( __( 'You do not have permission to edit this user.' ) );
            } elseif ( ! ( is_user_member_of_blog( $profileuser->ID, get_current_blog_id() ) && is_user_member_of_blog( $current_user->ID, get_current_blog_id() ) ) ) { // editing user and edited user aren't members of the same blog
                wp_die( __( 'You do not have permission to edit this user.' ) );
            }
        }

    }
}


$madisoftThemePluginHiddenAdminUser = new madisoftThemePluginHiddenAdminUser();



