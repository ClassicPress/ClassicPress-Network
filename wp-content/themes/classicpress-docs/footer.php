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

	<footer id="colophon">
		<a href="<?php echo esc_url( __( 'https://www.classicpress.net', 'susty' ) ); ?>">
			<?php
			/* translators: %s: CMS name, i.e. ClassicPress. */
			printf( esc_html__( 'Proudly powered by %s', 'susty' ), 'ClassicPress' );
			?>
		</a>
		<span> | </span>
			<?php
			/* translators: 1: Theme name, 2: Theme author. */
			printf( esc_html__( 'Theme: %1$s by %2$s.', 'susty' ), '<a href="https://github.com/jacklenox/susty">Susty</a>', '<a href="https://blog.jacklenox.com">Jack&nbsp;Lenox</a>' );
			?>
	</footer>
</div>

<?php wp_footer(); ?>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-124267066-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-124267066-3');
</script>


</body>
</html>
