<!-- START Login with Twitter section -->
<div id="wpoa-settings-section-login-with-twitter" class="wpoa-settings-section">
<h3>Login with Twitter</h3>
<div class='form-padding'>
<table class='form-table'>
  <tr valign='top'>
  <th scope='row'>Enabled:</th>
  <td>
    <input type='checkbox' name='wpoa_twitter_api_enabled' value='1' <?php checked(get_option('wpoa_twitter_api_enabled') == 1); ?> />
  </td>
  </tr>

  <tr valign='top'>
  <th scope='row'>API key:</th>
  <td>
    <input type='text' name='wpoa_twitter_api_id' value='<?php echo get_option('wpoa_twitter_api_id'); ?>' />
  </td>
  </tr>

  <tr valign='top'>
  <th scope='row'>API secret key:</th>
  <td>
    <input type='text' name='wpoa_twitter_api_secret' value='<?php echo get_option('wpoa_twitter_api_secret'); ?>' />
  </td>
  </tr>

</table> <!-- .form-table -->

<p>
  <strong>Instructions:</strong>
  <ol>
    <li>Visit the <a href='https://developer.twitter.com' target="_blank">Twitter Developer</a> home page and <a href='https://developer.twitter.com/en/apps/' target="_blank">Create a Twitter App</a>.
    <li>After creating your account and signing in, visit the <em>Keys and tokens</em> page.</li>
    <li>Copy over the <em>Consumer API keys</em>.</li>
    <li>Provide your site URL (<?php echo site_url('', 'https'); ?>/) for the <em>Register Callback URL</em> under <em>App details</em>. Don't forget the trailing slash!</li>
    <li>Then click the Save all settings button.</li>
  </ol>
</p>
<?php submit_button('Save all settings'); ?>
</div> <!-- .form-padding -->
</div> <!-- .wpoa-settings-section -->
<!-- END Login with Twitter section -->
