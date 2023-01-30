<?php
$electrician_option = electrician_options();
$post_img_url       = get_the_post_thumbnail_url( '', 'electrician-post-list' );
$video_content      = get_post_meta( get_the_ID(), 'framework-video-markup', true );

if ( $electrician_option['electrician-blog-layout'] == '3' ) {?>
	<a href="<?php esc_url( the_permalink() ); ?>"><img src="<?php echo esc_url( $post_img_url ); ?>" class="lazyload" data-src="<?php echo esc_url( $post_img_url ); ?>" alt="<?php esc_attr_e( 'Post Image', 'electrician' ); ?>"></a>
   
	<?php echo wp_kses_post( $video_content ); ?>
	<?php
} else {

	if ( $video_content ) {
		?>
	<div class="post-video">
		<?php echo wp_kses_post( $video_content ); ?>
	</div>
		<?php
	}
}
