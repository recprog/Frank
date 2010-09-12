<?php
/**
 * @package WordPress
 * @subpackage Franklin_Street
 */
?>
<?php get_header(); ?>
<div id="content" class="page clearfix">
	<article id="content_primary" class="span-11">
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
		<div class="post" id="p<?php the_ID(); ?>">
			<header>
				<h1><?php the_title(); ?></h1>
			</header>
			<section>
				<?php the_content(); ?>
			</section>
		</div>
		<?php endwhile; endif; ?>
	</article>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>