<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $dfd_native;

$row_class = '';

if(isset($dfd_native['footer_layout_width']) && $dfd_native['footer_layout_width'] != '') {
	$row_class .= $dfd_native['footer_layout_width'];
}

$columns_count = 0;
for($i = 1; $i < 5; $i++) {
	(is_active_sidebar('sidebar-footer-col'.$i)) ? $columns_count++ : 0;
}
$columns_number = Dfd_Theme_Helpers::dfd_num_to_string($columns_count);

if ( $columns_count > 0 ) : ?>
	<div class="row <?php echo esc_attr($row_class) ?>">
		<?php
		$counter = 0;
		for ($i = 1; $i < $columns_count + 1; $i++) {
			$counter++;
			?>
			<div class="<?php echo esc_attr($columns_number); ?> columns">
				<?php dynamic_sidebar('sidebar-footer-col' . $i); ?>
			</div>
		<?php
		}
	?>
	</div>
<?php endif;