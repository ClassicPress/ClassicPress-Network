<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
wp_nav_menu(array(
	'theme_location' => 'additional_header_menu',
	'depth' => 1,
	'fallback_cb' => 'false',
	'menu_class' => 'dfd-additional-header-menu dfd-header-links',
	'walker' => new crum_clean_walker()
));