<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

if(!function_exists('_add_custom_param_to_text_shortcode_params')){
	function _add_custom_param_to_text_shortcode_params($content_style,$content_style_bg){
		if (empty($content_style)) {
			$content_style .= "style='" . $content_style_bg . "'";
		} else {
			$content_style[strlen($content_style) - 1] = " ";
			$content_style.=$content_style_bg . "\"";
		}
		return $content_style;
	}
}
if(!function_exists('_dfd_parse_text_shortcode_params')){
	/**
	 * Parse TEXT params in shortcodes.
	 *
	 * @param $string
	 * @param $tag_class
	 * @param $use_google_fonts
	 * @param $custom_fonts
	 *
	 * @return array
	 */
	function _dfd_parse_text_shortcode_params( $string, $tag_class = '', $use_google_fonts = 'no', $custom_fonts = false, $in_head = false ) {
		$parsed_param =  array();
		$parsed_array = array(
			'style' => '',
			'tag' => 'div',
			'class' => '',
			'color' => '',
		);
		$param_value  = explode( '|', $string );

		if ( is_array( $param_value ) ) {
			foreach ( $param_value as $single_param ) {
				$single_param                     = explode( ':', $single_param );
				if ( isset($single_param[1]) && $single_param[1] != '' ) {
					$parsed_param[ $single_param[0] ] = $single_param[1];
				} else {
					$parsed_param[ $single_param[0] ] = '';
				}
			}
		}

		if ( ! empty( $parsed_param ) && is_array( $parsed_param ) ) {
//			$parsed_array['style'] = 'style="';

			if ( ('yes' === trim($use_google_fonts) || 'show' === trim($use_google_fonts)) && class_exists('Vc_Google_Fonts')) {

				$google_fonts_obj  = new Vc_Google_Fonts();
				$google_fonts_data = strlen( $custom_fonts ) > 0 ? $google_fonts_obj->_vc_google_fonts_parse_attributes( array(), $custom_fonts ) : '';
				
				if($google_fonts_data != '') {
					$google_fonts_family = explode( ':', $google_fonts_data['values']['font_family'] );
					$parsed_array['style'] .= 'font-family:' . $google_fonts_family[0] . '; ';
					$google_fonts_styles = explode( ':', $google_fonts_data['values']['font_style'] );
					$parsed_array['style'] .= 'font-weight:' . $google_fonts_styles[1] . '; ';
					$parsed_array['style'] .= 'font-style:' . $google_fonts_styles[2] . '; ';

					$settings = get_option( 'wpb_js_google_fonts_subsets' );
					if ( is_array( $settings ) && ! empty( $settings ) ) {
						$subsets = '&subset=' . implode( ',', $settings );
					} else {
						$subsets = '';
					}

					if ( isset( $google_fonts_data['values']['font_family'] ) && function_exists('vc_build_safe_css_class') ) {
						wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $google_fonts_data['values']['font_family'] . $subsets );
					}
				}
			}

			foreach ( $parsed_param as $key => $value ) {

				if ( strlen( $value ) > 0 ) {
					if ( 'font_style_italic' === $key ) {
						$parsed_array['style'] .= 'font-style:italic; ';
					} elseif ( 'font_style_bold' === $key ) {
						$parsed_array['style'] .= 'font-weight:bold; ';
					} elseif ( 'font_style_underline' === $key ) {
						$parsed_array['style'] .= 'text-decoration:underline; ';
					} elseif('font_family' === $key){
						$parsed_array['style'] .= 'font-family: '.$value.'; ';
					} elseif ( 'color' === $key ) {
						$value = str_replace( '%23', '#', $value );
						$value = str_replace( '%2C', ',', $value );
						$parsed_array['style'] .= $key . ': ' . $value . ' !important; ';
						$parsed_array['color'] = $value;
					} elseif('tag' === $key){
						$parsed_array['tag'] = $value;
					} else {
						$parsed_array['style'] .= str_replace( '_', '-', $key ) . ': ' . $value . 'px; ';
					}
				}
			}
			if(!$in_head) {
				$parsed_array['style'] = 'style="'.$parsed_array['style'].'"';
			}
//			$parsed_array['style'] .= '"';
			/*if( 1 === count($parsed_param) && isset($parsed_param['tag'])){
				$parsed_array['style'] = '';
			}*/
			if ( isset($parsed_array['tag']) && ('div' === $parsed_array['tag']) ) {
				$parsed_array['class'] = $tag_class;
			}
		}

		return $parsed_array;
	}
}

