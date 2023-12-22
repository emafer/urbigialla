<?php

class LeScuole_Widget extends WP_Widget {

	public function __construct() {
		// Instantiate the parent object
		parent::__construct( false, 'Le Scuole' );
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
		$opzioneIntestazioniSiNo = ( madisoft_get_theme_option('madisoft_scuola_scuole_widget_titoli', 'on') == 'on') ;
		$html = madisoft_get_terms_list( 'scuola_ordine', true, 'scuola_ordine_order', '', '', 'le_scuole', $opzioneIntestazioniSiNo);
		if ( $html && madisoft_get_theme_option('madisoft_scuola_scuole_widget_generale', 'on') == 'on' ) {
			$html = '<ul><li><a href="' . get_post_type_archive_link( 'le_scuole' ) . '">Le scuole</a>' . $html . '</li></ul>';
		}
		$str_end = $after_widget;
		if ( $html ) {
			echo $str . $html . $str_end;
		} else {
			echo '';
		}
	}

	public function form( $instance ) {
		if ( $instance ) {
			$title = esc_attr( $instance['title'] );
		} else {
			$title = 'Le Scuole';
		}

		?>

		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'madisoft_scuola' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" class="widefat" type="text"
					 name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>" />

	<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance          = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}


}

function le_scuole_register_widgets() {
	register_widget( 'LeScuole_Widget' );
}

if ( madisoft_get_theme_option('madisoft_scuola_scuole_uso', 'on') == 'on'){
add_action( 'widgets_init', 'le_scuole_register_widgets' );
}
