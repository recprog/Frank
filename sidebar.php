<?php
/**
 * @package WordPress
 * @subpackage Franklin_Street
 */
?>
	<aside id="sidebar" class='span-3 last' role="complementary">
		
		<div class="container span-6 last">
			<div class='span-3'>
				<?php if ( !function_exists('dynamic_sidebar')
				|| !dynamic_sidebar('Article Sidebar: Column 2') ) : ?>
				
				<p>Column 2</p>
				
				<?php endif; ?>
			</div>
			<div class='span-3 last'>		
					
				<?php if ( !function_exists('dynamic_sidebar')
				|| !dynamic_sidebar('Article Sidebar: Column 1') ) : ?>
				<p>Column 1</p>	
				
				<?php if ( is_404() || is_category() || is_day() || is_month() ||
							is_year() || is_search() || is_paged() ) {
				?>

				<?php /* If this is a 404 page */ if (is_404()) { ?>
				<?php /* If this is a category archive */ } elseif (is_category()) { ?>
				<p>You are currently browsing the archives for the <?php single_cat_title(''); ?> category.</p>

				<?php /* If this is a yearly archive */ } elseif (is_day()) { ?>
				<p>You are currently browsing the <a href="<?php bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> blog archives
				for the day <?php the_time('l, F jS, Y'); ?>.</p>

				<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
				<p>You are currently browsing the <a href="<?php bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> blog archives
				for <?php the_time('F, Y'); ?>.</p>

				<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				<p>You are currently browsing the <a href="<?php bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> blog archives
				for the year <?php the_time('Y'); ?>.</p>

				<?php /* If this is a monthly archive */ } elseif (is_search()) { ?>
				<p>You have searched the <a href="<?php echo bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> blog archives
				for <strong>'<?php the_search_query(); ?>'</strong>. If you are unable to find anything in these search results, you can try one of these links.</p>

				<?php /* If this is a monthly archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<p>You are currently browsing the <a href="<?php echo bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> blog archives.</p>

				<?php } ?>
				<?php }?>
				
				<?php endif; ?>
			</div>
		</div>
	</aside>