<article itemscope itemtype="http://schema.org/BlogPosting" <?php post_class('post-'.$wp_query->current_post+1); ?>>
	<header class="post-header">
		<h1 class="post-title truncate"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
	</header>
	<section class="post-content">
		<?php the_post_thumbnail( 'small-thumbnail' ); ?>
		<?php the_content(__('Read On&hellip;', 'frank_theme')); ?>
	</section>
	<footer class="post-info">
		<?php get_template_part('partials/post-metadata', 'horizontal'); ?>
	</footer>
</article>