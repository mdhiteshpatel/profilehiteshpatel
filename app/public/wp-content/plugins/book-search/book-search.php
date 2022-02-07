<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              Hitesh
 * @since             1.0.0
 * @package           Book_Search
 *
 * @wordpress-plugin
 * Plugin Name:       Booksearch
 * Plugin URI:        Booksearch
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Hitesh
 * Author URI:        Hitesh
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       book-search
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'BOOK_SEARCH_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-book-search-activator.php
 */
function activate_book_search() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-book-search-activator.php';
	Book_Search_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-book-search-deactivator.php
 */
function deactivate_book_search() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-book-search-deactivator.php';
	Book_Search_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_book_search' );
register_deactivation_hook( __FILE__, 'deactivate_book_search' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-book-search.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
// function booksearch_files() {
//     wp_enqueue_script('pricerange_js', plugin_dir_url(__FILE__). '/public/js/rangeslide.js', array('jquery'), '1.0', true);
// }
// add_action( 'wp_enqueue_scripts', 'booksearch_files');
function my_ajax_filter_search_scripts() {
    wp_enqueue_script( 'my_ajax_filter_search', plugin_dir_url(__FILE__). '/public/js/script.js', array(), '1.0', true );
    wp_localize_script( 'my_ajax_filter_search', 'ajax_url', admin_url('admin-ajax.php') );
}

require_once('book-post-type.php');
require_once('search-shortcode.php');


// Ajax Callback
 
add_action('wp_ajax_my_ajax_filter_search', 'my_ajax_filter_search_callback');
add_action('wp_ajax_nopriv_my_ajax_filter_search', 'my_ajax_filter_search_callback');
 
function my_ajax_filter_search_callback() {
 
    header("Content-Type: application/json"); 
 
    $meta_query = array('relation' => 'AND');
	$tax_query = array('relation' => '=');
 
    if(isset($_GET['book_author'])) {
        $author = sanitize_text_field( $_GET['book_author'] );
        $tax_query[] = array(
            'taxonomy' => 'book_author',
            'field' => 'slug',
            'terms' => $author
        );
    }
    
	if(isset($_GET['book_publisher'])) {
        $publisher = sanitize_text_field( $_GET['book_publisher'] );
        $tax_query[] = array(
            'taxonomy' => 'book_publisher',
            'field' => 'slug',
            'terms' => $publisher
        );
    }
    if(isset($_GET['rating'])) {
        $rating = sanitize_text_field( $_GET['rating'] );
        $meta_query[] = array(
            'key' => 'rating',
            'value' => $rating,
            'compare' => '='
        );
    }
 
    if(isset($_GET['price'])) {
        $price = sanitize_text_field( $_GET['price'] );
        $meta_query[] = array(
            'key' => 'price',
            'value' => $price,
            'compare' => '='
        );
    }
 
	$args = array(
        'post_type' => 'books',
        'posts_per_page' => -1,
        'meta_query' => $meta_query,
        'tax_query' => $tax_query
    );
 
    if(isset($_GET['search'])) {
        $search = sanitize_text_field( $_GET['search'] );
        $search_query = new WP_Query( array(
            'post_type' => 'books',
            'posts_per_page' => -1,
            'meta_query' => $meta_query,
            'tax_query' => $tax_query,
            's' => $search
        ) );
    } else {
        $search_query = new WP_Query( $args );
    }
 
    if ( $search_query->have_posts() ) {
 
        $result = array();
 
        while ( $search_query->have_posts() ) {
            $search_query->the_post();
			
			$bookauthor = strip_tags( get_terms(", ") );
            $bookpublisher = strip_tags( get_terms(", ") );
            $result[] = array(
                "id" => get_the_ID(),
                "title" => get_the_title(),
                "content" => get_the_content(),
                "permalink" => get_permalink(),
                "rating" => get_field('rating'),
				"price" => get_field('price'),
				"book_author" => $bookauthor,
                "book_publisher" => $bookpublisher,
                "poster" => wp_get_attachment_url(get_post_thumbnail_id($post->ID),'full')
            );
        }
        wp_reset_query();
 
        echo json_encode($result);
 
    } else {
        // no posts found
    }
    wp_die();
}




function run_book_search() {

	$plugin = new Book_Search();
	$plugin->run();

}
run_book_search();
