<?php
$classeOpzioni = madisoft_get_theme_class()->getImpostazioniClass();

$stili = [
    [
        'value' => '2',
        'label' => '2',
        'src'   => madisoft_scuola_get_assets_directory('img', true, 'stile2.png')
    ],
    [
        'value' => '3',
        'label' => '3',
        'src'   => madisoft_scuola_get_assets_directory('img', true, 'stile3.png')
    ],
    [
        'value' => '4',
        'label' => '4',
        'src'   => madisoft_scuola_get_assets_directory('img', true, 'stile4.gif')
    ],
    [
        'value' => '1',
        'label' => '1',
        'src'   => madisoft_scuola_get_assets_directory('img', true, 'stile1.png')
    ],
];
$classeOpzioni->aggiungiSezione(3, 'madisoft_scuola_layout_pagine', 'LAYOUT PAGINE' );
$classeOpzioni->aggiungiSezione(4, 'madisoft_scuola_layout_articoli', 'LAYOUT ARTICOLI' );
$classeOpzioni->aggiungiSezione(5, 'madisoft_scuola_layout_categorie', 'LAYOUT CATEGORIE' );
//PAGINE
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_layout_pagine', [
    'id'      => 'madisoft_scuola_layout_struttura_colonne',
    'label'   => 'Imposta il numero di colonne che desideri avere nelle pagine  principali',
    'desc'    => 'La visualizzazione delle colonne pu&ograve; essere modificata nelle singole pagine',
    'std'     => '3',
    'type'    => 'radio',
    'section' => 'madisoft_scuola_layout_pagine',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and',
    'choices'   => [
        [
            'value' => '3',
            'label' => '3',
        ],
        [
            'value' => '2r',
            'label' => '2, barra a destra',
        ],
        [
            'value' => '2l',
            'label' => '2, barra a sinistra',
        ],
        [
            'value' => '1',
            'label' => 'Senza barre',
        ]
    ]
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_layout_pagine', [
    'id'           => 'madisoft_scuola_content_in_categoria_collegata',
    'label'        => 'TESTO COMPLETO NELLE CATEGORIE COLLEGATE',
    'desc'         => 'Se impostato a ON nella lista degli articoli collegati alla pagina verr&agrave; visualizzato il testo completo',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'madisoft_scuola_layout_pagine',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_layout_pagine', [
    'id'           => 'madisoft_scuola_mostra_meta_pagina',
    'label'        => 'Mostra le informazioni dell\' articolo (data di pubblicazione, autore...)',
    'desc'         => '',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'madisoft_scuola_layout_pagine',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_layout_pagine', [
    'id'           => 'madisoft_scuola_mostra_meta_data_pagina',
    'label'        => 'Mostra la data di creazione della pagina',
    'desc'         => '',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'madisoft_scuola_layout_pagine',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_mostra_meta_pagina:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_layout_pagine', [
    'id'           => 'madisoft_scuola_mostra_meta_autore',
    'label'        => 'Mostra l\'autore dela pagina',
    'desc'         => '',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'madisoft_scuola_layout_pagine',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_mostra_meta_pagina:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_layout_pagine',[
    'id'           => 'madisoft_scuola_categoria_collegata_titolo_mostra',
    'label'        => 'MOSTRARE UN TITOLO PER LA CATEGORIA COLLEGATA',
    'desc'         => '',
    'std'          => 'on',
    'type'         => 'on-off',
    'section'      => 'madisoft_scuola_layout_pagine',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and',
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_layout_pagine',[
    'id'           => 'madisoft_scuola_categoria_collegata_titolo_categoria',
    'label'        => 'CATEGORIA COLLEGATA: MOSTRARE IL TITOLO DELLA PAGINA',
    'desc'         => '',
    'std'          => 'on',
    'type'         => 'on-off',
    'section'      => 'madisoft_scuola_layout_pagine',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_categoria_collegata_titolo_mostra:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_layout_pagine',[
    'id'           => 'madisoft_scuola_categoria_collegata_titolo',
    'label'        => 'CATEGORIA COLLEGATA: SUFFISSO AL TITOLO DA MOSTRARE',
    'desc'         => 'Se abilitata l\'opzione precedente, il testo sar&agrave; aggiunto 
    al titolo della categoria',
    'std'          => 'Articoli recenti',
    'type'         => 'text',
    'section'      => 'madisoft_scuola_layout_pagine',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_categoria_collegata_titolo_mostra:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_layout_pagine',[
    'id'           => 'madisoft_scuola_categoria_collegata_numero_articoli',
    'label'        => 'CATEGORIA COLLEGATA: NUMERO ARTICOLI DA MOSTRARE',
    'desc'         => '',
    'std'          => '8',
    'type'         => 'numeric-slider',
    'section'      => 'madisoft_scuola_layout_pagine',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '1,20,1',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_layout_pagine',[
    'id'           => 'madisoft_scuola_categoria_collegata_stile',
    'label'        => 'Stile vista articoli collegati',
    'desc'         => '',
    'std'          => 'categoria',
    'type'         => 'select',
    'section'      => 'madisoft_scuola_layout_pagine',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_categoria_collegata_titolo_mostra:is(on)',
    'operator'     => 'and',
    'choices'      => [
        [
            'value' => 'categoria',
            'label' => 'Categoria',
            'src'   => ''
        ],
        [
            'value' => 'archivio-categoria',
            'label' => 'archivio categoria',
            'src'   => ''
        ],
    ]
    ]
);

