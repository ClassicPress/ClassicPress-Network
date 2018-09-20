<?php
/*
Template Name: For Side by Side page
*/
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

$smart_header_data = '';

$additional_layout_class = DfdMetaboxSettings::get('dfd_enable_page_spacer') ? 'dfd-custom-padding-html' : '';
$animation_style = DfdMetaboxSettings::get('dfd_animation_style');
$smart_header = DfdMetaboxSettings::get('dfd_auto_header_colors');


if($animation_style != 'none') {
	$enable_animation = 'true';
	$enable_dots = 'false';
	$animation_style_class = ' dfd-enable-onepage-animation '.$animation_style;
} else {
	$enable_dots = DfdMetaboxSettings::get('dfd_enable_dots') ? 'false' : 'true';
	$enable_animation = 'false';
}
?>

<section id="layout" class="no-title dfd-side-by-side dfd-content-wrap <?php echo esc_attr($animation_style_class); ?>" data-enable-dots="<?php echo esc_attr($enable_dots) ?>" data-enable-animation="<?php echo esc_attr($enable_animation) ?>" <?php 
		if($smart_header == 'on') {
			echo ' data-smart-header="1"';
			$light_logo = DfdMetaBoxSettings::get('dfd_smart_header_light_logo');
			if($light_logo && !empty($light_logo)) {
				echo ' data-light-logo="'.esc_url($light_logo).'"';
			}
			$dark_logo = DfdMetaBoxSettings::get('dfd_smart_header_dark_logo');
			if($dark_logo && !empty($dark_logo)) {
				echo ' data-dark-logo="'.esc_url($dark_logo).'"';
			}
		}
	?>>
	
	<?php
		get_template_part('inc/loop/components/loop');
		new Dfd_Loop_Builder('content', 'one_page_scroll', 0);
	?>
	
</section>

<?php get_footer();