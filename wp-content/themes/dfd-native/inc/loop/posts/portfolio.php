<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_template_part('inc/loop/posts/post');

/**
 * DFD core portfolio loop item
 *
 * Generate portfolio item content inside loop for portfolio page template
 *
 * @author      dfd
 * @package     dfd_native theme
 * @version     1.0
 *
 */

if(!class_exists('Dfd_portfolio')) {
	/**
	 * Portfolio item content generator
	 *
	 *
	 * @class 		Dfd_portfolio extends Dfd_post
	 * @version		1.0
	 * @category	Class
	 * @author 		DFD
	 * @access		public
	 */
	class Dfd_portfolio extends Dfd_post {
		
		/** @var string Portfolio item prefix. */
		public $prefix = 'portfolio';
		
		/**
		 * Portfolio item content generator
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function post() {
			$css = '';
			$class = get_post_class();
			$class = implode(' ', $class);
			$class .= ' dfd-'.$this->prefix;
			$class .= ' '.$this->get_option($this->prefix.'_content_alignment', 'text-left');
			$appear = get_post_meta(get_the_ID(),$this->prefix.'_single_loop_apear',true);
			$class .= ' '.$appear;
			$class .= ' '.$this->build_hover_class();
			
			$data_atts = $this->build_article_data_atts();

			echo '<article class="'.esc_attr($class).'" '.$data_atts.'>';
				echo '<div class="cover" '.$css.'>';
					$this->post_html();
				echo '</div>';
				echo '<div class="dfd-shadow-box hide"></div>';
			echo '</article>';
		}
		
		/**
		 * Generate portfolio html.
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
			$this->content_html();
		}
		
		/**
		 * Generate media content html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function media_html() {
//			if($this->get_option($this->prefix.'_show_image', 'on') == 'on') {
				$this->get_simple_thumb();
//			}
		}
		
		/**
		 * Generate title html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function title_html() {
			if($this->get_option($this->prefix.'_show_title', 'on') == 'on') {
				echo '<h3 class="entry-title"><a href="'.esc_url(get_permalink()).'" title="'. esc_html(get_the_title()) .'">'. esc_html(get_the_title()) .'</a></h3>';
			}
		}
		
		/**
		 * Generate title html for entry hover decoration.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function title() {
			echo '<h3 class="entry-title"><span>'. esc_html(get_the_title()) .'</span></h3>';
		}
		
		/**
		 * Generate subtitle html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function subtitle_html() {
			if($this->get_option($this->prefix.'_show_subtitle', 'on') == 'on') {
				$this->subtitle();
			}
		}
		
		/**
		 * Generate subtitle html for hover decoration.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function subtitle() {
			$subtitle = DfdMetaBoxSettings::get('stunnig_headers_subtitle');
			if(!empty($subtitle)) {
				echo '<div class="entry-subtitle dfd-content-subtitle"><span>'. esc_html($subtitle) .'</span></div>';
			}
		}
		
		/**
		 * Generate thumb html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function get_simple_thumb() {
			global $dfd_native;
			
			$img_html = $thumb_class = $thumb = '';
			
			$width = 675;
			$height = 450;
			if (has_post_thumbnail()) {
				$thumb = get_post_thumbnail_id();
				$img_src = wp_get_attachment_image_src($thumb, 'full');
				$img_url = $img_src[0];
				$ratio = 1.2;
				
				if($this->loop_options[$this->prefix.'_style'] == 'masonry') {
					$ratio = $img_src[1] / $img_src[2];
				} elseif($this->loop_options[$this->prefix.'_style'] == 'metro') {
					$ratio = 1;
				}
				
				$image_size = $this->get_thumb_size($ratio);
				$width = $image_size[0];
				$height = $image_size[1];
				if($this->loop_options[$this->prefix.'_style'] == 'metro') {
					switch(get_post_meta(get_the_ID(),$this->prefix.'_single_loop_apear',true)) {
						case 'dfd-side-image':
							$width = $width * 2;
							break;
						case 'dfd-featured':
							$height = $height * 2;
							break;
						case 'dfd-side-image dfd-featured':
							$width = $width * 2;
							$height = $height * 2;
							break;
					}
				} elseif($this->loop_options[$this->prefix.'_style'] == 'justified') {
					$width = $height * ($img_src[1] / $img_src[2]);
				}
				$img_url = dfd_aq_resize($img_url, $width * 1.2, $height * 1.2, true, true, true);
				if(!$img_url) {
					$img_url = $img_src[0];
				}
				
			} else {
				$img_url = Dfd_Theme_Helpers::default_noimage_url();
			}
			
//			if($this->loop_options[$this->prefix.'_hover_main_decoration'] != 'buttons') {
//				$post_link = $this->hover_link();
//			}
			
			$post_title = get_the_title();
			
			$img_atts = Dfd_Theme_Helpers::get_image_attrs($img_url, $thumb, $width, $height, $post_title);

			if(isset($dfd_native['enable_images_lazy_load']) && $dfd_native['enable_images_lazy_load'] == 'on') {
				$thumb_class .= 'dfd-img-lazy-load';
				$loading_img_src = "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 $width $height'%2F%3E";
				$img_html .= '<img src="'.$loading_img_src.'" data-src="'. esc_url($img_url) .'" width="'.esc_attr(floor($width)).'" height="'.esc_attr(floor($height)).'" '.$img_atts.' />';
			} else {
				$img_html .= '<img src="'. esc_url($img_url) .'" width="'.esc_attr(floor($width)).'" height="'.esc_attr(floor($height)).'" '.$img_atts.' />';
			}

			echo '<div class="entry-thumb  '.esc_attr($thumb_class).'">';
				if($this->loop_options[$this->prefix.'_show_top_cat'] == 'on') {
					get_template_part('templates/entry-meta/mini', 'category-'.$this->prefix);
				}
				echo '<span class="thumb-wrap">'
						. $img_html
					. '</span>';
				$this->entry_hover();
			echo '</div>';
		}
		
		/**
		 * Generate entry hover html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function entry_hover() {
			if($this->loop_options[$this->prefix.'_hover_enable'] == 'on') {
				$hover_deco = 'hover_'.$this->loop_options[$this->prefix.'_hover_main_decoration'];
				if($this->loop_options[$this->prefix.'_hover_main_decoration'] != 'buttons') {
					$this->hover_link();
				}
				echo '<div class="entry-hover">';
					//$this->lightbox();
					if(method_exists($this, $hover_deco)) {
						$this->$hover_deco();
					}
					echo '<div class="dfd-hover-frame-deco hide">'
							. '<div class="line line-top"></div>'
							. '<div class="line line-bottom"></div>'
							. '<div class="line line-left"></div>'
							. '<div class="line line-right"></div>'
						. '</div>';
				echo '</div>';
			}
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

			if (metadata_exists('post', $_folio_id, '_my_product_image_gallery')) {
				$my_product_image_gallery = get_post_meta($_folio_id, '_my_product_image_gallery', true);
			} else {
				// Backwards compat
				$attachment_ids = get_posts('post_parent=' . $_folio_id . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids');
				$attachment_ids = array_diff($attachment_ids, array(get_post_thumbnail_id()));
				$my_product_image_gallery = implode(',', $attachment_ids);
			}

			$attachments = array_filter(explode(',', $my_product_image_gallery));
			
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
		 * Generate external link source.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function external_link() {
			$external_link = get_post_meta(get_the_ID(),$this->prefix.'_single_external_link_url',true);
			if($external_link && $external_link != '') {
				return $external_link;
			}
			return false;
		}
		
		/**
		 * Generate hover link html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function hover_link() {
			$link_url = get_permalink();
			$link_src = $this->loop_options[$this->prefix.'_hover_main_decoration_link'];
			if($link_src == 'external') {
				$link = $this->external_link();
				if(!empty($link)) {
					$link_url = $link;
				}
			} elseif($link_src == 'lightbox') {
				$this->lightbox();
				return;
			}
			echo '<a href="'.esc_url($link_url).'" class="dfd-main-hover-link" title=""></a>';
		}
		
		/**
		 * Generate heading hover decoration html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function hover_heading() {
			//echo '<div class="title-wrap '.esc_attr($this->loop_options[$this->prefix.'_hover_title_decoration']).'">';
			echo '<div class="title-wrap">';
				if($this->get_option($this->prefix.'_hover_show_title', 'on') == 'on') {
					$this->title();
				}
				if($this->get_option($this->prefix.'_hover_show_subtitle', 'on') == 'on') {
					$this->subtitle();
				}
			echo '</div>';
		}
		
		/**
		 * Generate plus hover decoration html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function hover_plus() {
			echo '<span class="plus-link '. esc_attr($this->loop_options[$this->prefix.'_hover_plus_position']) .'">';
				echo '<span class="plus-link-container">';
					echo '<span class="plus-link-out"></span>';
					echo '<span class="plus-link-come"></span>';
				echo '</span>';
			echo '</span>';
		}
		
		/**
		 * Generate lines hover decoration html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function hover_lines() {
			echo '<span class="dfd-dotted-link">';
				echo '<span class="dfd-left-line"></span>';
				echo '<span></span>';
				echo '<span class="dfd-right-line"></span>';
			echo '</span>';
		}
		
		/**
		 * Generate dots hover decoration html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function hover_dots() {
			echo '<span class="dfd-dots-link">';
				echo '<span class="dfd-left-dot"></span>';
				echo '<span class="dfd-middle-dot"></span>';
				echo '<span class="dfd-right-dot"></span>';
			echo '</span>';
		}
		
		/**
		 * Generate buttons hover decoration html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function hover_buttons() {
			if($this->loop_options[$this->prefix.'_hover_appear_effect'] == 'dfd-3d-parallax') {
				$this->hover_link();
				return;
			}
			echo '<span class="dfd-hover-buttons-wrap">';
				if($this->get_option($this->prefix.'_hover_buttons_external', '') == 'on') {
					$url = $this->external_link();
					if(!empty($url)) {
						echo '<a class="dfd-socicon-link2" href="'.esc_url($url).'" title=""></a>';
					}
				}
				if($this->get_option($this->prefix.'_hover_buttons_lightbox', '') == 'on') {
					echo '<i class="dfd-socicon-stack-2">';
						$this->lightbox();
					echo '</i>';
				}
				if($this->get_option($this->prefix.'_hover_buttons_inside', '') == 'on') {
					echo '<a class="dfd-socicon-image" href="'.esc_url(get_permalink()).'" title=""></a>';
				}
			echo '</span>';
		}
		
		/**
		 * Generate portfolio item hover.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function build_hover_class() {
			$class = '';
			if($this->loop_options[$this->prefix.'_hover_enable'] == 'on') {
				$non3d_hovers = array(
					'dfd-fade-out',
					'dfd-fade-offset',
					'dfd-left-to-right',
					'dfd-right-to-left',
					'dfd-top-to-bottom',
					'dfd-bottom-to-top',
				);
				$appear_effect = $this->loop_options[$this->prefix.'_hover_appear_effect'];
				$image_effect = $this->loop_options[$this->prefix.'_hover_image_effect'];
				$class .= $appear_effect;
				if(in_array($appear_effect, $non3d_hovers)) {
					$class .= ' '.$image_effect;
				}
			}
			
			return $class;
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
				echo '<span class="before-category">'.esc_html__('in','dfd-native').'</span>';
				get_template_part('templates/entry-meta/mini', 'category-portfolio-simple');
			}
		}
		
		/**
		 * Generate thumb image dimentions
		 *
		 * @since 1.0
		 * @access public
		 */
		public function get_thumb_size($ratio = 1.2) {
			$size = array();
			
			$layout_style = $this->loop_options[$this->prefix.'_style'];
			
			$columns = (int) $this->loop_options[$this->prefix.'_columns'] + (int)$this->loop_options['sidebars'];
			
			if(!$columns) {
				$columns = 1;
			}

			if($layout_style == 'side-image') {
				$columns = 1;
				$ratio = 1.7;
			}
			
			$width = $this->loop_options['layout_width'] / $columns;
			
			$height = $width / $ratio;
			
			$size[0] = $width;
			
			$size[1] = $height;
			
			return $size;
		}
		
		/**
		 * Generate dynamic css rules.
		 *
		 * @since 1.0
		 * @access public
		 */
		public function build_css() {
			$css = '';
			
			if($this->loop_options[$this->prefix.'_hover_mask_border'] == 'on') {
				$frame_style = $this->loop_options[$this->prefix.'_hover_mask_bordered_style'];
				$frame_size = $this->loop_options[$this->prefix.'_hover_mask_bordered_size'];
				$units = 'px';
				if(substr_count($frame_size,'%') > 0) {
					$units = '%';
				}
				if($frame_style == 'simple-border') {
					$css .= '#main-content > .dfd-content-wrap.dfd-'. $this->prefix .' .dfd-'. $this->prefix .' .entry-thumb .entry-hover .dfd-hover-frame-deco,'
						  . '#main-content > .dfd-content-wrap.dfd-'. $this->prefix .'_archive .dfd-'. $this->prefix .'_archive .entry-thumb .entry-hover .dfd-hover-frame-deco {'
								. 'display: block;'
							. '}'
							. '#main-content > .dfd-content-wrap.dfd-'. $this->prefix .' .dfd-'. $this->prefix .' .entry-thumb .entry-hover .dfd-hover-frame-deco .line.line-top,'
							. '#main-content > .dfd-content-wrap.dfd-'. $this->prefix .' .dfd-'. $this->prefix .' .entry-thumb .entry-hover .dfd-hover-frame-deco .line.line-bottom,'
							. '#main-content > .dfd-content-wrap.dfd-'. $this->prefix .'_archive .dfd-'. $this->prefix .'_archive .entry-thumb .entry-hover .dfd-hover-frame-deco .line.line-top,'
							. '#main-content > .dfd-content-wrap.dfd-'. $this->prefix .'_archive .dfd-'. $this->prefix .'_archive .entry-thumb .entry-hover .dfd-hover-frame-deco .line.line-bottom {'
								. 'height: '.(int)$frame_size.$units.';'
							. '}'
							. '#main-content > .dfd-content-wrap.dfd-'. $this->prefix .' .dfd-'. $this->prefix .' .entry-thumb .entry-hover .dfd-hover-frame-deco .line.line-left,'
							. '#main-content > .dfd-content-wrap.dfd-'. $this->prefix .' .dfd-'. $this->prefix .' .entry-thumb .entry-hover .dfd-hover-frame-deco .line.line-right,'
							. '#main-content > .dfd-content-wrap.dfd-'. $this->prefix .'_archive .dfd-'. $this->prefix .'_archive .entry-thumb .entry-hover .dfd-hover-frame-deco .line.line-left,'
							. '#main-content > .dfd-content-wrap.dfd-'. $this->prefix .'_archive .dfd-'. $this->prefix .'_archive .entry-thumb .entry-hover .dfd-hover-frame-deco .line.line-right {'
								. 'width: '.(int)$frame_size.$units.';'
							. '}'
							. '#main-content > .dfd-content-wrap.dfd-'. $this->prefix .' .dfd-'. $this->prefix .'.dfd-3d-parallax .entry-thumb .entry-hover:before,'
							. '#main-content > .dfd-content-wrap.dfd-'. $this->prefix .'_archive .dfd-'. $this->prefix .'_archive.dfd-3d-parallax .entry-thumb .entry-hover:before {'
								. 'display: none;'
							. '}'
							. '.dfd-'. $this->prefix .'.dfd-3d-parallax .cover .entry-thumb .thumb-wrap:before,'
							. '.dfd-'. $this->prefix .'_archive.dfd-3d-parallax .cover .entry-thumb .thumb-wrap:before {'
								. 'display: block !important;'
							. '}';
				} elseif($frame_style == 'offset') {
					$css .= '#main-content > .dfd-content-wrap.dfd-'. $this->prefix .' .dfd-'. $this->prefix .' .entry-thumb .entry-hover:before,'
						  . '#main-content > .dfd-content-wrap.dfd-'. $this->prefix .'_archive .dfd-'. $this->prefix .'_archive .entry-thumb .entry-hover:before {'
								. 'top: '.(int)$frame_size. $units .'; bottom: '.(int)$frame_size. $units .';'
								. 'left: '.(int)$frame_size. $units .'; right: '.(int)$frame_size. $units .';'
							. '}'
							. '#main-content > .dfd-content-wrap.dfd-'. $this->prefix .' .dfd-'. $this->prefix .'.dfd-3d-parallax .entry-thumb .entry-hover:before,'
							. '#main-content > .dfd-content-wrap.dfd-'. $this->prefix .'_archive .dfd-'. $this->prefix .'_archive.dfd-3d-parallax .entry-thumb .entry-hover:before,'
							. '#main-content > .dfd-content-wrap.dfd-'. $this->prefix .' .dfd-'. $this->prefix .'.dfd-3d-parallax:hover .entry-thumb .entry-hover:before,'
							. '#main-content > .dfd-content-wrap.dfd-'. $this->prefix .'_archive .dfd-'. $this->prefix .'_archive.dfd-3d-parallax:hover .entry-thumb .entry-hover:before {'
								. '-webkit-transform: scale(1);'
								. '-moz-transform: scale(1);'
								. '-o-transform: scale(1);'
								. 'transform: scale(1);'
							. '}';
				}
			}
			
			echo esc_js($css);
		}
	}
}