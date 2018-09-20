<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
 * Author Box
 *
 * Displays author box with author description and thumbnail on single posts
 *
 * @package WordPress
 * @subpackage Dynamic theme, for WordPress
 */
?>

<?php
$author_info = get_the_author_meta('dfd_author_info');
?>

<?php
$author_name = $author_info = '';
global $authordata;
if ( is_object( $authordata ) ) {
	$author_name =  ($authordata->display_name) ? $authordata->display_name : $authordata->user_nicename;
	$author_info = get_the_author_meta('dfd_author_info',get_current_user_id());
}
$author_description = get_the_author_meta('description');

if(!empty($author_description)) {
	?>

	<div class="about-author">
		<figure class="author-photo">
			<?php echo get_avatar( get_the_author_meta('ID') , 80 ); ?>
		</figure>
		<div class="author-content">
			<div class="author-top-inner">
				<?php if($author_name != '') { ?>
					<div class="dfd-content-title-big author-name"><?php echo esc_html($author_name) ?></div>
				<?php } ?>
				<?php if($author_info != '') { ?>
					<div class="dfd-content-title-small author-info"><?php echo esc_html($author_info) ?></div>
				<?php } ?>
			</div>
			<div class="author-description">
				<p><?php the_author_meta('description'); ?></p>
			</div>
		</div>
		<span class="delimiter"></span>
	</div>
	<?php
}