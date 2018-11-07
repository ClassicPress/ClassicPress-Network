<?php

// start the user session for maintaining individual user states during the multi-stage authentication flow:
if (!isset($_SESSION)) {
    session_start();
}

require "twitteroauth/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;

# DEFINE THE OAUTH PROVIDER AND SETTINGS TO USE #
$_SESSION['WPOA']['PROVIDER'] = 'Twitter';
define('HTTP_UTIL', get_option('wpoa_http_util'));
define('CLIENT_ENABLED', get_option('wpoa_twitter_api_enabled'));
define('CLIENT_ID', get_option('wpoa_twitter_api_id'));
define('CLIENT_SECRET', get_option('wpoa_twitter_api_secret'));
define('REDIRECT_URI', rtrim(site_url(), '/') . '/');
define('SCOPE', get_option('wpoa_twitter_api_scope')); // PROVIDER SPECIFIC: 'identity.basic' is the minimum scope required to get the user's id from Twitter
// define('URL_AUTH', "https://api.twitter.com/oauth/authorize?");
// define('URL_TOKEN', "https://slack.com/api/oauth.access?");
// define('URL_USER', "https://slack.com/api/users.identity?");
# END OF DEFINE THE OAUTH PROVIDER AND SETTINGS TO USE #

// remember the user's last url so we can redirect them back to there after the login ends:
if (!$_SESSION['WPOA']['LAST_URL']) {
	// try to obtain the redirect_url from the default login page:
	$redirect_url = esc_url($_GET['redirect_to']);
	// if no redirect_url was found, set it to the user's last page:
	if (!$redirect_url) {
		$redirect_url = strtok($_SERVER['HTTP_REFERER'], "?");
	}
	// set the user's last page so we can return that user there after they login:
	$_SESSION['WPOA']['LAST_URL'] = $redirect_url;
}

# AUTHENTICATION FLOW #
// the oauth 2.0 authentication flow will start in this script and make several calls to the third-party authentication provider which in turn will make callbacks to this script that we continue to handle until the login completes with a success or failure:
if (!CLIENT_ENABLED) {
	$this->wpoa_end_login("This third-party authentication provider has not been enabled. Please notify the admin or try again later.");
}
elseif (!CLIENT_ID || !CLIENT_SECRET) {
	// do not proceed if id or secret is null:
	$this->wpoa_end_login("This third-party authentication provider has not been configured with an API key/secret. Please notify the admin or try again later.");
}
elseif (isset($_GET['error_description'])) {
	// do not proceed if an error was detected:
	$this->wpoa_end_login($_GET['error_description']);
}
elseif (isset($_GET['error_message'])) {
	// do not proceed if an error was detected:
	$this->wpoa_end_login($_GET['error_message']);
}
elseif (isset($_GET['oauth_token'])) {
		// get an access token from the third party provider:
		get_oauth_token($this);
		// get the user's third-party identity and attempt to login/register a matching wordpress user account:
		$oauth_identity = get_oauth_identity($this);
		$this->wpoa_login_user($oauth_identity);
}
else {
	// pre-auth, start the auth process:
	if ((empty($_SESSION['WPOA']['EXPIRES_AT'])) || (time() > $_SESSION['WPOA']['EXPIRES_AT'])) {
		// expired token; clear the state:
		$this->wpoa_clear_login_state();
	}
	get_oauth_code($this);
}
// we shouldn't be here, but just in case...
$this->wpoa_end_login("Sorry, we couldn't log you in. The authentication flow terminated in an unexpected way. Please notify the admin or try again later.");
# END OF AUTHENTICATION FLOW #

# AUTHENTICATION FLOW HELPER FUNCTIONS #
function get_oauth_code($wpoa) {

  $connection = new TwitterOAuth(CLIENT_ID, CLIENT_SECRET);
  $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => REDIRECT_URI));
  $_SESSION['WPOA']['oauth_token'] = $request_token['oauth_token'];
  $_SESSION['WPOA']['oauth_token_secret'] = $request_token['oauth_token_secret'];
  $url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));

	header("Location: $url");
	exit;
}

function get_oauth_token($wpoa) {
  $request_token = [];
  $request_token['oauth_token'] = $_SESSION['WPOA']['oauth_token'];
  $request_token['oauth_token_secret'] = $_SESSION['WPOA']['oauth_token_secret'];

  if (isset($_REQUEST['oauth_token']) && $request_token['oauth_token'] !== $_REQUEST['oauth_token']) {
      $this->wpoa_end_login("Twitter: Sorry, we couldn't log you in. The authentication flow terminated in an unexpected way. Please notify the admin or try again later.");
  }

  $connection = new TwitterOAuth(CLIENT_ID, CLIENT_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);

  $access_token = $connection->oauth("oauth/access_token", ["oauth_verifier" => $_REQUEST['oauth_verifier']]);
	// handle the result:
	if (!$access_token) {
		// malformed access token result detected:
		$wpoa->wpoa_end_login("Sorry, we couldn't log you in. Malformed access token result detected. Please notify the admin or try again later.");
	}
	else {
		$_SESSION['WPOA']['ACCESS_TOKEN'] = $access_token;
    $_SESSION['WPOA']['SCREENID'] = $access_token['user_id'];
    $_SESSION['WPOA']['SCREENNAME'] = $access_token['screen_name'];
		return true;
	}
}

function get_oauth_identity($wpoa) {
	// here we exchange the access token for the user info...
	// set the access token param:
  $access_token =  $_SESSION['WPOA']['ACCESS_TOKEN'];  // PROVIDER SPECIFIC: the access token is passed to twitter using this key name

  $result_obj['id'] = $_SESSION['WPOA']['SCREENID'];
  $result_obj['screen_name'] = $_SESSION['WPOA']['SCREENNAME'];

	// parse and return the user's oauth identity:
	$oauth_identity = array();
	$oauth_identity['provider'] = $_SESSION['WPOA']['PROVIDER'];
	$oauth_identity['id'] = $result_obj['id']; // PROVIDER SPECIFIC: this is how Slack returns the user's unique id
	$oauth_identity['login'] = $result_obj['screen_name']; //PROVIDER SPECIFIC: this is how Slack returns the email address
	if (!$oauth_identity['id']) {
		$wpoa->wpoa_end_login("ID_missing: Sorry, we couldn't log you in. User identity was not found. Please notify the admin or try again later.");
	}
	return $oauth_identity;
}
# END OF AUTHENTICATION FLOW HELPER FUNCTIONS #
?>
