<?php

class CP_GP_Assign_Locale_GlotPress {

	function __construct() {
		add_filter( 'gp_pre_can_user', array( $this, 'pre_can_user' ), 9 , 2 );
	}

	public function pre_can_user( $verdict, $args ) {
		// Logged out users have no permissions.
		if ( ! is_user_logged_in() ) {
			return false;
		}

        $locale_and_project_id = (object) $this->get_locale_and_project_id( $args['object_type'], $args['object_id'], $args );
        // TODO compare locale with the one of the user
		// No user is allowed to delete something.
		if ( 'delete' === $args['action'] ) {
			return false;
		}

		// Allow logged in users to submit translations.
		if ( 'edit' == $args['action'] && 'translation-set' === $args['object_type'] ) {
			return is_user_logged_in();
		}

		// The next checks are only for the 'approve' action, no permissions for other actions.
		if ( 'approve' !== $args['action'] ) {
			return false;
		}

		return false;
	}
	
    /**
	 * Extracts project ID and locale slug from object type and ID.
	 *
	 * @param string $object_type Current object type.
	 * @param string $object_id   Current object ID.
	 * @param array  $args        Optional. Array of additional arguments.
	 * @return array|false Locale and project ID, false on failure.
	 */
	public function get_locale_and_project_id( $object_type, $object_id, $args = array() ) {
		static $set_cache = array();

		switch ( $object_type ) {
			case 'translation' :
				if ( empty( $args['extra']['translation']->translation_set_id ) ) {
					break;
				}

				$translation_set_id = $args['extra']['translation']->translation_set_id;
				if ( isset( $set_cache[ $translation_set_id ] ) ) {
					$set = $set_cache[ $translation_set_id ];
				} else {
					$set = GP::$translation_set->get( $args['extra']['translation']->translation_set_id );
					$set_cache[ $translation_set_id ] = $set;
				}

				return array( 'locale' => $set->locale, 'project_id' => (int) $set->project_id );

			case 'translation-set' :
				if ( isset( $set_cache[ $object_id ] ) ) {
					$set = $set_cache[ $object_id ];
				} else {
					$set = GP::$translation_set->get( $object_id );
					$set_cache[ $object_id ] = $set;
				}

				return array( 'locale' => $set->locale, 'project_id' => (int) $set->project_id );

			case 'project' :
			case 'locale' :
			case 'set-slug' :
                $r = parse_url( $_SERVER['REQUEST_URI'] );
                $locale = explode( '/', $r['path'] );
                $locale = $locale[count($locale)-2];
				return array( 'locale' => $locale, 'project_id' => (int) $object_id );
		}

		return false;
	}
    
} 
