<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<article id="post-0" class="post no-results not-found">
	<header class="entry-header">
		<h1><?php esc_html_e( 'Sorry', 'dfd-native' ); ?></h1>
		<p class="heading"><?php esc_html_e( 'Nothing was found', 'dfd-native' ); ?></p>
		<p class="subtitle"><?php esc_html_e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'dfd-native' ); ?></p>
	</header>

	<div class="entry-content">
		<div class="widget_search">
			<?php get_search_form(); ?>
		</div>
	</div>

	<div class="tags-widget">
		<?php wp_tag_cloud('smallest=10&largest=10&number=30'); ?>
	</div>

</article><!-- #post-0 -->