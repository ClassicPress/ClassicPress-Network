<?php if(!defined('LS_ROOT_FILE')) { header('HTTP/1.0 403 Forbidden'); exit; } ?>
<script type="text/html" id="tmpl-activation">
	<div id="tmpl-activation-modal-window">

		<div id="tmpl-layers" class="kmui-prepend">
			<img id="tmpl-layer-10" src="<?php echo LS_ROOT_URL . '/static/admin/img/layer10.png' ?>" alt="layer">
			<img id="tmpl-layer-9" src="<?php echo LS_ROOT_URL . '/static/admin/img/layer9.png' ?>" alt="layer">
			<img id="tmpl-layer-8" src="<?php echo LS_ROOT_URL . '/static/admin/img/layer8.png' ?>" alt="layer">
			<img id="tmpl-layer-7" src="<?php echo LS_ROOT_URL . '/static/admin/img/layer7.png' ?>" alt="layer">
			<img id="tmpl-layer-6" src="<?php echo LS_ROOT_URL . '/static/admin/img/layer6.png' ?>" alt="layer">
			<img id="tmpl-layer-5" src="<?php echo LS_ROOT_URL . '/static/admin/img/layer5.png' ?>" alt="layer">
			<img id="tmpl-layer-4" src="<?php echo LS_ROOT_URL . '/static/admin/img/layer4.png' ?>" alt="layer">
			<img id="tmpl-layer-3" src="<?php echo LS_ROOT_URL . '/static/admin/img/layer3.png' ?>" alt="layer">
			<img id="tmpl-layer-2" src="<?php echo LS_ROOT_URL . '/static/admin/img/layer2.png' ?>" alt="layer">
			<img id="tmpl-layer-1" src="<?php echo LS_ROOT_URL . '/static/admin/img/layer1.png' ?>" alt="layer">
		</div>

		<div class="ls-activation-benefits">
			<h3>
				<span><?php _e('Activate LayerSlider to receive the following benefits:', 'LayerSlider') ?></span>
			</h3>
			<ul>
				<li>
					<i class="dashicons dashicons-update"></i>
					<strong><?php _e('Automatic Updates', 'LayerSlider') ?></strong>
					<small><?php _e('Always receive the latest LayerSlider version.', 'LayerSlider') ?></small>
				</li>
				<li>
					<i class="dashicons dashicons-editor-help"></i>
					<strong><?php _e('Product Support', 'LayerSlider') ?></strong>
					<small><?php _e('Direct help from our Support Team.', 'LayerSlider') ?></small>
				</li>
				<li>
					<i class="dashicons dashicons-star-filled"></i>
					<strong><?php _e('Exclusive Features', 'LayerSlider') ?></strong>
					<small><?php _e('Unlock exclusive and early-access features.', 'LayerSlider') ?></small>
				</li>
				<li>
					<i class="dashicons dashicons-store"></i>
					<strong><?php _e('Premium Slider Templates', 'LayerSlider') ?></strong>
					<small><?php _e('Access more templates to get started with projects.', 'LayerSlider') ?></small>
				</li>
			</ul>
		</div>

		<a href="<?php echo admin_url('admin.php?page=layerslider#activationBox') ?>" class="button-activation button button-primary button-hero"><?php _e('Activate Now', 'LayerSlider') ?></a>

		<a href="<?php echo admin_url('admin.php?page=layerslider-addons') ?>" target="_blank" class="button-add-ons button button-primary button-hero"><?php _e('Discover Add-Ons', 'LayerSlider') ?></a>

		<div class="ls-bundled-version">
			<h3>
				<span><?php _e('If LayerSlider came bundled in a theme', 'LayerSlider') ?></span>
			</h3>
			<p>
				<?php echo sprintf(
					__('Product activation is optional. Add-Ons and other benefits can enhance your content &amp; workflow, but they are not required to build sliders or access essential features. Product activation requires you to have a purchase code, which is payable if you have received LayerSlider with a theme. For more information, please read our %sactivation guide%s.', 'LayerSlider'),
					'<a href="https://layerslider.kreaturamedia.com/documentation/#activation" target="_blank">',
					'</a>'
					);
				?>
			</p>
		</div>

	</div>
</script>