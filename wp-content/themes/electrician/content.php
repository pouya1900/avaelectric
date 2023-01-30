<?php
$electrician_option = electrician_options();
$post_img_url       = get_the_post_thumbnail_url( '', 'electrician-post-list' );
if ( $electrician_option['electrician-blog-layout'] == '3' ) {
	?>
<a href="<?php esc_url( the_permalink() ); ?>"><img src="<?php echo esc_url( $post_img_url ); ?>" class="lazyload" data-src="<?php echo esc_url( $post_img_url ); ?>" alt="<?php esc_attr_e( 'Post Image', 'electrician' ); ?>"></a>
<?php } else { ?>
	<?php if ( has_post_thumbnail() ) { ?>
	<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'post-thumbnail' ); ?></a>
	<?php }
} ?>
