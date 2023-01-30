<?php
$electrician_option = electrician_options();
$gallery            = get_post_meta( get_the_ID(), 'framework-gallery' );
if ( ! empty( $gallery ) ) :

	if ( $electrician_option['electrician-blog-layout'] == '3' ) {
		?>
	<div class="slick-type02 slick-dotted" data-slick='{
			"dots": true,
			"arrows": false,
			"infinite": true,
			"speed": 300,
			"slidesToShow": 1,
			"slidesToScroll": 1,
			"adaptiveHeight": true
		}'>
		<?php
		foreach ( $gallery as $single ) {
			$link = wp_get_attachment_url( (int) $single );
			?>
			<a href="<?php echo esc_url( $link ); ?>">
			<?php echo wp_get_attachment_image( $single, 'post-thumbnail' ); ?>
			</a>
		<?php } ?>
	</div>
		<?php

	} else {
		?>
	<div class="post-carousel">
		<?php
		foreach ( $gallery as $single ) {
			$link = wp_get_attachment_url( (int) $single );
			?>
			<a href="<?php echo esc_url( $link ); ?>">
			<?php echo wp_get_attachment_image( $single, 'post-thumbnail' ); ?>
			</a>
		<?php } ?>
	</div>
		<?php
	}

endif;
