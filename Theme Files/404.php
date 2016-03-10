<?php get_header(); ?>

<main>
	<div id="content" role="main">
		<h1 class="archive-title"><?php trichotomy_404_date_title() ?></h1>

		<div class="page-content">
			<p>Nothing was found at this address. Maybe try a search?</p>
			<?php get_search_form(); ?>
		</div>
	</div>
</main>

<?php
get_sidebar();
get_footer();