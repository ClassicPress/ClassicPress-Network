<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
require_once(get_template_directory().'/inc/widgets/widget.php');

class dfd_latest_tweets extends SB_WP_Widget {
	protected $widget_base_id = 'dfd_latest_tweets';
	protected $widget_name = 'Custom: Latest Tweets';
	
	protected $options;
	
    /**
     * Register widget with WordPress.
     */
	public function __construct() {
		$this->widget_args = array(
			'description' => ''
		);
		
		$this->options = array(
			array(
				'title', 'text', '',
				'label'		=> esc_html__('Title', 'dfd-native'),
				'input'		=> 'text',
				'filters'	=> 'widget_title',
				'on_update'	=> 'esc_attr'
			),
			array(
				'border_radius', 'text', '',
				'label'		=> esc_html__('General border radius in px', 'dfd-native'),
				'input'		=> 'number',
				'on_update'	=> 'esc_attr'
			),
			array(
				'author_info', 'text', '',
				'label'		=> esc_html__('Show author info', 'dfd-native'),
				'input'		=> 'checkbox'
			),
			array(
				'load_more', 'text', '',
				'label'		=> esc_html__('Display load more button', 'dfd-native'),
				'input'		=> 'checkbox'
			),
			array(
				'bg_transparent', 'text', '',
				'label'		=> esc_html__('Transparent background', 'dfd-native'),
				'desc'		=> esc_html__('Enable this option if you\'d like to set the transparent background for the widget', 'dfd-native'),
				'input'		=> 'checkbox'
			),
			array(
				'bg_light', 'text', '',
				'label'		=> esc_html__('Light container background is used', 'dfd-native'),
				'desc'		=> esc_html__('The text colors will be changed to make the text readable. This option is available only if Transparent background is enabled', 'dfd-native'),
				'input'		=> 'checkbox'
			),
		);
		
		add_action('wp_ajax_dfd_load_more_twitter', array($this, 'dfd_widgets_load_more_thumb_twitter'));
		add_action('wp_ajax_nopriv_dfd_load_more_twitter', array($this, 'dfd_widgets_load_more_thumb_twitter'));
		
        parent::__construct();
    }
	
	function relative_time($a) {
		//get current timestampt
		$b = time();
		//get timestamp when tweet created
		if (is_integer($a)) {
			$c = $a;
		} else {
			$c = strtotime($a);
		}
		//get difference
		$d = $b - $c;
		//calculate different time values
		$minute = 60;
		$hour = $minute * 60;
		$day = $hour * 24;
		$week = $day * 7;

		if (is_numeric($d) && $d > 0) {
			//if less then 3 seconds
			if ($d < 3) return "right now";
			//if less then minute
			if ($d < $minute) return floor($d) . " seconds ago";
			//if less then 2 minutes
			if ($d < $minute * 2) return "about 1 minute ago";
			//if less then hour
			if ($d < $hour) return floor($d / $minute) . " minutes ago";
			//if less then 2 hours
			if ($d < $hour * 2) return "about 1 hour ago";
			//if less then day
			if ($d < $day) return floor($d / $hour) . " hours ago";
			//if more then day, but less then 2 days
			if ($d > $day && $d < $day * 2) return "yesterday";
			//if less then year
			if ($d < $day * 365) return floor($d / $day) . " days ago";
			//else return more than a year
			return "over a year ago";
		}
	}
	
	//convert links to clickable format
	function convert_links($status, $targetBlank = true, $linkMaxLen = 250) {

		// the target
		$target = $targetBlank ? " target=\"_blank\" " : "";

		// convert link to url
		$status = preg_replace("/((http:\/\/|https:\/\/)[^ )]+)/e", "'<a href=\"$1\" title=\"$1\" $target >'. ((strlen('$1')>=$linkMaxLen ? substr('$1',0,$linkMaxLen).'...':'$1')).'</a>'", $status);

		// convert @ to follow
		$status = preg_replace("/(@([_a-z0-9\-]+))/i", "<a href=\"http://twitter.com/$2\" title=\"Follow $2\" $target >$1</a>", $status);

		// convert # to search
		$status = preg_replace("/(#([_a-z0-9\-]+))/i", "<a href=\"https://twitter.com/search?q=$2\" title=\"Search $1\" $target >$1</a>", $status);

		// return the status
		return $status;
	}

