<?php
/**
 * @package WordPress
 * @subpackage Franklin_Street
 */
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
	<title><?php if ( is_single()||is_page() ) { wp_title(''); ?> &#8212; <?php } ?> <?php bloginfo('name'); ?></title>

	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />	
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats please -->

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
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/stylesheets/css/custom.css" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/stylesheets/css/mobile.css" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/stylesheets/css/print.css" type="text/css" media="all" />
	
	<!--[if IE]>
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/stylesheets/css/ie.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/stylesheets/css/ie_custom.css" type="text/css" media="screen" />
	<![endif]-->
	<!--[if IE 7]>
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/stylesheets/css/ie7.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/stylesheets/css/ie7_custom.css" type="text/css" media="screen" />
	<![endif]-->
	
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
			
	<script>
		var colorBoxURL='<?php bloginfo('template_directory'); ?>/js/jquery.colorbox-min.js';
	</script>		
			
	<?php wp_enqueue_script('jquery'); ?>
	<?php wp_enqueue_script('jquery-main', get_bloginfo('template_url') . '/js/main.js'); ?>
	<?php wp_enqueue_script('jquery-srd', get_bloginfo('template_url') . '/js/custom.js'); ?>
	
	<?php wp_head(); ?>
	
	<!--[if lte IE 8]>
	<script src="<?php bloginfo('template_url'); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->	
</head>
<body id="page">
<div id="page_top">
<div class='wrapper clear'>
	<header id="page_header" class="span-12 last clear">
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
	<div id='sub_header' class='clear'>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sub Header") ) : ?>
		<?php endif; ?>
	</div>