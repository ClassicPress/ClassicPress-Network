<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$avail_scrs = array('youtube', 'vimeo', 'mp4', 'webm');
$video_src = DfdMetaBoxSettings::get('portfolio_single_video_src');

if(!empty($video_src) && in_array($video_src, $avail_scrs)) {
	$video_url = DfdMetaBoxSettings::get('portfolio_'.$video_src.'_video_url');
	if(!empty($video_url)) {
		switch($video_src) {
			case 'youtube':
				if(substr_count($video_url, '?') > 0) {
					$video_url = substr($video_url,(stripos($video_url,'?v=')+3));
				}
				if(substr_count($video_url, '&') > 0) {
					$video_url = substr($video_url, 0, stripos($video_url,'&'));
				}
				?>
				<div class="flex-video  widescreen">
					<iframe width="1200" height="675" src="https://www.youtube.com/embed/<?php echo esc_attr($video_url); ?>?wmode=opaque" class="youtube-video" allowfullscreen></iframe>
				</div>
				<?php
				break;
			case 'vimeo':
				if(substr_count($video_url, 'vimeo.com/') > 0) {
					$video_url = substr($video_url,(stripos($video_url, 'vimeo.com/')+10));
				}
				if(substr_count($video_url, '&') > 0) {
					$video_url = substr($video_url, 0, stripos($video_url,'&'));
				}
				?>
				<div class="flex-video widescreen vimeo">
					<iframe src="https://player.vimeo.com/video/<?php echo esc_attr($video_url); ?>?portrait=0" width="1200" height="675" frameborder="0"></iframe>
				</div>
				<?php
				break;
			case 'mp4':
			case 'webm':
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
				?>
				<video id="video-post<?php the_ID();?>" class="video-js vjs-default-skin" controls
					   preload="auto"
					   width="900"
					   height="650"
					   poster="<?php echo esc_url($article_image) ?>"
					   data-setup="{}" >


					<?php if( $video_src == 'mp4' ): ?>
						<source src="<?php echo esc_url($video_url) ?>" type='video/mp4'>
					<?php endif;?>
					<?php if( $video_src = 'webm' ): ?>
						<source src="<?php echo esc_url($video_url) ?>" type='video/webm'>
					<?php endif;?>
				</video>
				<?php
				break;
		}
	}
}