<?php
/*
 * The template for displaying a single storytelling.
 *
 * @package sostt
 */

do_action( 'sostt_get_header' ); ?>

<div class="story-wrapper">
	<div class="nav-wrapper">
		<?php
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
					do_action( 'sostt_get_single_template' );
				}
			}
		?>
	</div>
</div>

<?php do_action( 'sostt_get_footer' );
