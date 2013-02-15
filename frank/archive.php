<?php
/**
 * @package Frank
 */
?>
<?php get_header(); ?>
<div id="content" class="archive">
	<div class="row">
	<main id="content-primary" role="main">
	<?php if(have_posts()) : ?>
	<header>
	<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
	<?php /* If this is a category archive */ if (is_category()) { ?>
	<h1 class="page-title">Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h1>
	<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
	<h1 class="page-title">Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h1>
	<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
	<h1 class="page-title">Archive for <?php the_time('F jS, Y'); ?></h1>
	<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
	<h1 class="page-title">Archive for <?php the_time('F, Y'); ?></h1>
	<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
	<h1 class="page-title">Archive for <?php the_time('Y'); ?></h1>
	<?php /* If this is an author archive */ } elseif (is_author()) { ?>
	<h1 class="page-title">Author Archive</h1>
	<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
	<h1 class="page-title">Blog Archives</h1>
	<?php } ?>
	</header>
	<div class="posts">
		<?php while(have_posts()) : the_post(); ?>
			<?php get_template_part('partials/posts/post'); ?>
		<?php endwhile; ?>
		</div>
		<?php get_template_part( 'partials/post-pagination'); ?>
		<?php else : ?>
		<div class="post">
			<header><h1>Page Not Found</h1></header>
			<section>
			<p>Looks like the page you're looking for isn't here anymore. Try using the search box below.</p>
			<?php get_search_form(true); ?>
	 		</section>
		</div>
		<?php endif; ?>
	</div>
	<?php get_template_part('partials/sidebars/sidebar', 'archive'); ?>
	</main>
	</div>
</div>
<?php get_footer(); ?>