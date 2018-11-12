<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Susty
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="blog-post">

		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>

		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

		<div class="entry-meta">
			<?php susty_wp_posted_on(); ?>
			<?php susty_wp_posted_by(); ?>
		</div>

		<div class="excerpt"><?php the_excerpt(); ?></div>

		<a href="<?php the_permalink(); ?>" class="button button-purple"><?php esc_html_e( 'Continue Reading', 'susty' ); ?></a> <?php

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'susty' ),
			'after'  => '</div>',
		) ); ?>

	</div>	
	
</article><!-- #post-<?php the_ID(); ?> -->
