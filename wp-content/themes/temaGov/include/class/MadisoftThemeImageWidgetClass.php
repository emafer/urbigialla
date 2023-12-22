<?php

class MadisoftThemeImageWidgetClass extends MadisoftThemeWidgetClass {
	protected $image;
	protected $linkTo;

    /**
     * MadisoftThemeImageWidgetClass constructor.
     * @param $name
     * @param $title
     * @param MadisoftImageClass $image
     * @param $link
     * @param bool $id_base
     * @param array $widget_options
     * @param array $control_options
     * @throws NomeWidgetNonSettatoException
     */
	public function __construct( $name, $title, MadisoftImageClass $image, $link, $id_base = false, $widget_options = array(), $control_options = array() ) {
        $this->setNameOfWidget($name);
        $this->setTitle($title);
        $this->setImage( $image );
        $this->setLinkTo( $link  );
        parent::__construct( $id_base, $this->getNameOfWidget(), $widget_options, $control_options );
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

		$str .= '<a href="' . $this->getLinkTo() . '" target="_blank">';
		$str .= $this->getImage()->printImage();
		$str .= '</a>';
		$str .= $after_widget;

		echo $str;
	}

	public function form( $instance ) {
		if ( $instance ) {
			$title = esc_attr( $instance['title'] );
		} else {
			$title = $this->getTitle();
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

	/**
	 * @return mixed
	 */
	public function getLinkTo() {
		if ( ! $this->linkTo ) {
			throw new ParametroNonSettatoException( 'linkTo' );
		}

		return $this->linkTo;
	}

	/**
	 * @param mixed $linkTo
	 */
    public function setLinkTo($linkTo){
        $this->linkTo = $linkTo;
    }

	/**
	 * @return MadisoftImageClass
	 */
	public function getImage() {
		if ( ! $this->image ) {
			throw new ParametroNonSettatoException( 'Immagine ' );
		}

		return $this->image;
	}

	/**
	 * @param MadisoftImageClass $image
	 *
	 */

	 public function setImage( $image){
	     $this->image = $image;

         $this->getImage()->addStyle( [ 'width' => '100%' ] );
     }

}