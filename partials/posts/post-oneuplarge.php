<article itemscope itemtype="http://schema.org/BlogPosting" <?php post_class( 'post-large' ); ?>>
	<header class="post-header row">
		<h1 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
	</header>
	<div class="row">
		<section class="post-content">
			<?php the_post_thumbnail( 'featured-image' ); ?>
			<p><?php echo get_the_excerpt(); ?> <span class='more-link'><a href="<?php the_permalink(); ?>">Read On&hellip;</a></span></p>
		</section>
		<footer class="post-info">
			<?php get_template_part( 'partials/post-metadata', 'horizontal' ); ?>
		</footer>
	</div>
</article>