<?php
// Register Custom Taxonomy
function tours_tax() {

	$labels = array(
		'name'                       => _x( 'Galapagos Tours Groups', 'Taxonomy General Name', 'gogalapagos' ),
		'singular_name'              => _x( 'Group', 'Taxonomy Singular Name', 'gogalapagos' ),
		'menu_name'                  => __( 'Tours Groups', 'gogalapagos' ),
		'all_items'                  => __( 'All Groups', 'gogalapagos' ),
		'parent_item'                => __( 'Parent Group', 'gogalapagos' ),
		'parent_item_colon'          => __( 'Parent Group:', 'gogalapagos' ),
		'new_item_name'              => __( 'New Group Name', 'gogalapagos' ),
		'add_new_item'               => __( 'Add New Group', 'gogalapagos' ),
		'edit_item'                  => __( 'Edit Group', 'gogalapagos' ),
		'update_item'                => __( 'Update Group', 'gogalapagos' ),
		'view_item'                  => __( 'View Group', 'gogalapagos' ),
		'separate_items_with_commas' => __( 'Separate Groups with commas', 'gogalapagos' ),
		'add_or_remove_items'        => __( 'Add or remove Groups', 'gogalapagos' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'gogalapagos' ),
		'popular_items'              => __( 'Popular Groups', 'gogalapagos' ),
		'search_items'               => __( 'Search Groups', 'gogalapagos' ),
		'not_found'                  => __( 'Not Found', 'gogalapagos' ),
		'no_terms'                   => __( 'No Groups', 'gogalapagos' ),
		'items_list'                 => __( 'Groups list', 'gogalapagos' ),
		'items_list_navigation'      => __( 'Groups list navigation', 'gogalapagos' ),
	);
	$rewrite = array(
		'slug'                       => 'tour-packages',
		'with_front'                 => true,
		'hierarchical'               => true,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'query_var'                  => 'tour-group',
		'rewrite'                    => $rewrite,
		'show_in_rest'               => true,
		'rest_base'                  => 'ggtoursgroup',
	);
	register_taxonomy( 'go_tours', array( 'ggtour' ), $args );

}
add_action( 'init', 'tours_tax', 0 );


// Register Custom Taxonomy
function sa_tours_tax() {

	$labels = array(
		'name'                       => _x( 'Galapagos South America Tours Groups', 'Taxonomy General Name', 'gogalapagos' ),
		'singular_name'              => _x( 'South America Group', 'Taxonomy Singular Name', 'gogalapagos' ),
		'menu_name'                  => __( 'South America Tours Groups', 'gogalapagos' ),
		'all_items'                  => __( 'All South America Groups', 'gogalapagos' ),
		'parent_item'                => __( 'Parent South America Group', 'gogalapagos' ),
		'parent_item_colon'          => __( 'Parent South America Group:', 'gogalapagos' ),
		'new_item_name'              => __( 'New South America Group Name', 'gogalapagos' ),
		'add_new_item'               => __( 'Add New South America Group', 'gogalapagos' ),
		'edit_item'                  => __( 'Edit South America Group', 'gogalapagos' ),
		'update_item'                => __( 'Update South America Group', 'gogalapagos' ),
		'view_item'                  => __( 'View South America Group', 'gogalapagos' ),
		'separate_items_with_commas' => __( 'Separate South America Groups with commas', 'gogalapagos' ),
		'add_or_remove_items'        => __( 'Add or remove South America Groups', 'gogalapagos' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'gogalapagos' ),
		'popular_items'              => __( 'Popular South America Groups', 'gogalapagos' ),
		'search_items'               => __( 'Search South America Groups', 'gogalapagos' ),
		'not_found'                  => __( 'Not Found', 'gogalapagos' ),
		'no_terms'                   => __( 'No South America Groups', 'gogalapagos' ),
		'items_list'                 => __( 'South America Groups list', 'gogalapagos' ),
		'items_list_navigation'      => __( 'South America Groups list navigation', 'gogalapagos' ),
	);
	$rewrite = array(
		'slug'                       => 'south-america-tours',
		'with_front'                 => true,
		'hierarchical'               => true,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'query_var'                  => 'south-america-tour-group',
		'rewrite'                    => $rewrite,
		'show_in_rest'               => true,
		'rest_base'                  => 'ggsatoursgroup',
	);
	register_taxonomy( 'go_sa_tours', array( 'ggsatour' ), $args );

}
add_action( 'init', 'sa_tours_tax', 0 );

