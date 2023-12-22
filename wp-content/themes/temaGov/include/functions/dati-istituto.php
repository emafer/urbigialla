<?php

function madisoft_scuola_check_presenza_dati() {
    /** @var  $datiClasse MadisoftDatiIstituto */
    $datiClasse = madisoft_get_theme_class()->getGlobalVar('datiIstitutoClass');

	if ( current_user_can( 'madisoft_manage_options' ) ) {
		$erroreDati = 0;
		if ( $datiClasse->getNome() == '' ) {
			$erroreDati ++;
		}
		if ( $datiClasse->getIndirizzo() == '' ) {
			$erroreDati ++;
		}
		if ( $datiClasse->getComune() == '' ) {
			$erroreDati ++;
		}
		if ( $datiClasse->getCap() == '' ) {
			$erroreDati ++;
		}
		if ( $datiClasse->getProvincia() == '' ) {
			$erroreDati ++;
		}
		if ( $datiClasse->getCodiceMeccanografico() == '' ) {
			$erroreDati ++;
		}
		if ( $datiClasse->getCodiceFatturazione() == '' ) {
			$erroreDati ++;
		}
		if ( $datiClasse->getTelefono() == '' ) {
			$erroreDati ++;
		}
		if ( $datiClasse->getEmail() == '' ) {
			$erroreDati ++;
		}
		if ( $datiClasse->getPec() == '' ) {
			$erroreDati ++;
		}
		if ( $datiClasse->getCodiceFiscale() == '' ) {
			$erroreDati ++;
		}

		if ( $erroreDati > 0 ) {
			echo $txt = '<div class="error"><p><strong>Attenzione: Mancano alcuni dati dell\'Istituto</strong>'
					. '<br/>Inseriscili per usare al meglio il tuo sito Web: Vai alla <a href="' . home_url() . '/wp-admin/themes.php?page=ot-theme-options&settings-updated=true#section_madisoft_scuola_istituto_dati">pagina delle impostazioni del tuo tema</a>!'
					. '</p></div>';
		}
	}
}

add_action( 'admin_notices', 'madisoft_scuola_check_presenza_dati' );

class MadisoftDatiIstituto{

    protected $codiceIpa;
    protected $codiceMeccanografico;
    protected $fax;
    protected $telefono;
    protected $dsga;
    protected $ds;
    protected $codiceFatturazione;
    protected $codiceFiscale;
    protected $indirizzo;
    protected $comune;
    protected $cap;
    protected $provincia;
    protected $email;
    protected $pec;
    protected $pof;
    protected $ptof;
    protected $calendario;
    protected $immagine;
    protected $nome;
    protected $iban;

