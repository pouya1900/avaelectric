<?php
// Register Custom Post Type
function electrician_services_post_type() {

	$postype_name_electrician_services = 'Services';

	if ( function_exists( 'electrician_options' ) ) {
		$electrician_options = electrician_options();
		if ( isset( $electrician_options['electrician-postype_name_electrician_services'] ) && ! empty( $electrician_options['electrician-postype_name_electrician_services'] ) ) {
				$postype_name_electrician_services = $electrician_options['electrician-postype_name_electrician_services'];
		}
	}

	$labels = array(
		'name'                  => _x( $postype_name_electrician_services, 'Post Type General Name', 'electricity-core' ),
		'singular_name'         => _x( 'Service', 'Post Type Singular Name', 'electricity-core' ),
		'menu_name'             => __( 'Services', 'electricity-core' ),
		'name_admin_bar'        => __( 'Service', 'electricity-core' ),
		'archives'              => __( 'Item Archives', 'electricity-core' ),
		'parent_item_colon'     => __( 'Parent Item:', 'electricity-core' ),
		'all_items'             => __( 'All Services', 'electricity-core' ),
		'add_new_item'          => __( 'Add New Service', 'electricity-core' ),
		'add_new'               => __( 'Add New Service', 'electricity-core' ),
		'new_item'              => __( 'New Service Item', 'electricity-core' ),
		'edit_item'             => __( 'Edit Service Item', 'electricity-core' ),
		'update_item'           => __( 'Update Service Item', 'electricity-core' ),
		'view_item'             => __( 'View Service Item', 'electricity-core' ),
		'search_items'          => __( 'Search Item', 'electricity-core' ),
		'not_found'             => __( 'Not found', 'electricity-core' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'electricity-core' ),
		'featured_image'        => __( 'Featured Image', 'electricity-core' ),
		'set_featured_image'    => __( 'Set featured image', 'electricity-core' ),
		'remove_featured_image' => __( 'Remove featured image', 'electricity-core' ),
		'use_featured_image'    => __( 'Use as featured image', 'electricity-core' ),
		'insert_into_item'      => __( 'Insert into item', 'electricity-core' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'electricity-core' ),
		'items_list'            => __( 'Items list', 'electricity-core' ),
		'items_list_navigation' => __( 'Items list navigation', 'electricity-core' ),
		'filter_items_list'     => __( 'Filter items list', 'electricity-core' ),
	);

	$slug_postype_electrician_services = 'electrician-services';

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'electricity-core' ),
		'public'             => true,
		'publicly_queryable' => true,
		'taxonomies'         => array( 'taxonomy_service' ),
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => apply_filters( 'electrician_services_postype_electrician_services_slug', $slug_postype_electrician_services ) ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
	);

	register_post_type( 'electrician_services', $args );
}

add_action( 'init', 'electrician_services_post_type', 0 );
