<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package    WordPress
 * @subpackage Electrician
 * @since      Electrician 1.0
 */

get_header(); ?>


		<?php do_action( 'electrician_breadcrumb' ); ?>
		<div class="block">
			<div class="container">
		<?php
		// Start the loop.
		while ( have_posts() ) :
			the_post();

			// Include the page content template.
			get_template_part( 'content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
					endif;

			// End the loop.
		endwhile;
		?>
			</div><!-- .container -->
		</div><!-- .block -->


<?php get_footer(); ?>
