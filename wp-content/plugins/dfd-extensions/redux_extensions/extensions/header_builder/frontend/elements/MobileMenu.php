<?php
if (!defined('ABSPATH'))
	exit;
class DfdHeaderBuilder_MobileMenu extends DfdHeaderBuilderElementAbstract {

	public function render() {
		echo '<div class="dl-menuwrapper">';
		echo '<a href="#sidr" class="dl-trigger icon-mobile-menu mobile-menu">';
		echo '<span class="icon-wrap dfd-middle-line"></span>';
		echo '<span class="icon-wrap dfd-top-line"></span>';
		echo '<span class="icon-wrap dfd-bottom-line"></span>';
		echo '</a>';
		echo '</div>';
//		$this->init_mobile_menu();
	}

	

}
