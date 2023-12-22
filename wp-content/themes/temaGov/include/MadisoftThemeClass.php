<?php

/**
 * Class MadisoftThemeClass
 */
class MadisoftThemeClass {
    var $global_vars = [ ];
    var $impostazioniClass;
    /**
     * MadisoftThemeClass constructor.
     * @throws MadisoftAssetRichiestaNonEsistenteException
     */
    public function __construct() {
        global $post;
        $this->creaCartelleCssCache();
        $this->autoIncludeException();
        $this->autoIncludeInterfaces();
        $this->autoIncludeBaseClass();
        $this->autoIncludeFiles( madisoft_scuola_get_assets_directory( 'class', false ) );
        $this->setImpostazioniClass();
    }

    /**
     * @throws MadisoftAssetRichiestaNonEsistenteException
     */
    function generaFunzioniTema() {
 	if (!is_admin())
        {
            $this->autoIncludeFiles( madisoft_scuola_get_assets_directory( 'functions-public', false ) );
        }
        $this->autoIncludeFiles( madisoft_scuola_get_assets_directory( 'functions', false ) );
       
        if (possoCaricareLeOpzioni()){
            $this->autoIncludeFiles( madisoft_scuola_get_assets_directory( 'impostazioni', false ) );
        }
        $this->autoIncludeFileInDir( get_template_directory() . '/include/plugins');
        $this->autoIncludeFiles( get_template_directory() . '/include/widgets/' );
        $this->autoIncludeFileInDir( get_template_directory() . '/include/post-type');
        add_theme_support( 'post-thumbnails' );
        $this->setOptionsThemeSettings();
    }

    /**
     * @param $nameDir
     * @param string $nomeFile
     * @throws MadisoftDipendenzaNonRisoltaException
     */
    public function includeVendorDir($nameDir, $nomeFile = 'index.php'){
        if (is_dir( get_template_directory() .'/vendor/' . $nameDir )){
            include(  get_template_directory() .'/vendor/' . $nameDir .'/' . $nomeFile );
        } else {
            throw new MadisoftDipendenzaNonRisoltaException( $nameDir . ' non trovato. Percorso aspettato: ' . get_template_directory() . '/vendor/' . $nameDir .'/' );
        }
    }

    /**
     * @param $includePath
     * @param bool $createClass
     */
    protected function autoIncludeFileInDir( $includePath, $createClass = false ) {
        if ( substr( $includePath, - 1 ) != DIRECTORY_SEPARATOR ) {
            $includePath .= DIRECTORY_SEPARATOR;
        }
        $directories = glob( $includePath . '*', GLOB_ONLYDIR );
        foreach ( $directories as $fileToCall ) {
            include_once $fileToCall . '/' . basename( $fileToCall ) . '.php';
            if (file_exists($fileToCall . '/impostazioni.php') && possoCaricareLeOpzioni()){
                include_once ($fileToCall . '/impostazioni.php');
            }
        }
    }

    /**
     * @param $includePath
     * @return bool
     */
    public function autoIncludeFiles( $includePath, $createClass = false ) {
        if ( substr( $includePath, - 1 ) != DIRECTORY_SEPARATOR ) {
            $includePath .= DIRECTORY_SEPARATOR;
        }
        $directories = glob( $includePath . '*' );
        foreach ( $directories as $fileToImport ) {
            include_once $fileToImport;
            if ( $createClass ) {
                $classFile = pathinfo( $fileToImport );
                $className = $classFile['filename'];
                if ( class_exists( $className ) ) {
                    new $className();
                }
            }
        }

        return true;
    }

    /**
     * @throws MadisoftAssetRichiestaNonEsistenteException
     */
    protected function autoIncludeInterfaces() {
        $includePath = madisoft_scuola_get_assets_directory( 'interfaces', false );
        $this->autoIncludeFiles( $includePath );
    }

    /**
     *
     */
    protected function autoIncludeBaseClass() {
        $includePath = get_template_directory() . '/include/baseImportClass/';
        $this->autoIncludeFiles( $includePath );
    }

    /**
     *
     */
    protected function autoIncludeException() {
        $includePath = get_template_directory() . '/include/exceptions/';
        $this->autoIncludeFiles( $includePath );
    }

    /**
     * @param $name
     * @param $var
     */
    public function addGlobalVar( $name, $var ) {
        $this->global_vars[ $name ] = $var;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getGlobalVar( $name, $default = '' ) {
        if (!isset($this->global_vars[ $name ])) {
            return $default;
        }
        return $this->global_vars[ $name ];
    }

    /**
     * @return bool
     */
    protected function setOptionsThemeSettings() {
//		/**
//		 * THEME OPTIONS
//		 */
//		add_filter( 'ot_show_pages', '__return_true' );
//		add_filter( 'ot_show_new_layout', '__return_false' );
//		add_filter('ot_theme_mode', '__return_true' );echo 'mmm';die;
//		load_template( trailingslashit( get_template_directory() ) . 'vendor/option-tree/ot-loader.php' );
        if (!is_admin()){
            return false;
        }
        load_template( trailingslashit( get_template_directory() ) . 'include/theme-options.php' );
        /**
         * THEME OPTIONS
         */
    }

    /**
     * @param      $value1
     * @param      $value2
     * @param bool $print
     *
     * @return bool|string
     */
    public function madisoft_theme_selected( $value1, $value2, $print = false ) {
        if ( $value1 == $value2 ) {
            $testo = ' selected="selected"';
        } else {
            $testo = "";
        }

        if ( $print ) {
            echo $testo;

            return true;
        }

        return $testo;
    }

    /**
     *
     */
    function creaCartelleCssCache(){
        creaCartellaSeNonEsiste( WP_CONTENT_DIR . DIRECTORY_SEPARATOR . 'csscache');
        creaCartellaSeNonEsiste( WP_CONTENT_DIR . DIRECTORY_SEPARATOR . 'csscache' . DIRECTORY_SEPARATOR . get_current_blog_id());
    }

    /**
     * @return MadisoftThemeOptionClass
     */
    public function getImpostazioniClass()
    {
        return $this->impostazioniClass;
    }

    /**
     * @param string $classe
     */
    public function setImpostazioniClass($classe = '')
    {
        if (!$classe){
            $this->impostazioniClass = new MadisoftThemeOptionClass();
        } else {
            $this->impostazioniClass = $classe;
        }
    }
}
