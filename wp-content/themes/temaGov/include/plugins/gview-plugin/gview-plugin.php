<?php

class MadisoftScuolaGviewPlugin extends madisoftThemePluginClass implements madisoftThemePluginInterface
{

    function initFunction()
    {
        add_shortcode('gview', array($this, 'insertGview'));
    }


	function insertGview($atts){

        global $post;
        if ( !possoVisualizzareQuestoContenuto() ){
            return false;
        }
		$html = '';
		$titolo = '';
		$file = '';
		$border = '';
		$height = '';
		$width = '';
        $style = '';
		$allowfullscreen = '';
		$alt = '';
		extract( shortcode_atts( array(
			'file'      => '',
			'titolo'    => '',
			'alt'       => 'Clicca qui per problemi di visualizzazione',
			'height'    => '900',
			'width'     => '100%',
			'border'    => 'none',
			'allowfullscreen' => 'allowfullscreen'
		), $atts ) );

		// se non è presente il link non mostro nulla
		if (!($file)){
			return '<!-- non è stato inserito il link -->';
		}
		if ($titolo){
			$html .='<span class="titoloFrame">' . $titolo .'</span>';
		}
		$html .= '<iframe border="' . $border . '" width="' . $width . '" height="' . $height . '" src="' . $file . '"  allowfullscreen="allowfullscreen"><a href="' . $file .'">' . $alt . '</a></iframe>';

		return $html;
	}
}

$MadisoftScuolaGviewPlugin = new MadisoftScuolaGviewPlugin();