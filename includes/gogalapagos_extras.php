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

// CAMPOS PARA PERFILES DE USUARIO

add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );

function extra_user_profile_fields( $user ) { ?>
<?php if( current_user_can('administrator') && $user->roles[0] == 'administrator' ) { ?>

<h3><?php _e("ELIGOS profile information", "gogalapagos"); ?></h3>
<table class="form-table">
    <tr>
        <th><span class="dashicons dashicons-admin-network"></span>&nbsp;<label for="token"><?php _e("ELIGOS Token", 'gogalapagos'); ?></label></th>
        <td>
            <input type="text" name="token" id="token" value="<?php echo esc_attr( get_the_author_meta( 'token', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please set the token."); ?></span>
        </td>
    </tr>
</table>
<?php } ?>
<?php }
add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

function save_extra_user_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) ) { 
        return false; 
    }
    update_user_meta( $user_id, 'token', $_POST['token'] );
}

/*---------- FIN CAMPO PARA PERFILES DE USUARIO ------------*/



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
} // FIN FUNCION ADMIN DASHBOARD



// Add admin menu page for Go Galapagos Dashboard
function galapagos_admin_dashboard($hook){
?>
<h1>Galapagos Dashboard <?= $hook ?></h1>
<p><?= _e('This list shows the information published in the frontend about the destination.','gogalapagos')?></p>
<p> <span class="fa fa-globe"></span>Mas informacion luego.</p>
<div class="row">
    <div class="col-xs-4">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur modi numquam, corporis veritatis quasi magnam voluptatem, facilis consequuntur laborum, rem repellat ea asperiores et odio exercitationem placeat! Mollitia, inventore, deserunt!</p>
    </div>
    <div class="col-xs-4">
        <h2><?= _e('Islands', 'gogalapagos')?></h2>
    </div>
    <div class="col-xs-4">
        <h2><?= _e('Animals', 'gogalapagos')?></h2>
    </div>
</div>
<div class="row">
    <div class="col-xs-4">
        <h2><?= _e('Visitor Sites', 'gogalapagos')?></h2>
    </div>
    <div class="col-xs-4">
        <h2><?= _e('Activities', 'gogalapagos')?></h2>
    </div>
    <div class="col-xs-4">
        <h2><?= _e('Special Interests', 'gogalapagos')?></h2>
    </div>
</div>
<?php 
                                         }


