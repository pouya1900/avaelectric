<?php
get_header();

$electrician_option = electrician_options();
$blogisotope        = false;

$bloglayoutno = 1;
if ( isset( $_GET['layout'] ) && is_numeric( $_GET['layout'] ) ) {
	$bloglayoutno = (int) $_GET['layout'];
}
if ( ( isset( $electrician_option['electrician-blog-layout'] ) && $electrician_option['electrician-blog-layout'] == 2 ) || $bloglayoutno == 2 ) {
	$blogcolumn  = 'blog-isotope';
	$blogisotope = true;
} elseif ( ( isset( $electrician_option['electrician-blog-layout'] ) && $electrician_option['electrician-blog-layout'] == 3 ) ) {
	if ( is_active_sidebar( 'blogleftsidebar' ) ) {
		$blogcolumn = 'col-12 col-sm-7 col-md-8';
	} else {
		$blogcolumn = 'col-md-9 column-center';
	}
} else {
	if ( is_active_sidebar( 'blogleftsidebar' ) ) {
		$blogcolumn = 'col-md-9 column-center';
	} else {
		$blogcolumn = 'col-md-8 col-md-offset-2';
	}
}
$theme = $electrician_option['electrician_demo_select'];
if ( $theme == '2' ) {
	$class1 = 'section-indent';
} else {
	$class1 = 'content';
}
?>
<div id="pageContent">
	<?php do_action( 'electrician_breadcrumb' ); ?>
	<!-- Content  -->
	<section class="<?php echo esc_attr( $class1 ); ?>">
		<div class="container">
		<?php
		if ( is_home() && ! is_front_page() ) :
			if ( $theme != '2' ) :
				?>
			<h1 class="text-center"><?php single_post_title(); ?></h1>
			<div class="divider-sm"></div>
				<?php
		endif;
endif;
		if ( ! $blogisotope ) {
			?>
		<div class="row">
		<?php } ?>
			<div class="<?php echo esc_attr( $blogcolumn ); ?>">
			<div class="tt-blog-list">
			
		<?php if ( have_posts() ) : ?>

			<?php
			// Start the loop.
			while ( have_posts() ) :
				the_post();

				/*
				* Include the Post-Format-specific template for the content.
				* If you want to override this in a child theme, then include a file
				* called content-___.php (where ___ is the Post Format name) and that will be used instead.
				*/
				?>
				<?php if ( $electrician_option['electrician-blog-layout'] == '3' ) { ?>
					<div class="tt-item">
						<div class="blog-obj">
					<?php
					$quote         = get_post_meta( get_the_ID(), 'framework-quote', true );
					$audio_content = get_post_meta( get_the_ID(), 'framework-audio-markup', true );
					if ( empty( $quote ) and empty( $audio_content ) ) {
						?>
							<div class="blog-obj__img">
						<?php get_template_part( 'content', get_post_format() ); ?>
							</div>
					<?php } ?>
							<div class="blog-obj__wrapper">
								<div class="blog-obj__data">
									<div class="tt-col">
										<div class="data__time"><?php echo get_the_date( 'd M, Y' ); ?></div>
									</div>
									<div class="tt-col">
										<div class="data__posted"><?php esc_html_e( 'Posted by:', 'electrician' ); ?> <a href="<?php esc_url( the_permalink() ); ?>"><?php echo get_the_author(); ?></a></div>
									</div>
									<div class="tt-col">
										<div class="data__comments"><?php electrician_comments_count(); ?></div>
									</div>
								</div>
								<h3 class="blog-obj__title"><a href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a></h3>
									<?php
									if ( ! empty( $quote ) || ! empty( $audio_content ) ) {
										get_template_part( 'content', get_post_format() );
									}
									?>
									<?php the_excerpt(); ?>
								<div class="blog-obj__row-btn">
									<a href="<?php esc_url( the_permalink() ); ?>" class="tt-btn btn__color01">
									<?php if ( ! empty( $electrician_options['electrician-site-wide-icon'] ) ) { ?>
									<span class="icon-sitewide"><?php echo wp_kses_post( $electrician_options['electrician-site-wide-icon'] ); ?></span>
									<?php } else { ?>
									<span class="icon-lightning"></span>
									<?php } ?>
										<?php esc_html_e( 'Read more', 'electrician' ); ?>
									</a>
								</div>
							</div>
						</div>
					</div>
				<?php } else { ?>
				<div <?php post_class( 'blog-post' ); ?>>    
					<div class="post-image">
					<?php get_template_part( 'content', get_post_format() ); ?>
					</div>
					<div class="post-content">
						<h2 class="post-title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h2>
						<div class="post-date"><a href="<?php the_permalink(); ?>"><span class="day"><?php echo get_the_date( 'd' ); ?></span><span class="month"><?php echo get_the_date( 'M' ); ?></span></a></div>
						<div class="post-author"><?php printf( esc_html__( 'by %s', 'electrician' ), get_the_author() ); ?>&nbsp;&nbsp;<div class="post-meta"><i class="icon icon-speech"></i><span><?php comments_number( '0', '1', '%' ); ?></span></div></div>
						<div class="post-teaser">
					<?php the_content( esc_html__( 'Read More', 'electrician' ) ); ?>
						</div>    
					</div>
				</div>
				<?php } ?>
				<?php

				// End the loop.
			endwhile;

			// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );

		endif;
		if ( $blogisotope ) {
			?>
	
			</div><!-- //blog column -->
			<div class="col-xs-12">
			<?php
		}
			// Previous/next page navigation.
		if ( $electrician_option['electrician-blog-layout'] != '3' ) {
			the_posts_pagination(
				array(
					'prev_text'          => esc_html__( '&laquo; Previous', 'electrician' ),
					'next_text'          => esc_html__( 'Next &raquo;', 'electrician' ),
					'before_page_number' => '',
				)
			);
		}
		?>
			</div>
			<?php if ( $electrician_option['electrician-blog-layout'] == '3' ) { ?>
			<div class="tt-pagination text-left">
				<?php
				global $wp_query;
				$total_pages = $wp_query->max_num_pages;
				if ( $total_pages > 1 ) {
					$current_page = max( 1, get_query_var( 'paged' ) );
					echo '<ul><li>';
					echo paginate_links(
						array(
							'format'  => 'page/%#%/',
							'current' => $current_page,
							'total'   => $total_pages,
						)
					);
					echo '</li></ul>';
				}
				?>
			</div>
			<?php } ?>
			</div>

			<?php
			if ( ! $blogisotope || is_active_sidebar( 'blogleftsidebar' ) ) {
				get_sidebar();
				?>
			</div><!-- .row -->
			<?php } ?>
		</div><!-- .content -->
	</section><!-- .content -->
</div><!-- #pageContent-->
<?php get_footer(); ?>
