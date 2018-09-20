<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_native;
$dfd_gallery_page_url = '';
$dfd_gallery_link_src = (isset($dfd_native['dfd_gallery_top_link_src']) && !empty($dfd_native['dfd_gallery_top_link_src'])) ? $dfd_native['dfd_gallery_top_link_src'] : 'page';
if(isset($dfd_native['dfd_gallery_top_page_url']) && !empty($dfd_native['dfd_gallery_top_page_url']) && $dfd_gallery_link_src == 'url') {
	$dfd_gallery_page_url = $dfd_native['dfd_gallery_top_page_url'];
} elseif(isset($dfd_native['dfd_gallery_top_page_select']) && !empty($dfd_native['dfd_gallery_top_page_select'])) {
	$dfd_gallery_page_url = get_page_link($dfd_native['dfd_gallery_top_page_select']);
}

if($dfd_gallery_page_url) : ?>
	<a href="<?php echo esc_url($dfd_gallery_page_url) ?>" title="<?php echo esc_attr__('Gallery','dfd-native') ?>" class="dfd-blog-page-icon">
		<span></span>
		<span></span>
		<span></span>
	</a>
<?php endif;