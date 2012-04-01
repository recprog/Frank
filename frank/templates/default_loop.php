<?php
/*
	Template Name: Default Loop
*/
?>
<div class='content default row'>
	<div class='nine columns contents'>	
	<?php 		
	if (have_posts()) : while (have_posts()) : the_post(); ?>
		<article itemscope itemtype="http://schema.org/BlogPosting">
			<header><h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1></header>
			<div class='row'>
				<section class='nine columns push-three'>
					<?php the_post_thumbnail( 'default-thumbnail' ); ?>
					<?php the_content('Read On&hellip;'); ?>
				</section>
				<footer class='three columns pull-nine post-info'>	
					<ul class='metadata vertical'>
						<li class="date"><time datetime="<?php the_time('Y-m-d'); ?>" itemprop="datePublished"><?php the_time('F j, Y'); ?></time></li>
						<li class="author">By <?php the_author_link(); ?></li>
						<li class="categories"><?php the_category(', '); ?></li>
						<li class='comments'><?php comments_popup_link('No comments', '1 comment', '% comments'); ?></li>	
					</ul>
				</footer>
			</div>
		</article>
	<?php endwhile; ?>
	<?php endif; ?>
	</div>
	<div id="sidebar" class='three columns widgets'>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Index Right Aside") ) : ?>
			<h3>About This Site</h3>
			<p><?php bloginfo('description'); ?></p>
			<h3>Search</h3>
			<?php get_search_form(); ?>
		<?php endif; ?>
	</div>
</div>