<?php
/**
 * @package Frank
 */
?>
<?php get_header(); ?>
<div class="content">
	<main class="content-primary" role="main">
		<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<article class="post row" id="p<?php the_ID(); ?>">
			<header class="post-header">
				<h1 class="post-title"><?php the_title(); ?></h1>
			</header>
			<section class="post-content">
				<?php the_content(); ?>
			</section>
		</article>
		<?php endwhile; endif; ?>
		<?php comments_template(); ?>
	</main>
</div>
<?php get_footer(); ?>