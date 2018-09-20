<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
require_once(get_template_directory().'/inc/widgets/widget.php');

class dfd_tags extends SB_WP_Widget {
	protected $widget_base_id = 'dfd_tags';
	protected $widget_name = 'Custom: Tags';
	
	protected $options;
	
	public function __construct() {
		$this->widget_args = array(
			'description' => esc_html__('Displays tags list', 'dfd-native')
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
				'number', 'int', 10,
				'label'		=> esc_html__('Number of tags:', 'dfd-native'),
				'input'		=> 'number',
				'on_update'	=> 'esc_attr'
			),
			array(
				'read_all', 'text', '',
				'label'		=> esc_html__('All tags button:', 'dfd-native'),
				'input'		=> 'checkbox'
			),
		);
		
        parent::__construct();
    }

	function widget( $args, $instance ) {
		extract( $args );
		$this->setInstances($instance, 'filter');
		
		$title		= $this->getInstance('title');
		$number		= $this->getInstance('number');
		$read_all	= $this->getInstance('read_all');
		
		$unique_id = uniqid('tags-widget-');
		
		$all_tags = get_tags();
		
		$output = '';
		foreach($all_tags as $tag) {
			$output .= '<a href="'.get_tag_link($tag->term_id).'" title="'.esc_attr($tag->name).'">'.esc_html($tag->name).'</a>';
		}

        echo wp_kses( $before_widget, array(
				'div' => array('id' => array(), 'class' => array()),
				'section' => array('id' => array(), 'class' => array())
			) );
		
		echo (!empty($title)) ? ( $before_title . $title . $after_title ) : '';
		?>

		<div class="tags-widget clearfix" id="<?php echo esc_attr($unique_id); ?>">
			<?php wp_tag_cloud('smallest=10&largest=20&number='.$number); ?>
		</div>

		<?php if(isset($read_all) && $read_all) : ?>
			<div class="hide dfd-all-tags-content"><?php echo wp_kses($output, array(
				'a' => array(
					'href' => array(),
					'class' => array(),
					'title' => array(),
					'style' => array(),
				),
			)); ?></div>
			<div class="read-more-section ajax-pagination">
				<a href="#" class="button"><?php esc_html_e('Show all','dfd-native'); ?>
					<i class="dfd-socicon-refresh"></i>
				</a>
			</div>
		<?php endif; ?>

    <?php echo wp_kses( $after_widget, array(
					'div' => array('id' => array(), 'class' => array()),
					'section' => array('id' => array(), 'class' => array())
				) );
    }
}
