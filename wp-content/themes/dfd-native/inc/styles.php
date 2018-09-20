<?php
/*
 * Backgrounds
 */
global $dfd_native;
$output = '';

require(get_template_directory().'/inc/variables_less.php');

foreach(glob(get_template_directory().'/inc/dynamic_styles/*.php') as $styles) {
	require_once($styles);
}

$output .= '.dfd-color-main,'
		. '#respond form a:hover,'
		. '#cancel-comment-reply-link:hover,'
		. '.wpb_text_column a:not(.quote-content):not(.dfd-post-link-url):not(.fn):not(.dfd-post-link-title):not(.dk_toggle),'
		. '.dfd-content-wrap:not(.dfd-post_single) article.post.sticky > .cover h3.entry-title,'
		. '.dfd-posts-module:not(.dfd-post_single) article.post.sticky > .cover h3.entry-title {color: '.$vars['main_site_color'].';}';

$output .= '.dfd-background-main,'
		. '.total_cart_header .woo-cart-contents .woo-cart-details:before,'
		. '.products .product .woo-cover .wishlist-button-wrap:hover,'
		. '.wpb_text_column > div > ul li:before,'
		. '.wpb_text_column > p > ul li:before,'
		. '.wpb_text_column > ul li:before,'
		. '#layout.dfd-default-template .dfd-content-wrap > p > ul > li:before,'
		. '#layout.dfd-default-template .dfd-content-wrap > ul > li:before {background: '.$vars['main_site_color'].';}';

$output .= 'input[type="checkbox"]:hover:before {border-color: '.$vars['third_site_color'].';}';

$output .=	'input[type="checkbox"]:checked:before {'
				.'border-color: '.$vars['third_site_color'].';'
				.'background: '.$vars['third_site_color'].';'
			.'}';

$output .= '.sort-panel:not(.advanced) .filter > li.active:before,'
		. '.sort-panel:not(.advanced) .filter > li.active:before {border-color: '.$vars['main_site_color'].';}';

$output .= '.dfd-color-second {color: '.$vars['secondary_site_color'].';}';

$output .= '.dfd-background-second {background: '.$vars['secondary_site_color'].';}';

$output .= '.dfd-color-third {color: '.$vars['third_site_color'].';}';

$output .= '.dfd-background-third,'
		. 'body.checkout #main-content .dfd-content-wrap > .woocommerce .dfd-login-wrap form.login > .clear + .form-row .button {background: '.$vars['third_site_color'].';}';

/*base typography*/
$output .= 'body, dd, div, dl, dt, form, li, ol, p, pre, td, th, ul,'
		. '#shipping_method li label,'
		. 'body.checkout #main-content .dfd-content-wrap > .woocommerce .checkout.woocommerce-checkout #order_review #payment .payment_methods > li label,'
		. '.woocommerce-page table.shop_attributes td,'
		. '.login-header p.login-remember label,'
		. 'body.woocommerce-order-received ul li strong,'
		. 'body.woocommerce-order-received .shop_table:not(.customer_details) tfoot tr:nth-child(2) th,'
		. 'body.woocommerce-order-received .shop_table:not(.customer_details) tfoot tr:nth-child(3) th,'
		. 'body.woocommerce-order-received .shop_table:not(.customer_details) tfoot tr:nth-child(3) td,'
		. 'body.woocommerce-order-received .shop_table:not(.customer_details) tbody tr td.product-name,'
		. 'body.woocommerce-order-received #main-content .wc-bacs-bank-details-heading + h3 {'
				. 'font-family: '.$vars['default_text-font-family'].';'
				. 'font-size: '.$vars['default_text-font-size'].';'
				. 'font-style: '.$vars['default_text-font-style'].';'
				. 'font-weight: '.$vars['default_text-font-weight'].';'
				. 'text-transform: '.$vars['default_text-text-transform'].';'
				. 'line-height: '.$vars['default_text-line-height'].';'
				. 'letter-spacing: '.$vars['default_text-letter-spacing'].';'
				. 'color: '.$vars['default_text-color'].';'
			. '}';

