<article itemscope itemtype="http://schema.org/BlogPosting" class='post post-<?php echo($queryObject->current_post+1); ?>'>
	<header>
		<h1 class="truncate"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
	</header>
	<section>
		<?php the_post_thumbnail( 'small-thumbnail' ); ?>
		<?php the_content('Read On&hellip;'); ?>
	</section>
	<footer>
		<ul class='metadata horizontal clear'>
			<li class='time'><time datetime="<?php the_time('Y-m-d'); ?>" itemprop="datePublished"><?php the_time(get_option('date_format')); ?></time></li>										
			<li class='comments'><?php comments_popup_link('No comments', '1 comment', '% comments'); ?></li>
		</ul>
	</footer>
</article>