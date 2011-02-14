<?php
/**
 * @package WordPress
 * @subpackage Franklin_Street
 */
?>
<?php get_header(); ?>
<div id="content" class="archive clear">
	<div id="content_primary" class='span-11'>
	<?php if(have_posts()) : ?>
	<header>
	<h1>Search Results</h1>
	<h2>Click on one of the items below to go to the post</h2>
	</header>
		<?php while(have_posts()) : the_post(); ?>
		<article <?php post_class(); ?> id="<?php the_ID(); ?>">
			<header>
					<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
					<ul class='metadata clear'>
						<li class='time clock'><time datetime="<?php the_time('Y-m-d'); ?>" pubdate><?php the_time('Y-j-n, g:i a'); ?></time></li>											
						<li class='comments last'><?php comments_popup_link('No comments', '1 comment', '% comments'); ?></li>
					</ul>
			</header>
			<section class="entry">
				<?php the_content('Read the rest of this post...'); ?>
			</section>
		</article> <!-- .post -->
		<?php endwhile; ?>
		<div class="pagination clear">
			<div class="span-2 next"><?php next_posts_link( 'Older Entries' ); ?></div>
			<div class="span-2 last previous"><?php previous_posts_link( 'Newer Entries' ); ?></div>
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