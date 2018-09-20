<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Image module
*/
class WPBakeryShortCode_Dfd_Single_Image extends WPBakeryShortCode {
	function __construct($settings) {
		parent::__construct( $settings );
	}

	public function singleParamHtmlHolder( $param, $value ) {
		$output = '';
		// Compatibility fixes
		$old_names = array(
			'yellow_message',
			'blue_message',
			'green_message',
			'button_green',
			'button_grey',
			'button_yellow',
			'button_blue',
			'button_red',
			'button_orange',
		);
		$new_names = array(
			'alert-block',
			'alert-info',
			'alert-success',
			'btn-success',
			'btn',
			'btn-info',
			'btn-primary',
			'btn-danger',
			'btn-warning',
		);
		$value = str_ireplace( $old_names, $new_names, $value );

		$param_name = isset( $param['param_name'] ) ? $param['param_name'] : '';
		$type = isset( $param['type'] ) ? $param['type'] : '';
		$class = isset( $param['class'] ) ? $param['class'] : '';

		if ( 'attach_image' === $param['type'] && 'image' === $param_name ) {
			$output .= '<input type="hidden" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="' . $value . '" />';
			$element_icon = $this->settings( 'icon' );
			$img = wpb_getImageBySize( array(
				'attach_id' => (int) preg_replace( '/[^\d]/', '', $value ),
				'thumb_size' => 'thumbnail',
			));
			$this->setSettings( 'logo', ( $img ? $img['thumbnail'] : '<img width="150" height="150" src="' . vc_asset_url( 'vc/blank.gif' ) . '" class="attachment-thumbnail vc_general vc_element-icon"  data-name="' . $param_name . '" alt="" title="" style="display: none;" />' ) . '<span class="no_image_image vc_element-icon' . ( ! empty( $element_icon ) ? ' ' . $element_icon : '' ) . ( $img && ! empty( $img['p_img_large'][0] ) ? ' image-exists' : '' ) . '" /><a href="#" class="column_edit_trigger' . ( $img && ! empty( $img['p_img_large'][0] ) ? ' image-exists' : '' ) . '">' . esc_html__( 'Add image', 'dfd-native' ) . '</a>' );
			$output .= $this->outputTitleTrue( $this->settings['name'] );
		} elseif ( ! empty( $param['holder'] ) ) {
			if ( 'input' === $param['holder'] ) {
				$output .= '<' . $param['holder'] . ' readonly="true" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="' . $value . '">';
			} elseif ( in_array( $param['holder'], array( 'img', 'iframe' ) ) ) {
				$output .= '<' . $param['holder'] . ' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" src="' . $value . '">';
			} elseif ( 'hidden' !== $param['holder'] ) {
				$output .= '<' . $param['holder'] . ' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '">' . $value . '</' . $param['holder'] . '>';
			}
		}

		if ( ! empty( $param['admin_label'] ) && true === $param['admin_label'] ) {
			$output .= '<span class="vc_admin_label admin_label_' . $param['param_name'] . ( empty( $value ) ? ' hidden-label' : '' ) . '"><label>' . $param['heading'] . '</label>: ' . $value . '</span>';
		}

		return $output;
	}
	public function getImageSquareSize( $img_id, $img_size ) {
		if ( preg_match_all( '/(\d+)x(\d+)/', $img_size, $sizes ) ) {
			$exact_size = array(
				'width' => isset( $sizes[1][0] ) ? $sizes[1][0] : '0',
				'height' => isset( $sizes[2][0] ) ? $sizes[2][0] : '0',
			);
		} else {
			$image_downsize = image_downsize( $img_id, $img_size );
			$exact_size = array(
				'width' => $image_downsize[1],
				'height' => $image_downsize[2],
			);
		}
		$exact_size_int_w = (int) $exact_size['width'];
		$exact_size_int_h = (int) $exact_size['height'];
		if ( isset( $exact_size['width'] ) && $exact_size_int_w !== $exact_size_int_h ) {
			$img_size = $exact_size_int_w > $exact_size_int_h
				? $exact_size['height'] . 'x' . $exact_size['height']
				: $exact_size['width'] . 'x' . $exact_size['width'];
		}

		return $img_size;
	}

	protected function outputTitle( $title ) {
		return '';
	}

	protected function outputTitleTrue( $title ) {
		return '<h4 class="wpb_element_title">' . $title . ' ' . $this->settings( 'logo' ) . '</h4>';
	}
}

