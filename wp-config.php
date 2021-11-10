<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'demourlc_irepaircltdb' );

/** MySQL database username */
define( 'DB_USER', 'demourlc_irepaircltdb' );

/** MySQL database password */
define( 'DB_PASSWORD', 'A7Kt@mgYem,~' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '0?7(&TrK1>)(bT8j%WT&NJWQ1F?x` hmr0 YvDuaPVQV2yzm!y>%oR&.( ZTnD*Q' );
define( 'SECURE_AUTH_KEY',  'ov;5b9CGrGiNwp/Fan;-dq${haE*HO~p$a;<5Ijo.crPE[:W`u`.WMR4yWZFditB' );
define( 'LOGGED_IN_KEY',    '?cK>pq!o$#|(9tO c8%R1d^S)*1A$x>B=^yDiJhrTlRyZhmoFI;U?~thgw>U|82g' );
define( 'NONCE_KEY',        '|*4-,ID0P21x+SHm}5VY2Us+ a@nZZOf*o5])~i:VMC$ryzOOF>~xK57u1X5t$//' );
define( 'AUTH_SALT',        'Q~uo}-K*UVbEL`H5h+-iri7ti]8fjvo<!*A7`mVS`)|V?DqB5^U%_T[F/Bx:|=-}' );
define( 'SECURE_AUTH_SALT', '$-l+&s;G;8OBUO{S)l7~3Lkc~HC%I&_my3(7J-Fpdsl&f,kT}cJ=e1iOhw!F4#1r' );
define( 'LOGGED_IN_SALT',   'M),-LoCHpB?[H:]=VbqN4coeMbXdSRI_p*(S.|l/E$3OvXEZY1G3kP|TQ+VF3XF=' );
define( 'NONCE_SALT',       '(r*-fu;5?h-?tCkA[ZQ`6aGN e/`Wufu:n`m36IribjZ:Q#s&E`cnAC=PurNmX2W' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
