<?php
/**
 * @var $title
 * @var $tagline
 * @var $image
 */
?>

<div class="section-cover story-data-container">
	<div class="sostt-cover-solid-background cover-black sostt-shared sostt-cover sostt-block-align-center">
		<div class="sostt-multi-background">
			<div class="sostt-background-image-with-shim">
				<div class="sostt-image" style="background-position: 50% 50%; background-image: url('<?php echo esc_attr( $image ); ?>');"></div>
				<div class="sostt-background-image-with-shim-shim" style="background-color: rgba(0, 0, 0, 0.12);"></div>
			</div>
		</div>
		<div class="cover-text-outside-wrapper sostt-cover-left-gutter-padding-left sostt-cover-right-gutter-padding-right">
			<div class="cover-text-inside-wrapper">
				<h1 class="cover-title sostt-cover-font-sans-serif sostt-cover-h1">
					<span class="sostt-story-data"><?php echo wp_kses_post( $title ); ?></span>
				</h1>
				<h2 class="cover-subtitle sostt-cover-font-sans-serif sostt-cover-byline">
					<span class="subtitle">
						<span class="sostt-story-data"><?php echo wp_kses_post( $tagline ); ?></span>
					</span>
				</h2>
				<!--div class="cover-byline sostt-cover-font-sans-serif sostt-cover-byline">
					<div class="sostt-byline sostt-story-data-byline">
						<div class="sostt-byline-wrapper">
							<div class="byline-and-publication hello">
								<span class="sostt-byline-name"></span>
							</div>
						</div>
					</div>
				</div-->
			</div>
		</div>
	</div>
</div>
