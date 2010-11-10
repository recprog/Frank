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
			<h1>Page Not Found</h1>
		</header>
		<div class='container'>
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("404") ) : ?>
				<p class='default-message'>Unfortunately, the page you are looking for no longer exists or never existed in the first place. If you reached this page in error, you can go <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>">home</a> and start over. If you believe this page exists, please try searching for the page in the search input below.</p>
				<?php get_search_form(); ?>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>