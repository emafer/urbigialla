<?php

class MadisoftDisabilitaCommenti
{
    function __construct()
    {

        add_action( 'widgets_init', array( $this, 'disable_rc_widget' ) );
        add_filter( 'wp_headers', array( $this, 'filter_wp_headers' ) );
        add_action( 'template_redirect', array( $this, 'filter_query' ), 9 );	// before redirect_canonical

        // Admin bar filtering has to happen here since WP 3.6
        add_action( 'template_redirect', array( $this, 'remove_network_comment_links' ) );
        add_action( 'admin_init', array( $this, 'remove_network_comment_links' ) );
        add_action( 'admin_bar_menu', array( $this, 'remove_network_comment_links' ), 500 );

        // These can happen later
        add_action( 'wp_loaded', array( $this, 'init_wploaded_filters' ) );
    }

    public function disable_rc_widget()
    {
        unregister_widget('WP_Widget_Recent_Comments');
    }

    public function filter_wp_headers( $headers ) {
        unset( $headers['X-Pingback'] );
        return $headers;
    }


    /*
     * Issue a 403 for all comment feed requests.
     */
    public function filter_query() {
        if( is_comment_feed() ) {
            wp_die( __( 'Comments are closed.' ), '', array( 'response' => 403 ) );
        }
    }

    /*
	 * Remove comment links from the admin bar in a multisite network.
	 */
    public function remove_network_comment_links( $wp_admin_bar ) {
            foreach( (array) $wp_admin_bar->user->blogs as $blog ) {
                $wp_admin_bar->remove_menu( 'blog-' . $blog->userblog_id . '-c' );
            }
    }
}