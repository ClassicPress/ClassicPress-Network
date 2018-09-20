<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$output .= '.woocommerce-account .woocommerce-MyAccount-navigation ul > li.is-active {background: '.$vars['main_site_color'].';}';

$output .= '.woocommerce-account .woocommerce-MyAccount-content > p > a,'
			. '.woocommerce-thankyou-order-received a:hover,'
			. '.woocommerce-thankyou-order-received .button:hover,'
			. '.woocommerce-thankyou-order-received .button.wc-backward:hover,'
			. '.woocommerce-message a:hover,'
			. '.woocommerce-message .button:hover,'
			. '.woocommerce-message .button.wc-backward:hover,'
			. '.woocommerce-error a:hover,'
			. '.woocommerce-error .button:hover,'
			. '.woocommerce-error .button.wc-backward:hover,'
			. '.woocommerce-info a:hover,'
			. '.woocommerce-info .button:hover,'
			. '.woocommerce-info .button.wc-backward:hover {color: '.$vars['main_site_color'].';}';