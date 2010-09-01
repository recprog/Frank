<?php
/**
 * @package WordPress
 * @subpackage Franklin_Street
 */
?>
</div>
<?php wp_reset_query(); ?>
	<footer id='page_footer' class='clear'>
		<div class='wrapper showgrid clear'>
		<div class='span-4'>
			<?php if(is_home()) : ?>
				<h3>Older Posts</h3>
			<?php else : ?>
				<h3>Recent Posts</h3>
			<?php endif; ?>
			<ul id="footer_recent_posts">
				<?php 
			
				$offset = (is_home())?5:0;
			
				query_posts(array( 'cat' => getPrimaryColumnCategories(),  'showposts' => 5, 'offset' => $offset ));
				if(have_posts()) : while(have_posts()) : the_post();
				$category = get_the_category(); 
				?>
					<li class="<?php print $category[0]->category_nicename; ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; else : ?>
					<li>No Posts</li>
				<?php endif; ?>
			</ul>
			<?php if (function_exists("get_mostpopular")) get_mostpopular(); ?>
		</div>
		<div class='span-3 last'>
			<?php if (function_exists('get_recent_comments')) { ?>
			   <h3><?php _e('Recent Comments:'); ?></h3>
			   <dl class='recent_comments'><?php get_recent_comments(); ?></dl>
			<?php } ?>
		</div>
		<div class='span-2'>
			<h3>Categories</h3>
			<ul id="cat_navigation">
				<?php wp_list_categories('title_li='); ?>
			</ul>
		</div>
		<div class='span-2'>
			<?php wp_list_bookmarks(array(
			    'orderby'          => 'name',
			    'order'            => 'ASC',
			    'limit'            => -1,
			    'category'         => null,
			    'exclude_category' => null,
			    'category_name'    => null,
			    'hide_invisible'   => 1,
			    'show_updated'     => 0,
			    'echo'             => 1,
			    'categorize'       => 1,
			    'title_li'         => __('Bookmarks'),
			    'title_before'     => '<h3>',
			    'title_after'      => '</h3>',
			    'category_orderby' => 'name',
			    'category_order'   => 'ASC',
			    'class'            => 'linkcat',
			    'category_before'  => '',
			    'category_after'   => '' )); ?>
		</div>
		<div class='span-3 last'>
			<h3>Download This Theme</h3>
			<p>This theme is based on the <a href='/articles/current-events/making-good-word-finally-releasing-wordpress-theme/'>Franklin Street Wordpress theme</a> - an open source project of mine. It is free to use however you see fit. I am planning to release this current implementation of the theme as well in the near future.</p>
			<ul id="blog_details">
							<li class="copyleft"><a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/us/"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-sa/3.0/us/80x15.png" /></a> <a href="/">P.J. Onori</a></li>
							<li><a href="/hi">Contact</a></li>
							<li><a href="/subscribe">Subscribe</a></li>
							<li><a href="/ads">Advertisers</a></li>
							<li><a href="/compatibility">Compatibility Report</a></li>
							<li><a href="/mint">Statistics</a></li>
							<li><a href="http://technorati.com/claim/i8fxnzgswu" rel="me">Technorati Profile</a></li>
							
						</ul>
		</div>
		</div>
	</footer>
<div id="sticky_footer">
	
</div>
<?php wp_footer(); ?>
</body>
</html>