<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'growpress');

/** Database username */
define('DB_USER', 'root');

/** Database password */
define('DB_PASSWORD', '');

/** Database hostname */
define('DB_HOST', 'localhost');

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

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
define('AUTH_KEY', ',j^9wODTk&)AG2Pfa=:[)r!km]wbMS6M+B&c1GHfiR3Rt^10bDtcGqFS:VElrW87');
define('SECURE_AUTH_KEY', 'z6V`(m8x-I0+}1U[7WyOHtKIZUIdk08xlg%QY4T%XqDJ]$pXrYypgC%:)oJn37&}');
define('LOGGED_IN_KEY', 'vLtE[&AkBvz?=iDoUtqZ6e[T86_SFkekw(#tg`j *5}CM-z?5Z_O;2KGiTl2.ckN');
define('NONCE_KEY', 'w=9z#>w23]6CJ8T1U;+)ny<Rhw0jO;:Uz{Cgc9[ d a|Vp/e02=gR#aXWS4<&yXt');
define('AUTH_SALT', 'wL#:6r9-o*(B3OX+j)}MLd^#|*.P+BOSsZzkZ_RIB.A(} [V7N#R6 %z!ADdIRl&');
define('SECURE_AUTH_SALT', '7Wk,=!#;!E1:z<D>]._M+R(b$#?(pP_fC8#T]y:A_sjt8ytN0Eulo0U]jF[TF)x*');
define('LOGGED_IN_SALT', 'Pymd9NQek%IY-Hi[-{ad}83_A+JlI!9ql6{V/]0TGCZ V`T(HT:71ntHZ[`vj55;');
define('NONCE_SALT', 'Nhx -g,UoOm.SVSF_<|T?*wa=eFK-E2D}b/Kglg-nO=@S4@bH.nY{&|L,Q[=|~=3');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
ini_set('log_errors', 'on');
ini_set('display_errors', 'off');
ini_set('error_reporting', E_ALL);

define('WP_DEBUG', false);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
	define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
