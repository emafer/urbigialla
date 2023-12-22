<?php
if ( !function_exists( 'add_action' ) ) {
    exit;
}
function madisoft_gestione_url_aggiungi_pagina_opzioni(){
    add_management_page("Controlla opzioni", "controlla opzioni", "manage_options", basename(__FILE__), "madisoft_gestione_opzioni");
}
function madisoft_gestione_opzioni(){
    /** @var \Codeception\Module\WPDb $wpdb */
    global $wpdb;
    $galleryPath = '';
    echo $query2 = 'SELECT * FROM ' . $wpdb->prefix . 'sitemeta WHERE site_id = "' . get_current_blog_id() . '" and meta_key = "dbem_rsvp_mail_send_method"';
    $myrows = $wpdb->get_results($query2);
    foreach ($myrows as $myrow) {
        echo '<b>' . $myrow->meta_key . '</b>: ' . $myrow->meta_value . '<br/>';
    }
    if (isset($_POST['GalleryPath']) && $_POST['GalleryPath']!='') {
        $query = 'SELECT * FROM ' . $wpdb->prefix . 'options WHERE option_name = "ngg_options" ';
        $myrows = $wpdb->get_results($query);
        $result = $myrows[0];
        $arrayOpzioni = (unserialize($result->option_value));
        $arrayOpzioni['gallerypath'] = $_POST['GalleryPath'];
        $queryUpdate = "UPDATE " . $wpdb->prefix . "options SET option_value ='" . serialize($arrayOpzioni) .
            "' WHERE option_id =" . $result->option_id ;
        ($queryUpdate);

        $wpdb->get_results($queryUpdate);
    }
    $query = 'SELECT * FROM ' . $wpdb->prefix . 'options WHERE option_name = "ngg_options" ';
    $myrows = $wpdb->get_results($query);
    foreach ($myrows as $myrow) {
        $arrayOpzioni = (unserialize($myrow->option_value));
        $galleryPath = $arrayOpzioni['gallerypath'];
    }
        ?>
        <form method="post">
            <label>Opzioni</label>
            <input name="GalleryPath" id="gallerypath" value="<?php echo $galleryPath; ?>"/>
            <button type="submit">Invia</button>
        </form>
<?php
}
add_action('admin_menu', 'madisoft_gestione_url_aggiungi_pagina_opzioni');