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
define( 'DB_USER', 'Admin' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Ts0m5dat' );

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
define( 'AUTH_KEY',         ']%uNuQ`JZ2+7(JNy(jdo?N_En,_=4nBe6#QgULR5Csb]rwe@<EfNifPa<Xt,h5Yr' );
define( 'SECURE_AUTH_KEY',  'Z}wFK57[|%W@s3; */,~?5N`Ij%bXc!?Q)OhqLfqS]95zCk@t_%W-.iPtCC5ChpS' );
define( 'LOGGED_IN_KEY',    '0}|80cq]e6HD#vN$C9s0,ZQAcT6wSAL:W|.lZ+oLmnDFWG</Lth[{$iG_eM@(EU~' );
define( 'NONCE_KEY',        '7BnUuTgdrEd,8~|7Sg n-;@)-+p1f8BA:}ajdQ#6zp;@WP[$*eu:O>D#%3~*XsY?' );
define( 'AUTH_SALT',        'ic)=W_[F$cZR.V~Tar2M^ob?[)4WWCB[3JP^yoXw51q$has)5oMBLZJP0l C3es$' );
define( 'SECURE_AUTH_SALT', '> |U$v|7DajHkwKW1p}Kp/5,fA>0JEQHXL;yxDw1vp&tIqU_.sXSa::M-0m7zl{.' );
define( 'LOGGED_IN_SALT',   'i7VP2F.GweFN <dh4.X->_dAt6;|lSt5>{Hv63l^IC6+vhgJC# .l> SY%UgOjy1' );
define( 'NONCE_SALT',       '.oND_{>GR17}VD[iNvwLbU4@Zr2)VA!%1@K:b,7`D]>P9Bz1CRmDS5kF&V?[Z)pN' );

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
