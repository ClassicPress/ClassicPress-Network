<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
	$comments_count = wp_count_comments();
?>
<span class="entry-comments">
	<a href="<?php the_permalink(); ?>#comments" rel="author" class="fn">
		<span><?php comments_number( '0', '1', '%' ); ?></span><span class="comments-title"></span>
	</a>
</span>