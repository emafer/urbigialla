<?php
$classeOpzioni = madisoft_get_theme_class()->getImpostazioniClass();
$idSezione = 'madisoft_scuola_scuole_dati';
//USO SCUOLE
$classeOpzioni->aggiungiSezione('13', $idSezione, 'DATI SCUOLE');
$opzioneUsoDatiScuole = new ModelloThemeOption();
$opzioneUsoDatiScuole
    ->setId('madisoft_scuola_scuole_uso')
    ->setType('on-off')
    ->setStd('on')
    ->setSection($idSezione)
    ->setDesc('')
    ->setLabel('Utilizzare la creazione delle scuole predefinita?')
    ->setOperator('and');
$classeOpzioni->aggiungiImpostazione($idSezione,  $opzioneUsoDatiScuole->getOpzioneCompleta());

//USO SERVIZI
$opzioneUsoServizi = new ModelloThemeOptionOnOff($idSezione);
$opzioneUsoServizi
    ->setId('madisoft_scuola_visualizza_servizi')
    ->setDesc('Se impostato a ON visualizzerete i servizi nella gestione delle scuole')
    ->setLabel('Visualizza servizi')
    ->setOperator('and')
    ->setCondition('madisoft_scuola_scuole_uso:is(on)');
$classeOpzioni->aggiungiImpostazione($idSezione,  $opzioneUsoServizi->getOpzioneCompleta());

//VISUALIZZA ORARI
$opzioneUsoOrari = new ModelloThemeOption();
$opzioneUsoOrari
    ->setId('madisoft_scuola_visualizza_orari')
    ->setType('on-off')
    ->setStd('on')
    ->setSection($idSezione)
    ->setDesc('Se impostato a ON visualizzerete gli orari nella gestione delle scuole')
    ->setLabel('Visualizza Orari')
    ->setOperator('and')
    ->setCondition('madisoft_scuola_scuole_uso:is(on)');
$classeOpzioni->aggiungiImpostazione($idSezione,  $opzioneUsoOrari->getOpzioneCompleta());

//VISUALIZZA STRUTTURE
$opzioneUsoStrutture = new ModelloThemeOption();
$opzioneUsoStrutture
    ->setId('madisoft_scuola_visualizza_Strutture')
    ->setType('on-off')
    ->setStd('on')
    ->setSection($idSezione)
    ->setDesc('Se impostato a ON visualizzerete le strutture nella gestione delle scuole')
    ->setLabel('Visualizza Strutture')
    ->setOperator('and')
    ->setCondition('madisoft_scuola_scuole_uso:is(on)');
$classeOpzioni->aggiungiImpostazione($idSezione,  $opzioneUsoStrutture->getOpzioneCompleta());


//VISUALIZZA NOTE
$opzioneUsoNote = new ModelloThemeOption();
$opzioneUsoNote
    ->setId('madisoft_scuola_visualizza_note')
    ->setType('on-off')
    ->setStd('on')
    ->setSection($idSezione)
    ->setDesc('Se impostato a ON visualizzerete le note nella gestione delle scuole')
    ->setLabel('Visualizza note')
    ->setOperator('and')
    ->setCondition('madisoft_scuola_scuole_uso:is(on)');
$classeOpzioni->aggiungiImpostazione($idSezione,  $opzioneUsoNote->getOpzioneCompleta());

$visualizzaMappe = [
                'id'      => 'madisoft_scuola_visualizza_mappa',
                'label'   => 'Visualizza mappe',
                'desc'    => 'Se impostato a ON visualizzerete le strutture nella gestione delle scuole',
                'std'     => 'on',
                'type'    => 'on-off',
                'section' => 'madisoft_scuola_scuole_dati',
                'rows'         => '',
                'post_type'    => '',
                'taxonomy'     => '',
                'min_max_step' => '',
                'class'        => '',
                'condition'    => 'madisoft_scuola_scuole_uso:is(on)',
                'operator'     => 'and'
            ];
$classeOpzioni->aggiungiImpostazione($idSezione,  $visualizzaMappe);

