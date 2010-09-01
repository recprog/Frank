<?php
/**
 * @package WordPress
 * @subpackage Franklin_Street
 */
?>
<?php get_header(); ?>
		<div id="content" class="fullspread clearfix fourohfour">
			<div id="content_primary">
				<div class="container">
					<h2 id="foutohfour_title">404</h2>
					<h3>Sorry dude, but looks like you took a wrong turn. Or I screwed up. Or both.</h3>
					<p>That didn't work out too well, but let's give it another shot. Either try typing out the URL again or you can just check out some of these handy links below.</p>
					<div id="recent_posts">
					<h4>Recent Posts</h4>
				<ul id="fourohfour_recent_posts">
					<?php 
					query_posts('cat=3&showposts=5&offset=0');
					if(have_posts()) : while(have_posts()) : the_post();
					$category = get_the_category(); 
					?>
						<li class="<?php print $category[0]->category_nicename; ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
					<?php endwhile; else : ?>
						<li>No Posts</li>
					<?php endif; ?>
				</ul>
				</div>
				<div id="popular_posts">
				<h4 class="typeface-js">Popular Posts</h4>
				<ul>
					<?php mdv_most_commented(5); ?>
				</ul>
				</div>	
				</div>
			</div>
		</div>
	</div>
</body>
</html>