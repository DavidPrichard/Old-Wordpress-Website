<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width">
	<link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="hfeed">

<?php	if ( get_header_image() ) : ?>
		<div id="custom-header">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="">
			</a>
		</div>
<?php	endif; ?>

<header id="site-header" role="banner">
	<a id="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>

	<div id="header-search">
		<?php get_search_form(); ?>
	</div>

	<nav id="primary-navigation" role="navigation">
		<div class="menu-toggle"></div>
		<? wp_nav_menu( array(
			'container'=> false,
			'menu_class'=>'main-menu',
			'depth'=> 2
		 ) ); ?>
	</nav>
</header>