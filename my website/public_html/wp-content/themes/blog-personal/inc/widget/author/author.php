<?php
/**
 * Register Facebook Post Widget.
 *
 * @package Blog_Personal
 */

function Blog_Personal_Action_Author() {

    register_widget('Blog_Personal_Author');

}

add_action('widgets_init', 'Blog_Personal_Action_Author');

/**
* 
*/
class Blog_Personal_Author extends WP_Widget {

    function __construct()  {
        
        global $control_ops;

        $widget_ops = array(
          'classname'   => 'widget-post-author',
          'description' => esc_html__( 'Displays Author info.', 'blog-personal' ),
        );      

        parent::__construct( 'Blog_Personal_Author',esc_html__( 'Blog: Author', 'blog-personal' ), $widget_ops, $control_ops );
    }
	/**
	 * Outputs the widget settings form.
	 *
	 * @since 1.0.0
	 *
	 * @param array $instance Current settings.
	 */
	function form( $instance ) {

		// Defaults.
		$instance = wp_parse_args( (array) $instance, array(
			'title'                 => '',
			'description'           => '',
			'image_url'             => '',
            'layout'                => 'v1',	
            'author_facebook'   	=> '',
            'author_twitter'    	=> '',
            'author_linkedin'   	=> '',
            'author_instagram'  	=> '',
            'author_pinterest'  	=> '',
            'author_youtube'    	=> '',			

		) );
		$image_url = '';
		$image_url  = esc_url( $instance[ 'image_url' ] );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php echo esc_html_e( 'Title:', 'blog-personal' ); ?>:
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>">
				<?php echo esc_html_e( 'Description', 'blog-personal' ); ?>:
			</label>
			<textarea class="widefat" rows="4" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>"><?php echo esc_textarea( $instance['description'] ); ?></textarea>
		</p>

		<div class="cover-image">
			<label for="<?php echo esc_attr( $this->get_field_id( 'image_url' ) ); ?>">
				<?php esc_html_e( 'Cover Image:', 'blog-personal' ); ?>
			</label><br />
			<input type="text" class="img widefat" name="<?php echo esc_attr( $this->get_field_name( 'image_url' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'image_url' ) ); ?>" value="<?php echo esc_url( $instance['image_url'] ); ?>" /><br />
			<input type="button" class="select-img button button-primary" value="<?php esc_html_e( 'Upload', 'blog-personal' ); ?>" data-uploader_title="<?php esc_html_e( 'Select Cover Photo', 'blog-personal' ); ?>" data-uploader_button_text="<?php esc_html_e( 'Choose Image', 'blog-personal' ); ?>" style="margin-top:5px;" />

			<?php
			$image_url = '';

			if ( ! empty( $instance['image_url'] ) ) {

				$image_url = $instance['image_url'];

			}

			$wrap_style = '';

			if ( empty( $image_url ) ) {

				$wrap_style = ' style="display:none;" ';
			}
			?>
			<div class="rtam-preview-wrap" <?php echo esc_attr($wrap_style); ?>>
				<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php esc_attr_e( 'Preview', 'blog-personal' ); ?>" style="max-width: 100%;"  />
			</div><!-- .rtam-preview-wrap -->
			
		</div>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>"><?php esc_html_e( 'Choose Option', 'blog-personal' ); ?></label>
            <select class ="widefat" id="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'layout' ) ); ?>">
                <option value="v1" <?php selected( $instance['layout'], 'v1'); ?>><?php esc_html_e( 'Layout 1', 'blog-personal' ); ?></option>
                <option value="v2" <?php selected( $instance['layout'], 'v2'); ?>><?php esc_html_e( 'Layout 2', 'blog-personal' ); ?></option>
            </select>
        </p>        
            <p>
                <label for="<?php echo esc_attr( $this->get_field_name('author_facebook') ); ?>">
                    <?php esc_html_e('Facebook:', 'blog-personal'); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('author_facebook') ); ?>" name="<?php echo esc_attr( $this->get_field_name('author_facebook') ); ?>" type="text" value="<?php echo esc_url( $instance['author_facebook'] ); ?>" />   
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_name('author_twitter') ); ?>">
                    <?php esc_html_e('Twitter:', 'blog-personal'); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('author_twitter') ); ?>" name="<?php echo esc_attr( $this->get_field_name('author_twitter') ); ?>" type="text" value="<?php echo esc_url( $instance['author_twitter'] ); ?>" />   
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_name('author_linkedin') ); ?>">
                    <?php esc_html_e('LinkedIn:', 'blog-personal'); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('author_linkedin') ); ?>" name="<?php echo esc_attr( $this->get_field_name('author_linkedin') ); ?>" type="text" value="<?php echo esc_url( $instance['author_linkedin'] ); ?>" />   
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_name('author_instagram') ); ?>">
                    <?php esc_html_e('Instagram:', 'blog-personal'); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('author_instagram') ); ?>" name="<?php echo esc_attr( $this->get_field_name('author_instagram') ); ?>" type="text" value="<?php echo esc_url( $instance['author_instagram'] ); ?>" />   
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_name('author_pinterest') ); ?>">
                    <?php esc_html_e('Pinterest:', 'blog-personal'); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('author_pinterest') ); ?>" name="<?php echo esc_attr( $this->get_field_name('author_pinterest') ); ?>" type="text" value="<?php echo esc_url( $instance['author_pinterest'] ); ?>" />   
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_name('author_youtube') ); ?>">
                    <?php esc_html_e('Youtube:', 'blog-personal'); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('author_youtube') ); ?>" name="<?php echo esc_attr( $this->get_field_name('author_youtube') ); ?>" type="text" value="<?php echo esc_url( $instance['author_youtube'] ); ?>" />   
            </p>		
		<?php
	} 

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title']          = sanitize_text_field( $new_instance['title'] );

		$instance['image_url'] 		= isset($new_instance['image_url']) ? esc_url_raw($new_instance['image_url']) : '';

		$instance['button_title'] 	= sanitize_text_field( $new_instance['button_title'] );

		$instance['button_link']   	= esc_url_raw( $new_instance['button_link'] );

		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['description'] = $new_instance['description'];
		} else {
			$instance['description'] = wp_kses_post( $new_instance['description'] );
		}

        $instance[ 'layout' ] =  $new_instance['layout'];

        $instance['author_facebook']    = esc_url_raw( $new_instance['author_facebook'] );

        $instance['author_twitter']     = esc_url_raw( $new_instance['author_twitter'] );

        $instance['author_linkedin']    = esc_url_raw( $new_instance['author_linkedin'] );

        $instance['author_instagram']   = esc_url_raw( $new_instance['author_instagram'] );

        $instance['author_pinterest']   = esc_url_raw( $new_instance['author_pinterest'] );

        $instance['author_youtube']     = esc_url_raw( $new_instance['author_youtube'] );		

		return $instance;

	}	

	function widget( $args, $instance ) {	

		extract( $args ); 

		$title = ! empty( $instance['title'] ) ? esc_html($instance['title']) : '';
		$image_url = ! empty( $instance['image_url'] ) ? esc_url($instance['image_url']) : '';		
		$button_link = ! empty( $instance['button_link'] ) ? esc_url($instance['button_link']) : '';
		$description = ! empty( $instance['description'] ) ? $instance['description'] : '';
		$button_title = ! empty( $instance['button_title'] ) ? esc_html($instance['button_title']) : '';
        $layout = isset( $instance[ 'layout' ] ) ? $instance[ 'layout' ] : 'v1';
        $author_facebook    = !empty( $instance['author_facebook'] ) ? esc_url( $instance['author_facebook'] ) : '';
        $author_twitter     = !empty( $instance['author_twitter'] ) ? esc_url( $instance['author_twitter'] ): '';
        $author_linkedin    = !empty( $instance['author_linkedin'] ) ? esc_url( $instance['author_linkedin'] ): '';
        $author_instagram   = !empty( $instance['author_instagram'] ) ? esc_url( $instance['author_instagram'] ) : '';
        $author_pinterest   = !empty( $instance['author_pinterest'] ) ? esc_url( $instance['author_pinterest'] ) : '';
        $author_youtube     = !empty( $instance['author_youtube'] ) ? esc_url( $instance['author_youtube'] ) : '';		
		echo $before_widget; ?>

        <div class="widget-post-author widget-post-author-<?php echo esc_attr( $layout );?>">
            <figure class="avatar">
            	<img src="<?php echo esc_url( $image_url);?>">
            </figure>

    		<div class="author-details">

                <?php if ( !empty( $title ) ): ?>
    				<h3><?php echo esc_html( $title );?></h3>
    			<?php endif; ?>

    			<?php if ( !empty( $description ) ): ?>
    				<p><?php echo esc_html( $description );?></p>
    			<?php endif; ?>

    			<?php if( $author_facebook || $author_twitter || $author_linkedin || $author_instagram || $author_pinterest || $author_youtube ) { ?>

    				<div class="inline-social-icons social-links"> <!-- inline social links starting from here -->
    					<ul>
                            <?php if( $author_facebook ){ ?>
                                <li>
                                    <a href="<?php echo esc_url( $author_facebook ); ?>" target="_blank"></a>
                                </li>
                            <?php } ?>
                            <?php if( $author_twitter ){ ?>
                                <li>
                                    <a href="<?php echo esc_url( $author_twitter ); ?>" target="_blank"></a>
                                </li>
                            <?php } ?>
                            <?php if( $author_instagram ){ ?>
                                <li>
                                    <a href="<?php echo esc_url( $author_instagram ); ?>" target="_blank"></a>
                                </li>
                            <?php } ?>
                            <?php if( $author_linkedin ){ ?>
                                <li>
                                    <a href="<?php echo esc_url( $author_linkedin ); ?>" target="_blank"></a>
                                </li>
                            <?php } ?> 
                            <?php if( $author_pinterest ){ ?>
                                <li>
                                    <a href="<?php echo esc_url( $author_pinterest ); ?>" target="_blank"></a>
                                </li>
                            <?php } ?>
                            <?php if( $author_youtube ){ ?>
                                <li>
                                    <a href="<?php echo esc_url( $author_youtube ); ?>" target="_blank"></a>
                                </li>
                            <?php } ?>                                                
    					</ul>
    				</div>
    			<?php } ?>
    		</div>
        </div>

		<?php echo $after_widget;
	}	   


}

/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 *
 * @param string $hook Hook.
 */
function blog_personal_author_scripts( $hook ) {

	if ( 'widgets.php' !== $hook ) {
		return;
	}

	wp_enqueue_media();

	wp_enqueue_style( 'blog-personal-admin-css', get_template_directory_uri() . '/inc/widget/author/css/admin.css', array(), '1.0.0' );

	wp_enqueue_script( 'blog-personal-admin-js', get_template_directory_uri() . '/inc/widget/author/js/admin.js', array( 'jquery' ), '1.0.0' );

}
add_action( 'admin_enqueue_scripts', 'blog_personal_author_scripts' );