<?php
/*
 * Este archivo contiene los codigo para generar los metaboxes para cada CPT
 */

add_filter( 'rwmb_meta_boxes', 'gogalapagos_register_meta_boxes' );

function gogalapagos_register_meta_boxes( $meta_boxes ) {
    //verificar si es la página de fechas de salida
    $prefix = 'gg_';


    // META BOXES para las páginas de presentacion de Itinerarios
    $meta_boxes[] = array(
        'id'         => 'page_features',
        'title'      => '<span style="color: red;"><i class="dashicons dashicons-welcome-view-site"></i> ' . __( 'Itinerary Page Setting', 'gogalapagos' ).'</span>',
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


    // META BOXES para loa barcos
    
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
                'class' => ' translatethis'
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
                'class' => ' translatethis',
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
        'id'         => 'services_facilities',
        'title'      => '<i class="dashicons dashicons-editor-table"></i> ' . __( 'Ship Services and Facilities', 'gogalapagos' ),
        'post_types' => 'ggships',
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(
            array(
                'id' => $prefix . 'ship_facilities_onboard',
                'name' => '<i class="dashicons dashicons-admin-plugins"></i> ' . esc_html__( 'Onboard', 'gogalapagos' ),
                'type' => 'text',
                'clone' => true,
                'sort_clone' => true,
                'std' => true,
            ),
            array(
                'id' => $prefix . 'ship_facilities_cabin',
                'name' => '<i class="dashicons dashicons-admin-plugins"></i> ' . esc_html__( 'Cabin', 'gogalapagos' ),
                'type' => 'text',
                'clone' => true,
                'sort_clone' => true,
            )
        )
    );
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
                'id' => $prefix . 'ship_section_tech_info',
                'type' => 'wysiwyg',
                'name' => '<i class="dashicons dashicons-editor-edit"></i> ' . esc_html__( 'Technical Information Content', 'gogalapagos' ),
                'type' => 'text',
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
        'title'      => __( '<i class="fa fa-ship" aria-hidden="true"></i> Parent Ship', 'gogalapagos' ),
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
                'desc' => __('If not selectec, this cabin won\'t show on website','gogalapagos'),
            ),
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
                'clone' => true,
                'sort_clone' => true,
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
            ),
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
                'desc' => __('If not selectec, this cabin won\'t show on website','gogalapagos'),
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
                'sort_clone' => true,
            )
        )
    );
    $meta_boxes[] = array(
        'title'      => __( 'Social Area set frontend template', 'gogalapagos' ),
        'post_types' => 'ggsocialarea',
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
                'desc' => __('If not selectec, this itinerary won\'t show on frontend','gogalapagos'),
            ),
        ),
        'context' => 'side',
    );
    $meta_boxes[] = array(
        'title'      => __( 'Itinerary Color', 'gogalapagos' ),
        'post_types' => 'ggitineraries',
        'fields'     => array(
            array(
                'name' => 'Assign Parent Ship',
                'id' => $prefix . 'itinerary_frontend_color',
                'type' => 'color',
                'alpha_channel' => false,
                'desc' => __('If not selectec, this itinerary won\'t show on frontend','gogalapagos'),
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
                'desc' => __('If not selectec, this itinerary won\'t show on frontend','gogalapagos'),
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
        'post_types' => 'ggitineraries',
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
                'desc' => __('If not selectec, this itinerary won\'t show on frontend','gogalapagos'),
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
                'size' => '100%',
                'desc' => __('This name will be shown as the tab name.','gogalapagos'),
            ),
        ),
        'context' => 'normal',
    );
    $meta_boxes[] = array(
        'title'      => __( '<i class="fa fa-list-ul" aria-hidden="true"></i> Itinery Day by Day - Day 1', 'gogalapagos' ),
        'post_types' => 'ggitineraries',
        'fields'     => array(
            array(
                'name' => 'Day active?',
                'id' => $prefix . 'itinerary_active_day_1',
                'type' => 'checkbox',
                'desc' => '<span class="text-danger">' . __('If not checked, this day won\'t show on frontend','gogalapagos') . '</span>',
            ),
            array(
                'name' => 'Day Featured Image',
                'id' => $prefix . 'itinerary_featured_image_day_1',
                'type' => 'image_advanced',
                'placeholder' => _x('Please select...','gogalapagos'),
            ),
            array(
                'name' => 'Day description',
                'id' => $prefix . 'itinerary_description_day_1',
                'type' => 'textarea',
            ),
            array(
                'name' => 'AM Places list',
                'id' => $prefix . 'itinerary_am_activities_list_day_1',
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
                'id' => $prefix . 'itinerary_pm_activities_list_day_1',
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
        'context' => 'normal',
    );
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
                'desc' => __('If not selectec, this itinerary won\'t show on frontend','gogalapagos'),
            ),
            array(
                'name' => 'Day description',
                'id' => $prefix . 'itinerary_description_day_2',
                'type' => 'textarea',
                'desc' => __('If not selectec, this itinerary won\'t show on frontend','gogalapagos'),
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
                'desc' => __('If not selectec, this itinerary won\'t show on frontend','gogalapagos'),
            ),
            array(
                'name' => 'Day description',
                'id' => $prefix . 'itinerary_description_day_3',
                'type' => 'textarea',
                'desc' => __('If not selectec, this itinerary won\'t show on frontend','gogalapagos'),
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
                'desc' => __('If not selectec, this itinerary won\'t show on frontend','gogalapagos'),
            ),
            array(
                'name' => 'Day description',
                'id' => $prefix . 'itinerary_description_day_4',
                'type' => 'textarea',
                'desc' => __('If not selectec, this itinerary won\'t show on frontend','gogalapagos'),
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
                'desc' => __('If not selectec, this itinerary won\'t show on frontend','gogalapagos'),
            ),
            array(
                'name' => 'Day description',
                'id' => $prefix . 'itinerary_description_day_5',
                'type' => 'textarea',
                'desc' => __('If not selectec, this itinerary won\'t show on frontend','gogalapagos'),
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
                'size' => '100%',
                'placeholder' => _x('Please select...','gogalapagos'),
                'desc' => __('If not set, this activity won\'t show on frontend. Drag n\' Drop to sort the list. If item is a link, copy entire link.','gogalapagos'),
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
                    '1' => 'Dry',
                    '2' => 'Wet',
                    '3' => 'Dry or Wet Landing',
                    '4' => 'Dry Landing',
                    '5' => 'Wet Landing',
                    '6' => 'Wet Landing (Difficult)',
                    '7' => 'Dry Landing (Slipery Surface)',
                    '8' => 'Dry Landing (On Tuff)'
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
                    '0' => 'Sandy',
                    '1' => 'Volcanic',
                    '2' => 'Rocky',
                    '3' => 'Hard',
                    '4' => 'Water',
                    '5' => 'Sandy',
                    '6' => 'Flat',
                    '7' => 'Sandy and Flat',
                    '8' => 'Lava',
                    '9' => 'Dinghy Ride',
                    '10' => 'Steep',
                    '11' => 'Semi Rocky',
                    '12' => 'Windings',
                    '13' => 'Wooded Path',
                    '14' => 'Walking Path',
                    '15' => 'White Sandy Beach',
                    '16' => 'Red Sandy Beach',
                    '17' => 'Eroded Tuff',
                    '18' => 'Muddy',
                    '19' => 'Slippery'
                ),
                'multiple' => true,
                'placeholder' => _x('Please select...','gogalapagos'),
                'desc' => __('If not set, this item won\'t show on frontend. Drag n\' Drop to sort the list. If item is a link, copy entire link.','gogalapagos'),
            ),
            array(
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
            ),
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
                'desc' => __('If not set, this item won\'t show on frontend. Drag n\' Drop to sort the list. If item is a link, copy entire link.','gogalapagos'),
            ),
            array(
                'name' => 'Highlights',
                'id' => $prefix . 'visitors_site_highlights',
                'type' => 'textarea',
                'desc' => __('If not set, this item won\'t show on frontend. Drag n\' Drop to sort the list. If item is a link, copy entire link.','gogalapagos'),
            )
        ),
        'context' => 'normal',
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
                'size' => '100%',
            ),
            array(
                'name' => 'Size',
                'id' => $prefix . 'animal_size',
                'type' => 'text',
                'size' => '100%',
            ),
            array(
                'name' => 'Weight',
                'id' => $prefix . 'animal_weight',
                'type' => 'text',
                'size' => '100%',
            ),
            array(
                'name' => 'Google Map LAT/LONG',
                'id' => $prefix . 'gmap_coords',
                'type' => 'text',
                'size' => '100%',
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
    // Metaboxes para Actividades
    $meta_boxes[] = array(
        'title'      => __( '<i class="fa fa-list-ul" aria-hidden="true"></i> Activity Gallery', 'gogalapagos' ),
        'post_types' => 'ggactivity',
        'fields'     => array(
            array(
                'name' => 'Image List',
                'id' => $prefix . 'activity_gallery',
                'type' => 'image_advanced',
                'clone' => true,
                'sort_clone' => true,
                'desc' => __('If not set, this activity won\'t show on frontend. Drag n\' Drop to sort the list. If item is a link, copy entire link.','gogalapagos'),
            )
        ),
        'context' => 'normal',
    );

    // Metaboxes para Tours
    $meta_boxes[] = array(
        'title'      => '<i class="fa fa-list-ul" aria-hidden="true"></i> ' . __( 'Tour Featured Information', 'gogalapagos' ),
        'post_types' => array('ggtour', 'ggpackage'),
        'fields'     => array(
            array(
                'name' => 'Dispo CODE',
                'id' => $prefix . 'dispo_code',
                'type' => 'text',
                'maxlength' => 10,
            ),
            array(
                'name' => 'Price / $ - From',
                'id' => $prefix . 'tour_price',
                'type' => 'text',
                'pattern' => '[0-9]+.+[0-9]{2}'
            )
        ),
        'context' => 'side',
    );

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
                'placeholder' => 'Type a short title',
                'desc' => 'This content will appear in the boucher information'
            ),
            array(
                'name' => '<span style="color: darkorange; font-weight: bold;">Alter Services Description</span>',
                'id' => $prefix . 'service_group_description_alter_1',
                'type' => 'textarea',
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
                'placeholder' => 'Type a short title',
                'desc' => 'This content will appear in the boucher information'
            ),
            array(
                'name' => '<span style="color: darkorange; font-weight: bold;">Alter Services Description</span>',
                'id' => $prefix . 'service_group_description_alter_2',
                'type' => 'textarea',
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
                'placeholder' => 'Type a short title',
                'desc' => 'This content will appear in the boucher information'
            ),
            array(
                'name' => '<span style="color: darkorange; font-weight: bold;">Alter Services Description</span>',
                'id' => $prefix . 'service_group_description_alter_3',
                'type' => 'textarea',
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
                'placeholder' => 'Type a short title',
                'desc' => 'This content will appear in the boucher information'
            ),
            array(
                'name' => '<span style="color: darkorange; font-weight: bold;">Alter Services Description</span>',
                'id' => $prefix . 'service_group_description_alter_4',
                'type' => 'textarea',
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
                'placeholder' => 'Type a short title',
                'desc' => 'This content will appear in the boucher information'
            ),
            array(
                'name' => '<span style="color: darkorange; font-weight: bold;">Alter Services Description</span>',
                'id' => $prefix . 'service_group_description_alter_5',
                'type' => 'textarea',
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
                'placeholder' => 'Type a short title',
                'desc' => 'This content will appear in the boucher information'
            ),
            array(
                'name' => '<span style="color: darkorange; font-weight: bold;">Alter Services Description</span>',
                'id' => $prefix . 'service_group_description_alter_6',
                'type' => 'textarea',
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
                'placeholder' => 'Type a short title',
                'desc' => 'This content will appear in the boucher information'
            ),
            array(
                'name' => '<span style="color: darkorange; font-weight: bold;">Alter Services Description</span>',
                'id' => $prefix . 'service_group_description_alter_7',
                'type' => 'textarea',
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
                'placeholder' => 'Type a short title',
                'desc' => 'This content will appear in the boucher information'
            ),
            array(
                'name' => '<span style="color: darkorange; font-weight: bold;">Alter Services Description</span>',
                'id' => $prefix . 'service_group_description_alter_8',
                'type' => 'textarea',
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
                'placeholder' => 'Type a short title',
                'desc' => 'This content will appear in the boucher information'
            ),
            array(
                'name' => '<span style="color: darkorange; font-weight: bold;">Alter Services Description</span>',
                'id' => $prefix . 'service_group_description_alter_9',
                'type' => 'textarea',
                'desc' => 'This content will appear in the website, <span style="color: green; font-weight: bold;">Please complete this items to show on website and boucher</span>'
            ),
        ),
        'priority' => 'high',
        'context' => 'normal',
    );
    /* codigo de la disponibilidad */
    $meta_boxes[] = array(
        'id'         => 'ship_info_dispo_webservice',
        'title'      => '<i class="dashicons dashicons-paperclip"></i> ' . __( 'Kleintours Dispo System', 'gogalapagos' ),
        'post_types' => array('ggcabins', 'ggships', 'ggtour', 'ggpackage'),
        'context'    => 'side',
        'priority'   => 'high',
        'fields' => array(
            array(
                'id' => $prefix . 'dispo_ID',
                'name' => '<i class="dashicons dashicons-arrow-right"></i> ' . esc_html__( 'Dispo Code', 'gogalapagos' ),
                'type' => 'text',
                //'disabled' => true,
            )
        )
    );
    
    /* ESTRELLITAS PARA COMENTARIOS */
    $meta_boxes[] = array(
        'id'         => 'ship_info_dispo_webservice',
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
    
    return $meta_boxes;
}
?>
