<?php

class MadisoftScuolaLoginPlugin extends madisoftThemePluginClass implements madisoftThemePluginInterface
{

    function initFunction()
    {
        add_shortcode('loginForm', array($this, 'insertLoginForm'));
    }


	function insertLoginForm($atts){

        global $post;
        if ( !possoVisualizzareQuestoContenuto()){
            return false;
        }

        $titolo = 'Area riservata';
        extract( shortcode_atts( array(
            'titolo'    => 'Area riservata',
        ), $atts ) );

        $html = 'Accesso effettuato.';
        if (!is_user_logged_in()) {

            $args = array(
                'echo' => false,
                'redirect' => site_url($_SERVER['REQUEST_URI']),
                'form_id' => 'loginform',
                'label_username' => __('Username'),
                'label_password' => __('Password'),
                'label_remember' => __('Remember Me'),
                'label_log_in' => __('Log In'),
                'id_username' => 'user_login',
                'id_password' => 'user_pass',
                'id_remember' => 'rememberme',
                'id_submit' => 'wp-submit',
                'remember' => false,
                'value_username' => NULL,
                'value_remember' => false
            );
            $html = wp_login_form($args);
        }

        $html = '<div class="container-fluid" id="madisoft-login-frame"><h3>' . $titolo . '</h3><div class="row">' .$html .'</div></div>';
        return $html;
    }



}

$madisoftScuolaLoginPlugin = new MadisoftScuolaLoginPlugin();
