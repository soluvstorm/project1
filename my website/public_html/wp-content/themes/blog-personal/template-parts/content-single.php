<?php
/**
 * Template part for displaying Single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blog_Personal
 */

?>		
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if( has_post_thumbnail() ): ?>
		<figure class="featured-image">
			<?php the_post_thumbnail(); ?>
		</figure>
	<?php endif;?>

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

		<div class="entry-content">
           <?php the_content();?>
		</div>
	</div>	
	
</article><!-- #post-<?php the_ID(); ?> -->