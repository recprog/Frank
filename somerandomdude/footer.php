<?php
/**
 * @package WordPress
 * @subpackage Frank
 */
?>
</div>
</div>
<div id="page_bottom" class='clear'>
	<footer id='page_footer' class='wrapper'>
		<div class="clear">	
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer") ) : ?>
			
		<?php endif; ?>
		</div>
		<div id="twitter_follow">
			<p>2,344 people follow me on Twitter. <a href="http://twitter.com/somerandomdude" class="button alt">You should too.</a></p>
		</div>
	</footer>
</div>
<?php #wp_footer(); ?>
<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/somerandomdude.js"></script>
</body>
</html>
<!--<?php echo get_num_queries(); ?> queries in <?php timer_stop(1); ?> seconds.-->