<?php
/**
 * Il file base di configurazione di WordPress.
 *
 * Questo file viene utilizzato, durante l’installazione, dallo script
 * di creazione di wp-config.php. Non è necessario utilizzarlo solo via web
 * puoi copiare questo file in «wp-config.php» e riempire i valori corretti.
 *
 * Questo file definisce le seguenti configurazioni:
 *
 * * Impostazioni database
 * * Chiavi Segrete
 * * Prefisso Tabella
 * * ABSPATH
 *
 * * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Impostazioni database - È possibile ottenere queste informazioni dal proprio fornitore di hosting ** //
/** Il nome del database di WordPress */
define( 'DB_NAME', 'urbigialla' );

/** Nome utente del database */
define( 'DB_USER', 'root' );

/** Password del database */
define( 'DB_PASSWORD', 'St2018oucs$' );

/** Hostname del database */
define( 'DB_HOST', 'localhost' );

/** Charset del Database da utilizzare nella creazione delle tabelle. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Il tipo di Collazione del Database. Da non modificare se non si ha idea di cosa sia. */
define('DB_COLLATE', '');

/**#@+
 * Chiavi Univoche di Autenticazione e di Salatura.
 *
 * Modificarle con frasi univoche differenti!
 * È possibile generare tali chiavi utilizzando {@link https://api.wordpress.org/secret-key/1.1/salt/ servizio di chiavi-segrete di WordPress.org}
 * È possibile cambiare queste chiavi in qualsiasi momento, per invalidare tuttii cookie esistenti. Ciò forzerà tutti gli utenti ad effettuare nuovamente il login.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '8*8}Dlk{N}#m.)Z-]}!q?>rR ,**F|(w@)(&5VSKz*h]=7<Zl;l(S}&d]Q&Bwg98' );
define( 'SECURE_AUTH_KEY',  'N^jzL!DejP4=w#[W*K10yrD`#5v-]Si]FuG2^|Nx27a$D<7Iiq>j;kwZC+Wfb#Vk' );
define( 'LOGGED_IN_KEY',    '7F)xr%]3G55cYn_9)SN`]xi0i,.qKiz!ja5fa&JUG>x*yx.vF@:g1@r/=O7&pBuU' );
define( 'NONCE_KEY',        'nV:$u-]-jg9TY=MH2A}8M,g s8S.#EE_ILcmJ!%Wa>>!A`x?~HD_6pUQ7zZ39>Ey' );
define( 'AUTH_SALT',        '6Ql#$ptxV~>Ue8{3-~&ubta(wRJ 4T{w,c:4^UW{2fcf{b:ykdfV_:fQ/P|o7jPP' );
define( 'SECURE_AUTH_SALT', 'v[yl^)Un.i)E<[X?P4a+UF`v$dYdEt4QxBBU}.DjI-`ttsZc8sqR/=2${pG~K+&G' );
define( 'LOGGED_IN_SALT',   '=$A4_<75)M|Dx(- 2Dl2Bo$bDd/^bI+ekfekd[!?p}XgA#D6;97N&q+qy/J>kIgc' );
define( 'NONCE_SALT',       '6Cr~5yK,@5E-w+cb04 DnU?!?w<rB~sqi+7&)jRysa5!-ixP-u1Xb&:)BVIJeWiI' );

/**#@-*/

/**
 * Prefisso Tabella del Database WordPress.
 *
 * È possibile avere installazioni multiple su di un unico database
 * fornendo a ciascuna installazione un prefisso univoco.
 * Solo numeri, lettere e sottolineatura!
 */
$table_prefix = 'ug_';

/**
 * Per gli sviluppatori: modalità di debug di WordPress.
 *
 * Modificare questa voce a TRUE per abilitare la visualizzazione degli avvisi durante lo sviluppo
 * È fortemente raccomandato agli svilupaptori di temi e plugin di utilizare
 * WP_DEBUG all’interno dei loro ambienti di sviluppo.
 *
 * Per informazioni sulle altre costanti che possono essere utilizzate per il debug,
 * leggi la documentazione
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', false);

/* Finito, interrompere le modifiche! Buon blogging. */

/** Path assoluto alla directory di WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Imposta le variabili di WordPress ed include i file. */
require_once(ABSPATH . 'wp-settings.php');
