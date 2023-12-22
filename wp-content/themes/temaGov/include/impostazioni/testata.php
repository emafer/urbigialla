<?php

$classeOpzioni = madisoft_get_theme_class()->getImpostazioniClass();
$classeOpzioni->aggiungiSezione(8, 'testata', 'TESTATA' );

$classeOpzioni->aggiungiImpostazione('madisoft_scuola_testata_template', [
    'id'           => 'madisoft_scuola_testata_larghezza',
    'label'        => 'Larghezza della fascia',
    'desc'         => '',
    'std'          => 'container-fluid',
    'type'         => 'select',
    'section'      => 'testata',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and',
    'choices'      => [
        [
            'value' => 'container-fluid',
            'label' => 'Completa',
            'src'   => ''
        ],
        [
            'value' => 'container',
            'label' => 'Ridotta',
            'src'   => ''
        ]
    ]
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_testata_template', [
    'id'           => 'madisoft_scuola_testata_mostra_testata_standard',
    'label'        => 'MOSTRA TESTATA AUTOMATICA',
    'desc'         => '',
    'std'          => 'on',
    'type'         => 'on-off',
    'section'      => 'testata',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_testata_template', [
    'id'           => 'madisoft_scuola_testata_mostra_testata_comune',
    'label'        => 'MOSTRA RIFERIMENTO A COMUNE E PROVINCIA',
    'desc'         => '',
    'std'          => 'on',
    'type'         => 'on-off',
    'section'      => 'testata',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_testata_mostra_testata_standard:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_testata_template', [
    'id'           => 'madisoft_scuola_testata_stile',
    'label'        => 'Stile testata',
    'desc'         => '',
    'std'          => 'standard',
    'type'         => 'select',
    'section'      => 'testata',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and',
    'choices'   => [
        [
            'value' => 'standard',
            'label' => 'Standard: logo, logo min? istituto',
            'src'   => ''
        ],
        [
            'value' => '1',
            'label' => 'Logo, Istituto, Logo2',
            'src'   => ''
        ],
        [
            'value' => '2',
            'label' => 'Istituto, Logo, Logo2',
            'src'   => ''
        ],

    ],
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_testata_template', [
    'id'           => 'madisoft_scuola_testata_stile_logo_left',
    'label'        => 'Logo di sinistra ',
    'desc'         => '',
    'std'          => '',
    'type'         => 'upload',
    'section'      => 'testata',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => 'col-6',
    'condition'    => 'madisoft_scuola_testata_stile:not(standard)',
    'operator'     => 'and',
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_testata_template', [
    'id'           => 'madisoft_scuola_testata_stile_logo_left_width',
    'label'        => 'larghezza logo di sinistra',
    'desc'         => 'se vuoto verr&agrave; mostrato il logo dell\'istituto',
    'std'          => MadisoftScuolaWidth::MADISOFT_WIDTH_1_8,
    'type'         => 'select',
    'section'      => 'testata',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => 'col-6',
    'condition'    => 'madisoft_scuola_testata_stile:not(standard)',
    'operator'     => 'and',
    'choices'      => [
        [
            'value' => MadisoftScuolaWidth::MADISOFT_WIDTH_1_12,
            'label' => '1/12',
            'src'   => ''
        ],
        [
            'value' => MadisoftScuolaWidth::MADISOFT_WIDTH_1_8,
            'label' => '1/8',
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
    ]
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_testata_template', [
    'id'           => 'madisoft_scuola_testata_stile_logo_right',
    'label'        => 'Logo di destra ',
    'desc'         => '',
    'std'          => '',
    'type'         => 'upload',
    'section'      => 'testata',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => 'col-6',
    'condition'    => 'madisoft_scuola_testata_stile:not(standard)',
    'operator'     => 'and',
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_testata_template', [
    'id'           => 'madisoft_scuola_testata_stile_logo_right_width',
    'label'        => 'larghezza logo di destra',
    'desc'         => '',
    'std'          => MadisoftScuolaWidth::MADISOFT_WIDTH_1_8,
    'type'         => 'select',
    'section'      => 'testata',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => 'col-6',
    'condition'    => 'madisoft_scuola_testata_stile:not(standard)',
    'operator'     => 'and',
    'choices'      => [
        [
            'value' => MadisoftScuolaWidth::MADISOFT_WIDTH_1_12,
            'label' => '1/12',
            'src'   => ''
        ],
        [
            'value' => MadisoftScuolaWidth::MADISOFT_WIDTH_1_8,
            'label' => '1/8',
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
    ]
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_testata_template', [
    'id'           => 'madisoft_scuola_testata_stile_logo_right_link',
    'label'        => 'Eventuale link per il logo di destra',
    'desc'         => '',
    'std'          => '',
    'type'         => 'text',
    'section'      => 'testata',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => 'col-6',
    'condition'    => 'madisoft_scuola_testata_stile:not(standard)',
    'operator'     => 'and',
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_testata_template', [
    'id'           => 'madisoft_scuola_testata_cerca',
    'label'        => 'Mostra il cerca nei dati istituto',
    'desc'         => '',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'testata',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and',
    'choices'   => [],
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_testata_template', [
    'id'        => 'madisoft_scuola_testata_choose_order',
    'label'     => 'ORDINE DELLA TESTATA',
    'desc'      => 'Si scelga l\'ordine in cui mostrare immagini e informazioni',
    'std'          => '1',
    'type'         => 'select',
    'section'   => 'testata',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition' => '',
    'operator'     => 'and',
    'choices'   => [
        [
            'value' => '1',
            'label' => 'Informazioni sotto l\'immagine',
            'src'   => ''
        ],
        [
            'value' => '2',
            'label' => 'Informazioni sopra l\'immagine',
            'src'   => ''
        ],
    ],
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_testata_template', [
    'id'           => 'madisoft_scuola_testata_mostra_slider',
    'label'        => 'IMMAGINI SCORREVOLI',
    'desc'         => 'Se l\'opzione &egrave; "ON" si dovranno impostare le immagini nella sezione \'SLIDER\'.
                    Se l\'opzione &egrave; "OFF", si dovr&agrave; caricare una singola immagine da mostrare nella testata alla voce \'TESTATA --&gt; IMMAGINE\'',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'testata',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_testata_template', [
    'id'           => 'madisoft_scuola_testata_immagine',
    'label'        => 'IMMAGINE',
    'desc'         => 'L\'immagine verr&agrave; mostrata nella testata del sito solo se l\'opzione \'IMMAGINI SCORREVOLI\' &egrave; impostata su NO.',
    'std'          => '',
    'type'         => 'upload',
    'section'      => 'testata',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_testata_mostra_slider:is(off)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_testata_template', [
    'id'           => 'madisoft_scuola_testata_immagine_home',
    'label'        => 'IMMAGINE PER HOME PAGE',
    'desc'         => 'Se presente, nell\'home page verrà mostrata questa immagine',
    'std'          => '',
    'type'         => 'upload',
    'section'      => 'testata',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_testata_mostra_slider:is(off)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_testata_template', [
    'id'           => 'madisoft_scuola_testata_mostra_dati_istituto',
    'label'        => 'MOSTRA DATI ISTITUTO',
    'desc'         => 'Seleziona SI per mostrare i dati dell\'Istituto nella testata del sito sopra il men&ugrave; principale',
    'std'          => 'on',
    'type'         => 'on-off',
    'section'      => 'testata',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_testata_template', [
    'id'           => 'madisoft_scuola_testata_testo_per_dati_istituto',
    'label'        => 'TESTO PER DATI ISTITUTO',
    'desc'         => 'Il testo inserito verr&agrave; mostrato nella testata sopra il men&ugrave; principale solo se l\'opzione \'MOSTRA DATI ISTITUTO\' &egrave; su \'SI\'.
Se l\'opzione &egrave; attiva e nessun testo viene inserito sar&agrave; presente un testo di default generato dal sistema.

Si consiglia di utilizzare la seguenti parole chiave per inserire i dati dell\'Istituti. Nel sito web esse saranno sostituite con i rispettivi dati inseriti nella sezione \'Aspetto --&gt; DATI ISTITUTO\'.

<ul>
<li>$istituto-nome$</li>
<li>$istituto-codiceMeccanografico$</li>
<li>$istituto-codiceIpa$</li>
<li>$istituto-codiceFatturazione$</li>
<li>$istituto-codiceFiscale$</li>
<li>$istituto-cap$</li>
<li>$istituto-comune$</li>
<li>$istituto-provincia$</li>
<li>$istituto-indirizzo$</li>
<li>$istituto-telefono$</li>
<li>$istituto-fax$</li>
<li>$istituto-email$</li>
<li>$istituto-pec$</li>
<li>$istituto-dirigente$</li>
<li>$istituto-dsga$</li>
</ul>',
    'std'          => '',
    'type'         => 'textarea',
    'section'      => 'testata',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_testata_mostra_dati_istituto:is(on)',
    'operator'     => 'and'
]);

madisoft_get_theme_class()->setImpostazioniClass($classeOpzioni);