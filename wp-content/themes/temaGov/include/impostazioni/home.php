<?php
$classeOpzioni = madisoft_get_theme_class()->getImpostazioniClass();
$classeOpzioni->aggiungiSezione(6, 'madisoft_scuola_sezione_home_page', 'HOME PAGE' );

$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_home_page',[
    'id'           => 'madisoft_scuola_home_sidebar_mostra',
    'label'        => 'SIDEBAR SU HOME: ATTIVA ?',
    'desc'         => '',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'madisoft_scuola_sezione_home_page',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);

$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_home_page',[
    'id'           => 'madisoft_home_numero_fasce',
    'label'        => 'Numero fasce orizzontali prima del footer nella prima pagina; se cambiato salvare per abilitare le opzioni',
    'desc'         => '',
    'std'          => '3',
    'type'         => 'numeric-slider',
    'section'      => 'madisoft_scuola_sezione_home_page',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '1,25,1',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);

$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_home_page', [
    'id'           => 'madisoft_scuola_allarga_fasce',
    'label'        => 'Allargare le fasce a tutto schermo?',
    'desc'         => '',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'madisoft_scuola_sezione_home_page',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$baseNumFasce = generaTestoBaseOrdinamentoFasce();
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_home_page',[
    'id'           => 'madisoft_home_ordine_fasce',
    'label'        => 'Ordinamento fasce',
    'desc'         => 'scrivere il numero delle fasce nell\'ordine desiderato, separato da spazi: "1 3 2 4 7 6 5"',
    'std'          => trim($baseNumFasce),
    'type'         => 'text',
    'section'      => 'madisoft_scuola_sezione_home_page',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);

$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_home_page',[
    'id'           => 'madisoft_scuola_home_fascia_riduci_titoli',
    'label'        => 'Riduci i titoli?',
    'desc'         => 'Riduce i titoli per uniformare la grandezza del box articolo',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'madisoft_scuola_sezione_home_page',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_home_page',[
    'id'           => 'madisoft_scuola_home_circolari_numero',
    'label'        => 'CIRCOLARI HOME: NUMERO CIRCOLARI DA MOSTRARE',
    'desc'         => '',
    'std'          => '5',
    'type'         => 'numeric-slider',
    'section'      => 'madisoft_scuola_sezione_home_page',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '1,10,1',
    'class'        => '',
    'condition'    => 'madisoft_scuola_home_circolari_mostra:is(on)',
    'operator'     => 'and'
]);
for ($nf =1; $nf <= madisoft_get_theme_option('madisoft_home_numero_fasce', 3); $nf++) {
    aggiungiFascia($classeOpzioni, $nf);
}

/**
 * @param MadisoftThemeOptionClass $classeOpzioni
 * @param int $numeroFascia
 */
function aggiungiFascia($classeOpzioni, $numeroFascia = 1) {
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
//mostra?
    $classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_home_page',[
        'id'           => 'madisoft_scuola_home_fascia' . $numeroFascia . '_mostra',
        'label'        => 'Fascia ' . $numeroFascia . ': mostra?',
        'desc'         => 'Mostra questa fascia',
        'std'          => 'off',
        'type'         => 'on-off',
        'section'      => 'madisoft_scuola_sezione_home_page',
        'rows'         => '',
        'post_type'    => '',
        'taxonomy'     => '',
        'min_max_step' => '',
        'class'        => 'fascia' . $numeroFascia,
        'condition'    => '',
        'operator'     => 'and'
    ]);
    $classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_home_page',[
        'id'           => 'madisoft_scuola_home_fascia' . $numeroFascia . '_chiusa',
        'label'        => 'Fascia ' . $numeroFascia . ': lasciare la fascia chiusa?',
        'desc'         => '',
        'std'          => 'off',
        'type'         => 'on-off',
        'section'      => 'madisoft_scuola_sezione_home_page',
        'rows'         => '',
        'post_type'    => '',
        'taxonomy'     => '',
        'min_max_step' => '',
        'class'        => 'fascia' . $numeroFascia,
        'condition'    => 'madisoft_scuola_home_fascia' . $numeroFascia . '_mostra:is(on)',
        'operator'     => 'and'
    ]);
