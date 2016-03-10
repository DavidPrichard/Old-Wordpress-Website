<?php
/* The template for displaying archive-type pages for posts in a tag. */

get_header(); ?>
<main role="main">

<?php 	if ( have_posts() ) : ?>
		<h1 class="archive-title"><?php printf('Tag: %s', single_tag_title( '', false ) ); ?></h1>

		<?php while ( have_posts() ) : the_post();
			get_template_part( 'content', get_post_format() );
		endwhile;

		trichotomy_paging_nav();

	else :
		get_template_part( 'content', 'none' );

	endif;	?>

</main>

<?php
get_sidebar();
get_footer();