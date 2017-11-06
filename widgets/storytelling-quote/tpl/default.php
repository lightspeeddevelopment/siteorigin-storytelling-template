<?php
/**
 * @var $quote
 * @var $image
 */
?>

<div class="sostt-text-over-background sostt-block sostt-block-align-full">
	<div class="sostt-text-over-background-wrapper sostt-custom-class-1">
		<div class="sostt-multi-background">
			<div class="sostt-background-image-with-shim">
				<div class="sostt-image" style="background-position: 50% 50%; background-image: url('<?php echo esc_attr( $image ); ?>');"></div>
				<div class="sostt-background-image-with-shim-shim" style="background-color: rgba(0, 0, 0, 0.20);"></div>
			</div>
		</div>
		<p class="sostt-caption" style="font-size: 2em;" data-text-color="light" data-block-text-alignment="bottom-left"><?php echo wp_kses_post( $quote ); ?></p>
	</div>
</div>
