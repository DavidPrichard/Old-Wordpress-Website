<?php
/* The Template for displaying all single posts */

get_header(); ?>
<main role="main">

	<?php while ( have_posts() ) : the_post();

		get_template_part( 'content', get_post_format() );

		the_post_navigation();

		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}

	endwhile; ?>

</main>

<?php
get_sidebar();
get_footer();