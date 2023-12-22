<?php

/**
 * Il file base di configurazione di WordPress.
 *
 * Questo file definisce le seguenti configurazioni: impostazioni MySQL,
 * Prefisso Tabella, Chiavi Segrete, Lingua di WordPress e ABSPATH.
 * E' possibile trovare ultetriori informazioni visitando la pagina: del
 * Codex {@link http://codex.wordpress.org/Editing_wp-config.php
 * Editing wp-config.php}. E' possibile ottenere le impostazioni per
 * MySQL dal proprio fornitore di hosting.
 *
 * Questo file viene utilizzato, durante l'installazione, dallo script
 * di creazione di wp-config.php. Non � necessario utilizzarlo solo via
 * web,� anche possibile copiare questo file in "wp-config.php" e
 * rimepire i valori corretti.
 *
 * @package WordPress
 */

// ** Impostazioni MySQL - E? possibile ottenere questoe informazioni
// ** dal proprio fornitore di hosting ** //
/** Il nome del database di WordPress */
define('DB_NAME', 'nuvolademo');

/** Nome utente del database MySQL */
define('DB_USER', 'nuvolademo');

/** Password del database MySQL */
#define('DB_PASSWORD', 'nuvolademo2014');
define('DB_PASSWORD', trim(file("/var/www/passwd_wp")[0]));

/** Hostname MySQL  */
#define('DB_HOST', 'localhost');
define('DB_HOST', 'siti-scuole.cvwtdq1bt03j.eu-west-1.rds.amazonaws.com');

/** Charset del Database da utilizare nella creazione delle tabelle. */
define('DB_CHARSET', 'utf8');

/** Il tipo di Collazione del Database. Da non modificare se non si ha
idea di cosa sia. */
define('DB_COLLATE', '');

/**#@+
 * Chiavi Univoche di Autenticazione e di Salatura.
 *
 * Modificarle con frasi univoche differenti!
 * E' possibile generare tali chiavi utilizzando {@link https://api.wordpress.org/secret-key/1.1/salt/ servizio di chiavi-segrete di WordPress.org}
 * E' possibile cambiare queste chiavi in qualsiasi momento, per invalidare tuttii cookie esistenti. Ci� forzer� tutti gli utenti ad effettuare nuovamente il login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'b$a.;IOdrAi6lsXi^IU8DIY!8AN({5B+5UW/ppc%(#T2(+TDixOz@0~Wds-p-rw4');
define('SECURE_AUTH_KEY',  'FnPmO1RPHWat*[zYs3ZJ*U`7a!X8ctf}x59FeM9--ZK<)G2]$0Dae& z94+,|bMF');
define('LOGGED_IN_KEY',    'a]dl#E3YsA}/H!PB:LEwLh;/vY{<jF}~et@0.x^VU`QO^Lw9UYN4%YL&w5>D[=PO');
define('NONCE_KEY',        'VhOi_ZW+ABYjTYH3K3t[UeAG%~l<Ds>-b([><-kJj|_BWv3-9GxX,|[#F_kR+|q[');
define('AUTH_SALT',        '0j:q:@Ap&+1zdJ~-4Wd/V.0BgkYw4,E)(jzEJF93n7sB~ B=:R}c}yd-&OvgAFCF');
define('SECURE_AUTH_SALT', '(MEPI^F:LzoQ@U$|F.Q9p|!p2QFK-Bl&TVq-UY&& #.Z_^HPsj@=Mc;`8Hwid|tB');
define('LOGGED_IN_SALT',   'UPE4[+19<-$GgUw-fPqJTTA-rR?:|Non ,J^/A>H4q!YZl~{xXbX+r7,pE=>wmvZ');
define('NONCE_SALT',       '%G)VNl[_+&.+Zij{[y*kf+0H_1t*s9J?!E$zBd[_/G;?/Dmmy[ ;wFuK$Rg/Kr]a');

/**#@-*/

/**
 * Prefisso Tabella del Database WordPress .
 *
 * E' possibile avere installazioni multiple su di un unico database if you give each a unique
 * fornendo a ciascuna installazione un prefisso univoco.
 * Solo numeri, lettere e sottolineatura!
 */
$table_prefix  = 'wp_';

/**
 * Lingua di Localizzazione di WordPress, di base Inglese.
 *
 * Modificare questa voce per localizzare WordPress. Occorre che nella cartella
 * wp-content/languages sia installato un file MO corrispondente alla lingua
 * selezionata. Ad esempio, installare de_DE.mo in to wp-content/languages ed
 * impostare WPLANG a 'de_DE' per abilitare il supporto alla lingua tedesca.
 *
 * Tale valore � gi� impostato per la lingua italiana
 */
define('WPLANG', 'it_IT');

/**
 * Per gli sviluppatori: modalit� di debug di WordPress.
 *
 * Modificare questa voce a TRUE per abilitare la visualizzazione degli avvisi
 * durante lo sviluppo.
 * E' fortemente raccomandato agli svilupaptori di temi e plugin di utilizare
 * WP_DEBUG all'interno dei loro ambienti di sviluppo.
 
 ?debugM=true&mad_debug=dbgtrue
 */
if ( isset($_GET['debugM']) && $_GET['mad_debug'] == 'dbgtrue'){
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors','On');
	 define('WP_DEBUG', true);
} else {    
    define( 'WP_DEBUG', false );
}
    define( 'WP_DEBUG_DISPLAY', false );
    define ( 'WP_DEBUG_LOG', false );


    define( 'WP_AUTO_UPDATE_CORE', false );

/*
* WP MULTISIT
* WP MULTISITEE
**/
define('WP_ALLOW_MULTISITE', true);
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', true);
define('DOMAIN_CURRENT_SITE', 'scuoletest.madisoft.it');
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);

/** Define WordPress.com API Key */
define('WPCOM_API_KEY','87ada819af5c');
/* Breadcumb NAV XT */
define('BCN_SETTINGS_USE_NETWORK', true);


define( 'DISALLOW_FILE_EDIT', false );
/* Finito, interrompere le modifiche! Buon blogging. */

/** Path assoluto alla directory di WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** server per wp-mu-domain-mapping **/
define( 'SUNRISE', 'on' );

/* include i file. */
require_once(ABSPATH . 'wp-settings.php');
