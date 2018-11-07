
<!-- START Login with Slack section -->
<div id="wpoa-settings-section-login-with-slack" class="wpoa-settings-section">
<h3>Login with Slack</h3>
<div class='form-padding'>
<table class='form-table'>
  <tr valign='top'>
  <th scope='row'>Enabled:</th>
  <td>
    <input type='checkbox' name='wpoa_slack_api_enabled' value='1' <?php checked(get_option('wpoa_slack_api_enabled') == 1); ?> />
  </td>
  </tr>

  <tr valign='top'>
  <th scope='row'>Client ID:</th>
  <td>
    <input type='text' name='wpoa_slack_api_id' value='<?php echo get_option('wpoa_slack_api_id'); ?>' />
  </td>
  </tr>

  <tr valign='top'>
  <th scope='row'>Client Secret:</th>
  <td>
    <input type='text' name='wpoa_slack_api_secret' value='<?php echo get_option('wpoa_slack_api_secret'); ?>' />
  </td>
  </tr>

  <tr valign='top' class="has-tip">
  <th scope='row'>Slack Scope: <a href="#" class="tip-button">[?]</a></th>
  <td>
      <input type='text' name='wpoa_slack_api_scope' value='<?php echo get_option('wpoa_slack_api_scope'); ?>' />
    <p class="tip-message">Scopes let you specify exactly what type of access you need. These are displayed to the user on the authorization form.</p>
  </td>
  </tr>

</table> <!-- .form-table -->

<p>
  <strong>Instructions:</strong>
  <ol>
    <li>Visit your <a href='https://api.slack.com/apps' target="_blank">Slack Apps</a>.
    <li>Copy over your app's <em>Client ID</em> & <em>Client Secret</em>.</li>
    <li>Provide your site URL (<?php echo site_url('', 'https'); ?>/) for the <em>Register Callback URL</em>. Don't forget the trailing slash!</li>
    <li>Add your scope. Recommended Scope is <b><u>identity.basic identity.email</u></b></li>
    <li>Then click the Save all settings button.</li>
  </ol>
</p>
<?php submit_button('Save all settings'); ?>
</div> <!-- .form-padding -->
</div> <!-- .wpoa-settings-section -->
<!-- END Login with Slack section -->
