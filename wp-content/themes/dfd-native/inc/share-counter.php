<?php
if(!defined('ABSPATH')) {exit;}

if(!class_exists('Dfd_Share_Counter')) {
	class Dfd_Share_Counter {
		private $shared_url;
		private $facebook_api_url = 'https://graph.facebook.com/?id=';
		private $twitter_api_url = 'https://urls.api.twitter.com/1/urls/count.json?url=';
		private $google_api_url = 'https://plusone.google.com/_/+1/fastbutton?url=';
		
		function __construct() {
			add_action('wp_ajax_dfd_share_counter', array($this, 'init'));
			add_action('wp_ajax_nopriv_dfd_share_counter', array($this, 'init'));
		}
		
		function init() {
			$nonce = $_POST['nonce'];

			if (!wp_verify_nonce($nonce, 'ajax-nonce')) {
				die();
			}
			
			//header('Access-Control-Allow-Origin: ' . get_home_url('/'));
			$this->shared_url = $_POST['url'];
			
			$counts = $_POST['counts'];
			$url_parts = parse_url($this->shared_url);
			$http_url = '';
			$https_url = '';

			if ($url_parts['scheme'] == 'https') {
				$http_url = preg_replace('/^https:/i', 'http:', $this->shared_url);
				$https_url = $this->shared_url;
			} else {
				$http_url = $this->shared_url;
				$https_url = preg_replace('/^http:/i', 'https:', $this->shared_url);
			}

			$fb_shares = $counts['facebook'] ? $this->get_fb_shares_count($this->shared_url) : 0;
//			$tweets = $counts['twitter'] ? $this->get_tweet_count($this->shared_url) : 0;
			$plusones = $counts['google'] ? $this->get_plusone_count($this->shared_url) : 0;
			
			$total = $fb_shares + $plusones;
//			$total = $fb_shares + $tweets + $plusones;

			$response = array(
				'URL' => $this->shared_url,
				'Facebook' => $fb_shares,
//				'Twitter' => $tweets,
				'Google' => $plusones,
				'TOTAL' => $total,
			);

			echo json_encode($response);
			
			wp_die();
		}
		
		function get_fb_shares_count($url) {
			$file_contents = @Dfd_Theme_Helpers::fileGetContents($this->facebook_api_url . $url);
			$response = json_decode($file_contents, true);

			if (isset($response['share']['share_count'])) {
				return intval($response['share']['share_count']);
			}

			return 0;
		}

		function get_tweet_count($url) {
			$file_contents = @Dfd_Theme_Helpers::fileGetContents($this->twitter_api_url . urlencode($url));
			$response = json_decode($file_contents, true);

			if (isset($response['count'])) {
				return intval($response['count']);
			}

			return 0;
		}

		function get_plusone_count($url) {
			$file_contents = @Dfd_Theme_Helpers::fileGetContents($this->google_api_url . urlencode($url));
			preg_match('/window\.__SSR = {c: ([\d]+)/', $file_contents, $response);

			if (isset($response[0])) {
				$total = intval(str_replace('window.__SSR = {c: ', '', $response[0]));
				return $total;
			}

			return 0;
		}
	}
	
	new Dfd_Share_Counter;
}