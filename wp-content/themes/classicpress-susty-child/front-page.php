<?php
/*
Template Name: Home (Front) Page
*/

get_header();

?>

<!--- opening <section> tag in header.php template --->
	<div class="social">
		<span class="github">
			<a href="https://github.com/ClassicPress"><img src="<?php echo home_url( '/wp-content/themes/classicpress-susty-child/images/GitHub-Mark-Light-32px.png' ); ?>" alt="Github"></a>
		</span>
		<span class="twitter">
			<a href="https://twitter.com/GetClassicPress"><img src="<?php echo home_url( '/wp-content/themes/classicpress-susty-child/images/Twitter_Social_Icon_Circle_White.svg' ); ?>" alt="Twitter" width="32" height="32"></a>
		</span>
	</div>
	<div class="home-hero">
		<div class="home-hero-text">
			<h1><?php esc_html_e( 'ClassicPress', 'susty' ); ?></h1>
			<h2><?php esc_html_e( 'The business-focused CMS.', 'susty' ); ?></h2>
			<h3><?php esc_html_e( 'Powerful. Versatile. Predictable.', 'susty' ); ?></h3>
		</div>
		<div class="home-hero-image">
			<img src="<?php echo home_url( '/wp-content/themes/classicpress-susty-child/images/classicpress-admin.png' ); ?>" alt="ClassicPress edit post screen">
		</div>
	</div>
</section>

<section class="home-callout-container">
	<div class="home-callout">
		<div class="home-callout-panel">
			<h2 class="h3"><?php esc_html_e( 'For Businesses', 'susty' ); ?></h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione asperiores perferendis, aliquam quidem, rem illo autem maiores placeat incidunt, natus facilis minima quasi dolor facere asperiores perferendis.</p>
			<a href="" class="button button-purple"><?php esc_html_e( 'Continue Reading', 'susty' ); ?></a>
		</div>
		<div class="home-callout-panel">
			<h2 class="h3"><?php esc_html_e( 'For Bloggers', 'susty' ); ?></h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione asperiores perferendis, aliquam quidem, rem illo autem maiores placeat incidunt, natus facilis minima quasi dolor facere elit adipisicing.</p>
			<a href="#" class="button button-purple"><?php esc_html_e( 'Continue Reading', 'susty' ); ?></a>
		</div>
		<div class="home-callout-panel">
			<h2 class="h3"><?php esc_html_e( 'For Developers', 'susty' ); ?></h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione asperiores perferendis, aliquam quidem, rem illo autem maiores placeat incidunt, natus facilis minima quasi dolor facere asperiores perferendis.</p>
			<a href="#" class="button button-purple"><?php esc_html_e( 'Continue Reading', 'susty' ); ?></a>
		</div>
	</div>
</section>

<section class="feature-description">
	<h2><?php esc_html_e( 'Powerful. Versatile. Predictable.', 'susty' ); ?></h2>
	<div class="feature-callouts">
		<div class="feature-callout">
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione asperiores perferendis, aliquam quidem, rem illo autem maiores placeat incidunt, natus facilis minima quasi dolor facere temporibus.</p>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
			<a href="#" class="button button-aqua"><?php esc_html_e( 'Get Involved', 'susty' ); ?></a>
		</div>
		<div class="feature-callout">
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione asperiores perferendis, aliquam quidem, rem illo autem maiores placeat incidunt, natus facilis minima quasi dolor facere temporibus.</p>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
			<a href="#" class="button button-aqua"><?php esc_html_e( 'Create Account', 'susty' ); ?></a>
		</div>
	</div>
</section>

<section class="community-block">
	<div class="community-text">
		<h2><?php esc_html_e( 'Community first.', 'susty' ); ?></h2>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ullam- corper ante ut lectus feugiat, sed semper diam placerat. Aenean facili- sis eleifend dictum. Curabitur id odio pulvinar lacus pellentesque cursus. Ut interdum sapien a pretium pharetra. Ut ut lorem velit.</p>

		<p>Ut interdum sapien a pretium pharetra.</p>
	</div>
	<div class="community-image">
		<figure class="community-image-holder">
			<img src="https://via.placeholder.com/640x360" alt="Placeholder">
		</figure>
	</div>
</section>

<section class="features-block">
	<h2>Features</h2>
	<div class="feature-ctas">
		<div class="feature-cta">
			<h3><?php esc_html_e( 'Gutenberg Free', 'susty' ); ?></h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores voluptates nobis doloribus, quisquam aliquam numquam corporis dolores fugiat, blanditiis a nihil eveniet et magni enim, commodi rerum minus ipsum labore.</p>
		</div>
		<div class="feature-cta">
			<h3><?php esc_html_e( 'Another major feature', 'susty' ); ?></h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Placeat exercitationem laborum optio ad vitae sunt pariatur rem esse dolores iusto modi perferendis ut, itaque quae, adipisci tempore aspernatur recusandae mollitia.</p>
		</div>
	</div>
	<div class="feature-checks">
		<div class="feature-check">
			<h4>Feature Title</h4>
			<p>Lorem ipsum dolor sit amet, con- sectetur adipiscing elit. Nullam ullamcorper ante ut lectus feu- giat, sed semper diam placerat.</p>
		</div>
		<div class="feature-check">
			<h4>Feature Title</h4>
			<p>Lorem ipsum dolor sit amet, con- sectetur adipiscing elit. Nullam ullamcorper ante ut lectus feu- giat, sed semper diam placerat.</p>
		</div>
		<div class="feature-check">
			<h4>Feature Title</h4>
			<p>Lorem ipsum dolor sit amet, con- sectetur adipiscing elit. Nullam ullamcorper ante ut lectus feu- giat, sed semper diam placerat.</p>
		</div>
		<div class="feature-check">
			<h4>Feature Title</h4>
			<p>Lorem ipsum dolor sit amet, con- sectetur adipiscing elit. Nullam ullamcorper ante ut lectus feu- giat, sed semper diam placerat.</p>
		</div>
		<div class="feature-check">
			<h4>Feature Title</h4>
			<p>Lorem ipsum dolor sit amet, con- sectetur adipiscing elit. Nullam ullamcorper ante ut lectus feu- giat, sed semper diam placerat.</p>
		</div>
		<div class="feature-check">
			<h4>Feature Title</h4>
			<p>Lorem ipsum dolor sit amet, con- sectetur adipiscing elit. Nullam ullamcorper ante ut lectus feu- giat, sed semper diam placerat.</p>
		</div>
	</div>
</section>

<section class="get-classicpress">
	<div class="get-classicpress-content">
		<h2><?php esc_html_e( 'Get ClassicPress', 'susty' ); ?></h2>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ullamcorper ante ut lectus feugiat, sed semper diam placerat. Aenean facilisis eleifend dictum. Curabitur id odio pulvinar lacus pellentesque cursus. Ut interdum sapien a pretium pharetra. Ut ut lorem velit.</p>
		<a href="<?php echo home_url( '/download/' ); ?>" class="button button-yellow"><?php esc_html_e( 'Download', 'susty' ); ?></a>
		<figure class="get-classicpress-image-holder">
			<img src="https://via.placeholder.com/640x240" alt="Placeholder">
		</figure>
		<div class="classic-front">
			<p>Made with ❤ with ClassicPress. © Copyright 2018 ClassicPress. All Rights Reserved.</br>
			ClassicPress is a company limited by guarantee with registration number 11549088.</p>
		</div>
	</div>
</section>

<?php

get_footer();

?>