//titolo
    $classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_home_page',[
        'id'           => 'madisoft_scuola_home_fascia' . $numeroFascia . '_titolo',
        'label'        => 'Fascia ' . $numeroFascia . ': Titolo',
        'desc'         => '',
        'std'          => '',
        'type'         => 'text',
        'section'      => 'madisoft_scuola_sezione_home_page',
        'rows'         => '',
        'post_type'    => '',
        'taxonomy'     => '',
        'min_max_step' => '',
        'class'        => 'fascia' . $numeroFascia,
        'condition'    => 'madisoft_scuola_home_fascia' . $numeroFascia . '_mostra:is(on)',
        'operator'     => 'and'
    ]);
//Tipologia
    $classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_home_page',[
        'id'           => 'madisoft_scuola_home_fascia' . $numeroFascia . '_tipologia',
        'label'        => 'Fascia ' . $numeroFascia . ': Tipo',
        'desc'         => '',
        'std'          => 'categoria',
        'type'         => 'select',
        'section'      => 'madisoft_scuola_sezione_home_page',
        'rows'         => '',
        'post_type'    => '',
        'taxonomy'     => '',
        'min_max_step' => '',
        'class'        => 'fascia' . $numeroFascia,
        'condition'    => 'madisoft_scuola_home_fascia' . $numeroFascia . '_mostra:is(on)',
        'operator'     => 'and',
        'choices'      => [
            [
                'value' => 'categoria',
                'label' => 'Categoria',
                'src'   => ''
            ],
            [
                'value' => 'immagini',
                'label' => 'Immagini scorrevoli (di prossima attivazione)',
                'src'   => ''
            ],
            [
                'value' => 'video-youtube',
                'label' => 'Video Youtube',
                'src'   => ''
            ],
            [
                'value' => 'widget',
                'label' => 'Elementi di una sidebar',
                'src'   => ''
            ],
            [
                'value' => 'fascia',
                'label' => 'Contenuti predisposti',
                'src'   => ''
            ],
//            [
//                'value' => 'video-vimeo',
//                'label' => 'Video vimeo',
//                'src'   => ''
//            ],
//            [
//                'value' => 'evidenza',
//                'label' => 'Notizie in evidenza',
//                'src'   => ''
//            ],
            [
                'value' => 'lista-categoria',
                'label' => 'Archivio categoria',
                'src'   => ''
            ],
            [
                'value' => 'eventi',
                'label' => 'Eventi',
                'src'   => ''
            ],
            [
                'value' => 'circolari (di prossima attivazione)',
                'label' => 'Circolari (interne)',
                'src'   => ''
            ],
            [
                'value' => 'rss',
                'label' => 'Feed Rss, bacheche Nuvola',
                'src'   => ''
            ],
            [
                'value' => 'text',
                'label' => 'Testo/immagini',
                'src'   => ''
            ],
            [
                'value' => 'scorrimento',
                'label' => 'Articoli a scorrimento',
                'src'   => ''
            ]
            ]
    ]);
//immagine di base
    $classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_home_page',[
        'id'           => 'madisoft_scuola_home_fascia' . $numeroFascia . '_immaginebase',
        'label'        => 'Fascia ' . $numeroFascia . ': Immagine di base',
        'desc'         => 'Se nei contenuti non &egrave; stata impostata "l\'immagine in evidenza", verr&agrave; 
        usata questa indicata',
        'std'          => '',
        'type'         => 'upload',
        'section'      => 'madisoft_scuola_sezione_home_page',
        'rows'         => '',
        'post_type'    => '',
        'taxonomy'     => '',
        'min_max_step' => '',
        'class'        => 'fascia' . $numeroFascia,
        'condition'    => 'madisoft_scuola_home_fascia' . $numeroFascia . '_mostra:is(on),madisoft_scuola_home_fascia' . $numeroFascia . '_tipologia:not(video-youtube),madisoft_scuola_home_fascia' . $numeroFascia . '_tipologia:not(widget) ',
        'operator'     => 'and'
    ]);
