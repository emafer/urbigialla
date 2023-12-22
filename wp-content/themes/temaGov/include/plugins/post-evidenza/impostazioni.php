<?php
$classeOpzioni = madisoft_get_theme_class()->getImpostazioniClass();
$classeOpzioni->aggiungiSezione('13', 'evidenza', 'EVIDENZA');

$opzione = new ModelloThemeOptionOnOff('evidenza','off');
$opzione
    ->setId('madisoft_scuola_usa_post_in_evidenza')
    ->setDesc('Se impostato a Si, prima degli articoli, in home page, sar&agrave; creata una sezione "in evidenza"')
    ->setLabel('Usare i post in evidenza?')
    ->setOperator('and');
$classeOpzioni->aggiungiImpostazione('evidenza',  $opzione->getOpzioneCompleta());
$classeOpzioni->aggiungiImpostazione('evidenza',[
    'id'           => 'madisoft_scuola_post_in_evidenza_titolo_mostra',
    'label'        => 'MOSTRARE UN TITOLO PER GLI ARTICOLI IN EVIDENZA',
    'desc'         => '',
    'std'          => 'on',
    'type'         => 'on-off',
    'section'      => 'evidenza',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_usa_post_in_evidenza:is(on)',
    'operator'     => 'and',
]);
$classeOpzioni->aggiungiImpostazione('evidenza',[
    'id'           => 'madisoft_scuola_post_in_evidenza_titolo',
    'label'        => 'TITOLO',
    'desc'         => 'Se abilitata l\'opzione precedente, il testo sar&agrave; aggiunto 
    al titolo della categoria',
    'std'          => 'In evidenza',
    'type'         => 'text',
    'section'      => 'evidenza',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_post_in_evidenza_titolo_mostra:is(on),madisoft_scuola_usa_post_in_evidenza:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('evidenza',[
    'id'           => 'madisoft_scuola_post_in_evidenza_numero_articoli',
    'label'        => 'NUMERO ARTICOLI DA MOSTRARE',
    'desc'         => 'NB: Gli articoli in evidenza oltre al numero impostato non saranno mostrati',
    'std'          => '5',
    'type'         => 'numeric-slider',
    'section'      => 'evidenza',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '1,20,1',
    'class'        => '',
    'condition'    => 'madisoft_scuola_usa_post_in_evidenza:is(on)',
    'operator'     => 'and'
]);
$classeOpzioni->aggiungiImpostazione('evidenza',[
    'id'           => 'madisoft_scuola_posti_in_evidenza_immagine',
    'label'        => 'IMMAGINE DA MOSTRARE SOPRA GLI ARTICOLI',
    'desc'         => '&Egrave; possibile, con questa opzione, inserire un\'immagine sopra al primo titolo. 
    L\'immagine non sar&agrave; ridimensionata, a meno che non sia pi&ugrave; larga della dimenisione della pagina:
    in quel caso verr&agrave; automaticamente ridimensionata alla massima larghezza possibile',
    'std'          => '',
    'type'         => 'upload',
    'section'      => 'evidenza',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => 'madisoft_scuola_usa_post_in_evidenza:is(on)',
    'operator'     => 'and'
]);

madisoft_get_theme_class()->setImpostazioniClass($classeOpzioni);