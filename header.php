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
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/sidebar.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/comments.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/footer.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/forms.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/iconic.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/transitions.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/hacks.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/srd.css" type="text/css" media="screen, projection" />
	
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/mobile.css" type="text/css" media="handheld" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/print.css" type="text/css" media="print" />
	
	<!--[if IE]>
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie.css" type="text/css" media="screen" />
	<![endif]-->
	<!--[if IE 7]>
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie7.css" type="text/css" media="screen" />
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
			    'depth'        => 1,
			    'show_date'    => null,
			    'date_format'  => get_option('date_format'),
			    'child_of'     => 0,
			    'exclude'      => null,
			    'include'      => null,
			    'title_li'     => null,
			    'echo'         => 1,
			    'authors'      => null,
			    'sort_column'  => 'menu_order, post_title',
			    'link_before'  => null,
			    'link_after'   => null,
			    'exclude_tree' => null,
				'number'	   => 3);
			
				 ?>
				<div class='menu'>
					<ul>
						<?php wp_list_pages( $args ); ?>
						<li><a href='#'>Pages</a></li>
						<li class='last'><a href='#'>Topics</a>
							
							<!--TODO: Print this out via AJAX using Wordpress's XML-RPC interface -->
						</li>
					</ul>
				</div> 
				<div id='follow' class='span-3 last'>
					<a id='follow_header' href='/follow'><?php bloginfo('name'); ?></a>
				</div>
		</nav>
	</header>
	<div id='sub_header' class='clear'>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sub Header") ) : ?>
			<p><?php bloginfo('description'); ?></p>
		<?php endif; ?>
		<?php echo get_num_queries(); ?> queries in <?php timer_stop(1); ?> seconds.
	</div>