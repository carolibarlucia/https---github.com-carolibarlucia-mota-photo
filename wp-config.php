<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link https://fr.wordpress.org/support/article/editing-wp-config-php/ Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'mota-photo' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', 'root' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '^/v,mDH0:D5bt.Ism Al_w)13s$gy&@N1_EO.vZJp}1i{{H#xc)2P,.{-.1^|iJ@' );
define( 'SECURE_AUTH_KEY',  'o}rS r0rg=5W`5vT8qdddCi$R9w<Qk,  >]uQ9W{QuM?!*{@R#4LBG)712ppc7[O' );
define( 'LOGGED_IN_KEY',    '8T4LTHfr8Qr__~I=)3CP,oZ2O4Jwi3teCs5?ex4M6.]W[L&A:}p}SA=n@/5lX;`(' );
define( 'NONCE_KEY',        'v/3ojKB0)2G-<d>eCL~~DpQOXVT~z0+z[|PsT.]d&hRFP%$h|nlZFYx.r!22~Ky|' );
define( 'AUTH_SALT',        '_$+4@Zm{)PIUBl]iCWz5H6pk5&~=M-gnX^b0Y(+PG1{ob[OA+#qDAvBkP)Hd,=0W' );
define( 'SECURE_AUTH_SALT', 'KMf^U%VZ>+FWZdGJ-(>hD(F[KFzW)r|O8b{cAD*I7dtKjn=4OSgKoSld^HT%#EoL' );
define( 'LOGGED_IN_SALT',   'mB5Ie*9rF_Iv{npKbdESZ.i[>sO0Li|pwl[+2T$~?2K[SU`h)G7?-Ui8.<jO7qwh' );
define( 'NONCE_SALT',       '1D3x/!CM*aX e)x/>W&YpbT&2>Ed1j[71kcwmx-Q=|850N`|5V>XD+N8}m:mG%.*' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs et développeuses : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur la documentation.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
