<?php
/**
 * @package WordPress
 * @subpackage Franklin_Street
 */
/*
Template Name: Full-spread Template
*/
?>
<?php get_header(); ?>
<div id="content" class="page fullspread clear">
	<div id="content_primary">
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
		
		<div class="post" id="p<?php the_ID(); ?>">
			<div class="article_header">
			<h2><?php the_title(); ?></h2>
			</div>
			<div class="entry">
				<?php the_content(); ?>
			</div>
		
		</div> <!-- .post -->

		<?php endwhile; endif; ?>
	</div>
</div>

<?php get_footer(); ?>