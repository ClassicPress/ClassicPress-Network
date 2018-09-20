<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
 * List of the files included into theme
 */
#helpers
require_once get_template_directory().'/inc/helpers.php';
# Theme options panel
if(!isset($redux_demo)) {
	require_once get_template_directory().'/inc/redux-config.php';
}

# Include scripts ans styles
require_once get_template_directory().'/inc/assets.php';

#Theme icons pack
require_once get_template_directory().'/inc/icons/icons.php';

# Resize images on the fly
require_once get_template_directory().'/inc/aq_resizer.php';
# Cleanup - remove unused HTML and functions
require_once get_template_directory().'/inc/cleanup.php';
# Add Framework additional actions
require_once get_template_directory().'/inc/actions.php';
# Mega menu
require_once get_template_directory().'/inc/menu/menu.php';

# Widgets & Sidebars
require_once get_template_directory().'/inc/widgets.php';

# Woocommerce support
if(class_exists('WooCommerce')) {
	require_once get_template_directory().'/inc/woocommerce.php';
}

#Share counter
require_once get_template_directory().'/inc/share-counter.php';

# Icon represent
require_once get_template_directory().'/inc/lib/OneIcon.php';

if(is_admin()) {
	# Custom boxes
    require_once get_template_directory().'/inc/custom_metabox/include-boxes.php';
    require_once get_template_directory().'/inc/lib/plugins.php';
	if(!is_customize_preview()) {
		# Setup wizard by dtbaker https://github.com/dtbaker/envato-wp-theme-setup-wizard/tree/master/envato_setup
		require_once get_template_directory().'/inc/envato_setup/envato_setup.php';
	}
}