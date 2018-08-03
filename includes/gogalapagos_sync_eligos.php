<?php

function sync_from_eligos() {
    
    global $pagenow;
    $prefix = 'gg_';
    $post_tipo = 'ggcabins';

    // VALIDAR SI ESTA EN EL ADMINISTADOR DE WORDPRESS
    if(is_admin()){         
        // VALIDAR SI LA VISTA ES LA GENERAL Y ADEMAS SI ES LA DEL POST_TYPE => ggcabins
        if($pagenow == 'edit.php' && $_GET['post_type'] == $post_tipo && $_GET['eligos'] == 'true'){
            
            remove_action( 'pre_get_posts', __FUNCTION__ ); 
            
            $user = wp_get_current_user();

            // OBTENER EL ARREGLO DEL LA URL DE MIKY
            $json = file_get_contents('http://10.100.1.113/eligos/api/web/v1/cabina');
            $json = json_decode($json);

            // RECORRER EL ARREGLO PARA RECUPERAR LOS VALORES
            // PARA ACTUALIZAR LOS METADATOS DEL POST_TYPE => ggcabins
            
//            echo '<pre>';
//            var_dump($json);
//            echo '</pre>';
//            die();
            
            foreach($json as $element){
                
                $args = array(
                    'post_type' => $post_tipo,
                    'post_status' => 'publish',
                    'posts_per_page' -1,
                    'meta_query' => array(
                        'relation' => 'AND',
                        array(
                            'key' => $prefix . 'cabin_year_id',
                            'value' => $element->anio_id
                        ),
                        array(
                            'key' => $prefix . 'cabin_year',
                            'value' => $element->anio
                        ),
                        array(
                            'key' => $prefix . 'dispo_ID',
                            'value' => $element->codigo
                        ),
                        array(
                            'key' => $prefix . 'cabin_eligos_ship_code',
                            'value' => $element->barco_id
                        ),
                    )
                );
                $cabinas = get_posts($args);
                if ($cabinas){
                    foreach ($cabinas as $cabina){
                        // HACER EL UPDATE DE LOS METDATOS
                        update_post_meta($cabina->ID, $prefix . 'cabin_eligos_ship_code', $element->barco_id );
                        update_post_meta($cabina->ID, $prefix . 'cabin_eligos_id', $element->id );
                        //update_post_meta($cabina->ID, $prefix . 'cabin_year', $element->id);
                    }
                }else{
                    // CREAR EL ELEMENTO EN LA BD CON LOS METAS CARGADOS
                    //echo 'Cargando nueva cabina';
                    // SI VIENE UNA CABINA NUEVA
                    // PUBLICAR EN DRAFT post_status = 'draft'

                    $contenido_cabina = array(
                        'post_content' => '',
                        'post_title' => $element->nombre,
                        'post_status' => 'draft',
                        'post_type' => 'ggcabins',
                        'meta_input' => array(
                            $prefix . 'cabin_eligos_id' => $element->id,
                            $prefix . 'cabin_year_id' => $element->anio_id,
                            $prefix . 'cabin_year' => $element->anio,
                            $prefix . 'dispo_ID' => $element->codigo,
                            $prefix . 'cabin_eligos_code' => $element->codigo,
                            $prefix . 'cabin_eligos_ship_code' => $element->barco_id,
                            $prefix . 'cabin_category_color' => $element->color,
                        )
                    );

                    wp_insert_post( $contenido_cabina );
                }
            }
        }  
    }
}
add_action('pre_get_posts','sync_from_eligos');

function sync_btn($user){

    global $pagenow;
    // VALIDAR SI ESTA EN EL ADMINISTADOR DE WORDPRESS
    if(is_admin()){
        if($pagenow == 'edit.php' && $_GET['post_type'] == 'ggcabins'){
            $user = wp_get_current_user();
            // OBTENER CAMPO ELIGOS
            $eligos_token = get_user_meta( $user->ID, 'token', true);
            if ($user->allcaps['remove_users'] == true && $eligos_token){
                
?>
<script>
    $(document).ready( function(){
        console.log('Eligos is ready');
        var eligos_btn = '<a id="eligos-btn" href="' + window.location + '&eligos=true" class="page-title-action"><i class="fa fa-refresh"></i> Sync ELIGOS</a>';
        $(eligos_btn).insertAfter('.wp-heading-inline');
        
    })
</script>
<?php
            }
        }
    }
}
add_action('in_admin_footer','sync_btn');
?>