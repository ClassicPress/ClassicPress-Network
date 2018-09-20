<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<nav class="mega-menu clearfix" id="top_right_mega_menu">
	<?php
		wp_nav_menu(array(
			'theme_location' => 'top_right_navigation', 
			'menu_class' => 'nav-menu menu-top-right-navigation menu-clonable-for-mobiles dfd-header-responsive-hide', 
			'fallback_cb' => 'top_menu_fallback'
		));
	?>
</nav>
