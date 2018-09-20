<?php if ( ! defined( 'ABSPATH' ) ) { exit; }
$id = get_the_author_meta('ID');
?>
<span class="byline author vcard">
	<?php echo get_avatar($id, '34', '' ); ?>
	<a href="<?php echo get_author_posts_url($id); ?>" rel="author" class="fn">
		<span><?php esc_html_e('by','dfd-native') ?></span>
		<?php echo get_the_author(); ?>
	</a>
</span>