$classeOpzioni->aggiungiImpostazione('madisoft_scuola_layout_pagine',[
    'id'           => 'madisoft_scuola_categoria_collegata_stile_articoli',
    'label'        => 'Stile articoli',
    'desc'         => '',
    'std'          => '2',
    'type'         => 'radio-image',
    'section'      => 'madisoft_scuola_layout_pagine',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_categoria_collegata_titolo_mostra:is(on),madisoft_scuola_categoria_collegata_stile:is(categoria)',
    'operator'     => 'and',
    'choices'      => $stili
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_layout_pagine',[
    'id'           => 'madisoft_scuola_categoria_collegata_nav_link',
    'label'        => 'CATEGORIA COLLEGATA: Permetterne la navigazione',
    'desc'         => '',
    'std'          => 'on',
    'type'         => 'on-off',
    'section'      => 'madisoft_scuola_layout_pagine',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);




//ARTICOLI
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_layout_struttura_colonne_post', [
    'id'      => 'madisoft_scuola_layout_struttura_colonne_post',
    'label'   => 'Imposta il numero di colonne che desideri avere negli articoli',
    'desc'    => '',
    'std'     => '3',
    'type'    => 'radio',
    'section' => 'madisoft_scuola_layout_articoli',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and',
    'choices'   => [
        [
            'value' => '3',
            'label' => '3',
        ],
        [
            'value' => '2r',
            'label' => '2, barra a destra',
        ],
        [
            'value' => '2l',
            'label' => '2, barra a sinistra',
        ],
        [
            'value' => '1',
            'label' => 'Senza barre',
        ]
    ]
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_layout_articoli', [
    'id'      => 'madisoft_scuola_evidenza_immaginebase',
    'label'   => 'Immagine per articoli in evidenza senza immagine preimpostata',
    'desc'    => '',
    'std'     => '',
    'type'    => 'upload',
    'section' => 'madisoft_scuola_layout_articoli',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and',
    'choices'   => [
            ]
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_layout_struttura_colonne_post', [
    'id'           => 'madisoft_scuola_mostra_breadcrumbs_post',
    'label'        => 'Mostra le briciole di pane negli articoli',
    'desc'         => '',
    'std'          => 'on',
    'type'         => 'on-off',
    'section'      => 'madisoft_scuola_layout_articoli',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_layout_struttura_colonne_post', [
    'id'           => 'madisoft_scuola_mostra_meta',
    'label'        => 'Mostra le informazioni dell\' articolo (data di pubblicazione, autore...)',
    'desc'         => '',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'madisoft_scuola_layout_articoli',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);

$classeOpzioni->aggiungiImpostazione('madisoft_scuola_layout_struttura_colonne_post', [
    'id'           => 'madisoft_scuola_mostra_meta_data_home',
    'label'        => 'Mostra i metadati anche in home page',
    'desc'         => '',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'madisoft_scuola_layout_articoli',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_mostra_meta:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_layout_struttura_colonne_post', [
    'id'           => 'madisoft_scuola_mostra_meta_data',
    'label'        => 'Mostra la data di creazione dell\'articolo',
    'desc'         => '',
    'std'          => 'on',
    'type'         => 'on-off',
    'section'      => 'madisoft_scuola_layout_articoli',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_mostra_meta:is(on)',
    'operator'     => 'and'
]);

$classeOpzioni->aggiungiImpostazione('madisoft_scuola_layout_struttura_colonne_post', [
    'id'           => 'madisoft_scuola_mostra_meta_data_orario',
    'label'        => 'Mostra l\'orario di creazione?',
    'desc'         => '',
    'std'          => 'on',
    'type'         => 'on-off',
    'section'      => 'madisoft_scuola_layout_articoli',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_mostra_meta_data:is(on)',
    'operator'     => 'and'
]);

$classeOpzioni->aggiungiImpostazione('madisoft_scuola_layout_struttura_colonne_post', [
    'id'           => 'madisoft_scuola_formato_data_orario',
    'label'        => 'Formato orario',
    'desc'         => 'Impostare con l\'ausilio dell\'assistenza',
    'std'          => 'H:i',
    'type'         => 'text',
    'section'      => 'madisoft_scuola_layout_articoli',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_mostra_meta_data_orario:is(on),madisoft_scuola_mostra_meta:is(on)',
    'operator'     => 'and'
]);

