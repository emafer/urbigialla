<?php

class madisoftThemePluginDashboardSupport extends madisoftThemePluginClass implements madisoftThemePluginInterface
{

    function initFunction()
    {
        add_action('wp_dashboard_setup', [$this, 'remove_dashboard_widgets']);
        add_action('wp_dashboard_setup', [$this, 'prepara_widget_dashboard']);

    }

    function remove_dashboard_widgets()
    {
        global $wp_meta_boxes;
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
    }


    /**
     * Create the function to output the contents of our Dashboard Widget.
     */
    function madisoft_dashboard_widget_principale()
    {
// https://supporto.madisoft.it/rss/index.php?/Knowledgebase/Feed/Index/217
        // Display whatever it is you want to show.
        echo "<b>Resta sempre Aggiornato</b><br/> " .
            "In questa pagina avrai a disposizione tutte le ultime  novit&agrave; del sito Web:<br/>
	        Ognuno dei box che troverai qui, infatti, rappresenta uno degli aggiornamenti rilasciati per il sito web";

    }

    function prepara_widget_dashboard()
    {
        wp_add_dashboard_widget(
            'prepara_widget_dashboard',
            'Le Novit&agrave; del sito web',
            [$this, 'madisoft_dashboard_widget_principale']
        );
        $array = $this->get_post_from_rss('https://supporto.madisoft.it/rss/index.php?/News/Feed/Index/2', 5);
        $i = 1;
        foreach ($array as $news) {
            wp_add_dashboard_widget(
                'News_widget_' . $i,
                $news['title'],
                [$this, 'crea_news_widget'],
                '',
                $news
            );
            $i++;
        }
    }



    function crea_news_widget()
    {
        $args = func_get_args();
        echo $args[1]['args']['content'];
    }
}


$madisoftThemePluginDashboardSupport = new madisoftThemePluginDashboardSupport();