<?php get_header(); ?>
<main role="main">

<h1 class="archive-title"><?php printf('Search Results for: %s', get_search_query() ); ?></h1>

<?php if ( have_posts() ) : ?>

	<?php while ( have_posts() ) : the_post();
			get_template_part( 'content', get_post_format() );
	endwhile;

	the_posts_navigation();

else :
	get_template_part( 'content', 'none' );
endif; ?>

</main>

<?php
get_sidebar();
get_footer();