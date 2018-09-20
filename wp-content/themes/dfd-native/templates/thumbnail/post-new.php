<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if (has_post_thumbnail()) {
	
	$thumb = get_post_thumbnail_id();
	$img_url = wp_get_attachment_url($thumb, 'full'); //get img URL
	
?>
	<div class="entry-thumb">
		<img src="<?php echo esc_url($img_url); ?>" alt="<?php the_title(); ?>"/>
		<div class="post-comments-wrap">
			<?php get_template_part('templates/entry-meta/mini', 'comments-number'); ?>
		</div>
		<div class="post-like-wrap">
			<?php get_template_part('templates/entry-meta/mini', 'like'); ?>
		</div>
	</div>
<?php
}