<?php

class MadisoftScuolaRssReaderPlugin extends madisoftThemePluginClass implements madisoftThemePluginInterface
{

    function initFunction()
    {
        add_shortcode('rssReader', array($this, 'leggiFeedRss'));
    }


    function leggiFeedRss($atts){

        global $post;
        if ( !possoVisualizzareQuestoContenuto()){
            return false;
        }

        $src = '';

        extract( shortcode_atts( array(
            'src'    => 'Area riservata',
        ), $atts ) );


        if (!($src)){
            return '<!-- non è stato inserito il link -->';
        }

        foreach ($this->get_post_from_rss($src) as $bachecapost) {

        }
    }
}

$madisoftScuolaRssReaderPlugin = new MadisoftScuolaRssReaderPlugin();