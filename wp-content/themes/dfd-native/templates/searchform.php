<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$id_s = uniqid('s_'); ?>
<form role="search" method="get" id="<?php echo uniqid('searchform_'); ?>" class="form-search" action="<?php echo esc_url(home_url('/')); ?>">
	<input type="text" value="<?php if (is_search()) { echo get_search_query(); } ?>" name="s" id="<?php echo esc_attr($id_s); ?>" class="search-query" placeholder="<?php esc_html_e('Search on site...', 'dfd-native'); ?>">
	<span class="dfd-background-main" style="display: none;"></span>
	<input type="submit" value="<?php esc_html_e('Search', 'dfd-native'); ?>" class="btn">
	<i class="dfd-socicon-Search inside-search-icon"></i>
	<i class="header-search-switcher close-search"></i>
	<?php do_action( 'wpml_add_language_form_field' ); ?>
</form>
