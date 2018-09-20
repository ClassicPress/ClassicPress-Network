<?php

if (!defined('ABSPATH')) {
	exit;
}

class Dfd_OneIcon {

	public $can_use = true;
	
	public $options = array (
				'icon_type' => 'selector',
				'icon' => '',
				'icon_img' => '',
				'img_width' => '48',
				'icon_size' => '32',
				'icon_color' => '#333333',
				'icon_style' => 'none',
				'icon_color_bg' => '#ffffff',
				'icon_color_border' => '#333333',
				'icon_border_style' => '',
				'icon_border_size' => '1',
				'icon_border_radius' => '50',
				'icon_border_spacing' => '50',
				'icon_link' => '',
				'icon_animation' => '',
				'tooltip_disp' => '',
				'tooltip_text' => '',
				'module_animation' => '',
				'el_class' => '',
				'icon_align' => 'center'
	);
	
	
	public function __construct($options=array()) {
		if (!function_exists('vc_build_link')) {
			$this->can_use = false;
			return false;
		}
		$this->prepare($options);
		
	}
	public function prepare($options) {
		foreach ($this->options as $key => $value) {
			if(array_key_exists($key, $options)){
				if($options[$key]){
					$this->options[$key] = $options[$key];
				}
			}
		}
	}
	public function toHtml() {
		if(!$this->can_use) { return false; }
		$icon_type = $module_animation = $icon_img = $img_width = $icon = $icon_color = $icon_color_bg = $icon_size = $icon_style = $icon_border_style = $icon_border_radius = $icon_color_border = $icon_border_size = $icon_border_spacing = $icon_link = $el_class = $icon_animation = $tooltip_disp = $tooltip_text = $icon_align = '';
		extract($this->options);

		$output = $style = $link_sufix = $link_prefix = $target = $href = $icon_align_style = '';
		if ($icon_link !== '') {
			$href = vc_build_link($icon_link);
			$target = (isset($href['target'])) ? "target='" . esc_attr(preg_replace('/\s+/', '', $href['target'])) . "'" : '';
			$link_prefix .= '<a class="aio-tooltip" href = "' . esc_url($href['url']) . '" ' . $target . ' data-toggle="tooltip" data-placement="' . esc_attr($tooltip_disp) . '" title="' . esc_attr($tooltip_text) . '">';
			$link_sufix .= '</a>';
		} else {
			if ($tooltip_disp !== "") {
				$link_prefix .= '<div class="aio-tooltip" href = "' . esc_url($href) . '" ' . $target . ' data-toggle="tooltip" data-placement="' . esc_attr($tooltip_disp) . '" title="' . esc_attr($tooltip_text) . '">';
				$link_sufix .= '</div>';
			}
		}

		/* position fix */
		if ($icon_align == 'right') {
			$icon_align_style .= 'text-align: right;';
		} elseif ($icon_align == 'center') {
			$icon_align_style .= 'text-align: center;';
		} elseif ($icon_align == 'left') {
			$icon_align_style .= 'text-align: left;';
		}

		if ($icon_type == 'custom') {
			$img = wp_get_attachment_image_src($icon_img, 'large');
			$alt = get_post_meta($icon_img, '_wp_attachment_image_alt', true);

			$animate = $animation_data = '';

			if (!( $module_animation == '' )) {
				$animate = ' cr-animate-gen';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}

			if ($icon_style !== 'none') {
				if ($icon_color_bg !== '')
					$style .= 'background:' . esc_attr($icon_color_bg) . ';';
			}
			if ($icon_style == 'circle') {
				$el_class.= ' uavc-circle ';
			}
			if ($icon_style == 'square') {
				$el_class.= ' uavc-square ';
			}
			if ($icon_style == 'advanced' && $icon_border_style !== '') {
				$style .= 'border-style:' . esc_attr($icon_border_style) . ';';
				$style .= 'border-color:' . esc_attr($icon_color_border) . ';';
				$style .= 'border-width:' . esc_attr($icon_border_size) . 'px;';
				$style .= 'padding:' . esc_attr($icon_border_spacing) . 'px;';
				$style .= 'border-radius:' . esc_attr($icon_border_radius) . 'px;';
			}
			if (!empty($img[0])) {
				if ($icon_link == '' || $icon_align == 'center') {
					$style .= 'display:inline-block !important;';
					$style .= 'max-width:'.$img_width.'px;';
				}
				$output .= "\n" . $link_prefix . '<div class="aio-icon-img ' . esc_attr($el_class) . ' ' . esc_attr($animate) . '" style="font-size:' . esc_attr($img_width) . 'px;' . $style . '" ' . $animation_data . '>';
				$output .= "\n\t" . '<img class="img-icon" alt="' . esc_attr($alt) . '" src="' . esc_url($img[0]) . '"/>';
				$output .= "\n" . '</div>' . $link_sufix;
			}
			$output = $output;
		} else {

			$animate = $animation_data = '';

			if (!( $module_animation == '' )) {
				$animate = ' cr-animate-gen';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}

			if ($icon_color !== '')
				$style .= 'color:' . esc_attr($icon_color) . ';';
			if ($icon_style !== 'none') {
				if ($icon_color_bg !== '')
					$style .= 'background:' . esc_attr($icon_color_bg) . ';';
			}
			if ($icon_style == 'advanced') {
				$style .= 'border-style:' . esc_attr($icon_border_style) . ';';
				$style .= 'border-color:' . esc_attr($icon_color_border) . ';';
				$style .= 'border-width:' . esc_attr($icon_border_size) . 'px;';
				$style .= 'width:' . esc_attr($icon_border_spacing) . 'px;';
				$style .= 'height:' . esc_attr($icon_border_spacing) . 'px;';
				$style .= 'line-height:' . esc_attr($icon_border_spacing+3) . 'px;';
				$style .= 'border-radius:' . esc_attr($icon_border_radius) . 'px;';
			}
			if ($icon_size !== '') {
				$style .='font-size:' . esc_attr($icon_size) . 'px;';
			}

			if ($icon_align !== 'left') {
				$style .= 'display:inline-block !important;';
			}



			if ($icon !== "") {
				$output .= "\n" . $link_prefix . '<div class="aio-icon ' . esc_attr($icon_style) . ' ' . esc_attr($el_class) . ' ' . esc_attr($animate) . '" style="' . $style . '" ' . $animation_data . '>';
				$output .= "\n\t" . '<i class="' . esc_attr($icon) . '"></i>';
				$output .= "\n" . '</div>' . $link_sufix;
			}
			$output = $output;
		}

		/* alignment fix */
		if ($icon_align_style !== '') {
			$output = '<div class="align-icon" style="' . $icon_align_style . '">' . $output . '</div>';
		}

		return $output;
	}

}
