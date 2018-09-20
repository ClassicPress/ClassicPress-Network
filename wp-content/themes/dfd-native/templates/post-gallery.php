<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $post;
$postid = get_the_ID();

if (metadata_exists('post', $postid, '_my_post_image_gallery')) {
	$my_posts_image_gallery = get_post_meta($postid, '_my_post_image_gallery', true);
} else {
	// Backwards compat
	$attachment_ids = get_posts('post_parent=' . $postid . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids');
	$attachment_ids = array_diff($attachment_ids, array(get_post_thumbnail_id()));
	$my_posts_image_gallery = implode(',', $attachment_ids);
}

$attachments = array_filter(explode(',', $my_posts_image_gallery));
if ($attachments) {
	$image_dimentions = array(1200, 800);
	echo '<div class="entry-thumb">';
		if(!is_single()) {
			get_template_part('templates/entry-meta/mini', 'category-highlighted');
			$image_dimentions = array(900, 600);
		}
		
		echo '<div class="dfd-gallery-post-slider slide-post">';
		
			global $dfd_native;
			
			$extra_class = $img_html = '';
			$images_lazy_load = false;

			if(isset($dfd_native['enable_images_lazy_load']) && $dfd_native['enable_images_lazy_load'] == 'on') {
				$images_lazy_load = true;
				$extra_class .= ' dfd-img-lazy-load ';
			}

			foreach ($attachments as $attachment) {
				$img_url =  wp_get_attachment_url($attachment); /*get img URL*/

				$article_image = dfd_aq_resize($img_url, $image_dimentions[0], $image_dimentions[1], true, true, true);

				if(!$article_image) {
					$article_image = $img_url;
				}
				
				$atts = Dfd_Theme_Helpers::get_image_attrs($article_image, $attachment, absint($image_dimentions[0]), absint($image_dimentions[1]), get_the_title());
				
				if($images_lazy_load) {
					$loading_img_src = "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 $image_dimentions[0] $image_dimentions[1]'%2F%3E";
					$img_html = '<img src="'.$loading_img_src.'" data-src="'. esc_url($article_image) .'" width="'. esc_attr(floor($image_dimentions[0])) .'" height="'. esc_attr(floor($image_dimentions[1])) .'" '.$atts.' />';
				} else {
					$img_html = '<img src="'. esc_url($article_image) .'" width="'. esc_attr(floor($image_dimentions[0])) .'" height="'. esc_attr(floor($image_dimentions[1])) .'" '.$atts.' />';
				}
				?>
				<div class="<?php echo esc_attr($extra_class) ?>">
					<?php echo !empty($img_html) ? $img_html : ''; ?>
				</div>

			<?php  }
		echo '</div>';
		
		echo '<div class="slider-controls">'
				. '<a href="#" title="slick-prev" class="dfd-socicon-arrow-left-01 prev"><span class="count"></span></a>'
				. '<a href="#" title="slick-next" class="dfd-socicon-arrow-right-01 next"><span class="count"></span></a>'
			. '</div>';
		echo '<div class="dfd-gallery-bar"></div>';

	echo '</div>';
}