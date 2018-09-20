<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_native;
$woo_page_url = '';
$woo_link_src = (isset($dfd_native['woo_top_link_src']) && !empty($dfd_native['woo_top_link_src'])) ? $dfd_native['woo_top_link_src'] : 'page';
if(isset($dfd_native['woo_top_page_url']) && !empty($dfd_native['woo_top_page_url']) && $woo_link_src == 'url') {
	$woo_page_url = $dfd_native['woo_top_page_url'];
} elseif(isset($dfd_native['woo_top_page_select']) && !empty($dfd_native['woo_top_page_select'])) {
	$woo_page_url = get_page_link($dfd_native['woo_top_page_select']);
}

if($woo_page_url) : ?>
	<a href="<?php echo esc_url($woo_page_url) ?>" title="<?php esc_attr_e('Woocommerce page','dfd-native') ?>" class="dfd-blog-page-icon">
		<span></span>
		<span></span>
		<span></span>
	</a>
<?php endif;
