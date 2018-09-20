<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<span class="byline author vcard">
	<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn">
		<?php echo get_the_author(); ?>
	</a>
</span>