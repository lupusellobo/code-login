<?php

namespace codelogin\includes;

use lld\helpers\Mustache_helper;

class Code_Ajax {

	public function __construct() {
		add_action( 'wp_ajax_code_login_send_code', [ $this, 'send_code' ] );
		add_action( 'wp_ajax_nopriv_code_login_send_code', [ $this, 'send_code' ] );

		add_action( 'wp_ajax_code_login_validate_code', [ $this, 'validate_code' ] );
		add_action( 'wp_ajax_nopriv_code_login_validate_code', [ $this, 'validate_code' ] );
	}

	public function send_code() {
		global $wpdb;

		check_ajax_referer( 'code_request', 'nonce' );

		if ( !is_email( $_REQUEST['value'] ) && !is_numeric( $_REQUEST['value'] ) ) wp_send_json( [ 'error' => get_option( 'codelogin_user_invalid' ) ], 401 );

		$user = get_user_by( is_email( $_REQUEST['value'] )? 'email' : 'login', sanitize_text_field( $_REQUEST['value'] ) );

		if ( !$user ) wp_send_json( [ 'error' => get_option( 'codelogin_user_not_found' ) ], 404 );

		$trans = $wpdb->get_results( "SELECT replace( option_name, '_transient_', '' ) AS tr FROM $wpdb->options WHERE option_name LIKE '_transient_%' AND option_value = $user->ID" );

		foreach ( $trans as $tran ) {
			delete_transient( $tran->tr );
		}

		$code = Code_Generator::get_code( 8 );
		set_transient( $code, $user->ID, get_option( 'codelogin_timeout' ) );

		$body = Mustache_helper::get_instance()->render_str( get_option('codelogin_email'), [
			'name' => $user->first_name,
			'code' => $code,
			'timeout' => number_format( (int) get_option( 'codelogin_timeout' ) / 60, 0 ),
		], false  );

		do_action( 'code_login_send_code', $user, $code );
		wp_mail( $user->user_email, get_option( 'codelogin_email_subject' ), $body, [ 'Content-Type: text/html; charset=UTF-8' ] );



		wp_send_json( [ ], 200 );

		die();
	}

	public function validate_code() {
		check_ajax_referer( 'code_code', 'nonce' );

		$transient = get_transient( $_REQUEST['value'] );

		if ( !$transient ) wp_send_json( [ 'error' => get_option( 'codelogin_code_error' ) ], 404 );

//		delete_transient( $_REQUEST['value'] );

		$user = get_user_by( 'ID', $transient );
		wp_set_current_user( $user->ID, $user->user_login );
		wp_set_auth_cookie( $user->ID );
		do_action('wp_login', $user->user_login, $user );

		wp_send_json( [ 'url' => get_permalink( get_option('codelogin_form_url') ) ], 200 );

		die();
	}
}
$code_ajax = new Code_Ajax();
