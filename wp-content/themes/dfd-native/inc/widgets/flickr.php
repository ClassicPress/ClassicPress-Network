<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
require_once(get_template_directory().'/inc/widgets/widget.php');

class dfd_flickr extends SB_WP_Widget {
	protected $widget_base_id = 'dfd_flickr';
	protected $widget_name = 'Custom: Flickr Photos';
	
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
				'id', 'text', '',
				'label'		=> esc_html__('ID:', 'dfd-native'),
				'input'		=> 'text',
				'filters'	=> 'widget_title',
				'on_update'	=> 'esc_attr'
			),
			array(
				'num', 'text', 6,
				'label'		=> esc_html__('Number of photos:', 'dfd-native'),
				'input'		=> 'number',
				'on_update'	=> 'esc_attr'
			),
		);
        parent::__construct();
    }
	
	/**
     * Display widget
     */
	function widget($args, $instance) {

		extract( $args );
		
		$this->setInstances($instance, 'filter');

		$title = $this->getInstance('title');
		$id = $this->getInstance('id');
		$num = $this->getInstance('num');

		wp_register_script('flikr_feed', get_template_directory_uri() . '/assets/js/jflickrfeed.min.js', false, null, true);
		wp_enqueue_script('flikr_feed');

		echo wp_kses( $before_widget, array(
				'div' => array('id' => array(), 'class' => array()),
				'section' => array('id' => array(), 'class' => array())
			) );

		echo (!empty($title)) ? ( $before_title . $title . $after_title ) : '';

		/* Display Latest Tweets */
		if(isset($num) && !empty($num)) {
		?>
					
			<?php
			$column_class = '';
			if (method_exists('Dfd_Theme_Helpers','column_class_maker')) {
				$column_class .= Dfd_Theme_Helpers::column_class_maker($num);
			}
			?>

			<div class="dfd-flickr-widget flickr-widget" data-num="<?php echo esc_attr($num); ?>" data-columns="<?php echo esc_attr($column_class) ?>" data-id="<?php echo esc_attr($id) ?>"></div>

		<?php }

		echo wp_kses( $after_widget, array(
				'div' => array('id' => array(), 'class' => array()),
				'section' => array('id' => array(), 'class' => array())
			) );
	}
}
?>