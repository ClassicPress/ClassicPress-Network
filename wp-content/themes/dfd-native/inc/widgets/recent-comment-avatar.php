<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
require_once(get_template_directory().'/inc/widgets/widget.php');

class dfd_rec_com_with_avatar_noexept extends SB_WP_Widget {
	protected $widget_base_id = 'dfd_rec_com_with_avatar_noexept';
	protected $widget_name = 'Custom: Recent Comments with avatar no excerpt';
	
	protected $options;
	
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
		$this->widget_args = array(
			'description' => esc_html__('Advanced recent comments widget. With avatar & without excerpt', 'dfd-native')
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
				'values'	=> array('range', 'from'=>1, 'to'=>20),
				'on_update'	=> 'esc_attr'
			),
			array(
				'load_more', 'text', '',
				'label'		=> esc_html__('Display load more button', 'dfd-native'),
				'input'		=> 'checkbox'
			),
			array(
				'border_radius', 'text', '',
				'label'		=> esc_html__('Avatar border radius in "px"', 'dfd-native'),
				'input'		=> 'number',
				'on_update'	=> 'esc_attr'
			),
		);
		
		add_action( 'comment_post', array($this, 'flush_widget_cache') );
		add_action( 'edit_comment', array($this, 'flush_widget_cache') );
		add_action( 'transition_comment_status', array($this, 'flush_widget_cache') );
		
		add_action('wp_ajax_comment_avatar_dfd_load_more', array($this, 'dfd_widgets_load_more_comment_thumb'));
		add_action('wp_ajax_nopriv_comment_avatar_dfd_load_more', array($this, 'dfd_widgets_load_more_comment_thumb'));
		
        parent::__construct();
    }

    function flush_widget_cache() {
		wp_cache_delete('dfd_widget_recent_comments', 'widget');
    }
    
    /**
     * Display widget
     */
    function widget( $args, $instance ) {
		$link_css = $id = '';
        extract( $args );
		$this->setInstances($instance, 'filter');
		
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$limit = $this->getInstance('limit');
		$load_more = $this->getInstance('load_more');
		$border_radius = $this->getInstance('border_radius');

		extract($args, EXTR_SKIP);

		$title = $this->getInstance('title');

		global $comments, $comment;

		$arg = array(
			'post_type' => 'post',
			'number' => $limit,
			'status' => 'approve',
			'post_status' => 'publish',
		);
		$comments = get_comments($arg);
		
		$param = array(
			'post_type' => 'post',
			'status' => 'approve',
			'post_status' => 'publish',
		);
		$comments_summ = get_comments($param);
		$count_comments = count($comments_summ);
		
		if(isset($args['widget_id']) && !empty($args['widget_id'])) {
			$id = $args['widget_id'];
		}else{
			$id = 'widget_'.$this->widget_base_id;
		}
		
		if(isset($border_radius) && !empty($border_radius)) {
			$link_css .= '#'.$id.' .avatar {border-radius: '.esc_attr($border_radius).'px;}';
		}

		echo wp_kses( $before_widget, array(
				'div' => array('id' => array(), 'class' => array()),
				'section' => array('id' => array(), 'class' => array())
			) );
		
			echo (!empty($title)) ? ( $before_title . $title . $after_title ) : '';
			?>
			<ul class="dfd-list-comments">
				<?php
				if ( $comments ) {
					// Prime cache for associated posts. (Prime post term cache if we need it for permalinks.)
					$post_ids = array_unique( wp_list_pluck( $comments, 'comment_post_ID' ) );
					_prime_post_caches( $post_ids, strpos( get_option( 'permalink_structure' ), '%category%' ), false );

					foreach ( (array) $comments as $comment) {
						
						$this->item_html_comment_avatar($comment);
						
					}
				} ?>

			</ul>
			<?php
			if(!empty($load_more)) {
				if((int)$count_comments > 1 && (int)$count_comments > (int)$limit) {
					$data_atts = ' data-action="comment_avatar_dfd_load_more"';

					$data_atts .= ' data-container=".dfd-list-comments"';

					$data_atts .= ' data-current="1"';

					$data_atts .= ' data-max_pages="'.ceil((int)$count_comments / (int)$limit).'"';

					$data_atts .= ' data-extra_params="limit='. esc_js($limit) .'"';

					echo '<div class="pagination ajax-pagination">'
							. '<a class="button dfd-ajax-add-post" href="#" '.$data_atts.'>'.__('Load more', 'dfd-native').'<i class="dfd-socicon-refresh"></i></a>'
						. '</div><!--// end .pagination -->';
				}
			}
			wp_reset_postdata();

			if(!empty($link_css)) { ?>
				<script>
					(function($) {
						$('head').append('<style><?php echo esc_js($link_css); ?></style>');
					})(jQuery);
				</script>
			<?php }

		echo wp_kses( $after_widget, array(
				'div' => array('id' => array(), 'class' => array()),
				'section' => array('id' => array(), 'class' => array())
			) );
    }
	
	function item_html_comment_avatar($comment = '') {
		$comment_text = strlen(get_comment_text($comment->comment_ID)) < 100 ? get_comment_text($comment->comment_ID) : mb_substr(get_comment_text($comment->comment_ID), 0, 97) . '...';
		$d = "F j, Y";
		
		$author = get_comment_author($comment->comment_ID);
		?>

		<li class="dfd-list-elem-comments">
			<div class="container-content dfd-widget-list-content">
				<?php echo get_avatar($comment->user_id, 34); ?>
				<div class="dfd-widget-list-content">
					<span class="author-title"><?php echo esc_html($author); ?></span>
					<span class="author-text"><?php esc_html_e(' commented on ', 'dfd-native'); ?></span>
				</div>
				<a href="<?php echo esc_url( get_comment_link($comment->comment_ID) ); ?>" class="dfd-post-link" title=" " target="_blank"><?php echo get_the_title($comment->comment_post_ID); ?></a>
			</div>
			<div class="entry-meta">
				<span class="comments-date"><i class="dfd-socicon-clock"></i><?php echo get_comment_date($d, $comment->comment_ID); ?></span>
			</div>
		</li>
	<?php
	}
	
	function dfd_widgets_load_more_comment_thumb() {
		$nonce = $_POST['nonce'];

		if (!wp_verify_nonce($nonce, 'ajax-nonce')) {
			die();
		}
		
		$current = isset($_POST['current']) ? $_POST['current'] : 1;
		
		$limit = isset($_POST['limit']) ? $_POST['limit'] : 3;
		
		$args = array(
			'post_type' => 'post',
			'offset' => ($limit * $current),
			'number' => $limit,
		);
		
		$comments = get_comments($args);

		if ( $comments ) {
			foreach ( (array) $comments as $comment) {
				$this->item_html_comment_avatar($comment);
			}
		}
		
		wp_die();
	}
}