//numero colonne da mostrare
    $classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_home_page',[
        'id'           => 'madisoft_scuola_home_fascia' . $numeroFascia . '_numerocolonne',
        'label'        => 'Fascia ' . $numeroFascia . ': Numero elementi per riga',
        'desc'         => '',
        'std'          => '4',
        'type'         => 'select',
        'section'      => 'madisoft_scuola_sezione_home_page',
        'rows'         => '',
        'post_type'    => '',
        'taxonomy'     => '',
        'min_max_step' => '',
        'class'        => 'fascia' . $numeroFascia,
        'condition'    => 'madisoft_scuola_home_fascia' . $numeroFascia . '_mostra:is(on),madisoft_scuola_home_fascia' . $numeroFascia . '_tipologia:not(lista-categoria),madisoft_scuola_home_fascia' . $numeroFascia . '_tipologia:not(video-youtube)',
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
            [
                'value' => '6',
                'label' => '6',
            ],
            [
                'value' => '8',
                'label' => '8',
            ],
        ]
    ]);
    $classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_home_page',[
        'id'           => 'madisoft_scuola_home_fascia' . $numeroFascia . '_LinkCategoria',
        'label'        => 'Fascia ' . $numeroFascia . ': Inserire un link per mostrare gli altri elementi della catgegoria',
        'desc'         => '',
        'std'          => 'off',
        'type'         => 'on-off',
        'section'      => 'madisoft_scuola_sezione_home_page',
        'rows'         => '',
        'post_type'    => '',
        'taxonomy'     => '',
        'min_max_step' => '',
        'class'        => 'fascia' . $numeroFascia,
        'condition'    => 'madisoft_scuola_home_fascia' . $numeroFascia . '_mostra:is(on),madisoft_scuola_home_fascia' . $numeroFascia . '_tipologia:is(categoria) or madisoft_scuola_home_fascia' . $numeroFascia . '_tipologia:is(lista-categoria) or madisoft_scuola_home_fascia' . $numeroFascia . '_tipologia:is(scorrimento)',
        'operator'     => 'and'
    ]);
//categorie da mostrare
    $classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_home_page',[
        'id'           => 'madisoft_scuola_home_fascia' . $numeroFascia . '_sceltacategoria',
        'label'        => 'Fascia ' . $numeroFascia . ': Categoria da mostrare',
        'desc'         => '',
        'std'          => '',
        'type'         => 'category-select',
        'section'      => 'madisoft_scuola_sezione_home_page',
        'rows'         => '',
        'post_type'    => '',
        'taxonomy'     => '',
        'min_max_step' => '',
        'class'        => 'fascia' . $numeroFascia,
        'condition'    => 'madisoft_scuola_home_fascia' . $numeroFascia . '_mostra:is(on)',
        'operator'     => 'and'
    ]);
//url rss
    $classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_home_page',[
        'id'           => 'madisoft_scuola_home_fascia' . $numeroFascia . '_urlrss',
        'label'        => 'Fascia ' . $numeroFascia . ': URL RSS da mostrare',
        'desc'         => '',
        'std'          => '',
        'type'         => 'text',
        'section'      => 'madisoft_scuola_sezione_home_page',
        'rows'         => '',
        'post_type'    => '',
        'taxonomy'     => '',
        'min_max_step' => '',
        'class'        => 'fascia' . $numeroFascia,
        'condition'    => 'madisoft_scuola_home_fascia' . $numeroFascia . '_mostra:is(on),madisoft_scuola_home_fascia' . $numeroFascia . '_tipologia:is(rss)',
        'operator'     => 'and'
    ]);
    $classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_home_page',[
        'id'           => 'madisoft_scuola_home_fascia' . $numeroFascia . '_rssmostracome',
        'label'        => 'Fascia ' . $numeroFascia . ': Tipologia di visualizzazione',
        'desc'         => '',
        'std'          => '',
        'type'         => 'select',
        'section'      => 'madisoft_scuola_sezione_home_page',
        'rows'         => '',
        'post_type'    => '',
        'taxonomy'     => '',
        'min_max_step' => '',
        'class'        => 'fascia' . $numeroFascia,
        'condition'    => 'madisoft_scuola_home_fascia' . $numeroFascia . '_mostra:is(on),madisoft_scuola_home_fascia' . $numeroFascia . '_tipologia:is(rss)',
        'operator'     => 'and',
        'choices'      => [
            [
                'value' => 'categoria',
                'label' => 'come categoria',
            ],
            [
                'value' => 'archivio',
                'label' => 'come archivio categoria',
            ],
        ]
    ]);
