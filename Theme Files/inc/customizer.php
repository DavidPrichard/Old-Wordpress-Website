<?php
/**
 * Supports the 'Customize' section of the visual editor
 * by implementing Theme Customizer additions and adjustments.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function trichotomy_customize_register( $wp_customize ) {
	// Add custom description to Colors and Background sections.
	$wp_customize->get_section( 'colors' )->description           = 'Background may only be visible on wide screens.';
	$wp_customize->get_section( 'background_image' )->description = 'Background may only be visible on wide screens.';

	// Add postMessage support for site title and description.
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Rename the label to "Site Title Color" because this only affects the site title in this theme.
	$wp_customize->get_control( 'header_textcolor' )->label = 'Site Title Color';

	// Rename the label to "Display Site Title & Tagline" in order to make this option extra clear.
	$wp_customize->get_control( 'display_header_text' )->label = 'Display Site Title &amp; Tagline';

}
add_action( 'customize_register', 'trichotomy_customize_register' );

/* Bind JS handlers to make Theme Customizer preview reload changes asynchronously. */
function trichotomy_customize_preview_js() {
	wp_enqueue_script( 'trichotomy_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20131205', true );
}
add_action( 'customize_preview_init', 'trichotomy_customize_preview_js' );

/* Add contextual help to the Themes and Post edit screens. */
function trichotomy_contextual_help() {
	if ( 'admin_head-edit.php' === current_filter() && 'post' !== $GLOBALS['typenow'] ) {
		return;
	}

	get_current_screen()->add_help_tab( array(
		'id'      => 'trichotomy',
		'title'   => __( 'Trichotomy', 'trichotomy' ),
		'content' =>
			'<ul>' .
				'<li>' . sprintf( 'The home page features your choice of up to 6 posts prominently displayed in a grid or slider, controlled by a <a href="%1$s">tag</a>; you can change the tag and layout in <a href="%2$s">Appearance &rarr; Customize</a>. If no posts match the tag, <a href="%3$s">sticky posts</a> will be displayed instead.', esc_url( add_query_arg( 'tag', admin_url( 'edit.php' ) ) ), admin_url( 'customize.php' ), admin_url( 'edit.php?show_sticky=1' ) ) . '</li>' .
				'<li>' . sprintf( 'Enhance your site design by using <a href="%s">Post Thumbnails</a> for posts you&rsquo;d like to stand out. This allows you to associate an image with your post without inserting it. Trichotomy uses featured images for posts and pages above the title.', 'http://codex.wordpress.org/Post_Thumbnails#Setting_a_Post_Thumbnail' ) . '</li>' .
			'</ul>',
	) );
}
add_action( 'admin_head-themes.php', 'trichotomy_contextual_help' );
add_action( 'admin_head-edit.php',   'trichotomy_contextual_help' );
