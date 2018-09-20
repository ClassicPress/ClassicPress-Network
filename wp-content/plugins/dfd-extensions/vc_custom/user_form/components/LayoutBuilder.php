<?php

class Dfd_Contact_Form_Layout_Builder {

	function __construct() {
		
	}

	public function generate($data, $atts = array()) {
		$class = $result = '';
		$class_size = 'dfd-full-size-elements';
		if(isset($atts['button_aligned_sections']) && $atts['button_aligned_sections'] == 'lines') {
			$class = 'button-line-enable';
		}
		$count_row = count($data);
		$sizes_array = array (
				1 => "",
				2 => "dfd-half-size",
				3 => "dfd-third-size",
				4 => "dfd-fourth-size",
		);
		foreach ($data as $key_row => $row) {
			$columns = $row["presets"];
			$col_count = count($row["presets"]);

			foreach ($columns as $key_col => $col) {
				$size = $padding = $border = "";
				if ($col_count > 1) {
					$size = isset($sizes_array[$col_count]) ? $sizes_array[$col_count] : "";
					if ($key_col == 0) {
						$padding = "padding-left";
					}
					if(($key_col + 1) != $col_count){
						$border = "border-right";
					}
					if (($key_col + 1) == $col_count) {
						$padding = "padding-right";
					}
					if(($key_col != 0) && ($key_col + 1) != $col_count){
						$padding = "padding-center";
					}
//					if($col_count > 1){
						if($key_col!=0){
							$padding.=" margin-left-1 ";
						}
//					}
//					switch ($col_count) {
//						case 2:
//							break;
//						case 3:
//							break;
//						case 4:
//							break;
//					}
				}
				$result.='<p class="border-bottom ' . $size . ' ' . $padding . ' ' . $border . '">
							<span class="wpcf7-form-control-wrap ">
								{{field}}
							</span> 
						 </p>';
				if (($key_col + 1) == $col_count) {
						$result.=' <div class="clear"></div>';
				}
			}
			if(!empty($size)) {
				$class_size = $size.'-elements';
			}
		}
		$result_html = '{{hidden}}<div class="box '.$class.' '.$class_size.'">';
			$result_html .= $result;
		$result_html .= '</div>';
		
		return $result_html;
	}

}
