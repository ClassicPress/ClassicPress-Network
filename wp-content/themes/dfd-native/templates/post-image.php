<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<div class="entry-thumb">
	<?php
	if(!is_single()) {
		get_template_part('templates/entry-meta/mini', 'category-highlighted');
	}
	?>
	<?php the_content(); ?>
</div>