<?php
/**
*   Documento para crear los elementos extras del soporte de Go Galapagos
*   Ver 0.1
*
*/

// Incluir librerias
//require 'sendgrid-php/vendor/autoload.php';
//require("sendgrid-php/vendor/autoload.php");

// definir la zona horaria
date_default_timezone_set ( 'America/Bogota' );


global $pagenow, $typenow, $mensaje;
$prefix = 'gg_';

function gogalapagos_set_users_roles(){
    // Add a custom user role for Go Galapagos Marketing
    /*$results = add_role( 'ggmarketing', __('Go Galapagos Merketing', 'gogalalagos'), array( 
        //Capabilities
    ) );*/

    // Add a custom user role for Go Galapagos Ventas
    /*$results = add_role( 'ggmanagement', __('Go Galapagos Management', 'gogalalagos'), array( 
        //Capabilities
    ) );*/
    //$results = remove_role( 'ggventas' );

    // Add a custom user role for Go Galapagos Ventas
    $results = add_role( 'pasantias', __('Go Galapagos Pasantes', 'gogalalagos') );

    $usuariosVentas = get_role('pasantias');

    $usuariosVentas->add_cap('read');
    $usuariosVentas->add_cap('read_posts');
    $usuariosVentas->add_cap('edit_posts');    
    $usuariosVentas->remove_cap('publish_posts');
    $usuariosVentas->add_cap('edit_published_posts');
    $usuariosVentas->add_cap('edit_others_posts');
    $usuariosVentas->add_cap('edit_private_posts');
    $usuariosVentas->add_cap('upload_files');
    $usuariosVentas->remove_cap('manage_links');
    //$usuariosVentas->add_cap('edit_others_posts');
    /*--------------*/
    //$usuariosVentas->remove_cap('read_private_posts');
    //$usuariosVentas->remove_cap('edit_others_posts');
    $usuariosVentas->remove_cap('manage_categories');
    $usuariosVentas->remove_cap('manage_options');
    $usuariosVentas->remove_cap('level_0');
    $usuariosVentas->remove_cap('level_1');
    $usuariosVentas->remove_cap('level_2');
    $usuariosVentas->remove_cap('level_3');
    $usuariosVentas->remove_cap('level_4');
    $usuariosVentas->remove_cap('level_5');
    $usuariosVentas->remove_cap('level_6');
    $usuariosVentas->remove_cap('level_7');
    $usuariosVentas->remove_cap('level_8');
    $usuariosVentas->remove_cap('level_9');
    $usuariosVentas->remove_cap('level_10');

    //$usuariosVentas->remove_cap('edit_others_ggships');
    /*$usuariosVentas->remove_cap('create_post');
$usuariosVentas->remove_cap('delete_post');
$usuariosVentas->remove_cap('publish_post');*/

    flush_rewrite_rules();
    //remove_role("adinistrator");
    /*
        array( 
            //'read' => true, // true allows this capability
            //'edit_posts' => true, // Allows user to edit their own posts
            //'edit_pages' => true, // Allows user to edit pages
            /*
            'edit_others_posts' => false, // Allows user to edit others posts not just their own
            'create_posts' => true, // Allows user to create new posts
            'manage_categories' => true, // Allows user to manage post categories
            'publish_posts' => true, // Allows the user to publish, otherwise posts stays in draft mode
            'manage_options' => true,
            'edit_themes' => false, // false denies this capability. User can’t edit your theme
            'install_plugins' => false, // User cant add new plugins
            'update_plugin' => false, // User can’t update any plugins
            'update_core' => false, // user cant perform core updates

            'level_0' => true,
            'level_1' => true,
            'level_2' => true,
            'level_3' => true,
            'level_4' => true,
            'level_5' => true,
            'level_6' => true,
            'level_7' => true,
            'level_8' => true,
            'level_9' => true,
            'level_10' => true,
        )
    */
}
add_action( 'admin_init', 'gogalapagos_set_users_roles' );

// Remove some header garbage

