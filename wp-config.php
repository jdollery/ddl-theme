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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'ddl_theme' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'GHE&B*Ha /R;8`GGDoL)G_{|{ng]c2q~1h~St  8~t[m8,rfBKY2iTG_x]S4I$={' );
define( 'SECURE_AUTH_KEY',  'dmw08LP~<^t@]gyDOo8JW~-PRCh0NCCf~=AS:<P*X8RLYdwtB)S~` dUXA-v@#fr' );
define( 'LOGGED_IN_KEY',    'ELT.# :}(A+OkDfOEB;E5S)@*FL=[v8m:j+a]mE5tz#g3Cn}~J[FMu.VsnO&T]lF' );
define( 'NONCE_KEY',        '^L7Bsh8Ifz!;L]m#g$!8Mn7}`Ga(g+d(gTSWjI,cZ|:=I$}[02]oMSqqXTHSd@V,' );
define( 'AUTH_SALT',        '`ygsk,w TL7**s;)&p+#a3n LBqk*R9Yx*<Bri~Prt}ru%1{^z|ab*X>CR)t2APz' );
define( 'SECURE_AUTH_SALT', '@?rE*5jTKpG3M> `mO*F%tLOO?7AX^4OQRe[?Ll Ln`5;&@rdY=oxhYDvw>rO%xS' );
define( 'LOGGED_IN_SALT',   'cJ}C&+xdU|UnI}3GoEO0@P1?OjH-&-LO{ksxz-xYslkM[}@m0UW_wU;4Q^&_Du^s' );
define( 'NONCE_SALT',       ':8}8]3Fdnt(n1}F;.6GIN`v+dltz)+r>^_hX!TtTYxN[/!YOE/62-N[JXdcUz}yE' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
