<?php
if (!defined('ABSPATH'))
	exit;
class DfdHeaderBuilder_SideArea extends DfdHeaderBuilderElementAbstract {

//	protected $option_name = "header_login";
//	protected $template = "login";

	public function render() {
		$options = DfdHeaderBuilder_ReduxOptions::instance();
//		$side_area_enabled = $options->isSideAreaEnabled();
		$side_area_enabled = true;
		if (($side_area_enabled && !empty($side_area_enabled)) || $this->getUseCheck()) {
			echo '<div class="dfd-click-menu-button-wrap dfd-mobile-header-hide">';
			echo '<div class="dfd-click-menu-activation-button">';
			echo '<a href="#" title="menu" class="dfd-menu-button">';
			echo '<span class="icon-wrap dfd-top-line"></span>';
			echo '<span class="icon-wrap dfd-middle-line"></span>';
			echo '<span class="icon-wrap dfd-bottom-line"></span>';
			echo '</a>';
			echo '</div>';
			echo '</div>';
		}
	}

}