show_admin_bar(false);
remove_action( 'wp_head', 'rsd_link');
remove_action( 'wp_head', 'wlwmanifest_link');
remove_action( 'wp_head', 'wp_shortlink_wp_head');
remove_action( 'wp_head', 'wp_generator');
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 ); 
function remove_header_wordpress_garbage() {

    // all actions related to emojis
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

    // filter to remove TinyMCE emojis
    //add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_action( 'init', 'remove_header_wordpress_garbage' );

// Add Shortcode for brochure
function show_brochure_box( $attributos ) {

    extract( shortcode_atts( array(
        'text' => _x('Go Galapagos Brochure','gogalapagos'),
        'url' => '#'
    ), $attributos ) );

    $markup  = '<div class="ggbrochure">';
    $markup .= '<div class="ggbrochure-mask"></div>';
    $markup .= '<div class="icon-img"><i class="fa fa-map-o brochure-icon" aria-hidden="true"></i>';
    //$markup .= '<img src="http://placehold.it/120x120?text=Icon" alt="Go Galapagos Brochure Icon">';
    $markup .= '</div>';
    $markup .= '<div class="text-and-button-brochure">';
    $markup .= '<h3 class="download-brochure-text">' . esc_attr( $text ). '</h3>';
    $markup .= '<a class="hero-book-now-btn btn btn-warning download-brochure-btn" href="' . esc_attr( $url ) . '" title="Download Go Galapagos Brochure" target="_blank">' . _x('Download Now','gogalapagos') . '</a>';
    $markup .= '</div>';
    $markup .= '</div>';

    return $markup;
}
add_shortcode( 'gogabrochure', 'show_brochure_box' );

// Sidebar widgets
register_sidebar( array(
    'name'          => __( 'Multi Idioma', 'gogalapagos' ),
    'id'            => 'translation',
    'description'   => __( 'Uso exclusivo del qTranslate-x', 'gogalapagos' ),
    'before_widget' => '<div class="qtranxs_widget">',
    'after_widget'  => '</div>',
    'before_title'  => '',
    'after_title'   => '',
) );
register_sidebar( array(
    'name'          => __( 'Suscribe', 'gogalapagos' ),
    'id'            => 'suscribe',
    'description'   => __( 'Uso exclusivo de Constant Contact', 'gogalapagos' ),
    'before_widget' => '<div class="cc_widget">',
    'after_widget'  => '</div>',
    'before_title'  => '',
    'after_title'   => '',
) );

// Add admin menu page for Go Galapagos Dashboard
function gg_admin_dashboard(){
?>
<h1>Go Galapagos Dashboard</h1>
<p><?php echo URLPLUGINGOGALAPAGOS; ?></p>
<?php 
    if( is_user_logged_in() ) {
            $user = wp_get_current_user();
            $role = ( array ) $user->roles;            
            echo '<pre>';
            print_r($role);
            echo '</pre>';
        } else {
            return false;
        }
    $usuariosVentas = get_role('pasantias');
    echo '<pre>';
    print_r($usuariosVentas);
    echo '</pre>';
}
/**
 * Register a custom menu page.
 */

function gogalapagos_admin_menu() {
    if( is_user_logged_in() ) {
        $user = wp_get_current_user();
        $role = ( array ) $user->roles;            

    } else {
        return false;
    }
    // Go Galapagos main menu
    add_menu_page(
        __( 'Go Galapagos Dashboard', 'gogalapagos' ),
        'Go Galapagos',
        //'publish_pages',
        //'manage_options',
        'upload_files',
        'go-galapagos-dashboard',
        'gg_admin_dashboard',
        URLPLUGINGOGALAPAGOS . '/images/admin-icon.png',
        99
    );

    // Go Galapagos child pages
    add_submenu_page( 'go-galapagos-dashboard', __( 'Ships', 'gogalapagos' ), __( 'Ships', 'gogalapagos' ), 'manage_options', 'edit.php?post_type=ggships');
    add_submenu_page( 'go-galapagos-dashboard', __( 'Decks', 'gogalapagos' ), __( 'Decks', 'gogalapagos' ), 'manage_options', 'edit.php?post_type=ggdecks');
    add_submenu_page( 'go-galapagos-dashboard', __( 'Cabins', 'gogalapagos' ), __( 'Cabins', 'gogalapagos' ), 'manage_options', 'edit.php?post_type=ggcabins');
    add_submenu_page( 'go-galapagos-dashboard', __( 'Social Areas', 'gogalapagos' ), __( 'Social Areas', 'gogalapagos' ), 'upload_files', 'edit.php?post_type=ggsocialarea');
    add_submenu_page( 'go-galapagos-dashboard', __( 'Islands', 'gogalapagos' ), __( 'Islands', 'gogalapagos' ), 'manage_options', 'edit.php?post_type=ggisland');
    add_submenu_page( 'go-galapagos-dashboard', __( 'Animals', 'gogalapagos' ), __( 'Animals', 'gogalapagos' ), 'upload_files', 'edit.php?post_type=gganimal');
    add_submenu_page( 'go-galapagos-dashboard', '<i class="dashicons dashicons-controls-play"></i>' . __( 'Animal Groups', 'gogalapagos' ), __( 'Animal Groups', 'gogalapagos' ), 'manage_options', 'edit-tags.php?taxonomy=animalgroup');
    add_submenu_page( 'go-galapagos-dashboard', __( 'Visitor\'s Sites', 'gogalapagos' ), __( 'Visitor\'s Sites', 'gogalapagos' ), 'upload_files', 'edit.php?post_type=gglocation');
    add_submenu_page( 'go-galapagos-dashboard', __( 'Activities', 'gogalapagos' ), __( 'Activities', 'gogalapagos' ), 'upload_files', 'edit.php?post_type=ggactivity');
    add_submenu_page( 'go-galapagos-dashboard', __( 'Special Interest', 'gogalapagos' ), __( 'Special Interest', 'gogalapagos' ), 'upload_files', 'edit.php?post_type=ggspecialinterest');
    add_submenu_page( 'go-galapagos-dashboard', __( 'Itineraries', 'gogalapagos' ), __( 'Itineraries', 'gogalapagos' ), 'manage_options', 'edit.php?post_type=ggitineraries');
    add_submenu_page( 'go-galapagos-dashboard', '<i class="dashicons dashicons-controls-play"></i>' . __( 'Go Packages', 'gogalapagos' ), __( 'Go Packages', 'gogalapagos' ), 'manage_options', 'edit.php?post_type=ggpackage');
    add_submenu_page( 'go-galapagos-dashboard', '<i class="dashicons dashicons-controls-play"></i>' . __( 'Go Tours', 'gogalapagos' ), __( 'Go Tours', 'gogalapagos' ), 'manage_options', 'edit.php?post_type=ggtour');
    add_submenu_page( 'go-galapagos-dashboard', '<i class="dashicons dashicons-controls-play"></i>' . __( 'Testimonials', 'gogalapagos' ), __( 'Testimonials', 'gogalapagos' ), 'upload_files', 'edit.php?post_type=ggtestimonial');
    add_submenu_page( 'go-galapagos-dashboard', '<i class="dashicons dashicons-controls-play"></i>' . __( 'Memberships', 'gogalapagos' ), __( 'Memberships', 'gogalapagos' ), 'upload_files', 'edit.php?post_type=ggmembership');
}
add_action( 'admin_menu', 'gogalapagos_admin_menu' );
// A callback function to add a custom field to our "presenters" taxonomy  
function presenters_taxonomy_custom_fields($tag) {  
    // Check for existing taxonomy meta for the term you're editing  
    $t_id = $tag->term_id; // Get the ID of the term you're editing  
    $term_meta = get_option( "taxonomy_term_$t_id" ); // Do the check  
?>  
<tr class="form-field">  
    <th scope="row" valign="top">  
        <label for="presenter_id"><?php _e('WordPress User ID'); ?></label>  
    </th>  
    <td>  
        <input type="text" name="term_meta[presenter_id]" id="term_meta[presenter_id]" size="25" style="width:60%;" value="<?php echo $term_meta['presenter_id'] ? $term_meta['presenter_id'] : ''; ?>"><br />  
        <span class="description"><?php _e('The Presenter\'s WordPress User ID'); ?></span>  
    </td>  
</tr>  
<?php  
} 
// Add the fields to the "presenters" taxonomy, using our callback function  
add_action( 'presenters_edit_form_fields', 'presenters_taxonomy_custom_fields', 10, 2 );
// Add Custom Column Go Galapagos Post Types
// GET SHIP, DECKS AND GALLERY IMAGES FROM CABINS
function gg_get_featured_image($post_ID) {
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);
    if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'featured_preview');
        return $post_thumbnail_img[0];
    }
}
function gg_columns_head($defaults) {
    if ( $_GET['post_type'] == 'ggcabins' ){
        $defaults['dispo_code'] = '<i class="fa fa-ship" aria-hidden="true"></i> Dispo Code';
        $defaults['cabin_ship'] = '<i class="fa fa-ship" aria-hidden="true"></i> Cabin Ship';
        $defaults['cabin_deck'] = '<i class="fa fa-thumb-tack" aria-hidden="true"></i> Cabin Deck';
        $defaults['cabin_gallery'] = '<i class="fa fa-picture-o" aria-hidden="true"></i> Cabin Gallery';
        $defaults['cabin_category_color'] = '<i class="fa fa-tint" aria-hidden="true"></i> Color';
    }
    if ( $_GET['post_type'] == 'ggdecks' ){
        $defaults['deck_ship'] = '<i class="fa fa-ship" aria-hidden="true"></i> Deck Ship';
        $defaults['deck_gallery'] = '<i class="fa fa-picture-o" aria-hidden="true"></i> Deck Gallery';
    }
    if ( $_GET['post_type'] == 'ggships' ){
        $defaults['dispo_code'] = '<i class="fa fa-ship" aria-hidden="true"></i> Dispo Code';
    }
    if ( $_GET['post_type'] == 'ggsocialarea' ){
        $defaults['ship_parent'] = '<i class="fa fa-ship" aria-hidden="true"></i> Ship Parent';
    }
    return $defaults;
}
function gg_columns_content($column_name, $post_ID) {
    $prefix = 'gg_';
    // Columnas para Barcos
    if ($column_name == 'dispo_code') {
        $ship_dispo_code = get_post_meta( $post_ID, $prefix . 'dispo_ID', TRUE ); // Devuelve Array
        if ( empty ( $ship_dispo_code ) ){
            echo '<span style="color: #ff8000; font-weight: bold;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> ' . __('Please set the Dispo Code of this Ship', 'gogalapagos') . '</span>';
        }else{
            echo esc_html($ship_dispo_code);
        }
    }
    // Columnas para Decks
    if ($column_name == 'deck_ship') {
        $deck_ship = get_post_meta( $post_ID, $prefix . 'deck_ship_id', FALSE ); // Devuelve Array
        if ( empty ( $deck_ship ) ){
            echo '<span style="color: #ff8000; font-weight: bold;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> ' . __('This Deck has not be asigned to any Ship', 'gogalapagos') . '</span>';
        }else{
            echo get_the_title( $deck_ship );
        }
    }
    if ($column_name == 'deck_gallery') {
        $deck_pictures = get_post_meta( $post_ID, $prefix . 'deck_gallery', FALSE ); // Devuelve Array
        if ( empty ( $deck_pictures ) ){
            echo '<span style="color: #ff8000; font-weight: bold;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> ' . __('There is not gallery on this Deck', 'gogalapagos') . '</span>';
        }else{
            $i = 0;
            foreach ($deck_pictures as $deck_picture){
                if( $i <= 2 ){
                    echo '<img src="'.wp_get_attachment_url( $deck_picture ).'" style="width: 50px; margin-right: 10px;">';
                }
                if ( $i > 2 ){
                    $quedan = count( $deck_pictures ) - 3;
                    echo '<span style="font-size: 18px; font-weigth: bold; color: #f1f1f1; display: inline-block; padding: 5px; background: #70af70; border-radius: 3px;"><i class="fa fa-plus"></i> ' . $quedan . '</span>';
                }
                $i++;
            }
        }
    }
    // Columnas para Cabinas
    if ($column_name == 'cabin_category_color') {
        $cabin_color = get_post_meta( $post_ID, $prefix . 'cabin_category_color', true ); // Devuelve Array
        if ( empty ( $cabin_color ) ){
            echo '<span style="color: #ff8000; font-weight: bold;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> ' . __('This Cabin has not color asigned', 'gogalapagos') . '</span>';
        }else{
            echo '<span class="category-color-admin-column" style="background:'.$cabin_color.';" title="Use this color '.$cabin_color.'">'.$cabin_color.'</span>';
        }
    }
    if ($column_name == 'cabin_ship') {
        $cabin_ship = get_post_meta( $post_ID, $prefix . 'cabin_ship_id', TRUE ); // Devuelve Array
        if ( empty ( $cabin_ship ) ){
            echo '<span style="color: #ff8000; font-weight: bold;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> ' . __('This Cabin has not be asigned to any Ship', 'gogalapagos') . '</span>';
        }else{
            echo get_the_title( $cabin_ship );
        }
    }
    if ($column_name == 'cabin_deck') {
        $cabin_decks = get_post_meta( $post_ID, $prefix . 'cabin_decks_location', FALSE ); // Devuelve Array
        if ( empty( $cabin_decks ) ){
            echo '<span style="color: #ff8000; font-weight: bold;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> ' . __('This Cabin has not be asigned to any Deck or Decks', 'gogalapagos') . '</span>';
        }else{
            echo '<ul style="list-style: square;">';
            foreach ($cabin_decks as $cabin_deck){
                switch ($cabin_deck){
                    case 1:
                        echo '<li>Sea</li>';
                        break;
                    case 2:
                        echo '<li>Earth</li>';
                        break;
                    case 3:
                        echo '<li>Sky</li>';
                        break;
                    case 4:
                        echo '<li>Moon</li>';
                        break;
                }
            }
            echo '</ul>';

        }
    }
    if ($column_name == 'cabin_gallery') {
        $cabin_pictures = get_post_meta( $post_ID, $prefix . 'cabin_gallery', FALSE ); // Devuelve Array
        if ( empty ( $cabin_pictures ) ){
            echo '<span style="color: #ff8000; font-weight: bold;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> ' . __('There is not gallery on this Cabin', 'gogalapagos') . '</span>';
        }else{
            $i = 0;
            foreach ($cabin_pictures as $cabin_picture){
                if( $i <= 2 ){
                    echo '<img src="'.wp_get_attachment_url( $cabin_picture ).'" style="width: 50px; margin-right: 10px;">';
                }
                if ( $i > 2 ){
                    $quedan = count( $cabin_pictures ) - 3;
                    echo '<span style="font-size: 18px; font-weigth: bold; color: #f1f1f1; display: inline-block; padding: 5px; background: #70af70; border-radius: 3px;"><i class="fa fa-plus"></i> ' . $quedan . '</span>';
                }
                $i++;
            }
        }
    }
    // Columnas para Areas Siciales
    if ($column_name == 'ship_parent') {
        $deck_ship = get_post_meta( $post_ID, $prefix . 'social_ship_id', TRUE ); // Devuelve Array
        if ( empty ( $deck_ship ) ){
            echo '<span style="color: #ff8000; font-weight: bold;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> ' . __('This Deck has not be asigned to any Ship', 'gogalapagos') . '</span>';
        }else{
            echo get_the_title( $deck_ship );
        }
    }
}
add_filter('manage_posts_columns', 'gg_columns_head');
add_action('manage_posts_custom_column', 'gg_columns_content', 10, 2);