vc_map(
	array(
	   'name' => esc_html__('Single image','dfd-native'),
	   'base' => 'dfd_single_image',
	   'class' => 'dfd_single_image dfd_shortcode',
	   'icon' => 'dfd_single_image dfd_shortcode',
	   'category' => esc_html__('Native','dfd-native'),
	   'description' => esc_html__('Display single images with external links and hover effects','dfd-native'),
	   'params' => array(
			array(
				'type' => 'dfd_radio_advanced',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the image type. You can choose the image from the media library, add the external link or use the featured image of the page','dfd-native').'</span></span>'.esc_html__('Image type','dfd-native'),
				'param_name' => 'image_type',
				'value' => 'media_library',
				'options' => array(
					esc_attr__('Media gallery','dfd-native') => 'media_library',
					esc_attr__('External link','dfd-native') => 'external_link',
					esc_attr__('Page thumb','dfd-native') => 'featured_image',
				),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('External image url', 'dfd-native'),
				'param_name' => 'external_link_url',
				'dependency' => array('element' => 'image_type','value' => array('external_link')),
			),
			array(
				'type'				=> 'attach_image',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the image from the media library','dfd-native').'</span></span>'.esc_html__('Image','dfd-native'),
				'param_name'		=> 'image',
				'edit_field_class'	=> 'vc_column vc_col-sm-6',
				'dependency'		=> array('element' => 'image_type','value' => array('media_library')),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the border radius for the image. The value is not by default','dfd-native').'</span></span>'.esc_html__('Image border radius', 'dfd-native'),
				'param_name'		=> 'img_rounded',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
			),
			array(
				'type' => 'dfd_radio_advanced',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the size of the image','dfd-native').'</span></span>'.esc_html__('Image size','dfd-native'),
				'param_name' => 'image_size',
				'value' => 'full',
				'options' => array(
					esc_attr__('Full size','dfd-native') => 'full',
					esc_attr__('Medium','dfd-native') => 'medium',
					esc_attr__('Thumbnail','dfd-native') => 'thumb',
					esc_attr__('Custom size','dfd-native') => 'custom'
				),
				'dependency' => array('element' => 'image_type','value' => array('media_library')),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the width for the image','dfd-native').'</span></span>'.esc_html__('Image width', 'dfd-native'),
				'param_name' => 'image_width',
				'value' => 600,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
				'dependency' => array('element' => 'image_size','value' => array('custom')),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the height for the image','dfd-native').'</span></span>'.esc_html__('Image height', 'dfd-native'),
				'param_name' => 'image_height',
				'value' => 550,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
				'dependency' => array('element' => 'image_size','value' => array('custom')),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the image for the retina. If the option is enabled you can add the x2 or x4 image','dfd-native').'</span></span>'.esc_html__('Image for retina displays','dfd-native'),
				'param_name' => 'enable_retina',
				'value' => array(esc_attr__('Yes, please', 'dfd-native') => 'yes'),
				'options' => array(
					'yes' => array(
						'yes' => esc_attr__('Yes', 'dfd-native'),
						'no'  => esc_attr__('No', 'dfd-native'),
					),
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6',
				'dependency' => array('element' => 'image_type','value' => array('media_library')),
			),
			array(
				'type' => 'dfd_radio_advanced',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the size of the image on retina','dfd-native').'</span></span>'.esc_html__('Image size','dfd-native'),
				'param_name' => 'retina_image_size',
				'value' => '',
				'options' => array(
					esc_attr__('None','dfd-native') => '',
					esc_attr__('x2','dfd-native') => 'x2',
					esc_attr__('x4','dfd-native') => 'x4',
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6',
				'dependency' => array('element' => 'enable_retina','value' => array('yes')),
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__('Image for Retina x2','dfd-native'),
				'param_name' => 'retina_image_x2',
				'dependency' => array('element' => 'retina_image_size','value' => array('x2')),
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__('Image for Retina x4','dfd-native'),
				'param_name' => 'retina_image_x4',
				'dependency' => array('element' => 'retina_image_size','value' => array('x4')),
			),
			array(
				'type' => 'dfd_radio_advanced',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to align the image horizontally','dfd-native').'</span></span>'.esc_html__('Image alignment','dfd-native'),
				'param_name' => 'image_alignment',
				'value' => 'image-center',
				'options' => array(
					esc_attr__('Center','dfd-native') => 'image-center',
					esc_attr__('Left','dfd-native') => 'image-left',
					esc_attr__('Right','dfd-native') => 'image-right'
				),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the link for the image. If the option is enabled you can choose the lightbox, external link or use as one page scroll navigation','dfd-native').'</span></span>'.esc_html__('Link for image','dfd-native'),
				'param_name' => 'enable_link',
				'options' => array(
					'yes' => array(
						'yes' => esc_attr__('Yes', 'dfd-native'),
						'no'  => esc_attr__('No', 'dfd-native'),
					),
				),
			),
			array(
				'type' => 'dfd_radio_advanced',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Select the behavior for the link','dfd-native').'</span></span>'.esc_html__('Apply link to','dfd-native'),
				'param_name' => 'link_object',
				'value' => 'lightbox',
				'options' => array(
					esc_attr__('Lightbox','dfd-native') => 'lightbox',
					esc_attr__('External link','dfd-native') => 'link',
					esc_attr__('One page scroll nav','dfd-native') => 'onepage',
				),
				'dependency' => array('element' => 'enable_link','value' => array('yes')),
			),
			array(
				'type' => 'textfield',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the link for the image','dfd-native').'</span></span>'.esc_html__('External link url', 'dfd-native'),
				'param_name' => 'image_ext_link_url',
				'dependency' => array('element' => 'link_object','value' => array('link')),
			),
			array(
				'type' => 'dfd_radio_advanced',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Select the navigation direction, you can apply the link to next or previous slides. This option is available only for one page scroll templates','dfd-native').'</span></span>'.esc_html__('Navigate to','dfd-native'),
				'param_name' => 'onepage_navigate',
				'value' => 'slickPrev',
				'options' => array(
					esc_attr__('Prev. slide','dfd-native') => 'slickPrev',
					esc_attr__('Next slide','dfd-native') => 'slickNext',
				),
				'dependency' => array('element' => 'link_object','value' => array('onepage')),
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the hover effect for the image', 'dfd-native') . '</span></span>' .esc_html__('Image hover effect','dfd-native'),
				'param_name'		=> 'hover_style',
				'value'				=> '',
				'options'			=> array(
					esc_attr__('None','dfd-native') => '',
					esc_attr__('Shadow','dfd-native') => 'dfd-image-shadow',
					esc_attr__('Fade in','dfd-native') => 'dfd-image-fade-in',
					esc_attr__('Fade out','dfd-native') => 'dfd-image-fade-out',
					esc_attr__('Blur','dfd-native') => 'dfd-image-blur',
					esc_attr__('Grow','dfd-native') => 'dfd-image-scale',
					esc_attr__('Grow rotate','dfd-native') => 'dfd-image-scale-rotate',
					esc_attr__('Parallax','dfd-native') => 'panr',
				),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__( 'Shadow settings', 'dfd-native' ),
				'param_name'		=> 'shadow_settings_heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'dependency'		=> array('element' => 'hover_style','value' => array('dfd-image-shadow')),
			),
			array(
				'type'				=> 'dfd_box_shadow_param',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the shadow for the image','dfd-native').'</span></span>'.esc_html__('Box Shadow', 'dfd-native'),
				'param_name'		=> 'box_shadow',
				'value'				=> 'box_shadow_enable:enable|shadow_horizontal:0|shadow_vertical:15|shadow_blur:50|shadow_spread:0|box_shadow_color:rgba(255%2C255%2C255%2C0)',
				'dependency'		=> array('element' => 'hover_style','value' => array('dfd-image-shadow')),
			),
			array(
				'type'				=> 'dfd_box_shadow_param',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the shadow for the image on hover','dfd-native').'</span></span>'.esc_html__('Box Shadow on Hover', 'dfd-native'),
				'param_name'		=> 'hover_box_shadow',
				'value'				=> 'box_shadow_enable:enable|shadow_horizontal:0|shadow_vertical:15|shadow_blur:50|shadow_spread:0|box_shadow_color:rgba(0%2C0%2C0%2C0.35)',
				'dependency'		=> array('element' => 'hover_style','value' => array('dfd-image-shadow')),
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Extra features', 'dfd-native' ),
				'param_name'       => 'extra_features_elements_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
			),
			array(
			   'type'        => 'dropdown',
			   'heading'	 => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element','dfd-native').'</span></span>'.esc_html__('Animation', 'dfd-native'),
			   'param_name'  => 'module_animation',
			   'value'       => Dfd_Theme_Helpers::dfd_module_animation_styles(),
			),
			array(
				'type'		 => 'textfield',
				'heading'	 => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd-native').'</span></span>'.esc_html__('Custom CSS Class', 'dfd-native'),
				'param_name' => 'el_class',
			),
			array(
				'type'				=> 'dfd_video_link_param',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Video tutorial and theme documentation article','dfd-native').'</span></span>'.esc_html__('Tutorials','dfd-native'),
				'param_name'		=> 'tutorials',
				'doc_link'			=> '//nativewptheme.net/support/visual-composer/single-image',
				'video_link'		=> 'https://www.youtube.com/watch?v=yYa_WFsJkWk&feature=youtu.be',
			),
		),
	)
);
