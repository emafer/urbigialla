<?php
$classeOpzioni = madisoft_get_theme_class()->getImpostazioniClass();
$idSezione = 'rapidContact';

$opzioniRapidContact = [
    [
        'value' => 'off',
        'label' => '--',
        'src' => ''
    ],
    [
        'value' => 'telefono',
        'label' => 'Telefono',
        'src' => ''
    ],
    [
        'value' => 'fax',
        'label' => 'Fax',
        'src' => ''
    ],
    [
        'value' => 'mail',
        'label' => 'E-mail',
        'src' => ''
    ],
    [
        'value' => 'pec',
        'label' => 'PEC',
        'src' => ''
    ],
    [
        'value' => 'cmec',
        'label' => 'Codice Meccanografico',
        'src' => ''
    ],
    [
        'value' => 'cuniv',
        'label' => 'Codice Univoco Fatturazione',
        'src' => ''
    ],
];

$classeOpzioni->aggiungiSezione(4, $idSezione, 'BARRA CONTATTI' );
$classeOpzioni->aggiungiImpostazione($idSezione, [
    'id'           => 'madisoft_scuola_barra_contatti-show',
    'label'        => 'Mostrare la barra superiore?',
    'desc'         => '',
    'std'          => 'on',
    'type'         => 'on-off',
    'section'      => $idSezione,
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);

$classeOpzioni->aggiungiImpostazione($idSezione, [
    'id'           => 'madisoft_scuola_contatti-show',
    'label'        => 'Mostrare i contatti nella barra superiore?',
    'desc'         => '',
    'std'          => 'on',
    'type'         => 'on-off',
    'section'      => $idSezione,
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_barra_contatti-show:is(on)',
    'operator'     => 'and'
]);

$classeOpzioni->aggiungiImpostazione($idSezione, [
    'id'           => 'madisoft_scuola_contatti_posto_1',
    'label'        => 'Cosa mostrare nel primo spazio',
    'desc'         => '',
    'std'          => 'mail',
    'type'         => 'select',
    'section'      => $idSezione,
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_barra_contatti-show:is(on)',
    'operator'     => 'and',
    'choices'      => $opzioniRapidContact
]);

$classeOpzioni->aggiungiImpostazione($idSezione, [
    'id'           => 'madisoft_scuola_contatti_posto_2',
    'label'        => 'Cosa mostrare nel secondo spazio',
    'desc'         => '',
    'std'          => 'telefono',
    'type'         => 'select',
    'section'      => $idSezione,
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_barra_contatti-show:is(on)',
    'operator'     => 'and',
    'choices'      => $opzioniRapidContact
]);

$classeOpzioni->aggiungiImpostazione($idSezione, [
    'id'           => 'madisoft_scuola_contatti_posto_3',
    'label'        => 'Cosa mostrare nel terzo spazio',
    'desc'         => '',
    'std'          => 'fax',
    'type'         => 'select',
    'section'      => $idSezione,
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_barra_contatti-show:is(on)',
    'operator'     => 'and',
    'choices'      => $opzioniRapidContact
]);


$classeOpzioni->aggiungiImpostazione($idSezione, [
    'id'           => 'madisoft_scuola_contatti_posto_4',
    'label'        => 'Cosa mostrare nel quarto spazio',
    'desc'         => '',
    'std'          => 'off',
    'type'         => 'select',
    'section'      => $idSezione,
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_barra_contatti-show:is(on)',
    'operator'     => 'and',
    'choices'      => $opzioniRapidContact
]);
$classeOpzioni->aggiungiImpostazione($idSezione, [
    'id'           => 'madisoft_scuola_link_barra_text',
    'label'        => 'Testo per una voce aggiuntiva nella barra superiore',
    'desc'         => '',
    'std'          => '',
    'type'         => 'text',
    'section'      => $idSezione,
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_barra_contatti-show:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione($idSezione, [
    'id'           => 'madisoft_scuola_link_barra_link',
    'label'        => 'Link per una voce aggiuntiva nella barra superiore',
    'desc'         => '',
    'std'          => '',
    'type'         => 'text',
    'section'      => $idSezione,
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_barra_contatti-show:is(on)',
    'operator'     => 'and'
]);