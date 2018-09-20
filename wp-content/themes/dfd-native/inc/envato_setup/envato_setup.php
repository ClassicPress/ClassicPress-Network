<?php
/**
 * Envato Theme Setup Wizard Class
 *
 * Takes new users through some basic steps to setup their ThemeForest theme.
 *
 * @author      dtbaker
 * @author      vburlak
 * @package     envato_wizard
 * @version     1.2.6
 *
 *
 * 1.2.0 - added custom_logo
 * 1.2.1 - ignore post revisioins
 * 1.2.2 - elementor widget data replace on import
 * 1.2.3 - auto export of content.
 * 1.2.4 - fix category menu links
 * 1.2.5 - post meta un json decode
 *
 * Based off the WooThemes installer.
 *
 *
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Envato_Theme_Setup_Wizard' ) ) {
	/**
	 * Envato_Theme_Setup_Wizard class
	 */
	class Envato_Theme_Setup_Wizard {

		/**
		 * The class version number.
		 *
		 * @since 1.1.1
		 * @access private
		 *
		 * @var string
		 */
		protected $version = '1.2.6';

		/** @var string Current theme name, used as namespace in actions. */
		protected $theme_name = '';

		/** @var string Theme author username, used in check for oauth. */
		protected $envato_username = '';

		/** @var string Full url to server-script.php (available from https://gist.github.com/dtbaker ) */
		protected $oauth_script = '';

		/** @var string Current Step */
		protected $step = '';

		/** @var array Steps for the setup wizard */
		protected $steps = array();

		/**
		 * Relative plugin path
		 *
		 * @since 1.1.2
		 *
		 * @var string
		 */
		protected $plugin_path = '';

		/**
		 * Relative plugin url for this plugin folder, used when enquing scripts
		 *
		 * @since 1.1.2
		 *
		 * @var string
		 */
		protected $plugin_url = '';

		/**
		 * The slug name to refer to this menu
		 *
		 * @since 1.1.1
		 *
		 * @var string
		 */
		protected $page_slug;

		/**
		 * TGMPA instance storage
		 *
		 * @var object
		 */
		protected $tgmpa_instance;

		/**
		 * TGMPA Menu slug
		 *
		 * @var string
		 */
		protected $tgmpa_menu_slug = 'tgmpa-install-plugins';

		/**
		 * TGMPA Menu url
		 *
		 * @var string
		 */
		protected $tgmpa_url = 'themes.php?page=tgmpa-install-plugins';

		/**
		 * The slug name for the parent menu
		 *
		 * @since 1.1.2
		 *
		 * @var string
		 */
		protected $page_parent;

		/**
		 * Complete URL to Setup Wizard
		 *
		 * @since 1.1.2
		 *
		 * @var string
		 */
		protected $page_url;

		/**
		 * Custom url
		 *
		 * @since 1.1.2
		 *
		 * @var string
		 */
		protected $custom_url = 'http://nativewptheme.net';


		/**
		 * Holds the current instance of the theme manager
		 *
		 * @since 1.1.3
		 * @var Envato_Theme_Setup_Wizard
		 */
		private static $instance = null;

		/**
		 * @since 1.1.3
		 *
		 * @return Envato_Theme_Setup_Wizard
		 */
		public static function get_instance() {
			if ( ! self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}

		/**
		 * A dummy constructor to prevent this class from being loaded more than once.
		 *
		 * @see Envato_Theme_Setup_Wizard::instance()
		 *
		 * @since 1.1.1
		 * @access private
		 */
		public function __construct() {
			$this->init_globals();
			$this->init_actions();
		}

		/**
		 * Get the default style. Can be overriden by theme init scripts.
		 *
		 * @see Envato_Theme_Setup_Wizard::instance()
		 *
		 * @since 1.1.7
		 * @access public
		 */
		public function get_default_theme_style() {
			return 'pink';
		}

		/**
		 * Get the default style. Can be overriden by theme init scripts.
		 *
		 * @see Envato_Theme_Setup_Wizard::instance()
		 *
		 * @since 1.1.9
		 * @access public
		 */
		public function get_header_logo_width() {
			return '200px';
		}


		/**
		 * Get the default style. Can be overriden by theme init scripts.
		 *
		 * @see Envato_Theme_Setup_Wizard::instance()
		 *
		 * @since 1.1.9
		 * @access public
		 */
		public function get_logo_image() {
			$logo_image_id = get_theme_mod( 'custom_logo' );
			if ( $logo_image_id ) {
				$logo_image_object = wp_get_attachment_image_src( $logo_image_id, 'full' );
				$image_url         = $logo_image_object[0];
			} else {
				$image_url = get_theme_mod( 'logo_header_image', get_template_directory_uri() . '/images/' . get_theme_mod( 'dtbwp_site_color', $this->get_default_theme_style() ) . '/logo.png' );
			}

			return apply_filters( 'envato_setup_logo_image', $image_url );
		}

		/**
		 * Setup the class globals.
		 *
		 * @since 1.1.1
		 * @access public
		 */
		public function init_globals() {
			$current_theme         = wp_get_theme();
			$this->theme_name      = strtolower( preg_replace( '#[^a-zA-Z]#', '', $current_theme->get( 'Name' ) ) );
			$this->envato_username = apply_filters( $this->theme_name . '_theme_setup_wizard_username', 'dfdevelopment' );
			$this->oauth_script    = apply_filters( $this->theme_name . '_theme_setup_wizard_oauth_script', $this->custom_url.'/files/envato/wptoken/server-script.php' );
			$this->page_slug       = apply_filters( $this->theme_name . '_theme_setup_wizard_page_slug', $this->theme_name . '-setup' );
			$this->parent_slug     = apply_filters( $this->theme_name . '_theme_setup_wizard_parent_slug', '' );

			//If we have parent slug - set correct url
			if ( $this->parent_slug !== '' ) {
				$this->page_url = 'admin.php?page=' . $this->page_slug;
			} else {
				$this->page_url = 'themes.php?page=' . $this->page_slug;
			}
			$this->page_url = apply_filters( $this->theme_name . '_theme_setup_wizard_page_url', $this->page_url );

			//set relative plugin path url
			$this->plugin_url  = trailingslashit( get_template_directory_uri() . '/inc/envato_setup' );
		}

		/**
		 * Setup the hooks, actions and filters.
		 *
		 * @uses add_action() To add actions.
		 * @uses add_filter() To add filters.
		 *
		 * @since 1.1.1
		 * @access public
		 */
		public function init_actions() {
			if ( apply_filters( $this->theme_name . '_enable_setup_wizard', true ) && current_user_can( 'manage_options' ) ) {
				add_action( 'after_switch_theme', array( $this, 'switch_theme' ) );

				if ( class_exists( 'TGM_Plugin_Activation' ) && isset( $GLOBALS['tgmpa'] ) ) {
					add_action( 'init', array( $this, 'get_tgmpa_instanse' ), 30 );
					add_action( 'init', array( $this, 'set_tgmpa_url' ), 40 );
				}

				add_action( 'admin_menu', array( $this, 'admin_menus' ) );
				add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
				add_action( 'admin_init', array( $this, 'admin_redirects' ), 30 );
				add_action( 'admin_init', array( $this, 'init_wizard_steps' ), 30 );
				add_action( 'admin_init', array( $this, 'setup_wizard' ), 30 );
				add_filter( 'tgmpa_load', array( $this, 'tgmpa_load' ), 10, 1 );
				add_action( 'wp_ajax_envato_setup_plugins', array( $this, 'ajax_plugins' ) );
			}
			add_action( 'upgrader_post_install', array( $this, 'upgrader_post_install' ), 10, 2 );
		}

		/**
		 * After a theme update we clear the setup_complete option. This prompts the user to visit the update page again.
		 *
		 * @since 1.1.8
		 * @access public
		 */
		public function upgrader_post_install( $return, $theme ) {
			if ( is_wp_error( $return ) ) {
				return $return;
			}
			if ( $theme != get_stylesheet() ) {
				return $return;
			}
			update_option( 'envato_setup_complete', false );

			return $return;
		}

		/**
		 * We determine if the user already has theme content installed. This can happen if swapping from a previous theme or updated the current theme. We change the UI a bit when updating / swapping to a new theme.
		 *
		 * @since 1.1.8
		 * @access public
		 */
		public function is_possible_upgrade() {
			return false;
		}

		public function enqueue_scripts() {
		}

		public function tgmpa_load( $status ) {
			return is_admin() || current_user_can( 'install_themes' );
		}

		public function switch_theme() {
			set_transient( '_' . $this->theme_name . '_activation_redirect', 1 );
		}

		public function admin_redirects() {
			ob_start();
			if ( ! get_transient( '_' . $this->theme_name . '_activation_redirect' ) || get_option( 'envato_setup_complete', false ) ) {
				return;
			}
			delete_transient( '_' . $this->theme_name . '_activation_redirect' );
			wp_safe_redirect( admin_url( $this->page_url ) );
			exit;
		}

		/**
		 * Get configured TGMPA instance
		 *
		 * @access public
		 * @since 1.1.2
		 */
		public function get_tgmpa_instanse() {
			$this->tgmpa_instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
		}

		/**
		 * Update $tgmpa_menu_slug and $tgmpa_parent_slug from TGMPA instance
		 *
		 * @access public
		 * @since 1.1.2
		 */
		public function set_tgmpa_url() {

			$this->tgmpa_menu_slug = ( property_exists( $this->tgmpa_instance, 'menu' ) ) ? $this->tgmpa_instance->menu : $this->tgmpa_menu_slug;
			$this->tgmpa_menu_slug = apply_filters( $this->theme_name . '_theme_setup_wizard_tgmpa_menu_slug', $this->tgmpa_menu_slug );

			$tgmpa_parent_slug = ( property_exists( $this->tgmpa_instance, 'parent_slug' ) && $this->tgmpa_instance->parent_slug !== 'themes.php' ) ? 'admin.php' : 'themes.php';

			$this->tgmpa_url = apply_filters( $this->theme_name . '_theme_setup_wizard_tgmpa_url', $tgmpa_parent_slug . '?page=' . $this->tgmpa_menu_slug );

		}

		/**
		 * Add admin menus/screens.
		 */
		public function admin_menus() {

			if ( $this->is_submenu_page() ) {
				//prevent Theme Check warning about "themes should use add_theme_page for adding admin pages"
				$add_subpage_function = 'add_submenu' . '_page';
				$add_subpage_function( $this->parent_slug, esc_html__( 'Setup Wizard', 'dfd-native' ), esc_html__( 'Setup Wizard', 'dfd-native' ), 'manage_options', $this->page_slug, array(
					$this,
					'setup_wizard',
				) );
			} else {
				add_theme_page( esc_html__( 'Setup Wizard', 'dfd-native' ), esc_html__( 'Setup Wizard', 'dfd-native' ), 'manage_options', $this->page_slug, array(
					$this,
					'setup_wizard',
				) );
			}

		}


		/**
		 * Setup steps.
		 *
		 * @since 1.1.1
		 * @access public
		 * @return array
		 */
		public function init_wizard_steps() {

			$this->steps = array(
				'introduction' => array(
					'name'    => esc_html__( 'Introduction', 'dfd-native' ),
					'view'    => array( $this, 'envato_setup_introduction' ),
					'handler' => array( $this, 'envato_setup_introduction_save' ),
				),
			);
			if ( class_exists( 'TGM_Plugin_Activation' ) && isset( $GLOBALS['tgmpa'] ) ) {
				$this->steps['default_plugins'] = array(
					'name'    => esc_html__( 'Plugins', 'dfd-native' ),
					'view'    => array( $this, 'envato_setup_default_plugins' ),
					'handler' => '',
				);
			}
			$this->steps['customize']       = array(
				'name'    => esc_html__( 'Customize', 'dfd-native' ),
				'view'    => array( $this, 'envato_setup_customize' ),
				'handler' => '',
			);
			$this->steps['help_support']    = array(
				'name'    => esc_html__( 'Support', 'dfd-native' ),
				'view'    => array( $this, 'envato_setup_help_support' ),
				'handler' => '',
			);
			$this->steps['next_steps']      = array(
				'name'    => esc_html__( 'Ready!', 'dfd-native' ),
				'view'    => array( $this, 'envato_setup_ready' ),
				'handler' => '',
			);

			$this->steps = apply_filters( $this->theme_name . '_theme_setup_wizard_steps', $this->steps );

		}

		/**
		 * Show the setup wizard
		 */
		public function setup_wizard() {
			if ( empty( $_GET['page'] ) || $this->page_slug !== $_GET['page'] ) {
				return;
			}
			ob_end_clean();

			$this->step = isset( $_GET['step'] ) ? sanitize_key( $_GET['step'] ) : current( array_keys( $this->steps ) );

			wp_register_script( 'jquery-blockui', $this->plugin_url . 'js/jquery.blockUI.js', array( 'jquery' ), '2.70', true );
			wp_register_script( 'envato-setup', $this->plugin_url . 'js/envato-setup.js', array(
				'jquery',
				'jquery-blockui',
			), $this->version );
			wp_localize_script( 'envato-setup', 'envato_setup_params', array(
				'tgm_plugin_nonce' => array(
					'update'  => wp_create_nonce( 'tgmpa-update' ),
					'install' => wp_create_nonce( 'tgmpa-install' ),
				),
				'tgm_bulk_url'     => admin_url( $this->tgmpa_url ),
				'ajaxurl'          => admin_url( 'admin-ajax.php' ),
				'wpnonce'          => wp_create_nonce( 'envato_setup_nonce' ),
				'verify_text'      => esc_html__( '...verifying', 'dfd-native' ),
			) );

			//wp_enqueue_style( 'envato_wizard_admin_styles', $this->plugin_url . '/css/admin.css', array(), $this->version );
			wp_enqueue_style( 'envato-setup', $this->plugin_url . 'css/envato-setup.css', array(
				'wp-admin',
				'dashicons',
				'install',
			), $this->version );

			//enqueue style for admin notices
			wp_enqueue_style( 'wp-admin' );

			wp_enqueue_media();
			wp_enqueue_script( 'media' );

			ob_start();
			$this->setup_wizard_header();
			$this->setup_wizard_steps();
			$show_content = true;
			echo '<div class="envato-setup-content">';
			echo '<span class="shadow shadow-first"></span>';
			echo '<span class="shadow shadow-second"></span>';
			if ( ! empty( $_REQUEST['save_step'] ) && isset( $this->steps[ $this->step ]['handler'] ) ) {
				$show_content = call_user_func( $this->steps[ $this->step ]['handler'] );
			}
			if ( $show_content ) {
				$this->setup_wizard_content();
			}
			echo '</div>';
			$this->setup_wizard_footer();
			exit;
		}

		public function get_step_link( $step ) {
			return add_query_arg( 'step', $step, admin_url( 'admin.php?page=' . $this->page_slug ) );
		}

		public function get_next_step_link() {
			$keys = array_keys( $this->steps );

			return add_query_arg( 'step', $keys[ array_search( $this->step, array_keys( $this->steps ) ) + 1 ], remove_query_arg( 'translation_updated' ) );
		}

		/**
		 * Setup Wizard Header
		 */
		public function setup_wizard_header() {
			$logo_url = get_template_directory_uri() . '/assets/admin/img/pimport_logo_retina.png';
			?>
			<!DOCTYPE html>
			<html xmlns="http://www.w3.org/1999/xhtml" class="dfd-envato-setup-html" <?php language_attributes(); ?>>
				<head>
					<meta name="viewport" content="width=device-width"/>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
					<?php
					// avoid theme check issues.
					echo '<t';
					echo 'itle>' . esc_html__( 'Theme &rsaquo; Setup Wizard', 'dfd-native' ) . '</ti' . 'tle>'; ?>
					<?php wp_print_scripts( 'envato-setup' ); ?>
					<?php do_action( 'admin_print_styles' ); ?>
					<?php do_action( 'admin_print_scripts' ); ?>
					<?php do_action( 'admin_head' ); ?>
				</head>
				<body class="envato-setup wp-core-ui">
					<div class="envato-setup-content-wrapper">
						<h1 id="wc-logo">
							<a href="http://themeforest.net/user/dfdevelopment/portfolio" target="_blank">
								<strong><?php esc_html_e('Native WordPress Theme', 'dfd-native') ?></strong> <?php esc_html_e('setup wizard', 'dfd-native') ?>
								<?php /*<img src="<?php echo esc_url( $logo_url ); ?>" alt="Envato install wizard" /> */ ?>
							</a>
						</h1>
			<?php
		}

		/**
		 * Setup Wizard Footer
		 */
		public function setup_wizard_footer() {
						if ( 'next_steps' === $this->step ) : ?>
							<a class="wc-return-to-dashboard"
							   href="<?php echo esc_url( admin_url() ); ?>">← <?php esc_html_e( 'Return to the WordPress Dashboard', 'dfd-native' ); ?></a>
						<?php endif; ?>
					</div>
				</body>
				<?php
				@do_action( 'admin_footer' ); // this was spitting out some errors in some admin templates. quick @ fix until I have time to find out what's causing errors.
				do_action( 'admin_print_footer_scripts' );
				?>
			</html>
			<?php
		}

		/**
		 * Output the steps
		 */
		public function setup_wizard_steps() {
			$ouput_steps = $this->steps;
			array_shift( $ouput_steps );
			?>
			<div class="setup-steps-wrapper">
				<ol class="envato-setup-steps">
					<?php
					$i = 1;
					foreach ( $ouput_steps as $step_key => $step ) : ?>
						<li class="<?php
						$show_link = false;
						if ( $step_key === $this->step ) {
							echo 'active';
						} elseif ( array_search( $this->step, array_keys( $this->steps ) ) > array_search( $step_key, array_keys( $this->steps ) ) ) {
							echo 'done';
							$show_link = true;
						}
						?>">
							<span class="counter"><span><?php echo esc_html($i) ?></span><i><i class="dfd-socicon-icon-checkmark"></i></i></span>
							<?php
							if ( $show_link ) {
								?>
								<a href="<?php echo esc_url( $this->get_step_link( $step_key ) ); ?>" class="step-name"><?php echo esc_html( $step['name'] ); ?></a>
								<?php
							} else {
								echo '<span class="step-name">'.esc_html( $step['name'] ).'</span>';
							}
							?>
						</li>
					<?php
					$i++;
					endforeach; ?>
				</ol>
			</div>
			<?php
		}

		/**
		 * Output the content for the current step
		 */
		public function setup_wizard_content() {
			isset( $this->steps[ $this->step ] ) ? call_user_func( $this->steps[ $this->step ]['view'] ) : false;
		}

		/**
		 * Introduction step
		 */
		public function envato_setup_introduction() {

			if ( $this->is_possible_upgrade() ) {
				?>
				<h1><?php printf( esc_html__( 'Welcome to the setup wizard for %s.', 'dfd-native' ), wp_get_theme() ); ?></h1>
				<p>
					<?php esc_html_e( 'It looks like you may have recently upgraded to this theme. Great! This setup wizard will help ensure all the default settings are correct. It will also show some information about your new website and support options.', 'dfd-native' ); ?>
				</p>
				<p class="envato-setup-actions step">
					<a href="<?php echo esc_url( $this->get_next_step_link() ); ?>"
					   class="button-primary button button-large button-next"><?php esc_html_e( 'Let\'s Go!', 'dfd-native' ); ?></a>
					<a href="<?php echo esc_url( wp_get_referer() && ! strpos( wp_get_referer(), 'update.php' ) ? wp_get_referer() : admin_url( '' ) ); ?>"
					   class="button button-large button-cancel"><?php esc_html_e( 'Not right now', 'dfd-native' ); ?></a>
				</p>
				<?php
			} else if ( get_option( 'envato_setup_complete', false ) ) {
				?>
				<h1><?php printf( esc_html__( 'Welcome to the setup wizard for %s.', 'dfd-native' ), wp_get_theme() ); ?></h1>
				<p><?php esc_html_e( 'It looks like you have already run the setup wizard. Below there are some options: ', 'dfd-native' ); ?></p>
				<p class="envato-setup-actions step">
					<a href="<?php echo esc_url( $this->get_next_step_link() ); ?>"
					   class="button-primary button button-next button-large"><?php esc_html_e( 'Run Setup Wizard Again', 'dfd-native' ); ?></a>
					<a href="<?php echo esc_url( wp_get_referer() && ! strpos( wp_get_referer(), 'update.php' ) ? wp_get_referer() : admin_url( '' ) ); ?>"
					   class="button button-large button-cancel"><?php esc_html_e( 'Cancel', 'dfd-native' ); ?></a>
				</p>
				<?php
			} else {
				?>
				<h1><?php printf( esc_html__( 'Welcome to the setup wizard for %s.', 'dfd-native' ), wp_get_theme() ); ?></h1>
				<p><?php printf( esc_html__( 'Thank you for choosing the %s theme from ThemeForest. This quick setup wizard will help you to configure your new website. The wizard will install the required WordPress plugins and provide you with some information about Help &amp; Support options. It will take only 5 minutes.', 'dfd-native' ), wp_get_theme() ); ?></p>
				<p><?php esc_html_e( 'Not right now? If you don\'t want to go through the wizard, you can skip and return to the WordPress dashboard. You can come back anytime if you change your mind!', 'dfd-native' ); ?></p>
				<p class="envato-setup-actions step">
					<a href="<?php echo esc_url( $this->get_next_step_link() ); ?>"
					   class="button-primary button button-large button-next"><?php esc_html_e( 'Let\'s Go!', 'dfd-native' ); ?></a>
					<a href="<?php echo esc_url( wp_get_referer() && ! strpos( wp_get_referer(), 'update.php' ) ? wp_get_referer() : admin_url( '' ) ); ?>"
					   class="button button-large button-cancel"><?php esc_html_e( 'Not right now', 'dfd-native' ); ?></a>
				</p>
				<?php
			}
		}

		public function filter_options( $options ) {
			return $options;
		}

		/**
		 *
		 * Handles save button from welcome page. This is to perform tasks when the setup wizard has already been run. E.g. reset defaults
		 *
		 * @since 1.2.5
		 */
		public function envato_setup_introduction_save() {

			check_admin_referer( 'envato-setup' );

			if ( ! empty( $_POST['reset-font-defaults'] ) && $_POST['reset-font-defaults'] == 'yes' ) {

				$file_name = get_template_directory() . '/style.custom.css';
				if ( file_exists( $file_name ) ) {
					require_once( ABSPATH . 'wp-admin/includes/file.php' );
					WP_Filesystem();
					global $wp_filesystem;
					$wp_filesystem->put_contents( $file_name, '' );
				}
				?>
				<p>
					<strong><?php esc_html_e( 'Options have been reset. Please go to Appearance > Customize in the WordPress backend.', 'dfd-native' ); ?></strong>
				</p>
				<?php
				return true;
			}

			return false;
		}


		private function _get_plugins() {
			$instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
			$plugins  = array(
				'all'      => array(), // Meaning: all plugins which still have open actions.
				'install'  => array(),
				'update'   => array(),
				'activate' => array(),
			);

			foreach ( $instance->plugins as $slug => $plugin ) {
				if ( $instance->is_plugin_active( $slug ) && false === $instance->does_plugin_have_update( $slug ) ) {
					// No need to display plugins if they are installed, up-to-date and active.
					continue;
				} else {
					$plugins['all'][ $slug ] = $plugin;

					if ( ! $instance->is_plugin_installed( $slug ) ) {
						$plugins['install'][ $slug ] = $plugin;
					} else {
						if ( false !== $instance->does_plugin_have_update( $slug ) ) {
							$plugins['update'][ $slug ] = $plugin;
						}

						if ( $instance->can_plugin_activate( $slug ) ) {
							$plugins['activate'][ $slug ] = $plugin;
						}
					}
				}
			}

			return $plugins;
		}

		/**
		 * Page setup
		 */
		public function envato_setup_default_plugins() {

			tgmpa_load_bulk_installer();
			// install plugins with TGM.
			if ( ! class_exists( 'TGM_Plugin_Activation' ) || ! isset( $GLOBALS['tgmpa'] ) ) {
				die( 'Failed to find TGM' );
			}
			$url     = wp_nonce_url( add_query_arg( array( 'plugins' => 'go' ) ), 'envato-setup' );
			$plugins = $this->_get_plugins();

			// copied from TGM

			$method = ''; // Leave blank so WP_Filesystem can populate it as necessary.
			$fields = array_keys( $_POST ); // Extra fields to pass to WP_Filesystem.

			if ( false === ( $creds = request_filesystem_credentials( esc_url_raw( $url ), $method, false, false, $fields ) ) ) {
				return true; // Stop the normal page form from displaying, credential request form will be shown.
			}

			// Now we have some credentials, setup WP_Filesystem.
			if ( ! WP_Filesystem( $creds ) ) {
				// Our credentials were no good, ask the user for them again.
				request_filesystem_credentials( esc_url_raw( $url ), $method, true, false, $fields );

				return true;
			}

			/* If we arrive here, we have the filesystem */

			?>
			<h1><?php esc_html_e( 'Default Plugins', 'dfd-native' ); ?></h1>
			<form method="post">

				<?php
				$plugins = $this->_get_plugins();
				if ( count( $plugins['all'] ) ) {
					?>
					<p><?php esc_html_e( 'Your website needs a few essential plugins. The following plugins will be installed or updated:', 'dfd-native' ); ?></p>
					<ul class="envato-wizard-plugins">
						<?php foreach ( $plugins['all'] as $slug => $plugin ) { ?>
							<li data-slug="<?php echo esc_attr( $slug ); ?>"><?php echo esc_html( $plugin['name'] ); ?>
								<span>
    								<?php
								    $keys = array();
								    if ( isset( $plugins['install'][ $slug ] ) ) {
									    $keys[] = 'Installation';
								    }
								    if ( isset( $plugins['update'][ $slug ] ) ) {
									    $keys[] = 'Update';
								    }
								    if ( isset( $plugins['activate'][ $slug ] ) ) {
									    $keys[] = 'Activation';
								    }
								    echo implode( ' and ', $keys ) . ' required';
								    ?>
    							</span>
								<div class="spinner"></div>
							</li>
						<?php } ?>
					</ul>
					<?php
				} else {
					echo '<p><strong>' . esc_html__( 'Good news! All plugins are already installed and up to date. Please continue.', 'dfd-native' ) . '</strong></p>';
				} ?>

				<p><?php esc_html_e( 'You can add or remove plugins later within WordPress dashboard.', 'dfd-native' ); ?></p>

				<p class="envato-setup-actions step">
					<a href="<?php echo esc_url( $this->get_next_step_link() ); ?>"
					   class="button-primary button button-large button-next"
					   data-callback="install_plugins"><?php esc_html_e( 'Continue', 'dfd-native' ); ?></a>
					<a href="<?php echo esc_url( $this->get_next_step_link() ); ?>"
					   class="button button-large button-secondary button-next"><?php esc_html_e( 'Skip this step', 'dfd-native' ); ?></a>
					<?php wp_nonce_field( 'envato-setup' ); ?>
				</p>
			</form>
			<?php
		}


		public function ajax_plugins() {
			if ( ! check_ajax_referer( 'envato_setup_nonce', 'wpnonce' ) || empty( $_POST['slug'] ) ) {
				wp_send_json_error( array( 'error' => 1, 'message' => esc_html__( 'No Slug Found', 'dfd-native' ) ) );
			}
			$json = array();
			// send back some json we use to hit up TGM
			$plugins = $this->_get_plugins();
			// what are we doing with this plugin?
			foreach ( $plugins['activate'] as $slug => $plugin ) {
				if ( $_POST['slug'] == $slug ) {
					$json = array(
						'url'           => admin_url( $this->tgmpa_url ),
						'plugin'        => array( $slug ),
						'tgmpa-page'    => $this->tgmpa_menu_slug,
						'plugin_status' => 'all',
						'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
						'action'        => 'tgmpa-bulk-activate',
						'action2'       => - 1,
						'message'       => esc_html__( 'Activating Plugin', 'dfd-native' ),
					);
					break;
				}
			}
			foreach ( $plugins['update'] as $slug => $plugin ) {
				if ( $_POST['slug'] == $slug ) {
					$json = array(
						'url'           => admin_url( $this->tgmpa_url ),
						'plugin'        => array( $slug ),
						'tgmpa-page'    => $this->tgmpa_menu_slug,
						'plugin_status' => 'all',
						'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
						'action'        => 'tgmpa-bulk-update',
						'action2'       => - 1,
						'message'       => esc_html__( 'Updating Plugin', 'dfd-native' ),
					);
					break;
				}
			}
			foreach ( $plugins['install'] as $slug => $plugin ) {
				if ( $_POST['slug'] == $slug ) {
					$json = array(
						'url'           => admin_url( $this->tgmpa_url ),
						'plugin'        => array( $slug ),
						'tgmpa-page'    => $this->tgmpa_menu_slug,
						'plugin_status' => 'all',
						'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
						'action'        => 'tgmpa-bulk-install',
						'action2'       => - 1,
						'message'       => esc_html__( 'Installing Plugin', 'dfd-native' ),
					);
					break;
				}
			}

			if ( $json ) {
				$json['hash'] = md5( serialize( $json ) ); // used for checking if duplicates happen, move to next plugin
				wp_send_json( $json );
			} else {
				wp_send_json( array( 'done' => 1, 'message' => esc_html__( 'Success', 'dfd-native' ) ) );
			}
			exit;

		}

		// return the difference in length between two strings
		public function cmpr_strlen( $a, $b ) {
			return strlen( $b ) - strlen( $a );
		}

		public $logs = array();

		public function log( $message ) {
			$this->logs[] = $message;
		}

		public $errors = array();

		public function error( $message ) {
			$this->logs[] = 'ERROR!!!! ' . $message;
		}

		public function envato_setup_customize() {
			?>

			<h1><?php esc_html_e('Theme Customization','dfd-native') ?></h1>
			<p>
				<?php esc_html_e('Most changes to the website can be made through the Theme options section from the WordPress dashboard. Here you can customize:','dfd-native') ?>
				
			</p>
			<ul>
				<li><?php esc_html_e('Typography: Font Sizes, Style, Weight, Line height, Letter spacing, Colors for various elements.','dfd-native') ?></li>
				<li><?php esc_html_e('Logo: Upload a new logo and adjust its size.','dfd-native') ?></li>
				<li><?php esc_html_e('Styling: Specify the colors, background, style the content','dfd-native') ?></li>
			</ul>
			<p>
				<?php esc_html_e('To change the Sidebars navigate to Appearance > Widgets. The widgets can be "drag &amp; dropped" into sidebars.','dfd-native') ?>
				<?php esc_html_e('To create the custom menu on the site, navigate to Appearance > Menus.','dfd-native') ?>
				<?php esc_html_e('You can set the menu as primary navigation in Appearance > Menus > Manage locations.','dfd-native') ?>
				<?php esc_html_e('More information and details of site customization you can find in theme documentation.','dfd-native') ?>
			</p>
			<p>
				<em><?php esc_html_e('Advanced Users: If you are going to make changes to the theme source code please use a ','dfd-native') ?>
					<a href="https://codex.wordpress.org/Child_Themes" target="_blank"><?php esc_html_e('Child Theme','dfd-native') ?></a><?php esc_html_e(' rather than','dfd-native') ?>
					<?php esc_html_e('modifying the main theme HTML/CSS/PHP code. This allows the parent theme to receive updates without','dfd-native') ?>
					<?php esc_html_e('overwriting your source code changes. See child-theme.zip in the main folder for','dfd-native') ?>
					<?php esc_html_e('a sample.','dfd-native') ?></em>
			</p>

			<p class="envato-setup-actions step">
				<a href="<?php echo esc_url( $this->get_next_step_link() ); ?>" class="button button-primary button-large button-next"><?php esc_html_e( 'Continue', 'dfd-native' ); ?></a>
			</p>

			<?php
		}

		public function envato_setup_help_support() {
			?>
			<div class="envato-setup-support-wrap">
				<h1><?php esc_html_e('Help and Support','dfd-native') ?></h1>
				<p>
					<?php esc_html_e('This theme includes 6 months item support from purchase date (with the option to extend this period).','dfd-native') ?>
					<?php esc_html_e('This license allows you to use this theme on a single website. Please purchase an additional license to use this theme on another website.','dfd-native') ?>
				</p>
				<h3><?php esc_html_e('Item Support does include:','dfd-native') ?></h3>
				<ul>
					<li><?php esc_html_e('Availability of the author to answer questions','dfd-native') ?></li>
					<li><?php esc_html_e('Answering technical questions about item features','dfd-native') ?></li>
					<li><?php esc_html_e('Assistance with reported bugs and issues','dfd-native') ?></li>
					<li><?php esc_html_e('Help with bundled 3rd party plugins','dfd-native') ?></li>
				</ul>

				<h3><?php esc_html_e('Item Support ','dfd-native') ?><span><?php esc_html_e('does not','dfd-native') ?></span><?php esc_html_e(' include:','dfd-native') ?></h3>

				<ul>
					<li><?php esc_html_e('Theme customization (this is available through ','dfd-native') ?><a
							href="http://dfd.name/services/"
							target="_blank"><?php esc_html_e('Customization services','dfd-native') ?></a>)
					</li>
					<li><?php esc_html_e('Installation services (this is available through ','dfd-native') ?><a
							href="http://dfd.name/services/"
							target="_blank"><?php esc_html_e('Customization services','dfd-native') ?></a>)
					</li>
					<li><?php esc_html_e('Help and Support for non-bundled 3rd party plugins (i.e. plugins you install by yourself)','dfd-native') ?></li>
				</ul>
				<p>
					<?php esc_html_e('More details about item support can be found in the ThemeForest ','dfd-native') ?><a
						href="http://themeforest.net/page/item_support_policy" target="_blank"><?php esc_html_e('Item Support Polity','dfd-native') ?></a>.
				</p>
				<p class="envato-setup-actions step">
					<a href="<?php echo esc_url( $this->get_next_step_link() ); ?>"
					   class="button button-primary button-large button-next"><?php esc_html_e( 'Agree and Continue','dfd-native' ); ?></a>
					<?php wp_nonce_field( 'envato-setup' ); ?>
				</p>
			</div>
			<?php
		}

		/**
		 * Final step
		 */
		public function envato_setup_ready() {

			update_option( 'envato_setup_complete', time() );
			
			$tab_index = '68';
			if(class_exists('WooCommerce')) {
				$tab_index = '73';
			}
			?>

			<h1><?php esc_html_e( 'Your Website is Ready!', 'dfd-native' ); ?></h1>

			<p>
				<?php esc_html_e('Congratulations! The theme has been activated and your website is ready. Login to your WordPress','dfd-native') ?>
				<?php esc_html_e('dashboard to make changes and modify any of the default content to suit your needs.','dfd-native') ?>
			</p>
			<div class="envato-setup-next-steps">
				<div class="envato-setup-next-steps-last">
					<h3><?php esc_html_e( 'More Resources', 'dfd-native' ); ?></h3>
					<p class="documentation">
						<a href="<?php echo esc_url($this->custom_url.'/support/') ?>" target="_blank"><?php esc_html_e( 'Read the Theme Documentation', 'dfd-native' ); ?></a>
					</p>
					<p class="howto">
						<a href="https://wordpress.org/support/" target="_blank"><?php esc_html_e( 'Learn how to use WordPress', 'dfd-native' ); ?></a>
					</p>
					<p class="support">
						<a href="<?php echo esc_url($this->custom_url.'/support/') ?>" target="_blank"><?php esc_html_e( 'Get Help and Support', 'dfd-native' ); ?></a>
					</p>
				</div>
				<div class="envato-setup-next-steps-first">
						<?php
						if(class_exists('Dfd_Theme_extensions')) {
						?>
							<a class="button button-primary button-next button-large" href="<?php echo esc_url( admin_url().'admin.php?page=native&tab='.$tab_index ); ?>"><?php esc_html_e( 'Go to demo installer', 'dfd-native' ); ?></a>
						<?php
						}
						?>
				</div>
			</div>
			<?php
		}

		/**
		 * @param $array1
		 * @param $array2
		 *
		 * @return mixed
		 *
		 *
		 * @since    1.1.4
		 */
		private function _array_merge_recursive_distinct( $array1, $array2 ) {
			$merged = $array1;
			foreach ( $array2 as $key => &$value ) {
				if ( is_array( $value ) && isset( $merged [ $key ] ) && is_array( $merged [ $key ] ) ) {
					$merged [ $key ] = $this->_array_merge_recursive_distinct( $merged [ $key ], $value );
				} else {
					$merged [ $key ] = $value;
				}
			}

			return $merged;
		}

		/**
		 * Helper function
		 * Take a path and return it clean
		 *
		 * @param string $path
		 *
		 * @since    1.1.2
		 */
		public static function cleanFilePath( $path ) {
			$path = str_replace( '', '', str_replace( array( '\\', '\\\\', '//' ), '/', $path ) );
			if ( $path[ strlen( $path ) - 1 ] === '/' ) {
				$path = rtrim( $path, '/' );
			}

			return $path;
		}

		public function is_submenu_page() {
			return ( $this->parent_slug == '' ) ? false : true;
		}
	}

}// if !class_exists

/**
 * Loads the main instance of Envato_Theme_Setup_Wizard to have
 * ability extend class functionality
 *
 * @since 1.1.1
 * @return object Envato_Theme_Setup_Wizard
 */
add_action( 'after_setup_theme', 'envato_theme_setup_wizard', 10 );
if ( ! function_exists( 'envato_theme_setup_wizard' ) ) :
	function envato_theme_setup_wizard() {
		Envato_Theme_Setup_Wizard::get_instance();
	}
endif;
