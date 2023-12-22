<?php
$classeOpzioni = madisoft_get_theme_class()->getImpostazioniClass();
$classeOpzioni->aggiungiSezione(1, 'madisoft_scuola_istituto_dati', 'DATI ISTITUTO' );

$classeOpzioni->aggiungiImpostazione('madisoft_scuola_istituto_dati', [
    'id'           => 'madisoft_scuola_dati_mostra_logo',
    'label'        => 'Mostrare il logo nell\'intestazione',
    'desc'         => 'Se l\'opzione &egrave; "Off" la fascia di benvenuto, se impostata, sar&agrave; mostrata 
                    sopra alle barre laterali',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'madisoft_scuola_istituto_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_istituto_dati', [
    'id'           => 'madisoft_scuola_dati_logo',
    'label'        => 'LOGO ISTITUTO',
    'desc'         => 'Se caricato il logo verr&agrave; mostrato nell\'intestazione della pagina',
    'std'          => '',
    'type'         => 'upload',
    'section'      => 'madisoft_scuola_istituto_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_dati_mostra_logo:is(on)',
    'operator'     => 'and'
]);

$classeOpzioni->aggiungiImpostazione('madisoft_scuola_istituto_dati', [
    'id'           => 'madisoft_scuola_dati_logo_larghezza',
    'label'        => 'LARGHEZZA LOGO ISTITUTO (rispetto alla pagina)',
    'desc'         => '',
    'std'          => MadisoftScuolaWidth::MADISOFT_WIDTH_1_6,
    'type'         => 'select',
    'section'      => 'madisoft_scuola_istituto_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_dati_mostra_logo:is(on)',
    'operator'     => 'and',
    'choices'      => [
    [
        'value' => MadisoftScuolaWidth::MADISOFT_WIDTH_1_12,
        'label' => '1/12',
        'src'   => ''
    ],
    [
        'value' => MadisoftScuolaWidth::MADISOFT_WIDTH_1_6,
        'label' => '1/6',
        'src'   => ''
    ],
    [
        'value' => MadisoftScuolaWidth::MADISOFT_WIDTH_1_4,
        'label' => '1/4',
        'src'   => ''
    ],
    [
        'value' => MadisoftScuolaWidth::MADISOFT_WIDTH_1_3,
        'label' => '1/3',
        'src'   => ''
    ],
    [
        'value' => MadisoftScuolaWidth::MADISOFT_WIDTH_5_12,
        'label' => '5/12',
        'src'   => ''
    ],
    [
        'value' => MadisoftScuolaWidth::MADISOFT_WIDTH_1_2,
        'label' => '1/2',
        'src'   => ''
    ],
] ] );
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_istituto_dati', [
    'id'           => 'madisoft_scuola_istituto_nome',
    'label'        => 'NOME',
    'desc'         => '',
    'std'          => '',
    'type'         => 'text',
    'section'      => 'madisoft_scuola_istituto_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_istituto_dati', [
    'id'           => 'madisoft_scuola_istituto_codice_meccanografico',
    'label'        => 'CODICE MECCANOGRAFICO',
    'desc'         => '',
    'std'          => '',
    'type'         => 'text',
    'section'      => 'madisoft_scuola_istituto_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_istituto_dati', [
    'id'           => 'madisoft_scuola_istituto_codice_ipa',
    'label'        => 'CODICE IPA',
    'desc'         => '',
    'std'          => '',
    'type'         => 'text',
    'section'      => 'madisoft_scuola_istituto_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_istituto_dati', [
    'id'           => 'madisoft_scuola_istituto_codice_fatturazione',
    'label'        => 'CODICE FATTURAZIONE ELETTRONICA',
    'desc'         => '',
    'std'          => '',
    'type'         => 'text',
    'section'      => 'madisoft_scuola_istituto_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_istituto_dati', [
    'id'           => 'madisoft_scuola_istituto_codice_fiscale',
    'label'        => 'CODICE FISCALE',
    'desc'         => '',
    'std'          => '',
    'type'         => 'text',
    'section'      => 'madisoft_scuola_istituto_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_istituto_dati', [
    'id'           => 'madisoft_scuola_istituto_indirizzo',
    'label'        => 'INDIRIZZO',
    'desc'         => '',
    'std'          => '',
    'type'         => 'text',
    'section'      => 'madisoft_scuola_istituto_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_istituto_dati', [
    'id'           => 'madisoft_scuola_istituto_comune',
    'label'        => 'COMUNE',
    'desc'         => '',
    'std'          => '',
    'type'         => 'text',
    'section'      => 'madisoft_scuola_istituto_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_istituto_dati', [
    'id'           => 'madisoft_scuola_istituto_cap',
    'label'        => 'CAP',
    'desc'         => '',
    'std'          => '',
    'type'         => 'text',
    'section'      => 'madisoft_scuola_istituto_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_istituto_dati', [
    'id'           => 'madisoft_scuola_istituto_provincia',
    'label'        => 'PROVINCIA',
    'desc'         => '',
    'std'          => '',
    'type'         => 'text',
    'section'      => 'madisoft_scuola_istituto_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_istituto_dati', [
    'id'           => 'madisoft_scuola_istituto_telefono',
    'label'        => 'TELEFONO',
    'desc'         => '',
    'std'          => '',
    'type'         => 'text',
    'section'      => 'madisoft_scuola_istituto_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_istituto_dati', [
    'id'           => 'madisoft_scuola_istituto_fax',
    'label'        => 'FAX',
    'desc'         => '',
    'std'          => '',
    'type'         => 'text',
    'section'      => 'madisoft_scuola_istituto_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_istituto_dati', [
    'id'           => 'madisoft_scuola_istituto_email',
    'label'        => 'EMAIL',
    'desc'         => '',
    'std'          => '',
    'type'         => 'text',
    'section'      => 'madisoft_scuola_istituto_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_istituto_dati', [
    'id'           => 'madisoft_scuola_istituto_pec',
    'label'        => 'PEC',
    'desc'         => '',
    'std'          => '',
    'type'         => 'text',
    'section'      => 'madisoft_scuola_istituto_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_istituto_dati', [
    'id'           => 'madisoft_scuola_istituto_dirigente',
    'label'        => 'DIRIGENTE',
    'desc'         => '',
    'std'          => '',
    'type'         => 'text',
    'section'      => 'madisoft_scuola_istituto_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_istituto_dati', [
    'id'           => 'madisoft_scuola_istituto_dsga',
    'label'        => 'DSGA',
    'desc'         => '',
    'std'          => '',
    'type'         => 'text',
    'section'      => 'madisoft_scuola_istituto_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_istituto_dati', [
    'id'           => 'madisoft_scuola_istituto_iban',
    'label'        => 'IBAN',
    'desc'         => '',
    'std'          => '',
    'type'         => 'text',
    'section'      => 'madisoft_scuola_istituto_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_istituto_dati', [
    'id'           => 'madisoft_scuola_istituto_scuola_in_chiaro',
    'label'        => 'Link a Scuola in chiaro',
    'desc'         => '',
    'std'          => '',
    'type'         => 'text',
    'section'      => 'madisoft_scuola_istituto_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_istituto_dati', [
    'id'           => 'madisoft_scuola_dati_pof',
    'label'        => 'POF',
    'desc'         => 'Caricare il file del POF',
    'std'          => '',
    'type'         => 'upload',
    'section'      => 'madisoft_scuola_istituto_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_istituto_dati', [
    'id'           => 'madisoft_scuola_dati_ptof',
    'label'        => 'PTOF',
    'desc'         => 'Caricare il file del PTOF',
    'std'          => '',
    'type'         => 'upload',
    'section'      => 'madisoft_scuola_istituto_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_istituto_dati', [
    'id'           => 'madisoft_scuola_dati_foto',
    'label'        => 'Foto dell\'Istituto',
    'desc'         => 'Caricare la foto dell\'istituto',
    'std'          => '',
    'type'         => 'upload',
    'section'      => 'madisoft_scuola_istituto_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_istituto_dati', [
    'id'           => 'madisoft_scuola_dati_calendario',
    'label'        => 'Calendario Scolastico',
    'desc'         => 'calendario scolastico in PDF',
    'std'          => '',
    'type'         => 'upload',
    'section'      => 'madisoft_scuola_istituto_dati',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);

madisoft_get_theme_class()->setImpostazioniClass($classeOpzioni);