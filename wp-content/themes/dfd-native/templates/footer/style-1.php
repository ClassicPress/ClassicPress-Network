<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_native;

$row_class = '';

if(isset($dfd_native['footer_layout_width']) && $dfd_native['footer_layout_width'] != '') {
	$row_class .= $dfd_native['footer_layout_width'];
}

if(
	(isset($dfd_native['logo_footer']['url']) && $dfd_native['logo_footer']['url'] && isset($dfd_native['enable_footer_logo']) && strcmp($dfd_native['enable_footer_logo'], '1') === 0)
	||
	(isset($dfd_native['enable_footer_soc_icons']) && strcmp($dfd_native['enable_footer_soc_icons'], '1') === 0)
	||
	(isset($dfd_native['enable_footer_menu']) && strcmp($dfd_native['enable_footer_menu'], '1') === 0)
) :
?>
<div class="row <?php echo esc_attr($row_class) ?>">
	<div class="twelve columns text-center">
		<?php if(isset($dfd_native['logo_footer']['url']) && $dfd_native['logo_footer']['url'] && isset($dfd_native['enable_footer_logo']) && strcmp($dfd_native['enable_footer_logo'], '1') === 0) : ?>
			<div class="footer-logo">
				<a href="<?php echo esc_url(get_home_url('/')) ?>" alt="<?php esc_attr_e('Footer logo', 'dfd-native') ?>"><img src="<?php echo esc_url($dfd_native['logo_footer']['url']); ?>" alt="logo" class="foot-logo" /></a>
			</div>
		<?php endif; ?>
		<?php if(isset($dfd_native['enable_footer_soc_icons']) && strcmp($dfd_native['enable_footer_soc_icons'], '1') === 0) : ?>
			<div class="widget soc-icons">
				<?php Dfd_Theme_Helpers::dfd_social_networks(true); ?>
			</div>
		<?php endif; ?>
		<?php if(isset($dfd_native['enable_footer_menu']) && strcmp($dfd_native['enable_footer_menu'], '1') === 0) : ?>
			<div class="dfd-footer-menu">
				<?php wp_nav_menu(array('theme_location' => 'footer_menu', 'depth'=>1, 'container' => 'nav', 'fallback_cb' => 'false', 'menu_class' => 'footer-menu', 'walker' => new crum_clean_walker())); ?>
			</div>
		<?php endif; ?>
	</div>
</div>
<?php endif;