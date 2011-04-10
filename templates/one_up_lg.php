<?php
/*
	Template Name: One Up (Large)
*/
?>
<div class='span-12 last clear content oneup large'>
	<div class='nav content-header'>
		<span class='label'><?php print($title); ?></span>
		<span class='caption'><?php print($caption); ?></span> <span class='more'><a href='<?php bloginfo('url'); ?>?cat=<?php echo implode(",",array_filter($categories)); ?>'>View Archives&hellip;</a></span> 
	</div>
	<div class='contents span-12 last'>
<?php while ( $queryObject->have_posts() ) : $queryObject->the_post(); ?>

<article <?php post_class('post-'.($queryObject->current_post+1)); ?>>
	<header>
		<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
	</header>
	<section>
		<p><?php echo get_the_excerpt(); ?> <span class='more-link'><a href="<?php the_permalink(); ?>">Read On&hellip;</a></span></p>
	</section>
	<footer>
		<ul class='metadata clear'>
			<li class='author'>By <?php the_author_link(); ?></li>	
			<li class='time'><time datetime="<?php the_time('Y-m-d'); ?>" pubdate>Posted <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></time></li>
			<li>Filed Under <?php the_category(', '); ?></li>											
			<li class='comments'><?php comments_popup_link('No comments', '1 comment', '% comments'); ?></li>
			<li class='tweet'><a href='http://twitter.com/home?status=<?php the_title() ?> <?php the_permalink() ?>'>Retweet This Post</a></li>
		</ul>
	</footer>
</article>	

<?php endwhile; ?>
	</div>
</div>