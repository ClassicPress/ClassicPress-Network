<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if(isset($dfd_native['menu_alignment']) && !empty($dfd_native['menu_alignment'])) {
	$menu_class = ' '.$dfd_native['menu_alignment'];
} else {
	$menu_class = ' text-right';
}
?>
<nav class="mega-menu clearfix <?php echo esc_attr($menu_class); ?>" id="main_mega_menu">
	<?php
		wp_nav_menu(array(
			'theme_location' => 'primary_navigation', 
			'depth' => 1,
			'menu_class' => 'nav-menu menu-primary-navigation menu-clonable-for-mobiles', 
			'fallback_cb' => 'top_menu_fallback'
		));
	?>
</nav>
