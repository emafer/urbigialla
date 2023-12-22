<?php

class MadisoftScuolaWidth {
    const MADISOFT_WIDTH_ALL = 24;
    const MADISOFT_WIDTH_1_12 = 2;
    const MADISOFT_WIDTH_1_6 = 4;
    const MADISOFT_WIDTH_1_4 = 6;
    const MADISOFT_WIDTH_1_3 = 8;
    const MADISOFT_WIDTH_1_8 = 3;
    const MADISOFT_WIDTH_5_12 = 10;
    const MADISOFT_WIDTH_1_2 = 12;
    const MADISOFT_WIDTH_2_3 = 16;
    const MADISOFT_WIDTH_3_4 = 18;
    const MADISOFT_WIDTH_5_6 = 20;
	protected $larghezzaSidebarLeft = 0;
	protected $larghezzaContent = self::MADISOFT_WIDTH_ALL - 2;
	protected $larghezzaSidebarRight = 0;
	protected $plusContent = 0;

	protected $colonne = '3';

	protected $larghezzaLogoHeader = 0;
	protected $larghezzaTextHeader = self::MADISOFT_WIDTH_2_3;
	protected $larghezzaTextSidebar = 0;

	protected $larghezzaTopSidebar = 0;
	protected $larghezzaSlideHeader = self::MADISOFT_WIDTH_3_4;

	protected $plusTextHeader = 0;
	protected $plusSlideHeader = 0;

    /**
     * MadisoftScuolaWidth constructor.
     * @throws MadisoftAssetRichiestaNonEsistenteException
     */
	function __construct(){
		$this->calcolaLarghezzeHeader();
	}

    /**
     * @throws MadisoftAssetRichiestaNonEsistenteException
     */
	protected function calcolaLarghezzeHeader(){
	    $this->setLarghezzaTextHeader(self::MADISOFT_WIDTH_ALL);
		if ( madisoft_get_theme_option( 'madisoft_scuola_dati_mostra_logo', 'off') == 'on'
        && madisoft_get_theme_option( 'madisoft_scuola_dati_logo' , '') != ''){
		    $larghezzaLogo = madisoft_get_theme_option('madisoft_scuola_dati_logo_larghezza', self::MADISOFT_WIDTH_1_6);
			$this->setLarghezzaLogoHeader($larghezzaLogo);
			$this->setLarghezzaTextHeader(self::MADISOFT_WIDTH_ALL - $larghezzaLogo);
		}

		if ( madisoft_get_theme_option( 'madisoft_scuola_dati_istituto_sidebar', 'off') == 'on'){
			$this->setLarghezzaTextSidebar(self::MADISOFT_WIDTH_1_6);
            $this->setLarghezzaTextHeader($this->getLarghezzaTextHeader() - self::MADISOFT_WIDTH_1_6);
		}
		if ( is_active_sidebar( 'sidebar-testata' ) && madisoft_get_theme_option( 'madisoft_scuola_testata_separata' , 'off') == 'on' ){
			$this->setLarghezzaTopSidebar(self::MADISOFT_WIDTH_1_4);
		} else {
			$this->sumPlusSlideHeader(self::MADISOFT_WIDTH_1_4);
		}

		$this->setLarghezzaSlideHeader( $this->getLarghezzaSlideHeader() + $this->getPlusSlideHeader() );

	}

    /**
     * @throws MadisoftAssetRichiestaNonEsistenteException
     */
	public function calolaLarghezzaContent(){
        $strutturaColonne = madisoft_get_theme_option('madisoft_scuola_layout_struttura_colonne', '3');
        $metaValueStruttura = false;
        if ( is_page() && !is_404() ) {
            //controllo il template preesistente
            aggiornaValoreTemplate();
            $metaValueStruttura = madisoftThemePluginOpzioniPagine::getValueOfOption('page_struttura_colonne', $strutturaColonne, true);
            }

        if( is_archive() || is_category()){
            $metaValueStruttura = madisoft_get_theme_option('madisoft_scuola_layout_struttura_colonne_archive', $strutturaColonne);
        }


        if( is_single()){
            $metaValueStruttura = madisoft_get_theme_option('madisoft_scuola_layout_struttura_colonne_post', $strutturaColonne);
        }

        if($metaValueStruttura) {
           $strutturaColonne = $metaValueStruttura;
        }

        $this->setColonne( $strutturaColonne );
        switch ($this->getColonne()){
            case '3':
                $this->settaLarghezzaBarra( 'sidebar-1' );
                $this->settaLarghezzaBarra( 'sidebar-2' );
                break;
            case '2l':
                $this->settaLarghezzaBarra( 'sidebar-1' );
                break;
            case '2r':
                $this->settaLarghezzaBarra( 'sidebar-2' );
                break;
            case '1':
                break;
        }
        $this->setLarghezzaContent( $this->getLarghezzaContent() );
    }

	/**
	 * @return string
	 */
	protected function getColonne() {
		return $this->colonne;
	}

	/**
	 * @param string $colonne
	 */
	protected function setColonne( $colonne ) {
		$this->colonne = $colonne;
	}

