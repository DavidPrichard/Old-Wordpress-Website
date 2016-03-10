<?php
/**
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 */

get_header(); ?>

<main role="main">
	<h1 class="archive-title">
		<?php the_archive_title(); ?>
	</h1>

	<?php while ( have_posts() ) : the_post();
		get_template_part('content', get_post_format());
	endwhile;

	if ( !have_posts() ) :
		get_template_part('content', 'none');
	endif;

	trichotomy_paging_nav(); ?>
</main>

<?php
get_sidebar();
get_footer();