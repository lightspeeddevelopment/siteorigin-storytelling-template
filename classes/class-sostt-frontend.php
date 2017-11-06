<?php
/**
 * SiteOrigin Storytelling Template Frontend Class.
 *
 * @package sostt
 */

class Sostt_Frontend {

	public $apply_hooks = false;

	/**
	 * Construct.
	 */
	public function __construct() {
		add_action( 'wp', array( $this, 'init' ), 20 );
	}

	/**
	 * Init.
	 */
	public function init() {
		if ( is_singular( 'post' ) ) {
			global $post;

			$post_template = get_post_meta( $post->ID, '_wp_page_template', true );

			if ( 'single-sostt.php' === $post_template ) {
				$this->apply_hooks = true;
			}
		}

		if ( true === $this->apply_hooks ) {
			$this->clean_hooks();

			add_filter( 'template_include', array( $this, 'template_include' ), 20 );
			add_filter( 'body_class', array( $this, 'body_class' ), 20 );
			add_filter( 'siteorigin_panels_widget_classes', array( $this, 'siteorigin_panels_widget_classes' ), 20, 4 );
			add_filter( 'img_caption_shortcode', array( $this, 'img_caption_shortcode' ), 20, 3 );
			add_filter( 'wp_video_shortcode', array( $this, 'wp_video_shortcode' ), 20, 5 );
			add_filter( 'sostt_the_content', array( $this, 'the_content' ) );

			add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ), 20 );

