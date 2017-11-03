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

		$src = siteorigin_widgets_get_attachment_image_src( $instance['image'], 'full', false );

		$attr = array();

		if ( ! empty( $src ) ) {
			$attr = array(
				'src' => $src[0],
			);

			if ( ! empty( $src[1] ) ) {
				$attr['width'] = $src[1];
			}

			if ( ! empty( $src[2] ) ) {
				$attr['height'] = $src[2];
			}

			if ( function_exists( 'wp_get_attachment_image_srcset' ) ) {
				$attr['srcset'] = wp_get_attachment_image_srcset( $instance['image'], 'full' );
			}

			if ( ! ( class_exists( 'Jetpack_Photon' ) && Jetpack::is_module_active( 'photon' ) ) ) {
				if ( function_exists( 'wp_get_attachment_image_sizes' ) ) {
					$attr['sizes'] = wp_get_attachment_image_sizes( $instance['image'], 'full' );
				}
			}
		}

		// $attr = apply_filters( 'siteorigin_widgets_image_attr', $attr, $instance, $this );

		$attr['title'] = $title;
		$attr['alt'] = get_post_meta( $instance['image'], '_wp_attachment_image_alt', true );

		return array(
			'title' => $title,
			'tagline' => $tagline,
			'attributes' => $attr,
			'classes' => array( 'storytelling-widget-image' ),
		);
	}

}

siteorigin_widget_register( 'storytelling-image', __FILE__, 'Storytelling_Widget_Image_Widget' );
