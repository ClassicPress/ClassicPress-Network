<?php if ( ! defined( 'ABSPATH' ) ) { exit; }

$post_id = get_the_ID();

$link_text = get_post_meta($post_id,'post_link_text',true);
if(!is_single()) {
	$link_text = wp_trim_words($link_text, 20);
}
?>
<div class="entry-content">
	<?php
	$url = get_post_meta($post_id,'post_format_link_url',true);
	if(!$url) {
		$url = get_permalink();
	}
	if(!is_single()) {
		get_template_part('templates/entry-meta/mini', 'category-highlighted');
	}
	?>
    <h3 class="entry-title">
        <a href="<?php echo esc_url(get_permalink()) ?>" title="<?php echo esc_attr(get_the_title()) ?>" class="dfd-post-link-title"><?php echo esc_html($link_text); ?></a>
    </h3>
    <a href="<?php echo esc_url($url); ?>" title="<?php esc_attr_e('Post link','dfd-native') ?>" class="dfd-post-link-url"><?php echo esc_html($url); ?></a>
</div>
