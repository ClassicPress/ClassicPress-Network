<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<div class="form-search-container">
	<form role="search" method="get" id="searchform" class="form-search" action="<?php echo esc_url(home_url('/')); ?>">
		<label class="hide" for="s"><?php esc_html_e('Search for:', 'dfd-native'); ?></label>
		<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" class="search-query" placeholder="">
		<input type="submit" id="searchsubmit" value="" class="btn">
		<div class="searchsubmit-icon"><i class="dfd-socicon-search"></i></div>
	</form>
</div>