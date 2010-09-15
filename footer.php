<?php
/**
 * @package WordPress
 * @subpackage Franklin_Street
 */
?>
</div>
<?php wp_reset_query(); ?>
<div id="page_bottom" class='clear'>
	<footer id='page_footer' class='wrapper clear'>	
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer") ) : ?>
		<?php endif; ?>
	</footer>
</div>
<div id="page_heel">
	<div class="wrapper clear">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Heel") ) : ?>
		<?php endif; ?>
	</div>
</div>
<div id="sticky_footer">
	This will be the first-timer module. 
</div>
<?php wp_footer(); ?>
</body>
</html>