// Register Custom Taxonomy
function animals_tax() {

	$labels = array(
		'name'                       => _x( 'Galapagos Animal Groups', 'Taxonomy General Name', 'gogalapagos' ),
		'singular_name'              => _x( 'Group', 'Taxonomy Singular Name', 'gogalapagos' ),
		'menu_name'                  => __( 'Animal Groups', 'gogalapagos' ),
		'all_items'                  => __( 'All Groups', 'gogalapagos' ),
		'parent_item'                => __( 'Parent Group', 'gogalapagos' ),
		'parent_item_colon'          => __( 'Parent Group:', 'gogalapagos' ),
		'new_item_name'              => __( 'New Group Name', 'gogalapagos' ),
		'add_new_item'               => __( 'Add New Group', 'gogalapagos' ),
		'edit_item'                  => __( 'Edit Group', 'gogalapagos' ),
		'update_item'                => __( 'Update Group', 'gogalapagos' ),
		'view_item'                  => __( 'View Group', 'gogalapagos' ),
		'separate_items_with_commas' => __( 'Separate Groups with commas', 'gogalapagos' ),
		'add_or_remove_items'        => __( 'Add or remove Groups', 'gogalapagos' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'gogalapagos' ),
		'popular_items'              => __( 'Popular Groups', 'gogalapagos' ),
		'search_items'               => __( 'Search Groups', 'gogalapagos' ),
		'not_found'                  => __( 'Not Found', 'gogalapagos' ),
		'no_terms'                   => __( 'No Groups', 'gogalapagos' ),
		'items_list'                 => __( 'Groups list', 'gogalapagos' ),
		'items_list_navigation'      => __( 'Groups list navigation', 'gogalapagos' ),
	);
	$rewrite = array(
		'slug'                       => 'galapagos-animal-group',
		'with_front'                 => true,
		'hierarchical'               => true,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'query_var'                  => 'animal-group',
		'rewrite'                    => $rewrite,
		'show_in_rest'               => true,
		'rest_base'                  => 'gganimalgroup',
	);
	register_taxonomy( 'animalgroup', array( 'gganimal' ), $args );

}
add_action( 'init', 'animals_tax', 0 );

// Register Custom Taxonomy
function faqs_tax() {

	$labels = array(
		'name'                       => _x( 'FAQs Groups', 'Taxonomy General Name', 'gogalapagos' ),
		'singular_name'              => _x( 'FAQs Group', 'Taxonomy Singular Name', 'gogalapagos' ),
		'menu_name'                  => __( 'FAQs Groups', 'gogalapagos' ),
		'all_items'                  => __( 'All Groups', 'gogalapagos' ),
		'parent_item'                => __( 'Parent Group', 'gogalapagos' ),
		'parent_item_colon'          => __( 'Parent Group:', 'gogalapagos' ),
		'new_item_name'              => __( 'New Group Name', 'gogalapagos' ),
		'add_new_item'               => __( 'Add New Group', 'gogalapagos' ),
		'edit_item'                  => __( 'Edit Group', 'gogalapagos' ),
		'update_item'                => __( 'Update Group', 'gogalapagos' ),
		'view_item'                  => __( 'View Group', 'gogalapagos' ),
		'separate_items_with_commas' => __( 'Separate Groups with commas', 'gogalapagos' ),
		'add_or_remove_items'        => __( 'Add or remove Groups', 'gogalapagos' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'gogalapagos' ),
		'popular_items'              => __( 'Popular Groups', 'gogalapagos' ),
		'search_items'               => __( 'Search Groups', 'gogalapagos' ),
		'not_found'                  => __( 'Not Found', 'gogalapagos' ),
		'no_terms'                   => __( 'No Groups', 'gogalapagos' ),
		'items_list'                 => __( 'Groups list', 'gogalapagos' ),
		'items_list_navigation'      => __( 'Groups list navigation', 'gogalapagos' ),
	);
	$rewrite = array(
		'slug'                       => 'faqs',
		'with_front'                 => true,
		'hierarchical'               => true,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'query_var'                  => 'faqs',
		'rewrite'                    => $rewrite,
		'show_in_rest'               => true,
		'rest_base'                  => 'ggfaqs',
	);
	register_taxonomy( 'go_faqs', array( 'ggfaqs' ), $args );

}
add_action( 'init', 'faqs_tax', 0 );

// Register Custom Taxonomy
function onboardservices_tax() {

	$labels = array(
		'name'                       => _x( 'Onboard Service Package Groups', 'Taxonomy General Name', 'gogalapagos' ),
		'singular_name'              => _x( 'Onboard Service Package Group', 'Taxonomy Singular Name', 'gogalapagos' ),
		'menu_name'                  => __( 'Onboard Service Package Groups', 'gogalapagos' ),
		'all_items'                  => __( 'All Groups', 'gogalapagos' ),
		'parent_item'                => __( 'Parent Group', 'gogalapagos' ),
		'parent_item_colon'          => __( 'Parent Group:', 'gogalapagos' ),
		'new_item_name'              => __( 'New Group Name', 'gogalapagos' ),
		'add_new_item'               => __( 'Add New Group', 'gogalapagos' ),
		'edit_item'                  => __( 'Edit Group', 'gogalapagos' ),
		'update_item'                => __( 'Update Group', 'gogalapagos' ),
		'view_item'                  => __( 'View Group', 'gogalapagos' ),
		'separate_items_with_commas' => __( 'Separate Groups with commas', 'gogalapagos' ),
		'add_or_remove_items'        => __( 'Add or remove Groups', 'gogalapagos' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'gogalapagos' ),
		'popular_items'              => __( 'Popular Groups', 'gogalapagos' ),
		'search_items'               => __( 'Search Groups', 'gogalapagos' ),
		'not_found'                  => __( 'Not Found', 'gogalapagos' ),
		'no_terms'                   => __( 'No Groups', 'gogalapagos' ),
		'items_list'                 => __( 'Groups list', 'gogalapagos' ),
		'items_list_navigation'      => __( 'Groups list navigation', 'gogalapagos' ),
	);
	$rewrite = array(
		'slug'                       => 'onboard-service-packages',
		'with_front'                 => true,
		'hierarchical'               => true,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'query_var'                  => 'onboardservicepackage',
		'rewrite'                    => $rewrite,
		'show_in_rest'               => true,
		'rest_base'                  => 'ggonboardservicepackage',
	);
	register_taxonomy( 'onboard-service-package', array( 'ggonboardservices' ), $args );

}
add_action( 'init', 'onboardservices_tax', 0 );
?>