/*Featured decoration*/
$output .= 'em.dfd-textmodule-featured-decoration {'
				. 'font-family: '.$vars['featured_decoration-font-family'].';'
				. 'font-size: '.$vars['featured_decoration-font-size'].';'
				. 'font-style: '.$vars['featured_decoration-font-style'].';'
				. 'font-weight: '.$vars['featured_decoration-font-weight'].';'
				. 'text-transform: '.$vars['featured_decoration-text-transform'].';'
				. 'line-height: '.$vars['featured_decoration-line-height'].';'
				. 'letter-spacing: '.$vars['featured_decoration-letter-spacing'].';'
				. 'color: '.$vars['featured_decoration-color'].';'
			. '}';

/*Meta*/
$output .= '.entry-meta,'
		. '.widget_recent_entries ul li .post-date,'
		. '.audioplayer-time,'
		. '.woocommerce-page #reviews #comments ol.commentlist li .comment_container .comment-text .meta time,'
		. '.widget_recent_reviews li .reviewer,'
		. '.widget_display_replies li div {'
				. 'font-family: '.$vars['meta-font-family'].';'
				. 'font-size: '.$vars['meta-font-size'].';'
				. 'font-style: '.$vars['meta-font-style'].';'
				. 'font-weight: '.$vars['meta-font-weight'].';'
				. 'text-transform: '.$vars['meta-text-transform'].';'
				. 'line-height: '.$vars['meta-line-height'].';'
				. 'letter-spacing: '.$vars['meta-letter-spacing'].';'
				. 'color: '.$vars['meta-color'].';'
			. '}';

/*widgets*/
$output .= 'h3.widget-title,'
		. '.widget_calendar .calendar_wrap #wp-calendar thead th,'
		. '.widget_top_rated_products .product_summary .woocommerce-Price-amount,'
		. '.widget_recently_viewed_products .product_summary .woocommerce-Price-amount,'
		. '.widget_products .product_summary .woocommerce-Price-amount,'
		. '#ui-datepicker-div.ui-datepicker.ui-widget.ui-widget-content.ui-helper-clearfix.ui-corner-all .ui-datepicker-calendar thead th,'
		. '.shopping-cart-box .widget_shopping_cart_content ul.cart_list li .mini-cart-content, mini-cart-quantity {'
				. 'font-family: '.$vars['widget_title-font-family'].';'
				. 'font-size: '.$vars['widget_title-font-size'].';'
				. 'font-style: '.$vars['widget_title-font-style'].';'
				. 'font-weight: '.$vars['widget_title-font-weight'].';'
				. 'text-transform: '.$vars['widget_title-text-transform'].';'
				. 'line-height: '.$vars['widget_title-line-height'].';'
				. 'letter-spacing: '.$vars['widget_title-letter-spacing'].';'
				. 'color: '.$vars['widget_title-color'].';'
			. '}';

$output .= '.dfd-widget-post-title,'
		. '.widget_recent_entries ul li a,'
		. '.widget_rss ul li .rsswidget,'
		. '.widget_recently_viewed_products .product_summary a,'
		. '.widget_recent_reviews li > a,'
		. '.widget_top_rated_products li .product_summary a,'
		. '.widget_products li .product_summary a,'
		. '.widget_shopping_cart .widget_shopping_cart_content ul.cart_list li a,'
		. '.shopping-cart-box .widget_shopping_cart_content ul.cart_list li a {'
				. 'font-family: '.$vars['widget_post_title-font-family'].';'
				. 'font-size: '.$vars['widget_post_title-font-size'].';'
				. 'font-style: '.$vars['widget_post_title-font-style'].';'
				. 'font-weight: '.$vars['widget_post_title-font-weight'].';'
				. 'text-transform: '.$vars['widget_post_title-text-transform'].';'
				. 'line-height: '.$vars['widget_post_title-line-height'].';'
				. 'letter-spacing: '.$vars['widget_post_title-letter-spacing'].';'
				. 'color: '.$vars['widget_post_title-color'].';'
			. '}';

