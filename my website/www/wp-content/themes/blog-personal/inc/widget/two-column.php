<?php
/**
 * Register Home Featured Slider Widgets.
 *
 * @package Blog_Personal
 */

function Blog_Personal_Two_Column_Action() {

  register_widget( 'Blog_Personal_Two_Column' );
  
}
add_action( 'widgets_init', 'Blog_Personal_Two_Column_Action' );


/**
* 
*/
class Blog_Personal_Two_Column extends WP_Widget
{
	
	function __construct()	{
		
		global $control_ops;

		$widget_ops = array(
		  'classname'   => 'post-blog-section',
		  'description' => esc_html__( 'Displays latest posts or posts from a choosen category.', 'blog-personal' ),
		);		

		parent::__construct( 'Blog_Personal_Two_Column',esc_html__( 'Blog: Two Column', 'blog-personal' ), $widget_ops, $control_ops );
	}

	function form( $instance ) {
		$defaults[ 'title' ]                 = esc_html__( 'Trending', 'blog-personal' );
        $defaults[ 'show_post_meta' ]	= true;   
        $defaults[ 'category' ]    		= ''; 
        $defaults[ 'number' ]    	= 5;         
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : esc_html__( 'Trending', 'blog-personal' );
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$category = isset( $instance['category'] ) ? absint( $instance['category'] ) : 0;   
		$show_post_meta = isset( $instance['show_post_meta'] ) ? (bool) $instance['show_post_meta'] : true;
		
	?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">
				<?php echo esc_html__( 'Title', 'blog-personal' ); ?>				
			</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>	
		<p>
		    <input class="checkbox" type="checkbox"<?php checked( $show_post_meta ); ?> id="<?php echo esc_attr($this->get_field_id( 'show_post_meta' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_post_meta' )); ?>" />
		    <label for="<?php echo esc_attr($this->get_field_id( 'show_post_meta' )); ?>">
		    	<?php echo esc_html__( 'Enable Post Meta', 'blog-personal' ); ?>
		    	
		    </label>
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>">
				<?php esc_html_e( 'Select Category:', 'blog-personal' ); ?>			
			</label>

			<?php
				wp_dropdown_categories(array(
	                'orderby'         => 'name',
	                'hide_empty'      => 0,
	                'class' 		  => 'widefat',				
					'show_option_none' => '',
					'show_option_all'  => esc_html__('&mdash; Select &mdash;','blog-personal'),
					'name'             => esc_attr($this->get_field_name( 'category' )),
					'selected'         => absint( $category ),          
				) );
			?>
		</p>

	    <p>
	    	<label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>">
	    		<?php echo esc_html__( 'Choose Number', 'blog-personal' );?>    		
	    	</label>

	    	<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="number" step="1" min="1" value="<?php echo esc_attr($number); ?>" max="100" />
	    </p>

	<?php 
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance; 
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['number'] = (int) $new_instance['number'];  
        $instance['category'] = absint( $new_instance['category'] );     	
		$instance['show_post_meta'] = (bool) $new_instance['show_post_meta']; 
		return $instance;
	}

    function widget( $args, $instance ) {

    	extract( $args ); 
    	$title = ( ! empty( $instance['title'] ) ) ? esc_html($instance['title']) : esc_html__( 'Trending', 'blog-personal' );     
        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
        $show_post_meta = isset( $instance['show_post_meta'] ) ? $instance['show_post_meta'] : true;
        $category  = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';
        
        echo $before_widget; ?>

			<header class="entry-header heading">
				<h2 class="entry-title"><?php echo esc_html( $title );?></h2>
			</header>

        	<div class="row">
        		
				<?php $column_args = array(
				    'posts_per_page' => absint( $number ),
				    'post_type' => 'post',
				    'post_status' => 'publish',
				    'post__not_in' => get_option( 'sticky_posts' ),      
				);

				if ( absint( $category ) > 0 ) {
				  $column_args['cat'] = absint( $category );
				}
		        $the_query = new WP_Query( $column_args ); 

		        if ($the_query->have_posts()) : $cn = 0; ?>					
					
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<div class="custom-col-6 post-wrapper-<?php echo esc_attr( $cn );?>">
							<article class="post">
								<?php if ( $cn == 0 ): ?>
									<?php if ( has_post_thumbnail() ): ?>
										<figure class="slider-image">
											<?php the_post_thumbnail( 'blog-personal-two-column' );?>
										</figure>
									<?php endif;?>
								<?php endif; ?>

								<div class="post-content">
									<?php if ( $cn > 0): ?>
										<div class="count-post">
											<?php echo sprintf( '0%d', absint( $cn ) );?>
										</div>
									<?php endif ; ?>
									<header class="entry-header">
										<?php if ( true == $show_post_meta ) { ?>
											<div class="entry-meta">
												<?php blog_personal_entry_footer(); 
												blog_personal_posted_on();?>
												
											</div>
										<?php } ?>
										<h3 class="entry-title">
											<a href="<?php the_permalink();?>"><?php the_title();?></a>
										</h3>
									</header>
									<?php if ( $cn == 0 ): ?>
										<?php $excerpt = blog_personal_the_excerpt(40);
										if ( !empty( $excerpt ) ): ?>
											<div class="entry-content">
			                                    <?php	                                        
			                                        echo wp_kses_post( wpautop( $excerpt ) );
			                                    ?>
				                                <div class="read-more">
													<a href="<?php the_permalink();?>"><?php echo esc_html_e( 'CONTINUE READING', 'blog-personal' );?></a>
												</div>    
											</div>																				
										<?php endif;?>
									<?php endif; ?>
								</div>             
							</article>            
						</div>
						<?php $cn++; ?>
					<?php endwhile; 
					wp_reset_postdata();?>
					
				<?php endif;; ?>
    		</div>
        <?php echo $after_widget;
    } 		      		
}