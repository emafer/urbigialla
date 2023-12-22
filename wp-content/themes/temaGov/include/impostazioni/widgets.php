<?php

$classeOpzioni = madisoft_get_theme_class()->getImpostazioniClass();

$classeOpzioni->aggiungiSezione(3, 'widget', 'BARRE LATERALI' );
$classeOpzioni->aggiungiImpostazione('widget',[
    'id'           => 'posizione_barra_sinistra',
    'label'        => 'Posizione barra sinistra',
    'desc'         => 'selezionare la posizione della barra laterale',
    'std'          => '1',
    'type'         => 'select',
    'section'      => 'widget',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and',
        'choices'      => [
            [
                'value' => '1',
                'label' => '1',
                'src'   => ''
            ],
            [
                'value' => '2',
                'label' => '2',
                'src'   => ''
            ],
            [
                'value' => '3',
                'label' => '3',
                'src'   => ''
            ]
        ]
    ]
);
//$classeOpzioni->aggiungiImpostazione('widget',[
//        'id'           => 'barra_sinistra_titolo',
//        'label'        => 'Titolo barra sinistra',
//        'desc'         => '',
//        'std'          => '',
//        'type'         => 'text',
//        'section'      => 'widget',
//        'rows'         => '',
//        'post_type'    => '',
//        'taxonomy'     => '',
//        'min_max_step' => '',
//        'class'        => '',
//        'condition'    => '',
//        'operator'     => 'and',
//        ]
//);

