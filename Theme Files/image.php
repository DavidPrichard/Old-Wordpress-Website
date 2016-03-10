<?php 
$metadata = wp_get_attachment_metadata();

get_header();
?>

<main class="image-attachment" role="main">
<?php while ( have_posts() ) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

			<div class="entry-meta">

				<span class="entry-date"><time class="entry-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></span>

				<span class="full-size-link"><a href="<?php echo wp_get_attachment_url(); ?>"><?php echo $metadata['width']; ?> &times; <?php echo $metadata['height']; ?></a></span>

				<span class="parent-post-link"><a href="<?php echo get_permalink( $post->post_parent ); ?>" rel="gallery"><?php echo get_the_title( $post->post_parent ); ?></a></span>

				<?php edit_post_link('Edit', '<span class="edit-link">', '</span>' ); ?>

			</div>
		</header>

		<div class="entry-content">
			<div class="entry-attachment">
				<div class="attachment">
					<?php trichotomy_the_attached_image(); ?>
				</div>

				<?php if ( has_excerpt() ) : ?>
					<div class="entry-caption">
						<?php the_excerpt(); ?>
					</div>
				<?php endif; ?>
			</div>

			<?php the_content();
				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . 'Pages:' . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) );
			?>
		</div>
	</article>

	<nav id="image-navigation" class="image-navigation">
		<div class="nav-links">
			<?php previous_image_link( false, '<div class="previous-image">' . 'Previous Image' . '</div>' ); ?>
			<?php next_image_link( false, '<div class="next-image">' . 'Next Image' . '</div>' ); ?>
		</div>
	</nav>

	<?php comments_template(); ?>

<?php endwhile; // end of the loop. ?>
</main>

<?php
get_sidebar();
get_footer();