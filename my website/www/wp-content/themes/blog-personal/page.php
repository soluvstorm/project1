<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
