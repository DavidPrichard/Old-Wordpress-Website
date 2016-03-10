<?php
/**
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file; functions that are not wrapped are instead attached to
 * a filter or action hook.
 */

function trichotomy_setup() {

	add_editor_style( 'inc/editor-style.css' );

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 672, 372, true );
	add_image_size( 'trichotomy-full-width', 1038, 576, true );

	// Registers the primary menu for use with wp_nav_menu().
	register_nav_menu( 'primary', 'Primary Menu' );

	// HTML5 markup for several Wordpress features
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'widgets'
	) );
}
add_action( 'after_setup_theme', 'trichotomy_setup' );


function trichotomy_scripts() {

	wp_enqueue_style( 'trichotomy-style', get_stylesheet_uri(), array(), '1.0' );
/*
	wp_enqueue_script( 'trichotomy-script', get_stylesheet_directory_uri() . '/js/functions.js', array( 'jquery' ), '20140319');
*/
}
add_action( 'wp_enqueue_scripts', 'trichotomy_scripts' );


// Performance: adds "defer" to all enqueued scripts
function script_tag_defer($tag, $handle) {
	if (!is_admin()) {
	return str_replace( ' src', ' defer src', $tag );
	}
}
add_filter('script_loader_tag', 'script_tag_defer', 10, 2);

// Performance: removes JQuery-Migrate
function remove_jquery_migrate( &$scripts) {
	if(!is_admin()) {
		$scripts->remove( 'jquery');
		$scripts->add( 'jquery', false, array( 'jquery-core' ), '1.10.2' );
	}
}
add_filter( 'wp_default_scripts', 'remove_jquery_migrate' );

// Security: removes Windows-Live-Writer links from <head>
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');

// Security: removes WP version from <head>
function hide_wp_version()
{
	return '';
}
add_filter('the_generator','hide_wp_version');

// Registers the sidebar as a widget area.
function trichotomy_widgets_init() {

	register_sidebar( array(
		'name'          => 'Primary Sidebar',
		'id'            => 'sidebar-1',
		'description'   => 'Main sidebar.',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'trichotomy_widgets_init' );


/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Presence of header image.
 * 2. List views.
 * 3. Single views.
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function trichotomy_body_classes( $classes ) {

	if ( get_header_image() ) {
		$classes[] = 'header-image';
	}

	if ( is_archive() || is_search() || is_home() ) {
		$classes[] = 'list-view';
	}


	if ( is_singular() && ! is_front_page() ) {
		$classes[] = 'singular';
	}

	return $classes;
}
add_filter( 'body_class', 'trichotomy_body_classes' );

/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Page with a post thumbnail.
 *
 * @param array $classes A list of existing post class values.
 * @return array The filtered post class list.
 */
function trichotomy_post_classes( $classes ) {
	if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) {
		$classes[] = 'has-post-thumbnail';
	}

	return $classes;
}
add_filter( 'post_class', 'trichotomy_post_classes' );


// Custom Header features
require get_stylesheet_directory() . '/inc/custom-header.php';

// Custom template tags
require get_stylesheet_directory() . '/inc/template-tags.php';

// Theme Customizer
require get_stylesheet_directory() . '/inc/customizer.php';

// Less confusing titles when date queries get a 404 response
function trichotomy_404_date_title() {
	$day = get_query_var( 'day', '0');
	$year = get_query_var( 'year', '0');
	$monthNum = get_query_var( 'monthnum', '0');
	$monthDateObject = DateTime::createFromFormat('!m', $monthNum);
	$month = $monthDateObject->format('F');

	if ( $day != 0 ) {
		$title = printf( 'Day: %1$s %2$s, %3$s', $month, $day, $year );
	} elseif ( $monthNum != 0 ) {
		$title = printf( 'Month: %1$s, %2$s', $month, $year );
	} elseif ( $year != 0 ) {
		$title = printf( 'Year: %1$s', $year );
	} else {
		$title = printf( 'Not found' );
	}

	return apply_filters( 'get_the_archive_title', $title );
}

// Custom markup for individual comments
function trichotomy_comment_callback( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);
	$add_below = 'comment';
	?>

	<li <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<section class=comment-body>

		<div class="comment-author">
			<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
			<?php printf( '<b class="author-name">%s:</b>', get_comment_author_link() ); ?>
		</div>

		<?php if ( $comment->comment_approved == '0' ) : ?>
			<b class="comment-awaiting-moderation">Your comment is awaiting moderation.</b>
		<?php endif; ?>

		<div class="comment-meta"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php printf( '%1$s at %2$s', get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( 'Edit', '  ', '' ); ?>
		</div>

		<div class="comment-content">
			<?php comment_text(); ?>
		</div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div>

	</section>
<?php
}


// Custom Walker_Nav_Menu
class trichotomy_walker_nav_menu extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"sub-menu\">\n";
	}
}