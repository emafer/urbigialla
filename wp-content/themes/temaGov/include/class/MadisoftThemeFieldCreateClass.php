<?php

class MadisoftThemeFieldCreateClass {
	protected $isIncludedjqueryUi = false;
	protected $listOfField = [ ];
	protected $isIncludedTinyMceScript = false;
	protected $isIncludedUploadScript = false;
	protected $isIncludedDatepickerScript = false;
	protected $nonceFields = [ ];

	public function scriviIlForm() {
		foreach ( $this->getNonceFields() as $nonceField ) {
			wp_nonce_field( plugin_basename( __FILE__ ), $nonceField . '_nonce' );
		}

		foreach ( $this->getListOfField() as $sezione => $campiInput ) {
			$this->createSection( $sezione, $campiInput );
		}
	}
	private function getOption($id){
		global $post;
		if ($post instanceof WP_Post){
			return  get_post_meta( $post->ID, $id, true );
		}
		return '';

	}
	public function salvaIlForm( $id ) {

		if ( count( $this->getListOfField() ) == 0 ) {
//			throw new ParametroNonSettatoException( 'Impostare la lista dei campi ' );
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $id;
		}

		foreach ( $this->getNonceFields() as $nonceField ) {
			if ( ! isset( $_POST[ $nonceField . '_nonce' ] ) ) {
				return $id;
			}
			if ( ! wp_verify_nonce( $_POST[ $nonceField . '_nonce' ], plugin_basename( __FILE__ ) ) ) {
				return $id;
			}
		}
		foreach ( $this->getListOfField() as $sezioni ) {
			foreach ( $sezioni as $key => $campi ) {
				foreach ( $campi as $campo ) {
                    echo '<hr/>';
					if ( isset( $_POST[ $campo['id'] ] ) ) {
						if ( $campo['type'] == 'date' ) {
							if ( ! preg_match( '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $_POST[ $campo['id'] ] ) ) {
								$d                     = DateTime::createFromFormat( 'd/m/Y', $_POST[ $campo['id'] ] );
								$_POST[ $campo['id'] ] = $d->format( 'Y-m-d' );
							}
						}
						update_post_meta( $id, $campo['id'], $_POST[ $campo['id'] ] );
					}
				}
			}
		}
	}

	/**
	 * @return array
	 */
	public function getNonceFields() {
		return $this->nonceFields;
	}

	/**
	 * @param array $nonceFields
	 */
	public function setNonceFields( $nonceFields ) {
		$this->nonceFields = $nonceFields;
	}

	public function addNonceField( $nonceField ) {
		$this->nonceFields[] = $nonceField;
	}

	protected function showTinyMCE() {
		if ( $this->getIsIncludedTinyMceScript() ) {
			return true;
		}
		wp_enqueue_script( 'common' );
		wp_enqueue_script( 'jquery-color' );
		wp_print_scripts( 'editor' );
		if ( function_exists( 'add_thickbox' ) ) {
			add_thickbox();
		}
		wp_print_scripts( 'media-upload' );
		wp_admin_css();
		wp_enqueue_script( 'utils' );
		do_action( "admin_print_styles-post-php" );
		do_action( 'admin_print_styles' );
		$this->setIsIncludedTinyMceScript( true );
	}

	protected function uploadMediaScript() {
		if ( $this->getIsIncludedUploadScript() ) {
			return true;
		}
		wp_enqueue_media();
		wp_register_script( 'jqueryUpload', madisoft_scuola_get_assets_directory( 'js', true ) . 'jqueryUpload.js', array( 'jquery' ) );
		wp_enqueue_script( 'jqueryUpload' );
		$this->setIsIncludedUploadScript( true );
	}

	protected function uploadDatepickerScript() {
		if ( $this->getIsIncludedDatepickerScript() ) {
			return true;
		}

		$this->uploadJqueryUiScript();
		$this->setIsIncludedDatepickerScript( true );
	}

	protected function uploadJqueryUiScript() {
		if ( $this->getIsIncludedjqueryUi() ) {
			return true;
		}
		$this->setIsIncludedjqueryUi( true );
	}

	/**
	 * @param boolean $isIncludedDatepickerScript
	 */
	protected function setIsIncludedDatepickerScript( $isIncludedDatepickerScript ) {
		$this->isIncludedDatepickerScript = $isIncludedDatepickerScript;
	}

	/**
	 * @return boolean
	 */
	protected function getIsIncludedDatepickerScript() {
		return $this->isIncludedDatepickerScript;
	}

	/**
	 * @return boolean
	 */
	protected function getIsIncludedjqueryUi() {
		return $this->isIncludedjqueryUi;
	}

	/**
	 * @param boolean $isIncludedjqueryUi
	 */
	protected function setIsIncludedjqueryUi( $isIncludedjqueryUi ) {
		$this->isIncludedjqueryUi = $isIncludedjqueryUi;
	}
	protected function isThisAnEcommerce() {
		return in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
	}

	protected function createSection( $id, $campiInput ) {
		if ( $this->isHiddenSection( $id ) ) {
			echo '<div id="' . $id . '">';
		}

		foreach ( $campiInput as $campi ) {
			foreach ( $campi as $campo ) {
				if ( ! isset( $campo['type'] ) ) {
					throw new ParametroNonSettatoException( 'il campo Type del campo ' . $campo['id'] . ' non &egrave; stato fissato' );
				}

				$funzione = 'create' . ucfirst( $campo['type'] ) . 'Field';
				$this->$funzione( $campo );
			}
		}
		if ( $this->isHiddenSection( $id ) ) {
			echo '</div>';
		}
	}

	/**
	 * @return boolean
	 */
	protected function getIsIncludedTinyMceScript() {
		return $this->isIncludedTinyMceScript;
	}

	/**
	 * @param boolean $isIncludedTinyMceScript
	 */
	protected function setIsIncludedTinyMceScript( $isIncludedTinyMceScript ) {
		$this->isIncludedTinyMceScript = $isIncludedTinyMceScript;
	}

	/**
	 * @return boolean
	 */
	protected function getIsIncludedUploadScript() {
		return $this->isIncludedUploadScript;
	}

	/**
	 * @param boolean $isIncludedUploadScript
	 */
	protected function setIsIncludedUploadScript( $isIncludedUploadScript ) {
		$this->isIncludedUploadScript = $isIncludedUploadScript;
	}

	protected function setHtmlAttributes( $args ) {
		if ( ! isset( $args['htmlAttributes'] ) ) {
			return '';
		}

		$html = '';
		foreach ( $args['htmlAttributes'] as $attributo => $valore ) {
			$html .= ' ' . $attributo . '="' . $valore . '"';
		}

		return $html;
	}

	protected function createDateField( $args ) {
		$this->uploadDatepickerScript();
		if ( ! isset( $args['htmlAttributes'] ) ) {
			$args['htmlAttributes'] = [ ];
		};

		if ( ! isset( $args['htmlAttributes']['class'] ) ) {
			$args['htmlAttributes']['class'] = "datepicker";
		} else {
			$args['htmlAttributes']['class'] .= " datepicker";
		}
		$this->createTextField( $args );
	}

	protected function createTextField( $args ) {
		$id = $args['id'];
		isset( $args['supertype'] ) ? $type = $args['supertype'] : $type = 'text';
		printf(
			'<label for="' . $id . '" class="label_madisoft_form">%s:</label>
<input type="' . $type . '" id="' . $id . '" name="' . $id . '" value="%s"' . $this->setHtmlAttributes( $args ) . '/>',
			$args['title'], $args['value']
		);
		echo $this->getSeparator( $args );
	}

	protected function getSeparator( $args ) {
		if ( isset( $args['separator'] ) ) {
			return $args['separator'];
		}

		return '';
	}

	protected function createMediaField( $args, $image = false ) {
		$this->uploadMediaScript();
		$id = $args['id'];
		$image ? $class = ' imageField' : $class = '';
		echo '<div class="form-group">
        <label for="upload_image" class="label_madisoft_form">' . $args['title'] . '</label>';
		if ( $args['value'] ) {
			if ( $image ) {
				echo '<img width="250px" id="' . $id . '_image" src="' . $this->getOption( $id ) . '"/><br/>';
			} else {
				echo '<em>' . basename( $args['value'] ) . '</em>';
			}
		}
		echo '<input class="inputMedia' . $class . '" id="' . $id . '" type="hidden" name="' . $id . '" value="' . $args['value'] . '" />
	<input id="upload_media_button_' . $id . '" class="addMediaMadiButton" type="button" data-target="' . $id . '" value="' . $args['title'] . '" /></div>' . $this->getSeparator( $args );
//
	}

	protected function createImageField( $args ) {
		$id = $args['id'];
		if ( $this->getOption( $id ) ) {
			echo '<img width="250px" id="' . $id . '_image" src="' . $this->getOption( $id ) . '"/><br/>';
		}
		$this->createMediaField( $args, true );
//
	}

	protected function createProductField( $args ) {
		global $post;
		$id = $args['id'];
		echo '<select id="' . $id . '" name="' . $id . '">';
		$opzioni = array(
			'numberposts' => - 1,
			'post_type'   => 'product'
		);

		$posts = get_posts( $opzioni );
		foreach ( $posts as $post ) {
			/**
			 * @var $post WP_post
			 */
			setup_postdata( $post );
			echo "\n\t" . '<option value="' . $post->ID . '"' . $this->selected( $post->ID, $id ) . '>' . $post->post_title . '</option>';
		}
		echo "\n" . '</select>';
	}

	protected function createPageField( $args ) {
		global $post;
		$id = $args['id'];
		echo '<select id="' . $id . '" name="' . $id . '">';
		$opzioni = array(
			'numberposts' => - 1,
			'post_type'   => 'page'
		);

		$posts = get_posts( $opzioni );
		foreach ( $posts as $post ) {
			/**
			 * @var $post WP_post
			 */
			setup_postdata( $post );
			echo "\n\t" . '<option value="' . $post->ID . '"' . $this->selected( $post->ID, $id ) . '>' . $post->post_title . '</option>';
		}
		echo "\n" . '</select>';
	}

	protected function createCategoryProductField( $args ) {

		global $post;
		$id      = $args['id'];
		$opzioni = array(
			'taxonomy' => 'product_cat'
		);
		$cats    = get_categories( $opzioni );
		echo '<select id="' . $id . '" name="' . $id . '">';
		foreach ( $cats as $cat ) {
			setup_postdata( $post );
			echo "\n\t" . '<option value="' . $cat->term_id . '"' . $this->selected( $cat->term_id, $id ) . '>' . $cat->name . '</option>';
		}
		echo "\n" . '</select>';

	}

	protected function createTextareaField( $args ) {
		$id = $args['id'];
		echo '<textarea style="width: 100%; height: 200px;" id="' . $id . '" name="' . $id . '"/>' .
		     $this->getOption( $id )
		     . '</textarea>';

	}

	protected function createEditorField( $args ) {
		$this->showTinyMCE();
		$id = $args['id'];
		printf(
			'<label for="' . $id . '" class="label_madisoft_form">%s:</label><br/>',
			$args['title'] );
		if ( function_exists( 'wp_editor' ) ) {
			wp_editor( $args['value'],
				$id,
				array(
					'textarea_name' => $id,
				)
			);
		};
	}

	protected function selected( $val, $id ) {
		if ( $val == $this->getOption( $id ) ) {
			return ' selected="selected"';
		}

		return '';
	}

	protected function createSelectField( $args ) {
		$id = $args['id'];
		echo
			'<select id="' . $id . '" name="' . $id . '">';
		foreach ( $args['args'] as $value => $desc ) {
			echo "\n\t" . '<option value="' . $value . '"' . $this->selected( $value, $id ) . '>' . $desc . '</option>';
		}
		echo "\n" . '</select>';

	}

	/**
	 * @param $id
	 *
	 * @return bool
	 */
	protected function isHiddenSection( $id ) {
		return $id != 'hidden';
	}

	/**
	 * @return array
	 */
	public function getListOfField() {
		return $this->listOfField;
	}

	/**
	 * @param array $listOfField
	 */
	public function setListOfField( $listOfField ) {
		$this->listOfField = $listOfField;
	}
}
