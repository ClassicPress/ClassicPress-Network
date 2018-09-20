<?php
if (!defined('ABSPATH'))
	exit;
class DfdHeaderBuilder_Spacer extends DfdHeaderBuilderElementAbstract {

	public function render() {
		echo '<div class="dfd-header-spacer"></div>';
	}

}
