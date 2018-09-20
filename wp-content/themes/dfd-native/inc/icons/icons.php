<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*	
*	---------------------------------------------------------------------
*	DFD Icon picker param
*	--------------------------------------------------------------------- 
*/
if(!class_exists('Dfd_Icons_Admin_Field')) {
	class Dfd_Icons_Admin_Field {
		function __construct() {
			add_action('admin_enqueue_scripts', array($this, 'enqueue_assets'));
			add_action('admin_footer', array($this, 'param_field_html'));
		}
		
		function enqueue_assets($hook) {
			if($hook == 'edit-tags.php' || $hook == 'nav-menus.php' || $hook == 'term.php') {
				wp_register_style( 'dfd-icon-generator', get_template_directory_uri() . '/inc/icons/css/generator.css', false, '', 'all' );
				wp_register_script( 'dfd-icon-generator', get_template_directory_uri() . '/inc/icons/js/generator.js', array( 'jquery' ), '', false );

				wp_enqueue_style( 'thickbox' );
				wp_enqueue_style( 'dfd-icon-generator' );

				wp_enqueue_script( 'thickbox' );
				wp_enqueue_script( 'dfd-icon-generator' );
			}
		}
		
		function param_field_html() {
			$page = get_current_screen();
			if(isset($page->base) && ($page->base == 'edit-tags' || $page->base == 'nav-menus' || $page->base == 'term')) {
				?>
				<div id="dfd-generator-overlay" class="dfd-overlay-bg" style="display:none"></div>
				<div id="dfd-generator-wrap" style="display:none">
					<div id="dfd-generator">
						<a href="#" id="dfd-generator-close"><span class="dfd-close-icon"></span></a>
						<div id="dfd-generator-shell">
							<div class="dfd-generator-icon-select">
								<?php
								if(!class_exists('ReduxFramework_icon_manager') && class_exists('ReduxFramework') && isset(ReduxFramework::$_dir) && file_exists(ReduxFramework::$_dir.'/inc/extensions/icon_manager/extension_icon_manager.php')) {
									require_once(ReduxFramework::$_dir.'/inc/extensions/icon_manager/extension_icon_manager.php');	
								}
								if(method_exists('ReduxFramework_extension_icon_manager','get_font_manager') && class_exists('IconConfig')) {
									echo ReduxFramework_extension_icon_manager::get_font_manager(true);
								}
								?>
							</div>
							<input name="dfd-generator-insert" type="submit" class="button button-primary button-large" id="dfd-generator-insert" value="Insert Icon">
						</div>
					</div>
				</div>
				<?php
			}
		}
	}
	$Dfd_Icons_Admin_Field = new Dfd_Icons_Admin_Field();
}

if(!class_exists('Dfd_Vc_Enqueue_Icons')) {
	class Dfd_Vc_Enqueue_Icons {
		function __construct() {
			add_action('admin_init', array($this, 'init'));
		}
		function init() {
			add_filter('vc_iconpicker-type-dfd_icons', array($this, 'add_icons_to_param'));
		}
		function get_fonts() {
			if(!method_exists('ReduxFramework_extension_icon_manager', 'getIconOptions') || !method_exists('IconConfig', 'getDefaults')) {
				return false;
			}
			
			$fonts = ReduxFramework_extension_icon_manager::getIconOptions();
			$fonts = is_array($fonts) ? $fonts : array();
			$def = IconConfig::getDefaults();
			$fonts = array_merge($fonts, $def);
			
			return $fonts;
		}
		function add_icons_to_param($default_icons) {
			$fonts = $this->get_fonts();
			$dfd_icons = array();
			if($fonts && !empty($fonts) && is_array($fonts)) {
				$font_set = array();
				foreach($fonts as $font => $info) {
					if (!isset($info['active']) || $info['active'] == false) {
						continue;
					}
					$icon_set = $icons  = array();
					if (isset($info['is_default']) && defined('DFD_EXTENSIONS_PLUGIN_PATH')) {
						$upload_dir['basedir'] = DFD_EXTENSIONS_PLUGIN_PATH;
					} else {
						$upload_dir = wp_upload_dir();
					}
					$path = trailingslashit($upload_dir['basedir']);
					$file = $path . $info['include'] . '/' . $info['config'];
					include($file);
					if(!empty($icons)) {
						$icon_set = array_merge($icon_set, $icons);
					}
					$set_name = preg_replace('/[^a-zA-ZА-Яа-я0-9_\s]/', '', $font);
					if(!empty($icon_set)) {
						foreach ($icon_set as $icons) {
							foreach ($icons as $icon) {
								if(isset($info['is_default']) && $info['is_default']) {
									$class_name = $icon['class'];
								} else {
									$class_name = $font.'-'.$icon['class'];
								}
								$title = preg_replace('/[^a-zA-ZА-Яа-я0-9\s]/', ' ', $class_name);
								$font_set[$set_name][] = array($class_name => $title);
							}
						}
					}
				}
				$dfd_icons = array_merge($dfd_icons, $font_set);
			}

			return array_merge($default_icons, $dfd_icons);
		}
	}
	$Dfd_Vc_Enqueue_Icons = new Dfd_Vc_Enqueue_Icons();
}