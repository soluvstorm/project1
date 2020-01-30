<?php
/**
 * Default theme options.
 *
 * @package Blog_Personal
 */

if ( ! function_exists( 'blog_personal_get_default_theme_options' ) ) :

	/**
	 * Get default theme options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
function blog_personal_get_default_theme_options() {

	$defaults = array();
	
	$defaults['site_identity']						= 'title-text';

	/****************************** Header Setting *************************************/	
	$defaults['header_layout']						= 'default';
	$defaults['enable_media']						= true;
	$defaults['enable_search']						= true;

	/****************************** General Setting *************************************/	
	$defaults['sidebar_layout']						= 'right';
	$defaults['enable_breadcrumb']					= true;
	$defaults['enable_scroll_back']					= true;
	$defaults['enable_author']						= true;
	$defaults['enable_date']						= true;
	$defaults['enable_category']					= true;

	/****************************** Blog Setting *************************************/	
	$defaults['blog_layout']						= 'post-flexible';
	$defaults['button_text']			= esc_html__( 'CONTINUE READING', 'blog-personal' );
	$defaults['pagination_option']					= 'default';

	/****************************** Single Page Setting *************************************/	
	$defaults['enable_post_navigation']				= true;
	$defaults['enable_related_post']				= true;
	$defaults['related_post_text']					= esc_html__( 'RELATED POST', 'blog-personal' );
	$defaults['related_number']						= 4;
	$defaults['related_post_button_text']			= esc_html__( 'CONTINUE READING', 'blog-personal' );


	/****************************** Footer Setting *************************************/
	$defaults['enable_footer_text']					= true;
	$defaults['enable_footer_menu']					= true;
	$defaults['enable_poweredby']					= true;
	$defaults['footer_about_text']					= '';	
	$defaults['footer_content']						= '';	
	$defaults['copyright_text']						= '';
	$defaults['enable_powerby_text']				= true;
	


	// Pass through filter.
	$defaults = apply_filters( 'blog_personal_filter_default_theme_options', $defaults );
	return $defaults;
}

endif;

/**
*  Get theme options
*/
if ( ! function_exists( 'blog_personal_get_option' ) ) :

	/**
	 * Get theme option
	 *
	 * @since 1.0.0
	 *
	 * @param string $key Option key.
	 * @return mixed Option value.
	 */
	function blog_personal_get_option( $key ) {

		$default_options = blog_personal_get_default_theme_options();

		if ( empty( $key ) ) {
			return;
		}

		$theme_options = (array)get_theme_mod( 'theme_options' );
		$theme_options = wp_parse_args( $theme_options, $default_options );

		$value = null;

		if ( isset( $theme_options[ $key ] ) ) {
			$value = $theme_options[ $key ];
		}

		return $value;

	}

endif;