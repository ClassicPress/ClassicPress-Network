<!-- START Login with WP OAuth Server section -->
<div id="wpoa-settings-section-login-with-wp-oauth-server" class="wpoa-settings-section">
<h3>Login with WP OAuth Server</h3>
<div class='form-padding'>
<table class='form-table'>
  <tr valign='top'>
  <th scope='row'>Enabled:</th>
  <td>
    <input type='checkbox' name='wpoa_oauth_server_api_enabled' value='1' <?php checked(get_option('wpoa_oauth_server_api_enabled') == 1); ?> />
  </td>
  </tr>

  <tr valign='top'>
  <th scope='row'>Client ID:</th>
  <td>
    <input type='text' name='wpoa_oauth_server_api_id' value='<?php echo get_option('wpoa_oauth_server_api_id'); ?>' />
  </td>
  </tr>

  <tr valign='top'>
  <th scope='row'>Client Secret:</th>
  <td>
    <input type='text' name='wpoa_oauth_server_api_secret' value='<?php echo get_option('wpoa_oauth_server_api_secret'); ?>' />
  </td>
  </tr>

  <tr valign='top'>
  <th scope='row'>OAuth Server Endpoint:</th>
  <td>
    <input type='text' name='wpoa_oauth_server_api_endpoint' value='<?php echo get_option('wpoa_oauth_server_api_endpoint'); ?>' />
  </td>
  </tr>

  <tr valign='top'>
  <th scope='row'>Login Button Text:</th>
  <td>
    <input type='text' name='wpoa_oauth_server_api_button_text' value='<?php echo get_option('wpoa_oauth_server_api_button_text'); ?>' />
  </td>
  </tr>
</table> <!-- .form-table -->
<p>
  <strong>Instructions:</strong>
  <ol>
    <li>Log into the WordPress website that is running WP OAuth Server.</li>
    <li>Go to OAuth Server and click on the "Clients" tab.</li>
    <li>Click on "Add New Client" and follow the instructions.</li>
    <li>Use <strong><?php echo $blog_url; ?></strong> as the Redirect URI. Click "Add Client".</li>
    <li>Provide a login provider name as the button text option above. Login with "My OAuth Server". This text will show on the login button.</li>
    <li>Paste your Client ID/Secret provided by WP OAuth Server into the fields above, then click the Save all settings button.</li>
  </ol>
</p>
<?php submit_button('Save all settings'); ?>
</div> <!-- .form-padding -->
</div> <!-- .wpoa-settings-section -->
<!-- END Login with WP OAuth Server section -->