    /**
     * Display widget
     */
    public function widget($args, $instance) {
		global $dfd_native, $twitter, $tweets;
		
		$link_css = $general_class = $id = '';
		
        extract($args);
		
		$this->setInstances($instance, 'filter');
		
		$title			= $this->getInstance('title');
		$border_radius	= $this->getInstance('border_radius');
		$author_info	= $this->getInstance('author_info');
		$load_more		= $this->getInstance('load_more');
		$bg_transparent = $this->getInstance('bg_transparent');
		$bg_light		= $this->getInstance('bg_light');

        echo wp_kses( $before_widget, array(
					'div' => array('id' => array(), 'class' => array()),
					'section' => array('id' => array(), 'class' => array())
				) );

		echo (!empty($title)) ? ( $before_title . $title . $after_title ) : '';
		
		$tweets = $this->getTweets();
		$tweets_count = (int) count($tweets);
		
        if (!empty($tweets)) {
			$screen_name = $tweets[0]['name'];
			
			if(isset($dfd_native['username'])) {
				$username = $dfd_native['username'];
			}
		
			$carousel_class = 'without-carousel';
			if(isset($enable_carousel) && strcmp($enable_carousel, '') != 0) {
				$carousel_class = 'with-carousel';
			}
			if(!empty($load_more)) {
				$general_class .= 'with-load-more';
			}
			if(isset($bg_transparent) && !empty($bg_transparent)) {
				$general_class .= ' transparent-bg';
			}
			if(isset($bg_light) && !empty($bg_light)) {
				$general_class .= ' bg-light';
			}
			
			if(isset($args['widget_id']) && !empty($args['widget_id'])) {
				$id = $args['widget_id'];
			}else{
				$id = 'widget_'.$this->widget_base_id;
			}

			if(isset($border_radius) && strcmp($border_radius, '') != 0) {
				$link_css .= '#'.esc_js($id).' .twitter-container {border-radius: '.esc_attr($border_radius).'px;}';
			}
			?>
			<div class="twitter-container <?php echo esc_attr($general_class); ?>">
				<?php
				if(isset($author_info) && strcmp($author_info, '') != 0) { ?>
					<div class="tweets-author">
						<i class="dfd-socicon-twitter"></i>
						<div class="twitter-title-wrap">
							<div class="dfd-widget-post-title"><?php echo esc_attr($screen_name) ?></div>
							<span class="dfd-widget-content-title">@<?php echo esc_attr($username) ?></span>
						</div>
					</div>
				<?php }

				if(!empty($tweets) && isset($tweets[0])) {
					echo '<div class="tweet-list '. esc_attr($carousel_class) .'">';
						$this->item_html_twitter($tweets[0]);
					echo '</div>';
				}
				
				if(!empty($load_more)) {
					if($tweets_count > 1) {
						$data_atts = ' data-action="dfd_load_more_twitter"';

						$data_atts .= ' data-container=".tweet-list"';

						$data_atts .= ' data-current="1"';

						$data_atts .= ' data-max_pages="'.esc_attr($tweets_count).'"';

						$data_atts .= ' data-extra_params="limit=1"';

						echo '<div class="pagination ajax-pagination">'
								. '<a class="button dfd-ajax-add-post" href="#" '.$data_atts.'>'.esc_html__('Load more', 'dfd-native').'<i class="dfd-socicon-refresh"></i></a>'
							. '</div><!--// end .pagination -->';
					}
				}
				?>
				
			</div>
			<?php
			if(!empty($link_css)) { ?>
				<script>
					(function($) {
						$('head').append('<style><?php echo esc_js($link_css); ?></style>');
					})(jQuery);
				</script>
			<?php }
        }
        echo wp_kses( $after_widget, array(
					'div' => array('id' => array(), 'class' => array()),
					'section' => array('id' => array(), 'class' => array())
				) );
    }
	
	function item_html_twitter($tweet = '') {
		echo '<div class="tweet">'
				. '<div class="tweet-inner">' . wp_kses( $tweet['text'] , array(
									'a' => array(
										'href' => array(),
										'title' => array(),
										'target' => array(),
										'rel' => array()
									),
									'br' => array(),
									'em' => array(),
									'strong' => array(),
								))
					. '<div class="time entry-meta">'
						. '<i class="dfd-socicon-clock"></i>'
						. $this->relative_time($tweet['time'])
					. '</div>'
				. '</div>'
			. '</div>';
	}
	
	function getTweets() {
//		require_once get_template_directory().'/inc/lib/twitteroauth.php';
		if(class_exists('DFDTwitter')) {
			$twitter = new DFDTwitter();
			$tweets = $twitter->getTweets();

			return $tweets;
		}
	}
	
	function dfd_widgets_load_more_thumb_twitter() {
		$nonce = $_POST['nonce'];

		if (!wp_verify_nonce($nonce, 'ajax-nonce')) {
			die();
		}
		
		$current = isset($_POST['current']) ? $_POST['current'] : 1;
		
		$limit = isset($_POST['limit']) ? $_POST['limit'] : 1;
		
		$tweets = $this->getTweets();
				
		if (!empty($tweets) && isset($tweets[$current])) {
			$this->item_html_twitter($tweets[$current]);
		}
		
		wp_die();
	}
}