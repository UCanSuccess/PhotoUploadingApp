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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'h)~;hsB=TTtY Lif3XIUZHxVW?m-e:?X&#(qOeUNBkIrA(5|33]hjX=o-nqzpcEC');
define('SECURE_AUTH_KEY',  'k}r!%tI~>sHgumi8j<soD9q4,@PT^JY}+:s_)e=F1TmPGXPc#6 5&6D%{R#zNu^r');
define('LOGGED_IN_KEY',    'zIvA[}k(+1vYY i/C%pG,${1)DJ9dd,#].5rMBgI(gCx$1(7AsEGN4k;PlNF%rS7');
define('NONCE_KEY',        '; ,m}M=vJEa?B.jVSbsGUTNg0lj;K)se+:;wn6]@G!oS?mV9BN`>&kS<B(0n v-3');
define('AUTH_SALT',        '%xN)4~CGU#LXnv/D,6P(adLMBacf>hNasA;g_+KA:1[<RvweGH/`}eRAE3a%U$%!');
define('SECURE_AUTH_SALT', '9p&,4sTAG}d).Mv%oBL@v#%pFG{:zp9x:mcN9v~D#X}r7VkW:3b%4guTjW}IPuEk');
define('LOGGED_IN_SALT',   'akh)2ja4=SPN,>@)i6^BSN/-Oa 9nB<ii:t:xT^S5WcW(l0S~N3AM8N&v!c_}m#t');
define('NONCE_SALT',       'i^4Q&b]4H5xb)l4G9RZ%mL3(aAq1hRQ9f)l^afStwk7bR9d?/FveD:@3,4k@%Qi)');

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
define( 'WP_MEMORY_LIMIT', '96M' );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
