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
		<div class="post" id="<?php the_ID(); ?>">
			<header>
				<h1><?php the_title(); ?></h1>
			</header>
			<section>
				<?php the_content(); ?>
			</section>
		</div> <!-- .post -->
		<?php endwhile; endif; ?>
	</article>
	<?php get_sidebar(); ?>
	<!-->
	<div id="content_secondary" class="span-3 last">
		<h3>Highlighted Content</h3>
		<?php related_posts(); ?>
	</div>
	-->
</div>

<?php get_footer(); ?>