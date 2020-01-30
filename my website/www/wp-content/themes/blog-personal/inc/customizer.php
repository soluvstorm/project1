<?php
/**
 * Blog Personal Theme Customizer
 *
 * @package Blog_Personal
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function blog_personal_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Load Theme Option.
	require get_template_directory() . '/inc/customizer/control.php';	

	// Load Callback option.
	require get_template_directory() . '/inc/customizer/callback.php';		

	// Load Customize Sanitize.
	require trailingslashit( get_template_directory() ) . '/inc/customizer/sanitize.php';

	// Load Theme Option.
	require get_template_directory() . '/inc/customizer/theme-section.php';
		

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'blog_personal_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'blog_personal_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'blog_personal_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function blog_personal_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function blog_personal_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function blog_personal_customize_preview_js() {
	wp_enqueue_script( 'blog-personal-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'blog_personal_customize_preview_js' );
