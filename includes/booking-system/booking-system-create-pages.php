<?php

// VALIDAR SI LA PAGINA DEL COTIZADOR ESTA CREADA SINO CREARLA
add_action( 'plugins_loaded', 'gg_create_quote_pages' );
function gg_create_quote_pages() {
    
    //obtener la página por SLUG si no existe crearla
    $quote_page = get_page_by_path('booking');
    if (!$quote_page){
        // Create post object
        $my_post = array(
            'post_title'    => 'Go Galapagos Booking Filters',
            'post_name'     => 'booking',
            'post_content'  => '[gogabooking]',
            'post_status'   => 'publish',
            'post_author'   => get_current_user_id(),
            'post_type'     => 'page',
        );

        // Insert the post into the database
        wp_insert_post( $my_post, '' );
    }
    
    //obtener la página por SLUG si no existe crearla
    $quote_page = get_page_by_path('find-cruise');
    if (!$quote_page){
        // Create post object
        $my_post = array(
            'post_title'    => 'Go Galapagos Booking Filters',
            'post_name'     => 'find-cruise',
            'post_content'  => '[gogacruise-filters]',
            'post_status'   => 'publish',
            'post_author'   => get_current_user_id(),
            'post_type'     => 'page',
        );

        // Insert the post into the database
        wp_insert_post( $my_post, '' );
    }
    $quote_page = get_page_by_path('cabin-accommodation');
    if (!$quote_page){
        // Create post object
        $my_post = array(
            'post_title'    => 'Go Galapagos Booking Accommodarion',
            'post_name'     => 'cabin-accommodation',
            'post_content'  => '[gogacruise-accommodation]',
            'post_status'   => 'publish',
            'post_author'   => get_current_user_id(),
            'post_type'     => 'page',
        );

        // Insert the post into the database
        wp_insert_post( $my_post, '' );
    }
    $quote_page = get_page_by_path('add-land-service');
    if (!$quote_page){
        // Create post object
        $my_post = array(
            'post_title'    => 'Go Galapagos Booking Land Services',
            'post_name'     => 'add-land-service',
            'post_content'  => '[gogaland-services]',
            'post_status'   => 'publish',
            'post_author'   => get_current_user_id(),
            'post_type'     => 'page',
        );

        // Insert the post into the database
        wp_insert_post( $my_post, '' );
    }
    $quote_page = get_page_by_path('traveler-details');
    if (!$quote_page){
        // Create post object
        $my_post = array(
            'post_title'    => 'Go Galapagos Booking Travelers Details',
            'post_name'     => 'traveler-details',
            'post_content'  => '[gogabooking-travelers-details]',
            'post_status'   => 'publish',
            'post_author'   => get_current_user_id(),
            'post_type'     => 'page',
        );

        // Insert the post into the database
        wp_insert_post( $my_post, '' );
    }
    $quote_page = get_page_by_path('order-details');
    if (!$quote_page){
        // Create post object
        $my_post = array(
            'post_title'    => 'Go Galapagos Booking Order Details',
            'post_name'     => 'order-details',
            'post_content'  => '[gogabooking-order-details]',
            'post_status'   => 'publish',
            'post_author'   => get_current_user_id(),
            'post_type'     => 'page',
        );

        // Insert the post into the database
        wp_insert_post( $my_post, '' );
    }
    $quote_page = get_page_by_path('checkout');
    if (!$quote_page){
        // Create post object
        $my_post = array(
            'post_title'    => 'Go Galapagos Booking Checkout & Payment',
            'post_name'     => 'checkout',
            'post_content'  => '[gogabooking-checkout]',
            'post_status'   => 'publish',
            'post_author'   => get_current_user_id(),
            'post_type'     => 'page',
        );

        // Insert the post into the database
        wp_insert_post( $my_post, '' );
    }

}