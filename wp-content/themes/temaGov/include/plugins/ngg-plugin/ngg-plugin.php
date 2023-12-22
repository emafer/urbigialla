<?php

class MadisoftScuolaNggPlugin extends madisoftThemePluginClass implements madisoftThemePluginInterface
{

    function initFunction()
    {
        add_shortcode('ngg', array($this, 'ngg_show'));
		add_shortcode('ngg_images', array($this, 'ngg_images_show'));
    }


	function ngg_show($atts){

        global $wpdb, $table_prefix;
		$html = '';
		$source = $atts['src'];
		if ($source  == 'galleries') {
			$gallery_id = $atts['ids'];
		} else {
			return '';
		}
		//1 gallery path
		$sql = 'SELECT * from ' . $table_prefix  . 'ngg_gallery WHERE gid="' . $gallery_id .'";';
		$resultG = $wpdb->get_results($sql);
		if (!$resultG) {
			return $html;
		}
		$path =  $resultG[0]->path;
		$sql = 'SELECT * FROM ' . $table_prefix  . 'ngg_pictures WHERE galleryid="' . $gallery_id .'";';
		$result = $wpdb->get_results($sql);
		if (!$result) {
			return $html;
		}
		$idGallery = "gallery-" . $resultG[0]->slug;
		$buttons = '';
		$imgs = '';
		$counter = 0;
		foreach ($result as $img) {
			$buttons .= '<li data-target="#' . $idGallery . '" data-slide-to="'. $counter . '"';
      if (!$counter){$buttons .= ' class="active"';}
      $buttons .= '></li>';
	if (!$counter) {
		$class =' active';
	} else {
		$class = '';
	}
	$imgs .= '<div class="carousel-item' . $class . '">
      <img
        src="' . $path . $img->filename .'"
        class="d-block w-100"
        alt="'. $img->alttext. '"
      />
      <!--<div class="carousel-caption d-none d-md-block">
        <h5>'. $img->alttext. '</h5>
      </div> -->
    </div>';
	$counter++;
		}
		
		$html .= '<div
  id="' . $idGallery . '"
  style="width: 500px;
    margin-left: auto;
    margin-right: auto;"
  class="carousel slide carousel-fade"
  data-mdb-ride="carousel"
>
  <!-- Indicators -->
  <ol class="carousel-indicators">
      ' . $buttons .'
  </ol>

  <!-- Inner -->
  <div class="carousel-inner">
		' . $imgs .'
  </div>
  <!-- Inner -->

  <!-- Controls -->
  <a class="carousel-control-prev" href="#' . $idGallery . '" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#' . $idGallery . '" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<!-- Carousel wrapper -->
		<script>jQuery(document).ready(function(jQuery){
		jQuery(\'#' . $idGallery . '\').carousel();
		})</script>';
		
		return $html;
	}

	function ngg_images_show($atts)
	{
		global $wpdb, $table_prefix;
		$source = $atts['source'];
		$html = '';
		if ($source  == 'galleries') {
			$gallery_id = $atts['container_ids'];
		} else {
			return '';
		}
		//1 gallery path
		$sql = 'SELECT * from ' . $table_prefix  . 'ngg_gallery WHERE gid="' . $gallery_id .'";';
		
		$resultG = $wpdb->get_results($sql);
		if (!$resultG) {
			return "1". $html;
		}
		$path =  $resultG[0]->path;
		if (substr($path, -1) != DIRECTORY_SEPARATOR) {
			$path .= DIRECTORY_SEPARATOR;
		}
		$sql = 'SELECT * FROM ' . $table_prefix  . 'ngg_pictures WHERE galleryid="' . $gallery_id .'";';
		$result = $wpdb->get_results($sql);
		if (!$result) {
			return "2 " .$html;
		}
		$idGallery = "gallery-" . $resultG[0]->slug;
		$buttons = '';
		$imgs = '';
		$counter = 0;
		foreach ($result as $img) {
			$buttons .= '<li data-target="#' . $idGallery . '" data-slide-to="'. $counter . '"';
      if (!$counter){$buttons .= ' class="active"';}
      $buttons .= '></li>';
	if (!$counter) {
		$class =' active';
	} else {
		$class = '';
	}
	$imgs .= '<div class="carousel-item' . $class . '">
      <img
        src="' . $path . $img->filename .'"
        class="d-block w-100"
        alt="'. $img->alttext. '"
      />
      <!--<div class="carousel-caption d-none d-md-block">
        <h5>'. $img->alttext. '</h5>
      </div> -->
    </div>';
	$counter++;
		}
		if (!isset($atts['gallery_width'])) {
			$width ="500px";
		} else {
			$width = $atts['gallery_width'] . "px";
		}
		if (!isset($atts['gallery_height'])) {
			$height ="";
		} else {
			$height = ""; //"height: " .$atts['gallery_height'] . "px;";
		}
		$html .= '<div id="' . $idGallery . '"   style="width: 500px; ' . $height . ' margin-left: auto;   margin-right: auto;"  class="carousel slide carousel-fade"   data-mdb-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
      ' . $buttons .'
  </ol>

  <!-- Inner -->
  <div class="carousel-inner">
		' . $imgs .'
  </div>
  <!-- Inner -->

  <!-- Controls -->
  <a class="carousel-control-prev" href="#' . $idGallery . '" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#' . $idGallery . '" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<!-- Carousel wrapper -->
		<script>jQuery(document).ready(function(jQuery){
		jQuery(\'#' . $idGallery . '\').carousel();
		})</script>';
		
		return $html;
	}



}
if(!is_plugin_active('nextgen-gallery/nggallery.php')) {
	$madisoftScuolaNggPlugin = new MadisoftScuolaNggPlugin();
}