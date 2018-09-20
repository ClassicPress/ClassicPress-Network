<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$post_id = get_the_ID();

$video_src = get_post_meta($post_id, 'post_single_video_src', true);

if(!empty($video_src)) {
	$single = is_single();

	if (has_post_thumbnail()) {
		$thumb = get_post_thumbnail_id();
		$img_url = wp_get_attachment_url($thumb, 'full'); //get img URL
		$article_image = dfd_aq_resize($img_url, 900, 650, true, true, true);
		if(!$article_image) {
			$article_image = $img_url;
		}
	} else {
		$article_image = Dfd_Theme_Helpers::default_noimage_url();
	}
	switch($video_src) {
		case 'youtube':
			$youtube_video = get_post_meta($post_id, 'post_youtube_video_url', true);
			if ($youtube_video){
				if(substr_count($youtube_video, '?') > 0) {
					$youtube_video = substr($youtube_video,(stripos($youtube_video,'?v=')+3));
				}
				if(substr_count($youtube_video, '&') > 0) {
					$youtube_video = substr($youtube_video, 0, stripos($youtube_video,'&'));
				}
				?>
				<div class="entry-thumb">
					<div class="flex-video  widescreen">
						<iframe width="1200" height="675" src="https://www.youtube.com/embed/<?php echo esc_attr($youtube_video); ?>?wmode=opaque" class="youtube-video" allowfullscreen></iframe>
					</div>
				</div>
			<?php
				if(!$single) {
					return;
				}
			}
			break;
		case 'vimeo':
			$vimeo_video = get_post_meta($post_id,'post_vimeo_video_url', true);
			if ($vimeo_video){
				if(substr_count($vimeo_video, 'vimeo.com/') > 0) {
					$vimeo_video = substr($vimeo_video,(stripos($vimeo_video, 'vimeo.com/')+10));
				}
				if(substr_count($vimeo_video, '&') > 0) {
					$vimeo_video = substr($vimeo_video, 0, stripos($vimeo_video,'&'));
				}
				?>
				<div class="entry-thumb">
					<div class="flex-video widescreen vimeo">
						<iframe src='https://player.vimeo.com/video/<?php echo esc_attr($vimeo_video); ?>?portrait=0' width='1200' height='675' frameborder='0'></iframe>
					</div>
				</div>
			<?php
				if(!$single) {
					return;
				}
			}
			break;
		case 'mp4':
		case 'webm':
			$self_hosted_mp4 = get_post_meta($post_id, 'post_self_hosted_mp4', true);
			$self_hosted_webm = get_post_meta($post_id, 'post_self_hosted_webm', true);
			if( $self_hosted_mp4 ||  $self_hosted_webm) {
				?>
				<div class="entry-thumb">
					<video id="video-post<?php the_ID();?>" class="video-js vjs-default-skin" controls
						   preload="auto"
						   width="900"
						   height="650"
						   poster="<?php echo esc_url($article_image) ?>"
						   data-setup="{}" >


						<?php if( $self_hosted_mp4 ): ?>
							<source src="<?php echo esc_url($self_hosted_mp4) ?>" type='video/mp4'>
						<?php endif;?>
						<?php if( $self_hosted_webm ): ?>
							<source src="<?php echo esc_url($self_hosted_webm) ?>" type='video/webm'>
						<?php endif;?>
					</video>
				</div>
			<?php }
			break;
	}
}
