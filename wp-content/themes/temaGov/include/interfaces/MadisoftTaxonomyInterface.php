<?php

interface MadisoftTaxonomyInterface {

	/**
	 * @return mixed
	 */

	function __construct( $parentClass );
	function crea_taxonomy();

	function setPosition( $position );

	function getPosition();
}