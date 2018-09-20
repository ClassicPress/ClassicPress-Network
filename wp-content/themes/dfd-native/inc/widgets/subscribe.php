<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
require_once(get_template_directory().'/inc/widgets/widget.php');

class dfd_subscribe extends SB_WP_Widget {
	protected $widget_base_id = 'dfd_subscribe';
	protected $widget_name = 'Custom: Subscribe';
	
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
				'info_text', 'text', '',
				'label'		=> esc_html__('Text', 'dfd-native'),
				'input'		=> 'textarea'
			),
			array(
				'feedburner', 'text', '',
				'label'		=> esc_html__('Feedburner Feed Name:', 'dfd-native'),
				'input'		=> 'text',
				'on_update'	=> 'esc_attr'
			),
			array(
				'placeholder', 'text', '',
				'label'		=> esc_html__('Placeholder:', 'dfd-native'),
				'input'		=> 'text',
				'on_update'	=> 'esc_attr'
			),
			array(
				'button_bg_color', 'text', '',
				'label'		=> esc_html__('Button background color', 'dfd-native'),
				'input'		=> 'colorpicker'
			),
			array(
				'button_text_color', 'text', '',
				'label'		=> esc_html__('Button text color', 'dfd-native'),
				'input'		=> 'colorpicker'
			),
		);
        parent::__construct();
    }

    function widget( $args, $instance ) {
		
		$link_css = $hover_bg = $id = '';
			
        extract( $args );
		
		$this->setInstances($instance, 'filter');
		
        echo wp_kses( $before_widget, array(
				'div' => array('id' => array(), 'class' => array()),
				'section' => array('id' => array(), 'class' => array())
			) );
		
		$title = $this->getInstance('title');
		$info_text = $this->getInstance('info_text');
		$feedburner = $this->getInstance('feedburner');
		$placeholder = $this->getInstance('placeholder');
		$button_bg_color = $this->getInstance('button_bg_color');
		$button_text_color = $this->getInstance('button_text_color');
		
		$hover_bg = Dfd_Theme_Helpers::adjustBrightness($button_bg_color, -10);
		
		if(isset($args['widget_id']) && !empty($args['widget_id'])) {
			$id = $args['widget_id'];
		}else{
			$id = 'widget_'.$this->widget_base_id;
		}
		
		if(isset($button_bg_color) && !empty($button_bg_color)) {
			$link_css .= '#'.$id.' button {background: '.esc_attr($button_bg_color).';}';
			$link_css .= '#'.$id.' button:hover {background: '.$hover_bg.';}';
		}
		if(isset($button_text_color) && !empty($button_text_color)) {
			$link_css .= '#'.$id.' button {color: '.esc_attr($button_text_color).';}';
		}
		
        echo (!empty($title)) ? ( $before_title . $title . $after_title ) : '';
		
		?>

			<div class="subscribe-widget">
				<form id="<?php echo uniqid('feedburner_subscribe_') ?>" action="//feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('//feedburner.google.com/fb/a/mailverify?uri=<?php echo esc_attr( $feedburner ); ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
					<?php if(isset($info_text) && !empty($info_text)) { ?>
						<p class="subscribe-info"><?php echo esc_html($info_text); ?></p>
					<?php } ?>
					<input class="text" type="text" name="email" id="<?php echo uniqid('subsmail_'); ?>" placeholder="<?php echo esc_attr($placeholder); ?>" />
					<button type="submit"><i class="dfd-socicon-rss"></i><?php esc_html_e('Subscribe', 'dfd-native'); ?></button>
					<input type="hidden" value="<?php echo esc_attr($feedburner); ?>" name="uri"/>
					<input type="hidden" name="loc" value="en_US"/>
				</form>
				<?php if(!empty($link_css)) : ?>
					<script>
						(function($) {
							$('head').append('<style><?php echo esc_js($link_css); ?></style>');
						})(jQuery);
					</script>
				<?php endif; ?>
			</div>

		<?php
        echo wp_kses( $after_widget, array(
				'div' => array('id' => array(), 'class' => array()),
				'section' => array('id' => array(), 'class' => array())
			) );
    }
}