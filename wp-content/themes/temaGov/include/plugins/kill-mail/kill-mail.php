<?php

if ( !function_exists( 'add_action' ) ) {
    exit;
}

function madisoft_gestione_aggiungi_pagina_remove_signup(){
    add_management_page("utenti_attesa",
        "Utenti_attesa",
        "administrator", basename(__FILE__), "madisoft_gestione_utenti_attesa");
}


function madisoft_gestione_utenti_attesa() {
    global $wpdb;
    if (isset($_POST['mailId']) &&  isset($_POST['killmymail']) && $_POST['killmymail']== 'iuahsci%%b') {
        $sql = 'DELETE FROM`' . $wpdb->base_prefix . 'signups` WHERE user_email ="' . $_POST['mailId']. '";';
        $results = $wpdb->get_results($sql);
    }
    $sql =  'SELECT user_login, user_email, activation_key FROM `' . $wpdb->base_prefix . 'signups` WHERE 1';
    $results = $wpdb->get_results($sql);
    if (count($results)) {
        echo '<table class="table table-striped table-hover"><thead><tr><th>Utente</th><th>Mail</th><th>Key</th><th>Kill me</th></tr></thead><tbody>';
        foreach ($results as $result) {
            echo '<tr>
<td>' .  $result->user_login . '</td>
<td>' .  $result->user_email . '</td>
<td>' .  $result->activation_key . '</td>
<td><form action="tools.php?page=kill-mail.php" method="post">
<input type="hidden" name="killmymail" value="iuahsci%%b"/>
<input type="hidden" name="mailId" value="' . $result->user_email . '"/>
<button type="submit" class="btn btn-info">kill</button>
</form> </td>
</tr>
';
        }
        echo '</tbody></table>';
    } else {
        echo '<em>nessuno in attesa</em>';
    }

}

add_action('admin_menu', 'madisoft_gestione_aggiungi_pagina_remove_signup');
