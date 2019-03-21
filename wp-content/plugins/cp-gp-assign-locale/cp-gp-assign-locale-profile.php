<?php

class CP_GP_Assign_Locale_Profile {

	function __construct() {
		add_action( 'show_user_profile', array( $this, 'show_extra_profile_fields' ) );
        add_action( 'edit_user_profile', array( $this, 'show_extra_profile_fields' ) );
        add_action( 'personal_options_update',  array( $this, 'update_profile_fields' ) );
        add_action( 'edit_user_profile_update',  array( $this, 'update_profile_fields' ) );
	}

	function show_extra_profile_fields( $user ) {
        $gp_project = GP::$project->by_path( "core" );
        $translation_sets = GP::$translation_set->by_project_id( $gp_project->id );
        $option = $selected = '';
        $gp_locale_saved = get_the_user_meta( 'gp_locale', $user->ID, true );
        foreach ( $translation_sets as $set ) {
			// Get WP locale.
			$gp_locale = GP_Locales::by_slug( $set->locale );
			if ( ! isset( $gp_locale->wp_locale ) ) {
				continue;
			}
			
			if ( $set->locale === $gp_locale_saved ) {
                $selected = ' selected="selcted"';
			}
			
			$option .= '<option value="' . $set->locale . '"' . $selected .'>' . $gp_locale->english_name . '</option>' . "\n";
			$selected = '';
			
        }
        ?>
        <h3><?php esc_html_e( 'Set GlotPress Locale for this user' ); ?></h3>

        <table class="form-table">
            <tr>
                <th><label for="assign_locale"><?php esc_html_e( 'User Locale' ); ?></label></th>
                <td>
                    <select id="assign_locale" name="gp_locale">
                        <option value="">Please choose an option</option>
                        <?php echo $option ?>
                    </select>
                </td>
            </tr>
        </table>
        <?php
    }
    
    function update_profile_fields( $user_id ) {
        if ( ! current_user_can( 'edit_user', $user_id ) ) {
            return false;
        }

        if ( ! empty( esc_html( $_POST['gp_locale'] ) ) ) {
            update_user_meta( $user_id, 'gp_locale', esc_html( $_POST['gp_locale'] ) );
        }
    }
    
} 
