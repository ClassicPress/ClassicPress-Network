
<!-- START Login with LinkedIn section -->
<div id="wpoa-settings-section-login-with-linkedin" class="wpoa-settings-section">
<h3>Login with LinkedIn</h3>
<div class='form-padding'>
<table class='form-table'>
  <tr valign='top'>
  <th scope='row'>Enabled:</th>
  <td>
    <input type='checkbox' name='wpoa_linkedin_api_enabled' value='1' <?php checked(get_option('wpoa_linkedin_api_enabled') == 1); ?> />
  </td>
  </tr>

  <tr valign='top'>
  <th scope='row'>API Key:</th>
  <td>
    <input type='text' name='wpoa_linkedin_api_id' value='<?php echo get_option('wpoa_linkedin_api_id'); ?>' />
  </td>
  </tr>

  <tr valign='top'>
  <th scope='row'>Secret Key:</th>
  <td>
    <input type='text' name='wpoa_linkedin_api_secret' value='<?php echo get_option('wpoa_linkedin_api_secret'); ?>' />
  </td>
  </tr>

  <tr valign='top' class="has-tip">
  <th scope='row'>LinkedIn Scope: <a href="#" class="tip-button">[?]</a></th>
  <td>
      <input type='text' name='wpoa_linkedin_api_scope' value='<?php echo get_option('wpoa_linkedin_api_scope'); ?>' />
    <p class="tip-message">Scopes let you specify exactly what type of access you need. These are displayed to the user on the authorization form.</p>
  </td>
  </tr>

</table> <!-- .form-table -->
<p>
  <strong>Instructions:</strong>
  <ol>
    <li>Register as a LinkedIn Developer at <a href='https://developers.linkedin.com/' target="_blank">developers.linkedin.com</a>.</li>
    <li>At LinkedIn, create a new App. This will enable your site to access the LinkedIn API.</li>
    <li>At LinkedIn, provide your site's homepage URL (<?php echo $blog_url; ?>) for the new App's Redirect URI. Don't forget the trailing slash!</li>
    <li>Paste your API Key/Secret provided by LinkedIn into the fields above.</li>
    <li>Add your scope. Recommended Scope is <b><u>r_basicprofile</u></b></li>
    <li>Then click the Save all settings button.</li>
  </ol>
</p>
<?php submit_button('Save all settings'); ?>
</div> <!-- .form-padding -->
</div> <!-- .wpoa-settings-section -->
<!-- END Login with LinkedIn section -->
