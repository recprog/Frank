<?php
/**
 * @package WordPress
 * @subpackage Franklin_Street
 */
?>
<?php get_header(); ?>
<div id="content" class="results clearfix">
	<div id="content_primary" class='span-11'>
	<?php if(have_posts()) : ?>
	<div class="header">
		<h2>Search Results</h2>
		<small>Click on one of the items below to go to the post</small>
	</div>
		<?php while(have_posts()) : the_post(); ?>
		<div <?php post_class(); ?> id="<?php the_ID(); ?>">
			<div class="article_header">
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<h4>Posted on <?php the_time('j F, Y'); ?> at <?php the_time('g:ia'); ?> with <?php comments_popup_link('no comments', '1 comment &#187;', '% comments'); ?></h4>
			</div>
			<div class="entry">
				<?php the_content('Read the rest of this post...'); ?>
			</div>
		</div> <!-- .post -->
		<hr />
		<?php endwhile; ?>
		<div class="pagination clearfix">
			<div class="span-2 next"><?php next_posts_link( '<span class="nav-meta">&laquo;</span> Older Entries' ); ?></div>
			<div class="span-2 last previous"><?php previous_posts_link( 'Newer Entries <span class="nav-meta">&raquo;</span>' ); ?></div>
		</div>
		<?php else : ?>
		<div class="header">
			<h2>No Search Results</h2>
			<small>Apologies, I looks like we don't have what you're looking for</small>
		</div>
		<div class="post">
			
			<p>No posts found. Try a different search?</p>
			
			<?php include(TEMPLATEPATH.'/searchform.php'); ?>
		</div> <!-- .post -->

		<?php endif; ?>
		
	</div>
	<div id="content_secondary" class='span-3 last'>
		<h3>Highlighted Content</h3>
		<?php related_posts(); ?>
		<h3>Recent Posts</h3>
		<ul>
		<?php 
		
		$offset = (is_home())?5:0;
		
		if (function_exists("getPrimaryColumnCategories")) $qry=getPrimaryColumnCategories();				
		query_posts($qry.'&offset='.$offset.'&showposts='.max(0, getPrimaryColumnPostCount()-$counter));
		if(have_posts()) : while(have_posts()) : the_post();
		$category = get_the_category(); 
		?>
			<li class="<?php print $category[0]->category_nicename; ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
		<?php endwhile; else : ?>
			<li>No Posts</li>
		<?php endif; ?>
		</ul>
	</div>
</div>
<?php get_footer(); ?>