/*-----------------------------------------------------------------------------*/


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
        __( 'GO Galapagos Theme Settings', 'gogalapagos' ),
        'GO WP Theme',
        //'publish_pages',
        //'manage_options',
        'upload_files',
        'go-galapagos-theme-setings',
        'gg_theme_dashboard',
        URLPLUGINGOGALAPAGOS . '/images/admin-icon.png',
        80
    );
    add_menu_page(
        __( 'GO Galapagos Dashboard', 'gogalapagos' ),
        'GO Galapagos',
        //'publish_pages',
        //'manage_options',
        'upload_files',
        'go-galapagos-dashboard',
        'gg_admin_dashboard',
        URLPLUGINGOGALAPAGOS . '/images/admin-icon.png',
        85
    );
    // Galapagos main menu
    add_menu_page(
        __( 'Galapagos', 'gogalapagos' ),
        'Galapagos',
        //'publish_pages',
        //'manage_options',
        'upload_files',
        'galapagos-dashboard',
        'galapagos_admin_dashboard',
        URLPLUGINGOGALAPAGOS . '/images/admin-icon.png',
        80
    );
    
    add_menu_page(
        __( 'GO Office', 'gogalapagos' ),
        'GO Office',
        //'publish_pages',
        //'manage_options',
        'upload_files',
        'go-office-dashboard',
        'go_office_dashboard',
        URLPLUGINGOGALAPAGOS . '/images/admin-icon.png',
        95
    );
    // Go Galapagos child pages
    add_submenu_page( 'go-galapagos-dashboard', __( 'Ships', 'gogalapagos' ), __( 'Ships', 'gogalapagos' ), 'upload_files', 'edit.php?post_type=ggships');
    add_submenu_page( 'go-galapagos-dashboard', __( 'Decks', 'gogalapagos' ), __( 'Decks', 'gogalapagos' ), 'upload_files', 'edit.php?post_type=ggdecks');
    add_submenu_page( 'go-galapagos-dashboard', __( 'Cabins', 'gogalapagos' ), __( 'Cabins', 'gogalapagos' ), 'upload_files', 'edit.php?post_type=ggcabins');
    add_submenu_page( 'go-galapagos-dashboard', __( 'Social Areas', 'gogalapagos' ), __( 'Social Areas', 'gogalapagos' ), 'upload_files', 'edit.php?post_type=ggsocialarea');
    add_submenu_page( 'go-galapagos-dashboard', __( 'Onboard Services', 'gogalapagos' ), __( 'Onboard Services', 'gogalapagos' ), 'upload_files', 'edit.php?post_type=ggonboardservices');
    add_submenu_page( 'go-galapagos-dashboard', '<i class="dashicons dashicons-controls-play"></i>' . __( 'Onboard Service Package Groups', 'gogalapagos' ), __( 'Onboard Service Package Groups', 'gogalapagos' ), 'manage_options', 'edit-tags.php?taxonomy=onboard-service-package');
    add_submenu_page( 'go-galapagos-dashboard', __( 'Itineraries', 'gogalapagos' ), __( 'Itineraries', 'gogalapagos' ), 'upload_files', 'edit.php?post_type=ggitineraries');
    add_submenu_page( 'go-galapagos-dashboard', '<i class="dashicons dashicons-controls-play"></i>' . __( 'Go Packages', 'gogalapagos' ), __( 'Go Packages', 'gogalapagos' ), 'upload_files', 'edit.php?post_type=ggpackage');
    add_submenu_page( 'go-galapagos-dashboard', '<i class="dashicons dashicons-controls-play"></i>' . __( 'Go Tours', 'gogalapagos' ), __( 'Go Tours', 'gogalapagos' ), 'upload_files', 'edit.php?post_type=ggtour');
    add_submenu_page( 'go-galapagos-dashboard', '<i class="dashicons dashicons-controls-play"></i>' . __( 'Tour Groups', 'gogalapagos' ), __( 'Tour Groups', 'gogalapagos' ), 'manage_options', 'edit-tags.php?taxonomy=go_tours');
    add_submenu_page( 'go-galapagos-dashboard', '<i class="dashicons dashicons-controls-play"></i>' . __( 'South America Tours', 'gogalapagos' ), __( 'South America Tours', 'gogalapagos' ), 'manage_options', 'edit.php?post_type=ggsatour');
    add_submenu_page( 'go-galapagos-dashboard', '<i class="dashicons dashicons-controls-play"></i>' . __( 'South America Tour Groups', 'gogalapagos' ), __( 'South America Tour Groups', 'gogalapagos' ), 'manage_options', 'edit-tags.php?taxonomy=go_sa_tours');
    add_submenu_page( 'go-galapagos-dashboard', '<i class="dashicons dashicons-controls-play"></i>' . __( 'Special Offers', 'gogalapagos' ), __( 'Special Offers', 'gogalapagos' ), 'upload_files', 'edit.php?post_type=ggspecialoffer');
    add_submenu_page( 'go-galapagos-dashboard', '<i class="dashicons dashicons-controls-play"></i>' . __( 'FAQs', 'gogalapagos' ), __( 'FAQs', 'gogalapagos' ), 'upload_files', 'edit.php?post_type=ggfaqs');
    add_submenu_page( 'go-galapagos-dashboard', '<i class="dashicons dashicons-controls-play"></i>' . __( 'FAQs Groups', 'gogalapagos' ), __( 'FAQs Groups', 'gogalapagos' ), 'upload_files', 'edit-tags.php?taxonomy=go_faqs');
    add_submenu_page( 'go-galapagos-dashboard', '<i class="dashicons dashicons-controls-play"></i>' . __( 'Testimonials', 'gogalapagos' ), __( 'Testimonials', 'gogalapagos' ), 'upload_files', 'edit.php?post_type=ggtestimonial');
    add_submenu_page( 'go-galapagos-dashboard', '<i class="dashicons dashicons-controls-play"></i>' . __( 'Memberships', 'gogalapagos' ), __( 'Memberships', 'gogalapagos' ), 'upload_files', 'edit.php?post_type=ggmembership');

    // Galapagos child pages
    add_submenu_page( 'galapagos-dashboard', __( 'Islands', 'gogalapagos' ), __( 'Islands', 'gogalapagos' ), 'upload_files', 'edit.php?post_type=ggisland');
    add_submenu_page( 'galapagos-dashboard', __( 'Animals', 'gogalapagos' ), __( 'Animals', 'gogalapagos' ), 'upload_files', 'edit.php?post_type=gganimal');
    add_submenu_page( 'galapagos-dashboard', '<i class="dashicons dashicons-controls-play"></i>' . __( 'Animal Groups', 'gogalapagos' ), __( 'Animal Groups', 'gogalapagos' ), 'manage_options', 'edit-tags.php?taxonomy=animalgroup');
    add_submenu_page( 'galapagos-dashboard', __( 'Visitor\'s Sites', 'gogalapagos' ), __( 'Visitor\'s Sites', 'gogalapagos' ), 'upload_files', 'edit.php?post_type=gglocation');
    add_submenu_page( 'galapagos-dashboard', __( 'Activities', 'gogalapagos' ), __( 'Activities', 'gogalapagos' ), 'upload_files', 'edit.php?post_type=ggactivity');
    add_submenu_page( 'galapagos-dashboard', __( 'Special Interest', 'gogalapagos' ), __( 'Special Interest', 'gogalapagos' ), 'upload_files', 'edit.php?post_type=ggspecialinterest');
    
    // Go Office child pages
    add_submenu_page( 'go-office-dashboard', __('GO Galapagos user\'s manual','gogalapagos'), __('GO user\'s manual','gogalapagos'), 'publish_posts', 'users-manual', gogalapagos_user_manual );
    add_submenu_page( 'go-office-dashboard', __( 'Sales Experts', 'gogalapagos' ), __( 'Sales Experts', 'gogalapagos' ), 'upload_files', 'edit.php?post_type=ggsalesexpert');
    /* test
    add_submenu_page( 'galapagos-dashboard', __( 'Test', 'gogalapagos' ), __( 'Test', 'gogalapagos' ), 'upload_files', 'testeo', 'test');
    add_submenu_page( 'testeo', __( 'Test 2', 'gogalapagos' ), __( 'Test 2', 'gogalapagos' ), 'upload_files', 'testeo-2', 'test2');
    */
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
//        $defaults['dispo_cid'] = 'Eligos CabinID';
//        $defaults['dispo_code'] = 'Eligos Code';
//        $defaults['dispo_ship_code'] = 'Eligos Ship Code';
//        $defaults['dispo_yearid'] = 'Eligos YearID';
//        $defaults['dispo_year'] = 'Eligos Year';
        $defaults['cabin_eligos'] = '<i class="fa fa-database" aria-hidden="true"></i> Eligos';
        $defaults['cabin_ship'] = '<i class="fa fa-ship" aria-hidden="true"></i> Cabin Ship';
        $defaults['cabin_deck'] = '<i class="fa fa-thumb-tack" aria-hidden="true"></i> Cabin Deck';
        //$defaults['cabin_gallery'] = '<i class="fa fa-picture-o" aria-hidden="true"></i> Cabin Gallery';
        $defaults['cabin_category_color'] = '<i class="fa fa-tint" aria-hidden="true"></i> Color';
        $defaults['cabin_clone_content'] = '<i class="fa fa-clone" aria-hidden="true"></i> Clone Content';
    }
    if ( $_GET['post_type'] == 'ggdecks' ){
        $defaults['deck_ship'] = '<i class="fa fa-ship" aria-hidden="true"></i> Ship';
        $defaults['deck_gallery'] = '<i class="fa fa-picture-o" aria-hidden="true"></i> Deck Gallery';
    }
    if ( $_GET['post_type'] == 'ggships' ){
        $defaults['dispo_code'] = '<i class="fa fa-ship" aria-hidden="true"></i> Dispo Code';
        $defaults['dispo_group_code'] = '<i class="fa fa-ship" aria-hidden="true"></i> Group Code';
    }
    if ( $_GET['post_type'] == 'ggsocialarea' ){
        $defaults['ship_parent'] = '<i class="fa fa-ship" aria-hidden="true"></i> Ship Parent';
        $defaults['deck_location'] = '<i class="fa fa-ship" aria-hidden="true"></i> Deck Location';
    }
    if ( $_GET['post_type'] == 'ggitineraries' ){
        $defaults['itinerary_year'] = '<i class="fa fa-calendar" aria-hidden="true"></i> Operation Year';
    }
    return $defaults;
}
function gg_columns_content($column_name, $post_ID) {
    $prefix = 'gg_';
    $args = array(
        'post_type' => 'ggcabins',
        'posts_per_page' => -1,
    );
    $cabinas = get_posts($args);
    // Columnas para Barcos
    
    if ($column_name == 'cabin_eligos') {
        $cabin_eligos_id = get_post_meta( $post_ID, $prefix . 'cabin_eligos_id', TRUE );
        $dispo_code = get_post_meta( $post_ID, $prefix . 'dispo_ID', TRUE );
        $cabin_eligos_ship_code = get_post_meta( $post_ID, $prefix . 'cabin_eligos_ship_code', TRUE );
        $cabin_year_id = get_post_meta( $post_ID, $prefix . 'cabin_year_id', TRUE );
        $cabin_year = get_post_meta( $post_ID, $prefix . 'cabin_year', TRUE );
        echo '|' . $cabin_eligos_id . ' - ' . $dispo_code . ' - ' . $cabin_eligos_ship_code . '|<br />' . $cabin_year;
    }
    
    if ($column_name == 'dispo_cid') {
        $ship_dispo_code = get_post_meta( $post_ID, $prefix . 'cabin_eligos_id', TRUE ); // Devuelve Array
        if ( empty ( $ship_dispo_code ) ){
            echo '<span style="color: #ff8000; font-weight: bold;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>';
        }else{
            echo esc_html($ship_dispo_code);
        }
    }
    if ($column_name == 'cabin_clone_content') {
        echo '<select id="'.$post_ID.'" style="max-width: 100%; font-size: 10px;" class="clone-this-cabin">';
        echo '<option>Select cabin</option>';
        foreach($cabinas as $cabina){
               echo '<option value="'.$cabina->ID.'">'.$cabina->post_title.'</option>';
        }
        echo '</select>';
    }
    if ($column_name == 'dispo_code') {
        $ship_dispo_code = get_post_meta( $post_ID, $prefix . 'dispo_ID', TRUE ); // Devuelve Array
        if ( empty ( $ship_dispo_code ) ){
            echo '<span style="color: #ff8000; font-weight: bold;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>';
        }else{
            echo esc_html($ship_dispo_code);
        }
    }
    if ($column_name == 'dispo_ship_code') {
        $ship_dispo_code = get_post_meta( $post_ID, $prefix . 'cabin_eligos_ship_code', TRUE ); // Devuelve Array
        if ( empty ( $ship_dispo_code ) ){
            echo '<span style="color: #ff8000; font-weight: bold;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>';
        }else{
            echo esc_html($ship_dispo_code);
        }
    }
    if ($column_name == 'dispo_yearid') {
        $ship_dispo_code = get_post_meta( $post_ID, $prefix . 'cabin_year_id', TRUE ); // Devuelve Array
        if ( empty ( $ship_dispo_code ) ){
            echo '<span style="color: #ff8000; font-weight: bold;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>';
        }else{
            echo esc_html($ship_dispo_code);
        }
    }
    if ($column_name == 'dispo_year') {
        $ship_dispo_code = get_post_meta( $post_ID, $prefix . 'cabin_year', TRUE ); // Devuelve Array
        if ( empty ( $ship_dispo_code ) ){
            echo '<span style="color: #ff8000; font-weight: bold;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>';
        }else{
            echo esc_html($ship_dispo_code);
        }
    }
    if ($column_name == 'dispo_group_code') {
        $ship_dispo_code = get_post_meta( $post_ID, $prefix . 'ship_group_code', TRUE ); // Devuelve Array
        if ( empty ( $ship_dispo_code ) ){
            echo '<span style="color: #ff8000; font-weight: bold;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>';
        }else{
            echo esc_html($ship_dispo_code);
        }
    }
    // Columnas para Decks
    if ($column_name == 'deck_ship') {
        $deck_ship = get_post_meta( $post_ID, $prefix . 'deck_ship_id', FALSE ); // Devuelve Array
        if ( empty ( $deck_ship ) ){
            echo '<span style="color: #ff8000; font-weight: bold;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>';
        }else{
            echo '<a href="'.get_edit_post_link( $deck_ship[0], 'display' ).'">'.get_the_title($deck_ship[0]) . '</a>';
        }
    }
    if ($column_name == 'deck_gallery') {
        $deck_pictures = get_post_meta( $post_ID, $prefix . 'deck_gallery', FALSE ); // Devuelve Array
        if ( empty ( $deck_pictures ) ){
            echo '<span style="color: #ff8000; font-weight: bold;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>';
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
            echo '<span style="color: #ff8000; font-weight: bold;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>';
        }else{
            echo '<span class="category-color-admin-column" style="background:'.$cabin_color.'; display: block; padding: 8px; text-align: center; font-size: 16px; font-weight: bold; color: white;" title="Use this color '.$cabin_color.'">'.$cabin_color.'</span>';
        }
    }
    if ($column_name == 'cabin_ship') {
        $cabin_ship = get_post_meta( $post_ID, $prefix . 'cabin_ship_id', TRUE ); // Devuelve Array
        if ( empty ( $cabin_ship ) ){
            echo '<span style="color: #ff8000; font-weight: bold;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>';
        }else{
            echo get_the_title( $cabin_ship );
        }
    }
    if ($column_name == 'cabin_deck') {
        $cabin_decks = get_post_meta( $post_ID, $prefix . 'cabin_decks_location', false ); // Devuelve Array
        if ( empty( $cabin_decks ) ){
            echo '<span style="color: #ff8000; font-weight: bold;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>';
        }else{
            echo '<ul style="list-style: square;">';
            foreach ($cabin_decks as $cabin_deck){
                $deck = get_post($cabin_deck);
                echo '<li>'.$deck->post_title.'</li>';
            }
            echo '</ul>';
        }
    }
    if ($column_name == 'cabin_gallery') {
        $cabin_pictures = get_post_meta( $post_ID, $prefix . 'cabin_gallery', FALSE ); // Devuelve Array
        if ( empty ( $cabin_pictures ) ){
            echo '<span style="color: #ff8000; font-weight: bold;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>';
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
    // Columnas para Areas Sociales
    if ($column_name == 'ship_parent') {
        $deck_ship = get_post_meta( $post_ID, $prefix . 'social_ship_id', TRUE ); // Devuelve Array
        if ( empty ( $deck_ship ) ){
            echo '<span style="color: #ff8000; font-weight: bold;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> ' . __('This Deck has not be asigned to any Ship', 'gogalapagos') . '</span>';
        }else{
            echo get_the_title( $deck_ship );
        }
    }
    if ($column_name == 'deck_location') {
        $deck_ship = get_post_meta( $post_ID, $prefix . 'cabin_decks_location', true ); // Devuelve Array
        if ( empty ( $deck_ship ) ){
            echo '<span style="color: #ff8000; font-weight: bold;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> ' . __('This Deck has not be asigned to any Ship', 'gogalapagos') . '</span>';
        }else{
            echo get_the_title( $deck_ship );
        }
    }
    
    // Columnas para Itinerarios
    if ($column_name == 'itinerary_year') {
        $itinerary_year = get_post_meta( $post_ID, $prefix . 'itinerary_year', false ); // Devuelve Array
        if ( empty ( $itinerary_year ) ){
            echo '<span style="color: #ff8000; font-weight: bold;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> ' . __('This itinerary has not Year set yet', 'gogalapagos') . '</span>';
        }else{
            $anioActual = date ('Y');
            $marca = 'green';
            if ( $anioActual < $itinerary_year[0] ){
                $marca = 'orange';
            }else if( $anioActual > $itinerary_year[0] ){
                $marca = 'red';
            }
            echo '<span style=" color:'.$marca.'; font-weight: bold;">' . $itinerary_year[0] . '</span>';
            
        }
    }

}
add_filter('manage_posts_columns', 'gg_columns_head');
add_action('manage_posts_custom_column', 'gg_columns_content', 10, 2);

// ADD MENU PAGE FOR PAGE TUTORIAL
add_action('admin_menu', 'add_menu_for_user_manual');
function add_menu_for_user_manual(){
    
}

//Agregar los estilos para esta paginate_links
add_action('admin_enqueue_scripts','add_user_manual_style_and_scripts');
function add_user_manual_style_and_scripts($hook){
    
    $plugin_pages = array(
        'toplevel_page_go-galapagos-theme-setings',
        'toplevel_page_galapagos-dashboard',
        'toplevel_page_go-galapagos-dashboard',
        'toplevel_page_go-office-dashboard',
        'go-office_page_users-manual'
    );
    wp_enqueue_script( 'fontawesome', 'https://use.fontawesome.com/9671498c3e.js', array ( 'jquery' ), '1.1', true);
    
    /*if ( is_admin() ) {
        if (isset ( $_GET['page'] ) and $_GET['page'] == "/users-manual" ){
            wp_enqueue_style( 'bootstrap', URLPLUGINGOGALAPAGOS . '/css/bootstrap.min.css', array(), '3.3' );
            wp_enqueue_script('bootstrapjs');
        }
    }*/
    if ( in_array( $hook, $plugin_pages ) ) {        
        wp_enqueue_style( 'usermanualcss', URLPLUGINGOGALAPAGOS . 'css/users-manual.css', array(), '0.1' );
        wp_register_script('sticktyelements', URLPLUGINGOGALAPAGOS . 'js/jquery.sticky.js', false, '3.3');
        wp_register_script('usermanualjs', URLPLUGINGOGALAPAGOS . 'js/users-manual.js', false, '0.1');
        wp_enqueue_script('sticktyelements');
        wp_enqueue_script('usermanualjs');
        wp_enqueue_style( 'googlefonts', 'https://fonts.googleapis.com/css?family=Montserrat:400,900|Raleway:400,700', array(), '0.1' );
        wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array(), '3.3.7' );
        wp_enqueue_style( 'bootstrap-theme', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css', array(), '3.3.7' );
        wp_enqueue_style( 'gogalapagos-default', URLPLUGINGOGALAPAGOS . 'css/styles.css', array(), '1.0' );
        wp_register_script('bootstrapjs', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', false, '3.3.7');
        wp_enqueue_script('bootstrapjs');
    }
}


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
                                   include ( PATHPLUGINGOGALAPAGOS . '/includes/users-manual/welcome.php');

                                   /**
                        * Carga la pagina del manual para administradores y sistemas
                        */
                                   include ( PATHPLUGINGOGALAPAGOS . '/includes/users-manual/administrator-manual.php');

                                   /**
                        * Carga la pagina del manual para administradores y sistemas
                        */
                                   include ( PATHPLUGINGOGALAPAGOS . '/includes/users-manual/users-manual-content.php');

                                   /**
                        * Carga la pagina del manual para administradores y sistemas
                        */
                                   include ( PATHPLUGINGOGALAPAGOS . '/includes/users-manual/users-manual-support.php');
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
//add_action( 'add_meta_boxes', 'gogalapagos_metaboxes' );
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

/**
 * Send an email notification to the administrator when a post is published.
 * 
 * @param   string  $new_status
 * @param   string  $old_status
 * @param   object  $post
 */
function wpse_19040_notify_admin_on_publish( $new_status, $old_status, $post, $user = '' ) {
    if ( $new_status !== 'publish' || $old_status === 'publish' )
        return;
    if ( ! $post_type = get_post_type_object( $post->post_type ) )
        return;

    // User
    $user = wp_get_current_user();
    
    // Headers
    $headers[] = 'From: Go Galapagos Wordpress';
    $headers[] = 'Cc: Marketing <market@gogalapagos.com.ec>';
    $headers[] = 'Cc: Webmaster <web@kleintours.com.ec>'; 
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    
    // Recipient, in this case the administrator email
    $emailto = get_option( 'admin_email' );

    // Email subject, "New {post_type_label}"
    $subject = 'Edici&oacute;n en Wordpress ' . $post_type->labels->singular_name;
    
    // Email body
    ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" >
    <head>
        <meta charset="UTF-8">
        <title>Cambios en WordPress - Go Galapagos</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head>
    <body>
        <table border="0" cellspacing="0" cellpadding="0" align="center" style="width: 100%; background-color: #e5e5e5; margin: 0; font-family: Arial, Helvetica, sans serif;">
            <tr>
                <td>
                    <table width="600" border="0" cellspacing="0" cellpadding="0" align="center" style="font-family: Arial, Helvetica, sans serif; margin-top:48px; border: 1px solid #cccccc; background: #ffffff;">
                        <tr>
                            <td style="background: #003a57;">
                                <table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
                                    <tr>
                                        <td height="80"><h1 style="color: #e5e5e5; font-size: 1.5em; font-weight: 400; margin-left: 36px;">Go Galapagos - WordPress</h1></td>
                                        <td align="right">
                                            <img style="display: block; margin-right: 36px;" src="<?php echo URLPLUGINGOGALAPAGOS; ?>images/wordpress-notification-icon.png" alt="Wordpress Notification Icon">
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h2 align="center" style="font-family: 'Arial', sans-serif; color: #003a57; font-size: 2.1em; fotn-weight: 400; margin-bottom: 12px;">Se ha realizado un cambio</h2>
                                <p align="center" style="font-family: 'Arial', sans-serif; color: #7b7b7b; margin-top: 0px; margin-bottom: 36px;">en la informaci&oacute;n de la p&aacute;gina web de Go Galapagos</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="550" border="0" cellspacing="0" cellpadding="0" align="center">
                                    <tr>
                                        <td width="300" align="left">
                                            <a href="<?= get_permalink( $post->ID ) ?>"><img style="display: block;" src="<?php echo URLPLUGINGOGALAPAGOS; ?>images/wordpress-notification-view-btn.png" alt="Wordpress Notification View Post"></a>
                                        </td>
                                        <td width="300" align="right">
                                            <a href="<?= get_edit_post_link( $post->ID ) ?>"><img style="display: block;" src="<?php echo URLPLUGINGOGALAPAGOS; ?>images/wordpress-notification-edit-btn.png" alt="Wordpress Notification Edit Post"></a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="margin-left: 36px; color: #7b7b7b;">El Cambio fue realizado por <span style="color: red; text-transform: uppercase; font-weight: bold;"><?= $user ?></span></p>
                                <p style="margin-left: 36px; color: #7b7b7b;">Para m&aacute;s informaci&oacute;n cont&aacute;ctese con:</p>
                                <ul style="margin-left: 36px;">
                                    <li><a href="mailto:web@kleintours.com.ec">web@kleintours.com.ec</a></li>
                                </ul>
                            </td>
                        </tr>
                    </table>
                    <table width="600" border="0" cellspacing="0" cellpadding="0" align="center" style="font-family: Arial, Helvetica, sans serif; margin-bottom:36px;">
                        <tr>
                            <td align="center">
                                <p style="line-height: 2; color: #7b7b7b;">Este mail fue enviado desde <a href="https://www.gogalapagos.com">gogalapagos.com</a>, debido a la normas de notificaci&oacute;n configuradas por Go Galapagos.</p>
                                <p style="color: #7b7b7b;">Notificaci&oacute;n enviada el d&iacute;a <strong style="color: black;">08/05/2018</strong>, a las <strong style="color: black;">12:54</strong></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>
<?php    
    $message = ob_get_clean();

    wp_mail( 'web@gogalapagos.com.ec', $subject, $message, $headers );
}

//add_action( 'transition_post_status', 'wpse_19040_notify_admin_on_publish', 1, 4 );
add_action( 'post_updated', 'wpse_19040_notify_admin_on_publish', 10, 4 );

?>