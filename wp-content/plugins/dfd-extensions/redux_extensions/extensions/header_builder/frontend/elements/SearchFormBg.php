<?php
if (!defined('ABSPATH'))
	exit;
class DfdHeaderBuilder_SearchFormBg extends DfdHeaderBuilderElementAbstract {

//	protected $option_name = "show_search_form_header_5";
//	protected $template = "search";
	public function render() {
		?>
<div class="form-search-section">
	<div id="dfd-search-loader" class="pageload-overlay" data-opening="M 0,0 c 0,0 63.5,-16.5 80,0 16.5,16.5 0,60 0,60 L 0,60 Z">
		<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 80 60" preserveAspectRatio="none">
			<path d="M 0,0 c 0,0 -16.5,43.5 0,60 16.5,16.5 80,0 80,0 L 0,60 Z"/>
		</svg>
	</div>
	<div class="row">
		<?php echo get_template_part('templates/searchform'); ?>
	</div>
</div>
			<?php
	}
}
