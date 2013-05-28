<article itemscope itemtype="http://schema.org/BlogPosting" class="post">
	<header class="post-header">
		<h1 class="post-title">
			<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
		</h1>
	</header>
	<div class='row'>
		<section class='post-content'>
			<?php the_content(__('Read On&hellip;', 'frank_theme')); ?>
		</section>
		<footer class='post-info'>	
			<?php get_template_part('partials/post-metadata'); ?>
		</footer>
	</div>
</article>