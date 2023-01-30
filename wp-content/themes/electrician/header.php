<?php
$electrician_options = electrician_options();
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	  <?php
		if ( function_exists( 'has_site_icon' ) && has_site_icon() ) { // since 4.3.0
			wp_site_icon();
		} else {
			if ( isset( $electrician_options['electrician-site-favicon']['url'] ) && ! empty( $electrician_options['electrician-site-favicon']['url'] ) ) {
				?>
			<link rel="icon" href="<?php echo esc_url( $electrician_options['electrician-site-favicon']['url'] ); ?>" type="image/x-icon"/>
			<link rel="shortcut icon" href="<?php echo esc_url( $electrician_options['electrician-site-favicon']['url'] ); ?>" type="image/x-icon"/>
				<?php
			}
		}
		?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php do_action( 'electrician_preloader' ); ?>

<?php
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {
$theme = $electrician_options['electrician_demo_select'];
if ( $theme == '2' ) {
	$header_style = '2';
} else {
	$header_style = '1';
}

	get_template_part( 'template-part/header', $header_style );
}
?>

<div id="tt-pageContent">
