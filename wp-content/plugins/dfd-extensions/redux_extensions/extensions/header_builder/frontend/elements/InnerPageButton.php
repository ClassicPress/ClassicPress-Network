<?php
if (!defined('ABSPATH'))
	exit;
class DfdHeaderBuilder_InnerPageButton extends DfdHeaderBuilderElementAbstract {

	public function render() {
		$options = DfdHeaderBuilder_ReduxOptions::instance();
//		$enable = $options->isTopPanelEnabled();
		$enable = true;
		$page_id = $options->geTopPanelPageId();
		if ($enable && !empty($page_id)) {
			echo '<a class="top-inner-page dfd-mobile-header-hide" href="#">'
			. '<span>'
			. '<span></span>'
			. '<span></span>'
			. '<span></span>'
			. '</span>'
			. '</a>';
		}else{
			echo __("not selected inner page","dfd");
		}
	}

}
