<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * DFD core Nothing found post template
 *
 * Generate Nothing found post html
 *
 * @author      dfd
 * @package     dfd_native theme
 * @version     1.0
 *
 */

if(!class_exists('Dfd_nothing')) {
	/**
	 * Nothing found post item generator
	 *
	 *
	 * @class 		Dfd_nothing
	 * @version		1.0
	 * @category	Class
	 * @author 		DFD
	 * @access		public
	 */
	class Dfd_nothing {
		
		/**
		 * Constructor.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		function __construct() {
			$this->post();
			
			add_action('dfd_head_custom_css', array($this, 'build_css'));
		}
		
		/**
		 * Post content generator
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		function post() {
			global $dfd_native;
			$html404 = $html_search_icon = $class = '';
			
			if (is_404()) {
				$html404 = '<h1 class="namber404">'.esc_html__('404', 'dfd-native').'</h1>';
				$html_search_icon = '<i class="dfd-socicon-konus"></i>';
				$class .= ' page404';
			} else {
				$html_search_icon = '<i class="dfd-socicon-Search"></i>';
				$class .= ' search-page';
			}
			
			if(is_404() && (isset($dfd_native['nothing_variant']) && $dfd_native['nothing_variant'] == 2)) {
				$this->nothing_custom_html();
			}else{
				$this->nothing_html($html404, $html_search_icon, $class);
			}
		}
		
		/**
		 * Generate post html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		function nothing_html($html404, $html_search_icon, $class) {
		?>
			<article id="post-0" class="page-not-found clearfix <?php echo esc_attr($class);?>">
				<div class="info-wrap-empty text-center">
					<div class="number-decoration"><?php echo wp_kses($html404,array('h1' => array('class' => array()))); ?></div>
					<div class="title-container">
						<div class="icon-wrap">
							<?php echo wp_kses($html_search_icon, array('i' => array('class' => array()))); ?>
						</div>
						<div class="title-wrap text-left">
							<h3 class="empty-title"><?php esc_html_e('Nothing was found', 'dfd-native'); ?></h3>
							<p class="empty-subttitle"><?php esc_html_e('Perhaps searching, or one of the links below, can help.', 'dfd-native') ?></p>
						</div>
					</div>
					<div class="button-wrap">
						<a class="empty-button button" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e( 'Back to homepage', 'dfd-native' ) ?><i class="dfd-socicon-reply"></i></a>
					</div>
				</div>
				<div class="container-shortcodes">
					<div class="delimeter-empty text-center"><span class="dfd-widget-list-content"><?php esc_html_e('or', 'dfd-native') ?></span></div>
					<div class="columns six">
						<div class="widget-arhives-empty">
							<p class="label-form dfd-content-title-small"><?php esc_html_e('Search in archives', 'dfd-native') ?></p>
							<div class="arhives">
								<select name="archive-menu" onChange="document.location.href = this.options[this.selectedIndex].value;">
									<option value=""></option>
									<?php wp_get_archives('type=monthly&format=option'); ?>
								</select>
							</div>
						</div>
					</div>
					<div class="columns six">
						<div class="widget-search-empty">
							<p class="label-form dfd-content-title-small"><?php esc_html_e('Search on site', 'dfd-native') ?></p>
							<?php get_search_form(); ?>
						</div>
					</div>
				</div>
			</article>
		<?php
		}
		
		/**
		 * Widgets content html for Nothing found page.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		function nothing_custom_html() {
			$columns_count = 0;
			for($i = 1; $i < 5; $i++) {
				(is_active_sidebar('sidebar-nothing-col'.$i)) ? $columns_count++ : 0;
			}
			$columns_number = Dfd_Theme_Helpers::dfd_num_to_string($columns_count);

			if ( $columns_count > 0 ) : ?>
				<div class="row">
					<?php
					$counter = 0;
					for ($i = 1; $i < $columns_count + 1; $i++) {
						$counter++;
						?>
						<div class="<?php echo esc_attr($columns_number); ?> columns">
							<?php dynamic_sidebar('sidebar-nothing-col' . $i); ?>
						</div>
					<?php
					}
				?>
				</div>
			<?php endif;
		}
		
		/**
		 * Generate dynamic css rules.
		 *
		 * @since 1.0
		 * @access public
		 */
		function build_css() {
			global $dfd_native;
			if(isset($dfd_native['nothing_bg_color']) && !empty($dfd_native['nothing_bg_color'])) {
				echo '#layout.nothing-found {background-color: '.esc_js($dfd_native['nothing_bg_color']).';}';
			}

			if(isset($dfd_native['nothing_bg_image_for_404']) && !empty($dfd_native['nothing_bg_image_for_404']['url'])) {
				echo '.page-not-found .info-wrap-empty .number-decoration {background-image: url('.esc_url($dfd_native['nothing_bg_image_for_404']['url']).'); background-size: initial; background-position: center; background-repeat: no-repeat;}';
				echo '.page-not-found .info-wrap-empty .number-decoration {-webkit-text-fill-color: transparent; -webkit-background-clip: text;}';
			}
		}
	}
}