<?php
/**
 * SiteOrigin Storytelling Template Admin Class.
 *
 * @package sostt
 */

class Sostt_Admin {

	/**
	 * Construct.
	 */
	public function __construct() {
		add_filter( 'theme_post_templates', array( $this, 'theme_post_templates' ), 20 );
	}

	/**
	 * Custom single template.
	 * Make option available.
	 */
	public function theme_post_templates( $templates ) {
		$templates['single-sostt.php'] = esc_html__( 'SiteOrigin Storytelling', 'sostt' );
		return $templates;
	}

}

global $sostt_admin;
$sostt_admin = new Sostt_Admin();
