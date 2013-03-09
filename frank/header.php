<?php
/**
 * @package Frank
 */
?>
<!DOCTYPE html>
<!--[if IE 7 | IE 8]>
<html class="ie" lang="en-US">
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	
	<title>
		<?php wp_title('&mdash;',true,'right'); ?>
 		<?php bloginfo('name'); ?>
	</title>
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php wp_head(); ?>	
</head>
<body id="page" <?php body_class(); ?>>
	<!--[if lt IE 9]>
		<div class="chromeframe">Your browser is out of date. Please <a href="http://browsehappy.com/">upgrade your browser </a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a>.</div>
	<![endif]-->
<div class="container">
	<header id="page-header" class="row" role="banner">
		<hgroup id="site-title-description">
			<h1 id="site-title"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
			<h2 id="site-description"><?php bloginfo('description'); ?></h2>
		</hgroup>


		<?php
			$header_image = get_header_image();
			if ( $header_image ) :
				if ( function_exists( 'get_custom_header' ) ) {
					$header_image_width = get_theme_support( 'custom-header', 'width' );
				} else {
					$header_image_width = HEADER_IMAGE_WIDTH;
				}
				?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php
				if ( is_singular() && has_post_thumbnail( $post->ID ) &&
						( $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( $header_image_width, $header_image_width ) ) ) &&
						$image[1] >= $header_image_width ) :
					echo get_the_post_thumbnail( $post->ID, 'post-thumbnail' );
				else :
					if ( function_exists( 'get_custom_header' ) ) {
						$header_image_width  = get_custom_header()->width;
						$header_image_height = get_custom_header()->height;
					} else {
						$header_image_width  = HEADER_IMAGE_WIDTH;
						$header_image_height = HEADER_IMAGE_HEIGHT;
					}
					?>
				<img src="<?php header_image(); ?>" width="<?php echo $header_image_width; ?>" height="<?php echo $header_image_height; ?>" alt="" />
			<?php endif; ?>
		</a>
		<?php endif; ?>

		<?php
				if ( 'blank' == get_header_textcolor() ) :
			?>
				<div class="only-search<?php if ( $header_image ) : ?> with-image<?php endif; ?>">
				<?php get_search_form(); ?>
				</div>
			<?php
				else :
			?>
				<?php get_search_form(); ?>
			<?php endif; ?>

		<nav id="site-nav" role="navigation">
			<?php if ( !dynamic_sidebar("Navigation") ) : ?>
				<?php wp_nav_menu( array('theme_location' => 'frank_primary_navigation', 'container' => false ) ); ?>	
			<?php endif; ?> 
		</nav>
		<?php if ( is_active_sidebar("widget-subheader") ) : ?>
		<div id='sub_header' class='row'>
			<?php if ( !dynamic_sidebar("Sub Header") ) : ?>
			<?php endif; ?>
		</div>
		<?php endif; ?>
	</header>
