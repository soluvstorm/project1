<?php
/**
 * Register Promo latest Widgets.
 *
 * @package Blog_Personal
 */

function Blog_Personal_latest_Action() {

  register_widget( 'Blog_Personal_Latest' );
  
}
add_action( 'widgets_init', 'Blog_Personal_latest_Action' );


/**
* 
*/
class Blog_Personal_Latest extends WP_Widget
{
	
	function __construct()	{
		
		global $control_ops;

		$widget_ops = array(
		  'classname'   => 'post-blog-section flexible-post',
		  'description' => esc_html__( 'Displays latest posts or posts from a choosen category.', 'blog-personal' ),
		);		

		parent::__construct( 'Blog_Personal_Latest',esc_html__( 'Blog: Latest', 'blog-personal' ), $widget_ops, $control_ops );
	}

	function form( $instance ) {
        $defaults[ 'show_post_meta' ]	= true;   
        $defaults[ 'category' ]    		= ''; 
        $defaults[ 'number' ]    	= 2; 
		$instance = wp_parse_args( (array) $instance, $defaults );
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 2;
		$category = isset( $instance['category'] ) ? absint( $instance['category'] ) : 0;   
		$show_post_meta = isset( $instance['show_post_meta'] ) ? (bool) $instance['show_post_meta'] : true;
		
	?>
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
        $instance['number'] = (int) $new_instance['number'];  
        $instance['category'] = absint( $new_instance['category'] );     	
		$instance['show_post_meta'] = (bool) $new_instance['show_post_meta']; 
		return $instance;
	}

    function widget( $args, $instance ) {

    	extract( $args );        
        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 2;
        $show_post_meta = isset( $instance['show_post_meta'] ) ? $instance['show_post_meta'] : true;
        $category  = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';
        
        echo $before_widget; ?>      	
        		
			<?php $latest_args = array(
			    'posts_per_page' => absint( $number ),
			    'post_type' => 'post',
			    'post_status' => 'publish',
			    'post__not_in' => get_option( 'sticky_posts' ),      
			);

			if ( absint( $category ) > 0 ) {
			  $latest_args['cat'] = absint( $category );
			}
	        $the_query = new WP_Query( $latest_args ); 

	        if ($the_query->have_posts()) : $cn = 0; ?>			
				
				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); $cn++; ?>
					<?php $count_class = '';
					
					if ( $cn % 2 == 1) {
						$count_class = 'opp';						
					} 
					?>
					<article class="post <?php echo esc_attr( $count_class );?>">
						<?php if ( has_post_thumbnail() ): ?>
							<figure class="featured-image">
								<?php the_post_thumbnail( 'blog-personal-latest' );?>
							</figure>
						<?php endif;?>
						<div class="post-content">
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
							<?php $excerpt = blog_personal_the_excerpt(50);
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
						</div>
						<?php if ( $cn % 2 == 1) {  
							echo '<div class ="post-bg"></div>';
						} ?>           
					</article>
				<?php endwhile; 
				wp_reset_postdata();?>
				
			<?php endif;; ?>
    		
        <?php echo $after_widget;
    } 		      		
}