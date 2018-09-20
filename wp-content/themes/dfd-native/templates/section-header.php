<?php if ( ! defined( 'ABSPATH' ) ) { exit; }

if(!class_exists('Dfd_Header_Constructor')) {
	/**
	 * Header constructor
	 *
	 *
	 * @class 		Dfd_Header_Constructor
	 * @version		1.0
	 * @category	Class
	 * @author 		DFD
	 */
	class Dfd_Header_Constructor {
		private $side_area_enabled = '';
		
		private $top_panel_enabled = '';
		
		private $top_panel_page_ID = '';
		
		private $header_style = '';
		
		private $logo_position = '';
		
		function __construct() {
			$this->header_style = $this->get_header_style();
			if(Dfd_Theme_Helpers::isHeaderBuilderPluginActive()){
				if(defined('DFD_EXTENSIONS_PLUGIN_PATH') && DFD_EXTENSIONS_PLUGIN_PATH){
					require_once DFD_EXTENSIONS_PLUGIN_PATH . "redux_extensions/extensions/header_builder/frontend/DfdHeaderBuilderBoot.php";
					$builder = DfdHeaderBuilderBoot::instance();
					$builder->boot();
					$preset_collection = DfdHeaderBuilder_PresetCollection::instance();
					$preset_collection->localizeScripts();
					$exist = $preset_collection->hasId($this->header_style);
					if($exist){
						$preset_collection->setActivepreset($this->header_style);
						$builder->init();
						return false;
					}
				}
			}
			$this->logo_position = $this->get_logo_position();
			
			if((int)$this->header_style < 7) {
				$this->top_panel_enabled = $this->top_panel_enabled();
				$this->top_panel_page_ID = $this->top_panel_page();
				$this->side_area_enabled = $this->side_area_enabled();
			}
			
			if($this->header_style && $this->header_style != '' && $this->header_style != 'none') {
				$this->init();
			}
		}
		
		private function init() {
			if($this->top_panel_enabled && !empty($this->top_panel_page_ID) && (int)$this->header_style < 7) {
				$this->init_top_panel();
			}
			
			if($this->side_area_enabled && (int)$this->header_style < 7) {
				$this->init_side_area();
			}
			
			$this->init_mobile_menu();
			
			$this->header_html();
		}
		
		private function get_header_style() {
			global $dfd_native;

			$headers_avail = array_keys(Dfd_Theme_Helpers::dfd_headers_type());

			$selected_header = DfdMetaBoxSettings::get('dfd_headers_header_style');
			$find_strict = array_search($selected_header, $headers_avail,true);
			$find = array_search($selected_header, $headers_avail);
			if($selected_header && ($find || $find_strict || in_array($selected_header, $headers_avail))) {
				return $selected_header;
			}
			
			$layouts = array('pages', 'archive', 'single', 'search', '404',);

			switch (true) {
				case is_404(): $layout = '404';
					break;
				case is_search(): $layout = 'search';
					break;
				case is_single(): $layout = 'single';
					break;
				case is_archive(): $layout = 'archive';
					break;
				case is_page(): $layout = 'pages';
					break;
				default:
					$layout = 'pages';
			}

			if (!isset($dfd_native["{$layout}_head_type"]) || !$dfd_native["{$layout}_head_type"] || !in_array($dfd_native["{$layout}_head_type"], $headers_avail)) {
				return '1';
			}

			return $dfd_native["{$layout}_head_type"];
		}
		
		private function get_logo_position() {
			$logo_pos_avail = array_keys(Dfd_Theme_Helpers::dfd_logo_position());

			$logo_position = DfdMetaBoxSettings::get('dfd_headers_logo_position');
			
			if($logo_position && in_array($logo_position, $logo_pos_avail)) {
				return $logo_position;
			} else {
				return 'left';
			}
		}
		
		private function get_menu_position() {
			$menu_pos_avail = array_keys(Dfd_Theme_Helpers::dfd_menu_position());
	
			$selected_menu_position = '';

			$menu_position = DfdMetaBoxSettings::get('dfd_headers_menu_position');
			
			if($menu_position && in_array($menu_position, $menu_pos_avail)) {
				$selected_menu_position = $menu_position;
			} else {
				$selected_menu_position = 'top';
			}

			return $selected_menu_position;
		}
		
		private function get_header_layout() {
			global $dfd_native;
			
			if(isset($dfd_native['header_layout']) && !empty($dfd_native['header_layout'])) {
				return $dfd_native['header_layout'];
			} else {
				return 'fullwidth';
			}
		}
		
		private function get_header_animation() {
			global $dfd_native;
			$available = Dfd_Theme_Helpers::dfd_sticky_header_animations();

			$enable_sticky_header = (!isset($dfd_native['enable_sticky_header']) || strcmp($dfd_native['enable_sticky_header'], 'off') !== 0);

			if(!$enable_sticky_header) return 'sticky-header-disabled';

			$sticky_header_classes = 'sticky-header-enabled';

			$sticky_header_animation = isset($dfd_native['sticky_header_animation']) ? $dfd_native['sticky_header_animation'] : 'simple';

			if (empty($sticky_header_animation) || !isset($available[$sticky_header_animation])) {
				$available_keys = array_keys($available);
				$sticky_header_animation = array_shift($available_keys);
			}

			$sticky_header_classes .= ' '.$sticky_header_animation;

			return $sticky_header_classes;
		}
		
		private function show_element($option_name) {
			global $dfd_native;
			
			$show = true;
			
			$header_style = $this->header_style;
			
			if(isset($dfd_native[$option_name.'_'.$header_style]) && $dfd_native[$option_name.'_'.$header_style] == 'off') {
				$show = false;
			}
			
			if(!class_exists('Dfd_Theme_extensions')) {
				$show = false;
			}
			
			return $show;
		}
		
		private function get_value($option_name) {
			global $dfd_native;
			
			$value = '';
			
			$header_style = $this->header_style;
			
			if(isset($dfd_native[$option_name.'_'.$header_style]) && $dfd_native[$option_name.'_'.$header_style] != '') {
				$value = $dfd_native[$option_name.'_'.$header_style];
			}
			
			return $value;
		}
		
		private function build_header_class() {
			global $dfd_native;
			
			$header_style = $this->header_style;
			
			$header_class = '';
			
			$header_class .= 'header-style-'.$header_style;
			
			$header_class .= ' header-layout-'.$this->get_header_layout();
			
			
			if($header_style == '1' || $header_style == '2') {
				$header_class .= ' menu-position-'.$this->get_menu_position();
			}

			$header_class .= ' logo-position-'.$this->logo_position;
			
			if($header_style != '12' && $header_style != '13' && $header_style != '14') {
				$header_class .= ' '.$this->get_header_animation();
				
				if($this->show_element('header_sticky') || !class_exists('Dfd_Theme_extensions')) {
					$header_class .= ' dfd-enable-headroom';
				}
			}
			
			$disable_mega_menu = array('8','9','12','13','14');
			
			if(!in_array($header_style, $disable_mega_menu)) {
				$header_class .= ' dfd-enable-mega-menu';
			}
			
			$avail_styles = array('1','2','3','4','5','6');
			
			if(!empty($header_style) && in_array($header_style, $avail_styles) && $this->show_element('header_top_panel')) {
				$header_class .= ' with-top-panel';
			}
			
			$non_fixed_headers = array('1','3','5', '10');
			
			if(!empty($header_style) && !in_array($header_style, $non_fixed_headers)) {
				$header_class .= ' dfd-header-layout-fixed';
			}
			
			$with_content_alignment = array('8', '9', '12', '13');
			
			if(in_array($header_style, $with_content_alignment)) {
				if(isset($dfd_native['header_content_alignment_'.$header_style]) && !empty($dfd_native['header_content_alignment_'.$header_style])) {
					$header_class .= ' '.$dfd_native['header_content_alignment_'.$header_style];
				} else {
					$header_class .= ' text-left';
				}
			}
			
			$with_alignment = array('12', '13', '14');
			
			if(in_array($header_style, $with_alignment)) {
				$header_class .= ' side-header';
				if(isset($dfd_native['header_alignment_'.$header_style]) && !empty($dfd_native['header_alignment_'.$header_style])) {
					$header_class .= ' '.$dfd_native['header_alignment_'.$header_style];
				} else {
					$header_class .= ' left';
				}
			}
			
			if((int)$header_style > 6 && (int)$header_style < 12) {
				$header_class .= ' click-animated';
				if($header_style == '8' || $header_style == '9') {
					$header_class .= ' with-preloader';
				}
			}
			
			if((int)$header_style < 7 && $this->side_area_enabled) {
				$header_class .= ' side-area-enabled';
			}
			
			if(isset($dfd_native['show_menu_icons_header_'.$header_style]) && $dfd_native['show_menu_icons_header_'.$header_style] == 'off') {
				$header_class .= ' dfd-hide-menu-icons';
			}
			
			return $header_class;
		}
		
		private function is_simple($style) {
			$variant = 'simple';
			if((int)$style > 6) {
				$variant = 'advanced';
				if($style == '10' || $style == '11') {
					$variant = 'slide';
				}
			}
			
			return $variant;
		}
		
		private function header_html() {
			$class = $this->build_header_class();
			
			$this->search_form_html();
			
			echo '<div id="header-container" class="'.esc_attr($class).'">';
				echo '<div id="header">';
					$this->init_banner();
					$this->top_panel_html();
					$this->main_panel_html();
				echo '</div>';
			echo '</div>';
		}
		
		private function top_panel_html() {
			$style = $this->header_style;
			
			$avail_styles = array('1','2','3','4','5','6');
			
			if(!empty($style) && in_array($style, $avail_styles) && $this->show_element('header_top_panel')) {
				echo '<div class="header-top-panel">';
					echo '<div class="row">';
						echo '<div class="twelve columns header-info-panel">';
							
							get_template_part('templates/header/block', 'topinfo');
							
							if($this->show_element('header_login')) {
								get_template_part('templates/header/block', 'login');
							}
							
							if($this->show_element('head_show_header_soc_icons')) {
								echo '<div class="widget soc-icons">';
									echo Dfd_Theme_Helpers::dfd_social_networks(true);
								echo '</div>';
							}
							
							if((int)$style < 5) {
								get_template_part('templates/header/block', 'additional_header_menu');
							}
							
						echo '</div>';
					echo '</div>';
				echo '</div>';
			}
		}
		
		private function main_panel_html() {
			$top_logos = array('top-left','top-center','top-right');
			
			$bottom_logos = array('bottom-left','bottom-center','bottom-right','middle');
			
			$style = $this->header_style;
			
			$logo_position = $this->logo_position;
			
			if($style == '5' || $style == '6' || (($style == '1' || $style == '2') && in_array($logo_position, $top_logos))) {
				$this->mid_panel_html();
			}
			
			$this->main_panel_content();
			
			if(($style == '1' || $style == '2') && in_array($logo_position, $bottom_logos)) {
				$this->mid_panel_html();
			}
		}
		
		private function mid_panel_html() {
			$style = $this->header_style;
			
			echo '<div class="logo-wrap header-top-logo-panel">';
				echo '<div class="row">';
					echo '<div class="columns twelve">';
						$this->logo_html();
						if($style == '5' || $style == '6') {
							//echo '<div class="dfd-header-middle-content">';
								get_template_part('templates/header/block', 'additional_header_menu');
							//echo '</div>';
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}
		
		private function main_panel_content() {
			$style = $this->header_style;
			
			$template = $this->is_simple($style).'_headers_html';
			
			$this->$template();
		}
		
		private function simple_headers_html() {
			$style = $this->header_style;
			
			$logo_position = $this->logo_position;
			
			$exclude_list = array('top-left','top-center','top-right', 'bottom-left','bottom-center','bottom-right','middle');
			
			echo '<div class="header-wrap">';
				echo '<div class="row">';
					echo '<div class="twelve columns">';
						if(!in_array($logo_position, $exclude_list) && $style != '3' && $style != '4' && $style != '5' && $style != '6') {
							echo '<div class="dfd-header-logos">';
								$this->logo_html();
								$this->sticky_logo_html();
								$this->mobile_logo_html();
							echo '</div>';
						}
						if((in_array($logo_position, $exclude_list) && $style != '3' && $style != '4') || $style == '5' || $style == '6') {
							$this->sticky_logo_html();
							$this->mobile_logo_html();
						}
						$this->simple_buttons_wrap();
						$this->menu_html();
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}
		
		private function advanced_headers_html() {
			global $dfd_native;
			$style = $this->header_style;
			
			if($style == '8' || $style == '9') {
				$this->advanced_headers_front_html();
			}
			
			if($style == '13') {
				echo '<div class="dfd-side-slide-header-button-wrap dfd-mobile-header-hide">';
					$this->small_logo_html();
					echo  '<a href="#" title="'.esc_attr__('Side slide header button','dfd-native').'" class="dfd-menu-button dfd-side-slide-header-button">'
							. '<span class="icon-wrap dfd-top-line"></span>'
							. '<span class="icon-wrap dfd-middle-line"></span>'
							. '<span class="icon-wrap dfd-bottom-line"></span>'
						. '</a>'
					. '</div>';
			}
			
			echo '<div class="header-wrap">';
				if($style == '8' || $style == '9') {
					if (isset($dfd_native['header_appear_effect_8']) && !empty($dfd_native['header_appear_effect_8']) && isset($dfd_native['header_appear_effect_9']) && !empty($dfd_native['header_appear_effect_9'])) {
						if ($style =='8' && isset($dfd_native['header_appear_effect_8']) && !empty($dfd_native['header_appear_effect_8'])) {
							echo '<div id="header-anim-wrap" class="'.$dfd_native['header_appear_effect_8'].'">';
						} elseif ($style =='9' && isset($dfd_native['header_appear_effect_9']) && !empty($dfd_native['header_appear_effect_9'])) {
							echo '<div id="header-anim-wrap" class="'.$dfd_native['header_appear_effect_9'].'">';
						}
						if ($style =='8' && $dfd_native['header_appear_effect_8'] == 'stretch' || $style =='9' && $dfd_native['header_appear_effect_9'] == 'stretch') {
							echo   '<div id="dfd-header-loader" class="pageload-overlay dfd-mobile-header-hide" data-opening="M20,15 50,30 50,30 30,30 Z;M0,0 80,0 50,30 20,45 Z;M0,0 80,0 60,45 0,60 Z;M0,0 80,0 80,60 0,60 Z" data-closing="M0,0 80,0 60,45 0,60 Z;M0,0 80,0 50,30 20,45 Z;M20,15 50,30 50,30 30,30 Z;M30,30 50,30 50,30 30,30 Z">
										<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 80 60" preserveAspectRatio="none">
											<path d="M30,30 50,30 50,30 30,30 Z"/>
										</svg>
									</div>';
						} else if ($style =='8' && $dfd_native['header_appear_effect_8'] == 'spill' || $style =='9' && $dfd_native['header_appear_effect_9'] == 'spill') {
							echo   '<div id="dfd-header-loader" class="pageload-overlay dfd-mobile-header-hide" data-speed="400" data-reverse="820" data-opening="M 0,0 c 0,0 63.5,-16.5 80,0 16.5,16.5 0,60 0,60 L 0,60 Z">
										<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 80 60" preserveAspectRatio="none">
											<path d="M 0,0 c 0,0 -16.5,43.5 0,60 16.5,16.5 80,0 80,0 L 0,60 Z"/>
										</svg>
									</div>';
						} else if ($style =='8' && $dfd_native['header_appear_effect_8'] == 'windscreen' || $style =='9' && $dfd_native['header_appear_effect_9'] == 'windscreen') {
							echo   '<div id="dfd-header-loader" class="pageload-overlay dfd-mobile-header-hide" data-speed="400" data-reverse="700" data-opening="M 40,100 150,0 -65,0 z">
										<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 80 60" preserveAspectRatio="none">
											<path d="M 40,100 150,0 l 0,0 z"/>
										</svg>
									</div>';
						} else if ($style =='8' && $dfd_native['header_appear_effect_8'] == 'lateral_swipe' || $style =='9' && $dfd_native['header_appear_effect_9'] == 'lateral_swipe') {
							echo   '<div id="dfd-header-loader" class="pageload-overlay dfd-mobile-header-hide" data-speed="500" data-reverse="680" data-opening="M 40,-65 145,80 -65,80 40,-65" data-closing="m 40,-65 0,0 L -65,80 40,-65"">
										<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 80 60" preserveAspectRatio="none">
											<path d="M 40,-65 145,80 40,-65"/>
										</svg>
									</div>';
						} 
						echo '</div>';
					} else {
						if ($style =='8' && isset($dfd_native['header_appear_effect_8']) && !empty($dfd_native['header_appear_effect_8'])) {
							echo	'<div id="header-anim-wrap" class="'.$dfd_native['header_appear_effect_8'].'"></div>';
						} elseif ($style =='9' && isset($dfd_native['header_appear_effect_9']) && !empty($dfd_native['header_appear_effect_9'])) {
							echo	'<div id="header-anim-wrap" class="'.$dfd_native['header_appear_effect_9'].'"></div>';
						}
					}
				}
				echo '<div class="row">';
					echo '<div class="twelve columns">';
						if($style == '8' || $style == '9') {
							$this->nav_button();
						}
						echo '<div class="dfd-header-logos">';
							if($style == '8' || $style == '9') {
								$this->small_logo_html();
							}else {
								$this->logo_html();
							}
							$this->sticky_logo_html();
							$this->mobile_logo_html();
						echo '</div>';
						
						if($style != '7' && $style != '14') {
							echo '<div class="header-top-panel dfd-mobile-header-hide">';
								get_template_part('templates/header/block', 'topinfo');
							echo '</div>';
						}
						
						$this->menu_html();
						
						if($style != '7') {
							if($style != '14' && $this->show_element('header_login')) {
								echo '<div class="login-wrap dfd-mobile-header-hide">';
									get_template_part('templates/header/block', 'login-simple');
								echo '</div>';
							}

							if($style != '14' && $this->show_element('head_show_header_soc_icons')) {
								echo '<div class="soc-icons-wrap dfd-mobile-header-hide">';
									echo '<div class="widget soc-icons">';
										echo Dfd_Theme_Helpers::dfd_social_networks(true);
									echo '</div>';
								echo '</div>';
							}

							echo '<div class="dfd-header-buttons-cover">';
								echo '<div class="dfd-header-buttons-wrap">';
									if($style == '14' && $this->show_element('head_show_header_soc_icons')) {
										echo '<div class="soc-icons-wrap dfd-mobile-header-hide">';
											echo '<div class="widget soc-icons">';
												echo Dfd_Theme_Helpers::dfd_social_networks(true);
											echo '</div>';
										echo '</div>';
									}
									$this->lang_sel_html();
									$this->cart_html(true);
									$this->search_html();
									$this->mobile_menu_button();
								echo '</div>';
							echo '</div>';

							$this->copyright_text();
						}
						
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}
		
		private function slide_headers_html() {
			echo '<div class="header-wrap">';
				echo '<div class="row">';
					echo '<div class="twelve columns">';
						echo '<div class="dfd-header-logos">';
							$this->logo_html();
							$this->sticky_logo_html();
							$this->mobile_logo_html();
						echo '</div>';
						$this->nav_button();
						$this->menu_html();
						$this->mobile_menu_button();
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}
		
		private function advanced_headers_front_html() {
			echo '<div class="dfd-top-row dfd-header-responsive-hide">';
				echo '<div class="row">';
					echo '<div class="twelve columns">';
						echo '<div class="dfd-header-logos">';
							$this->logo_html();
							$this->sticky_logo_html();
						echo '</div>';
						$this->nav_button();
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}
		
		private function simple_buttons_wrap() {
			echo '<div class="dfd-header-buttons-wrap">';
				$this->cart_html();
				$this->wishlist_html();
				$this->search_html();
				$this->lang_sel_html();
				$this->top_panel_button_html();
				$this->side_area_button_html();
				$this->mobile_menu_button();
			echo '</div>';
		}
		
		private function main_logo_img($class = 'main-logo') {
			global $dfd_native;
			
			$logos_data_atts = '';
			
			$header_logo = $this->get_value('logo_header');
			
			$header_logo_retina = $this->get_value('retina_logo_header');
			
			if(!class_exists('Dfd_Theme_extensions')) {
				$header_logo['url'] = get_template_directory_uri().'/assets/img/logo.png';
			}
			
			if(empty($header_logo['url']) && isset($dfd_native['custom_logo_image']['url']) && !empty($dfd_native['custom_logo_image']['url'])) {
				$header_logo = $dfd_native['custom_logo_image'];
			}
			
			if(empty($header_logo_retina) && isset($dfd_native['custom_retina_logo_image']['url']) && !empty($dfd_native['custom_retina_logo_image']['url'])) {
				$header_logo_retina = $dfd_native['custom_retina_logo_image'];
			}
			
			if(isset($header_logo['url']) && !empty($header_logo['url'])) {
				$width = $height = '';
				
				if(isset($header_logo_retina['url']) && !empty($header_logo_retina['url'])) {
					$logos_data_atts .= ' data-retina="'. esc_url($header_logo_retina['url']) .'"';
				}
				
				if(isset($header_logo['width']) && !empty($header_logo['width'])) {
					$width = 'width="'.esc_attr($header_logo['width']).'"';
				}
				
				if(isset($header_logo['height']) && !empty($header_logo['height'])) {
					$height = 'height="'.esc_attr($header_logo['height']).'"';
				}

				echo '<img src="'.esc_url($header_logo['url']).'" class="'.esc_attr($class).'" '.$width.' '.$height.' alt="'.esc_attr__('Site logo','dfd-native').'" '.$logos_data_atts.' />';
			}
		}
		
		private function small_logo_img($class = 'main-logo') {
			global $dfd_native;
			
			$logos_data_atts = '';
			
			$header_logo = $this->get_value('small_logo_header');
			
			$header_logo_retina = $this->get_value('small_retina_logo_header');
			
			if(empty($header_logo['url']) && isset($dfd_native['custom_logo_image']['url']) && !empty($dfd_native['custom_logo_image']['url'])) {
				$header_logo = $dfd_native['custom_logo_image'];
			}
			
			if(empty($header_logo_retina) && isset($dfd_native['custom_retina_logo_image']['url']) && !empty($dfd_native['custom_retina_logo_image']['url'])) {
				$header_logo_retina = $dfd_native['custom_retina_logo_image'];
			}
			
			if(isset($header_logo['url']) && !empty($header_logo['url'])) {
				if(isset($header_logo_retina['url']) && !empty($header_logo_retina['url'])) {
					$logos_data_atts .= ' data-retina="'. esc_url($header_logo_retina['url']) .'"';
				}
				
				echo '<img src="'.esc_url($header_logo['url']).'" class="'.esc_attr($class).'" alt="'.esc_attr__('Site logo','dfd-native').'" '.$logos_data_atts.' />';
			}
		}
		
		private function logo_html() {
			echo '<div class="dfd-logo-wrap">'
					. '<a href="'.esc_url(home_url('/')).'" title="'.esc_attr__('Site logo','dfd-native').'">';
						$this->main_logo_img();
			echo	  '</a>'
				. '</div>';
		}
		
		private function small_logo_html() {
			echo '<div class="dfd-logo-wrap">'
					. '<a href="'.esc_url(home_url('/')).'" title="'.esc_attr__('Site logo','dfd-native').'">';
						$this->small_logo_img();
			echo	  '</a>'
				. '</div>';
		}
		
		private function sticky_logo_html() {
			global $dfd_native;
			
			$sticky_header_logo = $mobile_header_logo = '';
			
			if(!class_exists('Dfd_Theme_extensions')) {
				$dfd_native['custom_logo_fixed_header']['url'] = get_template_directory_uri().'/assets/img/logo_white.png';
			}
			
			if(isset($dfd_native['custom_logo_fixed_header']['url']) && !empty($dfd_native['custom_logo_fixed_header']['url'])) {
				$retina_logo_data = $width = $height = '';
				
				if(isset($dfd_native['custom_logo_fixed_header']['width']) && !empty($dfd_native['custom_logo_fixed_header']['width'])) {
					$width = 'width="'.esc_attr($dfd_native['custom_logo_fixed_header']['width']).'"';
				}
				
				if(isset($dfd_native['custom_logo_fixed_header']['height']) && !empty($dfd_native['custom_logo_fixed_header']['height'])) {
					$height = 'height="'.esc_attr($dfd_native['custom_logo_fixed_header']['height']).'"';
				}
				
				if(isset($dfd_native['custom_retina_logo_fixed_header']['url']) && !empty($dfd_native['custom_retina_logo_fixed_header']['url'])) {
					$retina_logo_data = 'data-retina="'.esc_url($dfd_native['custom_retina_logo_fixed_header']['url']).'"';
				}
				$sticky_header_logo .= '<img src="'. esc_url($dfd_native['custom_logo_fixed_header']['url']) .'" '.$width.' '.$height.' class="sticky-logo" '. $retina_logo_data .' alt="'.esc_attr__('Sticky header logo','dfd-native').'" />';
			}

			echo '<div class="dfd-logo-wrap mobile-sticky-logos sticky-logo-wrap">'
					. '<a href="'.esc_url(home_url('/')).'" title="'.esc_attr__('Site logo','dfd-native').'">';
				if($sticky_header_logo != '') {
					echo	$sticky_header_logo;
				} else {
					$this->main_logo_img('sticky-logo');
				}
			echo	  '</a>'
				. '</div>';
		}
		
		private function mobile_logo_html($simple = false) {
			global $dfd_native;
			
			$mobile_header_logo = '';
			
			if(isset($dfd_native['mobile_logo_image']['url']) && !empty($dfd_native['mobile_logo_image']['url'])) {
				$retina_logo_data = '';
				if(isset($dfd_native['mobile_retina_logo_image']['url']) && !empty($dfd_native['mobile_retina_logo_image']['url'])) {
					$retina_logo_data = 'data-retina="'.esc_url($dfd_native['mobile_retina_logo_image']['url']).'"';
				}
				$mobile_header_logo .= '<img src="'. esc_url($dfd_native['mobile_logo_image']['url']) .'" class="mobile-logo" '.$retina_logo_data.' alt="'.esc_attr__('Mobile logo','dfd-native').'" />';
			}

			echo '<div class="dfd-logo-wrap mobile-sticky-logos">'
					. '<a href="'.esc_url(home_url('/')).'" title="'.esc_attr__('Site logo','dfd-native').'">';
				if($mobile_header_logo != '') {
					echo	$mobile_header_logo;
				} else {
					$this->main_logo_img('mobile-logo');
				}
			echo	  '</a>'
				. '</div>';
		}
		
		private function cart_html($simple = false) {
			$cart_enabled = $this->show_element('show_cart_header');
			
			if ($cart_enabled && class_exists('WooCommerce') && function_exists('dfd_woocommerce_total_cart')) {
				echo dfd_woocommerce_total_cart($simple);
			}
		}
		
		private function wishlist_html() {
			$wishlist_enabled = $this->show_element('show_wishlist_header');
			
			if ($wishlist_enabled && class_exists('WooCommerce') && function_exists('dfd_wishlist_button')) {
				echo dfd_wishlist_button();
			}
		}
		
		private function search_form_html() {
			$search_enabled = $this->show_element('show_search_form_header');
			
			if($search_enabled) {
				get_template_part('templates/header/block', 'search');
			}
		}
		
		
		private function search_html() {
			$search_enabled = $this->show_element('show_search_form_header');
			
			if($search_enabled) {
				echo '<div class="form-search-wrap">';
					echo '<a href="#" class="header-search-switcher dfd-socicon-Search"></a>';
				echo '</div>';
			}
		}
		
		private function lang_sel_html() {
			$lang_sel_enabled = $this->show_element('show_lang_sel_header');
			
			if($lang_sel_enabled) {
				get_template_part('templates/header/block', 'lang_sel');
			}
		}
		
		private function nav_button() {
			echo '<div class="dfd-click-menu-button-wrap dfd-mobile-header-hide">';
				echo '<div class="dfd-click-menu-activation-button">';
					echo '<a href="#" title="menu" class="dfd-menu-button">';
						echo '<span class="icon-wrap dfd-top-line"></span>';
						echo '<span class="icon-wrap dfd-middle-line"></span>';
						echo '<span class="icon-wrap dfd-bottom-line"></span>';
					echo '</a>';
				echo '</div>';
			echo '</div>';
		}
		
		private function mobile_menu_button() {
			echo '<div class="dl-menuwrapper">';
				echo '<a href="#sidr" class="dl-trigger icon-mobile-menu" id="mobile-menu">';
					echo '<span class="icon-wrap dfd-middle-line"></span>';
					echo '<span class="icon-wrap dfd-top-line"></span>';
					echo '<span class="icon-wrap dfd-bottom-line"></span>';
				echo '</a>';
			echo '</div>';
		}
		
		private function copyright_text() {
			$copyright = $this->get_value('header_copyright');
			
			if(!empty($copyright)) {
				echo '<div class="dfd-copyright dfd-mobile-header-hide">';
					echo '<div>'.$copyright.'</div>';
				echo '</div>';
			}
		}
		
		private function menu_html() {
			if($this->header_style == '3' || $this->header_style == '4') {
				echo '<div class="menu-wrap">';
					get_template_part('templates/header/block', 'left_top_menu');
					echo '<div class="dfd-header-logos">';
						$this->logo_html();
						$this->sticky_logo_html();
						$this->mobile_logo_html();
					echo '</div>';
					get_template_part('templates/header/block', 'right_top_menu');
				echo '</div>';
			} elseif($this->header_style == '8' || $this->header_style == '9') {
				get_template_part('templates/header/block', 'main_simple');
			} elseif($this->header_style == '7') {
				get_template_part('templates/header/block', 'small_menu');
				echo '<div class="dfd-header-buttons-wrap">';
					$this->mobile_menu_button();
				echo '</div>';
			} else {
				get_template_part('templates/header/block', 'main_menu');
			}
		}
		
		private function top_panel_enabled() {
			$top_panel_enabled = DfdMetaBoxSettings::get('dfd_headers_show_top_inner_page');
			
			if($top_panel_enabled == 'on') {
				return true;
			}
			
			return false;
		}
		
		private function top_panel_page() {
			global $dfd_native;
			
			$top_inner_page_id = '';
			
			if (isset($dfd_native['top_panel_inner_page_select'])) {
				$top_inner_page_id = intval($dfd_native['top_panel_inner_page_select']);
			}
			
			return $top_inner_page_id;
		}
		
		private function init_top_panel() {
			global $dfd_native;
			
			$top_inner_page_id = $this->top_panel_page_ID;
			
			$page_data = get_page($top_inner_page_id);
	
			if (!empty($page_data) && isset($page_data->post_status) && strcmp($page_data->post_status,'publish')===0) {

				$wp_the_query = new WP_Query(array(
					'page_id' => $top_inner_page_id,
				));

				if ($wp_the_query->have_posts()) {
					$wp_the_query->the_post();
					
					get_template_part('templates/header/block', 'toppanel-animation');
					 	
					wp_reset_postdata();
				}
			}
		}
		
		private function top_panel_button_html() {
			if($this->top_panel_enabled && !empty($this->top_panel_page_ID)) {
				echo '<a class="top-inner-page dfd-mobile-header-hide" href="#">'
						. '<span>'
							. '<span></span>'
							. '<span></span>'
							. '<span></span>'
						. '</span>'
					. '</a>';
			}
		}
		
		private function side_area_enabled() {
			global $dfd_native;
			
			$enable_sidearea = false;
			
			if(!isset($dfd_native['side_area_enable']) || $dfd_native['side_area_enable'] != 'off') {
				$sidearea = DfdMetaBoxSettings::get('dfd_headers_show_side_area');

				if($sidearea == 'on') {
					$enable_sidearea = true;
				}
			}
			
			return $enable_sidearea;
		}
		
		private function side_area_button_html() {
			if($this->side_area_enabled && !empty($this->side_area_enabled)) {
				$this->nav_button();
			}
		}
		
		private function init_side_area() {
			if($this->side_area_enabled && !empty($this->side_area_enabled)) {
				get_template_part('templates/side-area');
			}
		}
		
		private function init_banner() {
			if($this->show_element('show_banner_header')) {
				global $dfd_native;
				$class = '';
				$avail_styles = array('1','2','3','4','5','6','7','10','11');
				$banner_image_url = $this->get_value('banner_image_url');
				$banner_url = $this->get_value('banner_url');
				if(in_array($this->header_style, $avail_styles) && isset($banner_image_url['url']) && !empty($banner_image_url['url']) && !empty($banner_url)) {
					$class .= $this->get_value('header_content_alignment');
					echo '<div class="dfd-header-banner-wrap dfd-mobile-header-hide">';
						echo '<a href="'.esc_url($banner_url).'" title="'.esc_attr__('Banner','dfd-native').'"><img src="'.esc_url($banner_image_url['url']).'" alt="'.esc_attr__('Banner','dfd-native').'" class="'.esc_attr($class).'" /></a>';
					echo '</div>';
				}
			}
		}
		
		private function init_mobile_menu() {
			global $dfd_native;
			$data = $css = '';
			
			if(isset($dfd_native['mobile_menu_position']) && $dfd_native['mobile_menu_position'] == 'right') {
				$data = 'right';
				$css = 'right: -260px;';
			} else {
				$data = 'left';
				$css = 'left: -260px;';
			}
			
			echo '<div id="sidr" style="'.esc_attr($css).'" data-sidr-side="'.esc_attr($data).'">';
				echo '<div class="sidr-inner"><a href="#sidr-close" class="dl-trigger dfd-sidr-close dfd-socicon-cross-24"></a></div>';
				echo '<div class="sidr-widgets">';
					if(isset($dfd_native['soc_icons_mobile_header']) && $dfd_native['soc_icons_mobile_header'] == 'on') {
						echo '<div class="widget soc-icons" style="display: none;">';
							echo Dfd_Theme_Helpers::dfd_social_networks(true);
						echo '</div>';
					}
					if(
						isset($dfd_native['lang_sel_mobile_header']) && $dfd_native['lang_sel_mobile_header'] == 'on'
						|| isset($dfd_native['cart_button_mobile_header']) && $dfd_native['cart_button_mobile_header'] == 'on'
						|| isset($dfd_native['serach_button_mobile_header']) && $dfd_native['serach_button_mobile_header'] == 'on'
					) {
						echo '<div class="sidr-buttons-container" style="display: none;">';
							if(isset($dfd_native['lang_sel_mobile_header']) && $dfd_native['lang_sel_mobile_header'] == 'on') {
								$this->lang_sel_html();
							}
							if(isset($dfd_native['cart_button_mobile_header']) && $dfd_native['cart_button_mobile_header'] == 'on' && class_exists('WooCommerce') && function_exists('dfd_woocommerce_total_cart')) {
								echo dfd_woocommerce_total_cart(true);
							}
							if(isset($dfd_native['serach_button_mobile_header']) && $dfd_native['serach_button_mobile_header'] == 'on') {
								echo '<div class="form-search-wrap">';
									echo '<a href="#" class="header-search-switcher dfd-socicon-Search"></a>';
								echo '</div>';
							}
						echo '</div>';
					}
				echo '</div>';
			echo '</div>';
			echo '<a href="#sidr-close" class="dl-trigger dfd-sidr-close"></a>';
		}
	}
	new Dfd_Header_Constructor();
}