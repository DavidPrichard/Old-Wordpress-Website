<?php
/* Custom template tags */

if ( ! function_exists( 'trichotomy_paging_nav' ) ) :

/* Display navigation to next/previous set of posts when applicable. */
function trichotomy_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => '&larr; Previous',
		'next_text' => 'Next &rarr;',
	) );

	if ( $links ) :

	?>
	<nav class="paging-navigation" role="navigation">
		<h1 class="screen-reader-text">Posts navigation</h1>
		<div class="pagination loop-pagination">
			<?php echo $links; ?>
		</div>
	</nav>
	<?php
	endif;
}
endif;

if ( ! function_exists( 'trichotomy_post_nav' ) ) :

/* Display navigation to next/previous post when applicable. */
function trichotomy_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}

	?>
	<nav class="post-navigation" role="navigation">
		<h1 class="screen-reader-text">'Post navigation'</h1>
		<div class="nav-links">
			<?php
			if ( is_attachment() ) :
				previous_post_link( '%link', '<span class="meta-nav">Published In</span>%title');
			else :
				previous_post_link( '%link', '<span class="meta-nav">Previous Post</span>%title');
				next_post_link( '%link', '<span class="meta-nav">Next Post</span>%title');
			endif;
			?>
		</div>
	</nav>
	<?php
}
endif;

/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index
 * views, or a div element when on single views.
 */
function trichotomy_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="post-thumbnail">
	<?php
		if ( ( ! is_active_sidebar( 'sidebar-2' ) || is_page_template( 'page-templates/full-width.php' ) ) ) {
			the_post_thumbnail( 'trichotomy-full-width' );
		} else {
			the_post_thumbnail();
		}
	?>
	</div>

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>">
	<?php
		if ( ( ! is_active_sidebar( 'sidebar-2' ) || is_page_template( 'page-templates/full-width.php' ) ) ) {
			the_post_thumbnail( 'trichotomy-full-width' );
		} else {
			the_post_thumbnail();
		}
	?>
	</a>

	<?php endif;
}