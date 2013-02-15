<?php
/**
 * @package Frank
 */
/*
Template Name: Full-spread Template With Post Footer
*/
?>
<?php get_header(); ?>
<div id="content" class="page fullspread clear">
	<main id="content-primary" role="main">
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>		
		<article class="post" id="p<?php the_ID(); ?>">
			<header>
				<h1><?php the_title(); ?></h1>
			</header>
			<section>
				<?php the_content(); ?>
			</section>
			<footer>
				<div id='post-footer' class='clear'>
					<?php if ( !dynamic_sidebar("Post Footer") ) : ?>
					<?php endif; ?>
				</div>
			</footer>
		</article>
		<?php endwhile; endif; ?>
	</main>
</div>
<?php get_footer(); ?>