    /**
     * @return mixed
     */
    public function getNome()
    {
        if (!$this->nome){
            $this->setNome();
        }
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome()
    {
        $this->nome = madisoft_get_theme_option( 'madisoft_scuola_istituto_nome', '' );
    }

    /**
     * @return mixed
     */
    public function getCodiceIpa($datiCompleti = false)
    {
        if(!$this->codiceIpa){
            $this->setCodiceIpa();
        }
        if ($datiCompleti && $this->codiceIpa){
            return 'Codice <abbr title="Indice Pubbliche Amministrazione">IPA</abbr>: ' . $this->codiceIpa;
        }
        return $this->codiceIpa;
    }

    /**
     * @param mixed $codiceIpa
     */
    public function setCodiceIpa()
    {
        $this->codiceIpa = madisoft_get_theme_option( 'madisoft_scuola_istituto_codice_ipa', '' );
    }

    /**
     * @return mixed
     */
    public function getCodiceMeccanografico($daticompleti = false)
    {
        if(!$this->codiceMeccanografico){
            $this->setCodiceMeccanografico();
        }
        if ($daticompleti && $this->codiceMeccanografico){
            return '<abbr title="Codice Meccanografico">Cod. Mecc.</abbr>: ' . $this->codiceMeccanografico;
        }

        return $this->codiceMeccanografico;
    }

    /**
     * @param mixed $codiceMeccanografico
     */
    public function setCodiceMeccanografico()
    {
        $this->codiceMeccanografico = madisoft_get_theme_option( 'madisoft_scuola_istituto_codice_meccanografico', '' );
        }

    /**
     * @return mixed
     */
    public function getFax()
    {
        if(!$this->fax){
            $this->setFax();
        }
        return $this->fax;
    }

    /**
     * @param mixed $fax
     */
    public function setFax()
    {
        $this->fax = madisoft_get_theme_option( 'madisoft_scuola_istituto_fax', '' );;
    }

    /**
     * @return mixed
     */
    public function getTelefono()
    {
        if(!$this->telefono){
            $this->setTelefono();
        }
        return $this->telefono;
    }

    /**
     *
     */
    public function setTelefono()
    {
        $this->telefono = madisoft_get_theme_option( 'madisoft_scuola_istituto_telefono', '' );
    }

    /**
     * @return mixed
     */
    public function getDsga()
    {
        if( !$this->dsga ){
            $this->setDsga();
        }
        return $this->dsga;
    }

    /**
     * @param mixed $dsga
     */
    public function setDsga()
    {
        $this->dsga = madisoft_get_theme_option( 'madisoft_scuola_istituto_dsga', '' );;
    }
    /**
     * @return mixed
     */
    public function getDs()
    {
        if (!$this->ds){
            $this->setDs();
        }
        return $this->ds;
    }

    /**
     * @param mixed $dsga
     */
    public function setDs()
    {
        $this->ds = madisoft_get_theme_option( 'madisoft_scuola_istituto_dirigente', '' );
    }

    /**
     * @return mixed
     */
    public function getCodiceFatturazione($datiCompleti = false)
    {
        if(!$this->codiceFatturazione){
            $this->setCodiceFatturazione();
        }
        if ($this->codiceFatturazione && $datiCompleti){
            return '<abbr title="Codice">Cod.</abbr> Fatturazione: ' . $this->codiceFatturazione;
        }
        return $this->codiceFatturazione;
    }

    /**
     * @param mixed $codiceFatturazione
     */
    public function setCodiceFatturazione()
    {
        $this->codiceFatturazione = madisoft_get_theme_option( 'madisoft_scuola_istituto_codice_fatturazione', '' );
    }

    /**
     * @return mixed
     */
    public function getCodiceFiscale($datiCompleti = false)
    {
        if(!$this->codiceFiscale){
            $this->setCodiceFiscale();
        }
        if ($this->codiceFiscale && $datiCompleti){
            return '<abbr title="Codice Fiscale">Cod. Fisc.:</abbr>' . $this->codiceFiscale;
        }
        return $this->codiceFiscale;
    }

    /**
     * @param mixed $codiceFiscale
     */
    public function setCodiceFiscale()
    {
        $this->codiceFiscale = madisoft_get_theme_option( 'madisoft_scuola_istituto_codice_fiscale', '' );
    }

    /**
     * @return mixed
     */
    public function getIndirizzo()
    {
        if(!$this->indirizzo){
            $this->setIndirizzo();
        }
        return $this->indirizzo;
    }

    /**
     * @param mixed $indirizzo
     */
    public function setIndirizzo()
    {
        $this->indirizzo = madisoft_get_theme_option( 'madisoft_scuola_istituto_indirizzo', '' );
    }

    /**
     * @return mixed
     */
    public function getComune()
    {
        if (!$this->comune){
            $this->setComune();
        }
        return $this->comune;
    }

    /**
     * @param mixed $comune
     */
    public function setComune()
    {
        $this->comune = madisoft_get_theme_option( 'madisoft_scuola_istituto_comune', '' );
    }

    /**
     * @return mixed
     */
    public function getCap()
    {
        if(!$this->cap){
            $this->setCap();
        }
        return $this->cap;
    }

    /**
     * @param mixed $cap
     */
    public function setCap()
    {
        $this->cap = madisoft_get_theme_option( 'madisoft_scuola_istituto_cap', '' );
    }

    /**
     * @return mixed
     */
    public function getProvincia($daticompleti = false)
    {
        if(!$this->provincia){
            $this->setProvincia();
        }
        if ($daticompleti){
            return '(' . $this->provincia . ')';
        }
        return $this->provincia;
    }

    /**
     * @param mixed $provincia
     */
    public function setProvincia()
    {
        $this->provincia = madisoft_get_theme_option( 'madisoft_scuola_istituto_provincia', '' );
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        if(!$this->email){
            $this->setEmail();
        }
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail()
    {
        $this->email = madisoft_get_theme_option( 'madisoft_scuola_istituto_email', '' );
    }

    /**
     * @return mixed
     */
    public function getPec()
    {
        if(!$this->pec){
            $this->setPec();
        }
        return $this->pec;
    }

    /**
     * @param mixed $pec
     */
    public function setPec()
    {
        $this->pec = madisoft_get_theme_option( 'madisoft_scuola_istituto_pec', '' );
    }

    /**
     * @return mixed
     */
    public function getPof()
    {
        if( !$this->pof){
            $this->setPof();
        }
        return $this->pof;
    }

    /**
     * @param mixed $pof
     */
    public function setPof()
    {
        $pof = madisoft_get_theme_option( 'madisoft_scuola_dati_pof', '' );

        if ( $pof ) {
            $this->pof =  '<a class="linkMadisoft" href="' . $pof . '"><strong>Clicca qui per scaricare il POF</strong><a>';
        }
    }

    /**
     * @return mixed
     */
    public function getCalendario()
    {
        if(!$this->calendario){
            $this->setCalendario();
        }
        return $this->calendario;
    }

    /**
     * @param mixed $calendario
     */
    public function setCalendario()
    {
        $calendarioFile = madisoft_get_theme_option( 'madisoft_scuola_dati_calendario', '' );
        if ( $calendarioFile ) {
            $this->calendario = '<a class="linkMadisoft" href="' . $calendarioFile . '"><strong>Clicca qui per scaricare il Calendario Scolastico</strong><a>';
        }
    }

    /**
     * @return mixed
     */
    public function getImmagine()
    {
        if (!$this->immagine){
            $this->setImmagine();
        }
        return $this->immagine;
    }

    /**
     * @param mixed $immagine
     */
    public function setImmagine()
    {
        $this->immagine = madisoft_get_theme_option( 'madisoft_scuola_dati_foto', '' );
    }

    public function printImmagine(){
        if($this->getImmagine()){
            return '<img src="' . $this->getImmagine() . '" style="max-width: 100%; height: auto;" alt="' . $this->getNome() .'"/>';
        }
    }

    /**
     * @return mixed
     */
    public function getIban()
    {
        if (!$this->iban){
            $this->setIban();
        }

        return $this->iban;
    }

    public function setIban()
    {
        $this->iban = madisoft_get_theme_option( 'madisoft_scuola_istituto_iban', '' );
    }



    /**
     * @return mixed
     */
    public function getPtof()
    {
        if( !$this->ptof){
            $this->setPtof();
        }
        return $this->ptof;
    }

    /**
     *
     */
    public function setPtof()
    {
        $ptof = madisoft_get_theme_option( 'madisoft_scuola_dati_ptof', '' );

        if ( $ptof ) {
            $this->ptof =  '<a class="linkMadisoft" href="' . $ptof . '"><strong>Clicca qui per scaricare il PTOF</strong><a>';
        }
    }

    public function printEmail($tipo, $datiCompleti = true){
        switch ($tipo){
            case 'email':
                $val  = $this->getEmail();
                $txt     = 'E-mail: ';
                break;
            case 'pec':
                $val  = $this->getPec();
                $txt     = 'P.E.C.: ';
                break;
            default:
                throw new MadisoftAssetRichiestaNonEsistenteException('errore');
                break;
        }
        $text = '';
        if ($datiCompleti){
            $text  .= '<abbr title="' . $txt . '">' . $txt . '</abbr> ';
        }
        $i    = 0;
        foreach ( explode( ';', $val ) as $email ) {
            if ( $i > 0 ) {
                if ( ! $datiCompleti ) {
                    break;
                }
                $text .= ' - ';
            }
            $i ++;
            $text .= '<a href="mailto:' . trim( $email ) . '" target="_blank">' . trim( $email ) . '</a>';
        }

        return $text;
    }

    public function printTelefono($tipo, $datiCompleti = false){
        switch ($tipo){
            case 'tel':
                $val  = $this->getTelefono();
                $abbr = 'Tel: ';
                $nonAbbr = 'Telefono';
                break;
            case 'fax':
                $val  = $this->getFax();
                $abbr    = 'Fax.';
                $nonAbbr = 'Fax';
                break;
            default:
                throw new MadisoftAssetRichiestaNonEsistenteException('errore');
                break;
        }

        if ( ! $val ) {
            return '';
        }
        $text = '';
        if ($datiCompleti){
            $text  .= '<abbr title="' . $nonAbbr . '">' . $abbr . '</abbr> ';
        }
        $array = explode( ';', $val );
        $i     = 0;
        foreach ( $array as $tel ) {
            if ( $i > 0 ) {
                if ( ! $datiCompleti ) {
                    break;
                }
                $text .= ' - ';
            }
            $text .=  trim( $tel ) ;
            $i ++;
        }

        return $text;
    }

    public function getIndirizzoPerMappa(){
        return $this->getIndirizzo()." - ".
            $this->getComune() ." ". $this->getCap() . " ". $this->getProvincia();
    }

    public function controllaPresenzaDati(){

    }

    public function printIban(){
        if ($this->getIban()){
            return '<em>IBAN:</em> ' . $this->getIban();
        }

        return '';
    }



    /**
     * Estrai i dati dell'istituto inseriti nelle opzioni del tema
     *
     * @param string $text
     *
     * @return string
     */
    function getDatiPerTestata( $text = '' ) {

        if ( empty( $text ) ) {
            $text  = '<strong>$istituto-nome$</strong> - $istituto-indirizzo$, $istituto-comune$ - $istituto-cap$ $istituto-provincia$<br/>';
            $text .= '$istituto-codiceMeccanografico$ - $istituto-codiceFiscale$ - $istituto-codiceFatturazione$ - $istituto-codiceIpa$ $istituto-iban$<br/>';
            $text .= '$istituto-telefono$ - $istituto-fax$ - $istituto-email$ - $istituto-pec$ ';
        }
        $text = madisoft_scuola_sotituisci_dati_istituto( $text, true );
        return $text;
    }

    /**
     * Estrai i dati dell'istituto inseriti nelle opzioni del tema
     *
     * @param string $text
     *
     * @return string
     */
    function getDatiPerFooter( $text = '' ) {

        if ( madisoft_get_theme_option( 'madisoft_scuola_pie_di_pagina_mostra_dati_istituto', 'off' ) == 'on' ) {
            $text = madisoft_get_theme_option('madisoft_scuola_pie_di_pagina_testo_per_dati_istituto', '');
        }
        if ( empty( $text ) ) {
            $text  = '<strong>$istituto-nome$</strong> <br/> $istituto-indirizzo$, $istituto-cap$ - $istituto-comune$ $istituto-provincia$<br/>';
            $text .= '$istituto-telefono$ <br/>$istituto-fax$ <br/>$istituto-email$<br/>$istituto-pec$<br/>$istituto-iban$';
        }
        $text = madisoft_scuola_sotituisci_dati_istituto( $text, true );
        return $text;
    }

}

$datiIstitutoClass = new MadisoftDatiIstituto();
madisoft_get_theme_class()->addGlobalVar('datiIstitutoClass', $datiIstitutoClass);
