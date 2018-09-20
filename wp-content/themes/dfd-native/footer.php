<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $dfd_native;

$footer_style_option = isset($dfd_native['footer_variant']) ? $dfd_native['footer_variant'] : '';
$footer_style = !empty($footer_style_option) ? $footer_style_option : '1';
$subfooter_style = isset($dfd_native['enable_subfooter']) ? $dfd_native['enable_subfooter'] : 'on';
$footer_class = 'footer-style-'.$footer_style;
$footer_class .= (isset($dfd_native['footer_bg_dark']) && strcmp($dfd_native['footer_bg_dark'], '1') === 0) ? ' dfd-background-dark' : '';
$footer_class .= (strcmp($footer_style_option, '4') === 0) ? ' no-paddings' : '';

$subfooter_class = (isset($dfd_native['sub_footer_bg_dark']) && strcmp($dfd_native['sub_footer_bg_dark'], '1') === 0) ? ' dfd-background-dark' : '';
$subfooter_class .= ' subfooter-style-'.$subfooter_style;
$back_to_top_class = 'dfd-socicon-chevron-arrow-up';
if(isset($dfd_native['btt_button_select_icon']) && !empty($dfd_native['btt_button_select_icon'])) {
	$back_to_top_class = $dfd_native['btt_button_select_icon'];
}
$mobile_class = (isset($dfd_native['btt_show_mobile']) && $dfd_native['btt_show_mobile'] === 'on') ? 'btt-mobile-show' : 'mobile-hide' ;
?>

			</div>

			<?php if($footer_style != '4' || $subfooter_style != 'off') : ?>
				<div id="footer-wrap">
					<?php if($footer_style != '4') : ?>
						<section id="footer" class="<?php echo esc_attr($footer_class); ?>">
							<?php get_template_part('templates/footer/style', $footer_style); ?>
						</section>
					<?php endif; ?>

					<?php if($subfooter_style != 'off') : ?>
						<section id="sub-footer" class="<?php echo esc_attr($subfooter_class); ?>">
							<?php get_template_part('templates/subfooter/content'); ?>
						</section>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php if(isset($dfd_native['site_boxed']) && $dfd_native['site_boxed']) : ?>
				</div>
			<?php endif; ?>
			
			<?php echo isset($dfd_native['custom_js']) ? wp_kses($dfd_native['custom_js'], array(
																'script' => array(
																	'type' => array(),
																),
																'noscript' => array()
															)) : ''; ?>
				
		</div>

		<div class="body-back-to-top align-right <?php echo esc_attr($mobile_class); ?>"><i class="<?php echo esc_attr($back_to_top_class); ?>"></i></div>
		
		<span class="hide dfd-dynamic-styles-container"><?php do_action('dfd_head_custom_css') ?></span>
	
		<?php wp_footer(); ?>
	</body>
</html>