if (!function_exists('dfd_module_read_more')) {
	/**
	 * Read more generator for Frontend
	 */
	function dfd_module_read_more($atts = array()) {
		$readmore_show = $more_show = $readmore_style = $readmore_text = $output = $link_more_open = $link_more_closed = $text_class = '';
		$link_title = $link_rel = $link_target = '';
		$defaults = array(
			'read_more'			=> '',
			'link'				=> '',
			'readmore_show'		=> '',
			'more_show'			=> 'permanent',
			'readmore_style'	=> 'read-more-1',
			'readmore_text'		=> esc_html__('Read More', 'dfd-native'),
		);
		extract(shortcode_atts($defaults, $atts));
		
		if(isset($readmore_show) && strcmp($readmore_show, 'show') == 0) {
			$output .= '<div class="dfd-module-read-more-wrap '.esc_attr($readmore_style).'">';
				if(isset($read_more) && strcmp($read_more, 'more') == 0 && isset($link)) {
					$link = vc_build_link($link);
					$link_title = !empty($link['title']) ? 'title="'.esc_attr($link['title']).'"' : '';
					$link_rel = !empty($link['rel']) ? 'rel="'.esc_attr($link['rel']).'"' : '';
					$link_target = !empty($link['target']) ? 'target="'.esc_attr(preg_replace('/\s+/', '', $link['target'])).'"' : '';
					$link_more_open = '<a href="'.esc_url($link['url']).'" '.$link_title.' '.$link_target.' '.$link_rel.'>';
					$link_more_closed = '</a>';
				}
				$output .= $link_more_open;
				
					if(isset($readmore_text) && !empty($readmore_text)) {
						$readmore_text = esc_html($readmore_text);
						$text_class = 'with-text';
					}

					if(isset($readmore_style) && strcmp($readmore_style, 'read-more-1') == 0 || strcmp($readmore_style, 'read-more-2') == 0 || strcmp($readmore_style, 'read-more-7') == 0) {
						$output .= '<span class="button">'.$readmore_text.'</span>';
					} elseif(strcmp($readmore_style, 'read-more-3') == 0) {
						$output .= '<span class="icon-wrap">';
							$output .= '<span class="plus-vertical line"></span>';
							$output .= '<span class="plus-horizontal line"></span>';
						$output .= '</span>';
					} elseif(strcmp($readmore_style, 'read-more-4') == 0) {
						$output .= '<span class="buton-wrap icon-wrap '.esc_attr($text_class).'">';
							$output .= '<span class="hover-animate-wrap button">';
								$output .= '<span class="text-container"><span class="animate-container">'.$readmore_text.'</span></span>';
								$output .= '<i class="dfd-socicon-arrow-right-01"></i>';
							$output .= '</span>';
						$output .= '</span>';
					} elseif(strcmp($readmore_style, 'read-more-5') == 0) {
						$output .= '<span class="icon-wrap">';
							$output .= '<i class="dfd-socicon-arrow-right"></i>';
						$output .= '</span>';
					} elseif(strcmp($readmore_style, 'read-more-6') == 0) {
						$output .= '<span class="icon-wrap">';
							$output .= '<span class="left-dot dots"></span>';
							$output .= '<span class="midle-dot dots"></span>';
							$output .= '<span class="right-dot dots"></span>';
						$output .= '</span>';
					} elseif(strcmp($readmore_style, 'read-more-8') == 0) {
						$output .= '<span class="button">';
							$output .= '<i class="dfd-socicon-arrow-right more-icon-left"></i>';
							$output .= '<span class="text-container">'.$readmore_text.'</span>';
							$output .= '<i class="dfd-socicon-arrow-right more-icon-right"></i>';
						$output .= '</span>';
					}
			
				$output .= $link_more_closed;
			$output .= '</div>';
			
			return $output;
		}
	}
}

if ( ! function_exists( 'dfd_icon_render' ) ) {
	/**
	 * Icon generator for Frontend
	 */
	function dfd_icon_render( $atts = array(), $return_only_style = false ) {

		$icon_type = $icon = $icon_class = $icon_image_id = $icon_size = $icon_color = $icon_hover = $icon_text = $icon_text_style = '';
		$icon_class = $text_icon_font_options = $text_icon_use_google_fonts = $text_icon_custom_fonts = $icon_font_options = '';

		$output = $icon_style = $img_style = '';

		$defaults = array(
			'icon_type'			=> 'icon',
//			'icon'				=> '',
			'select_icon'		=> 'dfd_icons',
			'icon_image_id'		=> '',
			'icon_size'			=> '',
			'icon_color'		=> '',
			'icon_hover'		=> '',
			'opacity'			=> '',
			'icon_text'			=> '',
			'ic_dfd_icons'		=> '',
			'ic_fontawesome'	=> '',
			'ic_openiconic'		=> '',
			'ic_typicons'		=> '',
			'ic_entypo'			=> '',
			'ic_linecons'		=> '',
			'text_icon_font_options'		=> '',
			'text_icon_use_google_fonts'		=> '',
			'text_icon_custom_fonts'		=> '',
		);

		extract( shortcode_atts( $defaults, $atts ) );

		if ('custom' === $icon_type) {

			$image_url = wp_get_attachment_image_src( $icon_image_id, 'full' );

			if (! empty( $icon_size )){
				$image_src = dfd_aq_resize( $image_url[0], $icon_size, $icon_size, true, true, true );
				if(!$image_src) $image_src = $image_url[0];
			} else {
				$image_src = $image_url[0];
			}
			
			$img_atts = Dfd_Theme_Helpers::get_image_attrs($image_url, $icon_image_id, $icon_size, $icon_size, esc_attr__('Image','dfd-native'));

			if ( ! empty( $icon_size ) ) {

				$img_style .= 'style="';

				if ( isset( $icon_size ) && ! empty( $icon_size ) ) {
					$img_style .= 'width:' . esc_attr($icon_size) . 'px; ';
				}

				$img_style .= '"';

			}

			$output .= '<img src="' . esc_url($image_src) . '" '.$img_atts.' ' . $img_style . '/>';

		} elseif('selector' === $icon_type && $select_icon != '') {
			if($select_icon != 'dfd_icons') {
				vc_icon_element_fonts_enqueue($select_icon);
			}
			
			if (!empty($icon_size) || !empty($icon_color)) {
				
				$icon_style .= 'style="';

				if ( ! empty( $icon_size ) ) {
					$icon_style .= 'font-size:' . $icon_size . 'px; ';
				}

				if ( ! empty( $icon_color ) ) {
					$icon_style .= 'color:' . $icon_color.'; ';
				}

				$icon_style .= '"';
			}

			if ($icon_hover) {
				$icon_hover = 'data-hover="'.$icon_hover.'"';
			}

			$icon_class = ${'ic_'.$select_icon};
			
			if($return_only_style){
				return array(
						'icon_class'=>$icon_class,
						'icon_style'=>$icon_style,
						'icon_hover'=>$icon_hover
				);
			}
			$output .= '<i class="featured-icon ' . $icon_class . '" ' . $icon_style . ' ' . $icon_hover . '></i>';
		} elseif('text' === $icon_type) {
//			$icon_text_style .= 'style="display: block; ';
//			if(!empty($icon_size)) {
//				$icon_text_style .= 'font-size: '.$icon_size.'px;';
//			}
//			if(!empty($icon_color)) {
//				$icon_text_style .= 'color: '.$icon_color.'; ';
//			}
//			$icon_text_style .= '"';
			
			$icon_font_options = _dfd_parse_text_shortcode_params( $text_icon_font_options, 'icon-text', $text_icon_use_google_fonts, $text_icon_custom_fonts);
			
			$output .= '<span class="'.$icon_font_options['class'].' dfd-text-icon-render" '.$icon_font_options['style'].'>'.  esc_html($icon_text).'</span>';
		}

		return $output;
	}
}

