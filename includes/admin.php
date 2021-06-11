<?php

namespace codelogin\includes;

class Admin_Page {
	public function __construct() {
		add_action( 'admin_menu', [ $this, 'create_menu' ] );
	}

	public function create_menu() {
		add_menu_page('Code Login settings', 'Code Login Settings', 'administrator', __FILE__, [ $this, 'settings_page' ] , 'dashicons-archive' );
		add_action( 'admin_init', [ $this, 'settings' ] );
	}

	public function settings() {
		register_setting( 'codelogin-settings-group', 'codelogin_request_form_text' );
		register_setting( 'codelogin-settings-group', 'codelogin_request_form_label' );
		register_setting( 'codelogin-settings-group', 'codelogin_request_form_button_text' );
		register_setting( 'codelogin-settings-group', 'codelogin_code_form_text' );
		register_setting( 'codelogin-settings-group', 'codelogin_code_form_label' );
		register_setting( 'codelogin-settings-group', 'codelogin_code_form_button_text' );
		register_setting( 'codelogin-settings-group', 'codelogin_timeout' );
		register_setting( 'codelogin-settings-group', 'codelogin_email_subject' );
		register_setting( 'codelogin-settings-group', 'codelogin_email' );

		register_setting( 'codelogin-settings-group', 'codelogin_user_invalid' );
		register_setting( 'codelogin-settings-group', 'codelogin_user_not_found' );
		register_setting( 'codelogin-settings-group', 'codelogin_code_error' );

		register_setting( 'codelogin-settings-group', 'codelogin_form_url' );
	}

	public function settings_page() {
		?>
		<div class="wrap">
		<h1><?php _e( 'Code Login Settings', 'code-login' ) ?></h1>

		<form method="post" action="options.php">
		<?php settings_fields( 'codelogin-settings-group' ); ?>
		<?php do_settings_sections( 'codelogin-settings-group' ); ?>
		<table class="form-table">
			<tbody>
				<tr>
					<td colspan="2"><h2><?php _e( 'Request Code', 'code-login' ) ?></h2></td>
				</tr>

				<tr valign="top">
					<th scope="row"><?php _e( 'Request Form Text', 'code-login' ) ?></th>
					<td>
						<textarea id="codelogin_request_form_text" name="codelogin_request_form_text" rows="5" cols="40"><?php echo get_option('codelogin_request_form_text'); ?></textarea>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><?php _e( 'Request Form label', 'code-login' ) ?></th>
					<td>
						<input type="text" id="codelogin_request_form_label" name="codelogin_request_form_label" value="<?php echo get_option( 'codelogin_request_form_label' ) ?>" >
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><?php _e( 'Request Form Button Text', 'code-login' ) ?></th>
					<td>
						<input type="text" id="codelogin_request_form_button_text" name="codelogin_request_form_button_text" value="<?php echo get_option( 'codelogin_request_form_button_text' ) ?>" >
					</td>
				</tr>



				<tr>
					<td colspan="2"><h2><?php _e( 'Login Code', 'code-login' ) ?></h2></td>
				</tr>

				<tr valign="top">
					<th scope="row"><?php _e( 'Code Form Text', 'code-login' ) ?></th>
					<td>
						<textarea id="codelogin_code_form_text" name="codelogin_code_form_text" rows="5" cols="40"><?php echo get_option('codelogin_code_form_text'); ?></textarea>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><?php _e( 'Code Form label', 'code-login' ) ?></th>
					<td>
						<input type="text" id="codelogin_code_form_label" name="codelogin_code_form_label" value="<?php echo get_option( 'codelogin_code_form_label' ) ?>" >
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><?php _e( 'Code Form Button Text', 'code-login' ) ?></th>
					<td>
						<input type="text" id="codelogin_code_form_button_text" name="codelogin_code_form_button_text" value="<?php echo get_option( 'codelogin_code_form_button_text' ) ?>" >
					</td>
				</tr>


				<tr>
					<td colspan="2"><h2><?php _e( 'Error messages', 'code-login' ) ?></h2></td>
				</tr>

				<tr valign="top">
					<th scope="row"><?php _e( 'Invalid user', 'code-login' ) ?></th>
					<td>
						<input type="text" id="codelogin_user_invalid" name="codelogin_user_invalid" value="<?php echo get_option( 'codelogin_user_invalid' ) ?>" >
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><?php _e( 'User not found', 'code-login' ) ?></th>
					<td>
						<input type="text" id="codelogin_user_not_found" name="codelogin_user_not_found" value="<?php echo get_option( 'codelogin_user_not_found' ) ?>" >
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><?php _e( 'Code error', 'code-login' ) ?></th>
					<td>
						<input type="text" id="codelogin_code_error" name="codelogin_code_error" value="<?php echo get_option( 'codelogin_code_error' ) ?>" >
					</td>
				</tr>




				<tr>
					<td colspan="2"><h2><?php _e( 'Email', 'code-login' ) ?></h2></td>
				</tr>

				<tr valign="top">
					<th scope="row"><?php _e( 'Code timeout in seconds', 'code-login' ) ?></th>
					<td>
						<input type="number" id="codelogin_timeout" name="codelogin_timeout" value="<?php echo get_option( 'codelogin_timeout' ) ?>" >
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><?php _e( 'Email subject', 'code-login' ) ?></th>
					<td>
						<input type="text" id="codelogin_email_subject" name="codelogin_email_subject" value="<?php echo get_option( 'codelogin_email_subject' ) ?>" >
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><?php _e( 'Code Form Text', 'code-login' ) ?></th>
					<td>
						<h4><?php _e( 'Codes', 'code-login' ) ?></h4>
						<p><?php _e( 'name {{name}}', 'code-login' ) ?></p>
						<p><?php _e( 'email {{email}}', 'code-login' ) ?></p>
						<p><?php _e( 'code {{code}}', 'code-login' ) ?></p>
						<p><?php _e( 'timeout {{timeout}} *in minutes', 'code-login' ) ?></p>
						<textarea id="codelogin_email" name="codelogin_email" rows="25" cols="80"><?php echo get_option('codelogin_email'); ?></textarea>
					</td>
				</tr>




				<tr>
					<td colspan="2"><h2><?php _e( 'Form page', 'code-login' ) ?></h2></td>
				</tr>

				<tr valign="top">
					<th scope="row">Página de detalle de noticia</th>
					<td>
						<?php wp_dropdown_pages( [
							'name' => 'codelogin_form_url',
							'show_option_none' => __( '— Select —', 'code-login' ),
							'option_none_value' => '0',
							'selected' => get_option('codelogin_form_url'),
						] ) ?>
					</td>
				</tr>

			</tbody>
		</table>

		<?php submit_button(); ?>
		<?php
	}
}
$admin_page = new Admin_Page();
