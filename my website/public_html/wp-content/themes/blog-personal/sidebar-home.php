<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blog_Personal
 */

if ( ! is_active_sidebar( 'sidebar-home' ) ) {
	return;
}
?>
<?php 
$blog_personal_sidebar_layout = '';
    if ( is_page() ){
        $blog_personal_layout = get_post_meta( $post->ID, 'blog_personal_meta', true );
        // If individual layout is set.
        if ( ! empty( $blog_personal_layout ) ) {
            $blog_personal_sidebar_layout =  $blog_personal_layout; 
        } else {
            // if individual layout is not set add global one.
            $blog_personal_sidebar_layout = blog_personal_get_option('sidebar_layout');    
        }
    } else{
          $blog_personal_sidebar_layout = blog_personal_get_option('sidebar_layout');  
    }

if ( 'no-sidebar' !== $blog_personal_sidebar_layout ): ?>
	<div id="secondary" class="widget-area custom-col-4">
		<?php dynamic_sidebar( 'sidebar-home' ); ?>
	</div><!-- #secondary -->
<?php endif; ?>