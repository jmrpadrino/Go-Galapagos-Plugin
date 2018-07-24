<?php

function gogalapagos_clone_cabin_content() {
    
    $cabina_origen = $_POST['cabina_origen'];
    $cabina_destino = $_POST['cabina_destino'];
    $origen = get_post($cabina_origen);
    
    
    var_dump($origen);
    
    
    $my_post = array(
        'ID'           => $cabina_destino,
        //'post_title' => 'This is the updated title.',
        'post_content' => 'This is the updated content.',
        'post_excerpt' => 'This is the updated excerpt.',
    );

    wp_update_post( $my_post );
    
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
                }
            });
        }
    })
</script>
<?php
}
add_action('in_admin_footer','gogalapagosAjaxCloneCabinContent');
?>