<?php

if (!function_exists('vc_icon_element_params_override')) {

	function vc_icon_element_params_override() {
		require_once vc_path_dir('CONFIG_DIR', 'content/vc-icon-element.php');
		$params_array = vc_icon_element_params();
		if (empty($params_array['params']) && !is_array($params_array['params'])) {
			return $params_array;
		}
		$merge_dfd_icon = array (
			array (
				'type' => 'iconpicker',
				'heading' => esc_html__('Select Icon ', 'dfd-native'),
				'param_name' => 'icon_dfd_icons',
				'settings' => array (
						'emptyIcon' => false,
						'type' => 'dfd_icons',
						'iconsPerPage' => 400,
				),
				'dependency' => array ('element' => 'type', 'value' => 'dfd_icons'),
				'description' => esc_html__('Select icon from library.', 'dfd-native'),
			)
		);
		foreach ($params_array['params'] as $key => $value) {
			if ($value['param_name'] == "type") {
				$params_array['params'][$key]['value'] = array (
					esc_html__('Standard', 'dfd-native')	=> 'dfd_icons',
					esc_html__('Awesome', 'dfd-native')	=> 'fontawesome',
					esc_html__('Open Iconic', 'dfd-native') => 'openiconic',
					esc_html__('Typicons', 'dfd-native')	=> 'typicons',
					esc_html__('Entypo', 'dfd-native')		=> 'entypo',
					esc_html__('Linecons', 'dfd-native')	=> 'linecons',
				);
			}
		}
		$params_array['params'] = array_merge($params_array['params'], $merge_dfd_icon);
		return $params_array;
	}

}

