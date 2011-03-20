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
	<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
	<?php /* If this is a category archive */ if (is_category()) { ?>
	<h1 class="pagetitle">Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h1>
	<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
	<h1 class="pagetitle">Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h1>
	<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
	<h1 class="pagetitle">Archive for <?php the_time('F jS, Y'); ?></h1>
	<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
	<h1 class="pagetitle">Archive for <?php the_time('F, Y'); ?></h1>
	<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
	<h1 class="pagetitle">Archive for <?php the_time('Y'); ?></h1>
	<?php /* If this is an author archive */ } elseif (is_author()) { ?>
	<h1 class="pagetitle">Author Archive</h1>
	<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
	<h1 class="pagetitle">Blog Archives</h1>
	<?php } ?>
	<h2>Click on one of the items below to go to the post</h2>
	</header>
		<?php while(have_posts()) : the_post(); ?>
			<article <?php post_class(); ?>>
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
						<dd class='tags'><?php the_tags('','<dd>','</dd>'); ?></dd>
					</dl>
				</div>
				<section class='span-7 last'>
					<?php  $content = content(80, 'Read On&hellip;', 555, 200); ?>
				</section>
				</div>
				<footer class='prefix-2'>
					<ul class='metadata clear'>								
						<li class='comments'><?php comments_popup_link('No comments', '1 comment', '% comments'); ?></li>	
						<li class='tweet'><a href='http://twitter.com/home?status=<?php the_title() ?> <?php the_permalink() ?>'>Retweet This Post</a></li>
						<?php if(!showSecondaryColumnHeader()) : ?><li class='permalink last'><a href='<?php the_permalink(); ?>'>Link</a></li><?php endif; ?>
					</ul>
				</footer>
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