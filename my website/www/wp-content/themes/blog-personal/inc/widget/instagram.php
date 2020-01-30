<?php
/**
 * Instagram Widget
 *
 * @package Blog_Personal
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function Blog_Personal_Insta_Feeds( $access_token, $image_num, $disable_cache ) {	

	if( '1' == $disable_cache ){
		$cached = false;
	} else{

		$cached = get_transient( 'blog_lite_instagram_feeds' );

	}	

	if ( false !== $cached ) {

		return $cached;

	}

	$count = $image_num;

	$url              = 'https://api.instagram.com/v1/users/self/media/recent/?access_token=' . trim( $access_token ). '&count=' . trim( $count );

	$feeds_json         = wp_remote_fopen( $url );

	$feeds_obj          = json_decode( $feeds_json, true );	

	$feeds_images_array = array();



	if ( ! empty( $feeds_obj['data'] ) ) {

		foreach ( $feeds_obj['data'] as $data ) {
			array_push( $feeds_images_array, array( $data['images']['thumbnail']['url'], $data['link'] ) );
		}

		foreach ( $feeds_images_array as $key => $value ) {
			$feeds_images_array[ $key ] = preg_replace( '/s150x150/', 's320x320', $value );
		}

		$ending_array = array(
			'link'   => $feeds_obj['data'][0]['user']['username'],
			'images' => $feeds_images_array,
		);

		set_transient( 'blog_lite_instagram_feeds', $ending_array, 1 * HOUR_IN_SECONDS );

		return $ending_array;
	}

}


class Blog_Personal_Insta_Feeds extends WP_Widget {
	/**
	* Declares the Blog_Personal_Insta_Feeds class.
	*
	*/	

	public function __construct() {

		global $control_ops;

		$widget_ops = array(						
					'classname' 	=> 'insta-section', 
					'description' 	=> esc_html__( 'A widget that displays your latest Instagram photos.', 'blog-personal') 
					);

		parent::__construct('Blog_Personal_Insta_Feeds', esc_html__('Blog: Instagram Feeds', 'blog-personal'), $widget_ops, $control_ops);

		$this->alt_option_name = 'widget_blif';		
	}

	/**
	* Displays the Widget
	*
	*/
	function widget($args, $instance){	

		extract( $args ); 	

		$title 				= ! empty( $instance['title'] ) ? $instance['title'] : '';

		$access_token		= ! empty( $instance['access_token'] ) ? $instance['access_token'] : false;
		
		$image_num			= ! empty( $instance['image_num'] ) ? $instance['image_num'] : '8';

		$disable_cache 		= ! empty( $instance['disable_cache'] ) ? '1' : '0';

		
		?>		
			<?php
				echo $before_widget;; 			

				echo '<header class="entry-header heading">';
					if (!empty( $title )):

			        	echo $args['before_title'] . esc_html( $title ) . $args['after_title'];

			    	endif;
		    	echo '</header>';

				$rt_feeds 	= Blog_Personal_Insta_Feeds( $access_token, $image_num, $disable_cache ); 

				$count 		= count( $rt_feeds['images'] );	
				echo '<ul class="thumbnails">';
					echo '<h3 class="footer-instagram-title v-center">';
					echo '<a href="' . esc_url( 'https://www.instagram.com/' . $rt_feeds['link'] ) . '/" target="_blank"><i class="fa fa-instagram"></i></a>';
					echo '</h3>';				
					for ( $i = 0; $i < $count; $i ++ ) {
						if ( $rt_feeds['images'][ $i ] ) {
							$rt_feeds['images'][ $i ] = preg_replace( '/s320x320/', 's150x150', $rt_feeds['images'][ $i ] );
							echo '<li>';
							echo '<a href="' . esc_url( $rt_feeds['images'][ $i ][1] ) . '" target="_blank" style="background-image: url('.esc_url( $rt_feeds['images'][ $i ][0] ).');"></a>';						
							echo '</li>';
						}
					}
				echo '</ul>';
				echo $after_widget; ?>
			

			<?php
	}	

	/**
	* Creates the edit form for the widget.
	*
	*/
	function form($instance){	

		$instance = wp_parse_args( (array) $instance, 
						array(
							'title'			=> '',
							'label_text'	=> '', 
							'access_token'	=> '', 
							'image_num'		=> '', 
						) 
					);

		$title 			=  isset( $instance['title'] ) ? $instance['title'] : '';

		$label_text		= isset( $instance['label_text'] ) ? $instance['label_text'] : '';

		$access_token 	= isset( $instance['access_token'] ) ? $instance['access_token'] : '';

		$image_num		= isset( $instance['image_num']) ? $instance['image_num'] : '8';

		$disable_cache	= isset( $instance['disable_cache']) ? (bool) $instance['disable_cache'] : 'true';	

			


		# Output the options ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_name('title') ); ?>">
				<?php esc_html_e('Title:', 'blog-personal'); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />		
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_name('access_token') ); ?>">
				<?php esc_html_e('Access Token:', 'blog-personal'); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('access_token') ); ?>" name="<?php echo esc_attr( $this->get_field_name('access_token') ); ?>" type="text" value="<?php echo $access_token; ?>" />
			<small>
				<?php esc_html_e('You can generate Instagram Access Token online. For ex: ', 'blog-personal'); ?>	
				<a href="<?php echo esc_url('http://instagram.pixelunion.net/'); ?>" target="_blank"><?php esc_html_e('Click Here', 'blog-personal'); ?></a>			
			</small>

		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_name('image_num') ); ?>">
				<?php esc_html_e('Number of Image: ', 'blog-personal'); ?>
			</label>
			<input class="small-text" id="<?php echo esc_attr( $this->get_field_id('image_num') ); ?>" name="<?php echo esc_attr( $this->get_field_name('image_num') ); ?>" type="number" value="<?php echo absint( $image_num ); ?>" />
		</p>

		<p>			
			<input class="checkbox" type="checkbox" <?php checked( $disable_cache ); ?> id="<?php echo esc_attr( $this->get_field_id('disable_cache') ); ?>" name="<?php echo esc_attr( $this->get_field_name('disable_cache') ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_name('disable_cache') ); ?>">
				<?php esc_html_e('Disable Cache', 'blog-personal'); ?>
				<br>
				<small><?php esc_html_e("Note: Work on 'Disable Cache' mode during widget setup. After you complete widget setup then enable cache. If you do not see change in number of image disable cache and save setting.", 'blog-personal'); ?></small>					
			</label>
		</p>

		<?php		



	} //end of form

	/**
	* Saves the widgets settings.
	*
	*/
	function update($new_instance, $old_instance){

		$instance 					= $old_instance;

		$instance['title'] 			= strip_tags(stripslashes($new_instance['title']));

		$instance['label_text'] 	= $new_instance['label_text'];

		$instance['access_token'] 	= $new_instance['access_token'];

		$instance['image_num'] 		= $new_instance['image_num'];

		$instance['disable_cache'] 	= $new_instance['disable_cache'];

		return $instance;
	}

}// END class

/**
* Register  widget.
*
* Calls 'widgets_init' action after widget has been registered.
*/
function Blog_Personal_Insta_Action_Feeds() {

	register_widget('Blog_Personal_Insta_Feeds');

}	

add_action('widgets_init', 'Blog_Personal_Insta_Action_Feeds');
?>