<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
require_once(get_template_directory().'/inc/widgets/widget.php');

class dfd_author extends SB_WP_Widget {
	protected $widget_base_id = 'dfd_author';
	protected $widget_name = 'Custom: Words from author';
	
	protected $options;

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
		$this->widget_args = array(
			'description' => esc_html__('Words from author', 'dfd-native'),
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
				'head_image', 'text', '',
				'label'		=> esc_html__('Header background image:', 'dfd-native'),
				'input'		=> 'upload_image',
				'on_update'	=> 'esc_attr'
			),
			array(
				'author_image', 'text', '',
				'label'		=> esc_html__('Author image:', 'dfd-native'),
				'input'		=> 'upload_image',
				'on_update'	=> 'esc_attr'
			),
			array(
				'shadow_decoration', 'text', '',
				'label'		=> esc_html__('Disable shadow on author\'s thumbnail', 'dfd-native'),
				'input'		=> 'checkbox'
			),
			array(
				'author_title', 'text', '',
				'label'		=> esc_html__('Author title', 'dfd-native'),
				'input'		=> 'text',
			),
			array(
				'author_subtitle', 'text', '',
				'label'		=> esc_html__('Author subtitle', 'dfd-native'),
				'input'		=> 'text',
				'on_update'	=> 'esc_attr'
			),
			array(
				'author_info', 'text', '',
				'label'		=> esc_html__('Author information', 'dfd-native'),
				'input'		=> 'textarea',
			),
			array(
				'author_facebook_url', 'text', '',
				'label'		=> esc_html__('Facebook url', 'dfd-native'),
				'input'		=> 'text',
				'on_update'	=> 'esc_attr'
			),
			array(
				'author_twitter_url', 'text', '',
				'label'		=> esc_html__('Twitter url', 'dfd-native'),
				'input'		=> 'text',
				'on_update'	=> 'esc_attr'
			),
			array(
				'author_google_url', 'text', '',
				'label'		=> esc_html__('Google+ url', 'dfd-native'),
				'input'		=> 'text',
				'on_update'	=> 'esc_attr'
			),
			array(
				'author_LinkedIn_url', 'text', '',
				'label'		=> esc_html__('LinkedIn url', 'dfd-native'),
				'input'		=> 'text',
				'on_update'	=> 'esc_attr'
			),
			array(
				'author_YouTube_url', 'text', '',
				'label'		=> esc_html__('YouTube url', 'dfd-native'),
				'input'		=> 'text',
				'on_update'	=> 'esc_attr'
			),
			array(
				'author_Pinterest_url', 'text', '',
				'label'		=> esc_html__('Pinterest url', 'dfd-native'),
				'input'		=> 'text',
				'on_update'	=> 'esc_attr'
			),
			array(
				'author_Instagram_url', 'text', '',
				'label'		=> esc_html__('Instagram url', 'dfd-native'),
				'input'		=> 'text',
				'on_update'	=> 'esc_attr'
			),
			array(
				'author_Tumblr_url', 'text', '',
				'label'		=> esc_html__('Tumblr url', 'dfd-native'),
				'input'		=> 'text',
				'on_update'	=> 'esc_attr'
			),
			array(
				'author_Flickr_url', 'text', '',
				'label'		=> esc_html__('Flickr url', 'dfd-native'),
				'input'		=> 'text',
				'on_update'	=> 'esc_attr'
			),
		);
		
        parent::__construct();
    }
	
    /**
     * Display widget
     */
    function widget( $args, $instance ) {
		$link_css = $output = $general_class = $id = $thumb_class = $img_html = '';
        extract( $args );
		$this->setInstances($instance, 'filter');
		
        $output .= $before_widget;
		
		$title					= $this->getInstance('title');
		$head_image				= $this->getInstance('head_image');
		$author_image			= $this->getInstance('author_image');
		$shadow_decoration		= $this->getInstance('shadow_decoration');
		$author_title			= $this->getInstance('author_title');
		$author_subtitle		= $this->getInstance('author_subtitle');
		$author_info			= $this->getInstance('author_info');
		$author_facebook_url	= $this->getInstance('author_facebook_url');
		$author_twitter_url		= $this->getInstance('author_twitter_url');
		$author_google_url		= $this->getInstance('author_google_url');
		$author_LinkedIn_url	= $this->getInstance('author_LinkedIn_url');
		$author_YouTube_url		= $this->getInstance('author_YouTube_url');
		$author_Pinterest_url	= $this->getInstance('author_Pinterest_url');
		$author_Instagram_url	= $this->getInstance('author_Instagram_url');
		$author_Tumblr_url		= $this->getInstance('author_Tumblr_url');
		$author_Flickr_url		= $this->getInstance('author_Flickr_url');
		
		if(isset($shadow_decoration) && strcmp($shadow_decoration, '') != 0) {
			$general_class .= ' thumb-without-shadow';
		}
		
		if (!empty($title)) {
            $output .= $before_title . $title . $after_title;
		}
		
		$soc_networks = array(
			'1' => array('key' => $author_facebook_url,	'value' => 'dfd-socicon-facebook'),
			'2' => array('key' => $author_twitter_url,	'value' => 'dfd-socicon-twitter'),
			'3' => array('key' => $author_google_url,	'value' => 'dfd-socicon-google-plus'),
			'4' => array('key' => $author_LinkedIn_url,	'value' => 'dfd-socicon-youtube'),
			'5' => array('key' => $author_YouTube_url,	'value' => 'dfd-socicon-linkedin'),
			'6' => array('key' => $author_Pinterest_url,'value' => 'dfd-socicon-pinterest'),
			'7' => array('key' => $author_Instagram_url,'value' => 'dfd-socicon-instagram'),
			'8' => array('key' => $author_Tumblr_url,	'value' => 'dfd-socicon-tumblr'),
			'9' => array('key' => $author_Flickr_url,	'value' => 'dfd-socicon-flickr'),
		);
		
		if(isset($args['widget_id']) && !empty($args['widget_id'])) {
			$id = $args['widget_id'];
		}else{
			$id = 'widget_'.$this->widget_base_id;
		}
		
		if(isset($head_image) && !empty($head_image)) {
			$img_src = dfd_aq_resize($head_image, 480, false, true, true, true);
			if(!$img_src) {
				$img_src = $head_image;
			}
			$link_css .= '#'.$id.' .dfd-author-container .top-decoration {background-image: url('.esc_url($img_src).');}';
		}
		
		$article_image = dfd_aq_resize($author_image, 120, 120, true, true, true);
		if(!$article_image) {
			$article_image = $author_image;
		}
		/*HTML*/
		$output .= '<div class="dfd-author-container text-center '.$general_class.'">';
			$output .= '<div class="top-decoration">';
				if(!empty($article_image)) {
					global $dfd_native;
					if(isset($dfd_native['enable_images_lazy_load']) && $dfd_native['enable_images_lazy_load'] == 'on') {
						$thumb_class .= 'dfd-img-lazy-load';
						$loading_img_src = "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 120 120'%2F%3E";
						$img_html .= '<img src="'.$loading_img_src.'" data-src="'. esc_url($article_image) .'" width="120" height="120" alt=""/>';
					} else {
						$img_html .= '<img src="'. esc_url($article_image) .'" width="120" height="120" alt=""/>';
					}
					$output .= '<div class="author-image '.esc_attr($thumb_class).'">';
						$output .= $img_html;
					$output .= '</div>';
				}
			$output .= '</div>';
			$output .= '<div class="main-info">';
				if(isset($author_title) && !empty($author_title)) {
					$output .= '<div class="dfd-widget-big-title">'.wp_kses($author_title, array('span' => array(), 'br' => array(), 'b' => array())).'</div>';
				}
				if(isset($author_subtitle) && !empty($author_subtitle)) {
					$output .= '<div class="dfd-widget-content-title">'.$author_subtitle.'</div>';
				}
				if(isset($author_info) && !empty($author_info)) {
					$output .= '<div class="author-info">'.wp_kses($author_info, array('span' => array(), 'br' => array(), 'b' => array())).'</div>';
				}
			$output .= '</div>';
			$output .= '<div class="icon-container">';
			foreach ($soc_networks as $k => $v) {
				if(isset($v['key']) && !empty($v['key'])) {
					$output .= '<a href="'.esc_url($v['key']).'" class="'.esc_attr($v['value']).'"></a>';
				}
			};
			$output .= '</div>';
			
		$output .= '</div>';

		if(!empty($link_css)) {
			$output .=	'<script>'
						. '(function($) {'
							. '$("head").append("<style>'. esc_js($link_css) .'</style>")'
						. '})(jQuery);'
					. '</script>';
		}

        $output .= $after_widget;
		
		echo  $output;
    }
}