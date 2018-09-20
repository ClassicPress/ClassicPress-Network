<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.2
 */

defined( 'ABSPATH' ) || exit;

global $post, $product, $woocommerce, $dfd_native;

$carousel_vertical = '0';

$attachment_ids = array();
if(method_exists($product, 'get_gallery_image_ids')) {
	$attachment_ids = $product->get_gallery_image_ids();
} elseif(method_exists($product, 'get_gallery_attachment_ids')) {
	$attachment_ids = $product->get_gallery_attachment_ids();
}
if(has_post_thumbnail()) {
	$thumbnail_id = get_post_thumbnail_id( $post->ID );
	array_unshift($attachment_ids, $thumbnail_id);
	array_unique($attachment_ids);
}

$thumbs_num = (isset($dfd_native['woo_single_thumb_number']) && !empty($dfd_native['woo_single_thumb_number'])) ? $dfd_native['woo_single_thumb_number'] : 4;

$thumbs_position = (isset($dfd_native['woo_single_thumb_position']) && !empty($dfd_native['woo_single_thumb_position'])) ? $dfd_native['woo_single_thumb_position'] : '';

if(!empty($thumbs_position) && $thumbs_position == 'thumbs-left') {
	$carousel_vertical = '1';
}

if ( $attachment_ids && (!isset($dfd_native['woocommerce_hide_single_thumb']) || $dfd_native['woocommerce_hide_single_thumb'] != '1')) { ?>
	<div class="product-carousel">
		<div class="dfd-single-product-thumbs-carousel flex-control-nav" data-slides="<?php echo esc_attr($thumbs_num) ?>" data-vertical="<?php echo esc_attr($carousel_vertical) ?>">
		<?php
			$loop = 0;
			$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
			
			$lightbox_html = '<div class="hide">';
			
			foreach ( $attachment_ids as $attachment_id ) {
				$classes = array( 'single-product-thumbnail' );

				$image_url   = wp_get_attachment_url($attachment_id);
					
				if ( ! $image_url ) {
					continue;
				}
				
				$image_class = esc_attr( implode( ' ', $classes ) );
				$image_title = esc_attr( get_the_title( $attachment_id ) );
				
				$image_size = wc_get_image_size('shop_single');
				
				$image_link = dfd_aq_resize($image_url, $image_size['width'], $image_size['height'], $image_size['crop'], true, true);
				
				if(!$image_link) {
					$image_link = $image_url;
				}

				$thumb_size = wc_get_image_size('shop_thumbnail');
				
				$img_url = dfd_aq_resize($image_url, $thumb_size['width'], $thumb_size['height'], $thumb_size['crop'], true, true);
				
				if(!$img_url) {
					$img_url = $image_url;
				}
				
				$image = '<img src ="'.esc_url($img_url).'" alt="" />';
				
				echo apply_filters( 'woocommerce_single_product_image_thumbnail_html',
										sprintf(
											'<div class="%s"><a href="%s" title="%s" data-large="%s">%s</a></div>',
											$image_class,
											$image_link, 
											$image_title,
											$image_url,
											$image
										),
										$attachment_id,
										$post->ID,
										$image_class
									);
				
				$loop++;
				
				$thumb_url = wp_get_attachment_image_src($attachment_id, 'thumbnail');
				$thumb_data_attr = '';
				
				if(isset($thumb_url[0]) && !empty($thumb_url[0])) {
					$thumb_data_attr = 'data-thumb="'.esc_url($thumb_url[0]).'"';
				}
				
				if($loop != 1) {
					$lightbox_html .= '<a href="'.esc_url($image_url).'" '.$thumb_data_attr.' data-rel="prettyPhoto[woo_single_gal]"></a>';
				}
			}
			$lightbox_html .= '</div>';
		?>
		</div>
	</div>
	<?php
	echo (!empty($lightbox_html)) ? $lightbox_html : '';
}