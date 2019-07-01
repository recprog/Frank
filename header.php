<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<title><?php wp_title( '&mdash;', true, 'right' ); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
	<!--[if lt IE 9]><script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body <?php body_class(); ?>>

<div class="wrap wrap-header">
	<div class="wrap-section-in">

		<?php do_action( 'header_before' ); ?>

		<nav id="header" role="navigation">

			<p id="logo" role="banner">
				<a href="<?php echo home_url() ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<?php 
					$header_image = get_header_image();

					if ( ! empty( $header_image ) )
						printf(
							'<img src="%s" width="%d" heigth="%d" alt="%s" title="%s" class="custom-logo" />',
							$header_image,
							get_custom_header()->width,
							get_custom_header()->height,
							esc_attr( get_bloginfo( 'name' ) ),
							esc_attr( get_bloginfo( 'name' ) )
						);
					?>
					<strong><?php bloginfo('name'); ?></strong>
				</a>
				<em><?php bloginfo('description'); ?></em>
			</p>
			
			<?php
				if ( has_nav_menu( 'main_menu' ) ) {

					$menu = wp_nav_menu( array( 
						'theme_location' => 'main_menu',
						'container_id' => 'nav-main',
						'fallback_cb' => null,
						'depth' => 2,
						'echo' => false
					) );

					printf(
						'<a id="nav-main-toggle" href="#nav-main" title="%s"></a>
						%s',
						__( 'Menu', 'frank' ),
						$menu
					);

				}

				if ( has_nav_menu( 'blog_menu' ) && ( is_home() || is_archive() || is_single() ) ) {

					$menu_locations = get_nav_menu_locations();
					$blog_menu_meta = wp_get_nav_menu_object( $menu_locations[ 'blog_menu' ] );

					$blog_menu = wp_nav_menu( array( 
							'theme_location' => 'blog_menu',
							'container_id' => 'nav-blog-header',
							'fallback_cb' => null,
							'depth' => 1,
							'echo' => false
						) );

					printf(
						'<div class="nav-blog nav-blog-header">
							<h2>%s</h2>
							%s
						</div>',
						esc_html( $blog_menu_meta->name ),
						$blog_menu
					);

				} elseif ( is_user_logged_in() && isset( $_POST['wp_customize'] ) ) {
					$message = __( 'Note: This area could display a blog related menu. Add them as menu items to the "Blog menu" area.', 'frank' );

					printf( 
						'<p class="preview-notice">%s</p>', 
						esc_html( $message )
					);
				}
			?>
		</nav>

		<?php do_action( 'header_after' ); ?>

		<div class="index-header">
			<div class="index-description">
				<h1>I build websites, software products<br>and electronic devices.</h1>
				<p><a>Read my blog</a>, view my <a>projects</a>, follow me <a>@frank</a> and on <a>GitHub</a>.</p>
			</div>
		</div>
	</div>
</div>

<div class="wrap wrap-content-main">
	<div class="wrap-section-in">

		<div id="content-main" class="hfeed" role="main">

		<?php do_action( 'content_before' ); ?>

