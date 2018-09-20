<?php
if (!defined('ABSPATH'))
	exit;
class DfdHeaderBuilder_InnerPageBg extends DfdHeaderBuilderElementAbstract {

	public function render() {
		$options = DfdHeaderBuilder_ReduxOptions::instance();
//		$enable = $options->isTopPanelEnabled();
		$enable = true;
		$page_id = $options->geTopPanelPageId();
		if ($enable && !empty($page_id)) {

			global $dfd_native;

			$top_inner_page_id = $page_id;

			$page_data = get_page($top_inner_page_id);

			if (!empty($page_data) && isset($page_data->post_status) && strcmp($page_data->post_status, 'publish') === 0) {

				$wp_the_query = new WP_Query(array (
						'page_id' => $top_inner_page_id,
				));

				if ($wp_the_query->have_posts()) {
					$wp_the_query->the_post();

					get_template_part('templates/header/block', 'toppanel-animation');

					wp_reset_postdata();
				}
			}
		}
	}

}
