<?php

if (!defined('ABSPATH'))
	exit;

class DfdHeaderBuilder_WishList extends DfdHeaderBuilderElementAbstract {

	protected $option_name = "show_wishlist_header";

	public function isActive() {
		if (!defined('YITH_WCWL')) {
			return false;
		}
		$wishlist_enabled = $this->show_element();

		if ($wishlist_enabled && class_exists('WooCommerce') && function_exists('dfd_wishlist_button')) {
			return true;
		}
		return false;
	}

	public function render() {
		if ($this->isActive()) {
			echo dfd_wishlist_button();
		}
	}

}
