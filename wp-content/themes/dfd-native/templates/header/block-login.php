<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<div class="login-header">
	<?php if (!is_user_logged_in()): ?>
		<div id="loginModal" class="reveal-modal">
			<?php Dfd_Theme_Helpers::dfd_login_form(''); ?>
		</div>

		<div class="links">
			<a href="<?php echo esc_url( wp_login_url( get_permalink() ) ); ?>" class="drop-login dfd-header-links" data-reveal-id="loginModal">
				<i class="dfd-socicon-login"></i>
				<span><?php echo esc_html__('Login on site','dfd-native'); ?></span>
			</a>
		</div>

		<?php get_template_part('templates/header/block', 'register'); ?>

		<?php get_template_part('templates/header/block', 'lost-password'); ?>
		
	<?php else: ?>

		<div class="links">
			<a href="<?php echo esc_url( wp_logout_url( get_permalink() ) ); ?>" class="dfd-header-links">
				<i class="dfd-socicon-login"></i>
				<span><?php echo esc_html__('Logout','dfd-native'); ?></span>
			</a>
		</div>

	<?php endif; ?>
</div>
