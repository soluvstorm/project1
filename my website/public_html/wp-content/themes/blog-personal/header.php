<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blog_Personal
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
				<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-154648503-1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-154648503-1');
		</script>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">	
		<link rel="profile" href="http://gmpg.org/xfn/11">

		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
		<div id="page" class="hfeed site">
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'blog-personal' ); ?></a>

			<?php $blog_personal_header_layout = blog_personal_get_option( 'header_layout' );	
			$header_image = get_header_image(); 
			$enable_media = blog_personal_get_option( 'enable_media' );
			$enable_search = blog_personal_get_option( 'enable_search' );?>
			<header id="masthead" class="site-header site-<?php echo esc_attr( $blog_personal_header_layout);?>" >
				<div class="hgroup-wrap"  style="background-image:url( <?php echo esc_url( $header_image );?> )">

					<div class="container">

						<section class="site-branding"> 
							<?php $site_identity = blog_personal_get_option( 'site_identity' );						
							$title = get_bloginfo( 'name', 'display' );
							$description    = get_bloginfo( 'description', 'display' );	
							if ( 'logo-only' == $site_identity ) { 
								if ( has_custom_logo() ){
									the_custom_logo();
								}
							} elseif ( 'logo-text' == $site_identity ) {
								if ( has_custom_logo() ) {
									the_custom_logo();
								}
								if ( $description ) {
									echo '<p class="site-description">'.esc_attr( $description ).'</p>';
								}
							} elseif ( 'title-only' == $site_identity && $title ) {
								if ( is_front_page() && is_home() ) { ?>
									<h1 class="site-title">
										<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
									</h1>
								<?php } else { ?>
									<p class="site-title">
										<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
									</p>
								<?php }
							} elseif ( 'title-text' == $site_identity ) {
								if ( $title ) {
									if ( is_front_page() && is_home() ) { ?>
										<h1 class="site-title">
											<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
										</h1>
									<?php } else { ?>
										<p class="site-title">
											<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
										</p>
									<?php }
								}

								if ( $description ) {
									echo '<p class="site-description">'.esc_attr( $description ).'</p>';	
								}
							}
							?>				
						</section>	

						<div id="navbar" class="navbar">  <!-- navbar starting from here -->

							<nav id="site-navigation" class="navigation main-navigation">
								<?php if ( true == $enable_media ): 
									if ( has_nav_menu( 'social-media' ) ) { ?>
										<div class="thumb-icon">
											<a href="#" target="_self"><i class="fa fa-thumbs-o-up"></i></a>
											<?php wp_nav_menu( array(
												'theme_location'  => 'social-media',
												'container_class' => 'block-social-icons social-links',					
												'depth'           => 1,
												'fallback_cb'     => false,

												) ); 
											?>
										</div>
									<?php } 
								endif; ?>

								<div class="menu-content-wrapper">									
					        		<?php
										wp_nav_menu(
											array(
												'theme_location' => 'menu-1',				
												'container_class' => 'menu-top-menu-container',
					            				'items_wrap' => '<ul>%3$s</ul>',
												'fallback_cb'    => 'wp_page_menu',
												)
											);
									?>									
								</div>

							</nav>

							<?php if ( true == $enable_search ):  ?>
								<div class="search-icon">
									<a href="javascript:void(0)" title="Search">
										<i class="fa fa-search"></i>
									</a>
								</div>
							<?php endif; ?>

						</div> <!-- navbar ends here -->

					</div>
				</div>

				<div class="search-section">
					<div class="search-container">
						<div class="close-icon">
							<span><?php esc_html_e( 'X', 'blog-personal' ); ?></span>
						</div>
						<form role="search" method="get" class="search-header" action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<input class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'blog-personal' ); ?>" value="<?php echo get_search_query(); ?>" name="s" type="search" autocomplete="off">
							</label>
							<div class="search-divider"></div>
							<h5 classs="text-filed"><?php esc_html_e( 'Type to search', 'blog-personal' ); ?></h5>
						</form><!-- .search-form -->					
					</div>
				</div>

				<?php
				/**
				 * Hook - blog_personal_action_header.
				 *
				 * @hooked blog_personal_slider - 10
				 * 
				 */
				do_action( 'blog_personal_action_header' );
				?>


			</header><!-- #masthead -->

			<div id="content" class="site-content">
				<div class="container">
					<div class="row">
