<?php
/**
 * The base configuration for ClassicPress
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
 * @package ClassicPress
 */

// ClassicPress Network config: Load configuration from a .env file
require_once dirname( __FILE__ ) . '/vendor/autoload.php';
$dotenv = new Dotenv\Dotenv( __DIR__ );
$dotenv->load();

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for ClassicPress */
define( 'DB_NAME',     getenv( 'DB_NAME' ) );

/** MySQL database username */
define( 'DB_USER',     getenv( 'DB_USER' ) );

/** MySQL database password */
define( 'DB_PASSWORD', getenv( 'DB_PASSWORD' ) );

/** MySQL hostname */
define( 'DB_HOST',     getenv( 'DB_HOST' ) );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET',  getenv( 'DB_CHARSET' ) );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE',  getenv( 'DB_COLLATE' ) );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since WP-2.6.0
 */
define( 'AUTH_KEY',         getenv( 'AUTH_KEY' ) );
define( 'SECURE_AUTH_KEY',  getenv( 'SECURE_AUTH_KEY' ) );
define( 'LOGGED_IN_KEY',    getenv( 'LOGGED_IN_KEY' ) );
define( 'NONCE_KEY',        getenv( 'NONCE_KEY' ) );
define( 'AUTH_SALT',        getenv( 'AUTH_SALT' ) );
define( 'SECURE_AUTH_SALT', getenv( 'SECURE_AUTH_SALT' ) );
define( 'LOGGED_IN_SALT',   getenv( 'LOGGED_IN_SALT' ) );
define( 'NONCE_SALT',       getenv( 'NONCE_SALT' ) );

/**#@-*/

/**
 * ClassicPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = getenv( 'DB_TABLE_PREFIX' );

/**
 * For developers: ClassicPress debugging mode.
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
define( 'WP_DEBUG', getenv( 'WP_DEBUG' ) );

/**
 * Site URL constants
 */
define( 'WP_HOME',    getenv( 'WP_HOME' ) );
define( 'WP_SITEURL', getenv( 'WP_SITEURL' ) );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the ClassicPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up ClassicPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
