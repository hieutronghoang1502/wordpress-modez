<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */



// ** MySQL settings - You can get this info from your web host ** //


/** The name of the database for WordPress */
define('DB_NAME', 'modez');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'z!z9`#xNB9JF#E2YB]62Hk$=Fn$L~~*&-J!D*XtYf Hra%#Z@p6MTdiY[*D}qkX~');
define('SECURE_AUTH_KEY',  'N,/d3-?5mks )p-|vB1BkANsC2W2`O<% `z&!PspP)3*Z|hMR;d]n9zs:c8}+QP9');
define('LOGGED_IN_KEY',    'c.Q Us0@LrQ`;U?Br,cP`]_(FY3Cx-a^?,/_!2@WROK_ls@MxjoNce{O+3zPo O]');
define('NONCE_KEY',        'k-U,UlanuU*HNpl{BH9AYM>!Y_Q84)l|&z3}#7l,MzEbzPx-peO)=s=B_&Kg h0t');
define('AUTH_SALT',        '|xsE2$f:%+le,K2GX=cx P%9iS^=<Da!jKw#,z/*R:x,xXV.my?[h<Ts{,g]b4Sx');
define('SECURE_AUTH_SALT', 'p)10o:KCP`J7UJ.bRgluMn7f7|.0Bi3#@KFYb)]X|c8mB.`k:HO><P.0aJN(lXg/');
define('LOGGED_IN_SALT',   'jn`bBk_ll=.0a3.|GEK-pqL#L@.GQx2xe$-PH)Q94PX)R/2BnT}=* ja(#TDG7d[');
define('NONCE_SALT',       'LkuSb|pMLhW4cx:|q0z~5CXlC]{>r++m4Xlqm>[oz`U^$RO;Bq1OOk[gI8a^0owV');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define('WP_MEMORY_LIMIT', '256M');