<?php
/**
 * Plugin Name: code-login
 * Plugin URI: http://www.laligad.com
 * Description: Login to website with code sent to email
 * Version: 0.0.4
 * Author: lld
 * Author URI: http:/www.laligad.com
 * License: GPL2
 * Text Domain: code-login
 * Domain Path: /languages
 */

namespace codelogin;

if ( ! defined( 'ABSPATH' ) )	exit;

use Mustache_Autoloader;
use Mustache_Engine;
use Mustache_Loader_FilesystemLoader;

define( 'CODE_LOGIN_URI', dirname(__FILE__).'/' );
define( 'CODE_LOGIN_URL', plugins_url( '', __FILE__ ) );
define( 'CODE_LOGIN_PATH', plugin_dir_path( __FILE__ ) );

class Code_Login {
	public function __construct() {
		if ( !class_exists( 'Mustache_Autoloader' ) ) {
			include_once( CODE_LOGIN_PATH . 'vendor/mustache/mustache/src/Mustache/Autoloader.php' );
			include_once( CODE_LOGIN_PATH . 'helpers/Mustache_helper.php' );
			Mustache_Autoloader::register();
		}

		if ( class_exists( '\lld\helpers\Mustache_helper' ) ) {
			\lld\helpers\Mustache_helper::get_instance()->init(new Mustache_Engine([
				'partials_loader' => new Mustache_Loader_FilesystemLoader( CODE_LOGIN_URI . 'components' )
			]));
		}

		include_once( CODE_LOGIN_PATH . 'includes/shortcodes/login-box.php' );
		include_once( CODE_LOGIN_PATH . 'includes/admin.php' );
		include_once( CODE_LOGIN_PATH . 'includes/ajax.php' );
		include_once( CODE_LOGIN_PATH . 'includes/generator.php' );
	}
}
$code_login = new Code_Login();
