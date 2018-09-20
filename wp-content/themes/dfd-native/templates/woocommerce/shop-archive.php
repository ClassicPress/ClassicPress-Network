<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $dfd_native;

$page_class = Dfd_Theme_Helpers::build_shop_archive_class();

/**
 * woocommerce_before_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 */

do_action( 'woocommerce_before_main_content' );

/**
 * woocommerce_archive_description hook.
 *
 * @hooked woocommerce_taxonomy_archive_description - 10
 * @hooked woocommerce_product_archive_description - 10
 */
do_action( 'woocommerce_archive_description' );
?>

<?php if ( have_posts() ) : ?>
	<div class="dfd-woo-category-wrap <?php echo esc_attr($page_class) ?>" <?php echo Dfd_Theme_Helpers::build_shop_archive_data_atts(); ?>>

		<div class="dfd-woo-category">

			<div class="row">
				<div class="six columns">
					<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

						<h2 class="dfd-shop-page-title"><?php woocommerce_page_title(); ?></h2>

					<?php endif; ?>
				</div>
				
				<div class="six columns">
					<?php
						/**
						 * Hook: woocommerce_before_shop_loop.
						 *
						 * @hooked wc_print_notices - 10
						 * @hooked woocommerce_result_count - 20
						 * @hooked woocommerce_catalog_ordering - 30
						 */
						do_action( 'woocommerce_before_shop_loop' );
					?>
				</div>
			</div>

			<?php
			woocommerce_product_loop_start();
			
			if(function_exists('wc_get_loop_prop')) {
				if ( wc_get_loop_prop( 'total' ) ) {
					while ( have_posts() ) {
						the_post();

						/**
						 * Hook: woocommerce_shop_loop.
						 *
						 * @hooked WC_Structured_Data::generate_product_data() - 10
						 */
						do_action( 'woocommerce_shop_loop' );

						wc_get_template_part( 'content', 'product' );
					}
				}
			} else {
				while ( have_posts() ) : the_post();

					/**
					 * Hook: woocommerce_shop_loop.
					 *
					 * @hooked WC_Structured_Data::generate_product_data() - 10
					 */
					do_action( 'woocommerce_shop_loop' );
			
					wc_get_template_part( 'content', 'product' );

				endwhile;
			}

			woocommerce_product_loop_end();

			/**
			 * woocommerce_after_shop_loop hook.
			 *
			 * @hooked woocommerce_pagination - 10
			 */
			do_action( 'woocommerce_after_shop_loop' );
			?>
		</div>

	</div>

	<?php else : ?>

		<?php 
		/**
		 * Hook: woocommerce_no_products_found.
		 *
		 * @hooked wc_no_products_found - 10
		 */
		do_action( 'woocommerce_no_products_found' );
		?>

	<?php endif; ?>

<?php
/**
 * woocommerce_after_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );
?>

<?php
/**
 * woocommerce_sidebar hook.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
//do_action( 'woocommerce_sidebar' );