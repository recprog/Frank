<?php
/**
 * @package WordPress
 * @subpackage Frank
 */
?>
<?php get_header(); ?>
<div id="content" class="page">
	<div class="row">
	<div id="content_primary" class="nine columns">
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
</div>
<?php get_footer(); ?>