<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package demo-theme
 */

get_header();
?>

	<main id="primary" class="site-main">
		<span><i class="fas fa-envelope-square"></i></span>
		<span><i class="fab fa-facebook-square"></i></span>
		<span><i class="fas fa-ad"></i></span>
		<?php echo do_shortcode("[test]"); ?>
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'demo-theme' ) . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'demo-theme' ) . '</span> <span class="nav-title">%title</span>',
				)
			);

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
		<!-- The 'likes' meta key value will store the total like count for a specific post, it'll show 0 if it's an empty string -->
<?php
	$likes = get_post_meta($post->ID, "likes", true);
	$likes = ($likes == "") ? 0 : $likes;
?>

This post has <span id='like_counter'><?php echo $likes ?></span> likes<br>

<!-- Linking to the admin-ajax.php file. Nonce check included for extra security. Note the "user_like" class for JS enabled clients. -->
<?php
	$nonce = wp_create_nonce("my_user_like_nonce");
	$link = admin_url('admin-ajax.php?action=my_user_like&post_id='.$post->ID.'&nonce='.$nonce);
	echo '<a class="user_like" data-nonce="' . $nonce . '" data-post_id="' . $post->ID . '" href="' . $link . '">Like this Post</a>';
?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
