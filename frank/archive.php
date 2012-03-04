<?php
/**
 * @package WordPress
 * @subpackage Franklin_Street
 */
?>
<?php get_header(); ?>
<div id="content" class="archive">
	<div class="row">
	<div id="content_primary" class='nine columns'>
	<?php if(have_posts()) : ?>
	<header>
		<hgroup>
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
		</hgroup>
	</header>
	<div class="posts">
		<?php while(have_posts()) : the_post(); ?>
			<article itemscope itemtype="http://schema.org/BlogPosting" class='clear'>
				<header>
					<h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
				</header>
				<div class="row">
				<section class='nine columns push-three'>
					<?php the_content('Read On&hellip;'); ?>
				</section>
				<div class='three columns pull-nine post-info'>
					<ul class='metadata vertical'>
						<li class="date"><time datetime="<?php the_time('Y-m-d'); ?>" itemprop="datePublished"><?php the_time('F j, Y'); ?></time></li>
						<li class="author">By <?php the_author_link(); ?></li>
						<li class="categories"><?php the_category(', '); ?></li>
						<li class='comments'><?php comments_popup_link('No comments', '1 comment', '% comments'); ?></li>	
					</ul>
				</div>
				</div>
			</article>
		<?php endwhile; ?>
		</div>
			<?php
			$next = get_next_posts_link();
			$prev = get_previous_posts_link();
			?>
			<?php if($next || $prev): ?>	
			<div class="pagination row">			
				<?php if($next): ?>
					<a href='<?php echo next_posts( $max_page, false ); ?>' class='button'>Older Entries</a>
				<?php endif; ?>
				<?php if($prev): ?>
					<a href='<?php echo previous_posts( $max_page, false ); ?>' class='button'>Newer Entries</a>
				<?php endif; ?>
			</div>
			<?php endif; ?>
		
		<?php else : ?>
		<div class="post">
			<header><h1>Page Not Found</h1></header>
			<section>
			<p>Looks like the page you're looking for isn't here anymore. Try browsing the <a href="">categories</a>, <a href="">archives</a>, or using the search box below.</p>
			<?php include(TEMPLATEPATH.'/searchform.php'); ?>
	 		</section>
		</div>
		<?php endif; ?>
	</div>
	<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>