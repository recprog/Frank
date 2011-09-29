<?php
/**
 * @package WordPress
 * @subpackage Franklin_Street
 */
?>
</div>
</div>
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
<?php wp_footer(); ?>
</body>
</html>
<!--<?php echo get_num_queries(); ?> queries in <?php timer_stop(1); ?> seconds.-->