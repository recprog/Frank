<?php
/*
	Template Name: Right Aside
*/
?>
<div class='span-12 last clear content halfandhalf'>
	<div class='nav content-header'>
		<span class='label'><?php print($title); ?></span>
		<span class='caption'><?php print($caption) ?></span> <span class='more'><a href='<?php bloginfo('url'); ?>?cat=<?php echo implode(",",array_filter($categories)); ?>'>View Archives&hellip;</a></span> 
		
	</div>
	<div class='contents span-9'>	
	<?php 		
	 while ( $queryObject->have_posts() ) : $queryObject->the_post(); ?>
		
		<article <?php post_class('span-9 post-'.($queryObject->current_post+1)); ?>>
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
					<dd class='tags'><?php the_tags('','<dd>','</dd>'); ?>
				</dl>
			</div>
			<section class='span-7 last'>
				<?php  $content = content(80, 'Read On&hellip;', 555, 200, 70); ?>
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