<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $save_image_ratio;

if (has_post_thumbnail()) {
	$thumb = get_post_thumbnail_id();
	$img_url = wp_get_attachment_url($thumb, 'thumb'); //get img URL
	$article_image = dfd_aq_resize($img_url, 280, 185, true, true, true);
	if(!$article_image) {
		$article_image = $img_url;
	}
	?>
	<div class="entry-thumb">
		<img src="<?php echo esc_url($article_image); ?>" alt="<?php the_title(); ?>"/>
	</div>
<?php
}