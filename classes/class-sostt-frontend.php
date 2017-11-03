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

			add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ), 20 );

			add_action( 'sostt_get_header', array( $this, 'get_header' ) );
			add_action( 'sostt_get_footer', array( $this, 'get_footer' ) );
			add_action( 'sostt_get_single_template', array( $this, 'get_single_template' ) );

			add_filter( 'template_include', array( $this, 'template_include' ), 20 );
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
	 * Enqueue scripts and styles.
	 */
	public function wp_enqueue_scripts() {
		wp_enqueue_script( 'sostt', SOSTT_URL . 'assets/js/sostt.min.js', array( 'jquery' ), SOSTT_VER, true );

		$params = apply_filters( 'sostt_js_params', array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
		));

		wp_localize_script( 'sostt', 'sostt_params', $params );

		wp_enqueue_style( 'sostt', SOSTT_URL . 'assets/css/sostt.css', array(), SOSTT_VER );
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

	/**
	 * Custom single template.
	 * Load front-end template.
	 */
	public function template_include( $template ) {
		$template = SOSTT_PATH . 'page-templates/single-sostt.php';
		return $template;
	}

}

global $sostt_frontend;
$sostt_frontend = new Sostt_Frontend();
