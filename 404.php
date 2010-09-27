<?php
/**
 * @package WordPress
 * @subpackage Franklin_Street
 */
?>
<?php get_header(); ?>
<div id="content" class="fullspread clearfix fourohfour">
	<div id="content_primary">
		<header>
			<h1>404</h1>
			<h2>Sorry dude, but looks like you took a wrong turn. Or I screwed up. Or both.</h2>
		</header>
		<div class='container'>
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("404") ) : ?>
				Name of blog
			<?php endif; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>