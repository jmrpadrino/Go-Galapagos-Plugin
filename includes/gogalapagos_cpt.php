<?php

/*
 * Este archivo contiene los codigo para generar las unidades de información
 * que comprende:
 * 1. Barcos => gg_ship()
 * 2. Decks => gg_decks()
 * 3. Cabinas => gg_cabins()
 * 4. Itinerarios => gg_itineraries()
 * 4. Locaciones => gg_locations()
 * 5. Islas => gg_islands()
 * 6. Animales => gg_animals()
 */

//if( current_user_can('administrator') or current_user_can('editor') ) {

// Register Custom Post Type
function gg_registerPostTypeForShips() {

    $labels = array(
        'name'                  => _x( 'Ships', 'Post Type General Name', 'gogalapagos' ),
        'singular_name'         => _x( 'Ship', 'Post Type Singular Name', 'gogalapagos' ),
        'menu_name'             => __( 'Ships', 'gogalapagos' ),
        'name_admin_bar'        => __( 'Ships', 'gogalapagos' ),
        'archives'              => __( 'Ship Archives', 'gogalapagos' ),
        'attributes'            => __( 'Ship Attributes', 'gogalapagos' ),
        'parent_item_colon'     => __( 'Parent Ship:', 'gogalapagos' ),
        'all_items'             => __( 'All Ships', 'gogalapagos' ),
        'add_new_item'          => __( 'Add New Ship', 'gogalapagos' ),
        'add_new'               => __( 'Add New', 'gogalapagos' ),
        'new_item'              => __( 'New Ship', 'gogalapagos' ),
        'edit_item'             => __( 'Edit Ship', 'gogalapagos' ),
        'update_item'           => __( 'Update Ship', 'gogalapagos' ),
        'view_item'             => __( 'View Ship', 'gogalapagos' ),
        'view_items'            => __( 'View Ships', 'gogalapagos' ),
        'search_items'          => __( 'Search Ship', 'gogalapagos' ),
        'not_found'             => __( 'Not found', 'gogalapagos' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'gogalapagos' ),
        'featured_image'        => __( 'Hero Page Featured Image', 'gogalapagos' ),
        'set_featured_image'    => __( 'Set Hero Page featured image', 'gogalapagos' ),
        'remove_featured_image' => __( 'Remove featured image', 'gogalapagos' ),
        'use_featured_image'    => __( 'Use as featured image', 'gogalapagos' ),
        'insert_into_item'      => __( 'Insert into Ship', 'gogalapagos' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Ship', 'gogalapagos' ),
        'items_list'            => __( 'Ships list', 'gogalapagos' ),
        'items_list_navigation' => __( 'Ships list navigation', 'gogalapagos' ),
        'filter_items_list'     => __( 'Filter Ships list', 'gogalapagos' ),
    );
    $rewrite = array(
        'slug'                  => 'ship',
        'with_front'            => false,
        'pages'                 => true,
        'feeds'                 => true,
    );
    $args = array(
        'label'                 => __( 'Ship', 'gogalapagos' ),
        'description'           => __( 'Go Galapagos Ships', 'gogalapagos' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
        'taxonomies'            => array(''),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => false,
        'menu_position'         => 99,
        'menu_icon'             => URLPLUGINGOGALAPAGOS . 'images/admin-icon.png',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => 'galapagos-cruises',
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rest_base'             => 'ggship',
    );
    register_post_type( 'ggships', $args );

}
add_action( 'init', 'gg_registerPostTypeForShips', 0 );

// Register Custom Post Type
function gg_registerPostTypeForDecks() {

    $labels = array(
        'name'                  => _x( 'Decks', 'Post Type General Name', 'gogalapagos' ),
        'singular_name'         => _x( 'Deck', 'Post Type Singular Name', 'gogalapagos' ),
        'menu_name'             => __( 'Decks', 'gogalapagos' ),
        'name_admin_bar'        => __( 'Decks', 'gogalapagos' ),
        'archives'              => __( 'Deck Archives', 'gogalapagos' ),
        'attributes'            => __( 'Deck Attributes', 'gogalapagos' ),
        'parent_item_colon'     => __( 'Parent Deck:', 'gogalapagos' ),
        'all_items'             => __( 'All Decks', 'gogalapagos' ),
        'add_new_item'          => __( 'Add New Deck', 'gogalapagos' ),
        'add_new'               => __( 'Add New', 'gogalapagos' ),
        'new_item'              => __( 'New Deck', 'gogalapagos' ),
        'edit_item'             => __( 'Edit Deck', 'gogalapagos' ),
        'update_item'           => __( 'Update Deck', 'gogalapagos' ),
        'view_item'             => __( 'View Deck', 'gogalapagos' ),
        'view_items'            => __( 'View Decks', 'gogalapagos' ),
        'search_items'          => __( 'Search Deck', 'gogalapagos' ),
        'not_found'             => __( 'Not found', 'gogalapagos' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'gogalapagos' ),
        'featured_image'        => __( 'Featured Image', 'gogalapagos' ),
        'set_featured_image'    => __( 'Set featured image', 'gogalapagos' ),
        'remove_featured_image' => __( 'Remove featured image', 'gogalapagos' ),
        'use_featured_image'    => __( 'Use as featured image', 'gogalapagos' ),
        'insert_into_item'      => __( 'Insert into Deck', 'gogalapagos' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Deck', 'gogalapagos' ),
        'items_list'            => __( 'Decks list', 'gogalapagos' ),
        'items_list_navigation' => __( 'Decks list navigation', 'gogalapagos' ),
        'filter_items_list'     => __( 'Filter Decks list', 'gogalapagos' ),
    );
    $args = array(
        'label'                 => __( 'Deck', 'gogalapagos' ),
        'description'           => __( 'Ship Decks', 'gogalapagos' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail'),
        'taxonomies'            => array(''),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => false,
        'menu_position'         => 99,
        'menu_icon'             => URLPLUGINGOGALAPAGOS . 'images/admin-icon.png',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => '',
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rest_base'             => 'ggdeck',
    );
    register_post_type( 'ggdecks', $args );

}
add_action( 'init', 'gg_registerPostTypeForDecks', 0 );

// Register Custom Post Type
function gg_registerPostTypeForCabins() {

    $labels = array(
        'name'                  => _x( 'Cabins', 'Post Type General Name', 'gogalapagos' ),
        'singular_name'         => _x( 'Cabins', 'Post Type Singular Name', 'gogalapagos' ),
        'menu_name'             => __( 'Cabins', 'gogalapagos' ),
        'name_admin_bar'        => __( 'Cabins', 'gogalapagos' ),
        'archives'              => __( 'Cabin Archives', 'gogalapagos' ),
        'attributes'            => __( 'Cabin Attributes', 'gogalapagos' ),
        'parent_item_colon'     => __( 'Parent Cabin:', 'gogalapagos' ),
        'all_items'             => __( 'All Cabins', 'gogalapagos' ),
        'add_new_item'          => __( 'Add New Cabin', 'gogalapagos' ),
        'add_new'               => __( 'Add New', 'gogalapagos' ),
        'new_item'              => __( 'New Cabin', 'gogalapagos' ),
        'edit_item'             => __( 'Edit Cabin', 'gogalapagos' ),
        'update_item'           => __( 'Update Cabin', 'gogalapagos' ),
        'view_item'             => __( 'View Cabin', 'gogalapagos' ),
        'view_items'            => __( 'View Cabins', 'gogalapagos' ),
        'search_items'          => __( 'Search Cabin', 'gogalapagos' ),
        'not_found'             => __( 'Not found', 'gogalapagos' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'gogalapagos' ),
        'featured_image'        => __( 'Featured Image', 'gogalapagos' ),
        'set_featured_image'    => __( 'Set featured image', 'gogalapagos' ),
        'remove_featured_image' => __( 'Remove featured image', 'gogalapagos' ),
        'use_featured_image'    => __( 'Use as featured image', 'gogalapagos' ),
        'insert_into_item'      => __( 'Insert into Cabin', 'gogalapagos' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Cabin', 'gogalapagos' ),
        'items_list'            => __( 'Cabins list', 'gogalapagos' ),
        'items_list_navigation' => __( 'Cabins list navigation', 'gogalapagos' ),
        'filter_items_list'     => __( 'Filter Cabins list', 'gogalapagos' ),
    );
    $rewrite = array(
        'slug'                  => 'cabin',
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    );
    $args = array(
        'label'                 => __( 'Cabins', 'gogalapagos' ),
        'description'           => __( 'Go Galapagos Cabins', 'gogalapagos' ),
        'labels'                => $labels,
        'supports'              => array( 'title', /*'editor', 'excerpt',*/ 'thumbnail' ),
        'taxonomies'            => array(''),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => false,
        'menu_position'         => 99,
        'menu_icon'             => URLPLUGINGOGALAPAGOS . 'images/admin-icon.png',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => 'our-cabins',
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'post',    
        'show_in_rest'          => true,
        'rest_base'             => 'ggcabins',
    );
    register_post_type( 'ggcabins', $args );

}
add_action( 'init', 'gg_registerPostTypeForCabins', 0 );

// Register Custom Post Type
function gg_registerPostTypeForSocialAreas() {

    $labels = array(
        'name'                  => _x( 'Social Areas', 'Post Type General Name', 'gogalapagos' ),
        'singular_name'         => _x( 'Social Area', 'Post Type Singular Name', 'gogalapagos' ),
        'menu_name'             => __( 'Social Areas', 'gogalapagos' ),
        'name_admin_bar'        => __( 'Social Areas', 'gogalapagos' ),
        'archives'              => __( 'Social Area Archives', 'gogalapagos' ),
        'attributes'            => __( 'Social Area Attributes', 'gogalapagos' ),
        'parent_item_colon'     => __( 'Parent Social Area:', 'gogalapagos' ),
        'all_items'             => __( 'All Social Areas', 'gogalapagos' ),
        'add_new_item'          => __( 'Add New Social Area', 'gogalapagos' ),
        'add_new'               => __( 'Add New', 'gogalapagos' ),
        'new_item'              => __( 'New Social Area', 'gogalapagos' ),
        'edit_item'             => __( 'Edit Social Area', 'gogalapagos' ),
        'update_item'           => __( 'Update Social Area', 'gogalapagos' ),
        'view_item'             => __( 'View Social Area', 'gogalapagos' ),
        'view_items'            => __( 'View Social Areas', 'gogalapagos' ),
        'search_items'          => __( 'Search Social Area', 'gogalapagos' ),
        'not_found'             => __( 'Not found', 'gogalapagos' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'gogalapagos' ),
        'featured_image'        => __( 'Social Area Main Image', 'gogalapagos' ),
        'set_featured_image'    => __( 'Set Social Area Main image', 'gogalapagos' ),
        'remove_featured_image' => __( 'Remove Social Area Main image', 'gogalapagos' ),
        'use_featured_image'    => __( 'Use as Social Area Main image', 'gogalapagos' ),
        'insert_into_item'      => __( 'Insert into Social Area', 'gogalapagos' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Social Area', 'gogalapagos' ),
        'items_list'            => __( 'Social Areas list', 'gogalapagos' ),
        'items_list_navigation' => __( 'Social Areas list navigation', 'gogalapagos' ),
        'filter_items_list'     => __( 'Filter Social Areas list', 'gogalapagos' ),
    );
    $rewrite = array(
        'slug'                  => 'social-area',
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    );
    /*$capabilities = array(
		'edit_post'             => 'edit_post',
		'read_post'             => 'read_post',
		'delete_post'           => 'delete_post',
		'edit_posts'            => 'edit_posts',
		'edit_others_posts'     => 'edit_others_posts',
		'publish_posts'         => 'publish_posts',
		'read_private_posts'    => 'read_private_posts',
	);*/
    $args = array(
        'label'                 => __( 'Social Area', 'gogalapagos' ),
        'description'           => __( 'Go Galapagos Social Area', 'gogalapagos' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'excerpt', 'thumbnail', 'page-attributes'),
        'taxonomies'            => array(''),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => false,
        'menu_position'         => 99,
        'menu_icon'             => URLPLUGINGOGALAPAGOS . 'images/admin-icon.png',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => 'social-areas-on-board',
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'post',
        //'capabilities'          => $capabilities,
        'show_in_rest'          => true,
        'rest_base'             => 'ggsocialarea',
    );
    register_post_type( 'ggsocialarea', $args );

}
add_action( 'init', 'gg_registerPostTypeForSocialAreas', 0 );

// Register Custom Post Type
function gg_registerPostTypeForItineraries() {

    $labels = array(
        'name'                  => _x( 'Itineraries', 'Post Type General Name', 'gogalapagos' ),
        'singular_name'         => _x( 'Itinerary', 'Post Type Singular Name', 'gogalapagos' ),
        'menu_name'             => __( 'Itineraries', 'gogalapagos' ),
        'name_admin_bar'        => __( 'Itineraries', 'gogalapagos' ),
        'archives'              => __( 'Itinerary Archives', 'gogalapagos' ),
        'attributes'            => __( 'Itinerary Attributes', 'gogalapagos' ),
        'parent_item_colon'     => __( 'Parent Itinerary:', 'gogalapagos' ),
        'all_items'             => __( 'All Itineraries', 'gogalapagos' ),
        'add_new_item'          => __( 'Add New Itinerary', 'gogalapagos' ),
        'add_new'               => __( 'Add New', 'gogalapagos' ),
        'new_item'              => __( 'New Itinerary', 'gogalapagos' ),
        'edit_item'             => __( 'Edit Itinerary', 'gogalapagos' ),
        'update_item'           => __( 'Update Itinerary', 'gogalapagos' ),
        'view_item'             => __( 'View Itinerary', 'gogalapagos' ),
        'view_items'            => __( 'View Itineraries', 'gogalapagos' ),
        'search_items'          => __( 'Search Itinerary', 'gogalapagos' ),
        'not_found'             => __( 'Not found', 'gogalapagos' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'gogalapagos' ),
        'featured_image'        => __( 'Featured Image', 'gogalapagos' ),
        'set_featured_image'    => __( 'Set featured image', 'gogalapagos' ),
        'remove_featured_image' => __( 'Remove featured image', 'gogalapagos' ),
        'use_featured_image'    => __( 'Use as featured image', 'gogalapagos' ),
        'insert_into_item'      => __( 'Insert into Itinerary', 'gogalapagos' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Itinerary', 'gogalapagos' ),
        'items_list'            => __( 'Itineraries list', 'gogalapagos' ),
        'items_list_navigation' => __( 'Itineraries list navigation', 'gogalapagos' ),
        'filter_items_list'     => __( 'Filter Itineraries list', 'gogalapagos' ),
    );
    $rewrite = array(
        'slug'                  => 'itinerary',
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    );
    /*$capabilities = array(
		'edit_post'             => 'edit_post',
		'read_post'             => 'read_post',
		'delete_post'           => 'delete_post',
		'edit_posts'            => 'edit_posts',
		'edit_others_posts'     => 'edit_others_posts',
		'publish_posts'         => 'publish_posts',
		'read_private_posts'    => 'read_private_posts',
	);*/
    $args = array(
        'label'                 => __( 'Itinerary', 'gogalapagos' ),
        'description'           => __( 'Ship Itinararies', 'gogalapagos' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'excerpt', 'author', 'thumbnail', 'revisions', ),
        'taxonomies'            => array(''),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => false,
        'menu_position'         => 99,
        'menu_icon'             => URLPLUGINGOGALAPAGOS . 'images/admin-icon.png',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => 'itineraries',
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'post',
        //'capabilities'          => $capabilities,
        'show_in_rest'          => true,
        'rest_base'             => 'ggitinerary',
    );
    register_post_type( 'ggitineraries', $args );

}
add_action( 'init', 'gg_registerPostTypeForItineraries', 0 );

// Register Custom Post Type
function gg_registerPostTypeForIslands() {

    $labels = array(
        'name'                  => _x( 'Islands', 'Post Type General Name', 'gogalapagos' ),
        'singular_name'         => _x( 'Island', 'Post Type Singular Name', 'gogalapagos' ),
        'menu_name'             => __( 'Islands', 'gogalapagos' ),
        'name_admin_bar'        => __( 'Islands', 'gogalapagos' ),
        'archives'              => __( 'Island Archives', 'gogalapagos' ),
        'attributes'            => __( 'Island Attributes', 'gogalapagos' ),
        'parent_item_colon'     => __( 'Parent Island:', 'gogalapagos' ),
        'all_items'             => __( 'All Islands', 'gogalapagos' ),
        'add_new_item'          => __( 'Add New Island', 'gogalapagos' ),
        'add_new'               => __( 'Add New', 'gogalapagos' ),
        'new_item'              => __( 'New Island', 'gogalapagos' ),
        'edit_item'             => __( 'Edit Island', 'gogalapagos' ),
        'update_item'           => __( 'Update Island', 'gogalapagos' ),
        'view_item'             => __( 'View Island', 'gogalapagos' ),
        'view_items'            => __( 'View Islands', 'gogalapagos' ),
        'search_items'          => __( 'Search Island', 'gogalapagos' ),
        'not_found'             => __( 'Not found', 'gogalapagos' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'gogalapagos' ),
        'featured_image'        => __( 'Featured Image', 'gogalapagos' ),
        'set_featured_image'    => __( 'Set featured image', 'gogalapagos' ),
        'remove_featured_image' => __( 'Remove featured image', 'gogalapagos' ),
        'use_featured_image'    => __( 'Use as featured image', 'gogalapagos' ),
        'insert_into_item'      => __( 'Insert into Island', 'gogalapagos' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Island', 'gogalapagos' ),
        'items_list'            => __( 'Islands list', 'gogalapagos' ),
        'items_list_navigation' => __( 'Islands list navigation', 'gogalapagos' ),
        'filter_items_list'     => __( 'Filter Islands list', 'gogalapagos' ),
    );
    $rewrite = array(
        'slug'                  => 'island',
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    );
    $capabilities = array(
		'edit_post'             => 'edit_post',
		'read_post'             => 'read_post',
		'delete_post'           => 'delete_post',
		'edit_posts'            => 'edit_posts',
		'edit_others_posts'     => 'edit_others_posts',
		'publish_posts'         => 'publish_posts',
		'read_private_posts'    => 'read_private_posts',
	);
    $args = array(
        'label'                 => __( 'Island', 'gogalapagos' ),
        'description'           => __( 'Galapagos Islands', 'gogalapagos' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'page-attributes', ),
        'taxonomies'            => array(''),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => false,
        'menu_position'         => 99,
        'menu_icon'             => URLPLUGINGOGALAPAGOS . 'images/admin-icon.png',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => 'galapagos-islands',
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'post',
        //'capabilities'          => $capabilities,
        'show_in_rest'          => true,
        'rest_base'             => 'ggisland',
    );
    register_post_type( 'ggisland', $args );

}
add_action( 'init', 'gg_registerPostTypeForIslands', 0 );


// Register Custom Post Type
function gg_registerPostTypeForLocations() {

    $labels = array(
        'name'                  => _x( 'Locations', 'Post Type General Name', 'gogalapagos' ),
        'singular_name'         => _x( 'Location', 'Post Type Singular Name', 'gogalapagos' ),
        'menu_name'             => __( 'Locations', 'gogalapagos' ),
        'name_admin_bar'        => __( 'Locations', 'gogalapagos' ),
        'archives'              => __( 'Location Archives', 'gogalapagos' ),
        'attributes'            => __( 'Location Attributes', 'gogalapagos' ),
        'parent_item_colon'     => __( 'Parent Location:', 'gogalapagos' ),
        'all_items'             => __( 'All Locations', 'gogalapagos' ),
        'add_new_item'          => __( 'Add New Location', 'gogalapagos' ),
        'add_new'               => __( 'Add New', 'gogalapagos' ),
        'new_item'              => __( 'New Location', 'gogalapagos' ),
        'edit_item'             => __( 'Edit Location', 'gogalapagos' ),
        'update_item'           => __( 'Update Location', 'gogalapagos' ),
        'view_item'             => __( 'View Location', 'gogalapagos' ),
        'view_items'            => __( 'View Locations', 'gogalapagos' ),
        'search_items'          => __( 'Search Location', 'gogalapagos' ),
        'not_found'             => __( 'Not found', 'gogalapagos' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'gogalapagos' ),
        'featured_image'        => __( 'Featured Image', 'gogalapagos' ),
        'set_featured_image'    => __( 'Set featured image', 'gogalapagos' ),
        'remove_featured_image' => __( 'Remove featured image', 'gogalapagos' ),
        'use_featured_image'    => __( 'Use as featured image', 'gogalapagos' ),
        'insert_into_item'      => __( 'Insert into Location', 'gogalapagos' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Location', 'gogalapagos' ),
        'items_list'            => __( 'Locations list', 'gogalapagos' ),
        'items_list_navigation' => __( 'Locations list navigation', 'gogalapagos' ),
        'filter_items_list'     => __( 'Filter Locations list', 'gogalapagos' ),
    );
    $rewrite = array(
        'slug'                  => 'location',
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    );
    $capabilities = array(
		'edit_post'             => 'edit_post',
		'read_post'             => 'read_post',
		'delete_post'           => 'delete_post',
		'edit_posts'            => 'edit_posts',
		'edit_others_posts'     => 'edit_others_posts',
		'publish_posts'         => 'publish_posts',
		'read_private_posts'    => 'read_private_posts',
	);
    $args = array(
        'label'                 => __( 'Location', 'gogalapagos' ),
        'description'           => __( 'Galapagos Locations', 'gogalapagos' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'revisions', ),
        'taxonomies'            => array(''),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => false,
        'menu_position'         => 99,
        'menu_icon'             => URLPLUGINGOGALAPAGOS . 'images/admin-icon.png',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => 'galapagos-island-locations',
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'post',
        //'capabilities'          => $capabilities,
        'show_in_rest'          => true,
        'rest_base'             => 'gglocation',
    );
    register_post_type( 'gglocation', $args );

}
add_action( 'init', 'gg_registerPostTypeForLocations', 0 );

// Register Custom Post Type
function gg_registerPostTypeForActivities() {

    $labels = array(
        'name'                  => _x( 'Activities', 'Post Type General Name', 'gogalapagos' ),
        'singular_name'         => _x( 'Activity', 'Post Type Singular Name', 'gogalapagos' ),
        'menu_name'             => __( 'Activities', 'gogalapagos' ),
        'name_admin_bar'        => __( 'Activities', 'gogalapagos' ),
        'archives'              => __( 'Activity Archives', 'gogalapagos' ),
        'attributes'            => __( 'Activity Attributes', 'gogalapagos' ),
        'parent_item_colon'     => __( 'Parent Activity:', 'gogalapagos' ),
        'all_items'             => __( 'All Activities', 'gogalapagos' ),
        'add_new_item'          => __( 'Add New Activity', 'gogalapagos' ),
        'add_new'               => __( 'Add New', 'gogalapagos' ),
        'new_item'              => __( 'New Activity', 'gogalapagos' ),
        'edit_item'             => __( 'Edit Activity', 'gogalapagos' ),
        'update_item'           => __( 'Update Activity', 'gogalapagos' ),
        'view_item'             => __( 'View Activity', 'gogalapagos' ),
        'view_items'            => __( 'View Activities', 'gogalapagos' ),
        'search_items'          => __( 'Search Activity', 'gogalapagos' ),
        'not_found'             => __( 'Not found', 'gogalapagos' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'gogalapagos' ),
        'featured_image'        => __( 'Featured Image', 'gogalapagos' ),
        'set_featured_image'    => __( 'Set featured image', 'gogalapagos' ),
        'remove_featured_image' => __( 'Remove featured image', 'gogalapagos' ),
        'use_featured_image'    => __( 'Use as featured image', 'gogalapagos' ),
        'insert_into_item'      => __( 'Insert into Activity', 'gogalapagos' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Activity', 'gogalapagos' ),
        'items_list'            => __( 'Activities list', 'gogalapagos' ),
        'items_list_navigation' => __( 'Activities list navigation', 'gogalapagos' ),
        'filter_items_list'     => __( 'Filter Activities list', 'gogalapagos' ),
    );
    $rewrite = array(
        'slug'                  => 'activity',
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    );
    $capabilities = array(
		'edit_post'             => 'edit_post',
		'read_post'             => 'read_post',
		'delete_post'           => 'delete_post',
		'edit_posts'            => 'edit_posts',
		'edit_others_posts'     => 'edit_others_posts',
		'publish_posts'         => 'publish_posts',
		'read_private_posts'    => 'read_private_posts',
	);
    $args = array(
        'label'                 => __( 'Activity', 'gogalapagos' ),
        'description'           => __( 'Go Galapagos Activities', 'gogalapagos' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'page-attributes', ),
        'taxonomies'            => array(''),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => false,
        'menu_position'         => 99,
        'menu_icon'             => URLPLUGINGOGALAPAGOS . 'images/admin-icon.png',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => 'galapagos-activities',
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rest_base'             => 'ggactivity',
    );
    register_post_type( 'ggactivity', $args );

}
add_action( 'init', 'gg_registerPostTypeForActivities', 0 );

// Register Custom Post Type Special Interest
function gg_registerPostTypeForSpecialInterest() {

    $labels = array(
        'name'                  => _x( 'Special Interests', 'Post Type General Name', 'gogalapagos' ),
        'singular_name'         => _x( 'Special Interest', 'Post Type Singular Name', 'gogalapagos' ),
        'menu_name'             => __( 'Special Interests', 'gogalapagos' ),
        'name_admin_bar'        => __( 'Special Interests', 'gogalapagos' ),
        'archives'              => __( 'Special Interest Archives', 'gogalapagos' ),
        'attributes'            => __( 'Special Interest Attributes', 'gogalapagos' ),
        'parent_item_colon'     => __( 'Parent Special Interest:', 'gogalapagos' ),
        'all_items'             => __( 'All Special Interests', 'gogalapagos' ),
        'add_new_item'          => __( 'Add New Special Interest', 'gogalapagos' ),
        'add_new'               => __( 'Add New', 'gogalapagos' ),
        'new_item'              => __( 'New Special Interest', 'gogalapagos' ),
        'edit_item'             => __( 'Edit Special Interest', 'gogalapagos' ),
        'update_item'           => __( 'Update Special Interest', 'gogalapagos' ),
        'view_item'             => __( 'View Special Interest', 'gogalapagos' ),
        'view_items'            => __( 'View Special Interests', 'gogalapagos' ),
        'search_items'          => __( 'Search Special Interest', 'gogalapagos' ),
        'not_found'             => __( 'Not found', 'gogalapagos' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'gogalapagos' ),
        'featured_image'        => __( 'Featured Image', 'gogalapagos' ),
        'set_featured_image'    => __( 'Set featured image', 'gogalapagos' ),
        'remove_featured_image' => __( 'Remove featured image', 'gogalapagos' ),
        'use_featured_image'    => __( 'Use as featured image', 'gogalapagos' ),
        'insert_into_item'      => __( 'Insert into Special Interest', 'gogalapagos' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Special Interest', 'gogalapagos' ),
        'items_list'            => __( 'Special Interests list', 'gogalapagos' ),
        'items_list_navigation' => __( 'Special Interests list navigation', 'gogalapagos' ),
        'filter_items_list'     => __( 'Filter Special Interests list', 'gogalapagos' ),
    );
    $rewrite = array(
        'slug'                  => 'Special-interest',
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    );
    $capabilities = array(
		'edit_post'             => 'edit_post',
		'read_post'             => 'read_post',
		'delete_post'           => 'delete_post',
		'edit_posts'            => 'edit_posts',
		'edit_others_posts'     => 'edit_others_posts',
		'publish_posts'         => 'publish_posts',
		'read_private_posts'    => 'read_private_posts',
	);
    $args = array(
        'label'                 => __( 'Special Interest', 'gogalapagos' ),
        'description'           => __( 'Go Galapagos Special Interest', 'gogalapagos' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', ),
        'taxonomies'            => array(''),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => false,
        'menu_position'         => 99,
        'menu_icon'             => URLPLUGINGOGALAPAGOS . 'images/admin-icon.png',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => 'special-interest',
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rest_base'             => 'ggSpecialinterest',
    );
    register_post_type( 'ggspecialinterest', $args );

}
add_action( 'init', 'gg_registerPostTypeForSpecialInterest', 0 );

// Register Custom Post Type Special Interest
function gg_registerPostTypeForSpecialOffers() {

    $labels = array(
        'name'                  => _x( 'Special Offers', 'Post Type General Name', 'gogalapagos' ),
        'singular_name'         => _x( 'Special Offer', 'Post Type Singular Name', 'gogalapagos' ),
        'menu_name'             => __( 'Special Offers', 'gogalapagos' ),
        'name_admin_bar'        => __( 'Special Offers', 'gogalapagos' ),
        'archives'              => __( 'Special Offer Archives', 'gogalapagos' ),
        'attributes'            => __( 'Special Offer Attributes', 'gogalapagos' ),
        'parent_item_colon'     => __( 'Parent Special Offer:', 'gogalapagos' ),
        'all_items'             => __( 'All Special Offers', 'gogalapagos' ),
        'add_new_item'          => __( 'Add New Special Offer', 'gogalapagos' ),
        'add_new'               => __( 'Add New', 'gogalapagos' ),
        'new_item'              => __( 'New Special Offer', 'gogalapagos' ),
        'edit_item'             => __( 'Edit Special Offer', 'gogalapagos' ),
        'update_item'           => __( 'Update Special Offer', 'gogalapagos' ),
        'view_item'             => __( 'View Special Offer', 'gogalapagos' ),
        'view_items'            => __( 'View Special Offers', 'gogalapagos' ),
        'search_items'          => __( 'Search Special Offer', 'gogalapagos' ),
        'not_found'             => __( 'Not found', 'gogalapagos' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'gogalapagos' ),
        'featured_image'        => __( 'Featured Image', 'gogalapagos' ),
        'set_featured_image'    => __( 'Set featured image', 'gogalapagos' ),
        'remove_featured_image' => __( 'Remove featured image', 'gogalapagos' ),
        'use_featured_image'    => __( 'Use as featured image', 'gogalapagos' ),
        'insert_into_item'      => __( 'Insert into Special Offer', 'gogalapagos' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Special Offer', 'gogalapagos' ),
        'items_list'            => __( 'Special Offers list', 'gogalapagos' ),
        'items_list_navigation' => __( 'Special Offers list navigation', 'gogalapagos' ),
        'filter_items_list'     => __( 'Filter Special Offers list', 'gogalapagos' ),
    );
    $rewrite = array(
        'slug'                  => 'special-offer',
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    );
    $capabilities = array(
		'edit_post'             => 'edit_post',
		'read_post'             => 'read_post',
		'delete_post'           => 'delete_post',
		'edit_posts'            => 'edit_posts',
		'edit_others_posts'     => 'edit_others_posts',
		'publish_posts'         => 'publish_posts',
		'read_private_posts'    => 'read_private_posts',
	);
    $args = array(
        'label'                 => __( 'Special Offers', 'gogalapagos' ),
        'description'           => __( 'Go Galapagos Special Offers', 'gogalapagos' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', ),
        'taxonomies'            => array(''),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => false,
        'menu_position'         => 99,
        'menu_icon'             => URLPLUGINGOGALAPAGOS . 'images/admin-icon.png',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => 'special-offers',
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rest_base'             => 'ggspecialoffers',
    );
    register_post_type( 'ggspecialoffer', $args );

}
add_action( 'init', 'gg_registerPostTypeForSpecialOffers', 0 );


// Register Custom Post Type
function gg_registerPostTypeForAnimals() {

    $labels = array(
        'name'                  => _x( 'Animals', 'Post Type General Name', 'gogalapagos' ),
        'singular_name'         => _x( 'Animal', 'Post Type Singular Name', 'gogalapagos' ),
        'menu_name'             => __( 'Animals', 'gogalapagos' ),
        'name_admin_bar'        => __( 'Animals', 'gogalapagos' ),
        'archives'              => __( 'Animal Archives', 'gogalapagos' ),
        'attributes'            => __( 'Animal Attributes', 'gogalapagos' ),
        'parent_item_colon'     => __( 'Parent Animal:', 'gogalapagos' ),
        'all_items'             => __( 'All Animals', 'gogalapagos' ),
        'add_new_item'          => __( 'Add New Animal', 'gogalapagos' ),
        'add_new'               => __( 'Add New', 'gogalapagos' ),
        'new_item'              => __( 'New Animal', 'gogalapagos' ),
        'edit_item'             => __( 'Edit Animal', 'gogalapagos' ),
        'update_item'           => __( 'Update Animal', 'gogalapagos' ),
        'view_item'             => __( 'View Animal', 'gogalapagos' ),
        'view_items'            => __( 'View Animal', 'gogalapagos' ),
        'search_items'          => __( 'Search Animal', 'gogalapagos' ),
        'not_found'             => __( 'Not found', 'gogalapagos' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'gogalapagos' ),
        'featured_image'        => __( 'Featured Image', 'gogalapagos' ),
        'set_featured_image'    => __( 'Set featured image', 'gogalapagos' ),
        'remove_featured_image' => __( 'Remove featured image', 'gogalapagos' ),
        'use_featured_image'    => __( 'Use as featured image', 'gogalapagos' ),
        'insert_into_item'      => __( 'Insert into Animal', 'gogalapagos' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Animal', 'gogalapagos' ),
        'items_list'            => __( 'Animals list', 'gogalapagos' ),
        'items_list_navigation' => __( 'Animals list navigation', 'gogalapagos' ),
        'filter_items_list'     => __( 'Filter Animals list', 'gogalapagos' ),
    );
    $rewrite = array(
        'slug'                  => 'animal',
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    );
    $args = array(
        'label'                 => __( 'Animal', 'gogalapagos' ),
        'description'           => __( 'Galapagos Animals', 'gogalapagos' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions' ),
        'taxonomies'            => array(''),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => false,
        'menu_position'         => 99,
        'menu_icon'             => URLPLUGINGOGALAPAGOS . 'images/admin-icon.png',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => 'galapagos-animals',
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rest_base'             => 'gganimal',
    );
    register_post_type( 'gganimal', $args );

}
add_action( 'init', 'gg_registerPostTypeForAnimals', 0 );

// Register Custom Post Type
function gg_packages() {

    $labels = array(
        'name'                  => _x( 'Go Packages', 'Post Type General Name', 'gogalapagos' ),
        'singular_name'         => _x( 'Go Package', 'Post Type Singular Name', 'gogalapagos' ),
        'menu_name'             => __( 'Go Packages', 'gogalapagos' ),
        'name_admin_bar'        => __( 'Go Packages', 'gogalapagos' ),
        'archives'              => __( 'Package Archives', 'gogalapagos' ),
        'attributes'            => __( 'Package Attributes', 'gogalapagos' ),
        'parent_item_colon'     => __( 'Parent Package:', 'gogalapagos' ),
        'all_items'             => __( 'All Packages', 'gogalapagos' ),
        'add_new_item'          => __( 'Add New Package', 'gogalapagos' ),
        'add_new'               => __( 'Add New', 'gogalapagos' ),
        'new_item'              => __( 'New Package', 'gogalapagos' ),
        'edit_item'             => __( 'Edit Package', 'gogalapagos' ),
        'update_item'           => __( 'Update Package', 'gogalapagos' ),
        'view_item'             => __( 'View Package', 'gogalapagos' ),
        'view_items'            => __( 'View Package', 'gogalapagos' ),
        'search_items'          => __( 'Search Package', 'gogalapagos' ),
        'not_found'             => __( 'Not found', 'gogalapagos' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'gogalapagos' ),
        'featured_image'        => __( 'Featured Image', 'gogalapagos' ),
        'set_featured_image'    => __( 'Set featured image', 'gogalapagos' ),
        'remove_featured_image' => __( 'Remove featured image', 'gogalapagos' ),
        'use_featured_image'    => __( 'Use as featured image', 'gogalapagos' ),
        'insert_into_item'      => __( 'Insert into Package', 'gogalapagos' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Package', 'gogalapagos' ),
        'items_list'            => __( 'Packages list', 'gogalapagos' ),
        'items_list_navigation' => __( 'Packages list navigation', 'gogalapagos' ),
        'filter_items_list'     => __( 'Filter Packages list', 'gogalapagos' ),
    );
    $rewrite = array(
        'slug'                  => 'gogalapagos_package',
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    );
    $args = array(
        'label'                 => __( 'Go Package', 'gogalapagos' ),
        'description'           => __( 'Galapagos Packages', 'gogalapagos' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'excerpt', 'author', 'thumbnail', 'revisions'),
        'taxonomies'            => array(''),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => false,
        'menu_position'         => 99,
        'menu_icon'             => URLPLUGINGOGALAPAGOS . 'images/admin-icon.png',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => 'gogalapagos_packages',
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rest_base'             => 'ggpacks',
    );
    register_post_type( 'ggpackage', $args );

}
add_action( 'init', 'gg_packages', 0 );


// Register Custom Post Type
function gg_tours() {

    $labels = array(
        'name'                  => _x( 'Tours', 'Post Type General Name', 'gogalapagos' ),
        'singular_name'         => _x( 'Tour', 'Post Type Singular Name', 'gogalapagos' ),
        'menu_name'             => __( 'Tours', 'gogalapagos' ),
        'name_admin_bar'        => __( 'Tours', 'gogalapagos' ),
        'archives'              => __( 'Tour Archives', 'gogalapagos' ),
        'attributes'            => __( 'Tour Attributes', 'gogalapagos' ),
        'parent_item_colon'     => __( 'Parent Tour:', 'gogalapagos' ),
        'all_items'             => __( 'All Tours', 'gogalapagos' ),
        'add_new_item'          => __( 'Add New Tour', 'gogalapagos' ),
        'add_new'               => __( 'Add New', 'gogalapagos' ),
        'new_item'              => __( 'New Tour', 'gogalapagos' ),
        'edit_item'             => __( 'Edit Tour', 'gogalapagos' ),
        'update_item'           => __( 'Update Tour', 'gogalapagos' ),
        'view_item'             => __( 'View Tour', 'gogalapagos' ),
        'view_items'            => __( 'View Tour', 'gogalapagos' ),
        'search_items'          => __( 'Search Tour', 'gogalapagos' ),
        'not_found'             => __( 'Not found', 'gogalapagos' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'gogalapagos' ),
        'featured_image'        => __( 'Featured Image', 'gogalapagos' ),
        'set_featured_image'    => __( 'Set featured image', 'gogalapagos' ),
        'remove_featured_image' => __( 'Remove featured image', 'gogalapagos' ),
        'use_featured_image'    => __( 'Use as featured image', 'gogalapagos' ),
        'insert_into_item'      => __( 'Insert into Tour', 'gogalapagos' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Tour', 'gogalapagos' ),
        'items_list'            => __( 'Tours list', 'gogalapagos' ),
        'items_list_navigation' => __( 'Tours list navigation', 'gogalapagos' ),
        'filter_items_list'     => __( 'Filter Tours list', 'gogalapagos' ),
    );
    $rewrite = array(
        'slug'                  => 'gogalapagos_tour',
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    );
    $args = array(
        'label'                 => __( 'Tours', 'gogalapagos' ),
        'description'           => __( 'Go Galapagos Tours', 'gogalapagos' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions' ),
        'taxonomies'            => array(''),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => false,
        'menu_position'         => 99,
        'menu_icon'             => URLPLUGINGOGALAPAGOS . 'images/admin-icon.png',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => 'gogalapagos_tours',
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rest_base'             => 'ggtours',
    );
    register_post_type( 'ggtour', $args );

}
add_action( 'init', 'gg_tours', 0 );

// Register Custom Post Type
function gg_testimonials() {

    $labels = array(
        'name'                  => _x( 'Testimonials', 'Post Type General Name', 'gogalapagos' ),
        'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', 'gogalapagos' ),
        'menu_name'             => __( 'Testimonials', 'gogalapagos' ),
        'name_admin_bar'        => __( 'Testimonials', 'gogalapagos' ),
        'archives'              => __( 'Testimonial Archives', 'gogalapagos' ),
        'attributes'            => __( 'Testimonial Attributes', 'gogalapagos' ),
        'parent_item_colon'     => __( 'Parent Testimonial:', 'gogalapagos' ),
        'all_items'             => __( 'All Testimonials', 'gogalapagos' ),
        'add_new_item'          => __( 'Add New Testimonial', 'gogalapagos' ),
        'add_new'               => __( 'Add New', 'gogalapagos' ),
        'new_item'              => __( 'New Testimonial', 'gogalapagos' ),
        'edit_item'             => __( 'Edit Testimonial', 'gogalapagos' ),
        'update_item'           => __( 'Update Testimonial', 'gogalapagos' ),
        'view_item'             => __( 'View Testimonial', 'gogalapagos' ),
        'view_items'            => __( 'View Testimonial', 'gogalapagos' ),
        'search_items'          => __( 'Search Testimonial', 'gogalapagos' ),
        'not_found'             => __( 'Not found', 'gogalapagos' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'gogalapagos' ),
        'featured_image'        => __( 'Featured Image', 'gogalapagos' ),
        'set_featured_image'    => __( 'Set featured image', 'gogalapagos' ),
        'remove_featured_image' => __( 'Remove featured image', 'gogalapagos' ),
        'use_featured_image'    => __( 'Use as featured image', 'gogalapagos' ),
        'insert_into_item'      => __( 'Insert into Testimonial', 'gogalapagos' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Testimonial', 'gogalapagos' ),
        'items_list'            => __( 'Testimonials list', 'gogalapagos' ),
        'items_list_navigation' => __( 'Testimonials list navigation', 'gogalapagos' ),
        'filter_items_list'     => __( 'Filter Testimonials list', 'gogalapagos' ),
    );
    $rewrite = array(
        'slug'                  => 'testimonial',
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    );
    $args = array(
        'label'                 => __( 'Testimonial', 'gogalapagos' ),
        'description'           => __( 'Galapagos Testimonials', 'gogalapagos' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'excerpt', 'author', ),
        'taxonomies'            => array(''),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => false,
        'menu_position'         => 99,
        'menu_icon'             => URLPLUGINGOGALAPAGOS . 'images/admin-icon.png',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => '',
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        //'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rest_base'             => 'ggtestimonials',
    );
    register_post_type( 'ggtestimonial', $args );

}
add_action( 'init', 'gg_testimonials', 0 );


// Register Custom Post Type
function gg_memberships() {

    $labels = array(
        'name'                  => _x( 'Memberships', 'Post Type General Name', 'gogalapagos' ),
        'singular_name'         => _x( 'Membership', 'Post Type Singular Name', 'gogalapagos' ),
        'menu_name'             => __( 'Memberships', 'gogalapagos' ),
        'name_admin_bar'        => __( 'Memberships', 'gogalapagos' ),
        'archives'              => __( 'Membership Archives', 'gogalapagos' ),
        'attributes'            => __( 'Membership Attributes', 'gogalapagos' ),
        'parent_item_colon'     => __( 'Parent Membership:', 'gogalapagos' ),
        'all_items'             => __( 'All Memberships', 'gogalapagos' ),
        'add_new_item'          => __( 'Add New Membership', 'gogalapagos' ),
        'add_new'               => __( 'Add New', 'gogalapagos' ),
        'new_item'              => __( 'New Membership', 'gogalapagos' ),
        'edit_item'             => __( 'Edit Membership', 'gogalapagos' ),
        'update_item'           => __( 'Update Membership', 'gogalapagos' ),
        'view_item'             => __( 'View Membership', 'gogalapagos' ),
        'view_items'            => __( 'View Membership', 'gogalapagos' ),
        'search_items'          => __( 'Search Membership', 'gogalapagos' ),
        'not_found'             => __( 'Not found', 'gogalapagos' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'gogalapagos' ),
        'featured_image'        => __( 'Featured Image', 'gogalapagos' ),
        'set_featured_image'    => __( 'Set featured image', 'gogalapagos' ),
        'remove_featured_image' => __( 'Remove featured image', 'gogalapagos' ),
        'use_featured_image'    => __( 'Use as featured image', 'gogalapagos' ),
        'insert_into_item'      => __( 'Insert into Membership', 'gogalapagos' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Membership', 'gogalapagos' ),
        'items_list'            => __( 'Memberships list', 'gogalapagos' ),
        'items_list_navigation' => __( 'Memberships list navigation', 'gogalapagos' ),
        'filter_items_list'     => __( 'Filter Memberships list', 'gogalapagos' ),
    );
    $rewrite = array(
        'slug'                  => 'membership',
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    );
    $args = array(
        'label'                 => __( 'Memberships', 'gogalapagos' ),
        'description'           => __( 'Galapagos Memberships', 'gogalapagos' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'excerpt', 'author', 'thumbnail',),
        'taxonomies'            => array(''),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => false,
        'menu_position'         => 99,
        'menu_icon'             => URLPLUGINGOGALAPAGOS . 'images/admin-icon.png',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => '',
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rest_base'             => 'ggmemberships',
    );
    register_post_type( 'ggmembership', $args );

}
add_action( 'init', 'gg_memberships', 0 );

// Register Custom Post Type
function gg_faqs() {

    $labels = array(
        'name'                  => _x( 'FAQs', 'Post Type General Name', 'gogalapagos' ),
        'singular_name'         => _x( 'FAQ', 'Post Type Singular Name', 'gogalapagos' ),
        'menu_name'             => __( 'FAQs', 'gogalapagos' ),
        'name_admin_bar'        => __( 'FAQs', 'gogalapagos' ),
        'archives'              => __( 'FAQ Archives', 'gogalapagos' ),
        'attributes'            => __( 'FAQ Attributes', 'gogalapagos' ),
        'parent_item_colon'     => __( 'Parent FAQ:', 'gogalapagos' ),
        'all_items'             => __( 'All FAQs', 'gogalapagos' ),
        'add_new_item'          => __( 'Add New FAQ', 'gogalapagos' ),
        'add_new'               => __( 'Add New', 'gogalapagos' ),
        'new_item'              => __( 'New FAQ', 'gogalapagos' ),
        'edit_item'             => __( 'Edit FAQ', 'gogalapagos' ),
        'update_item'           => __( 'Update FAQ', 'gogalapagos' ),
        'view_item'             => __( 'View FAQ', 'gogalapagos' ),
        'view_items'            => __( 'View FAQ', 'gogalapagos' ),
        'search_items'          => __( 'Search FAQ', 'gogalapagos' ),
        'not_found'             => __( 'Not found', 'gogalapagos' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'gogalapagos' ),
        'featured_image'        => __( 'Featured Image', 'gogalapagos' ),
        'set_featured_image'    => __( 'Set featured image', 'gogalapagos' ),
        'remove_featured_image' => __( 'Remove featured image', 'gogalapagos' ),
        'use_featured_image'    => __( 'Use as featured image', 'gogalapagos' ),
        'insert_into_item'      => __( 'Insert into FAQ', 'gogalapagos' ),
        'uploaded_to_this_item' => __( 'Uploaded to this FAQ', 'gogalapagos' ),
        'items_list'            => __( 'FAQs list', 'gogalapagos' ),
        'items_list_navigation' => __( 'FAQs list navigation', 'gogalapagos' ),
        'filter_items_list'     => __( 'Filter FAQs list', 'gogalapagos' ),
    );
    $rewrite = array(
        'slug'                  => 'general-faqs',
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    );
    $args = array(
        'label'                 => __( 'FAQs', 'gogalapagos' ),
        'description'           => __( 'Galapagos FAQs', 'gogalapagos' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'excerpt', 'author', 'thumbnail',),
        'taxonomies'            => array(''),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => false,
        'menu_position'         => 99,
        'menu_icon'             => URLPLUGINGOGALAPAGOS . 'images/admin-icon.png',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rest_base'             => 'ggfaqs',
    );
    register_post_type( 'ggfaqs', $args );

}
add_action( 'init', 'gg_faqs', 0 );

//} //Fin current user can

?>