	/**
	 * @return int
	 */
	public function getLarghezzaSidebarLeft() {
		return $this->larghezzaSidebarLeft;
	}

	/**
	 * @param int $larghezzaSidebarLeft
	 */
	protected function setLarghezzaSidebarLeft( $larghezzaSidebarLeft ) {
		$this->larghezzaSidebarLeft = $larghezzaSidebarLeft;
	}

	/**
	 * @return int
	 */
	public function getLarghezzaContent() {
		return $this->larghezzaContent;
	}

	/**
	 * @param int $larghezzaContent
	 */
	protected function setLarghezzaContent( $larghezzaContent ) {
		$this->larghezzaContent = $larghezzaContent;
	}
	/**
	 * @param int $larghezza
	 */
	protected function diminuisciLarghezzaContent( $larghezza ) {
		$this->larghezzaContent = $this->getLarghezzaContent() - $larghezza;
	}

	/**
	 * @return int
	 */
	public function getLarghezzaSidebarRight() {
		return $this->larghezzaSidebarRight;
	}

	/**
	 * @param int $larghezzaSidebarRight
	 */
	public function setLarghezzaSidebarRight( $larghezzaSidebarRight ) {
		$this->larghezzaSidebarRight = $larghezzaSidebarRight;
	}

	/**
	 * @return int
	 */
	protected function getPlusContent() {
		return $this->plusContent;
	}
	/**
	 * @param int $plusContent
	 */
	protected function setPlusContent( $plusContent ) {
		$this->plusContent = $plusContent;
	}

    /**
     * @param $barra
     *
     * @throws MadisoftAssetRichiestaNonEsistenteException
     */
	protected function settaLarghezzaBarra( $barra ) {
	    if ( is_active_sidebar( $barra ) ) {
			if ($barra == 'sidebar-1' ) {
			    $larghezzaSx = madisoft_get_theme_option('larghezza_colonna_sinistra', self::MADISOFT_WIDTH_1_6);
				$this->setLarghezzaSidebarLeft($larghezzaSx);
				$this->diminuisciLarghezzaContent($larghezzaSx);
			} else {
			    $larghezzaDx = madisoft_get_theme_option('larghezza_colonna_destra', self::MADISOFT_WIDTH_1_6);
				$this->setLarghezzaSidebarRight( $larghezzaDx);
				$this->diminuisciLarghezzaContent($larghezzaDx);
			}
		}
	}



	/**
	 * @return int
	 */
	public function getLarghezzaLogoHeader() {
		return $this->larghezzaLogoHeader;
	}

	/**
	 * @param int $larghezzaLogoHeader
	 */
	protected function setLarghezzaLogoHeader( $larghezzaLogoHeader ) {
		$this->larghezzaLogoHeader = $larghezzaLogoHeader;
	}

	/**
	 * @return int
	 */
	public function getLarghezzaTextHeader() {
		return $this->larghezzaTextHeader;
	}

	/**
	 * @param int $larghezzaTextHeader
	 */
	protected function setLarghezzaTextHeader( $larghezzaTextHeader ) {
		$this->larghezzaTextHeader = $larghezzaTextHeader;
	}

    /**
     * @return int
     */
    public function getLarghezzaSlideHeader() {
        return $this->larghezzaSlideHeader;
    }
	/**
	 * @param int $larghezzaSlideHeader
	 */
	protected function setLarghezzaSlideHeader( $larghezzaSlideHeader ) {
		$this->larghezzaSlideHeader = $larghezzaSlideHeader;
	}

	/**
	 * @return int
	 */
	public function getLarghezzaTopSidebar() {
		return $this->larghezzaTopSidebar;
	}

	/**
	 * @param int $larghezzaTopSidebar
	 */
	protected function setLarghezzaTopSidebar( $larghezzaTopSidebar ) {
		$this->larghezzaTopSidebar = $larghezzaTopSidebar;
	}

	/**
	 * @return int
	 */
	public function getPlusTextHeader() {
		return $this->plusTextHeader;
	}

	/**
	 * @param int $plusTextHeader
	 */
	protected function setPlusTextHeader( $plusTextHeader ) {
		$this->plusTextHeader = $plusTextHeader;
	}

    /**
     * @return int
     */
    public function getPlusSlideHeader ()
    {
        return $this->plusSlideHeader;
    }

    /**
     * @param int $plusSlideHeader
     */
    public function setPlusSlideHeader ($plusSlideHeader)
    {
        $this->plusSlideHeader = $plusSlideHeader;
    }

	protected function sumPlusHeader($int){
		$this->setPlusTextHeader($this->getPlusTextHeader() + $int );
	}

	protected function sumPlusSlideHeader($int){
		$this->setPlusSlideHeader($this->getPlusSlideHeader() + $int );
	}

    /**
     * @return int
     */
    public function getLarghezzaTextSidebar()
    {
        return $this->larghezzaTextSidebar;
    }

    /**
     * @param int $larghezzaTextSidebar
     */
    public function setLarghezzaTextSidebar($larghezzaTextSidebar)
    {
        $this->larghezzaTextSidebar = $larghezzaTextSidebar;
    }
}