<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/* Default button */
$output .= 'button,'
		. '.button,'
		. 'input[type="submit"],'
		. 'a.added_to_cart {'
				. 'font-family: '.$vars['default_button-font-family'].';'
				. 'font-size: '.$vars['default_button-font-size'].';'
				. 'font-style: '.$vars['default_button-font-style'].';'
				. 'font-weight: '.$vars['default_button-font-weight'].';'
				. 'text-transform: '.$vars['default_button-text-transform'].';'
				. 'line-height: '.$vars['default_button-line-height'].';'
				. 'letter-spacing: '.$vars['default_button-letter-spacing'].';'
				. 'color: '.$vars['default_button-color'].';'
			. '}';

$output .= 'input[type="text"],'
		. 'input[type="password"],'
		. 'input[type="date"],'
		. 'input[type="datetime"],'
		. 'input[type="email"],'
		. 'input[type="number"],'
		. 'input[type="search"],'
		. 'input[type="tel"],'
		. 'input[type="time"],'
		. 'input[type="url"] {'
			. 'height: '. ( (int)$vars['default_button-line-height'] + (int)$vars['default_button_border_width'] * 2 ) .'px;'
			. 'line-height: '. ( (int)$vars['default_button-line-height'] + (int)$vars['default_button_border_width'] * 2 ) .'px;'
		. '}';

$output .= '.single-product .single-product-wishlist-wrap .product-in-wishlist,'
		. '.single-product .single-product-wishlist-wrap .add_to_wishlist,'
		. '.single-product .woocommerce-tabs .tabs.wc-tabs > li,'
		. '.quantity input.qty,'
		. '.woocommerce-MyAccount-navigation ul > li a,'
		. '.woocommerce-MyAccount-content header.title .edit {'
				. 'font-family: '.$vars['default_button-font-family'].';'
				. 'font-size: '.$vars['default_button-font-size'].';'
				. 'font-style: '.$vars['default_button-font-style'].';'
				. 'font-weight: '.$vars['default_button-font-weight'].';'
				. 'text-transform: '.$vars['default_button-text-transform'].';'
				. 'line-height: '.$vars['default_button-line-height'].';'
				. 'letter-spacing: '.$vars['default_button-letter-spacing'].';'
			. '}';

$output .= 'button,'
		. '.button,'
		. 'input[type="submit"] {'
				. 'padding-left: '.$vars['default_button_padding_left'].'px;'
				. 'padding-right: '.$vars['default_button_padding_right'].'px;'
				. 'background: '.$vars['default_button_background'].';'
				. 'border-width: '.$vars['default_button_border_width'].'px;'
				. 'border-style: '.$vars['default_button_border_style'].';'
				. 'border-color: '.$vars['default_button_border'].';'
				. 'border-radius: '.$vars['default_button_border_radius'].'px;'
			. '}';

$output .= 'button:hover,'
		. '.button:hover,'
		. 'input[type="submit"]:hover {'
				. 'color: '.$vars['default_button_hover_color'].';'
				. 'background: '.$vars['default_button_hover_bg'].';'
				. 'border-color: '.$vars['default_button_hover_border'].';'
			. '}';