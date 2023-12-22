<?php

class MadisoftTaxonomyClass implements MadisoftTaxonomyInterface {
	protected $position;
	protected $taxonomyName;
	protected $parentCustomPostTypeClass;

	function __construct( $parentCustomPostTypeClass ) {
		$this->setParentCustomPostTypeClass( $parentCustomPostTypeClass );
	}

	/**
	 * @return mixed
	 */
	public function getTaxonomyName() {
		return $this->taxonomyName;
	}

	/**
	 * @param mixed $taxonomyName
	 */
	public function setTaxonomyName( $taxonomyName ) {
		$this->taxonomyName = $taxonomyName;
	}

	/**
	 * @return mixed
	 */
	function crea_taxonomy() {
		// TODO: Implement crea_taxonomy() method.
	}

	function setPosition( $position ) {
		$this->position = $position;
	}

	public function getPosition() {
		if ( ! $this->position ) {
			throw new ParametroNonSettatoException( '$this->position va settato' );
		}

		return $this->position;
	}

	public function get_post_type_archive_template( $single_template ) {
		$category = get_queried_object();
		if ( in_array( $category->taxonomy, $this->getParentCustomPostTypeClass()->getTaxonomyChilds() ) ) {
			return $this->getPosition() . '/archive.php';
		}
		return $single_template;
	}

	/**
	 * @return MadisoftThemeCustomPostTypeExtendClass
	 */
	public function getParentCustomPostTypeClass() {
		if ( ! $this->parentCustomPostTypeClass ) {
			throw new ParametroNonSettatoException( 'Non hai impostato la parent custom type class' );
		}

		return $this->parentCustomPostTypeClass;
	}

	/**
	 * @param  MadisoftThemeCustomPostTypeExtendClass $parentCustomPostTypeClass
	 */
	public function setParentCustomPostTypeClass( $parentCustomPostTypeClass ) {
		$this->parentCustomPostTypeClass = $parentCustomPostTypeClass;
	}
}