// ADD MENU PAGE FOR PAGE TUTORIAL
add_action('admin_menu', 'add_menu_for_user_manual');
function add_menu_for_user_manual(){
    add_menu_page(__('Go Galapagos user\'s manual','gogalapagos'), __('GO user\'s manual','gogalapagos'), 'publish_posts', 'gogalapagos-user-manual', gogalapagos_user_manual, URLPLUGINGOGALAPAGOS . '/images/admin-icon.png' );
}

//Agregar los estilos para esta paginate_links
add_action('admin_enqueue_scripts','add_user_manual_style_and_scripts');
function add_user_manual_style_and_scripts(){
    if ( is_admin() ) {
        wp_enqueue_style( 'googlefonts', 'https://fonts.googleapis.com/css?family=Montserrat:400,900|Raleway:400,700', array(), '0.1' );
        wp_enqueue_style( 'usermanualcss', URLPLUGINGOGALAPAGOS . 'css/users-manual.css', array(), '0.1' );
        wp_register_script('bootstrapjs', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', false, '3.3');
        wp_register_script('sticktyelements', URLPLUGINGOGALAPAGOS . 'js/jquery.sticky.js', false, '3.3');
        wp_register_script('usermanualjs', URLPLUGINGOGALAPAGOS . 'js/users-manual.js', false, '0.1');
        wp_enqueue_script('sticktyelements');
        wp_enqueue_script('usermanualjs');
        if (isset ( $_GET['page'] ) and $_GET['page'] == "gogalapagos-user-manual" ){
            wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array(), '3.3' );
            wp_enqueue_script('bootstrapjs');
        }
    }
}
function gogalapagos_admin_scripts(){

}
add_action( 'admin_enqueue_scripts', 'gogalapagos_admin_scripts' );
function admin_wired_styles(){
?>
<style>
    body{
        background-image: url('<?php echo URLPLUGINGOGALAPAGOS;?>/images/screenshot.jpg');
        background-position: bottom right;
        background-attachment: fixed;
        background-size: cover;
    }
</style>
<?php
                             }
