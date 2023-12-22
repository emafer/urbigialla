<?php

class MadisoftScuolaFramePlugin extends madisoftThemePluginClass implements madisoftThemePluginInterface
{

    function initFunction()
    {
        add_shortcode('frame', array($this, 'insertFrame'));
    }


	function insertFrame($atts){

        global $post;
        if ( !possoVisualizzareQuestoContenuto() ){
            return false;
        }
		$html = '';
		$titolo = '';
		$src = '';
		$border = '';
		$height = '';
		$width = '';
        $style = '';
		$allowfullscreen = '';
		$alt = '';
		extract( shortcode_atts( array(
			'src'      => '',
			'titolo'    => '',
			'alt'       => 'Clicca qui per problemi di visualizzazione',
			'height'    => '900',
			'width'     => '100%',
			'border'    => 'none',
			'allowfullscreen' => 'allowfullscreen'
		), $atts ) );

		// se non è presente il link non mostro nulla
		if (!($src)){
			return '<!-- non è stato inserito il link -->';
		}
		if ($titolo){
			$html .='<span class="titoloFrame">' . $titolo .'</span>';
		}
		$html .= '<iframe border="' . $border . '" width="' . $width . '" height="' . $height . '" src="' . $src . '"  allowfullscreen="allowfullscreen"><a href="' . $src .'">' . $alt . '</a></iframe>';

		return $html;
	}



}

$madisoftScuolaFramePlugin = new MadisoftScuolaFramePlugin();