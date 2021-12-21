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
define( 'DB_NAME', 'autos' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '(9=IlQ+nPko(h}lGey`eUQ:6s%{;18&B-4$-&ZAlM0&ca9RTB]>`/(p&!89eNoe{' );
define( 'SECURE_AUTH_KEY',  'b+i$&d>BoUet9Y*&=x75o+E%&TW[[MJMcpez9604d$4nTRZ0S$35k!+,,I(HZ#co' );
define( 'LOGGED_IN_KEY',    'F8%G$s}7%j:j(R=2e2.>4h_F9@ynSS%iM!T8xqAYeJa_*]:#u>~ PuH5jkfD/RL.' );
define( 'NONCE_KEY',        'KQ!cCmT9=/2c60Tv4)g7~bvyVdNI~aPN]=z>3:.FN=[=&8KuZ6ZvnWOzy0$xl4-.' );
define( 'AUTH_SALT',        'f2/)b@W.+`:&) H<,{?S#Pbh3CXB)9NmNYwcRPBaVl}b*7XXQWZzY*ilO)0>+!^{' );
define( 'SECURE_AUTH_SALT', 'IvxiZ.SabKXr$BGn;u3+p1x(A=}C.,mixG7SF~/++=Mpuue0RoVt]lf6Y>U#6R8X' );
define( 'LOGGED_IN_SALT',   ';d$GDNV.L2~E-9v}U!U/HrP#0ERV,]AnR-b>?Tpe#C^@*<njq <WjR |zyGXdKPi' );
define( 'NONCE_SALT',       'Z[8E(Kz6WiBKFpA(oq/|<5{V8%ehJ5.nJ<6Ho:#TG;t;x=~}cUyUT;O>OVUdJ,g8' );

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
