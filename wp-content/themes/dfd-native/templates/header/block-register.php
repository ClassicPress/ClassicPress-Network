<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( is_multisite() ) {
	return;
}

if ( !get_option('users_can_register') ) {
	return;
}

$registration_redirect = ! empty( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : '';

$redirect_to = apply_filters( 'registration_redirect', $registration_redirect );
?>
<div id="dfd-register">
	<h3 class="login_form_title"><?php echo esc_html__('Create account', 'dfd-native') ?></h3>
	<form name="registerform" id="dfd-registration-form" action="<?php echo esc_url( site_url( 'wp-login.php?action=register', 'login_post' ) ); ?>" method="post" novalidate="novalidate">
		<p class="email-wrap">
			<label for="user_email" class="dfd-widget-content-title"><?php esc_html_e('Email','dfd-native') ?></label>
			<input type="email" name="user_email" id="user_email" class="input" value="" size="25" />
		</p>
		<p class="login-wrap">
			<label for="user_login" class="dfd-widget-content-title"><?php esc_html_e('Username','dfd-native') ?></label>
			<input type="text" name="user_login" id="user_login" class="input" value="" size="20" />
		</p>
		<?php do_action( 'register_form' ); ?>
		<p class="submit">
			<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php esc_attr_e('Register', 'dfd-native'); ?>" />
			<input type="hidden" name="redirect_to" value="<?php echo esc_attr( $redirect_to ); ?>" />
		</p>
		<p id="reg_passmail" class="add-info"><?php esc_html_e( 'Registration confirmation will be emailed to you.', 'dfd-native' ); ?></p>
	</form>
	<a href="#" class="dfd-close-register" title="<?php esc_attr_e('close','dfd-native') ?>"></a>
</div>