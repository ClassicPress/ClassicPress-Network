<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

if(!class_exists('Dfd_Site_Preloader')) {
	class Dfd_Site_Preloader {
		private $options;
		
		function __construct() {
			$this->get_global_var();
			$this->dfd_site_preloader_html();
		}
		
		private function get_global_var() {
			global $dfd_native;
			return $this->options = $dfd_native;
		}
		
		function dfd_preloader_css_animation () {
			$animation_css = $animation_color_value = '';
			$preloader_page_style = DfdMetaBoxSettings::get('preloader_style');
			$page_preloader_animation = DfdMetaBoxSettings::get('preloader_animation_style');
			$page_preloader_animation_color = DfdMetaBoxSettings::get('preloader_animation_color');
			if($preloader_page_style && $page_preloader_animation) {
				$animation_style = 'dfd-preloader-style-'.$page_preloader_animation;
			} elseif(isset($this->options['css_animation_style']) && !empty($this->options['css_animation_style'])) {
				$page_preloader_animation = $this->options['css_animation_style'];
				$animation_style = 'dfd-preloader-style-'.$this->options['css_animation_style'];
			} else {
				$this->options['css_animation_style'] = '1';
				$animation_style = 'dfd-preloader-style-1';
			}
			if($preloader_page_style && $page_preloader_animation_color && $page_preloader_animation_color != '#') {
				$animation_color_value = $page_preloader_animation_color;
			} elseif(isset($this->options['preoader_animation_color']) && !empty($this->options['preoader_animation_color'])) {
				$animation_color_value = $this->options['preoader_animation_color'];
			}

			if($page_preloader_animation) {
				if($page_preloader_animation == '1') {
					echo	'<div id="dfd-preloader-animation" class="'.esc_attr($animation_style).'">
								<div class="container">
								   <div class="inner">
										<div class="outer first">
											<div class="dash"></div>
										</div>
										<div class="outer last">
											<div class="dash"></div>
										</div>
									</div>
								</div>
							</div>';
				} else {
					echo '<div id="dfd-preloader-animation" class="'.esc_attr($animation_style).'">';
						echo '<span class="item-one"></span>'
							. '<span class="item-two"></span>'
							. '<span class="item-three"></span>'
							. '<span class="item-four"></span>'
							. '<span class="item-five"></span>'
							. '<span class="item-six"></span>'
						. '</div>';
				}
			}
			
			if(!empty($animation_color_value)) {
				$animation_css .=  '#qLoverlay #qLbar_wrap #dfd-preloader-animation.dfd-preloader-style-1 .inner,'
									.'#qLoverlay #qLbar_wrap #dfd-preloader-animation.dfd-preloader-style-5 span {border-color: '.esc_attr($animation_color_value).'}'
									.'#qLoverlay #qLbar_wrap #dfd-preloader-animation.dfd-preloader-style-1 .outer .dash:before,'
									.'#qLoverlay #qLbar_wrap #dfd-preloader-animation.dfd-preloader-style-2 span,'
									.'#qLoverlay #qLbar_wrap #dfd-preloader-animation.dfd-preloader-style-3 span,'
									.'#qLoverlay #qLbar_wrap #dfd-preloader-animation.dfd-preloader-style-4 span.item-one,'
									.'#qLoverlay #qLbar_wrap #dfd-preloader-animation.dfd-preloader-style-6 span {background: '.esc_attr($animation_color_value).';}';
				
				echo '<script>'
						. '(function($) {'
							. '$("head").append("<style>'.esc_js($animation_css).'</style>")'
						. '})(jQuery)'
					. '</script>';
			}
		}
		function dfd_preloader_image () {
			$preloader_page_style = DfdMetaBoxSettings::get('preloader_style');
			$page_preloader_logo = DfdMetaBoxSettings::get('preloader_img');
			if($preloader_page_style && $page_preloader_logo) {
				$logo = $page_preloader_logo;
			} elseif (isset($this->options['preloader_image']['url']) && $this->options['preloader_image']['url']) {
				$logo = $this->options['preloader_image']['url'];
			} else {
				$logo = get_template_directory_uri().'/assets/img/logo.png';
			}
			echo '<div class="qLbar-img"><img src="'.esc_url($logo).'" alt="'.esc_attr__('Preloader logo', 'dfd-native').'" /></div>';
		}
		function dfd_preloader_progress_bar () {
			$bar_css = 'width: 0%;';
			$preloader_bar_position = '';
			$preloader_page_style = DfdMetaBoxSettings::get('preloader_style');
			$page_bar_bg = DfdMetaBoxSettings::get('preloader_bar_bg');
			$page_bar_height = DfdMetaBoxSettings::get('preloader_bar_height');
			$page_bar_position = DfdMetaBoxSettings::get('preloader_bar_position');

			if($page_bar_bg && $page_bar_bg != '#' && $preloader_page_style) {
				$bar_css .= 'background: '.esc_attr($page_bar_bg).';';
			} elseif(isset($this->options['preloader_bar_bg']) && !empty($this->options['preloader_bar_bg'])) {
				$bar_css .= 'background: '.esc_attr($this->options['preloader_bar_bg']).';';
			}
			if($page_bar_height && $preloader_page_style) {
				$bar_css .= 'height: '.esc_attr($page_bar_height).'px;';
			} elseif(isset($this->options['preloader_bar_height']) && !empty($this->options['preloader_bar_height'])) {
				$bar_css .= 'height: '.esc_attr($this->options['preloader_bar_height']).'px;';
			}
			if($page_bar_position && $preloader_page_style) {
				$preloader_bar_position .= $page_bar_position;
			} elseif(isset($this->options['preloader_bar_position']) && !empty($this->options['preloader_bar_position'])) {
				$preloader_bar_position .= $this->options['preloader_bar_position'];
			} else {
				$preloader_bar_position .= 'middle';
			}
			echo '<div id="qLbar" class="dfd-preloader-bar-'.esc_attr($preloader_bar_position).'" style="'.$bar_css.'"></div>';
		}
		function dfd_get_preloader_style() {
			$preloader_style = '';
			$preloader_page_style = DfdMetaBoxSettings::get('preloader_style');
			if($preloader_page_style) {
				$preloader_style = 'dfd_preloader_'.esc_attr($preloader_page_style);
			} elseif(isset($this->options['preloader_style']) && $this->options['preloader_style']) {
				$preloader_style = 'dfd_preloader_'.$this->options['preloader_style'];
			}
			return $preloader_style;
		}
		function dfd_get_preloader_percentage() {
			$preloader_class = '';
			$preloader_page_style = DfdMetaBoxSettings::get('preloader_style');
			$preloader_page_percentage = DfdMetaBoxSettings::get('preloader_enable_counter');
			if($preloader_page_style && $preloader_page_percentage) {
				$preloader_class = ($preloader_page_percentage == 'on') ? ' dfd-percentage-enabled' : '';
			} elseif(isset($this->options['preloader_percentage']) && $this->options['preloader_percentage']) {
				$preloader_class = ' dfd-percentage-enabled';
			}
			return $preloader_class;
		}
		function dfd_get_preloader_bg() {
			$preloader_css = '';
			$preloader_page_style = DfdMetaBoxSettings::get('preloader_style');
			$bg_image = DfdMetaBoxSettings::get('preloader_bg_img');
			$bg_position = DfdMetaBoxSettings::get('preloader_bg_img_position');
			$bg_color = DfdMetaBoxSettings::get('preloader_bg_color');
			$bg_size = DfdMetaBoxSettings::get('preloader_bg_size');
			$bg_repeat = DfdMetaBoxSettings::get('preloader_bg_repeat');
			$bg_attachment = DfdMetaBoxSettings::get('preloader_bg_attachment');
			if($bg_color && $bg_color != '#' && $preloader_page_style) {
				$preloader_css .= 'background-color: '.esc_attr($bg_color).';';
			} elseif(isset($this->options['preloader_background']['background-color']) && !empty($this->options['preloader_background']['background-color'])) {
				$preloader_css .= 'background-color: '.esc_attr($this->options['preloader_background']['background-color']).';';
			}
			if($bg_repeat && $preloader_page_style) {
				$preloader_css .= 'background-repeat: '.esc_attr($bg_repeat).';';
			} elseif(isset($this->options['preloader_background']['background-repeat']) && !empty($this->options['preloader_background']['background-repeat'])) {
				$preloader_css .= 'background-repeat: '.esc_attr($this->options['preloader_background']['background-repeat']).';';
			}
			if($bg_size && $preloader_page_style) {
				$preloader_css .= 'background-size: '.esc_attr($bg_size).';';
			} elseif(isset($this->options['preloader_background']['background-size']) && !empty($this->options['preloader_background']['background-size'])) {
				$preloader_css .= 'background-size: '.esc_attr($this->options['preloader_background']['background-size']).';';
			}
			if($bg_attachment && $preloader_page_style) {
				$preloader_css .= 'background-attachment: '.esc_attr($bg_attachment).';';
			} elseif(isset($this->options['preloader_background']['background-attachment']) && !empty($this->options['preloader_background']['background-attachment'])) {
				$preloader_css .= 'background-attachment: '.esc_attr($this->options['preloader_background']['background-attachment']).';';
			}
			if($bg_position && $preloader_page_style) {
				$preloader_css .= 'background-position: '.esc_attr($bg_position).';';
			} elseif(isset($this->options['preloader_background']['background-position']) && !empty($this->options['preloader_background']['background-position'])) {
				$preloader_css .= 'background-position: '.esc_attr($this->options['preloader_background']['background-position']).';';
			}
			if($bg_image && $preloader_page_style) {
				$preloader_css .= 'background-image: url('.esc_url($bg_image).');';
			} elseif(isset($this->options['preloader_background']['background-image']) && !empty($this->options['preloader_background']['background-image'])) {
				$preloader_css .= 'background-image: url('.esc_url($this->options['preloader_background']['background-image']).');';
			}
			return $preloader_css;
		}
		function dfd_site_preloader_html() {
			$preloader_css = $preloader_percentage_css = $preloader_style = $preloader_class = '';
			$preloader_style .= $this->dfd_get_preloader_style();
			$preloader_class .= $preloader_style;
			$preloader_class .= $this->dfd_get_preloader_percentage();
			$preloader_css .= $this->dfd_get_preloader_bg();
			if(isset($this->options['preloader_percentage_typography']) && $this->options['preloader_percentage_typography'] && is_array($this->options['preloader_percentage_typography'])) {
				if(isset($this->options['preloader_percentage_typography']['font-family']) && !empty($this->options['preloader_percentage_typography']['font-family'])) {
					$preloader_percentage_css .= 'font-family: '.esc_attr($this->options['preloader_percentage_typography']['font-family']).';';
				}
				if(isset($this->options['preloader_percentage_typography']['font-size']) && !empty($this->options['preloader_percentage_typography']['font-size'])) {
					$preloader_percentage_css .= 'font-size: '.esc_attr($this->options['preloader_percentage_typography']['font-size']).';';
				}
				if(isset($this->options['preloader_percentage_typography']['font-weight']) && !empty($this->options['preloader_percentage_typography']['font-weight'])) {
					$preloader_percentage_css .= 'font-weight: '.esc_attr($this->options['preloader_percentage_typography']['font-weight']).';';
				}
				if(isset($this->options['preloader_percentage_typography']['font-style']) && !empty($this->options['preloader_percentage_typography']['font-style'])) {
					$preloader_percentage_css .= 'font-style: '.esc_attr($this->options['preloader_percentage_typography']['font-style']).';';
				}
				if(isset($this->options['preloader_percentage_typography']['text-transform']) && !empty($this->options['preloader_percentage_typography']['text-transform'])) {
					$preloader_percentage_css .= 'text-transform: '.esc_attr($this->options['preloader_percentage_typography']['text-transform']).';';
				}
				if(isset($this->options['preloader_percentage_typography']['line-height']) && !empty($this->options['preloader_percentage_typography']['line-height'])) {
					$preloader_percentage_css .= 'line-height: '.esc_attr($this->options['preloader_percentage_typography']['line-height']).';';
				}
				if(isset($this->options['preloader_percentage_typography']['letter-spacing']) && !empty($this->options['preloader_percentage_typography']['letter-spacing'])) {
					$preloader_percentage_css .= 'letter-spacing: '.esc_attr($this->options['preloader_percentage_typography']['letter-spacing']).';';
				}
				if(isset($this->options['preloader_percentage_typography']['color']) && !empty($this->options['preloader_percentage_typography']['color'])) {
					$preloader_percentage_css .= 'color: '.esc_attr($this->options['preloader_percentage_typography']['color']).';';
				}
				?>
				<script>
					(function($) {
						$('head').append('<style>#qLpercentage {<?php echo esc_js($preloader_percentage_css) ?>}</style>');
					})(jQuery);
				</script>
				<?php
			}
			?>
			<div id="qLoverlay">
				<div id="qLbar_wrap" class="<?php echo esc_attr($preloader_class) ?>" style="<?php echo esc_attr($preloader_css) ?>">
					<?php if(!empty($preloader_style) && method_exists($this, $preloader_style)) {
						$this->$preloader_style();
					}?>
				</div>
			</div>
		<?php
		}
	}
	$Dfd_Site_Preloader = new Dfd_Site_Preloader;
}