if ( function_exists( 'vc_shortcodes_theme_templates_dir' ) || function_exists( 'vc_set_template_dir' ) ) {
	$templates_path = DFD_EXTENSIONS_PLUGIN_PATH . 'vc_custom/vc_templates/';
	vc_set_shortcodes_templates_dir( $templates_path );
}

if(function_exists('vc_remove_param')) {
	//vc_remove_param('vc_row','bg_image');
	//vc_remove_param('vc_row','bg_image');
	//vc_remove_param('vc_row','el_class');
	vc_remove_param('vc_row','full_height');
	vc_remove_param('vc_row','columns_placement');
	vc_remove_param('vc_row','disable_element');
	vc_remove_param('vc_row','el_class');
	vc_remove_param('vc_row','bg_image_repeat');
	vc_remove_param('vc_row','font_color');
	vc_remove_param('vc_row','full_width');
	vc_remove_param('vc_row','el_id');
	vc_remove_param('vc_row','parallax');
	vc_remove_param('vc_row','parallax_image');
	vc_remove_param('vc_row','parallax_speed_video');
	vc_remove_param('vc_row','parallax_speed_bg');
	vc_remove_param('vc_row','content_placement');
	vc_remove_param('vc_row','video_bg');
	vc_remove_param('vc_row','video_bg_url');
	vc_remove_param('vc_row','video_bg_parallax');
	vc_remove_param('vc_row','gap');
	vc_remove_param('vc_row','equal_height');
	vc_remove_param('vc_row','css_animation');
	//vc_remove_param('vc_row','columns_placement');
	vc_remove_param('vc_row_inner','disable_element');
	vc_remove_param('vc_row_inner','el_class');
	vc_remove_param('vc_row_inner','el_id');
	vc_remove_param('vc_row_inner','equal_height');
	vc_remove_param('vc_row_inner','content_placement');
	vc_remove_param('vc_row_inner','gap');
	vc_remove_param('vc_column','el_id');
	vc_remove_param('vc_column','video_bg');
	vc_remove_param('vc_column','video_bg_url');
	vc_remove_param('vc_column','video_bg_parallax');
	vc_remove_param('vc_column','parallax');
	vc_remove_param('vc_column','parallax_image');
	vc_remove_param('vc_column','parallax_speed_bg');
	vc_remove_param('vc_column','parallax_speed_video');
	vc_remove_param('vc_column','css_animation');
	vc_remove_param('vc_column_text','css_animation');
	vc_remove_param('vc_column_text','el_id');
	vc_remove_param('vc_column_text','el_class');
	vc_remove_param('vc_video','title');
	vc_remove_param('vc_video','link');
	vc_remove_param('vc_tour','title');
}

