<?php
/**
 * @package     ReduxFramework
 * @author      dfd
 * @version     1.0.0
 */
// Exit if accessed directly
if (!defined('ABSPATH'))
	exit;

// Don't duplicate me!
if (!class_exists('ReduxFramework_header_builder')) {

	/**
	 * Main ReduxFramework_custom_field class
	 *
	 * @since       1.0.0
	 */
	class ReduxFramework_header_builder extends ReduxFramework {

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
			$this->admin_js = get_template_directory_uri() . '/assets/admin/js/';
			$this->admin_css = get_template_directory_uri() . '/assets/admin/css/';


			$this->parent = $parent;
			$this->field = $field;
			$this->value = $value;

			if (empty($this->extension_dir)) {
				$this->extension_dir = trailingslashit(str_replace('\\', '/', dirname(__FILE__)));
				$this->extension_url = site_url(str_replace(trailingslashit(str_replace('\\', '/', ABSPATH)), '', $this->extension_dir));
			}
			$redux = ReduxFrameworkInstances::get_instance("native");
			add_action('admin_head', array (&$redux, '_output_css'), 200);
			add_action('admin_enqueue_scripts', array (&$redux, '_enqueue_output'), 200);
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
			$output = "";
			
			$main_lib = get_template_directory() . "/inc/dynamic_styles/headers.php";
			$main_vars = get_template_directory() . "/inc/variables_less.php";
			$vars= "";
			if(is_file($main_vars)){
				require_once $main_vars;
				$vars = Dfd_Dynamic_Style_Vars::return_vars();
			}
			if(is_file($main_lib)){
				@require $main_lib;
			}
			foreach (glob($this->extension_dir . 'dynamic_styles/' . '*.php') as $styles) {
				require_once($styles);
			}

			$this->loadTemplates();
			?><style type="text/css">
			<?php echo $output; ?>
			</style>
			<?php
		}

		public function loadTemplates() {
			$dir = $this->extension_dir . "templates/main.php";
			require_once $dir;
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
			add_thickbox();
			global $dfd_native;

			wp_enqueue_style('dfd-header-builder', $this->extension_url . 'css/main.css');
			if(isset($dfd_native['dev_mode']) && $dfd_native['dev_mode'] == 'on' && defined('DFD_DEBUG_MODE') && DFD_DEBUG_MODE) {
				wp_enqueue_script('dfd-header-builder-disablescroll', $this->extension_url . 'js/vendor/disableScroll.js', array ('jquery'));
				wp_enqueue_script('dfd-header-builder-presets', $this->extension_url . 'js/components/presets.js', array ('jquery', 'backbone', 'underscore'));
				wp_enqueue_script('dfd-header-builder-config', $this->extension_url . 'js/components/config.js', array ('jquery', 'backbone', 'underscore'));
				wp_enqueue_script('dfd-header-sortable', $this->extension_url . 'js/vendor/sortable.min.js');
				wp_enqueue_script('dfd-header-builder', $this->extension_url . 'js/main.js', array ('jquery', 'backbone', 'underscore'));
				wp_enqueue_script('dfd-header-builder-builder', $this->extension_url . 'js/components/builder.js', array ('jquery', 'backbone', 'underscore'));
				wp_enqueue_script('dfd-header-builder-add_preset_view', $this->extension_url . 'js/views/add_preset_view.js', array ('jquery', 'backbone', 'underscore'));
				wp_enqueue_script('dfd-header-builder-preset_view', $this->extension_url . 'js/views/preset_view.js', array ('jquery', 'backbone', 'underscore'));
				wp_enqueue_script('dfd-header-builder-presets_view', $this->extension_url . 'js/views/presets_view.js', array ('jquery', 'backbone', 'underscore'));
				wp_enqueue_script('dfd-header-builder-sortable', $this->extension_url . 'js/components/sortable.js', array ('jquery', 'backbone', 'underscore'));
				wp_enqueue_script('dfd-header-builder-helper', $this->extension_url . 'js/components/helper.js', array ('jquery', 'backbone', 'underscore'));
				wp_enqueue_script('dfd-header-builder-Element', $this->extension_url . 'js/models/Element.js', array ('jquery', 'backbone', 'underscore'));
				wp_enqueue_script('dfd-header-builder-Preset', $this->extension_url . 'js/models/Preset.js', array ('jquery', 'backbone', 'underscore'));
				wp_enqueue_script('dfd-header-builder-Setting', $this->extension_url . 'js/models/Setting.js', array ('jquery', 'backbone', 'underscore'));
				wp_enqueue_script('dfd-header-builder-Elements', $this->extension_url . 'js/collections/Elements.js', array ('jquery', 'backbone', 'underscore'));
				wp_enqueue_script('dfd-header-builder-SettingCollection', $this->extension_url . 'js/collections/SettingCollection.js', array ('jquery', 'backbone', 'underscore'));
				wp_enqueue_script('dfd-header-builder-element_view', $this->extension_url . 'js/views/element_view.js', array ('jquery', 'backbone', 'underscore'));
				wp_enqueue_script('dfd-header-builder-head', $this->extension_url . 'js/views/app.js', array ('jquery', 'backbone', 'underscore'));
				wp_enqueue_script('dfd-header-builder-settings-view', $this->extension_url . 'js/views/settings_view.js', array ('jquery', 'backbone', 'underscore'));
			} else {
				wp_enqueue_script('dfd-header-builder-compresed', $this->extension_url . 'js_pub/compresed.min.js', array ('jquery', 'backbone', 'underscore'));
			}
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