add_action('admin_head', 'admin_wired_styles');

function gogalapagos_user_manual(){
?>
<div class="wrap">
    <div class="container-fluid users-manual-container">
        <div class="row">
            <div class="col-sm-3 col-sm-push-9">
                <img src="<?php echo URLPLUGINGOGALAPAGOS; ?>images/logo-34-anos-internas.png" alt="Go Galapagos Logo" class="img-responsive gogalapagos-user-manual-logo">
            </div>
            <div class="col-sm-9 col-sm-pull-3">
                <h1 class="users_manual_title">Go Galapagos</h1>
                <h2><i class="fa fa-users" aria-hidden="true"></i> <?php _e('User\'s Tutorial and Information Support','gogalapagos'); ?></h2>
                <p class="users-manual-intro-copy"><?php _e('An overview of Go Galapagos Wordpress Theme, how to download and use, basic templates and examples, and more.','gogalapagos'); ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#welcome" aria-controls="welcome" role="tab" data-toggle="tab"><i class="fa fa-star" aria-hidden="true"></i> Welcome</a></li>
                        <li role="presentation"><a href="#adminmanual" aria-controls="adminmanual" role="tab" data-toggle="tab" accesskey="a" title="Press Alt + a"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Administrator's Manual</a></li>
                        <li role="presentation"><a href="#usermanual" aria-controls="usermanual" role="tab" data-toggle="tab" accesskey="u" title="Press Alt + u"><i class="fa fa-user" aria-hidden="true"></i> User's Manual</a></li>
                        <li role="presentation"><a href="#support" aria-controls="support" role="tab" data-toggle="tab" accesskey="h" title="Press Alt + h"><i class="fa fa-ambulance" aria-hidden="true"></i> Support</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content" style="padding: 36px;">
                        <?php
                                   /**
                        * Carga la pagina de bienvenida del manual de usuarios
                        */
                                   include ( RUTAPLUGINGOGALAPAGOS . 'includes/users-manual/welcome.php');

                                   /**
                        * Carga la pagina del manual para administradores y sistemas
                        */
                                   include ( RUTAPLUGINGOGALAPAGOS . 'includes/users-manual/administrator-manual.php');

                                   /**
                        * Carga la pagina del manual para administradores y sistemas
                        */
                                   include ( RUTAPLUGINGOGALAPAGOS . 'includes/users-manual/users-manual-content.php');

                                   /**
                        * Carga la pagina del manual para administradores y sistemas
                        */
                                   include ( RUTAPLUGINGOGALAPAGOS . 'includes/users-manual/users-manual-support.php');
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php //Termina el html del manual de usuario
                                  }

