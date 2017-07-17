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
define('DB_NAME', 'viewfinblog');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/** 修改wordpress根目录为相对路径 */
define('WP_HOME', '');
define('WP_SITEURL', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '~B;%;FbQ,xc!ahl,hnOaIJVx%8K,E*xaKw*#9IRi8 VESx}&Nj,^-rX3,yi(Dz~W');
define('SECURE_AUTH_KEY',  ' Wo+pTZJ3vA$- a<<.}1PlLIc^e3Z]^K5%ZB<}q:BQ_:95_ 4%^qHNG)l@kRs~U^');
define('LOGGED_IN_KEY',    'HfG&W+y_YK$-.Pm9/bKNl]tLB0[ccG7Ad e5myzh[uaIt,h>{BVo/!bwp*$H9jK~');
define('NONCE_KEY',        '?By5b_-=0gt?2AUwu$=&Sv*Cx7yjZI(z/Ln.wCzWQcmDwjMKx69uUx%x6lnx?xLS');
define('AUTH_SALT',        'M~ ~Tks`&YanXcwm[}Z0_<d0fT|zS+uEC[a6_:Ga0Higqz|i_Z[+597BA^*h0h!m');
define('SECURE_AUTH_SALT', 'M<qzwUzw)Ds~U/!~u`h2C(s(Yjz&uzOR^OJImyF1FW4N,:Oud[!>sg2n=P* q<e6');
define('LOGGED_IN_SALT',   'eu-_>zH8A@u20_!hx=8&GlW^:!F<Nr0.^aPh(0Spc.l3HTD*.1miQBt[7V1~a`wk');
define('NONCE_SALT',       '`h.oR/6Ck$5tnL>Q:GX$As+;|k}IR$5--|jNxXe9g]<xCWIXy{$Z]@*#G<}4p5#c');

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
