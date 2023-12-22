<?php

class MadisoftThemeCustomPostTypeExtendClass {
	var $postTypeCLass;
	var $createFieldClass;
	var $slug;
	var $postTypeName;
	var $postTitle;
	var $position = '';
	var $taxonomyChilds = [ ];

	/**
	 * @return string
	 */
	public function getPosition() {
		if ( ! $this->position ) {
			throw new ParametroNonSettatoException( '$this->position va settato' );
		}

		return $this->position;
	}

	/**
	 * @param string $position
	 */
	public function setPosition( $position ) {
		$this->position = $position;
	}

	/**
	 * @return mixed
	 */
	public function getSlug() {
		return $this->slug;
	}

	/**
	 * @param mixed $slug
	 */
	public function setSlug( $slug ) {
		$this->slug = $slug;
	}

	/**
	 * @return mixed
	 */
	public function getPostTypeName() {
		return $this->postTypeName;
	}

	/**
	 * @param mixed $postTypeName
	 */
	public function setPostTypeName( $postTypeName ) {
		$this->postTypeName = $postTypeName;

	}


	/**
	 * @return MadisoftPostTypeClass
	 */
	public function getPostTypeCLass() {
		return $this->postTypeCLass;
	}

	/**
	 * @param mixed $postTypeCLass
	 */
	public function setPostTypeCLass( $postTypeCLass ) {
		$this->postTypeCLass = $postTypeCLass;
	}

	/**
	 * @return MadisoftThemeFieldCreateClass
	 */
	public function getCreateFieldClass() {
		return $this->createFieldClass;
	}

	/**
	 * @param MadisoftThemeFieldCreateClass
	 */
	public function setCreateFieldClass( $createFieldClass ) {
		$this->createFieldClass = $createFieldClass;
	}


	/**
	 * @return mixed
	 */
	public function getPostTitle() {
		return $this->postTitle;
	}

	/**
	 * @param mixed $postTitle
	 */
	public function setPostTitle( $postTitle ) {
		$this->postTitle = $postTitle;
	}

	function setTemplatePages() {
		add_filter( "single_template", array( $this, "get_post_type_template" ) );
		add_filter( "archive_template", array( $this, "get_post_type_archive_template" ) );
		add_filter( "category_template", array( $this, "get_post_type_archive_template" ) );
		add_filter( "taxonomy_template", array( $this, "get_post_type_archive_template" ) );
		add_filter( 'enter_title_here', array( $this, 'change_default_title' ) );


	}

	public function get_post_type_template( $single_template ) {
		global $post;
		if ( $post->post_type == $this->getPostTypeCLass()->getPostTypeName() ) {
			$single_template = $this->getPosition() . '/single.php';
		}

		return $single_template;
	}

	public function get_post_type_archive_template( $single_template ) {
		$category = get_queried_object();
		if ( isset( $category->query_var ) && $category->query_var == $this->getPostTypeName() ) {
			if ( file_exists( $this->getPosition() . '/archive-all.php' ) ) {
				return $this->getPosition() . '/archive-all.php';
			}
			return $this->getPosition() . '/archive.php';
		}
		if ( isset( $category->taxonomy ) ) {
			if ( $category->taxonomy == 'category' && $category->slug == $this->getSlug() ) {
				return $this->getPosition() . '/archive.php';
			}

			if ( $category->taxonomy == '' ) {
				return $this->getPosition() . '/archive.php';
			}
		}

		return $single_template;
	}

	public function get_post_type_taxonomy_template( $single_template ) {
		$category        = get_queried_object();
		$single_template = $this->getPosition() . '/archive.php';

		return $single_template;
	}

	public function get_post_type_category_template( $single_template ) {
		$category        = get_queried_object();
		$single_template = $this->getPosition() . '/archive.php';

		return $single_template;
	}

	public function change_default_title( $title ) {

		$screen = get_current_screen();

		if ( $this->getPostTypeName() == $screen->post_type ) {
			$title = $this->getPostTitle();
		}

		return $title;
	}

	/**
	 * @return array
	 */
	public function getTaxonomyChilds() {
		if ( count( $this->taxonomyChilds ) == 0 ) {
			throw new ParametroNonSettatoException( 'Non Hai incluso la tassonomia' );
		}

		return $this->taxonomyChilds;
	}

	public function addTaxonomyChilds( $child ) {
		return $this->taxonomyChilds[] = $child;
	}

	/**
	 * @param array $taxonomyChilds
	 */
	public function setTaxonomyChilds( $taxonomyChilds ) {
		$this->taxonomyChilds = $taxonomyChilds;
	}
}