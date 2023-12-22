<?php

class madisoftThemePluginMyMediaOnly extends madisoftThemePluginClass implements madisoftThemePluginInterface
{

    function initFunction()
    {
        add_filter('parse_query', [$this, 'my_media_only']);
        add_action('pre_get_posts', [$this, 'ml_restrict_media_library']);
    }

    function my_media_only($wp_query)
    {
        if (strpos($_SERVER['REQUEST_URI'], '/wp-admin/upload.php') !== false) {
            $this->aggiungi_alla_query_id_utente();
            return true;
        }
        if (strpos($_SERVER['REQUEST_URI'], '/wp-admin/media-upload.php') !== false) {
            $this->aggiungi_alla_query_id_utente();
            return true;
        }
        if (strpos($_SERVER['REQUEST_URI'], '/wp-admin/admin-ajax.php') !== false && $_POST['action'] == 'query-attachments') {
            $this->aggiungi_alla_query_id_utente();
            return true;
        }
        if (strpos($_SERVER['REQUEST_URI'], '/wp-admin/post-new.php') !== false) {
            $this->aggiungi_alla_query_id_utente();
            return true;
        }

    }

    /**
     *
     * @return WP_User|false
     */
    function aggiungi_alla_query_id_utente()
    {
        if ($this->madisoft_posso_vedere_tutti_i_file()) {
            global $current_user, $wp_query;
            $wp_query->set('author', $current_user->ID);

            return $current_user;
        }
        return false;
    }

    /**
     * @return bool
     */
    function madisoft_posso_vedere_tutti_i_file()
    {
        global $current_user;

        return !current_user_can('see_all_files');
    }


    /**
     * @param $wp_query_obj WP_Query
     */
    function ml_restrict_media_library($wp_query_obj)
    {
        global $current_user, $pagenow;
        if (!is_a($current_user, 'WP_User')) {
            return;
        }
        if ('admin-ajax.php' != $pagenow || $_REQUEST['action'] != 'query-attachments') {
            return;
        }
        if ($this->madisoft_posso_vedere_tutti_i_file()) {
            $wp_query_obj->set('author', $current_user->ID);
            return;
        }
    }
}

$madisoftThemePluginMyMediaOnly = new madisoftThemePluginMyMediaOnly();
