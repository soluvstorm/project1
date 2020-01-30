<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blog_Personal
 */

?>
			</div><!-- row -->
		</div><!-- container -->
	</div><!-- #content -->
	<?php $blog_personal_enable_footer_text = blog_personal_get_option( 'enable_footer_text' );
	$blog_personal_enable_footer_menu = blog_personal_get_option( 'enable_footer_menu' );
	?>
	
	<footer id="colophon" class="site-footer">
			<?php if ( is_active_sidebar( 'insta-widget' ) ) : 
	
				dynamic_sidebar( 'insta-widget' );

			endif;?>

			<div class="widget-area"> <!-- widget area starting from here -->
				<div class="container">
					<?php if ( true == $blog_personal_enable_footer_text ):  ?>
						<aside class="widget">
							<div class="contact-detail">
								<?php $blog_personal_footer_about_text = blog_personal_get_option( 'footer_about_text' );
								$blog_personal_footer_content = blog_personal_get_option( 'footer_content' );
								?>
									<h3><?php echo esc_html( $blog_personal_footer_about_text);?></h3>
									<div class="textwidget">
										<?php echo wp_kses_post( $blog_personal_footer_content );?>
									</div>								
							</div>
						</aside>
					<?php endif; ?>
					<div class="inline-social-icons social-links"> <!-- inline social links starting from here -->
						<?php if ( true == $blog_personal_enable_footer_menu ): ?>
							<?php wp_nav_menu( array(
								'theme_location'  => 'social-media',											
								'depth'           => 1,
								'fallback_cb'     => false,

								) ); 
							?>
						<?php endif; ?>
					</div>
				</div>
			</div> <!-- widget area ends here -->

			<div class="site-generator">
				<div class="container">
					<?php 
					$blog_personal_copyright_footer = blog_personal_get_option( 'copyright_text' ); 
					$enable_powerby_text = blog_personal_get_option( 'enable_powerby_text' );				
					if ( ! empty( $blog_personal_copyright_footer ) ) {
						$blog_personal_copyright_footer = wp_kses_data( $blog_personal_copyright_footer );
					}
					
					// Powered by content.
					$blog_personal_powered_by_text = sprintf( __( 'Theme of %s', 'blog-personal' ), '<a target="_blank" rel="designer" href="'.esc_url( 'https://theme404.com/' ).'">'. esc_html__( 'Theme404', 'blog-personal' ). '</a>' ); 
					?>
					<span class="copy-right"><?php echo esc_html( $blog_personal_copyright_footer );?>&nbsp;
						<?php if ( true == $enable_powerby_text ):
								echo wp_kses_post($blog_personal_powered_by_text); 
						endif; ?>
									
						</span>	
				</div>
			</div>		
	</footer><!-- #colophon -->
	<?php $enable_scroll_back = blog_personal_get_option( 'enable_scroll_back' );
	if ( true == $enable_scroll_back ): ?>
		<div class="back-to-top">
			<a href="#masthead" title="Go to Top" class="fa-angle-up"></a>       
		</div>
	<?php endif; ?>		
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
