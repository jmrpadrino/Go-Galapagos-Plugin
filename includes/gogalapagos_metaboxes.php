<?php
/*
 * Este archivo contiene los codigo para generar los metaboxes para cada CPT
 */
global $post;

add_filter( 'rwmb_meta_boxes', 'gogalapagos_register_meta_boxes' );

function gogalapagos_register_meta_boxes( $meta_boxes ) {
    //verificar si es la página de fechas de salida
    $prefix = 'gg_';

    $post_ID = !empty($_POST['post_ID']) ? $_POST['post_ID'] : (!empty($_GET['post']) ? $_GET['post'] : FALSE);

    if (!$post_ID)
        return $meta_boxes; // Para que no emita mensaje de error

    $current_post = get_post($post_ID);

    $current_post_type = $current_post->post_type;

    $pageID = get_option('page_on_front');

    $user = wp_get_current_user();

    $disabled = true;

    if( $user->roles[0] == 'administrator' ){
        $disabled = false;
    }

    // Metaboxes del home
    $meta_boxes[] = array(
        'id'         => 'pages_fold_text',
        'title'      => '<i class="fa fa-desktop"></i> ' . __( 'FOLD Section Text', 'gogalapagos' ),
        'post_types' => array('page'),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(
            array(
                'name' => 'Paragraph (p)',
                'id' => $prefix . 'page_first_section_content',
                'type' => 'wysiwyg',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ) 
            )
        )
    );

    $touchTemplate = get_page_template_slug( $current_post );
    if( $touchTemplate == 'touch/ship-interactive-itineraries.php' or $touchTemplate == 'touch/ship-interactive.php' or  $touchTemplate == 'touch/ship-interactive-activity.php'){
        // Metaboxes del touch
        $meta_boxes[] = array(
            'title'      => __( '<i class="fa fa-ship" aria-hidden="true"></i> Parent Ship', 'gogalapagos' ),
            'post_types' => 'page',
            'fields'     => array(
                array(
                    'name' => 'Assign Parent Ship',
                    'id' => $prefix . 'touch_itinerary_ship_id',
                    'type' => 'post',
                    'post_type' => 'ggships',
                    'field_type' => 'select',
                    'query_args' => array(
                        'orderby' => 'ID',
                        'order' => 'ASC',
                    ),
                ),
            ),
            'context' => 'side',
        );
    }

    if($current_post->ID == $pageID){
        //obtener la cantidad de sliden del home
        $numeroSlides = get_option( 'gg_home_carousel_slides' );
        $i = 1;

        // Metaboxes del home
        $meta_boxes[] = array(
            'id'         => 'home_fold_features',
            'title'      => '<i class="fa fa-desktop"></i> ' . __( 'FOLD Section Settings', 'gogalapagos' ),
            'post_types' => array('page'),
            'context'    => 'normal',
            'priority'   => 'high',
            'fields' => array(
                array(
                    'name' => 'Title (h1)',
                    'id' => $prefix . 'homepage_fold_h1',
                    'type' => 'text',
                    'std' => 'Enjoy',
                    'attributes' => array(
                        'class' => 'gogalapagos-field'
                    )
                ),
                array(
                    'name' => 'Subtitle (p)',
                    'id' => $prefix . 'homepage_fold_subtitle',
                    'type' => 'textarea',
                    'attributes' => array(
                        'class' => 'gogalapagos-field'
                    )
                ),
                array(
                    'name' => '<i class="fa fa-image"></i> Background Image',
                    'id' => $prefix . 'homepage_fold_backgropund_image',
                    'type' => 'file_input',
                ),
                array(
                    'name' => '<i class="fa fa-video-camera"></i> Background Video WEBM',
                    'id' => $prefix . 'homepage_fold_backgropund_video_webm',
                    'type' => 'file_input',
                ),
                array(
                    'name' => '<i class="fa fa-video-camera"></i> Background Video MP4',
                    'id' => $prefix . 'homepage_fold_backgropund_video_mp4',
                    'type' => 'file_input',
                ),
                array(
                    'name' => '<i class="fa fa-video-camera"></i> Background Video OGV',
                    'id' => $prefix . 'homepage_fold_backgropund_video_ogv',
                    'type' => 'file_input',
                ),
            )
        );
        while ($i <= $numeroSlides){
            $meta_boxes[] = array(
                'id'         => 'home_experience_features_'. $i,
                'title'      => '<i class="fa fa-desktop"></i> ' . __( 'EXPERIENCE Slide '. $i .' Settings', 'gogalapagos' ),
                'post_types' => array('page'),
                'context'    => 'normal',
                'priority'   => 'high',
                'fields' => array(
                    array(
                        'name' => 'Title (h1)',
                        'id' => $prefix . 'homepage_fold_h1'. $i,
                        'type' => 'text',
                        'std' => 'Enjoy',
                        'attributes' => array(
                            'class' => 'gogalapagos-field'
                        )
                    ),
                    array(
                        'name' => 'Paragraph (p)',
                        'id' => $prefix . 'homepage_fold_subtitle'. $i,
                        'type' => 'textarea',
                        'attributes' => array(
                            'class' => 'gogalapagos-field'
                        )
                    ),
                    array(
                        'name' => '<i class="fa fa-image"></i> Background Image',
                        'id' => $prefix . 'homepage_fold_slide_background_image'. $i,
                        'type' => 'file_input',
                    ),
                )
            );
            $i++;
        }
        $meta_boxes[] = array(
            'id'         => 'home_posts_special_offers',
            'title'      => '<i class="fa fa-certificate"></i> ' . __( 'Special Offers Section Settings', 'gogalapagos' ),
            'post_types' => array('page'),
            'context'    => 'normal',
            'priority'   => 'high',
            'fields' => array(
                array(
                    'name' => 'Special Offer',
                    'id' => $prefix . 'front_page_special_offers',
                    'type' => 'post',
                    'post_type' => 'ggspecialoffer',
                    'field_type' => 'select',
                    'query_args' => array(
                        'orderby' => 'ID',
                        'order' => 'ASC',
                    ),
                    'clone' => true,
                    'sort_clone' => true,
                    'add_button' => '+ Add another Special Offer',
                ),
            )
        );  
        $meta_boxes[] = array(
            'id'         => 'home_posts_blog',
            'title'      => '<i class="fa fa-newspaper-o"></i> ' . __( 'Blog Posts Section Settings', 'gogalapagos' ),
            'post_types' => array('page'),
            'context'    => 'normal',
            'priority'   => 'high',
            'fields' => array(
                array(
                    'name' => 'Blog Post',
                    'id' => $prefix . 'page_template_ship_id',
                    'type' => 'post',
                    'post_type' => 'post',
                    'field_type' => 'select',
                    'query_args' => array(
                        'orderby' => 'ID',
                        'order' => 'ASC',
                    ),
                    'clone' => true,
                    'sort_clone' => true,
                    'max_clone' => 4,
                    'add_button' => '+ Add another Blog Post',
                ),
            )
        );  
    }

    // METABOXES PAGINA WHY GALAPAGOS
    if($current_post->post_name == 'why-galapagos'){
        $i = 1;
        $whyGalapagosnumberofsections = get_option('gg_why_galapagos_sections');
        while ($i <= $whyGalapagosnumberofsections){
            $meta_boxes[] = array(
                'id'         => 'why_galapagos_page_'. $i,
                'title'      => '<i class="fa fa-desktop"></i> ' . __( 'Why Galapagos Section '. $i .' Settings', 'gogalapagos' ),
                'post_types' => array('page'),
                'context'    => 'normal',
                'priority'   => 'high',
                'fields' => array(
                    array(
                        'name' => 'Title (h2)',
                        'id' => $prefix . 'why_galapagos_section_h2_'. $i,
                        'type' => 'text',
                        'std' => 'Enjoy',
                        'attributes' => array(
                            'class' => 'gogalapagos-field'
                        ),
                    ),
                    array(
                        'name' => 'Paragraph (p)',
                        'id' => $prefix . 'why_galapagos_section_content_'. $i,
                        'type' => 'wysiwyg',
                        'attributes' => array(
                            'class' => 'gogalapagos-field'
                        ),
                        'std' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem placeat, voluptatum ab quibusdam veritatis provident voluptatibus nobis repudiandae exercitationem necessitatibus molestiae quod numquam ea dolorum rerum laboriosam voluptates minus enim.'
                    ),
                    array(
                        'name' => 'Menu Link (a)',
                        'id' => $prefix . 'why_galapagos_section_link_'. $i,
                        'type' => 'url',
                    ),
                    array(
                        'name' => '<i class="fa fa-image"></i> Right Side Image',
                        'id' => $prefix . 'why_galapagos_section_image_'. $i,
                        'type' => 'file_input',
                    ),
                )
            );
            $i++;
        }
    }
    // METABOXES PARA LAS PAGINAS DE LOS ITINERARIOS.
    if ($current_post->post_name == 'galapagos-legend-itineraries' or $current_post->post_name == 'coral-yachts-itineraries'){
        // META BOXES para las páginas de presentacion de Itinerarios
        $meta_boxes[] = array(
            'id'         => 'page_features',
            'title'      => '<span style="color: red;"><i class="dashicons dashicons-welcome-view-site"></i> ' . __( 'Itinerary Page Setting ', 'gogalapagos' ).'</span>',
            'post_types' => array('page'),
            'context'    => 'side',
            'priority'   => 'high',
            'fields' => array(
                array(
                    'name' => 'Assign Ship',
                    'id' => $prefix . 'page_template_ship_id',
                    'type' => 'post',
                    'post_type' => 'ggships',
                    'field_type' => 'select',
                    'query_args' => array(
                        'orderby' => 'ID',
                        'order' => 'ASC',
                    ),
                    'desc' => __('<span style="color: red;">Just for Itineraries templates only</span>','gogalapagos'),
                ),
            )
        );     
    }
    if ($current_post->post_name == 'go-galapagos-cruises'){
        // Seccion informacion tecnica y de seguridad
        $meta_boxes[] = array(
            'id'         => 'services_facilities',
            'title'      => '<i class="dashicons dashicons-editor-table"></i> ' . __( 'Ship Services and Facilities', 'gogalapagos' ),
            'post_types' => array('page'),
            'context'    => 'normal',
            'priority'   => 'high',
            'fields' => array(
                array(
                    'id' => $prefix . 'ship_facilities_onboard',
                    'name' => '<i class="dashicons dashicons-admin-plugins"></i> ' . esc_html__( 'Onboard', 'gogalapagos' ),
                    'type' => 'text',
                    'attributes' => array(
                        'class' => 'gogalapagos-field'
                    ),
                    'clone' => true,
                    'sort_clone' => true,
                    'std' => true,
                ),
                array(
                    'id' => $prefix . 'ship_facilities_cabin',
                    'name' => '<i class="dashicons dashicons-admin-plugins"></i> ' . esc_html__( 'Cabin', 'gogalapagos' ),
                    'type' => 'text',
                    'attributes' => array(
                        'class' => 'gogalapagos-field'
                    ),
                    'clone' => true,
                    'sort_clone' => true,
                )
            )
        );
        $meta_boxes[] = array(
            'id'         => 'galapagos_cruises_crew',
            'title'      => '<i class="dashicons dashicons-editor-table"></i> ' . __( 'Crew &amp; Guides', 'gogalapagos' ),
            'post_types' => array('page'),
            'context'    => 'normal',
            'priority'   => 'high',
            'fields' => array(
                array(
                    'id' => $prefix . 'galapagos_cruises_crew_title',
                    'name' => '<i class="dashicons dashicons-admin-plugins"></i> ' . esc_html__( 'Section title', 'gogalapagos' ),
                    'type' => 'text',
                    'attributes' => array(
                        'class' => 'gogalapagos-field'
                    ),
                ),
                array(
                    'id' => $prefix . 'galapagos_cruises_crew_image',
                    'name' => '<i class="dashicons dashicons-admin-plugins"></i> ' . esc_html__( 'Featured Image', 'gogalapagos' ),
                    'type' => 'file_input',
                ),
                array(
                    'id' => $prefix . 'galapagos_cruises_crew_content',
                    'name' => '<i class="dashicons dashicons-admin-plugins"></i> ' . esc_html__( 'Content', 'gogalapagos' ),
                    'type' => 'textarea',
                    'attributes' => array(
                        'class' => 'gogalapagos-field'
                    ),
                )
            )
        );
        $meta_boxes[] = array(
            'id'         => 'galapagos_cruises_eco_luxury',
            'title'      => '<i class="dashicons dashicons-editor-table"></i> ' . __( 'Eco Luxury', 'gogalapagos' ),
            'post_types' => array('page'),
            'context'    => 'normal',
            'priority'   => 'high',
            'fields' => array(
                array(
                    'id' => $prefix . 'galapagos_cruises_eco_title',
                    'name' => '<i class="dashicons dashicons-admin-plugins"></i> ' . esc_html__( 'Section title', 'gogalapagos' ),
                    'type' => 'text',
                    'attributes' => array(
                        'class' => 'gogalapagos-field'
                    ),
                ),
                array(
                    'id' => $prefix . 'galapagos_cruises_eco_image',
                    'name' => '<i class="dashicons dashicons-admin-plugins"></i> ' . esc_html__( 'Featured Image', 'gogalapagos' ),
                    'type' => 'file_input',
                ),
                array(
                    'id' => $prefix . 'galapagos_cruises_eco_content',
                    'name' => '<i class="dashicons dashicons-admin-plugins"></i> ' . esc_html__( 'Content', 'gogalapagos' ),
                    'type' => 'textarea',
                    'attributes' => array(
                        'class' => 'gogalapagos-field'
                    ),
                )
            )
        );
        $meta_boxes[] = array(
            'id'         => 'galapagos_cruises_after_content',
            'title'      => '<i class="dashicons dashicons-editor-table"></i> ' . __( 'Folder main content', 'gogalapagos' ),
            'post_types' => array('page'),
            'context'    => 'normal',
            'priority'   => 'high',
            'fields' => array(
                array(
                    'id' => $prefix . 'galapagos_cruises_after_content',
                    'name' => '<i class="dashicons dashicons-admin-plugins"></i> ' . esc_html__( 'Content', 'gogalapagos' ),
                    'type' => 'wysiwyg',
                    'attributes' => array(
                        'class' => 'gogalapagos-field'
                    ),
                )
            )
        );

    }
    // META BOXES para los barcos

    // Seccion HERO
    $meta_boxes[] = array(
        'id'         => 'ship_info',
        'title'      => '<i class="dashicons dashicons-welcome-view-site"></i> ' . __( 'Ship Hero Page information', 'gogalapagos' ),
        'post_types' => 'ggships',
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(
            array(
                'name'  => '<i class="dashicons dashicons-format-image"></i> ' . __( 'Logo', 'gogalapagos' ),
                'desc'  => 'Note: Upload or Select a PNG format image.',
                'id'    => $prefix . 'ship_logo',
                'type'  => 'file_input',
                'mime_type' => 'png',
                'max_file_uploads' => 1,
            ),
            array(
                'name'  => '<i class="dashicons dashicons-edit"></i> ' . __( 'Slogan', 'gogalapagos' ),
                'desc'  => 'Note: This field is for alphanumeric only.',
                'id'    => $prefix . 'ship_slogan',
                'type'  => 'text',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
            ),
            /*array(
                'name'  => '<i class="dashicons dashicons-edit"></i> ' . __( 'Hero Short Description', 'gogalapagos' ),
                'id'    => $prefix . 'ship_description',
                'type'  => 'wysiwyg',
                'class' => ' translatethis',
            ),*/
            array(
                'name'  => '<i class="dashicons dashicons-admin-links"></i> ' . __( 'Video file URL', 'gogalapagos' ),
                'id'    => $prefix . 'ship_videourl',
                'type'  => 'text',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
            ),
            array(
                'name'  => '<i class="dashicons dashicons-format-image"></i> ' . __( 'Ship Image', 'gogalapagos' ),
                'desc'  => 'Note: this field is for the Book Now URL, please contact with Support.',
                'id'    => $prefix . 'ship_fold_picture',
                'type'  => 'file_input',
                'mime_type' => 'png',
                'max_file_uploads' => 1,
                'desc'  => 'Note: Upload or Select a PNG format image.',
            ),
            array(
                'name'  => '<i class="dashicons dashicons-format-image"></i> ' . __( 'Ship Page Banner', 'gogalapagos' ),
                'id'    => $prefix . 'ship_fold_bkg',
                'type'  => 'file_input',
                'mime_type' => 'png',
                'max_file_uploads' => 1,
                'desc'  => 'Note: Upload or Select a PNG format image.',
            ),
            array(
                'name'  => '<i class="dashicons dashicons-format-image"></i> ' . __( 'Ship lower fold background', 'gogalapagos' ),
                'id'    => $prefix . 'ship_fold_lower_bkg',
                'type'  => 'file_input',
                'mime_type' => 'png',
                'max_file_uploads' => 1,
                'desc'  => 'Note: Upload or Select a PNG format image.',
            ),
            array(
                'name'  => '<i class="dashicons dashicons-admin-links"></i> ' . __( 'Book Now URL', 'gogalapagos' ),
                'desc'  => 'Note: this field is for the Book Now URL, please contact with Support.',
                'id'    => $prefix . 'ship_bookurl',
                'type'  => 'url',
            )
        )
    );
    /*
    // Seccion Cabinas
    $meta_boxes[] = array(
        'id'         => 'ship_info_cabins',
        'title'      => '<i class="dashicons dashicons-editor-table"></i> ' . __( 'Cabins section information', 'gogalapagos' ),
        'post_types' => 'ggships',
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(
            array(
                'id' => $prefix . 'ship_section_cabins_active',
                'name' => '<i class="dashicons dashicons-visibility"></i> ' . esc_html__( 'Active on page?', 'gogalapagos' ),
                'type' => 'checkbox',
                'desc' => esc_html__( 'Note: Disable if you do not want this section to show on page structure.', 'gogalapagos' ),
                'std' => true,
            ),
            array(
                'id' => $prefix . 'ship_section_cabins_title',
                'type' => 'text',
                'name' => '<i class="dashicons dashicons-editor-bold"></i> ' . esc_html__( 'Cabins section title', 'gogalapagos' ),
                'std' => 'Ship Cabins',
                'class' => ' translatethis',
            ),
            array(
                'id' => $prefix . 'ship_section_cabins_description',
                'name' => '<i class="dashicons dashicons-edit"></i> ' . esc_html__( 'Cabins Section Description', 'gogalapagos' ),
                'type' => 'wysiwyg',
                'desc' => esc_html__( 'Note: Write a description for this section, you can use wordpress components or html with css code', 'gogalapagos' ),
                'raw' => true,
                'class' => ' translatethis',
            ),

        )
    );
    */
    /*
    // Seccion Areas Sociales
    $meta_boxes[] = array(
        'id'         => 'ship_info_socialareas',
        'title'      => '<i class="dashicons dashicons-editor-table"></i> ' . __( 'Social Areas section information', 'gogalapagos' ),
        'post_types' => 'ggships',
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(
            array(
                'id' => $prefix . 'ship_section_socialareas_active',
                'name' => '<i class="dashicons dashicons-visibility"></i> ' . esc_html__( 'Active on page?', 'gogalapagos' ),
                'type' => 'checkbox',
                'desc' => esc_html__( 'Note: Disable if you do not want this section to show on page structure.', 'gogalapagos' ),
                'std' => true,
            ),
            array(
                'id' => $prefix . 'ship_section_socialareas_title',
                'type' => 'text',
                'name' => '<i class="dashicons dashicons-editor-bold"></i> ' . esc_html__( 'Social Area section title', 'gogalapagos' ),
                'std' => esc_html__( 'Social Areas', 'gogalapagos' ),
                'class' => 'translatethis',
            ),
            array(
                'id' => $prefix . 'ship_section_socialareas_description',
                'name' => '<i class="dashicons dashicons-edit"></i> ' . esc_html__( 'Social Area Section Description', 'gogalapagos' ),
                'type' => 'wysiwyg',
                'desc' => esc_html__( 'Note: Write a description for this section, you can use wordpress components or html with css code', 'gogalapagos' ),
                'raw' => true,
                'class' => 'translatethis',
            ),
        )
    );
    */

    // Seccion 360 Tour
    $meta_boxes[] = array(
        'id'         => 'ship_info_360',
        'title'      => '<i class="dashicons dashicons-editor-table"></i> ' . __( '360 Virtual Tour section information', 'gogalapagos' ),
        'post_types' => 'ggships',
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(
            /*array(
                'id' => $prefix . 'ship_section_360_active',
                'name' => '<i class="dashicons dashicons-visibility"></i> ' . esc_html__( 'Active on page?', 'gogalapagos' ),
                'type' => 'checkbox',
                'desc' => esc_html__( 'Note: Disable if you do not want this section to show on page structure.', 'gogalapagos' ),
                'std' => true,
            ),
            array(
                'id' => $prefix . 'ship_section_360_title',
                'type' => 'text',
                'name' => '<i class="dashicons dashicons-editor-bold"></i> ' . esc_html__( '360 Virtual Tour section title', 'gogalapagos' ),
                'class' => ' translatethis',
            ),
            array(
                'name'  => '<i class="dashicons dashicons-format-image"></i> ' . __( 'Section Background Image', 'gogalapagos' ),
                'desc'  => 'Note: Upload or Select a JPG format image.',
                'id'    => $prefix . '360_backgroundimage',
                'type'  => 'file_input',
                'mime_type' => 'jpg',
                'max_file_uploads' => 1,
            ),*/
            array(
                'id' => $prefix . 'ship_section_360_link',
                'type' => 'text',
                'name' => '<i class="dashicons dashicons-admin-links"></i> ' . esc_html__( '360 Virtual Tour section link', 'gogalapagos' ),
                'desc' => __( 'Note: this field is for the 360 Virtual Tour URL. <strong>Please contact to Support Office</strong>', 'gogalapagos' ),
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
            ),
        )
    );

    $meta_boxes[] = array(
        'id'         => 'ship_extended',
        'title'      => '<i class="dashicons dashicons-editor-table"></i> ' . __( 'Extended Cruises Itineraries Images', 'gogalapagos' ),
        'post_types' => 'ggships',
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(
            array(
                'name'  => '<i class="dashicons dashicons-format-image"></i> ' . __( 'Extended AB', 'gogalapagos' ),
                'id'    => $prefix . 'ship_extended_img_ab',
                'type'  => 'file_input',
                'mime_type' => 'png',
                'max_file_uploads' => 1,
                'desc'  => 'Note: Upload or Select a PNG format image.',
            ),
            array(
                'name'  => '<i class="dashicons dashicons-format-image"></i> ' . __( 'Extended BC', 'gogalapagos' ),
                'id'    => $prefix . 'ship_extended_img_bc',
                'type'  => 'file_input',
                'mime_type' => 'png',
                'max_file_uploads' => 1,
                'desc'  => 'Note: Upload or Select a PNG format image.',
            ),
            array(
                'name'  => '<i class="dashicons dashicons-format-image"></i> ' . __( 'Extended CD', 'gogalapagos' ),
                'id'    => $prefix . 'ship_extended_img_cd',
                'type'  => 'file_input',
                'mime_type' => 'png',
                'max_file_uploads' => 1,
                'desc'  => 'Note: Upload or Select a PNG format image.',
            ),
            array(
                'name'  => '<i class="dashicons dashicons-format-image"></i> ' . __( 'Extended DA', 'gogalapagos' ),
                'id'    => $prefix . 'ship_extended_img_da',
                'type'  => 'file_input',
                'mime_type' => 'png',
                'max_file_uploads' => 1,
                'desc'  => 'Note: Upload or Select a PNG format image.',
            ),
        )
    );

    /*
    // Seccion Itineraries
    $meta_boxes[] = array(
        'id'         => 'ship_info_itineraries',
        'title'      => '<i class="dashicons dashicons-editor-table"></i> ' . __( 'Itineraries section information', 'gogalapagos' ),
        'post_types' => 'ggships',
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(
            array(
                'id' => $prefix . 'ship_section_itineraries_active',
                'name' => '<i class="dashicons dashicons-visibility"></i> ' . esc_html__( 'Active on page?', 'gogalapagos' ),
                'type' => 'checkbox',
                'desc' => esc_html__( 'Note: Disable if you do not want this section to show on page structure.', 'gogalapagos' ),
                'std' => true,
            ),
            array(
                'id' => $prefix . 'ship_section_itineraries_title',
                'type' => 'text',
                'name' => '<i class="dashicons dashicons-editor-bold"></i> ' . esc_html__( 'Itineraries section title', 'gogalapagos' ),
                'std' => esc_html__( 'Itineraries', 'gogalapagos' ),
                'class' => ' translatethis',
            ),
        )
    );
    */
    /*
    // Seccion Activities
    $meta_boxes[] = array(
        'id'         => 'ship_info_activities',
        'title'      => '<i class="dashicons dashicons-editor-table"></i> ' . __( 'Activities section information', 'gogalapagos' ),
        'post_types' => 'ggships',
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(
            array(
                'id' => $prefix . 'ship_section_activities_active',
                'name' => '<i class="dashicons dashicons-visibility"></i> ' . esc_html__( 'Active on page?', 'gogalapagos' ),
                'type' => 'checkbox',
                'desc' => esc_html__( 'Note: Disable if you do not want this section to show on page structure.', 'gogalapagos' ),
                'std' => true,
            ),
            array(
                'id' => $prefix . 'ship_section_activities_title',
                'type' => 'text',
                'name' => '<i class="dashicons dashicons-editor-bold"></i> ' . esc_html__( 'Activities section title', 'gogalapagos' ),
                'std' => esc_html__( 'Activities', 'gogalapagos' ),
                'class' => ' translatethis',
            ),
            array(
                'id' => $prefix . 'ship_section_activities_description',
                'name' => '<i class="dashicons dashicons-edit"></i> ' . esc_html__( 'Activities Section content', 'gogalapagos' ),
                'type' => 'wysiwyg',
                'desc' => esc_html__( 'Note: Write a description for this section, you can use wordpress components or html with css code', 'gogalapagos' ),
                'raw' => true,
                'class' => 'translatethis',
            ),
        )
    );
    */
    // Seccion informacion tecnica y de seguridad
    $meta_boxes[] = array(
        'id'         => 'ship_info_techandsec',
        'title'      => '<i class="dashicons dashicons-editor-table"></i> ' . __( 'Technical and Secutiry section information', 'gogalapagos' ),
        'post_types' => 'ggships',
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(
            /*array(
                'id' => $prefix . 'ship_section_techandsec_active',
                'name' => '<i class="dashicons dashicons-visibility"></i> ' . esc_html__( 'Active on page?', 'gogalapagos' ),
                'type' => 'checkbox',
                'desc' => esc_html__( 'Note: Disable if you do not want this section to show on page structure.', 'gogalapagos' ),
                'std' => true,
            ),*/
            array(
                'id' => $prefix . 'ship_section_tech_info_title',
                'type' => 'wysiwyg',
                'name' => '<i class="dashicons dashicons-editor-edit"></i> ' . esc_html__( 'Ship Name', 'gogalapagos' ),
                'type' => 'text',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
            ),
            array(
                'id' => $prefix . 'ship_section_sec_info',
                'type' => 'wysiwyg',
                'name' => '<i class="dashicons dashicons-editor-edit"></i> ' . esc_html__( 'Security Information Content', 'gogalapagos' ),
                'type' => 'textarea',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'rows' => 8
            ),
            array(
                'id' => $prefix . 'ship_section_tech_info',
                'type' => 'wysiwyg',
                'name' => '<i class="dashicons dashicons-editor-edit"></i> ' . esc_html__( 'Technical Information Content', 'gogalapagos' ),
                'type' => 'text',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'clone' => true,
                'sort_clone' => true,
            ),
            /*array(
                'id' => $prefix . 'ship_section_security_info',
                'name' => '<i class="dashicons dashicons-edit"></i> ' . esc_html__( 'Security Information Content', 'gogalapagos' ),
                'type' => 'wysiwyg',
                'desc' => esc_html__( 'Note: Write a description for this section, you can use wordpress components or html with css code', 'gogalapagos' ),
                'raw' => true,
                'class' => 'translatethis',
            ),*/
        )
    );
    // Seccion informacion tecnica y de seguridad
    $meta_boxes[] = array(
        'id'         => 'ship_info_techandsec_2',
        'title'      => '<i class="dashicons dashicons-editor-table"></i> ' . __( 'Technical and Secutiry section information Second Ship - <span style="color: darkorange;">use only if necessary</span>', 'gogalapagos' ),
        'post_types' => 'ggships',
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(
            /*array(
                'id' => $prefix . 'ship_section_techandsec_active',
                'name' => '<i class="dashicons dashicons-visibility"></i> ' . esc_html__( 'Active on page?', 'gogalapagos' ),
                'type' => 'checkbox',
                'desc' => esc_html__( 'Note: Disable if you do not want this section to show on page structure.', 'gogalapagos' ),
                'std' => true,
            ),*/
            array(
                'id' => $prefix . 'ship_section_tech_info_title_second',
                'type' => 'wysiwyg',
                'name' => '<i class="dashicons dashicons-editor-edit"></i> ' . esc_html__( 'Ship Name', 'gogalapagos' ),
                'type' => 'text',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
            ),
            array(
                'id' => $prefix . 'ship_section_tech_info_second',
                'type' => 'wysiwyg',
                'name' => '<i class="dashicons dashicons-editor-edit"></i> ' . esc_html__( 'Technical Information Content', 'gogalapagos' ),
                'type' => 'text',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'clone' => true,
                'sort_clone' => true,
            ),
            /*array(
                'id' => $prefix . 'ship_section_security_info',
                'name' => '<i class="dashicons dashicons-edit"></i> ' . esc_html__( 'Security Information Content', 'gogalapagos' ),
                'type' => 'wysiwyg',
                'desc' => esc_html__( 'Note: Write a description for this section, you can use wordpress components or html with css code', 'gogalapagos' ),
                'raw' => true,
                'class' => 'translatethis',
            ),*/
        )
    );

    $meta_boxes[] = array(
        'id'         => 'ship_home_image',
        'title'      => '<i class="dashicons dashicons-paperclip"></i> ' . __( 'Home Image', 'gogalapagos' ),
        'post_types' => 'ggships',
        'context'    => 'side',
        'priority'   => 'low',
        'fields' => array(
            array(
                'id' => $prefix . 'ship_home_image',
                'name' => '<i class="fa fa-image"></i> ' . esc_html__( 'Select Home Image', 'gogalapagos' ),
                'type' => 'file_input',
            ),
            array(
                'id' => $prefix . 'ship_wiki_image',
                'name' => '<i class="fa fa-image"></i> ' . esc_html__( 'Select Wiki Menu Image', 'gogalapagos' ),
                'type' => 'file_input',
            )
        )
    ); 

    $meta_boxes[] = array(
        'id'         => 'ship_gruop_id',
        'title'      => '<i class="fa fa-cog"></i> ' . __( 'Dispo metadata', 'gogalapagos' ),
        'post_types' => 'ggships',
        'context'    => 'side',
        'priority'   => 'high',
        'fields' => array(
            array(
                'id' => $prefix . 'ship_group_code',
                'name' => '<i class="fa fa-cog"></i> ' . esc_html__( 'Dispo Group Code', 'gogalapagos' ),
                'type' => 'text',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
            ),
            array(
                'id' => $prefix . 'ship_capacity',
                'name' => '<i class="fa fa-users"></i> ' . esc_html__( 'Ship Capacity', 'gogalapagos' ),
                'type' => 'text',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
            )
        )
    );

    /*

    // Datos para la DISPO(web service) 
    /*
    $meta_boxes[] = array(
        'id'         => 'ship_info_dispo_webservice',
        'title'      => '<i class="dashicons dashicons-paperclip"></i> ' . __( 'Kleintours Dispo System', 'gogalapagos' ),
        'post_types' => 'ggships',
        'context'    => 'side',
        'priority'   => 'low',
        'fields' => array(
            array(
                'id' => $prefix . 'ship_dispo_ID',
                'name' => '<i class="dashicons dashicons-arrow-right"></i> ' . esc_html__( 'Dispo Ship Code', 'gogalapagos' ),
                'type' => 'text',
                'desc' => esc_html__( 'This items allows to connect this info with the Dispo System, SET TO UPPERCASE. Please confirm with Kleintour System Department. ', 'gogalapagos' ),
            )
        )
    ); /*
    /*
    // Demas secciones
    $meta_boxes[] = array(
        'id'         => 'ship_info_alter_sections',
        'title'      => '<i class="dashicons dashicons-editor-table"></i> ' . __( 'More Sections..', 'gogalapagos' ),
        'post_types' => 'ggships',
        'context'    => 'side',
        'priority'   => 'low',
        'fields' => array(
            array(
                'id' => $prefix . 'ship_section_extended_cruises_active',
                'name' => '<i class="dashicons dashicons-visibility"></i> ' . esc_html__( 'Extended Cruises active on page?', 'gogalapagos' ),
                'type' => 'checkbox',
                'desc' => esc_html__( 'Note: Disable if you do not want this section to show on page structure.', 'gogalapagos' ),
                'std' => true,
            ),
            array(
                'id' => $prefix . 'ship_section_plan_your_trip_active',
                'name' => '<i class="dashicons dashicons-visibility"></i> ' . esc_html__( 'Plan Your Trip active on page?', 'gogalapagos' ),
                'type' => 'checkbox',
                'desc' => esc_html__( 'Note: Disable if you do not want this section to show on page structure.', 'gogalapagos' ),
                'std' => true,
            ),
            array(
                'id' => $prefix . 'ship_show_download_brochure',
                'name' => '<i class="dashicons dashicons-visibility"></i> ' . esc_html__( 'Show download Brochure?', 'gogalapagos' ),
                'type' => 'checkbox',
                'desc' => esc_html__( 'Note: Disable if you do not want this section to show on page structure.', 'gogalapagos' ),
                'std' => true,
            )
        )
    );
    */
    // METABOXES para los decks, las Cabinas y areas sociales
    $meta_boxes[] = array(
        'title'      => __( '<i class="fa fa-ship" aria-hidden="true"></i> Wordpress DATA', 'gogalapagos' ),
        'post_types' => 'ggcabins',
        'fields'     => array(
            array(
                'name' => 'Assign Parent Ship',
                'id' => $prefix . 'cabin_ship_id',
                'type' => 'post',
                'post_type' => 'ggships',
                'field_type' => 'select',
                'query_args' => array(
                    'orderby' => 'ID',
                    'order' => 'ASC',
                ),
                'desc' => __('If not selected, this cabin won\'t show on website','gogalapagos'),
            ),
        ),
        'context' => 'side',
        'priority' => 'high'
    );
    $meta_boxes[] = array(
        'title'      => __( '<i class="fa fa-ship" aria-hidden="true"></i> Eligos DATA', 'gogalapagos' ),
        'post_types' => 'ggcabins',
        'fields'     => array(
            array(
                'name' => 'WordPress Parent Ship',
                'id' => $prefix . 'cabin_ship_id',                
                'type' => 'text',
                'attributes' => array(
                    'class' => 'eligos-field'
                ),                
                'readonly'  => $disabled,
            ),
            array(
                'name' => 'ELIGOS Cabin ID',
                'id' => $prefix . 'cabin_eligos_id',                
                'type' => 'text',
                'attributes' => array(
                    'class' => 'eligos-field'
                ), 
                'readonly'  => $disabled,
            ),
            array(
                'name' => 'ELIGOS Ship CODE',
                'id' => $prefix . 'cabin_eligos_ship_code',                
                'type' => 'text',
                'attributes' => array(
                    'class' => 'eligos-field'
                ), 
                'readonly'  => $disabled,
            ),
            array(
                'name' => 'Dispo CODE',
                'id' => $prefix . 'dispo_ID',
                'type' => 'text',
                'attributes' => array(
                    'class' => 'eligos-field'
                ),
                'maxlength' => 10,
                'readonly' => $disabled
            ),
            array(
                'name' => 'ELIGOS Cabin CODE',
                'id' => $prefix . 'cabin_eligos_code',                
                'type' => 'text',
                'attributes' => array(
                    'class' => 'eligos-field'
                ), 
                'readonly'  => $disabled,
            ),            
            array(
                'name' => 'Year ID',
                'id' => $prefix . 'cabin_year_id',
                'type' => 'text',
                'attributes' => array(
                    'class' => 'eligos-field'
                ), 
                'readonly'  => $disabled,
            ),            
            array(
                'name' => 'Year',
                'id' => $prefix . 'cabin_year',
                'type' => 'text',
                'attributes' => array(
                    'class' => 'eligos-field'
                ), 
                'readonly'  => $disabled,
            )
        ),
        'context' => 'side',
    );
    $meta_boxes[] = array(
        'title'      => __( 'Ship\'s Deck', 'gogalapagos' ),
        'post_types' => 'ggcabins',
        'fields'     => array(
            array(
                'name' => 'Assign Ship\'s Deck',
                'id' => $prefix . 'cabin_decks_location',
                'type' => 'post',
                'post_type' => 'ggdecks',
                'field_type' => 'checkbox_list',
                /*'query_args' => array(

                    ),*/
                'desc' => __('If not checked, this cabin won\'t show on website','gogalapagos'),
            ),
        ),
        'context' => 'side',
    );
    $meta_boxes[] = array(
        'title'      => __( 'Cabin category Color', 'gogalapagos' ),
        'post_types' => 'ggcabins',
        'fields'     => array(
            array(
                'name' => 'Set Cabin Category color',
                'id' => $prefix . 'cabin_category_color',
                'type' => 'color',
                'alpha_channel' => false,
                'desc' => __('If not set, it will be gray','gogalapagos'),
            ),
        ),
        'context' => 'side',
    );
    $meta_boxes[] = array(
        'title'      => __( 'More...', 'gogalapagos' ),
        'post_types' => 'ggcabins',
        'fields'     =>
        array(
            array(
                'name' => 'General Specifycations',
                'id' => $prefix . 'cabin_featurelist',
                'type' => 'text',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'clone' => true,
                'sort_clone' => true,
                'desc' => __('Please specify feartures one by one','gogalapagos'),
                'class' => ' translatethis'
            ),
            array(
                'name' => 'Cabin deck(s) location image',
                'id' => $prefix . 'cabin_deck_location_image',
                'type'  => 'file_input',
                'mime_type' => 'png',
                'max_file_uploads' => 1,
                'desc' => __('If not checked, this cabin won\'t show on website','gogalapagos'),
            ),
            array(
                'name' => 'Plains Render Images',
                'id' => $prefix . 'cabin_render',
                'type' => 'image_advanced',
                /*'clone' => true,
                    'sort_clone' => true,*/
                'desc' => __('If not checked, this cabin won\'t show on website','gogalapagos'),
            )
            /*array(
                'name' => 'Gallery Images',
                'id' => $prefix . 'cabin_gallery',
                'type' => 'image_advanced',
                'clone' => true,
                    'sort_clone' => true,
                'desc' => __('If not checked, this cabin won\'t show on website','gogalapagos'),
            )*/
        )
    );
    $meta_boxes[] = array(
        'title'      => __( '<i class="fa fa-ship" aria-hidden="true"></i> Parent Ship', 'gogalapagos' ),
        'post_types' => 'ggdecks',
        'fields'     => array(
            array(
                'name' => 'Assign Parent Ship',
                'id' => $prefix . 'deck_ship_id',
                'type' => 'post',
                'post_type' => 'ggships',
                'field_type' => 'select',
                'query_args' => array(
                    'orderby' => 'ID',
                    'order' => 'ASC',
                ),
                'desc' => __('If not selected, this cabin won\'t show on website','gogalapagos'),
            ),
        ),
        'context' => 'side',
    );
    $meta_boxes[] = array(
        'title'      => __( '<i class="dashicons dashicons-format-image"></i> Deck Location', 'gogalapagos' ),
        'post_types' => 'ggdecks',
        'fields'     => array(
            array(
                'name' => 'Deck Location Images',
                'id' => $prefix . 'deck_location_image',
                'type'  => 'file_input',
                'mime_type' => 'png',
                'max_file_uploads' => 1,
                'desc'  => 'Note: Upload or Select a PNG format image.',
            )
        ),
        'context' => 'side',
    );
    $meta_boxes[] = array(
        'title'      => __( '<i class="dashicons dashicons-format-image"></i> Deck Plan', 'gogalapagos' ),
        'post_types' => 'ggdecks',
        'fields'     => array(
            array(
                'name' => 'Deck Plan Image',
                'id' => $prefix . 'deck_plan_image',
                'type'  => 'file_input',
                'mime_type' => 'png',
                'max_file_uploads' => 1,
                'desc'  => 'Note: Upload or Select a PNG format image.',
            )
        ),
        'context' => 'side',
    );
    $meta_boxes[] = array(
        'title'      => __( '<i class="dashicons dashicons-media-document"></i> Deck Plan PDF', 'gogalapagos' ),
        'post_types' => 'ggdecks',
        'fields'     => array(
            array(
                'name' => 'Deck Plan PDF document',
                'id' => $prefix . 'deck_plan_pdf',
                'type'  => 'file_input',
                'mime_type' => 'pdf',
                'max_file_uploads' => 1,
                'desc'  => 'Note: Upload or Select a PDF format document.',
            )
        ),
        'context' => 'side',
    );
    $meta_boxes[] = array(
        'title'      => __( 'Frontend Name', 'gogalapagos' ),
        'post_types' => 'ggdecks',
        'fields'     =>
        array(
            array(
                'name' => '<i class="dashicons dashicons-editor-textcolor"></i> Frontend Name',
                'id' => $prefix . 'deck_frontend_name',
                'type' => 'text',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'desc' => __('If not set, this item won\'t show on website','gogalapagos'),
            )
        )
    );
    $meta_boxes[] = array(
        'title'      => __( 'Deck Gallery', 'gogalapagos' ),
        'post_types' => 'ggdecks',
        'fields'     =>
        array(
            array(
                'name' => '<i class="dashicons dashicons-format-image"></i> Gallery Images',
                'id' => $prefix . 'deck_gallery',
                'type' => 'image_advanced',
                'sort_clone' => true,
                'desc' => __('If not checked, this cabin won\'t show on website','gogalapagos'),
            )
        )
    );

    //Metaboxes para Areas Sociales
    $meta_boxes[] = array(
        'title'      => __( 'Parent Ship', 'gogalapagos' ),
        'post_types' => 'ggsocialarea',
        'fields'     => array(
            array(
                'name' => 'Assign Parent Ship',
                'id' => $prefix . 'social_ship_id',
                'type' => 'post',
                'post_type' => 'ggships',
                'field_type' => 'select',
                /*'query_args' => array(

                    ),*/
                'desc' => __('If not checked, this social area won\'t show on website','gogalapagos'),
            ),
        ),
        'context' => 'side',
    );
    $meta_boxes[] = array(
        'title'      => __( 'Social Area Gallery', 'gogalapagos' ),
        'post_types' => 'ggsocialarea',
        'fields'     =>
        array(
            array(
                'name' => '<i class="dashicons dashicons-format-image"></i> Gallery Images',
                'id' => $prefix . 'social_gallery',
                'type' => 'image_advanced',
            )
        )
    );
    $meta_boxes[] = array(
        'title'      => __( 'Set frontend template', 'gogalapagos' ),
        'post_types' => array('ggsocialarea','ggactivity'),
        'fields'     => array(
            array(
                'name' => '<i class="dashicons dashicons-schedule"></i> Frontend Template',
                'id' => $prefix . 'social_template',
                'type' => 'select',
                'options' => array(
                    '1' => 'Image left smaller',
                    '2' => 'Image left bigger'
                )
            )
        ),
        'context' => 'side',
    );
    $meta_boxes[] = array(
        'title'      => __( 'Ship\'s Deck', 'gogalapagos' ),
        'post_types' => 'ggsocialarea',
        'fields'     => array(
            array(
                'name' => 'Assign Ship\'s Deck',
                'id' => $prefix . 'cabin_decks_location',
                'type' => 'post',
                'post_type' => 'ggdecks',
                'field_type' => 'select',
                /*'query_args' => array(

                    ),*/
                'desc' => __('If not checked, this cabin won\'t show on website','gogalapagos'),
            ),
        ),
        'context' => 'side',
    );

    //Metaboxes para itinerarios
    $meta_boxes[] = array(
        'title'      => __( '<i class="fa fa-ship" aria-hidden="true"></i> Parent Ship', 'gogalapagos' ),
        'post_types' => 'ggitineraries',
        'fields'     => array(
            array(
                'name' => 'Assign Parent Ship',
                'id' => $prefix . 'itinerary_ship_id',
                'type' => 'post',
                'post_type' => 'ggships',
                'field_type' => 'select',
                'query_args' => array(
                    'orderby' => 'ID',
                    'order' => 'ASC',
                ),
                'desc' => __('If not selected, this itinerary won\'t show on frontend','gogalapagos'),
            ),
        ),
        'validation' => array(
            'rules'  => array(
                'field_id' => array(
                    'required'  => true,
                    // More rules here
                ),
                // Rules for other fields
            ),
        ),
        'context' => 'side',
        'priority' => 'high'
    );
    $meta_boxes[] = array(
        'title'      => __( '<i class="fa fa-paint-brush" aria-hidden="true"></i> Itinerary Color', 'gogalapagos' ),
        'post_types' => 'ggitineraries',
        'fields'     => array(
            array(
                'name' => 'Select color',
                'id' => $prefix . 'itinerary_frontend_color',
                'type' => 'color',
                'alpha_channel' => false,
                'desc' => __('If not selected, this itinerary won\'t show on frontend','gogalapagos'),
            ),
        ),
        'context' => 'side',
    );
    $anios = [];
    $anioInicial = date('Y');
    for( $i = 0; $i < 5; $i++ ){
        $anios[$anioInicial + $i] = $anioInicial + $i;
    }

    $meta_boxes[] = array(
        'title'      => __( '<i class="fa fa-calendar" aria-hidden="true"></i> Operation Year', 'gogalapagos' ),
        'post_types' => 'ggitineraries',
        'fields'     => array(
            array(
                'name' => 'Set year',
                'id' => $prefix . 'itinerary_year',
                'type' => 'select',
                'options' => $anios
            ),
        ),
        'context' => 'side',
        'priority' => 'high'
    );
    $meta_boxes[] = array(
        'title'      => __( '<i class="fa fa-history" aria-hidden="true"></i> Duration', 'gogalapagos' ),
        'post_types' => 'ggitineraries',
        'fields'     => array(
            array(
                'name' => 'Select a day',
                'id' => $prefix . 'itinerary_duration',
                'type' => 'select',
                'placeholder' => _x('Please select...','gogalapagos'),
                'options' => array(
                    '4' => _x('4 Days / 3 Nights','gogalapagos'),
                    '5' => _x('5 Days / 4 Nights','gogalapagos'),
                ),
                'desc' => __('If not selected this itinerary won\'t show on frontend','gogalapagos'),
            ),
        ),
        'context' => 'side',
    );
    $meta_boxes[] = array(
        'title'      => __( '<i class="fa fa-play" aria-hidden="true"></i> Start Day', 'gogalapagos' ),
        'post_types' => 'ggitineraries',
        'fields'     => array(
            array(
                'name' => 'Select a day',
                'id' => $prefix . 'itinerary_start_day',
                'type' => 'select',
                'placeholder' => _x('Please select...','gogalapagos'),
                'options' => array(
                    '0' => _x('Monday','gogalapagos'),
                    '1' => _x('Tuesday','gogalapagos'),
                    '2' => _x('Wednesday','gogalapagos'),
                    '3' => _x('Thrusday','gogalapagos'),
                    '4' => _x('Friday','gogalapagos'),
                    '5' => _x('Saturday','gogalapagos'),
                    '6' => _x('Sunday','gogalapagos'),
                ),
                'desc' => __('If not selected, this itinerary won\'t show on frontend','gogalapagos'),
            ),
        ),
        'context' => 'side',
    );
    $meta_boxes[] = array(
        'title'      => __( '<i class="fa fa-globe" aria-hidden="true"></i> Itinerary Route Image', 'gogalapagos' ),
        'post_types' => 'ggitineraries',
        'fields'     => array(
            array(
                'name' => 'Upload the itinerary map image',
                'id' => $prefix . 'itinerary_route_image',
                'type'  => 'file_input',
                'mime_type' => 'png',
                'max_file_uploads' => 1,
                'desc' => __('If not set, this itinerary won\'t show on frontend','gogalapagos'),
            ),
        ),
        'context' => 'side',
    );
    $meta_boxes[] = array(
        'title'      => __( '<i class="fa fa-eye" aria-hidden="true"></i> Animals likely to be seen', 'gogalapagos' ),
        'post_types' => array('ggitineraries', 'gglocation'),
        'fields'     => array(
            array(
                'name' => 'Animals list',
                'id' => $prefix . 'itinerary_animal_list',
                'type' => 'post',
                'post_type' => 'gganimal',
                'field_type' => 'checkbox_list',
                'query_args' => array(
                    'orderby' => 'ID',
                    'order' => 'ASC',
                ),
                'desc' => __('If not selected, this itinerary won\'t show on frontend','gogalapagos'),
            ),
        ),
        'context' => 'side',
    );
    $meta_boxes[] = array(
        'title'      => __( '<i class="fa fa-font" aria-hidden="true"></i> Itinerary Single Name', 'gogalapagos' ),
        'post_types' => 'ggitineraries',
        'fields'     => array(
            array(
                'name' => 'Name',
                'id' => $prefix . 'itinerary_single_name',
                'type' => 'text',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'desc' => __('This name will be shown as the tab name.','gogalapagos'),
            ),
        ),
        'validation' => array(
            'rules'  => array(
                $prefix . 'itinerary_single_name' => array(
                    'required'  => true,
                    // More rules here
                ),
                // Rules for other fields
            ),
        ),
        'context' => 'normal',
    );

    $items_sugerencias = array(
        'baston'        => 'Baston',
        'bloqueador'    => 'Bloqueador Solar',
        'botas'         => 'Botas',
        'botella'       => 'Agua Mineral Embotellada',
        'camara'        => 'Camara',
        'chaqueta'      => 'Chaqueta',
        'lentes'        => 'Lentes de Sol',
        'repelente'     => 'Repelente',
        'short'         => 'Short',
        'snorkel'       => 'Snorkel',
        'sombrero'      => 'Sombrero',
        'traje'         => 'Traje',
    );

    $meta_boxes[] = array(
        'title'      => __( '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Pax Sugerencias', 'gogalapagos' ),
        'post_types' => 'ggitineraries',
        'fields'     => array(
            array(
                'name'    => 'Item Sugerido',
                'id'      => $prefix . 'pax_sugerencia',
                'type'    => 'checkbox_list',
                // Options of checkboxes, in format 'value' => 'Label'
                'options' => $items_sugerencias,
                'inline' => true,
                'select_all_none' => true,
            ),
        ),
        'validation' => array(
            'rules'  => array(
                $prefix . 'pax_sugerencia' => array(
                    'required'  => true,
                    // More rules here
                ),
                // Rules for other fields
            ),
        ),
        'context' => 'normal',
    );


    $duracion  = get_post_meta($post_ID, $prefix . 'itinerary_duration', true);

    for ($i = 1; $i <= $duracion; $i++){

        $mostrarAm = $mostrarPm = array(
            'type' => 'divider',
        );

        if($i == 1 /*|| $i == $duracion*/){
            $mostrarAm = array(
                'name' => 'AM Places list - Extended Only',
                'id' => $prefix . 'itinerary_am_activities_list_extended_day_' . $i,
                'type' => 'post',
                'post_type' => 'gglocation',
                'field_type'  => 'select_advanced',
                'clone' => true,
                'sort_clone' => true,
                'placeholder' => _x('Please select...','gogalapagos'),
                'add_button' => '+ Add another item',
                'desc' => __('If not set, this activity won\'t show on frontend. Drag n\' Drop to sort the list. If item is a link, copy entire link.','gogalapagos'),
            );

            $mostrarPm = array(
                'name' => 'PM Places list - Extended Only',
                'id' => $prefix . 'itinerary_pm_activities_list_extended_day_' . $i,
                'type' => 'post',
                'post_type' => 'gglocation',
                'field_type'  => 'select_advanced',
                'clone' => true,
                'sort_clone' => true,
                'placeholder' => _x('Please select...','gogalapagos'),
                'add_button' => '+ Add another item',
                'desc' => __('If not set, this activity won\'t show on frontend. Drag n\' Drop to sort the list. If item is a link, copy entire link.','gogalapagos'),
            );
        }


        $meta_boxes[] = array(
            'title'      => __( '<i class="fa fa-list-ul" aria-hidden="true"></i> Itinery Day by Day - Day ', 'gogalapagos' ) . $i,
            'post_types' => 'ggitineraries',
            'fields'     => array(
                array(
                    'name' => 'Day active?',
                    'id' => $prefix . 'itinerary_active_day_' . $i,
                    'type' => 'checkbox',
                    'desc' => '<span class="text-danger">' . __('If not checked, this day won\'t show on frontend','gogalapagos') . '</span>',
                ),
                array(
                    'name' => 'Day Featured Image',
                    'id' => $prefix . 'itinerary_featured_image_day_' . $i,
                    'type' => 'image_advanced',
                    'placeholder' => _x('Please select...','gogalapagos'),
                ),
                array(
                    'name' => 'Day description',
                    'id' => $prefix . 'itinerary_description_day_' . $i,
                    'type' => 'textarea',
                    'attributes' => array(
                        'class' => 'gogalapagos-field'
                    ),
                ),
                array(
                    'name' => 'AM Places list',
                    'id' => $prefix . 'itinerary_am_activities_list_day_' . $i,
                    'type' => 'post',
                    'post_type' => 'gglocation',
                    'field_type'  => 'select_advanced',
                    'clone' => true,
                    'sort_clone' => true,
                    'placeholder' => _x('Please select...','gogalapagos'),
                    'add_button' => '+ Add another item',
                    'desc' => __('If not set, this activity won\'t show on frontend. Drag n\' Drop to sort the list. If item is a link, copy entire link.','gogalapagos'),
                ),
                $mostrarAm,
                array(
                    'name' => 'PM Places list',
                    'id' => $prefix . 'itinerary_pm_activities_list_day_' . $i,
                    'type' => 'post',
                    'post_type' => 'gglocation',
                    'field_type'  => 'select_advanced',
                    'clone' => true,
                    'sort_clone' => true,
                    'placeholder' => _x('Please select...','gogalapagos'),
                    'add_button' => '+ Add another item',
                    'desc' => __('If not set, this activity won\'t show on frontend. Drag n\' Drop to sort the list. If item is a link, copy entire link.','gogalapagos'),
                ),
                $mostrarPm
            ),
            'validation' => array(
                'rules'  => array(
                    $prefix . 'itinerary_am_activities_list_day_' . $i => array(
                        'required'  => true,
                    ),
                    $prefix . 'itinerary_pm_activities_list_day_' . $i => array(
                        'required'  => true,
                    ),
                ),
            ),
            'context' => 'normal',
        );

    } //END for day by day

    /*
    $meta_boxes[] = array(
        'title'      => __( '<i class="fa fa-list-ul" aria-hidden="true"></i> Itinery Day by Day - Day 2', 'gogalapagos' ),
        'post_types' => 'ggitineraries',
        'fields'     => array(
            array(
                'name' => 'Day active?',
                'id' => $prefix . 'itinerary_active_day_2',
                'type' => 'checkbox',
                'desc' => '<span class="text-danger">' . __('If not checked, this day won\'t show on frontend','gogalapagos') . '</span>',
            ),
            array(
                'name' => 'Day Featured Image',
                'id' => $prefix . 'itinerary_featured_image_day_2',
                'type' => 'image_advanced',
                'placeholder' => _x('Please select...','gogalapagos'),
                'desc' => __('If not selected, this itinerary won\'t show on frontend','gogalapagos'),
            ),
            array(
                'name' => 'Day description',
                'id' => $prefix . 'itinerary_description_day_2',
                'type' => 'textarea',
                'desc' => __('If not selected, this itinerary won\'t show on frontend','gogalapagos'),
            ),
            array(
                'name' => 'AM Places list',
                'id' => $prefix . 'itinerary_am_activities_list_day_2',
                'type' => 'post',
                'post_type' => 'gglocation',
                'field_type'  => 'select_advanced',
                'clone' => true,
                'sort_clone' => true,
                'placeholder' => _x('Please select...','gogalapagos'),
                'add_button' => '+ Add another item',
                'desc' => __('If not set, this activity won\'t show on frontend. Drag n\' Drop to sort the list. If item is a link, copy entire link.','gogalapagos'),
            ),
            array(
                'name' => 'PM Places list',
                'id' => $prefix . 'itinerary_pm_activities_list_day_2',
                'type' => 'post',
                'post_type' => 'gglocation',
                'field_type'  => 'select_advanced',
                'clone' => true,
                'sort_clone' => true,
                'placeholder' => _x('Please select...','gogalapagos'),
                'add_button' => '+ Add another item',
                'desc' => __('If not set, this activity won\'t show on frontend. Drag n\' Drop to sort the list. If item is a link, copy entire link.','gogalapagos'),
            ),
        ),
        'validation' => array(
            'rules'  => array(
                $prefix . 'itinerary_active_day_2' => array(
                    'required'  => true,
                ),
                $prefix . 'itinerary_am_activities_list_day_2' => array(
                    'required'  => true,
                ),
                $prefix . 'itinerary_pm_activities_list_day_2' => array(
                    'required'  => true,
                ),
            ),
        ),
        'context' => 'normal',
    );
    $meta_boxes[] = array(
        'title'      => __( '<i class="fa fa-list-ul" aria-hidden="true"></i> Itinery Day by Day - Day 3', 'gogalapagos' ),
        'post_types' => 'ggitineraries',
        'fields'     => array(
            array(
                'name' => 'Day active?',
                'id' => $prefix . 'itinerary_active_day_3',
                'type' => 'checkbox',
                'desc' => '<span class="text-danger">' . __('If not checked, this day won\'t show on frontend','gogalapagos') . '</span>',
            ),
            array(
                'name' => 'Day Featured Image',
                'id' => $prefix . 'itinerary_featured_image_day_3',
                'type' => 'image_advanced',
                'placeholder' => _x('Please select...','gogalapagos'),
                'desc' => __('If not selected, this itinerary won\'t show on frontend','gogalapagos'),
            ),
            array(
                'name' => 'Day description',
                'id' => $prefix . 'itinerary_description_day_3',
                'type' => 'textarea',
                'desc' => __('If not selected, this itinerary won\'t show on frontend','gogalapagos'),
            ),
            array(
                'name' => 'AM Places list',
                'id' => $prefix . 'itinerary_am_activities_list_day_3',
                'type' => 'post',
                'post_type' => 'gglocation',
                'field_type'  => 'select_advanced',
                'clone' => true,
                'sort_clone' => true,
                'placeholder' => _x('Please select...','gogalapagos'),
                'add_button' => '+ Add another item',
                'desc' => __('If not set, this activity won\'t show on frontend. Drag n\' Drop to sort the list. If item is a link, copy entire link.','gogalapagos'),
            ),
            array(
                'name' => 'PM Places list',
                'id' => $prefix . 'itinerary_pm_activities_list_day_3',
                'type' => 'post',
                'post_type' => 'gglocation',
                'field_type'  => 'select_advanced',
                'clone' => true,
                'sort_clone' => true,
                'placeholder' => _x('Please select...','gogalapagos'),
                'add_button' => '+ Add another item',
                'desc' => __('If not set, this activity won\'t show on frontend. Drag n\' Drop to sort the list. If item is a link, copy entire link.','gogalapagos'),
            ),
        ),
        'validation' => array(
            'rules'  => array(
                $prefix . 'itinerary_active_day_3' => array(
                    'required'  => true,
                ),
                $prefix . 'itinerary_am_activities_list_day_3' => array(
                    'required'  => true,
                ),
                $prefix . 'itinerary_pm_activities_list_day_3' => array(
                    'required'  => true,
                ),
            ),
        ),
        'context' => 'normal',
    );
    $meta_boxes[] = array(
        'title'      => __( '<i class="fa fa-list-ul" aria-hidden="true"></i> Itinery Day by Day - Day 4', 'gogalapagos' ),
        'post_types' => 'ggitineraries',
        'fields'     => array(
            array(
                'name' => 'Day active?',
                'id' => $prefix . 'itinerary_active_day_4',
                'type' => 'checkbox',
                'desc' => '<span class="text-danger">' . __('If not checked, this day won\'t show on frontend','gogalapagos') . '</span>',
            ),
            array(
                'name' => 'Day Featured Image',
                'id' => $prefix . 'itinerary_featured_image_day_4',
                'type' => 'image_advanced',
                'placeholder' => _x('Please select...','gogalapagos'),
                'desc' => __('If not selected, this itinerary won\'t show on frontend','gogalapagos'),
            ),
            array(
                'name' => 'Day description',
                'id' => $prefix . 'itinerary_description_day_4',
                'type' => 'textarea',
                'desc' => __('If not selected, this itinerary won\'t show on frontend','gogalapagos'),
            ),
            array(
                'name' => 'AM Places list',
                'id' => $prefix . 'itinerary_am_activities_list_day_4',
                'type' => 'post',
                'post_type' => 'gglocation',
                'field_type'  => 'select_advanced',
                'clone' => true,
                'sort_clone' => true,
                'placeholder' => _x('Please select...','gogalapagos'),
                'add_button' => '+ Add another item',
                'desc' => __('If not set, this activity won\'t show on frontend. Drag n\' Drop to sort the list. If item is a link, copy entire link.','gogalapagos'),
            ),
            array(
                'name' => 'PM Places list',
                'id' => $prefix . 'itinerary_pm_activities_list_day_4',
                'type' => 'post',
                'post_type' => 'gglocation',
                'field_type'  => 'select_advanced',
                'clone' => true,
                'sort_clone' => true,
                'placeholder' => _x('Please select...','gogalapagos'),
                'add_button' => '+ Add another item',
                'desc' => __('If not set, this activity won\'t show on frontend. Drag n\' Drop to sort the list. If item is a link, copy entire link.','gogalapagos'),
            ),
        ),
        'validation' => array(
            'rules'  => array(
                $prefix . 'itinerary_active_day_4' => array(
                    'required'  => true,
                ),                                                              
                $prefix . 'itinerary_am_activities_list_day_4' => array(
                    'required'  => true,
                ),
                $prefix . 'itinerary_pm_activities_list_day_4' => array(
                    'required'  => true,
                ),
            ),
        ),
        'context' => 'normal',
    );
    $meta_boxes[] = array(
        'title'      => __( '<i class="fa fa-list-ul" aria-hidden="true"></i> Itinery Day by Day - Day 5', 'gogalapagos' ),
        'post_types' => 'ggitineraries',
        'fields'     => array(
            array(
                'name' => 'Day active?',
                'id' => $prefix . 'itinerary_active_day_5',
                'type' => 'checkbox',
                'desc' => '<span class="text-danger">' . __('If not checked, this day won\'t show on frontend','gogalapagos') . '</span>',
            ),
            array(
                'name' => 'Day Featured Image',
                'id' => $prefix . 'itinerary_featured_image_day_5',
                'type' => 'image_advanced',
                'placeholder' => _x('Please select...','gogalapagos'),
                'desc' => __('If not selected, this itinerary won\'t show on frontend','gogalapagos'),
            ),
            array(
                'name' => 'Day description',
                'id' => $prefix . 'itinerary_description_day_5',
                'type' => 'textarea',
                'desc' => __('If not selected, this itinerary won\'t show on frontend','gogalapagos'),
            ),
            array(
                'name' => 'AM Places list',
                'id' => $prefix . 'itinerary_am_activities_list_day_5',
                'type' => 'post',
                'post_type' => 'gglocation',
                'field_type'  => 'select_advanced',
                'size' => '100%',
                'clone' => true,
                'sort_clone' => true,
                'placeholder' => _x('Please select...','gogalapagos'),
                'add_button' => '+ Add another location',
                'desc' => __('If not set, this activity won\'t show on frontend. Drag n\' Drop to sort the list. If item is a link, copy entire link.','gogalapagos'),
            ),
            array(
                'name' => 'PM Places list',
                'id' => $prefix . 'itinerary_pm_activities_list_day_5',
                'type' => 'post',
                'post_type' => 'gglocation',
                'field_type'  => 'select_advanced',
                'size' => '100%',
                'clone' => true,
                'sort_clone' => true,
                'placeholder' => _x('Please select...','gogalapagos'),
                'add_button' => '+ Add another location',
                'desc' => __('If not set, this activity won\'t show on frontend. Drag n\' Drop to sort the list. If item is a link, copy entire link.','gogalapagos'),
            ),
        ),
        'context' => 'normal',
    );
    */
    // Metaboxes para Locaciones
    $meta_boxes[] = array(
        'title'      => __( '<i class="fa fa-list-ul" aria-hidden="true"></i> Visitor\'s Site Island', 'gogalapagos' ),
        'post_types' => 'gglocation',
        'fields'     => array(
            array(
                'name' => 'Select the island',
                'id' => $prefix . 'visitors_site_island',
                'type' => 'post',
                'post_type' => 'ggisland',
                'field_type' => 'select',
            )
        ),
        'context' => 'side',
    );
    $meta_boxes[] = array(
        'title'      => __( '<i class="fa fa-list-ul" aria-hidden="true"></i> Visitor\'s Site featured information', 'gogalapagos' ),
        'post_types' => 'gglocation',
        'fields'     => array(
            array(
                'name' => 'Disembarking',
                'id' => $prefix . 'visitors_site_disembarking',
                'type' => 'select',
                'options'         => array(
                    '0' => 'None',
                    '1' => 'Dry Landing',
                    '2' => 'Wet Landing',
                    '3' => 'Dry or Wet Landing',
                    '4' => 'Circumnavigation',
                ),
                'multiple' => true,
                'placeholder' => _x('Please select...','gogalapagos'),
                'desc' => __('If not set, this item won\'t show on frontend. Drag n\' Drop to sort the list. If item is a link, copy entire link.','gogalapagos'),
            ),
            array(
                'name' => 'Type of Terrain',
                'id' => $prefix . 'visitors_site_terrain',
                'type' => 'select',
                'options'         => array(
                    '0' => 'None',
                    '1' => 'Eroded Tuff',
                    '2' => 'Flat',
                    '3' => 'Flat & Muddy',
                    '4' => 'Flat & Petrified Lava',
                    '5' => 'Flat & Sandy',
                    '6' => 'Flat & Semi-rocky',
                    '7' => 'Hill/mountain',
                    '8' => 'Marsh',
                    '9' => 'Muddy',
                    '10' => 'Petrified Lava',
                    '11' => 'Rocky',
                    '12' => 'Rocky & Petrified Lava',
                    '13' => 'Rocky & Sandy',
                    '14' => 'Sandy',
                    '15' => 'Shallow Ocean',
                    '16' => 'Slippery',
                    '17' => 'Steep',
                    '18' => 'Steep & Petrified Lava',
                    '19' => 'Water',
                    '20' => 'Wooden Trail',
                ),
                'multiple' => true,
                'placeholder' => _x('Please select...','gogalapagos'),
                'desc' => __('If not set, this item won\'t show on frontend. Drag n\' Drop to sort the list. If item is a link, copy entire link.','gogalapagos'),
            ),
            /*array(
                'name' => 'Difficulty Level',
                'id' => $prefix . 'visitors_site_difficulty',
                'type' => 'select',
                'options'         => array(
                    '0' => 'Low',
                    '1' => 'High',
                    '2' => 'Intermediate',
                    '3' => 'Easy',
                    '4' => 'Moderate',
                    '5' => 'Difficult'
                ),
                'multiple' => true,
                'placeholder' => _x('Please select...','gogalapagos'),
                'desc' => __('If not set, this item won\'t show on frontend. Drag n\' Drop to sort the list. If item is a link, copy entire link.','gogalapagos'),
            ),*/
            array(
                'name' => 'Physical Conditions Required',
                'id' => $prefix . 'visitors_site_physical',
                'type' => 'select',
                'options'         => array(
                    '0' => 'Low',
                    '1' => 'High',
                    '2' => 'Medium',
                    '3' => 'Medium / High',
                ),
                'multiple' => true,
                'placeholder' => _x('Please select...','gogalapagos'),
                'desc' => __('If not set, this item won\'t show on frontend. Drag n\' Drop to sort the list. If item is a link, copy entire link.','gogalapagos'),
            ),
            array(
                'name' => 'Duration',
                'id' => $prefix . 'visitors_site_duration',
                'type' => 'textarea',
                'attributes' => array(
                        'class' => 'gogalapagos-field'
                    ),
                'desc' => __('If not set, this item won\'t show on frontend. Drag n\' Drop to sort the list. If item is a link, copy entire link.','gogalapagos'),
            ),
            array(
                'name' => 'Highlights',
                'id' => $prefix . 'visitors_site_highlights',
                'type' => 'textarea',
                'attributes' => array(
                        'class' => 'gogalapagos-field'
                    ),
                'desc' => __('If not set, this item won\'t show on frontend. Drag n\' Drop to sort the list. If item is a link, copy entire link.','gogalapagos'),
            )
        ),
        'context' => 'normal',
    );
    $meta_boxes[] = array(
        'title'      => __( '<i class="fa fa-list-ul" aria-hidden="true"></i> Visitor\'s Site Recommendations', 'gogalapagos' ),
        'post_types' => 'gglocation',
        'fields'     => array(
            array(
                'name' => 'Select the island',
                'id' => $prefix . 'visitors_site_recomendation',
                'type' => 'checkbox_list',
                'options' => $items_sugerencias,
                'inline' => true,
                'select_all_none' => true,
            )
        ),
    );
    $meta_boxes[] = array(
        'title'      => __( '<i class="fa fa-list-ul" aria-hidden="true"></i> Visitor\'s Site Gallery', 'gogalapagos' ),
        'post_types' => 'gglocation',
        'fields'     => array(
            array(
                'name' => 'Image List',
                'id' => $prefix . 'visitors_site_gallery',
                'type' => 'image_advanced',
                'clone' => true,
                'sort_clone' => true,
                'desc' => __('If not set, this activity won\'t show on frontend. Drag n\' Drop to sort the list. If item is a link, copy entire link.','gogalapagos'),
            )
        ),
        'context' => 'normal',
    );

    // Metaboxes para Animales
    $meta_boxes[] = array(
        'title'      => __( 'Featured Information', 'gogalapagos' ),
        'post_types' => 'gganimal',
        'fields'     => array(
            array(
                'name' => 'Scientific name',
                'id' => $prefix . 'scientific_name',
                'type' => 'text',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
            ),
            array(
                'name' => 'Size',
                'id' => $prefix . 'animal_size',
                'type' => 'text',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
            ),
            array(
                'name' => 'Weight',
                'id' => $prefix . 'animal_weight',
                'type' => 'text',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
            ),
            array(
                'name' => 'Map Location Image',
                'id' => $prefix . 'animal_location_map',
                'type' => 'image_advanced',
                'max' => 1
            ),
            array(
                'name' => 'Google Map LAT/LONG',
                'id' => $prefix . 'gmap_coords',
                'type' => 'text',
                'clone' => true,
                'desc' => 'SET THE LATTITUDE AND LONGITUDE, SEPARATED WITH A COMA'
            )
        ),
        'context' => 'normal',
    );
    $meta_boxes[] = array(
        'title'      => __( '<i class="fa fa-list-ul" aria-hidden="true"></i> Animal Gallery', 'gogalapagos' ),
        'post_types' => 'gganimal',
        'fields'     => array(
            array(
                'name' => 'Icon Image',
                'id' => $prefix . 'animal_icon',
                'type' => 'image_advanced',
                'desc' => __('If not set, this activity won\'t show on frontend. Drag n\' Drop to sort the list. If item is a link, copy entire link.','gogalapagos'),
            ),
            array(
                'name' => 'Image List',
                'id' => $prefix . 'animal_gallery',
                'type' => 'image_advanced',
                'clone' => true,
                'sort_clone' => true,
                'desc' => __('If not set, this activity won\'t show on frontend. Drag n\' Drop to sort the list. If item is a link, copy entire link.','gogalapagos'),
            )
        ),
        'context' => 'normal',
    );
    // metaboxes para islas
    $meta_boxes[] = array(
        'title'      => __( '<i class="fa fa-list-ul" aria-hidden="true"></i> Island Featured Information', 'gogalapagos' ),
        'post_types' => 'ggisland',
        'fields'     => array(
            array(
                'name' => 'Image List',
                'id' => $prefix . 'island_gallery',
                'type' => 'image_advanced',
                'clone' => true,
                'sort_clone' => true,
                'desc' => __('If not set, this activity won\'t show on frontend. Drag n\' Drop to sort the list. If item is a link, copy entire link.','gogalapagos'),
            ),
            array(
                'name' => 'Map Location Image',
                'id' => $prefix . 'island_location_map',
                'type' => 'image_advanced',
                'max' => 1
            ),
            array(
                'name' => 'Google Maps Location',
                'id' => $prefix . 'island_location',
                'type' => 'text',
            )
        ),
        'context' => 'normal',
    );
    $meta_boxes[] = array(
        'title'      => __( '<i class="fa fa-list-ul" aria-hidden="true"></i> Activity on this island', 'gogalapagos' ),
        'post_types' => 'ggisland',
        'fields'     => array(
            array(
                'name' => 'Activity list',
                'id' => $prefix . 'island_activity_list',
                'type' => 'post',
                'post_type' => 'ggactivity',
                'field_type' => 'checkbox_list',
                'query_args' => array(
                    'orderby' => 'ID',
                    'order' => 'ASC',
                ),
                'desc' => __('If not selected, this itinerary won\'t show on frontend','gogalapagos'),
            ),
        ),
        'context' => 'side',
    );
    // Metaboxes para Actividades
    $meta_boxes[] = array(
        'title'      => __( '<i class="fa fa-list-ul" aria-hidden="true"></i> Activity Gallery', 'gogalapagos' ),
        'post_types' => 'ggactivity',
        'fields'     => array(
            array(
                'name' => 'Image List',
                'id' => $prefix . 'activity_gallery',
                'type' => 'image_advanced',
            )
        ),
        'context' => 'normal',
    );
    $meta_boxes[] = array(
        'title'      => __( '<i class="fa fa-ship" aria-hidden="true"></i> Parent Ship', 'gogalapagos' ),
        'post_types' => 'ggactivity',
        'fields'     => array(
            array(
                'name' => 'Assign Parent Ship',
                'id' => $prefix . 'activity_ship_id',
                'type' => 'post',
                'post_type' => 'ggships',
                'field_type' => 'checkbox_list',
                'query_args' => array(
                    'orderby' => 'ID',
                    'order' => 'ASC',
                ),
            ),
        ),
        'context' => 'side',
    );
    // Metaboxes para Tours
    $meta_boxes[] = array(
        'title'      => '<i class="fa fa-list-ul" aria-hidden="true"></i> ' . __( 'Tour Featured Information', 'gogalapagos' ),
        'post_types' => array('ggtour', 'ggpackage', 'ggsatour'),
        'fields'     => array(
            array(
                'name' => 'Dispo CODE',
                'id' => $prefix . 'dispo_code',
                'type' => 'text',
                'attributes' => array(
                    'class' => 'eligos-field'
                ),
                'maxlength' => 10,
                'readonly' => true
            ),
            array(
                'name' => 'Price / $ - From',
                'id' => $prefix . 'tour_price',
                'type' => 'number',
                'step' => '0,2',
                'disabled' => $disabled
            ),
            array(
                'name' => 'Package Map .png',
                'id' => $prefix . 'package_map',
                'type' => 'image_advanced',
            ),
            array(
                'name' => 'Services Ammount',
                'id' => $prefix . 'package_service_ammount',
                'type' => 'number',                
            )           
        ),
        'context' => 'side',
    );

    //wp_get_current_user();
    // Metaboxes para Go Packages
    $meta_boxes[] = array(
        'title'      => '<i class="fa fa-list-ul" aria-hidden="true"></i> ' . __( 'Show Go Package', 'gogalapagos' ),
        'post_types' => array('ggpackage'),
        'fields'     => array(
            array(
                'name' => 'Switch Active',
                'id' => $prefix . 'activate_go_package',
                'type' => 'switch',
                'style' => 'rounded',
                'on_label' => 'Shown',
                'off_label' => 'Hidden',
                'desc' => 'If is active this package will be public on the web.'
            )
        ),
        'priority' => 'high',
        'context' => 'side',
    );
    $meta_boxes[] = array(
        'title'      => '<i class="fa fa-list-ul" aria-hidden="true"></i> ' . __( 'Services group container 1', 'gogalapagos' ),
        'post_types' => array('ggpackage'),
        'fields'     => array(
            array(
                'name' => 'Services Group Title',
                'id' => $prefix . 'service_group_title_1',
                'type' => 'text',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'placeholder' => 'Type a short title',
                'desc' => 'This content will appear in the boucher information'
            ),
            array(
                'name' => 'Minimun Duration',
                'id' => $prefix . 'service_group_duration_1',
                'type' => 'number',
                'max' => 20,
                'min' => 1,
                'std' => 1,
                'desc' => 'This content will appear in the website'
            ),
            array(
                'name' => 'Services Description',
                'id' => $prefix . 'service_group_description_1',
                'type' => 'textarea',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'desc' => 'This content will appear in the website, <span style="color: darkorange; font-weight: bold;">If this item has an alternative, please complete the next section</span>'
            ),
            array(
                'name' => 'Meals Included',
                'id' => $prefix . 'pack_includes_1',
                'type' => 'checkbox_list',
                'inline' => true,
                'select_all_none' => true,
                'options' => array(
                    'B' => 'Breakfast',
                    'BL' => 'Box Lunch',
                    'L' => 'Lunch',
                    'D' => 'Dinner'
                )
            ),
            array(
                'type' => 'divider',
            ),
            array(
                'name' => '<span style="color: darkorange; font-weight: bold;">Alter Services Group Title</span>',
                'id' => $prefix . 'service_group_title_alter_1',
                'type' => 'text',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'placeholder' => 'Type a short title',
                'desc' => 'This content will appear in the boucher information'
            ),
            array(
                'name' => '<span style="color: darkorange; font-weight: bold;">Alter Services Description</span>',
                'id' => $prefix . 'service_group_description_alter_1',
                'type' => 'textarea',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'desc' => 'This content will appear in the website, <span style="color: green; font-weight: bold;">Please complete this items to show on website and boucher</span>'
            ),
        ),
        'priority' => 'high',
        'context' => 'normal',
    );
    $meta_boxes[] = array(
        'title'      => '<i class="fa fa-list-ul" aria-hidden="true"></i> ' . __( 'Services group container 2', 'gogalapagos' ),
        'post_types' => array('ggpackage'),
        'fields'     => array(
            array(
                'name' => 'Services Group Title',
                'id' => $prefix . 'service_group_title_2',
                'type' => 'text',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'placeholder' => 'Type a short title',
                'desc' => 'This content will appear in the boucher information'
            ),
            array(
                'name' => 'Minimun Duration',
                'id' => $prefix . 'service_group_duration_2',
                'type' => 'number',
                'max' => 20,
                'min' => 1,
                'std' => 1,
                'desc' => 'This content will appear in the website'
            ),
            array(
                'name' => 'Services Description',
                'id' => $prefix . 'service_group_description_2',
                'type' => 'textarea',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'desc' => 'This content will appear in the website, <span style="color: darkorange; font-weight: bold;">If this item has an alternative, please complete the next section</span>'
            ),
            array(
                'name' => 'Meals Included',
                'id' => $prefix . 'pack_includes_2',
                'type' => 'checkbox_list',
                'inline' => true,
                'select_all_none' => true,
                'options' => array(
                    'B' => 'Breakfast',
                    'BL' => 'Box Lunch',
                    'L' => 'Lunch',
                    'D' => 'Dinner'
                )
            ),
            array(
                'type' => 'divider',
            ),
            array(
                'name' => '<span style="color: darkorange; font-weight: bold;">Alter Services Group Title</span>',
                'id' => $prefix . 'service_group_title_alter_2',
                'type' => 'text',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'placeholder' => 'Type a short title',
                'desc' => 'This content will appear in the boucher information'
            ),
            array(
                'name' => '<span style="color: darkorange; font-weight: bold;">Alter Services Description</span>',
                'id' => $prefix . 'service_group_description_alter_2',
                'type' => 'textarea',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'desc' => 'This content will appear in the website, <span style="color: green; font-weight: bold;">Please complete this items to show on website and boucher</span>'
            ),
        ),
        'priority' => 'high',
        'context' => 'normal',
    );
    $meta_boxes[] = array(
        'title'      => '<i class="fa fa-list-ul" aria-hidden="true"></i> ' . __( 'Services group container 3', 'gogalapagos' ),
        'post_types' => array('ggpackage'),
        'fields'     => array(
            array(
                'name' => 'Services Group Title',
                'id' => $prefix . 'service_group_title_3',
                'type' => 'text',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'placeholder' => 'Type a short title',
                'desc' => 'This content will appear in the boucher information'
            ),
            array(
                'name' => 'Minimun Duration',
                'id' => $prefix . 'service_group_duration_3',
                'type' => 'number',
                'max' => 20,
                'min' => 1,
                'std' => 1,
                'desc' => 'This content will appear in the website'
            ),
            array(
                'name' => 'Services Description',
                'id' => $prefix . 'service_group_description_3',
                'type' => 'textarea',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'desc' => 'This content will appear in the website, <span style="color: darkorange; font-weight: bold;">If this item has an alternative, please complete the next section</span>'
            ),
            array(
                'name' => 'Meals Included',
                'id' => $prefix . 'pack_includes_3',
                'type' => 'checkbox_list',
                'inline' => true,
                'select_all_none' => true,
                'options' => array(
                    'B' => 'Breakfast',
                    'BL' => 'Box Lunch',
                    'L' => 'Lunch',
                    'D' => 'Dinner'
                )
            ),
            array(
                'type' => 'divider',
            ),
            array(
                'name' => '<span style="color: darkorange; font-weight: bold;">Alter Services Group Title</span>',
                'id' => $prefix . 'service_group_title_alter_3',
                'type' => 'text',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'placeholder' => 'Type a short title',
                'desc' => 'This content will appear in the boucher information'
            ),
            array(
                'name' => '<span style="color: darkorange; font-weight: bold;">Alter Services Description</span>',
                'id' => $prefix . 'service_group_description_alter_3',
                'type' => 'textarea',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'desc' => 'This content will appear in the website, <span style="color: green; font-weight: bold;">Please complete this items to show on website and boucher</span>'
            ),
        ),
        'priority' => 'high',
        'context' => 'normal',
    );
    $meta_boxes[] = array(
        'title'      => '<i class="fa fa-list-ul" aria-hidden="true"></i> ' . __( 'Services group container 4', 'gogalapagos' ),
        'post_types' => array('ggpackage'),
        'fields'     => array(
            array(
                'name' => 'Services Group Title',
                'id' => $prefix . 'service_group_title_4',
                'type' => 'text',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'placeholder' => 'Type a short title',
                'desc' => 'This content will appear in the boucher information'
            ),
            array(
                'name' => 'Minimun Duration',
                'id' => $prefix . 'service_group_duration_4',
                'type' => 'number',
                'max' => 20,
                'min' => 1,
                'std' => 1,
                'desc' => 'This content will appear in the website'
            ),
            array(
                'name' => 'Services Description',
                'id' => $prefix . 'service_group_description_4',
                'type' => 'textarea',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'desc' => 'This content will appear in the website, <span style="color: darkorange; font-weight: bold;">If this item has an alternative, please complete the next section</span>'
            ),
            array(
                'name' => 'Meals Included',
                'id' => $prefix . 'pack_includes_4',
                'type' => 'checkbox_list',
                'inline' => true,
                'select_all_none' => true,
                'options' => array(
                    'B' => 'Breakfast',
                    'BL' => 'Box Lunch',
                    'L' => 'Lunch',
                    'D' => 'Dinner'
                )
            ),
            array(
                'type' => 'divider',
            ),
            array(
                'name' => '<span style="color: darkorange; font-weight: bold;">Alter Services Group Title</span>',
                'id' => $prefix . 'service_group_title_alter_4',
                'type' => 'text',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'placeholder' => 'Type a short title',
                'desc' => 'This content will appear in the boucher information'
            ),
            array(
                'name' => '<span style="color: darkorange; font-weight: bold;">Alter Services Description</span>',
                'id' => $prefix . 'service_group_description_alter_4',
                'type' => 'textarea',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'desc' => 'This content will appear in the website, <span style="color: green; font-weight: bold;">Please complete this items to show on website and boucher</span>'
            ),
        ),
        'priority' => 'high',
        'context' => 'normal',
    );
    $meta_boxes[] = array(
        'title'      => '<i class="fa fa-list-ul" aria-hidden="true"></i> ' . __( 'Services group container 5', 'gogalapagos' ),
        'post_types' => array('ggpackage'),
        'fields'     => array(
            array(
                'name' => 'Services Group Title',
                'id' => $prefix . 'service_group_title_5',
                'type' => 'text',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'placeholder' => 'Type a short title',
                'desc' => 'This content will appear in the boucher information'
            ),
            array(
                'name' => 'Minimun Duration',
                'id' => $prefix . 'service_group_duration_5',
                'type' => 'number',
                'max' => 20,
                'min' => 1,
                'std' => 1,
                'desc' => 'This content will appear in the website'
            ),
            array(
                'name' => 'Services Description',
                'id' => $prefix . 'service_group_description_5',
                'type' => 'textarea',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'desc' => 'This content will appear in the website, <span style="color: darkorange; font-weight: bold;">If this item has an alternative, please complete the next section</span>'
            ),
            array(
                'name' => 'Meals Included',
                'id' => $prefix . 'pack_includes_5',
                'type' => 'checkbox_list',
                'inline' => true,
                'select_all_none' => true,
                'options' => array(
                    'B' => 'Breakfast',
                    'BL' => 'Box Lunch',
                    'L' => 'Lunch',
                    'D' => 'Dinner'
                )
            ),
            array(
                'type' => 'divider',
            ),
            array(
                'name' => '<span style="color: darkorange; font-weight: bold;">Alter Services Group Title</span>',
                'id' => $prefix . 'service_group_title_alter_5',
                'type' => 'text',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'placeholder' => 'Type a short title',
                'desc' => 'This content will appear in the boucher information'
            ),
            array(
                'name' => '<span style="color: darkorange; font-weight: bold;">Alter Services Description</span>',
                'id' => $prefix . 'service_group_description_alter_5',
                'type' => 'textarea',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'desc' => 'This content will appear in the website, <span style="color: green; font-weight: bold;">Please complete this items to show on website and boucher</span>'
            ),
        ),
        'priority' => 'high',
        'context' => 'normal',
    );
    $meta_boxes[] = array(
        'title'      => '<i class="fa fa-list-ul" aria-hidden="true"></i> ' . __( 'Services group container 6', 'gogalapagos' ),
        'post_types' => array('ggpackage'),
        'fields'     => array(
            array(
                'name' => 'Services Group Title',
                'id' => $prefix . 'service_group_title_6',
                'type' => 'text',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'placeholder' => 'Type a short title',
                'desc' => 'This content will appear in the boucher information'
            ),
            array(
                'name' => 'Minimun Duration',
                'id' => $prefix . 'service_group_duration_6',
                'type' => 'number',
                'max' => 20,
                'min' => 1,
                'std' => 1,
                'desc' => 'This content will appear in the website'
            ),
            array(
                'name' => 'Services Description',
                'id' => $prefix . 'service_group_description_6',
                'type' => 'textarea',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'desc' => 'This content will appear in the website, <span style="color: darkorange; font-weight: bold;">If this item has an alternative, please complete the next section</span>'
            ),
            array(
                'name' => 'Meals Included',
                'id' => $prefix . 'pack_includes_6',
                'type' => 'checkbox_list',
                'inline' => true,
                'select_all_none' => true,
                'options' => array(
                    'B' => 'Breakfast',
                    'BL' => 'Box Lunch',
                    'L' => 'Lunch',
                    'D' => 'Dinner'
                )
            ),
            array(
                'type' => 'divider',
            ),
            array(
                'name' => '<span style="color: darkorange; font-weight: bold;">Alter Services Group Title</span>',
                'id' => $prefix . 'service_group_title_alter_6',
                'type' => 'text',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'placeholder' => 'Type a short title',
                'desc' => 'This content will appear in the boucher information'
            ),
            array(
                'name' => '<span style="color: darkorange; font-weight: bold;">Alter Services Description</span>',
                'id' => $prefix . 'service_group_description_alter_6',
                'type' => 'textarea',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'desc' => 'This content will appear in the website, <span style="color: green; font-weight: bold;">Please complete this items to show on website and boucher</span>'
            ),
        ),
        'priority' => 'high',
        'context' => 'normal',
    );
    $meta_boxes[] = array(
        'title'      => '<i class="fa fa-list-ul" aria-hidden="true"></i> ' . __( 'Services group container 7', 'gogalapagos' ),
        'post_types' => array('ggpackage'),
        'fields'     => array(
            array(
                'name' => 'Services Group Title',
                'id' => $prefix . 'service_group_title_7',
                'type' => 'text',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'placeholder' => 'Type a short title',
                'desc' => 'This content will appear in the boucher information'
            ),
            array(
                'name' => 'Minimun Duration',
                'id' => $prefix . 'service_group_duration_7',
                'type' => 'number',
                'max' => 20,
                'min' => 1,
                'std' => 1,
                'desc' => 'This content will appear in the website'
            ),
            array(
                'name' => 'Services Description',
                'id' => $prefix . 'service_group_description_7',
                'type' => 'textarea',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'desc' => 'This content will appear in the website, <span style="color: darkorange; font-weight: bold;">If this item has an alternative, please complete the next section</span>'
            ),
            array(
                'name' => 'Meals Included',
                'id' => $prefix . 'pack_includes_7',
                'type' => 'checkbox_list',
                'inline' => true,
                'select_all_none' => true,
                'options' => array(
                    'B' => 'Breakfast',
                    'BL' => 'Box Lunch',
                    'L' => 'Lunch',
                    'D' => 'Dinner'
                )
            ),
            array(
                'type' => 'divider',
            ),
            array(
                'name' => '<span style="color: darkorange; font-weight: bold;">Alter Services Group Title</span>',
                'id' => $prefix . 'service_group_title_alter_7',
                'type' => 'text',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'placeholder' => 'Type a short title',
                'desc' => 'This content will appear in the boucher information'
            ),
            array(
                'name' => '<span style="color: darkorange; font-weight: bold;">Alter Services Description</span>',
                'id' => $prefix . 'service_group_description_alter_7',
                'type' => 'textarea',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'desc' => 'This content will appear in the website, <span style="color: green; font-weight: bold;">Please complete this items to show on website and boucher</span>'
            ),
        ),
        'priority' => 'high',
        'context' => 'normal',
    );
    $meta_boxes[] = array(
        'title'      => '<i class="fa fa-list-ul" aria-hidden="true"></i> ' . __( 'Services group container 8', 'gogalapagos' ),
        'post_types' => array('ggpackage'),
        'fields'     => array(
            array(
                'name' => 'Services Group Title',
                'id' => $prefix . 'service_group_title_8',
                'type' => 'text',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'placeholder' => 'Type a short title',
                'desc' => 'This content will appear in the boucher information'
            ),
            array(
                'name' => 'Minimun Duration',
                'id' => $prefix . 'service_group_duration_8',
                'type' => 'number',
                'max' => 20,
                'min' => 1,
                'std' => 1,
                'desc' => 'This content will appear in the website'
            ),
            array(
                'name' => 'Services Description',
                'id' => $prefix . 'service_group_description_8',
                'type' => 'textarea',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'desc' => 'This content will appear in the website, <span style="color: darkorange; font-weight: bold;">If this item has an alternative, please complete the next section</span>'
            ),
            array(
                'name' => 'Meals Included',
                'id' => $prefix . 'pack_includes_8',
                'type' => 'checkbox_list',
                'inline' => true,
                'select_all_none' => true,
                'options' => array(
                    'B' => 'Breakfast',
                    'BL' => 'Box Lunch',
                    'L' => 'Lunch',
                    'D' => 'Dinner'
                )
            ),
            array(
                'type' => 'divider',
            ),
            array(
                'name' => '<span style="color: darkorange; font-weight: bold;">Alter Services Group Title</span>',
                'id' => $prefix . 'service_group_title_alter_8',
                'type' => 'text',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'placeholder' => 'Type a short title',
                'desc' => 'This content will appear in the boucher information'
            ),
            array(
                'name' => '<span style="color: darkorange; font-weight: bold;">Alter Services Description</span>',
                'id' => $prefix . 'service_group_description_alter_8',
                'type' => 'textarea',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'desc' => 'This content will appear in the website, <span style="color: green; font-weight: bold;">Please complete this items to show on website and boucher</span>'
            ),
        ),
        'priority' => 'high',
        'context' => 'normal',
    );
    $meta_boxes[] = array(
        'title'      => '<i class="fa fa-list-ul" aria-hidden="true"></i> ' . __( 'Services group container 9', 'gogalapagos' ),
        'post_types' => array('ggpackage'),
        'fields'     => array(
            array(
                'name' => 'Services Group Title',
                'id' => $prefix . 'service_group_title_9',
                'type' => 'text',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'placeholder' => 'Type a short title',
                'desc' => 'This content will appear in the boucher information'
            ),
            array(
                'name' => 'Minimun Duration',
                'id' => $prefix . 'service_group_duration_9',
                'type' => 'number',
                'max' => 20,
                'min' => 1,
                'std' => 1,
                'desc' => 'This content will appear in the website'
            ),
            array(
                'name' => 'Services Description',
                'id' => $prefix . 'service_group_description_9',
                'type' => 'textarea',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'desc' => 'This content will appear in the website, <span style="color: darkorange; font-weight: bold;">If this item has an alternative, please complete the next section</span>'
            ),
            array(
                'name' => 'Meals Included',
                'id' => $prefix . 'pack_includes_9',
                'type' => 'checkbox_list',
                'inline' => true,
                'select_all_none' => true,
                'options' => array(
                    'B' => 'Breakfast',
                    'BL' => 'Box Lunch',
                    'L' => 'Lunch',
                    'D' => 'Dinner'
                )
            ),
            array(
                'type' => 'divider',
            ),
            array(
                'name' => '<span style="color: darkorange; font-weight: bold;">Alter Services Group Title</span>',
                'id' => $prefix . 'service_group_title_alter_9',
                'type' => 'text',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'placeholder' => 'Type a short title',
                'desc' => 'This content will appear in the boucher information'
            ),
            array(
                'name' => '<span style="color: darkorange; font-weight: bold;">Alter Services Description</span>',
                'id' => $prefix . 'service_group_description_alter_9',
                'type' => 'textarea',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'desc' => 'This content will appear in the website, <span style="color: green; font-weight: bold;">Please complete this items to show on website and boucher</span>'
            ),
        ),
        'priority' => 'high',
        'context' => 'normal',
    );
    /* codigo de la disponibilidad */
    $meta_boxes[] = array(
        'id'         => 'ship_info_dispo_webservice',
        'title'      => '<i class="dashicons dashicons-paperclip"></i> ' . __( 'Kleintours Dispo System ' . $post->ID, 'gogalapagos' ),
        'post_types' => array('ggships', 'ggtour', 'ggpackage'),
        'context'    => 'side',
        'priority'   => 'high',
        'fields' => array(
            array(
                'id' => $prefix . 'dispo_ID',
                'name' => '<i class="dashicons dashicons-arrow-right"></i> ' . esc_html__( 'Dispo Code', 'gogalapagos' ),
                'type' => 'text',
                'readonly' => TRUE
            )
        )
    );

    /* ESTRELLITAS PARA COMENTARIOS */
    $meta_boxes[] = array(
        'id'         => 'ship_info_dispo_webservice_2',
        'title'      => '<i class="dashicons dashicons-star-filled"></i><i class="dashicons dashicons-star-filled"></i><i class="dashicons dashicons-star-filled"></i><i class="dashicons dashicons-star-filled"></i><i class="dashicons dashicons-star-empty"></i>',
        'post_types' => array('ggtestimonial'),
        'context'    => 'side',
        'priority'   => 'low',
        'fields' => array(
            array(
                'id' => $prefix . 'testimonial_rate',
                'name' => esc_html__( 'Rate the comment', 'gogalapagos' ),
                'type' => 'number',
                'min' => 1,
                'max' => 5,
                'std' => 1
            )
        )
    );
    // Para las ofertas y promociones
    $meta_boxes[] = array(
        'title'      => __( '<i class="fa fa-list-ul" aria-hidden="true"></i> Special Offer Gallery', 'gogalapagos' ),
        'post_types' => 'ggspecialoffer',
        'fields'     => array(
            array(
                'name' => 'Image List',
                'id' => $prefix . 'offer_gallery',
                'type' => 'image_advanced',
                'clone' => true,
                'sort_clone' => true,
                'desc' => __('If not set, this activity won\'t show on frontend. Drag n\' Drop to sort the list. If item is a link, copy entire link.','gogalapagos'),
            )
        ),
        'context' => 'normal',
    );
    // Para las membresias
    $meta_boxes[] = array(
        'title'      => __( '<i class="dashicons dashicons-format-image"></i> Membership Logo', 'gogalapagos' ),
        'post_types' => 'ggmembership',
        'fields'     => array(
            array(
                'name' => 'White Logo',
                'id' => $prefix . 'membership_white_logo',
                'type'  => 'file_input',
                'mime_type' => 'png',
                'max_file_uploads' => 1,
                'desc'  => 'Note: Upload or Select a PNG format image.',
            )
        ),
        'context' => 'side',
    );
    // Para los vendedores
    // Seccion HERO
    $meta_boxes[] = array(
        'id'         => 'ship_info',
        'title'      => '<i class="fa fa-user-circle"></i> ' . __( 'Sales Expert information', 'gogalapagos' ),
        'post_types' => 'ggsalesexpert',
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(
            array(
                'name'  => '<i class="fa fa-envelope"></i> ' . __( 'Email Address', 'gogalapagos' ),
                'desc'  => 'Note: type a valid email address',
                'id'    => $prefix . 'salesexpert_email',
                'type'  => 'email',                
            ),
            array(
                'name'  => '<i class="fa fa-phone"></i> ' . __( 'Extension', 'gogalapagos' ),
                'desc'  => 'Note: This field is for numbers only.',
                'id'    => $prefix . 'salesexpert_ext',
                'type'  => 'number',
                'min'   => 0,
                'max'   => 999,
            ),
            array(
                'name'  => '<i class="fa fa-check"></i> ' . __( 'Charge', 'gogalapagos' ),
                'id'    => $prefix . 'salesexpert_charge',
                'type'  => 'select',
                'options' => array(
                    '0' => _x('Direct Sales','gogalapagos'),
                    '1' => _x('Incoming Sales','gogalapagos'),
                    '2' => _x('Business Development','gogalapagos'),
                ),
            ),
            array(
                'name'  => '<i class="fa fa-globe"></i> ' . __( 'Region (Countries)', 'gogalapagos' ),
                'id'    => $prefix . 'salesexpert_region',
                'type'  => 'text',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
            )
        )
    );

    //Fondos para animales sitios de visita y actividades
    // Para las membresias
    $meta_boxes[] = array(
        'title'      => __( '<i class="dashicons dashicons-format-image"></i> Background content', 'gogalapagos' ),
        'post_types' => array( 'gglocation', 'gganimal', 'ggactivity', 'ggtour' ),
        'fields'     => array(
            array(
                'name' => 'Image',
                'id' => $prefix . 'background_image_content',
                'type'  => 'file_input',
                'mime_type' => 'png',
                'max_file_uploads' => 1,
                'desc'  => 'Note: Upload or Select a PNG format image.',
            )
        ),
        'context' => 'side',
    );


    // SOUTH AMERICA GO GALAPAGOS TOURS
    // 
    $meta_boxes[] = array(
        'title'      => __( '<i class="dashicons dashicons-backup"></i> Duration', 'gogalapagos' ),
        'post_types' => array( 'ggsatour' ),
        'fields'     => array(
            array(
                'name' => 'Days',
                'id' => $prefix . 'sa_tourduration',
                'type'  => 'number',
                'min' => 0,
                'std' => 0
            )
        ),
        'context' => 'side',
    );
    $meta_boxes[] = array(
        'title'      => __( 'Highlights', 'gogalapagos' ),
        'post_types' => array( 'ggsatour' ),
        'fields'     => array(
            array(
                'name' => 'Item',
                'id' => $prefix . 'sa_highlights',
                'type'  => 'text',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'clone' => true,
                'sort_clone' => true
            )
        ),
        'context' => 'normal',
        'priority' => 'high'
    );
    $meta_boxes[] = array(
        'title'      => __( 'What\'s included?', 'gogalapagos' ),
        'post_types' => array( 'ggsatour' ),
        'fields'     => array(
            array(
                'name' => 'Item',
                'id' => $prefix . 'sa_included',
                'type'  => 'text',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'clone' => true,
                'sort_clone' => true
            )
        ),
        'context' => 'normal',
        'priority' => 'high'
    );
    
    // METABOXES PARA SERVICIOS A BORDO
    $meta_boxes[] = array(
        'title'      => __( 'Pack Code', 'gogalapagos' ),
        'post_types' => array( 'ggonboardservices' ),
        'fields'     => array(
            array(
                'name' => 'CODE',
                'id' => $prefix . 'onboard_service_code',
                'type'  => 'text',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
            )
        ),
        'context' => 'side',
        'priority' => 'high'
    );
    $meta_boxes[] = array(
        'title'      => __( 'Pack Price', 'gogalapagos' ),
        'post_types' => array( 'ggonboardservices' ),
        'fields'     => array(
            array(
                'name' => 'Price',
                'id' => $prefix . 'onboard_service_price',
                'type'  => 'number',
                'min' => 0,
                'step' => 0.01
            )
        ),
        'context' => 'side',
        'priority' => 'high'
    );
    $meta_boxes[] = array(
        'title'      => __( 'Pack Slogan', 'gogalapagos' ),
        'post_types' => array( 'ggonboardservices' ),
        'fields'     => array(
            array(
                'name' => 'Text',
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
                'id' => $prefix . 'onboard_service_slogan',
                'type'  => 'text', 
                'attributes' => array(
                    'class' => 'gogalapagos-field'
                ),
            )
        ),
        'context' => 'side',
        'priority' => 'high'
    );
    $meta_boxes[] = array(
        'title'      => __( 'Onboard Service Icon', 'gogalapagos' ),
        'post_types' => array( 'ggonboardservices' ),
        'fields'     => array(
            array(
                'name' => 'Item',
                'id' => $prefix . 'onboard_service_icon',
                'type'  => 'select',
                'options' => array(
                    'fa-adjust' => 'adjust', 
                    'fa-adn' => 'adn', 
                    'fa-align-center' => 'align-center', 
                    'fa-align-justify' => 'align-justify', 
                    'fa-align-left' => 'align-left', 
                    'fa-align-right' => 'align-right', 
                    'fa-ambulance' => 'ambulance', 
                    'fa-anchor' => 'anchor', 
                    'fa-android' => 'android', 
                    'fa-angle-double-down' => 'angle-double-down', 
                    'fa-angle-double-left' => 'angle-double-left', 
                    'fa-angle-double-right' => 'angle-double-right', 
                    'fa-angle-double-up' => 'angle-double-up', 
                    'fa-angle-down' => 'angle-down', 
                    'fa-angle-left' => 'angle-left', 
                    'fa-angle-right' => 'angle-right', 
                    'fa-angle-up' => 'angle-up', 
                    'fa-apple' => 'apple', 
                    'fa-archive' => 'archive', 
                    'fa-arrow-circle-down' => 'arrow-circle-down', 
                    'fa-arrow-circle-left' => 'arrow-circle-left', 
                    'fa-arrow-circle-o-down' => 'arrow-circle-o-down', 
                    'fa-arrow-circle-o-left' => 'arrow-circle-o-left', 
                    'fa-arrow-circle-o-right' => 'arrow-circle-o-right', 
                    'fa-arrow-circle-o-up' => 'arrow-circle-o-up', 
                    'fa-arrow-circle-right' => 'arrow-circle-right', 
                    'fa-arrow-circle-up' => 'arrow-circle-up', 
                    'fa-arrow-down' => 'arrow-down', 
                    'fa-arrow-left' => 'arrow-left', 
                    'fa-arrow-right' => 'arrow-right', 
                    'fa-arrow-up' => 'arrow-up', 
                    'fa-arrows' => 'arrows', 
                    'fa-arrows-alt' => 'arrows-alt', 
                    'fa-arrows-h' => 'arrows-h', 
                    'fa-arrows-v' => 'arrows-v', 
                    'fa-asterisk' => 'asterisk', 
                    'fa-automobile' => 'automobile', 
                    'fa-backward' => 'backward', 
                    'fa-ban' => 'ban', 
                    'fa-bank' => 'bank', 
                    'fa-bar-chart-o' => 'bar-chart-o', 
                    'fa-barcode' => 'barcode', 
                    'fa-bars' => 'bars', 
                    'fa-beer' => 'beer', 
                    'fa-behance' => 'behance', 
                    'fa-behance-square' => 'behance-square', 
                    'fa-bell' => 'bell', 
                    'fa-bell-o' => 'bell-o', 
                    'fa-bitbucket' => 'bitbucket', 
                    'fa-bitbucket-square' => 'bitbucket-square', 
                    'fa-bitcoin' => 'bitcoin', 
                    'fa-bold' => 'bold', 
                    'fa-bolt' => 'bolt', 
                    'fa-bomb' => 'bomb', 
                    'fa-book' => 'book', 
                    'fa-bookmark' => 'bookmark', 
                    'fa-bookmark-o' => 'bookmark-o', 
                    'fa-briefcase' => 'briefcase', 
                    'fa-btc' => 'btc', 
                    'fa-bug' => 'bug', 
                    'fa-building' => 'building', 
                    'fa-building-o' => 'building-o', 
                    'fa-bullhorn' => 'bullhorn', 
                    'fa-bullseye' => 'bullseye', 
                    'fa-cab' => 'cab', 
                    'fa-calendar' => 'calendar', 
                    'fa-calendar-o' => 'calendar-o', 
                    'fa-camera' => 'camera', 
                    'fa-camera-retro' => 'camera-retro', 
                    'fa-car' => 'car', 
                    'fa-caret-down' => 'caret-down', 
                    'fa-caret-left' => 'caret-left', 
                    'fa-caret-right' => 'caret-right', 
                    'fa-caret-square-o-down' => 'caret-square-o-down', 
                    'fa-caret-square-o-left' => 'caret-square-o-left', 
                    'fa-caret-square-o-right' => 'caret-square-o-right', 
                    'fa-caret-square-o-up' => 'caret-square-o-up', 
                    'fa-caret-up' => 'caret-up', 
                    'fa-certificate' => 'certificate', 
                    'fa-chain' => 'chain', 
                    'fa-chain-broken' => 'chain-broken', 
                    'fa-check' => 'check', 
                    'fa-check-circle' => 'check-circle', 
                    'fa-check-circle-o' => 'check-circle-o', 
                    'fa-check-square' => 'check-square', 
                    'fa-check-square-o' => 'check-square-o', 
                    'fa-chevron-circle-down' => 'chevron-circle-down', 
                    'fa-chevron-circle-left' => 'chevron-circle-left', 
                    'fa-chevron-circle-right' => 'chevron-circle-right', 
                    'fa-chevron-circle-up' => 'chevron-circle-up', 
                    'fa-chevron-down' => 'chevron-down', 
                    'fa-chevron-left' => 'chevron-left', 
                    'fa-chevron-right' => 'chevron-right', 
                    'fa-chevron-up' => 'chevron-up', 
                    'fa-child' => 'child', 
                    'fa-circle' => 'circle', 
                    'fa-circle-o' => 'circle-o', 
                    'fa-circle-o-notch' => 'circle-o-notch', 
                    'fa-circle-thin' => 'circle-thin', 
                    'fa-clipboard' => 'clipboard', 
                    'fa-clock-o' => 'clock-o', 
                    'fa-cloud' => 'cloud', 
                    'fa-cloud-download' => 'cloud-download', 
                    'fa-cloud-upload' => 'cloud-upload', 
                    'fa-cny' => 'cny', 
                    'fa-code' => 'code', 
                    'fa-code-fork' => 'code-fork', 
                    'fa-codepen' => 'codepen', 
                    'fa-coffee' => 'coffee', 
                    'fa-cog' => 'cog', 
                    'fa-cogs' => 'cogs', 
                    'fa-columns' => 'columns', 
                    'fa-comment' => 'comment', 
                    'fa-comment-o' => 'comment-o', 
                    'fa-comments' => 'comments', 
                    'fa-comments-o' => 'comments-o', 
                    'fa-compass' => 'compass', 
                    'fa-compress' => 'compress', 
                    'fa-copy' => 'copy', 
                    'fa-credit-card' => 'credit-card', 
                    'fa-crop' => 'crop', 
                    'fa-crosshairs' => 'crosshairs', 
                    'fa-css3' => 'css3', 
                    'fa-cube' => 'cube', 
                    'fa-cubes' => 'cubes', 
                    'fa-cut' => 'cut', 
                    'fa-cutlery' => 'cutlery', 
                    'fa-dashboard' => 'dashboard', 
                    'fa-database' => 'database', 
                    'fa-dedent' => 'dedent', 
                    'fa-delicious' => 'delicious', 
                    'fa-desktop' => 'desktop', 
                    'fa-deviantart' => 'deviantart', 
                    'fa-digg' => 'digg', 
                    'fa-dollar' => 'dollar', 
                    'fa-dot-circle-o' => 'dot-circle-o', 
                    'fa-download' => 'download', 
                    'fa-dribbble' => 'dribbble', 
                    'fa-dropbox' => 'dropbox', 
                    'fa-drupal' => 'drupal', 
                    'fa-edit' => 'edit', 
                    'fa-eject' => 'eject', 
                    'fa-ellipsis-h' => 'ellipsis-h', 
                    'fa-ellipsis-v' => 'ellipsis-v', 
                    'fa-empire' => 'empire', 
                    'fa-envelope' => 'envelope', 
                    'fa-envelope-o' => 'envelope-o', 
                    'fa-envelope-square' => 'envelope-square', 
                    'fa-eraser' => 'eraser', 
                    'fa-eur' => 'eur', 
                    'fa-euro' => 'euro', 
                    'fa-exchange' => 'exchange', 
                    'fa-exclamation' => 'exclamation', 
                    'fa-exclamation-circle' => 'exclamation-circle', 
                    'fa-exclamation-triangle' => 'exclamation-triangle', 
                    'fa-expand' => 'expand', 
                    'fa-external-link' => 'external-link', 
                    'fa-external-link-square' => 'external-link-square', 
                    'fa-eye' => 'eye', 
                    'fa-eye-slash' => 'eye-slash', 
                    'fa-facebook' => 'facebook', 
                    'fa-facebook-square' => 'facebook-square', 
                    'fa-fast-backward' => 'fast-backward', 
                    'fa-fast-forward' => 'fast-forward', 
                    'fa-fax' => 'fax', 
                    'fa-female' => 'female', 
                    'fa-fighter-jet' => 'fighter-jet', 
                    'fa-file' => 'file', 
                    'fa-file-archive-o' => 'file-archive-o', 
                    'fa-file-audio-o' => 'file-audio-o', 
                    'fa-file-code-o' => 'file-code-o', 
                    'fa-file-excel-o' => 'file-excel-o', 
                    'fa-file-image-o' => 'file-image-o', 
                    'fa-file-movie-o' => 'file-movie-o', 
                    'fa-file-o' => 'file-o', 
                    'fa-file-pdf-o' => 'file-pdf-o', 
                    'fa-file-photo-o' => 'file-photo-o', 
                    'fa-file-picture-o' => 'file-picture-o', 
                    'fa-file-powerpoint-o' => 'file-powerpoint-o', 
                    'fa-file-sound-o' => 'file-sound-o', 
                    'fa-file-text' => 'file-text', 
                    'fa-file-text-o' => 'file-text-o', 
                    'fa-file-video-o' => 'file-video-o', 
                    'fa-file-word-o' => 'file-word-o', 
                    'fa-file-zip-o' => 'file-zip-o', 
                    'fa-files-o' => 'files-o', 
                    'fa-film' => 'film', 
                    'fa-filter' => 'filter', 
                    'fa-fire' => 'fire', 
                    'fa-fire-extinguisher' => 'fire-extinguisher', 
                    'fa-flag' => 'flag', 
                    'fa-flag-checkered' => 'flag-checkered', 
                    'fa-flag-o' => 'flag-o', 
                    'fa-flash' => 'flash', 
                    'fa-flask' => 'flask', 
                    'fa-flickr' => 'flickr', 
                    'fa-floppy-o' => 'floppy-o', 
                    'fa-folder' => 'folder', 
                    'fa-folder-o' => 'folder-o', 
                    'fa-folder-open' => 'folder-open', 
                    'fa-folder-open-o' => 'folder-open-o', 
                    'fa-font' => 'font', 
                    'fa-forward' => 'forward', 
                    'fa-foursquare' => 'foursquare', 
                    'fa-frown-o' => 'frown-o', 
                    'fa-gamepad' => 'gamepad', 
                    'fa-gavel' => 'gavel', 
                    'fa-gbp' => 'gbp', 
                    'fa-ge' => 'ge', 
                    'fa-gear' => 'gear', 
                    'fa-gears' => 'gears', 
                    'fa-gift' => 'gift', 
                    'fa-git' => 'git', 
                    'fa-git-square' => 'git-square', 
                    'fa-github' => 'github', 
                    'fa-github-alt' => 'github-alt', 
                    'fa-github-square' => 'github-square', 
                    'fa-gittip' => 'gittip', 
                    'fa-glass' => 'glass', 
                    'fa-globe' => 'globe', 
                    'fa-google' => 'google', 
                    'fa-google-plus' => 'google-plus', 
                    'fa-google-plus-square' => 'google-plus-square', 
                    'fa-graduation-cap' => 'graduation-cap', 
                    'fa-group' => 'group', 
                    'fa-h-square' => 'h-square', 
                    'fa-hacker-news' => 'hacker-news', 
                    'fa-hand-o-down' => 'hand-o-down', 
                    'fa-hand-o-left' => 'hand-o-left', 
                    'fa-hand-o-right' => 'hand-o-right', 
                    'fa-hand-o-up' => 'hand-o-up', 
                    'fa-hdd-o' => 'hdd-o', 
                    'fa-header' => 'header', 
                    'fa-headphones' => 'headphones', 
                    'fa-heart' => 'heart', 
                    'fa-heart-o' => 'heart-o', 
                    'fa-history' => 'history', 
                    'fa-home' => 'home', 
                    'fa-hospital-o' => 'hospital-o', 
                    'fa-html5' => 'html5', 
                    'fa-image' => 'image', 
                    'fa-inbox' => 'inbox', 
                    'fa-indent' => 'indent', 
                    'fa-info' => 'info', 
                    'fa-info-circle' => 'info-circle', 
                    'fa-inr' => 'inr', 
                    'fa-instagram' => 'instagram', 
                    'fa-institution' => 'institution', 
                    'fa-italic' => 'italic', 
                    'fa-joomla' => 'joomla', 
                    'fa-jpy' => 'jpy', 
                    'fa-jsfiddle' => 'jsfiddle', 
                    'fa-key' => 'key', 
                    'fa-keyboard-o' => 'keyboard-o', 
                    'fa-krw' => 'krw', 
                    'fa-language' => 'language', 
                    'fa-laptop' => 'laptop', 
                    'fa-leaf' => 'leaf', 
                    'fa-legal' => 'legal', 
                    'fa-lemon-o' => 'lemon-o', 
                    'fa-level-down' => 'level-down', 
                    'fa-level-up' => 'level-up', 
                    'fa-life-bouy' => 'life-bouy', 
                    'fa-life-ring' => 'life-ring', 
                    'fa-life-saver' => 'life-saver', 
                    'fa-lightbulb-o' => 'lightbulb-o', 
                    'fa-link' => 'link', 
                    'fa-linkedin' => 'linkedin', 
                    'fa-linkedin-square' => 'linkedin-square', 
                    'fa-linux' => 'linux', 
                    'fa-list' => 'list', 
                    'fa-list-alt' => 'list-alt', 
                    'fa-list-ol' => 'list-ol', 
                    'fa-list-ul' => 'list-ul', 
                    'fa-location-arrow' => 'location-arrow', 
                    'fa-lock' => 'lock', 
                    'fa-long-arrow-down' => 'long-arrow-down', 
                    'fa-long-arrow-left' => 'long-arrow-left', 
                    'fa-long-arrow-right' => 'long-arrow-right', 
                    'fa-long-arrow-up' => 'long-arrow-up', 
                    'fa-magic' => 'magic', 
                    'fa-magnet' => 'magnet', 
                    'fa-mail-forward' => 'mail-forward', 
                    'fa-mail-reply' => 'mail-reply', 
                    'fa-mail-reply-all' => 'mail-reply-all', 
                    'fa-male' => 'male', 
                    'fa-map-marker' => 'map-marker', 
                    'fa-maxcdn' => 'maxcdn', 
                    'fa-medkit' => 'medkit', 
                    'fa-meh-o' => 'meh-o', 
                    'fa-microphone' => 'microphone', 
                    'fa-microphone-slash' => 'microphone-slash', 
                    'fa-minus' => 'minus', 
                    'fa-minus-circle' => 'minus-circle', 
                    'fa-minus-square' => 'minus-square', 
                    'fa-minus-square-o' => 'minus-square-o', 
                    'fa-mobile' => 'mobile', 
                    'fa-mobile-phone' => 'mobile-phone', 
                    'fa-money' => 'money', 
                    'fa-moon-o' => 'moon-o', 
                    'fa-mortar-board' => 'mortar-board', 
                    'fa-music' => 'music', 
                    'fa-navicon' => 'navicon', 
                    'fa-openid' => 'openid', 
                    'fa-outdent' => 'outdent', 
                    'fa-pagelines' => 'pagelines', 
                    'fa-paper-plane' => 'paper-plane', 
                    'fa-paper-plane-o' => 'paper-plane-o', 
                    'fa-paperclip' => 'paperclip', 
                    'fa-paragraph' => 'paragraph', 
                    'fa-paste' => 'paste', 
                    'fa-pause' => 'pause', 
                    'fa-paw' => 'paw', 
                    'fa-pencil' => 'pencil', 
                    'fa-pencil-square' => 'pencil-square', 
                    'fa-pencil-square-o' => 'pencil-square-o', 
                    'fa-phone' => 'phone', 
                    'fa-phone-square' => 'phone-square', 
                    'fa-photo' => 'photo', 
                    'fa-picture-o' => 'picture-o', 
                    'fa-pied-piper' => 'pied-piper', 
                    'fa-pied-piper-alt' => 'pied-piper-alt', 
                    'fa-pied-piper-square' => 'pied-piper-square', 
                    'fa-pinterest' => 'pinterest', 
                    'fa-pinterest-square' => 'pinterest-square', 
                    'fa-plane' => 'plane', 
                    'fa-play' => 'play', 
                    'fa-play-circle' => 'play-circle', 
                    'fa-play-circle-o' => 'play-circle-o', 
                    'fa-plus' => 'plus', 
                    'fa-plus-circle' => 'plus-circle', 
                    'fa-plus-square' => 'plus-square', 
                    'fa-plus-square-o' => 'plus-square-o', 
                    'fa-power-off' => 'power-off', 
                    'fa-print' => 'print', 
                    'fa-puzzle-piece' => 'puzzle-piece', 
                    'fa-qq' => 'qq', 
                    'fa-qrcode' => 'qrcode', 
                    'fa-question' => 'question', 
                    'fa-question-circle' => 'question-circle', 
                    'fa-quote-left' => 'quote-left', 
                    'fa-quote-right' => 'quote-right', 
                    'fa-ra' => 'ra', 
                    'fa-random' => 'random', 
                    'fa-rebel' => 'rebel', 
                    'fa-recycle' => 'recycle', 
                    'fa-reddit' => 'reddit', 
                    'fa-reddit-square' => 'reddit-square', 
                    'fa-refresh' => 'refresh', 
                    'fa-renren' => 'renren', 
                    'fa-reorder' => 'reorder', 
                    'fa-repeat' => 'repeat', 
                    'fa-reply' => 'reply', 
                    'fa-reply-all' => 'reply-all', 
                    'fa-retweet' => 'retweet', 
                    'fa-rmb' => 'rmb', 
                    'fa-road' => 'road', 
                    'fa-rocket' => 'rocket', 
                    'fa-rotate-left' => 'rotate-left', 
                    'fa-rotate-right' => 'rotate-right', 
                    'fa-rouble' => 'rouble', 
                    'fa-rss' => 'rss', 
                    'fa-rss-square' => 'rss-square', 
                    'fa-rub' => 'rub', 
                    'fa-ruble' => 'ruble', 
                    'fa-rupee' => 'rupee', 
                    'fa-save' => 'save', 
                    'fa-scissors' => 'scissors', 
                    'fa-search' => 'search', 
                    'fa-search-minus' => 'search-minus', 
                    'fa-search-plus' => 'search-plus', 
                    'fa-send' => 'send', 
                    'fa-send-o' => 'send-o', 
                    'fa-share' => 'share', 
                    'fa-share-alt' => 'share-alt', 
                    'fa-share-alt-square' => 'share-alt-square', 
                    'fa-share-square' => 'share-square', 
                    'fa-share-square-o' => 'share-square-o', 
                    'fa-shield' => 'shield', 
                    'fa-shopping-cart' => 'shopping-cart', 
                    'fa-sign-in' => 'sign-in', 
                    'fa-sign-out' => 'sign-out', 
                    'fa-signal' => 'signal', 
                    'fa-sitemap' => 'sitemap', 
                    'fa-skype' => 'skype', 
                    'fa-slack' => 'slack', 
                    'fa-sliders' => 'sliders', 
                    'fa-smile-o' => 'smile-o', 
                    'fa-sort' => 'sort', 
                    'fa-sort-alpha-asc' => 'sort-alpha-asc', 
                    'fa-sort-alpha-desc' => 'sort-alpha-desc', 
                    'fa-sort-amount-asc' => 'sort-amount-asc', 
                    'fa-sort-amount-desc' => 'sort-amount-desc', 
                    'fa-sort-asc' => 'sort-asc', 
                    'fa-sort-desc' => 'sort-desc', 
                    'fa-sort-down' => 'sort-down', 
                    'fa-sort-numeric-asc' => 'sort-numeric-asc', 
                    'fa-sort-numeric-desc' => 'sort-numeric-desc', 
                    'fa-sort-up' => 'sort-up', 
                    'fa-soundcloud' => 'soundcloud', 
                    'fa-space-shuttle' => 'space-shuttle', 
                    'fa-spinner' => 'spinner', 
                    'fa-spoon' => 'spoon', 
                    'fa-spotify' => 'spotify', 
                    'fa-square' => 'square', 
                    'fa-square-o' => 'square-o', 
                    'fa-stack-exchange' => 'stack-exchange', 
                    'fa-stack-overflow' => 'stack-overflow', 
                    'fa-star' => 'star', 
                    'fa-star-half' => 'star-half', 
                    'fa-star-half-empty' => 'star-half-empty', 
                    'fa-star-half-full' => 'star-half-full', 
                    'fa-star-half-o' => 'star-half-o', 
                    'fa-star-o' => 'star-o', 
                    'fa-steam' => 'steam', 
                    'fa-steam-square' => 'steam-square', 
                    'fa-step-backward' => 'step-backward', 
                    'fa-step-forward' => 'step-forward', 
                    'fa-stethoscope' => 'stethoscope', 
                    'fa-stop' => 'stop', 
                    'fa-strikethrough' => 'strikethrough', 
                    'fa-stumbleupon' => 'stumbleupon', 
                    'fa-stumbleupon-circle' => 'stumbleupon-circle', 
                    'fa-subscript' => 'subscript', 
                    'fa-suitcase' => 'suitcase', 
                    'fa-sun-o' => 'sun-o', 
                    'fa-superscript' => 'superscript', 
                    'fa-support' => 'support', 
                    'fa-table' => 'table', 
                    'fa-tablet' => 'tablet', 
                    'fa-tachometer' => 'tachometer', 
                    'fa-tag' => 'tag', 
                    'fa-tags' => 'tags', 
                    'fa-tasks' => 'tasks', 
                    'fa-taxi' => 'taxi', 
                    'fa-tencent-weibo' => 'tencent-weibo', 
                    'fa-terminal' => 'terminal', 
                    'fa-text-height' => 'text-height', 
                    'fa-text-width' => 'text-width', 
                    'fa-th' => 'th', 
                    'fa-th-large' => 'th-large', 
                    'fa-th-list' => 'th-list', 
                    'fa-thumb-tack' => 'thumb-tack', 
                    'fa-thumbs-down' => 'thumbs-down', 
                    'fa-thumbs-o-down' => 'thumbs-o-down', 
                    'fa-thumbs-o-up' => 'thumbs-o-up', 
                    'fa-thumbs-up' => 'thumbs-up', 
                    'fa-ticket' => 'ticket', 
                    'fa-times' => 'times', 
                    'fa-times-circle' => 'times-circle', 
                    'fa-times-circle-o' => 'times-circle-o', 
                    'fa-tint' => 'tint', 
                    'fa-toggle-down' => 'toggle-down', 
                    'fa-toggle-left' => 'toggle-left', 
                    'fa-toggle-right' => 'toggle-right', 
                    'fa-toggle-up' => 'toggle-up', 
                    'fa-trash-o' => 'trash-o', 
                    'fa-tree' => 'tree', 
                    'fa-trello' => 'trello', 
                    'fa-trophy' => 'trophy', 
                    'fa-truck' => 'truck', 
                    'fa-try' => 'try', 
                    'fa-tumblr' => 'tumblr', 
                    'fa-tumblr-square' => 'tumblr-square', 
                    'fa-turkish-lira' => 'turkish-lira', 
                    'fa-twitter' => 'twitter', 
                    'fa-twitter-square' => 'twitter-square', 
                    'fa-umbrella' => 'umbrella', 
                    'fa-underline' => 'underline', 
                    'fa-undo' => 'undo', 
                    'fa-university' => 'university', 
                    'fa-unlink' => 'unlink', 
                    'fa-unlock' => 'unlock', 
                    'fa-unlock-alt' => 'unlock-alt', 
                    'fa-unsorted' => 'unsorted', 
                    'fa-upload' => 'upload', 
                    'fa-usd' => 'usd', 
                    'fa-user' => 'user', 
                    'fa-user-md' => 'user-md', 
                    'fa-users' => 'users', 
                    'fa-video-camera' => 'video-camera', 
                    'fa-vimeo-square' => 'vimeo-square', 
                    'fa-vine' => 'vine', 
                    'fa-vk' => 'vk', 
                    'fa-volume-down' => 'volume-down', 
                    'fa-volume-off' => 'volume-off', 
                    'fa-volume-up' => 'volume-up', 
                    'fa-warning' => 'warning', 
                    'fa-wechat' => 'wechat', 
                    'fa-weibo' => 'weibo', 
                    'fa-weixin' => 'weixin', 
                    'fa-wheelchair' => 'wheelchair', 
                    'fa-windows' => 'windows', 
                    'fa-won' => 'won', 
                    'fa-wordpress' => 'wordpress', 
                    'fa-wrench' => 'wrench', 
                    'fa-xing' => 'xing', 
                    'fa-xing-square' => 'xing-square', 
                    'fa-yahoo' => 'yahoo', 
                    'fa-yen' => 'yen', 
                    'fa-youtube' => 'youtube', 
                    'fa-youtube-play' => 'youtube-play', 
                    'fa-youtube-square' => 'youtube-square', 

                )
            )
        ),
        'context' => 'side',
        'priority' => 'high'
    );

    return $meta_boxes;
}
?>