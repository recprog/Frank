<?php
/**
 * @package WordPress
 * @subpackage Frank
 */
?>
<?php get_header(); ?>
<div id="content" class="page clear">
	<div id="content_primary" class="span-9">
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
		<article class="post clear" id="p<?php the_ID(); ?>">
			<header>
				<h1><?php the_title(); ?></h1>
			</header>
			<section>
				<?php the_content(); ?>
			</section>
		</article>
		<?php endwhile; endif; ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>