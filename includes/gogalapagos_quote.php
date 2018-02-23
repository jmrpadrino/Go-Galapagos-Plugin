<?php
// AGREGAR LAS FUNCIONES ADICIONALES
require_once('booking-system/booking-system-create-pages.php');
require_once('booking-system/booking-system-add-content-to-pages.php');
require_once('booking-system/booking-system-shortcodes.php');

add_action('wp_enqueue_scripts', 'gg_quote_style_and_scripts', 11);
function gg_quote_style_and_scripts(){
    wp_enqueue_style( 'gogalapagos-booking',  URLPLUGINGOGALAPAGOS .'css/gogalapagos-booking.css', array(), $ver, 'screen' );
    wp_register_script( 'goga_ajax_booking', URLPLUGINGOGALAPAGOS .'/js/gogalapagos-booking.js', array ( 'jquery' ), $ver, true);
    wp_enqueue_script( 'goga_ajax_booking', URLPLUGINGOGALAPAGOS .'js/gogalapagos-booking.js', array ( 'jquery' ), $ver, true);
    wp_localize_script( 'goga_ajax', 'goga_booking', array( 'booking_plugin_url' => URLPLUGINGOGALAPAGOS ));
}

//add_action('admin_enqueue_scripts', 'gg_quote_style_and_scripts', 11);