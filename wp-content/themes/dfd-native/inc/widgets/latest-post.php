<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
require_once(get_template_directory().'/inc/widgets/widget.php');

class dfd_latest_post extends SB_WP_Widget {
	protected $widget_base_id = 'dfd_latest_post';
	protected $widget_name = 'Custom: Latest Post';
	
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
				'meta', 'text', '',
				'label'		=> esc_html__('Display meta', 'dfd-native'),
				'input'		=> 'checkbox'
			),
			array(
				'exerpt', 'text', '',
				'label'		=> esc_html__('Display exerpt', 'dfd-native'),
				'input'		=> 'checkbox'
			),
			array(
				'load_more', 'text', '',
				'label'		=> esc_html__('Display load more button', 'dfd-native'),
				'input'		=> 'checkbox'
			),
			array(
				'radius', 'text', '',
				'label'		=> esc_html__('Thumb border radius in px', 'dfd-native'),
				'input'		=> 'number'
			),
		);
		
		add_action('wp_ajax_latest_dfd_load_more', array($this, 'dfd_widgets_load_more_latest'));
		add_action('wp_ajax_nopriv_latest_dfd_load_more', array($this, 'dfd_widgets_load_more_latest'));
		
        parent::__construct();
    }

    /**
     * Display widget
     */
    function widget( $args, $instance ) {
		$link_css = $id = '';
        extract( $args );
		$this->setInstances($instance, 'filter');
		
        echo wp_kses( $before_widget, array(
				'div' => array('id' => array(), 'class' => array()),
				'section' => array('id' => array(), 'class' => array())
			) );

		$title = $this->getInstance('title');
		$meta = $this->getInstance('meta');
		$exerpt = $this->getInstance('exerpt');
		$load_more = $this->getInstance('load_more');
		$border_radius = $this->getInstance('radius');
		
        echo (!empty($title)) ? ( $before_title . $title . $after_title ) : '';
		
		if(isset($args['widget_id']) && !empty($args['widget_id'])) {
			$id = $args['widget_id'];
		}else{
			$id = 'widget_'.$this->widget_base_id;
		}
		
		if(isset($border_radius) && strcmp($border_radius, '') != 0) {
			$link_css .= '#'.$id.' .entry-thumb img {border-radius: '.esc_attr($border_radius).'px;}';
			$link_css .= '#'.$id.' .post-list-item.format-gallery .slick-slide img {border-radius: '.esc_attr($border_radius).'px;}';
		}
		
		$page = get_query_var('paged');
		$paged = ($page) ? $page : 1;
		$args_post = array(
			'post_type' => 'post', //TODO: Add more post types and sort options
			'posts_per_page' => 1,
			'paged' => $paged,
		);

		$query = new WP_Query($args_post);
		?>
		<div class="dfd-content-wrap recent-posts-list">
		<?php

		if ($query->have_posts()) {
			while($query->have_posts()) : $query->the_post();

				$this->latest_item_html($meta, $exerpt);

			endwhile;
		} ?>
		</div>
		<?php
		if(!empty($load_more)) {
			if($query->max_num_pages > 1) {
				$data_atts = ' data-action="latest_dfd_load_more"';

				$data_atts .= ' data-container=".recent-posts-list"';

				$data_atts .= ' data-current="'.esc_attr($paged).'"';

				$data_atts .= ' data-max_pages="'.esc_attr($query->max_num_pages).'"';

				$data_atts .= ' data-extra_params="meta='. esc_js($meta) .'&exerpt='. esc_js($exerpt) .'"';

				echo '<div class="pagination ajax-pagination">'
						. '<a class="button dfd-ajax-add-post" href="#" '.$data_atts.'>'.esc_html__('Load more', 'dfd-native').'<i class="dfd-socicon-refresh"></i></a>'
					. '</div><!--// end .pagination -->';
			}
		}
		wp_reset_postdata(); ?>

		<?php
		if(!empty($link_css)) { ?>
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
	
	function latest_item_html($meta = '', $exerpt = '') {
		$post_class_elems = get_post_class();
		$post_class = implode(' ', $post_class_elems);

		$current_category_info = get_the_category();
		$current_cat_name = !empty($current_category_info) && is_array($current_category_info) ? $current_category_info[0]->cat_name : '';
		
		global $post;
		$like_count = intval(get_post_meta($post->ID, "_votes_count", true));
	?>
		<article class="post-list-item post <?php echo esc_attr($post_class); ?>">
			<div class="cover">
				<?php
				if(has_post_format('video')) {
					get_template_part('templates/post', 'video');
				} elseif(has_post_format('gallery')) {
					get_template_part('templates/post', 'gallery');
				} elseif(!has_post_format('quote') && !has_post_format('link') && !has_post_format('audio')) {
					if (has_post_thumbnail()) {
						$thumb = get_post_thumbnail_id();
						$img_url = wp_get_attachment_url($thumb, 'large');

						$article_image = dfd_aq_resize($img_url, 450);
						if(!$article_image) {
							$article_image = $img_url;
						}
					} else {
						$article_image = Dfd_Theme_Helpers::default_noimage_url();
					}
						?>
						<div class="entry-thumb">
							<a href="<?php esc_url(get_permalink()) ?>" title="<?php echo esc_attr(get_the_title()) ?>">
								<img src="<?php echo esc_url($article_image) ?>" alt="<?php echo esc_attr(get_the_title()) ?>"/>
							</a>
						</div>
				<?php
				}
				?>
				<?php if(!empty($meta)) { ?>
					<div class="entry-meta">
						<span class="meta-data">
							<i class="dfd-socicon-clock"></i>
							<?php echo the_date();?> <?php esc_html_e('in', 'dfd-native');?> <?php echo esc_html($current_cat_name);?>
						</span>
						<span class="meta-comment">
							<i class="dfd-socicon-Untitled-2-37"></i>
							<?php comments_number( '0', '1', '%' ); ?>
						</span>
						<span class="meta-likes">
							<?php echo '<a class="post-like" href="#" data-post_id="'.esc_attr($post->ID).'">'
											.'<i class="dfd-socicon-icon-ios7-heart"></i>'
											.esc_html($like_count)
										.'</a>'; ?>
						</span>
					</div>
				<?php } ?>
				<h3 class="entry-title dfd-widget-big-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
				<?php
				if(has_post_format('quote')) {
					get_template_part('templates/post', 'quote');
				} elseif(has_post_format('link')) {
					get_template_part('templates/post', 'link');
				} elseif(has_post_format('audio')) {
					get_template_part('templates/post', 'audio');
				} else {
					$content = get_the_excerpt();
					if(!empty($exerpt) || !empty($content)) { ?>
						<div class="entry-content">
							<?php echo wp_kses($content, array(
											'p' => array(
												'class' => array()
											)
										)); ?>
						</div>
					<?php
					}
				} ?>
			</div>
		</article>
	<?php
	}
	
	function dfd_widgets_load_more_latest() {
		$nonce = $_POST['nonce'];

		if (!wp_verify_nonce($nonce, 'ajax-nonce')) {
			die();
		}
		
		$current = isset($_POST['current']) ? $_POST['current'] : 1;
		
		//$limit = isset($_POST['limit']) ? $_POST['limit'] : 3;
		
		$meta = isset($_POST['meta']) ? $_POST['meta'] : '';
		
		$exerpt = isset($_POST['exerpt']) ? $_POST['exerpt'] : '';
		
		$args = array(
			'post_type' => 'post',
			'offset' => (/*$limit * */$current),
			'posts_per_page' => 1
		);
		
		$wp_query = new WP_Query($args);

		if($wp_query->have_posts()) {
			while($wp_query->have_posts()) : $wp_query->the_post();

				$this->latest_item_html($meta, $exerpt);

			endwhile;

			wp_reset_postdata();
		}
		
		wp_die();
	}
}
