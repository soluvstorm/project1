<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blog_Personal
 */

?>
<?php $blog_personal_blog_layout = blog_personal_get_option('blog_layout'); 
	$blog_personal_image_size = 'full'; 
	if ( 'flexible-post' == $blog_personal_blog_layout ){
		$blog_personal_image_size = 'blog-personal-latest';
	}
?>
<?php $blog_personal_image_class = '';
if( !has_post_thumbnail() ){
	$blog_personal_image_class = 'no-image';
}  
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $blog_personal_image_class ); ?>>
	<figure class="featured-image">
		<?php the_post_thumbnail( $blog_personal_image_size ) ;?>
	</figure>
	<div class="post-content">
		<header class="entry-header">
			<div class="entry-meta">
				<?php blog_personal_entry_footer(); 
				blog_personal_posted_on();?>
			</div>
			<h3 class="entry-title">
				<a href="<?php the_permalink();?>"><?php the_title();?></a>
			</h3>
		</header>
		<?php $excerpt = blog_personal_the_excerpt(40); 
		if ( !empty( $excerpt ) ): ?>
			<div class="entry-content">
				<p><?php	                                        
	                echo wp_kses_post( wpautop( $excerpt ) );
                ?></p>
                <?php $blog_personal_button = blog_personal_get_option('button_text'); ?>
				<div class="read-more">
					<a href="<?php the_permalink();?>"><?php echo esc_html( $blog_personal_button );?></a>
				</div>
			</div>
		<?php endif; ?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
