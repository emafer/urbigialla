<?php

class Separatore_Widget extends WP_Widget {

	public function __construct() {
		// Instantiate the parent object
		parent::__construct( false, 'SEPARATORE' );
	}

	public function widget( $args, $instance ) {
		global $before_widget, $after_widget, $before_title, $after_title;
		extract( $args );
		if ( $instance['title'] ) {
			$str = $before_widget;
			$str .= $before_title;
			$str .= $instance['title'];
			$str .= $after_title;
			$str .= $after_widget;
			echo $str;
		}
	}

	public function form( $instance ) {
		if ( $instance ) {
			$title = esc_attr( $instance['title'] );
		} else {
			$title = 'Separatore';
		}

		//mostro la casella di testo per inserire il titolo
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

function separatore_register_widgets() {
	register_widget( 'Separatore_Widget' );
}

add_action( 'widgets_init', 'separatore_register_widgets' );
