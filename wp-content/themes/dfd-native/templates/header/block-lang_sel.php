<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_native;
if (isset($dfd_native['wpml_lang_show']) && $dfd_native['wpml_lang_show']): ?>
	<div class="lang-sel dfd-wpml-switcher">
		<?php

		if(!function_exists('dfd_language_selector_flags')) {
			function dfd_language_selector_flags() {
				$switcher_html = $flag_html = $active_switcher_html = $active_item = $active_flag = '';
				if (function_exists('icl_get_languages')) {
					$languages = icl_get_languages('skip_missing=0&orderby=code');

					if (!empty($languages)) {
						foreach ($languages as $l) {
							$li_class = '';
							if(strcmp($l['active'], '0') != 0) {
								$active_item = $l['translated_name'];
								$active_flag = $l['country_flag_url'];
								$li_class = 'active';
								$active_switcher_html = '<a href="'.esc_url($l['url']).'"><span class="flag" style="background: transparent url('.esc_url($active_flag).') center center no-repeat;"></span><span>'.esc_html($active_item).'</span></a>';
							}
							
							$flag_html = '<span class="flag" style="background: transparent url('.$l['country_flag_url'].') center center no-repeat;"></span>';
							
							$switcher_html .= '<li class="'.esc_attr($li_class).'">';
								$switcher_html .= '<a href="' . esc_url($l['url']) . '">';
									$switcher_html .= $flag_html;
								$switcher_html .= '</a>';
							$switcher_html .= '</li>';
						}
					}
				} ?>

				<?php echo (!empty($active_switcher_html)) ? $active_switcher_html : ''; ?>
				
				<?php echo !empty($switcher_html) ? '<ul>'.$switcher_html.'</ul>' : ''; ?>
				
	<?php	}
		}

		dfd_language_selector_flags();
		?>
	</div>
<?php elseif (isset($dfd_native['lang_shortcode']) && $dfd_native['lang_shortcode']): ?>
	<?php echo do_shortcode($dfd_native['lang_shortcode']); ?>
<?php endif;
