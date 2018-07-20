<?php

global $query, $pagenow;

function sync_from_eligos($pagenow) {
    
    //return false;

    // VALIDAR SI ESTA EN EL ADMINISTADOR DE WORDPRESS
    if(is_admin()){

        // VALIDAR SI LA VISTA ES LA GENERAL Y ADEMAS SI ES LA DEL POST_TYPE => ggcabins
        if($pagenow == 'edit.php' && $_GET['post_type'] == 'ggcabins'){

            // OBTENER EL ARREGLO DEL LA URL DE MIKY
            $json = file_get_contents('http://gogalapagos.sistemaskt.com/getjson/?token=rogbV19gAJo33sS9RVdb_xyn_6bCkUWR');
            $json = json_decode($json);

            // RECORRER EL ARREGLO PARA RECUPERAR LOS VALORES
            // PARA ACTUALIZAR LOS METADATOS DEL POST_TYPE => ggcabins
            //update_post_meta( int $post_id, string $meta_key, mixed $meta_value, mixed $prev_value = '' );

            // SI VIENE UNA CABINA NUEVA
            // PUBLICAR EN DRAFT post_status = 'draft'

//            $contenido_cabina = array(
//                'post_content' => '',
//                'post_title' => 'UNA CABINA NUEVA',
//                'post_status' => 'draft',
//                'post_type' => 'ggcabins',
//                'meta_input'
//            );
//
//            wp_insert_post( $contenido_cabina );

//            echo '<pre>';
//            var_dump($query->query_vars);
//            echo '</pre>';
//            die();
        }  
    }
}
add_action('pre_get_posts','sync_from_eligos');

function sync_btn($pagenow){
    if($pagenow == 'edit.php' && $_GET['post_type'] == 'ggcabins'){
?>
<style>
    a{
        color: red !importnat;
    }
</style>
<?php
    }
}
add_action('admin_head','sync_btn');
?>