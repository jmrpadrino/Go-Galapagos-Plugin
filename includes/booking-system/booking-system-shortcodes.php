<?php
    // CREAR EL SHORTCODE PARA INYECTAR LAS FUNCIONES DEL COTIZADOR
    add_shortcode('gogabooking', 'goga_shortcode_main_function');
    add_shortcode('gogacruise-filters', 'goga_shortcode_filters');
    add_shortcode('gogacruise-accommodation', 'goga_shortcode_accommodation');
    add_shortcode('gogaland-services', 'goga_shortcode_land_services');
    add_shortcode('gogabooking-travelers-details', 'goga_shortcode_travelers_details');
    add_shortcode('gogabooking-order-details', 'goga_shortcode_order_details');
    add_shortcode('gogabooking-checkout', 'goga_shortcode_checkout');

    // CODIGO EJECUTABLE DESDE SHORTCODE gogabooking
    function goga_shortcode_main_function(){
        if(!$_GET){
            echo 'mostrar fechas a partir del mes actual hasta 2 meses';
        }else{
            print_r($_GET);
        }
    }

    // CODIGO EJECUTABLE DESDE SHORTCODE gogabooking
    function goga_shortcode_filters(){
        include '/views/booking-filters.php';
    }