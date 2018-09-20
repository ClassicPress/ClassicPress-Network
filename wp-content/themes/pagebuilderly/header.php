<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pagebuilderly
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'pagebuilderly' ); ?></a>
		<header id="masthead" class="site-header" role="banner">
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<div class="top-nav container">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
						<span class="m_menu_icon"></span>
						<span class="m_menu_icon"></span>
						<span class="m_menu_icon"></span>
					</button>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>

					<div id="top-search">
						<a href="#"><i class="fa fa-search"></i></a>
					</div>
					<div class="show-search">
						<?php get_search_form(); ?>
					</div>
					<div id="top-social">
						<?php if(get_theme_mod('pagebuilderly_facebook')) : ?><a href="<?php echo esc_url(get_theme_mod('pagebuilderly_facebook')); ?>" target="_blank"><i class="fa fa-facebook"></i></a><?php endif; ?>
						<?php if(get_theme_mod('pagebuilderly_twitter')) : ?><a href="<?php echo esc_url(get_theme_mod('pagebuilderly_twitter')); ?>" target="_blank"><i class="fa fa-twitter"></i></a><?php endif; ?>
						<?php if(get_theme_mod('pagebuilderly_instagram')) : ?><a href="<?php echo esc_url(get_theme_mod('pagebuilderly_instagram')); ?>" target="_blank"><i class="fa fa-instagram"></i></a><?php endif; ?>
						<?php if(get_theme_mod('pagebuilderly_youtube')) : ?><a href="<?php echo esc_url(get_theme_mod('pagebuilderly_youtube')); ?>" target="_blank"><i class="fa fa-youtube-play"></i></a><?php endif; ?>					</div>
					</div>
				</nav><!-- #site-navigation -->

				<!-- Header Start -->
				<?php if ( ! is_active_sidebar( 'header_widget_right')  ) : ?>
				<div class="header-no-widget">
				<?php endif; ?>


				<div class="container">
					<div class="header-container">
						<div class="header-content">
							<div class="site-branding">

								<?php
								if ( has_custom_logo() ) {
									pagebuilderly_the_custom_logo();
								}?>
								<span class="site-title">
									<?php bloginfo( 'name' ); ?>
								</span>

								<p class="site-description">
									<?php bloginfo( 'description' ); ?>
								</p>
							</span>
						</div>
					</div>
					<?php if ( is_active_sidebar( 'header_widget_right')  ) : ?>
					<div class="header-image">
						<?php dynamic_sidebar( 'header_widget_right' ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<?php if ( ! is_active_sidebar( 'header_widget_right')  ) : ?>
	</div>
<?php endif; ?>
<!-- Header End -->

</header><!-- #masthead -->

<?php if ( get_theme_mod( 'header_frontpage_only' ) == '' ) : ?>
<?php else : ?>
	<?php if ( !is_front_page() ) : ?>
	<div class="noheader-margins"></div>
<?php endif; ?>
<?php endif; ?>

<?php if ( is_active_sidebar( 'top_widget_left') || is_active_sidebar( 'top_widget_fullwidth') || is_active_sidebar( 'top_widget_middle') ||  is_active_sidebar( 'top_widget_right')  ) : ?>
	<div class="container"> 
		<div class="row">
			<div class="top-widget-wrapper">

				<?php if ( is_active_sidebar( 'top_widget_fullwidth')  ) : ?>
				<div class="top-widget-fullwidth">
					<?php dynamic_sidebar( 'top_widget_fullwidth' ); ?>
				</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'top_widget_left') || is_active_sidebar( 'top_widget_middle') ||  is_active_sidebar( 'top_widget_right')  ) : ?>
			<div class="top-widget-grid">
				<div class="top-widget-single">
					<?php dynamic_sidebar( 'top_widget_left' ); ?>
				</div>
				<div class="top-widget-single">
					<?php dynamic_sidebar( 'top_widget_middle' ); ?>
				</div>
				<div class="top-widget-single">
					<?php dynamic_sidebar( 'top_widget_right' ); ?>
				</div>
			</div>
			
		<?php endif; ?>
	</div>
</div>
</div>
<?php endif; ?>

<div id="content" class="site-content">
