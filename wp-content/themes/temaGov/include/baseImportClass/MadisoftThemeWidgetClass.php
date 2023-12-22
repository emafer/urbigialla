<?php
class MadisoftThemeWidgetClass extends WP_Widget {
	protected $title;
	protected $nameOfWidget;
	protected $nameOfClass;

	public function __construct( $id_base, $name, $widget_options = array(), $control_options = array() ) {
		parent::__construct( $id_base, $this->nameOfWidget, $widget_options, $control_options );
		add_action( 'widgets_init', array( $this, 'register_this_widgets' ) );
	}

	function register_this_widgets() {
		register_widget( $this->getNameOfClass() );
	}


	/**
	 * @return mixed
	 * @throws ParametroNonSettatoException
	 */
	public function getNameOfClass() {
		if ( ! $this->nameOfClass ) {
			throw new ParametroNonSettatoException( 'nome classe' );
		}

		return $this->nameOfClass;
	}

	/**
	 * @param mixed $nameOfClass
	 */
	public function setNameOfClass( $nameOfClass ) {
		$this->nameOfClass = $nameOfClass;
	}

	/**
	 * @return mixed
	 */
	public function getNameOfWidget() {
		if ( ! $this->title ) {
			throw new NomeWidgetNonSettatoException();
		}

		return $this->nameOfWidget;
	}

	/**
	 * @param mixed $nameOfWidget
	 */
	public function setNameOfWidget( $nameOfWidget ) {
		$this->nameOfWidget = $nameOfWidget;
	}

	/**
	 * @return mixed
	 */
	public function getTitle() {
		if ( ! $this->title ) {
			throw new TitoloNonSettatoException();
		}

		return $this->title;
	}

	/**
	 * @param mixed $title
	 */
	public function setTitle( $title ) {
		$this->title = $title;
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
		$str .= '<a href="' . get_page_link( $url ) . '">
                	<img alt="' . $instance['title'] . '" style="width: 100%" src="' . get_template_directory_uri() . '/include/images/amministrazioneTrasparente.jpg"/>
              	</a>';
		$str .= $after_widget;

		echo $str;
	}

	public function form( $instance ) {
		if ( $instance ) {
			$title = esc_attr( $instance['title'] );
		} else {
			$title = 'AMMINISTRAZIONE TRASPARENTE';
		}

		//mostro la casella di testo per inserire il titolo
		?>

		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'madisoft_scuola' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>" />

		<p>
			<label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'Pagina da collegare', 'madisoft_scuola' ); ?></label>
			<?php wp_dropdown_pages( array( 'id'       => $this->get_field_id( 'url' ),
			                                'name'     => $this->get_field_name( 'url' ),
			                                'selected' => $instance['url']
			) ); ?>
		</p>
	<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance          = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['url']   = strip_tags( $new_instance['url'] );

		return $instance;
	}
}