/* Send ajax mail */
function send_mail_to_sales_office(){
    // definir la zona horaria
    date_default_timezone_set ( 'America/Bogota' );

    $producto = filter_input(INPUT_POST, 'product');
    $nombre = filter_input(INPUT_POST, 'name');
    $email = filter_input(INPUT_POST, 'email');
    $telefono = filter_input(INPUT_POST, 'phone');
    //echo $producto.'-'.$nombre.'-'.$email.'-'.$telefono;
    //die();
    /*
    // Google reCaptcha features
    $secret = "6Lc1Ch0UAAAAALVmIyV_K8Bf5uspZL09RfwzY_JH";
    $response = null;

    $path = 'https://www.google.com/recaptcha/api/siteverify?';
    $path .= 'secret=' . $secret;
    $path .= '&remoteip=' . $_SERVER["REMOTE_ADDR"];
    $path .= '&v=php_1.0';
    $path .= '&response='. $_POST["g-recaptcha-response"];
    */
    //$response = file_get_contents( $path );

    //$answers = json_decode($response, true);

    /*if ( $response != null && trim($answers ['success']) == true ) {*/

    ob_start();
?>
<table border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#cccccc" style="width: 100%;">
    <table width="600" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#F6F6F6" style="font-family:Verdana, Helvetica, sans serif; margin-top:36px; margin-bottom:36px;">
        <tr>
            <td valign="center" align="right">
                <img src="<?php echo get_template_directory_uri(); ?>/images/logo-34-anos-internas.png" alt="Klein Tours - Go Galapagos" style="margin-right:36px;margin-top:36px;">
            </td>
        </tr>
        <tr>
            <td style="color:#222222!important; padding: 30px;">
                <h2 style="color:#00ACBA;text-transform:uppercase;font-weight:900;">Informaci&oacute;n de contacto</h2>
                <ul style="list-style:none;padding:0px;">
                    <li style="font-size:18px;color:#000!important;"><strong>Sr(a):</strong><br /> <span style="font-weight:900;display:block;margin-bottom:18px;font-size:36px;"><?php echo $nombre ?></span></li>
                    <li style="color:#222222!important;margin-bottom:12px;"><strong>Email:</strong> <a href="mailto:<?php echo $email ?></li"><?php echo $email ?></a></li>
                    <li style="color:#222222!important;"><strong>Tel&eacute;fono:</strong> <?php echo $telefono ?></li>
                </ul>
                <h3 style="color:#00ACBA;text-transform:uppercase;font-weight:800;">El cliente quiere:</h3>
                <span style="font-size:32px;font-weight:900;font-family:monospace;color:#222222!important;"><?php echo $producto ?></span>
            </td>
        </tr>
        <tr style="background-color:#062c40;">
            <td align="center">
                <p style="margin-top:35px;margin-bottom:0px!important;font-size:16px;line-height:1.5;color:#fff!important">Este email fue enviado desde el formulario del Landing</p>
                <p style="font-size:16px;color:#fff!important;margin:0px!important;"><strong>DISCOVER ECUADOR WITH GO GALAPAGOS</strong></p>
                <p style="margin-bottom:35px;margin-top:0px!important;font-size:16px;line-height:1.5;color:#fff!important">de Go Galapagos, el <?php echo date("d/m/Y") ?> a las <?php echo date("h:i") ?></p>
            </td>
        </tr>
    </table>
</table>
<?php
        $body = ob_get_clean();

    // Contenido para correos NO HTML
    $bodyAlternativo = "Mensaje desde ".$subject.", el Sr(a)".$nombre.', ';
    $bodyAlternativo .= 'cuyo email es: '.$email.', ';
    $bodyAlternativo .= 'y su tel&eacute;fono: '.$telefono.', ';
    $bodyAlternativo .= 'requiere informaci&oacute;n sobre '.$producto.'.';

    //$body = 'Esta es una prueba';

    //$contacto = get_page_by_path('contact');
    //$mail_admin = get_post_meta($contacto->ID, 'em', true);
    //$to = 'colocar un solo email';
    $subject = 'Landing: Discover Ecuador with Go Galapagos';

    require_once ABSPATH . WPINC . '/class-phpmailer.php';

    $mail = new PHPMailer( true );

    //$mail->AddAddress($to);
    try{
        // Server settings
        //$mail->SMTPDebug  = 1;
        //$mail->Host = 'smtp1.gogalapagos.com.ec;smtp2.gogalapagos.com.ec';
        //$mail->Host = 'smtp1.gogalapagos.com.ec';
        //$mail->isSMTP();
        //$mail->SMTPSecure = 'tls';
        //$mail->Port = 587;

        // Recipients
        $mail->setFrom('web@kleintours.com.ec', 'Mailer');
        $mail->From = 'grupowebsales@kleintours.com.ec';
        $mail->FromName = 'Go Galapagos Landing';

        $mail->AddAddress('jmrpadrino@gmail.com', 'Test Mail');
        $mail->AddAddress('web@kleintours.com.ec', 'Webmaster');
        //$mail->AddAddress('webmarketing@gogalapagos.com.ec', 'Nicolas Larenas');
        //$mail->AddAddress('grupowebsales@kleintours.com.ec', 'Ventas Web Klein Tours');
        $mail->AddReplyTo('grupowebsales@kleintours.com.ec', 'Go Galapagos web sales');

        // Content
        $mail->IsHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->CharSet = 'utf-8';
        $mail->AltBody = $bodyAlternativo;

        // Send Mail
        $mail->Send();
        echo 'true';
    } catch (phpmailerException $e) {
        echo $e->errorMessage() . ' excepcion'; //Pretty error messages from PHPMailer
        //echo 'false';
    } catch (Exception $e) {
        //echo trim($answers ['success']);
        echo $e->getMessage(); //Boring error messages from anything else!
        //echo 'false';
    }
    //echo trim($answers ['success']);
    /*try {
            $mail->AddAddress($to);
            $mail->FromName = 'Sentry Wellhead Systems - Contact';
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->IsHTML();
            $mail->CharSet = 'utf-8';
            $mail->Send();
            echo trim($answers ['success']);
        } catch (phpmailerException $e) {
          echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
            echo trim($answers ['success']);
          echo $e->getMessage(); //Boring error messages from anything else!
        }*/
    /*}else{
        echo trim($answers ['success']);
    }*/
    die();
}
add_action('wp_ajax_send_mail_to_sales_office', 'send_mail_to_sales_office');
add_action('wp_ajax_nopriv_send_mail_to_sales_office', 'send_mail_to_sales_office');

