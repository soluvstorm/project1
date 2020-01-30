<?php
/**
 * Blog Personal functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Blog_Personal
 */

if ( ! function_exists( 'blog_personal_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function blog_personal_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Blog Personal, use a find and replace
		 * to change 'blog-personal' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'blog-personal', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'blog-personal-featured-slider', 390, 501, true);
		add_image_size( 'blog-personal-featured', 380, 570, true);
		add_image_size( 'blog-personal-latest', 363, 470, true);
		add_image_size( 'blog-personal-related', 360, 300, true);
		add_image_size( 'blog-personal-two-column', 360, 251, true);
		add_image_size( 'blog-personal-promo-slider', 752, 450, true);	
		add_image_size( 'blog-personal-thumb-slider', 60, 60, true);	

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'blog-personal' ),
			'social-media' => esc_html__( 'Social Media', 'blog-personal' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'blog_personal_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 70,
			'width'       => 128,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		add_theme_support( 'custom-header', array(
			'height'      => 360,
			'width'       => 1349,


		) );
		
		add_theme_support('post-formats', array(
			'image',
			'video'
		) );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );	
						
	}
endif;
add_action( 'after_setup_theme', 'blog_personal_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function blog_personal_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'blog_personal_content_width', 640 );
}
add_action( 'after_setup_theme', 'blog_personal_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function blog_personal_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'blog-personal' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'blog-personal' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Home Sidebar', 'blog-personal' ),
		'id'            => 'sidebar-home',
		'description'   => esc_html__( 'Add widgets here.', 'blog-personal' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Featured Slider', 'blog-personal' ),
		'id'            => 'featured-slider-section',
		'description'   => esc_html__( 'This sidebar will appear below menu section.', 'blog-personal' ),
		'before_widget' => '<section id="%1$s" class="%2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="entry-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Home Widget Area', 'blog-personal' ),
		'id'            => 'home-widget',		
		'before_widget' => '<section id="%1$s" class="%2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="entry-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Instagram Area', 'blog-personal' ),
		'id'            => 'insta-widget',		
		'before_widget' => '<section id="%1$s" class="%2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="entry-title">',
		'after_title'   => '</h2>',
	) );			
}
add_action( 'widgets_init', 'blog_personal_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function blog_personal_scripts() {

	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() .'/assets/css/font-awesome' . $min . '.css', '', '4.7.0' );

	$fonts_url = blog_personal_fonts_url();

	if ( ! empty( $fonts_url ) ) {
		wp_enqueue_style( 'blog-personal-google-fonts', $fonts_url, array(), null );
	}


	wp_enqueue_style( 'owl.carousel', get_template_directory_uri() .'/assets/css/owl.carousel' . $min . '.css', '', 'v2.2.1' );

	wp_enqueue_style( 'owl.theme.default', get_template_directory_uri() .'/assets/css/owl.theme.default' . $min . '.css', '', 'v2.2.1' );

	wp_enqueue_style( 'meanmenu', get_template_directory_uri() .'/assets/css/meanmenu.css', '', '2.0.7' );

	wp_enqueue_style( 'blog-personal-style', get_stylesheet_uri() );

	wp_enqueue_style( 'blog-personal-responsive', get_template_directory_uri() .'/assets/css/responsive.css', '', '1.0.0' );

	wp_enqueue_script( 'jquery-owl.carousel', get_template_directory_uri() . '/assets/js/owl.carousel'  . $min . '.js', array( 'jquery' ), 'v2.3.4', true );

	wp_enqueue_script( 'jquery.meanmenu', get_template_directory_uri() . '/assets/js/jquery.meanmenu.js', array(), 'v2.0.8', true );

	wp_enqueue_script( 'blog-personal-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'blog-personal-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'jquery-ResizeSensor', get_template_directory_uri() . '/assets/js/ResizeSensor.js', array( 'jquery' ), 'v1.7.0', true );

	wp_enqueue_script( 'jquery-theia-sticky-sidebar', get_template_directory_uri() . '/assets/js/theia-sticky-sidebar.js', array( 'jquery' ), 'v1.7.0', true );	

	wp_enqueue_script( 'blog-personal-custom', get_template_directory_uri() . '/assets/js/custom.js', array(), '1.0.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'blog_personal_scripts' );

/**
 * Load init.
 */
require_once trailingslashit( get_template_directory() ) . 'inc/init.php';