<?php
/**
 * @package WordPress
 * @subpackage Frank
 */
?>
</div>
<div id="page_bottom" class='clear'>
	<footer id='page_footer' class='wrapper'>
		<div class="clear">	
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer") ) : ?>
			
		<?php endif; ?>
		</div>
		<div id="twitter_follow">
			<p><?php echo twounter('somerandomdude') ?> people follow me on Twitter. <a href="http://twitter.com/somerandomdude" class="button alt">You should too.</a></p>
			<small>P.J. Onori <em><a href='http://creativecommons.org/licenses/by-sa/3.0/'>Licensed under Creative Commons Attribution-ShareAlike 3.0 Unported.</a></em></strong>
		</div>
	</footer>
</div>
<?php wp_footer(); ?>
<?php if(franklin_devmode()) : ?>
	<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/frank.slideshow.js"></script>
	<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/simplebox.js"></script>
	<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/main.js"></script>
<?php else : ?>
	<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/somerandomdude.js"></script>
<?php endif; ?>	

</body>
</html>
<!--<?php echo get_num_queries(); ?> queries in <?php timer_stop(1); ?> seconds.-->