//url youtybe
    $classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_home_page',[
        'id'           => 'madisoft_scuola_home_fascia' . $numeroFascia . '_url-youtube',
        'label'        => 'Fascia ' . $numeroFascia . ': URL Video Youtube da mostrare',
        'desc'         => '',
        'std'          => '',
        'type'         => 'text',
        'section'      => 'madisoft_scuola_sezione_home_page',
        'rows'         => '',
        'post_type'    => '',
        'taxonomy'     => '',
        'min_max_step' => '',
        'class'        => 'fascia' . $numeroFascia,
        'condition'    => 'madisoft_scuola_home_fascia' . $numeroFascia . '_mostra:is(on),madisoft_scuola_home_fascia' . $numeroFascia . '_tipologia:is(video-youtube)',
        'operator'     => 'and'
    ]);

    $classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_home_page',[
        'id'           => 'madisoft_scuola_home_eventi_mostra_come_articoli_fascia_' . $numeroFascia,
        'label'        => 'Fascia ' . $numeroFascia .': MOSTRARE GLI EVENTI COME ARTICOLI',
        'desc'         => '',
        'std'          => 'off',
        'type'         => 'on-off',
        'section'      => 'madisoft_scuola_sezione_home_page',
        'rows'         => '',
        'post_type'    => '',
        'taxonomy'     => '',
        'min_max_step' => '',
        'class'        => '',
        'condition'    => 'madisoft_scuola_home_fascia' . $numeroFascia . '_mostra:is(on),madisoft_scuola_home_fascia' . $numeroFascia . '_tipologia:is(eventi)',
        'operator'     => 'and'
    ]);
    $classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_home_page',[
        'id'           => 'madisoft_scuola_home_eventi_rendi_cliccabile_titolo_fascia_' . $numeroFascia,
        'label'        => 'Fascia ' . $numeroFascia .': RENDI CLICCABILE IL TITOLO DEGLI EVENTI',
        'desc'         => '',
        'std'          => 'on',
        'type'         => 'on-off',
        'section'      => 'madisoft_scuola_sezione_home_page',
        'rows'         => '',
        'post_type'    => '',
        'taxonomy'     => '',
        'min_max_step' => '',
        'class'        => '',
        'condition'    => 'madisoft_scuola_home_fascia' . $numeroFascia . '_mostra:is(on),madisoft_scuola_home_fascia' . $numeroFascia . '_tipologia:is(eventi)',
        'operator'     => 'and'
    ]);
//url youtybe
    $classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_home_page',[
        'id'           => 'madisoft_scuola_home_fascia' . $numeroFascia . '_url-vimeo',
        'label'        => 'Fascia ' . $numeroFascia . ': URL Video Vimeo da mostrare',
        'desc'         => '',
        'std'          => '',
        'type'         => 'text',
        'section'      => 'madisoft_scuola_sezione_home_page',
        'rows'         => '',
        'post_type'    => '',
        'taxonomy'     => '',
        'min_max_step' => '',
        'class'        => 'fascia' . $numeroFascia,
        'condition'    => 'madisoft_scuola_home_fascia' . $numeroFascia . '_mostra:is(on),madisoft_scuola_home_fascia' . $numeroFascia . '_tipologia:is(video-vimeo)',
        'operator'     => 'and'
    ]);
    $classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_home_page',[
        'id'           => 'madisoft_scuola_home_fascia' . $numeroFascia . '_text',
        'label'        => 'Fascia ' . $numeroFascia . ': Testo',
        'desc'         => '',
        'std'          => '',
        'type'         => 'textarea',
        'section'      => 'madisoft_scuola_sezione_home_page',
        'rows'         => '',
        'post_type'    => '',
        'taxonomy'     => '',
        'min_max_step' => '',
        'class'        => 'fascia' . $numeroFascia,
        'condition'    => 'madisoft_scuola_home_fascia' . $numeroFascia . '_mostra:is(on),madisoft_scuola_home_fascia' . $numeroFascia . '_tipologia:is(text)',
        'operator'     => 'and'
    ]);
