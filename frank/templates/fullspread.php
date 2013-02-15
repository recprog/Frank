<?php
/**
 * @package Frank
 */
/*
Template Name: Full-spread Template
*/
?>
<?php get_header(); ?>
<div id="content" class="page fullspread">
	<div class="row">
	<main id="content-primary" role="main">
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>		
		<article class="post" id="p<?php the_ID(); ?>">
			<header class="post-header">
				<h1 class="post-title"><?php the_title(); ?></h1>
			</header>
			<section class="post-content">
				<?php the_content(); ?>
			</section>
		</article>
		<?php endwhile; endif; ?>
	</main>
	</div>
</div>
<?php get_footer(); ?>