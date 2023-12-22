<?php

$classe = madisoft_get_theme_class()->getImpostazioniClass();
$classe->aggiungiSezione('8', 'accessibilita', 'ACCESSIBILIT&Agrave;');
$opzioneUsaBarraAccessibilita = new ModelloThemeOption();
$opzioneUsaBarraAccessibilita
    ->setId('madisoft_scuola_usa_barra_di_accessibilita')
    ->setType('on-off')
    ->setStd('on')
    ->setSection('accessibilita')
    ->setDesc('')
    ->setLabel('Usare la barra di accessibilit&agrave;?')
    ->setOperator('and');
$classe->aggiungiImpostazione('accessibilita', $opzioneUsaBarraAccessibilita->getOpzioneCompleta());
$opzioneUsaAccessKey = new ModelloThemeOptionOnOff('accessibilita', 'off');
$opzioneUsaAccessKey
    ->setId('madisoft_scuola_usa_accesskey')
    ->setDesc('')
    ->setLabel('Usare le accesskey per permettere una navigazione con la tastiera (potrebbe rallentare il salvataggio delle pagine)?')
    ->setOperator('and')
    ->setCondition('madisoft_scuola_usa_barra_di_accessibilita:is(on)');
$classe->aggiungiImpostazione('accessibilita',  $opzioneUsaAccessKey->getOpzioneCompleta());

$classe->aggiungiImpostazione('accessibilita', [
    'id'           => 'madisoft_scuola_segnala_link_esterni',
    'label'        => 'Mostrare un immagine per indicare che il link &egrave; esterno al sito',
    'desc'         => '',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'accessibilita',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);
$classe->aggiungiImpostazione('accessibilita', [
    'id'           => 'madisoft_scuola_link_dichiarazione_agid',
    'label'        => 'Inserire il link generato dall\'AGID per la dichiarazione di Accessibilit&agrave;',
    'desc'         => '',
    'std'          => '',
    'type'         => 'text',
    'section'      => 'accessibilita',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);

madisoft_get_theme_class()->setImpostazioniClass($classe);