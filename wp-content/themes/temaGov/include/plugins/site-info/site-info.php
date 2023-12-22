<?php
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');

function my_custom_dashboard_widgets() {
    global $wp_meta_boxes;

    wp_add_dashboard_widget('custom_help_widget', 'Informazioni sul sito web', 'custom_dashboard_help');
}

function custom_dashboard_help() {

    $blog_details = get_blog_details(get_current_blog_id());
    list($data, $ora) = explode(" ", $blog_details->registered);
    $nuovaData = substr($data, 8,2) . '/' . substr($data, 5,2) . '/' . substr($data, 0,4);
    echo '<p>Giorno di creazione del sito web <b>' . $nuovaData . '</b></p>';
}