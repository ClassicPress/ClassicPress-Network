<?php
	// config check security
	function wpoa_cc_security() {
		$points = 0;
		if (strpos(site_url(), "https://")) {
			$points += 2;
		}
		if (get_option('wpoa_hide_wordpress_login_form') == 1) {
			$points += 1;
		}
		if (get_option('wpoa_logout_inactive_users') > 0) {
			$points += 1;
		}
		if (get_option('wpoa_http_util_verify_ssl') == 1) {
			$points += 1;
		}
		if (get_option('wpoa_http_util') == 'curl') {
			$points += 1;
		}
		$points_max = 6;
		return floor(($points / $points_max) * 100);
	}
	// config check privacy
	function wpoa_cc_privacy() {
		$points = 0;
		if (get_option('wpoa_logout_inactive_users') > 0) {
			$points += 1;
		}
		// TODO: +1 for NOT using email address matching
		$points_max = 1;
		return floor(($points / $points_max) * 100);
	}
	// config check user experience
	function wpoa_cc_ux() {
		$points = 0;
		if (get_option('wpoa_logo_links_to_site') == 1) {
			$points += 1;
		}
		if (get_option('wpoa_show_login_messages') == 1) {
			$points += 1;
		}
		$points_max = 2;
		return floor(($points / $points_max) * 100);
	}
	// cache the config check ratings:
	$cc_security = wpoa_cc_security();
	$cc_privacy = wpoa_cc_privacy();
	$cc_ux = wpoa_cc_ux();
?>



