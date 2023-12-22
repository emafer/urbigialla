<?php
$classeOpzioni = madisoft_get_theme_class()->getImpostazioniClass();
$classeOpzioni->aggiungiSezione(11, 'madisoft_scuola_circolari_dati', 'GESTIONE CIRCOLARI' );

$classeOpzioni->aggiungiImpostazione('madisoft_scuola_circolari_uso', [
    'id'           => 'madisoft_scuola_circolari_uso',
    'label'        => 'Utilizzare le circolari predefinite?',
    'desc'         => '',
    'std'          => 'on',
    'type'         => 'on-off',
    'section'      => 'madisoft_scuola_circolari_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_circolari_uso', [
    'id'           => 'madisoft_scuola_circolari_ordine',
    'label'        => 'Come mostrare le circolari?',
    'desc'         => '',
    'std'          => '1',
    'type'         => 'select',
    'section'      => 'madisoft_scuola_circolari_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_circolari_uso:is(on)',
    'operator'     => 'and',
    'choices'      => [
        [
            'value' => '1',
            'label' => 'Per data e per numero',
            'src'   => ''
        ],
        [
            'value' => '2',
            'label' => 'Per numero',
            'src'   => ''
        ]
    ]
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_circolari_uso', [
    'id'           => 'madisoft_scuola_circolari_tipologia',
    'label'        => 'Mostrare la tipologia?',
    'desc'         => '',
    'std'          => '1',
    'type'         => 'select',
    'section'      => 'madisoft_scuola_circolari_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_circolari_uso:is(on)',
    'operator'     => 'and',
    'choices'      => [
        [
            'value' => '1',
            'label' => 'SI',
            'src'   => ''
        ],
        [
            'value' => '0',
            'label' => 'NO',
            'src'   => ''
        ]
    ]
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_circolari_uso', [
    'id'           => 'madisoft_scuola_circolari_tipologia_nome',
    'label'        => 'Nome Tipologia',
    'desc'         => '',
    'std'          => 'Tipologia',
    'type'         => 'text',
    'section'      => 'madisoft_scuola_circolari_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_circolari_tipologia:is(1),madisoft_scuola_circolari_uso:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_circolari_uso', [
    'id'           => 'madisoft_scuola_circolari_destinatari',
    'label'        => 'Mostrare i destinatari?',
    'desc'         => '',
    'std'          => '1',
    'type'         => 'select',
    'section'      => 'madisoft_scuola_circolari_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_circolari_uso:is(on)',
    'operator'     => 'and',
    'choices'      => [
        [
            'value' => '1',
            'label' => 'SI',
            'src'   => ''
        ],
        [
            'value' => '0',
            'label' => 'NO',
            'src'   => ''
        ]
    ]
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_circolari_uso', [
    'id'           => 'madisoft_scuola_circolari_testo',
    'label'        => 'Testo per scaricare la circolare',
    'desc'         => '',
    'std'          => 'Visualizza',
    'type'         => 'text',
    'section'      => 'madisoft_scuola_circolari_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_circolari_uso:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_circolari_uso', [
    'id'      => 'madisoft_scuola_circolari_widget_generale',
    'label'   => 'Visualizza Link iniziale nel men&ugrave;',
    'desc'    => 'Se impostato a OFF nel box laterale non si vedr&agrave; il link alla pagina generale delle circolari',
    'std'     => 'on',
    'type'    => 'on-off',
    'section' => 'madisoft_scuola_circolari_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_circolari_uso:is(on)',
    'operator'     => 'and'
]);

madisoft_get_theme_class()->setImpostazioniClass($classeOpzioni);