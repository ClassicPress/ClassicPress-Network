<?php
if (!defined('ABSPATH'))
	exit;
class DfdHeaderBuilder_SearchButton extends DfdHeaderBuilderElementAbstract {

	protected $option_name = "show_search_form_header";

	public function render() {
		$search_enabled = $this->show_element();

		if ($search_enabled) {
			echo '<div class="form-search-wrap">';
			echo '<a href="#" class="header-search-switcher dfd-socicon-Search"></a>';
			echo '</div>';
		}
	}

}
