<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
	if(!defined('DFD_THEME_SETTINGS_NAME')) {
		exit;
	}
	
    $opt_name = DFD_THEME_SETTINGS_NAME;

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';
    if ( file_exists( get_template_directory() . '/inc/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

        $sampleHTML = $wp_filesystem->get_contents( get_template_directory() . '/inc/info-html.html' );
    }

    // Background Patterns Reader
	$assets_folder = get_template_directory_uri() . '/assets/';
	
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();
    
    if ( is_dir( $sample_patterns_path ) ) {

		foreach(glob($sample_patterns_path.'*') as $sample_patterns_file) {
			if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
				$name              = explode( '.', $sample_patterns_file );
				$name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
				$sample_patterns[] = array(
					'alt' => $name,
					'img' => $sample_patterns_url . $sample_patterns_file
				);
			}
		}
    }

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Theme Options', 'dfd-native' ),
        'page_title'           => esc_html__( 'Theme Options', 'dfd-native' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => 'AIzaSyAP7HLJmPCd44UnyeSwejW_G1Q9OLMFFMg',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => false,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => 'dfd_'.DFD_THEME_SETTINGS_NAME,
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
//        'forced_dev_mode_off'  => true,
        // Disables force dev mode for localhost
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => DFD_THEME_SETTINGS_NAME,
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.
        'allow_tracking'   => false,
        // Disable tracking

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
        'system_info'             => true,

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'left',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'dark',
                'shadow'  => false,
                'rounded' => false,
                'style'   => 'tipsy',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        ),
		'ajax_save' => false,
    );

    // Panel Intro text -> before the form
	if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
		if ( ! empty( $args['global_variable'] ) ) {
			$v = $args['global_variable'];
		} else {
			$v = str_replace( '-', '_', $args['opt_name'] );
		}
		$args['intro_text'] = '<p>'.sprintf( esc_html__( 'Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: ', 'dfd-native' ).'<strong>$%1$s</strong></p>', $v );
	} else {
		$args['intro_text'] = '<p>'.esc_html__( 'This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.', 'dfd-native' ).'</p>';
	}

    // Add content after the form.
    $args['footer_text'] = '';

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
//        array(
//            'id'      => 'redux-help-tab-1',
//            'title'   => esc_html__( 'Theme Information 1', 'dfd-native' ),
//            'content' => '<p>'.esc_html__( 'This is the tab content, HTML is allowed.', 'dfd-native' ).'</p>'
//        ),
//        array(
//            'id'      => 'redux-help-tab-2',
//            'title'   => esc_html__( 'Theme Information 2', 'dfd-native' ),
//            'content' => '<p>'.esc_html__( 'This is the tab content, HTML is allowed.', 'dfd-native' ).'</p>'
//        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = '';//'<p>'.esc_html__( 'This is the sidebar content, HTML is allowed.', 'dfd-native' ).'</p>';
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */
	
	$main_options = array(
		array(
			'id' => 'main_options_info_content',
			'type' => 'info',
			'desc' => '<h3 class="description">'.esc_html__('Main options', 'dfd-native').'</h3>'
		),
		array(
			'id' => 'scroll_animation',
			'type' => 'button_set',
			'title' => esc_html__('Page scroll animation', 'dfd-native'),
			'options' => array('on' => 'On', 'off' => 'Off'),
			'default' => 'on',
			'hint' => array(
				'title'   => esc_attr__('Smooth page scroll','dfd-native'),
				'content' => esc_attr__('Enable the page scroll animation to have the smooth scroll','dfd-native')
			)
		),
		array(
			'id' => 'enqueue_styles_file',
			'type' => 'button_set',
			'title' => esc_html__('Generate dynamic styles file', 'dfd-native'),
			'options' => array('on' => esc_html__('On','dfd-native'), 'off' => esc_html__('Off','dfd-native')),
			'default' => 'off',
			'hint' => array(
				'title'   => esc_attr__('Dynamic styles file','dfd-native'),
				'content' => esc_attr__('This option allows you to enqueue dynamic styles from file. These styles are enqueued in HEAD tag by default. This option allows you to enable browser and server cache for that file and increase site performance','dfd-native')
			)
		),
		array(
			'id' => 'mobile_responsive',
			'type' => 'button_set',
			'title' => esc_html__('Mobile responsive', 'dfd-native'),
			'options' => array('1' => esc_html__('On', 'dfd-native'), '0' => esc_html__('Off', 'dfd-native')),
			'default' => '1',
			'hint' => array(
				'title'   => esc_attr__('Mobile responsive','dfd-native'),
				'content' => esc_attr__('Allows you to enable or disable the responsiveness for the mobile devices','dfd-native')
			)
		),
		array(
			'id' => 'enable_default_modules',
			'type' => 'button_set',
			'title' => esc_html__('Default Visual Composer modules', 'dfd-native'),
			'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
			'default' => 'off',
			'hint' => array(
				'title'   => esc_attr__('Default VC Modules','dfd-native'),
				'content' => esc_attr__('Allows you to enable or disable default modules for the Visual Composer','dfd-native')
			)
		),
		array(
			'id' => 'enable_images_lazy_load',
			'type' => 'button_set',
			'title' => esc_html__('Enable images lazy load', 'dfd-native'),
			'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
			'default' => 'on',
			'hint' => array(
				'title'   => esc_attr__('Images lazy load','dfd-native'),
				'content' => esc_attr__('This option allows you to enable lazy load feature for blog, portfolio and gallery to increase your site speed.','dfd-native')
			)
		),
		array(
			'id' => 'lazy_load_offset',
			'type' => 'slider',
			'title' => esc_html__('Lazy images load offset', 'dfd-native'),
			'desc' => '',
			'min' => '50',
			'max' => '200',
			'step' => '1',
			'default' => '140',
			'required' => array( 'enable_images_lazy_load', "=", 'on' ),
			'hint' => array(
				'title'   => esc_attr__('Lazy images load offset','dfd-native'),
				'content' => esc_attr__('This option allows you to define the offset from the current viewport to start images loading in %. 100% means that images will start loading from the bottom of viewport, 150% means that images will start loading half of viewport below the current page screen position.','dfd-native')
			)
		),
		array(
			'id' => 'appear_effect_offset',
			'type' => 'slider',
			'title' => esc_html__('Appear effect offset', 'dfd-native'),
			'min' => '50',
			'max' => '200',
			'step' => '1',
			'default' => '98',
//			'hint' => array(
//				'title'   => esc_attr__('Lazy images load offset','dfd-native'),
//				'content' => esc_attr__('This option allows you to define the offset from the current viewport to start images loading in %. 100% means that images will start loading from the bottom of viewport, 150% means that images will start loading half of viewport below the current page screen position.','dfd-native')
//			)
		),
		array(
			'id' => 'custom_google_api_key',
			'type' => 'text',
			'title' => esc_html__('Custom Google API key', 'dfd-native'),
			'default' => '',
			'desc' => esc_html__('To create your Google API key, please see the ','dfd-native').'<a href="https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key" target="_blank">'.esc_html__('official documentation','dfd-native').'</a>' .esc_html__(' for more information','dfd-native'),
			'hint' => array(
				'title'   => esc_attr__('Google API key','dfd-native'),
				'content' => esc_attr__('Allows you to add custom Google API key which will be used for the Google map','dfd-native')
			)
		),
		array(
			'id' => 'main_logos_options_info_content',
			'type' => 'info',
			'desc' => '<h3 class="description">'.esc_html__('Logos', 'dfd-native').'</h3>'
		),
		array(
			'id' => 'custom_favicon',
			'type' => 'media',
			'title' => esc_html__('Favicon', 'dfd-native'),
			'default' => array(
					'url' => $assets_folder . 'img/favicon/favicon.ico'
				),
			'hint' => array(
				'title'   => esc_attr__('Favicon','dfd-native'),
				'content' => esc_attr__('Select a 16px X 16px image from the media library and upload it as a favicon of your site','dfd-native')
			)
		),
		array(
			'id' => 'custom_logo_image',
			'type' => 'media',
			'title' => esc_html__('Header main logotype image', 'dfd-native'),
			'default' => array(
					'url' => $assets_folder . 'img/logo.png'
				),
			'hint' => array(
				'title'   => esc_attr__('Main logotype','dfd-native'),
				'content' => esc_attr__('Select an image from the media library and upload it as header main logotype. You can also define logo for each header styles in Header style options, logo for mobile and sticky header in Mobile and Sticky header options sections.','dfd-native')
			)
		),
		array(
			'id' => 'custom_retina_logo_image',
			'type' => 'media',
			'title' => esc_html__('Header main logotype image for retina', 'dfd-native'),
			'default' => array(
					'url' => $assets_folder . 'img/logo_retina.png'
				),
			'hint' => array(
				'title'   => esc_attr__('Main retina logotype','dfd-native'),
				'content' => esc_attr__('Select 2x the size of your main logo from the media library and upload it as header main logotype for retina. You can also define logo for each header styles in Header style options, logo for mobile and sticky header in Mobile and Sticky header options sections.','dfd-native')
			)
		),
		array(
			'id' => 'dev_mode_options_info_content',
			'type' => 'info',
			'desc' => '<h3 class="description">'.esc_html__('Developer settings', 'dfd-native').'</h3>'
		),
		array(
			'id' => 'dfd_htaccess_rewrite',
			'type' => 'button_set',
			'title' => esc_html__('Write expire headers for content types. Use with caution', 'dfd-native'),
			'hint' => array(
				'title'   => esc_attr__('Add expire headers to .htaccess','dfd-native'),
				'content' => esc_attr__('Please make sure that your hosting is using Apache server. Using of this option in non-proper way can cause server error.','dfd-native')
			),
			'desc' => '',
			'options' => array('on' => esc_html__('On','dfd-native'), 'off' => esc_html__('Off','dfd-native')),
			'default' => 'off'
		),
	);
	
	if(defined('DFD_DEBUG_MODE') && DFD_DEBUG_MODE) {
		$main_options[] = array(
			'id' => 'dev_mode',
			'type' => 'button_set',
			'title' => esc_html__('Enable DEV mode', 'dfd-native'),
			'desc' => '',
			'options' => array('on' => esc_html__('On','dfd-native'), 'off' => esc_html__('Off','dfd-native')),
			'default' => 'off'
		);
	}
	
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('General options', 'dfd-native'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'dashicons dashicons-admin-generic',
		//Lets leave this as a blank section, no options just some intro text set above.
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Main settings', 'dfd-native'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'dashicons dashicons-admin-generic',
		'subsection' => true,
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => $main_options
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Layouts settings', 'dfd-native'),
		'icon' => 'dashicons dashicons-grid-view',
		'subsection' => true,
		'fields' => array(
			array(
				'id' => 'page_stun_header',
				'type' => 'button_set',
				'title' => esc_html__('Custom header', 'dfd-native'),
				'options' => array('on' => esc_html__('On','dfd-native'), 'off' => esc_html__('Off','dfd-native')),
				'default' => 'on',
				'hint' => array(
                    'title'   => esc_attr__('For page builder page Custom header','dfd-native'),
                    'content' => esc_attr__('This option enables custom header by default for For page builder page template. There is also an option on the item\'s page if you need to disable or enable custom header for one single item','dfd-native')
                )
			),
			array(
				'id' => 'page_layout_width',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Default page layout width', 'dfd-native'),
				'options' => Dfd_Theme_Helpers::dfd_layout_width(),
				'default' => 'full-width',
				'hint' => array(
                    'title'   => esc_attr__('Layout width','dfd-native'),
                    'content' => esc_attr__('This option defines the content width for "default" and "for page builder" page templates','dfd-native')
                )
			),
			array(
				'id' => 'lazy_load_pagination_image',
				'type' => 'media',
				'title' => esc_html__('Lazy load pagination image', 'dfd-native'),
				'desc' => '',
				'default' => array(
						'url' => $assets_folder . 'img/lazy_load.gif'
					),
				'hint' => array(
                    'title'   => esc_attr__('Lazy load image','dfd-native'),
                    'content' => esc_attr__('This option allows you to add the image for the lazy load pagination','dfd-native')
                )
			),
			array(
				'id' => 'pages_layout',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Single pages layout', 'dfd-native'),
				'sub_desc' => esc_html__('Select one of the layout types for single pages', 'dfd-native'),
				'options' => Dfd_Theme_Helpers::dfd_page_layouts(),
				'default' => '1col-fixed',
				'hint' => array(
                    'title'   => esc_attr__('Single layout','dfd-native'),
                    'content' => esc_attr__('Select one of the layout types which will be set as default for all the single pages. There is also an option on the item\'s page if you need to change the layout for the single page','dfd-native')
                )
			),
			array(
				'id' => 'pages_head_type',
				'type' => 'select',
				'title' => esc_html__('Single pages header', 'dfd-native'),
				'options' => Dfd_Theme_Helpers::dfd_headers_type(),
				'add_builder_styles'=>true,
				'default' => '1',
				'hint' => array(
                    'title'   => esc_attr__('Single header','dfd-native'),
                    'content' => esc_attr__('Select the header type which will be set as default for all the single pages. There is also an option on the item\'s page if you need to change the header style for the single page','dfd-native')
                )
			),
			array(
				'id' => 'archive_layout',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Archive pages layout', 'dfd-native'),
				'sub_desc' => esc_html__('Select one of the layout types for archive pages', 'dfd-native'),
				'options' => Dfd_Theme_Helpers::dfd_page_layouts(),
				'default' => '2c-r-fixed',
				'hint' => array(
                    'title'   => esc_attr__('Archive layout','dfd-native'),
                    'content' => esc_attr__('Select one of the layout types which will be set as default for all the archive pages','dfd-native')
                )
			),
			array(
				'id' => 'archive_head_type',
				'type' => 'select',
				'title' => esc_html__('Archive pages header', 'dfd-native'),
				'options' => Dfd_Theme_Helpers::dfd_headers_type(),
				'add_builder_styles'=>true,
				'default' => '1',
				'hint' => array(
                    'title'   => esc_attr__('Archive header','dfd-native'),
                    'content' => esc_attr__('Select the header type which will be set as default for all the archive pages','dfd-native')
                )
			),
			array(
				'id' => 'single_layout',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Single posts layout', 'dfd-native'),
				'sub_desc' => esc_html__('Select one of the layout types for single posts', 'dfd-native'),
				'options' => Dfd_Theme_Helpers::dfd_page_layouts(),
				'default' => '1col-fixed',
				'hint' => array(
                    'title'   => esc_attr__('Post layout','dfd-native'),
                    'content' => esc_attr__('Select one of the layout types which will be set as default for all the single posts. There is also an option on the item\'s page if you need to change the layout for the single post','dfd-native')
                )
			),
			array(
				'id' => 'single_head_type',
				'type' => 'select',
				'title' => esc_html__('Single posts header', 'dfd-native'),
				'options' => Dfd_Theme_Helpers::dfd_headers_type(),
				'add_builder_styles'=>true,
				'default' => '1',
				'hint' => array(
                    'title'   => esc_attr__('Post header','dfd-native'),
                    'content' => esc_attr__('Select the header type which will be set as default for all the single posts. There is also an option on the item\'s page if you need to change the header style for the single post','dfd-native')
                )
			),
			array(
				'id' => 'search_layout',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Search results layout', 'dfd-native'),
				'sub_desc' => esc_html__('Select one of the layout types for search results', 'dfd-native'),
				'options' => Dfd_Theme_Helpers::dfd_page_layouts(),
				'default' => '1col-fixed',
				'hint' => array(
                    'title'   => esc_attr__('Search layout','dfd-native'),
                    'content' => esc_attr__('Select one of the layout types which will be set as default for the search results page','dfd-native')
                )
			),
			array(
				'id' => 'search_head_type',
				'type' => 'select',
				'title' => esc_html__('Search results header', 'dfd-native'),
				'options' => Dfd_Theme_Helpers::dfd_headers_type(),
				'add_builder_styles'=>true,
				'default' => '1',
				'hint' => array(
                    'title'   => esc_attr__('Search header','dfd-native'),
                    'content' => esc_attr__('Select the header type which will be set as default for the search results page','dfd-native')
                )
			),
			array(
				'id' => '404_layout',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('404 page layout', 'dfd-native'),
				'sub_desc' => esc_html__('Select one of layouts for 404 page', 'dfd-native'),
				'options' => Dfd_Theme_Helpers::dfd_page_layouts(),
				'default' => '1col-fixed',
				'hint' => array(
                    'title'   => esc_attr__('404 layout','dfd-native'),
                    'content' => esc_attr__('Select one of the layout types which will be set as default for the 404 page','dfd-native')
                )
			),
			array(
				'id' => '404_head_type',
				'type' => 'select',
				'title' => esc_html__('404 page header', 'dfd-native'),
				'options' => Dfd_Theme_Helpers::dfd_headers_type(),
				'add_builder_styles'=>true,
				'default' => '1',
				'hint' => array(
                    'title'   => esc_attr__('404 header','dfd-native'),
                    'content' => esc_attr__('Select the header type which will be set as default for the 404 page','dfd-native')
                )
			),
			array(
				'id' => 'layout_whitespace_size',
				'type' => 'slider',
				'title' => esc_html__('Layout frame size', 'dfd-native'),
				'desc' => '',
				'min' => '0',
				'max' => '50',
				'step' => '1',
				'default' => '30',
				'hint' => array(
                    'title'   => esc_attr__('Layout frame','dfd-native'),
                    'content' => esc_attr__('Set the size for the frame around the page','dfd-native')
                )
			),
			array(
				'id' => 'layout_whitespace_color',
				'type' => 'color',
				'validate' => 'color',
				'title' => esc_html__('Layout frame color', 'dfd-native'),
				'default' => '#ffffff',
				'hint' => array(
                    'title'   => esc_attr__('Frame color','dfd-native'),
                    'content' => esc_attr__('Select the color for the layout frame','dfd-native')
                )
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Site preloader options', 'dfd-native'),
		'icon' => 'dashicons dashicons-image-filter',
		'subsection' => true,
		'fields' => array(
			array(
				'id' => 'site_preloader_enabled',
				'type' => 'button_set',
				'title' => esc_html__('Site preloader', 'dfd-native'),
				'options' => array('1' => 'On', 'off' => 'Off'),
				'default' => 'off',
				'hint' => array(
                    'title'   => esc_attr__('Preloader','dfd-native'),
                    'content' => esc_attr__('This option allows you to enable or disable the preloader for the site. When enabled the visitor will first see the preloader and then fully loaded page','dfd-native')
                )
			),
			array(
				'id' => 'preloader_percentage',
				'type' => 'button_set',
				'title' => esc_html__('Preloader percentage', 'dfd-native'),
				'options' => array('1' => esc_html__('On','dfd-native'), '0' => esc_html__('Off','dfd-native')),
				'default' => '0',
				'required' => array( 'site_preloader_enabled', "=", '1' ),
				'hint' => array(
                    'title'   => esc_attr__('Percentage','dfd-native'),
                    'content' => esc_attr__('This option allows you to enable or disable preloader percentage counter','dfd-native')
                )
			),
			array(
				'id'          => 'preloader_percentage_typography',
				'type'        => 'typography',
				'title'       => esc_html__( 'Preloader Counter Typography', 'dfd-native' ),
				'google'      => true,
				'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
				'subsets'       => true, // Only appears if google is true and subsets not set to false
				'font-size'     => true,
				'text-align'	=> false,
				'line-height'   => true,
				'word-spacing'  => false,  // Defaults to false
				'letter-spacing'=> true,  // Defaults to false
				'text-transform'=> true,
				'color'         => true,
				'preview'       => false, // Disable the previewer
				'all_styles'  => true,
				'units'       => 'px',
				'subtitle'    => esc_html__( 'Typography option with each property can be called individually.', 'dfd-native' ),
				'default'     => array(
					'font-style'  => 'normal',
					'font-weight'  => '700',
					'font-family' => 'Montserrat',
					'google'      => true,
					'font-size'   => '45px',
					'line-height' => '55px',
					'text-transform'=> 'uppercase',
					'letter-spacing'=> '2px',
					'color'	=> '#ffffff',
				),
				'required' => array( 'preloader_percentage', "=", '1' ),
			),
			array(
				'id' => 'preloader_background',
				'type' => 'background',
				'title' => esc_html__('Preloader background', 'dfd-native'),
				'desc' => '',
				'required' => array( 'site_preloader_enabled', "=", '1' ),
				'hint' => array(
                    'title'   => esc_attr__('Percentage','dfd-native'),
                    'content' => esc_attr__('This option allows you to add the background for the preloader and apply the image settings','dfd-native')
                )
			),
			array(
				'id' => 'preloader_style',
				'type' => 'radio',
				'title' => esc_html__('Preloader style', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'' => esc_html__('None', 'dfd-native'),
					'css_animation' => esc_html__('CSS animation', 'dfd-native'),
					'image' => esc_html__('Image', 'dfd-native'),
					'progress_bar' => esc_html__('Progress bar', 'dfd-native'),
				),
				'default' => '',
				'required' => array( 'site_preloader_enabled', "=", '1' ),
				'hint' => array(
                    'title'   => esc_attr__('Style','dfd-native'),
                    'content' => esc_attr__('This option allows you to choose one of the preset preloader styles','dfd-native')
                )
			),
			array(
				'id' => 'css_animation_style',
				'type' => 'select',
				'title' => esc_html__('Animation style', 'dfd-native'),
				'desc' => '',
				'options' => Dfd_Theme_Helpers::dfd_preloader_animation_style(),
				'default' => '',
				'required' => array( 'preloader_style', "=", 'css_animation' ),
				'hint' => array(
                    'title'   => esc_attr__('Animation style','dfd-native'),
                    'content' => esc_attr__('Select among 16 preset CSS animation styles','dfd-native')
                )
			),
			array(
				'id' => 'preoader_animation_color',
				'type' => 'color',
				'title' => esc_html__('Animation base color', 'dfd-native'),
				'default' => '',
				'validate' => 'color',
				'required' => array( 'preloader_style', "=", 'css_animation' ),
				'hint' => array(
                    'title'   => esc_attr__('Animation color','dfd-native'),
                    'content' => esc_attr__('Ths option allows you to choose the base color for the CSS animation','dfd-native')
                )
			),
			array(
				'id' => 'preloader_image',
				'type' => 'media',
				'title' => esc_html__('Preloader image', 'dfd-native'),
				'desc' => esc_html__('Select an image for preloader', 'dfd-native'),
				'default' => array(
						'url' => $assets_folder . 'img/logo.png'
					),
				'required' => array( 'preloader_style', "=", 'image' ),
				'hint' => array(
                    'title'   => esc_attr__('Image','dfd-native'),
                    'content' => esc_attr__('Ths option allows you to set custom image for the preloader','dfd-native')
                )
			),
			array(
				'id' => 'preloader_bar_bg',
				'type' => 'color',
				'title' => esc_html__('Progress bar background color', 'dfd-native'),
				'default' => '',
				'validate' => 'color',
				'required' => array( 'preloader_style', "=", 'progress_bar' ),
				'hint' => array(
                    'title'   => esc_attr__('Progress bar background','dfd-native'),
                    'content' => esc_attr__('Ths option allows you to set the color for the loading progress','dfd-native')
                )
			),
			array(
				'id' => 'preloader_bar_position',
				'type' => 'radio',
				'title' => esc_html__('Progress bar position', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'middle' => esc_html__('Middle', 'dfd-native'),
					'top' => esc_html__('Top', 'dfd-native'),
					'bottom' => esc_html__('Bottom', 'dfd-native'),
				),
				'default' => 'middle',
				'required' => array( 'preloader_style', "=", 'progress_bar' ),
				'hint' => array(
                    'title'   => esc_attr__('Progress bar position','dfd-native'),
                    'content' => esc_attr__('Ths option allows you to align the loading progress vertically','dfd-native')
                )
			),
			array(
				'id' => 'preloader_bar_height',
				'type' => 'text',
				'title' => esc_html__('Preloader bar height (in px)', 'dfd-native'),
				'default' => esc_html__('Full screen by default', 'dfd-native'),
				'validate' => 'numeric',
				'default' => '',
				'required' => array( 'preloader_style', "=", 'progress_bar' ),
				'hint' => array(
                    'title'   => esc_attr__('Progress bar height','dfd-native'),
                    'content' => esc_attr__('Ths option allows you adjust the height for the loding progress. The value should be set in px, don\'t include "px"','dfd-native')
                )
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Default button options', 'dfd-native'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'dashicons dashicons-admin-links',
		'subsection' => true,
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id'          => 'default_button_typography_option',
				'type'        => 'typography',
				'title'       => esc_html__( 'Default button typography', 'dfd-native' ),
				//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
				'google'      => true,
				// Disable google fonts. Won't work if you haven't defined your google api key
				//'font-backup' => true,
				// Select a backup non-google font in addition to a google font
				'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
				'subsets'       => true, // Only appears if google is true and subsets not set to false
				'font-size'     => true,
				'text-align'	=> false,
				'line-height'   => true,
				'word-spacing'  => false,  // Defaults to false
				'letter-spacing'=> true,  // Defaults to false
				'text-transform'=> true,
				'color'         => true,
				'preview'       => false, // Disable the previewer
				'all_styles'  => true,
				// Enable all Google Font style/weight variations to be added to the page
				//'output'      => array( 'h2.site-description, .entry-title' ),
				// An array of CSS selectors to apply this font style to dynamically
				//'compiler'    => array( 'h2.site-description-compiler' ),
				// An array of CSS selectors to apply this font style to dynamically
				'units'       => 'px',
				// Defaults to px
				'default'     => array(
					'font-style'  => 'normal',
					'font-weight'  => '700',
					'font-family' => 'Montserrat',
					'google'      => true,
					'font-size'   => '11px',
					'line-height' => '43px',
					'text-transform'=> 'uppercase',
					'letter-spacing'=> '.8px',
					'color'	=> '#ffffff',
				),
				'hint' => array(
                    'title'   => esc_attr__('Button typography','dfd-native'),
                    'content' => esc_attr__('Allows you to set the font family and styling for all the default buttons. Typography option with each property can be called individually','dfd-native')
                )
			),
			array(
				'id' => 'default_button_background',
				'type' => 'color',
				'title' => esc_html__('Default button background color', 'dfd-native'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
				'hint' => array(
                    'title'   => esc_attr__('Button background','dfd-native'),
                    'content' => esc_attr__('This option allows you to set the background color for all the default buttons','dfd-native')
                )
			),
			array(
				'id' => 'default_button_border',
				'type' => 'color',
				'title' => esc_html__('Default button border color', 'dfd-native'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
				'hint' => array(
                    'title'   => esc_attr__('Button border color','dfd-native'),
                    'content' => esc_attr__('This option allows you to set the border color for all the default buttons','dfd-native')
                )
			),
			array(
				'id' => 'default_button_hover_color',
				'type' => 'color',
				'title' => esc_html__('Default button hover text color', 'dfd-native'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
				'hint' => array(
                    'title'   => esc_attr__('Button text hover','dfd-native'),
                    'content' => esc_attr__('This option allows you to set the text hover color for all the default buttons','dfd-native')
                )
			),
			array(
				'id' => 'default_button_hover_bg',
				'type' => 'color',
				'title' => esc_html__('Default button hover background color', 'dfd-native'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
				'hint' => array(
                    'title'   => esc_attr__('Button background hover','dfd-native'),
                    'content' => esc_attr__('This option allows you to set the button background hover color for all the default buttons','dfd-native')
                )
			),
			array(
				'id' => 'default_button_hover_border',
				'type' => 'color',
				'title' => esc_html__('Default button border color on hover', 'dfd-native'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
				'hint' => array(
                    'title'   => esc_attr__('Button border hover color','dfd-native'),
                    'content' => esc_attr__('This option allows you to set the button border hover color for all the default buttons','dfd-native')
                )
			),
			array(
				'id'       => 'default_button_border_width',
				'type'     => 'text',
				'title'    => esc_html__( 'Default button border width', 'dfd-native' ),
				'desc'     => '',
				'validate' => 'numeric',
				'default'  => '0',
				'hint' => array(
                    'title'   => esc_attr__('Border width','dfd-native'),
                    'content' => esc_attr__('This option allows you to set the button border width for all the default buttons. The width should be added in px, don\'t include "px"','dfd-native')
                )
			),
			array(
				'id' => 'default_button_border_style',
				'type' => 'radio',
				'title' => esc_html__('Default button border style', 'dfd-native'),
				'options' => array(
					'solid' => esc_html__('Solid', 'dfd-native'),
					'dashed' => esc_html__('Dashed', 'dfd-native'),
					'dotted' => esc_html__('Dotted', 'dfd-native'),
				),
				'default' => 'solid',
				'hint' => array(
                    'title'   => esc_attr__('Border width','dfd-native'),
                    'content' => esc_attr__('This option allows you to set the button border style for all the default buttons','dfd-native')
                )
			),
			array(
				'id'       => 'default_button_border_radius',
				'type'     => 'text',
				'title'    => esc_html__( 'Default button border radius', 'dfd-native' ),
				'desc'     => '',
				'validate' => 'numeric',
				'default'  => 43,
				'hint' => array(
                    'title'   => esc_attr__('Border radius','dfd-native'),
                    'content' => esc_attr__('This option allows you to set the button border radius for all the default buttons','dfd-native')
                )
			),
			array(
				'id'       => 'default_button_padding_left',
				'type'     => 'text',
				'title'    => esc_html__( 'Default button left padding', 'dfd-native' ),
				'desc'     => '',
				'validate' => 'numeric',
				'default'  => 30,
				'hint' => array(
                    'title'   => esc_attr__('Button left padding','dfd-native'),
                    'content' => esc_attr__('This option allows you to set the left padding to the button text, will be aplied for all the default buttons. The padding should be added in px, don\'t include "px"','dfd-native')
                )
			),
			array(
				'id'       => 'default_button_padding_right',
				'type'     => 'text',
				'title'    => esc_html__( 'Default button right padding', 'dfd-native' ),
				'desc'     => '',
				'validate' => 'numeric',
				'default'  => 30,
				'hint' => array(
                    'title'   => esc_attr__('Button right adding','dfd-native'),
                    'content' => esc_attr__('This option allows you to set the left padding to the button text, will be aplied for all the default buttons. The padding should be added in px, don\'t include "px"','dfd-native')
                )
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Back to top options', 'dfd-native'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'dashicons dashicons-admin-links',
		'subsection' => true,
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'btt_switch',
				'type' => 'button_set',
				'options' => array('on' => 'On', 'off' => 'Off'),
				'default' => 'off',
				'title' => esc_html__('Custom settings', 'dfd-native'),
				'hint' => array(
					'title' => esc_attr__('Custom settings', 'dfd-native'),
					'content' => esc_attr__('This options allows you to enable or disable the custom settings for the back to top button', 'dfd-native'),
				)
			),
			array(
				'id' => 'btt_button_options',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Button options', 'dfd-native').'</h3>',
				'required' => array('btt_switch', "=", 'on'),
			),
			array(
				'id' => 'btt_button_background',
				'type' => 'color',
				'title' => esc_html__('Background color', 'dfd-native'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
				'required' => array('btt_switch', "=", 'on'),
				'hint' => array(
                    'title'   => esc_attr__('Button background','dfd-native'),
                    'content' => esc_attr__('This option allows you to set the background color for the back to top button','dfd-native')
                )
			),
			array(
				'id' => 'btt_button_border',
				'type' => 'color',
				'title' => esc_html__('Border color', 'dfd-native'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
				'required' => array('btt_switch', "=", 'on'),
				'hint' => array(
                    'title'   => esc_attr__('Button border','dfd-native'),
                    'content' => esc_attr__('This option allows you to set the border color for the back to top button','dfd-native')
                )
			),
			array(
				'id' => 'btt_button_hover_bg',
				'type' => 'color',
				'title' => esc_html__('Background hover color', 'dfd-native'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
				'required' => array('btt_switch', "=", 'on'),
				'hint' => array(
                    'title'   => esc_attr__('Background hover color','dfd-native'),
                    'content' => esc_attr__('This option allows you to set the background hover color for back to top button','dfd-native')
                )
			),
			array(
				'id' => 'btt_button_hover_border',
				'type' => 'color',
				'title' => esc_html__('Border hover color', 'dfd-native'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
				'required' => array('btt_switch', "=", 'on'),
				'hint' => array(
                    'title'   => esc_attr__('Border hover color','dfd-native'),
                    'content' => esc_attr__('This option allows you to set the border hover color for the back to top button','dfd-native')
                )
			),
			array(
				'id'       => 'btt_button_border_width',
				'type'     => 'text',
				'title'    => esc_html__( 'Border width', 'dfd-native' ),
				'desc'     => '',
				'validate' => 'numeric',
				'default'  => '0',
				'required' => array('btt_switch', "=", 'on'),
				'hint' => array(
                    'title'   => esc_attr__('Border width','dfd-native'),
                    'content' => esc_attr__('This option allows you to set the border width for the back to top button. The width should be added in px, don\'t include "px"','dfd-native')
                )
			),
			array(
				'id' => 'btt_button_border_style',
				'type' => 'radio',
				'title' => esc_html__('Border style', 'dfd-native'),
				'options' => array(
					'solid' => esc_html__('Solid', 'dfd-native'),
					'dashed' => esc_html__('Dashed', 'dfd-native'),
					'dotted' => esc_html__('Dotted', 'dfd-native'),
				),
				'default' => 'solid',
				'required' => array('btt_switch', "=", 'on'),
				'hint' => array(
                    'title'   => esc_attr__('Border style','dfd-native'),
                    'content' => esc_attr__('This option allows you to set the border style for the back to top button, choose between 3 preset styles','dfd-native')
                )
			),
			array(
				'id'       => 'btt_button_border_radius',
				'type'     => 'text',
				'title'    => esc_html__( 'Border radius', 'dfd-native' ),
				'desc'     => '',
				'validate' => 'numeric',
				'default'  => 43,
				'required' => array('btt_switch', "=", 'on'),
				'hint' => array(
                    'title'   => esc_attr__('Border radius','dfd-native'),
                    'content' => esc_attr__('This option allows you to set the border radius for the back to top button. The radius should be added in %, don/t include "%"','dfd-native')
                )
			),
			array (
				'id' => 'btt_button_size',
				'type' => 'slider',
				'title' => esc_html__('Button size', 'dfd-native'),
				'min'	   => '42',
				'max'	   => '80',
				'step'	   => '1',
				'default'  => '42',
				'required' => array('btt_switch', "=", 'on'),
				'hint' => array(
					'title' => esc_attr__('Button size', 'dfd-native'),
					'content' => esc_attr__('This option allows you to specify the button\'s size in px', 'dfd-native')
				)
			),
			array(
				'id' => 'btt_disable_shadow',
				'type' => 'button_set',
				'options' => array('on' => 'On', 'off' => 'Off'),
				'default' => 'on',
				'title' => esc_html__('Shadow on hover', 'dfd-native'),
				'required' => array('btt_switch', "=", 'on'),
				'hint' => array(
					'title' => esc_attr__('Shadow on hover', 'dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable the shadow for the back to top button', 'dfd-native'),
				)
			),
			array(
				'id' => 'btt_show_mobile',
				'type' => 'button_set',
				'options' => array('on' => 'On', 'off' => 'Off'),
				'default' => 'off',
				'title' => esc_html__('Enable on Mobile', 'dfd-native'),
				'required' => array('btt_switch', "=", 'on'),
				'hint' => array(
					'title' => esc_attr__('Enable on Mobile', 'dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the back to top button on mobile devices', 'dfd-native'),
				)
			),
			array (
				'id' => 'btt_button_mobile_size',
				'type' => 'slider',
				'title' => esc_html__('Button size on mobiles', 'dfd-native'),
				'min'	   => '10',
				'max'	   => '42',
				'step'	   => '1',
				'default'  => '42',
				'required' => array('btt_show_mobile', "=", 'on'),
				'hint' => array(
					'title' => esc_attr__('Mobile button size', 'dfd-native'),
					'content' => esc_attr__('This options allow you to specify the size of the back to top button only for mobile devices', 'dfd-native')
				)
			),
			array(
				'id' => 'btt_button_icon_options',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Icon options', 'dfd-native').'</h3>',
				'required' => array('btt_switch', "=", 'on'),
			),
			array(
				'id'	=> 'btt_button_select_icon',
				'type'	=> 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title'  => esc_html__( 'Select icon', 'dfd-native' ),
				'options' => array(
				   'dfd-socicon-caret-arrow-up' => array(
						'img' => get_template_directory_uri().'/assets/admin/img/back-to-top.png'
				   ),
				   'dfd-socicon-up-arrow' => array(
						'img' => get_template_directory_uri().'/assets/admin/img/back-to-top.png'
				   ),
				   'dfd-socicon-chevron-up' => array(
						'img' => get_template_directory_uri().'/assets/admin/img/back-to-top.png'
				   ),
				   'dfd-socicon-arrow-up' => array(
						'img' => get_template_directory_uri().'/assets/admin/img/back-to-top.png'
				   ),
				   'dfd-socicon-arrow-up2' => array(
						'img' => get_template_directory_uri().'/assets/admin/img/back-to-top.png'
				   ),
					'dfd-socicon-chevron-arrow-up' => array(
						'img' => get_template_directory_uri().'/assets/admin/img/back-to-top.png'
				   ),
				),
				'default' => 'dfd-socicon-chevron-arrow-up',
				'required' => array('btt_switch', "=", 'on'),
				'hint' => array(
                    'title'   => esc_attr__('Select icon','dfd-native'),
                    'content' => esc_attr__('This option allows you to select one of the preset icons for the back to top button','dfd-native')
				)
			),
			array(
				'id'       => 'btt_button_icon_size',
				'type'     => 'slider',
				'title'    => esc_html__( 'Icon size', 'dfd-native' ),
				'min'	   => '9',
				'max'	   => '25',
				'step'	   => '1',
				'default'  => '9',
				'required' => array('btt_switch', "=", 'on'),
				'hint' => array(
                    'title'   => esc_attr__('Icon size','dfd-native'),
                    'content' => esc_attr__('This option allows you to specify the icons size for the back to top button ','dfd-native')
                )
			),
			array(
				'id'       => 'btt_button_icon_mobile_size',
				'type'     => 'slider',
				'title'    => esc_html__( 'Icon size on mobiles', 'dfd-native' ),
				'min'	   => '5',
				'max'	   => '15',
				'step'	   => '1',
				'default'  => '9',
				'required' => array('btt_show_mobile', "=", 'on'), 
				'hint' => array(
                    'title'   => esc_attr__('Mobile icon size','dfd-native'),
                    'content' => esc_attr__('This option allows you to specify the size for the back to top icon on mobile devices ','dfd-native')
                )
			),
			array(
				'id' => 'btt_button_icon',
				'type' => 'color',
				'title' => esc_html__('Icon color', 'dfd-native'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
				'required' => array('btt_switch', "=", 'on'),
				'hint' => array(
                    'title'   => esc_attr__('Icon color','dfd-native'),
                    'content' => esc_attr__('This option allows you to set the icon color for the back to top button','dfd-native')
                )
			),
			array(
				'id' => 'btt_button_hover_icon',
				'type' => 'color',
				'title' => esc_html__('Icon hover color', 'dfd-native'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
				'required' => array('btt_switch', "=", 'on'),
				'hint' => array(
                    'title'   => esc_attr__('Icon hover color','dfd-native'),
                    'content' => esc_attr__('This option allows you to choose the icon hover color for the back to top button','dfd-native')
                )
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Lightbox styling options', 'dfd-native'),
		'subsection' => true,
		'icon' => 'dashicons dashicons-format-gallery',
		'fields' => array(
			array(
				'id' => 'enable_deep_links',
				'type' => 'button_set',
				'title' => esc_html__('Lightbox deep links', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'off',
				'hint' => array(
					'title'   => esc_attr__('Deep links','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable the link of the image opened in lightbox','dfd-native')
				)
			),
			array(
				'id' => 'lightbox_overlay_style',
				'type' => 'radio',
				'title' => esc_html__('Background style', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'simple' => esc_html__('Simple color','dfd-native'),
					'gradient' => esc_html__('Gradient','dfd-native'),
				),
				'default' => 'simple',
				'hint' => array(
					'title'   => esc_attr__('Background style','dfd-native'),
					'content' => esc_attr__('Choose the background style for the lighbox background. You can set simple color or gradient','dfd-native')
				)
			),
			array(
				'id' => 'lightbox_overley_bg_color',
				'type' => 'color',
				'title' => esc_html__('Background color', 'dfd-native'),
				'default' => '',
				'validate' => 'color',
				'required' => array( 'lightbox_overlay_style', "=", 'simple' ),
				'hint' => array(
						'title'   => esc_attr__('Background color','dfd-native'),
						'content' => esc_attr__('Choose the background style for the lighbox background','dfd-native')
					)
			),
			array(
				'id' => 'lightbox_overley_color_gradient',
				'type' => 'color_gradient',
				'title' => esc_html__('Background gradient', 'dfd-native'),
				'default'  => array(
					'from' => '',
					'to'   => '', 
				),
				'validate' => 'color',
				'required' => array( 'lightbox_overlay_style', "=", 'gradient' ),
				'hint' => array(
						'title'   => esc_attr__('Background gradient','dfd-native'),
						'content' => esc_attr__('Choose the start and end color for the lighbox background gradient color','dfd-native')
					)
			),
			array(
				'id' => 'lightbox_overley_bg_opacity',
				'type' => 'slider',
				'title' => esc_html__('Background opacity', 'dfd-native'),
				'desc' => '',
				'min' => '1',
				'max' => '100',
				'step' => '1',
				'default' => '70',
				'required' => array( 'lightbox_overlay_style', "=", 'gradient' ),
				'hint' => array(
						'title'   => esc_attr__('Background opacity','dfd-native'),
						'content' => esc_attr__('Set the opacity value for the lighbox background','dfd-native')
					)
			),
			array(
				'id' => 'lightbox_elements_color',
				'type' => 'color',
				'title' => esc_html__('Lightbox elements color', 'dfd-native'),
				'default' => '',
				'validate' => 'color',
				'hint' => array(
						'title'   => esc_attr__('Elements color','dfd-native'),
						'content' => esc_attr__('Choose the color for the elements set in lightbox','dfd-native')
					)
			),
			array(
				'id' => 'enable_lightbox_share',
				'type' => 'button_set',
				'title' => esc_html__('Lightbox share', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Lightbox Share','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the share buttons in the lightbox','dfd-native')
				)
			),
			array(
				'id' => 'enable_lightbox_arrows',
				'type' => 'button_set',
				'title' => esc_html__('Lightbox navigation arrows', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Lightbox navigation','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the navigation arrows in the lightbox','dfd-native')
				)
			),
			array(
				'id' => 'enable_zoom_button',
				'type' => 'button_set',
				'title' => esc_html__('Lightbox zoom button', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Lightbox zoom','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the zoom button for the images in the lightbox','dfd-native')
				)
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Login page options', 'dfd-native'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'dashicons dashicons-admin-customizer',
		'subsection' => true,
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'custom_login_page',
				'type' => 'button_set',
				'title' => esc_html__('Custom styles', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => 'On', 'off' => 'Off'),
				'default' => 'off',
				'hint' => array(
					'title'   => esc_attr__('Custom styles','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable the custom changes for the login page','dfd-native')
				)
			),
			array(
				'id' => 'custom_login_page_logo',
				'type' => 'button_set',
				'title' => esc_html__('Logo', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => 'On', 'off' => 'Off'),
				'required' => array( 'custom_login_page', "=", 'on' ),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Logo','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the logotype for the login page','dfd-native')
				)
			),
			array(
				'id' => 'login_page_logo_image',
				'type' => 'media',
				'title' => esc_html__('Logotype image', 'dfd-native'),
				'default' => '',
				'required' => array( 'custom_login_page_logo', "=", 'on' ),
				'hint' => array(
					'title'   => esc_attr__('Logotype image','dfd-native'),
					'content' => esc_attr__('Upload the logotype to be shown on the login page. By default the logotype is inherited from Theme Options > General Options > Main Settings > Header main logotype image','dfd-native')
				)
			),
			array(
				'id' => 'login_page_bg_color',
				'type' => 'color',
				'title' => esc_html__('Background color', 'dfd-native'),
				'default' => '',
				'validate' => 'color',
				'required' => array( 'custom_login_page', "=", 'on' ),
				'hint' => array(
					'title'   => esc_attr__('Background color','dfd-native'),
					'content' => esc_attr__('Choose the background color for the login page','dfd-native')
				)
			),
			array(
				'id' => 'login_page_select_bg_variant',
				'type' => 'radio',
				'title' => esc_html__('Background style', 'dfd-native'),
				'options' => array(
//					'none' => esc_html__('None', 'dfd-native'),
					'image' => esc_html__('Image', 'dfd-native'),
					'video' => esc_html__('Video', 'dfd-native'),
				),
				'required' => array( 'custom_login_page', "=", 'on' ),
				'default' => 'image',
				'hint' => array(
					'title'   => esc_attr__('Background style','dfd-native'),
					'content' => esc_attr__('Choose the background style for the login page, you can set the image or the video','dfd-native')
				)
			),
			array(
				'id' => 'login_page_bg_image',
				'type' => 'media',
				'title' => esc_html__('Background image', 'dfd-native'),
				'desc' => '',
				'default' => array(
					'url' => $assets_folder . 'img/login_bg.jpg'
				),
				'required' => array( 'login_page_select_bg_variant', "=", 'image' ),
				'hint' => array(
					'title'   => esc_attr__('Background image','dfd-native'),
					'content' => esc_attr__('Choose the background image for the login page','dfd-native')
				)
			),
			array(
				'id' => 'login_page_bg_image_size',
				'type' => 'radio',
				'title' => esc_html__('Background size', 'dfd-native'),
				'options' => Dfd_Theme_Helpers::dfd_get_bgsize(),
				'required' => array( 'login_page_bg_image', "!=", '' ),
				'default' => 'initial',
				'hint' => array(
					'title'   => esc_attr__('Background size','dfd-native'),
					'content' => esc_attr__('This option allows you to set the background size for the background image','dfd-native')
				)
			),
			array(
				'id' => 'login_page_select_bg_video_variant',
				'type' => 'radio',
				'title' => esc_html__('Video variant', 'dfd-native'),
				'options' => array(
					'self_host' => esc_html__('Self hosted', 'dfd-native'),
					'youtube' => esc_html__('Youtube', 'dfd-native'),
					'vimeo' => esc_html__('Vimeo', 'dfd-native'),
				),
				'required' => array( 'login_page_select_bg_variant', "=", 'video' ),
				'default' => 'self_host',
				'hint' => array(
					'title'   => esc_attr__('Video variant','dfd-native'),
					'content' => esc_attr__('This option allows you to choose the video source','dfd-native')
				)
			),
			array(
				'id' => 'login_video_bg_url_mp4',
				'type' => 'text',
				'title' => esc_html__('Video in MP4 Format', 'dfd-native'),
				'default' => '',
				'required' => array( 'login_page_select_bg_video_variant', "=", 'self_host' ),
				'hint' => array(
					'title'   => esc_attr__('MP4 Format','dfd-native'),
					'content' => esc_attr__('Add the link to your video in mp4 format','dfd-native')
				)
			),
			array(
				'id' => 'login_video_bg_url_webm',
				'type' => 'text',
				'title' => esc_html__('Video in WebM / Ogg Format', 'dfd-native'),
				'default' => '',
				'required' => array( 'login_page_select_bg_video_variant', "=", 'self_host' ),
				'hint' => array(
					'title'   => esc_attr__('MP4 Format','dfd-native'),
					'content' => esc_attr__('Add the link to your video in WebM / Ogg format','dfd-native')
				)
			),
			array(
				'id' => 'login_video_bg_youtube',
				'type' => 'text',
				'title' => esc_html__('YouTube video ID', 'dfd-native'),
				'default' => '',
				'required' => array( 'login_page_select_bg_video_variant', "=", 'youtube' ),
				'hint' => array(
					'title'   => esc_attr__('YouTube','dfd-native'),
					'content' => esc_attr__('Add the video ID. Look at the URL of that page, and at the end of it, you should see a combination of numbers and letters after an equal sign (=)','dfd-native')
				)
			),
			array(
				'id' => 'login_video_bg_vimeo',
				'type' => 'text',
				'title' => esc_html__('Vimeo video ID', 'dfd-native'),
				'default' => '',
				'required' => array( 'login_page_select_bg_video_variant', "=", 'vimeo' ),
				'hint' => array(
					'title'   => esc_attr__('YouTube','dfd-native'),
					'content' => esc_attr__('Add the video ID. Copy the numeric code that appears at the end of its URL at the top of your browser window','dfd-native')
				)
			),
			array(
				'id' => 'login_page_color_scheme',
				'type' => 'radio',
				'title' => esc_html__('Color scheme', 'dfd-native'),
				'options' => array(
					'light' => esc_html__('Light', 'dfd-native'),
					'dark' => esc_html__('Dark', 'dfd-native'),
				),
				'required' => array( 'custom_login_page', "=", 'on' ),
				'default' => 'dark',
				'hint' => array(
					'title'   => esc_attr__('Color scheme','dfd-native'),
					'content' => esc_attr__('According to the color scheme you choose the text color will be changed to make it more readable','dfd-native')
				)
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('404 page options', 'dfd-native'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'dashicons dashicons-hidden',
		'subsection' => true,
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'nothing_variant',
				'type' => 'select',
				'title' => esc_html__('404 page variants', 'dfd-native'),
				'options' => array(
					'1' => esc_html__('Default', 'dfd-native'),
					'2' => esc_html__('With widgets inside', 'dfd-native'),
				),
				'default' => '1',
				'hint' => array(
                    'title'   => esc_attr__('404 variants','dfd-native'),
                    'content' => esc_attr__('This option allows you to choose between "Default" and "With widgets inside" page variants','dfd-native')
                )
			),
			array(
				'id' => 'nothing_layout_width',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Page width', 'dfd-native'),
				'options' => Dfd_Theme_Helpers::dfd_layout_width(),
				'hint' => array(
                    'title'   => esc_attr__('404 variants','dfd-native'),
                    'content' => esc_attr__('This option defines the content width for 404 page','dfd-native')
                )
			),
			array(
				'id' => 'nothing_bg_image_for_404',
				'type' => 'media',
				'title' => esc_html__('Background image for number "404"', 'dfd-native'),
				'desc' => esc_html__('Click to upload your background image', 'dfd-native'),
				'default' => array(
					'url' => $assets_folder . 'img/404bg.jpg'
				),
				'required' => array( 'nothing_variant', "=", '1' ),
				'hint' => array(
                    'title'   => esc_attr__('Background image','dfd-native'),
                    'content' => esc_attr__('This option allows you to add the image background under the 404 number. The image can be uploaded from your media library','dfd-native')
                )
			),
			array(
				'id' => 'nothing_bg_color',
				'type' => 'color',
				'validate' => 'color',
				'title' => esc_html__('Page background color', 'dfd-native'),
				'default' => '#ffffff',
				'hint' => array(
                    'title'   => esc_attr__('Background color','dfd-native'),
                    'content' => esc_attr__('This option allows you to add the background color for the 404 page','dfd-native')
                )
			),
			array(
				'id' => 'nothing_bg_dark',
				'type' => 'button_set',
				'title' => esc_html__('Dark background', 'dfd-native'),
				'desc' => '',
				'options' => array('1' => esc_html__('Yes', 'dfd-native'), '0' => esc_html__('No', 'dfd-native')),
				'default' => '0',
				'hint' => array(
                    'title'   => esc_attr__('Dark background','dfd-native'),
                    'content' => esc_attr__('Enable this option if you\'ve set dark background color. The text color will be changed to make the text more readable','dfd-native')
                )
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Custom CSS / JS', 'dfd-native'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'dashicons dashicons-editor-code',
		'subsection' => true,
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'head_custom_js',
				'type' => 'textarea',
				'title' => esc_html__('JS code to be added inside HEAD tag', 'dfd-native'),
				'default' => '',
				'hint' => array(
                    'title'   => esc_attr__('JS in HEAD','dfd-native'),
                    'content' => esc_attr__('Allows you to add the custom javascript code to head tag streight after the Jquery. Please pay attention that this option requires at list WP 4.5 version','dfd-native')
                )
			),
			array(
				'id' => 'custom_js',
				'type' => 'textarea',
				'title' => esc_html__('Custom JS', 'dfd-native'),
				'default' => '',
				'hint' => array(
                    'title'   => esc_attr__('Custom JS','dfd-native'),
                    'content' => esc_attr__('Allows you to add the custom javascript code if you need to customize anything using js','dfd-native')
                )
			),
			array(
				'id' => 'custom_css',
				'type' => 'textarea',
				'title' => esc_html__('Custom CSS', 'dfd-native'),
				'default' => '',
				'hint' => array(
                    'title'   => esc_attr__('Custom CSS','dfd-native'),
                    'content' => esc_attr__('Allows you to add any custom CSS code if you need to customize styles','dfd-native')
                )
			),
			array(
				'id' => 'custom_admin_css',
				'type' => 'textarea',
				'title' => esc_html__('Custom CSS for admin area', 'dfd-native'),
				'default' => '',
				'hint' => array(
                    'title'   => esc_attr__('Custom CSS for admin area','dfd-native'),
                    'content' => esc_attr__('Allows you to add any custom CSS code for admin area if you need to add some custom styles for admin area','dfd-native')
                )
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Header options', 'dfd-native'),
		'icon' => 'dashicons dashicons-editor-kitchensink',
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Header main options', 'dfd-native'),
		'icon' => 'dashicons dashicons-editor-kitchensink',
		'subsection' => true,
		'fields' => array(
			array(
				'id' => 'info_top_pane_content',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Top inner page settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'top_panel_inner_page_select',
				'type'     => 'select',
				'data'     => 'pages',
				'title' => esc_html__('Top inner page', 'dfd-native'),
				'hint' => array(
                    'title'   => esc_attr__('Top inner page','dfd-native'),
                    'content' => esc_attr__('Allows you to select any custom page as top inner page. Note, you have to be sure, that the top inner page and the main page are not the same to avoid conflicts and errors on the page','dfd-native')
                )
			),
			array(
				'id' => 'top_panel_inner_appear_effect',
				'type' => 'select',
				'title' => esc_html__('Top inner page appear effect', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'fade' => esc_html__('Fade', 'dfd-native'),
					'scale' => esc_html__('Grow', 'dfd-native'),
					'stretch' => esc_html__('Lazy Stretch', 'dfd-native'),
					'spill' => esc_html__('Spill', 'dfd-native'),
					'windscreen' => esc_html__('Windscreen wiper', 'dfd-native'),
					'lateral_swipe' => esc_html__('Lateral swipe', 'dfd-native'),
				),
				'default' => 'slide_down',
				'required' => array( 'top_panel_inner_page_select', "!=", '' ),
				'hint' => array(
                    'title'   => esc_attr__('Appear effect','dfd-native'),
                    'content' => esc_attr__('Allows you to select the appear animation effect for the top inner page','dfd-native')
                )
			),
			array(
				'id' => 'top_panel_inner_background',
				'type' => 'color',
				'title' => esc_html__('Top inner page background color', 'dfd-native'),
				'default' => '',
				'validate' => 'color',
				'required' => array( 'top_panel_inner_page_select', "!=", '' ),
				'hint' => array(
                    'title'   => esc_attr__('Top page background','dfd-native'),
                    'content' => esc_attr__('Allows you to add the background color for the top panel inner page','dfd-native')
                )
			),
			array(
				'id' => 'top_panel_el_color',
				'type' => 'color',
				'title' => esc_html__('Close button color', 'dfd-native'),
				'default' => '',
				'validate' => 'color',
				'required' => array( 'top_panel_inner_page_select', "!=", '' ),
				'hint' => array(
					'title'   => esc_attr__('Close color','dfd-native'),
					'content' => esc_attr__('Choose the color for the close button set inside top inner page','dfd-native')
				)
			),
			array(
				'id' => 'info_header_base_content',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Header main settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'header_layout',
				'type' => 'button_set',
				'title' => esc_html__('Boxed header layout', 'dfd-native'),
				'options' => Dfd_Theme_Helpers::dfd_header_layouts(),
				'default' => 'fullwidth',
				'hint' => array(
                    'title'   => esc_attr__('Boxed header','dfd-native'),
                    'content' => esc_attr__('This option allows you to enable or disable the boxed width for the header','dfd-native')
                )
			),
			array(
				'id' => 'menu_alignment',
				'type' => 'radio',
				'title' => esc_html__('Primary navigation alignment', 'dfd-native'),
				'options' => Dfd_Theme_Helpers::dfd_alignment_options(),
				'default' => 'text-right',
				'hint' => array(
                    'title'   => esc_attr__('Navigation aignment','dfd-native'),
                    'content' => esc_attr__('This option allows you to align the header navigation horizontally','dfd-native')
                )
			),
			array(
				'id' => 'wpml_lang_show',
				'type' => 'button_set',
				'title' => esc_html__('WPML language switcher', 'dfd-native'),
				'desc' => esc_html__('WPML plugin is not included to the theme pack. You can find the plugin here', 'dfd-native') . ': http://wpml.org/',
				'options' => array('1' => esc_html__('On', 'dfd-native'), '0' => esc_html__('Off', 'dfd-native')),
				'default' => '0',
				'hint' => array(
                    'title'   => esc_attr__('WPML switcher','dfd-native'),
                    'content' => esc_attr__('Allows you to have the WPML language switcher in header. Note, WPML plugin must be installed','dfd-native')
                )
			),
			array(
				'id' => 'lang_shortcode',
				'type' => 'textarea',
				'title' => esc_html__('Language selection shortcode', 'dfd-native'),
				'default'  => '<div class="lang-sel"><a href="#"><span class="flag"></span><span>En</span></a><ul><li class="active"><a href="#"><span class="flag"></span></a></li><li><a href="#"><span class="flag"></span></a></li><li><a href="#"><span class="flag"></span></a></li></ul></div>',
				'hint' => array(
                    'title'   => esc_attr__('Language shortcode','dfd-native'),
                    'content' => esc_attr__('In this field you can paste the language shortcode provided by the translating plugin','dfd-native')
                )
			),
			array(
				'id' => 'top_adress_field',
				'type' => 'textarea',
				'title' => esc_html__('Top address panel', 'dfd-native'),
				'sub_desc' => esc_html__('Please do not use single quote here', 'dfd-native'),
				'validate' => 'html',
				'default' => 'Phone: +0(123) 456 78 90       Email: dynamicframeworks@gmail.com',
				'hint' => array(
                    'title'   => esc_attr__('Address panel','dfd-native'),
                    'content' => esc_attr__('Add the address information which will be visible in top panel','dfd-native')
                )
			),
			array(
				'id' => 'top_menu_height',
				'type' => 'slider',
				'title' => esc_html__('Top menu height', 'dfd-native'),
				'desc' => '',
				'min' => '20',
				'max' => '150',
				'step' => '2',
				'default' => '70',
				'hint' => array(
                    'title'   => esc_attr__('Top menu height','dfd-native'),
                    'content' => esc_attr__('This option allows you to adjust the height of the top menu in px. Note, the maximum value is 150','dfd-native')
                )
			),
			array(
				'id' => 'info_header_menu_colors',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Menu dropdowns colors', 'dfd-native') .'</h3>'
			),
			array(
				'id' => 'menu_dropdown_hover_color',
				'type' => 'color',
				'title' => esc_html__('Menu dropdown hover color', 'dfd-native'),
				'desc' => '',
				'default' => '#3498db',
				'validate' => 'color',
				'hint' => array(
                    'title'   => esc_attr__('Menu dropdown hover','dfd-native'),
                    'content' => esc_attr__('This option allows you to set the text hover color for the menu items','dfd-native')
                )
			),
			array(
				'id' => 'menu_dropdown_background',
				'type' => 'color',
				'title' => esc_html__('Menu dropdown background color', 'dfd-native'),
				'desc' => '',
				'default' => '#ffffff',
				'validate' => 'color',
				'hint' => array(
                    'title'   => esc_attr__('Menu dropdown background','dfd-native'),
                    'content' => esc_attr__('This option allows you to set the background color for the menu dropdown','dfd-native')
                )
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Sticky header options', 'dfd-native'),
		'icon' => 'dashicons dashicons-editor-kitchensink',
		'subsection' => true,
		'fields' => array(
			array(
				'id' => 'info_sticky_header_main',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Sticky header main options', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'enable_sticky_header',
				'type' => 'button_set',
				'title' => esc_html__('Sticky header', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
                    'title'   => esc_attr__('Sticky header','dfd-native'),
                    'content' => esc_attr__('Allows you to add the sticky header. Allows you to add the sticky header which makes the menu visible when you scroll down the page','dfd-native')
                )
			),
			array(
				'id' => 'sticky_header_animation',
				'type' => 'radio',
				'title' => esc_html__('Sticky header animation', 'dfd-native'),
				'options' => Dfd_Theme_Helpers::dfd_sticky_header_animations(),
				'required' => array( 'enable_sticky_header', "=", 'on' ),
				'default' => 'simple',
				'hint' => array(
                    'title'   => esc_attr__('Sticky header animation','dfd-native'),
                    'content' => esc_attr__('Allows you to add the sticky header appear animation','dfd-native')
                )
			),
			array(
				'id' => 'info_sticky_header_color',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Sticky Header color options', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'fixed_header_background_color',
				'type' => 'color',
				'title' => esc_html__('Sticky Header background color', 'dfd-native'),
				'default' => '',
				'validate' => 'color',
				'required' => array( 'enable_sticky_header', "=", 'on' ),
				'hint' => array(
                    'title'   => esc_attr__('Sticky header background','dfd-native'),
                    'content' => esc_attr__('Allows you to add the background for the sticky header','dfd-native')
                )
			),
			array(
				'id' => 'fixed_header_border_color',
				'type' => 'color',
				'title' => esc_html__('Sticky header delimiter color', 'dfd-native'),
				'default' => '',
				'validate' => 'color',
				'required' => array( 'enable_sticky_header', "=", 'on' ),
				'hint' => array(
                    'title'   => esc_attr__('Sticky header deimiter','dfd-native'),
                    'content' => esc_attr__('Allows you to add the delimiter color for the sticky header. The delimiter will be set between the menu and icons','dfd-native')
                )
			),
			array(
				'id' => 'fixed_header_text_color',
				'type' => 'color',
				'title' => esc_html__('Sticky header text color', 'dfd-native'),
				'default' => '',
				'validate' => 'color',
				'required' => array( 'enable_sticky_header', "=", 'on' ),
				'hint' => array(
                    'title'   => esc_attr__('Sticky header text','dfd-native'),
                    'content' => esc_attr__('Allows you to choose the color for the menu items text in sticky header','dfd-native')
                )
			),
			array(
				'id' => 'custom_logo_fixed_header',
				'type' => 'media',
				'title' => esc_html__('Logo for sticky header', 'dfd-native'),
				'default' => array(
						'url' => $assets_folder . 'img/logo_white.png',
						'width'		=> 77,
						'height'	=> 38,
					),
				'hint' => array(
                    'title'   => esc_attr__('Sticky header Logotype','dfd-native'),
                    'content' => esc_attr__('Select an image from the media library and upload it as logotype for sticky header','dfd-native')
                )
			),
			array(
				'id' => 'custom_retina_logo_fixed_header',
				'type' => 'media',
				'title' => esc_html__('Retina logo for sticky header', 'dfd-native'),
				'default' => array(
						'url' => $assets_folder . 'img/logo_white_retina.png'
					),
				'hint' => array(
                    'title'   => esc_attr__('Sticky header Logotype','dfd-native'),
                    'content' => esc_attr__('Select an image from the media library and upload it as logotype for sticky header','dfd-native')
                )
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Custom header options', 'dfd-native'),
		'icon' => 'dashicons dashicons-editor-kitchensink',
		'subsection' => true,
		'fields' => array(
			array(
				'id' => 'info_sth',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Custom header main options', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'enable_stunning_header',
				'type' => 'button_set',
				'title' => esc_html__('Custom header', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
                    'title'   => esc_attr__('Custom header','dfd-native'),
                    'content' => esc_attr__('This option allows you to enable or disable the custom header. Custom header is an area with page title, subtitle and breadcrumbs that is set in the top header section','dfd-native')
                )
			),
			array(
				'id' => 'stunning_header_full_height',
				'type' => 'button_set',
				'title' => esc_html__('Full window height', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'off',
				'hint' => array(
                    'title'   => esc_attr__('Full height','dfd-native'),
                    'content' => esc_attr__('This option allows you to adjust the stunning header to the full window height','dfd-native')
                )
			),
			array(
				'id' => 'stunnig_headers_custom_height',
				'type' => 'slider',
				'title' => esc_html__('Custom header min height', 'dfd-native'),
				'desc' => '',
				'min' => '100',
				'step' => '5',
				'max' => '900',
				'default' => '650',
				'required' => array( 'stunning_header_full_height', "!=", 'on' ),
				'hint' => array(
                    'title'   => esc_attr__('Min height','dfd-native'),
                    'content' => esc_attr__('This option allows you to set the min height for the custom header. There is also an option on the item\'s page if you need to change the custom header height for one single item','dfd-native')
                )
			),
			array(
				'id' => 'info_sth_background',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Custom header background options', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'stunnig_headers_bg_color',
				'type' => 'color',
				'title' => esc_html__('Default background color', 'dfd-native'),
				'desc' => '',
				'validate' => 'color',
				'default' => '',
				'hint' => array(
                    'title'   => esc_attr__('Background color','dfd-native'),
                    'content' => esc_attr__('This option allows you to set the default background color for the custom header. There is also an option on the item\'s page if you need to change the custom header background color for one single item','dfd-native')
                )
			),
			array(
				'id' => 'stunnig_headers_bg_image',
				'type' => 'media',
				'title' => esc_html__('Default background image', 'dfd-native'),
				'desc' => esc_html__('Upload your own background image or pattern.', 'dfd-native'),
				'default' => array(
					'url' => ''
				),
				'hint' => array(
                    'title'   => esc_attr__('Background image','dfd-native'),
                    'content' => esc_attr__('This option allows you to set the default background image for the custom header. There is also an option on the item\'s page if you need to change the custom header background image for one single item','dfd-native')
                )
			),
			array(
				'id' => 'stunnig_headers_bg_img_position',
				'type' => 'select',
				'title' => esc_html__('Default background position', 'dfd-native'),
				'default' => '',
				'options' => Dfd_Theme_Helpers::dfd_get_bgposition(),
				'hint' => array(
                    'title'   => esc_attr__('Background position','dfd-native'),
                    'content' => esc_attr__('This option allows you to set the default background image position for the custom header. There is also an option on the item\'s page if you need to change the custom header background image position for one single item','dfd-native')
                )
			),
			array(
				'id' => 'stun_header_bg_size',
				'type' => 'radio',
				'title' => esc_html__('Default background size', 'dfd-native'),
				'desc' => '',
				'default' => 'initial',
				'options' => Dfd_Theme_Helpers::dfd_get_bgsize(),
				'hint' => array(
                    'title'   => esc_attr__('Background position','dfd-native'),
                    'content' => esc_attr__('This option allows you to set the default background image size for the custom header. There is also an option on the item\'s page if you need to change the custom header background image size for one single item','dfd-native')
                )
			),
			array(
				'id' => 'stunnig_headers_fixed',
				'type' => 'radio',
				'title' => esc_html__('Background attachment', 'dfd-native'),
				'options' => array(
					'initial' => esc_html__('Initial', 'dfd-native'),
					'scroll' => esc_html__('Scroll', 'dfd-native'),
					'fixed' => esc_html__('Fixed', 'dfd-native'),
				),
				'default' => 'initial',
				'hint' => array(
                    'title'   => esc_attr__('Background attachment','dfd-native'),
                    'content' => esc_attr__('This option allows you to set the default background attachment for the custom header. There is also an option on the item\'s page if you need to change the custom header background attachment for one single item','dfd-native')
                )
			),
			array(
				'id' => 'stunnig_headers_repeat',
				'type' => 'radio',
				'title' => esc_html__('Background repeat', 'dfd-native'),
				'options' => array(
					'no-repeat' => esc_html__('No-repeat', 'dfd-native'),
					'repeat-x' => esc_html__('Repeat X', 'dfd-native'),
					'repeat-y' => esc_html__('Repeat Y', 'dfd-native'),
					'repeat' => esc_html__('Repeat', 'dfd-native'),
				),
				'default' => 'initial',
				'hint' => array(
                    'title'   => esc_attr__('Background repeat','dfd-native'),
                    'content' => esc_attr__('This option allows you to set the repeat options for the image set in custom header. There is also an option on the item\'s page if you need to change it for one single item','dfd-native')
                )
			),
			array(
				'id' => 'stunnig_headers_bgcheck',
				'type' => 'button_set',
				'title' => esc_html__('Dark background', 'dfd-native'),
				'options' => array(
					'dfd-background-dark' => esc_html__('On', 'dfd-native'),
					'dfd-background-initial' => esc_html__('Off', 'dfd-native'),
				),
				'default' => 'dfd-background-initial',
				'hint' => array(
                    'title'   => esc_attr__('Dark background','dfd-native'),
                    'content' => esc_attr__('Enable this option if you\'ve set dark background color. The text color will be changed to make the text more readable','dfd-native')
                )
			),
			array(
				'id' => 'info_sth_content',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Custom header content options', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'stunnig_headers_text_alignment',
				'type' => 'radio',
				'title' => esc_html__('Custom header text alignment', 'dfd-native'),
				'options' => array(
					'text-center' => esc_html__('Center', 'dfd-native'),
					'text-left' => esc_html__('Left', 'dfd-native'),
					'text-right' => esc_html__('Right', 'dfd-native'),
				),
				'default' => 'text-center',
				'hint' => array(
                    'title'   => esc_attr__('Text alignment','dfd-native'),
                    'content' => esc_attr__('This option allows you to align the text horizontally in custom header','dfd-native')
                )
			),
			array(
				'id' => 'enable_stun_parallax',
				'type' => 'button_set',
				'title' => esc_html__('Custom header parallax effect', 'dfd-native'),
				'options' => array(
					'dfd-enable-parallax' => esc_html__('On', 'dfd-native'),
					'' => esc_html__('Off', 'dfd-native'),
				),
				'default' => '',
				'hint' => array(
                    'title'   => esc_attr__('Parallax effect','dfd-native'),
                    'content' => esc_attr__('This option allows you to enable or disable the parallax effect for the custom header','dfd-native')
                )
			),
			array(
				'id' => 'enable_stun_header_title',
				'type' => 'button_set',
				'title' => esc_html__('Custom header title', 'dfd-native'),
				'options' => array(
					'on' => esc_html__('On', 'dfd-native'),
					'off' => esc_html__('Off', 'dfd-native'),
				),
				'default' => '1',
				'hint' => array(
                    'title'   => esc_attr__('Custom header title','dfd-native'),
                    'content' => esc_attr__('This option allows you to enable or disable the title of the page in the custom header','dfd-native')
                )
			),
			array(
				'id' => 'enable_stun_header_subtitle',
				'type' => 'button_set',
				'title' => esc_html__('Custom header subtitle', 'dfd-native'),
				'options' => array(
					'on' => esc_html__('On', 'dfd-native'),
					'off' => esc_html__('Off', 'dfd-native'),
				),
				'default' => '1',
				'hint' => array(
                    'title'   => esc_attr__('Custom header subtitle','dfd-native'),
                    'content' => esc_attr__('This option allows you to enable or disable the subtitle of the page in the custom header','dfd-native')
                )
			),
			array(
				'id' => 'stun_header_breadcrumbs',
				'type' => 'button_set',
				'title' => esc_html__('Custom header breadcrumbs', 'dfd-native'),
				'options' => array(
					'on' => esc_html__('On', 'dfd-native'),
					'off' => esc_html__('Off', 'dfd-native'),
				),
				'default' => '1',
				'hint' => array(
                    'title'   => esc_attr__('Custom header breadcrumbs','dfd-native'),
                    'content' => esc_attr__('This option allows you to enable or disable the breadcrumbs of the page in the custom header','dfd-native')
                )
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Header style 1 options', 'dfd-native'),
		'subsection' => true,
		'icon' => 'dashicons dashicons-editor-kitchensink',
		'fields' => Dfd_Theme_Helpers::dfd_build_header_options(1)
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Header style 2 options', 'dfd-native'),
		'subsection' => true,
		'icon' => 'dashicons dashicons-editor-kitchensink',
		'fields' => Dfd_Theme_Helpers::dfd_build_header_options(2)
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Header style 3 options', 'dfd-native'),
		'subsection' => true,
		'icon' => 'dashicons dashicons-editor-kitchensink',
		'fields' => Dfd_Theme_Helpers::dfd_build_header_options(3)
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Header style 4 options', 'dfd-native'),
		'subsection' => true,
		'icon' => 'dashicons dashicons-editor-kitchensink',
		'fields' => Dfd_Theme_Helpers::dfd_build_header_options(4)
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Header style 5 options', 'dfd-native'),
		'subsection' => true,
		'icon' => 'dashicons dashicons-editor-kitchensink',
		'fields' => Dfd_Theme_Helpers::dfd_build_header_options(5)
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Header style 6 options', 'dfd-native'),
		'subsection' => true,
		'icon' => 'dashicons dashicons-editor-kitchensink',
		'fields' => Dfd_Theme_Helpers::dfd_build_header_options(6)
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Header style 7 options', 'dfd-native'),
		'subsection' => true,
		'icon' => 'dashicons dashicons-editor-kitchensink',
		'fields' => array(
			array(
				'id' => 'info_image_7',
				'type' => 'info',
				'class' => 'dfd-no-bg',
				'desc' => '<div class="description-image"><img src="'.  get_template_directory_uri().'/assets/img/headers/header-7.png" alt="'.esc_attr('Header style 7 preview','dfd-native').'" /></div>'
			),
			array(
				'id' => 'header_sticky_7',
				'type' => 'button_set',
				'title' => esc_html__('Header animation', 'dfd-native'),
				'options' => array('on' => esc_html__('On','dfd-native'), 'off' => esc_html__('Off','dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Header animation','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable the header animation on scroll','dfd-native')
				)
			),
			array(
				'id' => 'show_menu_icons_header_7',
				'type' => 'button_set',
				'title' => esc_html__('Menu icons', 'dfd-native'),
				'desc' => esc_html__('Please make sure that icons are defined for the top level navigation menu items in','dfd-native') . ' <a href="'.esc_url(admin_url()).'/nav-menus.php">'.esc_html__('Appearance -> Menus','dfd-native').'</a> ' . esc_html__('if you enable this option','dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Menu icons','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable icons in primary navigation.','dfd-native')
				)
			),
			array(
				'id' => 'info_main_panel_color_7',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Header color settings', 'dfd-native') .'</h3>'
			),
			array(
				'id' => 'header_background_color_7',
				'type' => 'color',
				'title' => esc_html__('Header background color', 'dfd-native'),
				'default' => '',
				'validate' => 'color',
				'hint' => array(
					'title'   => esc_attr__('Background color','dfd-native'),
					'content' => esc_attr__('Choose the background color for the header main section','dfd-native')
				)
			),
			array(
				'id' => 'header_text_color_7',
				'type' => 'color',
				'title' => esc_html__('Header elements color', 'dfd-native'),
				'default' => '',
				'validate' => 'color',
				'hint' => array(
						'title'   => esc_attr__('Elements color','dfd-native'),
						'content' => esc_attr__('Choose the text color for the elements set in header','dfd-native')
					)
			),
			array(
				'id' => 'info_main_panel_logos_7',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Header style', 'dfd-native') . ' 7 ' . esc_html__('logos','dfd-native') .'</h3>'
			),
			array(
				'id' => 'logo_header_7',
				'type' => 'media',
				'title' => esc_html__('Header logotype image', 'dfd-native'),
				'default' => array(
						'url' => $assets_folder . 'img/logo_white.png',
						'width'		=> 77,
						'height'	=> 38,
				),
				'hint' => array(
						'title'   => esc_attr__('Header logotype','dfd-native'),
						'content' => esc_attr__('Select the image from the media library which will be set as logotype image for the current header style','dfd-native')
					)
			),
			array(
				'id' => 'retina_logo_header_7',
				'type' => 'media',
				'title' => esc_html__('Header logotype image for retina', 'dfd-native'),
				'default' => array(
						'url' => $assets_folder . 'img/logo_white_retina.png'
					),
				'hint' => array(
						'title'   => esc_attr__('Header retina logotype','dfd-native'),
						'content' => esc_attr__('Select the image from the media library which will be set as logotype image for retina for the current header style','dfd-native')
					)
			),
			array(
				'id' => 'info_main_panel_banner_7',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Header style', 'dfd-native') . ' 7 ' . esc_html__('banner settings','dfd-native') .'</h3>'
			),
			array(
				'id' => 'show_banner_header_7',
				'type' => 'button_set',
				'title' => esc_html__('Banner', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'off',
				'hint' => array(
						'title'   => esc_attr__('Banner','dfd-native'),
						'content' => esc_attr__('This option allows you to add the banner with the custom link which will be set above the header','dfd-native')
					)
			),
			array(
				'id' => 'banner_image_url_7',
				'type' => 'media',
				'title' => esc_html__('Banner image URL', 'dfd-native'),
				'desc' => esc_html__('Select or upload the image for banner in header', 'dfd-native'),
				'required' => array(
					array('show_banner_header_7', '=', 'on'),
				),
				'default' => array(
						'url' => get_template_directory_uri() . '/assets/img/banner.jpg'
					),
				'hint' => array(
						'title'   => esc_attr__('Banner image URL','dfd-native'),
						'content' => esc_attr__('Add the custom image link or upload the image from the media library','dfd-native')
					)
			),
			array(
				'id' => 'banner_url_7',
				'type' => 'text',
				'title' => esc_html__('Banner URL', 'dfd-native'),
				'desc' => '',
				'validate' => 'url',
				'required' => array(
					array('show_banner_header_7', '=', 'on'),
				),
				'default' => 'http://nativewptheme.net',
				'hint' => array(
						'title'   => esc_attr__('Banner URL','dfd-native'),
						'content' => esc_attr__('This option allows you to add the link to your banner','dfd-native')
					)
			),
			array(
				'id' => 'header_content_alignment_7',
				'type' => 'radio',
				'title' => esc_html__('Header content alignment', 'dfd-native'),
				'options' => array(
					'alignleft' => esc_html__('Left', 'dfd-native'),
					'alignright' => esc_html__('Right', 'dfd-native'),
					'aligncenter' => esc_html__('Center', 'dfd-native'),
				),
				'required' => array(
					array('show_banner_header_7', '=', 'on'),
				),
				'default' => 'alignleft',
				'hint' => array(
						'title'   => esc_attr__('Header content alignment','dfd-native'),
						'content' => esc_attr__('This option allows you to choose horizontal alignment for the header content','dfd-native')
					)
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Header style 8 options', 'dfd-native'),
		'subsection' => true,
		'icon' => 'dashicons dashicons-editor-kitchensink',
		'fields' => array(
			array(
				'id' => 'info_image_8',
				'type' => 'info',
				'class' => 'dfd-no-bg',
				'desc' => '<div class="description-image"><img src="'.  get_template_directory_uri().'/assets/img/headers/header-8.png" alt="'.esc_attr('Header style 8 preview','dfd-native').'" /></div>'
			),
			array(
				'id' => 'header_sticky_8',
				'type' => 'button_set',
				'title' => esc_html__('Header animation', 'dfd-native'),
				'options' => array('on' => esc_html__('On','dfd-native'), 'off' => esc_html__('Off','dfd-native')),
				'default' => 'on',
				'hint' => array(
						'title'   => esc_attr__('Header animation','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the header animation on scroll','dfd-native')
					)
			),
			array(
				'id' => 'info_anim_effect_8',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Header animation effect', 'dfd-native') .'</h3>'
			),
			array(
				'id' => 'header_appear_effect_8',
				'type' => 'select',
				'title' => esc_html__('Header appearance effect', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'fade' => esc_html__('Fade', 'dfd-native'),
					'scale' => esc_html__('Grow', 'dfd-native'),
					'stretch' => esc_html__('Lazy Stretch', 'dfd-native'),
					'spill' => esc_html__('Spill', 'dfd-native'),
					'windscreen' => esc_html__('Windscreen wiper', 'dfd-native'),
					'lateral_swipe' => esc_html__('Lateral swipe', 'dfd-native'),
				),
				'default' => 'stretch',
				'hint' => array(
                    'title'   => esc_attr__('Header appearance effect','dfd-native'),
                    'content' => esc_attr__('Allows you to select the appear animation effect for the header','dfd-native')
                )
			),
			
			array(
				'id' => 'info_elements_8',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Header elements settings', 'dfd-native') .'</h3>'
			),
			array(
				'id' => 'header_login_8',
				'type' => 'button_set',
				'title' => esc_html__('Login form', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
						'title'   => esc_attr__('Login form','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the login form in the opened (active) header','dfd-native')
					)
			),
			array(
				'id' => 'head_show_header_soc_icons_8',
				'type' => 'button_set',
				'title' => esc_html__('Social icons', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
						'title'   => esc_attr__('Social icons','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the social icon in the opened (active) header, the socia icons can be added in Sicoal accounts section in theme options','dfd-native')
					)
			),
			array(
				'id' => 'show_search_form_header_8',
				'type' => 'button_set',
				'title' => esc_html__('Search form in header', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Search form','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable the search form in the opened (active) header','dfd-native')
				)
			),
			array(
				'id' => 'show_lang_sel_header_8',
				'type' => 'button_set',
				'title' => esc_html__('Language switcher in header', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Language switcher','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable the language switcher in header','dfd-native')
				)
			),
			array(
				'id' => 'show_cart_header_8',
				'type' => 'button_set',
				'title' => esc_html__('Shopping cart button in header', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'off',
				'hint' => array(
						'title'   => esc_attr__('Shopping cart','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the shopping cart button in the opened (active) header. Note, this option is available if Woocommerce plugin is installed','dfd-native')
					)
			),
			array(
				'id' => 'show_menu_icons_header_8',
				'type' => 'button_set',
				'title' => esc_html__('Menu icons', 'dfd-native'),
				'desc' => esc_html__('Please make sure that icons are defined for the top level navigation menu items in','dfd-native') . ' <a href="'.esc_url(admin_url()).'/nav-menus.php">'.esc_html__('Appearance -> Menus','dfd-native').'</a> ' . esc_html__('if you enable this option','dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Menu icons','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable icons in primary navigation.','dfd-native')
				)
			),
			array(
				'id' => 'info_color_8',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Header color settings', 'dfd-native') .'</h3>'
			),
			array(
				'id' => 'header_background_color_8',
				'type' => 'color',
				'title' => esc_html__('Header background color', 'dfd-native'),
				'default' => '',
				'validate' => 'color',
				'hint' => array(
						'title'   => esc_attr__('Background color','dfd-native'),
						'content' => esc_attr__('Choose the background color for the header main section','dfd-native')
					)
			),
			array(
				'id' => 'header_border_color_8',
				'type' => 'color',
				'title' => esc_html__('Header border color', 'dfd-native'),
				'default' => '',
				'validate' => 'color',
				'hint' => array(
						'title'   => esc_attr__('Border color','dfd-native'),
						'content' => esc_attr__('Choose the border color for the header','dfd-native')
					)
			),
			array(
				'id' => 'header_text_color_8',
				'type' => 'color',
				'title' => esc_html__('Header text color', 'dfd-native'),
				'default' => '',
				'validate' => 'color',
				'hint' => array(
						'title'   => esc_attr__('Text color','dfd-native'),
						'content' => esc_attr__('Choose the text color for the elements set in header','dfd-native')
					)
			),
			array(
				'id' => 'info_active_color_8',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Header active color settings', 'dfd-native') .'</h3>'
			),
			array(
				'id' => 'header_active_background_color_8',
				'type' => 'color',
				'title' => esc_html__('Active header background color', 'dfd-native'),
				'default' => '',
				'validate' => 'color',
				'hint' => array(
						'title'   => esc_attr__('Active background','dfd-native'),
						'content' => esc_attr__('Choose the background color for the opened (active) header','dfd-native')
					)
			),
			array(
				'id' => 'header_active_text_color_8',
				'type' => 'color',
				'title' => esc_html__('Active header text color', 'dfd-native'),
				'default' => '',
				'validate' => 'color',
				'hint' => array(
						'title'   => esc_attr__('Active text color','dfd-native'),
						'content' => esc_attr__('Choose the text color for the elements set in opened (active) header','dfd-native')
					)
			),
			array(
				'id' => 'info_header_content_8',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Header content settings', 'dfd-native') .'</h3>'
			),
			array(
				'id' => 'header_content_alignment_8',
				'type' => 'radio',
				'title' => esc_html__('Header content alignment', 'dfd-native'),
				'options' => Dfd_Theme_Helpers::dfd_alignment_options(),
				'default' => 'text-left',
				'hint' => array(
						'title'   => esc_attr__('Header content alignment','dfd-native'),
						'content' => esc_attr__('This option allows you to choose horizontal alignment for the header content','dfd-native')
					)
			),
			array(
				'id' => 'header_copyright_8',
				'type' => 'text',
				'title' => esc_html__('Copyright message', 'dfd-native'),
				'sub_desc' => esc_html__('Please do not use single quote here', 'dfd-native'),
				'validate' => 'html',
				'default' => '© DynamicFrameworks - Elite ThemeForest Author.',
				'hint' => array(
						'title'   => esc_attr__('Copyright','dfd-native'),
						'content' => esc_attr__('Add the copyright message which will be visible in opened (active) header','dfd-native')
					)
			),
			array(
				'id' => 'info_header_logos_8',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Header style 8 custom logos', 'dfd-native') .'</h3>'
			),
			array(
				'id' => 'logo_header_8',
				'type' => 'media',
				'title' => esc_html__('Header logotype image', 'dfd-native'),
				'default' => array(
						'url' => $assets_folder . 'img/logo_white.png',
						'width'		=> 77,
						'height'	=> 38,
					),
				'hint' => array(
						'title'   => esc_attr__('Header logotype','dfd-native'),
						'content' => esc_attr__('Select the image from the media library which will be set as logotype image for the current header style','dfd-native')
					)
			),
			array(
				'id' => 'retina_logo_header_8',
				'type' => 'media',
				'title' => esc_html__('Header logotype image for retina', 'dfd-native'),
				'default' => array(
						'url' => $assets_folder . 'img/logo_white_retina.png'
					),
				'hint' => array(
						'title'   => esc_attr__('Header retina logotype','dfd-native'),
						'content' => esc_attr__('Select the image from the media library which will be set as logotype image for retina for the current header style','dfd-native')
					)
			),
			array(
				'id' => 'small_logo_header_8',
				'type' => 'media',
				'title' => esc_html__('Active header logotype image', 'dfd-native'),
				'default' => array(
						'url' => $assets_folder . 'img/logo_white.png'
					),
				'hint' => array(
						'title'   => esc_attr__('Header logotype','dfd-native'),
						'content' => esc_attr__('Select the image from the media library which will be set as logotype image for the current header style','dfd-native')
					)
			),
			array(
				'id' => 'small_retina_logo_header_8',
				'type' => 'media',
				'title' => esc_html__('Active header logotype image for retina', 'dfd-native'),
				'default' => array(
						'url' => $assets_folder . 'img/logo_white_retina.png'
					),
				'hint' => array(
						'title'   => esc_attr__('Header retina logotype','dfd-native'),
						'content' => esc_attr__('Select the image from the media library which will be set as logotype image for retina for the current header style','dfd-native')
					)
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Header style 9 options', 'dfd-native'),
		'subsection' => true,
		'icon' => 'dashicons dashicons-editor-kitchensink',
		'fields' => array(
			array(
				'id' => 'info_image_9',
				'type' => 'info',
				'class' => 'dfd-no-bg',
				'desc' => '<div class="description-image"><img src="'.  get_template_directory_uri().'/assets/img/headers/header-9.png" alt="'.esc_attr('Header style 9 preview','dfd-native').'" /></div>'
			),
			array(
				'id' => 'header_sticky_9',
				'type' => 'button_set',
				'title' => esc_html__('Header animation', 'dfd-native'),
				'options' => array('on' => esc_html__('On','dfd-native'), 'off' => esc_html__('Off','dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Header animation','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable the header animation on scroll','dfd-native')
				)
			),
			array(
				'id' => 'info_anim_effect_9',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Header animation effect', 'dfd-native') .'</h3>'
			),
			array(
				'id' => 'header_appear_effect_9',
				'type' => 'select',
				'title' => esc_html__('Header appearance effect', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'fade' => esc_html__('Fade', 'dfd-native'),
					'scale' => esc_html__('Grow', 'dfd-native'),
					'stretch' => esc_html__('Lazy Stretch', 'dfd-native'),
					'spill' => esc_html__('Spill', 'dfd-native'),
					'windscreen' => esc_html__('Windscreen wiper', 'dfd-native'),
					'lateral_swipe' => esc_html__('Lateral swipe', 'dfd-native'),
				),
				'default' => 'stretch',
				'hint' => array(
                    'title'   => esc_attr__('Header appearance effect','dfd-native'),
                    'content' => esc_attr__('Allows you to select the appear animation effect for the header','dfd-native')
                )
			),
			array(
				'id' => 'info_elements_9',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Header elements settings', 'dfd-native') .'</h3>'
			),
			array(
				'id' => 'header_login_9',
				'type' => 'button_set',
				'title' => esc_html__('Login form', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
						'title'   => esc_attr__('Login form','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the login form in the opened(active) header','dfd-native')
					)
			),
			array(
				'id' => 'head_show_header_soc_icons_9',
				'type' => 'button_set',
				'title' => esc_html__('Social icons', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
						'title'   => esc_attr__('Social icons','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the social icon in the opened (active) header, the socia icons can be added in Sicoal accounts section in theme options','dfd-native')
					)
			),
			array(
				'id' => 'show_search_form_header_9',
				'type' => 'button_set',
				'title' => esc_html__('Search form in header', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Search form','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable the search form in the opened (active) header','dfd-native')
				)
			),
			array(
				'id' => 'show_lang_sel_header_9',
				'type' => 'button_set',
				'title' => esc_html__('Language switcher in header', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Language switcher','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable the language switcher in header','dfd-native')
				)
			),
			array(
				'id' => 'show_cart_header_9',
				'type' => 'button_set',
				'title' => esc_html__('Shopping cart button in header', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'off',
				'hint' => array(
						'title'   => esc_attr__('Shopping cart','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the shopping cart button in the opened (active) header. Note, this option is available if Woocommerce plugin is installed','dfd-native')
					)
			),
			array(
				'id' => 'show_menu_icons_header_9',
				'type' => 'button_set',
				'title' => esc_html__('Menu icons', 'dfd-native'),
				'desc' => esc_html__('Please make sure that icons are defined for the top level navigation menu items in','dfd-native') . ' <a href="'.esc_url(admin_url()).'/nav-menus.php">'.esc_html__('Appearance -> Menus','dfd-native').'</a> ' . esc_html__('if you enable this option','dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Menu icons','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable icons in primary navigation.','dfd-native')
				)
			),
			array(
				'id' => 'info_color_9',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Header color settings', 'dfd-native') .'</h3>'
			),
			array(
				'id' => 'header_background_color_9',
				'type' => 'color',
				'title' => esc_html__('Header background color', 'dfd-native'),
				'default' => '',
				'validate' => 'color',
				'hint' => array(
						'title'   => esc_attr__('Background color','dfd-native'),
						'content' => esc_attr__('Choose the background color for the header main section','dfd-native')
					)
			),
			array(
				'id' => 'header_border_color_9',
				'type' => 'color',
				'title' => esc_html__('Header border color', 'dfd-native'),
				'default' => '',
				'validate' => 'color',
				'hint' => array(
						'title'   => esc_attr__('Border color','dfd-native'),
						'content' => esc_attr__('Choose the border color for the header','dfd-native')
					)
			),
			array(
				'id' => 'header_text_color_9',
				'type' => 'color',
				'title' => esc_html__('Header text color', 'dfd-native'),
				'default' => '',
				'validate' => 'color',
				'hint' => array(
						'title'   => esc_attr__('Text color','dfd-native'),
						'content' => esc_attr__('Choose the text color for the elements set in header','dfd-native')
					)
			),
			array(
				'id' => 'info_active_color_9',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Header active color settings', 'dfd-native') .'</h3>'
			),
			array(
				'id' => 'header_active_background_color_9',
				'type' => 'color',
				'title' => esc_html__('Active header background color', 'dfd-native'),
				'default' => '',
				'validate' => 'color',
				'hint' => array(
						'title'   => esc_attr__('Active background','dfd-native'),
						'content' => esc_attr__('Choose the background color for the opened (active) header','dfd-native')
					)
			),
			array(
				'id' => 'header_active_text_color_9',
				'type' => 'color',
				'title' => esc_html__('Active header text color', 'dfd-native'),
				'default' => '',
				'validate' => 'color',
				'hint' => array(
						'title'   => esc_attr__('Active text color','dfd-native'),
						'content' => esc_attr__('Choose the text color for the elements set in opened (active) header','dfd-native')
					)
			),
			array(
				'id' => 'info_header_content_9',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Header content settings', 'dfd-native') .'</h3>'
			),
			array(
				'id' => 'header_content_alignment_9',
				'type' => 'radio',
				'title' => esc_html__('Header content alignment', 'dfd-native'),
				'options' => Dfd_Theme_Helpers::dfd_alignment_options(),
				'default' => 'text-left',
				'hint' => array(
						'title'   => esc_attr__('Header content alignment','dfd-native'),
						'content' => esc_attr__('This option allows you to choose horizontal alignment for the header content','dfd-native')
					)
			),
			array(
				'id' => 'header_copyright_9',
				'type' => 'text',
				'title' => esc_html__('Copyright message', 'dfd-native'),
				'sub_desc' => esc_html__('Please do not use single quote here', 'dfd-native'),
				'validate' => 'html',
				'default' => '© DynamicFrameworks - Elite ThemeForest Author.',
				'hint' => array(
						'title'   => esc_attr__('Copyright','dfd-native'),
						'content' => esc_attr__('Add the copyright message which will be visible in opened (active) header','dfd-native')
					)
			),
			array(
				'id' => 'info_header_logos_9',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Header style 9 custom logos', 'dfd-native') .'</h3>'
			),
			array(
				'id' => 'logo_header_9',
				'type' => 'media',
				'title' => esc_html__('Header logotype image', 'dfd-native'),
				'default' => array(
						'url' => $assets_folder . 'img/logo_white.png',
						'width'		=> 77,
						'height'	=> 38,
					),
				'hint' => array(
						'title'   => esc_attr__('Header logotype','dfd-native'),
						'content' => esc_attr__('Select the image from the media library which will be set as logotype image for the current header style','dfd-native')
					)
			),
			array(
				'id' => 'retina_logo_header_9',
				'type' => 'media',
				'title' => esc_html__('Header logotype image for retina', 'dfd-native'),
				'default' => array(
						'url' => $assets_folder . 'img/logo_white_retina.png'
					),
				'hint' => array(
						'title'   => esc_attr__('Header retina logotype','dfd-native'),
						'content' => esc_attr__('Select the image from the media library which will be set as logotype image for retina for the current header style','dfd-native')
					)
			),
			array(
				'id' => 'small_logo_header_9',
				'type' => 'media',
				'title' => esc_html__('Active header logotype image', 'dfd-native'),
				'default' => array(
						'url' => $assets_folder . 'img/logo_white.png'
					),
				'hint' => array(
						'title'   => esc_attr__('Header logotype','dfd-native'),
						'content' => esc_attr__('Select the image from the media library which will be set as logotype image for the current header style','dfd-native')
					)
			),
			array(
				'id' => 'small_retina_logo_header_9',
				'type' => 'media',
				'title' => esc_html__('Active header logotype image for retina', 'dfd-native'),
				'default' => array(
						'url' => $assets_folder . 'img/logo_white_retina.png'
					),
				'hint' => array(
						'title'   => esc_attr__('Header retina logotype','dfd-native'),
						'content' => esc_attr__('Select the image from the media library which will be set as logotype image for retina for the current header style','dfd-native')
					)
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Header Style 10 options', 'dfd-native'),
		'subsection' => true,
		'icon' => 'dashicons dashicons-editor-kitchensink',
		'fields' => array(
			array(
				'id' => 'info_image_10',
				'type' => 'info',
				'class' => 'dfd-no-bg',
				'desc' => '<div class="description-image"><img src="'.  get_template_directory_uri().'/assets/img/headers/header-10.png" alt="'.esc_attr('Header style 10 preview','dfd-native').'" /></div>'
			),
			array(
				'id' => 'header_sticky_10',
				'type' => 'button_set',
				'title' => esc_html__('Header animation', 'dfd-native'),
				'options' => array('on' => esc_html__('On','dfd-native'), 'off' => esc_html__('Off','dfd-native')),
				'default' => 'on',
				'hint' => array(
						'title'   => esc_attr__('Header animation','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the header animation on scroll','dfd-native')
					)
			),
			array(
				'id' => 'show_menu_icons_header_10',
				'type' => 'button_set',
				'title' => esc_html__('Menu icons', 'dfd-native'),
				'desc' => esc_html__('Please make sure that icons are defined for the top level navigation menu items in','dfd-native') . ' <a href="'.esc_url(admin_url()).'/nav-menus.php">'.esc_html__('Appearance -> Menus','dfd-native').'</a> ' . esc_html__('if you enable this option','dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Menu icons','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable icons in primary navigation.','dfd-native')
				)
			),
			array(
				'id' => 'info_color_10',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Header color settings', 'dfd-native') .'</h3>'
			),
			array(
				'id' => 'header_background_color_10',
				'type' => 'color',
				'title' => esc_html__('Header background color', 'dfd-native'),
				'default' => '',
				'validate' => 'color',
				'hint' => array(
						'title'   => esc_attr__('Background color','dfd-native'),
						'content' => esc_attr__('Choose the background color for the header main section','dfd-native')
					)
			),
			array(
				'id' => 'header_border_color_10',
				'type' => 'color',
				'title' => esc_html__('Header border color', 'dfd-native'),
				'default' => '',
				'validate' => 'color',
				'hint' => array(
						'title'   => esc_attr__('Border color','dfd-native'),
						'content' => esc_attr__('Choose the border color for the header','dfd-native')
					)
			),
			array(
				'id' => 'header_text_color_10',
				'type' => 'color',
				'title' => esc_html__('Header text color', 'dfd-native'),
				'default' => '',
				'validate' => 'color',
				'hint' => array(
						'title'   => esc_attr__('Text color','dfd-native'),
						'content' => esc_attr__('Choose the text color for the elements set in header','dfd-native')
					)
			),
			array(
				'id' => 'info_header_logos_10',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Header style 10 custom logos', 'dfd-native') .'</h3>'
			),
			array(
				'id' => 'logo_header_10',
				'type' => 'media',
				'title' => esc_html__('Header logotype image', 'dfd-native'),
				'default' => array(
						'url' => $assets_folder . 'img/logo.png',
						'width'		=> 77,
						'height'	=> 38,
					),
				'hint' => array(
						'title'   => esc_attr__('Header logotype','dfd-native'),
						'content' => esc_attr__('Select the image from the media library which will be set as logotype image for the current header style','dfd-native')
					)
			),
			array(
				'id' => 'retina_logo_header_10',
				'type' => 'media',
				'title' => esc_html__('Header logotype image for retina', 'dfd-native'),
				'default' => array(
						'url' => $assets_folder . 'img/logo_retina.png'
					),
				'hint' => array(
						'title'   => esc_attr__('Header retina logotype','dfd-native'),
						'content' => esc_attr__('Select the image from the media library which will be set as logotype image for retina for the current header style','dfd-native')
					)
			),
			array(
				'id' => 'info_header_banner_10',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Header style 10 banner settings', 'dfd-native') .'</h3>'
			),
			array(
				'id' => 'show_banner_header_10',
				'type' => 'button_set',
				'title' => esc_html__('Banner', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'off',
				'hint' => array(
						'title'   => esc_attr__('Banner','dfd-native'),
						'content' => esc_attr__('This option allows you to add the banner with the custom link which will be set above the header','dfd-native')
					)
			),
			array(
				'id' => 'banner_image_url_10',
				'type' => 'media',
				'title' => esc_html__('Banner image URL', 'dfd-native'),
				'desc' => esc_html__('Select or upload the image for banner in header', 'dfd-native'),
				'required' => array(
					array('show_banner_header_10', '=', 'on'),
				),
				'default' => array(
						'url' => get_template_directory_uri() . '/assets/img/banner.jpg'
					),
				'hint' => array(
						'title'   => esc_attr__('Banner image URL','dfd-native'),
						'content' => esc_attr__('Add the custom image link or upload the image from the media library','dfd-native')
					)
			),
			array(
				'id' => 'banner_url_10',
				'type' => 'text',
				'title' => esc_html__('Banner URL', 'dfd-native'),
				'desc' => '',
				'validate' => 'url',
				'required' => array(
					array('show_banner_header_10', '=', 'on'),
				),
				'default' => 'http://nativewptheme.net',
				'hint' => array(
						'title'   => esc_attr__('Banner URL','dfd-native'),
						'content' => esc_attr__('This option allows you to add the link to your banner','dfd-native')
					)
			),
			array(
				'id' => 'header_content_alignment_10',
				'type' => 'radio',
				'title' => esc_html__('Header content alignment', 'dfd-native'),
				'options' => array(
					'alignleft' => esc_html__('Left', 'dfd-native'),
					'alignright' => esc_html__('Right', 'dfd-native'),
					'aligncenter' => esc_html__('Center', 'dfd-native'),
				),
				'required' => array(
					array('show_banner_header_10', '=', 'on'),
				),
				'default' => 'alignleft',
				'hint' => array(
						'title'   => esc_attr__('Header content alignment','dfd-native'),
						'content' => esc_attr__('This option allows you to choose horizontal alignment for the header content','dfd-native')
					)
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Header style 11 options', 'dfd-native'),
		'subsection' => true,
		'icon' => 'dashicons dashicons-editor-kitchensink',
		'fields' => array(
			array(
				'id' => 'info_image_11',
				'type' => 'info',
				'class' => 'dfd-no-bg',
				'desc' => '<div class="description-image"><img src="'.  get_template_directory_uri().'/assets/img/headers/header-11.png" alt="'.esc_attr('Header style 11 preview','dfd-native').'" /></div>'
			),
			array(
				'id' => 'header_sticky_11',
				'type' => 'button_set',
				'title' => esc_html__('Header animation', 'dfd-native'),
				'options' => array('on' => esc_html__('On','dfd-native'), 'off' => esc_html__('Off','dfd-native')),
				'default' => 'on',
				'hint' => array(
						'title'   => esc_attr__('Header animation','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the header animation on scroll','dfd-native')
					)
			),
			array(
				'id' => 'show_menu_icons_header_11',
				'type' => 'button_set',
				'title' => esc_html__('Menu icons', 'dfd-native'),
				'desc' => esc_html__('Please make sure that icons are defined for the top level navigation menu items in','dfd-native') . ' <a href="'.esc_url(admin_url()).'/nav-menus.php">'.esc_html__('Appearance -> Menus','dfd-native').'</a> ' . esc_html__('if you enable this option','dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Menu icons','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable icons in primary navigation.','dfd-native')
				)
			),
			array(
				'id' => 'info_header_color_11',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Header color settings', 'dfd-native') .'</h3>'
			),
			array(
				'id' => 'header_background_color_11',
				'type' => 'color',
				'title' => esc_html__('Header background color', 'dfd-native'),
				'default' => '',
				'validate' => 'color',
				'hint' => array(
						'title'   => esc_attr__('Background color','dfd-native'),
						'content' => esc_attr__('Choose the background color for the header main section','dfd-native')
					)
			),
			array(
				'id' => 'header_border_color_11',
				'type' => 'color',
				'title' => esc_html__('Header border color', 'dfd-native'),
				'default' => '',
				'validate' => 'color',
				'hint' => array(
						'title'   => esc_attr__('Border color','dfd-native'),
						'content' => esc_attr__('Choose the border color for the header','dfd-native')
					)
			),
			array(
				'id' => 'header_text_color_11',
				'type' => 'color',
				'title' => esc_html__('Header text color', 'dfd-native'),
				'default' => '',
				'validate' => 'color',
				'hint' => array(
						'title'   => esc_attr__('Text color','dfd-native'),
						'content' => esc_attr__('Choose the text color for the elements set in header','dfd-native')
					)
			),
			array(
				'id' => 'info_header_logos_11',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Header style 11 custom logos', 'dfd-native') .'</h3>'
			),
			array(
				'id' => 'logo_header_11',
				'type' => 'media',
				'title' => esc_html__('Header logotype image', 'dfd-native'),
				'default' => array(
						'url' => $assets_folder . 'img/logo_white.png',
						'width'		=> 77,
						'height'	=> 38,
					),
				'hint' => array(
						'title'   => esc_attr__('Header logotype','dfd-native'),
						'content' => esc_attr__('Select the image from the media library which will be set as logotype image for the current header style','dfd-native')
					)
			),
			array(
				'id' => 'retina_logo_header_11',
				'type' => 'media',
				'title' => esc_html__('Header logotype image for retina', 'dfd-native'),
				'default' => array(
						'url' => $assets_folder . 'img/logo_white_retina.png'
					),
				'hint' => array(
						'title'   => esc_attr__('Header retina logotype','dfd-native'),
						'content' => esc_attr__('Select the image from the media library which will be set as logotype image for retina for the current header style','dfd-native')
					)
			),
			array(
				'id' => 'info_header_banner_11',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Header style 11 banner settings', 'dfd-native') .'</h3>'
			),
			array(
				'id' => 'show_banner_header_11',
				'type' => 'button_set',
				'title' => esc_html__('Banner', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'off',
				'hint' => array(
						'title'   => esc_attr__('Banner','dfd-native'),
						'content' => esc_attr__('This option allows you to add the banner with the custom link which will be set above the header','dfd-native')
					)
			),
			array(
				'id' => 'banner_image_url_11',
				'type' => 'media',
				'title' => esc_html__('Banner image URL', 'dfd-native'),
				'desc' => esc_html__('Select or upload the image for banner in header', 'dfd-native'),
				'required' => array(
					array('show_banner_header_11', '=', 'on'),
				),
				'default' => array(
						'url' => get_template_directory_uri() . '/assets/img/banner.jpg'
					),
				'hint' => array(
						'title'   => esc_attr__('Banner image URL','dfd-native'),
						'content' => esc_attr__('Add the custom image link or upload the image from the media library','dfd-native')
					)
			),
			array(
				'id' => 'banner_url_11',
				'type' => 'text',
				'title' => esc_html__('Banner URL', 'dfd-native'),
				'desc' => '',
				'validate' => 'url',
				'required' => array(
					array('show_banner_header_11', '=', 'on'),
				),
				'default' => 'http://nativewptheme.net',
				'hint' => array(
						'title'   => esc_attr__('Banner URL','dfd-native'),
						'content' => esc_attr__('This option allows you to add the link to your banner','dfd-native')
					)
			),
			array(
				'id' => 'header_content_alignment_11',
				'type' => 'radio',
				'title' => esc_html__('Header content alignment', 'dfd-native'),
				'options' => array(
					'alignleft' => esc_html__('Left', 'dfd-native'),
					'alignright' => esc_html__('Right', 'dfd-native'),
					'aligncenter' => esc_html__('Center', 'dfd-native'),
				),
				'required' => array(
					array('show_banner_header_11', '=', 'on'),
				),
				'default' => 'alignleft',
				'hint' => array(
						'title'   => esc_attr__('Header content alignment','dfd-native'),
						'content' => esc_attr__('This option allows you to choose horizontal alignment for the header content','dfd-native')
					)
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Header style 12 options', 'dfd-native'),
		'subsection' => true,
		'icon' => 'dashicons dashicons-editor-kitchensink',
		'fields' => array(
			array(
				'id' => 'info_image_12',
				'type' => 'info',
				'class' => 'dfd-no-bg',
				'desc' => '<div class="description-image"><img src="'.  get_template_directory_uri().'/assets/img/headers/header-12.png" alt="'.esc_attr('Header style 12 preview','dfd-native').'" /></div>'
			),
			array(
				'id' => 'info_header_elements_12',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Header elements settings', 'dfd-native') .'</h3>'
			),
			array(
				'id' => 'header_login_12',
				'type' => 'button_set',
				'title' => esc_html__('Login form', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
						'title'   => esc_attr__('Login form','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the login form in the header','dfd-native')
					)
			),
			array(
				'id' => 'head_show_header_soc_icons_12',
				'type' => 'button_set',
				'title' => esc_html__('Social icons in header', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
						'title'   => esc_attr__('Social icons','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the social icons in mobile header, the social icons can be added in Social accounts section in theme options','dfd-native')
					)
			),
			array(
				'id' => 'show_search_form_header_12',
				'type' => 'button_set',
				'title' => esc_html__('Search form in header', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Search form','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable the search form in the header','dfd-native')
				)
			),
			array(
				'id' => 'show_lang_sel_header_12',
				'type' => 'button_set',
				'title' => esc_html__('Language switcher in header', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Language switcher','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable the language switcher in header','dfd-native')
				)
			),
			array(
				'id' => 'show_cart_header_12',
				'type' => 'button_set',
				'title' => esc_html__('Shopping cart button in header', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'off',
				'hint' => array(
						'title'   => esc_attr__('Shopping cart','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the shopping cart button in the header. Note, this option is available if Woocommerce plugin is installed','dfd-native')
					)
			),
			array(
				'id' => 'show_menu_icons_header_12',
				'type' => 'button_set',
				'title' => esc_html__('Menu icons', 'dfd-native'),
				'desc' => esc_html__('Please make sure that icons are defined for the top level navigation menu items in','dfd-native') . ' <a href="'.esc_url(admin_url()).'/nav-menus.php">'.esc_html__('Appearance -> Menus','dfd-native').'</a> ' . esc_html__('if you enable this option','dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Menu icons','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable icons in primary navigation.','dfd-native')
				)
			),
			array(
				'id' => 'info_header_color_13',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Header color settings', 'dfd-native') .'</h3>'
			),
			array(
				'id' => 'bg_image_header_12',
				'type' => 'media',
				'title' => esc_html__('Header background image', 'dfd-native'),
				'default' => array(
						'url' => ''
					),
				'hint' => array(
						'title'   => esc_attr__('Header background image','dfd-native'),
						'content' => esc_attr__('Select the image from the media library which will be set as a header background image','dfd-native')
					)
			),
			array(
				'id' => 'header_background_color_12',
				'type' => 'color',
				'title' => esc_html__('Header background color', 'dfd-native'),
				'default' => '',
				'validate' => 'color',
				'hint' => array(
						'title'   => esc_attr__('Background color','dfd-native'),
						'content' => esc_attr__('Choose the background color for the header main section','dfd-native')
					)
			),
			array(
				'id' => 'header_text_color_12',
				'type' => 'color',
				'title' => esc_html__('Header text color', 'dfd-native'),
				'default' => '',
				'validate' => 'color',
				'hint' => array(
						'title'   => esc_attr__('Text color','dfd-native'),
						'content' => esc_attr__('Choose the text color for the elements set in header','dfd-native')
					)
			),
			array(
				'id' => 'info_header_content_12',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Header content settings', 'dfd-native') .'</h3>'
			),
			array(
				'id' => 'header_alignment_12',
				'type' => 'radio',
				'title' => esc_html__('Header alignment', 'dfd-native'),
				'options' => array(
					'left' => esc_html__('Left','dfd-native'),
					'right' => esc_html__('Right','dfd-native'),
				),
				'default' => 'left',
				'hint' => array(
						'title'   => esc_attr__('Header alignment','dfd-native'),
						'content' => esc_attr__('Choose the position of the header according to the content','dfd-native')
					)
			),
			array(
				'id' => 'header_content_alignment_12',
				'type' => 'radio',
				'title' => esc_html__('Header content alignment', 'dfd-native'),
				'options' => Dfd_Theme_Helpers::dfd_alignment_options(),
				'default' => 'text-left',
				'hint' => array(
						'title'   => esc_attr__('Header content alignment','dfd-native'),
						'content' => esc_attr__('This option allows you to choose horizontal alignment for the header content','dfd-native')
					)
			),
			array(
				'id' => 'header_copyright_12',
				'type' => 'text',
				'title' => esc_html__('Copyright message', 'dfd-native'),
				'sub_desc' => esc_html__('Please do not use single quote here', 'dfd-native'),
				'validate' => 'html',
				'default' => '© DynamicFrameworks - Elite ThemeForest Author.',
				'hint' => array(
						'title'   => esc_attr__('Copyright','dfd-native'),
						'content' => esc_attr__('Add the copyright message which will be visible in header','dfd-native')
					)
			),
			array(
				'id' => 'info_header_logos_12',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Header style 12 custom logos', 'dfd-native') .'</h3>'
			),
			array(
				'id' => 'logo_header_12',
				'type' => 'media',
				'title' => esc_html__('Header logotype image', 'dfd-native'),
				'default' => array(
						'url' => $assets_folder . 'img/logo.png',
						'width'		=> 77,
						'height'	=> 38,
					),
				'hint' => array(
						'title'   => esc_attr__('Header logotype','dfd-native'),
						'content' => esc_attr__('Select the image from the media library which will be set as logotype image for the current header style','dfd-native')
					)
			),
			array(
				'id' => 'retina_logo_header_12',
				'type' => 'media',
				'title' => esc_html__('Header logotype image for retina', 'dfd-native'),
				'default' => array(
						'url' => $assets_folder . 'img/logo_retina.png'
					),
				'hint' => array(
						'title'   => esc_attr__('Header retina logotype','dfd-native'),
						'content' => esc_attr__('Select the image from the media library which will be set as logotype image for retina for the current header style','dfd-native')
					)
			),
		)
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Header style 13 options', 'dfd-native'),
		'subsection' => true,
		'icon' => 'dashicons dashicons-editor-kitchensink',
		'fields' => array(
			array(
				'id' => 'info_image_13',
				'type' => 'info',
				'class' => 'dfd-no-bg',
				'desc' => '<div class="description-image"><img src="'.  get_template_directory_uri().'/assets/img/headers/header-13.png" alt="'.esc_attr('Header style 13 preview','dfd-native').'" /></div>'
			),
			array(
				'id' => 'info_header_elements_13',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Header elements settings', 'dfd-native') .'</h3>'
			),
			array(
				'id' => 'header_login_13',
				'type' => 'button_set',
				'title' => esc_html__('Login form', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
						'title'   => esc_attr__('Login form','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the login form in the header','dfd-native')
					)
			),
			array(
				'id' => 'head_show_header_soc_icons_13',
				'type' => 'button_set',
				'title' => esc_html__('Social icons in header', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
						'title'   => esc_attr__('Social icons','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the social icons in mobile header, the social icons can be added in Social accounts section in theme options','dfd-native')
					)
			),
			array(
				'id' => 'show_search_form_header_13',
				'type' => 'button_set',
				'title' => esc_html__('Search form in header', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Search form','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable the search form in the header','dfd-native')
				)
			),
			array(
				'id' => 'show_lang_sel_header_13',
				'type' => 'button_set',
				'title' => esc_html__('Language switcher in header', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Language switcher','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable the language switcher in header','dfd-native')
				)
			),
			array(
				'id' => 'show_cart_header_13',
				'type' => 'button_set',
				'title' => esc_html__('Shopping cart in header', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'off',
				'hint' => array(
						'title'   => esc_attr__('Shopping cart','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the shopping cart button in the header. Note, this option is available if Woocommerce plugin is installed','dfd-native')
					)
			),
			array(
				'id' => 'show_menu_icons_header_13',
				'type' => 'button_set',
				'title' => esc_html__('Menu icons', 'dfd-native'),
				'desc' => esc_html__('Please make sure that icons are defined for the top level navigation menu items in','dfd-native') . ' <a href="'.esc_url(admin_url()).'/nav-menus.php">'.esc_html__('Appearance -> Menus','dfd-native').'</a> ' . esc_html__('if you enable this option','dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Menu icons','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable icons in primary navigation.','dfd-native')
				)
			),
			array(
				'id' => 'info_header_color_12',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Header color settings', 'dfd-native') .'</h3>'
			),
			array(
				'id' => 'bg_image_header_13',
				'type' => 'media',
				'title' => esc_html__('Header background image', 'dfd-native'),
				'default' => array(
						'url' => ''
					),
				'hint' => array(
						'title'   => esc_attr__('Header background image','dfd-native'),
						'content' => esc_attr__('Select the image from the media library which will be set as a header background image','dfd-native')
					)
			),
			array(
				'id' => 'header_background_color_13',
				'type' => 'color',
				'title' => esc_html__('Header background color', 'dfd-native'),
				'default' => '',
				'validate' => 'color',
				'hint' => array(
						'title'   => esc_attr__('Background color','dfd-native'),
						'content' => esc_attr__('Choose the background color for the header main section','dfd-native')
					)
			),
			array(
				'id' => 'header_text_color_13',
				'type' => 'color',
				'title' => esc_html__('Header text color', 'dfd-native'),
				'default' => '',
				'validate' => 'color',
				'hint' => array(
						'title'   => esc_attr__('Text color','dfd-native'),
						'content' => esc_attr__('Choose the text color for the elements set in header','dfd-native')
					)
			),
			array(
				'id' => 'header_navbutton_background_color_13',
				'type' => 'color',
				'title' => esc_html__('Menu button background color', 'dfd-native'),
				'default' => '',
				'validate' => 'color',
				'hint' => array(
						'title'   => esc_attr__('Menu button background','dfd-native'),
						'content' => esc_attr__('Choose the background color for the inactive header','dfd-native')
					)
				
			),
			array(
				'id' => 'header_navbutton_text_color_13',
				'type' => 'color',
				'title' => esc_html__('Menu button color', 'dfd-native'),
				'default' => '',
				'validate' => 'color',
				'hint' => array(
						'title'   => esc_attr__('Menu button background','dfd-native'),
						'content' => esc_attr__('Choose the color for the menu button','dfd-native')
					)
			),
			array(
				'id' => 'info_header_content_13',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Header content settings', 'dfd-native') .'</h3>'
			),
			array(
				'id' => 'header_alignment_13',
				'type' => 'radio',
				'title' => esc_html__('Header alignment', 'dfd-native'),
				'options' => array(
					'left' => esc_html__('Left','dfd-native'),
					'right' => esc_html__('Right','dfd-native'),
				),
				'default' => 'left',
				'hint' => array(
						'title'   => esc_attr__('Header alignment','dfd-native'),
						'content' => esc_attr__('Choose the position of the header according to the content','dfd-native')
					)
			),
			array(
				'id' => 'header_content_alignment_13',
				'type' => 'radio',
				'title' => esc_html__('Header content alignment', 'dfd-native'),
				'options' => Dfd_Theme_Helpers::dfd_alignment_options(),
				'default' => 'text-left',
			),
			array(
				'id' => 'header_copyright_13',
				'type' => 'text',
				'title' => esc_html__('Copyright message', 'dfd-native'),
				'sub_desc' => esc_html__('Please do not use single quote here', 'dfd-native'),
				'validate' => 'html',
				'default' => '© DynamicFrameworks - Elite ThemeForest Author.',
				'hint' => array(
						'title'   => esc_attr__('Copyright','dfd-native'),
						'content' => esc_attr__('Add the copyright message which will be visible in header','dfd-native')
					)
			),
			array(
				'id' => 'info_header_logos_13',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Header style 13 custom logos', 'dfd-native') .'</h3>'
			),
			array(
				'id' => 'small_logo_header_13',
				'type' => 'media',
				'title' => esc_html__('Header logotype image', 'dfd-native'),
				'default' => array(
						'url' => $assets_folder . 'img/logo_small.png'
					),
				'hint' => array(
						'title'   => esc_attr__('Header logotype','dfd-native'),
						'content' => esc_attr__('Select the image from the media library which will be set as logotype image for the current header style','dfd-native')
					)
			),
			array(
				'id' => 'small_retina_logo_header_13',
				'type' => 'media',
				'title' => esc_html__('Header logotype image for retina', 'dfd-native'),
				'default' => array(
						'url' => $assets_folder . 'img/logo_small_retina.png'
					),
				'hint' => array(
						'title'   => esc_attr__('Header retina logotype','dfd-native'),
						'content' => esc_attr__('Select the image from the media library which will be set as logotype image for retina for the current header style','dfd-native')
					)
			),
			array(
				'id' => 'logo_header_13',
				'type' => 'media',
				'title' => esc_html__('Active header logotype image', 'dfd-native'),
				'default' => array(
						'url' => $assets_folder . 'img/logo.png',
						'width'		=> 77,
						'height'	=> 38,
					),
				'hint' => array(
						'title'   => esc_attr__('Header logotype','dfd-native'),
						'content' => esc_attr__('Select the image from the media library which will be set as logotype image for the current header style','dfd-native')
					)
			),
			array(
				'id' => 'retina_logo_header_13',
				'type' => 'media',
				'title' => esc_html__('Active header logotype image for retina', 'dfd-native'),
				'default' => array(
						'url' => $assets_folder . 'img/logo_retina.png'
					),
				'hint' => array(
						'title'   => esc_attr__('Header retina logotype','dfd-native'),
						'content' => esc_attr__('Select the image from the media library which will be set as logotype image for retina for the current header style','dfd-native')
					)
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Header style 14 options', 'dfd-native'),
		'subsection' => true,
		'icon' => 'dashicons dashicons-editor-kitchensink',
		'fields' => array(
			array(
				'id' => 'info_image_14',
				'type' => 'info',
				'class' => 'dfd-no-bg',
				'desc' => '<div class="description-image"><img src="'.  get_template_directory_uri().'/assets/img/headers/header-14.png" alt="'.esc_attr('Header style 14 preview','dfd-native').'" /></div>'
			),
			array(
				'id' => 'info_header_elements_14',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Header elements settings', 'dfd-native') .'</h3>'
			),
			array(
				'id' => 'head_show_header_soc_icons_14',
				'type' => 'button_set',
				'title' => esc_html__('Social icons in header', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
						'title'   => esc_attr__('Social icons','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the social icons in mobile header, the social icons can be added in Social accounts section in theme options','dfd-native')
					)
			),
			array(
				'id' => 'show_search_form_header_14',
				'type' => 'button_set',
				'title' => esc_html__('Search form in header', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Search form','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable the search form in the header','dfd-native')
				)
			),
			array(
				'id' => 'show_lang_sel_header_14',
				'type' => 'button_set',
				'title' => esc_html__('Language switcher in header', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Language switcher','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable the language switcher in header','dfd-native')
				)
			),
			array(
				'id' => 'show_cart_header_14',
				'type' => 'button_set',
				'title' => esc_html__('Shopping cart button in header', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'off',
				'hint' => array(
						'title'   => esc_attr__('Shopping cart','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the shopping cart button in the header. Note, this option is available if Woocommerce plugin is installed','dfd-native')
					)
			),
			array(
				'id' => 'show_menu_icons_header_14',
				'type' => 'button_set',
				'title' => esc_html__('Menu icons', 'dfd-native'),
				'desc' => esc_html__('Please make sure that icons are defined for the top level navigation menu items in','dfd-native') . ' <a href="'.esc_url(admin_url()).'/nav-menus.php">'.esc_html__('Appearance -> Menus','dfd-native').'</a> ' . esc_html__('if you enable this option','dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Menu icons','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable icons in primary navigation.','dfd-native')
				)
			),
			array(
				'id' => 'info_header_color_14',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Header color settings', 'dfd-native') .'</h3>'
			),
			array(
				'id' => 'header_background_color_14',
				'type' => 'color',
				'title' => esc_html__('Header background color', 'dfd-native'),
				'default' => '',
				'validate' => 'color',
				'hint' => array(
						'title'   => esc_attr__('Background color','dfd-native'),
						'content' => esc_attr__('Choose the background color for the header main section','dfd-native')
					)
			),
			array(
				'id' => 'header_text_color_14',
				'type' => 'color',
				'title' => esc_html__('Header text color', 'dfd-native'),
				'default' => '',
				'validate' => 'color',
				'hint' => array(
						'title'   => esc_attr__('Text color','dfd-native'),
						'content' => esc_attr__('Choose the text color for the elements set in header','dfd-native')
					)
			),
			array(
				'id' => 'info_header_content_14',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Header content settings', 'dfd-native') .'</h3>'
			),
			array(
				'id' => 'header_alignment_14',
				'type' => 'radio',
				'title' => esc_html__('Header alignment', 'dfd-native'),
				'options' => array(
					'left' => esc_html__('Left','dfd-native'),
					'right' => esc_html__('Right','dfd-native'),
				),
				'default' => 'left',
				'hint' => array(
						'title'   => esc_attr__('Header alignment','dfd-native'),
						'content' => esc_attr__('Choose the position of the header according to the content','dfd-native')
					)
			),
			array(
				'id' => 'header_copyright_14',
				'type' => 'text',
				'title' => esc_html__('Copyright message', 'dfd-native'),
				'sub_desc' => esc_html__('Please do not use single quote here', 'dfd-native'),
				'validate' => 'html',
				'default' => '©DFD',
				'hint' => array(
						'title'   => esc_attr__('Copyright','dfd-native'),
						'content' => esc_attr__('Add the copyright message which will be visible in header','dfd-native')
					)
			),
			array(
				'id' => 'info_header_logos_14',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Header style 14 custom logos', 'dfd-native') .'</h3>'
			),
			array(
				'id' => 'logo_header_14',
				'type' => 'media',
				'title' => esc_html__('Header logotype image', 'dfd-native'),
				'default' => array(
						'url' => $assets_folder . 'img/logo_small.png'
					),
				'hint' => array(
						'title'   => esc_attr__('Header logotype','dfd-native'),
						'content' => esc_attr__('Select the image from the media library which will be set as logotype image for the current header style','dfd-native')
					)
			),
			array(
				'id' => 'retina_logo_header_14',
				'type' => 'media',
				'title' => esc_html__('Header logotype image for retina', 'dfd-native'),
				'default' => array(
						'url' => $assets_folder . 'img/logo_small_retina.png'
					),
				'hint' => array(
						'title'   => esc_attr__('Header retina logotype','dfd-native'),
						'content' => esc_attr__('Select the image from the media library which will be set as logotype image for retina for the current header style','dfd-native')
					)
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Mobile header options', 'dfd-native'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'dashicons dashicons-editor-kitchensink',
		'subsection' => true,
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'info_mobile_menu_position',
				'type' => 'info',
				'desc' => '<h3 class="description">'.__('Mobile menu position', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'mobile_menu_position',
				'type' => 'radio',
				'title' => esc_html__('Mobile menu position', 'dfd-native'),
				'options' => array(
					'left' => esc_html__('Left','dfd-native'),
					'right' => esc_html__('Right','dfd-native'),
				),
				'default' => 'left',
				'hint' => array(
						'title'   => esc_attr__('Mobile menu position','dfd-native'),
						'content' => esc_attr__('Choose the position of the mobile menu according to the content','dfd-native')
					)
			),
			array(
				'id' => 'info_mobile_header_color',
				'type' => 'info',
				'desc' => '<h3 class="description">'.__('Mobile header color settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'mobile_header_bg',
				'type' => 'color',
				'title' => esc_html__('Header background color', 'dfd-native'),
				'desc' => '',
				'default' => '#ffffff',
				'validate' => 'color',
				'hint' => array(
						'title'   => esc_attr__('Background color','dfd-native'),
						'content' => esc_attr__('Choose the background color for the mobile header','dfd-native')
					)
			),
			array(
				'id' => 'mobile_header_color',
				'type' => 'color',
				'title' => esc_html__('Header elements color', 'dfd-native'),
				'desc' => '',
				'default' => '#000000',
				'validate' => 'color',
				'hint' => array(
						'title'   => esc_attr__('Elements color','dfd-native'),
						'content' => esc_attr__('Choose the text color for the elements set in mobile header','dfd-native')
					)
			),
			array(
				'id' => 'mobile_header_border_color',
				'type' => 'color',
				'title' => esc_html__('Header border color', 'dfd-native'),
				'desc' => '',
				'default' => '#e7e7e7',
				'validate' => 'color',
				'hint' => array(
						'title'   => esc_attr__('Border color','dfd-native'),
						'content' => esc_attr__('Choose the border color for the mobile header','dfd-native')
					)
			),
			array(
				'id' => 'mobile_menu_bg',
				'type' => 'color',
				'title' => esc_html__('Menu background color', 'dfd-native'),
				'desc' => '',
				'default' => '#1d1e20',
				'validate' => 'color',
				'hint' => array(
						'title'   => esc_attr__('Opened menu background','dfd-native'),
						'content' => esc_attr__('Choose the background color for the opened(active) mobile header','dfd-native')
					)
			),
			array(
				'id' => 'mobile_menu_delim',
				'type' => 'color',
				'title' => esc_html__('Menu delimiter color', 'dfd-native'),
				'desc' => '',
				'default' => '#232527',
				'validate' => 'color',
				'hint' => array(
						'title'   => esc_attr__('Opened menu delimiter','dfd-native'),
						'content' => esc_attr__('Choose the delimiter color for the opened(active) mobile header','dfd-native')
					)
			),
			array(
				'id' => 'mobile_submenu_bg',
				'type' => 'color',
				'title' => esc_html__('Third level menu background color', 'dfd-native'),
				'desc' => '',
				'default' => '#191a1c',
				'validate' => 'color',
				'hint' => array(
						'title'   => esc_attr__('Third level background','dfd-native'),
						'content' => esc_attr__('This option allows you to set the background color for the third level menu','dfd-native')
					)
			),
			array(
				'id' => 'info_mobile_header_elements',
				'type' => 'info',
				'desc' => '<h3 class="description">'.__('Mobile header elements settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'soc_icons_mobile_header',
				'type' => 'button_set',
				'title' => esc_html__('Social icons', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Social icons','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable the social icons in mobile header, the social icons can be added in Social accounts section in theme options','dfd-native')
				)
			),
			array(
				'id' => 'lang_sel_mobile_header',
				'type' => 'button_set',
				'title' => esc_html__('Language switcher', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
                    'title'   => esc_attr__('Language switcher','dfd-native'),
                    'content' => esc_attr__('This option allows you to enable or disable the language switcher in mobile header','dfd-native')
                )
			),
			array(
				'id' => 'cart_button_mobile_header',
				'type' => 'button_set',
				'title' => esc_html__('Shopping cart button', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Shopping cart','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable the shopping cart button in mobile header. Note, this option is available if Woocommerce plugin is installed','dfd-native')
				)
			),
			array(
				'id' => 'serach_button_mobile_header',
				'type' => 'button_set',
				'title' => esc_html__('Search form', 'dfd-native'),
				'desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Search form','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable the search form in mobile header','dfd-native')
				)
			),
			array(
				'id' => 'mobile_logo_image',
				'type' => 'media',
				'title' => esc_html__('Logo for mobile devices', 'dfd-native'),
				'desc' => esc_html__('Select logo to be displayed on mobile devices.', 'dfd-native'),
				'default' => array(
						'url' => ''
					),
				'hint' => array(
                    'title'   => esc_attr__('Mobile logotype','dfd-native'),
                    'content' => esc_attr__('Select an image from the media library and upload it as mobile header logotype','dfd-native')
                )
			),
			array(
				'id' => 'mobile_retina_logo_image',
				'type' => 'media',
				'title' => esc_html__('Retina logo for mobile devices', 'dfd-native'),
				'desc' => esc_html__('Select logo to be displayed on mobile devices.', 'dfd-native'),
				'default' => array(
						'url' => ''
					),
				'hint' => array(
                    'title'   => esc_attr__('Mobile logotype','dfd-native'),
                    'content' => esc_attr__('Select an image from the media library and upload it as mobile header logotype','dfd-native')
                )
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Side area options', 'dfd-native'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'dashicons dashicons-editor-outdent',
		'subsection' => true,
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'side_area_enable',
				'type' => 'button_set',
				'title' => esc_html__('Side area by default', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Side area','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable the side area by default. There is also an option on the item\'s page if you need to enable or disable the sidearea on the single page','dfd-native')
				)
			),
			array(
				'id' => 'side_area_bg_color',
				'type' => 'color',
				'validate' => 'color',
				'title' => esc_html__('Background color', 'dfd-native'),
				'default' => '#1d1e20',
				'hint' => array(
					'title'   => esc_attr__('Background color','dfd-native'),
					'content' => esc_attr__('This option allows you to set the background color for the side area','dfd-native')
				),
				'required' => array( 'side_area_enable', "=", 'on' )
			),
			array(
				'id' => 'side_area_bg_image',
				'type' => 'media',
				'title' => esc_html__('Background image', 'dfd-native'),
				'desc' => '',
				'default' => array(
					'url' => '',
				),
				'hint' => array(
					'title'   => esc_attr__('Background image','dfd-native'),
					'content' => esc_attr__('Upload the custom image from the media library for the side area background','dfd-native')
				),
				'required' => array( 'side_area_enable', "=", 'on' )
			),
			array(
				'id' => 'side_area_bg_position',
				'type' => 'select',
				'title' => esc_html__('Background position', 'dfd-native'),
				'desc' => '',
				'options' => Dfd_Theme_Helpers::dfd_get_bgposition(),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Background position','dfd-native'),
					'content' => esc_attr__('This option allows you to choose the position for the background image','dfd-native')
				),
				'required' => array( 'side_area_enable', "=", 'on' )
			),
			array(
				'id' => 'side_area_bg_repeat',
				'type' => 'radio',
				'title' => esc_html__('Background repeat', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'no-repeat' => esc_html__('No-Repeat','dfd-native'),
					'repeat-x' => esc_html__('Repeat X','dfd-native'),
					'repeat-y' => esc_html__('Repeat Y','dfd-native'),
					'repeat' => esc_html__('Repeat','dfd-native'),
				),
				'default' => 'no-repeat',
				'hint' => array(
					'title'   => esc_attr__('Background repeat','dfd-native'),
					'content' => esc_attr__('This option allows you to choose the repeat for the background image','dfd-native')
				),
				'required' => array( 'side_area_enable', "=", 'on' )
			),
			array(
				'id' => 'side_area_bg_size',
				'type' => 'radio',
				'title' => esc_html__('Background size', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'initial' => esc_html__('Initial','dfd-native'),
					'cover' => esc_html__('Cover','dfd-native'),
					'contain' => esc_html__('Contain','dfd-native'),
				),
				'default' => 'cover',
				'hint' => array(
					'title'   => esc_attr__('Background size','dfd-native'),
					'content' => esc_attr__('This option allows you to set the background size for the background image','dfd-native')
				),
				'required' => array( 'side_area_enable', "=", 'on' )
			),
			array(
				'id' => 'side_area_bg_dark',
				'type' => 'button_set',
				'title' => esc_html__('Dark background', 'dfd-native'),
				'options' => array('on' => esc_html__('Yes', 'dfd-native'), 'off' => esc_html__('No', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
                    'title'   => esc_attr__('Dark background','dfd-native'),
                    'content' => esc_attr__('Enable this option if you\'ve set dark background color. The text color will be changed to make the text more readable','dfd-native')
                ),
				'required' => array( 'side_area_enable', "=", 'on' )
			),
		)
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Footer section options', 'dfd-native'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'dashicons dashicons-format-aside',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'info_footer_base',
				'type' => 'info',
				'desc' => '<h3 class="description">'.__('Main footer settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'footer_variant',
				'type' => 'radio',
				'title' => esc_html__('Footer variants', 'dfd-native'),
				'options' => array(
					'1' => esc_html__('Compact', 'dfd-native'),
					'2' => esc_html__('Widgetized', 'dfd-native'),
					'3' => esc_html__('Visual Composer page', 'dfd-native'),
					'4' => esc_html__('Disable', 'dfd-native'),
				),
				'default' => '1',
				'hint' => array(
                    'title'   => esc_attr__('Footer variants','dfd-native'),
                    'content' => esc_attr__('This option allows you to choose the variant for your footer','dfd-native')
                )
			),
			array(
				'id' => 'footer_layout_width',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Layout width', 'dfd-native'),
				'desc' => '',
				'options' => Dfd_Theme_Helpers::dfd_layout_width(),
				'required' => array(
					array('footer_variant', "!=", '3'),
					array('footer_variant', "!=", '4'),
				),
				'default' => '',
				'hint' => array(
                    'title'   => esc_attr__('Layout width','dfd-native'),
                    'content' => esc_attr__('This option defines the footer content width','dfd-native')
                )
			),
			array(
				'id' => 'enable_footer_logo',
				'type' => 'button_set',
				'title' => esc_html__('Footer logotype', 'dfd-native'),
				'options' => array('1' => esc_html__('On', 'dfd-native'), '0' => esc_html__('Off', 'dfd-native')),
				'required' => array( 'footer_variant', "=", '1' ),
				'default' => '1',// 1 = on | 0 = off
				'hint' => array(
                    'title'   => esc_attr__('Footer logotype','dfd-native'),
                    'content' => esc_attr__('This option allows you to show the logotype image in footer','dfd-native')
                )
			),
			array(
				'id' => 'logo_footer',
				'type' => 'media',
				'title' => esc_html__('Logotype image', 'dfd-native'),
				'required' => array( 'enable_footer_logo', "=", '1' ),
				'default' => array(
						'url' => $assets_folder . 'img/logo_white.png'
					),
				'hint' => array(
						'title'   => esc_attr__('Logotype','dfd-native'),
						'content' => esc_attr__('Select the image from the media library which will be set as logotype image for the footer','dfd-native')
					)
			),
			array(
				'id' => 'enable_footer_soc_icons',
				'type' => 'button_set',
				'title' => esc_html__('Social icons', 'dfd-native'),
				'options' => array('1' => esc_html__('On', 'dfd-native'), '0' => esc_html__('Off', 'dfd-native')),
				'required' => array( 'footer_variant', "=", '1' ),
				'default' => '1',// 1 = on | 0 = off
				'hint' => array(
						'title'   => esc_attr__('Social icons','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the social icons in footer, the social icons can be added in Social accounts section in theme options','dfd-native')
					)
			),
			array(
				'id' => 'enable_footer_menu',
				'type' => 'button_set',
				'title' => esc_html__('Footer menu', 'dfd-native'),
				'options' => array('1' => esc_html__('On', 'dfd-native'), '0' => esc_html__('Off', 'dfd-native')),
				'required' => array( 'footer_variant', "=", '1' ),
				'default' => '0',// 1 = on | 0 = off
				'hint' => array(
						'title'   => esc_attr__('Footer menu','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the menu in footer, the menu can be set in Appearance > Menus > Manage locations > Footer navigation','dfd-native')
					)
				
			),
			array(
				'id' => 'footer_page_select',
				'type'     => 'select',
				'data'     => 'pages',
				'title' => esc_html__('Footer page', 'dfd-native'),
				'desc' => esc_html__('Please select Footer Section Page', 'dfd-native'),
				'required' => array( 'footer_variant', "=", 3 ),
				'hint' => array(
						'title'   => esc_attr__('Footer page','dfd-native'),
						'content' => esc_attr__('Select the page which will be set as footer on your site','dfd-native')
					)
			),
			array(
				'id' => 'info_subfooter_base',
				'type' => 'info',
				'desc' => '<h3 class="description">'.__('Main subfooter settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'enable_subfooter',
				'type' => 'button_set',
				'title' => esc_html__('Subfooter', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',// 1 = on | 0 = off
				'hint' => array(
						'title'   => esc_attr__('Subfooter','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the subfooter on your site','dfd-native')
					)
			),
			array(
				'id' => 'subfooter_layout_width',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Layout width', 'dfd-native'),
				'desc' => '',
				'options' => Dfd_Theme_Helpers::dfd_layout_width(),
				'required' => array( 'enable_subfooter', "=", 'on' ),
				'default' => '',
				'hint' => array(
                    'title'   => esc_attr__('Layout width','dfd-native'),
                    'content' => esc_attr__('This option defines the subfooter content width','dfd-native')
                )
			),
			array(
				'id' => 'subfooter_columns',
				'type' => 'radio',
				'title' => esc_html__('Columns number', 'dfd-native'),
				'options' => array(
					'1' => esc_html__('One', 'dfd-native'),
					'2' => esc_html__('Two', 'dfd-native'),
					'3' => esc_html__('Three', 'dfd-native'),
				),
				'required' => array( 'enable_subfooter', "=", 'on' ),
				'default' => '1',
				'hint' => array(
                    'title'   => esc_attr__('Columns','dfd-native'),
                    'content' => esc_attr__('This option allows you to set one, two or three columns for the subfooter','dfd-native')
                )
			),
			array(
				'id' => 'subfooter_column_1_content',
				'type' => 'radio',
				'title' => esc_html__('First column content', 'dfd-native'),
				'options' => array(
					'copyright' => esc_html__('Copyright', 'dfd-native'),
					'logo' => esc_html__('Logo', 'dfd-native'),
					'soc_icons' => esc_html__('Social networks', 'dfd-native'),
				),
				'required' => array( 'enable_subfooter', "=", 'on' ),
				'default' => 'copyright',
				'hint' => array(
                    'title'   => esc_attr__('Column content','dfd-native'),
                    'content' => esc_attr__('This option allows you to choose what should be displayed in the first subfooter column','dfd-native')
                )
			),
			array(
				'id' => 'subfooter_column_1_content_align',
				'type' => 'radio',
				'title' => esc_html__('First column content alignment', 'dfd-native'),
				'options' => Dfd_Theme_Helpers::dfd_alignment_options(),
				'default' => 'text-center',
				'hint' => array(
						'title'   => esc_attr__('Content alignment','dfd-native'),
						'content' => esc_attr__('This option allows you to choose horizontal alignment for first column','dfd-native')
					)
				
			),
			array(
				'id' => 'copyright_subfooter_1',
				'type' => 'textarea',
				'title' => esc_html__('Copyright message', 'dfd-native'),
				'desc' => esc_html__('Fill in the copyright text.', 'dfd-native'),
				'validate' => 'html',
				'default' => '© DynamicFrameworks- Elite ThemeForest Author.',
				'required' => array( 'subfooter_column_1_content', "=", 'copyright' ),
				'hint' => array(
						'title'   => esc_attr__('Copyright','dfd-native'),
						'content' => esc_attr__('Add the copyright message which will be visible in subfooter','dfd-native')
					)
			),
			array(
				'id' => 'logo_subfooter_1',
				'type' => 'media',
				'title' => esc_html__('Logotype', 'dfd-native'),
				'required' => array( 'subfooter_column_1_content', "=", 'logo' ),
				'default' => array(
						'url' => $assets_folder . 'img/logo.png'
					),
				'hint' => array(
						'title'   => esc_attr__('Header logotype','dfd-native'),
						'content' => esc_attr__('Select the image from the media library which will be set as logotype image for the subfooter','dfd-native')
					)
			),
			array(
				'id' => 'subfooter_column_2_content',
				'type' => 'radio',
				'title' => esc_html__('Second column content', 'dfd-native'),
				'options' => array(
					'copyright' => esc_html__('Copyright', 'dfd-native'),
					'logo' => esc_html__('Logo', 'dfd-native'),
					'soc_icons' => esc_html__('Social networks', 'dfd-native'),
				),
				'required' => array('subfooter_columns', "!=", '1'),
				'default' => 'logo',
				'hint' => array(
                    'title'   => esc_attr__('Column content','dfd-native'),
                    'content' => esc_attr__('This option allows you to choose what should be displayed in the second subfooter column','dfd-native')
                )
			),
			array(
				'id' => 'subfooter_column_2_content_align',
				'type' => 'radio',
				'title' => esc_html__('Second column content alignment', 'dfd-native'),
				'options' => Dfd_Theme_Helpers::dfd_alignment_options(),
				'required' => array('subfooter_columns', "!=", '1'),
				'default' => 'text-center',
				'hint' => array(
						'title'   => esc_attr__('Content alignment','dfd-native'),
						'content' => esc_attr__('This option allows you to choose horizontal alignment for second column','dfd-native')
					)
			),
			array(
				'id' => 'copyright_subfooter_2',
				'type' => 'textarea',
				'title' => esc_html__('Copyright message', 'dfd-native'),
				'desc' => esc_html__('Fill in the copyright text.', 'dfd-native'),
				'validate' => 'html',
				'default' => '© DynamicFrameworks- Elite ThemeForest Author.',
				'required' => array( 'subfooter_column_2_content', "=", 'copyright' ),
				'hint' => array(
						'title'   => esc_attr__('Copyright','dfd-native'),
						'content' => esc_attr__('Add the copyright message which will be visible in subfooter','dfd-native')
					)
			),
			array(
				'id' => 'logo_subfooter_2',
				'type' => 'media',
				'title' => esc_html__('Logotype', 'dfd-native'),
				'required' => array( 'subfooter_column_2_content', "=", 'logo' ),
				'default' => array(
						'url' => $assets_folder . 'img/logo.png'
					),
				'hint' => array(
						'title'   => esc_attr__('Header logotype','dfd-native'),
						'content' => esc_attr__('Select the image from the media library which will be set as logotype image for the subfooter','dfd-native')
					)
			),
			array(
				'id' => 'subfooter_column_3_content',
				'type' => 'radio',
				'title' => esc_html__('Third column content', 'dfd-native'),
				'options' => array(
					'copyright' => esc_html__('Copyright', 'dfd-native'),
					'logo' => esc_html__('Logo', 'dfd-native'),
					'soc_icons' => esc_html__('Social networks', 'dfd-native'),
				),
				'required' => array('subfooter_columns', "=", '3'),
				'default' => 'soc_icons',
				'hint' => array(
                    'title'   => esc_attr__('Column content','dfd-native'),
                    'content' => esc_attr__('This option allows you to choose what should be displayed in the third subfooter column','dfd-native')
                )
			),
			array(
				'id' => 'subfooter_column_3_content_align',
				'type' => 'radio',
				'title' => esc_html__('Third column content alignment', 'dfd-native'),
				'options' => Dfd_Theme_Helpers::dfd_alignment_options(),
				'required' => array('subfooter_columns', "=", '3'),
				'default' => 'text-center',
				'hint' => array(
						'title'   => esc_attr__('Content alignment','dfd-native'),
						'content' => esc_attr__('This option allows you to choose horizontal alignment for third column','dfd-native')
					)
			),
			array(
				'id' => 'copyright_subfooter_3',
				'type' => 'textarea',
				'title' => esc_html__('Copyright message', 'dfd-native'),
				'desc' => esc_html__('Fill in the copyright text.', 'dfd-native'),
				'validate' => 'html',
				'default' => '© DynamicFrameworks- Elite ThemeForest Author.',
				'required' => array( 'subfooter_column_3_content', "=", 'copyright' ),
				'hint' => array(
						'title'   => esc_attr__('Copyright','dfd-native'),
						'content' => esc_attr__('Add the copyright message which will be visible in subfooter','dfd-native')
					)
			),
			array(
				'id' => 'logo_subfooter_3',
				'type' => 'media',
				'title' => esc_html__('Logotype', 'dfd-native'),
				'required' => array( 'subfooter_column_3_content', "=", 'logo' ),
				'default' => array(
						'url' => $assets_folder . 'img/logo.png'
					),
				'hint' => array(
						'title'   => esc_attr__('Header logotype','dfd-native'),
						'content' => esc_attr__('Select the image from the media library which will be set as logotype image for the subfooter','dfd-native')
					)
			),
			array(
				'id' => 'info_foot',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Footer styling options', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'footer_bg_color',
				'type' => 'color',
				'validate' => 'color',
				'title' => esc_html__('Footer background color', 'dfd-native'),
				'default' => '#323232',
				'hint' => array(
						'title'   => esc_attr__('Footer background','dfd-native'),
						'content' => esc_attr__('Select the footer background color','dfd-native')
					)
			),
			array(
				'id' => 'footer_bg_dark',
				'type' => 'button_set',
				'title' => esc_html__('Dark background', 'dfd-native'),
				'desc' => '',
				'options' => array('1' => esc_html__('Yes', 'dfd-native'), '0' => esc_html__('No', 'dfd-native')),
				'default' => '1',
				'hint' => array(
                    'title'   => esc_attr__('Dark background','dfd-native'),
                    'content' => esc_attr__('Enable this option if you\'ve set dark background color. The text color will be changed to make the text more readable','dfd-native')
                )
			),
			array(
				'id' => 'footer_bg_image',
				'type' => 'media',
				'title' => esc_html__('Background image', 'dfd-native'),
				'default' => array(
					'url' => ''
				),
				'hint' => array(
						'title'   => esc_attr__('Background image','dfd-native'),
						'content' => esc_attr__('Upload the custom image from the media library for the footer background','dfd-native')
					)
			),
			array(
				'id' => 'footer_custom_repeat',
				'type' => 'radio',
				'title' => esc_html__('Background repeat', 'dfd-native'),
				'options' => array(
					'no-repeat' => esc_html__('No-Repeat','dfd-native'),
					'repeat-x' => esc_html__('Repeat X','dfd-native'),
					'repeat-y' => esc_html__('Repeat Y','dfd-native'),
					'repeat' => esc_html__('Repeat','dfd-native'),
				),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Background repeat','dfd-native'),
					'content' => esc_attr__('This option allows you to choose the repeat for the background image','dfd-native')
				)
			),
			array(
				'id' => 'info_sub_foot',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Subfooter styling options', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'sub_footer_bg_color',
				'type' => 'color',
				'title' => esc_html__('Background color', 'dfd-native'),
				'desc' => esc_html__('Subfooter background color. ', 'dfd-native'),
				'validate' => 'color',
				'default' => '#323232',
				'hint' => array(
					'title'   => esc_attr__('Subfooter background','dfd-native'),
					'content' => esc_attr__('Select the subfooter background color','dfd-native')
				)
			),
			array(
				'id' => 'sub_footer_bg_dark',
				'type' => 'button_set',
				'title' => esc_html__('Dark background', 'dfd-native'),
				'desc' => '',
				'options' => array('1' => esc_html__('Yes', 'dfd-native'), '0' => esc_html__('No', 'dfd-native')),
				'default' => '1',
				'hint' => array(
                    'title'   => esc_attr__('Dark background','dfd-native'),
                    'content' => esc_attr__('Enable this option if you\'ve set dark background color. The text color will be changed to make the text more readable','dfd-native')
                )
			),
			array(
				'id' => 'sub_footer_bg_image',
				'type' => 'media',
				'title' => esc_html__('Background image', 'dfd-native'),
				'default' => array(
					'url' => ''
				),
				'hint' => array(
					'title'   => esc_attr__('Background image','dfd-native'),
					'content' => esc_attr__('Upload the custom image from the media library for the subfooter background','dfd-native')
				)
			),
			array(
				'id' => 'sub_footer_custom_repeat',
				'type' => 'radio',
				'title' => esc_html__('Background repeat', 'dfd-native'),
				'desc' => '',//__('Select type background image repeat', 'dfd-native'),
				'options' => array(
					'no-repeat' => esc_html__('No-Repeat','dfd-native'),
					'repeat-x' => esc_html__('Repeat X','dfd-native'),
					'repeat-y' => esc_html__('Repeat Y','dfd-native'),
					'repeat' => esc_html__('Repeat','dfd-native'),
				),
				'default' => 'repeat',
				'hint' => array(
					'title'   => esc_attr__('Background repeat','dfd-native'),
					'content' => esc_attr__('This option allows you to choose the repeat for the background image','dfd-native')
				)
			),
		),
	));
	$_title_typography_fields = array();

	$_typography_heading_section = array(
		'headings' => array(
			'title' => esc_html__('Headings typography', 'dfd-native'),
			'elements' => array(
				'h1' => array(
					'font-family' => 'Montserrat',
					'font-size' => '55px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '60px',
					'letter-spacing' => '-3px',
					'color' => '#313131',
					'title' => esc_html__('H1','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the H1. You can use the H1 as element tag in Visual Composer modules','dfd-native'),
				),
				'h2' => array(
					'font-family' => 'Montserrat',
					'font-size' => '45px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '50px',
					'letter-spacing' => '-2px',
					'color' => '#313131',
					'title' => esc_html__('H2','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the H2. You can use the H2 as element tag in Visual Composer modules','dfd-native'),
				),
				'h3' => array(
					'font-family' => 'Montserrat',
					'font-size' => '30px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '35px',
					'letter-spacing' => '-1px',
					'color' => '#2d2d2d',
					'title' => esc_html__('H3','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the H3. You can use the H3 as element tag in Visual Composer modules','dfd-native'),
				),
				'h4' => array(
					'font-family' => 'Montserrat',
					'font-size' => '25px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '30px',
					'letter-spacing' => '-1px',
					'color' => '#313131',
					'title' => esc_html__('H4','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the H4. You can use the H4 as element tag in Visual Composer modules','dfd-native'),
				),
				'h5' => array(
					'font-family' => 'Montserrat',
					'font-size' => '20px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '25px',
					'letter-spacing' => '-1px',
					'color' => '#2b2b2b',
					'title' => esc_html__('H5','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the H5. You can use the H5 as element tag in Visual Composer modules','dfd-native'),
				),
				'h6' => array(
					'font-family' => 'Montserrat',
					'font-size' => '11px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'uppercase',
					'line-height' => '15px',
					'letter-spacing' => '1',
					'color' => '#848484',
					'title' => esc_html__('H6','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the H6. You can use the H6 as element tag in Visual Composer modules','dfd-native'),
				),
				'content_title_big' => array(
					'font-family' => 'Montserrat',
					'font-size' => '18px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '18px',
					'letter-spacing' => '-.4px',
					'color' => '#2b2b2b',
					'title' => esc_html__('Content title big','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the big title. The big title is used in the majority of modules as title by default. The full list of modules where the big title is used you can check in Theme Documentation','dfd-native'),
				),
				'content_title_small' => array(
					'font-family' => 'Montserrat',
					'font-size' => '10px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'uppercase',
					'line-height' => '10px',
					'letter-spacing' => '.6px',
					'color' => '#9c9c9c',
					'title' => esc_html__('Content title small','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the small title. Small title is used in modules as content elements by default. This element will also change the typography of sort panel titles. The full list of modules where the small title is used you can check in Theme Documentation','dfd-native'),
				),
				'content_subtitle' => array(
					'font-family' => 'Open Sans',
					'font-size' => '13px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '13px',
					'letter-spacing' => '0px',
					'color' => '#b5b5b5',
					'title' => esc_html__('Content subtitle','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the content subtitle. Content subtitle is used in modules as subtitle elements by default. The full list of modules where the content subtitle is used you can check in Theme Documentation','dfd-native'),
				),
				'form_heading' => array(
					'font-family' => 'Montserrat',
					'font-size' => '25px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '25px',
					'letter-spacing' => '-.6px',
					'color' => '#2d2d2d',
					'title' => esc_html__('Form heading','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the form heading. This heading is related to the comments notification (or to the "Leave a Reply" if the item was not commented) under the post, portfolio or gallery items','dfd-native'),
				),
			),
		),
		'header' => array(
			'title' => esc_html__('Header typography', 'dfd-native'),
			'elements' => array(
				'top_info' => array(
					'font-family' => 'Open Sans',
					'font-size' => '12px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '25px',
					'letter-spacing' => '0',
					'color' => '#313131',
					'title' => esc_html__('Top info','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the top address panel','dfd-native'),
				),
				'header_links' => array(
					'font-family' => 'Open Sans',
					'font-size' => '12px',
					'font-style' => 'normal',
					'font-weight' => '600',
					'text-transform' => 'none',
					'line-height' => '25px',
					'letter-spacing' => '0px',
					'color' => '#313131',
					'title' => esc_html__('Header links','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the login link and Additional header navigation','dfd-native'),
				),
			),
		),
		'menu' => array(
			'title' => esc_html__('Menu typography', 'dfd-native'),
			'elements' => array(
				'menu_title_big' => array(
					'font-family' => 'Montserrat',
					'font-size' => '25px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '25px',
					'letter-spacing' => '-.8px',
					'color' => '#ffffff',
					'title' => esc_html__('Menu top level item for header 8 and 9','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the menu top level items. These settings will be applied for the header styles 8 and 9','dfd-native'),
				),
				'menu_title' => array(
					'font-family' => 'Montserrat',
					'font-size' => '13px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '',
					'letter-spacing' => '-1px',
					'color' => '#313131',
					'title' => esc_html__('Menu top level item','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the menu top level items. These settings will be applied for all the header styles excluding styles 7, 8 and 9','dfd-native'),
				),
				'menu_subitem_title' => array(
					'font-family' => 'Montserrat',
					'font-size' => '10px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'uppercase',
					'line-height' => '',
					'letter-spacing' => '1.2px',
					'color' => '#262626',
					'title' => esc_html__('Menu second level item','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the menu second level items. These settings will be applied for all the header styles excluding styles 8 and 9','dfd-native'),
				),
				'menu_subitem' => array(
					'font-family' => 'Open Sans',
					'font-size' => '13px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '',
					'letter-spacing' => '-.2px',
					'color' => '#5c5c5c',
					'title' => esc_html__('Menu subitems','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the menu subitems. These settings will be applied for all the header styles excluding styles  8 and 9. In header style 7 it will be applied for all the menu items','dfd-native'),
				),
				'menu_subitem_subtitle' => array(
					'font-family' => 'Open Sans',
					'font-size' => '12px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '20px',
					'letter-spacing' => '0px',
					'color' => '#c3c3c3',
					'title' => esc_html__('Menu second level subtitles','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the menu subtitles. These settings will be applied for all the header styles excluding styles  8 and 9','dfd-native'),
				),
			),
		),
		'mobile_menu' => array(
			'title' => esc_html__('Mobile menu typography', 'dfd-native'),
			'elements' => array(
				'mobile_menu_title' => array(
					'font-family' => 'Montserrat',
					'font-size' => '10px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'uppercase',
					'line-height' => '10px',
					'letter-spacing' => '.8px',
					'color' => '#ffffff',
					'title' => esc_html__('Mobile menu top level items','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the mobile menu top items','dfd-native'),
				),
				'mobile_menu_subitem' => array(
					'font-family' => 'Open Sans',
					'font-size' => '13px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '',
					'letter-spacing' => '0',
					'color' => '#999999',
					'title' => esc_html__('Mobile menu subitems','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the mobile menu top subitems','dfd-native'),
				),
				'mobile_menu_subitem_subtitles' => array(
					'font-family' => 'Open Sans',
					'font-size' => '13px',
					'font-style' => 'italic',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '13px',
					'letter-spacing' => '0',
					'color' => '#999999',
					'title' => esc_html__('Mobile menu subitem subtitles','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the mobile menu subitem subtitles.','dfd-native'),
				),
			),
		),
		'stunning_header' => array(
			'title' => esc_html__('Custom header typography', 'dfd-native'),
			'elements' => array(
				'stunning_header_title' => array(
					'font-family' => 'Montserrat',
					'font-size' => '50px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '',
					'letter-spacing' => '-3px',
					'color' => '#313131',
					'title' => esc_html__('Title','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the custom header title. It will be applied for all the custom headers by default','dfd-native'),
				),
				'stunning_header_subtitle' => array(
					'font-family' => 'Open Sans',
					'font-size' => '24px',
					'font-style' => 'normal',
					'font-weight' => '300',
					'text-transform' => 'none',
					'line-height' => '',
					'letter-spacing' => '0px',
					'color' => '#c3c3c3',
					'title' => esc_html__('Subtitle','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the custom header subtitle. It will be applied for all the custom headers by default','dfd-native'),
				),
				'stunning_header_breadcrumbs' => array(
					'font-family' => 'Open Sans',
					'font-size' => '12px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '14px',
					'letter-spacing' => '0',
					'color' => '#808080',
					'title' => esc_html__('Breadcrumbs','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the custom header breadcrumbs. It will be applied for all the custom headers by default','dfd-native'),
				),
			),
		),
		'default_text' => array(
			'title' => esc_html__('Text typography', 'dfd-native'),
			'elements' => array(
				'default_text' => array(
					'font-family' => 'Open Sans',
					'font-size' => '14px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '28px',
					'letter-spacing' => '0',
					'color' => '#7b7b7b',
					'title' => esc_html__('Default text','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the text. It will be applied for all the text areas by default','dfd-native'),
				),
				'featured_decoration' => array(
					'font-family' => 'Open Sans',
					'font-size' => '14px',
					'font-style' => 'italic',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '18px',
					'letter-spacing' => '0',
					'color' => '#7b7b7b',
					'title' => esc_html__('Featured decoration','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the featured decoration, the feature decoration you can find in text editor on single post, single portfolio and in text module','dfd-native'),
				),
				'quote' => array(
					'font-family' => 'Montserrat',
					'font-size' => '23px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '40px',
					'letter-spacing' => '-.8px',
					'color' => '#2e2e2e',
					'title' => esc_html__('Blockquote','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the blockquote. It will be applied for all the blockquotes by default','dfd-native'),
				),
//				'link' => array(
//					'font-family' => '',
//					'font-size' => '',
//					'font-style' => '',
//					'font-weight' => '',
//					'text-transform' => '',
//					'line-height' => '',
//					'letter-spacing' => '',
//					'color' => '',
//					'title' => esc_html__('Link','dfd-native'),
//					'subtitle' => esc_html__('Specify the typography settings and color for the link. It will be applied for all the links by default','dfd-native'),
//				),
				'meta' => array(
					'font-family' => 'Montserrat',
					'font-size' => '11px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '11px',
					'letter-spacing' => '0',
					'color' => '#808080',
					'title' => esc_html__('Meta','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the meta. It will be applied for all the meta by default','dfd-native'),
				),
				'pagination' => array(
					'font-family' => 'Montserrat',
					'font-size' => '11px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'uppercase',
					'line-height' => '43px',
					'letter-spacing' => '.8px',
					'color' => '#292929',
					'title' => esc_html__('Pagination','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the pagination. It will be applied for the pagination by default','dfd-native'),
				),
			),
		),
		'blog' => array(
			'title' => esc_html__('Blog typography', 'dfd-native'),
			'elements' => array(
				'blog_title' => array(
					'font-family' => 'Montserrat',
					'font-size' => '21px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '26px',
					'letter-spacing' => '-1.2px',
					'color' => '#313131',
					'title' => esc_html__('Blog title','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the blog title. It will be applied for all the blog titles by default. You can set the custom settings in blog post module if you need to change the typography for the blog module','dfd-native'),
				),
				'blog_featured_quote' => array(
					'font-family' => 'Montserrat',
					'font-size' => '28px',
					'font-style' => 'normal',
					'font-weight' => '900',
					'text-transform' => 'none',
					'line-height' => '37px',
					'letter-spacing' => '-.8px',
					'color' => '#3498db',
					'title' => esc_html__('Blog content featured quote','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the featured quote, the featured quote you can find in text editor on single post','dfd-native'),
				),
				'blog_quote' => array(
					'font-family' => 'Montserrat',
					'font-size' => '18px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '30px',
					'letter-spacing' => '-.8px',
					'color' => '#313131',
					'title' => esc_html__('Blog quote post','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the quote (Blog format - Quote) on blog pages, the quotation for the blog inner pages inherit the Theme Options > Typography/Fonts > Text typography > Blockquote Typography. The quote you can find in Quote post settings on single blog page','dfd-native'),
				),
				'blog_quote_author' => array(
					'font-family' => 'Montserrat',
					'font-size' => '10px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'uppercase',
					'line-height' => '10px',
					'letter-spacing' => '.5px',
					'color' => '#9c9c9c',
					'title' => esc_html__('Blog quote post author','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the quote author (Blog format - Quote), the quote author you can add in Quote post settings on single blog page','dfd-native'),
				),
				'blog_link_post_url' => array(
					'font-family' => 'Montserrat',
					'font-size' => '14px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '14px',
					'letter-spacing' => '.5px',
					'color' => '#7b7b7b',
					'title' => esc_html__('Blog link post URL','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the link (Blog format - Link), the link you can find in Link post settings on single blog page','dfd-native'),
				),
				'blog_author' => array(
					'font-family' => 'Montserrat',
					'font-size' => '11px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '11px',
					'letter-spacing' => '-.5px',
					'color' => '#313131',
					'title' => esc_html__('Author and content subtitle','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the author and content subtitle, the setting will be applied for all the authors\' names on blog pages by default','dfd-native'),
				),
				'blog_category' => array(
					'font-family' => 'Montserrat',
					'font-size' => '10px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'uppercase',
					'line-height' => '10px',
					'letter-spacing' => '.5px',
					'color' => '#ffffff',
					'title' => esc_html__('Category','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the categories, the setting will be applied for all the categories on blog, portfolio, gallery pages and single posts, portfolios and galleries by default','dfd-native'),
				),
				'blog_pagination' => array(
					'title' => esc_html__('Blog pagination','dfd-native'),
					'description' => esc_html__('This element inherits blog links typography','dfd-native')
				)
			),
		),
		'portfolio' => array(
			'title' => esc_html__('Portfolio typography', 'dfd-native'),
			'elements' => array(
				'portfolio_title' => array(
					'font-family' => 'Montserrat',
					'font-size' => '18px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '18px',
					'letter-spacing' => '-.4px',
					'color' => '#2b2b2b',
					'title' => esc_html__('Portfolio item title','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the portfolio title. It will be applied for all the portfolio titles by default. You can set the custom settings in portfolio module if you need to change the typography for the portfolio module','dfd-native'),
				),
				'portfolio_subtitle' => array(
					'font-family' => 'Open Sans',
					'font-size' => '13px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '13px',
					'letter-spacing' => '0px',
					'color' => '#b5b5b5',
					'title' => esc_html__('Portfolio item subtitle','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the portfolio subtitle. It will be applied for all the portfolio subtitles by default. You can set the custom settings in portfolio module if you need to change the typography for the portfolio module','dfd-native'),
				),
				'portfolio_description_title' => array(
					'font-family' => 'Montserrat',
					'font-size' => '12px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'uppercase',
					'line-height' => '12px',
					'letter-spacing' => '.6px',
					'color' => '#222222',
					'title' => esc_html__('Portfolio single item description title','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the portfolio description title. It will be applied for all the portfolio descriptions by default','dfd-native'),
				),
			),
		),
		'gallery' => array(
			'title' => esc_html__('Gallery typography', 'dfd-native'),
			'elements' => array(
				'gallery_title' => array(
					'font-family' => 'Montserrat',
					'font-size' => '18px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '18px',
					'letter-spacing' => '-.4px',
					'color' => '#2b2b2b',
					'title' => esc_html__('Gallery item title','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the gallery title. It will be applied for all the gallery titles by default. You can set the custom settings in gallery module if you need to change the typography for the gallery module','dfd-native'),
				),
				'gallery_subtitle' => array(
					'font-family' => 'Open Sans',
					'font-size' => '13px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '13px',
					'letter-spacing' => '0px',
					'color' => '#b5b5b5',
					'title' => esc_html__('Gallery item subtitle','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the gallery subtitle. It will be applied for all the gallery subtitles by default. You can set the custom settings in gallery module if you need to change the typography for the gallery module','dfd-native'),
				),
			),
		),
		'widgets' => array(
			'title' => esc_html__('Widgets typography', 'dfd-native'),
			'elements' => array(
				'widget_title' => array(
					'font-family' => 'Montserrat',
					'font-size' => '12px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'uppercase',
					'line-height' => '',
					'letter-spacing' => '.6px',
					'color' => '#222222',
					'title' => esc_html__('Widget title','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the widget title. It will be applied for all the widget titles by default','dfd-native'),
				),
				'widget_big_title' => array(
					'font-family' => 'Montserrat',
					'font-size' => '18px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '26px',
					'letter-spacing' => '-.6px',
					'color' => '#313131',
					'title' => esc_html__('Widget post title big size','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the post title in "Latest post" widget','dfd-native'),
				),
				'widget_post_title' => array(
					'font-family' => 'Montserrat',
					'font-size' => '15px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '22px',
					'letter-spacing' => '-.6px',
					'color' => '#363535',
					'title' => esc_html__('Widget post title','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the post title in "Recent posts", "Recent posts with thumbs", "Products" widgets','dfd-native'),
				),
				'widget_content_title' => array(
					'font-family' => 'Montserrat',
					'font-size' => '10px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'uppercase',
					'line-height' => '22px',
					'letter-spacing' => '.6px',
					'color' => '#3a3a3a',
					'title' => esc_html__('Widget content title','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the content title. It will be applied for "Product tags", "Counter mail","Tags", "Calendar", "Words from author"(author subtitle) and "Tag cloud"','dfd-native'),
				),
				'widget_comment_title' => array(
					'font-family' => 'Montserrat',
					'font-size' => '11px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '18px',
					'letter-spacing' => '-.4px',
					'color' => '#363535',
					'title' => esc_html__('Widget comment title','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the comments','dfd-native'),
				),
				'widget_list_content' => array(
					'font-family' => 'Montserrat',
					'font-size' => '12px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '',
					'letter-spacing' => '-.4px',
					'color' => '#2b2b2b',
					'title' => esc_html__('Widget list content','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the list content. It will be applied for "Categories", "Archives", "Pages", "Meta", "Recent Comments with avatar no excerpt" and "Custom menu"','dfd-native'),
				),
			),
		),
	);
	
	if(class_exists('WooCommerce')) {
		$_typography_heading_section['woocommerce'] = array(
			'title' => esc_html__('Woocommerce typography' ,'dfd-native'),
			'elements' => array(
				'single_product_title' => array(
					'font-family' => 'Montserrat',
					'font-size' => '30px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '30px',
					'letter-spacing' => '-2px',
					'color' => '#2b2b2b',
					'title' => esc_html__('Single product title','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the single product title on the single product page','dfd-native'),
				),
				'single_product_subtitle' => array(
					'font-family' => 'Open Sans',
					'font-size' => '14px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '13px',
					'letter-spacing' => '0px',
					'color' => '#7f7f7f',
					'title' => esc_html__('Single product subtitle','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the single product subtitle on the single product page','dfd-native'),
				),
				'single_product_price' => array(
					'font-family' => 'Montserrat',
					'font-size' => '30px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '30px',
					'letter-spacing' => '-.4px',
					'color' => '#2b2b2b',
					'title' => esc_html__('Single product price','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the single product price on the single product page','dfd-native'),
				),
				'loop_product_title' => array(
					'font-family' => 'Montserrat',
					'font-size' => '15px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '18px',
					'letter-spacing' => '-.4px',
					'color' => '#2d2d2d',
					'title' => esc_html__('Shop page product title','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the single product title on the shop page','dfd-native'),
				),
				'loop_product_price' => array(
					'font-family' => 'Montserrat',
					'font-size' => '13px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'uppercase',
					'line-height' => '15px',
					'letter-spacing' => '-.4px',
					'color' => '#272727',
					'title' => esc_html__('Shop page product price','dfd-native'),
					'subtitle' => esc_html__('Specify the typography settings and color for the single product price on the shop page','dfd-native'),
				),
			),
		);
	}

	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Typography', 'dfd-native') .' / ' . esc_html__('Fonts', 'dfd-native'),
		'icon' => 'dashicons dashicons-editor-spellcheck',
		'fields' => array(
			'id' => 'typography_main_field_heading',
			'type' => 'info',
			'desc' => '<h3 class="description">'.esc_html__('Main typography options','dfd-native').'</h3>'
		),
	));
	
	foreach($_typography_heading_section as $k => $v) {
		if(isset($v['title'])) {
			$_title_typography_fields = array();
			if(isset($v['elements']) && !empty($v['elements']) && is_array($v['elements'])) {
				foreach($v['elements'] as $el_k => $el_v) {
					if(isset($el_v['description'])) {
						$_title_typography_fields[] = array(
							'id' => $el_k.'_description',
							'type' => 'info',
							'style' => 'custom',
							'color' => 'transparent',
							'title' => $el_v['title'],
							'desc' => '<div class="info-description">'.$el_v['description'].'</div>'
						);
					} else {
						$_title_typography_fields[] = array(
							'id'          => $el_k.'_typography_option',
							'type'        => 'typography',
							'title'       => '<div id="'.esc_attr($el_k.'_typography_title').'"><div class="redux-info-desc"><h2>'.$el_v['title'].__( ' Typography', 'dfd-native' ).'</h2></div></div>',
							'compiler'      => false,
							'google'      => true,
							'font-style'    => true,
							'subsets'       => true,
							'font-size'     => true,
							'text-align'	=> false,
							'line-height'   => true,
							'word-spacing'  => false,
							'letter-spacing'=> true,
							'text-transform'=> true,
							'color'         => true,
							'preview'       => false,
							'all_styles'  => true,
							'units'       => 'px',
							'subtitle'    => $el_v['subtitle'],
							'default'     => array(
								'font-style'  => $el_v['font-style'],
								'font-weight'  => $el_v['font-weight'],
								'font-family' => $el_v['font-family'],
								'google'      => true,
								'font-size'   => $el_v['font-size'],
								'line-height' => $el_v['line-height'],
								'text-transform'=> $el_v['text-transform'],
								'letter-spacing'=> $el_v['letter-spacing'],
								'color'	=> $el_v['color'],
							),
						);
					}
				}
			}
			if(!empty($_title_typography_fields)) {
				Redux::setSection( $opt_name, array(
					'title' => $v['title'],
					'icon' => 'dashicons dashicons-editor-spellcheck',
					'subsection' => true,
					'fields' => $_title_typography_fields,
				));
			}
		}
	}
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Blog options', 'dfd-native'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'dashicons dashicons-schedule',
		//Lets leave this as a blank section, no options just some intro text set above.
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Base Blog options', 'dfd-native'),
		//You dont have to though, leave it blank for default.
		'icon' => 'dashicons dashicons-schedule',
		'subsection' => true,
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'info_blog_base',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Base blog options', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'blog_top_link_src',
				'type' => 'radio',
				'title' => esc_html__('Blog top link source', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'page' => esc_html__('Page', 'dfd-native'),
					'url' => esc_html__('Custom URL', 'dfd-native'),
				),
				'default' => 'page',
				'hint' => array(
					'title'   => esc_attr__('Link source','dfd-native'),
					'content' => esc_attr__('This option allows you to set the page or custom link which will be used for the button placed next to the categories and tags dropdown on pages with "Blog page template"','dfd-native')
				)
			),
			array(
				'id' => 'blog_top_page_select',
				'type'     => 'select',
				'data'     => 'pages',
				'title' => esc_html__('Blog page', 'dfd-native'),
				'required' => array(
					array('blog_top_link_src', '=', 'page'),
				),
				'hint' => array(
					'title'   => esc_attr__('Blog page','dfd-native'),
					'content' => esc_attr__('Select the page which will be used as main blog page','dfd-native')
				)
			),
			array(
				'id' => 'blog_top_page_url',
				'type' => 'text',
				'title' => esc_html__('Blog page URL', 'dfd-native'),
				'desc' => '',
				'validate' => 'url',
				'required' => array(
					array('blog_top_link_src', '=', 'url'),
				),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Blog page URL','dfd-native'),
					'content' => esc_attr__('Set the blog page URL which will be used as main blog page','dfd-native')
				)
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Single post options', 'dfd-native'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'subsection' => true,
		'icon' => 'dashicons dashicons-schedule',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'info_single_post',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Layout settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'post_single_stun_header',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Custom header', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Custom header','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable the custom header for the single post pages by default. There is also an option on the single post page if you need to change custom header settings on single item','dfd-native')
				)
			),
			array(
				'id' => 'post_single_layout',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Layout width', 'dfd-native'),
				'desc' => '',
				'options' => Dfd_Theme_Helpers::dfd_layout_width(),
				'default' => '',
				'hint' => array(
                    'title'   => esc_attr__('Layout width','dfd-native'),
                    'content' => esc_attr__('This option defines the single post content width. There is also an option on the single post page if you need to change the layout width on single item','dfd-native')
                )
			),
			array(
				'id' => 'post_single_sidebars_configuration',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Single post layout', 'dfd-native'),
				'sub_desc' => esc_html__('Select one of the layout types for single pages', 'dfd-native'),
				'options' => Dfd_Theme_Helpers::dfd_page_layouts(),
				'default' => '',
				'hint' => array(
                    'title'   => esc_attr__('Single layout','dfd-native'),
                    'content' => esc_attr__('Select one of the layout types which will be set as default for all the single posts. There is also an option on the item\'s page if you need to change the layout for the single post','dfd-native')
                )
			),
			array(
				'id' => 'info_single_post_sth_content',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Custom header content', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'post_single_stun_header_cat',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Category', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'required' => array(
					array('post_single_stun_header', '=', 'on'),
				),
				'hint' => array(
					'title'   => esc_attr__('Category','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the post category in custom header on single post page','dfd-native')
				)
			),
			array(
				'id' => 'post_single_stun_header_meta',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Meta', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'required' => array(
					array('post_single_stun_header', '=', 'on'),
				),
				'hint' => array(
					'title'   => esc_attr__('Meta','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the post meta in custom header on single post page','dfd-native')
				)
			),
			array(
				'id' => 'info_single_post_content',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Content settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'post_single_show_top_tags',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Category', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Category','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the post category on single post page','dfd-native')
				)
			),
			array(
				'id' => 'post_single_show_title',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Title', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Title','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the post title on single post page','dfd-native')
				)
			),
			array(
				'id' => 'post_single_show_meta',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Meta', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				//'required' => array( array('post_single_style', '=', 'advanced'), ),
				'hint' => array(
					'title'   => esc_attr__('Meta','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the post meta on single post page','dfd-native')
				)
			),
			array(
				'id' => 'post_single_show_meta_date',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Date', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('post_single_show_meta', '=', 'on',),
				),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Date','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the post publication date on single post page','dfd-native')
				)
			),
			array(
				'id' => 'post_single_show_meta_category',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Category in meta', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('post_single_show_meta', '=', 'on',),
				),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Meta','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the post category in meta on single post page','dfd-native')
				)
			),
			array(
				'id' => 'post_single_show_meta_comments',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Comments in meta', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('post_single_show_meta', '=', 'on',),
				),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Meta','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the post featured image for standard posts','dfd-native')
				)
			),
			array(
				'id' => 'post_single_show_featured_image',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Featured image', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'sub_desc' => '',
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Fixed Share','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the featured image on single standard post page','dfd-native')
				)
			),
			array(
				'id' => 'post_single_show_fixed_share',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Fixed share', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'sub_desc' => '',
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Fixed Share','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the fixed share on single post page','dfd-native')
				)
			),
			array(
				'id' => 'post_single_show_meta_likes',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Likes', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('post_single_show_meta', '=', 'on',),
				),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Meta','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the post likes counter in meta on single post page','dfd-native')
				)
			),
			array(
				'id' => 'info_single_post_bottom_content',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Extra elements under post content', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'post_single_show_bottom_tags',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Tags', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'sub_desc' => '',
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Tags','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the post tags on single post page','dfd-native')
				)
			),
			array(
				'id' => 'post_single_show_bottom_share',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Share', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'sub_desc' => '',
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Share','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the post share on single post page','dfd-native')
				)
			),
			array(
				'id' => 'post_single_show_bottom_likes',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Likes', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'sub_desc' => '',
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Likes','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the post likes on single post page','dfd-native')
				)
			),
			array(
				'id' => 'post_single_show_author',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Show author info', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'sub_desc' => '',
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Author info','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the information about author of the posts. This information is located under the post content. Please make sure that author info is defined in the Users section -> User you need -> Biographical Info','dfd-native')
				)
			),
			array(
				'id' => 'post_single_show_related_posts',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Related posts', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'sub_desc' => '',
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Related posts','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the related post on single post page','dfd-native')
				)
			),
			array(
				'id' => 'info_single_post_pagination',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Pagination settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'post_single_enable_pagination',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Inside pagination', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'sub_desc' => '',
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Inside pagination','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the inside pagination on single post page','dfd-native')
				)
			),
			array(
				'id' => 'post_single_pagination_style',
				'type' => 'radio',
				'title' => esc_html__('Pagination position', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'off' => esc_html__('Disable', 'dfd-native'),
					'fixed' => esc_html__('Fixed', 'dfd-native'),
					'top' => esc_html__('Top', 'dfd-native'),
				),
				'default' => 'top',
				'required' => array(
					array('post_single_enable_pagination', '=', 'on'),
				),
				'hint' => array(
					'title'   => esc_attr__('Pagination position','dfd-native'),
					'content' => esc_attr__('This option allows you to choose the position of the inside pagination on single post page','dfd-native')
				)
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Blog page options', 'dfd-native'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'subsection' => true,
		'icon' => 'dashicons dashicons-schedule',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'info_post_page',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Page settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'post_stun_header',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Custom header', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',//this should be the key as defined above
				'hint' => array(
						'title'   => esc_attr__('Custom header','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the custom header for the blog post pages by default. There is also an option on the blog post page if you need to change custom header settings on single page','dfd-native')
					)
			),
			array(
				'id' => 'post_layout_width',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Layout width', 'dfd-native'),
				'desc' => '',
				'options' => Dfd_Theme_Helpers::dfd_layout_width(),
				'hint' => array(
                    'title'   => esc_attr__('Layout width','dfd-native'),
                    'content' => esc_attr__('This option defines the single content width. There is also an option on the blog post page if you need to change the layout width on single item','dfd-native')
                )
			),
			array(
				'id' => 'post_sidebars_configuration',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Blog page layout', 'dfd-native'),
				'sub_desc' => esc_html__('Select one of the layout types for single pages', 'dfd-native'),
				'options' => Dfd_Theme_Helpers::dfd_page_layouts(),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Single layout','dfd-native'),
					'content' => esc_attr__('Select one of the layout types which will be set as default for all the blog post pages. There is also an option on the item\'s page if you need to change the layout for the single item','dfd-native')
				)
			),
			array(
				'id' => 'info_post_page_content',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Page settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'post_cat_tag',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Categories and tags dropdown', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',//this should be the key as defined above
				'hint' => array(
					'title'   => esc_attr__('Categories and tags dropdown','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide categories, tags and author drop-down sorter before post items','dfd-native')
				)
			),
			array(
				'id' => 'post_style',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Layout style', 'dfd-native'),
				'options' => Dfd_Theme_Helpers::dfd_blog_layouts_style(),
				'default' => 'masonry',
				'hint' => array(
					'title'   => esc_attr__('Layout style','dfd-native'),
					'content' => esc_attr__('Choose the layout style for the blog page which will be applied for all the blog pages by default. There is also an option on the item\'s page if you need to change the layout for the single blog page','dfd-native')
				)
			),
			array(
				'id' => 'post_style_side',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Side image layout style', 'dfd-native'),
				'options' => array(
					'left-image' => array(
						'title' => esc_html__('Left image','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/side.png'
					),
					'right-image' => array(
						'title' => esc_html__('Right image','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/side.png'
					),
					'mixed-image' => array(
						'title' => esc_html__('Mixed image','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/side.png'
					),
				),
				'required' => array(
					array('post_style', '=', 'side-image'),
				),
				'default' => 'mixed-image',
				'hint' => array(
					'title'   => esc_attr__('Image layout','dfd-native'),
					'content' => esc_attr__('Choose the layout style for the blog post image. There is also an option on the item\'s page if you need to change the image layout for the single blog page','dfd-native')
				)
			),
			array(
				'id' => 'post_content_style',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Content style', 'dfd-native'),
				'options' => array(
					'standard' => array(
						'title' => esc_html__('Simple','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/tiled.png'
					),
					'tiled' => array(
						'title' => esc_html__('Tiled','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/tiled.png'
					),
				),
				'default' => 'standard',
				'hint' => array(
					'title'   => esc_attr__('Content style','dfd-native'),
					'content' => esc_attr__('Choose content style for the single blog post. Simple style allows you to have transparent background without hover effect. Tiled style allows you to have white background with shadow hover effect. There is also an option on the item\'s page if you need to change it for single blog posts page','dfd-native')
				)
			),
			array(
				'id' => 'post_columns',
				'type' => 'radio',
				'title' => esc_html__('Number of columns', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'1' => esc_html__('One', 'dfd-native'),
					'2' => esc_html__('Two', 'dfd-native'),
					'3' => esc_html__('Three', 'dfd-native'),
					'4' => esc_html__('Four', 'dfd-native'),
					'5' => esc_html__('Five', 'dfd-native'),
				),
				'default' => '3',
				'required' => array(
					array('post_style', '!=', 'side-image'),
				),
				'hint' => array(
					'title'   => esc_attr__('Number of columns','dfd-native'),
					'content' => esc_attr__('Choose the number of columns for the blog page. There is also an option on the item\'s page if you need to change it for single blog posts page','dfd-native')
				)
			),
			array(
				'id' => 'post_sort_panel',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Sort panel', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('post_style', '!=', 'standard'),
					array('post_style', '!=', 'left-image'),
					array('post_style', '!=', 'right-image'),
					array('post_style', '!=', 'metro'),
				),
				'default' => 'on',//this should be the key as defined above
				'hint' => array(
					'title'   => esc_attr__('Sort panel','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable post categories sorter above blog post items. There is also an option on the item\'s page if you need to change it for single blog posts page','dfd-native')
				)
			),
			array(
				'id' => 'post_sort_panel_align',
				'type' => 'radio', //the field type
				'title' => esc_html__('Sort panel alignment', 'dfd-native'),
				'sub_desc' => '',
				'options' => array(
					'text-left' => esc_html__('Left', 'dfd-native'),
					'text-right' => esc_html__('Right', 'dfd-native'),
					'text-center' => esc_html__('Center', 'dfd-native'),
				),
				'required' => array(
					array('post_sort_panel', '=', 'on',),
				),
				'default' => 'text-left',
				'hint' => array(
					'title'   => esc_attr__('Sort panel alignment','dfd-native'),
					'content' => esc_attr__('This option allows you to align the sort panel horizontally','dfd-native')
				)
			),
			array(
				'id' => 'info_post_page_content_elements',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Content elements settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'post_show_image',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Media', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => '',
				'required' => array(
					array('post_style', '!=', 'side-image',),
				),
				'hint' => array(
					'title'   => esc_attr__('Media','dfd-native'),
					'content' => esc_attr__('This option enables or disables images on blog page','dfd-native')
				)
			),
			array(
				'id' => 'post_show_top_cat',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Category', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Category','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the post category on single post page','dfd-native')
				)
			),
			array(
				'id' => 'post_show_title',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Titles', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Titles','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the post title on blog posts page. There is also an option on the item\'s page if you need to change it for single blog posts page','dfd-native')
				)
			),
			array(
				'id' => 'post_show_meta',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Meta', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Meta','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the post meta on blog posts page. There is also an option on the item\'s page if you need to change it for single blog posts page','dfd-native')
				)
			),
			array(
				'id' => 'post_show_meta_date',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Date', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('post_show_meta', '=', 'on',),
				),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Date','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the post publication date in meta on blog posts page','dfd-native')
				)
			),
			array(
				'id' => 'post_show_meta_category',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Category', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('post_show_meta', '=', 'on',),
				),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Category','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the post category in meta on blog posts page','dfd-native')
				)
			),
			array(
				'id' => 'post_show_meta_comments',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Comments', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('post_show_meta', '=', 'on',),
				),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Comments','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the post comments counter in meta on blog posts page','dfd-native')
				)
			),
			array(
				'id' => 'post_show_meta_likes',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Likes', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('post_show_meta', '=', 'on',),
				),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Likes','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the post likes counter in meta on blog posts page','dfd-native')
				)
			),
			array(
				'id' => 'post_show_content',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Description', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Description','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the post description on blog posts page. There is also an option on the item\'s page if you need to change it for single blog posts page','dfd-native')
				)
			),
			array(
				'id' => 'post_content_alignment',
				'type' => 'radio', //the field type
				'title' => esc_html__('Content alignment', 'dfd-native'),
				'sub_desc' => '',
				'options' => array(
					'text-center' => esc_html__('Center', 'dfd-native'),
					'text-left' => esc_html__('Left', 'dfd-native'),
					'text-right' => esc_html__('Right', 'dfd-native'),
				),
				'default' => 'text-left',
				'required' => array(
					array('post_show_content', '=', 'on'),
				),
				'hint' => array(
					'title'   => esc_attr__('Content alignment','dfd-native'),
					'content' => esc_attr__('This option allows you to choose horizontal alignment for the post description on blog posts page. There is also an option on the item\'s page if you need to change it for single blog posts page','dfd-native')
				)
			),
			array(
				'id' => 'post_show_author_box',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Author box', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Author','dfd-native'),
					'content' => esc_attr__('This option allows you to choose show or hide the author of the post. There is also an option on the item\'s page if you need to change it for single blog posts page','dfd-native')
				)
			),
			array(
				'id' => 'info_post_page_extra',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Extra features settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'post_vc_content_position',
				'type' => 'radio',
				'title' => esc_html__('Content position', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'top' => esc_html__('Before projects', 'dfd-native'),
					'bottom' => esc_html__('After projects', 'dfd-native'),
				),
				'default' => 'top',
				'hint' => array(
					'title'   => esc_attr__('Content position','dfd-native'),
					'content' => esc_attr__('This option allows you to choose the displaying of the Visual Composer content. You can set the content above or below the post items. There is also an option on the item\'s page if you need to change it for single blog posts page','dfd-native')
				)
			),
			array(
				'id' => 'post_items_offset',
				'type' => 'text',
				'title' => esc_html__('Items offset (in px)', 'dfd-native'),
				'validate' => 'numeric',
				'default' => '20',
				'hint' => array(
					'title'   => esc_attr__('Items offset','dfd-native'),
					'content' => esc_attr__('This option allows you to add space between single posts, don\'t include "px". There is also an option on the item\'s page if you need to change it for single blog posts page','dfd-native')
				)
			),
			array(
				'id' => 'post_appear_effect',
				'type' => 'select',
				'title' => esc_html__('Items appear effect', 'dfd-native'),
				'desc' => '',
				'options' => Dfd_Theme_Helpers::dfd_module_animation_styles('options'),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Appear effect','dfd-native'),
					'content' => esc_attr__('Choose the appear effect for the posts. There is also an option on the item\'s page if you need to change it for single blog posts page','dfd-native')
				)
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Blog archive page options', 'dfd-native'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'subsection' => true,
		'icon' => 'dashicons dashicons-schedule',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'info_post_archive_layout',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Layout settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'post_archive_stun_header',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Custom header', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',//this should be the key as defined above
				'hint' => array(
						'title'   => esc_attr__('Custom header','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the custom header for the archive blog page','dfd-native')
					)
			),
			array(
				'id' => 'post_archive_layout_width',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Layout width', 'dfd-native'),
				'desc' => '',
				'options' => Dfd_Theme_Helpers::dfd_layout_width(),
				'hint' => array(
                    'title'   => esc_attr__('Layout width','dfd-native'),
                    'content' => esc_attr__('This option defines the content width for the archive blog page','dfd-native')
                )
			),
			array(
				'id' => 'post_archive_sidebars_configuration',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Archive layout', 'dfd-native'),
				'sub_desc' => esc_html__('Select one of the layout types for single pages', 'dfd-native'),
				'options' => Dfd_Theme_Helpers::dfd_page_layouts(),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Archive layout','dfd-native'),
					'content' => esc_attr__('Select one of the layout types which will be set for the archive blog page','dfd-native')
				)
			),
			array(
				'id' => 'info_post_archive_page_options',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Page settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'post_archive_style',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Layout style', 'dfd-native'),
				'options' => Dfd_Theme_Helpers::dfd_blog_layouts_style(),
				'default' => 'masonry',
				'hint' => array(
					'title'   => esc_attr__('Layout style','dfd-native'),
					'content' => esc_attr__('Choose layout style for the archive page','dfd-native')
				)
			),
			array(
				'id' => 'post_archive_style_side',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Side image layout style', 'dfd-native'),
				'options' => array(
					'left-image' => array(
						'title' => esc_html__('Left image','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/side.png'
					),
					'right-image' => array(
						'title' => esc_html__('Right image','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/side.png'
					),
					'mixed-image' => array(
						'title' => esc_html__('Mixed image','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/side.png'
					),
				),
				'required' => array(
					array('post_archive_style', '=', 'side-image'),
				),
				'default' => 'mixed-image',
				'hint' => array(
					'title'   => esc_attr__('Image layout','dfd-native'),
					'content' => esc_attr__('Choose the layout style for the blog post image','dfd-native')
				)
			),
			array(
				'id' => 'post_archive_content_style',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Content style', 'dfd-native'),
				'options' => array(
					'standard' => array(
						'title' => esc_html__('Simple','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/tiled.png'
					),
					'tiled' => array(
						'title' => esc_html__('Tiled','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/tiled.png'
					),
				),
				'default' => 'standard',
				'hint' => array(
					'title'   => esc_attr__('Content style','dfd-native'),
					'content' => esc_attr__('Choose content style for the single blog post. Simple style allows you to have transparent background without hover effect. Tiled style allows you to have white background with shadow hover effect','dfd-native')
				)
			),
			array(
				'id' => 'post_archive_columns',
				'type' => 'radio',
				'title' => esc_html__('Number of columns', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'1' => esc_html__('One', 'dfd-native'),
					'2' => esc_html__('Two', 'dfd-native'),
					'3' => esc_html__('Three', 'dfd-native'),
					'4' => esc_html__('Four', 'dfd-native'),
					'5' => esc_html__('Five', 'dfd-native'),
				),
				'default' => '3',
				'required' => array(
					array('post_archive_style', '!=', 'side-image'),
				),
				'hint' => array(
					'title'   => esc_attr__('Number of columns','dfd-native'),
					'content' => esc_attr__('Choose the number of columns for the archive blog page','dfd-native')
				)
			),
			array(
				'id' => 'info_post_archive_page_content_elements',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Content settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'post_archive_show_image',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Media', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => '',
				'required' => array(
					array('post_archive_style', '!=', 'side-image',),
				),
				'hint' => array(
					'title'   => esc_attr__('Media','dfd-native'),
					'content' => esc_attr__('This option enables or disables images on blog archive page','dfd-native')
				)
			),
			array(
				'id' => 'post_archive_show_title',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Titles', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Titles','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the post title on archive blog posts page','dfd-native')
				)
			),
			array(
				'id' => 'post_archive_show_meta',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Meta', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Meta','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the post meta on archive blog posts page','dfd-native')
				)
			),
			array(
				'id' => 'post_archive_show_meta_date',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Date', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('post_archive_show_meta', '=', 'on',),
				),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Date','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the post publication date in meta on archive blog posts page','dfd-native')
				)
			),
			array(
				'id' => 'post_archive_show_meta_category',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Category', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('post_archive_show_meta', '=', 'on',),
				),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Category','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the post category in meta on archive blog posts page','dfd-native')
				)
			),
			array(
				'id' => 'post_archive_show_meta_comments',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Comments', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('post_archive_show_meta', '=', 'on',),
				),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Comments','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the post comments counter in meta on archive blog posts page','dfd-native')
				)
			),
			array(
				'id' => 'post_archive_show_meta_likes',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Likes', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('post_archive_show_meta', '=', 'on',),
				),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Likes','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the post likes counter in meta on archive blog posts page','dfd-native')
				)
			),
			array(
				'id' => 'post_archive_title_position',
				'type' => 'radio', //the field type
				'title' => esc_html__('Title position', 'dfd-native'),
				'sub_desc' => '',
				'options' => array(
					'bottom' => esc_html__('Under media', 'dfd-native'),
					'front' => esc_html__('In front of the media', 'dfd-native'),
				),
				'default' => 'bottom',
				'required' => array(
					array('blog_show_title', '=', 'on'),
				),
				'hint' => array(
					'title'   => esc_attr__('Title position','dfd-native'),
					'content' => esc_attr__('This option allows you to choose the position of the post title on archive blog posts page','dfd-native')
				)
			),
			array(
				'id' => 'post_archive_show_content',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Description', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Description','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the post description on archive blog posts page','dfd-native')
				)
			),
			array(
				'id' => 'post_archive_content_alignment',
				'type' => 'radio', //the field type
				'title' => esc_html__('Content alignment', 'dfd-native'),
				'sub_desc' => '',
				'options' => array(
					'text-center' => esc_html__('Center', 'dfd-native'),
					'text-left' => esc_html__('Left', 'dfd-native'),
					'text-right' => esc_html__('Right', 'dfd-native'),
				),
				'default' => 'text-left',
				'required' => array(
					array('post_archive_show_content', '=', 'on'),
				),
				'hint' => array(
					'title'   => esc_attr__('Content alignment','dfd-native'),
					'content' => esc_attr__('This option allows you to choose horizontal alignment for the post description on archive blog posts page','dfd-native')
				)
			),
			array(
				'id' => 'post_archive_show_author_box',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Author box', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Author','dfd-native'),
					'content' => esc_attr__('This option allows you to choose show or hide the author of the post','dfd-native')
				)
			),
			array(
				'id' => 'post_archive_items_offset',
				'type' => 'text',
				'title' => esc_html__('Items offset (in px)', 'dfd-native'),
				'validate' => 'numeric',
				'default' => '20',
				'hint' => array(
					'title'   => esc_attr__('Items offset','dfd-native'),
					'content' => esc_attr__('This option allows you to add space between single posts, don\'t include "px"','dfd-native')
				)
			),
			array(
				'id' => 'info_post_archive_extra',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Extra features', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'post_archive_appear_effect',
				'type' => 'select',
				'title' => esc_html__('Items appear effect', 'dfd-native'),
				'desc' => '',
				'options' => Dfd_Theme_Helpers::dfd_module_animation_styles('options'),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Appear effect','dfd-native'),
					'content' => esc_attr__('Choose the appear effect for the posts','dfd-native')
				)
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Portfolio options', 'dfd-native'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'dashicons dashicons-media-interactive',
		//Lets leave this as a blank section, no options just some intro text set above.
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Base portfolio options', 'dfd-native'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'dashicons dashicons-media-interactive',
		'subsection' => true,
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'portfolio_url_slug',
				'type' => 'text',
				'title' => esc_html__('Portfolio URL slug', 'dfd-native'),
				'desc' => esc_html__('Please do not forget to save the permalinks in Settings -> Permalinks after changing this option', 'dfd-native'),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Portfolio URL slug','dfd-native'),
					'content' => esc_attr__('This option allows you to change the portfolio slug. Set your custom slug which will be displayed instead of portfolio in portfolio URL','dfd-native')
				)
			),
			array(
				'id' => 'folio_top_page_title',
				'type' => 'text',
				'title' => esc_html__('Portfolio page title', 'dfd-native'),
				'default' => esc_html__('Portfolio', 'dfd-native'),
				'hint' => array(
					'title'   => esc_attr__('Portfolio page title','dfd-native'),
					'content' => esc_attr__('Set the title for your portfolio page','dfd-native')
				)
			),
			array(
				'id' => 'folio_top_link_src',
				'type' => 'radio',
				'title' => esc_html__('Portfolio top link source', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'page' => esc_html__('Page', 'dfd-native'),
					'url' => esc_html__('Custom url', 'dfd-native'),
				),
				'default' => 'page',
				'hint' => array(
						'title'   => esc_attr__('Link source','dfd-native'),
						'content' => esc_attr__('This option allows you to set the page or custom link which will be used for the button placed next to the categories and tags dropdown on pages with "Portfolio page template"','dfd-native')
					)
			),
			array(
				'id' => 'folio_top_page_select',
				'type'     => 'select',
				'data'     => 'pages',
				'title' => esc_html__('Portfolio page', 'dfd-native'),
				'required' => array(
					array('folio_top_link_src', '=', 'page'),
				),
				'hint' => array(
						'title'   => esc_attr__('Portfolio page','dfd-native'),
						'content' => esc_attr__('Select the page which will be used as main portfolio page','dfd-native')
					)
			),
			array(
				'id' => 'folio_top_page_url',
				'type' => 'text',
				'title' => esc_html__('Portfolio page URL', 'dfd-native'),
				'validate' => 'url',
				'required' => array(
					array('folio_top_link_src', '=', 'url'),
				),
				'default' => '',
				'hint' => array(
						'title'   => esc_attr__('Portfolio page URL','dfd-native'),
						'content' => esc_attr__('Set the blog page URL which will be used as main portfolio page','dfd-native')
					)
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Single portfolio item options', 'dfd-native'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'subsection' => true,
		'icon' => 'dashicons dashicons-media-interactive',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'info_portfolio_single',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Layout settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'portfolio_single_stun_header',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Custom header', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
						'title'   => esc_attr__('Custom header','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the custom header for the single portfolio pages by default. There is also an option on the single portfolio item page if you need to change custom header settings on single portfolio','dfd-native')
					)
			),
			array(
				'id' => 'portfolio_single_layout',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Layout width', 'dfd-native'),
				'desc' => '',
				'options' => Dfd_Theme_Helpers::dfd_layout_width(),
				'hint' => array(
                    'title'   => esc_attr__('Layout width','dfd-native'),
                    'content' => esc_attr__('This option defines the single portfolio content width','dfd-native')
                )
			),
			array(
				'id' => 'portfolio_single_sidebars_configuration',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Single layout', 'dfd-native'),
				'sub_desc' => esc_html__('Select one of the layout types for single pages', 'dfd-native'),
				'options' => Dfd_Theme_Helpers::dfd_page_layouts(),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Single layout','dfd-native'),
					'content' => esc_attr__('Select one of the layout types which will be set as default for all the portfolio items. There is also an option on the item\'s page if you need to change the layout for the single item','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_single_vc_content',
				'type' => 'radio',
				'title' => esc_html__('Visual Composer default content position', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'top' => esc_html__('Top', 'dfd-native'),
					'bottom' => esc_html__('Bottom', 'dfd-native'),
				),
				'default' => 'top',
				'hint' => array(
					'title'   => esc_attr__('Number of columns','dfd-native'),
					'content' => esc_attr__('Choose the number of columns for the portfolio page','dfd-native')
				)
			),
			array(
				'id' => 'info_portfolio_single_page',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Page settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'portfolio_single_style',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Layout style', 'dfd-native'),
				'options' => Dfd_Theme_Helpers::dfd_portfolio_single_layout_style(),
				'default' => 'carousel',
				'hint' => array(
					'title'   => esc_attr__('Layout style','dfd-native'),
					'content' => esc_attr__('Choose layout style for the single portfolio item','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_single_columns',
				'type' => 'radio',
				'title' => esc_html__('Number of columns', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'1' => esc_html__('One', 'dfd-native'),
					'2' => esc_html__('Two', 'dfd-native'),
					'3' => esc_html__('Three', 'dfd-native'),
					'4' => esc_html__('Four', 'dfd-native'),
					'5' => esc_html__('Five', 'dfd-native'),
				),
				'default' => '3',
				'required' => array(
					array('portfolio_single_style', '!=', 'carousel'),
					array('portfolio_single_style', '!=', 'video'),
				),
				'hint' => array(
					'title'   => esc_attr__('Number of columns','dfd-native'),
					'content' => esc_attr__('Choose the number of columns for the portfolio page','dfd-native')
				)
			),
			array(
				'id' => 'info_portfolio_single_content',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Content settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'portfolio_single_show_top_tags',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Category', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Category','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the portfolio category on single portfolio item','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_single_show_title',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Title', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Title','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the portfolio title on single portfolio item','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_single_show_meta',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Meta', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Meta','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the portfolio meta on single portfolio item','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_single_show_meta_date',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Date', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('portfolio_single_show_meta', '=', 'on',),
				),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Date','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the portfolio publication date on single portfolio item','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_single_show_meta_category',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Category', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('portfolio_single_show_meta', '=', 'on',),
				),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Category','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the portfolio category in meta on single portfolio item','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_single_show_meta_comments',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Comments', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('portfolio_single_show_meta', '=', 'on',),
				),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Comments','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the portfolio comments counter in meta on single portfolio item','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_single_show_meta_likes',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Likes', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('portfolio_single_show_meta', '=', 'on',),
				),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Likes','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the portfolio likes counter in meta on single portfolio item','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_single_show_fixed_share',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Fixed share', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'sub_desc' => '',
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Fixed share','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the fixed share on single portfolio item','dfd-native')
				)
			),
			array(
				'id' => 'info_single_portfolio_bottom_content',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Extra elements under post content', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'portfolio_single_show_bottom_tags',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Tags', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'sub_desc' => '',
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Tags','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the post tags on single post page','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_single_show_bottom_share',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Share', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'sub_desc' => '',
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Share','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the post share on single post page','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_single_show_bottom_likes',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Likes', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'sub_desc' => '',
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Likes','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the post comments likes on single post page','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_single_show_author',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Show author info', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'sub_desc' => '',
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Author info','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the information about author of the portfolio items. This information is located under the post content. Please make sure that author info is defined in the Users section -> User you need -> Biographical Info','dfd-native')
				)
			),
			array(
				'id' => 'info_portfolio_single_pagination',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Pagination settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'portfolio_single_enable_pagination',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Inside pagination', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'sub_desc' => '',
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Inside pagination','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the inside pagination on single portfolio item','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_single_pagination_style',
				'type' => 'radio',
				'title' => esc_html__('Pagination position', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'off' => esc_html__('Disable', 'dfd-native'),
					'fixed' => esc_html__('Fixed', 'dfd-native'),
					'top' => esc_html__('Top', 'dfd-native'),
				),
				'default' => '',
				'required' => array(
					array('portfolio_single_enable_pagination', '=', 'on'),
				),
				'hint' => array(
					'title'   => esc_attr__('Pagination position','dfd-native'),
					'content' => esc_attr__('This option allows you to choose the position of the inside pagination on single portfolio item','dfd-native')
				)
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Portfolio page options', 'dfd-native'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'subsection' => true,
		'icon' => 'dashicons dashicons-media-interactive',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'info_portfolio_page_layout',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Layout settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'portfolio_stun_header',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Custom header', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',//this should be the key as defined above
				'hint' => array(
						'title'   => esc_attr__('Custom header','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the custom header for the potfolio page by default. There is also an option on the item\'s page if you need to change custom header settings on single page','dfd-native')
					)
			),
			array(
				'id' => 'portfolio_layout_width',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Layout width', 'dfd-native'),
				'desc' => '',
				'options' => Dfd_Theme_Helpers::dfd_layout_width(),
				'hint' => array(
                    'title'   => esc_attr__('Layout width','dfd-native'),
                    'content' => esc_attr__('This option defines the portfolio page content width','dfd-native')
                )
			),
			array(
				'id' => 'portfolio_sidebars_configuration',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Portfolio page layout', 'dfd-native'),
				'sub_desc' => esc_html__('Select one of the layout types for single pages', 'dfd-native'),
				'options' => Dfd_Theme_Helpers::dfd_page_layouts(),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Portfolio layout','dfd-native'),
					'content' => esc_attr__('Select one of the layout types which will be set as default for all the portfolio items. There is also an option on the item\'s page if you need to change the layout for the single item','dfd-native')
				)
				
			),
			array(
				'id' => 'info_portfolio_page',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Page settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'portfolio_cat_tag',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Categories and tags dropdown', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',//this should be the key as defined above
				'hint' => array(
					'title'   => esc_attr__('Categories and tags dropdown','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide categories, tags and author drop-down sorter before portfolio items','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_style',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Portfolio layout style', 'dfd-native'),
				'options' => Dfd_Theme_Helpers::dfd_portfolio_layout_style(),
				'default' => 'fitRows',
				'hint' => array(
					'title'   => esc_attr__('Layout style','dfd-native'),
					'content' => esc_attr__('Choose layout style for the portfolio items on portfolio page','dfd-native')
				)
				
			),
			array(
				'id' => 'portfolio_style_side',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Portfolio side image layout style', 'dfd-native'),
				'options' => array(
					'left-image' => array(
						'title' => esc_html__('Left image','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/side-image-portfolio.png'
					),
					'right-image' => array(
						'title' => esc_html__('Right image','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/side-image-portfolio.png'
					),
					'mixed-image' => array(
						'title' => esc_html__('Mixed image','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/side-image-portfolio.png'
					),
				),
				'required' => array(
					array('portfolio_style', '=', 'side-image'),
				),
				'default' => 'mixed-image',
				'hint' => array(
					'title'   => esc_attr__('Image layout','dfd-native'),
					'content' => esc_attr__('Choose the layout style for the portfolio item image','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_content_style',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Portfolio content style', 'dfd-native'),
				'options' => array(
					'standard' => array(
						'title' => esc_html__('Simple','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/portfolio-tiled.png'
					),
					'tiled' => array(
						'title' => esc_html__('Tiled','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/portfolio-tiled.png'
					),
				),
				'default' => 'standard',
				'hint' => array(
					'title'   => esc_attr__('Content style','dfd-native'),
					'content' => esc_attr__('Choose content style for the single portfolio item. Simple style allows you to have transparent background without hover effect. Tiled style allows you to have white background with shadow hover effect','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_columns',
				'type' => 'radio',
				'title' => esc_html__('Number of columns', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'1' => esc_html__('One', 'dfd-native'),
					'2' => esc_html__('Two', 'dfd-native'),
					'3' => esc_html__('Three', 'dfd-native'),
					'4' => esc_html__('Four', 'dfd-native'),
					'5' => esc_html__('Five', 'dfd-native'),
				),
				'default' => '3',
				'required' => array(
					array('portfolio_style', '!=', 'justified'),
				),
				'hint' => array(
					'title'   => esc_attr__('Number of columns','dfd-native'),
					'content' => esc_attr__('Choose the number of columns for the portfolio page','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_sort_panel',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Sort panel', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('portfolio_style', '!=', 'standard'),
					array('portfolio_style', '!=', 'left-image'),
					array('portfolio_style', '!=', 'right-image'),
					array('portfolio_style', '!=', 'metro'),
				),
				'default' => 'on',//this should be the key as defined above
				'hint' => array(
					'title'   => esc_attr__('Sort panel','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable portfolio categories sorter above portfolio items. There is also an option on the item\'s page if you need to change it for single portfolio page','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_sort_panel_align',
				'type' => 'radio', //the field type
				'title' => esc_html__('Sort panel alignment', 'dfd-native'),
				'sub_desc' => '',
				'options' => array(
					'text-left' => esc_html__('Left', 'dfd-native'),
					'text-right' => esc_html__('Right', 'dfd-native'),
					'text-center' => esc_html__('Center', 'dfd-native'),
				),
				'required' => array(
					array('portfolio_sort_panel', '=', 'on',),
				),
				'default' => 'text-left',
				'hint' => array(
					'title'   => esc_attr__('Sort panel alignment','dfd-native'),
					'content' => esc_attr__('This option allows you to align the sort panel horizontally','dfd-native')
				)
			),
			array(
				'id' => 'info_portfolio_page_content',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Content settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'portfolio_show_top_cat',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Top category', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Top category','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the category name on the top right side of the featured image','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_show_title',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Titles', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Titles','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the portfolio title on portfolio page','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_show_subtitle',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Subtitles', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Subtitles','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the portfolio subtitle on portfolio page','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_show_meta',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Meta', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Meta','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the portfolio meta on portfolio page','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_show_meta_date',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Date', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('portfolio_show_meta', '=', 'on',),
				),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Date','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the portfolio publication date on portfolio page','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_show_meta_category',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Category', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('portfolio_show_meta', '=', 'on',),
				),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Category','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the portfolio category in meta on portfolio page','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_show_meta_comments',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Comments', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('portfolio_show_meta', '=', 'on',),
				),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Comments','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the portfolio comments counter in meta on portfolio page','dfd-native')
				)				
			),
			array(
				'id' => 'portfolio_show_meta_likes',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Likes', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('portfolio_show_meta', '=', 'on',),
				),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Likes','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the portfolio likes counter in meta on portfolio page','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_content_position',
				'type' => 'radio', //the field type
				'title' => esc_html__('Content position', 'dfd-native'),
				'sub_desc' => '',
				'options' => array(
					'bottom' => esc_html__('Under media', 'dfd-native'),
					'front' => esc_html__('In front of the media', 'dfd-native'),
				),
				'default' => 'bottom',
				'hint' => array(
					'title'   => esc_attr__('Content position','dfd-native'),
					'content' => esc_attr__('This option allows you to choose the displaying of the portfolio info content. You can set the content under or infront of the portfolio items','dfd-native')
				)
			),
			array(
				'id' => '',
				'type' => 'radio', //the field type
				'title' => esc_html__('Content alignment', 'dfd-native'),
				'sub_desc' => '',
				'options' => array(
					'top' => esc_html__('Top', 'dfd-native'),
					'middle' => esc_html__('Middle', 'dfd-native'),
					'bottom' => esc_html__('Bottom', 'dfd-native'),
				),
				'required' => array(
					array('portfolio_content_position', '=', 'front',),
				),
				'default' => 'bottom',
				'hint' => array(
					'title'   => esc_attr__('Content alignment','dfd-native'),
					'content' => esc_attr__('This option allows you to align the portfolio item info vertically','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_show_content',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Description', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Description','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the portfolio description on portfolio page','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_content_alignment',
				'type' => 'radio', //the field type
				'title' => esc_html__('Content alignment', 'dfd-native'),
				'sub_desc' => '',
				'options' => array(
					'text-center' => esc_html__('Center', 'dfd-native'),
					'text-left' => esc_html__('Left', 'dfd-native'),
					'text-right' => esc_html__('Right', 'dfd-native'),
				),
				'default' => 'text-left',
				'required' => array(
					array('portfolio_show_content', '=', 'on'),
				),
				'hint' => array(
					'title'   => esc_attr__('Content alignment','dfd-native'),
					'content' => esc_attr__('This option allows you to align the portfolio description vertically','dfd-native')
				)
			),
			array(
				'id' => 'info_portfolio_page_extra',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Extra features', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'portfolio_vc_content_position',
				'type' => 'radio',
				'title' => esc_html__('Content position', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'top' => esc_html__('Before projects', 'dfd-native'),
					'bottom' => esc_html__('After projects', 'dfd-native'),
				),
				'default' => 'top',
				'hint' => array(
					'title'   => esc_attr__('Content position','dfd-native'),
					'content' => esc_attr__('This option allows you to choose the displaying of the Visual Composer content. You can set the content above or below the portfolio items. There is also an option on the item\'s page if you need to change it for single portfolio page','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_items_offset',
				'type' => 'text',
				'title' => esc_html__('Portfolio items offset (in px)', 'dfd-native'),
				'validate' => 'numeric',
				'default' => '20',
				'hint' => array(
					'title'   => esc_attr__('Items offset','dfd-native'),
					'content' => esc_attr__('This option allows you to add space between single portfolio items, don\'t include "px". There is also an option on the item\'s page if you need to change it for single portfolio page','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_appear_effect',
				'type' => 'select',
				'title' => esc_html__('Items appear effect', 'dfd-native'),
				'desc' => '',
				'options' => Dfd_Theme_Helpers::dfd_module_animation_styles('options'),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Appear effect','dfd-native'),
					'content' => esc_attr__('Choose the appear effect for the portfolio items. There is also an option on the item\'s page if you need to change it for single portfolio page','dfd-native')
				)
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Portfolio archive page options', 'dfd-native'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'subsection' => true,
		'icon' => 'dashicons dashicons-media-interactive',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'info_portfolio_archive',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Layout settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'portfolio_archive_stun_header',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Custom header', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',//this should be the key as defined above
				'hint' => array(
						'title'   => esc_attr__('Custom header','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the custom header for the archive portfolio page','dfd-native')
					)
			),
			array(
				'id' => 'portfolio_archive_layout_width',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Layout width', 'dfd-native'),
				'desc' => '',
				'options' => Dfd_Theme_Helpers::dfd_layout_width(),
				'hint' => array(
                    'title'   => esc_attr__('Layout width','dfd-native'),
                    'content' => esc_attr__('This option defines the content width on archive page','dfd-native')
                )
			),
			array(
				'id' => 'portfolio_archive_sidebars_configuration',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Archive page layout', 'dfd-native'),
				'sub_desc' => esc_html__('Select one of the layout types for single pages', 'dfd-native'),
				'options' => Dfd_Theme_Helpers::dfd_page_layouts(),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Archive layout','dfd-native'),
					'content' => esc_attr__('Select one of the layout types which will be set for archive portfolio page','dfd-native')
				)
			),
			array(
				'id' => 'info_portfolio_arcive_page',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Page settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'portfolio_archive_style',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Portfolio layout style', 'dfd-native'),
				'options' => array(
					'fitRows' => array(
						'title' => esc_html__('Grid','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/portfolio-layout.png'
					),
					'masonry' => array(
						'title' => esc_html__('Masonry','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/portfolio-layout.png'
					),
					'justified' => array(
						'title' => esc_html__('Justified grid','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/portfolio-layout.png'
					),
					'metro' => array(
						'title' => esc_html__('Metro','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/portfolio-layout.png'
					),
				),
				'default' => 'fitRows',
				'hint' => array(
					'title'   => esc_attr__('Layout style','dfd-native'),
					'content' => esc_attr__('Choose layout style for the portfolio items on portfolio archive page','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_archive_content_style',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Portfolio content style', 'dfd-native'),
				'options' => array(
					'standard' => array(
						'title' => esc_html__('Simple','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/portfolio-tiled.png'
					),
					'tiled' => array(
						'title' => esc_html__('Tiled','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/portfolio-tiled.png'
					),
				),
				'default' => 'standard',
				'hint' => array(
					'title'   => esc_attr__('Content style','dfd-native'),
					'content' => esc_attr__('Choose content style for the portfolio item on archive portfolio page. Simple style allows you to have transparent background without hover effect. Tiled style allows you to have white background with shadow hover effect','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_archive_columns',
				'type' => 'radio',
				'title' => esc_html__('Number of columns', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'1' => esc_html__('One', 'dfd-native'),
					'2' => esc_html__('Two', 'dfd-native'),
					'3' => esc_html__('Three', 'dfd-native'),
					'4' => esc_html__('Four', 'dfd-native'),
					'5' => esc_html__('Five', 'dfd-native'),
				),
				'default' => '3',
				'required' => array(
					array('portfolio_archive_style', '!=', 'justified'),
				),
				'hint' => array(
					'title'   => esc_attr__('Number of columns','dfd-native'),
					'content' => esc_attr__('Choose the number of columns for the portfolio archive page','dfd-native')
				)
			),
			array(
				'id' => 'info_portfolio_archive_content',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Content settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'portfolio_archive_show_title',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Titles', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Titles','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the portfolio title on portfolio archive page','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_archive_show_subtitle',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Subtitles', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Subtitles','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the portfolio subtitle on portfolio archive page','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_archive_show_meta',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Meta', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Meta','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the portfolio meta on portfolio archive page','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_archive_show_meta_date',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Date', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('portfolio_archive_show_meta', '=', 'on',),
				),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Date','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the portfolio publication date on portfolio archive page','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_archive_show_meta_category',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Category', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('portfolio_archive_show_meta', '=', 'on',),
				),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Category','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the portfolio category in meta on portfolio archive page','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_archive_show_meta_comments',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Comments', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('portfolio_archive_show_meta', '=', 'on',),
				),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Comments','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the portfolio comments counter in meta on portfolio archive page','dfd-native')
				)	
			),
			array(
				'id' => 'portfolio_archive_show_meta_likes',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Likes', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('portfolio_archive_show_meta', '=', 'on',),
				),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Likes','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the portfolio likes counter in meta on portfolio archive page','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_archive_content_position',
				'type' => 'radio', //the field type
				'title' => esc_html__('Content position', 'dfd-native'),
				'sub_desc' => '',
				'options' => array(
					'bottom' => esc_html__('Under media', 'dfd-native'),
					'front' => esc_html__('In front of the media', 'dfd-native'),
				),
				'default' => 'bottom',
				'hint' => array(
					'title'   => esc_attr__('Content position','dfd-native'),
					'content' => esc_attr__('This option allows you to choose the displaying of the portfolio info content. You can set the content under or infront of the portfolio items','dfd-native')
				)
			),
			array(
				'id' => '',
				'type' => 'radio', //the field type
				'title' => esc_html__('Content alignment', 'dfd-native'),
				'sub_desc' => '',
				'options' => array(
					'top' => esc_html__('Top', 'dfd-native'),
					'middle' => esc_html__('Middle', 'dfd-native'),
					'bottom' => esc_html__('Bottom', 'dfd-native'),
				),
				'required' => array(
					array('portfolio_archive_content_position', '=', 'front',),
				),
				'default' => 'bottom',
				'hint' => array(
					'title'   => esc_attr__('Content alignment','dfd-native'),
					'content' => esc_attr__('This option allows you to align the portfolio description vertically','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_archive_show_content',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Description', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Description','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the portfolio description on portfolio archive page','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_archive_content_alignment',
				'type' => 'radio', //the field type
				'title' => esc_html__('Content alignment', 'dfd-native'),
				'sub_desc' => '',
				'options' => array(
					'text-center' => esc_html__('Center', 'dfd-native'),
					'text-left' => esc_html__('Left', 'dfd-native'),
					'text-right' => esc_html__('Right', 'dfd-native'),
				),
				'default' => 'text-left',
				'required' => array(
					array('portfolio_archive_show_content', '=', 'on'),
				),
				'hint' => array(
					'title'   => esc_attr__('Content alignment','dfd-native'),
					'content' => esc_attr__('This option allows you to align the portfolio description vertically','dfd-native')
				)
			),
			array(
				'id' => 'info_portfolio_archive_extra',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Extra features', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'portfolio_archive_items_offset',
				'type' => 'text',
				'title' => esc_html__('Portfolio items offset (in px)', 'dfd-native'),
				'validate' => 'numeric',
				'default' => '20',
				'hint' => array(
					'title'   => esc_attr__('Items offset','dfd-native'),
					'content' => esc_attr__('This option allows you to add space between single portfolios, don\'t include "px"','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_archive_appear_effect',
				'type' => 'select',
				'title' => esc_html__('Items appear effect', 'dfd-native'),
				'desc' => '',
				'options' => Dfd_Theme_Helpers::dfd_module_animation_styles('options'),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Appear effect','dfd-native'),
					'content' => esc_attr__('Choose the appear effect for the portfolios','dfd-native')
				)
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Portfolio hover options', 'dfd-native'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'subsection' => true,
		'icon' => 'dashicons dashicons-media-interactive',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'info_portfolio_hover',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Main hover settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'portfolio_hover_enable',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Portfolio hover', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), '' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Portfolio hover','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable the hover effect for the portfolio items','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_hover_appear_effect',
				'type' => 'select',
				'title' => esc_html__('Mask appear effect', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'dfd-fade-out' => esc_html__('Fade out', 'dfd-native'),
					'dfd-fade-offset' => esc_html__('Fade out with offset', 'dfd-native'),
					'dfd-left-to-right' => esc_html__('From left to right', 'dfd-native'),
					'dfd-right-to-left' => esc_html__('From right to left', 'dfd-native'),
					'dfd-top-to-bottom' => esc_html__('From top to bottom', 'dfd-native'),
					'dfd-bottom-to-top' => esc_html__('From bottom to top', 'dfd-native'),
					'portfolio-hover-style-1' => esc_html__('Following the mouse', 'dfd-native'),
					'dfd-3d-parallax' => esc_html__('3d parallax effect', 'dfd-native'),
				),
				'default' => 'dfd-fade-out',
				'required' => array(
					array('portfolio_hover_enable', '=', 'on'),
				),
				'hint' => array(
					'title'   => esc_attr__('Mask appear effect','dfd-native'),
					'content' => esc_attr__('This option allows you to choose the mask appear effect for the portfolio items','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_hover_image_effect',
				'type' => 'select',
				'title' => esc_html__('Image effect', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'panr' => esc_html__('Image parallax', 'dfd-native'),
					'dfd-image-scale' => esc_html__('Grow', 'dfd-native'),
					'dfd-image-scale-rotate' => esc_html__('Grow with rotation', 'dfd-native'),
					'dfd-image-shift-left' => esc_html__('Shift left', 'dfd-native'),
					'dfd-image-shift-right' => esc_html__('Shift right', 'dfd-native'),
					'dfd-image-shift-top' => esc_html__('Shift top', 'dfd-native'),
					'dfd-image-shift-bottom' => esc_html__('Shift bottom', 'dfd-native'),
					'dfd-image-blur' => esc_html__('Blur', 'dfd-native'),
				),
				'default' => 'panr',
				'required' => array(
					array('portfolio_hover_appear_effect', '!=', 'dfd-left-to-right-shift'),
					array('portfolio_hover_appear_effect', '!=', 'dfd-right-to-left-shift'),
					array('portfolio_hover_appear_effect', '!=', 'dfd-top-to-bottom-shift'),
					array('portfolio_hover_appear_effect', '!=', 'dfd-bottom-to-top-shift'),
					array('portfolio_hover_appear_effect', '!=', 'dfd-rotate-left'),
					array('portfolio_hover_appear_effect', '!=', 'dfd-rotate-right'),
					array('portfolio_hover_appear_effect', '!=', 'dfd-rotate-top'),
					array('portfolio_hover_appear_effect', '!=', 'dfd-rotate-bottom'),
					array('portfolio_hover_appear_effect', '!=', 'dfd-rotate-content-up'),
					array('portfolio_hover_appear_effect', '!=', 'dfd-rotate-content-down'),
					array('portfolio_hover_appear_effect', '!=', 'dfd-3d-parallax'),
				),
				'hint' => array(
					'title'   => esc_attr__('Image parallax','dfd-native'),
					'content' => esc_attr__('This option allows you to choose the image effect for the portfolio featured image','dfd-native')
				)
			),
			array(
				'id' => 'info_portfolio_hover_colors',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Hover color scheme settings', 'dfd-native').'</h3>',
				'required' => array(
					array('portfolio_hover_enable', '=', 'on'),
				),
			),
			array(
				'id' => 'portfolio_hover_text_color',
				'type' => 'color',
				'title' => esc_html__('Text color', 'dfd-native'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
				'required' => array(
					array('portfolio_hover_enable', '=', 'on'),
				),
				'hint' => array(
					'title'   => esc_attr__('Text color','dfd-native'),
					'content' => esc_attr__('Choose the text color for the portfolio hover','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_hover_mask_style',
				'type' => 'radio',
				'title' => esc_html__('Hover mask background style', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'simple' => esc_html__('Simple color','dfd-native'),
					'gradient' => esc_html__('Gradient','dfd-native'),
				),
				'required' => array(
					array('portfolio_hover_enable', '=', 'on'),
				),
				'default' => 'simple',
				'hint' => array(
					'title'   => esc_attr__('Background style','dfd-native'),
					'content' => esc_attr__('Choose the background style for the hover mask. You can set simple color or gradient','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_hover_bg',
				'type' => 'color',
				'title' => esc_html__('Mask background color', 'dfd-native'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
				'required' => array(
					'portfolio_hover_mask_style', "=", 'simple'
				),
				'hint' => array(
					'title'   => esc_attr__('Background color','dfd-native'),
					'content' => esc_attr__('Choose the background color for the hover mask','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_hover_bg_gradient',
				'type' => 'color_gradient',
				'title' => esc_html__('Background gradient', 'dfd-native'),
				'default'  => array(
					'from' => '',
					'to'   => '', 
				),
				'validate' => 'color',
				'required' => array(
					'portfolio_hover_mask_style', "=", 'gradient'
				),
				'hint' => array(
					'title'   => esc_attr__('Background gradient','dfd-native'),
					'content' => esc_attr__('Choose the start and end color for the hover mask gradient color','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_hover_bg_opacity',
				'type' => 'slider',
				'title' => esc_html__('Background opacity', 'dfd-native'),
				'desc' => '',
				'min' => '1',
				'max' => '100',
				'step' => '1',
				'default' => '70',
				'required' => array(
					array('portfolio_hover_enable', '=', 'on'),
				),
				'hint' => array(
					'title'   => esc_attr__('Background opacity','dfd-native'),
					'content' => esc_attr__('Set the opacity value for the hover mask background','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_hover_buttons_bg',
				'type' => 'color',
				'title' => esc_html__('Buttons background', 'dfd-native'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
				'required' => array(
					array('portfolio_hover_enable', '=', 'on'),
				),
				'hint' => array(
					'title'   => esc_attr__('Buttons background','dfd-native'),
					'content' => esc_attr__('This option defines the background color for buttons if Buttons option is selected as main hover decoration. You can overwrite this setting from inside shortcodes but this value will be applied for portfolio page','dfd-native')
				)
			),
			array(
				'id' => 'info_portfolio_hover_mask',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Mask settings', 'dfd-native').'</h3>',
				'required' => array(
					array('portfolio_hover_enable', '=', 'on'),
				),
			),
			array(
				'id' => 'portfolio_hover_mask_border',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Frame decoration', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'off',
				'required' => array(
					array('portfolio_hover_enable', '=', 'on'),
				),
				'hint' => array(
					'title'   => esc_attr__('Frame decoration','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable the frame decoration on hover','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_hover_mask_bordered_style',
				'type' => 'radio',
				'title' => esc_html__('Frame style', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'simple-border' => esc_html__('Simple border','dfd-native'),
					'offset' => esc_html__('Offset','dfd-native'),
				),
				'required' => array(
					array('portfolio_hover_mask_border', '=', 'on'),
				),
				'default' => 'offset',
				'hint' => array(
					'title'   => esc_attr__('Frame style','dfd-native'),
					'content' => esc_attr__('This option allows you to choose the style for the frame decoration on hover','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_hover_mask_bordered_size',
				'type' => 'slider',
				'title' => esc_html__('Frame size', 'dfd-native'),
				'desc' => '',
				'min' => '1',
				'max' => '20',
				'step' => '1',
				'default' => '10',
				'required' => array(
					array('portfolio_hover_mask_border', '=', 'on'),
				),
				'hint' => array(
					'title'   => esc_attr__('Frame size','dfd-native'),
					'content' => esc_attr__('This option allows you to choose the border or offset size for the frame decoration on hover','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_hover_mask_bordered_bg',
				'type' => 'color',
				'title' => esc_html__('Frame border color', 'dfd-native'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
				'required' => array(
					array('portfolio_hover_mask_bordered_style', '=', 'simple-border'),
				),
				'hint' => array(
					'title'   => esc_attr__('Frame border color','dfd-native'),
					'content' => esc_attr__('Choose the color for the frame decoration on hover','dfd-native')
				)
			),
			array(
				'id' => 'info_portfolio_hover_deco',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Hover decoration settings', 'dfd-native').'</h3>',
				'required' => array(
					array('portfolio_hover_enable', '=', 'on'),
				),
			),
			array(
				'id' => 'portfolio_hover_main_decoration',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Main hover decoration', 'dfd-native'),
				'options' => array(
					'none' => array(
						'title' => esc_html__('None','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/hover-decoration.png'
					),
					'heading' => array(
						'title' => esc_html__('Heading','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/hover-decoration.png'
					),
					'plus' => array(
						'title' => esc_html__('Plus','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/hover-decoration.png'
					),
					'dots' => array(
						'title' => esc_html__('Dots','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/hover-decoration.png'
					),
					'buttons' => array(
						'title' => esc_html__('Buttons','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/hover-decoration.png'
					),
				),
				'default' => 'dots',
				'required' => array(
					array('portfolio_hover_enable', '=', 'on'),
				),
				'hint' => array(
					'title'   => esc_attr__('Main decoration','dfd-native'),
					'content' => esc_attr__('Choose the main decoration for the portfolio hover','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_hover_show_title',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Title', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'required' => array(
					array('portfolio_hover_main_decoration', '=', 'heading'),
				),
				'hint' => array(
					'title'   => esc_attr__('Title','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the portfolio title on hover','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_hover_show_subtitle',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Subtitle', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'required' => array(
					array('portfolio_hover_main_decoration', '=', 'heading'),
				),
				'hint' => array(
					'title'   => esc_attr__('Subtitle','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the portfolio subtitle on hover','dfd-native')
				)
			),
			array(
				'id' => 'portfolio_hover_plus_position',
				'type' => 'select',
				'title' => esc_html__('Plus decoration', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'dfd-middle' => esc_html__('Big plus in the middle of the thumb', 'dfd-native'),
					'dfd-middle dfd-plus-bordered' => esc_html__('Small plus in the middle of the thumb', 'dfd-native'),
					'dfd-cursor-plus' => esc_html__('Following the mouse', 'dfd-native'),
				),
				'default' => 'custom',
				'required' => array(
					array('portfolio_hover_main_decoration', '=', 'plus'),
				),
				'hint' => array(
					'title'   => esc_attr__('Plus decoration','dfd-native'),
					'content' => esc_attr__('Choose one of the plus decoration styles','dfd-native')
				)
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Gallery options', 'dfd-native'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'dashicons dashicons-images-alt2',
		//Lets leave this as a blank section, no options just some intro text set above.
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Base gallery options', 'dfd-native'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'dashicons dashicons-images-alt2',
		'subsection' => true,
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'dfd_gallery_top_link_src',
				'type' => 'radio',
				'title' => esc_html__('Gallery top link source', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'page' => esc_html__('Page', 'dfd-native'),
					'url' => esc_html__('Custom URL', 'dfd-native'),
				),
				'default' => 'page',
				'hint' => array(
						'title'   => esc_attr__('Link source','dfd-native'),
						'content' => esc_attr__('This option allows you to set the page or custom link which will be used for the button placed next to the categories and tags dropdown on pages with "Gallery page template"','dfd-native')
					)
			),
			array(
				'id' => 'dfd_gallery_top_page_select',
				'type'     => 'select',
				'data'     => 'pages',
				'title' => esc_html__('Gallery page', 'dfd-native'),
				'required' => array(
					array('dfd_gallery_top_link_src', '=', 'page'),
				),
				'hint' => array(
						'title'   => esc_attr__('Portfolio page','dfd-native'),
						'content' => esc_attr__('Select the page which will be used as main gallery page','dfd-native')
					)
			),
			array(
				'id' => 'dfd_gallery_top_page_url',
				'type' => 'text',
				'title' => esc_html__('Gallery page URL', 'dfd-native'),
				'desc' => '',
				'validate' => 'url',
				'required' => array(
					array('dfd_gallery_top_link_src', '=', 'url'),
				),
				'default' => '',
				'hint' => array(
						'title'   => esc_attr__('Portfolio page','dfd-native'),
						'content' => esc_attr__('Select the page which will be used as main gallery page','dfd-native')
					)
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Single gallery item options', 'dfd-native'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'subsection' => true,
		'icon' => 'dashicons dashicons-images-alt2',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'info_gallery_single_layout',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Layout settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'gallery_single_stun_header',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Custom header', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
						'title'   => esc_attr__('Custom header','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the custom header for the single gallery items by default. There is also an option on the single gallery item page if you need to change custom header settings on single gallery','dfd-native')
					)
			),
			array(
				'id' => 'gallery_single_layout',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Layout width', 'dfd-native'),
				'desc' => '',
				'options' => Dfd_Theme_Helpers::dfd_layout_width(),
				'hint' => array(
                    'title'   => esc_attr__('Layout width','dfd-native'),
                    'content' => esc_attr__('This option defines the gallery singe item content width','dfd-native')
                )
			),
			array(
				'id' => 'gallery_single_sidebars_configuration',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Single layout', 'dfd-native'),
				'sub_desc' => esc_html__('Select one of the layout types for single pages', 'dfd-native'),
				'options' => Dfd_Theme_Helpers::dfd_page_layouts(),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Single layout','dfd-native'),
					'content' => esc_attr__('Select one of the layout types which will be set as default for all the gallery items. There is also an option on the item\'s page if you need to change the layout for the single item','dfd-native')
				)
			),
			array(
				'id' => 'info_gallery_single_page',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Page settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'gallery_single_style',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Gallery layout style', 'dfd-native'),
				'options' => Dfd_Theme_Helpers::dfd_portfolio_single_layout_style(),
				'default' => 'carousel',
				'hint' => array(
					'title'   => esc_attr__('Layout style','dfd-native'),
					'content' => esc_attr__('Choose layout style for the single gallery items','dfd-native')
				)
			),
			array(
				'id' => 'gallery_single_columns',
				'type' => 'radio',
				'title' => esc_html__('Number of columns', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'1' => esc_html__('One', 'dfd-native'),
					'2' => esc_html__('Two', 'dfd-native'),
					'3' => esc_html__('Three', 'dfd-native'),
					'4' => esc_html__('Four', 'dfd-native'),
					'5' => esc_html__('Five', 'dfd-native'),
				),
				'default' => '3',
				'required' => array(
					array('gallery_single_style', '!=', 'carousel'),
					array('gallery_single_style', '!=', 'video'),
				),
				'hint' => array(
					'title'   => esc_attr__('Number of columns','dfd-native'),
					'content' => esc_attr__('Choose the number of columns for the gallery page','dfd-native')
				)
			),
			array(
				'id' => 'info_gallery_single_content',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Content settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'gallery_single_show_top_tags',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Category', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Category','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the gallery category on single gallery item','dfd-native')
				)
			),
			array(
				'id' => 'gallery_single_show_title',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Title', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Title','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the gallery title on single gallery item','dfd-native')
				)
			),
			array(
				'id' => 'gallery_single_show_meta',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Meta', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Meta','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the gallery meta on single gallery item','dfd-native')
				)
			),
			array(
				'id' => 'gallery_single_show_meta_date',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Date', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('gallery_single_show_meta', '=', 'on',),
				),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Date','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the gallery publication date on single gallery item','dfd-native')
				)
			),
			array(
				'id' => 'gallery_single_show_meta_category',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Category', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('gallery_single_show_meta', '=', 'on',),
				),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Category','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the gallery category in meta on single gallery item','dfd-native')
				)
			),
			array(
				'id' => 'gallery_single_show_meta_comments',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Comments', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('gallery_single_show_meta', '=', 'on',),
				),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Comments','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the gallery comments counter in meta on single gallery item','dfd-native')
				)
			),
			array(
				'id' => 'gallery_single_show_meta_likes',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Likes', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('gallery_single_show_meta', '=', 'on',),
				),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Likes','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the gallery likes counter in meta on single gallery item','dfd-native')
				)
			),
			array(
				'id' => 'gallery_single_show_fixed_share',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Fixed share', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'sub_desc' => '',
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Fixed share','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the fixed share on single gallery item','dfd-native')
				)
			),
			array(
				'id' => 'info_single_gallery_bottom_content',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Extra elements under post content', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'gallery_single_show_bottom_tags',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Tags', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'sub_desc' => '',
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Tags','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the post tags on single post page','dfd-native')
				)
			),
			array(
				'id' => 'gallery_single_show_bottom_share',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Share', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'sub_desc' => '',
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Share','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the post share on single post page','dfd-native')
				)
			),
			array(
				'id' => 'gallery_single_show_bottom_likes',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Likes', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'sub_desc' => '',
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Likes','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the post comments likes on single post page','dfd-native')
				)
			),
			array(
				'id' => 'gallery_single_show_author',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Show author info', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'sub_desc' => '',
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Author info','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the information about author of the gallery items. This information is located under the post content. Please make sure that author info is defined in the Users section -> User you need -> Biographical Info','dfd-native')
				)
			),
			array(
				'id' => 'info_gallery_single_pagination',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Pagination settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'gallery_single_enable_pagination',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Inside pagination', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'sub_desc' => '',
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Inside pagination','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the inside pagination on single gallery item','dfd-native')
				)
			),
			array(
				'id' => 'gallery_single_pagination_style',
				'type' => 'radio',
				'title' => esc_html__('Pagination position', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'off' => esc_html__('Disable', 'dfd-native'),
					'fixed' => esc_html__('Fixed', 'dfd-native'),
					'top' => esc_html__('Top', 'dfd-native'),
				),
				'default' => '',
				'required' => array(
					array('gallery_single_enable_pagination', '=', 'on'),
				),
				'hint' => array(
					'title'   => esc_attr__('Pagination position','dfd-native'),
					'content' => esc_attr__('This option allows you to choose the position of the inside pagination on single gallery item','dfd-native')
				)
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Gallery page options', 'dfd-native'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'dashicons dashicons-images-alt2',
		'subsection' => true,
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'info_gallery_layout',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Layout settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'gallery_stun_header',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Custom header', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',//this should be the key as defined above
				'hint' => array(
						'title'   => esc_attr__('Custom header','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the custom header for the single gallery pages by default. There is also an option on the single gallery page if you need to change custom header settings on single page','dfd-native')
					)
			),
			array(
				'id' => 'gallery_layout_width',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Layout width', 'dfd-native'),
				'desc' => '',
				'options' => Dfd_Theme_Helpers::dfd_layout_width(),
				'hint' => array(
                    'title'   => esc_attr__('Layout width','dfd-native'),
                    'content' => esc_attr__('This option defines the gallery page content width','dfd-native')
                )
			),
			array(
				'id' => 'gallery_sidebars_configuration',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Gallery page layout', 'dfd-native'),
				'sub_desc' => esc_html__('Select one of the layout types for single pages', 'dfd-native'),
				'options' => Dfd_Theme_Helpers::dfd_page_layouts(),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Gallery layout','dfd-native'),
					'content' => esc_attr__('Select one of the layout types which will be set as default for all the gallery items. There is also an option on the item\'s page if you need to change the layout for the single item','dfd-native')
				)
			),
			array(
				'id' => 'info_gallery_page',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Page settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'gallery_cat_tag',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Categories and tags dropdown', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',//this should be the key as defined above
				'hint' => array(
					'title'   => esc_attr__('Categories and tags dropdown','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide categories, tags and author drop-down sorter before gallery items','dfd-native')
				)
			),
			array(
				'id' => 'gallery_style',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Gallery layout style', 'dfd-native'),
				'options' => array(
					'fitRows' => array(
						'title' => esc_html__('Grid','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/gallery-layout.png'
					),
					'masonry' => array(
						'title' => esc_html__('Masonry','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/gallery-layout.png'
					),
					'justified' => array(
						'title' => esc_html__('Justified grid','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/gallery-layout.png'
					),
					'metro' => array(
						'title' => esc_html__('Metro','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/gallery-layout.png'
					),
				),
				'default' => 'fitRows',
				'hint' => array(
					'title'   => esc_attr__('Layout style','dfd-native'),
					'content' => esc_attr__('Choose layout style for the gallery page','dfd-native')
				)
			),
			array(
				'id' => 'gallery_content_style',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Gallery content style', 'dfd-native'),
				'options' => array(
					'standard' => array(
						'title' => esc_html__('Simple','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/portfolio-tiled.png'
					),
					'tiled' => array(
						'title' => esc_html__('Tiled','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/portfolio-tiled.png'
					),
				),
				'default' => 'standard',
				'hint' => array(
					'title'   => esc_attr__('Content style','dfd-native'),
					'content' => esc_attr__('Choose content style for the gallery item on gallery page. Simple style allows you to have transparent background without hover effect. Tiled style allows you to have white background with shadow hover effect','dfd-native')
				)
			),
			array(
				'id' => 'gallery_columns',
				'type' => 'radio',
				'title' => esc_html__('Number of columns', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'1' => esc_html__('One', 'dfd-native'),
					'2' => esc_html__('Two', 'dfd-native'),
					'3' => esc_html__('Three', 'dfd-native'),
					'4' => esc_html__('Four', 'dfd-native'),
					'5' => esc_html__('Five', 'dfd-native'),
				),
				'default' => '3',
				'required' => array(
					array('gallery_style', '!=', 'justified'),
				),
				'hint' => array(
					'title'   => esc_attr__('Number of columns','dfd-native'),
					'content' => esc_attr__('Choose the number of columns for the gallery page','dfd-native')
				)
			),
			array(
				'id' => 'gallery_sort_panel',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Sort panel', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('gallery_style', '!=', 'standard'),
					array('gallery_style', '!=', 'left-image'),
					array('gallery_style', '!=', 'right-image'),
					array('gallery_style', '!=', 'justified'),
					array('gallery_style', '!=', 'metro'),
				),
				'default' => 'on',//this should be the key as defined above
				'hint' => array(
					'title'   => esc_attr__('Sort panel','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable gallery categories sorter above gallery items. There is also an option on the item\'s page if you need to change it for single gallery page','dfd-native')
				)
			),
			array(
				'id' => 'gallery_sort_panel_align',
				'type' => 'radio', //the field type
				'title' => esc_html__('Sort panel alignment', 'dfd-native'),
				'sub_desc' => '',
				'options' => array(
					'text-left' => esc_html__('Left', 'dfd-native'),
					'text-right' => esc_html__('Right', 'dfd-native'),
					'text-center' => esc_html__('Center', 'dfd-native'),
				),
				'required' => array(
					array('gallery_sort_panel', '=', 'on',),
				),
				'default' => 'text-left',
				'hint' => array(
					'title'   => esc_attr__('Sort panel alignment','dfd-native'),
					'content' => esc_attr__('This option allows you to align the sort panel horizontally','dfd-native')
				)
			),
			array(
				'id' => 'info_gallery_content',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Content settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'gallery_show_top_cat',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Top category', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Top category','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the category name on the top right side of the featured image','dfd-native')
				)
			),
			array(
				'id' => 'gallery_show_title',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Titles', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Titles','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the gallery title on gallery page','dfd-native')
				)	
			),
			array(
				'id' => 'gallery_show_subtitle',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Subtitles', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Subtitles','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the gallery subtitle on gallery page','dfd-native')
				)
				
			),
			array(
				'id' => 'gallery_show_meta',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Meta', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Meta','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the gallery meta on gallery page','dfd-native')
				)
			),
			array(
				'id' => 'gallery_show_meta_date',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Date', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('gallery_show_meta', '=', 'on',),
				),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Date','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the gallery publication date on gallery page','dfd-native')
				)
			),
			array(
				'id' => 'gallery_show_meta_category',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Category', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('gallery_show_meta', '=', 'on',),
				),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Category','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the gallery category in meta on gallery page','dfd-native')
				)
			),
			array(
				'id' => 'gallery_show_meta_comments',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Comments', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('gallery_show_meta', '=', 'on',),
				),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Comments','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the gallery comments counter in meta on gallery page','dfd-native')
				)
			),
			array(
				'id' => 'gallery_show_meta_likes',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Likes', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('gallery_show_meta', '=', 'on',),
				),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Likes','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the gallery likes counter in meta on gallery page','dfd-native')
				)
			),
			array(
				'id' => 'gallery_content_position',
				'type' => 'radio', //the field type
				'title' => esc_html__('Content position', 'dfd-native'),
				'sub_desc' => '',
				'options' => array(
					'bottom' => esc_html__('Under media', 'dfd-native'),
					'front' => esc_html__('In front of the media', 'dfd-native'),
				),
				'default' => 'bottom',
				'hint' => array(
					'title'   => esc_attr__('Content position','dfd-native'),
					'content' => esc_attr__('This option allows you to choose the displaying of the gallery info content. You can set the content under or infront of the gallery items','dfd-native')
				)
			),
			array(
				'id' => '',
				'type' => 'radio', //the field type
				'title' => esc_html__('Content alignment', 'dfd-native'),
				'sub_desc' => '',
				'options' => array(
					'top' => esc_html__('Top', 'dfd-native'),
					'middle' => esc_html__('Middle', 'dfd-native'),
					'bottom' => esc_html__('Bottom', 'dfd-native'),
				),
				'required' => array(
					array('gallery_content_position', '=', 'front',),
				),
				'default' => 'bottom',
				'hint' => array(
					'title'   => esc_attr__('Content alignment','dfd-native'),
					'content' => esc_attr__('This option allows you to align the gallery description vertically','dfd-native')
				)
			),
			array(
				'id' => 'gallery_content_alignment',
				'type' => 'radio', //the field type
				'title' => esc_html__('Content alignment', 'dfd-native'),
				'sub_desc' => '',
				'options' => array(
					'text-center' => esc_html__('Center', 'dfd-native'),
					'text-left' => esc_html__('Left', 'dfd-native'),
					'text-right' => esc_html__('Right', 'dfd-native'),
				),
				'default' => 'text-left',
				'required' => array(
					array('gallery_show_content', '=', 'on'),
				),
				'hint' => array(
					'title'   => esc_attr__('Content alignment','dfd-native'),
					'content' => esc_attr__('This option allows you to align the gallery content horizontally','dfd-native')
				)
			),
			array(
				'id' => 'info_gallery_extra',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Extra features', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'gallery_vc_content_position',
				'type' => 'radio',
				'title' => esc_html__('Content position', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'top' => esc_html__('Before projects', 'dfd-native'),
					'bottom' => esc_html__('After projects', 'dfd-native'),
				),
				'default' => 'top',
				'hint' => array(
					'title'   => esc_attr__('Content position','dfd-native'),
					'content' => esc_attr__('This option allows you to choose the displaying of the Visual Composer content. You can set the content above or below the gallery items. There is also an option on the item\'s page if you need to change it for single gallery page','dfd-native')
				)
			),
			array(
				'id' => 'gallery_items_offset',
				'type' => 'text',
				'title' => esc_html__('Gallery items offset (in px)', 'dfd-native'),
				'validate' => 'numeric',
				'default' => '20',
				'hint' => array(
					'title'   => esc_attr__('Items offset','dfd-native'),
					'content' => esc_attr__('This option allows you to add space between single gallery items, don\'t include "px". There is also an option on the item\'s page if you need to change it for single gallery page','dfd-native')
				)
			),
			array(
				'id' => 'gallery_appear_effect',
				'type' => 'select',
				'title' => esc_html__('Items appear effect', 'dfd-native'),
				'desc' => '',
				'options' => Dfd_Theme_Helpers::dfd_module_animation_styles('options'),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Appear effect','dfd-native'),
					'content' => esc_attr__('Choose the appear effect for the gallery items. There is also an option on the item\'s page if you need to change it for single gallery page','dfd-native')
				)
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Gallery archive page options', 'dfd-native'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'subsection' => true,
		'icon' => 'dashicons dashicons-images-alt2',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'info_gallery_archive_layout',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Layout settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'gallery_archive_stun_header',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Custom header', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',//this should be the key as defined above
				'hint' => array(
						'title'   => esc_attr__('Custom header','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the custom header for the archive gallery page','dfd-native')
					)
			),
			array(
				'id' => 'gallery_archive_layout_width',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Layout width', 'dfd-native'),
				'desc' => '',
				'options' => Dfd_Theme_Helpers::dfd_layout_width(),
				'hint' => array(
                    'title'   => esc_attr__('Layout width','dfd-native'),
                    'content' => esc_attr__('This option defines the gallery content width','dfd-native')
                )
			),
			array(
				'id' => 'gallery_archive_sidebars_configuration',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Archive layout', 'dfd-native'),
				'sub_desc' => esc_html__('Select one of the layout types for single pages', 'dfd-native'),
				'options' => Dfd_Theme_Helpers::dfd_page_layouts(),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Archive layout','dfd-native'),
					'content' => esc_attr__('Select one of the layout types which will be set as default for archive gallery','dfd-native')
				)
			),
			array(
				'id' => 'info_gallery_archive_page',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Page settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'gallery_archive_style',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Gallery layout style', 'dfd-native'),
				'options' => array(
					'fitRows' => array(
						'title' => esc_html__('Grid','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/gallery-layout.png'
					),
					'masonry' => array(
						'title' => esc_html__('Masonry','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/gallery-layout.png'
					),
					'justified' => array(
						'title' => esc_html__('Justified grid','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/gallery-layout.png'
					),
					'metro' => array(
						'title' => esc_html__('Metro','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/gallery-layout.png'
					),
				),
				'default' => 'fitRows',
				'hint' => array(
					'title'   => esc_attr__('Layout style','dfd-native'),
					'content' => esc_attr__('Choose layout style for the gallery archive page','dfd-native')
				)
			),
			array(
				'id' => 'gallery_archive_content_style',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Gallery content style', 'dfd-native'),
				'options' => array(
					'standard' => array(
						'title' => esc_html__('Simple','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/portfolio-tiled.png'
					),
					'tiled' => array(
						'title' => esc_html__('Tiled','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/portfolio-tiled.png'
					),
				),
				'default' => 'standard',
				'hint' => array(
					'title'   => esc_attr__('Content style','dfd-native'),
					'content' => esc_attr__('Choose content style for the gallery item on gallery archive page. Simple style allows you to have transparent background without hover effect. Tiled style allows you to have white background with shadow hover effect','dfd-native')
				)
			),
			array(
				'id' => 'gallery_archive_columns',
				'type' => 'radio',
				'title' => esc_html__('Number of columns', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'1' => esc_html__('One', 'dfd-native'),
					'2' => esc_html__('Two', 'dfd-native'),
					'3' => esc_html__('Three', 'dfd-native'),
					'4' => esc_html__('Four', 'dfd-native'),
					'5' => esc_html__('Five', 'dfd-native'),
				),
				'default' => '3',
				'required' => array(
					array('gallery_archive_style', '!=', 'justified'),
				),
				'hint' => array(
					'title'   => esc_attr__('Number of columns','dfd-native'),
					'content' => esc_attr__('Choose the number of columns for the gallery archive page','dfd-native')
				)
			),
			array(
				'id' => 'info_gallery_archive_content',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Content settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'gallery_archive_show_title',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Titles', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Titles','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the gallery title on gallery archive page','dfd-native')
				)
			),
			array(
				'id' => 'gallery_archive_show_subtitle',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Subtitles', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Subtitles','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the gallery subtitle on gallery archive page','dfd-native')
				)
			),
			array(
				'id' => 'gallery_archive_show_meta',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Meta', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Meta','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the gallery meta on gallery archive page','dfd-native')
				)
			),
			array(
				'id' => 'gallery_archive_show_meta_date',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Date', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('gallery_archive_show_meta', '=', 'on',),
				),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Date','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the gallery publication date on gallery archive page','dfd-native')
				)
			),
			array(
				'id' => 'gallery_archive_show_meta_category',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Category', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('gallery_archive_show_meta', '=', 'on',),
				),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Category','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the gallery category in meta on gallery archive page','dfd-native')
				)
			),
			array(
				'id' => 'gallery_archive_show_meta_comments',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Comments', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('gallery_archive_show_meta', '=', 'on',),
				),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Comments','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the gallery comments counter in meta on gallery archive page','dfd-native')
				)
			),
			array(
				'id' => 'gallery_archive_show_meta_likes',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Likes', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'required' => array(
					array('gallery_archive_show_meta', '=', 'on',),
				),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Likes','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the gallery likes counter in meta on gallery archive page','dfd-native')
				)
			),
			array(
				'id' => 'gallery_archive_content_position',
				'type' => 'radio', //the field type
				'title' => esc_html__('Content position', 'dfd-native'),
				'sub_desc' => '',
				'options' => array(
					'bottom' => esc_html__('Under media', 'dfd-native'),
					'front' => esc_html__('In front of the media', 'dfd-native'),
				),
				'default' => 'bottom',
				'hint' => array(
					'title'   => esc_attr__('Content position','dfd-native'),
					'content' => esc_attr__('This option allows you to choose the displaying of the gallery info content. You can set the content under or infront of the gallery items','dfd-native')
				)
			),
			array(
				'id' => '',
				'type' => 'radio', //the field type
				'title' => esc_html__('Content alignment', 'dfd-native'),
				'sub_desc' => '',
				'options' => array(
					'top' => esc_html__('Top', 'dfd-native'),
					'middle' => esc_html__('Middle', 'dfd-native'),
					'bottom' => esc_html__('Bottom', 'dfd-native'),
				),
				'required' => array(
					array('gallery_archive_content_position', '=', 'front',),
				),
				'default' => 'bottom',
				'hint' => array(
					'title'   => esc_attr__('Content alignment','dfd-native'),
					'content' => esc_attr__('This option allows you to align the gallery description vertically','dfd-native')
				)
			),
			array(
				'id' => 'gallery_archive_content_alignment',
				'type' => 'radio', //the field type
				'title' => esc_html__('Content alignment', 'dfd-native'),
				'sub_desc' => '',
				'options' => array(
					'text-center' => esc_html__('Center', 'dfd-native'),
					'text-left' => esc_html__('Left', 'dfd-native'),
					'text-right' => esc_html__('Right', 'dfd-native'),
				),
				'default' => 'text-left',
				'required' => array(
					array('gallery_archive_show_content', '=', 'on'),
				),
				'hint' => array(
					'title'   => esc_attr__('Content alignment','dfd-native'),
					'content' => esc_attr__('This option allows you to align the gallery content horizontally','dfd-native')
				)
			),
			array(
				'id' => 'info_gallery_archive_extra',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Extra features', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'gallery_archive_items_offset',
				'type' => 'text',
				'title' => esc_html__('Gallery items offset (in px)', 'dfd-native'),
				'validate' => 'numeric',
				'default' => '20',
				'hint' => array(
					'title'   => esc_attr__('Items offset','dfd-native'),
					'content' => esc_attr__('This option allows you to add space between single gallery items, don\'t include "px"','dfd-native')
				)
			),
			array(
				'id' => 'gallery_archive_appear_effect',
				'type' => 'select',
				'title' => esc_html__('Items appear effect', 'dfd-native'),
				'desc' => '',
				'options' => Dfd_Theme_Helpers::dfd_module_animation_styles('options'),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Appear effect','dfd-native'),
					'content' => esc_attr__('Choose the appear effect for the gallery items','dfd-native')
				)
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Gallery hover style options', 'dfd-native'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'subsection' => true,
		'icon' => 'dashicons dashicons-images-alt2',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'info_gallery_hover_main',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Main hover settings', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'gallery_hover_enable',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Gallery hover', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), '' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'hint' => array(
					'title'   => esc_attr__('Gallery hover','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable the hover effect for the gallery items','dfd-native')
				)
			),
			array(
				'id' => 'gallery_hover_appear_effect',
				'type' => 'select',
				'title' => esc_html__('Mask appear effect', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'dfd-fade-out' => esc_html__('Fade out', 'dfd-native'),
					'dfd-fade-offset' => esc_html__('Fade out with offset', 'dfd-native'),
					'dfd-left-to-right' => esc_html__('From left to right', 'dfd-native'),
					'dfd-right-to-left' => esc_html__('From right to left', 'dfd-native'),
					'dfd-top-to-bottom' => esc_html__('From top to bottom', 'dfd-native'),
					'dfd-bottom-to-top' => esc_html__('From bottom to top', 'dfd-native'),
					'portfolio-hover-style-1' => esc_html__('Following the mouse', 'dfd-native'),
					'dfd-3d-parallax' => esc_html__('3d parallax effect', 'dfd-native'),
				),
				'default' => 'dfd-fade-out',
				'required' => array(
					array('gallery_hover_enable', '=', 'on'),
				),
				'hint' => array(
					'title'   => esc_attr__('Mask appear effect','dfd-native'),
					'content' => esc_attr__('This option allows you to choose the mask appear effect for the gallery items','dfd-native')
				)
			),
			array(
				'id' => 'gallery_hover_image_effect',
				'type' => 'select',
				'title' => esc_html__('Image effect', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'panr' => esc_html__('Image parallax', 'dfd-native'),
					'dfd-image-scale' => esc_html__('Grow', 'dfd-native'),
					'dfd-image-scale-rotate' => esc_html__('Grow with rotation', 'dfd-native'),
					'dfd-image-shift-left' => esc_html__('Shift left', 'dfd-native'),
					'dfd-image-shift-right' => esc_html__('Shift right', 'dfd-native'),
					'dfd-image-shift-top' => esc_html__('Shift top', 'dfd-native'),
					'dfd-image-shift-bottom' => esc_html__('Shift bottom', 'dfd-native'),
					'dfd-image-blur' => esc_html__('Blur', 'dfd-native'),
				),
				'default' => '',
				'required' => array(
					array('gallery_hover_appear_effect', '!=', 'dfd-left-to-right-shift'),
					array('gallery_hover_appear_effect', '!=', 'dfd-right-to-left-shift'),
					array('gallery_hover_appear_effect', '!=', 'dfd-top-to-bottom-shift'),
					array('gallery_hover_appear_effect', '!=', 'dfd-bottom-to-top-shift'),
					array('gallery_hover_appear_effect', '!=', 'dfd-rotate-left'),
					array('gallery_hover_appear_effect', '!=', 'dfd-rotate-right'),
					array('gallery_hover_appear_effect', '!=', 'dfd-rotate-top'),
					array('gallery_hover_appear_effect', '!=', 'dfd-rotate-bottom'),
					array('gallery_hover_appear_effect', '!=', 'dfd-rotate-content-up'),
					array('gallery_hover_appear_effect', '!=', 'dfd-rotate-content-down'),
					array('gallery_hover_appear_effect', '!=', 'dfd-3d-parallax'),
				),
				'hint' => array(
					'title'   => esc_attr__('Image parallax','dfd-native'),
					'content' => esc_attr__('This option allows you to choose the image effect for the gallery items','dfd-native')
				)
			),
			array(
				'id' => 'info_gallery_hover_colors',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Hover color scheme settings', 'dfd-native').'</h3>',
				'required' => array(
					array('gallery_hover_enable', '=', 'on'),
				),
			),
			array(
				'id' => 'gallery_hover_text_color',
				'type' => 'color',
				'title' => esc_html__('Text color', 'dfd-native'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
				'required' => array(
					array('gallery_hover_enable', '=', 'on'),
				),
				'hint' => array(
					'title'   => esc_attr__('Text color','dfd-native'),
					'content' => esc_attr__('Choose the text color for the gallery hover','dfd-native')
				)
			),
			array(
				'id' => 'gallery_hover_mask_style',
				'type' => 'radio',
				'title' => esc_html__('Hover mask background style', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'simple' => esc_html__('Simple color','dfd-native'),
					'gradient' => esc_html__('Gradient','dfd-native'),
				),
				'required' => array(
					array('gallery_hover_enable', '=', 'on'),
				),
				'default' => 'simple',
				'hint' => array(
					'title'   => esc_attr__('Background style','dfd-native'),
					'content' => esc_attr__('Choose the background style for the hover mask. You can set simple color or gradient','dfd-native')
				)
			),
			array(
				'id' => 'gallery_hover_bg',
				'type' => 'color',
				'title' => esc_html__('Mask background color', 'dfd-native'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
				'required' => array(
					'gallery_hover_mask_style', "=", 'simple'
				),
				'hint' => array(
					'title'   => esc_attr__('Background color','dfd-native'),
					'content' => esc_attr__('Choose the background color for the hover mask','dfd-native')
				)
			),
			array(
				'id' => 'gallery_hover_bg_gradient',
				'type' => 'color_gradient',
				'title' => esc_html__('Background gradient', 'dfd-native'),
				'default'  => array(
					'from' => '',
					'to'   => '', 
				),
				'validate' => 'color',
				'required' => array(
					'gallery_hover_mask_style', "=", 'gradient'
				),
				'hint' => array(
					'title'   => esc_attr__('Background gradient','dfd-native'),
					'content' => esc_attr__('Choose the start and end color for the hover mask gradient color','dfd-native')
				)
			),
			array(
				'id' => 'gallery_hover_bg_opacity',
				'type' => 'slider',
				'title' => esc_html__('Background opacity', 'dfd-native'),
				'desc' => '',
				'min' => '1',
				'max' => '100',
				'step' => '1',
				'default' => '70',
				'required' => array(
					array('gallery_hover_enable', '=', 'on'),
				),
				'hint' => array(
					'title'   => esc_attr__('Background opacity','dfd-native'),
					'content' => esc_attr__('Set the opacity value for the hover mask background','dfd-native')
				)
			),
			array(
				'id' => 'gallery_hover_buttons_bg',
				'type' => 'color',
				'title' => esc_html__('Buttons background', 'dfd-native'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
				'required' => array(
					array('gallery_hover_enable', '=', 'on'),
				),
				'hint' => array(
					'title'   => esc_attr__('Buttons background','dfd-native'),
					'content' => esc_attr__('This option defines the background color for buttons if Buttons option is selected as main hover decoration. You can overwrite this setting from inside shortcodes but this value will be applied for gallery page','dfd-native')
				)
			),
			array(
				'id' => 'info_gallery_hover_frame',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Hover mask settings', 'dfd-native').'</h3>',
				'required' => array(
					array('gallery_hover_enable', '=', 'on'),
				),
			),
			array(
				'id' => 'gallery_hover_mask_border',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Frame decoration', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'off',
				'required' => array(
					array('gallery_hover_enable', '=', 'on'),
				),
				
				'hint' => array(
					'title'   => esc_attr__('Frame decoration','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable the frame decoration for the thumbnail','dfd-native')
				)
			),
			array(
				'id' => 'gallery_hover_mask_bordered_style',
				'type' => 'radio',
				'title' => esc_html__('Frame style', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'simple-border' => esc_html__('Simple border','dfd-native'),
					'offset' => esc_html__('Offset','dfd-native'),
				),
				'required' => array(
					array('gallery_hover_mask_border', '=', 'on'),
				),
				'default' => 'offset',
				'hint' => array(
					'title'   => esc_attr__('Frame style','dfd-native'),
					'content' => esc_attr__('This option allows you to choose the style for the frame decoration on hover','dfd-native')
				)
			),
			array(
				'id' => 'gallery_hover_mask_bordered_size',
				'type' => 'slider',
				'title' => esc_html__('Frame size', 'dfd-native'),
				'desc' => '',
				'min' => '1',
				'max' => '20',
				'step' => '1',
				'default' => '10',
				'required' => array(
					array('gallery_hover_mask_border', '=', 'on'),
				),
				'hint' => array(
					'title'   => esc_attr__('Frame size','dfd-native'),
					'content' => esc_attr__('This option allows you to choose the border size for the frame decoration on hover','dfd-native')
				)
			),
			array(
				'id' => 'gallery_hover_mask_bordered_bg',
				'type' => 'color',
				'title' => esc_html__('Frame border color', 'dfd-native'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
				'required' => array(
					array('gallery_hover_mask_bordered_style', '=', 'simple-border'),
				),
				'hint' => array(
					'title'   => esc_attr__('Frame border color','dfd-native'),
					'content' => esc_attr__('Choose the color for the frame decoration on hover','dfd-native')
				)
			),
			array(
				'id' => 'info_gallery_hover_main_deco',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Hover decoration settings', 'dfd-native').'</h3>',
				'required' => array(
					array('gallery_hover_enable', '=', 'on'),
				),
			),
			array(
				'id' => 'gallery_hover_main_decoration',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => esc_html__('Main hover decoration', 'dfd-native'),
				'options' => array(
					'none' => array(
						'title' => esc_html__('None','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/hover-decoration.png'
					),
					'heading' => array(
						'title' => esc_html__('Heading','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/hover-decoration.png'
					),
					'plus' => array(
						'title' => esc_html__('Plus','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/hover-decoration.png'
					),
					'dots' => array(
						'title' => esc_html__('Dots','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/hover-decoration.png'
					),
					'buttons' => array(
						'title' => esc_html__('Buttons','dfd-native'),
						'img' => get_template_directory_uri().'/assets/admin/img/hover-decoration.png'
					),
				),
				'default' => 'dots',
				'required' => array(
					array('gallery_hover_enable', '=', 'on'),
				),
				'hint' => array(
					'title'   => esc_attr__('Main decoration','dfd-native'),
					'content' => esc_attr__('Choose the main decoration for the gallery hover','dfd-native')
				)
			),
			array(
				'id' => 'gallery_hover_show_title',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Title', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'required' => array(
					array('gallery_hover_main_decoration', '=', 'heading'),
				),
				'hint' => array(
					'title'   => esc_attr__('Title','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the gallery title on hover','dfd-native')
				)
			),
			array(
				'id' => 'gallery_hover_show_subtitle',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Subtitle', 'dfd-native'),
				'sub_desc' => '',
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',
				'required' => array(
					array('gallery_hover_main_decoration', '=', 'heading'),
				),
				'hint' => array(
					'title'   => esc_attr__('Subtitle','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the gallery subtitle on hover','dfd-native')
				)
			),
			array(
				'id' => 'gallery_hover_plus_position',
				'type' => 'select',
				'title' => esc_html__('Plus decoration', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'dfd-middle' => esc_html__('Big plus in the middle of the thumb', 'dfd-native'),
					'dfd-middle dfd-plus-bordered' => esc_html__('Small plus in the middle of the thumb', 'dfd-native'),
					'dfd-cursor-plus' => esc_html__('Following the mouse', 'dfd-native'),
				),
				'default' => 'custom',
				'required' => array(
					array('gallery_hover_main_decoration', '=', 'plus'),
				),
				'hint' => array(
					'title'   => esc_attr__('Plus decoration','dfd-native'),
					'content' => esc_attr__('Choose one of the plus decoration styles','dfd-native')
				)
			),
		),
	));
	if(class_exists('WooCommerce')) {
		Redux::setSection( $opt_name, array(
			'title' => esc_html__('Woocommerce', 'dfd-native'),
			'icon' => 'dashicons dashicons-cart',
		));
		Redux::setSection( $opt_name, array(
			'title' => esc_html__('Woocommerce base options', 'dfd-native'),
			'icon' => 'dashicons dashicons-cart',
			'subsection' => true,
			'fields' => array(
				array(
					'id' => 'info_woo_general_settings',
					'type' => 'info',
					'desc' => '<h3 class="description">'.esc_html__('Base setting', 'dfd-native').'</h3>'
				),
				array(
					'id' => 'shop_title',
					'type' => 'text',
					'title' => esc_html__('Shop Title', 'dfd-native'),
					'default' => esc_html__('Best offers','dfd-native'),
					'hint' => array(
						'title'   => esc_attr__('Shop title','dfd-native'),
						'content' => esc_attr__('This option allows you to add the title for your shop page','dfd-native')
					)
				),
				array(
					'id' => 'woo_top_link_src',
					'type' => 'radio',
					'title' => esc_html__('Shop top link source', 'dfd-native'),
					'desc' => '',
					'options' => array(
						'page' => esc_html__('Page', 'dfd-native'),
						'url' => esc_html__('Custom url', 'dfd-native'),
					),
					'default' => 'chaffle',
					'hint' => array(
						'title'   => esc_attr__('Link source','dfd-native'),
						'content' => esc_attr__('This option allows you to set the page or custom link which will be used for the button placed next to the categories and tags dropdown on shop page','dfd-native')
					)
				),
				array(
					'id' => 'woo_top_page_select',
					'type'     => 'select',
					'data'     => 'pages',
					'title' => esc_html__('Shop page', 'dfd-native'),
					'required' => array(
						array('woo_top_link_src', '=', 'page'),
					),
					'hint' => array(
						'title'   => esc_attr__('Shop page','dfd-native'),
						'content' => esc_attr__('Select the page which will be used as main shop page','dfd-native')
					)
				),
				array(
					'id' => 'woo_top_page_url',
					'type' => 'text',
					'title' => esc_html__('Shop page URL', 'dfd-native'),
					'validate' => 'url',
					'required' => array(
						array('woo_top_link_src', '=', 'url'),
					),
					'default' => '',
					'hint' => array(
						'title'   => esc_attr__('Shop page','dfd-native'),
						'content' => esc_attr__('Select the page which will be used as main shop page','dfd-native')
					)
				),
				array(
					'id' => 'woocommerce_catalogue_mode',
					'type' => 'button_set', //the field type
					'title' => esc_html__('Catalogue mode', 'dfd-native'),
					'options' => array('1' => esc_html__('On', 'dfd-native'), '0' => esc_html__('Off', 'dfd-native')),
					'default' => '0',
					'hint' => array(
						'title'   => esc_attr__('Catalogue mode','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the cataog mode. The products will be displayed without prices in this mode','dfd-native')
					)
				),
				array(
					'id' => 'woo_star_rating_color',
					'type' => 'color',
					'title' => esc_html__('Star rating color', 'dfd-native'),
					'desc' => '',
					'default' => '',
					'validate' => 'color',
					'hint' => array(
						'title'   => esc_attr__('Star color','dfd-native'),
						'content' => esc_attr__('Choose the color for the stars shown in the product rating','dfd-native')
					)
				),
				array(
					'id' => 'woo_products_hover_mask_style',
					'type' => 'radio',
					'title' => esc_html__('Hover mask background style', 'dfd-native'),
					'desc' => '',
					'options' => array(
						'simple' => esc_html__('Simple color','dfd-native'),
						'gradient' => esc_html__('Gradient','dfd-native'),
					),
					'required' => array(
						'woo_products_loop_style', "=", 'style-3'
					),
					'default' => '',
					'hint' => array(
						'title'   => esc_attr__('Background style','dfd-native'),
						'content' => esc_attr__('Choose the background style for the hover mask. You can set simple color or gradient','dfd-native')
					)
				),
				array(
					'id' => 'woo_products_hover_bg',
					'type' => 'color',
					'title' => esc_html__('Mask background color', 'dfd-native'),
					'desc' => '',
					'default' => '',
					'validate' => 'color',
					'required' => array(
						'woo_products_hover_mask_style', "=", 'simple'
					),
					'hint' => array(
						'title'   => esc_attr__('Background color','dfd-native'),
						'content' => esc_attr__('Choose the background color for the hover mask','dfd-native')
					)
				),
				array(
					'id' => 'woo_products_hover_bg_gradient',
					'type' => 'color_gradient',
					'title' => esc_html__('Background gradient', 'dfd-native'),
					'default'  => array(
						'from' => '',
						'to'   => '', 
					),
					'validate' => 'color',
					'required' => array(
						'woo_products_hover_mask_style', "=", 'gradient'
					),
					'hint' => array(
						'title'   => esc_attr__('Background gradient','dfd-native'),
						'content' => esc_attr__('Choose the start and end color for the hover mask gradient color','dfd-native')
					)
				),
				array(
					'id' => 'woo_products_hover_bg_opacity',
					'type' => 'slider',
					'title' => esc_html__('Background opacity', 'dfd-native'),
					'desc' => '',
					'min' => '1',
					'max' => '100',
					'step' => '1',
					'default' => '70',
					'required' => array(
						'woo_products_loop_style', "=", 'style-3'
					),
					'hint' => array(
						'title'   => esc_attr__('Background opacity','dfd-native'),
						'content' => esc_attr__('Set the opacity value for the hover mask background','dfd-native')
					)
				),
				array(
					'id' => 'info_woo_general_settings',
					'type' => 'info',
					'desc' => '<h3 class="description">'.esc_html__('Sale badge setting', 'dfd-native').'</h3>'
				),
				array(
					'id' => 'woo_products_sale_badge_position',
					'type' => 'radio',
					'title' => esc_html__('Sale badge position', 'dfd-native'),
					'desc' => '',
					'options' => array(
						'left' => esc_html__('Left','dfd-native'),
						'right' => esc_html__('Right','dfd-native'),
					),
					'default' => 'left',
					'hint' => array(
						'title'   => esc_attr__('Sale badge position','dfd-native'),
						'content' => esc_attr__('Choose the sales badge position','dfd-native')
					)
				),
				array(
					'id' => 'woo_products_sale_badge_bg',
					'type' => 'color',
					'title' => esc_html__('Sale badge background color', 'dfd-native'),
					'desc' => '',
					'default' => '',
					'validate' => 'color',
					'hint' => array(
						'title'   => esc_attr__('Sale badge background color','dfd-native'),
						'content' => esc_attr__('Choose the background color for the sale badge','dfd-native')
					)
				),
				array(
					'id' => 'woo_products_sale_badge_border_radius',
					'type' => 'slider',
					'title' => esc_html__('Sale badge border radius', 'dfd-native'),
					'desc' => '',
					'min' => '0',
					'max' => '30',
					'step' => '1',
					'default' => '4',
					'hint' => array(
						'title'   => esc_attr__('Sale badge border radius','dfd-native'),
						'content' => esc_attr__('This option allows you to define the border radius of the sales badge','dfd-native')
					)
				),
			),
		));
		Redux::setSection( $opt_name, array(
			'title' => esc_html__('Woocommerce category options', 'dfd-native'),
			'icon' => 'dashicons dashicons-cart',
			'subsection' => true,
			'fields' => array(
				array(
					'id' => 'info_woo_achive_layout',
					'type' => 'info',
					'desc' => '<h3 class="description">'.esc_html__('Layout setting', 'dfd-native').'</h3>'
				),
				array(
					'id' => 'shop_stun_header',
					'type' => 'button_set', //the field type
					'title' => esc_html__('Custom header', 'dfd-native'),
					'sub_desc' => '',
					'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
					'default' => 'on',//this should be the key as defined above
					'hint' => array(
						'title'   => esc_attr__('Custom header','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the custom header for the shop category pages by default','dfd-native')
					)
				),
				array(
					'id' => 'shop_layout_width',
					'type' => 'image_select',
					'tiles' => true,
					'dfd_tiles' => true,
					'title' => esc_html__('Layout width', 'dfd-native'),
					'desc' => '',
					'options' => Dfd_Theme_Helpers::dfd_layout_width(),
					'hint' => array(
						'title'   => esc_attr__('Layout width','dfd-native'),
						'content' => esc_attr__('This option defines the shop content width','dfd-native')
					 )
				),
				array(
					'id' => 'shop_sidebars_configuration',
					'type' => 'image_select',
					'tiles' => true,
					'dfd_tiles' => true,
					'title' => esc_html__('Category layout', 'dfd-native'),
					'sub_desc' => esc_html__('Select one of the layout types for single pages', 'dfd-native'),
					'options' => Dfd_Theme_Helpers::dfd_page_layouts(),
					'default' => '',
					'hint' => array(
						'title'   => esc_attr__('Category layout','dfd-native'),
						'content' => esc_attr__('Select one of the layout types which will be set as default for shop category pages','dfd-native')
					)
				),
				array(
					'id' => 'info_woo_achive_page',
					'type' => 'info',
					'desc' => '<h3 class="description">'.esc_html__('Page settings', 'dfd-native').'</h3>'
				),
				array(
					'id' => 'woo_category_cat_tag',
					'type' => 'button_set', //the field type
					'title' => esc_html__('Categories, tags dropdown', 'dfd-native'),
					'sub_desc' => '',
					'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
					'default' => 'on',//this should be the key as defined above
					'hint' => array(
						'title'   => esc_attr__('Categories and tags dropdown','dfd-native'),
						'content' => esc_attr__('This option allows you to show or hide categories, tags and author drop-down sorter before product items','dfd-native')
				)
				),
				array(
					'id' => 'shop_category_columns',
					'type' => 'radio',
					'title' => esc_html__('Number of columns', 'dfd-native'),
					'desc' => '',
					'options' => array(
						1 => esc_html__('One', 'dfd-native'),
						2 => esc_html__('Two', 'dfd-native'),
						3 => esc_html__('Three', 'dfd-native'),
						4 => esc_html__('Four', 'dfd-native'),
					),
					'default' => 3,
					'hint' => array(
						'title'   => esc_attr__('Number of columns','dfd-native'),
						'content' => esc_attr__('Choose the number of columns for the category page','dfd-native')
					)
				),
				array(
					'id'       => 'woo_category_products_number',
					'type'     => 'text',
					'title'    => esc_html__( 'Number of products per page to display', 'dfd-native' ),
					'desc'     => '',
					'validate' => 'numeric',
					'default'  => '9',
					'hint' => array(
						'title'   => esc_attr__('Number of products','dfd-native'),
						'content' => esc_attr__('Choose the number of products for the category page','dfd-native')
					)
				),
				array(
					'id' => 'info_woo_achive_content',
					'type' => 'info',
					'desc' => '<h3 class="description">'.esc_html__('Content elements', 'dfd-native').'</h3>'
				),
				array(
					'id' => 'woo_products_loop_style',
					'type' => 'radio',
					'title' => esc_html__('Product style', 'dfd-native'),
					'desc' => '',
					'options' => array(
						'style-1' => esc_html__('Style 1','dfd-native'),
						'style-2' => esc_html__('Style 2','dfd-native'),
						'style-3' => esc_html__('Style 3','dfd-native'),
					),
					'default' => 'style-1',
					'hint' => array(
						'title'   => esc_attr__('Product style','dfd-native'),
						'content' => esc_attr__('Choose one of the three preset product styles','dfd-native')
					)
				),
				array(
					'id' => 'woo_products_loop_title',
					'type' => 'button_set', //the field type
					'title' => esc_html__('Title', 'dfd-native'),
					'sub_desc' => '',
					'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
					'default' => 'on',//this should be the key as defined above
					'hint' => array(
						'title'   => esc_attr__('Title','dfd-native'),
						'content' => esc_attr__('This option allows you to show or hide the product title','dfd-native')
					)
				),
				array(
					'id' => 'woo_products_loop_subtitle',
					'type' => 'button_set', //the field type
					'title' => esc_html__('Subtitle', 'dfd-native'),
					'sub_desc' => '',
					'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
					'default' => 'on',//this should be the key as defined above
					'hint' => array(
						'title'   => esc_attr__('Subtitle','dfd-native'),
						'content' => esc_attr__('This option allows you to show or hide the product subtitle','dfd-native')
					)
				),
				array(
					'id' => 'woo_products_loop_price',
					'type' => 'button_set', //the field type
					'title' => esc_html__('Price', 'dfd-native'),
					'sub_desc' => '',
					'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
					'default' => 'on',//this should be the key as defined above
					'hint' => array(
						'title'   => esc_attr__('Price','dfd-native'),
						'content' => esc_attr__('This option allows you to show or hide the product price on category pages','dfd-native')
					)
				),
				array(
					'id' => 'woo_products_loop_rating',
					'type' => 'button_set', //the field type
					'title' => esc_html__('Rating', 'dfd-native'),
					'sub_desc' => '',
					'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
					'default' => 'on',//this should be the key as defined above
					'hint' => array(
						'title'   => esc_attr__('Rating','dfd-native'),
						'content' => esc_attr__('This option allows you to show or hide the product star rating on category page','dfd-native')
					)
				),
				array(
					'id' => 'woo_category_content_alignment',
					'type' => 'radio', //the field type
					'title' => esc_html__('Content alignment', 'dfd-native'),
					'sub_desc' => '',
					'options' => array(
						'text-center' => esc_html__('Center', 'dfd-native'),
						'text-left' => esc_html__('Left', 'dfd-native'),
						'text-right' => esc_html__('Right', 'dfd-native'),
					),
					'default' => 'text-center',
					'hint' => array(
						'title'   => esc_attr__('Content alignment','dfd-native'),
						'content' => esc_attr__('This option allows you to align the product content horizontally','dfd-native')
					)
				),
				array(
					'id' => 'woo_category_item_appear_effect',
					'type' => 'select',
					'title' => esc_html__('Items appear effect', 'dfd-native'),
					'desc' => '',
					'options' => Dfd_Theme_Helpers::dfd_module_animation_styles('options'),
					'default' => '',
					'hint' => array(
						'title'   => esc_attr__('Appear effect','dfd-native'),
						'content' => esc_attr__('Choose the appear effect for the products','dfd-native')
					)
				),
			),
		));
		Redux::setSection( $opt_name, array(
			'title' => esc_html__('Woocommerce single options', 'dfd-native'),
			'icon' => 'dashicons dashicons-cart',
			'subsection' => true,
			'fields' => array(
				array(
					'id' => 'product_single_stun_header',
					'type' => 'button_set', //the field type
					'title' => esc_html__('Custom header', 'dfd-native'),
					'sub_desc' => '',
					'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
					'default' => 'on',//this should be the key as defined above
					'hint' => array(
						'title'   => esc_attr__('Custom header','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the custom header for the single product pages by default. There is also an option on the single post page if you need to change custom header settings on single product','dfd-native')
					)
				),
				array(
					'id' => 'product_single_layout_width',
					'type' => 'image_select',
					'tiles' => true,
					'dfd_tiles' => true,
					'title' => esc_html__('Layout width', 'dfd-native'),
					'desc' => '',
					'options' => Dfd_Theme_Helpers::dfd_layout_width(),
					'hint' => array(
						'title'   => esc_attr__('Layout width','dfd-native'),
						'content' => esc_attr__('This option defines the single product content width','dfd-native')
					 )
				),
				array(
					'id' => 'product_single_sidebars_configuration',
					'type' => 'image_select',
					'tiles' => true,
					'dfd_tiles' => true,
					'title' => esc_html__('Single layout', 'dfd-native'),
					'sub_desc' => esc_html__('Select one of the layout types for single pages', 'dfd-native'),
					'options' => Dfd_Theme_Helpers::dfd_page_layouts(),
					'default' => '',
					'hint' => array(
						'title'   => esc_attr__('Single layout','dfd-native'),
						'content' => esc_attr__('Select one of the layout types which will be set as default for single product pages','dfd-native')
					)
				),
				array(
					'id' => 'woocommerce_hide_single_thumb',
					'type' => 'button_set', //the field type
					'title' => esc_html__('Hide thumbnails', 'dfd-native'),
					'desc' => '',
					'options' => array('1' => esc_html__('On', 'dfd-native'), '0' => esc_html__('Off', 'dfd-native')),
					'default' => '0',
					'hint' => array(
						'title'   => esc_attr__('Hide thumbnails','dfd-native'),
						'content' => esc_attr__('This option allows you to hide the product gallery thumbnails on single product page','dfd-native')
					)
				),
				array(
					'id' => 'product_single_columns_config',
					'type' => 'select',
					'title' => esc_html__('Image and description width configuration', 'dfd-native'),
					'desc' => '',
					'options' => array(
						'default'	=> esc_html__('Theme default', 'dfd-native'),
						3			=> esc_html__('1/4 to 3/4', 'dfd-native'),
						4			=> esc_html__('1/3 to 2/3', 'dfd-native'),
						5			=> esc_html__('5/12 to 7/12', 'dfd-native'),
						6			=> esc_html__('1/2 to 1/2', 'dfd-native'),
						7			=> esc_html__('7/12 to 5/12', 'dfd-native'),
						8			=> esc_html__('2/3 to 1/3', 'dfd-native'),
						9			=> esc_html__('3/4 to 1/4', 'dfd-native'),
					),
					'default' => 'default',
					'hint' => array(
						'title'   => esc_attr__('Width configuration','dfd-native'),
						'content' => esc_attr__('This option allows you to choose the width configuration for the image and description on single product pages','dfd-native')
					)
				),
				array(
					'id' => 'woo_single_thumb_position',
					'type' => 'radio',
					'title' => esc_html__('Thumbnails position', 'dfd-native'),
					'desc' => '',
					'options' => array(
						'' => esc_html__('Bottom', 'dfd-native'),
						'thumbs-left' => esc_html__('Left', 'dfd-native'),
					),
					'default' => '',
					'required' => array(
						array('woocommerce_hide_single_thumb', '=', '0'),
					),
					'hint' => array(
						'title'   => esc_attr__('Thumbnails position','dfd-native'),
						'content' => esc_attr__('This option allows you to choose the product gallery thumbnails position','dfd-native')
					)
				),
				array(
					'id' => 'woo_single_thumb_number',
					'type' => 'radio',
					'title' => esc_html__('Number of thumbnails to show', 'dfd-native'),
					'desc' => '',
					'options' => array(
						1 => esc_html__('One', 'dfd-native'),
						2 => esc_html__('Two', 'dfd-native'),
						3 => esc_html__('Three', 'dfd-native'),
						4 => esc_html__('Four', 'dfd-native'),
						5 => esc_html__('Five', 'dfd-native'),
						6 => esc_html__('Six', 'dfd-native'),
						7 => esc_html__('Seven', 'dfd-native'),
						8 => esc_html__('Eight', 'dfd-native'),
					),
					'default' => 5,
					'required' => array(
						array('woocommerce_hide_single_thumb', '=', '0'),
					),
					'hint' => array(
						'title'   => esc_attr__('Number of thumbnails to show','dfd-native'),
						'content' => esc_attr__('Set the number of product gallery thumbnails which should be visible on product page','dfd-native')
					)
				),
				array(
					'id' => 'woo_single_enable_pagination',
					'type' => 'button_set', //the field type
					'title' => esc_html__('Inside pagination', 'dfd-native'),
					'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
					'sub_desc' => '',
					'default' => 'on',
					'hint' => array(
						'title'   => esc_attr__('Inside pagination','dfd-native'),
						'content' => esc_attr__('This option allows you to show or hide the inside pagination on single product page','dfd-native')
					)
				),
				array(
					'id' => 'woo_single_pagination_style',
					'type' => 'radio',
					'title' => esc_html__('Pagination position', 'dfd-native'),
					'desc' => '',
					'options' => array(
						'off' => esc_html__('Disable', 'dfd-native'),
						'fixed' => esc_html__('Fixed', 'dfd-native'),
						'top' => esc_html__('Top', 'dfd-native'),
					),
					'default' => '',
					'required' => array(
						array('woo_single_enable_pagination', '=', 'on'),
					),
					'hint' => array(
						'title'   => esc_attr__('Pagination position','dfd-native'),
						'content' => esc_attr__('This option allows you to choose the position of the inside pagination on single product page','dfd-native')
					)
				),
				array(
					'id' => 'woo_single_show_product_breadcrumbs',
					'type' => 'button_set', //the field type
					'title' => esc_html__('Product breadcrumbs', 'dfd-native'),
					'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
					'sub_desc' => '',
					'default' => 'on',
					'hint' => array(
						'title'   => esc_attr__('Product breadcrumbs','dfd-native'),
						'content' => esc_attr__('This option allows you to show or hide the breadcrumbs over the product title','dfd-native')
					)
				),
				array(
					'id' => 'woo_single_show_related_products',
					'type' => 'button_set', //the field type
					'title' => esc_html__('Related products', 'dfd-native'),
					'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
					'sub_desc' => '',
					'default' => 'on',
					'hint' => array(
						'title'   => esc_attr__('Related products','dfd-native'),
						'content' => esc_attr__('This option allows you to show or hide the related products on single product page','dfd-native')
					)
				),
			),
		));
	}
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Styling options', 'dfd-native'),
		'icon' => 'dashicons dashicons-admin-customizer',
//		'subsection' => true,
		'fields' => array(
			array(
				'id' => 'info_styling_main',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Main site colors setup', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'main_site_color',
				'type' => 'color',
				'title' => esc_html__('Main site color', 'dfd-native'),
				'desc' => '',
				'default' => '#3498db',
				'validate' => 'color',
				'hint' => array(
						'title'   => esc_attr__('Main site color','dfd-native'),
						'content' => esc_attr__('This option allows you to choose the main site color. This color is used as default color for the Visual Composer elements','dfd-native')
					)
			),
			array(
				'id' => 'secondary_site_color',
				'type' => 'color',
				'title' => esc_html__('Second site color', 'dfd-native'),
				'desc' => '',
				'default' => '#e9e9e9',
				'validate' => 'color',
				'hint' => array(
						'title'   => esc_attr__('Second site color','dfd-native'),
						'content' => esc_attr__('This option allows you to choose the second site color. This color is used as default border and delimiter color and background color for the popover, the feature for the text editor on single post, single portfolio and in text module','dfd-native')
					)
			),
			array(
				'id' => 'third_site_color',
				'type' => 'color',
				'title' => esc_html__('Third site color', 'dfd-native'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
				'hint' => array(
						'title'   => esc_attr__('Third color','dfd-native'),
						'content' => esc_attr__('This option allows you to choose the third site color. The color is used as button background in header login form ','dfd-native')
					)
			),
			array(
				'id' => 'info_body_style',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Body styling options', 'dfd-native').'</h3>',
			),
			array(
				'id' => 'site_boxed',
				'type' => 'button_set',
				'title' => esc_html__('Boxed body layout', 'dfd-native'),
				'options' => array('1' => esc_html__('On','dfd-native'), '0' => esc_html__('Off','dfd-native')),
				'default' => '0',
				'hint' => array(
						'title'   => esc_attr__('Boxed body','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the boxed site layout, its width will be set to 1280px','dfd-native')
					)
			),
			//Body wrapper
			array(
				'id' => 'body_bg_color',
				'type' => 'color',
				'validate' => 'color',
				'title' => esc_html__('Body background color', 'dfd-native'),
				'default' => '',
				'hint' => array(
						'title'   => esc_attr__('Background color','dfd-native'),
						'content' => esc_attr__('This option allows you to set the default color for the body','dfd-native')
					)
			),
			array(
				'id' => 'body_bg_image',
				'type' => 'media',
				'title' => esc_html__('Body background image', 'dfd-native'),
				'desc' => esc_html__('Upload background image or pattern from the media library', 'dfd-native'),
				'default' => array(
					'url' => ''
				),
				'hint' => array(
                    'title'   => esc_attr__('Background image','dfd-native'),
                    'content' => esc_attr__('This option allows you to set the default background image for the body','dfd-native')
                )
			),
			array(
				'id' => 'body_custom_repeat',
				'type' => 'radio',
				'title' => esc_html__('Body background image repeat', 'dfd-native'),
				'options' => array(
					'no-repeat' => esc_html__('No-Repeat','dfd-native'),
					'repeat-x' => esc_html__('Repeat X','dfd-native'),
					'repeat-y' => esc_html__('Repeat Y','dfd-native'),
					'repeat' => esc_html__('Repeat','dfd-native'),
				),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Background repeat','dfd-native'),
					'content' => esc_attr__('This option allows you to choose the repeat for the background image','dfd-native')
				)
			),
			array(
				'id' => 'body_bg_fixed',
				'type' => 'button_set',
				'title' => esc_html__('Fixed body background', 'dfd-native'),
				'options' => array('1' => esc_html__('On', 'dfd-native'), '0' => esc_html__('Off', 'dfd-native')),
				'default' => '0',// 1 = on | 0 = off
				'hint' => array(
					'title'   => esc_attr__('Fixed background','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable the fixed background. When enabled fixed background, the background image is fixed and content scrolls separately over it.','dfd-native')
				)
			),
			array(
				'id' => 'info_content_style',
				'type' => 'info',
				'desc' => '<h3 class="description">'.esc_html__('Content styling options', 'dfd-native').'</h3>',
			),
			array(
				'id' => 'wrapper_bg_color',
				'type' => 'color',
				'validate' => 'color',
				'title' => esc_html__('Content background color', 'dfd-native'),
				'default' => '',
				'hint' => array(
						'title'   => esc_attr__('Background color','dfd-native'),
						'content' => esc_attr__('This option allows you to set the default color for the content','dfd-native')
					)
			),
			array(
				'id' => 'wrapper_bg_image',
				'type' => 'media',
				'title' => esc_html__('Content background image', 'dfd-native'),
				'desc' => esc_html__('Upload background image or pattern from the media library', 'dfd-native'),
				'default' => array(
					'url' => ''
				),
				'hint' => array(
                    'title'   => esc_attr__('Background image','dfd-native'),
                    'content' => esc_attr__('This option allows you to set the default background image for the content','dfd-native')
                )
			),
			array(
				'id' => 'wrapper_custom_repeat',
				'type' => 'radio',
				'title' => esc_html__('Content image repeat', 'dfd-native'),
				'options' => array(
					'no-repeat' => esc_html__('No-Repeat','dfd-native'),
					'repeat-x' => esc_html__('Repeat X','dfd-native'),
					'repeat-y' => esc_html__('Repeat Y','dfd-native'),
					'repeat' => esc_html__('Repeat','dfd-native'),
				),
				'default' => 'repeat',
				'hint' => array(
					'title'   => esc_attr__('Background repeat','dfd-native'),
					'content' => esc_attr__('This option allows you to choose the repeat for the background image','dfd-native')
				)
			),
			array(
				'id' => 'dfd_pagination_type',
				'type' => 'radio',
				'title' => esc_html__('Pagination type', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'default' => esc_html__('Pagination','dfd-native'),
					'1' => esc_html__('Load more button','dfd-native'),
					'2' => esc_html__('Lazy load on scroll','dfd-native'),
				),
				'default' => 'default',
				'hint' => array(
					'title'   => esc_attr__('Pagination type','dfd-native'),
					'content' => esc_attr__('The default pagination type for blog, portfolio, gallery, archive and search pages can be defined here. It will be applied for theme defined post types only but will not affect plugins functionality.','dfd-native')
				)
			),
			array(
				'id' => 'dfd_pagination_style',
				'type' => 'radio',
				'title' => esc_html__('Pagination style', 'dfd-native'),
				'desc' => '',
				'options' => array(
					'1' => esc_html__('Style 1','dfd-native'),
					'2' => esc_html__('Style 2','dfd-native'),
					'3' => esc_html__('Style 3','dfd-native'),
					'4' => esc_html__('Style 4','dfd-native'),
					'5' => esc_html__('Style 5','dfd-native'),
				),
				'default' => '',
				'required' => array( 'dfd_pagination_type', "=", 'default' ),
				'hint' => array(
					'title'   => esc_attr__('Pagination style','dfd-native'),
					'content' => esc_attr__('Choose one of the preset pagination styles. The pagination will be used for blog, portfolio, gallery and shop pages','dfd-native')
				)
			),
			array(
				'id' => 'default_screen_width',
				'type' => 'text',
				'title' => esc_html__('Default screen (in px)', 'dfd-native'),
				'default' => '',
				'validate' => 'numeric',
				'default' => 1920,
				'hint' => array(
					'title'   => esc_attr__('Default screen','dfd-native'),
					'content' => esc_attr__('Set the screen default width for proper image displaying. The images would be cropped according to the screen width you\'ve set','dfd-native')
				)
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Social accounts', 'dfd-native'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'dashicons dashicons-share',
		//Lets leave this as a blank section, no options just some intro text set above.
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Social networks', 'dfd-native'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'dashicons dashicons-share',
		//Lets leave this as a blank section, no options just some intro text set above.
		'subsection' => true,
		'fields' => array(
			array(
				'id' => 'de_link',
				'type' => 'text',
				'title' => esc_html__('Deviantart link', 'dfd-native'),
				'desc' => esc_html__('Paste link to your account if you\'d like to show this social network', 'dfd-native'),
				'default' => ''
			),
			array(
				'id' => 'dg_link',
				'type' => 'text',
				'title' => esc_html__('Digg link', 'dfd-native'),
				'desc' => esc_html__('Paste link to your account if you\'d like to show this social network', 'dfd-native'),
				'default' => ''
			),
			array(
				'id' => 'dr_link',
				'type' => 'text',
				'title' => esc_html__('Dribbble link', 'dfd-native'),
				'desc' => esc_html__('Paste link to your account if you\'d like to show this social network', 'dfd-native'),
				'default' => 'http://dribbble.com'
			),
			array(
				'id' => 'db_link',
				'type' => 'text',
				'title' => esc_html__('Dropbox link', 'dfd-native'),
				'desc' => esc_html__('Paste link to your account if you\'d like to show this social network', 'dfd-native'),
				'default' => ''
			),
			array(
				'id' => 'en_link',
				'type' => 'text',
				'title' => esc_html__('Evernote link', 'dfd-native'),
				'desc' => esc_html__('Paste link to your account if you\'d like to show this social network', 'dfd-native'),
				'default' => ''
			),
			array(
				'id' => 'fb_link',
				'type' => 'text',
				'title' => esc_html__('Facebook link', 'dfd-native'),
				'desc' => esc_html__('Paste link to your account if you\'d like to show this social network', 'dfd-native'),
				'default' => 'http://facebook.com'
			),
			array(
				'id' => 'flk_link',
				'type' => 'text',
				'title' => esc_html__('Flickr link', 'dfd-native'),
				'desc' => esc_html__('Paste link to your account if you\'d like to show this social network', 'dfd-native'),
				'default' => ''
			),
			array(
				'id' => 'gp_link',
				'type' => 'text',
				'title' => esc_html__('Google + link', 'dfd-native'),
				'desc' => esc_html__('Paste link to your account if you\'d like to show this social network', 'dfd-native'),
				'default' => ''
			),
			array(
				'id' => 'in_link',
				'type' => 'text',
				'title' => esc_html__('Instagram link', 'dfd-native'),
				'desc' => esc_html__('Paste link to your account if you\'d like to show this social network', 'dfd-native'),
				'default' => ''
			),
			array(
				'id' => 'lf_link',
				'type' => 'text',
				'title' => esc_html__('Last FM link', 'dfd-native'),
				'desc' => esc_html__('Paste link to your account if you\'d like to show this social network', 'dfd-native'),
				'default' => ''
			),
			array(
				'id' => 'li_link',
				'type' => 'text',
				'title' => esc_html__('LinkedIN link', 'dfd-native'),
				'desc' => esc_html__('Paste link to your account if you\'d like to show this social network', 'dfd-native'),
				'default' => ''
			),
			array(
				'id' => 'pi_link',
				'type' => 'text',
				'title' => esc_html__('Picasa link', 'dfd-native'),
				'desc' => esc_html__('Paste link to your account if you\'d like to show this social network', 'dfd-native'),
				'default' => ''
			),
			array(
				'id' => 'pt_link',
				'type' => 'text',
				'title' => esc_html__('Pinterest link', 'dfd-native'),
				'desc' => esc_html__('Paste link to your account if you\'d like to show this social network', 'dfd-native'),
				'default' => ''
			),
			array(
				'id' => 'rss_link',
				'type' => 'text',
				'title' => esc_html__('RSS', 'dfd-native'),
				'desc' => esc_html__('Paste alternative link to Rss', 'dfd-native'),
				'default' => ''
			),
			array(
				'id' => 'tu_link',
				'type' => 'text',
				'title' => esc_html__('Tumblr link', 'dfd-native'),
				'desc' => esc_html__('Paste link to your account if you\'d like to show this social network', 'dfd-native'),
				'default' => ''
			),
			array(
				'id' => 'tw_link',
				'type' => 'text',
				'title' => esc_html__('Twitter link', 'dfd-native'),
				'desc' => esc_html__('Paste link to your account if you\'d like to show this social network', 'dfd-native'),
				'default' => 'http://twitter.com'
			),
			array(
				'id' => 'vi_link',
				'type' => 'text',
				'title' => esc_html__('Vimeo link', 'dfd-native'),
				'desc' => esc_html__('Paste link to your account if you\'d like to show this social network', 'dfd-native'),
				'default' => 'https://vimeo.com/'
			),
			array(
				'id' => 'wp_link',
				'type' => 'text',
				'title' => esc_html__('WordPress link', 'dfd-native'),
				'desc' => esc_html__('Paste link to your account if you\'d like to show this social network', 'dfd-native'),
				'default' => ''
			),
			array(
				'id' => 'yt_link',
				'type' => 'text',
				'title' => esc_html__('YouTube link', 'dfd-native'),
				'desc' => esc_html__('Paste link to your account if you\'d like to show this social network', 'dfd-native'),
				'default' => ''
			),
			array(
				'id' => '500px_link',
				'type' => 'text',
				'title' => esc_html__('500px link', 'dfd-native'),
				'desc' => esc_html__('Paste link to your account if you\'d like to show this social network', 'dfd-native'),
				'default' => ''
			),
			array(
				'id' => 'vb_link',
				'type' => 'text',
				'title' => esc_html__('ViewBug link', 'dfd-native'),
				'desc' => esc_html__('Paste link to your account if you\'d like to show this social network', 'dfd-native'),
				'default' => ''
			),
			array(
				'id' => 'xn_link',
				'type' => 'text',
				'title' => esc_html__('Xing link', 'dfd-native'),
				'desc' => esc_html__('Paste link to your account if you\'d like to show this social network', 'dfd-native'),
				'default' => ''
			),
			array(
				'id' => 'sp_link',
				'type' => 'text',
				'title' => esc_html__('Spotify link', 'dfd-native'),
				'desc' => esc_html__('Paste link to your account if you\'d like to show this social network', 'dfd-native'),
				'default' => ''
			),
			array(
				'id' => 'hz_link',
				'type' => 'text',
				'title' => esc_html__('Houzz link', 'dfd-native'),
				'desc' => esc_html__('Paste link to your account if you\'d like to show this social network', 'dfd-native'),
				'default' => ''
			),
			array(
				'id' => 'sk_link',
				'type' => 'text',
				'title' => esc_html__('Skype link', 'dfd-native'),
				'desc' => esc_html__('Paste link to your account if you\'d like to show this social network', 'dfd-native'),
				'default' => ''
			),
			array(
				'id' => 'ss_link',
				'type' => 'text',
				'title' => esc_html__('Slideshare link', 'dfd-native'),
				'desc' => esc_html__('Paste link to your account if you\'d like to show this social network', 'dfd-native'),
				'default' => ''
			),
			array(
				'id' => 'bd_link',
				'type' => 'text',
				'title' => esc_html__('Bandcamp link', 'dfd-native'),
				'desc' => esc_html__('Paste link to your account if you\'d like to show this social network', 'dfd-native'),
				'default' => ''
			),
			array(
				'id' => 'sd_link',
				'type' => 'text',
				'title' => esc_html__('Soundcloud link', 'dfd-native'),
				'desc' => esc_html__('Paste link to your account if you\'d like to show this social network', 'dfd-native'),
				'default' => ''
			),
			array(
				'id' => 'mk_link',
				'type' => 'text',
				'title' => esc_html__('Meerkat link', 'dfd-native'),
				'desc' => esc_html__('Paste link to your account if you\'d like to show this social network', 'dfd-native'),
				'default' => ''
			),
			array(
				'id' => 'ps_link',
				'type' => 'text',
				'title' => esc_html__('Periscope link', 'dfd-native'),
				'desc' => esc_html__('Paste link to your account if you\'d like to show this social network', 'dfd-native'),
				'default' => ''
			),
			array(
				'id' => 'sc_link',
				'type' => 'text',
				'title' => esc_html__('Snapchat link', 'dfd-native'),
				'desc' => esc_html__('Paste link to your account if you\'d like to show this social network', 'dfd-native'),
				'default' => ''
			),
			array(
				'id' => 'tc_link',
				'type' => 'text',
				'title' => esc_html__('The City link', 'dfd-native'),
				'desc' => esc_html__('Paste link to your account if you\'d like to show this social network', 'dfd-native'),
				'default' => ''
			),
			array(
				'id' => 'bh_link',
				'type' => 'text',
				'title' => esc_html__('Behance link', 'dfd-native'),
				'desc' => esc_html__('Paste link to your account if you\'d like to show this social network', 'dfd-native'),
				'default' => ''
			),
			array(
				'id' => 'pp_link',
				'type' => 'text',
				'title' => esc_html__('Microsoft Pinpoint link', 'dfd-native'),
				'desc' => esc_html__('Paste link to your account if you\'d like to show this social network', 'dfd-native'),
				'default' => ''
			),
			array(
				'id' => 'vd_link',
				'type' => 'text',
				'title' => esc_html__('Viadeo link', 'dfd-native'),
				'desc' => esc_html__('Paste link to your account if you\'d like to show this social network', 'dfd-native'),
				'default' => ''
			),
			array(
				'id' => 'ta_link',
				'type' => 'text',
				'title' => esc_html__('TripAdvisor link', 'dfd-native'),
				'desc' => esc_html__('Paste link to your account if you\'d like to show this social network', 'dfd-native'),
				'default' => ''
			),
			array(
				'id' => 'vk_link',
				'type' => 'text',
				'title' => esc_html__('VKontakte link', 'dfd-native'),
				'desc' => esc_html__('Paste link to your account if you\'d like to show this social network', 'dfd-native'),
				'default' => ''
			),
			array(
				'id' => 'ok_link',
				'type' => 'text',
				'title' => esc_html__('Odnoklassniki link', 'dfd-native'),
				'desc' => esc_html__('Paste link to your account if you\'d like to show this social network', 'dfd-native'),
				'default' => ''
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Social share options', 'dfd-native'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'subsection' => true,
		'icon' => 'dashicons dashicons-share',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'enable_facebook_share',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Facebook share button', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',//this should be the key as defined above
				'hint' => array(
					'title'   => esc_attr__('Facebook share','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the Facebook among your share buttons','dfd-native')
				)
			),
			array(
				'id' => 'enable_instagram_share',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Instagram share button', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',//this should be the key as defined above
				'hint' => array(
					'title'   => esc_attr__('Instagram share','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the Instagram among your share buttons','dfd-native')
				)
			),
			array(
				'id' => 'enable_tumblr_share',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Tumblr share button', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',//this should be the key as defined above
				'hint' => array(
					'title'   => esc_attr__('Tumblr share','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the Tumblr among your share buttons','dfd-native')
				)
			),
			array(
				'id' => 'enable_linkedin_share',
				'type' => 'button_set', //the field type
				'title' => esc_html__('LinkedIN share button', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',//this should be the key as defined above
				'hint' => array(
					'title'   => esc_attr__('LinkedIN share','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the LinkedIN among your share buttons','dfd-native')
				)
			),
			array(
				'id' => 'enable_twitter_share',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Twitter share button', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',//this should be the key as defined above
				'hint' => array(
					'title'   => esc_attr__('Twitter share','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the Twitter among your share buttons','dfd-native')
				)
			),
			array(
				'id' => 'enable_reddit_share',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Reddit share button', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',//this should be the key as defined above
				'hint' => array(
					'title'   => esc_attr__('Reddit share','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the Reddit among your share buttons','dfd-native')
				)
			),
			array(
				'id' => 'enable_google_plus_share',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Google Plus share button', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',//this should be the key as defined above
				'hint' => array(
					'title'   => esc_attr__('Google Plus share','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the Google Plus among your share buttons','dfd-native')
				)
			),
			array(
				'id' => 'enable_pinterest_share',
				'type' => 'button_set', //the field type
				'title' => esc_html__('Pinterest share button', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
				'default' => 'on',//this should be the key as defined above
				'hint' => array(
					'title'   => esc_attr__('Pinterest share','dfd-native'),
					'content' => esc_attr__('This option allows you to show or hide the Pinterest among your share buttons','dfd-native')
				)
			),
		),
	));
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Twitter section options', 'dfd-native'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'dashicons dashicons-twitter',
		'subsection' => true,
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'cachetime',
				'type' => 'text',
				'title' => esc_html__('Cache tweets', 'dfd-native'),
				'sub_desc' => esc_html__('In minutes', 'dfd-native'),
				'default' => '1',
				'hint' => array(
					'title'   => esc_attr__('Cache Tweets','dfd-native'),
					'content' => esc_attr__('Specify the cache time for tweets in minutes','dfd-native')
				)
			),
			array(
				'id' => 'numb_lat_tw',
				'type' => 'text',
				'title' => esc_html__('Latest tweets to display', 'dfd-native'),
				'default' => '10',
				'hint' => array(
					'title'   => esc_attr__('Latest tweets','dfd-native'),
					'content' => esc_attr__('Specify the number of tweets you\'d like to display','dfd-native')
				)
			),
			array(
				'id' => 'username',
				'type' => 'text',
				'title' => esc_html__('Username', 'dfd-native'),
				'default' => 'Envato',
				'hint' => array(
					'title'   => esc_attr__('Username','dfd-native'),
					'content' => esc_attr__('Specify the twitter username','dfd-native')
				)
			),
			array(
				'id' => 'twiiter_consumer',
				'type' => 'text',
				'title' => esc_html__('Consumer key', 'dfd-native'),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Consumer key','dfd-native'),
					'content' => esc_attr__('Enter the consumer key','dfd-native')
				)
			),
			array(
				'id' => 'twiiter_con_s',
				'type' => 'text',
				'title' => esc_html__('Consumer secret', 'dfd-native'),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Consumer secret','dfd-native'),
					'content' => esc_attr__('Enter the consumer secret','dfd-native')
				)
			),
			array(
				'id' => 'twiiter_acc_t',
				'type' => 'text',
				'title' => esc_html__('Access token', 'dfd-native'),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Access token','dfd-native'),
					'content' => esc_attr__('Enter the access token','dfd-native')
				)
			),
			array(
				'id' => 'twiiter_acc_t_s',
				'type' => 'text',
				'title' => esc_html__('Access token secret', 'dfd-native'),
				'default' => '',
				'hint' => array(
					'title'   => esc_attr__('Access token secret','dfd-native'),
					'content' => esc_attr__('Enter the access token secret','dfd-native')
				)
			),
		),
	));
	if(method_exists('Dfd_Theme_Helpers','build_icon_manager_options_section')) {
		$_icon_manager_fields = Dfd_Theme_Helpers::build_icon_manager_options_section();
		
		Redux::setSection( $opt_name, array (
			'title' => esc_html__('Icon manager', 'dfd-native'),
			//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
			//You dont have to though, leave it blank for default.
			'icon' => 'dashicons dashicons-text',
			//Lets leave this as a blank section, no options just some intro text set above.
			'fields' => $_icon_manager_fields
		));
	}

	Redux::setSection( $opt_name, array (
		'title' => esc_html__('Custom fonts', 'dfd-native'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'dashicons dashicons-editor-customchar',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array (
			array (
				'type' => 'custom_font',
				'id' => 'custom_font',
				'validate'=>'font_load',
				'title' => esc_html__('Font-face list:', 'dfd-native'),
				'subtitle' => esc_html__('Upload .zip archive with font-face files.', 'dfd-native').'<br>(<a target="_blank" href="http://www.fontsquirrel.com/tools/webfont-generator">'.esc_html__('Create your font-face package','dfd-native').'</a>)',
				'desc' => '<span style="color:#F09191">'.esc_html__('Note','dfd-native').':</span> '.esc_html__('You have to download the font-face.zip archive.','dfd-native').' <br>'.__('Pay your attention, that the archive has to contain the font-face files itself, and not the subfolders','dfd-native').'<br> ('.esc_html__('E.g.: font-face.zip/your-font-face.ttf, font-face.zip/your-font-face.eot, font-face.zip/your-font-face.woff etc','dfd-native').' ).<br> '.esc_html__('They\'ll be extracted and assigned automatically.', 'dfd-native').' ).<br> '.esc_html__('Please check the instruction how to create', 'dfd-native').' '.'<a href="http://nativewptheme.net/support/theme-options/custom-fonts">'.esc_html__('correct font archive', 'dfd-native').'</a>'.'.',
				'placeholder' => array (
					'title' => esc_html__('This is a title', 'dfd-native'),
					'description' => esc_html__('Description Here', 'dfd-native'),
					'url' => esc_html__('Give us a link!', 'dfd-native'),
				),
			),
		)
	));
//	if(Dfd_Theme_Helpers::isHeaderBuilderPluginActive()){
	Redux::setSection( $opt_name, array (
		'title' => __('Header Builder', 'dfd-native'),
		'icon' => 'dashicons dashicons-editor-customchar',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array (
			array (
				'type' => 'header_builder',
				'id' => 'header_builder',
				'validate'=>'header_builder',
				'title' => __('Header Builder:', 'dfd-native'),
				'required' => array( 'is_header_builder_enabled', "=", 'on' ),
				'placeholder' => array (
					'title' => __('This is a title', 'dfd-native'),
					'description' => __('Description Here', 'dfd-native'),
					'url' => __('Give us a link!', 'dfd-native'),
				),
			),
			array(
				'id' => 'grid_info_main_setting_builder',
				'type' => 'info',
				'desc' => '<h3 class="description">'.__('Header builder', 'dfd-native').'</h3>'
			),
			array(
				'id' => 'is_header_builder_enabled',
				'type' => 'button_set',
				'title' => esc_html__('Header builder', 'dfd-native'),
				'options' => array('on' => esc_html__('On','dfd-native'), 'off' => esc_html__('Off','dfd-native')),
				'default' => 'off',
				'hint' => array(
					'title'   => esc_attr__('Header builder','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable the header builder to design your own header style','dfd-native')
				)
			),
			array(
				'id' => 'grid_info_setting_builder',
				'type' => 'info',
				'required' => array( 'is_header_builder_enabled', "=", 'on' ),
				'desc' => '<h3 class="description">'.__('Content and styles settings', 'dfd-native').'</h3>'
			),
			array (
				'id' => 'style_header_builder',
				'type' => 'image_select',
				'tiles' => true,
				'dfd_tiles' => true,
				'title' => __('Header Style', 'dfd-native'),
				'sub_desc' => __('Select one of the layout types for single pages', 'dfd-native'),
				'options' => array (
					'horizontal' => array (
						'title' => esc_html__('Standard', 'dfd-native'),
						'img' => get_template_directory_uri() . '/assets/admin/img/header_builder_styles.png'
					),
					'side' => array (
						'title' => esc_html__('Side header', 'dfd-native'),
						'img' => get_template_directory_uri() . '/assets/admin/img/header_builder_styles.png'
					),
					'boxed' => array (
						'title' => esc_html__('Boxed', 'dfd-native'),
						'img' => get_template_directory_uri() . '/assets/admin/img/header_builder_styles.png'
					),
				),
				'default' => 'horizontal',
				'required' => array( 'is_header_builder_enabled', "=", 'on' ),
				'hint' => array (
					'title' => esc_attr__('Header Style', 'dfd-native'),
					'content' => esc_attr__('Choose one of the preset header styles. Standard, Side and Boxed styles are available', 'dfd-native')
				)
			),
			array(
				'id' => 'bg_image_side_header_builder',
				'type' => 'media',
				'title' => __('Background image', 'dfd-native'),
				'default' => array('url' => ''),
				'required' => array( 'is_header_builder_enabled', "=", 'on' ),
				'hint' => array(
					'title'   => esc_attr__('Background image','dfd-native'),
					'content' => esc_attr__('Select the image from the media library which will be set as a header background image','dfd-native')
				)
			),
			array(
				'id' => 'header_side_background_color_builder',
				'type' => 'color',
				'title' => __('Background color', 'dfd-native'),
				'default' => '#ffffff',
				'validate' => 'color',
				'required' => array( 'is_header_builder_enabled', "=", 'on' ),
				'hint' => array(
					'title'   => esc_attr__('Background color','dfd-native'),
					'content' => esc_attr__('Choose the background color for the header','dfd-native')
				)
			),
			array(
				'id' => 'header_side_bar_width_builder',
				'type' => 'slider',
				'title' => __('Side header width', 'dfd-native'),
				'desc' => '',
				'min' => '125',
				'step' => '1',
				'max' => '450',
				'default' => '320',
				'required' => array( 'is_header_builder_enabled', "=", 'on' ),
				'hint' => array(
                    'title'   => esc_attr__('Side header width','dfd-native'),
                    'content' => esc_attr__('This option allows you to specify the width of the side header. Minimum value is 125px and maximum value is 450px','dfd-native')
                )
			),
			array(
				'id' => 'header_copyright_builder',
				'type' => 'text',
				'title' => __('Copyright message', 'dfd-native'),
				'sub_desc' => __('Please do not use single quote here', 'dfd-native'),
				'validate' => 'html',
				'default' => '© DynamicFrameworks - Elite ThemeForest Author.',
				'required' => array( 'is_header_builder_enabled', "=", 'on' ),
				'hint' => array(
					'title'   => esc_attr__('Copyright','dfd-native'),
					'content' => esc_attr__('Add the text for your copyright message placed in header','dfd-native')
				)
			),
			array(
				'id' => 'header_telephone_builder',
				'type' => 'text',
				'title' => __('Telephone', 'dfd-native'),
				'sub_desc' => __('Please do not use single quote here', 'dfd-native'),
				'validate' => 'html',
				'default' => '+(032) 323-323-32',
				'required' => array( 'is_header_builder_enabled', "=", 'on' ),
				'hint' => array(
					'title'   => esc_attr__('Telephone','dfd-native'),
					'content' => esc_attr__('Add the telephone number which will be placed in header','dfd-native')
				)
			),
			array(
				'id' => 'header_button_text_builder',
				'type' => 'text',
				'title' => __('Button text', 'dfd-native'),
				'sub_desc' => __('Please do not use single quote here', 'dfd-native'),
				'validate' => 'html',
				'default' => 'Button',
				'required' => array( 'is_header_builder_enabled', "=", 'on' ),
				'hint' => array(
					'title'   => esc_attr__('Button text','dfd-native'),
					'content' => esc_attr__('Add the text for the button which will be displayed in header','dfd-native')
				)
			),
			array(
				'id' => 'header_button_url_builder',
				'type' => 'text',
				'title' => __('Button URL', 'dfd-native'),
				'sub_desc' => __('Please do not use single quote here', 'dfd-native'),
				'validate' => 'html',
				'default' => '#',
				'required' => array( 'is_header_builder_enabled', "=", 'on' ),
				'hint' => array(
					'title'   => esc_attr__('Button URL','dfd-native'),
					'content' => esc_attr__('Add the link to the button which will be displayed in header','dfd-native')
				)
			),
			array(
				'id' => 'header_alignment_builder',
				'type' => 'radio',
				'title' => __('Header alignment', 'dfd-native'),
				'options' => array(
					'left' => __('Left','dfd-native'),
					'right' => __('Right','dfd-native'),
				),
				'default' => 'left',
				'required' => array( 'is_header_builder_enabled', "=", 'on' ),
				'hint' => array(
					'title'   => esc_attr__('Header alignment','dfd-native'),
					'content' => esc_attr__('Choose the position of the header according to the page\'s content','dfd-native')
				)
			),
			array(
				'id' => 'header_content_alignment_builder',
				'type' => 'radio',
				'required' => array( 'is_header_builder_enabled', "=", 'on' ),
				'title' => __('Content alignment', 'dfd-native'),
				'options' => array(
					'alignleft' => __('Left', 'dfd-native'),
					'alignright' => __('Right', 'dfd-native'),
					'aligncenter' => __('Center', 'dfd-native'),
				),
				'default' => 'alignleft',
				'required' => array( 'is_header_builder_enabled', "=", 'on' ),
				'hint' => array(
					'title'   => esc_attr__('Content alignment','dfd-native'),
					'content' => esc_attr__('This option allows you to choose horizontal alignment for the header content','dfd-native')
				)
			),
			array(
				'id' => 'header_bg_repeat_builder',
				'type' => 'radio',
				'title' => __('Background image repeat', 'dfd-native'),
				'options' => array(
					'repeat' => __('repeat', 'dfd-native'),
					'no-repeat' => __('no-repeat', 'dfd-native'),
				),
				'default' => 'no-repeat',
				'required' => array( 'is_header_builder_enabled', "=", 'on' ),
				'hint' => array(
					'title'   => esc_attr__('Image repeat','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable the repeating of the image you\'ve set as background for the header','dfd-native')
				)
			),
			array(
				'id' => 'header_bg_size_builder',
				'type' => 'radio',
				'title' => __('Background image size', 'dfd-native'),
				'options' => array(
					'cover' => __('cover', 'dfd-native'),
					'contain' => __('contain', 'dfd-native'),
					'initial' => __('initial', 'dfd-native'),
				),
				'default' => 'cover',
				'required' => array( 'is_header_builder_enabled', "=", 'on' ),
				'hint' => array(
					'title'   => esc_attr__('Background size','dfd-native'),
					'content' => esc_attr__('This option allows you to specify the backround size for the image you\'ve set as background for the header','dfd-native')
				)
			),
			array(
				'id' => 'header_bg_position_builder',
				'type' => 'radio',	
				'title' => __('Background image position', 'dfd-native'),
				'options' => array(
					'center-center' => __('center center', 'dfd-native'),
					'top' => __('top', 'dfd-native'),
					'top-right' => __('top right', 'dfd-native'),
					'right' => __('right', 'dfd-native'),
					'right-bottom' => __('right bottom', 'dfd-native'),
					'bottom' => __('bottom', 'dfd-native'),
					'bottom-left' => __('bottom left', 'dfd-native'),
					'left' => __('left', 'dfd-native'),
					'left-top' => __('left top', 'dfd-native'),
				),
				'default' => 'center-center',
				'required' => array( 'is_header_builder_enabled', "=", 'on' ),
				'hint' => array(
					'title'   => esc_attr__('Image position','dfd-native'),
					'content' => esc_attr__('Choose the position for the image you\'ve set as background for the header','dfd-native')
				)
			),
			array(
				'id' => 'show_top_panel_builder',
				'type' => 'button_set',
				'title' => esc_html__('Top panel', 'dfd-native'),
				'options' => array('on' => esc_html__('On','dfd-native'), 'off' => esc_html__('Off','dfd-native')),
				'default' => 'on',
				'required' => array( 'is_header_builder_enabled', "=", 'on' ),
				'hint' => array(
					'title'   => esc_attr__('Top Panel','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable the top panel of the header','dfd-native')
				)
			),
			array(
				'id' => 'show_mid_panel_builder',
				'type' => 'button_set',
				'title' => esc_html__('Middle panel', 'dfd-native'),
				'options' => array('on' => esc_html__('On','dfd-native'), 'off' => esc_html__('Off','dfd-native')),
				'default' => 'on',
				'required' => array( 'is_header_builder_enabled', "=", 'on' ),
				'hint' => array(
					'title'   => esc_attr__('Middle Panel','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable the middle panel of the header','dfd-native')
				)
			),
			array(
				'id' => 'show_bot_panel_builder',
				'type' => 'button_set',
				'title' => esc_html__('Bottom panel', 'dfd-native'),
				'options' => array('on' => esc_html__('On','dfd-native'), 'off' => esc_html__('Off','dfd-native')),
				'default' => 'on',
				'required' => array( 'is_header_builder_enabled', "=", 'on' ),
				'hint' => array(
					'title'   => esc_attr__('Bottom panel','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable the bottom panel of the header','dfd-native')
				)
			),
			array(
				'id' => 'top_header_height_builder',
				'type' => 'slider',
				'title' => __('Top panel min-height', 'dfd-native'),
				'desc' => '',
				'min' => '30',
				'step' => '1',
				'max' => '250',
				'default' => '40',
				'required' => array( 'is_header_builder_enabled', "=", 'on' ),
				'hint' => array(
                    'title'   => esc_attr__('Top panel height','dfd-native'),
                    'content' => esc_attr__('This option allows you to set the min height for the top panel','dfd-native')
                )
			),
			array(
				'id' => 'mid_header_height_builder',
				'type' => 'slider',
				'title' => __('Middle panel min-height', 'dfd-native'),
				'desc' => '',
				'min' => '30',
				'step' => '1',
				'max' => '250',
				'default' => '40',
				'required' => array( 'is_header_builder_enabled', "=", 'on' ),
				'hint' => array(
                    'title'   => esc_attr__('Middle panel height','dfd-native'),
                    'content' => esc_attr__('This option allows you to set the min height for the middle panel','dfd-native')
                )
			),
			array(
				'id' => 'bot_header_height_builder',
				'type' => 'slider',
				'title' => __('Bottom panel min-height', 'dfd-native'),
				'desc' => '',
				'min' => '30',
				'step' => '1',
				'max' => '250',
				'default' => '70',
				'required' => array( 'is_header_builder_enabled', "=", 'on' ),
				'hint' => array(
                    'title'   => esc_attr__('Bottom panel height','dfd-native'),
                    'content' => esc_attr__('This option allows you to set the min height for the bottom panel','dfd-native')
                )
			),
			array(
				'id' => 'set_top_panel_abstract_builder',
				'type' => 'button_set',
				'title' => esc_html__('Set main field in Top panel to center', 'dfd-native'),
				'options' => array('on' => esc_html__('On','dfd-native'), 'off' => esc_html__('Off','dfd-native')),
				'default' => 'on',
				'required' => array( 'is_header_builder_enabled', "=", 'on' ),
				'hint' => array(
					'title'   => esc_attr__('Set main field in Top panel to center','dfd-native'),
					'content' => esc_attr__('This option allows you to align the main field (the center column of the Top panel) to the center. Please make sure you have left enough space for all elements when this option is enabled','dfd-native')
				)
			),
			array(
				'id' => 'set_mid_panel_abstract_builder',
				'type' => 'button_set',
				'title' => esc_html__('Set main field in Middle panel to center', 'dfd-native'),
				'options' => array('on' => esc_html__('On','dfd-native'), 'off' => esc_html__('Off','dfd-native')),
				'default' => 'on',
				'required' => array( 'is_header_builder_enabled', "=", 'on' ),
				'hint' => array(
					'title'   => esc_attr__('Set main field in Middle panel to center','dfd-native'),
					'content' => esc_attr__('This option allows you to align the main field (the center column of the Middle panel) to the center. Please make sure you have left enough space for all elements when this option is enabled','dfd-native')
				)
			),
			array(
				'id' => 'set_bot_panel_abstract_builder',
				'type' => 'button_set',
				'title' => esc_html__('Set main field in Bottom panel to center', 'dfd-native'),
				'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off','dfd-native')),
				'default' => 'on',
				'required' => array( 'is_header_builder_enabled', "=", 'on' ),
				'hint' => array(
					'title'   => esc_attr__('Set main field in Bottom panel to center','dfd-native'),
					'content' => esc_attr__('This option allows you to align the main field (the center column of the Top panel) to the center. Please make sure you have left enough space for all elements when this option is enabled','dfd-native')
				)
			),
			array(
				'id' => 'header_top_background_color_build',
				'type' => 'color',
				'title' => __('Top panel background color', 'dfd-native'),
				'default' => '#ffffff',
				//'validate' => 'color',
				'required' => array( 'is_header_builder_enabled', "=", 'on' ),
				'hint' => array(
					'title'   => esc_attr__('Background color','dfd-native'),
					'content' => esc_attr__('Choose the background color for the Top panel','dfd-native')
				)
			),
			array(
				'id' => 'header_mid_background_color_build',
				'type' => 'color',
				'title' => __('Middle panel background color', 'dfd-native'),
				'default' => '#ffffff',
				//'validate' => 'color',
				'required' => array( 'is_header_builder_enabled', "=", 'on' ),
				'hint' => array(
					'title'   => esc_attr__('Background color','dfd-native'),
					'content' => esc_attr__('Choose the background color for the Middle panel','dfd-native')
				)
			),
			array(
				'id' => 'header_bot_background_color_build',
				'type' => 'color',
				'title' => __('Bottom panel background color', 'dfd-native'),
				'default' => '#ffffff',
				//'validate' => 'color',
				'required' => array( 'is_header_builder_enabled', "=", 'on' ),
				'hint' => array(
					'title'   => esc_attr__('Background color','dfd-native'),
					'content' => esc_attr__('Choose the background color for the Bottom panel','dfd-native')
				)
			),
			array(
				'id' => 'header_top_text_color_build',
				'type' => 'color',
				'title' => __('Top panel text color', 'dfd-native'),
				'default' => '#313131',
				//'validate' => 'color',
				'required' => array( 'is_header_builder_enabled', "=", 'on' ),
				'hint' => array(
					'title'   => esc_attr__('Text color','dfd-native'),
					'content' => esc_attr__('Specify the text color for the Top panel\'s elements','dfd-native')
				)
			),
			array(
				'id' => 'header_mid_text_color_build',
				'type' => 'color',
				'title' => __('Middle panel text color', 'dfd-native'),
				'default' => '#313131',
				'required' => array( 'is_header_builder_enabled', "=", 'on' ),
				//'validate' => 'color',
				'hint' => array(
					'title'   => esc_attr__('Text color','dfd-native'),
					'content' => esc_attr__('Specify the text color for the Middle panel\'s elements','dfd-native')
				)
			),
			array(
				'id' => 'header_bot_text_color_build',
				'type' => 'color',
				'title' => __('Bottom panel text color', 'dfd-native'),
				'default' => '#313131',
				'required' => array( 'is_header_builder_enabled', "=", 'on' ),
				//'validate' => 'color',
				'hint' => array(
					'title'   => esc_attr__('Text color','dfd-native'),
					'content' => esc_attr__('Specify the text color for the Bottom panel\'s elements','dfd-native')
				)
			),
			array(
				'id' => 'header_border_color_build',
				'type' => 'color',
				'title' => __('Border Color', 'dfd-native'),
				'default' => '#e7e7e7',
				'required' => array( 'is_header_builder_enabled', "=", 'on' ),
				//'validate' => 'color',
				'hint' => array(
					'title'   => esc_attr__('Border color','dfd-native'),
					'content' => esc_attr__('Choose the border color for the header. The color will be also applied for the delimiters set in header','dfd-native')
				)
			),
			array(
				'id' => 'logo_header_builder',
				'type' => 'media',
				'title' => __('Logotype image', 'dfd-native'),
				'default' => array(
					'url' => $assets_folder . 'img/logo.png'
				),
				'required' => array( 'is_header_builder_enabled', "=", 'on' ),
				'hint' => array(
					'title'   => esc_attr__('Logotype','dfd-native'),
					'content' => esc_attr__('Select the image from the media library which will be set as logotype image for the current header style','dfd-native')
				)
			),
			array(
				'id' => 'retina_logo_header_builder',
				'type' => 'media',
				'title' => __('Logotype image for retina', 'dfd-native'),
				'default' => array(
					'url' => $assets_folder . 'img/logo.png'
				),
				'required' => array( 'is_header_builder_enabled', "=", 'on' ),
				'hint' => array(
					'title'   => esc_attr__('Retina logotype','dfd-native'),
					'content' => esc_attr__('Select the image from the media library which will be set as logotype image for retina for the current header style','dfd-native')
				)
			),
			array(
				'id' => 'header_sticky_builder',
				'type' => 'button_set',
				'title' => esc_html__('Header animation', 'dfd-native'),
				'options' => array('on' => esc_html__('On','dfd-native'), 'off' => esc_html__('Off','dfd-native')),
				'default' => 'on',
				'required' => array( 'is_header_builder_enabled', "=", 'on' ),
				'hint' => array(
					'title'   => esc_attr__('Header animation','dfd-native'),
					'content' => esc_attr__('This option allows you to enable or disable the header animation on scroll','dfd-native')
				)
			),
		)
	));
//	}
//	Redux::setSection( $opt_name, array (
//		'title' => esc_html__('System check', 'dfd-native'),
//		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
//		//You dont have to though, leave it blank for default.
//		'icon' => 'dashicons dashicons-filter',
//		'class' => 'system_check',
//		//Lets leave this as a blank section, no options just some intro text set above.
//		'fields' => array (
//			array (
//				'type' => 'sysinfo',
//				'id' => 'sysifo',
//				'title' => esc_html__('System Check:', 'dfd-native'),
//				'subtitle' => esc_html__('Press run test to show you configuration', 'dfd-native'),
//			),
//		)
//	));

    if ( file_exists( get_template_directory() . '/inc/README.md' ) ) {
        $section = array(
            'icon'   => 'el el-list-alt',
            'title'  => esc_html__( 'Documentation', 'dfd-native' ),
            'fields' => array(
                array(
                    'id'       => '17',
                    'type'     => 'raw',
                    'markdown' => true,
                    'content_path' => get_template_directory() . '/inc/README.md', // FULL PATH, not relative please
                    //'content' => 'Raw content here',
                ),
            ),
        );
        Redux::setSection( $opt_name, $section );
    }
    /*
     * <--- END SECTIONS
     */


    /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */

    /*
    *
    * --> Action hook examples
    *
    */

    // If Redux is running as a plugin, this will remove the demo notice and links
    //add_action( 'redux/loaded', 'remove_demo' );

    // Function to test the compiler hook and demo CSS output.
    // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
    //add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

    // Change the arguments after they've been declared, but before the panel is created
    //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

    // Change the default value of a field after it's been set, but before it's been useds
    //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

    // Dynamically add a section. Can be also used to modify sections/fields
    //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $field['msg']    = 'your custom error message';
                $return['error'] = $field;
            }

            if ( $warning == true ) {
                $field['msg']      = 'your custom warning message';
                $return['warning'] = $field;
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => esc_html__( 'Section via hook', 'dfd-native' ),
                'desc'   => '<p class="description">'.esc_html__( 'This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.', 'dfd-native' ).'</p>',
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }

    /**
     * Removes the demo link and the notice of integrated demo from the redux-framework plugin
     */
    if ( ! function_exists( 'remove_demo' ) ) {
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_filter( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }
    }