<?php

class MadisoftPostTypeClass implements MadisoftPostTypeInterface {

	protected $postTypeName;
	protected $label;
	protected $description;
	protected $labels = [ ];
	protected $public = true;
	protected $excludeFromSearch = true;
	protected $publiclyQueryable = true;
	protected $show_ui = true;
	protected $show_in_rest = false;
	protected $showInNavMenu = true;
	protected $showInMenu = true;
	protected $showInAdminBar = true;
	protected $menuIcon = null;
	protected $rewrite = [ ];
	protected $rewriteSlug;
	protected $rewriteWithFront = false;
	protected $rewriteFeeds = false;
	protected $rewritePages = true;
	protected $supports = [ ];
	protected $menu_position = 0;
	protected $publicly_queryable = true;
	protected $show_in_menu = true;
	protected $query_var = true;
	protected $capability_type = 'post';
	protected $mapMetaCap = null;
	protected $has_archive = true;
	protected $hierarchical = false;
	protected $slug;
	protected $supportTitle = true;
	protected $supportEditor = true;
	protected $supportAuthor = false;
	protected $supportPageAttributes = false;
	protected $supportThumbnail = true;
	protected $supportExcerpt = false;
	protected $supportComments = false;
	protected $supportReviosions = true;
	protected $supportTrackbacks = false;
	protected $supportCustomFields = false;
	protected $supportPostFormat = false;
	protected $taxonomies = null;
	protected $queryVar;
	protected $canExport = null;

	function __construct() {
	}

	function register_post_type() {
		register_post_type(
			$this->getPostTypeName(),
			array(
				'label'=>_x($this->getLabel(),'madisoft_tema_scuola'),
				'labels'=> $this->getLabels(),
				'public' => $this->isPublic(),
				'show_ui'=> $this->isShowUi(),
				'rewrite'=> $this->getRewrite(),
				'show_in_rest' => $this->isShowInRest(),
				'supports' => $this->getSupports(),
				'menu_position'=>$this->getMenuPosition(),
				'has_archive' => $this->isHasArchive(),
			)
		);
	}

	/**
	 * @return boolean
	 */
	public function isSupportTitle() {
		return $this->supportTitle;
	}

	/**
	 * @param boolean $supportTitle
	 */
	public function setSupportTitle( $supportTitle ) {
		$this->supportTitle = $supportTitle;
	}

	/**
	 * @return boolean
	 */
	public function isSupportEditor() {
		return $this->supportEditor;
	}

	/**
	 * @param boolean $supportEditor
	 */
	public function setSupportEditor( $supportEditor ) {
		$this->supportEditor = $supportEditor;
	}


	/**
	 * @return boolean
	 */
	public function isSupportAuthor() {
		return $this->supportAuthor;
	}

	/**
	 * @param boolean $supportAuthor
	 */
	public function setSupportAuthor( $supportAuthor ) {
		$this->supportAuthor = $supportAuthor;
	}

    /**
     * @return bool
     */
    public function isSupportPageAttributes()
    {
        return $this->supportPageAttributes;
    }

    /**
     * @param bool $supportPageAttributes
     */
    public function setSupportPageAttributes($supportPageAttributes)
    {
        $this->supportPageAttributes = $supportPageAttributes;
    }

	/**
	 * @return boolean
	 */
	public function isSupportThumbnail() {
		return $this->supportThumbnail;
	}

	/**
	 * @param boolean $supportThumbnail
	 */
	public function setSupportThumbnail( $supportThumbnail ) {
		$this->supportThumbnail = $supportThumbnail;
	}

	/**
	 * @return boolean
	 */
	public function isSupportExcerpt() {
		return $this->supportExcerpt;
	}

	/**
	 * @param boolean $supportExcerpt
	 */
	public function setSupportExcerpt( $supportExcerpt ) {
		$this->supportExcerpt = $supportExcerpt;
	}

	/**
	 * @return boolean
	 */
	public function isSupportComments() {
		return $this->supportComments;
	}

	/**
	 * @param boolean $supportComments
	 */
	public function setSupportComments( $supportComments ) {
		$this->supportComments = $supportComments;
	}

	/**
	 * @return boolean
	 */
	public function isSupportReviosions() {
		return $this->supportReviosions;
	}

	/**
	 * @param boolean $supportReviosions
	 */
	public function setSupportReviosions( $supportReviosions ) {
		$this->supportReviosions = $supportReviosions;
	}

	/**
	 * @return boolean
	 */
	public function isSupportTrackbacks() {
		return $this->supportTrackbacks;
	}

	/**
	 * @param boolean $supportTrackbacks
	 */
	public function setSupportTrackbacks( $supportTrackbacks ) {
		$this->supportTrackbacks = $supportTrackbacks;
	}

