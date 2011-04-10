<?php
/*
	Template Name: Four Up
*/
?>
<div class='span-12 clear content fourup'>
	<div class='nav content-header'>
		<span class='label'><?php print($title); ?></span>
		<span class='caption'><?php print($caption) ?></span> <span class='more'><a href='<?php bloginfo('url'); ?>?cat=<?php echo implode(",",array_filter($categories)); ?>'>View Archives&hellip;</a></span> 
	</div>
	<div class='contents span-12 last'>	
	
	<?php while ( $queryObject->have_posts() ) : $queryObject->the_post(); ?>
	
		<article <?php post_class('span-3 post-'.($queryObject->current_post+1)); ?>>
			<header>
				<h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
			</header>
			<section><?php $content = content(80, "Read More", 190, 120, 80, true); ?></section>
			<footer>
				<ul class='metadata clear'>
					<li class='time'><time datetime="<?php the_time('Y-m-d'); ?>" pubdate>Posted <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></time></li>										
					<li class='comments'><?php comments_popup_link('No comments', '1 comment', '% comments'); ?></li>
				</ul>
			</footer>
		</article>
	<?php endwhile; ?>
</div>
</div>