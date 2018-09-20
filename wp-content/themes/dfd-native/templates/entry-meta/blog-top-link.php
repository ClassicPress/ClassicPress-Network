<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_native;
$blog_page_url = '';
$blog_link_src = (isset($dfd_native['blog_top_link_src']) && !empty($dfd_native['blog_top_link_src'])) ? $dfd_native['blog_top_link_src'] : 'page';
if(isset($dfd_native['blog_top_page_url']) && !empty($dfd_native['blog_top_page_url']) && $blog_link_src == 'url') {
	$blog_page_url = $dfd_native['blog_top_page_url'];
} elseif(isset($dfd_native['blog_top_page_select']) && !empty($dfd_native['blog_top_page_select'])) {
	$blog_page_url = get_page_link($dfd_native['blog_top_page_select']);
}

if($blog_page_url) : ?>
	<a href="<?php echo esc_url($blog_page_url) ?>" title="<?php echo esc_attr__('Blog','dfd-native') ?>" class="dfd-blog-page-icon">
		<span></span>
		<span></span>
		<span></span>
	</a>
<?php endif;