<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_native;

if (has_post_thumbnail()) {
	if (!isset($dfd_native['thumb_image_crop']) || !$dfd_native['thumb_image_crop']) {
		$image_crop = true;
	} else {
		$image_crop = $dfd_native['thumb_image_crop'];
	}
	
	$thumb = get_post_thumbnail_id();
	$img_url = wp_get_attachment_url($thumb, 'full'); //get img URL
	
	if (isset($dfd_native['post_thumbnails_width']) && $dfd_native['post_thumbnails_width'] && isset($dfd_native['post_thumbnails_height']) && $dfd_native['post_thumbnails_height']) {
		$width = $dfd_native['post_thumbnails_width'];
		$height = $dfd_native['post_thumbnails_height'];
	} else {
		$width = 900;
		$height = 400;
	}
	
	$article_image = dfd_aq_resize($img_url, $width, $height, $image_crop, true, true);
	if(!$article_image) {
		$article_image = $img_url;
	}
	$atts = Dfd_Theme_Helpers::get_image_attrs($img_url, $thumb, $width, $height, get_the_title());
?>
	<div class="entry-thumb">
		<img src="<?php echo esc_url($article_image); ?>" <?php echo !empty($atts) ? $atts : ''; ?>/>
	</div>
<?php
}