//numero elementi
    $classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_home_page',[
        'id'           => 'madisoft_scuola_home_fascia' . $numeroFascia . '_numeroarticoli',
        'label'        => 'Fascia ' . $numeroFascia . ': Numero elementi',
        'desc'         => '',
        'std'          => '4',
        'type'         => 'numeric-slider',
        'section'      => 'madisoft_scuola_sezione_home_page',
        'rows'         => '',
        'post_type'    => '',
        'taxonomy'     => '',
        'min_max_step' => '1,20,1',
        'class'        => 'fascia' . $numeroFascia,
        'condition'    => 'madisoft_scuola_home_fascia' . $numeroFascia . '_mostra:is(on), madisoft_scuola_home_fascia' . $numeroFascia . '_tipologia:not(video-vimeo), ,madisoft_scuola_home_fascia' . $numeroFascia . '_tipologia:not(video-youtube)',
        'operator'     => 'and'
    ]);
//scelta stile primario
    $classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_home_page',[
        'id'           => 'madisoft_scuola_home_fascia' . $numeroFascia . '_stileprimario',
        'label'        => 'Fascia ' . $numeroFascia . ': stile principale',
        'desc'         => '',
        'std'          => 'style1',
        'type'         => 'radio-image',
        'section'      => 'madisoft_scuola_sezione_home_page',
        'rows'         => '',
        'post_type'    => '',
        'taxonomy'     => '',
        'min_max_step' => '',
        'class'        => 'fascia' . $numeroFascia,
        'condition'    => 'madisoft_scuola_home_fascia' . $numeroFascia . '_mostra:is(on),madisoft_scuola_home_fascia' . $numeroFascia . '_tipologia:not(lista-categoria),madisoft_scuola_home_fascia' . $numeroFascia . '_tipologia:not(video-youtube),madisoft_scuola_home_fascia' . $numeroFascia . '_tipologia:not(video-vimeo)',
        'operator'     => 'and',
        'choices'      => $stili
    ]);
    $classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_home_page',[
        'id'           => 'madisoft_scuola_home_fascia' . $numeroFascia . '_mostracontinua',
        'label'        => 'Fascia ' . $numeroFascia . ': Mostra pulsante "Continua a leggere"',
        'desc'         => '',
        'std'          => 'on',
        'type'         => 'on-off',
        'section'      => 'madisoft_scuola_sezione_home_page',
        'rows'         => '',
        'post_type'    => '',
        'taxonomy'     => '',
        'min_max_step' => '',
        'class'        => 'fascia' . $numeroFascia,
        'condition'    => 'madisoft_scuola_home_fascia' . $numeroFascia . '_mostra:is(on)',
        'operator'     => 'and',
    ]);
