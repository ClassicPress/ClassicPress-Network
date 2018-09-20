<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
	$comments_count = wp_count_comments();
?>
<span class="entry-comments">
	<a href="<?php the_permalink(); ?>#comments" rel="author" class="fn">
		<i class="dfd-socicon-Untitled-2-37"></i>
		<span><?php comments_number( '0', '1', '%' ); ?></span><span class="comments-title">&nbsp;<?php esc_html_e('Comments', 'dfd-native'); ?></span>
	</a>
</span>