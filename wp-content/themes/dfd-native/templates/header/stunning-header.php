<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $dfd_native;

if((!isset($dfd_native['enable_stunning_header']) || $dfd_native['enable_stunning_header'] != 'off') && !class_exists('Dfd_Stunning_Header')) {
	class Dfd_Stunning_Header {
		
		public $uniqid;
		
		function __construct() {
			$this->uniqid = uniqid('dfd-stun-header-');
			$this->init();
			add_action('dfd_head_custom_css', array($this, 'build_css'));
		}
		
		public function init() {
			$class = $this->build_class();
			echo '<div id="stuning-header">';
				$this->build_background();
				echo '<div class="stuning-header-inner">';
					echo '<div class="row">';
						echo '<div class="twelve columns">';
							echo '<div class="page-title-inner '. esc_attr($class) .'">';
								$this->build_category();
								echo '<div class="page-title-inner-wrap">';
									$this->build_breadcrumbs();
									$this->build_title();
									$this->build_subtitle();
									$this->build_popup_video();
								echo '</div>';
								$this->build_meta();
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}
		
		public function build_class() {
			$class = '';
			
			$bg_check = $this->get_option('stunnig_headers_bgcheck', '');
			
			if($bg_check != '') {
				$class .= ' '.$bg_check;
			}
			
			$align = $this->get_option('stunnig_headers_text_alignment', 'text-center');

			if ($align != '') {
				$class .= ' '.$align;
			}
			
			$parallax = $this->get_option('enable_stun_parallax', '');

			if ($parallax != '') {
				$class .= ' '.$parallax;
			}
			
			$full_height = $this->get_option('stunning_header_full_height', '');
			
			if($full_height == 'on') {
				$class .= ' full-height';
			}
			
			return $class;
		}
		
		public function build_category() {
			global $dfd_native;
			if(is_singular('post') && isset($dfd_native['post_single_stun_header_cat']) && $dfd_native['post_single_stun_header_cat'] == 'on'):
				echo '<div class="dfd-mini-categories">';
					get_template_part('templates/entry-meta/mini', 'category-highlighted');
				echo '</div>';
			endif;
		}
		
		public function build_breadcrumbs() {
			if ($this->get_option('stun_header_breadcrumbs','on') != 'off') {
				if ( function_exists('yoast_breadcrumb') ) {
					yoast_breadcrumb('<div id="breadcrumbs" class="breadcrumbs">','</div>');
				} else {
					echo '<div class="breadcrumbs">';
						# Woocommerce: product or product taxonomy
						if (
								function_exists('is_product_taxonomy') && is_product_taxonomy()
							||
								function_exists('is_product') && is_product()
							)
						{
							woocommerce_breadcrumb();
						}
						# Portfolio
						elseif ( is_singular( array( 'portfolio' ) ) && method_exists( $this, 'dfd_portfolio_breadcrumbs' ) ) {
							$this->dfd_portfolio_breadcrumbs();
						}
						# BBpress || ByddyPress
						elseif (
							function_exists('bbp_breadcrumb')
							&&
							(
								( function_exists('is_bbpress') && is_bbpress() )
								||
								( function_exists('is_buddypress') && is_buddypress() )
							)
						)
						{
							bbp_breadcrumb();
						}
						# Default breadcrumbs
						elseif (method_exists($this,'dfd_breadcrumbs')) {
							$this->dfd_breadcrumbs();
						}
					echo '</div>';
				}
			}
		}
		
		public function dfd_breadcrumbs() {
			$html = '';

			/* === OPTIONS === */
			$text['home']     = esc_html__('Home', 'dfd-native'); // text for the 'Home' link
			$text['category'] = esc_html__('Archive by Category "%s"', 'dfd-native'); // text for a category page
			$text['search']   = esc_html__('Search Results for "%s" Query', 'dfd-native'); // text for a search results page
			$text['tag']      = esc_html__('Posts Tagged "%s"', 'dfd-native'); // text for a tag page
			$text['author']   = esc_html__('Articles Posted by %s', 'dfd-native'); // text for an author page
			$text['404']      = esc_html__('Error 404', 'dfd-native'); // text for the 404 page

			$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
			$showOnHome  = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
			$delimiter   = ' <span class="del"></span> '; // delimiter between crumbs
			$before      = '<span class="current">'; // tag before the current crumb
			$after       = '</span>'; // tag after the current crumb
			/* === END OF OPTIONS === */

			global $post;
			$homeLink = home_url('/');
			$linkBefore = '<span>';
			$linkAfter = '</span>';
			$link = $linkBefore . '<a href="%1$s">%2$s</a>' . $linkAfter;

			if (is_home() || is_front_page()) {

				if ($showOnHome == 1) $html .= '<nav id="crumbs"><a href="' . esc_url($homeLink) . '">' . $text['home'] . '</a></nav>';

			} else {

				$html .= '<nav id="crumbs">' . sprintf($link, $homeLink, $text['home']);

				if ( is_category() ) {
					$thisCat = get_category(get_query_var('cat'), false);
					if ($thisCat->parent != 0) {
						$cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
						$cats = str_replace('<a', $linkBefore . '<a', $cats);
						$html .= str_replace('</a>', '</a>' . $linkAfter, $cats);
					}
					$html .= ( $before . sprintf($text['category'], single_cat_title('', false)) . $after );

				} elseif ( is_search() ) {
					$html .= ( $before . sprintf($text['search'], get_search_query()) . $after );


				}
				elseif (is_singular('topic') ){
					$post_type = get_post_type_object(get_post_type());
					printf($link, $homeLink . '/forums/', $post_type->labels->singular_name);
				}
				/* in forum, add link to support forum page template */
				elseif (is_singular('forum')){
					$post_type = get_post_type_object(get_post_type());
					printf($link, $homeLink . '/forums/', $post_type->labels->singular_name);
				}
				elseif (is_tax('topic-tag')){
					$post_type = get_post_type_object(get_post_type());
					printf($link, $homeLink . '/forums/', $post_type->labels->singular_name);
				}
				elseif ( is_day() ) {
					$html .= sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
					$html .= sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
					$html .= ( $before . get_the_time('d') . $after );

				} elseif ( is_month() ) {
					$html .= sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
					$html .= ( $before . get_the_time('F') . $after );

				} elseif ( is_year() ) {
					$html .= ( $before . get_the_time('Y') . $after );

				} elseif ( is_single() && !is_attachment() ) {
					if ( get_post_type() != 'post' ) {
						$post_type = get_post_type_object(get_post_type());
						$slug = $post_type->rewrite;
						printf($link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
						if ($showCurrent == 1) {
							$html .= ( $delimiter . $before . esc_html(get_the_title()) . $after );
						}
					} else {
						$cat = get_the_category();
						if(isset($cat[0])) {
							$cat =  $cat[0];
							$cats = get_category_parents($cat, TRUE, $delimiter);
							if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
							$cats = str_replace('<a', $linkBefore . '<a', $cats);
							$html .= str_replace('</a>', '</a>' . $linkAfter, $cats);
							if ($showCurrent == 1) {
								$html .= ( $before . get_the_title() . $after );
							}
						}
					}

				} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() && isset($post_type->labels->singular_name) ) {
					$post_type = get_post_type_object(get_post_type());
					$html .= $before . esc_html($post_type->labels->singular_name) . $after;

				} elseif ( is_attachment() ) {
					$parent = get_post($post->post_parent);
					$cat = get_the_category($parent->ID);
					if($cat) {
						$cat = $cat[0];
						$cats = get_category_parents($cat, TRUE, $delimiter);
						$cats = str_replace('<a', $linkBefore . '<a', $cats);
						$html .= str_replace('</a>', '</a>' . $linkAfter, $cats);
						printf($link, get_permalink($parent), $parent->post_title);
						if ($showCurrent == 1) {
							$html .= ( $delimiter . $before . esc_html(get_the_title()) . $after );
						}
					}
				} elseif ( is_page() && !$post->post_parent ) {
					if ($showCurrent == 1) {
						$html .= ( $before . esc_html(get_the_title()) . $after );
					}

				} elseif ( is_page() && $post->post_parent ) {
					$parent_id  = $post->post_parent;
					$breadcrumbs = array();
					while ($parent_id) {
						$page = get_page($parent_id);
						$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
						$parent_id  = $page->post_parent;
					}
					$breadcrumbs = array_reverse($breadcrumbs);
					for ($i = 0; $i < count($breadcrumbs); $i++) {
						$html .= wp_kses( $breadcrumbs[$i], array('span' => array('class' => array()), 'a' => array('href' => array(), 'title' => array(), 'class' => array())) );
						if ($i != count($breadcrumbs)-1) {
							$html .= ( $delimiter );
						}
					}
					if ($showCurrent == 1) {
						$html .= ( $delimiter . $before . esc_html(get_the_title()) . $after );
					}

				} elseif ( is_tag() ) {
					$html .= ( $before . sprintf($text['tag'], single_tag_title('', false)) . $after );

				} elseif ( is_author() ) {
					global $author;
					$userdata = get_userdata($author);
					$html .= ( $before . sprintf($text['author'], $userdata->display_name) . $after );

				} elseif ( is_404() ) {
					$html .= ( $before . $text['404'] . $after );
				}

				if ( get_query_var('paged') ) {
					if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $html .= ' (';
					$html .= '<span class="current">'.__('Page', 'dfd-native') . ' ' . get_query_var('paged') .'</span>';
					if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $html .= ')';
				}

				$html .= '</nav>';

				echo !empty($html) ? $html : '';
			}
		}
		
		public function dfd_portfolio_breadcrumbs() {
			global $dfd_native;

			echo '<nav id="crumbs">';
				echo '<span><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'dfd-native') . '</a></span>';
				echo '<span class="del"></span>';

				if(isset($dfd_native['folio_top_page_select']) && !empty($dfd_native['folio_top_page_select'])) {
					$page = $dfd_native['folio_top_page_select'];

					if(isset($dfd_native['folio_top_page_title']) && !empty($dfd_native['folio_top_page_title'])) {
						$title = $dfd_native['folio_top_page_title'];
					} else {
						$title = get_the_title($page);
					}
					$slug = get_permalink($page);

					if (!empty($title) && !empty($slug)) {
						echo '<span><a href="' . esc_url($slug) . '">' . esc_html($title) . '</a></span>';
						echo '<span class="del"></span>';
					}
				}

				echo '<span class="current">'.esc_html(get_the_title()).'</span>';
			echo '</nav>';
		}
		
		public function build_title() {
			if($this->get_option('enable_stun_header_title', 'on') != 'off') :
				echo '<h1 class="dfd-page-title">';
					switch ( true ) {
						# Home page
						case ( is_home() ):
							$page_for_posts = get_option('page_for_posts', true);
							if ($page_for_posts) {
								echo esc_html(get_the_title($page_for_posts));
							} else {
								esc_html_e('Latest Posts', 'dfd-native');
							}
							break;

						# Archive
						case ( is_archive() ):
							$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));

							if ($term && isset($term->name)) {
								echo esc_html($term->name);
							} elseif (is_post_type_archive()) {
								$queried_object = get_queried_object();

								if (isset($queried_object->labels) && isset($queried_object->labels->name)) {
									echo esc_html($queried_object->labels->name);
								}
							} elseif (is_day()) {
								printf(esc_html__('Daily Archives: %s', 'dfd-native'), get_the_date());
							} elseif (is_month()) {
								printf(esc_html__('Monthly Archives: %s', 'dfd-native'), get_the_date('F Y'));
							} elseif (is_year()) {
								printf(esc_html__('Yearly Archives: %s', 'dfd-native'), get_the_date('Y'));
							} elseif (is_author()) {
								global $post;
								$author_id = $post->post_author;

								$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
								$google_profile = get_the_author_meta('google_profile', $curauth->ID);
								if ($google_profile) {
									printf(esc_html__('Author Archives:', 'dfd-native'));
									echo '<a href="' . esc_url($google_profile) . '" rel="me">' . esc_html($curauth->display_name) . '</a>';
								} else {
									printf(esc_html__('Author Archives: %s', 'dfd-native'), get_the_author_meta('display_name', $author_id));
								}
							} else {
								single_cat_title();
							}
							break;

						# Search
						case ( is_search() ):
							printf(esc_html__('Search Results for %s', 'dfd-native'), get_search_query());
							break;

						# 404 black hole o_O
						case ( is_404() ):
							esc_html_e('Whoops!', 'dfd-native');
							break;

						# Default
						default:
							the_title();

					}
				echo '</h1>';
			endif;
		}
		
		public function build_subtitle() {
			$custom_head_subtitle = DfdMetaBoxSettings::get('stunnig_headers_subtitle');
			if (!empty($custom_head_subtitle) && $this->get_option('enable_stun_header_subtitle','on') != 'off') {
				echo '<h2 class="dfd-page-subtitle">';
					echo esc_html($custom_head_subtitle);
				echo '</h2>';
			}
		}
		
		public function build_meta() {
			global $dfd_native;
			if (is_singular('post') && isset($dfd_native['post_single_stun_header_meta']) && $dfd_native['post_single_stun_header_meta'] == 'on'):
				echo '<div class="dfd-meta-wrap clearfix">';
					echo '<div class="entry-meta meta-left">';
						$author_id = get_queried_object()->post_author;
						echo '<figure class="author-photo">';
							echo get_avatar( $author_id , 40 );
						echo '</figure>';
						echo'<span>';
							echo esc_attr__('by','dfd-native');
						echo'</span>';
							$author_name = get_the_author_meta('nickname', $author_id);
						echo '<span class="byline author vcard">';
							echo esc_html($author_name);
						echo '</span>';
					echo '</div>';
					echo '<div class="entry-meta meta-right">';
						get_template_part('templates/entry-meta/mini', 'date');
						get_template_part('templates/entry-meta/mini', 'comments');
						echo '<span class="entry-views">';
							get_template_part('templates/entry-meta/mini', 'views');
						echo '</span>';
						get_template_part('templates/entry-meta/mini', 'like');
						get_template_part('templates/entry-meta/mini', 'share');
					echo '</div>';
				echo '</div>';
			endif;
		}
		
		public function build_background() {
			$class = $data_atts = '';
			
			$parallax = $this->get_option('enable_stun_parallax', '');

			if ($parallax == 'dfd-enable-parallax') {
				$class .= ' dfd_stun_header_vertical_parallax';
				$data_atts .= ' data-parallax_sense="150"';
			}
			echo '<div class="dfd-stuning-header-bg-container '.esc_attr($class).'" '.$data_atts.'>';
				$this->build_background_gallery();
				$this->build_background_video();
			echo '</div>';
		}
		
		public function build_background_video() {
			$video_enabled = DfdMetaBoxSettings::get('dfd_stun_video_enable');

			if($video_enabled != 'enable') return false;

			$bg_video = DfdMetaBoxSettings::get('dfd_stun_video_type');
			
			if($bg_video != 'full-screen-video') {
				$loop = $this->video_loop();

				$muted = $this->video_sound();

				$video_style = DfdMetaBoxSettings::get('dfd_stun_video_style');

				$avail_styles = array('self-hosted','youtube','vimeo');

				if($video_style && in_array($video_style, $avail_styles)) {
					switch($video_style) {
						case 'self-hosted':
							$this->self_hosted_video($loop, $muted);
							break;
						case 'youtube':
							$video = $this->youtube_video($loop, $muted);
							echo	'<div class="dfd-video-bg dfd-youtube-bg dfd_vc_hidden-md dfd_vc_hidden-sm dfd_vc_hidden-xs">
										'.$video.'
									</div>';
							break;
						case 'vimeo':
							$video = $this->vimeo_video($loop, $muted);
							echo	'<div class="dfd-video-bg dfd-vimeo-bg dfd_vc_hidden-md dfd_vc_hidden-sm dfd_vc_hidden-xs">
										'.$video.'
									</div>';
							break;
					}
				}
			}
		}
		
		public function self_hosted_video($loop = false, $muted = false) {
			$self_hosted_mp4 = DfdMetaBoxSettings::get('dfd_stun_header_self_hosted_mp4');
			$self_hosted_webm = DfdMetaBoxSettings::get('dfd_stun_header_self_hosted_webm');

			if ($self_hosted_mp4 != '' || $self_hosted_webm != '') {
				$sound_conrtol_class = 'dfd-icon-volume_off';
				wp_enqueue_script('dfd_zencdn_video_js');
				$poster = (isset($custom_head_img) && !empty($custom_head_img)) ? $custom_head_img : '';

				echo '<div class="dfd-video-bg dfd_vc_hidden-md dfd_vc_hidden-sm dfd_vc_hidden-xs">';
					echo '<video id="video-post'. esc_attr(get_the_ID()) .'" class="video-js vjs-default-skin" ';
							if($loop) :
								echo 'loop="true"';
							endif;
							if($muted) :
								$sound_conrtol_class = 'dfd-socicon-unmute';
								echo 'muted="true"';
							endif;
							echo 'autoplay="true"';
							echo 'preload="auto"';
							echo 'width="100%"';
							echo 'height="100%"';
							echo 'poster="'. esc_url($poster) .'"';
							echo 'data-setup="{}">';

						if($self_hosted_mp4):
							echo '<source src="'. esc_url($self_hosted_mp4) .'" type="video/mp4">';
						endif;
						if ($self_hosted_webm):
							echo '<source src="'. esc_url($self_hosted_webm) .'" type="video/webm">';
						endif;
					echo '</video>';
				echo '</div>';

				echo '<a href="#" class="dfd-sound-controller mobile-hide '. esc_attr($sound_conrtol_class) .'"></a>';
			}
		}
		
		public function youtube_video($loop = false, $muted = false, $popup = false) {
			$dfd_youtube_video_id = DfdMetaBoxSettings::get('dfd_stun_bg_youtube_id');
			$video = $extra_url_prop = $data_atts = '';
			if($dfd_youtube_video_id && !empty($dfd_youtube_video_id)) {
				if(substr_count($dfd_youtube_video_id, '?') > 0) {
					$dfd_youtube_video_id = substr($dfd_youtube_video_id,(stripos($dfd_youtube_video_id,'?v=')+3));
				}
				if(substr_count($dfd_youtube_video_id, '&') > 0) {
					$dfd_youtube_video_id = substr($dfd_youtube_video_id, 0, stripos($dfd_youtube_video_id,'&'));
				}
				if($loop) {
					$extra_url_prop .= '&amp;loop=1&playlist='.$dfd_youtube_video_id;
				}
				if($muted) {
					$data_atts .= ' data-muted="1"';
				} else {
					$data_atts .= ' data-muted="0"';
				}
				if($popup) {
					$data_atts .= ' data-video_url="'.esc_url($video_url).'"';
					$video_url = '';
				}
				$video_url = 'https://www.youtube.com/embed/'.esc_attr($dfd_youtube_video_id).'?'.esc_attr($extra_url_prop).'&amp;enablejsapi=1&amp;showinfo=0&amp;controls=0&amp;rel=0';
				$video = '<iframe id="frame-'.esc_attr($this->uniqid).'" class="dfd-bg-frame dfd-vertical-aligned" '.$data_atts.' width="100%" height="100%" src="'.esc_url($video_url).'" frameborder="0" class="dfd-bg-frame" allowfullscreen allow="autoplay; encrypted-media"></iframe>';
			}
			return $video;
		}
		
		public function vimeo_video($loop = false, $muted = false, $popup = false) {
			$dfd_vimeo_video_id = DfdMetaBoxSettings::get('dfd_stun_bg_vimeo_id');
			$video = $extra_url_prop = $data_atts = '';
			if($dfd_vimeo_video_id && !empty($dfd_vimeo_video_id)) {
				if(substr_count($dfd_vimeo_video_id, 'vimeo.com/') > 0) {
					$dfd_vimeo_video_id = substr($dfd_vimeo_video_id,(stripos($dfd_vimeo_video_id, 'vimeo.com/')+10));
				}
				if(substr_count($dfd_vimeo_video_id, '&') > 0) {
					$dfd_vimeo_video_id = substr($dfd_vimeo_video_id, 0, stripos($dfd_vimeo_video_id,'&'));
				}
				if($loop) {
					$extra_url_prop .= '&amp;loop=1';
				}
				if($muted) {
					$data_atts .= ' data-muted="1"';
				} else {
					$data_atts .= ' data-muted="0"';
				}
				if($popup) {
					$data_atts .= ' data-video_url="'.esc_url($video_url).'"';
					$video_url = '';
				}
				$video_url = 'https://player.vimeo.com/video/'.esc_attr($dfd_vimeo_video_id).'?api=1&amp;portrait=0&amp;rel=0&amp;autoplay=1'.esc_attr($extra_url_prop);
				$video = '<iframe id="frame-'.esc_attr($this->uniqid).'" '.$data_atts.' class="dfd-bg-frame dfd-vertical-aligned" src="'.esc_url($video_url).'" width="100%" height="100%" frameborder="0" class="dfd-bg-frame"></iframe>';
			}
			return $video;
		}
		
		public function build_popup_video() {
			$video_enabled = DfdMetaBoxSettings::get('dfd_stun_video_enable');

			if(!$video_enabled) return false;
			
			$video_url = '';

			$bg_video = DfdMetaBoxSettings::get('dfd_stun_video_type');
			
			$video_style = DfdMetaBoxSettings::get('dfd_stun_video_style');

			$avail_styles = array('youtube','vimeo');

			if($video_style && in_array($video_style, $avail_styles) && $bg_video == 'full-screen-video') {
				if($video_style == 'youtube') {
					$video_url = DfdMetaBoxSettings::get('dfd_stun_bg_youtube_id');
				} elseif($video_style == 'vimeo') {
					$video_url = DfdMetaBoxSettings::get('dfd_stun_bg_vimeo_id');
				}
				if($video_url != '') {
					echo '<div id="stun-header-'.esc_attr($this->uniqid).'" class="dfd-header-videoplayer">';
						echo '<div class="dfd-video-button-wrap">';
							echo '<div class="dfd-play-button">';
								echo '<span class="dfd-socicon-icon-play"></span>';
							echo '</div>';
							echo '<a href="'. esc_url($video_url) .'?width=1200&height=675" data-rel="prettyPhoto" class="dfd-video-link dfd-lazy-video-load"></a>';
						echo '</div>';
					echo '</div>';
				}
			}
		}
		
		public function build_background_gallery() {
			$gallery_enabled = DfdMetaBoxSettings::get('stunnig_headers_bg_element');

			if($gallery_enabled && $gallery_enabled == 'gallery') {
				$gallery_images = DfdMetaBoxSettings::get('stunning_header_bg_image_gallery');
				if(!empty($gallery_images) && is_array($gallery_images)) :
					echo '<div id="dfd-stun-header-gallery">';
					foreach($gallery_images as $image) {
						if(isset($image['image']) && !empty($image['image'])) {
							echo '<div class="slide" style="background-image: url('.esc_url($image['image']).');"></div>';
						}
					}
				echo '</div>';
				endif;
			}
		}
		
		public function build_css() {
			global $post, $dfd_native;
			$options = array(
				'stunnig_headers_custom_height' => 300,
				'stun_header_bg_size' => 'cover',
				'stunnig_headers_bg_img_position' => 'top center',
				'stunnig_headers_fixed' => 'initial',
				'stunnig_headers_repeat' => 'no-repeat',
			);

			foreach($options as $k => $v) {
				$options[$k] = $this->get_option($k, $v);
			}

			$css_rules = $custom_head_img = $extra_css = '';
			
			$bg_color_custom = DfdMetaBoxSettings::get('stunnig_headers_bg_color');
			$bg_color = $bg_color_custom;
			if(!$bg_color_custom && isset($dfd_native['stunnig_headers_bg_color'])) {
				$bg_color = $dfd_native['stunnig_headers_bg_color'];
			}
			
			$custom_head_img = DfdMetaBoxSettings::get('stunnig_headers_bg_img');
			if(!$custom_head_img && $bg_color_custom == '' && isset($dfd_native['stunnig_headers_bg_image']['url'])) {
				$custom_head_img = $dfd_native['stunnig_headers_bg_image']['url'];
			}

			if($custom_head_img && $custom_head_img != '') {
				$css_rules .= 'background-image: url(' . esc_url($custom_head_img) . ');';
			}

			if($bg_color && $bg_color != '') {
				$css_rules .= 'background-color: ' . $bg_color . ';';
			}

			if(($options['stun_header_bg_size']) != '') {
				$css_rules .= 'background-size: ' . $options['stun_header_bg_size'] . ';';
			}

			if(($options['stunnig_headers_bg_img_position']) != '') {
				$css_rules .= 'background-position: ' . $options['stunnig_headers_bg_img_position'] . ';';
			}

			if(($options['stunnig_headers_fixed']) != '') {
				$css_rules .= 'background-attachment: ' . $options['stunnig_headers_fixed'] . ';';
				if($options['stunnig_headers_fixed'] == 'fixed') {
					$extra_css .= 'div#stuning-header .dfd-stuning-header-bg-container.dfd_stun_header_vertical_parallax {'
									. '-webkit-transform: -webkit-translate3d(0,0,0) !important;'
									. '-moz-transform: -moz-translate3d(0,0,0) !important;'
									. '-ms-transform: -ms-translate3d(0,0,0) !important;'
									. '-o-transform: -o-translate3d(0,0,0) !important;'
									. 'transform: translate3d(0,0,0) !important;'
								. '}';
				}
			}

			if(($options['stunnig_headers_repeat']) != '') {
				$css_rules .= 'background-repeat: ' . $options['stunnig_headers_repeat'] . ';';
			}

			if($css_rules != '') {
				$css_rules = 'div#stuning-header .dfd-stuning-header-bg-container {'.$css_rules.'}';
			}

			if(($options['stunnig_headers_custom_height']) != '') {
				$css_rules .= '#stuning-header div.page-title-inner {min-height: '.esc_attr(preg_replace("/[^0-9,.-]/","",$options['stunnig_headers_custom_height'])).'px;}';
			}
			
			$css_rules .= $extra_css;

			echo esc_js($css_rules);
		}
		
		public function get_video_style() {
			return DfdMetaBoxSettings::get('dfd_stun_video_type');
		}
		
		public function get_option($option, $default) {
			return DfdMetaBoxSettings::compared($option, $default);
		}
		
		public function video_loop() {
			if(DfdMetaBoxSettings::get('dfd_stun_header_video_loop') == 'on') {
				return true;
			}
			
			return false;
		}
		
		public function video_sound() {
			if(DfdMetaBoxSettings::get('dfd_stun_header_video_mute') == 'on') {
				return true;
			}
			
			return false;
		}
	}
	new Dfd_Stunning_Header();
}