$classeOpzioni->aggiungiImpostazione('widget',[
     'id'           => 'posizione_barra_destra',
     'label'        => 'Posizione barra destra',
     'desc'         => 'selezionare la posizione della barra laterale',
     'std'          => '3',
     'type'         => 'select',
     'section'      => 'widget',
     'rows'         => '',
     'post_type'    => '',
     'taxonomy'     => '',
     'min_max_step' => '',
     'class'        => '',
     'condition'    => '',
     'operator'     => 'and',
     'choices'      => [
         [
             'value' => '1',
             'label' => '1',
             'src'   => ''
         ],
         [
             'value' => '2',
             'label' => '2',
             'src'   => ''
         ],
         [
             'value' => '3',
             'label' => '3',
             'src'   => ''
         ]
     ]
 ]
);
//$classeOpzioni->aggiungiImpostazione('widget',[
//        'id'           => 'barra_destra_titolo',
//        'label'        => 'Titolo barra destra',
//        'desc'         => '',
//        'std'          => '',
//        'type'         => 'text',
//        'section'      => 'widget',
//        'rows'         => '',
//        'post_type'    => '',
//        'taxonomy'     => '',
//        'min_max_step' => '',
//        'class'        => '',
//        'condition'    => '',
//        'operator'     => 'and',
//    ]
//);
$classeOpzioni->aggiungiImpostazione('widget',[
    'id'           => 'madisoft_scuola_leftsidebar_usa_divisore',
    'label'        => 'Abilitare Il divisore sotto al titolo dei widget(barra sinistra)',
    'desc'         => 'Abilitando questa opzione sar&agrave; possibile inserire una linea sotto il titolo',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'widget',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('widget',[
    'id'           => 'madisoft_scuola_rightsidebar_usa_divisore',
    'label'        => 'Abilitare Il divisore sotto al titolo dei widget (barra destra)',
    'desc'         => 'Abilitando questa opzione sar&agrave; possibile inserire una linea sotto il titolo',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'widget',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('widget',[
    'id'           => 'madisoft_scuola_headerwidget_usa_divisore',
    'label'        => 'Abilitare Il divisore sotto al titolo dei widget (Testata)',
    'desc'         => 'Abilitando questa opzione sar&agrave; possibile inserire una linea sotto il titolo',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'widget',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_testata_separata:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('widget',[
    'id'           => 'madisoft_scuola_footerinterno_usa_divisore',
    'label'        => 'Abilitare Il divisore sotto al titolo dei widget (footer-interno)',
    'desc'         => 'Abilitando questa opzione sar&agrave; possibile inserire una linea sotto il titolo',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'widget',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('widget',[
    'id'           => 'madisoft_scuola_footer_usa_divisore',
    'label'        => 'Abilitare Il divisore sotto al titolo dei widget (footer)',
    'desc'         => 'Abilitando questa opzione sar&agrave; possibile inserire una linea sotto il titolo',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'widget',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('widget', [
    'id'           => 'larghezza_colonna_sinistra',
    'label'        => 'Larghezza colonna Sinistra',
    'desc'         => 'Consigliamo di non modificare questa impostazione se non dopo aver parlato con l\'assistenza',
    'std'          => '2',
    'type'         => 'select',
    'section'      => 'widget',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and',
    'choices'      => [
        [
            'value' => '1',
            'label' => '1',
            'src'   => ''
        ],
        [
            'value' => '2',
            'label' => '2',
            'src'   => ''
        ],
        [
            'value' => '3',
            'label' => '3',
            'src'   => ''
        ],
        [
            'value' => '4',
            'label' => '4',
            'src'   => ''
        ],
        [
            'value' => '5',
            'label' => '5',
            'src'   => ''
        ],
        [
            'value' => '6',
            'label' => '6',
            'src'   => ''
        ]
    ]
]);
$classeOpzioni->aggiungiImpostazione('widget', [
    'id'           => 'larghezza_colonna_destra',
    'label'        => 'Larghezza colonna Destra',
    'desc'         => 'Consigliamo di non modificare questa impostazione se non dopo aver parlato con l\'assistenza',
    'std'          => '2',
    'type'         => 'select',
    'section'      => 'widget',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and',
    'choices'      => [
        [
            'value' => '1',
            'label' => '1',
            'src'   => ''
        ],
        [
            'value' => '2',
            'label' => '2',
            'src'   => ''
        ],
        [
            'value' => '3',
            'label' => '3',
            'src'   => ''
        ],
        [
            'value' => '4',
            'label' => '4',
            'src'   => ''
        ],
        [
            'value' => '5',
            'label' => '5',
            'src'   => ''
        ],
        [
            'value' => '6',
            'label' => '6',
            'src'   => ''
        ]
    ]
]);

$classeOpzioni->aggiungiImpostazione('widget', [
    'id'           => 'madisoft_scuola_usa_footer_interno',
    'label'        => 'Abilita una barra di widget in fondo ai contenuti',
    'desc'         => '',
    'std'          => 'on',
    'type'         => 'on-off',
    'section'      => 'widget',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);

$classeOpzioni->aggiungiImpostazione('widget', [
    'id'           => 'madisoft_scuola_usa_footer',
    'label'        => 'Abilita una barra di widget nel footer',
    'desc'         => '',
    'std'          => 'on',
    'type'         => 'on-off',
    'section'      => 'widget',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('widget',[
        'id'           => 'barra_inferiore_titolo',
        'label'        => 'Titolo barra inferiore',
        'desc'         => '',
        'std'          => '',
        'type'         => 'text',
        'section'      => 'widget',
        'rows'         => '',
        'post_type'    => '',
        'taxonomy'     => '',
        'min_max_step' => '',
        'class'        => '',
        'condition'    => '',
        'operator'     => 'and',
    ]
);$classeOpzioni->aggiungiImpostazione('widget',[
        'id'           => 'barra_interna_titolo',
        'label'        => 'Titolo barra footer interno',
        'desc'         => '',
        'std'          => '',
        'type'         => 'text',
        'section'      => 'widget',
        'rows'         => '',
        'post_type'    => '',
        'taxonomy'     => '',
        'min_max_step' => '',
        'class'        => '',
        'condition'    => '',
        'operator'     => 'and',
    ]
);

madisoft_get_theme_class()->setImpostazioniClass($classeOpzioni);
