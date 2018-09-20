<?php
if (!defined('ABSPATH')) {
	exit;
}
$data_title = get_the_title();
$data_link = get_permalink();
?>
<div class="dfd-blog-share-popup-wrap" data-directory="<?php echo get_template_directory_uri(); ?>" data-url="<?php echo esc_url($data_link) ?>">
	<div class="dfd-share-title"><i class="dfd-socicon-icon-share"></i><span><?php esc_html_e('Share', 'dfd-native') ?></span></div>
	<?php get_template_part('templates/entry-meta/mini','share-inner'); ?>
</div>