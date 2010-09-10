<?php
/**
 * @package WordPress
 * @subpackage Franklin_Street
 */
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
	<title><?php if ( is_single()||is_page() ) { wp_title(''); ?> &#8212; <?php } else if ($tag!=null) { echo($tag); ?> &raquo; <?php } ?> <?php bloginfo('name'); ?></title>

	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />	
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats please -->
	<meta name="verify-v1" content="by1MB81PjkQUdjinZJQn73aCwjaV5erxwsvtTP7pTNE=" />
	<meta name="msvalidate.01" content="E26B60A5A071B94556E802AA20B9F72B" />

	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/reset.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/grid.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/global.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/header.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/index.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/single_article.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/footer.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/iconic.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/transitions.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/hacks.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/srd.css" type="text/css" media="screen, projection" />
	
	<!--<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/mobile.css" type="text/css" media="handheld" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/print.css" type="text/css" media="print" />-->
	
	<!--[if IE]>
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/ie.css" type="text/css" media="screen" />
	<![endif]-->
	
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		
	<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js'></script>
	<?php wp_enqueue_script('jquery-main', get_bloginfo('template_url') . '/js/main.js'); ?>
	<?php wp_enqueue_script('jquery-srd', get_bloginfo('template_url') . '/js/srd.js'); ?>
	<!--[if lte IE 8]>
	<script src="<?php bloginfo('template_url'); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	
	<?php wp_head(); ?>
</head>
<body id="page">
<div id="page_top" class='wrapper clear'>
	<header id="page_header" class="span-14 last clear">
		<hgroup>
			<h1 id="title"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
		</hgroup>
		<nav>
			<?php $args = array(
			    'sort_column' => 'menu_order',
			    'menu_class'  => 'menu',
			    'include'     => null,
			    'exclude'     => null,
			    'echo'        => true,
			    'show_home'   => false,
			    'link_before' => null,
			    'link_after'  =>  null);
			
				wp_page_menu( $args ); ?> 
				<div id='follow' class='span-3 last'>
					<a id='follow_header' href='/follow'><?php bloginfo('name'); ?></a>
				</div>
		</nav>
	</header>
	<div id='sub_header' class='clear'>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sub Header") ) : ?>
		<?php endif; ?>
	</div>