<article itemscope itemtype="http://schema.org/BlogPosting" <?php post_class('post-'.$wp_query->current_post+1); ?>>
	<header>
		<h1 class="truncate"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
	</header>
	<section>
		<?php the_post_thumbnail( 'medium-thumbnail' ); ?>
		<?php the_content(__('Read On&hellip;' 'frank_theme')); ?>
	</section>
	<footer>
		<?php get_template_part('partials/post-metadata', 'horizontal'); ?>
	</footer>
</article>