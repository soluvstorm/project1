<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Blog_Personal
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found">
				<figure class="error-icon">
					<img src="<?php echo esc_url( get_template_directory_uri())?>/assets/img/error-image.png" alt="">
				</figure>	
				<div class="entry-content">
					<h2 class="page-title"><?php echo esc_html__( '404', 'blog-personal' );?></h2>
					<a href="<?php echo esc_url( home_url() ); ?>"><?php echo esc_html__( 'BACK to HOMEPAGE', 'blog-personal' );?></a>
				</div><!-- .page-header -->  
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
