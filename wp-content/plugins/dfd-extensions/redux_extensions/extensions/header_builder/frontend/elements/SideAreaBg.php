<?php
if (!defined('ABSPATH'))
	exit;
class DfdHeaderBuilder_SideAreaBg extends DfdHeaderBuilderElementAbstract {

//	protected $option_name = "header_login";
//	protected $template = "login";

	public function render() {
		$side_area = DfdHeaderBuilder_ReduxOptions::instance()->isSideAreaEnabled();
		if ($side_area && !empty($side_area)) {

			get_template_part('templates/side-area');

		}
	}

}