$output .= '.dfd-widget-content-title,'
		. '.widget_calendar .calendar_wrap #wp-calendar caption,'
		. '.widget_calendar .calendar_wrap #wp-calendar tbody td,'
		. '.widget_tag_cloud .tagcloud a, .widget_product_tag_cloud a,'
		. '.widget_archive ul li, .widget_categories ul li,'
		. '.widget_categories .has-sub-category > a,'
		. '.widget_nav_menu .menu .sub-nav-item.has-submenu > a,'
		. '.widget_nav_menu .menu .nav-item.has-submenu > a,'
		. '.widget_pages ul .page_item.page_item_has_children > a,'
		. '.dfd-single-tags a,'
		. '.widget_dfd_tags .tags-widget a,'
		. '.single-product .product_meta .tagged_as a,'
		. 'body.checkout #main-content .woocommerce form p label,'
		. '.single-product .cart table.variations tr td.label,'
		. '.single-product .cart table.variations tr td.label label,'
		. '#ui-datepicker-div.ui-datepicker.ui-widget.ui-widget-content.ui-helper-clearfix.ui-corner-all .ui-datepicker-title,'
		. '#ui-datepicker-div.ui-datepicker.ui-widget.ui-widget-content.ui-helper-clearfix.ui-corner-all .ui-datepicker-calendar tbody td,'
		. '.woocommerce-account.woocommerce-page form label {'
				. 'font-family: '.$vars['widget_content_title-font-family'].';'
				. 'font-size: '.$vars['widget_content_title-font-size'].';'
				. 'font-style: '.$vars['widget_content_title-font-style'].';'
				. 'font-weight: '.$vars['widget_content_title-font-weight'].';'
				. 'text-transform: '.$vars['widget_content_title-text-transform'].';'
				. 'line-height: '.$vars['widget_content_title-line-height'].';'
				. 'letter-spacing: '.$vars['widget_content_title-letter-spacing'].';'
				. 'color: '.$vars['widget_content_title-color'].';'
			. '}';

$output .= '.dfd-widget-comment-title,'
		. '.widget_rss ul li .rss-date,'
		. '.widget_rss ul li cite,'
		. '.widget_recent_comments .recentcomments .comment-author-link,'
		. '.widget_recent_comments .recentcomments a,'
		. '.widget_recent_comments .recentcomments,'
		. '.widget_display_replies li {'
				. 'font-family: '.$vars['widget_comment_title-font-family'].';'
				. 'font-size: '.$vars['widget_comment_title-font-size'].';'
				. 'font-style: '.$vars['widget_comment_title-font-style'].';'
				. 'font-weight: '.$vars['widget_comment_title-font-weight'].';'
				. 'text-transform: '.$vars['widget_comment_title-text-transform'].';'
				. 'line-height: '.$vars['widget_comment_title-line-height'].';'
				. 'letter-spacing: '.$vars['widget_comment_title-letter-spacing'].';'
				. 'color: '.$vars['widget_comment_title-color'].';'
			. '}';

