<?php


class Registro_Elettronico_Widget extends WP_Widget {

	public function __construct() {
		// Instantiate the parent object
		parent::__construct( false, 'COLLEGAMENTI - REGISTRO ELETTRONICO' );
	}

	public function widget( $args, $instance ) {
		global $before_widget, $after_widget, $before_title, $after_title;
		extract( $args );

		$codiceMeccanografico = $this->getCodiceMeccanografico($instance);

		$str = $before_widget;
		if ( $instance['title'] ) {
			$str .= $before_title;
			$str .= $instance['title'];
			$str .= $after_title;
		}

		$str .= '
			<a href="https://nuvola.madisoft.it/login?codice=' . $codiceMeccanografico . '" target="_blank">
                <img alt="Registro elettronico" style="width: 100%; height:auto;" src="' . madisoft_scuola_get_assets_directory('img',  true, 'logo-registroelettronico.png') . '"/>
            </a>';
		$str .= $after_widget;

		echo $str;
	}

	public function form( $instance ) {
		if ( $instance ) {
			$title = esc_attr( $instance['title'] );
			$codiceMeccanografico  = $this->getCodiceMeccanografico($instance);
		} else {
			$title = 'REGISTRO ELETTRONICO';
			$codiceMeccanografico  = madisoft_get_theme_option('madisoft_scuola_istituto_codice_meccanografico', '');
		}

		//mostro la casella di testo per inserire il titolo
		?>

		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'madisoft_scuola' ); ?></label>

		<input id="<?php echo $this->get_field_id( 'title' ); ?>" class="widefat" type="text"
					 name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>" />

		<!-- link registro elettronico -->
		<label for="<?php echo $this->get_field_id( 'codiceMeccanografico' ); ?>"><?php _e( 'Codice Meccanografico:', 'madisoft_scuola' ); ?></label>

		<input id="<?php echo $this->get_field_id( 'codiceMeccanografico' ); ?>" class="widefat" type="text"
					 name="<?php echo $this->get_field_name( 'codiceMeccanografico' ); ?>" value="<?php echo $codiceMeccanografico; ?>" />

	<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance          = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['codiceMeccanografico']  = $new_instance['codiceMeccanografico'];

		return $instance;
	}

	protected function getCodiceMeccanografico($instance){
        return (!isset( $instance['codiceMeccanografico'] ) || !$instance['codiceMeccanografico'])? madisoft_get_theme_option('madisoft_scuola_istituto_codice_meccanografico', ''): $instance['codiceMeccanografico'];
    }
}

function nuvola_register_widgets() {
	register_widget( 'Registro_Elettronico_Widget' );
}

add_action( 'widgets_init', 'nuvola_register_widgets' );
