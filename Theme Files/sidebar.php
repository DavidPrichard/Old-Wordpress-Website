<?php
/* The sidebar containing the main widget area */
?>

<div id="sidebar" role="complementary">
	<?php if ( has_nav_menu( 'secondary' ) ) : ?>
		<nav role="navigation" class="site-navigation secondary-navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'secondary' ) ); ?>
		</nav>
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'sidebar-1' ) ) :
		dynamic_sidebar( 'sidebar-1' ); 
	 endif; ?>
</div>