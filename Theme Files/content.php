<?php /* The default template for displaying posts, for both single and index/archive/search. */ ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>
<?php trichotomy_post_thumbnail(); ?>

<header class="entry-header">
	<div class="entry-meta">
		<span class="cat-links"><?php echo implode(' | ', array_reverse( explode(',',get_the_category_list(',')))); ?></span>
	</div>

	<?php if ( is_single() ) :
		the_title( '<h1 class="entry-title">', '</h1>' );
	else :
		the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
	endif;	?>

	<div class="entry-meta">
		<?php	printf( '<a class="entry-date" href="%1$s" rel="bookmark"><time datetime="%2$s">%3$s</time></a>',
				esc_url( get_permalink() ),
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() )
			);

		edit_post_link('Edit');	?>
	</div>
</header>

<div class="entry-content">

	<?php if ( is_search() ) : ?>
		<?php the_excerpt(); ?>
</div>
	<?php else : ?>
		<?php the_content('Continue reading  &rarr;');
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . 'Pages:' . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) ); ?>
</div>
<?php endif; ?>

	<?php the_tags( '<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>' ); ?>
</article>
<hr>