$output .= '.dfd-widget-list-content,'
		. '.widget_akismet_widget .a-stats a strong span,'
		. '.widget_archive ul li a,'
		. '.widget_categories ul li a,'
		. '.widget_nav_menu .menu .nav-item a,'
		. '.widget_nav_menu .menu .nav-item,'
		. '.widget_nav_menu .menu .nav-item .sub-nav .mega-menu-item,'
		. '.widget_pages ul .page_item,'
		. '.widget_meta ul li,'
		. '.widget_akismet_widget .a-stats a,'
		. '.widget_archive ul li,'
		. '.widget_categories ul li,'
		. '.widget_layered_nav_filters li,'
		. 'body.checkout #main-content .dfd-content-wrap > .woocommerce .dfd-login-wrap form.login .lost_password a,'
		. '.woocommerce-thankyou-order-received a,'
		. '.woocommerce-thankyou-order-received .button,'
		. '.woocommerce-thankyou-order-received .button.wc-backward,'
		. '.woocommerce-message a, .woocommerce-message .button,'
		. '.woocommerce-message .button.wc-backward,'
		. '.woocommerce-error a, .woocommerce-error .button,'
		. '.woocommerce-error .button.wc-backward, .woocommerce-info a,'
		. '.woocommerce-info .button, .woocommerce-info .button.wc-backward,'
		. 'body.checkout #main-content .dfd-content-wrap > .woocommerce .checkout.woocommerce-checkout #order_review #payment .payment_methods .payment_method_paypal label a,'
		. '.widget_product_categories .cat-item,'
		. '.widget_layered_nav .wc-layered-nav-term,'
		. 'body.checkout #main-content .dfd-content-wrap > .woocommerce .checkout.woocommerce-checkout h3#ship-to-different-address label,'
		. '#bbpress-forums #bbp-single-user-details #bbp-user-navigation li {'
				. 'font-family: '.$vars['widget_list_content-font-family'].';'
				. 'font-size: '.$vars['widget_list_content-font-size'].';'
				. 'font-style: '.$vars['widget_list_content-font-style'].';'
				. 'font-weight: '.$vars['widget_list_content-font-weight'].';'
				. 'text-transform: '.$vars['widget_list_content-text-transform'].';'
				. 'line-height: '.$vars['widget_list_content-line-height'].';'
				. 'letter-spacing: '.$vars['widget_list_content-letter-spacing'].';'
				. 'color: '.$vars['widget_list_content-color'].';'
			. '}';

$output .= '.dfd-widget-big-title,'
		. 'h3.entry-title.dfd-widget-big-title {'
				. 'font-family: '.$vars['widget_big_title-font-family'].';'
				. 'font-size: '.$vars['widget_big_title-font-size'].';'
				. 'font-style: '.$vars['widget_big_title-font-style'].';'
				. 'font-weight: '.$vars['widget_big_title-font-weight'].';'
				. 'text-transform: '.$vars['widget_big_title-text-transform'].';'
				. 'line-height: '.$vars['widget_big_title-line-height'].';'
				. 'letter-spacing: '.$vars['widget_big_title-letter-spacing'].';'
				. 'color: '.$vars['widget_big_title-color'].';'
			. '}';

$output .= '.dfd-form-heading {'
				. 'font-family: '.$vars['form_heading-font-family'].';'
				. 'font-size: '.$vars['form_heading-font-size'].';'
				. 'font-style: '.$vars['form_heading-font-style'].';'
				. 'font-weight: '.$vars['form_heading-font-weight'].';'
				. 'text-transform: '.$vars['form_heading-text-transform'].';'
				. 'line-height: '.$vars['form_heading-line-height'].';'
				. 'letter-spacing: '.$vars['form_heading-letter-spacing'].';'
				. 'color: '.$vars['form_heading-color'].';'
			. '}';

$output .= 'blockquote, .dfd-textmodule-blockquote, #layout.single-post .quote-content {'
				. 'font-family: '.$vars['quote-font-family'].';'
				. 'font-size: '.$vars['quote-font-size'].';'
				. 'font-style: '.$vars['quote-font-style'].';'
				. 'font-weight: '.$vars['quote-font-weight'].';'
				. 'text-transform: '.$vars['quote-text-transform'].';'
				. 'line-height: '.$vars['quote-line-height'].';'
				. 'letter-spacing: '.$vars['quote-letter-spacing'].';'
				. 'color: '.$vars['quote-color'].';'
			. '}';

