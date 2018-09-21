<?php

// TODO: very important that we sanitize all $_POST variables here before using them!
// TODO: this doesn't call wpoa_end_login() which might result in the LAST_URL not being cleared...

global $wpdb;

// initiate the user session:
session_start();
$token = $_SESSION['WPOA']['ACCESS_TOKEN'];
$provider = $_SESSION['WPOA']['PROVIDER'];

// prevent users from registering if the option is turned off in the dashboard:
if (!get_option("users_can_register") && !get_option("wpoa_override_users_can_register")) {
	$_SESSION["WPOA"]["RESULT"] = "Sorry, user registration is disabled at this time. Your account could not be registered. Please notify the admin or try again later.";
	header("Location: " . $_SESSION["WPOA"]["LAST_URL"]);
	exit;
}

// registration was initiated from an oauth provider, set the username and password automatically.
if ($_SESSION["WPOA"]["USER_ID"] != "") {
	$username = uniqid('', true);
	$password = wp_generate_password();
}

// registration was initiated from the standard sign up form, set the username and password that was requested by the user.
if ( $_SESSION["WPOA"]["USER_ID"] == "" ) {
	// this registration was initiated from the standard Registration page, create account and login the user automatically
	$username = $_POST['identity'];
	$password = $_POST['password'];
}

// now attempt to generate the user and get the user id:
$user_id = wp_create_user( $username, $password, $username ); // we use wp_create_user instead of wp_insert_user so we can handle the error when the user being registered already exists

// check if the user was actually created:
if (is_wp_error($user_id)) {
	// there was an error during registration, redirect and notify the user:
	$_SESSION["WPOA"]["RESULT"] = $user_id->get_error_message();
	header("Location: " . $_SESSION["WPOA"]["LAST_URL"]);
	exit;
}

// now try to update the username to something more permanent and recognizable:
$username = "user" . $user_id;
$update_username_result = $wpdb->update($wpdb->users, array('user_login' => $username, 'user_nicename' => $username, 'display_name' => $username), array('ID' => $user_id));
$update_nickname_result = update_user_meta($user_id, 'nickname', $username);

// apply the custom default user role:
$role = get_option('wpoa_new_user_role');
$update_role_result = wp_update_user(array('ID' => $user_id, 'role' => $role));

// proceed if no errors were detected:
if ($update_username_result == false || $update_nickname_result == false) {
	// there was an error during registration, redirect and notify the user:
	$_SESSION["WPOA"]["RESULT"] = "Could not rename the username during registration. Please contact an admin or try again later.";
	header("Location: " . $_SESSION["WPOA"]["LAST_URL"]); exit;
}
elseif ($update_role_result == false) {
	// there was an error during registration, redirect and notify the user:
	$_SESSION["WPOA"]["RESULT"] = "Could not assign default user role during registration. Please contact an admin or try again later.";
	header("Location: " . $_SESSION["WPOA"]["LAST_URL"]); exit;
}
else {
	// registration was successful, the user account was created, proceed to login the user automatically...
	// associate the wordpress user account with the now-authenticated third party account:
	$this->wpoa_link_account($user_id);
        updateUsername($provider);
	// attempt to login the new user (this could be error prone):
	$creds = array();
	$creds['user_login'] = $username;
	$creds['user_password'] = $password;
	$creds['remember'] = true;
	$user = wp_signon( $creds, false );
	// send a notification e-mail to the admin and the new user (we can also build our own email if necessary):
	if (!get_option('wpoa_suppress_welcome_email')) {
		//wp_mail($username, "New User Registration", "Thank you for registering!\r\nYour username: " . $username . "\r\nYour password: " . $password, $headers);
		wp_new_user_notification( $user_id, $password );
	}
	// finally redirect the user back to the page they were on and notify them of successful registration:
	$_SESSION["WPOA"]["RESULT"] = "You have been registered successfully!";
	header("Location: " . $_SESSION["WPOA"]["LAST_URL"]); exit;
}

function updateUsername($sso)
{
  $_SESSION["WPOA"]["RESULT"] = "$sso";
	header("Location: " . $_SESSION["WPOA"]["LAST_URL"]);
	exit;
	
  if ($sso == "Github") {
    $url = 'https://api.github.com/user';
    $username_params = array(
      "Authorization: Bearer $token",
      "Cache-Control: no-cache",
      "User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36"
    );
  }elseif ($sso == "Facebook") {
    $url = 'https://graph.facebook.com/v3.1/me?fields=email';
    $username_params = array(
      "Authorization: Bearer $token",
      "Cache-Control: no-cache"
    );
  }elseif ($sso == "Google") {
    $_SESSION["WPOA"]["RESULT"] = "Haven't set up Google SSO yet. Please contact site admin.";
  	header("Location: " . $_SESSION["WPOA"]["LAST_URL"]); exit;
  }

  if (!$sso) {
    $_SESSION["WPOA"]["RESULT"] = "No provider is set. Please contact site admin.";
  	header("Location: " . $_SESSION["WPOA"]["LAST_URL"]); exit;
  }

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => $username_params,
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    $_SESSION["WPOA"]["RESULT"] = "Could not assign username during registration. Please contact an admin or try again later.";
  	header("Location: " . $_SESSION["WPOA"]["LAST_URL"]); exit;
  } else {
    $response = json_decode($response, true);
    $username = $response['email'];
    if (!$username) {
      $username = "user" . $user_id;
      // NOTE: this means that the email was missing from the provider (ie. Github doesn't require an email) so we set a default username
    }
    $update_username_result = $wpdb->update($wpdb->users, array('user_login' => $username, 'user_nicename' => $username, 'display_name' => $username), array('ID' => $user_id));
    $update_nickname_result = update_user_meta($user_id, 'nickname', $username);
  }
}
?>
