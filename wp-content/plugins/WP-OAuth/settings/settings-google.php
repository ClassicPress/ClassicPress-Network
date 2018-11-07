<!-- START Login with Google section -->
<div id="wpoa-settings-section-login-with-google" class="wpoa-settings-section">
<h3>Login with Google</h3>
<div class='form-padding'>
<table class='form-table'>
  <tr valign='top'>
  <th scope='row'>Enabled:</th>
  <td>
    <input type='checkbox' name='wpoa_google_api_enabled' value='1' <?php checked(get_option('wpoa_google_api_enabled') == 1); ?> />
  </td>
  </tr>

  <tr valign='top'>
  <th scope='row'>Client ID:</th>
  <td>
    <input type='text' name='wpoa_google_api_id' value='<?php echo get_option('wpoa_google_api_id'); ?>' />
  </td>
  </tr>

  <tr valign='top'>
  <th scope='row'>Client Secret:</th>
  <td>
    <input type='text' name='wpoa_google_api_secret' value='<?php echo get_option('wpoa_google_api_secret'); ?>' />
  </td>
  </tr>

  <tr valign='top' class="has-tip">
  <th scope='row'>Google Scope: <a href="#" class="tip-button">[?]</a></th>
  <td>
      <input type='text' name='wpoa_google_api_scope' value='<?php echo get_option('wpoa_google_api_scope'); ?>' />
    <p class="tip-message">Scopes let you specify exactly what type of access you need. These are displayed to the user on the authorization form.</p>
  </td>
  </tr>

</table> <!-- .form-table -->
<p>
  <strong>Instructions:</strong>
  <ol>
    <li>Visit the Google website for developers <a href='https://console.developers.google.com/project' target="_blank">console.developers.google.com</a>.</li>
    <li>At Google, create a new Project and enable the Google+ API. This will enable your site to access the Google+ API.</li>
    <li>At Google, provide your site's homepage URL (<?php echo $blog_url; ?>) for the new Project's Redirect URI. Don't forget the trailing slash!</li>
    <li>At Google, you must also configure the Consent Screen with your Email Address and Product Name. This is what Google will display to users when they are asked to grant access to your site/app.</li>
    <li>Paste your Client ID/Secret provided by Google into the fields above.</li>
    <li>Add your scope. Recommended Scope is <b><u>profile</u></b></li>
    <li>then click the Save all settings button.</li>
  </ol>
</p>
<?php submit_button('Save all settings'); ?>
</div> <!-- .form-padding -->
</div> <!-- .wpoa-settings-section -->
<!-- END Login with Google section -->
