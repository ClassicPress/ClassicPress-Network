<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$id = get_the_ID();
$tags = wp_get_object_terms($id, 'portfolio_tags');
if(!empty($tags)) { ?>
	<div class="post-tags">
		<ul>
			<?php foreach($tags as $tag) : ?>
				<li class="post-tags-item">
					<a href="<?php echo esc_url(get_term_link($tag->slug, 'portfolio_tags')); ?>"><?php echo esc_html($tag->name); ?></a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php }