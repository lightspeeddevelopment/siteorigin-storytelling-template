<?php
/**
 * @var $text
 */
?>

<div class="section-cover story-data-container" style="display: none;"></div>

<?php
	$text = apply_filters( 'wpautop', $text );
	$text = apply_filters( 'sostt_the_content', $text );
	$text = str_replace( ']]>', ']]>', $text );
	echo wp_kses_post( $text );
?>
