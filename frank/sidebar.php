<?php
/**
 * @package WordPress
 * @subpackage Frank
 */
?>
	<aside id="sidebar" class='span-3 last' role="complementary">	
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Post Right Aside') ) : ?>
				
				<?php endif; ?>
	</aside>