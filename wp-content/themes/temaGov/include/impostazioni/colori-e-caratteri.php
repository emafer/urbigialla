<?php

$classeOpzioni = madisoft_get_theme_class()->getImpostazioniClass();
$classeOpzioni->aggiungiSezione(14, 'madisoft_scuola_sezione_grafica_less', 'GESTIONE COLORI' );
$classeOpzioni->aggiungiSezione(15, 'madisoft_scuola_sezione_grafica_fonts', 'GESTIONE CARATTERI' );

$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_less',[
    'id'           => 'madisoft_scuola_grafica_colore_sfondo',
    'label'        => 'SFONDO',
    'desc'         => 'Modificando l\'opzione \'SFONDO\' verr&agrave; modificato il colore di sfondo del sito',
    'std'          => '#ffffff',
    'type'         => 'colorpicker',
    'section'      => 'madisoft_scuola_sezione_grafica_less',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => 'cssChange',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_less',[
    'id'           => 'madisoft_scuola_grafica_box_shadow',
    'label'        => 'INSERISCI UN BORDO ALLA PAGINA',
    'desc'         => 'Se abilitata, questa opzione permette di visualizzare un bordo per definie in maniera pi&ugrave;
							 netta l\'area della pagina',
    'std'          => 'on',
    'type'         => 'on-off',
    'section'      => 'madisoft_scuola_sezione_grafica_less',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => 'cssChange',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_less',[
    'id'           => 'madisoft_scuola_grafica_colore_sfondo_header',
    'label'        => 'SFONDO HEADER',
    'desc'         => 'Modificando l\'opzione \'SFONDO PAGINA\' verr&agrave; modificato il colore di sfondo dell\'area di testo in tutte le pagine',
    'std'          => '#0066cc',
    'type'         => 'colorpicker',
    'section'      => 'madisoft_scuola_sezione_grafica_less',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => 'cssChange',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_less',[
    'id'           => 'madisoft_scuola_grafica_colore_sfondo_wrapper',
    'label'        => 'SFONDO PAGINA',
    'desc'         => 'Modificando l\'opzione \'SFONDO PAGINA\' verr&agrave; modificato il colore di sfondo dell\'area di testo in tutte le pagine',
    'std'          => '#ffffff',
    'type'         => 'colorpicker',
    'section'      => 'madisoft_scuola_sezione_grafica_less',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => 'cssChange',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_less',[
    'id'           => 'madisoft_scuola_grafica_colore_principale',
    'label'        => 'COLORE PREVALENTE',
    'desc'         => 'L\'opzione "COLORE PREVALENTE" agisce su: <em>Colore di sfondo dei men&ugrave;</em>,
																<em>Colore della barra a pi&egrave; di pagina</em> e sul <em>Colore dei collegamenti</em>, a meno di non impostare a "ON"
																l\'opzione "GESTISCI OPZIONI AVANZATE"',
    'std'          => '#0066cc',
    'type'         => 'colorpicker',
    'section'      => 'madisoft_scuola_sezione_grafica_less',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => 'cssChange',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_less',[
    'id'           => 'madisoft_scuola_grafica_colore_carattere_principale',
    'label'        => 'COLORE CARATTERE MENU',
    'desc'         => 'Questa opzione permette di gestire il colore del carattere quando &egrave; di contrasto
							al "COLORE PREVALENTE" (nei <em> men&ugrave;</em>, nella <em>barra a pi&egrave; di pagina</em>) a meno di non
							impostare a "ON" l\'opzione "GESTISCI OPZIONI AVANZATE"',
    'std'          => '#ffffff',
    'type'         => 'colorpicker',
    'section'      => 'madisoft_scuola_sezione_grafica_less',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => 'cssChange',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_less',[
    'id'           => 'madisoft_scuola_grafica_opzioni_avanzate',
    'label'        => 'GESTISCI OPZIONI AVANZATE',
    'desc'         => 'Se abilitata, questa opzione permette di gestire i colori delle singole parti del sito:
							i <em>men&ugrave;</em> le <em>barre di destra e sinistra</em>, il <em>colore del pie\' di pagina</em>...',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'madisoft_scuola_sezione_grafica_less',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => 'cssChange',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_less',[
    'id'           => 'madisoft_scuola_grafica_colore_link',
    'label'        => 'COLORE LINK',
    'desc'         => '',
    'std'          => '#00006B',
    'type'         => 'colorpicker',
    'section'      => 'madisoft_scuola_sezione_grafica_less',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => 'cssChange',
    'condition'    => 'madisoft_scuola_grafica_opzioni_avanzate:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_less',[
    'id'           => 'madisoft_scuola_grafica_colore_sfondo_menu_superiore',
    'label'        => 'SFONDO MEN&Ugrave; SUPERIORE',
    'desc'         => '',
    'std'          => '#424f78',
    'type'         => 'colorpicker',
    'section'      => 'madisoft_scuola_sezione_grafica_less',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => 'cssChange',
    'condition'    => 'madisoft_scuola_grafica_mostra_menu_superiore:is(on),madisoft_scuola_grafica_opzioni_avanzate:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_less',[
    'id'           => 'madisoft_scuola_grafica_colore_carattere_menu_superiore',
    'label'        => 'CARATTERE MEN&Ugrave; SUPERIORE',
    'desc'         => '',
    'std'          => '#f0f0f0',
    'type'         => 'colorpicker',
    'section'      => 'madisoft_scuola_sezione_grafica_less',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => 'cssChange',
    'condition'    => 'madisoft_scuola_grafica_mostra_menu_superiore:is(on),madisoft_scuola_grafica_opzioni_avanzate:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_less',[
    'id'           => 'madisoft_scuola_grafica_colore_sfondo_menu_principale',
    'label'        => 'SFONDO MEN&Ugrave; PRINCIPALE',
    'desc'         => '',
    'std'          => '#424f78',
    'type'         => 'colorpicker',
    'section'      => 'madisoft_scuola_sezione_grafica_less',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => 'cssChange',
    'condition'    => 'madisoft_scuola_grafica_opzioni_avanzate:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_less',[
    'id'           => 'madisoft_scuola_grafica_colore_carattere_menu_principale',
    'label'        => 'CARATTERE MEN&Ugrave; PRINCIPALE',
    'desc'         => '',
    'std'          => '#f0f0f0',
    'type'         => 'colorpicker',
    'section'      => 'madisoft_scuola_sezione_grafica_less',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => 'cssChange',
    'condition'    => 'madisoft_scuola_grafica_opzioni_avanzate:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_less',[
    'id'           => 'madisoft_scuola_grafica_rightbar',
    'label'        => 'MODIFICA BARRA DI DESTRA',
    'desc'         => 'Se abilitata questa opzione permette modificare i colori dei blocchi della barra di destra',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'madisoft_scuola_sezione_grafica_less',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => 'cssChange',
    'condition'    => 'madisoft_scuola_grafica_opzioni_avanzate:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_less',[
    'id'           => 'madisoft_scuola_grafica_colore_sfondo_rightbar',
    'label'        => 'SFONDO BARRA A DESTRA',
    'desc'         => '',
    'std'          => '#ffffff',
    'type'         => 'colorpicker',
    'section'      => 'madisoft_scuola_sezione_grafica_less',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => 'cssChange',
    'condition'    => 'madisoft_scuola_grafica_opzioni_avanzate:is(on),madisoft_scuola_grafica_rightbar:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_less',[
    'id'           => 'madisoft_scuola_grafica_colore_widget_rightbar',
    'label'        => 'SFONDO TITOLI BLOCCHI DI DESTRA',
    'desc'         => '',
    'std'          => '#424f78',
    'type'         => 'colorpicker',
    'section'      => 'madisoft_scuola_sezione_grafica_less',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => 'cssChange',
    'condition'    => 'madisoft_scuola_grafica_opzioni_avanzate:is(on),madisoft_scuola_grafica_rightbar:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_less',[
    'id'           => 'madisoft_scuola_grafica_colore_widget_rightbar_font',
    'label'        => 'CARATTERE TITOLI BLOCCHI DI DESTRA',
    'desc'         => '',
    'std'          => '#F0F0F0',
    'type'         => 'colorpicker',
    'section'      => 'madisoft_scuola_sezione_grafica_less',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => 'cssChange',
    'condition'    => 'madisoft_scuola_grafica_opzioni_avanzate:is(on),madisoft_scuola_grafica_rightbar:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_less',[
    'id'           => 'madisoft_scuola_grafica_bordi_rightbar',
    'label'        => 'BORDO BLOCCHI DI DESTRA',
    'desc'         => 'Se abilitata questa opzione permette di inserire un bordo ai blocchi della barra laterale',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'madisoft_scuola_sezione_grafica_less',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => 'cssChange',
    'condition'    => 'madisoft_scuola_grafica_opzioni_avanzate:is(on),madisoft_scuola_grafica_rightbar:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_less',[
    'id'           => 'madisoft_scuola_grafica_colore_bordo_widget_rightbar',
    'label'        => 'COLORE BORDO BLOCCO DI DESTRA',
    'desc'         => '',
    'std'          => '#424f78',
    'type'         => 'colorpicker',
    'section'      => 'madisoft_scuola_sezione_grafica_less',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => 'cssChange',
    'condition'    => 'madisoft_scuola_grafica_opzioni_avanzate:is(on),madisoft_scuola_grafica_bordi_rightbar:is(on),madisoft_scuola_grafica_rightbar:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_less',[
    'id'           => 'madisoft_scuola_grafica_spessore_bordo_widget_rightbar',
    'label'        => 'SPESSORE BORDO BLOCCO BARRA DI DESTRA',
    'desc'         => '',
    'std'          => '1',
    'type'         => 'numeric-slider',
    'section'      => 'madisoft_scuola_sezione_grafica_less',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '1,5,1',
    'class'        => 'cssChange',
    'condition'    => 'madisoft_scuola_grafica_opzioni_avanzate:is(on),madisoft_scuola_grafica_bordi_rightbar:is(on),madisoft_scuola_grafica_rightbar:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_less',[
    'id'           => 'madisoft_scuola_grafica_leftbar',
    'label'        => 'MODIFICA BARRA DI SINISTRA',
    'desc'         => 'Se abilitata questa opzione permette modificare i colori dei blocchi della barra di sinistra',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'madisoft_scuola_sezione_grafica_less',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => 'cssChange',
    'condition'    => 'madisoft_scuola_grafica_opzioni_avanzate:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_less',[
    'id'           => 'madisoft_scuola_grafica_colore_sfondo_leftbar',
    'label'        => 'COLORE DI SFONDO BARRA DI SINISTRA',
    'desc'         => '',
    'std'          => '#ffffff',
    'type'         => 'colorpicker',
    'section'      => 'madisoft_scuola_sezione_grafica_less',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => 'cssChange',
    'condition'    => 'madisoft_scuola_grafica_opzioni_avanzate:is(on),madisoft_scuola_grafica_leftbar:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_less',[
    'id'           => 'madisoft_scuola_grafica_colore_widget_leftbar',
    'label'        => 'SFONDO TITOLI BLOCCHI DI SINISTRA',
    'desc'         => '',
    'std'          => '#424f78',
    'type'         => 'colorpicker',
    'section'      => 'madisoft_scuola_sezione_grafica_less',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => 'cssChange',
    'condition'    => 'madisoft_scuola_grafica_opzioni_avanzate:is(on),madisoft_scuola_grafica_leftbar:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_less',[
    'id'           => 'madisoft_scuola_grafica_colore_widget_leftbar_font',
    'label'        => 'CARATTERE TITOLI BLOCCHI DI SINISTRA',
    'desc'         => '',
    'std'          => '#F0F0F0',
    'type'         => 'colorpicker',
    'section'      => 'madisoft_scuola_sezione_grafica_less',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => 'cssChange',
    'condition'    => 'madisoft_scuola_grafica_opzioni_avanzate:is(on),madisoft_scuola_grafica_leftbar:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_less',[
    'id'           => 'madisoft_scuola_grafica_bordi_leftbar',
    'label'        => 'BORDO BLOCCHI DI SINISTRA',
    'desc'         => 'Se abilitata questa opzione permette di inserire un bordo ai blocchi della barra laterale',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'madisoft_scuola_sezione_grafica_less',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => 'cssChange',
    'condition'    => 'madisoft_scuola_grafica_opzioni_avanzate:is(on),madisoft_scuola_grafica_leftbar:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_less',[
    'id'           => 'madisoft_scuola_grafica_colore_bordo_widget_leftbar',
    'label'        => 'COLORE BORDO BLOCCO DI SINISTRA',
    'desc'         => '',
    'std'          => '#424f78',
    'type'         => 'colorpicker',
    'section'      => 'madisoft_scuola_sezione_grafica_less',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => 'cssChange',
    'condition'    => 'madisoft_scuola_grafica_opzioni_avanzate:is(on),madisoft_scuola_grafica_bordi_leftbar:is(on),madisoft_scuola_grafica_leftbar:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_less',[
    'id'           => 'madisoft_scuola_grafica_spessore_bordo_widget_leftbar',
    'label'        => 'SPESSORE BORDO BLOCCO BARRA DI SINISTRA',
    'desc'         => '',
    'std'          => '1',
    'type'         => 'numeric-slider',
    'section'      => 'madisoft_scuola_sezione_grafica_less',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '1,5,1',
    'class'        => 'cssChange',
    'condition'    => 'madisoft_scuola_grafica_opzioni_avanzate:is(on),madisoft_scuola_grafica_bordi_leftbar:is(on),madisoft_scuola_grafica_leftbar:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_less',[
    'id'           => 'madisoft_scuola_grafica_colore_sfondo_footer',
    'label'        => 'COLORE BARRA PIE\' DI PAGINA',
    'desc'         => '',
    'std'          => '#424f78',
    'type'         => 'colorpicker',
    'section'      => 'madisoft_scuola_sezione_grafica_less',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => 'cssChange',
    'condition'    => 'madisoft_scuola_grafica_opzioni_avanzate:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_less',[
    'id'           => 'madisoft_scuola_grafica_colore_font_footer',
    'label'        => 'COLORE CARATTERE PIE\' DI PAGINA',
    'desc'         => '',
    'std'          => '#f0f0f0',
    'type'         => 'colorpicker',
    'section'      => 'madisoft_scuola_sezione_grafica_less',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => 'cssChange',
    'condition'    => 'madisoft_scuola_grafica_opzioni_avanzate:is(on)',
    'operator'     => 'and'
]);
// CARATTERI
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_fonts',selectCarattereType(
    'madisoft_scuola_grafica_font_general',
    'CARATTERE DA USARE',
    'madisoft_scuola_grafica_fonts_opzioni_avanzate:is(off)'
) );
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_fonts',selectCarattereDimensione(
    'madisoft_scuola_grafica_font_general_dimensioni',
    'DIMENSIONI CARATTERE',
    '0.9',
    'madisoft_scuola_grafica_fonts_opzioni_avanzate:is(off)'
) );
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_fonts',[
    'id'           => 'madisoft_scuola_grafica_fonts_opzioni_avanzate',
    'label'        => 'GESTISCI OPZIONI AVANZATE CARATTERE',
    'desc'         => 'Se abilitata, questa opzione permette di gestire i caratteri delle singole parti del sito:
							i <em>men&ugrave;</em>, i <em>titoli</em>, gli <em>elenchi</em>...',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'madisoft_scuola_sezione_grafica_fonts',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => 'cssChange',
    'condition'    => '',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_fonts',selectCarattereType(
    'madisoft_scuola_grafica_font_menu_principale',
    'CARATTERE DA USARE PER IL MEN&Ugrave; PRINCIPALE',
    'madisoft_scuola_grafica_fonts_opzioni_avanzate:is(on)'
) );
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_fonts',selectCarattereDimensione(
    'madisoft_scuola_grafica_font_menu_principale_dimensioni',
    'DIMENSIONE CARATTERI MEN&Ugrave; PRINCIPALE',
    '1',
    'madisoft_scuola_grafica_fonts_opzioni_avanzate:is(on)'
) );
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_fonts',selectCarattereType(
    'madisoft_scuola_grafica_font_menu_top',
    'CARATTERE DA USARE PER IL MEN&Ugrave; TOP',
    'madisoft_scuola_grafica_fonts_opzioni_avanzate:is(on)'
) );
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_fonts',selectCarattereDimensione(
    'madisoft_scuola_grafica_font_menu_top_dimensioni',
    'DIMENSIONE CARATTERI MEN&Ugrave; TOP',
    '1',
    'madisoft_scuola_grafica_fonts_opzioni_avanzate:is(on)'
) );
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_fonts',selectCarattereType(
    'madisoft_scuola_grafica_font_menu_footer',
    'CARATTERE DA USARE PER IL MEN&Ugrave; IN BASSO',
    'madisoft_scuola_grafica_fonts_opzioni_avanzate:is(on)'
), 0, 'cssChange');
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_fonts',selectCarattereDimensione(
    'madisoft_scuola_grafica_font_menu_footer_dimensioni',
    'DIMENSIONI CARATTERE DA USARE PER IL MEN&Ugrave; IN BASSO',
    '1',
    'madisoft_scuola_grafica_fonts_opzioni_avanzate:is(on)'
), 0, 'cssChange' );
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_fonts',selectCarattereType(
    'madisoft_scuola_grafica_font_titoli',
    'CARATTERE DA USARE PER I TITOLI',
    'madisoft_scuola_grafica_fonts_opzioni_avanzate:is(on)'
), 0, 'cssChange' );
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_fonts',selectCarattereDimensione(
    'madisoft_scuola_grafica_font_titoli_dimensioni',
    'DIMENSIONE CARATTERI DA USARE PER I TITOLI',
    '1.3',
    'madisoft_scuola_grafica_fonts_opzioni_avanzate:is(on)'
), 0, 'cssChange' );
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_fonts',selectCarattereType(
    'madisoft_scuola_grafica_font_testo',
    'CARATTERE DA USARE PER IL TESTO',
    'madisoft_scuola_grafica_fonts_opzioni_avanzate:is(on)'
), 0, 'cssChange');
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_fonts',selectCarattereDimensione(
    'madisoft_scuola_grafica_font_testo_dimensioni',
    'DIMENSIONE CARATTERI PER IL TESTO',
    '0.9',
    'madisoft_scuola_grafica_fonts_opzioni_avanzate:is(on)'
), 0, 'cssChange' );
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_fonts',selectCarattereType(
    'madisoft_scuola_grafica_font_date',
    'CARATTERE DA USARE PER LE DATE DEGLI ARTICOLI',
    'madisoft_scuola_grafica_fonts_opzioni_avanzate:is(on)'
), 0, 'cssChange' );
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_fonts',selectCarattereDimensione(
    'madisoft_scuola_grafica_font_date_dimensioni',
    'DIMENSIONE CARATTERI DA USARE PER LE DATE DEGLI ARTICOLI',
    '1.2',
    'madisoft_scuola_grafica_fonts_opzioni_avanzate:is(on)'
), 0, 'cssChange' );
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_fonts',selectCarattereType( 'madisoft_scuola_grafica_font_elenchi', 'CARATTERE DA USARE NEI MEN&Ugrave;', 'madisoft_scuola_grafica_fonts_opzioni_avanzate:is(on)' ) , 0, 'cssChange');
$classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_grafica_fonts',selectCarattereDimensione( 'madisoft_scuola_grafica_font_elenchi_dimensioni', 'DIMENSIONI CARATTERI NEI MEN&Ugrave;', '0.9', 'madisoft_scuola_grafica_fonts_opzioni_avanzate:is(on)' ), 0, 'cssChange' );


