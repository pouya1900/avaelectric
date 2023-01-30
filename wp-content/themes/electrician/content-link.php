<?php
$electrician_option = electrician_options();
$link_title         = get_post_meta( get_the_ID(), 'framework-link-title', true );
$link               = get_post_meta( get_the_ID(), 'framework-link', true );
if ( $link ) {
	if ( $electrician_option['electrician-blog-layout'] == '3' ) {
		$post_img_url = get_the_post_thumbnail_url( '', 'electrician-post-list' );
		?>
<div class="tt-img-wrapper"></div>
<a href="<?php echo esc_url( $link ); ?>" class="tt-img-link"><div class="tt-align"><div class="tt-icon icon-2919521"></div><div class="tt-text"><?php echo sprintf( __( '%s', 'electrician' ), $link_title ); ?></div></div></a>
<a href="<?php esc_url( the_permalink() ); ?>"><img src="<?php echo esc_url( $post_img_url ); ?>" class="lazyload" data-src="<?php echo esc_url( $post_img_url ); ?>" alt="<?php esc_attr_e( 'Post Image', 'electrician' ); ?>"></a>
	<?php } else { ?>
	<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'post-thumbnail' ); ?></a>
	<div class="post-link-wrapper">
		<div class="vert-wrap">
			<div class="vert"> <a href="<?php echo esc_url( $link ); ?>" class="post-link"><?php echo sprintf( __( '%s', 'electrician' ), $link_title ); ?></a> </div>
		</div>
	</div>
		<?php
	}
}
?>
