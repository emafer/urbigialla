<?php
$classeOpzioni = madisoft_get_theme_class()->getImpostazioniClass();
$classeOpzioni->aggiungiSezione(7, 'intro', 'SEZIONE DI BENVENUTO NELLA PAGINA' );
$classeOpzioni->aggiungiImpostazione('intro', [
    'id'           => 'page_intro_fascia',
    'label'        => 'Abilita Fascia di benvenuto',
    'desc'         => 'Se l\'opzione &egrave; "ON" si potr&agrave; impostare una fascia introduttiva con immagini scorrevoli',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'intro',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('intro', [
    'id'           => 'page_intro_fascia_in_content',
    'label'        => 'Inserisci Fascia all\'interno della pagina',
    'desc'         => 'Se l\'opzione &egrave; "Off" la fascia di benvenuto sar&agrave; larga quanto la pagina, altrimenti 
                    verr&agrave; ridotta alla dimesione del contenuto',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'intro',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'page_intro_fascia:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('intro', [
    'id'           => 'page_intro_fascia_home',
    'label'        => 'Abilita Fascia di benvenuto solo nella pagina Home',
    'desc'         => '',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'intro',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);

$classeOpzioni->aggiungiImpostazione('intro', [
    'id'           => 'page_intro_tipo_fascia',
    'label'        => 'Scegliere cosa mostrare nella fascia',
    'desc'         => '',
    'std'          => 'immagine',
    'type'         => 'select',
    'section'      => 'intro',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'page_intro_fascia:is(on)',
    'operator'     => 'and',
    'choices'      => [
        [
            'value' => 'immagine',
            'label' => 'Immagine',
        ],
        [
            'value' => 'youtube',
            'label' => 'Video   ',
        ],
    ],
]);
$classeOpzioni->aggiungiImpostazione('intro', [
    'id'           => 'madisoft_scuola_intro_mostra_youtube',
    'label'        => 'Video',
    'desc'         => '',
    'std'          => '',
    'type'         => 'text',
    'section'      => 'intro',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'page_intro_fascia:is(on),page_intro_tipo_fascia:is(youtube)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('intro', [
    'id'           => 'madisoft_scuola_intro_mostra_slider',
    'label'        => 'IMMAGINI SCORREVOLI',
    'desc'         => 'Se l\'opzione &egrave; "ON" si dovranno impostare le immagini ',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'intro',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'page_intro_fascia:is(on),page_intro_tipo_fascia:is(immagine)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('intro', [
    'id'           => 'madisoft_scuola_intro_immagine',
    'label'        => 'IMMAGINE PER LA FASCIA',
    'desc'         => 'L\'immagine verr&agrave; mostrata nella parte laterale solo se l\'opzione \'SLIDER\' &egrave; impostata su NO.',
    'std'          => '',
    'type'         => 'upload',
    'section'      => 'intro',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'page_intro_fascia:is(on),madisoft_scuola_intro_mostra_slider:is(off),page_intro_tipo_fascia:is(immagine)',
    'operator'     => 'and'
]);

$classeOpzioni->aggiungiImpostazione('intro', [
    'id'           => 'page_intro_fascia_immagini_text',
    'label'        => 'Mostra titoli delle immagini',
    'desc'         => '',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'intro',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('intro', [
    'id'           => 'madisoft_scuola_intro_immagine_not_home',
    'label'        => 'IMMAGINE PER LA FASCIA (NON HOME PAGE)',
    'desc'         => '',
    'std'          => '',
    'type'         => 'upload',
    'section'      => 'intro',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'page_intro_fascia:is(on),page_intro_tipo_fascia:is(immagine)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('intro', [
    'id'           => 'madisoft_scuola_intro_slider_immagini',
    'label'        => 'IMMAGINI',
    'desc'         => 'Carica le immagini da mostrare nello slider',
    'std'          => '',
    'type'         => 'slider',
    'section'      => 'intro',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'page_intro_fascia:is(on),madisoft_scuola_intro_mostra_slider:is(on),page_intro_tipo_fascia:is(immagine)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('intro', [
    'id'           => 'madisoft_scuola_intro_slider_intervallo_temporale',
    'label'        => 'INTERVALLO DI TEMPO TRA UN\'IMMAGINE ED UN\'ALTRA',
    'desc'         => 'Inserire il numero dei secondi per attendere la transizione tra un\'immagine ed un\'altra',
    'std'          => '3',
    'type'         => 'numeric-slider',
    'section'      => 'intro',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '1,10,1',
    'class'        => '',
    'condition'    => 'page_intro_fascia:is(on),madisoft_scuola_intro_mostra_slider:is(on),page_intro_tipo_fascia:is(immagine)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('intro', [
    'id'           => 'madisoft_scuola_intro_slider_tipo_animazione',
    'label'        => 'TIPO DI ANIMAZIONE',
    'desc'         => '',
    'std'          => 'slide',
    'type'         => 'select',
    'section'      => 'intro',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'page_intro_fascia:is(on),madisoft_scuola_intro_mostra_slider:is(on),page_intro_tipo_fascia:is(immagine)',
    'operator'     => 'and',
    'choices'      => [
        [
            'value' => 'fade',
            'label' => 'DISSOLVENZA',
            'src'   => ''
        ],
        [
            'value' => 'slide',
            'label' => 'SCORRIMENTO',
            'src'   => ''
        ]
    ]
]);
//BOX LATERALE
$classeOpzioni->aggiungiImpostazione('intro', [
    'id'           => 'madisoft_intro_mostra_box',
    'label'        => 'Mostrare un box laterale a destra della fascia',
    'desc'         => 'Se l\'opzione &egrave; "Off" la fascia di benvenuto, se impostata, sar&agrave; mostrata 
                    sopra alle barre laterali',
    'std'          => 'on',
    'type'         => 'on-off',
    'section'      => 'intro',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'page_intro_fascia:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('intro', [
    'id'           => 'page_intro_tipo_box',
    'label'        => 'Scegliere cosa mostrare nel box laterale',
    'desc'         => '',
    'std'          => 'immagine',
    'type'         => 'select',
    'section'      => 'intro',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'page_intro_fascia:is(on),madisoft_intro_mostra_box:is(on)',
    'operator'     => 'and',
    'choices'      => [
        [
            'value' => 'immagine',
            'label' => 'Immagine',
        ],
        [
            'value' => 'testo',
            'label' => 'Testo',
        ],
    ],
]);
$classeOpzioni->aggiungiImpostazione('intro', [
    'id'           => 'madisoft_scuola_intro_box_immagine',
    'label'        => 'IMMAGINE PER IL BOX LATERALE',
    'desc'         => '',
    'std'          => '',
    'type'         => 'upload',
    'section'      => 'intro',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'page_intro_fascia:is(on),madisoft_intro_mostra_box:is(on),page_intro_tipo_box:is(immagine)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('intro', [
    'id'           => 'madisoft_scuola_intro_testo',
    'label'        => 'TESTO SEZIONE DI BENVENUTO',
    'desc'         => '',
    'std'          => '',
    'type'         => 'textarea',
    'section'      => 'intro',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'page_intro_fascia:is(on),page_intro_tipo_box:is(testo),madisoft_intro_mostra_box:is(on)',
    'operator'     => 'and'
]);

madisoft_get_theme_class()->setImpostazioniClass($classeOpzioni);

