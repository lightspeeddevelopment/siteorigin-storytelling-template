<?php
/*
 * Widget Name:	Storytelling Image
 * Description:	Storytelling image widget.
 * Author:		LightSpeed
 * Author URI: 	https://www.lsdev.biz/
*/

class Storytelling_Widget_Image_Widget extends SiteOrigin_Widget {

	public function __construct() {
		parent::__construct(
			'storytelling-image',
			__( 'Storytelling Image', 'sostt' ),
			array(
				'description' => __( 'Storytelling image widget.', 'sostt' ),
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

			'title' => array(
				'type' => 'text',
				'label' => __( 'Title text', 'sostt' ),
			),

			'tagline' => array(
				'type' => 'text',
				'label' => __( 'Tagline text', 'sostt' ),
			),
		);
	}

	public function get_style_hash( $instance ) {
		return substr( md5( serialize( $this->get_less_variables( $instance ) ) ), 0, 12 );
	}

	public function get_template_variables( $instance, $args ) {
		if ( ! empty( $instance['title'] ) ) {
			$title = $instance['title'];
		} else {
			$title = '';
		}

		if ( ! empty( $instance['tagline'] ) ) {
			$tagline = $instance['tagline'];
		} else {
			$tagline = '';
		}

		$image = siteorigin_widgets_get_attachment_image_src( $instance['image'], 'full', false );

		if ( ! empty( $image ) ) {
			$image = $image[0];
		}

		return array(
			'title' => $title,
			'tagline' => $tagline,
			'image' => $image,
		);
	}

}

siteorigin_widget_register( 'storytelling-image', __FILE__, 'Storytelling_Widget_Image_Widget' );
