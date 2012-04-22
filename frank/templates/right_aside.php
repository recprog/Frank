<?php
/*
	Template Name: Right Aside
*/
?>
<div class='clear content halfandhalf'>
	<div class='nav content-header'>
		<span class='label'><?php print($title); ?></span>
		<span class='caption'><?php print($caption) ?></span> <span class='more'><?php next_posts_link('View more&hellip;'); ?></span>
	</div>
	<div class='contents span-9'>	
	<?php 		
	 while ( $queryObject->have_posts() ) : $queryObject->the_post(); ?>
		
		<article itemscope itemtype="http://schema.org/BlogPosting" class='clear'>
			<header>
				<h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
			</header>
			<div class='clear'>
			<div class='post-info span-2'>
				<ul class='metadata vertical'>
					<li class="date"><time datetime="<?php the_time('Y-m-d'); ?>" itemprop="datePublished"><?php the_time(get_option('date_format')); ?></time></li>
					<li class="author">By <?php the_author_link(); ?></li>
					<li class="categories"><?php the_category(', '); ?></li>
					<li class="tags"><?php the_tags('', ', '); ?></li>
					<li class='comments'><?php comments_popup_link('No comments', '1 comment', '% comments'); ?></li>	
				</ul>
			</div>
			<section class='span-7 last'>
				<?php if (!empty($post->post_excerpt)) : ?>
				<p><?php echo get_the_excerpt(); ?> <span class='more-link'><a href="<?php the_permalink(); ?>">Read On&hellip;</a></span></p>
				<?php else : ?>
				<?php the_content('Read On&hellip;'); ?>
				<?php endif; ?>
			</section>
			</div>
			<footer class='prefix-2'>
				<ul class='metadata clear'>								
					<li class='comments'><?php comments_popup_link('No comments', '1 comment', '% comments'); ?></li>	
					<li class='tweet'><a href='http://twitter.com/home?status=<?php the_title() ?> <?php the_permalink() ?>'>Retweet This Post</a></li>
				</ul>
			</footer>
		</article>
	<?php endwhile; ?>

	</div>
	<div class='widgets span-3 last'>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Index Right Aside") ) : ?>
			<p><?php bloginfo('description'); ?></p>
		<?php endif; ?>
	</div>
</div>