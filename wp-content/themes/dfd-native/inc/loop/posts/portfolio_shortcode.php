<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_template_part('inc/loop/posts/portfolio');

/**
 * DFD core portfolio shortcode item
 *
 * Generate portfolio item content inside portfolio shortcode
 *
 * @author      dfd
 * @package     dfd_native theme
 * @version     1.0
 *
 */

if(!class_exists('Dfd_portfolio_shortcode')) {
	/**
	 * Portfolio item content generator for portfolio shortcode
	 *
	 *
	 * @class 		Dfd_portfolio_shortcode extends Dfd_post
	 * @version		1.0
	 * @category	Class
	 * @author 		DFD
	 * @access		public
	 */
	class Dfd_portfolio_shortcode extends Dfd_portfolio {

		/**
		 * Generate thmb image dimentions
		 *
		 * @since 1.0
		 * @access public
		 */
		public function get_thumb_size($ratio = 1.2) {
			$size = array();
			
			if(isset($this->loop_options['image_width']) && $this->loop_options['image_width'] != '' && isset($this->loop_options['image_height']) && $this->loop_options['image_height'] != '') {
				return array(
					$this->loop_options['image_width'],
					$this->loop_options['image_height']
				);
			}
			
			$columns = (int) $this->loop_options['columns'];
			
			if(!$columns) {
				$columns = 1;
			}
			
			$width = Dfd_Theme_Helpers::default_screen_width() / $columns;
			
			$height = $width / $ratio;
			
			$size[0] = $width;
			
			$size[1] = $height;
			
			return $size;
		}
		
		/**
		 * Get option method. Call DfdMetaBoxSettings::compared().
		 *
		 * @since 1.0
		 * @access public
		 */
		public function get_option($option, $default) {
			$options = $this->loop_options;

			if(isset($options[$option])) {
				return $options[$option];
			}

			return $default;
		}
		
		/**
		 * Generate dynamic css rules. Not used in original class but used in child classes
		 *
		 * @since 1.0
		 * @access public
		 */
		public function build_css() {
			
		}
	}
}