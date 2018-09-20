<?php
if (!defined('ABSPATH'))
	exit;
class DfdHeaderBuilder_Logo extends DfdHeaderBuilderElementAbstract {

	public function render() {
		$view = DfdHeader_ViewCollection::instance()->getView();
		echo '<div class="dfd-header-logos">';
		echo '<div class="dfd-logo-wrap">';
		echo '<a href="' . esc_url(home_url()) . '" title="' . esc_attr__('Site logo', 'dfd-native') . '">';
		if ($view == "desktop") {
			$this->getLogoImg();
		} else {
			$this->mobile_logo_html();
		}
		echo '</a>';
		$this->sticky_logo_html();
		echo '</div>';
		echo '</div>';
	}

	protected function getLogoImg($class = 'main-logo') {
		global $dfd_native;
		$logo_sett = DfdHeader_ViewCollection::instance()->getPreset()->getGlobalSettingByName("logo_header_builder");
		$logo_retina_sett = DfdHeader_ViewCollection::instance()->getPreset()->getGlobalSettingByName("retina_logo_header_builder");
		$retina_img = $img = $logos_data_atts="";
		if (is_object($logo_retina_sett)) {
			$logo_retina_val_set="";
			if(is_string($logo_retina_sett->value)){
				$logo_retina_val_set = json_decode($logo_retina_sett->value);
			}
			if (is_object($logo_retina_val_set)) {
				$img_retina_id = $logo_retina_val_set->id;
				$retina_img = wp_get_attachment_image_src($img_retina_id, "full");
			}
		}
		if (is_object($logo_sett)) {
			$logo_val_sett="";
			if(is_string($logo_sett->value)){
				$logo_val_sett = json_decode($logo_sett->value);
			}
			if (is_object($logo_val_sett)) {
				$img_id = $logo_val_sett->id;
				$img = wp_get_attachment_image_src($img_id, "full");
			}
		}
		if ($retina_img && is_array($retina_img)) {
			$retina_img = $retina_img[0];
		}
		if ($img && is_array($img)) {
			$img = $img[0];
		}


		$header_logo = $img;

		$header_logo_retina = $retina_img;

		if (empty($header_logo) && isset($dfd_native['custom_logo_image']['url']) && !empty($dfd_native['custom_logo_image']['url'])) {
			$header_logo = $dfd_native['custom_logo_image']['url'];
		}

		if (empty($header_logo_retina) && isset($dfd_native['custom_retina_logo_image']['url']) && !empty($dfd_native['custom_retina_logo_image']['url'])) {
			$header_logo_retina = $dfd_native['custom_retina_logo_image']['url'];
		}

		if (!empty($header_logo)) {
			if (!empty($header_logo_retina)) {
				$logos_data_atts .= ' data-retina="' . esc_url($header_logo_retina) . '"';
			}

			echo '<img src="' . esc_url($header_logo) . '" class="' . esc_attr($class) . '" alt="' . esc_attr__('Site logo', 'dfd-native') . '" ' . $logos_data_atts . ' />';
		}


		return "";
	}

	private function main_logo_img($class = 'main-logo') {
		global $dfd_native;

		$logos_data_atts = '';

		$header_logo = $this->get_value('logo_header');

		$header_logo_retina = $this->get_value('retina_logo_header');

		if (empty($header_logo['url']) && isset($dfd_native['custom_logo_image']['url']) && !empty($dfd_native['custom_logo_image']['url'])) {
			$header_logo = $dfd_native['custom_logo_image'];
		}

		if (empty($header_logo_retina) && isset($dfd_native['custom_retina_logo_image']['url']) && !empty($dfd_native['custom_retina_logo_image']['url'])) {
			$header_logo_retina = $dfd_native['custom_retina_logo_image'];
		}

		if (isset($header_logo['url']) && !empty($header_logo['url'])) {
			if (isset($header_logo_retina['url']) && !empty($header_logo_retina['url'])) {
				$logos_data_atts .= ' data-retina="' . esc_url($header_logo_retina['url']) . '"';
			}

			echo '<img src="' . esc_url($header_logo['url']) . '" class="' . esc_attr($class) . '" alt="' . esc_attr__('Site logo', 'dfd-native') . '" ' . $logos_data_atts . ' />';
		}
	}

