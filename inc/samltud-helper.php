<?php

/**
 * Allow usage of the SAMLTUD plugin by
 * - saving the NetID to the user meta
 */

class SAMLTUD_Helper {

	function __construct () {
		add_action('wp_login', array($this, 'save_netid'), 10, 2);
	}

	/**
   * Save the NetID (function to use in hook)
   *
   * @param string $user_login Username
	 * @param WP_User $user WP_User object of the logged-in user.
   * @return void
   */
	public function save_netid( $user_login, $user ) {
		if ( !$this->has_netid($user->ID) ) {
			$netid = $this->getUsername($user);
			if ( !$netid ) return;
			add_user_meta( $user->ID, 'svid_netid', $netid);
		}
	}

	/**
   * Find out whether the user already as a netid saved
   *
   * @param int $current_user_id The id of the user which is being logged into
   * @return mixed Will be an Array if $key is not specified or if $single is
	 *   false. Will be value of meta_value field if $single is true. I.e. false
	 *   like value when it doesn’t exist.
   */
	private function has_netid( $current_user_id ) {
		$existing_netid = get_user_meta( $current_user_id, 'svid_netid' , true );
		return $existing_netid;
	}

	/**
   * Find out whether the user already as a netid saved
   *
	 * @param WP_User $user WP_User object of the logged-in user.
   * @return string The username (netid) of the Lassie user.
   */
	private function getUsername($user) {
		$lassie_api = new Lassie_Api(array(
      'host' => get_option('lassie_url'),
      'api_key' => get_user_meta($user->ID, 'api-key', true),
      'api_secret' => get_user_meta($user->ID, 'api-secret', true),
    ));
		$person = $lassie_api->get('person_information');
		return $person->username;
	}

}

$samltud_helper = new SAMLTUD_Helper();
