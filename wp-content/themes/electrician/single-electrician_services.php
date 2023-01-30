<?php
/**
 * Template Name: Single Service
 * Template Post Type: post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Electrician
 * @since Electrician 1.0
 */
get_header();


$show_sidebar     = get_post_meta( get_the_ID(), 'framework_show_service_sidebar', true );
$sidebar_position = get_post_meta( get_the_ID(), 'framework_page_style', true );

if ( empty( $show_sidebar ) || ( $show_sidebar == '' ) ) {
	$show_sidebar = 'on';
}

if ( empty( $sidebar_position ) || ( $sidebar_position == '' ) ) {
	$sidebar_position = 'leftsidebar';
}

$show_breadcrumb = get_post_meta( get_the_ID(), 'framework_show_service_breadcrumb', true );

$electrician_option = electrician_options();
$theme              = $electrician_option['electrician_demo_select'];
if ( $theme == '2' ) { ?>
<div id="page-content">
	<?php
	if ( $show_breadcrumb != 'off' ) {
		do_action( 'electrician_breadcrumb' );
	}
	?>
	<!-- Block -->
	<div class="block section-indent">
		<div class="container container-lg-fluid">
			<div class="row flex-sm-row-reverse">
					<div class="col-12 col-md-8 col-lg-8">
						<div class="services-item">
							<div class="services-item__img">
								<?php the_post_thumbnail( 'electrician_service_image' ); ?>
							</div>
							<div class="divider-lg"></div>
							<div class="services-item__layout">
							<?php
							while ( have_posts() ) :
								the_post();
								the_content();
							endwhile;
							?>
							</div>
						</div>
					</div>
					<div class="divider-lg visible-xs"></div>
					<?php if ( $show_sidebar == 'on' && isset( $show_sidebar ) && is_active_sidebar( 'servicesidebar' ) && ( $sidebar_position == 'leftsidebar' ) ) : ?>
					<div class="col-12 col-md-4 col-lg-4 asideColumn asideColumn-left">
						<?php get_sidebar( 'services' ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<!-- //Block -->
</div>
	<?php
} else {
	?>
<div id="page-content">
	<?php
	if ( $show_breadcrumb != 'off' ) {
		do_action( 'electrician_breadcrumb' );
	}
	?>
	<!-- Block -->
	<div class="block">
		<div class="container">
			<div class="row">
			<?php if ( $show_sidebar == 'on' && isset( $show_sidebar ) && is_active_sidebar( 'servicesidebar' ) && ( $sidebar_position == 'leftsidebar' ) ) : ?>
				<div class="col-md-4 col-lg-3">
					<?php get_sidebar( 'services' ); ?>
				</div>
			<div class="divider-lg visible-xs"></div>
			<div class="col-md-8 col-lg-9">
			<?php elseif ( ( $show_sidebar == 'on' && isset( $show_sidebar ) && is_active_sidebar( 'servicesidebar' ) && ( $sidebar_position == 'rightsidebar' ) ) ) : ?>
				<div class="col-md-8 
				<?php
				if ( $sidebar_position == 'leftsidebar' ) {
					echo 'col-md-offset-2 ';}
				?>
				"
			<?php else : ?>
				<div class="col-md-12">
			<?php endif; ?>
					<div class="category-text">
						<div class="category-image">
							<?php the_post_thumbnail( 'electrician_service_image' ); ?>
							<h1>
								<?php
								while ( have_posts() ) :
									the_post();
									the_title();
								endwhile;
								?>
							</h1></div>
						<div class="divider-lg"></div>
						<?php
						while ( have_posts() ) :
							the_post();
							the_content();
						endwhile;
						?>
					</div>
					<?php if ( $show_sidebar == 'on' && isset( $show_sidebar ) && is_active_sidebar( 'servicesidebar' ) && ( $sidebar_position == 'rightsidebar' ) ) : ?>
				<div class="divider-lg visible-xs"></div>
				<div class="col-md-4 col-lg-3">
						<?php get_sidebar( 'services' ); ?>
				</div>
				<?php else : ?>
				</div>
				<?php endif;   // right side bar ?>
				</div>
			</div>
		</div>
	</div>
	<!-- //Block -->
</div>
	<?php
}
get_footer();
