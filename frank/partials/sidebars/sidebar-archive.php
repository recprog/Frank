<?php
/**
 * @package Frank
 */
?>
	<aside id="sidebar" role="complementary">	
			<?php if ( !dynamic_sidebar('Index Right Aside') ) : ?>
				<h3>
				  <?php _e('About This Site', 'frank_theme'); ?>
				</h3>
				<p><?php bloginfo('description'); ?></p>
				<h3>
				  <?php _e('Search', 'frank_theme'); ?>
				</h3>
				<?php get_search_form(); ?>
			<?php endif; ?>
	</aside>