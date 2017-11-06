<?php
/**
 * @package sostt
 */
?>

<?php
	global $post;
?>

<div class="nav-icons-left">
	<?php
		$post_id = get_the_ID();
		$link_to_homepage = get_post_meta( $post_id, 'sostt_link_to_homepage', true );
		$link_to_landing_page = get_post_meta( $post_id, 'sostt_link_to_landing_page', true );
		$landing_page_link = get_post_meta( $post_id, 'sostt_landing_page_link', true );

		if ( ! empty( $link_to_homepage ) ) {
			?><a href="<?php echo home_url(); ?>"><i class="fa fa-home" aria-hidden="true"></i></a><?php
		}

		if ( ! empty( $link_to_landing_page ) && ! empty( $landing_page_link ) ) {
			?><a href="<?php echo esc_attr( $landing_page_link ); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i></a><?php
		}
	?>
</div>

<div class="nav-icons">
	<?php echo do_shortcode( '[lsx_sharing_buttons buttons="facebook,twitter"]' ); ?>
</div>

<article id="post-<?php the_ID(); ?>">
	<section class="sostt-section story-cover">
		<div class="sostt-cover-text-color cover-text-bold sostt-cover sostt-block-align-center">
			<div class="cover-text-wrapper sostt-cover-column-width-and-alignment cover-text-on-solid-background">
				<h1 class="cover-title sostt-cover-font-sans-serif">
					<span class="sostt-story-data"><?php the_title(); ?></span>
				</h1>

				<div class="divider" style="background-color: rgb(187, 25, 7);"></div>

				<h2 class="cover-subtitle sostt-cover-font-sans-serif">
					<span class="sostt-story-data"><?php echo wp_kses_post( $post->post_excerpt ); ?></span>
				</h2>

				<div class="cover-byline sostt-cover-font-sans-serif sostt-cover-byline">
					<div class="sostt-byline sostt-story-data-byline">
						<div class="sostt-byline-wrapper">
							<div class="byline-and-publication">
								<?php
									$author = get_user_by( 'ID', $post->post_author );
									$author = $author->display_name;
								?>

								<span class="sostt-byline-name"><?php echo esc_html( $author ); ?></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php the_content(); ?>

	<footer class="sostt-footer">
		<a href="<?php echo esc_url( home_url() ); ?>" class="sostt-footer-wrapper sostt-cover-left-gutter-padding-left sostt-cover-right-gutter-padding-right">
			<div class="text">
				<?php
					printf(
						/* Translators: 1: current year, 2: blog name */
						esc_html__( '&#169; %1$s %2$s All Rights Reserved', 'lsx' ),
						esc_html( date_i18n( 'Y' ) ),
						esc_html( get_bloginfo( 'name' ) )
					);
				?>
			</div>
		</a>
	</footer>
</article>
