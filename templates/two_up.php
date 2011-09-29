<?php
/*
	Template Name: Two Up
*/
?>
<div class='span-12 clear content twoup'>
	<div class='nav content-header'>
		<span class='label'><?php print($title); ?></span>
		<span class='caption'><?php print($caption) ?></span> <span class='more'><?php next_posts_link('View more&hellip;'); ?></span>
		
	</div>
	<div class='contents span-12 last'>	
	
	<?php while ( $queryObject->have_posts() ) : $queryObject->the_post(); ?>
		<article <?php post_class('span-6 post-'.($queryObject->current_post+1)); ?>>
			<header>
				<h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
			</header>
			<section>
				<?php  $content = content(80); ?>
			</section>
			<footer>
				<ul class='metadata clear'>
					<li class='author'>By <?php the_author_link(); ?></li>
					<li class='time'><time datetime="<?php the_time('Y-m-d'); ?>" pubdate>Posted <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></time></li>										
					<li class='comments'><?php comments_popup_link('No comments', '1 comment', '% comments'); ?></li>
					<li class='tweet'><a href='http://twitter.com/home?status=<?php the_title() ?> <?php the_permalink() ?>'>Retweet This Post</a></li>
				</ul>
			</footer>
		</article>
	<?php endwhile; ?>

	</div>
</div>