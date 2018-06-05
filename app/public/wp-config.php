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

// ** MySQL settings ** //
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
define('AUTH_KEY',         'a9qUn6Xyt4XaKZqlscH5L73oKedv28RO1FikJwXPg9QTrxfDuK8GdRc6HpvMhj9rweszq7nYQ59VFL2ZYeDmnw==');
define('SECURE_AUTH_KEY',  'BwO11wFAFmA6kt0yxeZnm0dfNsGDzq3CEXMOwdcQQ/ItIhJS4CqB+r8vL4dZ3AVRZKhb10bSUO9g/8mxU42dtg==');
define('LOGGED_IN_KEY',    'vhkgNnk9mTTTeGVNOwJCJETPL1kutnUbSTMMgjshs9AAYQQkzkFpaeMcnb0RC4HDKgTJhPcaXPGRD9aM0OvNkA==');
define('NONCE_KEY',        '4chHzaUVxO4M1GbVc02D36d6HcmXFdv+DgcHyNfX+ru5aVdwAL1ZHWkioxulRA/gBEjPIfMCQO9K+lDdNWAQcQ==');
define('AUTH_SALT',        '97LPTFXF5MswzVOG1L3zAv+d6UXsziuf/wRlARxmzBG+P6+ARzNfHqLjH3oW6qPBEORaUCej0WKrW8cuXSIFyw==');
define('SECURE_AUTH_SALT', 'YxNgKgo0OIoaCnmONEFClehEBqpDhGkFuLkU+wFh957cT4q+Rw1yBzbR5QoXL/hhN2vAR/TQF3zJ1Fbaqqg9iQ==');
define('LOGGED_IN_SALT',   'y3oPnd/wqEJnX0FibZIUs0m+AMNhG5t/d8ISg1KO78vO2rF0JiCDt7s3Qgpn3CwS1cseEPo/aCxDtR1J16zYDw==');
define('NONCE_SALT',       'tCEsMuGxllpBZBdkUUJsxlCMssIEIDP0ZfjxX/jwSh43LgatOZXZF/iEJets+5fjELfX5hVx4v9Tk8Slw/FWwg==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';





/* Inserted by Local by Flywheel. See: http://codex.wordpress.org/Administration_Over_SSL#Using_a_Reverse_Proxy */
if ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ) {
	$_SERVER['HTTPS'] = 'on';
}

/* Inserted by Local by Flywheel. Fixes $is_nginx global for rewrites. */
if ( ! empty( $_SERVER['SERVER_SOFTWARE'] ) && strpos( $_SERVER['SERVER_SOFTWARE'], 'Flywheel/' ) !== false ) {
	$_SERVER['SERVER_SOFTWARE'] = 'nginx/1.10.1';
}
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
