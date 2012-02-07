<?php
/**
 * @package WordPress
 * @subpackage Frank
 */
/*
Template Name: Full-spread Template With Footer
*/
?>
<?php get_header(); ?>
<div id="content" class="page fullspread clear">
	<div id="content_primary">
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>		
		<article class="post" id="p<?php the_ID(); ?>">
			<header>
				<h1><?php the_title(); ?></h1>
			</header>
			<section>
				<?php the_content(); ?>
			</section>
			<footer>
				<div id='post_footer' class='clear'>
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Post Footer") ) : ?>
					<?php endif; ?>
				</div>
			</footer>
		</article>
		<?php endwhile; endif; ?>
	</div>
</div>
<?php get_footer(); ?>