<?php
$classeOpzioni = madisoft_get_theme_class()->getImpostazioniClass();

$classeOpzioni->aggiungiSezione(80, 'madisoft_scuola_eventi', 'EVENTI' );

$classeOpzioni->aggiungiImpostazione('madisoft_scuola_eventi', [
    'id'      => 'madisoft_scuola_eventi_usa_plugin_standard',
    'label'   => 'Usa Events Manager',
    'desc'    => '',
    'std'     => 'on',
    'type'    => 'on-off',
    'section' => 'madisoft_scuola_eventi',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);

$classeOpzioni->aggiungiImpostazione('madisoft_scuola_eventi', [
    'id'      => 'madisoft_scuola_eventi_nomecognome',
    'label'   => 'Men&ugrave; prenotazioni: descrizione campo <em>nome e cognome</em>',
    'desc'    => '',
    'std'     => 'Nome e cognome',
    'type'    => 'text',
    'section' => 'madisoft_scuola_eventi',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_eventi_usa_plugin_standard:is(on)',
    'operator'     => 'and'
]);

$classeOpzioni->aggiungiImpostazione('madisoft_scuola_eventi', [
    'id'      => 'madisoft_scuola_eventi_telefono_mostra',
    'label'   => 'Telefono: mostra',
    'desc'    => '',
    'std'     => 'on',
    'type'    => 'on-off',
    'section' => 'madisoft_scuola_eventi',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_eventi_usa_plugin_standard:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_eventi', [
    'id'      => 'madisoft_scuola_eventi_conferma_email_mostra',
    'label'   => 'Email: mostra conferma email?',
    'desc'    => '',
    'std'     => 'off',
    'type'    => 'on-off',
    'section' => 'madisoft_scuola_eventi',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_eventi_usa_plugin_standard:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_eventi', [
    'id'      => 'madisoft_scuola_eventi_descrizione_annotazioni_mostra',
    'label'   => 'Men&ugrave; prenotazioni: mostra',
    'desc'    => '',
    'std'     => 'on',
    'type'    => 'on-off',
    'section' => 'madisoft_scuola_eventi',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_eventi_usa_plugin_standard:is(on)',
    'operator'     => 'and'
]);

$classeOpzioni->aggiungiImpostazione('madisoft_scuola_eventi', [
    'id'      => 'madisoft_scuola_eventi_descrizione_annotazioni',
    'label'   => 'Men&ugrave; prenotazioni: descrizione campo <em>Annotazioni</em>',
    'desc'    => '',
    'std'     => 'Indirizzo e annotazioni',
    'type'    => 'text',
    'section' => 'madisoft_scuola_eventi',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_eventi_descrizione_annotazioni_mostra:is(on),madisoft_scuola_eventi_usa_plugin_standard:is(on)',
    'operator'     => 'and'
]);

madisoft_get_theme_class()->setImpostazioniClass($classeOpzioni);