////scelta stile primario
//    $classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_home_page',[
//        'id'           => 'madisoft_scuola_home_fascia' . $numFascia . '_stilesecondario',
//        'label'        => 'Fascia ' . $numFascia . ': stile secondario',
//        'desc'         => '',
//        'std'          => 'style1',
//        'type'         => 'radio-image',
//        'section'      => 'madisoft_scuola_sezione_home_page',
//        'rows'         => '',
//        'post_type'    => '',
//        'taxonomy'     => '',
//        'min_max_step' => '',
//        'class'        => 'fascia' . $numFascia,
//        'condition'    => 'madisoft_scuola_home_fascia' . $numFascia . '_mostra:is(on), madisoft_scuola_home_fascia' . $numFascia . 'mostralituttiuguali:is(off)',
//        'operator'     => 'and',
//        'choices'      => $stili
//    ]);
////stessostile
//    $classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_home_page',[
//        'id'           => 'madisoft_scuola_home_fascia' . $numFascia . 'mostralituttiuguali',
//        'label'        => 'Fascia ' . $numFascia . ': Unico stile per tutti?',
//        'desc'         => '',
//        'std'          => 'on',
//        'type'         => 'on-off',
//        'section'      => 'madisoft_scuola_sezione_home_page',
//        'rows'         => '',
//        'post_type'    => '',
//        'taxonomy'     => '',
//        'min_max_step' => '',
//        'class'        => 'fascia' . $numFascia,
//        'condition'    => 'madisoft_scuola_home_fascia' . $numFascia . '_mostra:is(on)',
//        'operator'     => 'and'
//    ]);
////numero elementi primario
//    $classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_home_page',[
//        'id'           => 'madisoft_scuola_home_fascia' . $numFascia . '_numeroarticoliprimario',
//        'label'        => 'Fascia ' . $numFascia . ': Numero elementi con lo stile principale. I successivi eventualmente presenti verranno mostrati con lo stile secondario',
//        'desc'         => '',
//        'std'          => '4',
//        'type'         => 'numeric-slider',
//        'section'      => 'madisoft_scuola_sezione_home_page',
//        'rows'         => '',
//        'post_type'    => '',
//        'taxonomy'     => '',
//        'min_max_step' => '1,20,1',
//        'class'        => 'fascia' . $numFascia,
//        'condition'    => 'madisoft_scuola_home_fascia' . $numFascia . '_mostra:is(on), madisoft_scuola_home_fascia' . $numFascia . 'mostralituttiuguali:is(off)',
//        'operator'     => 'and'
//    ]);
//bordo
//    $classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_home_page',[
//        'id'           => 'madisoft_scuola_home_fascia' . $numFascia . '_bordo',
//        'label'        => 'Fascia ' . $numFascia . ': bordo elementi',
//        'desc'         => '',
//        'std'          => 'on',
//        'type'         => 'on-off',
//        'section'      => 'madisoft_scuola_sezione_home_page',
//        'rows'         => '',
//        'post_type'    => '',
//        'taxonomy'     => '',
//        'min_max_step' => '',
//        'class'        => 'cssChange, fascia' . $numFascia,
//        'condition'    => 'madisoft_scuola_home_fascia' . $numFascia . '_mostra:is(on)',
//        'operator'     => 'and'
//    ]);
    $classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_home_page', [
        'id'           => 'madisoft_scuola_home_fascia' . $numeroFascia . '_immagini',
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
        'condition'    => 'madisoft_scuola_home_fascia' . $numeroFascia . '_mostra:is(on),madisoft_scuola_home_fascia' . $numeroFascia . '_tipologia:is(immagini)',
        'operator'     => 'and'
    ]);
    $classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_home_page', [
        'id'           => 'madisoft_scuola_home_fascia' . $numeroFascia . '_immagini_tipo_animazione',
        'label'        => 'TIPO DI ANIMAZIONE',
        'desc'         => '',
        'std'          => 'slide',
        'type'         => 'select',
        'section'      => 'slider',
        'rows'         => '',
        'post_type'    => '',
        'taxonomy'     => '',
        'min_max_step' => '',
        'class'        => '',
        'condition'    => 'madisoft_scuola_home_fascia' . $numeroFascia . '_mostra:is(on),madisoft_scuola_home_fascia' . $numeroFascia . '_tipologia:is(immagini)',
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
    $classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_home_page', [
        'id'           => 'madisoft_scuola_home_fascia' . $numeroFascia . '_intervallo_temporale',
        'label'        => 'INTERVALLO DI TEMPO TRA UN\'IMMAGINE ED UN\'ALTRA',
        'desc'         => 'Inserire il numero dei secondi per attendere la transizione tra un\'immagine ed un\'altra',
        'std'          => '3',
        'type'         => 'numeric-slider',
        'section'      => 'slider',
        'rows'         => '',
        'post_type'    => '',
        'taxonomy'     => '',
        'min_max_step' => '1,10,1',
        'class'        => '',
        'condition'    => 'madisoft_scuola_home_fascia' . $numeroFascia . '_mostra:is(on),madisoft_scuola_home_fascia' . $numeroFascia . '_tipologia:is(immagini)',
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
    $classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_home_page', [
        'id'           => 'madisoft_scuola_home_fascia' . $numeroFascia . '_larghezza',
        'label'        => 'Larghezza della fascia',
        'desc'         => '',
        'std'          => 'container-fluid',
        'type'         => 'select',
        'section'      => 'madisoft_scuola_sezione_home_page',
        'rows'         => '',
        'post_type'    => '',
        'taxonomy'     => '',
        'min_max_step' => '',
        'class'        => '',
        'condition'    => 'madisoft_scuola_home_fascia' . $numeroFascia . '_mostra:is(on)',
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

    $classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_home_page',[
        'id'           => 'madisoft_scuola_home_fascia' . $numeroFascia . '_colore',
        'label'        => 'Colore della fascia',
        'desc'         => '',
        'std'          => '',
        'type'         => 'colorpicker',
        'section'      => 'madisoft_scuola_sezione_home_page',
        'rows'         => '',
        'post_type'    => '',
        'taxonomy'     => '',
        'min_max_step' => '',
        'class'        => 'cssChange',
        'condition'    => 'madisoft_scuola_home_fascia' . $numeroFascia . '_mostra:is(on)',
        'operator'     => 'and'
    ]);

    $classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_home_page',[
        'id'           => 'madisoft_scuola_home_fascia' . $numeroFascia . '_usa_sidebar_esistenti',
        'label'        => 'Fascia ' . $numeroFascia . ': usare una sidebar esistente?',
        'desc'         => '',
        'std'          => 'on',
        'type'         => 'on-off',
        'section'      => 'madisoft_scuola_sezione_home_page',
        'rows'         => '',
        'post_type'    => '',
        'taxonomy'     => '',
        'min_max_step' => '',
        'class'        => 'fascia' . $numeroFascia,
        'condition'    => 'madisoft_scuola_home_fascia' . $numeroFascia . '_mostra:is(on),madisoft_scuola_home_fascia' . $numeroFascia . '_tipologia:is(widget)',
        'operator'     => 'and'
    ]);
        $classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_home_page',[
        'id'           => 'madisoft_scuola_home_fascia' . $numeroFascia . '_usa_sidebar',
        'label'        => 'Fascia ' . $numeroFascia . ': segliere la sidebar',
        'desc'         => '',
        'std'          => '',
        'type'         => 'sidebar-select',
        'section'      => 'madisoft_scuola_sezione_home_page',
        'rows'         => '',
        'post_type'    => '',
        'taxonomy'     => '',
        'min_max_step' => '',
        'class'        => 'fascia' . $numeroFascia,
        'condition'    => 'madisoft_scuola_home_fascia' . $numeroFascia . '_mostra:is(on),madisoft_scuola_home_fascia' . $numeroFascia . '_tipologia:is(widget)',
        'operator'     => 'and',
    ]);
        $classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_home_page',[
        'id'           => 'madisoft_scuola_home_fascia' . $numeroFascia . '_usa_contenuto_fascia',
        'label'        => 'Fascia ' . $numeroFascia . ': scegli il contenuto',
        'desc'         => '',
        'std'          => '',
        'type'         => 'custom-post-type-select',
        'section'      => 'madisoft_scuola_sezione_home_page',
        'rows'         => '',
        'post_type'    => 'fascia_home',
        'taxonomy'     => '',
        'min_max_step' => '',
        'class'        => 'fascia' . $numeroFascia,
        'condition'    => 'madisoft_scuola_home_fascia' . $numeroFascia . '_mostra:is(on) and madisoft_scuola_home_fascia' . $numeroFascia . '_tipologia:is(fascia)',
        'operator'     => 'and',
    ]);
}

madisoft_get_theme_class()->setImpostazioniClass($classeOpzioni);