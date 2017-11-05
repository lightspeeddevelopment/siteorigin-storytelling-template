<?php
/*
 * Widget Name:	Storytelling Text
 * Description:	Storytelling text widget.
 * Author:		LightSpeed
 * Author URI: 	https://www.lsdev.biz/
*/

class Storytelling_Widget_Text_Widget extends SiteOrigin_Widget {

	public function __construct() {
		parent::__construct(
			'storytelling-text',
			__( 'Storytelling Text', 'sostt' ),
			array(
				'description' => __( 'Storytelling text widget.', 'sostt' ),
			),
			array(),
			false,
			SOSTT_PATH
		);
	}

	public function get_widget_form() {
		return array(
			'text' => array(
				'type' => 'tinymce',
				'label' => __( 'Text', 'sostt' ),
			),
		);
	}

	public function get_style_hash( $instance ) {
		return substr( md5( serialize( $this->get_less_variables( $instance ) ) ), 0, 12 );
	}

	public function get_template_variables( $instance, $args ) {
		if ( ! empty( $instance['text'] ) ) {
			$text = $instance['text'];
		} else {
			$text = '';
		}

		return array(
			'text' => $text,
		);
	}

}

siteorigin_widget_register( 'storytelling-text', __FILE__, 'Storytelling_Widget_Text_Widget' );
