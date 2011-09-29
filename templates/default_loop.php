<?php
/*
	Template Name: Default Loop
*/
?>
<div class='span-12 last clear content default'>
	<div class='contents span-12 last'>
<?php while ( have_posts() ) : the_post(); ?>
<article <?php post_class(); ?>>
	<header>
		<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
	</header>
	<section>
		<?php if (!empty($post->post_excerpt)) : ?>
		<p><?php echo get_the_excerpt(); ?> <span class='more-link'><a href="<?php the_permalink(); ?>">Read On&hellip;</a></span></p>
		<?php else : ?>
		<?php the_content('Read On&hellip;'); ?>
		<?php endif; ?>
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