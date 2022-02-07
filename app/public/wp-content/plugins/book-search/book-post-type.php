<?php 
/* Register custom post type Book and taxonomy for Publisher and Author*/

function book_post_type() {
    $labels = array (
        'name' => esc_html__('Books', 'anybook'),
        'singular_name' => esc_html__('Book', 'anybook'),
        'menu_name' => esc_html__('Books', 'anybook'),
        'all_items' => esc_html__('All Books', 'anybook'),
        'view_item' => esc_html__('View Book', 'anybook'),
        'add_new_item' => esc_html__('Add New Book', 'anybook'),
        'add_new' => esc_html__('Add New', 'anybook'),
        'edit_item' => esc_html__('Edit Book', 'anybook'),
        'update_item' => esc_html__('Update Book', 'anybook'),
        'search_items' => esc_html__('Search Book', 'anybook'),
        'not_found' => esc_html__('Book Not Found', 'anybook'),
        'not_found_in_trash' => esc_html__('Not Found in Trash', 'anybook')
    );
    $arguments = array(
        'label' => esc_html__('books', 'anybook'),
        'description' => esc_html__('Book Selection', 'anybook'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'taxonomies' => array('category', 'post_tag'),
        'public' => true,
        'hierarchical' => false,
        'menu_icon' => 'dashicons-book-alt',
        'show_ui' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
    );
    register_post_type('books', $arguments);

    register_taxonomy('book_author', 'books',
        array(
            'labels' => array(
                'name' => esc_html__( 'Author', 'anybook' ),
                'add_new_item' => esc_html__( 'Add New Author', 'anybook' ),
                'new_item_name' => esc_html__( 'New Author Type', 'anybook' ),
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => false,
            'show_in_rest' => true,
            'public' => true
        )
    );

    register_taxonomy('book_publisher', 'books',
        array(
            'labels' => array(
                'name' => esc_html__( 'Book Publisher', 'anybook' ),
                'add_new_item'  => esc_html__( 'Add New Publisher', 'anybook' ),
                'new_item_name' => esc_html__( 'New Publisher Type', 'anybook' ),
            ),
            'show_ui'       => true,
            'show_tagcloud' => false,
            'hierarchical'  => false,
            'show_in_rest' => true,
            'public' => true,
            'rewrite' => array('slug' => 'book_publisher'),
        )
    );
}
add_action('init', 'book_post_type');