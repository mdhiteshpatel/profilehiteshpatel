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
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'BRU2ANwkVEKXFFu/F+Ohld0FyQeatc3zyYtwYVzN+EKI9ee7DZI7qgAjrdp74rC2PW4Rl06Rx2lmc3+IgWSMDw==');
define('SECURE_AUTH_KEY',  'XfPISzfnAp8l+Vrx26ykx2Y41HSnIuc99lN1I6ZO7uQwOFtHbSQI6+kkh4JwCccNHX+voiKf/DU7z1I3v53xoQ==');
define('LOGGED_IN_KEY',    'bj00oxpCMURQqrrg0Qn2loCeyKKAQ/hLGgn+5H0HsQ6fL2j5UK9NO3JJS5EEQHjFgHHHzx005wngFc0W523FAA==');
define('NONCE_KEY',        'zDj7npuGzpMNAdX9BIEkMG6El/FOCU1B2FYt3cGOtv3CpOvfclNEjc1x5Z3vU1iFjiR/1kl/L0AULMs4Sd9Cfw==');
define('AUTH_SALT',        'e4mwEdk/ZGXdl8WqtYQ2wN7dZCspmdJoWcW5S8+8b2KLpRd7O8UujstejiP3GRLYkV2cCIXL2gLwRL4sQPrsUw==');
define('SECURE_AUTH_SALT', 'jJSLQYD70DxrjIVWZvRoq8mV3WSra0dsevfZgyausiTEw0WiPwszbbl1wV6hkh6b3rqYD44lnC9ac61urQGomw==');
define('LOGGED_IN_SALT',   'yT7sCfCKoWMUlyf2Fww5+sfIfGPfmGUAcR0LpIVoZ16OodO45TD91Xw1KLmhGUlPJwtK+q7dvI9Kqkcaj0oNlw==');
define('NONCE_SALT',       'MbYrSRI5m6AvcsujAcUKUURNyq3O2n6du61ac8PJi1AS28n1l/zlnvpCq0CrrfIut8rMY/UmzQIfWro5dGjmLw==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
