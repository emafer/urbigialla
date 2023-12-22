<?php


/**
 * Applica i campi di stampa unione al testo passato nella variabile the_content
 * @param $the_content
 */
function madisoft_scuola_sotituisci_dati_istituto( $the_content, $daticompleti = false ) {
	/**
	 * la struttura dei campi stampa &egrave; $base-campo$ (ae $istituto-nome$)
	 * viene richiamata la funzione sostituisci_base (ae sostituisci_istituto(nome))
	 * questo per eventualmente gestire sostituzioni successive
	 */
	preg_match_all( '/(?<=\$)[a-zA-Z]*-[a-zA-Z]*(?=\$)/', $the_content, $match );

	foreach ( $match[0] as $find ) {
		list( $base, $campo ) = explode( '-', $find );
			$newText = sostituisci_campo( $campo, $daticompleti );
				$the_content = str_replace( '$' . $find . '$', $newText, $the_content );

	}

	return $the_content;
}

/**
 * la funzione matcha il campo passato se tra i campi possibili richiama la funzione per avere il dato
 * in caso contrario ritorna una stringa vuota
 * @param $campo
 * @param bool $daticompleti
 * @return string
 */
function sostituisci_campo( $campo, $daticompleti = true ) {
    /** @var  $datiClasse MadisoftDatiIstituto */
    $datiClasse = madisoft_get_theme_class()->getGlobalVar('datiIstitutoClass');
	switch ( $campo ) {
		case 'codiceMeccanografico':
			return $datiClasse->getCodiceMeccanografico($daticompleti);
			break;
		case 'codiceIpa':
			return $datiClasse->getCodiceIpa($daticompleti);
			break;
		case 'codiceFatturazione':
			return $datiClasse->getCodiceFatturazione($daticompleti);
			break;
		case 'codiceFiscale':
			return $datiClasse->getCodiceFiscale($daticompleti);
			break;
		case 'comune':
			return $datiClasse->getComune();
			break;
		case 'dirigente':
			return $datiClasse->getDs();
			break;
		case 'dsga':
			return $datiClasse->getDsga();
			break;
		case 'email':
			return $datiClasse->printEmail('email', $daticompleti );
			break;
		case 'telefono':
			return $datiClasse->printTelefono( 'tel', $daticompleti );
			break;
		case 'fax':
			return $datiClasse->printTelefono( 'fax', $daticompleti );
			break;
		case 'indirizzo':
			return $datiClasse->getIndirizzo();
			break;
		case 'indirizzoCompleto':
			return $datiClasse->getIndirizzoPerMappa();
			break;
		case 'nome':
			return $datiClasse->getNome();
			break;
		case 'pec':
            return $datiClasse->printEmail('pec', $daticompleti );
			break;
		case 'cap':
			return $datiClasse->getCap();
			break;
		case 'provincia':
			return $datiClasse->getProvincia($daticompleti);
			break;
		case 'pof':
			return $datiClasse->getPof();
		case 'ptof':
			return $datiClasse->getPtof();
		case 'calendarioScolastico':
			return $datiClasse->getCalendario();
		case 'foto':
			return $datiClasse->printImmagine();
		case 'iban':
			return $datiClasse->printIban();
		default:
			return '';
			break;
	}
}

add_filter( 'the_content', 'madisoft_scuola_sotituisci_dati_istituto', 5 );
add_filter( 'the_title', 'madisoft_scuola_sotituisci_dati_istituto', 5 );
