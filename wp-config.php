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
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'nhome_cms' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
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
define( 'AUTH_KEY',         'G4?V851_vOq!kMWK[|i+0RK^-t8T{PCe~[WT1DlrYl^BMPma{FTQ[Ktg``V[xu,K' );
define( 'SECURE_AUTH_KEY',  'cxPg[f(L$>:o.5?1~<acuIB(du=uq{Ib#BaoC1vG&u1/5mWK^Aw/n+{[J,tO2}U9' );
define( 'LOGGED_IN_KEY',    'm9{)!Ye$Z,4 FOmy3w,4R^K&GF1~(I!j/0$0^VL[u$CALnov2#/JOJ,2-nZCrE[O' );
define( 'NONCE_KEY',        'f2KK9_e}y!~jQ6DDgMxk__(ay5A+jYT*q=BCSksq&QZb6ENZagWW_9IL Hzc9en4' );
define( 'AUTH_SALT',        'UW74xbk^>OxOc.u-ic|8Ddr/*T!=KS)xP}O/$jn{n @5[Nd9LH*L3_tRn/kK;AoC' );
define( 'SECURE_AUTH_SALT', 'Y}pHy`<n$a;JqVQH]XY3WO.:IBzX=?~+q-}/nagr*s{}#2jWDQ!+tAPc-r{FG_*.' );
define( 'LOGGED_IN_SALT',   '1k)d.JN#4hm5Fh#q$KR`I%0:BbF(mY<-&+zld$LgI&ZB<RB@HoA@Ql<i.RO~l1uy' );
define( 'NONCE_SALT',       'K.u/#km^}TYksXvi~@6)hg%,g%]safE?gVHm:3O?z0_W!,t~)Y/@)T2RLAN0 1{2' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
