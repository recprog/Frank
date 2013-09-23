<?php
/**
 * @package Frank
 */
?>
<!DOCTYPE html>
<!--[if IE 7 | IE 8]>
<html class="ie" lang="en-US">
<![endif]-->
<!--[if (gte IE 9) | !(IE)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <title>
        <?php
        wp_title('&mdash;', true, 'right');
        bloginfo('name');
        ?>
    </title>

    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>

    <?php if (is_singular()) wp_enqueue_script('comment-reply'); ?>
    <?php wp_head(); ?>
</head>
<body id="page" <?php body_class(); ?>>
<!--[if lt IE 9]>
<div class="chromeframe">Your browser is out of date. Please <a href="http://browsehappy.com/">upgrade your browser </a>
    or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a>.
</div>
<![endif]-->
<div class="container">
    <header id="page-header" class="row">
        <h1 id="site-title" class="three columns"><a href="/">CFR.io</a></h1>

        <nav id="site-nav" class="nine columns">
            <ul id="menu-primary" class="menu">
                <ul id="menu-primary" class="menu">
                    <li class="last"><a href="/hello/" rel="author">Hello</a></li>
                    <li class="rss"><a href="/feed/">RSS</a></li>
                    <li class="twitter"><a href="http://twitter.com/cfrerebeau" target="_blank">Twitter</a></li>
                </ul>
            </ul>
        </nav>

    </header>
