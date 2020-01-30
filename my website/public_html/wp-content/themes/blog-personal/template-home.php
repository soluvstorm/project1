<?php
/**
 * Template for Home Page
 *
 * Template name: Home
 *
 * @package Blog_Personal
 */

get_header();
?>
	<?php 
		global $post;
		$blog_personal_layout = get_post_meta( $post->ID, 'blog_personal_meta', true );		
		$blog_personal_layout_class ='custom-col-8';
		$blog_personal_sidebar_layout = blog_personal_get_option('sidebar_layout'); 
		// If individual layout is set.
        if ( ! empty( $blog_personal_layout ) ) {
           	if( is_active_sidebar('sidebar-1') && 'no-sidebar' !==  $blog_personal_layout){
				$blog_personal_layout_class = 'custom-col-8';
			}
			else{
				$blog_personal_layout_class = 'custom-col-12';
			}	
        } else {
            if( is_active_sidebar('sidebar-1') && 'no-sidebar' !==  $blog_personal_sidebar_layout){
				$blog_personal_layout_class = 'custom-col-8';
			}
			else{
				$blog_personal_layout_class = 'custom-col-12';
			}     
        }
        
			
	?>
	<div id="primary" class="content-area <?php echo esc_attr( $blog_personal_layout_class );?>">
		<main id="main" class="site-main">
			<?php if ( is_active_sidebar( 'home-widget' ) ) : 
	
				dynamic_sidebar( 'home-widget' );

			endif;?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar( 'home' );
get_footer();
