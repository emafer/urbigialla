<?php

if ( !function_exists( 'add_action' ) ) {
    exit;
}
function madisoft_gestione_url_aggiungi_pagina_opzioni2(){
    add_management_page("PaginaMalefica",
        "PaginaMalefica",
        "administrator", basename(__FILE__), "madisoft_gestione_PaginaMalefica");
}

function madisoft_gestione_PaginaMalefica() {
    if (!isset($_GET['post_id_malefico'])) {
        $_GET['post_id_malefico'] = 5121;
    }
    echo "Controlla pagina con &post_id_malefico= nell'url";
    $pos = get_post($_GET['post_id_malefico']);
    var_dump(get_post_meta($_GET['post_id_malefico']));
    var_dump($pos);
    echo '<textarea>' . $pos->post_content . '</textarea>';
}

add_action('admin_menu', 'madisoft_gestione_url_aggiungi_pagina_opzioni2');
