<?php
/*
 * Widget Name:	Storytelling Quote
 * Description:	Storytelling quote widget.
 * Author:		LightSpeed
 * Author URI: 	https://www.lsdev.biz/
*/

class Storytelling_Widget_Quote_Widget extends SiteOrigin_Widget {

	public function __construct() {
		parent::__construct(
			'storytelling-quote',
			__( 'Storytelling Quote', 'sostt' ),
			array(
				'description' => __( 'Storytelling quote widget.', 'sostt' ),
			),
			array(),
			false,
			SOSTT_PATH
		);
	}

	public function get_widget_form() {
		return array(
			'image' => array(
				'type' => 'media',
				'label' => __( 'Image file', 'sostt' ),
				'library' => 'image',
			),

			'quote' => array(
				'type' => 'textarea',
				'label' => __( 'Quote', 'sostt' ),
			),
		);
	}

	public function get_style_hash( $instance ) {
		return substr( md5( serialize( $this->get_less_variables( $instance ) ) ), 0, 12 );
	}

	public function get_template_variables( $instance, $args ) {
		if ( ! empty( $instance['quote'] ) ) {
			$quote = $instance['quote'];
		} else {
			$quote = '';
		}

		$image = siteorigin_widgets_get_attachment_image_src( $instance['image'], 'full', false );

		if ( ! empty( $image ) ) {
			$image = $image[0];
		}

		return array(
			'quote' => $quote,
			'image' => $image,
		);
	}

}

siteorigin_widget_register( 'storytelling-quote', __FILE__, 'Storytelling_Widget_Quote_Widget' );
