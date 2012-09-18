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
		
			<h2>Page Not Found</h2>
			
			<p>Looks like the page you're looking for isn't here anymore. Try using the search box below.</p>
			
			<?php get_search_form(true); ?>		
		</div>
		<?php endif; ?>
		</div>
	</div>
	<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>