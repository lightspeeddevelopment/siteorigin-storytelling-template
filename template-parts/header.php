<?php
/**
 * Custom header.
 *
 * @package sostt
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<meta name="viewport" content="width=device-width, user-scalable=no, maximum-scale=1, initial-scale=1">
		<?php wp_head(); ?>
	</head>

	<body <?php body_class( 'sostt' ); ?>>