/* Category typo */
$output .= '.dfd-content-wrap article.post .entry-thumb .byline.category,'
		. '.dfd-content-wrap article.post .entry-content .byline.category,'
		. 'div.page-title-inner .dfd-mini-categories .byline.category,'
		. '.dfd-content-wrap article.dfd-portfolio .entry-thumb .byline.category,'
		. '.dfd-content-wrap article.dfd-gallery .entry-thumb .byline.category,'
		. '.dfd-content-wrap article.dfd-portfolio_archive .entry-thumb .byline.category,'
		. '.dfd-content-wrap article.dfd-gallery_archive .entry-thumb .byline.category,'
		. '.dfd-single-categories a.fn,'
		. '.dfd-product-category-module .dfd-product-category-module-wrap .content-wrap .byline.category {'
				. 'font-family: '.$vars['blog_category-font-family'].';'
				. 'font-size: '.$vars['blog_category-font-size'].';'
				. 'font-style: '.$vars['blog_category-font-style'].';'
				. 'font-weight: '.$vars['blog_category-font-weight'].';'
				. 'text-transform: '.$vars['blog_category-text-transform'].';'
				. 'line-height: '.$vars['blog_category-line-height'].';'
				. 'letter-spacing: '.$vars['blog_category-letter-spacing'].';'
				. 'color: '.$vars['blog_category-color'].';'
			. '}';

/* Blockquote responsive typo */
if((int) $vars['quote-font-size'] > 26) {
	$output .= '@media only screen and (max-width: 400px) {'
					. 'blockquote,'
					. '.dfd-textmodule-blockquote,'
					. '#layout.single-post .quote-content {'
						. 'font-size: '. (int) $vars['quote-font-size'] / 1.55 .'px;'
						. 'line-height: 1.5;'
						. 'letter-spacing: 0;'
					. '}'
				. '}';
}

$output .= '.page-nav .dfd-pagination,'
		. '.dfd-single-inside-paginated-wrap .dfd-single-nav-links > * {'
				. 'font-family: '.$vars['pagination-font-family'].';'
				. 'font-size: '.$vars['pagination-font-size'].';'
				. 'font-style: '.$vars['pagination-font-style'].';'
				. 'font-weight: '.$vars['pagination-font-weight'].';'
				. 'text-transform: '.$vars['pagination-text-transform'].';'
				. 'line-height: '.$vars['pagination-line-height'].';'
				. 'letter-spacing: '.$vars['pagination-letter-spacing'].';'
				. 'color: '.$vars['pagination-color'].';'
			. '}';

$output .= '.dfd-logo-carousel-wrap.style-3 .dfd-logo-carousel-item .thumb-wrap .thumb-wrap-back {'
				. 'background: '.$vars['main_site_color'].';'
			. '}';

if (isset($dfd_native['wrapper_bg_color']) && $dfd_native['wrapper_bg_color']) {
    $output .= '#change_wrap_div{ background-color: '.esc_attr($dfd_native['wrapper_bg_color']).' !important; }';
}
if (isset($dfd_native['wrapper_bg_image']['url']) && $dfd_native['wrapper_bg_image']['url']) {
    $output .= '#change_wrap_div{ background-image: url("'.esc_url($dfd_native['wrapper_bg_image']['url']).'") !important; } ';
}
if (isset($dfd_native['wrapper_custom_repeat']) && $dfd_native['wrapper_custom_repeat']) {
    $output .= '#change_wrap_div{ background-repeat: '.esc_attr($dfd_native['wrapper_custom_repeat']).' !important; }';
}

// body
if (isset($dfd_native['body_bg_color']) && $dfd_native['body_bg_color']) {
    $output .= 'body{ background-color: '.esc_attr($dfd_native['body_bg_color']).' !important; }';
}
if (isset($dfd_native['body_bg_image']['url']) && $dfd_native['body_bg_image']['url']) {
    $output .= 'body{ background-image: url("'.esc_url($dfd_native['body_bg_image']['url']).'") !important; }';
}
if (isset($dfd_native['body_custom_repeat']) && $dfd_native['body_custom_repeat']) {
    $output .= 'body{ background-repeat: '.esc_attr($dfd_native['body_custom_repeat']).' !important; }';
}
if (isset($dfd_native['body_bg_fixed']) && $dfd_native['body_bg_fixed']) {
    $output .= 'body{ background-attachment: fixed !important; } ';
}

