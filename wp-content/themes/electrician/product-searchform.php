<div class="tt-aside-content">
<form role="search" method="get" class="woocommerce-product-search form-default" action="<?php echo esc_url( home_url( '/' ) ); ?>">
<div class="tt-aside-search">
	<label class="screen-reader-text" for="s"><?php esc_html_e( 'Search for:', 'electrician' ); ?></label>
	<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search Products&hellip;', 'placeholder', 'electrician' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'electrician' ); ?>" />

	<button type="submit" class="tt-btn-icon icon-search"></button>
	<input type="hidden" name="post_type" value="product" />
</div>
</form>
</div>
