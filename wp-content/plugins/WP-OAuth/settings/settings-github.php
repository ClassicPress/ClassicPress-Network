<!-- START Login with Github section -->
<div id="wpoa-settings-section-login-with-github" class="wpoa-settings-section">
<h3>Login with Github</h3>
<div class='form-padding'>
<table class='form-table'>
  <tr valign='top'>
  <th scope='row'>Enabled:</th>
  <td>
    <input type='checkbox' name='wpoa_github_api_enabled' value='1' <?php checked(get_option('wpoa_github_api_enabled') == 1); ?> />
  </td>
  </tr>

  <tr valign='top'>
  <th scope='row'>Client ID:</th>
  <td>
    <input type='text' name='wpoa_github_api_id' value='<?php echo get_option('wpoa_github_api_id'); ?>' />
  </td>
  </tr>

  <tr valign='top'>
  <th scope='row'>Client Secret:</th>
  <td>
    <input type='text' name='wpoa_github_api_secret' value='<?php echo get_option('wpoa_github_api_secret'); ?>' />
  </td>
  </tr>

  <tr valign='top' class="has-tip">
  <th scope='row'>Github Scope: <a href="#" class="tip-button">[?]</a></th>
  <td>
      <input type='text' name='wpoa_github_api_scope' value='<?php echo get_option('wpoa_github_api_scope'); ?>' />
    <p class="tip-message">Scopes let you specify exactly what type of access you need. These are displayed to the user on the authorization form.</p>
  </td>
  </tr>

</table> <!-- .form-table -->
<p>
  <strong>Instructions:</strong>
  <ol>
    <li>Register as a Github Developer at <a href='https://developers.github.com/' target="_blank">developers.github.com</a>.</li>
    <li>At Github, create a new App. This will enable your site to access the Github API.</li>
    <li>At Github, provide your site's homepage URL (<?php echo $blog_url; ?>) for the new App's Redirect URI. Don't forget the trailing slash!</li>
    <li>Paste your API Key/Secret provided by Github into the fields above, then click the Save all settings button.</li>
    <li>Recommended Scope is <b><u>read:user user:email</u></b></li>
  </ol>
</p>
<?php submit_button('Save all settings'); ?>
</div> <!-- .form-padding -->
</div> <!-- .wpoa-settings-section -->
<!-- END Login with Github section -->
