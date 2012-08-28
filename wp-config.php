<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'prayud_wordpress');

/** MySQL database username */
define('DB_USER', 'prayud_wordpress');

/** MySQL database password */
define('DB_PASSWORD', 'prayudh');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'wzue4!6Z|8}-.$LmooVX2{4-k_-8+}--x]eNT{|[r-6:ts,>?e73k>+k31I>f!o%');
define('SECURE_AUTH_KEY',  'R<P|@@YG:#jZv` 1%)OEo5A_FO`||#*!eH?n.h}2p+*^0`&1wI1z+N;r:1$dq68O');
define('LOGGED_IN_KEY',    'n_g,s-d{V5m|:$vQlw+HQ`KjS=p}is}keEQ0IB}qc5zX*= >n,[TGd,yT&|exA(#');
define('NONCE_KEY',        'gjh:b&)Qecr6c8m%ZGA|}BOH|+mRq6]KvK?4!IuT +vi! %*VhlDc# L]`-[`|VB');
define('AUTH_SALT',        'wtqhJ4an0e)%nop!%6rP*+7:=|6NbNAy4YN.0|pMh3d&,X=7%t_})yC?E|xJ7-);');
define('SECURE_AUTH_SALT', 'ef~:uCvDGT-< jY#J-Rew);.d.>88ZsRJGk80XSJYU+uJC-5d5-R<fH).6 XG,Lh');
define('LOGGED_IN_SALT',   '&ZVL^RUTpD4PGh <ccPtSWec|&L/+gR=W~Vvm} On,Wn8-H^O3u*aGF2K4y_Y`ZB');
define('NONCE_SALT',       '/Y0+xGUSbvMHiF)e*%A|u69kHbO,|rL:!U-q79){z7D#h6NHE}8@HW!0#J%!,*H/');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
