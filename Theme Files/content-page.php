<?php
/* The template used for displaying page content */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		// Page thumbnail and title.
		trichotomy_post_thumbnail();
		the_title( '<header class="entry-header"><h1 class="entry-title">', '</h1></header>' );
	?>

	<div class="entry-content">
		<?php
			the_content();
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . 'Pages:' . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );

			edit_post_link( 'Edit', '<span class="edit-link">', '</span>' );
		?>
	</div>
</article>