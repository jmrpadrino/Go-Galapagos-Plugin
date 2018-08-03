<?php

function gogalapagos_clone_cabin_content() {
    
    $prefix = 'gg_';
    
    $cabina_origen = $_POST['cabina_origen'];
    $cabina_destino = $_POST['cabina_destino'];
    $destino = get_post($cabina_destino);
    $origen = get_post($cabina_origen);
    $metas_origen = get_post_meta($origen->ID);
    $metas_destino = get_post_meta($destino->ID);
    
    echo get_post_meta($cabina_origen, $prefix . 'cabin_decks_location');
    
    
    //var_dump($metas_origen);
    //var_dump($metas_destino);
    
    update_post_meta($cabina_destino, $prefix . 'cabin_featurelist', get_post_meta($cabina_origen, $prefix . 'cabin_featurelist', true));
    update_post_meta($cabina_destino, $prefix . 'cabin_ship_id', get_post_meta($cabina_origen, $prefix . 'cabin_ship_id', true));
    update_post_meta($cabina_destino, $prefix . 'cabin_category_color', get_post_meta($cabina_origen, $prefix . 'cabin_category_color', false));
    update_post_meta($cabina_destino, $prefix . 'cabin_deck_location', get_post_meta($cabina_origen, $prefix . 'cabin_decks_location'));
    update_post_meta($cabina_destino, $prefix . 'cabin_deck_location_image', get_post_meta($cabina_origen, $prefix . 'cabin_deck_location_image', true));
    update_post_meta($cabina_destino, $prefix . 'cabin_quote_system_alias', $metas_origen[$prefix . 'cabin_quote_system_alias'][0]);
    update_post_meta($cabina_destino, $prefix . 'cabin_render', get_post_meta($cabina_origen, $prefix . 'cabin_render', true));
    update_post_meta($cabina_destino, '_thumbnail_id', get_post_meta($cabina_origen, '_thumbnail_id', true));
    
    //var_dump($metas_destino);
    
    die();
}
add_action('wp_ajax_gogalapagos_clone_cabin_content','gogalapagos_clone_cabin_content');

function gogalapagosAjaxCloneCabinContent(){
?>
<script>
    $('.clone-this-cabin').change( function(){
        var cambiar = confirm('Are you sure you want to clone the information of this cabin in the current cabin?');
        var cabina_destino = $(this).attr('id');
        var cabina_origen = $(this).val();
        console.log(cambiar);
        if(cambiar){
            console.log(cabina_destino, cabina_origen);
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: {
                    action: 'gogalapagos_clone_cabin_content',
                    cabina_destino : cabina_destino,
                    cabina_origen : cabina_origen
                },
                beforeSend: function(){

                },
                error: function(response){
                    alert('Something happened, try later. Code: ' + response);
                },
                success: function(response){
                    console.log(response);
                    alert('Cabin successfully cloned!');
                    window.location.reload();
                }
            });
        }
    })
</script>
<?php
}
add_action('in_admin_footer','gogalapagosAjaxCloneCabinContent');
?>