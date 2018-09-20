<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if (!class_exists('DFD_Edit_Menu_Walker')) {

	class DFD_Edit_Menu_Walker extends Walker_Nav_Menu {
		/**
		 * Starts the list before the elements are added.
		 *
		 * @see Walker_Nav_Menu::start_lvl()
		 *
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   Not used.
		 */
		function start_lvl( &$output, $depth = 0, $args = array() ) {}

		/**
		 * Ends the list of after the elements are added.
		 *
		 * @see Walker_Nav_Menu::end_lvl()
		 *
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   Not used.
		 */
		function end_lvl( &$output, $depth = 0, $args = array() ) {}

		/**
		 * Start the element output.
		 *
		 * @see Walker_Nav_Menu::start_el()
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item   Menu item data object.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   Not used.
		 * @param int    $id     Not used.
		 */
		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			global $_wp_nav_menu_max_depth;
			
			$mega_menu_class = DFD_MEGA_MENU_CLASS;
			$mega_menu_class_e = new $mega_menu_class();
			$mega_menu_class_options = $mega_menu_class_e->options();
			
			$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

			ob_start();
			$item_id = esc_attr( $item->ID );
			$removed_args = array(
				'action',
				'customlink-tab',
				'edit-menu-item',
				'menu-item',
				'page-tab',
				'_wpnonce',
			);

			$original_title = '';
			if ( 'taxonomy' == $item->type ) {
				$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
				if ( is_wp_error( $original_title ) )
					$original_title = false;
			} elseif ( 'post_type' == $item->type ) {
				$original_object = get_post( $item->object_id );
				
				if (isset($original_object->ID)) {
					$original_title = get_the_title( $original_object->ID );
				} else {
					$original_title = '';
				}
			}

			$classes = array(
				'menu-item menu-item-depth-' . $depth,
				'menu-item-' . esc_attr( $item->object ),
				'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
			);

			$title = $item->title;

			if ( ! empty( $item->_invalid ) ) {
				$classes[] = 'menu-item-invalid';
				/* translators: %s: title of menu item which is invalid */
				$title = sprintf( esc_html__( '%s (Invalid)', 'dfd-native' ), $item->title );
			} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
				$classes[] = 'pending';
				/* translators: %s: title of menu item in draft status */
				$title = sprintf( esc_html__( '%s (Pending)', 'dfd-native' ), $item->title );
			}

			$title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

			?>
			<li id="menu-item-<?php echo esc_attr($item_id); ?>" class="<?php echo implode(' ', $classes ); ?>">
				<dl class="menu-item-bar">
					<dt class="menu-item-handle">
						<span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo ( 0 == $depth ) ? 'style="display: none;"' : ''; ?>><?php esc_html_e( 'sub item', 'dfd-native' ); ?></span></span>
						<span class="item-controls">
							<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
							<span class="item-order hide-if-js">
								<a href="<?php
									echo wp_nonce_url(
										add_query_arg(
											array(
												'action' => 'move-up-menu-item',
												'menu-item' => $item_id,
											),
											remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
										),
										'move-menu_item'
									);
								?>" class="item-move-up"><abbr title="<?php esc_attr_e( 'Move up', 'dfd-native' ); ?>">&#8593;</abbr></a>
								|
								<a href="<?php
									echo wp_nonce_url(
										add_query_arg(
											array(
												'action' => 'move-down-menu-item',
												'menu-item' => $item_id,
											),
											remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
										),
										'move-menu_item'
									);
								?>" class="item-move-down"><abbr title="<?php esc_attr_e( 'Move down', 'dfd-native' ); ?>">&#8595;</abbr></a>
							</span>
							<a class="item-edit" id="edit-<?php echo esc_attr($item_id); ?>" title="<?php esc_attr_e( 'Edit Menu Item', 'dfd-native' ); ?>" href="<?php
								echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
							?>"><?php esc_html_e( 'Edit Menu Item', 'dfd-native' ); ?></a>
						</span>
					</dt>
				</dl>

				<div class="menu-item-settings" id="menu-item-settings-<?php echo esc_attr($item_id); ?>">
					<?php if( 'custom' == $item->type ) : ?>
						<p class="field-url description description-wide">
							<label for="edit-menu-item-url-<?php echo esc_attr($item_id); ?>">
								<?php esc_html_e( 'URL', 'dfd-native' ); ?><br />
								<input type="text" id="edit-menu-item-url-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
							</label>
						</p>
					<?php endif; ?>
					<p class="description description-thin">
						<label for="edit-menu-item-title-<?php echo esc_attr($item_id); ?>">
							<?php esc_html_e( 'Navigation Label', 'dfd-native' ); ?><br />
							<input type="text" id="edit-menu-item-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
						</label>
					</p>
					<p class="description description-thin">
						<label for="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>">
							<?php esc_html_e( 'Title Attribute', 'dfd-native' ); ?><br />
							<input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
						</label>
					</p>
					<p class="field-link-target description">
						<label for="edit-menu-item-target-<?php echo esc_attr($item_id); ?>">
							<input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr($item_id); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr($item_id); ?>]"<?php checked( $item->target, '_blank' ); ?> />
							<?php esc_html_e( 'Open link in a new window/tab', 'dfd-native' ); ?>
						</label>
					</p>
					<p class="field-css-classes description description-thin">
						<label for="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>">
							<?php esc_html_e( 'CSS Classes (optional)', 'dfd-native' ); ?><br />
							<input type="text" id="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
						</label>
					</p>
					<p class="field-xfn description description-thin">
						<label for="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>">
							<?php esc_html_e( 'Link Relationship (XFN)', 'dfd-native' ); ?><br />
							<input type="text" id="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
						</label>
					</p>
					
					<?php if (!empty($mega_menu_class_options) && is_array($mega_menu_class_options)): ?>
						<?php foreach($mega_menu_class_options as $option_name=>$params): ?>
						<?php
							if(!isset($params['depth']) || ($params['depth'] == '0' && $depth == 0) || ($params['depth'] == '1' && $depth > 0)) {
								$block_class = 'field-'. $option_name .' description description-'. $params['size'];

								if (isset($params['class']) && !empty($params['class'])) {
									$block_class .= ' '.$params['class'];
								}
								?>
								<p class="<?php echo esc_attr($block_class); ?>">
									<label for="edit-menu-item-<?php echo esc_attr($option_name); ?>-<?php echo esc_attr($item_id); ?>">
										<?php echo esc_html($params['label']); ?><br />

										<?php if ($params['type']=='text'): ?>
											<input type="text" id="edit-menu-item-<?php echo esc_attr($option_name); ?>-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-<?php echo esc_attr($option_name); ?>" name="menu-item-<?php echo esc_attr($option_name); ?>[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->$option_name ); ?>" />
										<?php elseif($params['type']=='select'): ?>
											<select id="edit-menu-item-<?php echo esc_attr($option_name); ?>-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-<?php echo esc_attr($option_name); ?>" name="menu-item-<?php echo esc_attr($option_name); ?>[<?php echo esc_attr($item_id); ?>]">
												<?php foreach($params['options'] as $val=>$label): ?>
													<option value="<?php echo esc_attr($val); ?>" <?php if($item->$option_name==$val): ?>selected="selected"<?php endif;?> >
														<?php echo esc_html($label); ?>
													</option>
												<?php endforeach; ?>
											</select>
										<?php elseif($params['type']=='upload'): /*Add url check*/?>
											<img src="<?php echo (substr_count(esc_attr( $item->$option_name ), 'http://') > 0 || substr_count(esc_attr( $item->$option_name ), 'https://') > 0) ? esc_url( $item->$option_name ) : ''; ?>" id="edit-menu-item-<?php echo esc_attr($option_name); ?>-img-<?php echo esc_attr($item_id); ?>" alt="edit-menu-item-<?php echo esc_attr($option_name); ?>-<?php echo esc_attr($item_id); ?>" class="image_uploaded" style="<?php echo (substr_count(esc_attr( $item->$option_name ), 'http://') > 0 || substr_count(esc_attr( $item->$option_name ), 'https://') > 0) ? '' : 'display: none;'; ?> padding: 20px 0; max-width: 100%;" />
											<input id="edit-menu-item-<?php echo esc_attr($option_name); ?>-src-<?php echo esc_attr($item_id); ?>" class="upload_image" type="hidden" name="menu-item-<?php echo esc_attr($option_name); ?>[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->$option_name ); ?>" /> 
											<input id="edit-menu-item-<?php echo esc_attr($option_name); ?>-add-image-<?php echo esc_attr($item_id); ?>-button" class="upload_image_button button" type="button" value="<?php _e('Upload Image','dfd-native'); ?>" />
											<input id="edit-menu-item-<?php echo esc_attr($option_name); ?>-remove-image-<?php echo esc_attr($item_id); ?>-button" class="remove_image_button button" type="button" value="<?php _e('Remove Image','dfd-native'); ?>" />
										<?php endif; ?>
									</label>
								</p>
							<?php } ?>
						<?php endforeach; ?>
					<?php endif; ?>
					
					<p class="field-description description description-wide">
						<label for="edit-menu-item-description-<?php echo esc_attr($item_id); ?>">
							<?php esc_html_e( 'Description', 'dfd-native' ); ?><br />
							<textarea id="edit-menu-item-description-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr($item_id); ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
							<span class="description"><?php _e( 'The description will be displayed in the menu if the current theme supports it.', 'dfd-native' ); ?></span>
						</label>
					</p>

					<p class="field-move hide-if-no-js description description-wide">
						<label>
							<span><?php esc_html_e( 'Move', 'dfd-native' ); ?></span>
							<a href="#" class="menus-move-up"><?php esc_html_e( 'Up one', 'dfd-native' ); ?></a>
							<a href="#" class="menus-move-down"><?php esc_html_e( 'Down one', 'dfd-native' ); ?></a>
							<a href="#" class="menus-move-left"></a>
							<a href="#" class="menus-move-right"></a>
							<a href="#" class="menus-move-top"><?php esc_html_e( 'To the top', 'dfd-native' ); ?></a>
						</label>
					</p>

					<div class="menu-item-actions description-wide submitbox">
						<?php if( 'custom' != $item->type && $original_title !== false ) : ?>
							<p class="link-to-original">
								<?php printf( esc_html__( 'Original: %s', 'dfd-native' ), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
							</p>
						<?php endif; ?>
						<a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr($item_id); ?>" href="<?php
						echo wp_nonce_url(
							add_query_arg(
								array(
									'action' => 'delete-menu-item',
									'menu-item' => $item_id,
								),
								admin_url( 'nav-menus.php' )
							),
							'delete-menu_item_' . $item_id
						); ?>"><?php esc_html_e( 'Remove', 'dfd-native' ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo esc_attr($item_id); ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
							?>#menu-item-settings-<?php echo esc_attr($item_id); ?>"><?php esc_html_e( 'Cancel', 'dfd-native' ); ?></a>
					</div>

					<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($item_id); ?>" />
					<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
					<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
					<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
					<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
					<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
				</div><!-- .menu-item-settings-->
				<ul class="menu-item-transport"></ul>
			<?php
			$output .= ob_get_clean();
		}
	}

}
