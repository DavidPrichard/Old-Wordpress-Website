<?php
/* The main template file */

get_header(); ?>
<main role="main">

<?php	while ( have_posts() ) : the_post();
		get_template_part( 'content', get_post_format() );
	endwhile;

	the_posts_navigation();

	if ( !have_posts() ) :
		get_template_part( 'content', 'none' );
	endif;	?>

</main>

<?php
get_sidebar();
get_footer();