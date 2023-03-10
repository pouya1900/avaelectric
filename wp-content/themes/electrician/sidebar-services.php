<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Electrician
 * @since Electrician 1.0
 */

if ( is_active_sidebar( 'servicesidebar' ) ) {
	?>
	<div class="divider d-block d-block d-md-none"></div>
		<?php dynamic_sidebar( 'servicesidebar' ); ?>
	<?php
}