/**
* Botones en el tinymce del editor.
*
**/
function wpb_mce_buttons_2($buttons) {
    array_unshift($buttons, 'styleselect');
    return $buttons;
}
//add_filter('mce_buttons_2', 'wpb_mce_buttons_2');
/*
* Callback function to filter the MCE settings
*/

function my_mce_before_init_insert_formats( $init_array ) {

    // Define the style_formats array

    $style_formats = array(
        /*
* Each array child is a format with it's own settings
* Notice that each array has title, block, classes, and wrapper arguments
* Title is the label which will be visible in Formats menu
* Block defines whether it is a span, div, selector, or inline style
* Classes allows you to define CSS classes
* Wrapper whether or not to add a new block-level element around any selected elements
*/
        array(
            'title' => 'Content Block',
            'block' => 'span',
            'classes' => 'content-block',
            'wrapper' => true,

        ),
        array(
            'title' => 'Blue Button',
            'block' => 'span',
            'classes' => 'blue-button',
            'wrapper' => true,
        ),
        array(
            'title' => 'Red Button',
            'block' => 'span',
            'classes' => 'red-button',
            'wrapper' => true,
        ),
    );
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );

    return $init_array;

}
// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );

/* Metaboxes */
/**
 * Adds a meta box to the post editing screen
 */