$mostrareIlLinkGeneraleNelWidget = [
                'id'      => 'madisoft_scuola_scuole_widget_generale',
                'label'   => 'Visualizza Link iniziale nel men&ugrave;',
                'desc'    => 'Se impostato a OFF nel box laterale non si vedr&agraveM il link alla pagina generale delle scuole',
                'std'     => 'on',
                'type'    => 'on-off',
                'section' => 'madisoft_scuola_scuole_dati',
                'rows'         => '',
                'post_type'    => '',
                'taxonomy'     => '',
                'min_max_step' => '',
                'class'        => '',
                'condition'    => 'madisoft_scuola_scuole_uso:is(on)',
                'operator'     => 'and'
            ];
$mostrareITitoliNelWidget = [
                'id'      => 'madisoft_scuola_scuole_widget_titoli',
                'label'   => 'Mostra l\'ordine delle scuole nel box laterale',
                'desc'    => 'Se impostato a ON visualizzerete le scuole separate per ordine di scuola (tipologia)',
                'std'     => 'on',
                'type'    => 'on-off',
                'section' => 'madisoft_scuola_scuole_dati',
                'rows'         => '',
                'post_type'    => '',
                'taxonomy'     => '',
                'min_max_step' => '',
                'class'        => '',
                'condition'    => 'madisoft_scuola_scuole_uso:is(on)',
                'operator'     => 'and'
            ];

$classeOpzioni->aggiungiImpostazione($idSezione,  $mostrareIlLinkGeneraleNelWidget);
$classeOpzioni->aggiungiImpostazione($idSezione,  $mostrareITitoliNelWidget);

$posizioneContenuto = new ModelloThemeOptionText($idSezione, 1);
$posizioneContenuto
    ->setId('madisoft_scuola_scuole_ordine_contenuto')
    ->setLabel('Ordine della pagina scuole: contenuto')
    ->setCondition('madisoft_scuola_scuole_uso:is(on)');

    $posizioneOrari = new ModelloThemeOptionText($idSezione, 2);
    $posizioneOrari
        ->setId('madisoft_scuola_scuole_ordine_orari')
        ->setLabel('Ordine della pagina scuole: orari')
        ->setCondition('madisoft_scuola_scuole_uso:is(on), madisoft_scuola_visualizza_orari:is(on)');

$posizioneStrutture = new ModelloThemeOptionText($idSezione, 3);
$posizioneStrutture
    ->setId('madisoft_scuola_scuole_ordine_strutture')
    ->setLabel('Ordine della pagina scuole: strutture')
    ->setCondition('madisoft_scuola_scuole_uso:is(on), madisoft_scuola_visualizza_Strutture:is(on)');

$posizioneNote = new ModelloThemeOptionText($idSezione, 4);
$posizioneNote
    ->setId('madisoft_scuola_scuole_ordine_note')
    ->setLabel('Ordine della pagina scuole: note')
    ->setCondition('madisoft_scuola_scuole_uso:is(on), madisoft_scuola_visualizza_note:is(on)');

$posizioneServizi = new ModelloThemeOptionText($idSezione, 5);
$posizioneServizi
    ->setId('madisoft_scuola_scuole_ordine_servizi')
    ->setLabel('Ordine della pagina scuole: servizi')
    ->setCondition('madisoft_scuola_scuole_uso:is(on), madisoft_scuola_visualizza_servizi:is(on)');

$posizioneMappe = new ModelloThemeOptionText($idSezione, 6);
$posizioneMappe
    ->setId('madisoft_scuola_scuole_ordine_mappe')
    ->setLabel('Ordine della pagina scuole: mappe')
    ->setCondition('madisoft_scuola_scuole_uso:is(on), madisoft_scuola_visualizza_mappa:is(on)');

$classeOpzioni->aggiungiImpostazione($idSezione,$posizioneContenuto->getOpzioneCompleta());
$classeOpzioni->aggiungiImpostazione($idSezione,$posizioneOrari->getOpzioneCompleta());
$classeOpzioni->aggiungiImpostazione($idSezione,$posizioneStrutture->getOpzioneCompleta());
$classeOpzioni->aggiungiImpostazione($idSezione,$posizioneNote->getOpzioneCompleta());
$classeOpzioni->aggiungiImpostazione($idSezione,$posizioneServizi->getOpzioneCompleta());
$classeOpzioni->aggiungiImpostazione($idSezione,$posizioneMappe->getOpzioneCompleta());

madisoft_get_theme_class()->setImpostazioniClass($classeOpzioni);