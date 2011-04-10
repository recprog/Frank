<?php
/**
 * @package WordPress
 * @subpackage Franklin_Street
 */
?>
<?php get_header(); ?>
<div id="content" class="archive clear">
	<div id="content_primary" class='span-9'>
	<?php if(have_posts()) : ?>
	<header>
		<h1>Search Results</h1>
		<h2>Click on one of the items below to go to the post</h2>
	</header>
		<?php while(have_posts()) : the_post(); ?>
			<article <?php post_class('span-9 post-'.($queryObject->current_post+1)); ?>>
				<header>
					<h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
				</header>
				<div class='clear'>
				<div class='post-info span-2'>
					<dl class='metadata'>
						<dt class='author'>By</dt>
						<dd class='author'><?php the_author_link(); ?></dd>
						<dt class='time'>Posted</dt>
						<dd class='time'><time datetime="<?php the_time('Y-m-d'); ?>" pubdate><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></time></dd>
						<dt class='categories'>Filed Under</dt>
						<dd class='categories'><?php the_category('</dd><dd>'); ?></dd>
						<dt class='tags'>Tagged</dt>
						<dd class='tags'><?php the_tags('','<dd>','</dd>'); ?>
					</dl>
				</div>
				<section class='span-7 last'>
					<?php  $content = content(80, 'Read On&hellip;', 555, 200, 70); ?>
				</section>
				</div>
				<footer class='prefix-2'>
					<ul class='metadata clear'>								
						<li class='comments'><?php comments_popup_link('No comments', '1 comment', '% comments'); ?></li>	
						<li class='tweet'><a href='http://twitter.com/home?status=<?php the_title() ?> <?php the_permalink() ?>'>Retweet This Post</a></li>
					</ul>
				</footer>
			</article> <!-- .post -->
		<?php endwhile; ?>
		<div class="pagination clear">			
			<?php if(get_next_posts_link()): ?>
				<a href='<?php echo next_posts( $max_page, false ); ?>' class='button'>Older Entries</a>
			<?php endif; ?>
			<?php if(get_previous_posts_link()): ?>
				<a href='<?php echo previous_posts( $max_page, false ); ?>' class='button'>Newer Entries</a>
			<?php endif; ?>
		</div>
		<?php else : ?>
		<div class="post">
		
			<h2>Page Not Found</h2>
			
			<p>Looks like the page you're looking for isn't here anymore. Try browsing the <a href="">categories</a>, <a href="">archives</a>, or using the search box below.</p>
			
			<?php include(TEMPLATEPATH.'/searchform.php'); ?>
	 		<!-- .post -->
		</div>
		<?php endif; ?>
	</div>
	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>