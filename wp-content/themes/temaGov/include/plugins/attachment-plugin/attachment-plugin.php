<?php

class MadisoftScuolaAttachmentPlugin extends madisoftThemePluginClass implements madisoftThemePluginInterface
{

    function initFunction()
    {
        add_shortcode('attachments', array($this, 'inserisciLinkAgliAllegati'));
    }

	function inserisciLinkAgliAllegati($atts){
        global $post;
        if ( !possoVisualizzareQuestoContenuto($post->ID) ){
            return false;
        }
        $html = '';
        $include = '';
		extract( shortcode_atts( array(
			'include'      => '',
		), $atts ) );


        // se non è presente il link non mostro nulla
		if (!($include)){
			return '';
		}
		if ($include){
			$allegati = explode(',', $include);
		}
        foreach ( $allegati as $allegato) {
		    $datiAllegato = get_post($allegato);
		 $html .= '<div class="allegato">
            <a target="_blank" href="' . wp_get_attachment_url($allegato) .'">' . $datiAllegato->post_title . '</a>
                </div>' ."\n";
		 unset($datiAllegato);
		}

		return $html;
	}



}

$madisoftScuolaAttachementPlugin = new MadisoftScuolaAttachmentPlugin();

