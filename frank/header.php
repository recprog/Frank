<?php
/**
 * @package WordPress
 * @subpackage Frank
 */
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
	<meta charset="UTF-8" />
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
	<meta name="viewport" content="width=device-width" />
	
	<title><?php if (function_exists('is_tag') && is_tag()) { echo 'Tag Archive for &quot;'.$tag.'&quot;&mdash;'; } elseif (is_archive()) { wp_title(''); echo ' Archive&mdash;'; } elseif (is_search()) { echo 'Search for &quot;'.wp_specialchars($s).'&quot;&mdash;'; } elseif (!(is_404()) && (is_single()) || (is_page())) { wp_title(''); echo '&mdash;'; } elseif (is_404()) { echo 'Not Found&mdash;'; } bloginfo('name'); ?></title>

	<?php if(franklin_devmode()) : ?>
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/stylesheets/css/reset.css" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/stylesheets/css/grid.css" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/stylesheets/css/global.css" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/stylesheets/css/forms.css" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/stylesheets/css/widgets.css" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/stylesheets/css/sprites.css" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/stylesheets/css/transitions.css" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/stylesheets/css/header.css" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/stylesheets/css/index.css" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/stylesheets/css/single.css" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/stylesheets/css/archive.css" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/stylesheets/css/fourohfour.css" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/stylesheets/css/sidebar.css" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/stylesheets/css/comments.css" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/stylesheets/css/footer.css" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/stylesheets/css/colorbox.css" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/stylesheets/css/hacks.css" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/stylesheets/css/mobile.css" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/stylesheets/css/print.css" type="text/css" media="all" />
	<?php else : ?>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<?php endif; ?> 
	
	<!--[if IE]>
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/stylesheets/css/ie.css" type="text/css" media="screen" />
	<![endif]-->
	<!--[if IE 7]>
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/stylesheets/css/ie7.css" type="text/css" media="screen" />
	<![endif]-->
	
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
	<?php wp_head(); ?>
	
	<!--[if lte IE 8]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js" type="text/javascript"></script>
	<![endif]-->
	
	<!--[if lt IE 7]>
	<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE7.js"></script>
	<![endif]-->	
</head>
<body id="page">
<div id="page_top" class='wrapper clear'>
	<header id="page_header" class="clear">
		<hgroup>
			<h1 id="title"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
			<h2 id="description"><?php bloginfo('description'); ?></h2>
		</hgroup>
		<nav class='clear'>
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Navigation") ) : ?>
			<div class='menu clear'>
				<?php wp_nav_menu( array('theme_location' => 'primary', 'container' => '' ) ); ?>	
			</div>
			<?php endif; ?> 
		</nav>
	</header>
	<?php if ( is_active_sidebar("widget-subheader") ) : ?>
		<div id='sub_header' class='clear'>
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sub Header") ) : ?>
			<?php endif; ?>
		</div>
	<?php endif; ?>