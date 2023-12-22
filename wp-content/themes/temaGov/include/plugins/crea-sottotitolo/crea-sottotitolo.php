<?php

class madisoftThemePluginCreaSottotitolo extends MadisoftThemePluginClass implements madisoftThemePluginInterface
{

    function initFunction()
    {
        add_action('add_meta_boxes', [$this, 'add_sottotitolo']);
        add_action('save_post', [$this, 'save_sottotitolo_meta_box']);
    }

    function add_sottotitolo()
    {
        $screens = array('post', 'page');

        foreach ($screens as $screen) {
            add_meta_box(
                'post_sottotitolo',
                'Sottotitolo',
                [$this, 'madisoft_scuola_sottotitolo_box'],
                $screen,
                'normal',
                'high'
            );
        }
    }

    function madisoft_scuola_sottotitolo_box()
    {
        global $post;
        wp_nonce_field(plugin_basename(__FILE__), 'add_sottotitolo_nonce');
        $id = 'add_sottotitolo_field';
        printf(
            '<label for="' . $id . '" class="label_madisoft_form">%s:</label>' . " \n\t"
            . '<input type="text" id="' . $id . '" name="' . $id . '" value="%s" style="width: %s"/>',
            'Sottotitolo', get_post_meta($post->ID, '_sottotitolo', true), '100%'
        );
    }


    function save_sottotitolo_meta_box($id)
    {
        if (isset($_GET['post_type']) && ('post' != $_GET['post_type'] || 'page' != $_GET['post_type'])) {
            return false;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $id;
        }

        if (!isset($_POST['add_sottotitolo_nonce'])) {
            return $id;
        }
        if (!wp_verify_nonce($_POST['add_sottotitolo_nonce'], plugin_basename(__FILE__))) {
            return $id;
        }
        update_post_meta($id, '_sottotitolo', $_POST['add_sottotitolo_field']);

    }
}
if ( madisoft_get_theme_option('madisoft_scuola_usa_sottotitolo', 'off') == 'on'){
    $madisoftThemePluginCreaSottotitolo = new madisoftThemePluginCreaSottotitolo();
}