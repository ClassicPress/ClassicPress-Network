<?php

if (!defined('ABSPATH'))
	exit;

class DfdHeaderBuilder_Button extends DfdHeaderBuilderElementAbstract {

	public function render() {
		$preset = DfdHeaderBuilder_PresetCollection::instance()->getActivePreset();
		$text_values = $preset->getGlobalSettingByName("header_button_text_builder");
		$url_values = $preset->getGlobalSettingByName("header_button_url_builder");
		$text = $text_values->value;
		$url_value = $url_values->value;
		echo '<div class="button"><span class="btn_text">'.$text.'</span><a class="btn_href" href='.  esc_url($url_value).'></a></div>';
	}

}
