<?php if(!defined('LS_ROOT_FILE')) { header('HTTP/1.0 403 Forbidden'); exit; } ?>

<script type="text/html" id="tmpl-ls-gdpr-consent">
	<div id="tmpl-gdpr-modal-window">

		<form action="post">
			<input type="hidden" name="action" value="ls_save_gdpr_settings">
			<?php wp_nonce_field('ls-save-gdpr-settings'); ?>

			<!-- STEP 1: LAYERSLIDER, YOUR DATA AND YOU -->
			<div id="ls-gdpr-step-1" class="ls-gdpr-step">
				<h1><?php _e('LAYERSLIDER, YOUR DATA AND YOU', 'LayerSlider') ?></h1>
				<p>
					<?php echo sprintf(__('Thank you for your support and trust in Kreatura when using our products and services. To keep pace with the new data protection laws taking effect on May 25, 2018 in the European Union, we are updating our privacy policies. Please, do visit our %sGeneral Data Protection Regulation%s page for more information.', 'LayerSlider'), '<a href="https://layerslider.kreaturamedia.com/gdpr" target="_blank">', '</a>'); ?>
				</p>
				<p>
					<?php _e('We encourage you to review the new changes to our policies. We appreciate your kind understanding as we offer our users to make the best decisions about the information they share with us.', 'LayerSlider'); ?>
				</p>
				<p>
					<?php _e('By using our products and services on or after May 25, 2018, you will be agreeing to these updates.', 'LayerSlider') ?>
				</p>

				<div class="ls-gdpr-bottom">

					<span class="ls-gdpr-steps">
						<?php echo sprintf(__('%1$s of %2$s steps', 'LayerSlider'), '1', '3') ?>
					</span>

					<a href="#" class="button button-hero button-next"><?php _e('Next', 'LayerSlider') ?></a>
				</div>
			</div>

			<!-- STEP 2: Google Fonts -->
			<div id="ls-gdpr-step-2" class="ls-gdpr-step">
				<h1><?php _e('Google Fonts: Hundreds of beautiful fonts for the web', 'LayerSlider') ?></h1>
				<p>
					<?php echo sprintf( __('%sWhat is it:%s Google Fonts offers hundreds of custom fonts and is one of the most popular web services to customize website appearance with beautiful typography.', 'LayerSlider'), '<strong>', '</strong>') ?>
				</p>
				<p>
					<?php echo sprintf( __('%sWhy is it important:%s Many of our importable content in the Template Store use and rely on Google Fonts. If you disable this feature, you may not be able to add custom fonts and it might compromise the appearance of textual content in sliders. Third parties can offer the same functionality, but they are also subjected to Google’s data processing.', 'LayerSlider') , '<strong>', '</strong>') ?>
				</p>
				<p>
					<?php echo sprintf( __('%sWhy should I care:%s Google might be able to track your activity when using their services. Please review Google’s %sPrivacy Policy%s and %sGDPR Compliance%s. As an external service, you can choose to disable Google Fonts if you disagree with Google’s data processing methods.', 'LayerSlider'), '<strong>', '</strong>', '<a href="https://privacy.google.com/" target="_blank">', '</a>', '<a href="https://privacy.google.com/businesses/compliance" target="_blank">', '</a>') ?>
				</p>
				<p>
					<input type="checkbox" name="ls_gdpr_goole_fonts" class="larger" checked>
					<?php _e('Enable Google Fonts', 'LayerSlider') ?>
				</p>
				<p>
					<img src="<?php echo LS_ROOT_URL.'/static/admin/img/google-fonts.png' ?>" alt="Google Fonts">
				</p>


				<div class="ls-gdpr-bottom">

					<span class="ls-gdpr-steps">
						<?php echo sprintf(__('%1$s of %2$s steps', 'LayerSlider'), '2', '3') ?>
					</span>

					<a href="#" class="button button-hero button-next"><?php _e('Next', 'LayerSlider') ?></a>
				</div>
			</div>


			<!-- STEP 3: Adobe Image Editor -->
			<div id="ls-gdpr-step-3" class="ls-gdpr-step">
				<h1><?php _e('Adobe Creative SDK: A Photoshop-like Image Editor', 'LayerSlider') ?></h1>
				<p>
					<?php echo sprintf( __('%sWhat is it:%s As part of the Adobe Creative SDK, Adobe offers a Photoshop-like image editor for the web. LayerSlider uses this service, so you can perform common tasks like resizing, cropping, rotating images, as well as photo retouching, adding frames, text, effects, stickers and a lot more.', 'LayerSlider'), '<strong>', '</strong>') ?>
				</p>
				<p>
					<?php echo sprintf( __('%sWhy is it important:%s If you disable this feature, you may need to use a dedicated software installed on your computer (e. g. Photoshop) to perform these tasks.', 'LayerSlider'), '<strong>', '</strong>') ?>
				</p>
				<p>
					<?php echo sprintf(__('%sWhy should I care:%s Adobe might be able to track your activity when using their services. Please review Adobe’s %sPrivacy Policy%s and %sGDPR Compliance%s. As an external service, you can choose to disable the image editor feature if you disagree with Adobe’s data processing methods.', 'LayerSlider'), '<strong>', '</strong>', '<a href="https://www.adobe.com/privacy/policy.html" target="_blank">', '</a>', '<a href="https://www.adobe.com/privacy/general-data-protection-regulation.html" target="_blank">', '</a>') ?>
				</p>
				<p>
					<input type="checkbox" name="ls_gdpr_aviary" class="larger" checked>
					<?php _e('Enable Adobe Image Editor', 'LayerSlider') ?>
				</p>
				<p>
					<img src="<?php echo LS_ROOT_URL.'/static/admin/img/adobe-image-editor.png' ?>" alt="Adobe Creative SDK Image Editor">
				</p>


				<div class="ls-gdpr-bottom">

					<span class="ls-gdpr-steps">
						<?php echo sprintf(__('%1$s of %2$s steps', 'LayerSlider'), '3', '3') ?>
					</span>

					<a href="#" class="button button-hero button-next"><?php _e('Next', 'LayerSlider') ?></a>
				</div>
			</div>


			<!-- STEP 4: Thank you -->
			<div id="ls-gdpr-step-4" class="ls-gdpr-step">
				<h1><?php _e('Thank you', 'LayerSlider') ?></h1>
				<p>
					<?php echo sprintf( __('Thank you for your time and taking data security seriously. As a reminder, you can update these settings at any time if you ever change your mind. Just navigate to the %sLayerSlider -> Options -> Privacy%s page from your WordPress admin sidebar.', 'LayerSlider'), '<strong>', '</strong>') ?>
				</p>

				<div class="ls-gdpr-bottom">
					<a href="#" class="button button-hero button-next"><?php _e('Finish', 'LayerSlider') ?></a>
				</div>
			</div>
		</form>
	</div>
</script>