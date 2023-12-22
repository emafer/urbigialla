<?php
/**
 * Initialize the custom theme options.
 */
add_action( 'admin_init', 'custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
    global $madisoftTheme;
    /**
     * Get a copy of the saved settings array.
     */
    $saved_settings = get_option( 'option_tree_settings', array() );
    /**
     * Custom settings array that will eventually be
     * passes to the OptionTree Settings API Class.
     */

    $classeOpzioni = madisoft_get_theme_class()->getImpostazioniClass();
    $classeOpzioni->aggiungiSezione(16, 'madisoft_scuola_sezione_codice_custom', 'CODICE PERSONALIZZATO' );
//                GRAFICA

//        CUSTOM CODE
    $classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_codice_custom',[
        'id'           => 'madisoft_scuola_codice_custom_js',
        'label'        => 'CODICE JAVASCRIPT',
        'desc'         => '',
        'std'          => '',
        'type'         => 'textarea-simple',
        'section'      => 'madisoft_scuola_sezione_codice_custom',
        'rows'         => '',
        'post_type'    => '',
        'taxonomy'     => '',
        'min_max_step' => '',
        'class'        => '',
        'condition'    => '',
        'operator'     => 'and'
    ]);
    $classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_codice_custom',[
        'id'           => 'madisoft_scuola_codice_custom_css',
        'label'        => 'CODICE CSS',
        'desc'         => '',
        'std'          => '',
        'type'         => 'css',
        'section'      => 'madisoft_scuola_sezione_codice_custom',
        'rows'         => '',
        'post_type'    => '',
        'taxonomy'     => '',
        'min_max_step' => '',
        'class'        => '',
        'condition'    => '',
        'operator'     => 'and'
    ]);
    $classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_codice_custom',[
        'id'           => 'madisoft_scuola_codice_custom_head',
        'label'        => 'CODICE METADATI',
        'desc'         => '',
        'std'          => '',
        'type'         => 'textarea-simple',
        'section'      => 'madisoft_scuola_sezione_codice_custom',
        'rows'         => '',
        'post_type'    => '',
        'taxonomy'     => '',
        'min_max_step' => '',
        'class'        => '',
        'condition'    => '',
        'operator'     => 'and'
    ]);

    $classeOpzioni->aggiungiImpostazione('madisoft_scuola_sezione_codice_custom',[
        'id'           => 'madisoft_scuola_aggiornaCss',
        'label'        => 'AggiornaCss',
        'desc'         => '',
        'std'          => '1',
        'type'         => 'text',
        'section'      => 'madisoft_scuola_sezione_codice_custom',
        'rows'         => '',
        'post_type'    => '',
        'taxonomy'     => '',
        'min_max_step' => '',
        'class'        => 'aggiornaCssCommand',
        'condition'    => '',
        'operator'     => 'and',
        'choices'      => [
            [
                'value' => '1',
                'label' => 'NO',
            ],
            [
                'value' => '2',
                'label' => 'SI',
            ],
        ]

    ]);

    $custom_settings = madisoft_get_theme_class()->getImpostazioniClass()->generaThemeOptions();

    /* allow settings to be filtered before saving */
    $custom_settings = apply_filters( 'option_tree_settings_args', $custom_settings );

    /* settings are not the same update the DB */
    if ( $saved_settings !== $custom_settings ) {
        update_option( 'option_tree_settings', $custom_settings );
    }

}
