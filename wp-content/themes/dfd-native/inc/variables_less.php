<?php
if(!class_exists('Dfd_Dynamic_Style_Vars')) {
	class Dfd_Dynamic_Style_Vars {		
		public static function return_vars() {
			global $dfd_native;
			
			$_variables = array();
			
			$_defaults = self::defaults();

			$_typography_defaults = self::typography_defautls();
		
			$_typography_option = self::typography_option();
		
			$_typography_option_name = array_keys($_typography_defaults);
			
			foreach($_defaults as $k => $v) {
				if(isset($dfd_native[$k]) && $dfd_native[$k] != '') {
					$_variables[$k] = $dfd_native[$k];
				} else {
					$_variables[$k] = $v;
				}
			}
			
			foreach($_typography_option_name as $k => $option) {
				foreach($_typography_option as $n => $prop) {
					$_typography_val = '';
					if(isset($dfd_native[$option.'_typography_option'][$prop]) && $dfd_native[$option.'_typography_option'][$prop] != '') {
						$_typography_val = $dfd_native[$option.'_typography_option'][$prop];
					} elseif(isset($_typography_defaults[$option][$prop]) && $_typography_defaults[$option][$prop] != '') {
						$_typography_val = $_typography_defaults[$option][$prop];
					}
					if($_typography_val != '') {
						if($prop == 'font-family') {
							$_typography_val = '"'.$_typography_val.'"';
						}
						$_variables[$option.'-'.$prop] = $_typography_val;
					}
				}
			}
			
			return $_variables;
		}
		
		public static function defaults() {
			return array(
				/*main color*/
				'main_site_color' => '#3498db',
				/*second color*/
				'secondary_site_color' => '#e9e9e9',
				/*third color*/
				'third_site_color' => '#34db83',
				/*Menu*/
				'top_menu_height' => '75',
				'menu_dropdown_hover_color' => '#3498db',
				'menu_dropdown_background' => '#ffffff',
				/*Mobile header*/
				'mobile_header_bg' => '#ffffff',
				'mobile_header_border_color' => '#e7e7e7',
				'mobile_header_color' => '#000000',
				'mobile_menu_bg' => '#1d1e20',
				'mobile_menu_delim' => '#232527',
				'mobile_submenu_bg' => '#191a1c',
				/*Sticky header*/
				'fixed_header_background_color' => 'rgba(22,22,22,0.6)',
				'fixed_header_border_color' => 'rgba(255,255,255,.1)',
				'fixed_header_text_color' => '#ffffff',
				/*Top inner page*/
				'top_panel_inner_background' => 'rgba(0,0,0,.93)',
				'top_panel_el_color' => '#ffffff',
				/*Header 1*/
				'header_top_panel_background_color_1' => '#ffffff',
				'header_top_panel_color_1' => '#313131',
				'header_background_color_1' => '#ffffff',
				'header_border_color_1' => '#e7e7e7',
				'header_text_color_1' => '#313131',
				/*Header 2*/
				'header_top_panel_background_color_2' => 'transparent',
				'header_top_panel_color_2' => '#ffffff',
				'header_background_color_2' => 'transparent',
				'header_border_color_2' => 'rgba(255,255,255,.1)',
				'header_text_color_2' => '#ffffff',
				/*Header 3*/
				'header_top_panel_background_color_3' => '#ffffff',
				'header_top_panel_color_3' => '#313131',
				'header_background_color_3' => '#ffffff',
				'header_border_color_3' => '#e7e7e7',
				'header_text_color_3' => '#313131',
				/*Header 4*/
				'header_top_panel_background_color_4' => 'transparent',
				'header_top_panel_color_4' => '#ffffff',
				'header_background_color_4' => 'transparent',
				'header_border_color_4' => 'rgba(255,255,255,.1)',
				'header_text_color_4' => '#ffffff',
				/*Header 5*/
				'header_top_panel_background_color_5' => '#ffffff',
				'header_top_panel_color_5' => '#313131',
				'header_background_color_5' => '#ffffff',
				'header_border_color_5' => '#e7e7e7',
				'header_text_color_5' => '#313131',
				/*Header 6*/
				'header_top_panel_background_color_6' => 'transparent',
				'header_top_panel_color_6' => '#ffffff',
				'header_background_color_6' => 'transparent',
				'header_border_color_6' => 'rgba(255,255,255,.1)',
				'header_text_color_6' => '#ffffff',
				/*Header 7*/
				'header_background_color_7' => 'transparent',
				'header_border_color_7' => 'rgba(255,255,255,.1)',
				'header_text_color_7' => '#ffffff',
				/*Header 8*/
				'header_background_color_8' => 'transparent',
				'header_border_color_8' => 'rgba(255,255,255,.1)',
				'header_text_color_8' => '#ffffff',
				'header_active_background_color_8' => '#1b1b1b',
				'header_active_text_color_8' => '#ffffff',
				/*Header 9*/
				'header_background_color_9' => 'transparent',
				'header_border_color_9' => 'rgba(255,255,255,.1)',
				'header_text_color_9' => '#ffffff',
				'header_active_background_color_9' => '#1b1b1b',
				'header_active_text_color_9' => '#ffffff',
				/*Header 10*/
				'header_background_color_10' => '#ffffff',
				'header_border_color_10' => '#e7e7e7',
				'header_text_color_10' => '#000000',
				/*Header 11*/
				'header_background_color_11' => 'transparent',
				'header_border_color_11' => 'rgba(255,255,255,.1)',
				'header_text_color_11' => '#ffffff',
				/*Header 12*/
				'header_background_color_12' => '#ffffff',
				'header_text_color_12' => '#000000',
				'bg_image_header_12' => array(),
				/*Header 13*/
				'header_background_color_13' => '#ffffff',
				'header_text_color_13' => '#000000',
				'header_navbutton_background_color_13' => '#ffffff',
				'header_navbutton_text_color_13' => '#000000',
				'bg_image_header_13' => array(),
				/*Header 14*/
				'header_background_color_14' => '#ffffff',
				'header_text_color_14' => '#000000',
				/*Side area*/
				'side_area_bg_color' => '#1d1e20',
				'side_area_bg_image' => array(),
				'side_area_bg_position' => 'center center',
				'side_area_bg_repeat' => 'no-repeat',
				'side_area_bg_size' => 'cover',
				/*Button*/
				'default_button_background' => '#3498db',
				'default_button_border' => '#3498db',
				'default_button_hover_color' => '#ffffff',
				'default_button_hover_bg' => '#2f77a8',
				'default_button_hover_border' => '#2f77a8',
				'default_button_border_width' => '0',
				'default_button_border_style' => 'solid',
				'default_button_border_radius' => '43',
				'default_button_padding_left' => '30',
				'default_button_padding_right' => '30',
				/*Portfolio hover*/
				'portfolio_hover_text_color' => '#ffffff',
				'portfolio_hover_mask_bordered_bg' => '#ffffff',
				'portfolio_hover_buttons_bg' => 'rgba(255,255,255,.1)',
				/*Gallery hover*/
				'gallery_hover_text_color' => '#ffffff',
				'gallery_hover_mask_bordered_bg' => '#ffffff',
				'gallery_hover_buttons_bg' => 'rgba(255,255,255,.1)',
				/*Lightbox*/
				'lightbox_elements_color' => '#ffffff',
				'lightbox_overley_bg_color' => '#000000',
				/*WooCommerce*/
				'woo_star_rating_color' => '#f4b900',
				'woo_products_sale_badge_position' => 'left',
				'woo_products_sale_badge_bg' => '#f4b900',
				'woo_products_sale_badge_border_radius' => '4',
				/*Wite space*/
				'layout_whitespace_size' => '30',
				'layout_whitespace_color' => '#ffffff',
				/*Back to top*/
				'btt_button_background' => 'rgba(0,0,0,.25)',
				'btt_button_hover_bg' => '#3498db',
				'btt_button_border_width' => '0',
				'btt_button_border_style' => 'solid',
				'btt_button_border_radius' => '50',
				'btt_button_border' => 'rgba(0,0,0,.25)',
				'btt_button_hover_border' => '#3498db',
				'btt_button_icon' => '#ffffff',
				'btt_button_hover_icon' => '#ffffff',
				'btt_button_icon_size' => '9',
				'btt_button_size' => '42',
				'btt_button_mobile_size' => '30',
				'btt_button_icon_mobile_size' => '8',
				/*Header builder*/
				'header_top_background_color_build'=>'#ffffff',
				'header_mid_background_color_build'=>'#ffffff',
				'header_bot_background_color_build'=>'#ffffff',
				'header_top_text_color_build'=>'#313131',
				'header_mid_text_color_build'=>'#313131',
				'header_bot_text_color_build'=>'#313131',
				'header_border_color_build'=>'#e7e7e7',
				'header_side_background_color_builder'=>'#ffffff',
			);
		}
		
		public static function typography_defautls() {
			return array(
				'h1' => array(
					'font-family' => 'Montserrat',
					'font-size' => '45px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '50px',
					'letter-spacing' => '-3px',
					'color' => '#313131',
				),
				'h2' => array(
					'font-family' => 'Montserrat',
					'font-size' => '35px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '40px',
					'letter-spacing' => '-2px',
					'color' => '#313131',
				),
				'h3' => array(
					'font-family' => 'Montserrat',
					'font-size' => '30px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '35px',
					'letter-spacing' => '-1px',
					'color' => '#2d2d2d',
				),
				'h4' => array(
					'font-family' => 'Montserrat',
					'font-size' => '25px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '30px',
					'letter-spacing' => '-1px',
					'color' => '#313131',
				),
				'h5' => array(
					'font-family' => 'Montserrat',
					'font-size' => '20px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '25px',
					'letter-spacing' => '-1px',
					'color' => '#2b2b2b',
				),
				'h6' => array(
					'font-family' => 'Montserrat',
					'font-size' => '16px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '18px',
					'letter-spacing' => '-.5px',
					'color' => '#2b2b2b',
				),
				'content_title_big' => array(
					'font-family' => 'Montserrat',
					'font-size' => '18px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '18px',
					'letter-spacing' => '-.4px',
					'color' => '#2b2b2b',
				),
				'content_title_small' => array(
					'font-family' => 'Montserrat',
					'font-size' => '10px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'uppercase',
					'line-height' => '10px',
					'letter-spacing' => '.6px',
					'color' => '#9c9c9c',
				),
				'content_subtitle' => array(
					'font-family' => 'Open Sans',
					'font-size' => '13px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '13px',
					'letter-spacing' => '0px',
					'color' => '#b5b5b5',
				),
				'form_heading' => array(
					'font-family' => 'Montserrat',
					'font-size' => '25px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '25px',
					'letter-spacing' => '-.6px',
					'color' => '#2d2d2d',
				),
				'top_info' => array(
					'font-family' => 'Open Sans',
					'font-size' => '12px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '25px',
					'letter-spacing' => '0',
					'color' => '#313131',
				),
				'header_links' => array(
					'font-family' => 'Open Sans',
					'font-size' => '12px',
					'font-style' => 'normal',
					'font-weight' => '600',
					'text-transform' => 'none',
					'line-height' => '25px',
					'letter-spacing' => '0px',
					'color' => '#313131',
				),
				'menu_title_big' => array(
					'font-family' => 'Montserrat',
					'font-size' => '25px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '25px',
					'letter-spacing' => '-.8px',
					'color' => '#ffffff',
				),
				'menu_title' => array(
					'font-family' => 'Montserrat',
					'font-size' => '13px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '13px',
					'letter-spacing' => '-1px',
					'color' => '#313131',
				),
				'menu_subitem_title' => array(
					'font-family' => 'Montserrat',
					'font-size' => '10px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'uppercase',
					'line-height' => '10px',
					'letter-spacing' => '1.2px',
					'color' => '#262626',
				),
				'menu_subitem' => array(
					'font-family' => 'Open Sans',
					'font-size' => '13px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '13px',
					'letter-spacing' => '-.2px',
					'color' => '#5c5c5c',
				),
				'menu_subitem_subtitle' => array(
					'font-family' => 'Open Sans',
					'font-size' => '12px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '20px',
					'letter-spacing' => '0px',
					'color' => '#c3c3c3',
				),
				'mobile_menu_title' => array(
					'font-family' => 'Montserrat',
					'font-size' => '10px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'uppercase',
					'line-height' => '1',
					'letter-spacing' => '.8px',
					'color' => '#ffffff',
				),
				'mobile_menu_subitem' => array(
					'font-family' => 'Open Sans',
					'font-size' => '13px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '1',
					'letter-spacing' => '0',
					'color' => '#999999',
				),
				'mobile_menu_subitem_subtitles' => array(
					'font-family' => 'Open Sans',
					'font-size' => '13px',
					'font-style' => 'italic',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '1',
					'letter-spacing' => '0',
					'color' => '#999999',
				),
				'stunning_header_title' => array(
					'font-family' => 'Montserrat',
					'font-size' => '50px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '1.2',
					'letter-spacing' => '-3px',
					'color' => '#313131',
				),
				'stunning_header_subtitle' => array(
					'font-family' => 'Open Sans',
					'font-size' => '24px',
					'font-style' => 'normal',
					'font-weight' => '300',
					'text-transform' => 'none',
					'line-height' => '1.25',
					'letter-spacing' => '0px',
					'color' => '#c3c3c3',
				),
				'stunning_header_breadcrumbs' => array(
					'font-family' => 'Open Sans',
					'font-size' => '12px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '14px',
					'letter-spacing' => '0',
					'color' => '#9c9c9c',
				),
				'default_text' => array(
					'font-family' => 'Open Sans',
					'font-size' => '14px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '28px',
					'letter-spacing' => '0',
					'color' => '#7b7b7b',
				),
				'featured_decoration' => array(
					'font-family' => 'Open Sans',
					'font-size' => '14px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '18px',
					'letter-spacing' => '0',
					'color' => '#7b7b7b',
				),
				'quote' => array(
					'font-family' => 'Open Sans',
					'font-size' => '20px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '40px',
					'letter-spacing' => '-.5px',
					'color' => '#2e2e2e',
				),
				'link' => array(
					'font-family' => '',
					'font-size' => '',
					'font-style' => '',
					'font-weight' => '',
					'text-transform' => '',
					'line-height' => '',
					'letter-spacing' => '',
					'color' => '',
				),
				'meta' => array(
					'font-family' => 'Montserrat',
					'font-size' => '11px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '11px',
					'letter-spacing' => '0',
					'color' => '#9c9c9c',
				),
				'pagination' => array(
					'font-family' => 'Montserrat',
					'font-size' => '11px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'uppercase',
					'line-height' => '43px',
					'letter-spacing' => '.8px',
					'color' => '#292929',
				),
				'blog_title' => array(
					'font-family' => 'Montserrat',
					'font-size' => '21px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '1.238',
					'letter-spacing' => '-1.2px',
					'color' => '#313131',
				),
				'blog_featured_quote' => array(
					'font-family' => 'Montserrat',
					'font-size' => '28px',
					'font-style' => 'normal',
					'font-weight' => '900',
					'text-transform' => 'none',
					'line-height' => '37px',
					'letter-spacing' => '-.8px',
					'color' => '#3498db',
				),
				'blog_quote' => array(
					'font-family' => 'Montserrat',
					'font-size' => '18px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '30px',
					'letter-spacing' => '-.8px',
					'color' => '#313131',
				),
				'blog_quote_author' => array(
					'font-family' => 'Montserrat',
					'font-size' => '10px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'uppercase',
					'line-height' => '1',
					'letter-spacing' => '.5px',
					'color' => '#9c9c9c',
				),
				'blog_link_post_url' => array(
					'font-family' => 'Montserrat',
					'font-size' => '14px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '1',
					'letter-spacing' => '.5px',
					'color' => '#7b7b7b',
				),
				'blog_author' => array(
					'font-family' => 'Montserrat',
					'font-size' => '11px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '1',
					'letter-spacing' => '-.5px',
					'color' => '#313131',
				),
				'blog_category' => array(
					'font-family' => 'Montserrat',
					'font-size' => '10px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'uppercase',
					'line-height' => '10px',
					'letter-spacing' => '.5px',
					'color' => '#ffffff',
				),
				'portfolio_title' => array(
					'font-family' => 'Montserrat',
					'font-size' => '18px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '18px',
					'letter-spacing' => '-.4px',
					'color' => '#2b2b2b',
				),
				'portfolio_subtitle' => array(
					'font-family' => 'Open Sans',
					'font-size' => '13px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '13px',
					'letter-spacing' => '0px',
					'color' => '#b5b5b5',
				),
				'portfolio_description_title' => array(
					'font-family' => 'Montserrat',
					'font-size' => '12px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'uppercase',
					'line-height' => '12px',
					'letter-spacing' => '.6px',
					'color' => '#222222',
				),
				'gallery_title' => array(
					'font-family' => 'Montserrat',
					'font-size' => '18px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '18px',
					'letter-spacing' => '-.4px',
					'color' => '#2b2b2b',
				),
				'gallery_subtitle' => array(
					'font-family' => 'Open Sans',
					'font-size' => '13px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '13px',
					'letter-spacing' => '0px',
					'color' => '#b5b5b5',
				),
				'widget_title' => array(
					'font-family' => 'Montserrat',
					'font-size' => '12px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'uppercase',
					'line-height' => '1.6',
					'letter-spacing' => '.6px',
					'color' => '#222222',
				),
				'widget_big_title' => array(
					'font-family' => 'Montserrat',
					'font-size' => '18px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '26px',
					'letter-spacing' => '-.6px',
					'color' => '#313131',
				),
				'widget_post_title' => array(
					'font-family' => 'Montserrat',
					'font-size' => '15px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '22px',
					'letter-spacing' => '-.6px',
					'color' => '#363535',
				),
				'widget_content_title' => array(
					'font-family' => 'Montserrat',
					'font-size' => '10px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'uppercase',
					'line-height' => '22px',
					'letter-spacing' => '.6px',
					'color' => '#3a3a3a',
				),
				'widget_comment_title' => array(
					'font-family' => 'Montserrat',
					'font-size' => '11px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '18px',
					'letter-spacing' => '-.4px',
					'color' => '#363535',
				),
				'widget_list_content' => array(
					'font-family' => 'Montserrat',
					'font-size' => '12px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '1',
					'letter-spacing' => '-.4px',
					'color' => '#2b2b2b',
				),
				'default_button' => array(
					'font-family' => 'Montserrat',
					'font-weight'  => '700',
					'font-style'  => 'normal',
					'font-size'   => '11px',
					'line-height' => '43px',
					'text-transform'=> 'uppercase',
					'letter-spacing'=> '.8px',
					'color'	=> '#ffffff',
				),
				'single_product_title' => array(
					'font-family' => 'Montserrat',
					'font-size' => '30px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '30px',
					'letter-spacing' => '-2px',
					'color' => '#272727',
				),
				'single_product_subtitle' => array(
					'font-family' => 'Open Sans',
					'font-size' => '14px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '14px',
					'letter-spacing' => '0px',
					'color' => '#7f7f7f',
				),
				'single_product_price' => array(
					'font-family' => 'Montserrat',
					'font-size' => '30px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '30px',
					'letter-spacing' => '-.4px',
					'color' => '#272727',
				),
				'loop_product_title' => array(
					'font-family' => 'Montserrat',
					'font-size' => '15px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'none',
					'line-height' => '18px',
					'letter-spacing' => '-.4px',
					'color' => '#2d2d2d',
				),
				'loop_product_price' => array(
					'font-family' => 'Montserrat',
					'font-size' => '13px',
					'font-style' => 'normal',
					'font-weight' => '700',
					'text-transform' => 'uppercase',
					'line-height' => '15px',
					'letter-spacing' => '-.4px',
					'color' => '#272727',
				),
			);
		}
		public static function typography_option() {
			return array(
				1 => 'font-style',
				2 => 'font-weight',
				3 => 'font-family',
				4 => 'font-size',
				5 => 'line-height',
				6 => 'text-transform',
				7 => 'letter-spacing',
				8 => 'color'
			);
		}
	}
	
	$vars = Dfd_Dynamic_Style_Vars::return_vars();
	
	$vars['main_color_darken_5'] = Dfd_Theme_Helpers::adjustBrightness($vars['main_site_color'], -7);
	
	$vars['secondary_site_color_darken_6'] = Dfd_Theme_Helpers::adjustBrightness($vars['secondary_site_color'], -6);
	
	$vars['secondary_site_color_darken_12'] = Dfd_Theme_Helpers::adjustBrightness($vars['secondary_site_color'], -12);
	
	$vars['secondary_site_color_darken_50'] = Dfd_Theme_Helpers::adjustBrightness($vars['secondary_site_color'], -50);
	
	$vars['default_text-color_darken_10'] = Dfd_Theme_Helpers::adjustBrightness($vars['default_text-color'], -18);
	
	$vars['secondary_site_color_light_4'] = Dfd_Theme_Helpers::adjustBrightness($vars['secondary_site_color'], 3.7);
	
	$vars['third_color_darken_5'] = Dfd_Theme_Helpers::adjustBrightness($vars['third_site_color'], -7);
}
