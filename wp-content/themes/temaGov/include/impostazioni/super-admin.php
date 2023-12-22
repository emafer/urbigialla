<?php
if (current_user_can('administrator')) {
    $classeOpzioni = madisoft_get_theme_class()->getImpostazioniClass();
    $idSezione = 'sadmin';


    $classeOpzioni->aggiungiSezione(99, $idSezione, 'SOLO SUPER ADMIN');
    $classeOpzioni->aggiungiImpostazione($idSezione, [
        'id' => 'madisoft_scuola_forza_dati_testata',
        'label' => 'Mostrare la barra superiore?',
        'desc' => 'Forza la visualizzazione dei dati della testata, magari in luogo di quella standard e di una immagine',
        'std' => 'off',
        'type' => 'on-off',
        'section' => $idSezione,
        'rows' => '',
        'post_type' => '',
        'taxonomy' => '',
        'min_max_step' => '',
        'class' => '',
        'condition' => '',
        'operator' => 'and'
    ]);
    $classeOpzioni->aggiungiImpostazione($idSezione, [
        'id' => 'madisoft_scuola_usa_plugin_ammtrasp',
        'label' => 'Usare Amm Trasparente?',
        'desc' => '',
        'std' => 'off',
        'type' => 'on-off',
        'section' => $idSezione,
        'rows' => '',
        'post_type' => '',
        'taxonomy' => '',
        'min_max_step' => '',
        'class' => '',
        'condition' => '',
        'operator' => 'and'
    ]);
}