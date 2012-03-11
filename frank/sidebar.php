<?php
/**
 * @package WordPress
 * @subpackage Frank
 */
?>
	<aside id="sidebar" class='three columns' role="complementary">	
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Post Right Aside') ) : ?>
				<h3>About This Site</h3>
				<p><?php bloginfo('description'); ?></p>
				<h3>Search</h3>
				<?php get_search_form(); ?>
			<?php endif; ?>
	</aside>