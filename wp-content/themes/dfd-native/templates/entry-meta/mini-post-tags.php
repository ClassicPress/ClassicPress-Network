<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$tags = wp_get_post_tags( $post->ID );
if(!empty($tags)) { ?>
	<div class="dfd-single-tags">
		<ul>
			<?php foreach($tags as $tag) : ?>
				<li class="post-tags-item">
					<a href="<?php echo get_tag_link($tag->term_id); ?>" title="<?php echo esc_attr($tag->name) ?>" class="dfd-background-second"><?php echo esc_html($tag->name); ?></a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php }