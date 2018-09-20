<div class="onclick-menu-wrap dfd-mobile-header-hide">
	<div class="dfd-click-menu-button-wrap">
		<div class="dfd-click-menu-activation-button">
			<a href="#" title="menu" class="dfd-menu-button">
				<span class="icon-wrap dfd-top-line"></span>
				<span class="icon-wrap dfd-middle-line"></span>
				<span class="icon-wrap dfd-bottom-line"></span>
			</a>
		</div>
	</div>
	<div class="onclick-menu-cover">
		<nav class="onclick-menu clearfix">
			<?php
				wp_nav_menu(array(
					'theme_location' => 'primary_navigation', 
					'menu_class' => 'onclick-nav-menu menu-clonable-for-mobiles', 
					'fallback_cb' => 'top_menu_fallback'
				));
			?>
		</nav>
	</div>
</div>