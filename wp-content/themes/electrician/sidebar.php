<?php
$electrician_option = electrician_options();
if ( is_active_sidebar( 'blogleftsidebar' ) ) {
	?>
	<?php
	if ( $electrician_option['electrician-blog-layout'] == '3' ) {
		?>
	<div class="divider d-block d-sm-none"></div>
	<div class="col-12 col-sm-5 col-md-4 rightColumn tt-aside">
	<?php } else { ?>
	<div class="col-md-3 column-right">
	<?php } ?>
	<?php dynamic_sidebar( 'blogleftsidebar' ); ?>
	</div>
	<?php
}
