<?php

class MadisoftImageClass {
	protected $src;
	protected $title;
	protected $alt;
	protected $class;
	protected $id;
	protected $width;
	protected $height;
	protected $style = [ ];

	function __construct( $src ) {
		$this->setSrc( $src );
	}

	public function printImage() {
		return '<img' . $this->printAlt() . $this->printTitle() . $this->printStyle() . ' src="' . $this->getSrc() . '"/>';
	}

	/**
	 * @return mixed
	 */
	public function getTitle() {

		return $this->title;
	}

	public function printTitle() {
		if ( $this->getTitle() ) {
			return ' title="' . $this->getTitle() . '"';
		}

		return '';
	}

	public function printAlt() {
		if ( $this->getAlt() ) {
			return ' alt="' . $this->getAlt() . '"';
		}

		return '';
	}

	/**
	 * @param mixed $title
	 */
	public function setTitle( $title ) {
		$this->title = $title;
	}

	/**
	 * @return mixed
	 */
	public function getClass() {
		return $this->class;
	}

	/**
	 * @param mixed $class
	 */
	public function setClass( $class ) {
		$this->class = $class;
	}

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param mixed $id
	 */
	public function setId( $id ) {
		$this->id = $id;
	}

	/**
	 * @return mixed
	 */
	public function getWidth() {
		return $this->width;
	}

	/**
	 * @param mixed $width
	 */
	public function setWidth( $width ) {
		$this->width = $width;
	}

	/**
	 * @return mixed
	 */
	public function getHeight() {
		return $this->height;
	}

	/**
	 * @param mixed $height
	 */
	public function setHeight( $height ) {
		$this->height = $height;
	}

	/**
	 * @return mixed
	 */
	public function getStyle() {
		return $this->style;
	}

	/**
	 * @param array $style
	 */
	public function setStyle( array $style ) {
		$this->style = $style;
	}

	/**
	 * @param array $style
	 *
	 * @return $this
	 */
	public function addStyle( array $style ) {
		$this->style[ key( $style ) ] = $style[ key( $style ) ];

		return $this;
	}

	public function printStyle() {
		if ( count( $this->getStyle() ) == 0 ) {
			return '';
		}
		$style = [];
        foreach ($this->getStyle() as $property=>$value){
		    $style[] =$property .': ' .$value;
        }

			return ' style="' . implode( '; ', $style ) . ';"';
	}

	/**
	 * @return mixed
	 */
	public function getSrc() {
		if ( ! $this->src ) {
			throw new ParametroNonSettatoException( 'src Image' );
		}

		return $this->src;
	}

	/**
	 * @param mixed $src
	 */
	public function setSrc( $src ) {
		$this->src = $src;
	}


    /**
     * @return mixed
     */
    public function getAlt ()
    {
        if($this->alt){
            return $this->alt;
        }

        return $this->getTitle();
    }

    /**
     * @param mixed $alt
     */
    public function setAlt ($alt)
    {
        $this->alt = $alt;
    }

}