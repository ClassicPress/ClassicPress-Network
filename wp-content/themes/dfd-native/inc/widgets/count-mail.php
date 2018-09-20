<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
require_once(get_template_directory().'/inc/widgets/widget.php');

class dfd_counter_mail extends SB_WP_Widget {
	protected $widget_base_id = 'dfd_counter_mail';
	protected $widget_name = 'Custom: Counter mail';
	
	protected $options;
	
    public function __construct() {
		$this->widget_args = array(
			'description' => esc_html__('Subscribe to social and rss', 'dfd-native'),
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
				'new_window', 'text', '',
				'label'		=> esc_html__('Open links in a new window', 'dfd-native'),
				'input'		=> 'checkbox',
				'on_update'	=> 'esc_attr'
			),
			array(
				'facebook', 'text', '',
				'label'		=> esc_html__('Facebook Page ID', 'dfd-native'),
				'desc'		=> esc_html__('Please follow this','dfd-native').' <a href="http://findmyfacebookid.com/">'.esc_html__('link','dfd-native').'</a> '.esc_html__('if to find our your facebook page ID.', 'dfd-native'),
				'input'		=> 'text',
				'on_update'	=> 'esc_attr'
			),
			array(
				'facebook_app_id', 'text', '',
				'label'		=> esc_html__('Facebook App ID', 'dfd-native'),
				'desc'		=> esc_html__('Please Create an App on Facebook in','dfd-native').' <a href="https://developers.facebook.com/">https://developers.facebook.com/</a> '.esc_html__('and get this data.', 'dfd-native'),
				'input'		=> 'text',
				'on_update'	=> 'esc_attr'
			),
			array(
				'facebook_secret', 'text', '',
				'label'		=> esc_html__('Facebook Secret Token', 'dfd-native'),
				'desc'		=> esc_html__('Please Create an App on Facebook in','dfd-native').' <a href="https://developers.facebook.com/">https://developers.facebook.com/</a> '.esc_html__('and get this data.', 'dfd-native'),
				'input'		=> 'text',
				'on_update'	=> 'esc_attr'
			),
			array(
				'twitter', 'text', '',
				'label'		=> esc_html__('Enable Twitter', 'dfd-native'),
				'desc'		=> '<em style="color:red;">'.esc_html__('Make sure you Setup Twitter API OAuth settings under Theme options > Social accounts > Twitter section options ', 'dfd-native').'</em>',
				'input'		=> 'checkbox',
				'on_update'	=> 'esc_attr'
			),
			array(
				'google_id', 'text', '',
				'label'		=> esc_html__('Google+ Page ID', 'dfd-native'),
				'input'		=> 'text',
				'on_update'	=> 'esc_attr'
			),
		);
		parent::__construct();
	}

	function widget( $args, $instance ) {
		
		extract( $args );
		
		$this->setInstances($instance, 'filter');
		
		$title = $this->getInstance('title');
		
		$facebook_page  = (isset($instance['facebook']))?$instance['facebook']:false;
		$facebook_app_id  = (isset($instance['facebook_app_id']))?$instance['facebook_app_id']:false;
		$facebook_secret  = (isset($instance['facebook_secret']))?$instance['facebook_secret']:false;
		$twitter_id     = (isset($instance['twitter']))?$instance['twitter']:false;
		$google_id    = (isset($instance['google_id']))?$instance['google_id']:false;
		$new_window     = (isset($instance['new_window']))?$instance['new_window']:false;

		echo wp_kses( $before_widget, array(
				'div' => array('id' => array(), 'class' => array()),
				'section' => array('id' => array(), 'class' => array())
			) );
		
		echo (!empty($title)) ? ( $before_title . $title . $after_title ) : '';

		if( $twitter_id || $facebook_page || $google_id ) :
			if( $facebook_page && method_exists('Dfd_Theme_Helpers','dfd_facebook_fans') ):
				$facebook = Dfd_Theme_Helpers::dfd_facebook_fans( $facebook_page, $facebook_app_id, $facebook_secret ); ?>
				<div class="follow-widget-item dfd-widget-content-title facebook text-center">
					<span class="color-mask"></span>
					<div class="icon-wrap text-left">
						<i class="dfd-socicon-facebook"></i>
						<span class="number"><?php echo esc_html($facebook) . esc_html__(' fans', 'dfd-native'); ?></span>
					</div>
					<a href="http://facebook.com/<?php echo esc_attr($facebook_page); ?>"<?php echo ($new_window) ? 'target="_blank"' : '' ?> class="fb"><?php esc_html_e('Like','dfd-native') ?></a>
				</div>
			<?php endif;
			
			if( $twitter_id && method_exists('Dfd_Theme_Helpers','dfd_tweet_followers_count') ):
				$twitter = Dfd_Theme_Helpers::dfd_tweet_followers_count();
				if($twitter) {
				?>
				<div class="follow-widget-item dfd-widget-content-title twitter text-center">
					<span class="color-mask"></span>
					<div class="icon-wrap text-left">
						<i class="dfd-socicon-twitter"></i>
						<span class="number"><?php echo @number_format($twitter['followers_count']) . esc_html__(' followers', 'dfd-native'); ?></span>
					</div>
					<a href="<?php echo esc_url($twitter['page_url']); ?>"<?php echo ($new_window) ? 'target="_blank"' : '' ?> class="tw"><?php esc_html_e('Follow','dfd-native') ?></a>
				</div>
			<?php
				}
			endif; ?>

			<?php if( $google_id && method_exists('Dfd_Theme_Helpers','get_google_plus_circles') ): ?>
				<div class="follow-widget-item dfd-widget-content-title google-plus text-center">
					<span class="color-mask"></span>
					<div class="icon-wrap text-left">
						<i class="dfd-socicon-google-plus"></i>
						<span class="number"><?php echo Dfd_Theme_Helpers::get_google_plus_circles($google_id)  . esc_html__(' circled', 'dfd-native'); ?></span>
					</div>
					<a href="https://plus.google.com/<?php echo esc_attr($google_id); ?>/"<?php echo ($new_window) ? 'target="_blank"' : '' ?> class="yt"><?php esc_html_e('Subscribe','dfd-native') ?></a>
				</div>
			<?php endif;
			
		endif;
		
		echo wp_kses( $after_widget, array(
				'div' => array('id' => array(), 'class' => array()),
				'section' => array('id' => array(), 'class' => array())
			) );
	}
}