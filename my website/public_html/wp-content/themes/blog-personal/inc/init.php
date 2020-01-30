<?php
/**
 * Load files
 *
 * @package Blog_Personal
 */

/**
 * Include default theme options.
 */
require_once trailingslashit( get_template_directory() ) . 'inc/customizer/default.php';

/**
 * Load Hooks.
 */
require_once trailingslashit( get_template_directory() ) . 'inc/hook/basic.php';
require_once trailingslashit( get_template_directory() ) . 'inc/hook/custom.php';
require_once trailingslashit( get_template_directory() ) . 'inc/hook/class-tgm-plugin-activation.php';


/**
 * Implement the Custom Header feature.
 */
require trailingslashit( get_template_directory() ). '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require trailingslashit( get_template_directory() ). '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require trailingslashit( get_template_directory() ). '/inc/template-functions.php';

/**
 * Implement the Metabox.
 */
require trailingslashit( get_template_directory() ). '/inc/metabox.php';

/**
 * Customizer additions.
 */
require trailingslashit( get_template_directory() ). '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require trailingslashit( get_template_directory() ) . '/inc/jetpack.php';
}

/**
 * Register Slider Widget.
 */
require_once trailingslashit( get_template_directory() ) . '/inc/widget/featured-slider.php';

/**
 * Register Promo Slider Widget.
 */
require_once trailingslashit( get_template_directory() ) . '/inc/widget/promo-slider.php';

/**
 * Register Two Column Widget.
 */
require_once trailingslashit( get_template_directory() ) . '/inc/widget/two-column.php';

/**
 * Register Latest Post Widget.
 */
require_once trailingslashit( get_template_directory() ) . '/inc/widget/latest-post.php';

/**
 * Register Extendede Comment Widget.
 */
require_once trailingslashit( get_template_directory() ) . '/inc/widget/extended-comments.php';

/**
 * Register Video  Widget.
 */
require_once trailingslashit( get_template_directory() ) . '/inc/widget/instagram.php';

/**
 * Register Author Widget.
 */
require_once trailingslashit( get_template_directory() ) . '/inc/widget/author/author.php';

/**
 * Register Social Media Widget.
 */
require_once trailingslashit( get_template_directory() ) . '/inc/widget/social-media.php';

/**
 * One Click Data .
 */
require trailingslashit( get_template_directory() ) . 'demo-content/demo-import-setup.php';