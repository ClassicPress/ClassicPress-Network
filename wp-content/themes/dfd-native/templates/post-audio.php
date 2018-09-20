<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $dfd_native;

$heading_html = '';

$single = is_single();

$post_id = get_the_ID();

$composition = get_post_meta($post_id,'post_audio_song',true);

$author = get_post_meta($post_id,'post_audio_author',true);

if($composition && $composition != '') {
	if(!$single) {
		$composition = '<a href="'.esc_url(get_permalink()).'" title="'.esc_attr($composition).'">'.esc_html($composition).'</a>';
	}
	$heading_html .= '<h3 class="entry-title">'.$composition.'</h3>';
}

if($author && $author != '') {
	$heading_html .= '<div class="entry-subtitle">'.esc_html($author).'</div>';
}

echo (!$single) ? $heading_html : '';

if($single) { ?>
	<div class="entry-content">
		<?php
		if($single && $heading_html != '') {
			echo '<div class="dfd-composition-heading"><div>'. $heading_html .'</div></div>';
		}
		?>
		<?php if (get_post_meta(get_the_ID(), 'post_custom_post_audio_url', true)): ?>
			<audio class="audio"  preload="auto" controls="controls">
				<source id="audio-post<?php the_ID();?>" src="<?php echo get_post_meta(get_the_ID(), 'post_custom_post_audio_url', true);?> ">      
			</audio>
		<?php endif; ?> 

		<?php if( get_post_meta(get_the_ID(), "post_self_hosted_audio", true ) ):  ?>
			<audio class="audio" preload="auto" controls="controls">              
				<source src="<?php echo get_post_meta(get_the_ID(), "post_self_hosted_audio",true ) ?>" type="audio/mpeg">
			</audio>
		<?php endif; ?>

		<?php if( get_post_meta(get_the_ID(), "post_soundcloud_audio", true ) ):  ?>
			<?php echo get_post_meta(get_the_ID(), "post_soundcloud_audio", true ); ?>
		<?php endif; ?>
	</div>
<?php }