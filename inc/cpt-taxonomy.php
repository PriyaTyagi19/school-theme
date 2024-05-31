<?php
function school_register_custom_post_types() {
    
    // Register Staff
    $labels = array(
        'name'                  => _x( 'Staff', 'post type general name' ),
        'singular_name'         => _x( 'Staff', 'post type singular name'),
        'menu_name'             => _x( 'Staff', 'admin menu' ),
        'name_admin_bar'        => _x( 'Staff', 'add new on admin bar' ),
        'add_new'               => _x( 'Add New', 'staff' ),
        'add_new_item'          => __( 'Add New staff' ),
        'new_item'              => __( 'New staff' ),
        'edit_item'             => __( 'Edit staff' ),
        'view_item'             => __( 'View staff' ),
        'all_items'             => __( 'All staff' ),
        'search_items'          => __( 'Search staff' ),
        'parent_item_colon'     => __( 'Parent staff:' ),
        'not_found'             => __( 'No staff found.' ),
        'not_found_in_trash'    => __( 'No staff found in Trash.' ),
        'archives'              => __( 'staff Archives'),
        'insert_into_item'      => __( 'Insert into staff'),
        'uploaded_to_this_item' => __( 'Uploaded to this staff'),
        'filter_item_list'      => __( 'Filter staff list'),
        'items_list_navigation' => __( 'staff list navigation'),
        'items_list'            => __( 'staff list'),
        'featured_image'        => __( 'staff featured image'),
        'set_featured_image'    => __( 'Set staff featured image'),
        'remove_featured_image' => __( 'Remove staff featured image'),
        'use_featured_image'    => __( 'Use as featured image'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'staff' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-archive',
        'supports'           => array( 'title' ),
    );

    register_post_type( 'staff', $args );

}
add_action( 'init', 'school_register_custom_post_types' );


function school_register_taxonomies() {
    // Add Staff Taxonomy taxonomy
    $labels = array(
        'name'              => _x( 'Staff Taxonomy', 'taxonomy general name' ),
        'singular_name'     => _x( 'Staff Taxonomy', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Staff Taxonomy' ),
        'all_items'         => __( 'All Staff Taxonomy' ),
        'parent_item'       => __( 'Parent Staff Taxonomy' ),
        'parent_item_colon' => __( 'Parent Staff Taxonomy:' ),
        'edit_item'         => __( 'Edit Staff Taxonomy' ),
        'view_item'         => __( 'Vview Staff Taxonomy' ),
        'update_item'       => __( 'Update Staff Taxonomy' ),
        'add_new_item'      => __( 'Add New Staff Taxonomy' ),
        'new_item_name'     => __( 'New Staff Taxonomy Name' ),
        'menu_name'         => __( 'Staff Taxonomy' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_in_nav_menu'  => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'Staff-Taxonomy' ),
    );
    register_taxonomy( 'school-Staff-Taxonomy', array( 'staff' ), $args );
}
add_action( 'init', 'school_register_taxonomies');




// this flushes the permalink when switching themes
function school_rewrite_flush() {
    school_register_custom_post_types();
    school_register_taxonomies();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'school_rewrite_flush' );