// footer
if (isset($dfd_native['footer_bg_color']) && $dfd_native['footer_bg_color']) {
    $output .= '#footer{ background-color: '.esc_attr($dfd_native['footer_bg_color']).'} ';
}
if (isset($dfd_native['footer_bg_image']['url']) && $dfd_native['footer_bg_image']['url']) {
    $output .= '#footer{ background-image: url("'.esc_url($dfd_native['footer_bg_image']['url']).'")} ';
}
if (isset($dfd_native['footer_custom_repeat']) && $dfd_native['footer_custom_repeat']) {
    $output .= '#footer{ background-repeat: '.esc_attr($dfd_native['footer_custom_repeat']).'} ';
}

// sub footer
if (isset($dfd_native['sub_footer_bg_color']) && $dfd_native['sub_footer_bg_color']){
    $output .= '#sub-footer { background-color: '.esc_attr($dfd_native['sub_footer_bg_color']).' !important; } ';
}
if (isset($dfd_native['sub_footer_bg_image']['url']) && $dfd_native['sub_footer_bg_image']['url']){
    $output .= '#sub-footer { background-image: url("'.esc_url($dfd_native['sub_footer_bg_image']['url']).'") !important; } ';
}

if (isset($dfd_native['sub_footer_custom_repeat']) && $dfd_native['sub_footer_custom_repeat']){
    $output .= '#sub-footer { background-repeat: '.esc_attr($dfd_native['sub_footer_custom_repeat']).' !important; } ';
}

if (
	isset($dfd_native['woo_products_hover_mask_style']) &&
	strcmp($dfd_native['woo_products_hover_mask_style'],'gradient') !== 0 &&
	isset($dfd_native['woo_products_hover_bg']) &&
	$dfd_native['woo_products_hover_bg']
){
	$output .= '.dfd-products-style-3 .products .product .woo-cover:before {'
				. 'background:'.esc_attr($dfd_native['woo_products_hover_bg']).';'
			. '}';
}

if(isset($dfd_native['woo_products_hover_bg_opacity']) && !empty($dfd_native['woo_products_hover_bg_opacity'])) {
	$output .= '.dfd-products-style-3 .products .product:hover .woo-cover:before {'
				. 'opacity:'.esc_attr($dfd_native['woo_products_hover_bg_opacity']/100).';'
			. '}';
}

if (
	isset($dfd_native['woo_products_hover_mask_style']) &&
	strcmp($dfd_native['woo_products_hover_mask_style'],'gradient') === 0 &&
	isset($dfd_native['woo_products_hover_bg_gradient']) &&
	$dfd_native['woo_products_hover_bg_gradient']
){
    $output .= '.dfd-products-style-3 .products .product .woo-cover:before {'
			. $opacity_css
			. 'background: -webkit-linear-gradient(left, '.esc_attr($dfd_native['woo_products_hover_bg_gradient']['from']).','.esc_attr($dfd_native['woo_products_hover_bg_gradient']['to']).') !important;'
			. 'background: -moz-linear-gradient(left, '.esc_attr($dfd_native['woo_products_hover_bg_gradient']['from']).','.esc_attr($dfd_native['woo_products_hover_bg_gradient']['to']).') !important;'
			. 'background: -o-linear-gradient(left, '.esc_attr($dfd_native['woo_products_hover_bg_gradient']['from']).','.esc_attr($dfd_native['woo_products_hover_bg_gradient']['to']).') !important;'
			. 'background: -ms-linear-gradient(left, '.esc_attr($dfd_native['woo_products_hover_bg_gradient']['from']).','.esc_attr($dfd_native['woo_products_hover_bg_gradient']['to']).') !important;'
			. 'background: linear-gradient(left, '.esc_attr($dfd_native['woo_products_hover_bg_gradient']['from']).','.esc_attr($dfd_native['woo_products_hover_bg_gradient']['to']).') !important;'
		. '}';
}

/*
 * Custom CSS
 */
$output .= isset($dfd_native['custom_css']) ? wp_strip_all_tags($dfd_native['custom_css']) : '';

echo !empty( $output ) ? $output : '';