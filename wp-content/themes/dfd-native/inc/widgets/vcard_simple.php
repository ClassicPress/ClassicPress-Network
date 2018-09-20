<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
require_once(get_template_directory().'/inc/widgets/widget.php');

class dfd_vcard_simple extends SB_WP_Widget {
	protected $widget_base_id = 'dfd_vcard_simple';
	protected $widget_name = 'Custom: Additional info';
	
	protected $options;
	
    public function __construct() {
		$this->widget_args = array(
			'description' => esc_html__('Use this widget to add a simple vCard', 'dfd-native'),
		);
		
		$this->options = array(
			array(
				'title', 'text', '',
				'label'		=> esc_html__('Widget Title', 'dfd-native'),
				'input'		=> 'text',
				'filters'	=> 'widget_title',
				'on_update'	=> 'esc_attr'
			),
			array(
				'heading_first', 'text', '',
				'label'		=> esc_html__('Heading', 'dfd-native'),
				'input'		=> 'text'
			),
			array(
				'info_first', 'text', '',
				'label'		=> esc_html__('Information', 'dfd-native'),
				'input'		=> 'textarea'
			),
			array(
				'heading_second', 'text', '',
				'label'		=> esc_html__('Heading', 'dfd-native'),
				'input'		=> 'text'
			),
			array(
				'info_second', 'text', '',
				'label'		=> esc_html__('Information', 'dfd-native'),
				'input'		=> 'textarea'
			),
			array(
				'heading_third', 'text', '',
				'label'		=> esc_html__('Heading', 'dfd-native'),
				'input'		=> 'text'
			),
			array(
				'info_third', 'text', '',
				'label'		=> esc_html__('Information', 'dfd-native'),
				'input'		=> 'textarea'
			),
			array(
				'heading_fourth', 'text', '',
				'label'		=> esc_html__('Heading', 'dfd-native'),
				'input'		=> 'text'
			),
			array(
				'info_fourth', 'text', '',
				'label'		=> esc_html__('Information', 'dfd-native'),
				'input'		=> 'textarea'
			),
			array(
				'bg_transparent', 'text', '',
				'label'		=> esc_html__('Transparent background', 'dfd-native'),
				'desc'		=> esc_html__('Will overwrite "General background"', 'dfd-native'),
				'input'		=> 'checkbox'
			),
			array(
				'background', 'text', '',
				'label'		=> esc_html__('General background', 'dfd-native'),
				'input'		=> 'colorpicker'
			),
			array(
				'border_radius', 'text', '',
				'label'		=> esc_html__('General border radius in px', 'dfd-native'),
				'input'		=> 'number',
				'on_update'	=> 'esc_attr'
			),
			array(
				'heading_color', 'text', '',
				'label'		=> esc_html__('Heading text color', 'dfd-native'),
				'input'		=> 'colorpicker'
			),
			array(
				'info_color', 'text', '',
				'label'		=> esc_html__('Information text color', 'dfd-native'),
				'input'		=> 'colorpicker'
			),
		);
        parent::__construct();
    }
	
	/**
     * Display widget
     */
    function widget( $args, $instance ) {
		$link_css = $id = '';
        extract( $args );
		$this->setInstances($instance, 'filter');
		$heading_first = $info_first = $heading_second = $info_second = $heading_third = $info_third = $heading_fourth = $info_fourth = '';
		
        echo wp_kses( $before_widget, array(
				'div' => array('id' => array(), 'class' => array()),
				'section' => array('id' => array(), 'class' => array())
			) );
		
		$title = $this->getInstance('title');
		$heading_first = $this->getInstance('heading_first');
		$info_first = $this->getInstance('info_first');
		$heading_second = $this->getInstance('heading_second');
		$info_second = $this->getInstance('info_second');
		$heading_third = $this->getInstance('heading_third');
		$info_third = $this->getInstance('info_third');
		$heading_fourth = $this->getInstance('heading_fourth');
		$info_fourth = $this->getInstance('info_fourth');
		$bg_transparent = $this->getInstance('bg_transparent');
		$background = $this->getInstance('background');
		$heading_color = $this->getInstance('heading_color');
		$info_color = $this->getInstance('info_color');
		$border_radius = $this->getInstance('border_radius');
		
		$fields = array(
			'1' => array('key' => $heading_first,	'value' => $info_first),
			'2' => array('key' => $heading_second,	'value' => $info_second),
			'3' => array('key' => $heading_third,	'value' => $info_third),
			'4' => array('key' => $heading_fourth,	'value' => $info_fourth)
		);
		
		echo !empty($title) ? ( $before_title . $title . $after_title ) : '';
		
		if(isset($args['widget_id']) && !empty($args['widget_id'])) {
			$id = $args['widget_id'];
		}else{
			$id = 'widget_'.$this->widget_base_id;
		}
		
		if(isset($border_radius) && strcmp($border_radius, '') != 0) {
			$link_css .= '#'.$id.' .dfd-vcard-wrap {border-radius: '.esc_attr($border_radius).'px;}';
		}
		if(isset($background) && !empty($background) && empty($bg_transparent)) {
			$link_css .= '#'.$id.' .dfd-vcard-wrap {background: '.esc_attr($background).';}';
		}
		if(isset($heading_color) && !empty($heading_color)) {
			$link_css .= '#'.$id.' .dfd-vcard-wrap .vcard-field .field-name {color: '.esc_attr($heading_color).';}';
		}
		if(isset($info_color) && !empty($info_color)) {
			$link_css .= '#'.$id.' .dfd-vcard-wrap .vcard-field .field-info {color: '.esc_attr($info_color).';}';
		}
		if(!empty($bg_transparent)) {
			$link_css .= '#'.$id.' .dfd-vcard-wrap {background: transparent; padding: 0;}';
		}
		
		?>

		<div class="dfd-vcard-wrap">
			<?php 
				foreach ($fields as $k => $v) {
					if(!empty($v['key']) || !empty($v['value'])) { ?>
						<div class="vcard-field">
							<?php if(isset($v['key']) && !empty($v['key'])) { ?>
								<div class="field-name dfd-widget-content-title"><?php echo esc_html($v['key']) ; ?></div>
							<?php } ?>
							<?php if(isset($v['value']) && !empty($v['value'])) { ?>
								<div class="field-info"><?php echo esc_html($v['value']) ; ?></div>
							<?php } ?>
						</div>
					<?php }
				};
			?>
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