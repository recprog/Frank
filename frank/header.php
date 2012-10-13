<?php
/**
 * @package WordPress
 * @subpackage Frank
 */
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
	<meta name="viewport" content="width=device-width" />
	
	<title><?php if (function_exists('is_tag') && is_tag()) { echo 'Tag Archive for &quot;'.$tag.'&quot;&mdash;'; } elseif (is_archive()) { wp_title(''); echo ' Archive&mdash;'; } elseif (is_search()) { echo 'Search for &quot;'.wp_specialchars($s).'&quot;&mdash;'; } elseif (!(is_404()) && (is_single()) || (is_page())) { wp_title(''); echo '&mdash;'; } elseif (is_404()) { echo 'Not Found&mdash;'; } bloginfo('name'); ?></title>

	<?php 
	if(!frank_devmode()) {
		wp_enqueue_style('frank_stylesheet', get_bloginfo( 'stylesheet_url' ), null, '0.1', 'all' );
	}
	else {
		wp_enqueue_style('frank_stylesheet_reset', get_template_directory_uri().'/stylesheets/css/reset.css', null, '0.1', 'all' );
		wp_enqueue_style('frank_stylesheet_grid', get_template_directory_uri().'/stylesheets/css/grid.css', null, '0.1', 'all' );
		wp_enqueue_style('frank_stylesheet_global', get_template_directory_uri().'/stylesheets/css/global.css', null, '0.1', 'all' );
		wp_enqueue_style('frank_stylesheet_forms', get_template_directory_uri().'/stylesheets/css/forms.css', null, '0.1', 'all' );
		wp_enqueue_style('frank_stylesheet_widgets', get_template_directory_uri().'/stylesheets/css/widgets.css', null, '0.1', 'all' );
		wp_enqueue_style('frank_stylesheet_sprites', get_template_directory_uri().'/stylesheets/css/sprites.css', null, '0.1', 'all' );
		wp_enqueue_style('frank_stylesheet_transitions', get_template_directory_uri().'/stylesheets/css/transitions.css', null, '0.1', 'all' );
		wp_enqueue_style('frank_stylesheet_header', get_template_directory_uri().'/stylesheets/css/header.css', null, '0.1', 'all' );
		wp_enqueue_style('frank_stylesheet_index', get_template_directory_uri().'/stylesheets/css/index.css', null, '0.1', 'all' );
		wp_enqueue_style('frank_stylesheet_single', get_template_directory_uri().'/stylesheets/css/single.css', null, '0.1', 'all' );
		wp_enqueue_style('frank_stylesheet_archive', get_template_directory_uri().'/stylesheets/css/archive.css', null, '0.1', 'all' );
		wp_enqueue_style('frank_stylesheet_fourohfour', get_template_directory_uri().'/stylesheets/css/fourohfour.css', null, '0.1', 'all' );
		wp_enqueue_style('frank_stylesheet_sidebar', get_template_directory_uri().'/stylesheets/css/sidebar.css', null, '0.1', 'all' );
		wp_enqueue_style('frank_stylesheet_comments', get_template_directory_uri().'/stylesheets/css/comments.css', null, '0.1', 'all' );
		wp_enqueue_style('frank_stylesheet_footer', get_template_directory_uri().'/stylesheets/css/footer.css', null, '0.1', 'all' );
		wp_enqueue_style('frank_stylesheet_colorbox', get_template_directory_uri().'/stylesheets/css/colorbox.css', null, '0.1', 'all' );
		wp_enqueue_style('frank_stylesheet_hacks', get_template_directory_uri().'/stylesheets/css/hacks.css', null, '0.1', 'all' );
		
		wp_enqueue_style('frank_stylesheet_mobile', get_template_directory_uri().'/stylesheets/css/mobile.css', null, '0.1', 'all' );
		wp_enqueue_style('frank_stylesheet_print', get_template_directory_uri().'/stylesheets/css/print.css', null, '0.1', 'print' );
	}	
	?>

	
	<!--[if IE]>
	<?php wp_enqueue_style('frank_stylesheet_ie', get_template_directory_uri().'/stylesheets/css/ie.css', null, '0.1', 'all' ); ?>
	<![endif]-->
	<!--[if IE 7]>
	<?php wp_enqueue_style('frank_stylesheet_ie7', get_template_directory_uri().'/stylesheets/css/ie7.css', null, '0.1', 'all' ); ?>
	<![endif]-->
	
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php get_feed_link( 'rss2' ) ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
	<!--[if lte IE 8]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js" type="text/javascript"></script>
	<![endif]-->
	
	<!--[if lt IE 7]>
	<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE7.js"></script>
	<![endif]-->
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php wp_head(); ?>	
</head>
<body id="page" <?php body_class($class); ?>>
<div class="container">
	<div class="row">
	<header id="page_header">
		<div class='row'>
		<hgroup class='9 columns'>
			<h1 id="title"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
			<h2 id="description"><?php bloginfo('description'); ?></h2>
		</hgroup>
		</div>
		<nav>
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Navigation") ) : ?>
			<div class='menu clear'>
				<?php wp_nav_menu( array('theme_location' => 'primary', 'container' => false ) ); ?>	
			</div>
			<?php endif; ?> 
		</nav>
	</header>
	<?php if ( is_active_sidebar("widget-subheader") ) : ?>
		<div id='sub_header' class='row'>
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sub Header") ) : ?>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	</div>