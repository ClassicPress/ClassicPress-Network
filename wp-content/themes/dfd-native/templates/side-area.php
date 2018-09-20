<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

if(preg_match('/(?i)msie [1-9]/',$_SERVER['HTTP_USER_AGENT']) === 0) {
	global $dfd_native;

	$side_area_class = 'side-area-widget';
	if(isset($dfd_native['side_area_bg_dark']) && strcmp($dfd_native['side_area_bg_dark'], 'on') === 0) {
		$side_area_class .= ' dfd-background-dark';
	}

	?>
	<section id="side-area" class="<?php echo esc_attr($side_area_class); ?>">
		<a href="#" title="" class="dfd-side-area-close-button dfd-socicon-cross-24 dfd-menu-button"></a>
		<div class="dfd-side-area-mask dfd-menu-button"></div>
		<div class="widget-vertical-scroll">
			<?php 
				if (is_active_sidebar('sidebar-sidearea')) {
					dynamic_sidebar('sidebar-sidearea');
				} else {
					the_widget( 'WP_Widget_Categories', 'title=Blog categories&count=true', 'before_widget=<div id="%1$s" class="widget %s">&before_title=<h3 class="widget-title">&after_title=</h3>');
					the_widget( 'dfd_rec_com_with_avatar_noexept', 'title=Comments&limit=3', 'before_widget=<div id="%1$s" class="widget %s">&before_title=<h3 class="widget-title">&after_title=</h3>');
					the_widget( 'dfd_soc_icon', 'alignment=text-left&style=style-4&sliding_direction=left_to_right&icon_size=15&border_radius=50', 'before_widget=<div id="%1$s" class="widget %s">');
				}
			?>
		</div>
	</section>
<?php
}