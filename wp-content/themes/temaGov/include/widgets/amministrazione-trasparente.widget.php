<?php

class Amministrazione_Trasparente_Widget extends WP_Widget {

	public function __construct() {
		// Instantiate the parent object
		parent::__construct( false, 'COLLEGAMENTI: Amministrazione Trasparente' );
	}

	public function widget( $args, $instance ) {
		global $before_widget, $after_widget, $before_title, $after_title;
		extract( $args );

		$str = $before_widget;
		if ( $instance['title'] ) {
			$str .= $before_title;
			$str .= $instance['title'];
			$str .= $after_title;
		}
		$url = $instance['url'];
        $accessKeyAttribute = '';
        if (gliAccessKeySonoAbilitati()){
            $accessKeyAttribute = getAccessKeyAttribute(getAccessKeyPage($url));
        }

		$str .= '
				<a href="' . get_page_link( $url ) . '"' . $accessKeyAttribute . '>
                	<img alt="Amministrazione Trasparente" style="width: 100%" src="' . get_template_directory_uri() . '/include/assets/images/amministrazioneTrasparente.jpg"/>
              	</a>';
		$str .= $after_widget;

		echo $str;
	}

	public function form( $instance ) {
		if ( $instance ) {
			$title = esc_attr( $instance['title'] );
		} else {
			$title = 'AMMINISTRAZIONE TRASPARENTE';
			$instance = [];
			$instance['url'] = '';
		}

		//mostro la casella di testo per inserire il titolo
		?>

		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'madisoft_scuola' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>" />
        <p><?php ?></p>
		<p>
			<label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'Pagina da collegare', 'madisoft_scuola' ); ?></label>
			<?php wp_dropdown_pages(
			        array( 'id' => 'url', 'name' => 'url', 'selected' => $instance['url'] ) ); ?>
		</p>
	<?php
	}

	public function update( $new_instance, $old_instance ) {
	    $instance          = $old_instance;
	    $instance['title'] = strip_tags( $new_instance['title'] );
		$instance['url']   = strip_tags( $_POST['url'] );
		return $instance;
	}
}

function amministrazioneTrasparente_register_widgets() {
	register_widget( 'Amministrazione_Trasparente_Widget' );
}

add_action( 'widgets_init', 'amministrazioneTrasparente_register_widgets' );

//compatibilita se toglia()mo il plugin accessibilita
    if (!function_exists('gliAccessKeySonoAbilitati')){
        function gliAccessKeySonoAbilitati(){
            return false;
        }
    }
