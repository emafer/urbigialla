<?php
$classeOpzioni = madisoft_get_theme_class()->getImpostazioniClass();

$classeOpzioni->aggiungiSezione(3, 'madisoft_scuola_social', 'SOCIAL' );
//PAGINE
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_social', [
    'id'      => 'madisoft_scuola_social_attivo',
    'label'   => 'Abilitare il men&ugrave; social?',
    'desc'    => '',
    'std'     => 'on',
    'type'    => 'on-off',
    'section' => 'madisoft_scuola_social',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);

$classeOpzioni->aggiungiImpostazione('madisoft_scuola_social', [
    'id'      => 'madisoft_scuola_social_fb',
    'label'   => 'Link Facebook',
    'desc'    => '',
    'std'     => '',
    'type'    => 'text',
    'section' => 'madisoft_scuola_social',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);

$classeOpzioni->aggiungiImpostazione('madisoft_scuola_social', [
    'id'      => 'madisoft_scuola_social_tw',
    'label'   => 'Link Twitter',
    'desc'    => '',
    'std'     => '',
    'type'    => 'text',
    'section' => 'madisoft_scuola_social',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);

$classeOpzioni->aggiungiImpostazione('madisoft_scuola_social', [
    'id'      => 'madisoft_scuola_social_yt',
    'label'   => 'Canale Youtube',
    'desc'    => '',
    'std'     => '',
    'type'    => 'text',
    'section' => 'madisoft_scuola_social',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);

$classeOpzioni->aggiungiImpostazione('madisoft_scuola_social', [
    'id'      => 'madisoft_scuola_social_fl',
    'label'   => 'Link Flickr',
    'desc'    => '',
    'std'     => '',
    'type'    => 'text',
    'section' => 'madisoft_scuola_social',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);

$classeOpzioni->aggiungiImpostazione('madisoft_scuola_social', [
    'id'      => 'madisoft_scuola_social_ss',
    'label'   => 'Link Slideshare',
    'desc'    => '',
    'std'     => '',
    'type'    => 'text',
    'section' => 'madisoft_scuola_social',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_social', [
    'id'      => 'madisoft_scuola_social_inst',
    'label'   => 'Link instagram',
    'desc'    => '',
    'std'     => '',
    'type'    => 'text',
    'section' => 'madisoft_scuola_social',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);

madisoft_get_theme_class()->setImpostazioniClass($classeOpzioni);


