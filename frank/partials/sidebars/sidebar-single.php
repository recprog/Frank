<?php
/**
 * @package Frank
 */
?>
	<aside id="sidebar" role="complementary">	
			<?php if ( !dynamic_sidebar('Post Right Aside') ) : ?>
				<h3>About This Site</h3>
				<p><?php bloginfo('description'); ?></p>
				<h3>Search</h3>
				<?php get_search_form(); ?>
			<?php endif; ?>
	</aside>