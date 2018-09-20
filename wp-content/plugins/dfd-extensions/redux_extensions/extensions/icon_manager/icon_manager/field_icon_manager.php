<?php
/**
 * @package     ReduxFramework
 * @author      Vladyslav Tkachenko
 * @version     1.0.0
 */
// Exit if accessed directly
if (!defined('ABSPATH'))
	exit;

// Don't duplicate me!
if (!class_exists('ReduxFramework_icon_manager')) {

	/**
	 * Main ReduxFramework_custom_field class
	 *
	 * @since       1.0.0
	 */
	class ReduxFramework_icon_manager extends ReduxFramework {

		/**
		 * Field Constructor.
		 *
		 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
		 *
		 * @since       1.0.0
		 * @access      public
		 * @return      void
		 */
		function __construct($field = array (), $value = '', $parent) {
			$this->admin_js = DFD_EXTENSIONS_PLUGIN_URL . 'assets/admin/js/';
			$this->admin_css = DFD_EXTENSIONS_PLUGIN_URL . 'assets/admin/css/';

			IconConfig::initSettings($this);

			$this->parent = $parent;
			$this->field = $field;
			$this->value = $value;

			if (empty($this->extension_dir)) {
				$this->extension_dir = trailingslashit(str_replace('\\', '/', dirname(__FILE__)));
				$this->extension_url = site_url(str_replace(trailingslashit(str_replace('\\', '/', ABSPATH)), '', $this->extension_dir));
			}
			$field = $this->field["id"];
//			 $this->parent->options[$field][0] = "1";
//			$this->value = "1";
//			$sss = $this->parent->options[$field][0];
			$this->addCssToHead();
//			add_action('init', array ($this, 'addCssToHead'));
		}

		public function addCssToHead() {
			$fonts = array ();
			$field = $this->field["id"];
			// For Back capability
//			if (isset($this->parent->options[$field][0]["icons"])) {
//				$this->parent->options[$field][0] = $this->parent->options[$field][0]["icons"];
//			}

			if (isset($this->parent->options[$field][0]) && $this->parent->options[$field][0] != "" && is_string($this->parent->options[$field][0])) {
				$fonts = json_decode($this->parent->options[$field][0], true);
			}
			$def = IconConfig::getDefaults();
			if (is_array($fonts)) {
				$fonts = array_merge($fonts, $def);
			} else {
				$fonts = $def;
			}
			if (count($fonts) > 0) {
				foreach ($fonts as $font => $info) {
					if (isset($info->style) && strpos($info->style, 'http://') !== false) {
						wp_enqueue_style('dfd-' . $font, $info["style"]);
					} else {
						if (isset($info["is_default"])) {
							$path = trailingslashit(DFD_EXTENSIONS_PLUGIN_URL) . $info["main"];
						} else {
							$path = $this->paths['fonturl'];
						}
						$path = trailingslashit($path) . $info["style"];
						$local_path = trailingslashit($this->paths['fontdir']) . $info["style"];
						if (is_file($local_path) || isset($info["is_default"])) {
							wp_enqueue_style('dfd-' . $font, $path);
						}
					}
				}
			}
		}

		/**
		 * Field Render Function.
		 *
		 * Takes the vars and outputs the HTML for the field in the settings
		 *
		 * @since       1.0.0
		 * @access      public
		 * @return      void
		 */
		public function render() {
			$jsonArr = array (
					"[zip]" => "application/zip"
			);
			$libFilter = urlencode(json_encode($jsonArr));
			$x = 0;
			?>
			<div class="wrap">
				<div>
					<h2>
						<?php esc_html_e('Icon Fonts Manager', 'dfd-native'); ?>
					</h2>
					<?php echo '<span class="button icon_upload_font_button" id="add_' . $x . '">' . esc_html__('Upload New Icons', 'dfd-native') . '</span>'; ?>
					<br>
					&nbsp;
					<div class="screenshot"></div>
					<div id="msg"></div>
					<?php
					echo '<input type="hidden" class="upload_file_id" name="' . $this->field['name'] . '[0][id]" id="" value="" />';
					echo '<input type="hidden" class="delete_file_id" name="' . $this->field['name'] . '[0][delete]" id="del_icon" value="" />';
					echo '<input type="hidden" class="select_file_id" name="' . $this->field['name'] . '[0][select]" id="sel_icon" value="" />';
					?>
				</div>

				<?php
				echo '<input type="hidden" class="library-filter" data-lib-filter="' . $libFilter . '" />';
				?>
				<?php echo self::get_font_set($this->value); ?>
			</div>
			<?php
		}

		/**
		 * Enqueue Function.
		 *
		 * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
		 *
		 * @since       1.0.0
		 * @access      public
		 * @return      void
		 */
		public function enqueue() {
			wp_enqueue_script('dfd-media-icon-manager', $this->extension_url . 'js/media.js', array ('jquery'));
			wp_enqueue_script('media-upload');
			wp_enqueue_media();
			wp_enqueue_style('dfdev-icon-manager-admin', $this->admin_css . 'icon-manager-admin.css');
		}

		// Generate Icon Set Preview and settings page
		static function get_font_set($fonts) {
			$def = IconConfig::getDefaults();
			if (isset($fonts[0]) && !empty($fonts[0]) && !empty($fonts) && is_string($fonts[0])) {
				$fonts = json_decode($fonts[0], true);
			} else {
				$fonts = array ();
			}
			$fonts = !is_array($fonts) ? array(): $fonts;
			$fonts = array_merge($fonts, $def);
			$n = count($fonts);
			foreach ($fonts as $font => $info) {
				$font = esc_attr($font);
				$icon_set = array ();
				$icons = array ();
				$class = "";
				if (isset($info["is_default"])) {
					$upload_dir['basedir'] = DFD_EXTENSIONS_PLUGIN_PATH;
					$class = "def";
				} else {
					$upload_dir = wp_upload_dir();
				}
				$path = trailingslashit($upload_dir['basedir']);
				$file = $path . $info["include"] . '/' . $info["config"];
				$output = '<div class="icon_set-' . $font . ' metabox-holder">';
				$output2 = "";
				if (!isset($info["is_default"])) {
					$checked = isset($info["active"]) && $info["active"] == true ? "checked" : "";
					$output2.='<div class="icon_check"><input type="checkbox" ' . $checked . ' data-select = ' . $font . ' class="sel_use_icon"></div>';
				}
				$output .= '<div class="postbox '.$class.'">';
				if (!file_exists($file)) {
					continue;
				}
				include($file);
				if (!empty($icons)) {
					$icon_set = array_merge($icon_set, $icons);
				}
				if (!empty($icon_set)) {
					foreach ($icon_set as $icons) {
						$count = count($icons);
					}
					if (isset($info["is_default"]))
						$output .= '<h3 class="icon_font_name"><strong>' . esc_html__("Theme Default Icons", 'dfd-native') . '</strong>';
					else
						$output .= $output2 . '<h3 class="icon_font_name"><strong>' . ucfirst($font) . '</strong>';
					$output .= '<span class="fonts-count count-' . esc_attr($font) . '">' . $count . '</span>';
					if ($n != 0 && !isset($info["is_default"]))
						$output .= '<button class="button button-secondary button-small dfd_del_icon" data-delete=' . esc_attr($font) . ' data-title="Delete This Icon Set">Delete Icon Set</button>';
					$output .= '</h3>';
					$output .= '<div class="inside"><div class="icon_actions">';
					$output .= '</div>';
					$output .= '<div class="icon_search"><ul class="icons-list fi_icon">';
					foreach ($icon_set as $icons) {
						foreach ($icons as $icon) {
							$icon_class =  esc_attr($icon['class']);
							$output .= '<li title="' . $icon_class . '" data-icons="' . $icon_class . '" data-icons-tag="' . esc_attr($icon['tags']) . '">';
							if(isset($info["is_default"]) && $info["is_default"]) {
								$output .= '<i class="'.esc_attr($icon['class']).'"></i><label class="icon">'.$icon['class'].'</label></li>';
							} else {
								$output .= '<i class="'.$font.'-'.$icon_class.'"></i><label class="icon">' . $icon_class . '</label></li>';
							}
						}
					}
					$output . '</ul>';
					$output .= '</div><!-- .icon_search-->';
					$output .= '</div><!-- .inside-->';
					$output .= '</div><!-- .postbox-->';
					$output .= '</div><!-- .icon_set-' . $font . ' -->';
					echo $output;
				}
			}
			$script = '<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery(".search-icon").keyup(function(){
						jQuery(".fonts-count").hide();
						// Retrieve the input field text and reset the count to zero
						var filter = jQuery(this).val(), count = 0;
						// Loop through the icon list
						jQuery(".icons-list li").each(function(){
							// If the list item does not contain the text phrase fade it out
							if (jQuery(this).attr("data-icons-tag").search(new RegExp(filter, "i")) < 0) {
								jQuery(this).fadeOut();
							} else {
								jQuery(this).show();
								count++;
							}
							if(count == 0)
								jQuery(".search-count").html(" Can\'t find the icon? <a href=\'#dfd_upload_icon\' class=\'add-new-h2 dfd_upload_icon\' data-target=\'iconfont_upload\' data-title=\'Upload/Select Fontello Font Zip\' data-type=\'application/octet-stream, application/zip\' data-button=\'Insert Fonts Zip File\' data-trigger=\'dfd_insert_zip\' data-class=\'media-frame\'>Click here to upload</a>");
							else
								jQuery(".search-count").html(count+" Icons found.");
							if(filter == "")
								jQuery(".fonts-count").show();
						});
					});
				});
			</script>';
			echo $script;
		}

		/**
		 * Output Function.
		 *
		 * Used to enqueue to the front-end
		 *
		 * @since       1.0.0
		 * @access      public
		 * @return      void
		 */
		public function output() {

			if ($this->field['enqueue_frontend']) {
				
			}
		}

	}

}
