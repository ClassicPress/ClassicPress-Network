<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<nav class="mega-menu clearfix text-right" id="top_left_mega_menu">
	<?php
		wp_nav_menu(array(
			'theme_location' => 'top_left_navigation', 
			'menu_class' => 'nav-menu menu-top-left-navigation menu-clonable-for-mobiles dfd-header-responsive-hide', 
			'fallback_cb' => 'top_menu_fallback'
		));
	?>
</nav>
