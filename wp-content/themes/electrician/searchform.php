<?php
$unique_id = esc_attr( uniqid( 'search-form-' ) );

$electrician_option = electrician_options();

 $theme = $electrician_option['electrician_demo_select'];

if ( $theme == '2' ) {
	?>
<div class="tt-aside-content">
	<form class="form-default" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<div class="tt-aside-search02">
			<input type="search" id="<?php echo esc_attr( $unique_id ); ?>" placeholder="<?php esc_attr_e( 'Search text...', 'electrician' ); ?>" value="<?php echo get_search_query(); ?>" name="s">
			<button type="submit" class="tt-btn-icon icon-search"></button>
		</div>
	</form>
</div>
	<?php
} else {
	?>
	<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label>
			<input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Search …', 'electrician' ); ?>" value="<?php echo get_search_query(); ?>" name="s">
		</label>
		<input type="submit" class="search-submit" value="Search">
	</form>
	<?php
}
