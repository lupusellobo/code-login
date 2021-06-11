<?php

namespace codelogin\includes\shortcodes;

if ( ! defined( 'ABSPATH' ) )	exit;

class Login_box {
	public function __construct() {
		add_shortcode( 'codelogin_loginbox', [ $this, 'shortcode' ] );
	}

	public function shortcode( $atts ) {
		wp_enqueue_script( 'codelogin-script', CODE_LOGIN_URL.'/assets/codelogin.js', [ 'jquery' ], '', true );
		wp_localize_script( 'codelogin-script', 'codelogin', [
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'endpoint' => get_rest_url(),
		] );

		return \lld\helpers\Mustache_helper::get_instance()->render( CODE_LOGIN_URI . 'components/login-box.mustache', [
			'request_nonce' =>  wp_create_nonce( 'code_request' ),
			'code_nonce' =>  wp_create_nonce( 'code_code' ),
			'str' => [
				'request_form_text' => get_option('codelogin_request_form_text'),
				'request_form_label' => get_option('codelogin_request_form_label'),
				'request_form_button_text' => get_option('codelogin_request_form_button_text'),
				'code_form_text' => get_option('codelogin_code_form_text'),
				'code_form_label' => get_option('codelogin_code_form_label'),
				'code_form_button_text' => get_option('codelogin_code_form_button_text'),
			]
		], false );
	}
}
$login_box = new Login_box();
