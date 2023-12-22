<?php

class madisoftThemePluginTextReader extends madisoftThemePluginClass implements madisoftThemePluginInterface
{
    function initFunction()
    {
        if (madisoft_get_theme_option('madisoft_scuola_attivaLetturaVocale', 'off') == 'on') {
            add_filter('the_content', [$this, 'letturaVocale'], 0);
            add_action('wp_enqueue_scripts', [$this, 'addScriptAndStyleResponsiveVoice']);
        }

    }

    function addScriptAndStyleResponsiveVoice()
    {
        wp_register_style('text-reader-style', madisoft_scuola_get_assets_directory('plugins') . 'text-reader/assets/text-reader.css');
        wp_enqueue_script('text-reader', madisoft_scuola_get_assets_directory('plugins') . 'text-reader/assets/text-reader.js', array('jquery', 'responsivevoice'), "1.0", true);
        wp_enqueue_style('text-reader-style');
        wp_enqueue_script('responsivevoice', 'https://code.responsivevoice.org/responsivevoice.js', array('jquery'), "1.0", true);

    }

    function letturaVocale($content)
    {
        if (!is_single() || !possoVisualizzareQuestoContenuto()) {
            return $content;
        }
        $content = '<div id="testoDaLeggere">' . $content . '</div>
<div style="alignright"><button id="play"/><button id="pause"></div>';

        return $content;
    }
}

if (letturaVocaleEAttiva()){
    $madisoftThemePluginTextReader = new madisoftThemePluginTextReader();
}

function letturaVocaleEAttiva(){
    return madisoft_get_theme_option('madisoft_scuola_attivaLetturaVocale', 'off') == 'on';
}
