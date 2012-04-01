<?php
/*
	Template Name: One Up (Large)
*/
?>
<div class='row content oneup large'>
	<div class='nav content-header'>
		<span class='label'><?php print($title); ?></span>
		<span class='caption'><?php print($caption); ?></span> <span class='more'><?php next_posts_link('View more&hellip;'); ?></span>
	</div>
	<div class='contents'>
<?php while ( $queryObject->have_posts() ) : $queryObject->the_post(); ?>

<article itemscope itemtype="http://schema.org/BlogPosting">
	<header>
		<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
	</header>
	<section>
		<?php the_post_thumbnail( 'featured-image' ); ?>
		<p><?php echo get_the_excerpt(); ?> <span class='more-link'><a href="<?php the_permalink(); ?>">Read On&hellip;</a></span></p>
	</section>
	<footer>
		<ul class='metadata horizontal clearfix'>
			<li class='date'><time itemprop="datePublished" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('F j, Y'); ?></time></li>
			<li class='author'>By <?php the_author_link(); ?></li>	
			<li>Filed Under <?php the_category(', '); ?></li>											
			<li class='comments'><?php comments_popup_link('No comments', '1 comment', '% comments'); ?></li>
		</ul>
	</footer>
</article>	

<?php endwhile; ?>
	</div>
</div>