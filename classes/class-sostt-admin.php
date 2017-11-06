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
		add_action( 'add_meta_boxes', array( $this, 'meta_box' ), 20 );
		add_action( 'save_post', array( $this, 'meta_box_save' ), 20 );
	}

	/**
	 * Custom single template.
	 * Make option available.
	 */
	public function theme_post_templates( $templates ) {
		$templates['single-sostt.php'] = esc_html__( 'SiteOrigin Storytelling', 'sostt' );
		return $templates;
	}

	/**
	 * Meta box.
	 */
	public function meta_box() {
		add_meta_box(
			'sostt',
			esc_html__( 'Storytelling Template', 'sostt' ),
			array( $this, 'meta_box_content' ),
			'post',
			'side',
			'high'
		);
	}

	/**
	 * Meta box fields.
	 */
	public function meta_box_content() {
		$post_id = get_the_ID();
		$link_to_homepage = get_post_meta( $post_id, 'sostt_link_to_homepage', true );
		$link_to_landing_page = get_post_meta( $post_id, 'sostt_link_to_landing_page', true );
		$landing_page_link = get_post_meta( $post_id, 'sostt_landing_page_link', true );

		wp_nonce_field( plugin_basename( __FILE__ ), 'sostt_nonce' );
		?>
		<label style="padding: 2px 0;">
			<input value="1" type="checkbox" name="sostt_link_to_homepage" <?php checked( $link_to_homepage, true, true ); ?>> <?php esc_html_e( 'Display link to homepage', 'sostt' ); ?>
		</label>
		<br>
		<label style="padding: 2px 0;">
			<input value="1" type="checkbox" name="sostt_link_to_landing_page" <?php checked( $link_to_landing_page, true, true ); ?>> <?php esc_html_e( 'Display link to landing page', 'sostt' ); ?>
		</label>
		<br>
		<br>
		<label style="padding: 2px 0;">
			<?php esc_html_e( 'Landing page link', 'sostt' ); ?>
			<br>
			<input style="margin: 2px 0; width: 80%;" value="<?php echo esc_attr( $landing_page_link ); ?>" type="text" name="sostt_landing_page_link">
		</label>
		<?
	}

	/**
	 * Meta box save.
	 */
	public function meta_box_save( $post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( empty( $_POST['sostt_nonce'] ) || ! wp_verify_nonce( $_POST['sostt_nonce'], plugin_basename( __FILE__ ) ) ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		if ( isset( $_POST['sostt_link_to_homepage'] ) ) {
			update_post_meta( $post_id, 'sostt_link_to_homepage', $_POST['sostt_link_to_homepage'] );
		} else {
			delete_post_meta( $post_id, 'sostt_link_to_homepage' );
		}

		if ( isset( $_POST['sostt_link_to_landing_page'] ) ) {
			update_post_meta( $post_id, 'sostt_link_to_landing_page', $_POST['sostt_link_to_landing_page'] );
		} else {
			delete_post_meta( $post_id, 'sostt_link_to_landing_page' );
		}

		if ( isset( $_POST['sostt_landing_page_link'] ) ) {
			update_post_meta( $post_id, 'sostt_landing_page_link', $_POST['sostt_landing_page_link'] );
		} else {
			delete_post_meta( $post_id, 'sostt_landing_page_link' );
		}
	}

}

global $sostt_admin;
$sostt_admin = new Sostt_Admin();
