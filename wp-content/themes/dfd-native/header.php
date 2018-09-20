<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<!DOCTYPE html>
<html class="no-ie" <?php language_attributes(); ?>> <!--<![endif]-->
	<head>
		
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		
		<?php
		global $dfd_native;
		if((!function_exists('wp_site_icon') || !function_exists('get_site_icon_url') || get_site_icon_url() == '') && isset($dfd_native['custom_favicon']['url']) && $dfd_native['custom_favicon']['url']) { ?>
			<link rel="icon" type="image/png" href="<?php echo esc_url($dfd_native['custom_favicon']['url']) ?>" />
		<?php } ?>

		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		
		<link rel="dns-prefetch" href="//fonts.googleapis.com" />
		
		<?php wp_head(); ?>

	</head>
	<?php
	$main_wrap_class = '';
	$lazy_load_data = '140%';
	$preloader = false;
	if(DfdMetaboxSettings::get('crum_page_custom_footer_parallax')) {
		$main_wrap_class .= ' dfd-parallax-footer';
	}
	if(strcmp(DfdMetaBoxSettings::compared('site_preloader_enabled', 'off'),'1')===0) {
		$preloader = true;
	}
	if(isset($dfd_native['enable_images_lazy_load']) && $dfd_native['enable_images_lazy_load'] == 'on' && isset($dfd_native['lazy_load_offset']) && $dfd_native['lazy_load_offset'] != '') {
		$lazy_load_data = $dfd_native['lazy_load_offset'].'%';
	}
	if(isset($dfd_native['appear_effect_offset']) && $dfd_native['appear_effect_offset'] != '') {
		$appear_effect_data = $dfd_native['appear_effect_offset'].'%';
	}
	?>

	<body <?php body_class(); ?>>
		<?php do_action('dfd_after_body_start'); ?>
		<?php if(DfdMetaboxSettings::get('dfd_enable_page_spacer')) : ?>
			<span class="dfd-frame-line line-top"></span>
			<span class="dfd-frame-line line-bottom"></span>
			<span class="dfd-frame-line line-left"></span>
			<span class="dfd-frame-line line-right"></span>
		<?php endif; ?>
		<?php
			if ($preloader) {
				get_template_part('inc/preloader');
			}
			
			if(isset($dfd_native['site_boxed']) && $dfd_native['site_boxed']) { ?>
				<div class="boxed_layout">
			<?php } ?>

			<?php get_template_part('templates/section', 'header'); ?>

			<div id="main-wrap" class="<?php echo esc_attr($main_wrap_class); ?>" data-lazy-load-offset="<?php echo esc_attr($lazy_load_data) ?>" data-appear-offset="<?php echo esc_attr($appear_effect_data) ?>">

				<div id="change_wrap_div">