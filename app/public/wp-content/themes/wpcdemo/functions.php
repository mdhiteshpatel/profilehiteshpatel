<?php
function twentytwentyone_styles() {
    wp_enqueue_style( 'child-style', get_template_directory_uri().'/style.css');
}
add_action( 'wp_enqueue_scripts', 'twentytwentyone_styles');

// Custom post type movie
function register_custom_post_type_movie() {
    $args = array(
        "label" => __( "Movies", "" ),
        "labels" => array(
            "name" => __( "Movies", "" ),
            "singular_name" => __( "Movie", "" ),
            "featured_image" => __( "Movie Poster", "" ),
            "set_featured_image" => __( "Set Movie Poster", "" ),
            "remove_featured_image" => __( "Remove Movie Poster", "" ),
            "use_featured_image" => __( "Use Movie Poster", "" ),
        ),
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => false,
        "has_archive" => false,
        "show_in_menu" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array( "slug" => "movie", "with_front" => true ),
        "query_var" => true,
        "supports" => array( "title", "editor", "thumbnail" ),
        "taxonomies" => array( "category" ),
    );
    register_post_type( "movie", $args );
}
add_action( 'init', 'register_custom_post_type_movie' );

function my_ajax_filter_search_scripts() {
    wp_enqueue_script( 'my_ajax_filter_search', get_stylesheet_directory_uri(). '/script.js', array(), '1.0', true );
    wp_localize_script( 'my_ajax_filter_search', 'ajax_url', admin_url('admin-ajax.php') );
}


// Shortcode:
function my_ajax_filter_search_shortcode() {
    my_ajax_filter_search_scripts();
    ob_start(); ?>
    <div id="my-ajax-filter-search">
        <form action="" method="get">
            <input type="text" name="search" id="search" value="" placeholder="Search Here..">
            <div class="column-wrap">
                <div class="column">
                    <label for="year">Year</label>
                    <input type="number" name="year" id="year">
                </div>
                <div class="column">
                    <label for="rating">Rating</label>
                    <select name="rating" id="rating">
                        <option value="">Any Rating</option>
                        <option value="5">5</option>
                        <option value="4">4</option>
                        <option value="3">3</option>
                        <option value="2">2</option>
                        <option value="1">1</option>
                    </select>
                </div>
            </div>
            <div class="column-wrap">
                <div class="column">
                    <label for="language">Language</label>
                    <select name="language" id="language">
                        <option value="">Any Language</option>
                        <option value="english">English</option>
                        <option value="korean">Korean</option>
                        <option value="hindi">Hindi</option>
                        <option value="serbian">Serbian</option>
                        <option value="malayalam">Malayalam</option>
                    </select>
                </div>
                <div class="column">
                    <label for="genre">Genre</label>
                    <select name="genre" id="genre">
                        <option value="">Any Genre</option>
                        <option value="action">Action</option>
                        <option value="comedy">Comedy</option>
                        <option value="drama">Drama</option>
                        <option value="horror">Horror</option>
                        <option value="romance">Romance</option>
                    </select>
                </div>
            </div>
            <input type="submit" id="submit" name="submit" value="Search">
        </form>
        <ul id="ajax_filter_search_results"></ul>
    </div>

     
    <?php
    return ob_get_clean();
}
 
add_shortcode ('my_ajax_filter_search', 'my_ajax_filter_search_shortcode');

// Ajax Callback
 
add_action('wp_ajax_my_ajax_filter_search', 'my_ajax_filter_search_callback');
add_action('wp_ajax_nopriv_my_ajax_filter_search', 'my_ajax_filter_search_callback');
 
function my_ajax_filter_search_callback() {
 
    header("Content-Type: application/json"); 
 
    $meta_query = array('relation' => 'AND');
 
    if(isset($_GET['year'])) {
        $year = sanitize_text_field( $_GET['year'] );
        $meta_query[] = array(
            'key' => 'year',
            'value' => $year,
            'compare' => '='
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
 
    if(isset($_GET['language'])) {
        $language = sanitize_text_field( $_GET['language'] );
        $meta_query[] = array(
            'key' => 'language',
            'value' => $language,
            'compare' => '='
        );
    }
 
    if(isset($_GET['genre'])) {
        $genre = sanitize_text_field( $_GET['genre'] );
        $meta_query[] = array(
            'key' => 'genre',
            'value' => $genre,
            'compare' => '='
        );
    }
 
    $args = array(
        'post_type' => 'movie',
        'posts_per_page' => -1,
        'meta_query' => $meta_query,
    );
 
    if(isset($_GET['search'])) {
        $search = sanitize_text_field( $_GET['search'] );
        $search_query = new WP_Query( array(
            'post_type' => 'movie',
            'posts_per_page' => -1,
            'meta_query' => $meta_query,
            's' => $search
        ) );
    } else {
        $search_query = new WP_Query( $args );
    }
 
    if ( $search_query->have_posts() ) {
 
        $result = array();
 
        while ( $search_query->have_posts() ) {
            $search_query->the_post();
 
            $result[] = array(
                "id" => get_the_ID(),
                "title" => get_the_title(),
                "content" => get_the_content(),
                "permalink" => get_permalink(),
                "year" => get_field('year'),
                "rating" => get_field('rating'),
                "language" => get_field('language'),
                "genre" => get_field('genre')
            );
        }
        wp_reset_query();
 
        echo json_encode($result);
 
    } else {
        // no posts found
    }
    wp_die();
}