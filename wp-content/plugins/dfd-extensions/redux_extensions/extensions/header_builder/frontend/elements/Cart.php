<?php

if (!defined('ABSPATH'))
	exit;

class DfdHeaderBuilder_Cart extends DfdHeaderBuilderElementAbstract {

	protected $option_name = "show_cart_header";
	protected $simple = false;

	public function setSimple($value) {
		$this->simple = (bool) $value;
	}

	public function getSimple() {
		return $this->simple;
	}

	public function isActive() {
		$cart_enabled = $this->show_element();
		if ($cart_enabled && class_exists('WooCommerce') && function_exists('dfd_woocommerce_total_cart')) {
			return true;
		}
		return false;
	}

	public function render() {
		if ($this->isActive()) {
			echo dfd_woocommerce_total_cart($this->getSimple());
		}
	}

}
