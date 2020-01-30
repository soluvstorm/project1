<?php
/**
 * Custom theme functions.
 *
 * This file contains hook functions attached to theme hooks.
 *
 * @package Blog_Personal
 */

if ( ! function_exists( 'blog_personal_featured_slider' ) ) :
	/**
	 * Featured Slider
 	 *
	 * @since 1.0.0
	 */
function blog_personal_featured_slider() {
	?>
	<?php if ( !is_front_page() ) { 
		$enable_breadcrumb = blog_personal_get_option('enable_breadcrumb');	
		if ( true == $enable_breadcrumb ):	
			if ( ! is_404() ): ?>
				<div class="page-title-wrap">
					<div class="container">
						<?php blog_personal_breadcrumb(); 
						$banner_title = apply_filters( 'blog_personal_filter_banner_title', '' ); 

						if ( ! empty( $banner_title ) ) : ?>
							<h2 class="page-title"><?php echo esc_html( $banner_title );?></h2>
						<?php endif; ?>
					</div>
				</div>	
			<?php endif; 
		endif;?>
	<?php } else { ?>	
		<?php if ( is_active_sidebar( 'featured-slider-section' ) ) : 
			
			dynamic_sidebar( 'featured-slider-section' );

		endif;?>
	<?php } 
}
endif;

add_action( 'blog_personal_action_header', 'blog_personal_featured_slider');

if ( ! function_exists( 'blog_personal_customize_banner_title' ) ) :

	/**
	 * Customize banner title.
	 *
	 * @since 1.0.0
	 *
	 * @param string $title Title.
	 * @return string Modified title.
	 */
	function blog_personal_customize_banner_title( $title ) {

		if ( is_home() ) {
			$title = blog_personal_get_option( 'blog_title' );
		} elseif ( is_singular() ) {
			$title = single_post_title( '', false );
		} elseif ( is_category() || is_tag() ) {
			$title = single_term_title( '', false );
		} elseif ( is_archive() ) {
			$title = strip_tags( get_the_archive_title() );
		} elseif ( is_search() ) {
			$title = sprintf( esc_html__( 'Search Results for: %s', 'blog-personal' ),  get_search_query() );
		} elseif ( is_404() ) {
			$title = esc_html__( '404!', 'blog-personal' );
		}

		return $title;
	}

endif;

add_filter( 'blog_personal_filter_banner_title', 'blog_personal_customize_banner_title' );
if ( ! function_exists( 'blog_personal_navigation' ) ) :

	/**
	 * Posts navigation.
	 *
	 * @since 1.0.0
	 */
function blog_personal_navigation() {

	$pagination_option = blog_personal_get_option('pagination_option');

	if ( 'default' == $pagination_option) {

		the_posts_navigation();	

	} else{

		the_posts_pagination( array(
			'mid_size' => 5,
			'prev_text' => __( 'PREV', 'blog-personal' ),
			'next_text' => __( 'NEXT', 'blog-personal' ),
			) );
	}

}
endif;

add_action( 'blog_personal_action_navigation', 'blog_personal_navigation' );
