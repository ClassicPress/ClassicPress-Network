<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

class DFD_Nav_Menu_Walker extends Walker_Nav_Menu {
	private $_last_ul = '';
	
	function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
		$id_field = $this->db_fields['id'];

		if (is_object($args[0])) {
			$args[0]->has_children = !empty($children_elements[$element->$id_field]);
			$args[0]->wide_menu = ($depth==0 && !empty($element->_dfd_mega_menu_enabled) && $element->_dfd_mega_menu_enabled==1);
			$args[0]->full_width_menu = ($depth==0 && !empty($element->_dfd_full_width_menu_enabled) && $element->_dfd_full_width_menu_enabled==1);
			$args[0]->dfd_mega_menu_image = ($depth==0 && !empty($element->_dfd_mega_menu_image)) ? $element->_dfd_mega_menu_image : '';
			$args[0]->dfd_mega_menu_bg_position = ($depth==0 && !empty($element->_dfd_mega_menu_bg_position)) ? $element->_dfd_mega_menu_bg_position : '';
			$args[0]->dfd_mega_menu_bg_repeat = ($depth==0 && !empty($element->_dfd_mega_menu_bg_repeat)) ? $element->_dfd_mega_menu_bg_repeat : '';
			$args[0]->dfd_mega_menu_limit_columns = ($depth==0 && !empty($element->_dfd_mega_menu_limit_columns)) ? $element->_dfd_mega_menu_limit_columns : '';
		}

		return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
	}

	function start_lvl(&$output, $depth = 0, $args = array()) {
		// depth dependent classes
		$indent = ( $depth > 0 ? str_repeat("\t", $depth) : '' ); // code indent
		$display_depth = ( $depth + 1); // because it counts the first submenu as 0

		$classes = array(
			'menu-depth-' . $display_depth
		);
		
		$data_atts = '';
		
		if(isset($args->dfd_mega_menu_limit_columns) && $args->dfd_mega_menu_limit_columns != '') {
			$data_atts = ' data-limit-columns="'.esc_attr($args->dfd_mega_menu_limit_columns).'"';
		}

		if ($display_depth==1) {
			$classes[] = 'sub-menu';
			
			if ($args->wide_menu) {
				$classes[] = 'sub-menu-wide';
			}
			
			if ($args->full_width_menu) {
				$classes[] = 'sub-menu-full-width';
			}
			
		} else if ($display_depth >= 2) {
			$classes[] = 'sub-sub-menu';
		}
		$subnav_bg_image_url = !empty($args->dfd_mega_menu_image) ? esc_attr($args->dfd_mega_menu_image) : '';
		$subnav_bg_position = !empty($args->dfd_mega_menu_bg_position) ? esc_attr($args->dfd_mega_menu_bg_position) : 'center center';
		$subnav_bg_repeat = !empty($args->dfd_mega_menu_bg_repeat) ? esc_attr($args->dfd_mega_menu_bg_repeat) : 'no-repeat';
		
		$subnav_bg_css = '';
		
		if ($args->wide_menu) {
			$subnav_bg_css .= 'style="';

			if(!empty($subnav_bg_image_url)) {
				$subnav_bg_css .= 'background-image: url('.$subnav_bg_image_url.');';
			}

			if(!empty($subnav_bg_position)) {
				$subnav_bg_css .= 'background-position: '.$subnav_bg_position.';';
			}

			if(!empty($subnav_bg_repeat)) {
				$subnav_bg_css .= 'background-repeat: '.$subnav_bg_repeat.';';
			}
			$subnav_bg_css .= '"';
		}
		
		$prefix = '';
		if ($depth==0) {
			$prefix = '<div class="sub-nav">';
			$classes[] = 'sub-nav-group';
		}
		
		$class_names = implode(' ', $classes);
		
		// build html output
		$output .= "\n" . $indent . $prefix . '<ul class="' . $class_names . '" '.$subnav_bg_css.' '.$data_atts.'>' . "\n";
	}
	
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$postfix = '';
		if ($depth==0) {
			$postfix = '</div>';
		}
		
		$output .= "{$indent}</ul>{$postfix}\n";
	}
	
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		global $wp_query;
		
		// code indent
		$indent = ( $depth > 0 ? str_repeat("\t", $depth) : '' );
		
		// depth dependent classes
		$depth_classes = array(
			( $depth == 0 ? 'nav-item' : 'sub-nav-item' ),
			'menu-item-depth-' . $depth,
		);

		if (!empty($item->_dfd_mega_menu_subtitle)  && ($depth>0)) {
			$depth_classes[] = 'mega-menu-item-has-subtitle';
		}
		
		if( in_array("current-menu-ancestor", $item->classes)) {
			$depth_classes[] = 'current-menu-ancestor';
		}
		
		if( in_array("current-menu-item", $item->classes)) {
			$depth_classes[] = 'current-menu-item';
		}
		
		if( in_array("current-menu-parent", $item->classes) ) {
			$depth_classes[] = 'current-menu-parent';
		}
		
		// build html
		if ($args->has_children) {
			$depth_classes[] = 'has-submenu';
		}
		
		if ($depth==0) {

			if ($args->full_width_menu) {
				$depth_classes[] = 'sub-menu-full-width';
			}
			
		}

		$depth_class_names = esc_attr(implode(' ', $depth_classes));
		
		$custom_class = '';
		if(isset($item->classes[0]) && !empty($item->classes[0])) {
			$custom_class .= $item->classes[0];
		}

		$output .= $indent . '<li id="nav-menu-item-' . esc_attr($item->ID) . '-' . esc_attr(uniqid()) . '" class="mega-menu-item ' . esc_attr($depth_class_names) . ' '.esc_attr($custom_class).'">';

		// link attributes
		$attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
		$attributes .=!empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
		$attributes .=!empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
		$attributes .=!empty($item->url) ? ' href="' . esc_url($item->url) . '"' : '';
		$attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link item-title' ) . '"';
		
		$icon = !empty($item->_dfd_mega_menu_icon) ? '<i class="'.$item->_dfd_mega_menu_icon.'"></i>' : '';
		if (!empty($item->_dfd_mega_menu_subtitle) && ($depth>0)) {
			$subtitle = !empty($item->_dfd_mega_menu_icon) ? '<span class="menu-subtitle has-icon">'.$item->_dfd_mega_menu_subtitle.'</span>' : '<span class="menu-subtitle">'.$item->_dfd_mega_menu_subtitle.'</span>';
		} else {
			$subtitle = '';
		}
	
		switch(true) {
			case ($depth == 0):
				$item_output = sprintf('%1$s<a%2$s>',
					$args->before, $attributes
				);

				$item_output .= sprintf('%s'.$subtitle,
					apply_filters('the_title', $icon.'<span>'.$item->title.'</span>', $item->ID)
				);

				$item_output .= sprintf('</a>%1$s', 
					$args->after
				);
				break;
			default: 
				$item_output = sprintf('%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
					$args->before, 
					$attributes, 
					$args->link_before,
					apply_filters('the_title', $icon.$item->title, $item->ID).$subtitle,
					$args->link_after, 
					$args->after
				);
		}
		if ($depth == 0) {
			
			
		} else {
			
		}

		// build html
		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}
	
	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}
}