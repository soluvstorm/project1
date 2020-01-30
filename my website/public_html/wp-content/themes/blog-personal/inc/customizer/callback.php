<?php 
/**
 * Blog Personal Callback Hunction
 *
 * @package Blog_Personal
 */

/***************************** Active callback Related Post **********************************************/

if ( ! function_exists( 'blog_personal_related_post' ) ) :

	function blog_personal_related_post( $control ) { 

		if( 'slider' == $control->manager->get_setting('theme_options[enable_related_post]')->value() ){
		
			return true;
		
		} else {
		
			return false;
		
		}
	}

endif;