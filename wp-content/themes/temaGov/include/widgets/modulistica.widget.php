<?php

class Modulistica_Widget extends WP_Widget {

	public function __construct() {
		// Instantiate the parent object
		parent::__construct( false, 'Modulistica' );
	}

	public function widget( $args, $instance ) {
		global $before_widget, $after_widget, $before_title, $after_title, $madisoftTheme;
		$destinari_tax = $madisoftTheme->getGlobalVar( 'modulistica_destinatari_taxonomy' );
		extract( $args );

		$str = $before_widget;
		if ( $instance['title'] ) {
			$str .= $before_title;
			$str .= $instance['title'];
			$str .= $after_title;
		}

		$html = madisoft_get_terms_list( 'destinatari_modulistica', false, 'destinatari_modulistica_order' );
		if ( $html && madisoft_get_theme_option('madisoft_scuola_modulistica_widget_generale', 'on') == 'on' ) {
			$html = '<ul><li><a href="' . get_post_type_archive_link( 'scuola_modulistica' ) . '">Modulistica</a>' . $html . '</li></ul>';
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
			$title = 'Modulistica';
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

function modulistica_register_widgets() {
	register_widget( 'Modulistica_Widget' );
}

if ( madisoft_get_theme_option('madisoft_scuola_modulistica_uso', 'on') == 'on') {
	add_action( 'widgets_init', 'modulistica_register_widgets' );
}