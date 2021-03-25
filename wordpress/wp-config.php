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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'UJ/l=1@(EIhevd+KAQ]?k&oHg pj[|+euf#N!d2078*e Ji2!idSPn439:hxoQ4+' );
define( 'SECURE_AUTH_KEY',  '.PRh`CC)M0Y``Tn@,Pey7c}%(GyHM;.@-aMI}0~1V}~ 3f5_`mQW!;3$mF:eSH*&' );
define( 'LOGGED_IN_KEY',    'D&c!=Efxi2F>Rn (xj&$BMo:vXK[lmnkxm_ZTjufCI%$f<U?lw@JIG2*z!n r~>^' );
define( 'NONCE_KEY',        'zSFy t.FIhr5LZrVfLvH%a;z:bI(kHAf gK>=enW4?v+9w Q6-@p#DnSgDi)[d}D' );
define( 'AUTH_SALT',        '-w4i{`-4+$jCfX{ac70kF>Gf]LpJ.q>T*#s[$SzyVY;;VjDQ y<iuvs>-O$L^xEC' );
define( 'SECURE_AUTH_SALT', 'QoKYVbq5U%X)(1f|+12:S$ &{F^zcVj>{3Ne}nc]rW1{hBOuQf/l(o>0pLP7&L@G' );
define( 'LOGGED_IN_SALT',   'w~ 5-yz%.YRA0bA3%^rw{<?+%Z%tH3=4L1R;y2>D0(Ut}8x5Bgq`>/mCE@L)=mXG' );
define( 'NONCE_SALT',       '%_V{t1%wDZOB9SIN)[K:yMWN_>OSW$@KIo}F-i2)Rw]cNk[?O0.MhF(}QYCfOMU)' );

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
