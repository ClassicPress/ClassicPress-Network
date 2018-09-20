<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
require_once(get_template_directory().'/inc/widgets/widget.php');

class dfd_rec_posts_thumb extends SB_WP_Widget {
	protected $widget_base_id = 'dfd_rec_posts_thumb';
	protected $widget_name = 'Custom: Recent Posts with thumb';
	
	protected $options;
	
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
		$this->widget_args = array(
			'description' => esc_html__('Advanced recent posts widget. Posts with thumb', 'dfd-native')
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
				'limit', 'int', 3,
				'label'		=> esc_html__('Limit', 'dfd-native'),
				'input'		=> 'select',
				'values'	=> array('range', 'from'=>1, 'to'=>20)
			),
			array(
				'date', 'text', '',
				'label'		=> esc_html__('Display date', 'dfd-native'),
				'input'		=> 'checkbox'
			),
			array(
				'comments', 'text', '',
				'label'		=> esc_html__('Display comments', 'dfd-native'),
				'input'		=> 'checkbox'
			),
			array(
				'like', 'text', '',
				'label'		=> esc_html__('Display likes', 'dfd-native'),
				'input'		=> 'checkbox'
			),
			array(
				'load_more', 'text', '',
				'label'		=> esc_html__('Display load more button', 'dfd-native'),
				'input'		=> 'checkbox'
			),
			array(
				'width', 'text', 80,
				'label'		=> esc_html__('Thumb size', 'dfd-native'),
				'input'		=> 'number',
			),
			array(
				'radius', 'text', '',
				'label'		=> esc_html__('Thumb border radius in px', 'dfd-native'),
				'input'		=> 'number'
			),
		);
		
		add_action('wp_ajax_dfd_load_more', array($this, 'dfd_widgets_load_more_thumb'));
		add_action('wp_ajax_nopriv_dfd_load_more', array($this, 'dfd_widgets_load_more_thumb'));
			
        parent::__construct();
    }

    /**
     * Display widget
     */
    function widget( $args, $instance ) {
		$link_css = $args_post = $id = '';
        extract( $args );
		$this->setInstances($instance, 'filter');
		
        echo wp_kses( $before_widget, array(
				'div' => array('id' => array(), 'class' => array()),
				'section' => array('id' => array(), 'class' => array())
			) );

		$title = $this->getInstance('title');
		$limit = $this->getInstance('limit');
		$date = $this->getInstance('date');
		$comments = $this->getInstance('comments');
		$like = $this->getInstance('like');
		$load_more = $this->getInstance('load_more');
		$width = $this->getInstance('width');
		$border_radius = $this->getInstance('radius');
		
        echo (!empty($title)) ? ( $before_title . $title . $after_title ) : '';
		
		$page = get_query_var('paged');
		$paged = ($page) ? $page : 1;
		$args_post = array(
			'post_type' => 'post',
			'posts_per_page' => $limit,
			'paged' => $paged,
			'post_status' => 'publish',
		);
		
		$query = new WP_Query($args_post);
		
		if(isset($args['widget_id']) && !empty($args['widget_id'])) {
			$id = $args['widget_id'];
		}else{
			$id = 'widget_'.$this->widget_base_id;
		}
		
		if ($width != '') {
			$link_css .= '#'.$id.' .entry-thumb {width: '.esc_attr($width).'px;}';
		}
		if ($border_radius != '') {
			$link_css .= '#'.$id.' .entry-thumb img {border-radius: '.esc_attr($border_radius).'px;}';
		}
		?>

        <div class="recent-posts-list">
		
		<?php
	    if ($query->have_posts()) {
			while($query->have_posts()) : $query->the_post();
			
				$this->item_html($date, $comments, $like);
			
			endwhile;
			
		} ?>
        </div>
		<?php
		if(!empty($load_more)) {
			if($query->max_num_pages > 1) {
				$data_atts = ' data-action="dfd_load_more"';

				$data_atts .= ' data-container=".recent-posts-list"';

				$data_atts .= ' data-current="'.esc_attr($paged).'"';

				$data_atts .= ' data-max_pages="'.esc_attr($query->max_num_pages).'"';

				$data_atts .= ' data-extra_params="limit='. esc_attr($limit) .'&date='. esc_attr($date) .'&comments='. esc_attr($comments) .'&like='. esc_attr($like) .'"';

				echo '<div class="pagination ajax-pagination">'
						. '<a class="button dfd-ajax-add-post" href="#" '.$data_atts.'>'.__('Load more', 'dfd-native').'<i class="dfd-socicon-refresh"></i></a>'
					. '</div><!--// end .pagination -->';
			}
		}

		wp_reset_postdata();
		?>
		<?php if(!empty($link_css)) { ?>
			<script>
				(function($) {
					$('head').append('<style><?php echo esc_js($link_css); ?></style>');
				})(jQuery);
			</script>
		<?php } ?>

		<?php
        echo wp_kses( $after_widget, array(
				'div' => array('id' => array(), 'class' => array()),
				'section' => array('id' => array(), 'class' => array())
			) );
    }
	
	function item_html($date = '', $comments = '', $like = '') {
		global $post;
		$like_count = intval(get_post_meta($post->ID, "_votes_count", true));
		?>
		<div class="post-list-item clearfix">
			<?php if (has_post_thumbnail()) {
				global $dfd_native;
				$thumb_class = $img_html = '';
				$thumb_img = get_post_thumbnail_id();
				$img_url = wp_get_attachment_image_src($thumb_img, array(150,150)); //get img URL
				if(isset($dfd_native['enable_images_lazy_load']) && $dfd_native['enable_images_lazy_load'] == 'on') {
					$thumb_class .= 'dfd-img-lazy-load';
					$loading_img_src = "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 150 150'%2F%3E";
					$img_html .= '<img src="'.$loading_img_src.'" data-src="'. esc_url($img_url[0]) .'" width="150" height="150" alt="'. esc_attr(get_the_title()) .'"/>';
				} else {
					$img_html .= '<img src="'. esc_url($img_url[0]) .'" width="150" height="150" alt="'. esc_attr(get_the_title()) .'"/>';
				}
				?>
				<div class="entry-thumb <?php echo esc_attr($thumb_class) ?>">
					<?php echo $img_html; ?>
				</div>
			<?php } ?>
			<div class="entry-content-wrap">
				<div class="dfd-widget-post-title">
					<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'dfd-native' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
				</div>

				<?php if(!empty($date) || !empty($comments) || !empty($like)) { ?>
					<div class="entry-meta">
						<?php if(!empty($date)) { ?>
							<span class="meta-data">
								<i class="dfd-socicon-clock"></i>
								<?php echo get_the_date('j.m.Y');?>
							</span>
						<?php } ?>
						<?php if(!empty($comments)) { ?>
							<span class="meta-comment">
								<i class="dfd-socicon-Untitled-2-37"></i>
								<?php
									comments_number( '0', '1', '%' );
								?>
							</span>
						<?php } ?>
						<?php if(!empty($like)) { ?>
							<span class="meta-likes">
								<?php echo '<a class="post-like" href="#" data-post_id="'.esc_attr($post->ID).'">'
												.'<i class="dfd-socicon-icon-ios7-heart"></i>'
												.esc_html($like_count)
											.'</a>'; ?>
							</span>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>
		<?php
	}
	
	function dfd_widgets_load_more_thumb() {
		$nonce = $_POST['nonce'];

		if (!wp_verify_nonce($nonce, 'ajax-nonce')) {
			die();
		}
		
		$current = isset($_POST['current']) ? $_POST['current'] : 1;
		
		$limit = isset($_POST['limit']) ? $_POST['limit'] : 3;
		
		$date = isset($_POST['date']) ? $_POST['date'] : '';
		
		$comments = isset($_POST['comments']) ? $_POST['comments'] : '';
		
		$like = isset($_POST['like']) ? $_POST['like'] : '';
		
		$args = array(
			'post_type' => 'post',
			'offset' => ($limit * $current),
			'posts_per_page' => $limit,
			'post_status' => 'publish',
		);
		
		$wp_query = new WP_Query($args);
		if($wp_query->have_posts()) {
			while($wp_query->have_posts()) : $wp_query->the_post();

				$this->item_html($date, $comments, $like);

			endwhile;

			wp_reset_postdata();
		}
		
		wp_die();
	}
}
