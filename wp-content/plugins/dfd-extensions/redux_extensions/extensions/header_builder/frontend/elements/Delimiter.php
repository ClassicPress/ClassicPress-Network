<?php
if (!defined('ABSPATH'))
	exit;
class DfdHeaderBuilder_Delimiter extends DfdHeaderBuilderElementAbstract {

	public function render() {
		echo '<div class="dfd-header-delimiter"></div>';
	}

}
