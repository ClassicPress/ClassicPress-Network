<?php if ( ! defined( 'ABSPATH' ) ) { exit; }

$post_id = get_the_ID();

$quote_text = get_post_meta($post_id,'post_quote_text',true);
if(!is_single()) {
	$quote_text = wp_trim_words($quote_text, 20);
}
if(!empty($quote_text)) {
?>
<div class="entry-content">
	<?php
	if(!is_single()) {
		get_template_part('templates/entry-meta/mini', 'category-highlighted');
	}
	?>
	<a href="<?php echo the_permalink(); ?>" class="quote-content"><?php echo esc_html($quote_text) ?></a>
	<?php $post_custom_author_name = get_post_meta($post_id, "post_custom_author_name", true); ?>
	<?php if (!empty($post_custom_author_name)): ?>
			<div class="quote-author"><?php echo esc_html($post_custom_author_name); ?></div>
	<?php endif; ?>
</div>
<?php
}