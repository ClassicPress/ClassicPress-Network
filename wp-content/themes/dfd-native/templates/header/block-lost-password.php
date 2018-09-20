<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$lostpassword_redirect = ! empty( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : '';

$redirect_to = apply_filters( 'lostpassword_redirect', $lostpassword_redirect );

do_action( 'lost_password' );

?>
<div id="dfd-lost-password">
	<h3 class="login_form_title"><?php echo esc_html__('Restore password', 'dfd-native') ?></h3>
	<form name="lostpasswordform" id="lostpasswordform" action="<?php echo esc_url( network_site_url( 'wp-login.php?action=lostpassword', 'login_post' ) ); ?>" method="post">
		<p>
			<label for="user_login" class="dfd-widget-content-title"><?php esc_html_e('Username or Email', 'dfd-native') ?></label>
			<input type="text" name="user_login" id="user_login" class="input" value="" />
		</p>
		<?php do_action( 'lostpassword_form' ); ?>
		<p class="submit">
			<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php esc_attr_e('Get New Password', 'dfd-native'); ?>" />
			<input type="hidden" name="redirect_to" value="<?php echo esc_attr( $redirect_to ); ?>" />
		</p>
		<p class="add-info"><?php esc_html_e('Please enter your username or email address.', 'dfd-native') ?></p>
		<p class="add-info"><?php esc_html_e('You will receive a link to create a new password via email.', 'dfd-native') ?></p>
	</form>
	<a href="#" class="dfd-close-lost-password" title="<?php esc_attr_e('close','dfd-native') ?>"></a>
</div>