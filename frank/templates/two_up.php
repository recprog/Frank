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
		<article itemscope itemtype="http://schema.org/BlogPosting" class='clear post-.<?php echo($queryObject->current_post+1); ?>'>
			<header>
				<h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
			</header>
			<section>
				<?php the_content('Read On&hellip;'); ?>
			</section>
			<footer>
				<ul class='metadata clear'>
					<li class='time'><time datetime="<?php the_time('Y-m-d'); ?>" itemprop="datePublished"><?php the_time('F j, Y'); ?></time></li>
					<li class='author'>By <?php the_author_link(); ?></li>										
					<li class='comments'><?php comments_popup_link('No comments', '1 comment', '% comments'); ?></li>
				</ul>
			</footer>
		</article>
	<?php endwhile; ?>

	</div>
</div>