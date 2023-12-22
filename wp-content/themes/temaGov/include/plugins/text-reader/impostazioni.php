<?php
$classeOpzioni = madisoft_get_theme_class()->getImpostazioniClass();

$classeOpzioni->aggiungiImpostazione('general', [
    'id'           => 'madisoft_scuola_attivaLetturaVocale',
    'label'        => 'ATTIVA LETTURA VOCALE',
    'desc'         => '',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'accessibilita',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);

madisoft_get_theme_class()->setImpostazioniClass($classeOpzioni);