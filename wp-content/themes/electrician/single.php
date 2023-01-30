<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package    WordPress
 * @subpackage Electrician
 * @since      Electrician 1.0
 */
get_header();
$electrician_option = electrician_options();
$post_author_box    = $electrician_option['electrician_blog_single_post_author_box'];

$theme = $electrician_option['electrician_demo_select'];
if ( $theme == '2' ) {
	if ( is_active_sidebar( 'blogleftsidebar' ) ) {
		$blogcolumn = 'col-12 col-sm-7 col-md-8';
	} else {
		$blogcolumn = 'col-sm-12 column-center';
	}
} else {
	if ( is_active_sidebar( 'blogleftsidebar' ) ) {
		$blogcolumn = 'col-md-9 column-center  with-sidebar-blog';
	} else {
		$blogcolumn = 'col-md-12 column-center';
	}
}



if ( $theme == '2' ) {?>
<div id="pageContent">
	<?php do_action( 'electrician_breadcrumb' ); ?>
	<!-- Content  -->
	<section class="section-indent">
		<div class="container">
			<div class="row">
				<div class="<?php echo esc_attr( $blogcolumn ); ?>">
				<div class="blog-single">
				<?php
				// Start the loop.
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
						?>
							<div class="blog-single__img">
								<?php get_template_part( 'content', get_post_format() ); ?>
							</div>
							<div class="blog-single__wrapper">
							<div class="blog-single__data"><div class="tt-col"><div class="data__time"><?php echo get_the_date( 'd M, Y' ); ?></div></div><div class="tt-col"><div class="data__posted"><?php printf( esc_html__( 'Posted by %s', 'electrician' ), get_the_author() ); ?></div></div><div class="tt-col"><div class="data__comments"><?php electrician_comments_count(); ?></div></div></div>
							<h1 class="blog-single__title"><?php the_title(); ?></h1>
						<?php
						the_content();
						wp_link_pages(
							array(
								'before'      => '<div class="page-pagination"><div class="page-numbers"><span class="page-links-title">' . esc_html__( 'Pages:', 'electrician' ) . '</span>',
								'after'       => '</div></div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
								'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'electrician' ) . ' </span>%',
								'separator'   => ', ',
							)
						);
						?>
						<div class="blog-single__meta">
							<div class="tt-col">
								<?php
								$posttags = get_the_tags();
								if ( $posttags ) {
									echo '<ul class="tt-list02">';
									foreach ( $posttags as $tag ) {
										echo '<li><a href="' . get_tag_link( $tag->term_id ) . '">' . $tag->name . '</a></li>';
									}
									echo '</ul>';
								}
								?>
							</div>
							<?php do_action( 'electrician_social_share' ); ?>
						</div>
						<?php
						global $post;
						$display_name = get_the_author_meta( 'display_name', $post->post_author );
						$url          = get_the_author_meta( 'url', $post->post_author );
						$user_text    = get_the_author_meta( 'user_description', $post->post_author );
						$user_avatar  = get_avatar( $post->post_author, 160 );

						if ( $post_author_box ) :
							if ( isset( $user_text ) && ! empty( $user_text ) ) {
								?>
								<div class="personal-info personal-info__top">
									<div class="personal-info__img"><?php echo wp_kses_post( $user_avatar ); ?></div>
									<div class="personal-info_description">
										<h6 class="personal-info__title"><?php echo esc_html( ucfirst( $display_name ) ); ?></h6>
										<p><?php echo esc_html( $user_text ); ?></p>
									</div>
								</div>
								<?php
							}
						endif;
						?>
						</div>

						<?php

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

						// Previous/next post navigation.


						// End the loop.
					endwhile;
				endif;
				?>
			</div>
			</div><!-- .col-sm-9-->
	<?php get_sidebar(); ?>
		</div><!-- .row -->
		</div><!-- .Container -->
	</section><!-- .site-main -->
</div><!-- .content-area -->

	<?php get_footer(); ?>
<?php } else { ?>
<div id="pageContent">
	<?php do_action( 'electrician_breadcrumb' ); ?>
	<!-- Content  -->
	<section class="content">
		<div class="container">
			<div class="row">
				<div class="<?php echo esc_attr( $blogcolumn ); ?>">
				<?php
				// Start the loop.
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
						?>
						<div <?php post_class( 'blog-post single' ); ?>>
							<div class="post-image">
						<?php get_template_part( 'content', get_post_format() ); ?>
							</div>
							<div class="post-content">
								<h2 class="post-title">
						<?php the_title(); ?>
								</h2>
								<div class="post-date"><span class="day"><?php echo get_the_date( 'd' ); ?></span><span class="month"><?php echo get_the_date( 'M' ); ?></span></div>
								<div class="post-author"><?php printf( esc_html__( 'by %s', 'electrician' ), get_the_author() ); ?>&nbsp;&nbsp;<div class="post-meta"><i class="icon icon-speech"></i><span><?php comments_number( '0', '1', '%' ); ?></span></div></div>
								<div class="post-teaser">
						<?php
						the_content( esc_html__( 'Read More', 'electrician' ) );
						wp_link_pages(
							array(
								'before'      => '<div class="page-pagination"><div class="page-numbers"><span class="page-links-title">' . esc_html__( 'Pages:', 'electrician' ) . '</span>',
								'after'       => '</div></div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
								'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'electrician' ) . ' </span>%',
								'separator'   => ', ',
							)
						);
						?>
						<?php
						$posttags = get_the_tags();
						if ( $posttags ) {
							echo '<ul class="tags-list">';
							foreach ( $posttags as $tag ) {
								echo '<li><a href="' . get_tag_link( $tag->term_id ) . '">' . $tag->name . '</a></li>';
							}
							echo '</ul>';
						}
						?>
								</div>
							</div>
						</div>

						<?php
						the_post_navigation(
							array(
								'next_text' => '<span class="post-title">%title</span>' . esc_html__( '&raquo;', 'electrician' ),
								'prev_text' => esc_html__( '&laquo;', 'electrician' ) . '<span class="post-title">%title</span>',
							)
						);

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

						// Previous/next post navigation.


						// End the loop.
					endwhile;
				endif;
				?>
			</div><!-- .col-sm-9-->
	<?php get_sidebar(); ?>
		</div><!-- .row -->
		</div><!-- .Container -->
	</section><!-- .site-main -->
</div><!-- .content-area -->

	<?php get_footer(); ?>
<?php } ?>
