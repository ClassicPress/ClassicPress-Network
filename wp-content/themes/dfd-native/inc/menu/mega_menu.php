<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if (!class_exists('DFD_Mega_menu')) {
	class DFD_Mega_menu {
		var $_options;

		public function __construct() {
			$this->_options = self::options();
			$this->_add_filters();
		}
		
		public static function options() {
			return array(
				'_dfd_mega_menu_icon'		=> array(
						'type' => 'text',
						'label' => esc_html__( 'Icon', 'dfd-native' ),
						'default' => '',
						'size' => 'wide',
					),
				'_dfd_mega_menu_subtitle'	=> array(
						'type' => 'text',
						'label' => esc_html__('Subtitle', 'dfd-native'),
						'default' => '',
						'size' => 'wide',
						'depth' => '1',
						'class' => 'dfd-hide-only-depth-0',
					),
				'_dfd_mega_menu_image'	=> array(
						'type' => 'upload',
						'label' => esc_html__('Image', 'dfd-native'),
						'default' => '',
						'size' => 'wide',
						'depth' => '0',  
						'class' => 'dfd-show-only-depth-0',
					),
				
				'_dfd_mega_menu_bg_position'	=> array(
						'type' => 'select',
						'label' => esc_html__( 'Background position', 'dfd-native' ),
						'default' => 0,
						'options' => array(
								'left top' => esc_html__('Left top', 'dfd-native'),
								'left center' => esc_html__('Left center', 'dfd-native'),
								'left bottom' => esc_html__('Left bottom', 'dfd-native'),
								'right top' => esc_html__('Right top', 'dfd-native'),
								'right center' => esc_html__('Right center', 'dfd-native'),
								'right bottom' => esc_html__('Right bottom', 'dfd-native'),
								'center top' => esc_html__('Center top', 'dfd-native'),
								'center center' => esc_html__('Center center', 'dfd-native'),
								'center bottom' => esc_html__('Center bottom', 'dfd-native')
							),
						'size' => 'thin',
						'depth' => '0',
						'class' => 'dfd-show-only-depth-0',
					),
				'_dfd_mega_menu_bg_repeat'	=> array(
						'type' => 'select',
						'label' => esc_html__( 'Background repeat', 'dfd-native' ),
						'default' => 'no-repeat',
						'options' => array(
								'no-repeat' => esc_html__( 'No-repeat', 'dfd-native' ),
								'repeat' => esc_html__( 'Repeat', 'dfd-native' ),
								'repeat-x' => esc_html__( 'Repeat-x', 'dfd-native' ),
								'repeat-y' => esc_html__( 'Repeat-y', 'dfd-native' ),
							),
						'size' => 'thin',
						'depth' => '0',
						'class' => 'dfd-show-only-depth-0',
					),
				'_dfd_mega_menu_enabled'	=> array(
						'type' => 'select',
						'label' => esc_html__( 'Enable mega menu', 'dfd-native' ),
						'default' => 0,
						'options' => array(1=> esc_html__( 'Yes', 'dfd-native' ), 0=> esc_html__( 'No', 'dfd-native' )),
						'size' => 'thin',
						'depth' => '0',
						'class' => 'dfd-show-only-depth-0 dfd-mega-menu',
					),
				'_dfd_full_width_menu_enabled'	=> array(
						'type' => 'select',
						'label' => esc_html__( 'Enable full-width menu', 'dfd-native' ),
						'default' => 0,
						'options' => array(1=> esc_html__( 'Yes', 'dfd-native' ), 0=> esc_html__( 'No', 'dfd-native' )),
						'size' => 'thin',
						'depth' => '0',
						'class' => 'dfd-show-only-depth-0',
					),
				'_dfd_mega_menu_limit_columns'	=> array(
						'type' => 'select',
						'label' => esc_html__( 'Limit Max columns number', 'dfd-native' ),
						'default' => 0,
						'options' => array(
								''	=>	esc_html__( 'None', 'dfd-native' ),
								1	=>	esc_html__( 'One', 'dfd-native' ),
								2	=>	esc_html__( 'Two', 'dfd-native' ),
								3	=>	esc_html__( 'Three', 'dfd-native' ),
								4	=>	esc_html__( 'Four', 'dfd-native' ),
								5	=>	esc_html__( 'Five', 'dfd-native' ),
								6	=>	esc_html__( 'Six', 'dfd-native' ),
							),
						'size' => 'thin',
						'depth' => '0',
						'class' => 'dfd-show-only-depth-0 dfd-columns-limit',
					),
			);
		}

		private function _add_filters() {
			# Add custom options to menu
			add_filter('wp_setup_nav_menu_item', array($this, 'add_custom_options'));

			# Update custom menu options
			add_action('wp_update_nav_menu_item', array($this, 'update_custom_options'), 10, 3);

			# Set edit menu walker
			add_filter('wp_edit_nav_menu_walker', array($this, 'apply_edit_walker_class'), 10, 2);
			
			# Mega menu javascript
			add_action('admin_enqueue_scripts', array( $this, 'dfd_mega_menu_admin_scripts' ), 80);
		}
		
		
 
		function dfd_mega_menu_admin_scripts() {
			wp_enqueue_media();
		}
		

		/**
		 * Register custom options and load options values
		 * 
		 * @param obj $item Menu Item
		 * @return obj Menu Item
		 */
		public function add_custom_options($item) {

			foreach($this->_options as $option => $params) {
				$item->$option = get_post_meta($item->ID, $option, true);
				if ($item->$option===false) {
					$item->$option = $params['default'];
				}
			}

			return $item;
		}

		public function update_custom_options($menu_id, $menu_item_id, $args) {
			foreach($this->_options as $option => $params) {
				$key = 'menu-item-'. $option;
				
				//$option_value = $params['default']; // ???
				$option_value = '';
				
				if (isset($_REQUEST[$key], $_REQUEST[$key][$menu_item_id])) {
					$option_value = $_REQUEST[$key][$menu_item_id];
				}
				
				update_post_meta($menu_item_id, $option, $option_value );
			}
		}

		public function apply_edit_walker_class( $walker, $menu_id ) {
			return DFD_EDIT_MENU_WALKER_CLASS;
		}
	}
}
