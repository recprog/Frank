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
	<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
	<?php /* If this is a category archive */ if (is_category()) { ?>
	<h2 class="pagetitle">Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h2>
	<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
	<h2 class="pagetitle">Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h2>
	<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
	<h2 class="pagetitle">Archive for <?php the_time('F jS, Y'); ?></h2>
	<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
	<h2 class="pagetitle">Archive for <?php the_time('F, Y'); ?></h2>
	<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
	<h2 class="pagetitle">Archive for <?php the_time('Y'); ?></h2>
	<?php /* If this is an author archive */ } elseif (is_author()) { ?>
	<h2 class="pagetitle">Author Archive</h2>
	<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
	<h2 class="pagetitle">Blog Archives</h2>
	<?php } ?>
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
		<div class="post">
		
			<h2>Page Not Found</h2>
			
			<p>Looks like the page you're looking for isn't here anymore. Try browsing the <a href="">categories</a>, <a href="">archives</a>, or using the search box below.</p>
			
			<?php include(TEMPLATEPATH.'/searchform.php'); ?>
	 		<!-- .post -->

		<?php endif; ?>
	</div>
	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>