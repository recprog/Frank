<?php
/**
 * @package Frank
 */
?>
<?php get_header(); ?>
<div id="content" class="page">
	<div class="row">
	<div id="content-primary">
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
		<article class="post clear" id="p<?php the_ID(); ?>">
			<header class="post-header">
				<h1 class="post-title"><?php the_title(); ?></h1>
			</header>
			<section class="post-content">
				<?php the_content(); ?>
			</section>
		</article>
		<?php endwhile; endif; ?>
	</div>
	<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>