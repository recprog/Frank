<?php
/**
 * @package Frank
 */
?>
</div>
<?php if ( is_active_sidebar("widget-footer") ) : ?>
<div id="page-bottom">
	<footer id='page-footer' class='container'>	
		<div class="row">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer") ) : ?>
			
		<?php endif; ?>
		</div>
	</footer>
</div>
<?php endif; ?>
<?php wp_footer(); ?>
</body>
</html>