	private function sticky_logo_html() {
		global $dfd_native;

		$sticky_header_logo = $mobile_header_logo = '';

		if (isset($dfd_native['custom_logo_fixed_header']['url']) && !empty($dfd_native['custom_logo_fixed_header']['url'])) {
			$retina_logo_data = '';
			if (isset($dfd_native['custom_retina_logo_fixed_header']['url']) && !empty($dfd_native['custom_retina_logo_fixed_header']['url'])) {
				$retina_logo_data = 'data-retina="' . esc_url($dfd_native['custom_retina_logo_fixed_header']['url']) . '"';
			}
			$sticky_header_logo .= '<img src="' . esc_url($dfd_native['custom_logo_fixed_header']['url']) . '" class="sticky-logo" ' . $retina_logo_data . ' alt="' . esc_attr__('Sticky header logo', 'dfd-native') . '" />';
		}

		echo '<div class="dfd-logo-wrap mobile-sticky-logos sticky-logo-wrap">'
		. '<a href="' . esc_url(home_url()) . '" title="' . esc_attr__('Site logo', 'dfd-native') . '">';
		if ($sticky_header_logo != '') {
			echo $sticky_header_logo;
		} else {
			$this->main_logo_img('sticky-logo');
		}
		echo '</a>';
		echo '</div>';
	}

	private function mobile_logo_html($simple = false) {
		global $dfd_native;

		$mobile_header_logo = '';

		if (isset($dfd_native['mobile_logo_image']['url']) && !empty($dfd_native['mobile_logo_image']['url'])) {
			$retina_logo_data = '';
			if (isset($dfd_native['mobile_retina_logo_image']['url']) && !empty($dfd_native['mobile_retina_logo_image']['url'])) {
				$retina_logo_data = 'data-retina="' . esc_url($dfd_native['mobile_retina_logo_image']['url']) . '"';
			}
			$mobile_header_logo .= '<img src="' . esc_url($dfd_native['mobile_logo_image']['url']) . '" class="main-logo" ' . $retina_logo_data . ' alt="' . esc_attr__('Mobile logo', 'dfd-native') . '" />';
		}
		if ($mobile_header_logo != '') {
			echo $mobile_header_logo;
		} else {
			$this->getLogoImg();
		}

	}

	private function small_logo_img($class = 'main-logo') {
		global $dfd_native;

		$logos_data_atts = '';

		$header_logo = $this->get_value('small_logo_header');

		$header_logo_retina = $this->get_value('small_retina_logo_header');

		if (empty($header_logo['url']) && isset($dfd_native['custom_logo_image']['url']) && !empty($dfd_native['custom_logo_image']['url'])) {
			$header_logo = $dfd_native['custom_logo_image'];
		}

		if (empty($header_logo_retina) && isset($dfd_native['custom_retina_logo_image']['url']) && !empty($dfd_native['custom_retina_logo_image']['url'])) {
			$header_logo_retina = $dfd_native['custom_retina_logo_image'];
		}

		if (isset($header_logo['url']) && !empty($header_logo['url'])) {
			if (isset($header_logo_retina['url']) && !empty($header_logo_retina['url'])) {
				$logos_data_atts .= ' data-retina="' . esc_url($header_logo_retina['url']) . '"';
			}

			echo '<img src="' . esc_url($header_logo['url']) . '" class="' . esc_attr($class) . '" alt="' . esc_attr__('Site logo', 'dfd-native') . '" ' . $logos_data_atts . ' />';
		}
	}

}
