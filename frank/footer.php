<?php
/**
 * @package Frank
 */
?>
</div>
<?php if ( is_active_sidebar("widget-footer") ) : ?>
<div id="page-bottom">
	<footer id="page-footer" class="container" role="contentinfo">	
		<div class="row">
		<?php if ( !dynamic_sidebar("Footer") ) : ?>
			
		<?php endif; ?>
		</div>
	</footer>
</div>
<?php endif; ?>
<?php wp_footer(); ?>
<!--<?php echo get_num_queries(); ?> queries in <?php timer_stop(1); ?> seconds.-->
</body>
</html>