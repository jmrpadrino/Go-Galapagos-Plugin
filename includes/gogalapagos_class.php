<?php
class Gogalapagos{
    
    // Constructor
    public function __construct()
    {
        $appName = 'Gogalapagos Main WordPress Plugin';
    }
    
    public function mostrarArreglo($array){
        echo '<pre>';
        var_dump($array);
        echo '</pre>';
    }
    
    public function listarPosttype($posttypeName){
        
        $args = array(
            'post_type' => $posttypeName,
            'posts_per_page' => -1
        );
        $elementos = get_posts($args);
        if($elementos){
            echo '<ul>';
            foreach ($elementos as $elemento){
                echo '<li>' . $elemento->post_title . '</li>';
            }
            echo '</ul>';
        }else{
            echo 'No hay elementos o no existe el Post Type';
        }
    }
    
    public function listarPosttypePorMetabox($posttypeName, $metaField, $metaValue){
        $args = array(
            'post_type' => $posttypeName,
            'posts_per_page' => -1,
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => $metaField,
                    'value' => $metaValue
                )
            )
        );
        $elementos = get_posts($args);
        if($elementos){
            echo '<ul>';
            foreach ($elementos as $elemento){
                echo '<li>' . $elemento->post_title . '</li>';
            }
            echo '</ul>';
        }else{
            echo 'No hay elementos para listar';
        }
        
    }
    
}
?>