madisoft_get_theme_class()->setImpostazioniClass($classeOpzioni);

function selectCarattereDimensione( $id, $titolo, $pred = 1, $dependencies = '' ) {
    $grandezzeCaratteri = [ ];
    $scelte             = [
        0.7,
        0.8,
        0.9,
        1,
        1.1,
        1.2,
        1.3,
        1.4,
        2.9
    ];
    foreach ( $scelte as $scelta ) {
        $grandezzeCaratteri[] = [
            'value' => $scelta,
            'src'   => '',
            'label' => $scelta,
        ];
    }

    return array(
        'id'           => $id,
        'label'        => $titolo,
        'desc'         => 'Grandezza dei caratteri',
        'std'          => 1,
        'type'         => 'select',
        'section'      => 'madisoft_scuola_sezione_grafica_fonts',
        'rows'         => '',
        'post_type'    => '',
        'taxonomy'     => '',
        'min_max_step' => '',
        'class'        => 'sceltaFont',
        'condition'    => $dependencies,
        'operator'     => 'and',
        'choices'      => $grandezzeCaratteri,
    );
}

function selectCarattereType( $id, $titolo, $dependencies = '' ){
    $caratteri          = [ ];
    $caratteriPossibili = [
        'Andale Mono',
        'Book Antiqua',
        'Comic Sans MS',
        'Courier New',
        'Georgia',
        'Helvetica',
        'Impact',
        'Symbol',
        'Terminal',
        'Trebuchet MS',
        'Webdings',
        'Wingdings',
        'EB Garamond',
	'Oxygen',
        'Lucida Grande, sans-serif',
        'Lucida Sans unicode',
        'Tahoma',
        'Verdana',
        'Lato, sans-serif',
        'Shadows Into Light, cursive',
        'Open Sans',
        'Libre Baskerville',
        'Titillium Web',
        'Lobster,cursive',
        'Josefin Slab, serif',
        'Gloria Hallelujah, cursive',
        'Arial',
        'Arial Black',
        'Times new roman',
        'Montserrat',
    ];
    sort( $caratteriPossibili );
    foreach ( $caratteriPossibili as $carattere ) {
        $caratteri[] = [
            'value' => $carattere,
            'src'   => '',
            'label' => $carattere,
        ];
    }
    return array(
        'id'           => $id,
        'label'        => $titolo,
        'desc'         => '<b>Testo descrittivo</b> a titolo esemplificativo, del testo con il '
                                .'<em>carattere selezionato</em>',
        'std'          => 'Titillium Web',
        'type'         => 'select',
        'section'      => 'madisoft_scuola_sezione_grafica_fonts',
        'rows'         => '',
        'post_type'    => '',
        'taxonomy'     => '',
        'min_max_step' => '',
        'class'        => 'sceltaFont',
        'condition'    => $dependencies,
        'operator'     => 'and',
        'choices'      => $caratteri,
    );
}
