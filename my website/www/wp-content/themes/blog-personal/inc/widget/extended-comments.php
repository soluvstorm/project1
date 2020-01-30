<?php
/**
 * Register Extended Comment Widgets.
 *
 * @package Blog_Personal
 */

function Blog_Personal_Action_Extended_Comment() {

  register_widget( 'Blog_Personal_Extended_Comment' );
  
}
add_action( 'widgets_init', 'Blog_Personal_Action_Extended_Comment' );

/**
 *
 *
 */
class Blog_Personal_Extended_Comment extends WP_Widget {

	function __construct()	{
		
		global $control_ops;

		$widget_ops = array(
		  'classname'   => 'sidebar-recent-comments',
		  'description' => esc_html__( 'Displays latest posts or posts from a choosen category.', 'blog-personal' ),
		);		

		parent::__construct( 'Blog_Personal_Extended_Comment',esc_html__( 'Blog: Extended Comment', 'blog-personal' ), $widget_ops, $control_ops );
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">
				<?php echo esc_html__( 'Title:', 'blog-personal' ); ?>
			
			</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>

	    <p>
	    	<label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>">
	    		<?php echo esc_html__( 'Choose Number', 'blog-personal' );?>    		
	    	</label>

	    	<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="number" step="1" min="1" value="<?php echo esc_attr($number); ?>" max="10" />
	    </p>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['number'] = absint( $new_instance['number'] );
		return $instance;
	}	

	function widget( $args, $instance ) {
		extract( $args );

		$title = ( ! empty( $instance['title'] ) ) ? esc_html($instance['title']) :'';

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5; 

		echo $before_widget; 
		?>

		<?php if( !empty( $title ) ): ?>
			<h2 class="widget-title"><span><?php echo esc_html( $title );?></span></h2>
		<?php  endif;?>

		<?php $comment_args = array('number' => $number );
			$comments_query = new WP_Comment_Query;
			$comments = $comments_query->query( $comment_args ); ?>

			<ul id="recentcomments">
				<?php if ( !empty( $comments ) ) {  
					foreach ( $comments as $comment ) { ?>
						<li class="recentcomments">
							<figure class="comment-author-image">
								<?php echo get_avatar( $comment); ?>
							</figure>
							<div class="comment-author-text">
								<span class="comment-author-link">
									<?php echo wp_kses_post(get_comment_author_link( $comment )); ?>
								</span>
								<a href="<?php echo esc_url( get_comment_link( $comment ) );?>"><?php echo wp_kses_post( $comment->comment_content );?></a>
							</div>
						</li>
					<?php }
				} ?>
			</ul>
		<?php
		echo $after_widget;
	}

}
