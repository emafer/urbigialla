<?php

$classeOpzioni = madisoft_get_theme_class()->getImpostazioniClass();
$classeOpzioni->aggiungiImpostazione('general',  [
    'id'           => 'madisoft_scuola_usa_sottotitolo',
    'label'        => 'Abilitare Il sottotitolo',
    'desc'         => 'Abilitando questa opzione sar&agrave; possibile inserire un sottotitolo',
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
], 99);

madisoft_get_theme_class()->setImpostazioniClass($classeOpzioni);