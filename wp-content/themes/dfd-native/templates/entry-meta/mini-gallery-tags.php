<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

if(isset($post) && !empty($post) && is_object($post)) {
	$tags = wp_get_object_terms($post->ID, 'gallery_tags');
	if(!empty($tags)) {
	?>
	<div class="dfd-single-tags">
		<ul>
			<?php foreach($tags as $tag) : ?>
				<li class="post-tags-item">
					<a href="<?php echo get_tag_link($tag->term_id); ?>" title="<?php echo esc_attr($tag->name) ?>" class="dfd-background-second"><?php echo esc_html($tag->name); ?></a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php
	}
}