$classeOpzioni->aggiungiImpostazione('madisoft_scuola_layout_struttura_colonne_post', [
    'id'           => 'madisoft_scuola_formato_data_metadata',
    'label'        => 'Formato orario',
    'desc'         => 'Impostare con l\'ausilio dell\'assistenza',
    'std'          => 'l j F Y',
    'type'         => 'text',
    'section'      => 'madisoft_scuola_layout_articoli',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_mostra_meta_data:is(on),madisoft_scuola_mostra_meta:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_layout_struttura_colonne_post', [
    'id'           => 'madisoft_scuola_prefix_data_metadata',
    'label'        => 'Prefisso per la data',
    'desc'         => 'Impostare con l\'ausilio dell\'assistenza',
    'std'          => ' del ',
    'type'         => 'text',
    'section'      => 'madisoft_scuola_layout_articoli',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_mostra_meta_data:is(on),madisoft_scuola_mostra_meta:is(on)',
    'operator'     => 'and'
]);

$classeOpzioni->aggiungiImpostazione('madisoft_scuola_layout_struttura_colonne_post', [
    'id'           => 'madisoft_scuola_mostra_meta_autore',
    'label'        => 'Mostra l\'autore dell\'articolo',
    'desc'         => '',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'madisoft_scuola_layout_articoli',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_mostra_meta:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_layout_struttura_colonne_post', [
    'id'           => 'madisoft_scuola_mostra_meta_categorie',
    'label'        => 'Mostra le categorie dell\'articolo',
    'desc'         => '',
    'std'          => 'on',
    'type'         => 'on-off',
    'section'      => 'madisoft_scuola_layout_articoli',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_mostra_meta:is(on)',
    'operator'     => 'and'
]);

//CATEGORIE
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_layout_categorie', [
    'id'      => 'madisoft_scuola_layout_struttura_colonne_archive',
    'label'   => 'Imposta il numero di colonne che desideri avere nelle liste di articoli o nelle scuole',
    'desc'    => 'La visualizzazione delle colonne pu&ograve; essere modificata nelle singole pagine',
    'std'     => '3',
    'type'    => 'radio',
    'section' => 'madisoft_scuola_layout_categorie',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and',
    'choices'   => [
        [
            'value' => '3',
            'label' => '3',
        ],
        [
            'value' => '2r',
            'label' => '2, barra a destra',
        ],
        [
            'value' => '2l',
            'label' => '2, barra a sinistra',
        ],
        [
            'value' => '1',
            'label' => 'Senza barre',
        ]
    ]
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_layout_categorie', [
    'id'           => 'madisoft_scuola_content_in_categoria',
    'label'        => 'TESTO COMPLETO NELLE CATEGORIE',
    'desc'         => 'Se impostato a ON nella lista degli articoli collegati alla pagina verr&agrave; visualizzato il testo completo',
    'std'          => 'on',
    'type'         => 'on-off',
    'section'      => 'madisoft_scuola_layout_categorie',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_layout_categorie', [
    'id'           => 'madisoft_scuola_usa_divisore',
    'label'        => 'Abilitare Il divisore sotto al titolo',
    'desc'         => 'Abilitando questa opzione sar&agrave; possibile inserire una linea sotto il titolo',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'madisoft_scuola_layout_categorie',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_layout_categorie', [
    'id'           => 'madisoft_scuola_mostra_data_nei_post',
    'label'        => 'DATA ARTICOLI: MOSTRA?',
    'desc'         => 'Se impostato a ON nella lista degli articoli verr&agrave; visualizzata la data di pubblicazione',
    'std'          => 'on',
    'type'         => 'on-off',
    'section'      => 'madisoft_scuola_layout_categorie',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_layout_categorie', [
    'id'           => 'madisoft_scuola_mostra_bordo_inferiore_articoli',
    'label'        => 'Inserire un bordo sotto agli articoli',
    'desc'         => '',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'madisoft_scuola_layout_categorie',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and',
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_layout_categorie', [
    'id'           => 'madisoft_scuola_numero_colonne_articoli',
    'label'        => 'Colonne per la visualizzazione degli articoli',
    'desc'         => 'Usare solo se consigliato dall\'assistenza',
    'std'          => '1',
    'type'         => 'select',
    'section'      => 'madisoft_scuola_layout_categorie',
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
        ],
        [
            'value' => '2',
            'label' => '2',
        ],
        [
            'value' => '3',
            'label' => '3',
        ],
        [
            'value' => '4',
            'label' => '4',
        ],
    ],
]);
//scelta stile primario
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_layout_categorie',[
    'id'           => 'madisoft_scuola_layout_style_categoria',
    'label'        => 'Stile da abilitare',
    'desc'         => '',
    'std'          => 'style2',
    'type'         => 'radio-image',
    'section'      => 'madisoft_scuola_layout_categorie',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and',
    'choices'      => $stili
]);


madisoft_get_theme_class()->setImpostazioniClass($classeOpzioni);