<div class='wrap wpoa-settings'>
	<div id="wpoa-settings-meta">Toggle tips: <ul><li><a id="wpoa-settings-tips-on" href="#">On</a></li><li><a id="wpoa-settings-tips-off" href="#">Off</a></li></ul><div class="nav-splitter"></div>Toggle sections: <ul><li><a id="wpoa-settings-sections-on" href="#">On</a></li><li><a id="wpoa-settings-sections-off" href="#">Off</a></li></ul></div>
	<h2>WP-OAuth Settings</h2>
	<!-- START Settings Header -->
	<div id="wpoa-settings-header"></div>
	<!-- END Settings Header -->
	<!-- START Settings Body -->
	<div id="wpoa-settings-body">
	<br><!-- START Settings Column 2 -->
	<div id="wpoa-settings-col2" class="wpoa-settings-column">
		<div id="wpoa-settings-section-config-check" class="wpoa-settings-section">
		<h3>Config Check</h3>
			<div class='form-padding'>
				<p>These ratings are an estimate of <em>this plugin's current configuration</em> when compared to an optimum configuration.</p>
				<div id='wpoa-measurements'>
					<div class="has-tip">
						<div class="wpoa-measurement-label">Security: <?php echo $cc_security; ?>% <a href="#" class="tip-button">[?]</a></div>
						<div class="wpoa-measurement"><div class="wpoa-measurement-rating" style="width:<?php echo $cc_security; ?>%;"></div></div>
						<p class="tip-message">
							+2 if site is secured with an SSL certificate<br/>
							+1 if Verify Peer/Host SSL Certificates = True<br/>
							+1 if Hide the WordPress login form = True<br/>
							+1 if Automatically logout inactive users = True<br/>
							+1 if HTTP Utility = cURL<br/>
						</p>
					</div>
					<div class="has-tip">
						<div class="wpoa-measurement-label">Privacy: <?php echo $cc_privacy; ?>% <a href="#" class="tip-button">[?]</a></div>
						<div class="wpoa-measurement"><div class="wpoa-measurement-rating" style="width:<?php echo $cc_privacy; ?>%;"></div></div>
						<p class="tip-message">
							+1 if Automatically logout inactive users = True<br/>
						</p>
					</div>
					<div class="has-tip">
						<div class="wpoa-measurement-label">User Experience: <?php echo $cc_ux; ?>% <a href="#" class="tip-button">[?]</a></div>
						<div class="wpoa-measurement"><div class="wpoa-measurement-rating" style="width:<?php echo $cc_ux; ?>%;"></div></div>
						<p class="tip-message">
							+1 if Logo links to site = True<br/>
							+1 if Show login messages = True<br/>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END Settings Column 2 -->
	<!-- START Settings Column 1 -->
	<div id="wpoa-settings-col1" class="wpoa-settings-column">
		<form method='post' action='options.php'>
			<?php settings_fields('wpoa_settings'); ?>
			<?php do_settings_sections('wpoa_settings'); ?>
			<!-- START General Settings section -->
			<div id="wpoa-settings-section-general-settings" class="wpoa-settings-section">
			<h3>General Settings</h3>
			<div class='form-padding'>
			<table class='form-table'>
				<tr valign='top' class='has-tip' class="has-tip">
				<th scope='row'>Show login messages: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<input type='checkbox' name='wpoa_show_login_messages' value='1' <?php checked(get_option('wpoa_show_login_messages') == 1); ?> />
					<p class="tip-message">Shows a short-lived notification message to the user which indicates whether or not the login was successful, and if there was an error.</p>
				</td>
				</tr>
				<tr valign='top' class="has-tip">
				<th scope='row'>Login redirects to: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<select name='wpoa_login_redirect'>
						<option value='home_page' <?php selected(get_option('wpoa_login_redirect'), 'home_page'); ?>>Home Page</option>
						<option value='last_page' <?php selected(get_option('wpoa_login_redirect'), 'last_page'); ?>>Last Page</option>
						<option value='specific_page' <?php selected(get_option('wpoa_login_redirect'), 'specific_page'); ?>>Specific Page</option>
						<option value='admin_dashboard' <?php selected(get_option('wpoa_login_redirect'), 'admin_dashboard'); ?>>Admin Dashboard</option>
						<option value='user_profile' <?php selected(get_option('wpoa_login_redirect'), 'user_profile'); ?>>User's Profile Page</option>
						<option value='custom_url' <?php selected(get_option('wpoa_login_redirect'), 'custom_url'); ?>>Custom URL</option>
					</select>
					<?php wp_dropdown_pages(array("id" => "wpoa_login_redirect_page", "name" => "wpoa_login_redirect_page", "selected" => get_option('wpoa_login_redirect_page'))); ?>
					<input type="text" name="wpoa_login_redirect_url" value="<?php echo get_option('wpoa_login_redirect_url'); ?>" style="display:none;" />
					<p class="tip-message">Specifies where to redirect a user after they log in.</p>
				</td>
				</tr>
				<tr valign='top' class="has-tip">
				<th scope='row'>Logout redirects to: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<select name='wpoa_logout_redirect'>
						<option value='default_handling' <?php selected(get_option('wpoa_logout_redirect'), 'default_handling'); ?>>Let WordPress handle it</option>
						<option value='home_page' <?php selected(get_option('wpoa_logout_redirect'), 'home_page'); ?>>Home Page</option>
						<option value='last_page' <?php selected(get_option('wpoa_logout_redirect'), 'last_page'); ?>>Last Page</option>
						<option value='specific_page' <?php selected(get_option('wpoa_logout_redirect'), 'specific_page'); ?>>Specific Page</option>
						<option value='admin_dashboard' <?php selected(get_option('wpoa_logout_redirect'), 'admin_dashboard'); ?>>Admin Dashboard</option>
						<option value='user_profile' <?php selected(get_option('wpoa_logout_redirect'), 'user_profile'); ?>>User's Profile Page</option>
						<option value='custom_url' <?php selected(get_option('wpoa_logout_redirect'), 'custom_url'); ?>>Custom URL</option>
					</select>
					<?php wp_dropdown_pages(array("id" => "wpoa_logout_redirect_page", "name" => "wpoa_logout_redirect_page", "selected" => get_option('wpoa_logout_redirect_page'))); ?>
					<input type="text" name="wpoa_logout_redirect_url" value="<?php echo get_option('wpoa_logout_redirect_url'); ?>" style="display:none;" />
					<p class="tip-message">Specifies where to redirect a user after they log out.</p>
				</td>
				</tr>
				<tr valign='top' class="has-tip">
				<th scope='row'>Automatically logout inactive users: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<select name='wpoa_logout_inactive_users'>
						<option value='0' <?php selected(get_option('wpoa_logout_inactive_users'), '0'); ?>>Never</option>
						<option value='1' <?php selected(get_option('wpoa_logout_inactive_users'), '1'); ?>>After 1 minute</option>
						<option value='5' <?php selected(get_option('wpoa_logout_inactive_users'), '5'); ?>>After 5 minutes</option>
						<option value='15' <?php selected(get_option('wpoa_logout_inactive_users'), '15'); ?>>After 15 minutes</option>
						<option value='30' <?php selected(get_option('wpoa_logout_inactive_users'), '30'); ?>>After 30 minutes</option>
						<option value='60' <?php selected(get_option('wpoa_logout_inactive_users'), '60'); ?>>After 1 hour</option>
						<option value='120' <?php selected(get_option('wpoa_logout_inactive_users'), '120'); ?>>After 2 hours</option>
						<option value='240' <?php selected(get_option('wpoa_logout_inactive_users'), '240'); ?>>After 4 hours</option>
					</select>
					<p class="tip-message">Specifies whether to log out users automatically after a period of inactivity.</p>
					<p class="tip-message tip-warning"><strong>Warning:</strong> When a user logs out of WordPress, they will remain logged into their third-party provider until they close their browser. Logging out of WordPress DOES NOT log you out of Google, Facebook, LinkedIn, etc...</p>
				</td>
				</tr>
			</table> <!-- .form-table -->
			<?php submit_button('Save all settings'); ?>
			</div> <!-- .form-padding -->
			</div> <!-- .wpoa-settings-section -->
			<!-- END General Settings section -->
			<!-- START Login Page & Form Customization section -->
			<div id="wpoa-settings-section-login-forms" class="wpoa-settings-section">
			<h3>Login Forms</h3>
			<div class='form-padding'>
			<table class='form-table'>
				<tr valign='top'>
				<th colspan="2">
					<h4>Default Login Form / Page / Popup</h4>
				</th>
				</td>
				<tr valign='top' class="has-tip">
				<th scope='row'>Hide the WordPress login form: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<input type='checkbox' name='wpoa_hide_wordpress_login_form' value='1' <?php checked(get_option('wpoa_hide_wordpress_login_form') == 1); ?> />
					<p class="tip-message">Use this to hide the WordPress username/password login form that is shown by default on the Login Screen and Login Popup.</p>
					<p class="tip-message tip-warning"><strong>Warning: </strong>Hiding the WordPress login form may prevent you from being able to login. If you normally rely on this method, DO NOT enable this setting. Furthermore, please make sure your login provider(s) are active and working BEFORE enabling this setting.</p>
				</td>
				</tr>
				<tr valign='top' class="has-tip">
				<th scope='row'>Logo links to site: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<input type='checkbox' name='wpoa_logo_links_to_site' value='1' <?php checked(get_option('wpoa_logo_links_to_site') == 1); ?> />
					<p class="tip-message">Forces the logo image on the login form to link to your site instead of WordPress.org.</p>
				</td>
				</tr>
				<tr valign='top' class="has-tip">
				<th scope='row'>Logo image: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<p>
					<input id='wpoa_logo_image' type='text' size='' name='wpoa_logo_image' value="<?php echo get_option('wpoa_logo_image'); ?>" />
					<input id='wpoa_logo_image_button' type='button' class='button' value='Select' />
					</p>
					<p class="tip-message">Changes the default WordPress logo on the login form to an image of your choice. You may select an image from the Media Library, or specify a custom URL.</p>
				</td>
				</tr>
				<tr valign='top' class="has-tip">
				<th scope='row'>Background image: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<p>
					<input id='wpoa_bg_image' type='text' size='' name='wpoa_bg_image' value="<?php echo get_option('wpoa_bg_image'); ?>" />
					<input id='wpoa_bg_image_button' type='button' class='button' value='Select' />
					</p>
					<p class="tip-message">Changes the background on the login form to an image of your choice. You may select an image from the Media Library, or specify a custom URL.</p>
				</td>
				</tr>
				<tr valign='top'>
				<th colspan="2">
					<h4>Custom Login Forms</h4>
				</th>
				</td>
				<tr valign='top' class="has-tip">
				<th scope='row'>Custom form to show on the login screen: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<?php echo WPOA::wpoa_login_form_designs_selector('wpoa-login-form-show-login-screen'); ?>
					<p class="tip-message">Create or manage these login form designs in the CUSTOM LOGIN FORM DESIGNS section.</p>
				</td>
				</tr>
				<tr valign='top' class="has-tip">
				<th scope='row'>Custom form to show on the user's profile page: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<?php echo WPOA::wpoa_login_form_designs_selector('wpoa-login-form-show-profile-page'); ?>
					<p class="tip-message">Create or manage these login form designs in the CUSTOM LOGIN FORM DESIGNS section.</p>
				</td>
				</tr>
				<tr valign='top' class="has-tip">
				<th scope='row'>Custom form to show in the comments section: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<?php echo WPOA::wpoa_login_form_designs_selector('wpoa-login-form-show-comments-section'); ?>
					<p class="tip-message">Create or manage these login form designs in the CUSTOM LOGIN FORM DESIGNS section.</p>
				</td>
				</tr>
			</table> <!-- .form-table -->
			<?php submit_button('Save all settings'); ?>
			</div> <!-- .form-padding -->
			</div> <!-- .wpoa-settings-section -->
			<!-- END Login Page & Form Customization section -->

			<!-- START Custom Login Form Designs section -->
			<div id="wpoa-settings-section-custom-login-form-designs" class="wpoa-settings-section">
			<h3>Custom Login Form Designs</h3>
			<div class='form-padding'>
			<p>You may create multiple login form <strong><em>designs</em></strong> and use them throughout your site. A design is essentially a re-usable <em>shortcode preset</em>. Instead of writing out the login form shortcode ad-hoc each time you want to use it, you can build a design here, save it, and then specify that design in the shortcode's <em>design</em> attribute. For example: <pre><code>[wpoa_login_form design='CustomDesign1']</code></pre></p>
			<table class='form-table'>
				<tr valign='top' class="has-tip">
				<th scope='row'>Design: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<?php echo WPOA::wpoa_login_form_designs_selector('wpoa-login-form-design', true); ?>
					<p>
					<input type="button" id="wpoa-login-form-new" class="button" value="New">
					<input type="button" id="wpoa-login-form-edit" class="button" value="Edit">
					<input type="button" id="wpoa-login-form-delete" class="button" value="Delete">
					</p>
					<p class="tip-message">Here you may create a new design, select an existing design to edit, or delete an existing design.</p>
					<p class="tip-message tip-info"><strong>Tip: </strong>Make sure to click the <em>Save all settings</em> button after making changes here.</p>
				</td>
				</tr>
			</table> <!-- .form-table -->

			<table class="form-table" id="wpoa-login-form-design-form">
				<tr valign='top'>
				<th colspan="2">
					<h4>Edit Design</h4>
				</th>
				</td>

				<tr valign='top' class="has-tip">
				<th scope='row'>Design name: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<input id='wpoa-login-form-design-name' type='text' size='36' name='wpoa_login_form_design_name' value="" />
					<p class="tip-message">Sets the name to use for this design.</p>
				</td>
				</tr>

				<tr valign='top' class="has-tip">
				<th scope='row'>Icon set: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<select name='wpoa_login_form_icon_set'>
						<option value='none'>None</option>
						<option value='hex'>Hex</option>
					</select>
					<p class="tip-message">Specifies which icon set to use for displaying provider icons on the login buttons.</p>
				</td>
				</tr>

				<tr valign='top' class="has-tip">
				<th scope='row'>Show login buttons: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<select name='wpoa_login_form_show_login'>
						<option value='always'>Always</option>
						<option value='conditional'>Conditional</option>
						<option value='never'>Never</option>
					</select>
					<p class="tip-message">Determines when the login buttons should be shown.</p>
				</td>
				</tr>

				<tr valign='top' class="has-tip">
				<th scope='row'>Show logout button: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<select name='wpoa_login_form_show_logout'>
						<option value='always'>Always</option>
						<option value='conditional'>Conditional</option>
						<option value='never'>Never</option>
					</select>
					<p class="tip-message">Determines when the logout button should be shown.</p>
				</td>
				</tr>

				<tr valign='top' class="has-tip">
				<th scope='row'>Layout: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<select name='wpoa_login_form_layout'>
						<option value='links-row'>Links Row</option>
						<option value='links-column'>Links Column</option>
						<option value='buttons-row'>Buttons Row</option>
						<option value='buttons-column'>Buttons Column</option>
					</select>
					<p class="tip-message">Sets vertical or horizontal layout for the buttons.</p>
				</td>
				</tr>

				<tr valign='top' class="has-tip">
				<th scope='row'>Login button prefix: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<input id='wpoa_login_form_button_prefix' type='text' size='36' name='wpoa_login_form_button_prefix' value="" />
					<p class="tip-message">Sets the text prefix to be displayed on the social login buttons.</p>
				</td>
				</tr>

				<tr valign='top' class="has-tip">
				<th scope='row'>Logged out title: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<input id='wpoa_login_form_logged_out_title' type='text' size='36' name='wpoa_login_form_logged_out_title' value="" />
					<p class="tip-message">Sets the text to be displayed above the login form for logged out users.</p>
				</td>
				</tr>

				<tr valign='top' class="has-tip">
				<th scope='row'>Logged in title: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<input id='wpoa_login_form_logged_in_title' type='text' size='36' name='wpoa_login_form_logged_in_title' value="" />
					<p class="tip-message">Sets the text to be displayed above the login form for logged in users.</p>
				</td>
				</tr>

				<tr valign='top' class="has-tip">
				<th scope='row'>Logging in title: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<input id='wpoa_login_form_logging_in_title' type='text' size='36' name='wpoa_login_form_logging_in_title' value="" />
					<p class="tip-message">Sets the text to be displayed above the login form for users who are logging in.</p>
				</td>
				</tr>

				<tr valign='top' class="has-tip">
				<th scope='row'>Logging out title: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<input id='wpoa_login_form_logging_out_title' type='text' size='36' name='wpoa_login_form_logging_out_title' value="" />
					<p class="tip-message">Sets the text to be displayed above the login form for users who are logging out.</p>
				</td>
				</tr>

				<tr valign='top' id='wpoa-login-form-actions'>
				<th scope='row'>
					<input type="button" id="wpoa-login-form-ok" name="wpoa_login_form_ok" class="button" value="OK">
					<input type="button" id="wpoa-login-form-cancel" name="wpoa_login_form_cancel" class="button" value="Cancel">
				</th>
				<td>

				</td>
				</tr>
			</table> <!-- .form-table -->
			<?php submit_button('Save all settings'); ?>
			</div> <!-- .form-padding -->
			</div> <!-- .wpoa-settings-section -->
			<!-- END Login Buttons section -->

			<!-- START User Registration section -->
			<div id="wpoa-settings-section-user-registration" class="wpoa-settings-section">
			<h3>User Registration</h3>
			<div class='form-padding'>
			<table class='form-table'>
				<tr valign='top' class="has-tip">
				<th scope='row'>Suppress default welcome email: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<input type='checkbox' name='wpoa_suppress_welcome_email' value='1' <?php checked(get_option('wpoa_suppress_welcome_email') == 1); ?> />
					<p class="tip-message">Prevents WordPress from sending an email to newly registered users by default, which contains their username and password.</p>
				</td>
				</tr>

				<tr valign='top' class="has-tip">
				<th scope='row'>Assign new users to the following role: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<select name="wpoa_new_user_role"><?php wp_dropdown_roles(get_option('wpoa_new_user_role')); ?></select>
					<p class="tip-message">Specifies what user role will be assigned to newly registered users.</p>
				</td>
				</tr>
			</table> <!-- .form-table -->
			<?php submit_button('Save all settings'); ?>
			</div> <!-- .form-padding -->
			</div> <!-- .wpoa-settings-section -->
			<!-- END User Registration section -->


			<?php
					include('settings/settings-facebook.php');
					include('settings/settings-google.php');
					include('settings/settings-linkedin.php');
					include('settings/settings-slack.php');
					include('settings/settings-github.php');
					include('settings/settings-oauth_server.php');
			 ?>

			<!-- START Back Channel Configuration section -->
			<div id="wpoa-settings-section-back-channel=configuration" class="wpoa-settings-section">
			<h3>Back Channel Configuration</h3>
			<div class='form-padding'>
			<p>These settings are for troubleshooting and/or fine tuning the back channel communication this plugin utilizes between your server and the third-party providers.</p>
			<table class='form-table'>
				<tr valign='top' class="has-tip">
				<th scope='row'>HTTP utility: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<select name='wpoa_http_util'>
						<option value='curl' <?php selected(get_option('wpoa_http_util'), 'curl'); ?>>cURL</option>
						<option value='stream-context' <?php selected(get_option('wpoa_http_util'), 'stream-context'); ?>>Stream Context</option>
					</select>
					<p class="tip-message">The method used by the web server for performing HTTP requests to the third-party providers. Most servers support cURL, but some servers may require Stream Context instead.</p>
				</td>
				</tr>

				<tr valign='top' class="has-tip">
				<th scope='row'>Verify Peer/Host SSL Certificates: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<input type='checkbox' name='wpoa_http_util_verify_ssl' value='1' <?php checked(get_option('wpoa_http_util_verify_ssl') == 1); ?> />
					<p class="tip-message">Determines whether or not to validate peer/host SSL certificates during back channel HTTP calls to the third-party login providers. If your server has an incorrect SSL configuration or doesn't support SSL, you may try disabling this setting as a workaround.</p>
					<p class="tip-message tip-warning"><strong>Warning:</strong> Disabling this is not recommended. For maximum security it would be a good idea to get your server's SSL configuration fixed and keep this setting enabled.</p>
				</td>
				</tr>
			</table> <!-- .form-table -->
			<?php submit_button('Save all settings'); ?>
			</div> <!-- .form-padding -->
			</div> <!-- .wpoa-settings-section -->
			<!-- END Back Channel Configuration section -->

			<!-- START Maintenance & Troubleshooting section -->
			<div id="wpoa-settings-section-maintenance-troubleshooting" class="wpoa-settings-section">
			<h3>Maintenance & Troubleshooting</h3>
			<div class='form-padding'>
			<table class='form-table'>
				<tr valign='top' class="has-tip">
				<th scope='row'>Restore default settings: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<input type='checkbox' name='wpoa_restore_default_settings' value='1' <?php checked(get_option('wpoa_restore_default_settings') == 1); ?> />
					<p class="tip-message"><strong>Instructions:</strong> Check the box above, click the Save all settings button, and the settings will be restored to default.</p>
					<p class="tip-message tip-warning"><strong>Warning:</strong> This will restore the default settings, erasing any API keys/secrets that you may have entered above.</p>
				</td>
				</tr>
				<tr valign='top' class="has-tip">
				<th scope='row'>Delete settings on uninstall: <a href="#" class="tip-button">[?]</a></th>
				<td>
					<input type='checkbox' name='wpoa_delete_settings_on_uninstall' value='1' <?php checked(get_option('wpoa_delete_settings_on_uninstall') == 1); ?> />
					<p class="tip-message"><strong>Instructions:</strong> Check the box above, click the Save all settings button, then uninstall this plugin as normal from the Plugins page.</p>
					<p class="tip-message tip-warning"><strong>Warning:</strong> This will delete all settings that may have been created in your database by this plugin, including all linked third-party login providers. This will not delete any WordPress user accounts, but users who may have registered with or relied upon their third-party login providers may have trouble logging into your site. Make absolutely sure you won't need the values on this page any time in the future, because they will be deleted permanently.</p>
				</td>
				</tr>
			</table> <!-- .form-table -->
			<?php submit_button('Save all settings'); ?>
			</div> <!-- .form-padding -->
			</div> <!-- .wpoa-settings-section -->
			<!-- END  Maintenance & Troubleshooting section -->
		</form> <!-- form -->
	</div>
	<!-- END Settings Column 1 -->
	</div> <!-- #wpoa-settings-body -->
	<!-- END Settings Body -->
</div> <!-- .wrap .wpoa-settings -->
