<?php
/**
 * Template part for displaying posts.
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package pagebuilderly
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<!-- Single start -->

	<?php if(is_single()) : ?>
	<?php if(has_post_thumbnail()) : ?>
	<div class="entry-thumb">
		<a href="<?php echo esc_url(get_permalink()); ?>"><?php the_post_thumbnail('pagebuilderly-full-thumb'); ?></a>
	</div>
<?php endif; ?>
<header class="entry-header">
	<div class="entry-box">
		<span class="entry-cate"><?php the_category(' '); ?></span>
	</div>
	<?php
	if ( is_single() ) :
		the_title( '<h1 class="entry-title">', '</h1>' );
	else :
		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	endif;
	if ( 'post' === get_post_type() ) : ?>
	<?php
	endif; ?>
	<span class="entry-meta"><?php pagebuilderly_posted_on(); ?></span>
</header>
<div class="entry-content">
	<?php the_content(); ?>
</div>
<div class="entry-tags">
	<?php the_tags("",""); ?>
</div>

<!-- Single end -->
<?php else : ?>
	<!-- Post feed start -->
	<div class="blog-feed-post-wrapper">


		<?php if(has_post_thumbnail()) : ?>
		<div class="blog-feed-entry-thumb">
			<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
			<a href="<?php the_permalink(); ?>" rel="bookmark">
				<div class="post-thumbnail" style="background-image: url('<?php echo $thumb['0'];?>')"></div>
			</a>
		</div>
		<div class="blog-feed-thumbnail-entry-content">
		<?php else : ?>
		<div class="entry-content blog-feed-entry-content">
		<?php endif; ?>
		<span class="blog-feed-category"><?php the_category(' '); ?></span>

		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		if ( 'post' === get_post_type() ) : ?>
		<?php
		endif; ?>

		<div class="blog-feed-meta">
			<a href="<?php the_permalink(); ?>">By	<span class="post-author"><?php echo get_the_author(); ?> | </a> 
					<span class="post-date"><?php pagebuilderly_posted_on(); ?></span>
					<!-- Sticky banner -->
					<?php if(is_sticky()) : ?>
					<div class="sticky-text">Featured</div>
					<!-- Sticky banner end -->
				<?php endif; ?>
			</div>
			<?php the_excerpt(); ?> 

		</div>
	</div>
<?php endif; ?>
<!-- Post feed end -->

</article>