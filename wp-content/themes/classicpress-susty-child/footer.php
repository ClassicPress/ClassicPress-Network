<?php
/**
 * The template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Susty
 */
?>

	</div>

	<footer id="colophon" role="contentinfo">

		<?php if ( !is_front_page() ) { ?>

			<div class="classic">
				<p>© Copyright 2018 ClassicPress. All Rights Reserved.</br>
				ClassicPress is a company limited by guarantee with registration number 11549088.</p>
			</div>

		<?php } ?>		

			<p><a href="https://www.iubenda.com/privacy-policy/41030260">Privacy Policy</a> | <a href="https://www.iubenda.com/privacy-policy/41030260/cookie-policy">Cookie Policy</a></p>
			<a href="<?php echo esc_url( __( 'https://www.classicpress.net', 'susty' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. ClassicPress. */
				printf( esc_html__( 'Made with ❤ with %s', 'susty' ), 'ClassicPress' );
				?>
			</a>
			<span> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s', 'susty' ), '<a href="https://github.com/jacklenox/susty">Susty</a>', '<a href="https://blog.jacklenox.com">Jack&nbsp;Lenox</a>' );
				?>

	</footer>

</div>

<?php wp_footer(); ?>

</body>
</html>
