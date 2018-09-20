<?php
global $dfd_native;
$data_title = get_the_title();
$data_link = get_permalink();
$data_media = Dfd_Theme_Helpers::default_noimage_url();
if(has_post_thumbnail()) {
	$thumb_id = get_post_thumbnail_id();
	$img_src = wp_get_attachment_image_src($thumb_id, 'full');
	if($img_src && isset($img_src[0])) {
		$data_media = $img_src[0];
	}
}
?>
<ul class="dfd-share-buttons" data-share="1">
	<?php if(!isset($dfd_native['enable_facebook_share']) || $dfd_native['enable_facebook_share'] != 'off') : ?>
		<li class="dfd-share-facebook">
			<!--  Replace with your URL. For best results, make sure you page has the proper FB Open Graph tags in header:
				  https://developers.facebook.com/docs/opengraph/howtos/maximizing-distribution-media-content/ -->
			<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_attr($data_link) ?>" class="popup" data-share-button="facebook" data-text="<?php echo esc_attr($data_title) ?>">
				<i class="dfd-socicon-facebook"></i>
				<span class="share-count" data-share-count="facebook"></span>
			</a>
		</li>
	<?php endif ?>
	
	<?php if(!isset($dfd_native['enable_google_plus_share']) || $dfd_native['enable_google_plus_share'] != 'off') : ?>
		<li class="dfd-share-googleplus">
			<!-- Replace href with your meta and URL information.  -->
			<a href="https://plus.google.com/share?url=<?php echo esc_attr($data_link) ?>" class="popup" data-share-button="google" data-text="<?php echo esc_attr($data_title) ?>">
				<i class="dfd-socicon-google-plus"></i>
				<span class="share-count" data-share-count="google"></span>
			</a>
		</li>
	<?php endif ?>
	
	<?php if(!isset($dfd_native['enable_twitter_share']) || $dfd_native['enable_twitter_share'] != 'off') : ?>
		<li class="dfd-share-twitter">
			<!-- Replace href with your Meta and URL information  -->
			<a href="https://twitter.com/intent/tweet?text=<?php echo esc_attr($data_link) ?>" class="popup" data-share-button="twitter" data-text="<?php echo esc_attr($data_title) ?>">
				<i class="dfd-socicon-twitter"></i>
				<?php
//				<span class="share-count" data-share-count="twitter"></span>
				?>
			</a>
		</li>
	<?php endif ?>

	<?php if(!isset($dfd_native['enable_pinterest_share']) || $dfd_native['enable_pinterest_share'] != 'off') : ?>
		<li class="dfd-share-pinterest">
			<!-- Replace href with your meta and URL information.  -->
			<a href="http://pinterest.com/pin/create/button/?url=<?php echo esc_attr($data_link) ?>&amp;media=<?php echo esc_url($data_media) ?>" class="popup" data-text="<?php echo esc_attr($data_title) ?>">
				<i class="dfd-socicon-pinterest"></i>
			</a>
		</li>
	<?php endif ?>
		
	<?php if(!isset($dfd_native['enable_instagram_share']) || $dfd_native['enable_instagram_share'] != 'off') : ?>
		<li class="dfd-share-instagram">
			<!-- Replace href with your URL  -->
			<a href="https://instagram.com/sharer.php?u=<?php echo esc_attr($data_link) ?>&media=<?php echo esc_url($data_media) ?>&description=<?php echo esc_attr($data_title) ?>" class="popup" data-text="<?php echo esc_attr($data_title) ?>">
			<!--<a href="http://instagram.com/dbox" class="popup" data-text="">-->
				<i class="dfd-socicon-instagram"></i>
			</a>
		</li>
	<?php endif ?>

	<?php if(!isset($dfd_native['enable_tumblr_share']) || $dfd_native['enable_tumblr_share'] != 'off') : ?>
		<li class="dfd-share-tumblr">
			<a href="http://tumblr.com/share/link?url=<?php echo esc_attr($data_link) ?>" class="popup"  data-text="<?php echo esc_attr($data_title) ?>">
				<i class="dfd-socicon-tumblr"></i>
			</a>
		</li>
	<?php endif ?>

	<?php if(!isset($dfd_native['enable_linkedin_share']) || $dfd_native['enable_linkedin_share'] != 'off') : ?>
		<li class="dfd-share-linkedin">
			<!-- Replace href with your meta and URL information -->
			<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_attr($data_link) ?>" class="popup"  data-text="<?php echo esc_attr($data_title) ?>">
				<i class="dfd-socicon-linkedin"></i>
			</a>
		</li>
	<?php endif ?>
	
	<?php if(!isset($dfd_native['enable_reddit_share']) || $dfd_native['enable_reddit_share'] != 'off') : ?>
		<li class="dfd-share-reddit">
			<a href="http://www.reddit.com/submit?url=<?php echo esc_attr($data_link) ?>" class="popup"  data-text="<?php echo esc_attr($data_title) ?>">
				<i class="dfd-socicon-reddit"></i>
			</a>
		</li>
	<?php endif ?>
</ul>