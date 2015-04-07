<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wp_41');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'giang');

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
define('AUTH_KEY',         'ef!k}omgS804L;QJ>@iydqTz=N|lGT[ _m&T#ypF|C,A.8EK}cgYN& 7k4yR1Npq');
define('SECURE_AUTH_KEY',  '5K[qehC|+C6^T.y(2!<=-=(SP{j[+U4vH(6!{-m+Zwex7}uGe`Fy)V3sJMb5-GMD');
define('LOGGED_IN_KEY',    '|TEy&xnAYu<O+P`*!ys5IreR[o&TDo(GaU|i;pJg-c}v=c|k7FV)qUUgn?T=)xV,');
define('NONCE_KEY',        'E3J?`0B,_u|<#oW?y^|d:m#GC@Y%D_^`0J@YRO}l$u#N>Jp]>!eTdQ$jJXuQg]^r');
define('AUTH_SALT',        'L4NFar]e*h-1BRf_Mc;(+H<UG*O@k}>0[gyc^*PWB2;XjpHE6iRe+mYj-HjIk,9{');
define('SECURE_AUTH_SALT', '2aGb5u.4FGba? _tMZ>oU}8A7aje IJrq =nMi-oD$lN4G<a`MV||]|4+]YB-oLP');
define('LOGGED_IN_SALT',   'SMu]^z|&7FD&?%|S{l7AT[doonr%`g-&JbSMIdXk+lg--+zVy%cH3pH>H@J;Hu6x');
define('NONCE_SALT',       '53Y+`5EVDko~( @QsINOR`-(weEh/s8)}1~#`4p,L~.>`U,5T=rtF@K}aE@NsYW}');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
