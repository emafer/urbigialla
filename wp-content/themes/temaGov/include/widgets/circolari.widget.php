<?php

class Circolari_Widget extends WP_Widget {

	public function __construct() {
		// Instantiate the parent object
		parent::__construct( false, 'Circolari' );
	}

	public function widget( $args, $instance ) {
		global $before_widget, $after_widget, $before_title, $after_title;
		extract( $args );
		$str = $before_widget;
		if ( $instance['title']) {
			$title = $instance['title'] ;
		}
		if ( isset($instance['automatico']) && $instance['automatico'] == '2' ){
			$circolareSearch = new CircolariSearchAndShow();
			$title = 'Ultima Circolare: N. ' . $circolareSearch->getLastNumber();
		}

		if ( $title ) {
			$str .= $before_title;
			$str .= $title;
			$str .= $after_title;
		}

		$html = madisoft_get_terms_list( 'destinatari_circolari', false, 'destinatari_circolari_order' );
		if ( $html && madisoft_get_theme_option('madisoft_scuola_circolari_widget_generale', 'on') == 'on' 	) {
			$html = '<ul><li><a href="' . get_post_type_archive_link( 'scuola_circolari' ) . '">Circolari</a>' . $html . '</li></ul>';
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
			$automatico = esc_attr( $instance['automatico'] );
		} else {
			$title = 'Circolari';
			$automatico = 1;
		}

		?>

		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'madisoft_scuola' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" class="widefat" type="text"
					 name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>" /><br/>
		<label for="<?php echo $this->get_field_id( 'automatico' ); ?>"><?php _e( 'Titolo Automatico:', 'madisoft_scuola' ); ?></label>
		<select id="<?php echo $this->get_field_id( 'automatico' ); ?>" class="widefat"
			   name="<?php echo $this->get_field_name( 'automatico' ); ?>">
			<option value="1"<?php if ($automatico == 1) {echo ' selected="selected"';} ?>>NO</option>
			<option value="2"<?php if ($automatico == 2) {echo ' selected="selected"';} ?>>SI</option>
			   </select>


	<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance          = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['automatico'] = strip_tags( $new_instance['automatico'] );
		return $instance;
	}


}

function circolari_register_widgets() {
	register_widget( 'Circolari_Widget' );
}


if ( madisoft_get_theme_option('madisoft_scuola_circolari_uso', 'on') == 'on'){
	add_action( 'widgets_init', 'circolari_register_widgets' );
}