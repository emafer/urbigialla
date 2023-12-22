<?php

/**
 * FUNZIONAMENTO:
 * se c'è la richiesta GET di avcp_redirect_token (ottenuto mediante htaccess) rimanda alla path
 * avcp trasparenza con la richiesta GET
 * @param $_GET['avcp_redirect_token']
 */

function getAvcpCustomPath()
{
    $sitoCorrenteId = get_current_blog_id();
    $sitoCorrentefolderPath = ABSPATH . 'avcp/trasparenza/' . $sitoCorrenteId . '/';

    // controlla se in ABS_PATH/avcp/trasparenza esiste una cartella per il sito corrente
    if (!file_exists($sitoCorrentefolderPath)) {
        // se la cartella non c è, creala e rendila scrivibile
        if (!mkdir($sitoCorrentefolderPath)) {
            die('Impossibile creare la cartella per AVCP');
        }
    }

    return get_site_url() . '/avcp/trasparenza/' . $sitoCorrenteId . '/';
}

if ( isset($_GET['avcp_redirect_token']) ) {
    $link = getAvcpCustomPath() . $_GET['avcp_redirect_token'];
    header("location: $link");
    exit;
}