function gogalapagos_metaboxes() {
    // Metaboxes para Descripcion corta y larga del Voucher
    add_meta_box( 'itinerario_descripcion_corta', __( 'Go Galapagos descripción Voucher', 'gogalapagos' ), 'gogalapagos_metabox_drawing', 'ggitineraries', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'gogalapagos_metaboxes' );
// Render de los metaboxes
function gogalapagos_metabox_drawing( $post )
{ 
    // Crear los nonce
    wp_nonce_field( basename( __FILE__ ), 'inputs_para_vouchers' );

    //intento de web service
    $args = array(
        'timeout'     => 5,
        'redirection' => 5,
        'httpversion' => '1.0',
        'user-agent'  => 'WordPress/' . $wp_version . '; ' . home_url(),
        'blocking'    => true,
        'headers'     => array(),
        'cookies'     => array(),
        'body'        => null,
        'compress'    => false,
        'decompress'  => true,
        'sslverify'   => true,
        'stream'      => false,
        'filename'    => null
    ); 

    if ( !isset($_POST) or empty($_POST)){
        $_POST['interes'] = 'ALL';
        $_POST['fecha-inicio'] = strtotime(date('Y-m-d'));
        $fecha = date('Y-m-j');
        $nuevafecha = strtotime ( '+20 day' , strtotime ( $fecha ) ) ;
        $_POST['fecha-fin'] = $nuevafecha;
        $_POST['adultos'] = 2;
        $_POST['ninios'] = 1;
    }else{
        $_POST['interes'] = 'ALL';
        $_POST['fecha-inicio'] = strtotime(date('Y-m-d'));
        $fecha = date('Y-m-j');
        $nuevafecha = strtotime ( '+20 day' , strtotime ( $fecha ) ) ;
        $_POST['fecha-fin'] = $nuevafecha;
        $_POST['adultos'] = 2;
        $_POST['ninios'] = 1;
    }
    $datos = serialize($_POST);
    $URL = 'https://servicios.gogalapagos.com/wstransaccional/web/servicios-landing?id='.$datos;

    $response = wp_remote_get($URL, $args ); 

    if ( is_array( $response ) ) {
        $header = $response['headers']; // array of http header lines
        $_body = json_decode( wp_remote_retrieve_body( $response ), true);
    }

    // Obtener los valores guardados get_post_meta($id, $key, $single)
    $descripcion_corta = get_post_meta( $post->ID, 'itinerario_corto', TRUE );
    $descripcion_larga = get_post_meta( $post->ID, 'itinerario_largo', TRUE );

?>
<div class="meta-wrapper" style="overflow: auto;">
    <div class="meta-row" style="display: block; overflow: auto;">
        <div class="meta-th" style="width:25%; font-weight: bold; float: left;">
            <img src="<?php echo URLPLUGINGOGALAPAGOS; ?>/images/logo-34-anos-internas.png" alt="Go Galapagos Logo">
        </div>
        <div class="meta-td" style="width:75%; float:left;">
            <h1>Descripción para Vouchers Klein Tours</h1>
        </div>
    </div>
    <div class="meta-row" style="margin-top: 36px; display: block; overflow: auto;">
        <div class="meta-th" style="width:25%; font-weight: bold; float: left;">
            <label for="itinerario_corto" class="">Descripci&oacute;n Corta del Itinerario</label>
        </div>
        <div class="meta-td" style="width:75%; float:left;">
            <textarea id="itinerario_corto" name="itinerario_corto" class="traducible" rows="8" placeholder="Escriba la descripción corta del itinerario" style="width: 100%;"><?php echo !empty($descripcion_corta) ? esc_html($descripcion_corta) : ''; ?></textarea>
        </div>
    </div>
    <div class="meta-row" style="display: block; overflow: auto;">
        <hr />
    </div>
    <div class="meta-row" style="margin-top: 36px; display: block; overflow: auto;">
        <div class="meta-th" style="width:25%; font-weight: bold; float: left;">
            <label for="itinerario_largo" class="">Descripci&oacute;n Larga del Itinerario</label>
        </div>
        <div class="meta-td" style="width:75%; float:left;">
            <textarea id="itinerario_largo" name="itinerario_largo" class="traducible" rows="8" placeholder="Escriba la descripción larga del itinerario" style="width: 100%;"><?php echo !empty($descripcion_larga) ? esc_html($descripcion_larga) : ''; ?></textarea>
        </div>
    </div>
    <div class="meta-row" style="display: block; overflow: auto;">
        <p style="color: red; font-size: 24px; font-weight: bold;">Este espacio está vinculado al sistema de impresion de Vouchers de Klein Tour, no haga cambio sin autorizacion previa. Gracias.</p>
    </div>
    <?php 
    foreach($_body as $interest => $value){ 
        foreach($_body[$interest] as $producto => $valores){
            echo '<div class="meta-row" style="display: inline-block; overflow: auto; margin: 18px; border: 1px solid gray; padding: 16px; width: auto;">';
            echo '<h3>'. $valores['titulo'] . '</h3>';
            echo '<p><strong>Precio:<strong> ' . $valores['precio'] .'</p>';
            echo '</div>';
        }
    }
    ?>
</div>
<?php // Fin de la funcion
}

// Funcion para guardar los cambios
function gogalalagos_save_vouchers_descriptions( $post_id ){
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST['inputs_para_vouchers']) && wp_verify_nonce($_POST['inputs_para_vouchers'], basename( __FILE__ ) ) ? 'true' : 'false');

    if ( $is_autosave || $is_revision || !$is_valid_nonce ){
        return;
    }

    if ( isset ( $_POST['itinerario_corto'] ) ){
        update_post_meta($post_id, 'itinerario_corto', $_POST['itinerario_corto'] );
    }
    if ( isset ( $_POST['itinerario_largo'] ) ){
        update_post_meta($post_id, 'itinerario_largo', $_POST['itinerario_largo'] );
    }
}
add_action('save_post', 'gogalalagos_save_vouchers_descriptions' );



?>