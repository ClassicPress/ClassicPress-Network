<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*H3*/
for($i = 1; $i < 7; $i++) {
	$output .= 'h'.$i.' {'
					. 'font-family: '.$vars['h'.$i.'-font-family'].';'
					. 'font-size: '.$vars['h'.$i.'-font-size'].';'
					. 'font-style: '.$vars['h'.$i.'-font-style'].';'
					. 'font-weight: '.$vars['h'.$i.'-font-weight'].';'
					. 'text-transform: '.$vars['h'.$i.'-text-transform'].';'
					. 'line-height: '.$vars['h'.$i.'-line-height'].';'
					. 'letter-spacing: '.$vars['h'.$i.'-letter-spacing'].';'
					. 'color: '.$vars['h'.$i.'-color'].';'
				. '}';
}

$output .= '.dfd-content-title-big, .dfd-countdown .number, .dfd-countdown .dot,'
		. '#layout.single-post .dfd-content-wrap.dfd-post_single > article.post.format-audio > .cover h3.entry-title,'
		. '.dfd-audio-box .pp_fade #pp_full_res .pp_audio_container h3.entry-title,'
		. '.dfd-related-posts-wrap article.post h3.entry-title,'
		. '.pp_details .ppt,'
		. '.woocommerce-page #reviews .comment-text .meta strong,'
		. '.products.upsells h2,'
		. '.products.related h2,'
		. '.single-product .cart .reset_variations,'
		. '.dfd-hotspot-shortcode .HotspotPlugin_Hotspot > div > .Hotspot_Title {'
				. 'font-family: '.$vars['content_title_big-font-family'].';'
				. 'font-size: '.$vars['content_title_big-font-size'].';'
				. 'font-style: '.$vars['content_title_big-font-style'].';'
				. 'font-weight: '.$vars['content_title_big-font-weight'].';'
				. 'text-transform: '.$vars['content_title_big-text-transform'].';'
				. 'line-height: '.$vars['content_title_big-line-height'].';'
				. 'letter-spacing: '.$vars['content_title_big-letter-spacing'].';'
				. 'color: '.$vars['content_title_big-color'].';'
			. '}';

$output .= '.form-search-section input[type="text"] {'.
				'font-family: '.$vars['content_title_big-font-family'].';'.
			'}'.
			'.form-search-section ::-webkit-input-placeholder {'.
				'font-family: '.$vars['content_title_big-font-family'].';'.
			'}'.
			'.form-search-section :-moz-placeholder {'.
				'font-family: '.$vars['content_title_big-font-family'].';'.
			'}'.
			'.form-search-section ::-moz-placeholder {'.
				'font-family: '.$vars['content_title_big-font-family'].';'.
			'}'.
			'.form-search-section :-ms-input-placeholder {'.
				'font-family: '.$vars['content_title_big-font-family'].';'.
			'}';

$output .= '.dfd-content-title-small,'
		. '.sort-panel .filter a,'
		. '.dfd-single-pagination .dfd-controler,'
		. '.dfd-single-item-bottom .post-like,'
		. '#respond label,'
		. '.comment-edit-link,'
		. '.comment-reply-link, blockquote .slug,'
		. '.widget_shopping_cart .mini-cart-quantity, .shopping-cart-box .mini-cart-quantity,'
		. '.widget_shopping_cart p.total, .shopping-cart-box p.total,'
		. '.dfd-share-title,'
		. '.share-count,'
		. 'a.pp_next > i > span.count,'
		. 'a.pp_previous > i > span.count,'
		. '.woocommerce-account form.login .lost_password,'
		. '.woocommerce-account  table thead tr th,'
		. '.woocommerce-page #reviews #review_form #respond form label,'
		. '.post-password-form p label,'
		. '.dfd-portfolio-module.layout-fullscreen .dfd-swiper-pagination .dfd-swiper-pagination-bullet,'
		. '.dfd-gallery-module.layout-fullscreen .dfd-swiper-pagination .dfd-swiper-pagination-bullet,'
		. 'blockquote cite,'
		. '.dfd-textmodule-blockquote cite,'
		. '#layout.single-post .quote-content cite {'
				. 'font-family: '.$vars['content_title_small-font-family'].';'
				. 'font-size: '.$vars['content_title_small-font-size'].';'
				. 'font-style: '.$vars['content_title_small-font-style'].';'
				. 'font-weight: '.$vars['content_title_small-font-weight'].';'
				. 'text-transform: '.$vars['content_title_small-text-transform'].';'
				. 'line-height: '.$vars['content_title_small-line-height'].';'
				. 'letter-spacing: '.$vars['content_title_small-letter-spacing'].';'
				. 'color: '.$vars['content_title_small-color'].';'
			. '}';

$output .= '.yith-wcwl-message,'
		. '.onsale {'
				. 'font-family: '.$vars['content_title_small-font-family'].';'
				. 'font-size: '.$vars['content_title_small-font-size'].';'
				. 'font-style: '.$vars['content_title_small-font-style'].';'
				. 'font-weight: '.$vars['content_title_small-font-weight'].';'
				. 'text-transform: '.$vars['content_title_small-text-transform'].';'
				. 'letter-spacing: '.$vars['content_title_small-letter-spacing'].';'
			. '}';

$output .= '.dfd-content-subtitle,'
		. '.widget_shopping_cart .widget_shopping_cart_content ul.cart_list .variation,'
		. '.shopping-cart-box .widget_shopping_cart_content ul.cart_list .variation,'
		. '.pp_details .pp_description,'
		. '#cancel-comment-reply-link,'
		. 'form label abbr,'
		. '.dfd-button-module-wrap .dfd-button-tooltip,'
		. '.logged-in-as,'
		. '.comment-notes {'
				. 'font-family: '.$vars['content_subtitle-font-family'].';'
				. 'font-size: '.$vars['content_subtitle-font-size'].';'
				. 'font-style: '.$vars['content_subtitle-font-style'].';'
				. 'font-weight: '.$vars['content_subtitle-font-weight'].';'
				. 'text-transform: '.$vars['content_subtitle-text-transform'].';'
				. 'line-height: '.$vars['content_subtitle-line-height'].';'
				. 'letter-spacing: '.$vars['content_subtitle-letter-spacing'].';'
				. 'color: '.$vars['content_subtitle-color'].';'
			. '}';