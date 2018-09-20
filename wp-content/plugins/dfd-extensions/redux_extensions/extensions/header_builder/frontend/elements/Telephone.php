<?php
if (!defined('ABSPATH'))
	exit;
class DfdHeaderBuilder_Telephone extends DfdHeaderBuilderElementAbstract {

	public function render() {
		$preset = DfdHeaderBuilder_PresetCollection::instance()->getActivePreset();
		$values = $preset->getGlobalSettingByName("header_telephone_builder");
		$val = $values->value;
		echo "<span class='telephone-field-builder'>";
		echo $val;
		echo "</span>";
	}

}
