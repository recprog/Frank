<?php
/**
 * @package Frank
 */
?>
<?php get_header(); ?>
<div id="content" class="archive">
	<div class="row">
	<div id="content-primary">
	<?php if(have_posts()) : ?>
	<header>
		<h1 class="page-title">Search Results for &#8216;<?php the_search_query(); ?>&#8217;</h1>
	</header>
	<div class="posts">
		<?php while(have_posts()) : the_post(); ?>
			<?php get_template_part('partials/posts/post'); ?>
		<?php endwhile; ?>
		<?php get_template_part( 'partials/post-pagination'); ?>
		<?php else : ?>
		<div class="post">
		
			<h2>No Results Were Found</h2>
			
			<p>There were no matches for your search. Please try a different search term.</p>
			
		</div>
		<?php endif; ?>
		</div>
	</div>
	</div>
</div>

<?php get_footer(); ?>