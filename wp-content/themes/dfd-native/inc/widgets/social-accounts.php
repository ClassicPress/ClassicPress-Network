<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
require_once(get_template_directory().'/inc/widgets/widget.php');

class dfd_soc_icon extends SB_WP_Widget {
	protected $widget_base_id = 'dfd_soc_icon';
	protected $widget_name = 'Custom: Social Accounts';
	
	protected $options;

    public function __construct() {
		$this->widget_args = array(
			'description' => esc_html__('Social Accounts', 'dfd-native'),
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
				'alignment', 'text', '',
				'label'		=> esc_html__('Align', 'dfd-native'),
				'input'		=> 'custom_select',
				'values'	=>	array(
					'text-left'		=> esc_html__('Left', 'dfd-native'),
					'text-center'	=> esc_html__('Center', 'dfd-native'),
					'text-right'	=> esc_html__('Right', 'dfd-native')
				),
				'on_update'	=> 'esc_attr'
			),
			array(
				'style', 'text', '',
				'label'		=> esc_html__('Style', 'dfd-native'),
				'input'		=> 'custom_select',
				'values'	=>	array(
					'style-1'	=> esc_html__('Sliding icon', 'dfd-native'),
					'style-2'	=> esc_html__('Sliding background', 'dfd-native'),
					'style-3'	=> esc_html__('Fade', 'dfd-native'),
					'style-4'	=> esc_html__('Appear out', 'dfd-native'),
					'style-5'	=> esc_html__('General shadow', 'dfd-native'),
					'style-6'	=> esc_html__('Round to square', 'dfd-native'),
					'style-7'	=> esc_html__('Animated cube', 'dfd-native'),
					'style-8'	=> esc_html__('Long shadow', 'dfd-native'),
				),
				'on_update'	=> 'esc_attr'
			),
			array(
				'sliding_direction', 'text', '',
				'label'		=> esc_html__('Sliding direction', 'dfd-native'),
				'input'		=> 'custom_select',
				'values'	=>	array(
					'left_to_right'	=> esc_html__('Left to right', 'dfd-native'),
					'top_to_bottom'	=> esc_html__('Top to bottom', 'dfd-native'),
					'right_to_left'	=> esc_html__('Right to left', 'dfd-native'),
					'bottom_to_top'	=> esc_html__('Bottom to top', 'dfd-native')
				),
				'desc'		=> esc_html__('The sliding direction option is available only for Sliding icon, Sliding background and Animated cube styles', 'dfd-native'),
				'on_update'	=> 'esc_attr'
			),
			array(
				'icon_size', 'text', '',
				'label'		=> esc_html__('Icon size', 'dfd-native'),
				'input'		=> 'number',
				'on_update'	=> 'esc_attr'
			),
			array(
				'border_radius', 'text', '',
				'label'		=> esc_html__('Border radius in px', 'dfd-native'),
				'desc'		=> esc_html__('The Border radius option is not available for Animated cube.', 'dfd-native'),
				'input'		=> 'number',
				'on_update'	=> 'esc_attr'
			),
			array(
				'standard_icon_color', 'text', '',
				'label'		=> esc_html__('Colored icon', 'dfd-native'),
				'desc'		=> esc_html__('The colored icon option is available only for Sliding icon, Sliding background, Fade and Appear out styles.', 'dfd-native'),
				'input'		=> 'checkbox'
			),
		);
        parent::__construct();
    }

    function widget( $args, $instance ) {
			
		global $dfd_native;
		
		$el_class = $link_css = $id = '';
		
        extract( $args );
		
		$social_networks = array(
			"de"=>"Devianart",
			"dg"=>"Digg",
			"dr"=>"Dribbble",
			"db"=>"Dropbox",
			"en"=>"Evernote",
			"fb"=>"Facebook",
			"flk"=>"Flickr",
			"gp"=>"Google +",
			"in"=>"Instagram",
			"lf"=>"Last FM",
			"li"=>"LinkedIN",
			"pi"=>"Picasa",
			"pt"=>"Pinterest",
			"rss"=>"RSS",
			"tu"=>"Tumblr",
			"tw"=>"Twitter",
			"vi"=>"Vimeo",
			"wp"=>"WordPress",
			"yt"=>"YouTube",
			"500px"=>"500px",
			"vb"=>"viewbug",
			"xn"=>"xing",
			"sp"=>"spotify",
			"hz"=>"houzz",
			"sk"=>"skype",
			"ss"=>"slideshare",
			"bd"=>"bandcamp",
			"sd"=>"soundcloud",
			"mk"=>"meerkat",
			"ps"=>"periscope",
			"sc"=>"snapchat",
			"tc"=>"thechurch",
			"bh"=>"behance",
			"pp"=>"pinpoint",
			"vd"=>"viadeo",
			"ta"=>"tripadvisor",
		);
		$social_icons = array(
			"de" => "dfd-socicon-deviantart",
			"dg" => "dfd-socicon-digg",
			"dr" => "dfd-socicon-dribbble",
			"db" => "dfd-socicon-dropbox",
			"en" => "dfd-socicon-evernote",
			"fb" => "dfd-socicon-facebook",
			"flk" => "dfd-socicon-flickr",
			"gp" => "dfd-socicon-google",
			"in" => "dfd-socicon-instagram",
			"lf" => "dfd-socicon-lastfm",
			"li" => "dfd-socicon-linkedin",
			"pi" => "dfd-socicon-picasa",
			"pt" => "dfd-socicon-pinterest",
			"rss" => "dfd-socicon-rss",
			"tu" => "dfd-socicon-tumblr",
			"tw" => "dfd-socicon-twitter",
			"vi" => "dfd-socicon-vimeo",
			"wp" => "dfd-socicon-wordpress",
			"yt" => "dfd-socicon-youtube",
			"500px" => "dfd-socicon-px-icon",
			"vb" => "dfd-socicon-vb",
			"xn" => "dfd-socicon-b_Xing-icon_bl",
			"sp" => "dfd-socicon-spotify",
			"hz" => "dfd-socicon-houzz-dark-icon",
			"sk" => "dfd-socicon-skype",
			"ss" => "dfd-socicon-slideshare",
			"bd" => "dfd-socicon-bandcamp-logo",
			"sd" => "dfd-socicon-soundcloud",
			"mk" => "dfd-socicon-Meerkat-color",
			"ps" => "dfd-socicon-periscope",
			"sc" => "dfd-socicon-snapchat",
			"tc" => "dfd-socicon-the-city",
			"bh" => "dfd-socicon-behance",
			"pp" => "dfd-socicon-pinpoint",
			"vd" => "dfd-socicon-viadeo",
			"ta" => "dfd-socicon-tripadvisor",
		);
		
		$this->setInstances($instance, 'filter');
		
        echo wp_kses( $before_widget, array(
				'div' => array('id' => array(), 'class' => array()),
				'section' => array('id' => array(), 'class' => array())
			) );
		
		$title = $this->getInstance('title');
		$alignment = $this->getInstance('alignment');
		$style = $this->getInstance('style');
		$sliding_direction = $this->getInstance('sliding_direction');
		$icon_size = $this->getInstance('icon_size');
		$border_radius = $this->getInstance('border_radius');
		$standard_icon_color = $this->getInstance('standard_icon_color');
		
        echo (!empty($title)) ? ( $before_title . $title . $after_title ) : '';
		
		if(isset($style) && !empty($style)) {
			$el_class .= $style;
		}
		if(isset($alignment) && !empty($alignment)) {
			$el_class .= ' '.$alignment;
		}
		if(isset($sliding_direction) && !empty($sliding_direction)) {
			$el_class .= ' '.$sliding_direction;
		}
		if(!empty($standard_icon_color)) {
			$el_class .= ' standard-color';
		}
		
		if(isset($args['widget_id']) && !empty($args['widget_id'])) {
			$id = $args['widget_id'];
		}else{
			$id = 'widget_'.$this->widget_base_id;
		}
		
		if(isset($icon_size) && strcmp($icon_size, '') != 0) {
			$link_css .= '#'.esc_js($id).' .dfd-soc-icon a {font-size: '.esc_js($icon_size).'px;}';
		}
		if(isset($border_radius) && strcmp($border_radius, '') != 0) {
			$link_css .= '#'.esc_js($id).' .dfd-soc-icon a {border-radius: '.esc_js($border_radius).'px;}';
		}
		
		?>

		<div class="dfd-soc-icon <?php echo esc_attr($el_class); ?>">
			<div class="soc-icon-container clearfix">
				<?php
				foreach($social_networks as $short=>$original){
					$link = $dfd_native[$short.'_link'];
					$icon = $social_icons[$short];
					if( $link  !='' && $link  !='http://' ) {
						echo '<a href="'.esc_url($link) .'" class="'.esc_attr($icon).'" title="'.esc_attr($original).'" target="_blank"><i class="'.esc_attr($icon).'"></i></a>';
					}
				}
				?>
			</div>
		</div>

		<?php if(!empty($link_css)) : ?>
			<script>
				(function($) {
					$('head').append('<style><?php echo esc_js($link_css); ?></style>');
				})(jQuery);
			</script>
		<?php endif; ?>

		<?php
        echo wp_kses( $after_widget, array(
				'div' => array('id' => array(), 'class' => array()),
				'section' => array('id' => array(), 'class' => array())
			) );
    }
}