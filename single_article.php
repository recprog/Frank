<?php
/**
 * @package WordPress
 * @subpackage Franklin_Street
 */
?>
<?php get_header(); ?>
	<div id="content" class="span-14 last post clearfix">
		<div id="content_primary" class='span-11 clearfix'>
			<?php while(have_posts()) : the_post(); ?>
			<article <?php post_class(); ?>>
				<header>
					<hgroup>
						<h1><span class='iconic document'></span><?php the_title(); ?></h1>
						<h2>Posted on <?php the_time('j F, Y'); ?> at <?php the_time('g:ia'); ?></h2>
					</hgroup>
				</header>
				<div id='excerpt'><?php the_excerpt(); ?></div>
				<section>
					<?php the_content(); ?>
				</section>
				<footer>
					<?php wp_link_pages(); ?>
					<div class='clearfix'>
						<div class='span-4' style="background:#c00;">
							Messaging to subscribe to RSS and/or follow on Twitter
						    First Timer module?							
						</div>
						<div class='span-5' style="background:#c00;">
							Relevant Outside Links?
							Suggested Reading
						</div>
						<div class='span-2 last' style="background:#c00;">
							Share this link? or Rate this link
						</div>
					</div>
				</footer>
			</article>
			<?php endwhile; ?>
			<div id="comments_container" class='clearfix'>
				<hgroup class='content_header'>
					<h2>The Discussion</h2>
					<h3><?php comments_number('No Comments', 'One Comment', '% Comments' );?> on &#8220;<?php the_title(); ?>&#8221;</h3>
				</hgroup>
				<?php comments_template(); ?>
			</div>
		</div>
	<aside id="content_secondary" class='span-3 last clearfix'>
		<?php while(have_posts()) : the_post(); ?>
		<div class="container span-6 last">
			<div class='span-3'>
				<h3>Metadata</h3>
				<dl>
					<dt>Posted</dt>
					<dd>Posted on <?php the_time('j.m.y') ?> at <?php the_time('g:i a'); ?></dd>
					<dt>Category</dt>
					<dd><?php the_category(); ?></dd>
					<dt>Comments</dt>
					<dd><?php comments_number('No Comments', 'One Comment', '% Comments' ); ?></dd>
				</dl>
				<h3>Tags</h3>
				<?php if(get_the_tags()) : ?>
					<?php the_tags('<ul id="tag_full_list"><li>', '</li><li>', '</li></ul>'); ?>
				<?php else : ?>
					<small class='notags'>No tags for this post.</small>
				<?php endif; ?>	
			</div>
			<div class='span-3 last'>
				<h3>Related Posts</h3>
				<ul>
					<?php related_posts(); ?>
				</ul>
				<h3>Recent Posts</h3>
				<ul>
				<?php 
				
				$offset = (is_home())?5:0;
				
				if (function_exists("getPrimaryColumnCategories")) $qry=getPrimaryColumnCategories();				
				query_posts(array( 'cat' => -4477,  'showposts' => 5));
				if(have_posts()) : while(have_posts()) : the_post();
				$category = get_the_category(); 
				?>
					<li class="<?php print $category[0]->category_nicename; ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; else : ?>
					<li>No Posts</li>
				<?php endif; ?>
				</ul>
				<?php wp_reset_query(); ?>
				<?php
				$category = get_the_category(); 
				query_posts(array( 'cat' => $category[0]->cat_ID,  'showposts' => 5));
				if(have_posts()) : ?>
				<h3>Recent Posts in This Category</h3>
				<ul>
				<?php while(have_posts()) : the_post(); ?>
					<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; ?>
				</ul>
				<?php endif; ?>
				<?php wp_reset_query(); ?>
			</div>
			<?php endwhile; ?>
		</aside>
	</div>
</div>
<?php get_footer(); ?>