	/**
	 * @return boolean
	 */
	public function isSupportCustomFields() {
		return $this->supportCustomFields;
	}

	/**
	 * @param boolean $supportCustomFields
	 */
	public function setSupportCustomFields( $supportCustomFields ) {
		$this->supportCustomFields = $supportCustomFields;
	}

	/**
	 * @return boolean
	 */
	public function isSupportPostFormat() {
		return $this->supportPostFormat;
	}

	/**
	 * @param boolean $supportPostFormat
	 */
	public function setSupportPostFormat( $supportPostFormat ) {
		$this->supportPostFormat = $supportPostFormat;
	}

	function setSlug( $slug ) {
		$this->slug = $slug;
	}

	/**
	 * @return boolean
	 */
	public function isHierarchical() {
		return $this->hierarchical;
	}

	/**
	 * @param boolean $hierarchical
	 */
	public function setHierarchical( $hierarchical ) {
		$this->hierarchical = $hierarchical;
	}

	/**
	 * @return mixed
	 */
	public function getLabel() {
		return $this->label;
	}

	/**
	 * @param mixed $label
	 */
	public function setLabel( $label ) {
		$this->label = $label;
	}

	/**
	 * @return array
	 */
	public function getLabels() {
		return $this->labels;
	}

	/**
	 * @param array $labels
	 */
	public function setLabels( array $labels ) {
		$this->labels = $labels;
	}

	/**
	 * @return boolean
	 */
	public function isPublic() {
		return $this->public;
	}

	/**
	 * @param boolean $public
	 */
	public function setPublic( $public ) {
		$this->public = $public;
	}

	/**
	 * @return boolean
	 */
	public function isShowUi() {
		return $this->show_ui;
	}

	/**
	 * @param boolean $show_ui
	 */
	public function setShowUi( $show_ui ) {
		$this->show_ui = $show_ui;
	}

	/**
	 * @return array
	 */
	public function getRewrite() {
		return $this->rewrite;
	}

	/**
	 * @internal param array $rewrite
	 */
	public function setRewrite( ) {
		$this->rewrite['slug'] = $this->getSlug();
		$this->rewrite['with-front'] = $this->isRewriteWithFront();
		$this->rewrite['pages'] = $this->isRewritePages();
		$this->rewrite['feeds'] = $this->isRewriteFeeds();

	}

	/**
	 * @return array
	 */
	public function getSupports() {
		if (count($this->supports) == 0){
			$this->setSupports();
		}
		return $this->supports;
	}

	/**
	 * @internal param array $supports
	 */
	public function setSupports(  ) {
		if ($this->isSupportAuthor()){
			$this->supports[] = 'author';
		}
		if ($this->isSupportPageAttributes()){
			$this->supports[] = 'page-attributes';
		}
		if ($this->isSupportComments()){
			$this->supports[] = 'comments';
		}
		if ($this->isSupportCustomFields()){
			$this->supports[] = 'custom-field';
		}
		if ($this->isSupportEditor()){
			$this->supports[] = 'editor';
		}
		if ($this->isSupportExcerpt()){
			$this->supports[] = 'excerpt';
		}
		if ($this->isSupportPostFormat()){
			$this->supports[] = 'post-formats';
		}
		if ($this->isSupportReviosions()){
			$this->supports[] = 'revisions';
		}
		if ($this->isSupportThumbnail()){
			$this->supports[] = 'thumbnail';
		}
		if ($this->isSupportTitle()){
			$this->supports[] = 'title';
		}
		if ($this->isSupportTrackbacks()){
			$this->supports[] = 'trackbacks';
		}
	}

	/**
	 * @return null
	 */
	public function getMenuPosition() {
		return $this->menu_position;
	}

	/**
	 * @param null $menu_position
	 */
	public function setMenuPosition( $menu_position ) {
		$this->menu_position = $menu_position;
	}

	/**
	 * @return boolean
	 */
	public function isPubliclyQueryable() {
		return $this->publicly_queryable;
	}

	/**
	 * @param boolean $publicly_queryable
	 */
	public function setPubliclyQueryable( $publicly_queryable ) {
		$this->publicly_queryable = $publicly_queryable;
	}

	/**
	 * @return boolean
	 */
	public function isShowInMenu() {
		return $this->show_in_menu;
	}

	/**
	 * @param boolean $show_in_menu
	 */
	public function setShowInMenu( $show_in_menu ) {
		$this->show_in_menu = $show_in_menu;
	}

	/**
	 * @return boolean
	 */
	public function isQueryVar() {
		return $this->query_var;
	}

	/**
	 * @param boolean $query_var
	 */
	public function setQueryVar( $query_var ) {
		$this->query_var = $query_var;
	}

	/**
	 * @return string
	 */
	public function getCapabilityType() {
		return $this->capability_type;
	}

