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
		<h1 class="page-title">
		<?php
		  _e('Search Results for', 'frank_theme');
		  echo ' ';
		  echo '&#8216';  // left single quotation mark
		  echo the_search_query();
		  echo '&#8217';  // right single quotation mark
		?>
		</h1>
	</header>
	<div class="posts">
		<?php while(have_posts()) : the_post(); ?>
			<?php get_template_part('partials/posts/post'); ?>
		<?php endwhile; ?>
		<?php get_template_part( 'partials/post-pagination'); ?>
		<?php else : ?>
		<div class="post">
			<h2>
			  <?php _e('No Results Were Found', 'frank_theme'); ?>
			</h2>
			<p>
			  <?php _e('There were no matches for your search. Please try a different search term.', 'frank_theme'); ?>
			</p>
		</div>
		<?php endif; ?>
		</div>
	</main>
	</div>
</div>

<?php get_footer(); ?>