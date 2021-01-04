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
define( 'DB_NAME', 'ddl' );

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
define( 'AUTH_KEY',         'qj+s&#iqYKw^C?h3c6i50Tr79az|M-T+Lb6}bU~J_#2Ikx5^W2`Cg~tx9ix4JdN6' );
define( 'SECURE_AUTH_KEY',  '$FO8=iu fONVR~j{PQ]_j3rkR#?F?oVxQd~o<p_P5IS-6a{FRpl6lK5bQx_mOoM0' );
define( 'LOGGED_IN_KEY',    'tRs_N7;;E n=8{@qN&Ix_IDK#He3f1s{%mWA=_BbC&x!$nr|9%J7ivbZ(Yf8 E((' );
define( 'NONCE_KEY',        '93e&ke3v) eibg{p4X>^ b&8{II{Y*t+x^~&Ys]-.TY7Ni[+F1^kDKL `XaN)fps' );
define( 'AUTH_SALT',        '>Mc:2Wk=:fZslFa805%d_ k4Az~*, pLWAiM!Nm{vB~:8o/O0Il*:HfrJ$Md4}<t' );
define( 'SECURE_AUTH_SALT', 'Q7[^A[-R<Q!w$ OZ`+gk!V1OyY6bFQaKF3<3 9RFw3gr/:O5nV^1!]*c8KyOE7&3' );
define( 'LOGGED_IN_SALT',   'nx|%uul|m*z_D}Zf?Sqt8rZ%{T>hvO:Hokkd-4A](%7$z/8<yuGs8D8l. i17zE-' );
define( 'NONCE_SALT',       'Z1R-$./a$C@f/l(+iqGSdr-[NDS[4/?+`H<ZJ&R!499s@k?UcAy;)A$FeLjh%#Hw' );

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
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
