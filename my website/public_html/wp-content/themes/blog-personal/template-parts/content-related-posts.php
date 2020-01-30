<?php /**
 *
 * This Template is for showing related posts.
 * 
 * @package Blog_Personal
 *
 *
 */ 
?>
<?php 
	global $post;
	$blog_personal_related_number = blog_personal_get_option('related_number');
		$args = array(
		'fields'=>'ids'
		);
		$blog_personal_related_catId = wp_get_post_categories($post->ID, $args);
		$blog_personal_args = array(
		'post_type' => 'post',
		'posts_per_page' => absint( $blog_personal_related_number ),
		'post_status' => 'publish',
		'paged' => 1,
		'category__in' => $blog_personal_related_catId,		
		'post__not_in'  =>array(get_the_ID())
	);
	$related_posts = new WP_Query($blog_personal_args);
	if ($related_posts->have_posts()): 
		$related_post_text = blog_personal_get_option('related_post_text');?>	

			<div class="related-post-section">				

	            	<?php if( !empty( $related_post_text ) ):?>
						<header class="entry-header heading">
							<h2 class="entry-title"><span><?php echo esc_html( $related_post_text);?></span></h2>
						</header>
					<?php endif;?>
				<div class="post-item-wrapper post-item-has-2">	
					<?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
						<?php $blog_personal_image_class = '';
						if( !has_post_thumbnail() ){
							$blog_personal_image_class = 'no-image';
						}  
						?>
						<div class="post <?php echo esc_attr( $blog_personal_image_class );?>">
							<?php if(has_post_thumbnail()):  ?>
			                	<figure class="featured-image">
			                     	<?php the_post_thumbnail( 'blog-personal-related' );?>
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
								<?php $excerpt = blog_personal_the_excerpt(20); 
								if ( !empty( $excerpt ) ): ?>
									<div class="entry-content">
										<p><?php	                                        
							                echo wp_kses_post( wpautop( $excerpt ) );
						                ?></p>
						                <?php $blog_personal_button = blog_personal_get_option('related_post_button_text'); ?>
										<div class="read-more">
											<a href="<?php the_permalink();?>"><?php echo esc_html( $blog_personal_button );?></a>
										</div>
									</div>
								<?php endif; ?>							
							</div>
						</div>
					<?php endwhile; ?>
				</div>

			</div>

		<?php wp_reset_postdata(); ?>

	<?php endif; ?>