			add_action( 'sostt_get_header', array( $this, 'get_header' ) );
			add_action( 'sostt_get_footer', array( $this, 'get_footer' ) );
			add_action( 'sostt_get_single_template', array( $this, 'get_single_template' ) );

		}
	}

	/**
	 * Clean hooks.
	 */
	public function clean_hooks() {
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'feed_links_extra', 3 );
		remove_action( 'wp_head', 'feed_links', 2 );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'index_rel_link' );
		remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
		remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
		remove_action( 'wp_head', 'rel_canonical', 10, 0 );
		remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
		remove_action( 'wp_head', 'wp_generator' );
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );

		// Uncode Theme

		global $uncodefont;

		if ( ! empty( $uncodefont ) ) {
			remove_action( 'wp_enqueue_scripts', array( $uncodefont, 'add_scripts' ) );
			remove_action( 'wp_head', array( $uncodefont, 'print_direct_scripts' ) );
			remove_action( 'wp_head', array( $uncodefont, 'print_selectors' ) );

			remove_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
			remove_action( 'wp_enqueue_scripts', 'uncode_add_uncode_cart' );
			remove_action( 'wp_enqueue_scripts', 'uncode_equeue' );
			remove_action( 'wp_enqueue_scripts', 'uncode_remove_woo_scripts', 99 );
			remove_action( 'wp_enqueue_scripts', 'ot_load_google_fonts_css', 1 );
			remove_action( 'wp_enqueue_scripts', 'ot_load_dynamic_css', 999 );
		}
	}

	/**
	 * Custom single template.
	 * Load front-end template.
	 */
	public function template_include( $template ) {
		$template = SOSTT_PATH . 'page-templates/single-sostt.php';
		return $template;
	}

	/**
	 * Add custom body classes.
	 */
	public function body_class( $classes ) {
		$classes[] = 'template-setting-paragraph-spacing-Spaces';
		$classes[] = 'template-setting-pagination-Scroll';
		$classes[] = 'template-setting-navigation-option-None';
		$classes[] = 'template-setting-pop-up-style-Overlay';
		$classes[] = 'template-setting-drop-caps-Drop';
		return $classes;
	}

	/**
	 * Add custom widget classes.
	 */
	public function siteorigin_panels_widget_classes( $classes, $widget_class, $instance, $widget_info ) {
		if ( 'Storytelling_Widget_Image_Widget' === $widget_class ) {
			$classes[] = 'chapter sostt-section chapter-type-text';
		} elseif ( 'Storytelling_Widget_Text_Widget' === $widget_class ) {
			$classes[] = 'chapter sostt-section chapter-type-text cover-text-simple';
		}

		return $classes;
	}

	/**
	 * Change image caption default output.
	 */
	public function img_caption_shortcode( $empty, $attr, $content ) {
		$id = str_replace( 'attachment_', '', $attr['id'] );
		$data = wp_prepare_attachment_for_js( $id );

		if ( empty( $data['width'] ) ) {
			return $content;
		}

		$align = 'sostt-block-align-left';

		if ( 'alignright' === $attr['align'] ) {
			$align = 'sostt-block-align-right';
		}

		if ( ! empty( $data['description'] ) ) {
			$height = $data['height'];
			$caption = $data['description'];
			$image = $data['url'];

			$html = '<div class="aligned-extra-wrapper">' .
						'<div class="sostt-text-over-background sostt-block ' . $align . '">' .
							'<div class="sostt-text-over-background-wrapper" style-scope="sostt-text-over-background" style="height: 150px; min-height: ' . $height . 'px;">' .
								'<div class="sostt-multi-background">' .
									'<div class="sostt-background-image-with-shim">' .
										'<div class="sostt-image" style="background-position: 50% 50%; background-image: url(\'' . $image . '\');"></div>' .
										'<div class="sostt-background-image-with-shim-shim" style="background-color: rgba(0, 0, 0, 0.35);"></div>' .
									'</div>' .
								'</div>' .
								'<p class="sostt-caption" data-block-text-alignment="top-left" data-text-color="light" style="font-size: 2em;">' . $caption . '</p>' .
							'</div>' .
						'</div>' .
					'</div>';
		} else {
			$html = '<div class="aligned-extra-wrapper">' .
						'<div class="sostt-simple-image sostt-block ' . $align . '">' .
							'<div class="sostt-simple-image-wrapper sostt-cover-aligned-block-width-as-max-width sostt-simple-image-wrapper-sized">' .
								'<div class="sostt-image real-image-size" style="background-position: 50% 50%;">' .
									// '<img sizes="100vw" srcset="https://sostt.com/data/files/organization/222157/image/derivative/scale~400x0~0001-1505427728-52.jpg 400w,/data/files/organization/222157/image/raw/0001-1505427728-52.jpg">' .
									do_shortcode( $content ) .
								'</div>';

			if ( ! empty( $attr['caption'] ) ) {
				$caption = $attr['caption'];
				$html .= '<p class="sostt-caption">' . $caption . '</p>';
			}

			$html .= 		'</div>' .
						'</div>' .
					'</div>';
		}

		return $html;
	}

	/**
	 * Change video default output.
	 */
	public function wp_video_shortcode( $output, $atts, $video, $post_id, $library ) {
		$output = '<div class="sostt-simple-video sostt-block sostt-block-align-center">' . $output . '</div>';
		return $output;
	}

	/**
	 * Change text content default output.
	 */
	public function the_content( $text ) {
		$text = preg_replace( '/(<h1>)([^<]+)(<\/h1>)/', '<h1 class="cover-title sostt-cover-font-sans-serif sostt-cover-h1"><span class="sostt-story-data">$2</span></h1>', $text );
		$text = preg_replace( '/(<h2>)([^<]+)(<\/h2>)/', '<h2 class="cover-subtitle sostt-cover-font-sans-serif sostt-cover-h2"><span class="sostt-story-data">$2</span></h2>', $text );
		return $text;
	}

	/**
	 * Enqueue scripts and styles.
	 */
	public function wp_enqueue_scripts() {
		wp_register_style( 'fontawesome', SOSTT_URL . 'assets/css/vendor/font-awesome.css', array(), SOSTT_VER );
		wp_style_add_data( 'fontawesome', 'rtl', 'replace' );

		wp_enqueue_script( 'sostt', SOSTT_URL . 'assets/js/sostt.min.js', array( 'jquery' ), SOSTT_VER, true );

		$params = apply_filters( 'sostt_js_params', array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
		));

		wp_localize_script( 'sostt', 'sostt_params', $params );

		wp_enqueue_style( 'sostt', SOSTT_URL . 'assets/css/sostt.css', array( 'fontawesome' ), SOSTT_VER );
		wp_style_add_data( 'sostt', 'rtl', 'replace' );
	}

	/**
	 * Custom header action hook.
	 */
	public function get_header() {
		include( SOSTT_PATH . '/template-parts/header.php' );
	}

	/**
	 * Custom footer action hook.
	 */
	public function get_footer() {
		include( SOSTT_PATH . '/template-parts/footer.php' );
	}

	/**
	 * Custom single template action hook.
	 */
	public function get_single_template() {
		include( SOSTT_PATH . '/template-parts/content-single.php' );
	}

}

global $sostt_frontend;
$sostt_frontend = new Sostt_Frontend();