/* VC settings */
if(function_exists('vc_add_param')){
	/*VC Row custom params*/
	vc_add_param(
		'vc_row', array(
			'type' => 'dfd_heading_param',
			'text' => esc_html__('Row sizing options', 'dfd-native'),
			'param_name' => 'sizing',
			'class' => '',
			'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
			'weight' => 1
		)
	);
	vc_add_param(
		'vc_row', array(
			'type' => 'dfd_radio_advanced',
			'class' => '',
			'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to choose the width for the row. Boxed width is 1280px width','dfd-native').'</span></span>'.__('Content Width', 'dfd-native'),
			'param_name' => 'dfd_row_config',
			'value' => '',
			'options' => array(
				__('Boxed', 'dfd-native') => '',
				__('Full Width', 'dfd-native') => 'full_width_content',
			),
		)
	);
	vc_add_param(
		'vc_row', array(
			'type' => 'dfd_single_checkbox',
			'class' => '',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to set the row to full-screen','dfd-native').'</span></span>'.__('Full height row', 'dfd-native'),
			'param_name' => 'full_height',
			'value' => '',
			'options' => array(
				'yes' => array(
						'label' => '',
						'on' => 'Yes',
						'off' => 'No',
					),
				),
		)
	);
	vc_add_param(
		'vc_row', array(
			'type' => 'dfd_radio_advanced',
			'class' => '',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to choose the vertical alingnment for the content','dfd-native').'</span></span>'.__('Columns position', 'dfd-native'),
			'param_name' => 'columns_placement',
			'value' => 'middle',
			'options' => array(
				__('Middle', 'dfd-native') => 'middle',
				__('Top', 'dfd-native') => 'top',
				__('Bottom', 'dfd-native') => 'bottom',
			),
			'dependency' => array('element' => 'full_height','value' => array('yes')),
		)
	);
	vc_add_param(
		'vc_row', array(
			'type' => 'dfd_single_checkbox',
			'class' => '',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to adjust the columns content to the height to the bigger one.','dfd-native').'</span></span>'.__('Force equal height columns', 'dfd-native'),
			'param_name' => 'force_equal_height_columns',
			'value' => '',
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
			'options' => array(
				'main_row' => array(
						'label' => '',
						'on' => 'Yes',
						'off' => 'No',
					),
				),
		)
	);
	vc_add_param(
		'vc_row', array(
			'type' => 'dfd_single_checkbox',
			'class' => '',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option will add top and bottom spaces inside the smaller column to display the content vertically centered.','dfd-native').'</span></span>'.__('Align content vertically', 'dfd-native'),
			'param_name' => 'align_content_vertically',
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
			'value' => 'yes',
			'options' => array(
				'yes' => array(
						'label' => '',
						'on' => 'Yes',
						'off' => 'No',
					),
				),
			'dependency' => array('element' => 'force_equal_height_columns','value' => array('main_row', 'child_row')),
		)
	);
	vc_add_param(
		'vc_row', array(
			'type' => 'dfd_single_checkbox',
			'class' => '',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to display columns content one by one on small screens and do not keep equal height.','dfd-native').'</span></span>'.__('Turn off equal heights on mobiles', 'dfd-native'),
			'param_name' => 'mobile_destroy_equal_heights',
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
			'value' => 'yes',
			'options' => array(
				'yes' => array(
						'label' => '',
						'on' => 'Yes',
						'off' => 'No',
					),
				),
			'dependency' => array('element' => 'force_equal_height_columns','value' => array('main_row', 'child_row')),
		)
	);
	vc_add_param(
		'vc_row',array(
			'type' => 'number',
			'class' => '',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the width of the device from which the equal height should be destroyed.','dfd-native').'</span></span>'.__('Resolution to disable equal heights', 'dfd-native'),
			'param_name' => 'mobile_destroy_equal_heights_resolution',
			'value' =>'800',
			'min'=>'1',
			'max'=>'100',
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
			'description' => esc_html__('', 'dfd-native'),
			'dependency' => Array('element' => 'mobile_destroy_equal_heights','value' => array('yes')),
		)
	);
	vc_add_param(
		'vc_row', array(
			'type' => 'dfd_single_checkbox',
			'class' => '',
			'heading' => esc_html__('Enable custom columns offsets', 'dfd-native'),
			'param_name' => 'row_custom_paddings',
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
			'value' => '',
			'dependency' => Array('element' => 'dfd_row_config','value' => array('full_width_content')),
			'options' => array(
				'yes' => array(
						'label' => '',
						'on' => 'Yes',
						'off' => 'No',
					),
				),
		)
	);
	vc_add_param(
		'vc_row',array(
			'type' => 'number',
			'class' => '',
			'heading' => esc_html__('Columns offsets', 'dfd-native'),
			'param_name' => 'row_columns_paddings',
			'value' =>'20',
			'min'=>'1',
			'max'=>'100',
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
			'description' => esc_html__('', 'dfd-native'),
			'dependency' => Array('element' => 'row_custom_paddings','value' => array('yes')),
		)
	);
	vc_add_param(
		'vc_row', array(
			'type' => 'dfd_heading_param',
			'text' => esc_html__('Row effects options', 'dfd-native'),
			'param_name' => 'effects',
			'class' => '',
			'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
		)
	);
	vc_add_param(
		'vc_row', array(
			'type' => 'dfd_radio_advanced',
			'class' => '',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to add the fade effect when the row is on the top of the viewport','dfd-native').'</span></span>'.__('Row effect', 'dfd-native'),
			'param_name' => 'row_effect',
			'value' => '',
			'options' => array(
				__('None', 'dfd-native') => '',
				__('Fade', 'dfd-native') => 'dfd-fade-on-scroll',
				__('Sticky', 'dfd-native') => 'dfd-sticky-row'
			),
		)
	);
	vc_add_param(
		'vc_row', array(
			'type' => 'dfd_single_checkbox',
			'class' => '',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to have the paxalax effect for the content','dfd-native').'</span></span>'.__('Content parallax effect', 'dfd-native'),
			'param_name' => 'dfd_row_parallax',
			'value' => '',
			'options' => array(
				'dfd-row-parallax' => array(
						'label' => '',
						'on' => 'Yes',
						'off' => 'No',
					),
				),
		)
	);
	vc_add_param(
		'vc_row',array(
			'type' => 'number',
			'class' => '',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Control the speed of parallax. Values from 1 to 100 are acceptable','dfd-native').'</span></span>'.__('Parallax Speed', 'dfd-native'),
			'param_name' => 'row_parallax_sense',
			'value' =>'30',
			'min'=>'1',
			'max'=>'100',
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
			'dependency' => Array('element' => 'dfd_row_parallax','value' => array('dfd-row-parallax')),
		)
	);
	vc_add_param(
		'vc_row',array(
			'type' => 'number',
			'class' => '',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Parallax shift limit. Values from 50 to 400 are acceptable. Units should be set in px.','dfd-native').'</span></span>'.__('Parallax limit', 'dfd-native'),
			'param_name' => 'row_parallax_limit',
			'value' =>'',
			'min'=>'50',
			'max'=>'400',
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
			'dependency' => Array('element' => 'dfd_row_parallax','value' => array('dfd-row-parallax')),
		)
	);
	vc_add_param(
		'vc_row', array(
			'type' => 'dfd_heading_param',
			'text' => esc_html__('Row heading options', 'dfd-native'),
			'param_name' => 'heading',
			'class' => '',
			'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
		)
	);
	vc_add_param(
		'vc_row', array(
			'type' => 'textfield',
			'class' => '',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to add the title for the one page scroll dots navigation','dfd-native').'</span></span>'.__('Title for one page scroll navigation', 'dfd-native'),
			'param_name' => 'one_page_title',
			'value' => '',
		)
	);
	vc_add_param(
		'vc_row', array(
			'type' => 'textfield',
			'class' => '',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique anchor name. The anchor can be used for the anchor navigation in menu','dfd-native').'</span></span>'.__('Anchor', 'dfd-native'),
			'param_name' => 'anchor',
			'value' => '',
		)
	);
	vc_add_param(
		'vc_row', array(
			'type' => 'dfd_heading_param',
			'text' => esc_html__('Extra features', 'dfd-native'),
			'param_name' => 'extra_features',
			'class' => '',
			'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
		)
	);
	vc_add_param(
		'vc_row', array(
			'type' => 'textfield',
			'class' => '',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the row which can be used for custom CSS codes','dfd-native').'</span></span>'.__('Custom CSS Class', 'dfd-native'),
			'param_name' => 'el_class',
			'value' => '',
		)
	);
	vc_add_param(
		'vc_row', array(
			'type' => 'textfield',
			'class' => '',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to add custom css styles for the row','dfd-native').'</span></span>'.__('Custom CSS Styles', 'dfd-native'),
			'param_name' => 'extra_css_styles',
			'value' => '',
		)
	);
	vc_add_param(
		'vc_row', array(
			'type' => 'dfd_single_checkbox',
			'class' => '',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('The row won\'t be visible on the public side of your website. You can switch it back any time.','dfd-native').'</span></span>'.__('Disable row', 'dfd-native'),
			'param_name' => 'disable_element',
			'value' => '',
			'options' => array(
				'yes' => array(
						'label' => '',
						'on' => 'Yes',
						'off' => 'No',
					),
				),
		)
	);
	/* Row Background options */
	require_once(DFD_EXTENSIONS_PLUGIN_PATH.'vc_custom/dfd_vc_background/dfd_vc_bg.php');
	
	$Dfd_VC_Row_Background->build_backend_options();
	
	vc_add_param(
		'vc_row', array(
			'type' => 'dfd_single_checkbox',
			'class' => '',
			'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to add custom paddings, margins and border for different devices','dfd-native').'</span></span>'.__('Responsive options', 'dfd-native'),
			'param_name' => 'dfd_row_responsive_enable',
			'value' => '',
			'options' => array(
				'dfd-row-responsive-enable' => array(
						'label' => '',
						'on' => 'Yes',
						'off' => 'No',
					),
				),
			'group' => esc_html__('Responsive Options', 'dfd-native'),
		)
	);
	vc_add_param(
		'vc_row', array(
			'type'				=> 'dfd_param_responsive_css',
			'heading'			=> esc_html__('Resposive settings', 'dfd-native'),
			'param_name'		=> 'responsive_styles',
			'group'				=> esc_html__('Responsive Options', 'dfd-native'),
			'dependency'		=> Array("element" => "dfd_row_responsive_enable","value" => array('dfd-row-responsive-enable')),
		)
	);
	vc_add_param(
		'vc_row_inner', array(
			'type' => 'dfd_single_checkbox',
			'class' => '',
			'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('The row won\'t be visible on the public side of your website. You can switch it back any time.','dfd-native').'</span></span>'.__('Disable row', 'dfd-native'),
			'param_name' => 'disable_element',
			'value' => '',
			'options' => array(
				'yes' => array(
						'label' => '',
						'on' => 'Yes',
						'off' => 'No',
					),
				),
			'weight' => 1
		)
	);
	vc_add_param(
		'vc_row_inner', array(
			'type' => 'dfd_radio_advanced',
			'class' => '',
			'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background style for the row. The text colors will be changed according to the style you choose to make it more readable','dfd-native').'</span></span>'.esc_html__('Row Background Style', 'dfd-native'),
			'param_name' => 'bg_check',
			'value' => '',
			'options' => array(
				esc_attr__('Light', 'dfd-native') => '',
				esc_attr__('Dark', 'dfd-native') => 'row-background-dark'
			),
		)
	);
	vc_add_param(
		'vc_row_inner',array(
			'type' => 'textfield',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the row which can be used for custom CSS codes','dfd-native').'</span></span>'.__('Custom CSS Class', 'dfd-native'),
			'param_name' => 'el_class',
		)
	);
	vc_add_param(
		'vc_row_inner', array(
			'type' => 'dfd_single_checkbox',
			'class' => '',
			'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to add custom paddings, margins and border for different devices','dfd-native').'</span></span>'.__('Responsive options', 'dfd-native'),
			'param_name' => 'dfd_row_responsive_enable',
			'value' => '',
			'options' => array(
				'dfd-row-responsive-enable' => array(
						'label' => '',
						'on' => 'Yes',
						'off' => 'No',
					),
				),
			'group' => esc_html__('Responsive Options', 'dfd-native'),
		)
	);
	vc_add_param(
		'vc_row_inner', array(
			'type'				=> 'dfd_param_responsive_css',
			'heading'			=> esc_html__('Resposive settings', 'dfd-native'),
			'param_name'		=> 'responsive_styles',
			'group'				=> esc_html__('Responsive Options', 'dfd-native'),
			'dependency'		=> Array("element" => "dfd_row_responsive_enable","value" => array('dfd-row-responsive-enable')),
		)
	);
	/*VC Columns cstom params*/
	vc_add_param(
		'vc_column', array(
			'type' => 'dfd_heading_param',
			'text' => esc_html__('Main column settings', 'dfd-native'),
			'param_name' => 'main',
			'class' => '',
			'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
			'weight' => 1
		)
	);
	vc_add_param(
		'vc_column', array(
			'type' => 'dfd_radio_advanced',
			'class' => '',
			'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('According to the color you choose the text colors will be changed to make it more readable','dfd-native').'</span></span>'.__('Column Background Style', 'dfd-native'),
			'param_name' => 'column_bg_check',
			'value' => '',
			'options' => array(
				__('Light', 'dfd-native') => '',
				__('Dark', 'dfd-native') => 'column-background-dark'
			),
			'weight' => 1
		));
	vc_add_param(
		'vc_column', array(
			'type' => 'dfd_single_checkbox',
			'class' => '',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to have the paxalax effect for the content','dfd-native').'</span></span>'.__('Content parallax effect', 'dfd-native'),
			'param_name' => 'column_parallax',
			'options' => array(
				'dfd-column-parallax' => array(
						'label' => '',
						'on' => 'Yes',
						'off' => 'No',
					),
				),
			'weight' => 1
		));
	vc_add_param(
		'vc_column',array(
			'type' => 'number',
			'class' => '',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Control the speed of parallax. Values from 1 to 100 are acceptable','dfd-native').'</span></span>'.__('Parallax Speed', 'dfd-native'),
			'param_name' => 'column_parallax_sense',
			'value' =>'30',
			'min'=>'-200',
			'max'=>'200',
			'edit_field_class' => 'no-top-margin vc_column vc_col-sm-6',
			'dependency' => Array("element" => "column_parallax","value" => array('dfd-column-parallax')),
			'weight' => 1
		)
	);
	vc_add_param(
		'vc_column',array(
			'type' => 'number',
			'class' => '',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Parallax shift limit. Values from 50 to 400 are acceptable. Units should be set in px.','dfd-native').'</span></span>'.__('Parallax limit', 'dfd-native'),
			'param_name' => 'column_parallax_limit',
			'value' =>'',
			'min'=>'50',
			'max'=>'400',
			'edit_field_class' => 'no-top-margin vc_column vc_col-sm-6',
			'dependency' => Array("element" => "column_parallax","value" => array('dfd-column-parallax')),
			'weight' => 1
		)
	);
	vc_add_param(
		'vc_column', array(
			'type' => 'dfd_heading_param',
			'text' => esc_html__('Extra features', 'dfd-native'),
			'param_name' => 'extra_features',
			'class' => '',
			'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
			'weight' => 1
		)
	);
	vc_add_param(
		'vc_column', array(
			'type'				=> 'dropdown',
			'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the position for the image you\'ve set as background for the column','dfd-native').'</span></span>'.esc_html__('Image position', 'dfd-native'),
			'param_name'		=> 'cus_bg_position',
			'value'				=> Dfd_Theme_Helpers::dfd_get_bgposition(),
			'edit_field_class'	=> 'vc_column vc_col-sm-6',
			'group'				=> esc_html__('Design Options', 'dfd-native'),
		)
	);
	vc_add_param(
		'vc_column', array(
			'type'				=> 'dfd_radio_advanced',
			'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the repeating of the image you\'ve set as background for the columns','dfd-native').'</span></span>'.esc_html__('Image repeat', 'dfd-native'),
			'param_name'		=> 'cus_bg_repeat',
			'value'				=> '',
			'options'			=> array(
				esc_html__('Default', 'dfd-native')		=> '',
				esc_html__('Repeat', 'dfd-native')			=> 'repeat',
				esc_html__('No repeat', 'dfd-native')		=> 'no-repeat',
			),
			'edit_field_class'	=> 'vc_column vc_col-sm-6',
			'group'				=> esc_html__('Design Options', 'dfd-native'),
		)
	);
	vc_add_param(
		'vc_column', array(
			'type' => 'dfd_heading_param',
			'text' => esc_html__('Mobile background options', 'dfd-native'),
			'param_name' => 'mobile_column_bg_heading',
			'class' => '',
			'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
			'group'				=> esc_html__('Design Options', 'dfd-native'),
		)
	);
	vc_add_param(
		'vc_column', array(
			'type' => 'attach_image',
			'class' => '',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Upload the image from the media library to be set as background image for the column on mobile devices','dfd-native').'</span></span>'.__('Mobile Background Image', 'dfd-native'),
			'param_name' => 'mobile_column_bg_image',
			'value' => '',
			'edit_field_class'	=> 'vc_column vc_col-sm-6',
			'group'				=> esc_html__('Design Options', 'dfd-native'),
		)
	);
	vc_add_param(
		'vc_column', array(
			'type'				=> 'dfd_radio_advanced',
			'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to change the background size of the image you\'ve set as background for the columns on mobile devices','dfd-native').'</span></span>'.esc_html__('Image size', 'dfd-native'),
			'param_name'		=> 'mobile_column_bg_size',
			'value'				=> '',
			'options'			=> array(
				esc_html__('Initial', 'dfd-native')	=> 'initial',
				esc_html__('Contain', 'dfd-native')	=> 'contain',
				esc_html__('Cover', 'dfd-native')		=> 'cover',
			),
			'edit_field_class'	=> 'vc_column vc_col-sm-6',
			'group'				=> esc_html__('Design Options', 'dfd-native'),
		)
	);
	vc_add_param(
		'vc_column', array(
			'type'				=> 'dropdown',
			'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the position for the image you\'ve set as background for the column on mobile devices','dfd-native').'</span></span>'.esc_html__('Image position', 'dfd-native'),
			'param_name'		=> 'mobile_column_bg_position',
			'value'				=> Dfd_Theme_Helpers::dfd_get_bgposition(),
			'edit_field_class'	=> 'vc_column vc_col-sm-6',
			'group'				=> esc_html__('Design Options', 'dfd-native'),
		)
	);
	vc_add_param(
		'vc_column', array(
			'type'				=> 'dfd_radio_advanced',
			'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the repeating of the image you\'ve set as background for the columns on mobile devices','dfd-native').'</span></span>'.esc_html__('Image repeat', 'dfd-native'),
			'param_name'		=> 'mobile_column_bg_repeat',
			'value'				=> '',
			'options'			=> array(
				esc_html__('Default', 'dfd-native')		=> 'initial',
				esc_html__('Repeat', 'dfd-native')			=> 'repeat',
				esc_html__('No repeat', 'dfd-native')		=> 'no-repeat',
			),
			'edit_field_class'	=> 'vc_column vc_col-sm-6',
			'group'				=> esc_html__('Design Options', 'dfd-native'),
		)
	);
	vc_add_param(
		'vc_column',array(
			'type'				=> 'dfd_heading_param',
			'text'				=> esc_html__('Hover settings', 'dfd-native'),
			'param_name'		=> 'col_hover_settings',
			'edit_field_class'	=> 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
			'group'				=> esc_html__('Design Options', 'dfd-native'),
		)
	);
	vc_add_param(
		'vc_column', array(
			'type'				=> 'dfd_box_shadow_param',
			'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to add the shadow to the column','dfd-native').'</span></span>'.esc_html__('Box Shadow', 'dfd-native'),
			'param_name'		=> 'col_shadow',
			'edit_field_class'	=> 'vc_column vc_col-sm-6',
			'group'				=> esc_html__('Design Options', 'dfd-native'),
		)
	);
	vc_add_param(
		'vc_column', array(
			'type'				=> 'dfd_box_shadow_param',
			'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to add the shadow to the column on hover','dfd-native').'</span></span>'.esc_html__('Box Shadow on Hover', 'dfd-native'),
			'param_name'		=> 'col_shadow_hover',
			'edit_field_class'	=> 'vc_column vc_col-sm-6',
			'group'				=> esc_html__('Design Options', 'dfd-native'),
		)
	);
	vc_add_param(
		'vc_column', array(
			'type'				=> 'colorpicker',
			'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to add the hover background color for the column','dfd-native').'</span></span>'.esc_html__('Background', 'dfd-native' ),
			'param_name'		=> 'col_hover_bg',
			'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
			'group'				=> esc_html__('Design Options', 'dfd-native'),
		)
	);
	vc_add_param(
		'vc_column', array(
			'type'				=> 'colorpicker',
			'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the hover border color for the column','dfd-native').'</span></span>'.esc_html__('Border color', 'dfd-native' ),
			'param_name'		=> 'col_hover_border_color',
			'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
			'group'				=> esc_html__('Design Options', 'dfd-native'),
		)
	);
	vc_add_param(
		'vc_column', array(
			'type'				=> 'dfd_radio_advanced',
			'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Select among the three preset border hover styles','dfd-native').'</span></span>'.esc_html__('Border style', 'dfd-native'),
			'param_name'		=> 'col_hover_border_style',
			'value'				=> '',
			'options'			=> array(
				esc_html__('None', 'dfd-native')	=> '',
				esc_html__('Solid', 'dfd-native')		=> 'solid',
				esc_html__('Dotted', 'dfd-native')		=> 'dotted',
				esc_html__('Dashed', 'dfd-native')		=> 'dashed',
			),
			'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
			'group'				=> esc_html__('Design Options', 'dfd-native'),
		)
	);
	vc_add_param(
		'vc_column', array(
			'type'				=> 'number',
			'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to set the column\s hover border radius','dfd-native').'</span></span>'.esc_html__('Border radius', 'dfd-native'),
			'param_name'		=> 'col_hover_border_radius',
			'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
			'group'				=> esc_html__('Design Options', 'dfd-native'),
		)
	);
	vc_add_param(
		'vc_column', array(
			'type'				=> 'dfd_radio_advanced',
			'class'				=> '',
			'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to add side up or slide down effect on hover to the column','dfd-native').'</span></span>'.esc_html__('Effect', 'dfd-native'),
			'param_name'		=> 'col_hover',
			'value'				=> '',
			'options'				=> array(
				esc_html__('None', 'dfd-native')	=> '',
				esc_html__('Slide up', 'dfd-native')		=> 'col-hover-slide-up',
				esc_html__('Slide down', 'dfd-native')		=> 'col-hover-slide-dovn',
			),
			'group'				=> esc_html__('Design Options', 'dfd-native'),
		)
	);
	vc_add_param(
		'vc_column', array(
			'type' => 'dfd_single_checkbox',
			'class' => '',
			'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to add custom paddings, margins and border for different devices','dfd-native').'</span></span>'.__('Responsive options', 'dfd-native'),
			'param_name' => 'dfd_column_responsive_enable',
			'value' => '',
			'options' => array(
				'dfd-column-responsive-enable' => array(
						'label' => '',
						'on' => 'Yes',
						'off' => 'No',
					),
				),
			'group' => esc_html__('Responsive Options', 'dfd-native'),
		)
	);
	vc_add_param(
		'vc_column', array(
			'type'				=> 'dfd_param_responsive_css',
			'heading'			=> esc_html__('Resposive settings', 'dfd-native'),
			'param_name'		=> 'responsive_styles',
			'group'				=> esc_html__('Responsive Options', 'dfd-native'),
			'dependency'		=> Array("element" => "dfd_column_responsive_enable","value" => array('dfd-column-responsive-enable')),
		)
	);
	vc_add_param(
		'vc_column_inner', array(
			'type'				=> 'dfd_box_shadow_param',
			'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to add the shadow to the column','dfd-native').'</span></span>'.esc_html__('Box Shadow', 'dfd-native'),
			'param_name'		=> 'col_inner_shadow',
			'edit_field_class'	=> 'vc_column vc_col-sm-6',
			'group'				=> esc_html__('Design Options', 'dfd-native'),
		)
	);
	vc_add_param(
		'vc_column_inner', array(
			'type'				=> 'dfd_box_shadow_param',
			'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to add the shadow to the column on hover','dfd-native').'</span></span>'.esc_html__('Box Shadow on Hover', 'dfd-native'),
			'param_name'		=> 'col_inner_shadow_hover',
			'edit_field_class'	=> 'vc_column vc_col-sm-6',
			'group'				=> esc_html__('Design Options', 'dfd-native'),
		)
	);
	vc_add_param(
		'vc_column_inner',array(
			'type'				=> 'dfd_heading_param',
			'text'				=> esc_html__('Hover settings', 'dfd-native'),
			'param_name'		=> 'col_inner_hover_settings',
			'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
			'group'				=> esc_html__('Design Options', 'dfd-native'),
		)
	);
	vc_add_param(
		'vc_column_inner', array(
			'type'				=> 'colorpicker',
			'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to add the hover background color for the column','dfd-native').'</span></span>'.esc_html__('Background', 'dfd-native' ),
			'param_name'		=> 'col_inner_hover_bg',
			'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
			'group'				=> esc_html__('Design Options', 'dfd-native'),
		)
	);
	vc_add_param(
		'vc_column_inner', array(
			'type'				=> 'colorpicker',
			'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the hover border color for the column','dfd-native').'</span></span>'.esc_html__('Border color', 'dfd-native' ),
			'param_name'		=> 'col_inner_hover_border_color',
			'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
			'group'				=> esc_html__('Design Options', 'dfd-native'),
		)
	);
	vc_add_param(
		'vc_column_inner', array(
			'type'				=> 'dfd_radio_advanced',
			'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Select among the three preset border hover styles','dfd-native').'</span></span>'.esc_html__('Border style', 'dfd-native'),
			'param_name'		=> 'col_inner_hover_border_style',
			'value'				=> '',
			'options'				=> array(
				esc_html__('Theme defaults', 'dfd-native')	=> '',
				esc_html__('Solid', 'dfd-native')		=> 'solid',
				esc_html__('Dotted', 'dfd-native')		=> 'dotted',
				esc_html__('Dashed', 'dfd-native')		=> 'dashed',
			),
			'edit_field_class'	=> 'vc_column vc_col-sm-7 crum_vc',
			'group'				=> esc_html__('Design Options', 'dfd-native'),
		)
	);
	vc_add_param(
		'vc_column_inner', array(
			'type'				=> 'number',
			'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to set the column\s hover border radius','dfd-native').'</span></span>'.esc_html__('Border radius', 'dfd-native'),
			'param_name'		=> 'col_inner_hover_border_radius',
			'edit_field_class'	=> 'vc_column vc_col-sm-5 crum_vc',
			'group'				=> esc_html__('Design Options', 'dfd-native'),
		)
	);
	vc_add_param(
		'vc_column_inner', array(
			'type'				=> 'dfd_radio_advanced',
			'class'				=> '',
			'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to add side up or slide down effect on hover to the column','dfd-native').'</span></span>'.esc_html__('Effect', 'dfd-native'),
			'param_name'		=> 'col_inner_hover',
			'value'				=> '',
			'options'				=> array(
				esc_html__('None', 'dfd-native')	=> '',
				esc_html__('Slide up', 'dfd-native')		=> 'col-hover-slide-up',
				esc_html__('Slide down', 'dfd-native')		=> 'col-hover-slide-dovn',
			),
			'group'				=> esc_html__('Design Options', 'dfd-native'),
		)
	);
	vc_add_param(
		'vc_column_inner', array(
			'type' => 'dfd_single_checkbox',
			'class' => '',
			'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to add custom paddings, margins and border for different devices','dfd-native').'</span></span>'.__('Responsive options', 'dfd-native'),
			'param_name' => 'dfd_column_responsive_enable',
			'value' => '',
			'options' => array(
				'dfd-column-responsive-enable' => array(
						'label' => '',
						'on' => 'Yes',
						'off' => 'No',
					),
				),
			'group' => esc_html__('Responsive Options', 'dfd-native'),
		)
	);
	vc_add_param(
		'vc_column_inner', array(
			'type'				=> 'dfd_param_responsive_css',
			'heading'			=> esc_html__('Resposive settings', 'dfd-native'),
			'param_name'		=> 'responsive_styles',
			'group'				=> esc_html__('Responsive Options', 'dfd-native'),
			'dependency'		=> Array("element" => "dfd_column_responsive_enable","value" => array('dfd-column-responsive-enable')),
		)
	);
	vc_add_param(
		'vc_column_text',array(
			'type' => 'dfd_heading_param',
			'text' => esc_html__('Extra features', 'dfd-native'),
			'param_name' => 'extra_features',
			'class' => '',
			'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
		)
	);
	vc_add_param(
		'vc_column_text',array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('Item Animation','dfd-native'),
			'param_name' => 'item_animation',
			'value'       => Dfd_Theme_Helpers::dfd_module_animation_styles(),
			'description' => '',
		)
	);
	vc_add_param(
		'vc_column_text',array(
			'type' => 'textfield',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the row which can be used for custom CSS codes','dfd-native').'</span></span>'.__('Custom CSS Class', 'dfd-native'),
			'param_name' => 'el_class',
		)
	);
	
	require_once(DFD_EXTENSIONS_PLUGIN_PATH.'vc_custom/params.php');
	foreach(glob(DFD_EXTENSIONS_PLUGIN_PATH.'vc_custom/map_shortcodes/*.php') as $shortcode) {
		require_once($shortcode);
	}
	
	if(class_exists('WooCommerce')) {
		foreach(glob(DFD_EXTENSIONS_PLUGIN_PATH.'vc_custom/dfd_woo_shortcodes/*.php') as $woo_shortcode) {
			require_once($woo_shortcode);
		}
	}
}
