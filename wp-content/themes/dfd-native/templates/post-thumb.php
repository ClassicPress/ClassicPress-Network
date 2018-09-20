<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<?php if(has_post_thumbnail()) { ?>
	<div class="entry-thumb">
		<?php the_post_thumbnail(); ?>
	</div>
<?php }