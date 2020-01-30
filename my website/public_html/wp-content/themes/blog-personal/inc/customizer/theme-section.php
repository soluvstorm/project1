<?php
/**
 * Blog Personal Theme Customizer
 *
 * @package Blog_Personal
 */

$default = blog_personal_get_default_theme_options();

/****************  Add Pannel   ***********************/
$wp_customize->add_panel( 'theme_option_panel',
	array(
	'title'      => esc_html__( 'Theme Options', 'blog-personal' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	)
);

/****************  Header Setting Section starts ************/
$wp_customize->add_section('section_header', 
	array(    
	'title'       => esc_html__('Header Setting', 'blog-personal'),
	'panel'       => 'theme_option_panel'    
	)
);

/************************  Site Identity  ******************/
$wp_customize->add_setting('theme_options[site_identity]', 
	array(
	'default' 			=> $default['site_identity'],
	'sanitize_callback' => 'blog_personal_sanitize_select'
	)
);
$wp_customize->add_control('theme_options[site_identity]', 
	array(		
	'label' 	=> esc_html__('Choose Option', 'blog-personal'),
	'section' 	=> 'title_tagline',
	'settings'  => 'theme_options[site_identity]',
	'type' 		=> 'radio',
	'choices' 	=>  array(
			'logo-only' 	=> esc_html__('Logo Only', 'blog-personal'),
			'logo-text' 	=> esc_html__('Logo + Tagline', 'blog-personal'),
			'title-only' 	=> esc_html__('Title Only', 'blog-personal'),
			'title-text' 	=> esc_html__('Title + Tagline', 'blog-personal')
		)
	)
);
/****************  Header Setting Section starts ************/
$wp_customize->add_section('section_header', 
	array(    
	'title'       => esc_html__('Header Setting', 'blog-personal'),
	'panel'       => 'theme_option_panel'    
	)
);
/************************  Header Layout  ******************/
$wp_customize->add_setting('theme_options[header_layout]', 
	array(
	'default' 			=> $default['header_layout'],
	'sanitize_callback' => 'blog_personal_sanitize_select'
	)
);
$wp_customize->add_control('theme_options[header_layout]', 
	array(		
	'label' 	=> esc_html__('Choose Option', 'blog-personal'),
	'section' 	=> 'section_header',
	'settings'  => 'theme_options[header_layout]',
	'type' 		=> 'radio',
	'choices' 	=>  array(
			'default' 	=> esc_html__('Header Layout 1', 'blog-personal'),
			'header-v2' 	=> esc_html__('Header Layout 2', 'blog-personal'),					
		)
	)
);


/********************* Enable Social Media ****************************/
$wp_customize->add_setting( 'theme_options[enable_media]',
	array(
		'default'           => $default['enable_media'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'blog_personal_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[enable_media]',
	array(
		'label'    => esc_html__( 'Enable Social Icon', 'blog-personal' ),
		'section'  => 'section_header',
		'type'     => 'checkbox',		
	)
);


/********************* Enable Search ****************************/
$wp_customize->add_setting( 'theme_options[enable_search]',
	array(
		'default'           => $default['enable_search'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'blog_personal_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[enable_search]',
	array(
		'label'    => esc_html__( 'Enable Search', 'blog-personal' ),
		'section'  => 'section_header',
		'type'     => 'checkbox',		
	)
);
/****************  General  Setting Section starts ************/
$wp_customize->add_section('section_general', 
	array(    
	'title'       => esc_html__('General Setting', 'blog-personal'),
	'panel'       => 'theme_option_panel'    
	)
);

/****************************** Enable Breadcrumb *************************/
$wp_customize->add_setting('theme_options[enable_breadcrumb]', 
	array(
	'default' 			=> $default['enable_breadcrumb'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'blog_personal_sanitize_checkbox'
	)
);

$wp_customize->add_control('theme_options[enable_breadcrumb]', 
	array(		
	'label' 	=> esc_html__('Enable Breadcrumb', 'blog-personal'),
	'section' 	=> 'section_general',
	'settings'  => 'theme_options[enable_breadcrumb]',
	'type' 		=> 'checkbox',	
	)
);


/************************  Sidebar Layout  ******************/
$wp_customize->add_setting('theme_options[sidebar_layout]', 
	array(
	'default' 			=> $default['sidebar_layout'],
	'sanitize_callback' => 'blog_personal_sanitize_select'
	)
);
$wp_customize->add_control('theme_options[sidebar_layout]', 
	array(		
	'label' 	=> esc_html__('Choose Option', 'blog-personal'),
	'section' 	=> 'section_general',
	'settings'  => 'theme_options[sidebar_layout]',
	'type' 		=> 'radio',
	'choices' 	=>  array(
			'right' 	=> esc_html__('Right Sidebar', 'blog-personal'),
			'left' 	=> esc_html__('Left Sidebar', 'blog-personal'),
			'no-sidebar' 	=> esc_html__('No Sidebar', 'blog-personal'),		
		)
	)
);

/****************************** Enable Author *************************/
$wp_customize->add_setting('theme_options[enable_author]', 
	array(
	'default' 			=> $default['enable_author'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'blog_personal_sanitize_checkbox'
	)
);

$wp_customize->add_control('theme_options[enable_author]', 
	array(		
	'label' 	=> esc_html__('Enable Author', 'blog-personal'),
	'section' 	=> 'section_general',
	'settings'  => 'theme_options[enable_author]',
	'type' 		=> 'checkbox',	
	)
);

/****************************** Enable Date *************************/
$wp_customize->add_setting('theme_options[enable_date]', 
	array(
	'default' 			=> $default['enable_date'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'blog_personal_sanitize_checkbox'
	)
);

$wp_customize->add_control('theme_options[enable_date]', 
	array(		
	'label' 	=> esc_html__('Enable Date', 'blog-personal'),
	'section' 	=> 'section_general',
	'settings'  => 'theme_options[enable_date]',
	'type' 		=> 'checkbox',	
	)
);
/****************************** Enable Categories *************************/
$wp_customize->add_setting('theme_options[enable_category]', 
	array(
	'default' 			=> $default['enable_category'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'blog_personal_sanitize_checkbox'
	)
);

$wp_customize->add_control('theme_options[enable_category]', 
	array(		
	'label' 	=> esc_html__('Enable Category', 'blog-personal'),
	'section' 	=> 'section_general',
	'settings'  => 'theme_options[enable_category]',
	'type' 		=> 'checkbox',	
	)
);

/****************  Blog Setting Section starts ************/
$wp_customize->add_section('section_archive', 
	array(    
	'title'       => esc_html__('Blog Page Setting', 'blog-personal'),
	'panel'       => 'theme_option_panel'    
	)
);
/************************  Sidebar Layout  ******************/
$wp_customize->add_setting('theme_options[blog_layout]', 
	array(
	'default' 			=> $default['blog_layout'],
	'sanitize_callback' => 'blog_personal_sanitize_select'
	)
);
$wp_customize->add_control('theme_options[blog_layout]', 
	array(		
	'label' 	=> esc_html__('Choose Option', 'blog-personal'),
	'section' 	=> 'section_archive',
	'settings'  => 'theme_options[blog_layout]',
	'type' 		=> 'select',
	'choices' 	=>  array(
		'post-flexible' 	=> esc_html__('Default', 'blog-personal'),
		'flexible-post' 	=> esc_html__('List', 'blog-personal'),						
		)
	)
);

/************************  Button  Title  ******************/
$wp_customize->add_setting( 'theme_options[button_text]',
	array(
	'default'           => $default['button_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',	
	)
);
$wp_customize->add_control( 'theme_options[button_text]',
	array(
	'label'    => esc_html__( 'Button Title', 'blog-personal' ),
	'section'  => 'section_archive',	
	'type'     => 'text',	
	
	)
);

/********************************** Pagination Option *********************************/
$wp_customize->add_setting('theme_options[pagination_option]', 
	array(
	'default' 			=> $default['pagination_option'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'blog_personal_sanitize_select'
	)
);

$wp_customize->add_control('theme_options[pagination_option]', 
	array(		
	'label' 	=> esc_html__('Pagination Options', 'blog-personal'),
	'section' 	=> 'section_archive',
	'settings'  => 'theme_options[pagination_option]',
	'type' 		=> 'radio',
	'choices' 	=> array(		
		'default' 		=> esc_html__('Default', 'blog-personal'),							
		'numeric' 		=> esc_html__('Numeric', 'blog-personal'),		
		),	
	)
);

/****************  Single Page Setting Section starts ************/
$wp_customize->add_section('section_single', 
	array(    
	'title'       => esc_html__('Single Page Setting', 'blog-personal'),
	'panel'       => 'theme_option_panel'    
	)
);

/****************************** Enable Post Navigation *************************/
$wp_customize->add_setting('theme_options[enable_post_navigation]', 
	array(
	'default' 			=> $default['enable_post_navigation'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'blog_personal_sanitize_checkbox'
	)
);

$wp_customize->add_control('theme_options[enable_post_navigation]', 
	array(		
	'label' 	=> esc_html__('Enable Post Navigation', 'blog-personal'),
	'section' 	=> 'section_single',
	'settings'  => 'theme_options[enable_post_navigation]',
	'type' 		=> 'checkbox',	
	)
);

/****************************** Enable Related Post *************************/
$wp_customize->add_setting('theme_options[enable_related_post]', 
	array(
	'default' 			=> $default['enable_related_post'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'blog_personal_sanitize_checkbox'
	)
);

$wp_customize->add_control('theme_options[enable_related_post]', 
	array(		
	'label' 	=> esc_html__('Enable Related Post', 'blog-personal'),
	'section' 	=> 'section_single',
	'settings'  => 'theme_options[enable_related_post]',
	'type' 		=> 'checkbox',	
	)
);
/************************  Related Post Title  ******************/
$wp_customize->add_setting( 'theme_options[related_post_text]',
	array(
	'default'           => $default['related_post_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',	
	)
);
$wp_customize->add_control( 'theme_options[related_post_text]',
	array(
	'label'    => esc_html__( 'Related Post Title', 'blog-personal' ),
	'section'  => 'section_single',	
	'type'     => 'text',
	'active_callback' => 'blog_personal_related_post',
	
	)
);
/*****************************  Related Post Number. ***************************/
$wp_customize->add_setting( 'theme_options[related_number]',
	array(
		'default'           => $default['related_number'],
		'capability'        => 'edit_theme_options',		
		'sanitize_callback' => 'blog_personal_sanitize_number_range',
		)
);
$wp_customize->add_control( 'theme_options[related_number]',
	array(
		'label'       => esc_html__( 'Related Post Number', 'blog-personal' ),
		'section'     => 'section_single',
		'type'        => 'number',		
		'input_attrs' => array( 'min' => 2, 'max' => 8, 'step' => 2, 'style' => 'width: 115px;' ),
		'active_callback' => 'blog_personal_related_post',		
	)
);

/************************  Related Post Button  Title  ******************/
$wp_customize->add_setting( 'theme_options[related_post_button_text]',
	array(
	'default'           => $default['related_post_button_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',	
	)
);
$wp_customize->add_control( 'theme_options[related_post_button_text]',
	array(
	'label'    => esc_html__( 'Related Post Button Title', 'blog-personal' ),
	'section'  => 'section_single',	
	'type'     => 'text',
	'active_callback' => 'blog_personal_related_post',
	
	)
);

/****************  Footer Setting Section starts ************/
$wp_customize->add_section('section_footer', 
	array(    
	'title'       => esc_html__('Footer Setting', 'blog-personal'),
	'panel'       => 'theme_option_panel'    
	)
);

/****************************** Enable Scroll To Top *************************/
$wp_customize->add_setting('theme_options[enable_scroll_back]', 
	array(
	'default' 			=> $default['enable_scroll_back'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'blog_personal_sanitize_checkbox'
	)
);

$wp_customize->add_control('theme_options[enable_scroll_back]', 
	array(		
	'label' 	=> esc_html__('Enable Scroll back', 'blog-personal'),
	'section' 	=> 'section_footer',
	'settings'  => 'theme_options[enable_scroll_back]',
	'type' 		=> 'checkbox',	
	)
);

/****************************** Enable Footer Content *************************/
$wp_customize->add_setting('theme_options[enable_footer_text]', 
	array(
	'default' 			=> $default['enable_footer_text'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'blog_personal_sanitize_checkbox'
	)
);

$wp_customize->add_control('theme_options[enable_footer_text]', 
	array(		
	'label' 	=> esc_html__('Enable Footer Content', 'blog-personal'),
	'section' 	=> 'section_footer',
	'settings'  => 'theme_options[enable_footer_text]',
	'type' 		=> 'checkbox',	
	)
);

/****************************** Enable Footer Menu *************************/
$wp_customize->add_setting('theme_options[enable_footer_menu]', 
	array(
	'default' 			=> $default['enable_footer_menu'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'blog_personal_sanitize_checkbox'
	)
);

$wp_customize->add_control('theme_options[enable_footer_menu]', 
	array(		
	'label' 	=> esc_html__('Enable Footer Menu', 'blog-personal'),
	'section' 	=> 'section_footer',
	'settings'  => 'theme_options[enable_footer_menu]',
	'type' 		=> 'checkbox',	
	)
);


/************************  Footer Contact  ******************/
$wp_customize->add_setting( 'theme_options[footer_about_text]',
	array(
	'default'           => $default['footer_about_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_textarea_field',	
	)
);
$wp_customize->add_control( 'theme_options[footer_about_text]',
	array(
	'label'    => esc_html__( 'Contact Title', 'blog-personal' ),
	'section'  => 'section_footer',
	'type'     => 'text',
	
	)
);

/*********************** Footer Content.  ****************************/
$wp_customize->add_setting( 'theme_options[footer_content]',
	array(
	'default'           => $default['footer_content'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'blog_personal_sanitize_textarea_content',	
	)
);
$wp_customize->add_control( 'theme_options[footer_content]',
	array(
	'label'    => esc_html__( 'Footer Text', 'blog-personal' ),
	'section'  => 'section_footer',
	'type'     => 'textarea',	
	)
);


/************************  Footer Copyright  ******************/
$wp_customize->add_setting( 'theme_options[copyright_text]',
	array(
	'default'           => $default['copyright_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_textarea_field',	
	)
);
$wp_customize->add_control( 'theme_options[copyright_text]',
	array(
	'label'    => esc_html__( 'Footer Copyright', 'blog-personal' ),
	'section'  => 'section_footer',
	'type'     => 'text',
	
	)
);

/****************************** Enable Powerd By Text *************************/
$wp_customize->add_setting('theme_options[enable_powerby_text]', 
	array(
	'default' 			=> $default['enable_powerby_text'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'blog_personal_sanitize_checkbox'
	)
);

$wp_customize->add_control('theme_options[enable_powerby_text]', 
	array(		
	'label' 	=> esc_html__('Enable Powered By Text', 'blog-personal'),
	'section' 	=> 'section_footer',
	'settings'  => 'theme_options[enable_powerby_text]',
	'type' 		=> 'checkbox',	
	)
);