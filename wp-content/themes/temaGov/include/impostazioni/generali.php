<?php
$classeOpzioni = madisoft_get_theme_class()->getImpostazioniClass();
$classeOpzioni->aggiungiSezione(2, 'general', 'OPZIONI GENERALI' );
$classeOpzioni->aggiungiImpostazione('general', [
    'id'           => 'madisoft_scuola_testo_per_continua_a_leggere',
    'label'        => 'TESTO PER DICITURA "Continua a leggere..."',
    'desc'         => 'Testo per personalizzare la dicitura \'Continua a leggere\' mostrata dal sito web quando si mostra all\'utente solo il riassunto di un articolo inserito',
    'std'          => 'Continua...',
    'type'         => 'text',
    'section'      => 'general',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('general', [
    'id'           => 'madisoft_scuola_logomin',
    'label'        => 'Mostrare il logo ministeriale?',
    'desc'         => '',
    'std'          => 'on',
    'type'         => 'on-off',
    'section'      => 'general',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('general', [
    'id'           => 'madisoft_scuola_menu_center',
    'label'        => 'Centrare le voci del men&ugrave; principale?',
    'desc'         => '',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'general',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('general', [
    'id'           => 'madisoft_scuola_favicon',
    'label'        => 'Logo per il browser',
    'desc'         => 'Questa immagine - se caricata - verr&agrave; mostrata nella barra del browser. Caricare un\'immagine di piccole dimensioni',
    'std'          => '',
    'type'         => 'upload',
    'section'      => 'general',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('general',  [
    'id'           => 'madisoft_scuola_grafica_mostra_breadcrumb',
    'label'        => 'Mostra BreadCrumbs?',
    'desc'         => 'Mostra le briciole di pane che indicano all\'utente dove si trova',
    'std'          => 'on',
    'type'         => 'on-off',
    'section'      => 'general',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
] );
$classeOpzioni->aggiungiImpostazione('general',  [
    'id'           => 'madisoft_scuola_grafica_mostra_menu_superiore',
    'label'        => 'MENU SUPERIORE: MOSTRA?',
    'desc'         => 'Se impostato a OFF il men&ugrave; superiore non verr&agrave; mostrato',
    'std'          => 'on',
    'type'         => 'on-off',
    'section'      => 'general',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('general', [
    'id'           => 'madisoft_scuola_cerca_fixed',
    'label'        => 'PULSANTE CERCA BLOCCATO',
    'desc'         => 'Si consiglia di lasciare a ON questa opzione, perch&egrave; manterrete alto lo status di accessibilitt&agrave;',
    'std'          => 'on',
    'type'         => 'on-off',
    'section'      => 'general',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('general', [
    'id'           => 'madisoft_scuola_usa_bootstrap',
    'label'        => 'Gestisci il men&ugrave; in modalit&agrave; avanzata',
    'desc'         => 'Usare solo se consigliato dall\'assistenza',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'general',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);

$classeOpzioni->aggiungiImpostazione('general', [
    'id'           => 'madisoft_scuola_webmaster',
    'label'        => 'Webmaster',
    'desc'         => '',
    'std'          => '',
    'type'         => 'text',
    'section'      => 'general',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('general', [
    'id'           => 'madisoft_scuola_usa_bordi',
    'label'        => 'Usa bordi',
    'desc'         => '',
    'std'          => 'on',
    'type'         => 'on-off',
    'section'      => 'general',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);

$classeOpzioni->aggiungiImpostazione('general', [
    'id'           => 'madisoft_scuola_usa_layout_madisoft_per_plugin_circolari',
    'label'        => 'Circolari: usa layout interno',
    'desc'         => '',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'general',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('general', [
    'id'           => 'madisoft_scuola_menu_nome_menu1',
    'label'        => 'Testo per bottone men&ugrave;  principale',
    'desc'         => '',
    'std'          => '',
    'type'         => 'text',
    'section'      => 'general',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('general', [
    'id'           => 'madisoft_scuola_menu_nome_menu2',
    'label'        => 'Testo per bottone men&ugrave;  laterale',
    'desc'         => '',
    'std'          => 'Men&ugrave; laterale',
    'type'         => 'text',
    'section'      => 'general',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);

madisoft_get_theme_class()->setImpostazioniClass($classeOpzioni);