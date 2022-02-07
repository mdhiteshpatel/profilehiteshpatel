<?php
/**
 * demo-theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package demo-theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function demo_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on demo-theme, use a find and replace
		* to change 'demo-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'demo-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	add_theme_support("editor-styles");
	add_editor_style('style-editor.css');
	add_theme_support("responsive-embeds");
	add_theme_support("align-wide");
	add_theme_support('editor-color-palette', array(
		array(
			'name' => esc_attr__('strong magenta', 'themeLangDomain'),
			'slug' => 'strong-magenta',
			'color' => '#a156b4'
		),
		array(
			'name' => esc_attr__('very light gray', 'themeLangDomain'),
			'slug' => 'very-light-gray',
			'color' => '#eee'
		),
	));
	add_theme_support('disable-custom-colors');
	add_theme_support('editor-gradient-presets', array(
		array(
			'name' => esc_attr__('Red to Blue', 'themeLangDomain'),
			'gradient' => 'linear-gradient(135deg,#e4064d 0%, #2c59ee 100%)',
			'slug' => 'red-to-blue'
		),
		array(
			'name' => esc_attr__('Green to Yellow', 'themeLangDomain'),
			'gradient' => 'linear-gradient(135deg, #3ce406 0%, #d6e029 100%)',
			'slug' => 'green-to-yellow'
		),
	));
	add_theme_support('disable-custom-gradients');
	add_theme_support('editor-font-sizes', array(
		array(
			'name' => esc_attr__('Small', 'themeLangDomain'),
			'size' => 12,
			'slug' => 'small'
		),
		array(
			'name' => esc_attr__('Regular', 'themeLangDomain'),
			'size' => 16,
			'slug' => 'regular'
		),
		array(
			'name' => esc_attr__('Large', 'themeLangDomain'),
			'size' => 36,
			'slug' => 'large'
		)
		));
		add_theme_support('disable-custom-font-sizes');
		add_theme_support('custom-line-height');
		add_theme_support('custom-spacing');
		add_theme_support('custom-units', "rem", "em", "px");
	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'demo-theme' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'demo_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'demo_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function demo_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'demo_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'demo_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function demo_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'demo-theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'demo-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'demo_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function demo_theme_scripts() {
	wp_enqueue_style( 'demo-theme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'demo-theme-style', 'rtl', 'replace' );
	wp_enqueue_style('demo_fa_style', get_theme_file_uri('js/all.min.css'));
	wp_enqueue_script( 'demo-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'demo_theme_scripts' );
// function my_ajax_filter_search_scripts() {
//     wp_enqueue_script( 'my_ajax_filter_search', get_stylesheet_directory_uri(). '/js/script.js', array(), '1.0', true );
//     wp_localize_script( 'my_ajax_filter_search', 'ajax_url', admin_url('admin-ajax.php') );
// }
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
function demo_gutenberg_block() {
	wp_register_script('demo-block-script', get_template_directory_uri() . '/blocks/index.build.js',
    	array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n'), '1.0'
	);
	wp_register_style('demo-block-style', get_template_directory_uri() . '/assets/css/block.css', array(), '1.0');

	/* register block type */
    register_block_type(
    	'demo/demo-blocks',
		array(
			'editor_script' => 'demo-block-script',
			'editor_style'  => 'demo-block-style',
		)
	);
}
add_action( 'enqueue_block_editor_assets', 'demo_gutenberg_block' );
function demo_register_dynamic_block() {
	register_block_type(
		'demo/latest-posts',
		array(
			'attributes' => array(
				'noPosts' => array (
					'type' => 'number',
					'default' => 1
				)
			),
			'render_callback' => 'demo_latest_posts_render_callback',
		)
	);
}
add_action( 'init', 'demo_register_dynamic_block' );

function demo_latest_posts_render_callback( $attr ){
	// var_dump($attr);
	// exit;
	$no_posts = isset($attr['noPosts']) && !empty($attr['noPosts']) ? $attr['noPosts'] : 1;
	$args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' => $no_posts,
	);
	$query = new WP_Query( $args );
	ob_start();
	?>
	<div class="latest-posts">
		<h1>Latest Posts</h1>
				<?php
				if ( $query->have_posts() ) {

					while ( $query->have_posts() ) {

						$query->the_post();
						?>
						<div class="post-item">
							<h2><?php the_title(); ?></h2>
							<?php the_excerpt(); ?>
						</div>
						<?php
					}

				}
				?>
			</div>
	<?php
	$html = ob_get_clean();
	return $html;
}

function demo_register_dynamic_post_block() {
	register_block_type(
		'demo/post-categories',
		array(
			'attributes' => array(
				'postCategory' => array (
					'type' => 'string',
					'default' => ''
				),
				'categories' => array (
					'type' => 'object'
				)
			),
			'render_callback' => 'demo_posts_categories_render_callback',
		)
	);
}
add_action( 'init', 'demo_register_dynamic_post_block' );

function demo_posts_categories_render_callback( $attr ){
	// var_dump($attr);
	// exit;
	$postcat = isset($attr['postCategory']) && !empty($attr['postCategory']) ? $attr['postCategory'] : '';
	// var_dump($postcat);
	// exit;
	$args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'category_name' => $postcat
	);
	// var_dump($args);
	// exit;
	$query = new WP_Query( $args );
	// var_dump($query);
	// exit;
	ob_start();
	?>
	<div class="latest-posts">
		<h1>Latest Posts</h1>
				<?php
				if ( $query->have_posts() ) {

					while ( $query->have_posts() ) {

						$query->the_post();
						?>
						<div class="post-item">
							<h2><?php the_title(); ?></h2>
							<?php the_excerpt(); ?>
						</div>
						<?php
					}

				}
				?>
			</div>
	<?php
	$html = ob_get_clean();
	return $html;
}

// Allow SVG
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

	global $wp_version;
	if ( $wp_version !== '4.7.1' ) {
	   return $data;
	}
  
	$filetype = wp_check_filetype( $filename, $mimes );
  
	return [
		'ext'             => $filetype['ext'],
		'type'            => $filetype['type'],
		'proper_filename' => $data['proper_filename']
	];
  
  }, 10, 4 );
  
  function cc_mime_types( $mimes ){
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
  }
  add_filter( 'upload_mimes', 'cc_mime_types' );
  
  function fix_svg() {
	echo '<style type="text/css">
		  .attachment-266x266, .thumbnail img {
			   width: 100% !important;
			   height: auto !important;
		  }
		  </style>';
  }
  add_action( 'admin_head', 'fix_svg' );