<?php
/*
 * Plugin Name:	SiteOrigin Storytelling Template
 * Plugin URI:	https://github.com/lightspeeddevelopment/siteorigin-storytelling-template
 * Description:	SiteOrigin Storytelling Template.
 * Author:		LightSpeed
 * Version: 	1.0.0
 * Author URI: 	https://www.lsdev.biz/
 * License: 	GPL3
 * Text Domain: sostt
 * Domain Path: /languages/
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'SOSTT_PATH', plugin_dir_path( __FILE__ ) );
define( 'SOSTT_CORE', __FILE__ );
define( 'SOSTT_URL',  plugin_dir_url( __FILE__ ) );
define( 'SOSTT_VER',  '1.0.0' );

// require_once( SOSTT_PATH . 'classes/class-sostt.php' );
require_once( SOSTT_PATH . 'classes/class-sostt-admin.php' );
require_once( SOSTT_PATH . 'classes/class-sostt-frontend.php' );
require_once( SOSTT_PATH . 'classes/class-sostt-widgets.php' );
