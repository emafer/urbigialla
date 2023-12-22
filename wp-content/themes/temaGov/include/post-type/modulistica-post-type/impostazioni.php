<?php

$classeOpzioni = madisoft_get_theme_class()->getImpostazioniClass();
$classeOpzioni->aggiungiSezione(12, 'madisoft_scuola_modulistica_dati', 'DATI MODULISTICA' );

$classeOpzioni->aggiungiImpostazione('madisoft_scuola_modulistica_uso', [
    'id'           => 'madisoft_scuola_modulistica_uso',
    'label'        => 'Utilizzare la modulistica predefinita?',
    'desc'         => '',
    'std'          => 'on',
    'type'         => 'on-off',
    'section'      => 'madisoft_scuola_modulistica_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_modulistica_uso', [
    'id'           => 'madisoft_scuola_modulistica_testo',
    'label'        => 'Testo per scaricare la modulistica',
    'desc'         => '',
    'std'          => 'Visualizza',
    'type'         => 'text',
    'section'      => 'madisoft_scuola_modulistica_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_modulistica_uso:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_modulistica_uso', [
    'id'      => 'madisoft_scuola_modulistica_widget_generale',
    'label'   => 'Visualizza Link iniziale nel men&ugrave;',
    'desc'    => 'Se impostato a OFF nel box laterale non si vedr&agrave; il link alla pagina generale della modulistica',
    'std'     => 'on',
    'type'    => 'on-off',
    'section' => 'madisoft_scuola_modulistica_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_modulistica_uso:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_modulistica_uso', [
    'id'           => 'madisoft_scuola_modulistica_tipologia',
    'label'        => 'Mostrare la tipologia?',
    'desc'         => '',
    'std'          => '0',
    'type'         => 'select',
    'section'      => 'madisoft_scuola_modulistica_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_modulistica_uso:is(on)',
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
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_modulistica_uso', [
    'id'           => 'madisoft_scuola_modulistica_tipologia_nome',
    'label'        => 'Nome Tipologia',
    'desc'         => '',
    'std'          => 'Tipologia',
    'type'         => 'text',
    'section'      => 'madisoft_scuola_modulistica_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_modulistica_tipologia:is(1),madisoft_scuola_modulistica_uso:is(on)',
    'operator'     => 'and'
]);

$classeOpzioni->aggiungiImpostazione('madisoft_scuola_modulistica_uso', [
    'id'           => 'madisoft_scuola_modulistica_mostra_data',
    'label'        => 'mostrare la data di creazione della modulistica?',
    'desc'         => '',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'madisoft_scuola_modulistica_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);

$classeOpzioni->aggiungiImpostazione('madisoft_scuola_modulistica_uso', [
    'id'      => 'madisoft_scuola_modulistica_download_diretto',
    'label'   => 'Permetti il download del modulo direttamente',
    'desc'    => 'Se impostato a ON il file sar&agrave; scaricabile direttamente dall\'elenco dei moduli',
    'std'     => 'off',
    'type'    => 'on-off',
    'section' => 'madisoft_scuola_modulistica_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_modulistica_uso:is(on)',
    'operator'     => 'and'
]);
madisoft_get_theme_class()->setImpostazioniClass($classeOpzioni);
