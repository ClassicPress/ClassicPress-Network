<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
class DFDTwitter {
	private $screen_name;
	private $oauth_access_token;
	private $oauth_access_token_secret;
	private $consumer_key;
	private $consumer_secret;
	
	private $transName;
	private $backupName;
	private $backupTime;
	
	private $cachetime;
	private $error;
	
	public function __construct() {
		$this->loadOptions();
	}
	
	public function loadOptions() {
		global $dfd_native;
		$this->screen_name = isset($dfd_native['username']) ? $dfd_native['username'] : '';
		$this->oauth_access_token = isset($dfd_native['twiiter_acc_t']) ? $dfd_native['twiiter_acc_t'] : '';
		$this->oauth_access_token_secret = isset($dfd_native['twiiter_acc_t_s']) ? $dfd_native['twiiter_acc_t_s'] : '';
		$this->consumer_key = isset($dfd_native['twiiter_consumer']) ? $dfd_native['twiiter_consumer'] : '';
		$this->consumer_secret = isset($dfd_native['twiiter_con_s']) ? $dfd_native['twiiter_con_s'] : '';
		
		$this->numTweets = (int) isset($dfd_native['numb_lat_tw']) ? $dfd_native['numb_lat_tw'] : 0;
		$this->cachetime = (int) isset($dfd_native['cachetime']) ? $dfd_native['cachetime'] * 60 : 0;
		
		$this->transName = 'list-tweets'; // Name of value in database.
		$this->backupName = $this->transName . '-backup';
		$this->backupTime = $this->transName . '-backup-time';
	}

	public function getTweets() {
		$tweets = get_option($this->backupName);
		$backupTimeVal = get_option($this->backupTime);
		
		if (
			!empty($tweets) && 
			!empty($backupTimeVal) && 
			isset($this->cachetime) && $this->cachetime>0 && 
			(($backupTimeVal+$this->cachetime)>time())
		) {
			return $tweets;
		}
		
		$tweets = array();
		$fetchedTweets = $this->get("https://api.twitter.com/1.1/statuses/user_timeline.json");
		
		if (!(isset($fetchedTweets->errors) && count($fetchedTweets->errors)>0) && $fetchedTweets) {
			// Fetch succeeded.
			$limitToDisplay = min($this->numTweets, count($fetchedTweets));

			for ($i = 0; $i < $limitToDisplay; $i++) {
				$tweet = $fetchedTweets[$i];

				// Core info.
				$name = $tweet->user->name;
				$permalink = 'http://twitter.com/' . $name . '/status/' . $tweet->id_str;

				/* Alternative image sizes method: http://dev.twitter.com/doc/get/users/profile_image/:screen_name */
				$image = $tweet->user->profile_image_url;

				// Message. Convert links to real links.
				$pattern = '#((https?|ftp)://(\S*?\.\S*?))([\s)\[\]{},;"\':<]|\.\s|$)#i';
				$replace = '<a href="${0}" target="_blank" rel="nofollow">${0}</a>';
				$text = preg_replace($pattern, $replace, $tweet->text);

				// Need to get time in Unix format.
				$time = $tweet->created_at;
				$time = date_parse($time);
				$uTime = mktime($time['hour'], $time['minute'], $time['second'], $time['month'], $time['day'], $time['year']);

				// Now make the new array.
				$tweets[] = array(
					'text' => $text,
					'name' => $name,
					'permalink' => $permalink,
					'image' => $image,
					'time' => $uTime
				);
			}

			update_option($this->backupName, $tweets);
			update_option($this->backupTime, time());
			
			return $tweets;
		} else {
			if ($fetchedTweets) {
				$this->setError( array_shift($fetchedTweets->errors) );
			}	
			update_option($this->backupName, false);
			update_option($this->backupTime, false);
			
			return false;
		}
	}
	
	public function getFollowersCount() {
		$followers_count = intval(get_option('followers_count'));
		$backupTimeVal = get_option($this->backupTime);
		
		if (
			!$followers_count &&
			isset($this->cacheTime) && ($this->cacheTime>0) &&
			(($backupTimeVal+$this->cacheTime)>time())
		) {
			return $followers_count;
		}
		
		$res = $this->get("https://api.twitter.com/1.1/statuses/user_timeline.json");
		if (!(isset($res->errors) && count($res->errors)>0) && $res) {
			$el = array_shift($res);
			$followers_count = intval($el->user->followers_count);
			update_option($this->backupTime, $followers_count);
			
			return $followers_count;
		}  else {
			if ($res) {
				$this->setError( array_shift($res->errors) );
			}
			update_option($this->backupTime, false);
			
			return false;
		}
	}
		
	public function get($url = "https://api.twitter.com/1.1/statuses/user_timeline.json") {
		$oauth = array( 'oauth_consumer_key' => $this->consumer_key,
                'oauth_nonce' => time(),
                'oauth_signature_method' => 'HMAC-SHA1',
                'oauth_token' => $this->oauth_access_token,
                'oauth_timestamp' => time(),
                'oauth_version' => '1.0');

		$base_info = $this->buildBaseString($url, 'GET', $oauth);
		$composite_key = rawurlencode($this->consumer_secret) . '&' . rawurlencode($this->oauth_access_token_secret);
		$oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
		$oauth['oauth_signature'] = $oauth_signature;

		// Make Requests
		$header = array($this->buildAuthorizationHeader($oauth), 'Expect:');
		$options_buf = wp_remote_get($url, array(
			'headers' => implode("\n", $header),
			'sslverify' => false,
		));
		
		if (!is_wp_error($options_buf) && isset($options_buf['body'])) {
			return json_decode($options_buf['body']);
		} else {
			return false;
		}
	}
	
	private function buildBaseString($baseURI, $method, $params) {
		$r = array();
		ksort($params);
		foreach($params as $key=>$value){
			$r[] = "$key=" . rawurlencode($value);
		}
		return $method."&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r));
	}

	private function buildAuthorizationHeader($oauth) {
		$r = 'Authorization: OAuth ';
		$values = array();
		foreach($oauth as $key=>$value)
			$values[] = "$key=\"" . rawurlencode($value) . "\"";
		$r .= implode(', ', $values);
		return $r;
	}
	
	public function hasError() {
		return !empty($this->error);
	}
	
	public function getError() {
		return $this->error;
	}

	public function setError($error) {
		$this->error = $error;
	}
}
