<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_template_part('inc/loop/posts/post_single');

/**
 * DFD core post single item
 *
 * Generate post item content inside loop for gallery page template
 *
 * @author      dfd
 * @package     dfd_native theme
 * @version     1.0
 *
 */

if(!class_exists('Dfd_portfolio_single')) {
	/**
	 * Single post item content generator
	 *
	 *
	 * @class 		Dfd_portfolio_single extends Dfd_post_single
	 * @version		1.0
	 * @category	Class
	 * @author 		DFD
	 * @access		public
	 */
	class Dfd_portfolio_single extends Dfd_post_single {
		
		/** @var string Portfolio item prefix. */
		public $prefix = 'portfolio_single';
				
		/**
		 * Generate portfolio html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function post_html() {
			$vc_content_position = $this->get_option($this->prefix.'_vc_content','top');
			if($vc_content_position == 'top') {
				$this->content_html();
			}
			$this->media_html();
			if($vc_content_position != 'top') {
				$this->content_html();
			}
		}
		
		/**
		 * Generate media content html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function media_html() {
			$gallery_style = $this->get_option($this->prefix.'_style','carousel');
			$desc_position = $this->get_option($this->prefix.'_description_position','bottom');
			
			$media_cover_class = 'eight';
			
			$description_html = $this->description_html($desc_position);
			
			if($desc_position == 'bottom' || $description_html == '') {
				$media_cover_class = 'twelve';
				$desc_position .= ' maybe-no-desc';
			}
			
			echo '<div class="row entry-thumb media-'.esc_attr($gallery_style).' description-'.esc_attr($desc_position).'">';
				echo ($desc_position == 'left') ? $description_html : '';
				echo '<div class="media-section '.esc_attr($media_cover_class).' columns">';
					get_template_part('templates/portfolio/gallery', $gallery_style);
				echo '</div>';
				echo ($desc_position != 'left') ? $description_html : '';
			echo '</div>';
		}
		
		/**
		 * Generate portfolio description html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function description_html($desc_position = 'bottom') {
			$description_html = $desc_fields_html = '';
			$desc_fields = DfdMetaBoxSettings::get($this->prefix.'_description');
			if(!empty($desc_fields) && is_array($desc_fields)) {
				$count = count($desc_fields);
				$cover_class = 'four';
				$item_class = 'twelve';
				if($desc_position == 'bottom') {
					$cover_class = 'twelve';
					if($count > 3) {
						$count = 3;
					}
					$item_class = Dfd_Theme_Helpers::dfd_num_to_string($count);
				}
				foreach($desc_fields as $field) {
					if(isset($field[$this->prefix.'_content_style']) && !empty($field[$this->prefix.'_content_style'])) {
						switch($field[$this->prefix.'_content_style']) {
							case 'description':
								if(
									( isset($field[$this->prefix.'_title']) && !empty($field[$this->prefix.'_title']) ) ||
									( isset($field[$this->prefix.'_content']) && !empty($field[$this->prefix.'_content']) )
								) {
									$desc_fields_html .= '<div class="'.esc_attr($item_class).' columns">';
									if(isset($field[$this->prefix.'_title']) && !empty($field[$this->prefix.'_title'])) {
										$desc_fields_html .= '<h5 class="dfd-content-title-big">'.esc_html($field[$this->prefix.'_title']).'</h5>';
									}
									if(isset($field[$this->prefix.'_content']) && !empty($field[$this->prefix.'_content'])) {
										$desc_fields_html .= '<div class="description">'.esc_html($field[$this->prefix.'_content']).'</div>';
									}
									$desc_fields_html .= '</div>';
								}
								break;
							case 'info':
								$desc_fields_html .= '<div class="'.esc_attr($item_class).' columns">';
									$desc_fields_html .= '<div class="delimiter hide"></div>';
									if(isset($field[$this->prefix.'_title']) && !empty($field[$this->prefix.'_title'])) {
										$desc_fields_html .= '<h5 class="dfd-content-title-big">'.esc_html($field[$this->prefix.'_title']).'</h5>';
									}
									for($i = 1; $i < 3; $i++) {
										if(
											(
												isset($field[$this->prefix.'_info_title_'.$i]) && !empty($field[$this->prefix.'_info_title_'.$i]) && 
												isset($field[$this->prefix.'_info_text_'.$i]) && !empty($field[$this->prefix.'_info_text_'.$i])
											)
										) {
											$desc_fields_html .= '<div class="description-field">'
																	. '<span class="dfd-link-heading">'.esc_html($field[$this->prefix.'_info_title_'.$i]).':</span>'
																	. '<span class="dfd-short-info">'.esc_html($field[$this->prefix.'_info_text_'.$i]).'</span>'
																. '</div>';
										}
									}
									/*Link html*/
									if(
										(
											isset($field[$this->prefix.'_link_url']) && !empty($field[$this->prefix.'_link_url']) && 
											isset($field[$this->prefix.'_link_text']) && !empty($field[$this->prefix.'_link_text']) &&
											isset($field[$this->prefix.'_link_title']) && !empty($field[$this->prefix.'_link_title'])
										)
									) {
										if(isset($field[$this->prefix.'_link_text']) && !empty($field[$this->prefix.'_link_text']) && isset($field[$this->prefix.'_link_text']) && !empty($field[$this->prefix.'_link_text'])) {
											$desc_fields_html .= '<div class="description-field">'
																	. '<span class="dfd-link-heading">'.esc_html($field[$this->prefix.'_link_title']).':</span>'
																	. '<a class="dfd-link" href="'.esc_url($field[$this->prefix.'_link_url']).'" target="_blank" title="'.esc_attr($field[$this->prefix.'_link_text']).'">'.esc_html($field[$this->prefix.'_link_text']).'</a>'
																. '</div>';
										}
									}
									/*Button html*/
									if(
										(
											isset($field[$this->prefix.'_button_text']) && !empty($field[$this->prefix.'_button_text']) && 
											isset($field[$this->prefix.'_button_url']) && !empty($field[$this->prefix.'_button_url'])
										)
									) {
										if(isset($field[$this->prefix.'_button_text']) && !empty($field[$this->prefix.'_button_text']) && isset($field[$this->prefix.'_button_url']) && !empty($field[$this->prefix.'_button_url'])) {
											$desc_fields_html .= '<div class="description-field">'
																	. '<a class="button" href="'.esc_url($field[$this->prefix.'_button_url']).'" target="_blank" title="'.esc_attr($field[$this->prefix.'_button_text']).'">'.esc_html($field[$this->prefix.'_button_text']).'</a>'
																. '</div>';
										}
									}
								$desc_fields_html .= '</div>';
								break;
						}
					}
				}
				if($desc_fields_html != '') {
					$description_html .= '<div class="dfd-portfolio-description '.esc_attr($cover_class).' columns">';
						$description_html .= '<div class="row">';
							$description_html .= $desc_fields_html;
						$description_html .= '</div>';
					$description_html .= '</div>';
				}
			}
			return $description_html;
		}
		
		/**
		 * Generate portfolio content html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function content_html() {
			$content = get_the_content();
			if($content != '') {
				unset($content);
				echo '<div class="entry-content row">';
					echo '<div class="twelve columns">';
						the_content();
					echo '</div>';
				echo '</div>';
			}
		}
		
		/**
		 * Generate portfolio category html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function category_html() {
			if($this->get_option($this->prefix.'_show_meta_category', 'on') == 'on') {
				echo '<span>'.esc_html__('in','dfd-native').'</span>';
				get_template_part('templates/entry-meta/mini', 'category-portfolio-simple');
			}
		}
		
		/**
		 * Generate single portfolio pagination html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function single_pagination_html() {
			$pagination_style = $this->get_option($this->prefix.'_pagination_style', 'fixed');
			if($pagination_style != 'off') {
				echo '<div class="dfd-single-pagination mobile-hide '.esc_attr($pagination_style).'">';
					get_template_part('templates/inside-pagination');
					if($pagination_style != 'fixed') {
						get_template_part('templates/entry-meta/folio-top-link');
					}
				echo '</div>';
			}
		}
		
		/**
		 * Generate portfolio content html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function single_related_posts_html() {
			
		}
		
		/**
		 * Generate dynamic css rules.
		 *
		 * @since 1.0
		 * @access public
		 */
		public function build_css() {
			$css = '';
			$offset = $this->get_option($this->prefix.'_gallery_offset', 0);
			$units = 'px';
			if(substr_count($offset,'%') > 0) {
				$units = '%';
			}
			if($offset != '') {
				$css .= '.'.$this->prefix.' .dfd-inside-gallery-wrap {margin: -'.(int)$offset / 2 . $units .';}'
					.	'.'.$this->prefix.' .dfd-inside-gallery-wrap > article > a.dfd-lightbox-link {display: block; padding: '. (int)$offset / 2 . $units .';}'
					.	'#layout.single-folio > .row.full-width .dfd-content-wrap.dfd-portfolio_single > article.portfolio .media-section.twelve.columns .media-cover,'
					.	'#layout.single-gallery > .row.full-width .dfd-content-wrap.dfd-gallery_single > article.gallery_single .media-section .media-cover {'
					.		'padding: '. (int)$offset . $units .';'
					.	'}';
			}
			echo esc_js($css);
		}
	}
}