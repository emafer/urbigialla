<?php

$classeOpzioni = madisoft_get_theme_class()->getImpostazioniClass();

$classeOpzioni->aggiungiSezione(10, 'madisoft_scuola_opzioni_sezione_pie_di_pagina', 'PIE\' DI PAGINA' );
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_opzioni_sezione_pie_di_pagina', [
    'id'           => 'madisoft_scuola_numero_footer_inferiore_widget',
    'label'        => 'Colonne per la visualizzazione dei widget nella barra inferiore',
    'desc'         => 'Impostare il numero di colonne per la barra inferiore',
    'std'          => '6',
    'type'         => 'select',
    'section'      => 'madisoft_scuola_opzioni_sezione_pie_di_pagina',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and',
    'choices'      => [
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
        ]
    ],
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_opzioni_sezione_pie_di_pagina', [
    'id'           => 'madisoft_scuola_numero_footer_widget_mostra',
    'label'        => 'Mostra i widget nel footer',
    'desc'         => '',
    'std'          => 'on',
    'type'         => 'on-off',
    'section'      => 'madisoft_scuola_opzioni_sezione_pie_di_pagina',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and',
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_opzioni_sezione_pie_di_pagina', [
    'id'           => 'madisoft_scuola_numero_footer_widget',
    'label'        => 'Colonne per la visualizzazione dei widget nei footer',
    'desc'         => 'Impostare il numero di colonne per il footer',
    'std'          => '3',
    'type'         => 'select',
    'section'      => 'madisoft_scuola_opzioni_sezione_pie_di_pagina',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_numero_footer_widget_mostra:is(on)',
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
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_opzioni_sezione_pie_di_pagina',[
    'id'           => 'madisoft_scuola_pie_di_pagina_mostra_dati_istituto',
    'label'        => 'MOSTRA DATI ISTITUTO',
    'desc'         => '',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'madisoft_scuola_opzioni_sezione_pie_di_pagina',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_opzioni_sezione_pie_di_pagina',[
    'id'           => 'madisoft_scuola_pie_di_pagina_testo_per_dati_istituto',
    'label'        => 'TESTO PER DATI ISTITUTO',
    'desc'         => 'Il testo inserito verr&agrave; mostrato nel pie\' di pagina sopra il men&ugrave; principale solo se l\'opzione \'MOSTRA DATI ISTITUTO\' &egrave; su \'SI\'.
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
    'section'      => 'madisoft_scuola_opzioni_sezione_pie_di_pagina',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_pie_di_pagina_mostra_dati_istituto:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_opzioni_sezione_pie_di_pagina',[
    'id'           => 'madisoft_scuola_footer_template',
    'label'        => 'ORDINE PIE\' DI PAGINA',
    'desc'         => 'Si scelga la versione preferita della pie\' di pagina',
    'std'          => '1',
    'type'         => 'select',
    'section'      => 'madisoft_scuola_opzioni_sezione_pie_di_pagina',
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
            'label' => 'Standard: widget del footer (se impostati), informazioni (se impostate) e barra',
            'src'   => ''
        ],
        [
            'value' => '2',
            'label' => 'widget del footer (se impostati), barra e informazioni (se impostate)',
            'src'   => ''
        ],
        [
            'value' => '3',
            'label' => 'barra, widget del footer (se impostati) e informazioni (se impostate)',
            'src'   => ''
        ],
        [
            'value' => '4',
            'label' => 'barra, informazioni (se impostate) e widget del footer (se impostati)',
            'src'   => ''
        ],
        [
            'value' => '5',
            'label' => 'informazioni (se impostate), barra e widget del footer (se impostati)',
            'src'   => ''
        ],
        [
            'value' => '6',
            'label' => 'informazioni (se impostate), widget del footer (se impostati) e barra',
            'src'   => ''
        ],
    ],
]);
