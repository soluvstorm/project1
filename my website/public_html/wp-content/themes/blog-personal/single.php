<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
			<div class="detail-page-wrapper">	
				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', 'single' );


					$enable_post_navigation = blog_personal_get_option('enable_post_navigation');

					if ( true == $enable_post_navigation ):	
						the_post_navigation();
					endif; 		

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>					
			</div>

			<?php $enable_related_post = blog_personal_get_option('enable_related_post');
			if( true == $enable_related_post):
				get_template_part( 'template-parts/content', 'related-posts' );
			endif;?>	

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
