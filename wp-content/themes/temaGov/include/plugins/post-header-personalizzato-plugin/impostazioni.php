<?php
$classeOpzioni = madisoft_get_theme_class()->getImpostazioniClass();

$classeOpzioni->aggiungiImpostazione('general',  [
    'id'           => 'madisoft_scuola_usa_intestazione_personalizata',
    'label'        => 'Abilitare le immagini personalizzate nell\'intestazione',
    'desc'         => 'Abilitando questa opzione sar&agrave; possibile personalizzare l\'immagine usata nell\'intestazione della pagina (se impostata)',
    'std'          => 'off',
    'type'         => 'on-off',
    'section'      => 'general',
    'rows'         => '',
    'post_type'    => '',
    'taxonomy'     => '',
    'min_max_step' => '',
    'class'        => '',
    'condition'    => '',
    'operator'     => 'and'
]);

madisoft_get_theme_class()->setImpostazioniClass($classeOpzioni);