	/**
	 * @param string $capability_type
	 */
	public function setCapabilityType( $capability_type ) {
		$this->capability_type = $capability_type;
	}

	/**
	 * @return boolean
	 */
	public function isHasArchive() {
		return $this->has_archive;
	}

	/**
	 * @param boolean $has_archive
	 */
	public function setHasArchive( $has_archive ) {
		$this->has_archive = $has_archive;
	}

	function getSlug() {
		return $this->slug;
	}

	/**
	 * @return mixed
	 */
	public function getRewriteSlug() {
		return $this->rewriteSlug;
	}

	/**
	 * @param mixed $rewriteSlug
	 */
	public function setRewriteSlug( $rewriteSlug ) {
		$this->rewriteSlug = $rewriteSlug;
	}

	/**
	 * @return boolean
	 */
	public function isRewriteWithFront() {
		return $this->rewriteWithFront;
	}

	/**
	 * @param boolean $rewriteWithFront
	 */
	public function setRewriteWithFront( $rewriteWithFront ) {
		$this->rewriteWithFront = $rewriteWithFront;
	}

	/**
	 * @return mixed
	 */
	public function getRewriteFeeds() {
		return $this->rewriteFeeds;
	}

	/**
	 * @param mixed $rewriteFeeds
	 */
	public function setRewriteFeeds( $rewriteFeeds ) {
		$this->rewriteFeeds = $rewriteFeeds;
	}

	/**
	 * @return mixed
	 */
	public function getRewritePages() {
		return $this->rewritePages;
	}

	public function isRewritePages(){
		return $this->rewritePages;
	}
	public function isRewriteFeeds(){
		return $this->rewriteFeeds;
	}
	/**
	 * @param mixed $rewritePages
	 */
	public function setRewritePages( $rewritePages ) {
		$this->rewritePages = $rewritePages;
	}

	/**
	 * @return mixed
	 * @throws ParametroNonSettatoException
	 */
	public function getPostTypeName() {
		if ($this->postTypeName) {
			return $this->postTypeName;
		}

		throw new ParametroNonSettatoException( 'postTypeName' );
	}

	/**
	 * @param mixed $postTypeName
	 */
	public function setPostTypeName( $postTypeName ) {
		$this->postTypeName = $postTypeName;
	}

	/**
	 * @return mixed
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param mixed $description
	 */
	public function setDescription( $description ) {
		$this->description = $description;
	}


	/**
	 * @return boolean
	 */
	public function isExcludeFromSearch() {
		return $this->excludeFromSearch;
	}

	/**
	 * @param boolean $excludeFromSearch
	 */
	public function setExcludeFromSearch( $excludeFromSearch ) {
		$this->excludeFromSearch = $excludeFromSearch;
	}

	/**
	 * @return boolean
	 */
	public function isShowInNavMenu() {
		return $this->showInNavMenu;
	}

	/**
	 * @param boolean $showInNavMenu
	 */
	public function setShowInNavMenu( $showInNavMenu ) {
		$this->showInNavMenu = $showInNavMenu;
	}

	/**
	 * @return boolean
	 */
	public function isShowInAdminBar() {
		return $this->showInAdminBar;
	}

	/**
	 * @param boolean $showInAdminBar
	 */
	public function setShowInAdminBar( $showInAdminBar ) {
		$this->showInAdminBar = $showInAdminBar;
	}

	/**
	 * @return null
	 */
	public function getMenuIcon() {
		return $this->menuIcon;
	}

	/**
	 * @param null $menuIcon
	 */
	public function setMenuIcon( $menuIcon ) {
		$this->menuIcon = $menuIcon;
	}

	/**
	 * @return null
	 */
	public function getMapMetaCap() {
		return $this->mapMetaCap;
	}

	/**
	 * @param null $mapMetaCap
	 */
	public function setMapMetaCap( $mapMetaCap ) {
		$this->mapMetaCap = $mapMetaCap;
	}

	/**
	 * @return null
	 */
	public function getTaxonomies() {
		return $this->taxonomies;
	}

	/**
	 * @param null $taxonomies
	 */
	public function setTaxonomies( $taxonomies ) {
		$this->taxonomies = $taxonomies;
	}

	/**
	 * @return mixed
	 */
	public function getQueryVar() {
		return $this->queryVar;
	}



	/**
	 * @return null
	 */
	public function getCanExport() {
		return $this->canExport;
	}

	/**
	 * @param null $canExport
	 */
	public function setCanExport( $canExport ) {
		$this->canExport = $canExport;
	}

    /**
     * @return bool
     */
    public function isShowInRest()
    {
        return $this->show_in_rest;
    }

    /**
     * @param bool $show_in_rest
     */
    public function setShowInRest($show_in_rest)
    {
        $this->show_in_rest = $show_in_rest;
    }

}