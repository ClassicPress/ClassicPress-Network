<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
require_once(get_template_directory().'/inc/widgets/widget.php');

class dfd_image extends SB_WP_Widget {
	protected $widget_base_id = 'dfd_image';
	protected $widget_name = 'Custom: Image';
	
	protected $options;

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
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
				'label'		=> esc_html__('Upload image', 'dfd-native'),
				'input'		=> 'upload_image',
				'on_update'	=> 'esc_attr'
			),
			array(
				'alignment', 'text', '',
				'label'		=> esc_html__('Alignment', 'dfd-native'),
				'input'		=> 'custom_select',
				'values'	=>	array(
					'text-left'		=> esc_html__('Left', 'dfd-native'),
					'text-center'	=> esc_html__('Center', 'dfd-native'),
					'text-right'	=> esc_html__('Right', 'dfd-native')
				),
				'on_update'	=> 'esc_attr'
			),
		);
		
        parent::__construct();
    }
	
    /**
     * Display widget
     */
    function widget( $args, $instance ) {
		$el_class = '';
		
        extract( $args );
		$this->setInstances($instance, 'filter');
		
        echo wp_kses($before_widget, array(
				'div' => array('id' => array(), 'class' => array()),
				'section' => array('id' => array(), 'class' => array())
			));
		
		$title = $this->getInstance('title');
		$head_image = $this->getInstance('head_image');
		$alignment = $this->getInstance('alignment');
		
		if(isset($alignment) && !empty($alignment)) {
			$el_class .= $alignment;
		}
		echo (!empty($title)) ? $before_title . $title . $after_title : '';
				
		/*HTML*/
		if(isset($head_image) && !empty($head_image)) {
			echo '<div class="dfd-image-widget '.esc_attr($el_class).'">';
				echo '<img src="'.esc_url($head_image).'" alt="">';
			echo '</div>';
		}

        echo wp_kses($after_widget, array(
				'div' => array('id' => array(), 'class' => array()),
				'section' => array('id' => array(), 'class' => array())
			));
    }
}