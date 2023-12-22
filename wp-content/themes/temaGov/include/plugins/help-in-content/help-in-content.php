<?php

class MadisoftThemePluginHelpInLine extends madisoftThemePluginClass implements madisoftThemePluginInterface {

    protected $links = [
        'page' => 'https://supporto.madisoft.it/rss/index.php?/Knowledgebase/Feed/Index/327',
        'avcp' => 'https://supporto.madisoft.it/rss/index.php?/Knowledgebase/Feed/Index/38',
        'post' => 'https://supporto.madisoft.it/rss/index.php?/Knowledgebase/Feed/Index/326',
        'event' => 'https://supporto.madisoft.it/rss/index.php?/Knowledgebase/Feed/Index/223',
        'event-recurring' => 'https://supporto.madisoft.it/rss/index.php?/Knowledgebase/Feed/Index/223',
        'amm-trasparente' => 'https://supporto.madisoft.it/rss/index.php?/Knowledgebase/Feed/Index/37',
        'widgets.php' => 'https://supporto.madisoft.it/rss/index.php?/Knowledgebase/Feed/Index/329',
        'nav-menus.php' => 'https://supporto.madisoft.it/rss/index.php?/Knowledgebase/Feed/Index/328',
        'ot-theme-options' => 'https://supporto.madisoft.it/rss/index.php?/Knowledgebase/Feed/Index/225',
//        'scuola-modulistica' => 'http://google.it',
//        'scuola-circolare' => 'http://google.it',
//        'scuola_service' => 'http://google.it',

    ];
    protected $temporaryLink = [];

    protected $counterID = 0;


    function initFunction()
    {
//        add_action('add_meta_boxes', [$this, 'add_help_meta_box']);
        global $pagenow;
        if (!is_admin()) {
            return false;
        }
            $array = [];
            switch ($pagenow){
                case 'post.php':
                    $edit_post_type = isset($_GET['post'])? get_post_type($_GET['post']): '';
                    if ($edit_post_type && isset($this->links[$edit_post_type])){
                        $this->temporaryLink =  $this->get_post_from_rss($this->links[$edit_post_type]);
                    }
                    break;
                case 'post-new.php':
                case 'edit.php':
                    $post_type = isset($_GET['post_type'])? $_GET['post_type']: 'post';
                    if (isset($this->links[$post_type])){
                        $this->temporaryLink =  $this->get_post_from_rss($this->links[$post_type]);
                    }
                    break;
                case 'themes.php':
                    if (isset($_GET['page']) =='ot-theme-options' ){
                        $this->temporaryLink =  $this->get_post_from_rss($this->links['ot-theme-options']);
                    }
                    break;
            default:
                if (isset( $this->links[$pagenow])){
                    $this->temporaryLink =  $this->get_post_from_rss($this->links[$pagenow]);
                }
                break;
            }
        add_action('admin_bar_menu', [$this, 'add_admin_bar'], 999);
        if (count($this->temporaryLink)){
                add_action('admin_bar_menu', [$this, 'add_help_in_admin_bar'], 999);
            }
        add_action('admin_bar_menu', [$this, 'madisoft_scuola_aggiunta_link_supporto_admin_bar'], 999);

    }


    /**
     * @param WP_Admin_Bar $wp_admin_bar
     */
    function add_admin_bar( WP_Admin_Bar $wp_admin_bar ) {
        $args = array(
            'id'    => 'helpInLine',
            'title' =>  __('<img src="'. madisoft_scuola_get_assets_directory('img') . 'nuv.png" style="max-height: 50%; vertical-align:middle;margin-right:5px" alt="Help" title="Help" />GUIDE','madisoft_scuola' ),
            'href' => '#',
            'meta'  => array(
                'target' => 'blank' )
        );
        $wp_admin_bar->add_node( $args );
    }

    /**
     * @param WP_Admin_Bar $wp_admin_bar
     */
    function add_help_in_admin_bar( WP_Admin_Bar $wp_admin_bar) {
        foreach ($this->temporaryLink as $guida) {
                $args = array(
                    'id' => 'helpInLine-link' . $this->counterID,
                    'title' => __($guida['title'], 'madisoft_scuola'),
                    'href' => $guida['link'],
                    'parent' => 'helpInLine',
                    'meta' => array(
                        'class' => 'thickbox',
                        'target' => 'blank')
                );
                $wp_admin_bar->add_node($args);
            $this->counterID++;
            }

    }

    /**
     * @param WP_Admin_Bar $wp_admin_bar
     */
    function madisoft_scuola_aggiunta_link_supporto_admin_bar( WP_Admin_Bar $wp_admin_bar ) {
        $args = array(
            'id'     => 'madisoft_support', // id of the existing child node (New > Post)
            'title'  => 'Supporto: guide e video', // alter the title of existing node
            'href'   => 'https://supporto.madisoft.it/portal/kb/siti-web',
            'parent' => 'helpInLine',
            'meta'   => array(
                'target' => 'blank' )
        );
        $args2 = array(
            'id'     => 'madisoft_telesupport', // id of the existing child node (New > Post)
            'title'  => 'Teleassistenza', // alter the title of existing node
            'href'   => 'https://supporto.madisoft.it/portal/kb/articles/so',
            'parent' => 'helpInLine',
            'meta'   => array(
                'target' => 'blank' )
        );
        $wp_admin_bar->add_node( $args );
        $wp_admin_bar->add_node( $args2 );
    }



}

$MadisoftThemePluginHelpInLine = new MadisoftThemePluginHelpInLine();
