<?php
/**
 * Functions to provide support for the One Click Demo Import plugin (wordpress.org/plugins/one-click-demo-import)
 *
 * @package blog_personal
 */
/**
* Remove branding
*/
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

/*Import demo data*/
if ( ! function_exists( 'blog_personal_demo_import_files' ) ) :
    function blog_personal_demo_import_files() {
        return array(
            array(
                'import_file_name'             => 'Blog Personal',      
                'categories'                 => array( 'Default' ),          
                'local_import_file'            => trailingslashit( get_template_directory() ) . 'demo-content/blogpersonal.wordpress.2018-05-28.xml',
                'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'demo-content/demo.theme404.com-blog-personal-widgets.wie',
                'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'demo-content/blog-personal-export.dat',
                'import_notice'                => esc_html__( 'Please waiting for a few minutes, do not close the window or refresh the page until the data is imported', 'blog-personal' ),
                 'preview_url'                  => 'https://demo.theme404.com/blog-personal/',
            ),
            array(
                'import_file_name'             => 'Blog Personal Travel',  
                'categories'                 => array( 'Default','Travel' ),              
                'local_import_file'            => trailingslashit( get_template_directory() ) . 'demo-content/blog-travel/blogpersonaltravel.wordpress.2018-07-09.xml',
                'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'demo-content/blog-travel/demo.theme404.com-blog-personal-travel-widgets.wie',
                'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'demo-content/blog-travel/blog-personal-export.dat',

                'import_preview_image_url'   => get_template_directory_uri(). '/demo-content/blog-travel/screenshot.png',
                'import_notice'                => esc_html__( 'Please waiting for a few minutes, do not close the window or refresh the page until the data is imported', 'blog-personal' ),
                 'preview_url'                  => 'https://demo.theme404.com/blog-personal-travel/',
            ),            
        );  
    }
    add_filter( 'pt-ocdi/import_files', 'blog_personal_demo_import_files' );
endif;

/**
 * Action that happen after import
 */
if ( ! function_exists( 'blog_personal_after_demo_import' ) ) :
function blog_personal_after_demo_import( $selected_import ) {
    
        //Set Menu
        $primary_menu = get_term_by('name', 'Main Menu', 'nav_menu'); 
        $social_menu = get_term_by('name', 'Social Menu', 'nav_menu');   


        set_theme_mod( 'nav_menu_locations' , array( 
            'menu-1' => $primary_menu->term_id,
            'social-media' => $social_menu->term_id, 


             ) 
        );

        if ( 'Blog Personal' === $selected_import['import_file_name'] ) {
            // Set Up the Front page
            $front_page = get_page_by_title( 'Home' );      

            update_option( 'show_on_front', 'page' );
            update_option( 'page_on_front', $front_page -> ID );       
        } 
  
    
}
add_action( 'pt-ocdi/after_import', 'blog_personal_after_demo_import' );
endif;