<?php
/**
 * SiteOrigin Storytelling Template Widgets Class.
 *
 * @package sostt
 */

class Sostt_Widgets {

	/**
	 * Construct.
	 */
	public function __construct() {
		add_filter( 'siteorigin_widgets_widget_folders', array( $this, 'widgets_collection' ) );
		add_filter( 'siteorigin_widgets_active_widgets', array( $this, 'widgets_active' ) );
	}

	/**
	 * Widgets collection folder.
	 */
	public function widgets_collection( $folders ) {
		$folders[] = SOSTT_PATH . 'widgets/';
		return $folders;
	}

	/**
	 * Widgets active by default.
	 */
	public function widgets_active( $widgets ) {
		$widgets['storytelling-image'] = true;
		$widgets['storytelling-text'] = true;
		return $widgets;
	}

}

global $sostt_widgets;
$sostt_widgets = new Sostt_Widgets();
