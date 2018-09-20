<?php
if (!defined('ABSPATH'))
	exit;
class DfdHeaderBuilder_SocialIcons extends DfdHeaderBuilderElementAbstract {

	public function render() {
		echo '<div class="widget soc-icons">';
		echo Dfd_Theme_Helpers::dfd_social_networks(true);
		echo '</div>';
	}

}
