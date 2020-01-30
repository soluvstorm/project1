<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blog_Personal
 */

get_header();
?>
	<?php 
		$blog_personal_layout_class ='custom-col-8';
		$blog_personal_sidebar_layout = blog_personal_get_option('sidebar_layout'); 		
		if( is_active_sidebar('sidebar-1') && 'no-sidebar' !==  $blog_personal_sidebar_layout){
			$blog_personal_layout_class = 'custom-col-8';
		}
		else{
			$blog_personal_layout_class = 'custom-col-12';
		}		
	?>
	<div id="primary" class="content-area <?php echo esc_attr( $blog_personal_layout_class );?>">
		<main id="main" class="site-main">

		<?php $blog_personal_blog_layout = blog_personal_get_option( 'blog_layout' );?>	
		<div class="post-item-wrapper <?php echo esc_attr( $blog_personal_blog_layout );?>">	
			<?php if ( have_posts() ) : ?>

				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					 * Include the Post-Type-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );

				endwhile;

				do_action( 'blog_personal_action_navigation' );

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>

		</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
