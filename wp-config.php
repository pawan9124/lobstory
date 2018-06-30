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
define('DB_NAME', 'lobst8bl_lobstorypsaket');

/** MySQL database username */
define('DB_USER', 'lobst8bl_psaket');

/** MySQL database password */
define('DB_PASSWORD', 'w9A~N&CT(C^_');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '4nXM,pG@ctG_f!6}@gB!Btyz27o7^FeUaF),nai7BtTrbmeiC$U?O^A)X[x-kd[T');
define('SECURE_AUTH_KEY',  'b6NIodBHbu6}IYIbc-w^F!{^W!v1D]M5LM]c7LQo`cAWk9Cq}[4*7.R+dVg)AqG{');
define('LOGGED_IN_KEY',    'i4i/4M/.2r ,k^-#238Jph5LcE/>vx{G@zRfk1.$`-L]h2oaFUB8vsbvUfTfVv?2');
define('NONCE_KEY',        '|&5)?n2R=uR}~>ojk)7W2pwG*2VnH/?j?}tPs=J#H2#.lrz-uTV*.g1mB#9&7%4D');
define('AUTH_SALT',        'Ox[5iHR4>OJS8aDpupMK$u$rv]>:^t.~5l2O^rlGbaQBe2Ro^n:{fjc0Us*KM1G+');
define('SECURE_AUTH_SALT', '1<P_|ZeTAEI}<IQ5G4Njmon?3-yiS<{M77QQJme{):lbM%$ N;DC9Kah^%79Q0b;');
define('LOGGED_IN_SALT',   '.6X&z1LIh wAt040EU!`|ACcMl~a<Cpv/8Uy]n&90hc3nz1aM1L8 V5+YY;`h]%(');
define('NONCE_SALT',       '/`wymB96*T,)1 |c12IeQyf!BMn)y.0r|5c}m}!q{D$qOk<w4%%vb9]AM7s@Sw+<');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'psaket_';

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
