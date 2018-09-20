<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_template_part('inc/loop/posts/portfolio');

/**
 * DFD core gallery post loop item
 *
 * Generate gallery item content inside loop for gallery page template
 *
 * @author      dfd
 * @package     dfd_native theme
 * @version     1.0
 *
 */

if(!class_exists('Dfd_gallery')) {
	/**
	 * Gallery item content generator
	 *
	 *
	 * @class 		Dfd_gallery extends Dfd_portfolio
	 * @version		1.0
	 * @category	Class
	 * @author 		DFD
	 * @access		private
	 */
	class Dfd_gallery extends Dfd_portfolio {
		
		/** @var string Post item prefix. */
		public $prefix = 'gallery';
		
		/**
		 * Generate gallery html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function post_html() {
			$this->media_html();
			$this->meta_html();
			$this->title_html();
			$this->subtitle_html();
		}
		
		/**
		 * Generate lightbox html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function lightbox() {
			$thumb_data_attr = '';
			if (has_post_thumbnail()) {
				$thumb = get_post_thumbnail_id();
				$img_url = wp_get_attachment_url($thumb, 'full');
				$thumb_url = wp_get_attachment_image_src($thumb, 'thumbnail');
				if(!empty($thumb_url[0])) {
					$thumb_data_attr = 'data-thumb="'.esc_url($thumb_url[0]).'"';
				}
			} else {
				$img_url = Dfd_Theme_Helpers::default_noimage_url();
			}

			$_folio_id = get_the_ID();

			# Extract gallery images
			$gallery_id = uniqid($_folio_id);

			if (metadata_exists('post', $_folio_id, '_gallery_image_gallery')) {
				$gallery_image_gallery = get_post_meta($_folio_id, '_gallery_image_gallery', true);
			} else {
				// Backwards compat
				$attachment_ids = get_posts('post_parent=' . $_folio_id . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids');
				$attachment_ids = array_diff($attachment_ids, array(get_post_thumbnail_id()));
				$gallery_image_gallery = implode(',', $attachment_ids);
			}

			$attachments = array_filter(explode(',', $gallery_image_gallery));
			
			echo '<a data-rel="prettyPhoto['. esc_attr($gallery_id) .']" '. $thumb_data_attr .' class="dfd-main-hover-link" href="'. esc_url($img_url) .'"></a>';
			
			echo '<span class="hide">';
				foreach ($attachments as $attachment_id) {
					$image_src = wp_get_attachment_image_src($attachment_id, 'full');
					if (empty($image_src[0])) {
						continue;
					}
					$attachment_img_url = $image_src[0];

					if (strcmp($attachment_img_url, $img_url)===0) {
						continue;
					}
					$thumb_src = wp_get_attachment_image_src($attachment_id, 'thumbnail');
					$thumb_data = '';
					if (!empty($thumb_src[0])) {
						$thumb_data .= 'data-thumb="'.esc_url($thumb_src[0]).'"';
					}

					echo '<a href="'. $attachment_img_url .'" '.$thumb_data.' data-rel="prettyPhoto['. esc_attr($gallery_id) .']"></a>';
				}
			echo '</span>';
		}
		
		/**
		 * Generate gallery category html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function category_html() {
			if($this->get_option($this->prefix.'_show_meta_category', 'on') == 'on') {
				echo '<span class="before-category">'.esc_html__('in','dfd-native').'</span>';
				get_template_part('templates/entry-meta/mini', 'category-gallery-simple');
			}
		}
	}
}