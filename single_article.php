<?php
/**
 * @package WordPress
 * @subpackage Franklin_Street
 */
?>
<?php get_header(); ?>
	<div id="content" class="span-14 last post clear">
		<div id="content_primary" class='span-11 clear'>
			<?php while(have_posts()) : the_post(); ?>
			<article <?php post_class(); ?>>
				<header>
					<hgroup>
						<h1><span class='iconic document'></span><?php the_title(); ?></h1>
						<h2>Posted on <?php the_time('j.m.y') ?> at <?php the_time('g:i a'); ?></h2>
					</hgroup>
				</header>
				<div id='excerpt'><?php the_excerpt(); ?></div>
				<section>
					<?php the_content(); ?>
				</section>
				<footer>
					<?php wp_link_pages(); ?>
					<div class='clear'>
						<div class='span-5'>
							Messaging to subscribe to RSS and/or follow on Twitter
						    First Timer module?							
						</div>
						<div class='span-6 last'>
							Share this link? or Rate this link
						</div>
					</div>
				</footer>
			</article>
			<?php endwhile; ?>
			<div id="comments_container" class='clearfix'>
				<hgroup>
					<h2>The Discussion</h2>
					<h3><?php comments_number('No Comments', 'One Comment', '% Comments' );?> on &#8220;<?php the_title(); ?>&#8221;</h3>
				</hgroup>
				<?php comments_template(); ?>
			</div>
		</div>
	<aside id="content_secondary" class='span-3 last clearfix'>
		<?php while(have_posts()) : the_post(); ?>
		<div class="container span-6 last">
			<div class='span-3'>
				<?php if ( !function_exists('dynamic_sidebar')
				|| !dynamic_sidebar('Article Sidebar: Column 2') ) : ?>
				<?php endif; ?>
			</div>
			<div class='span-3 last'>				
				<?php if ( !function_exists('dynamic_sidebar')
				|| !dynamic_sidebar('Article Sidebar: Column 1') ) : ?>
				<?php endif; ?>
			</div>
			<?php endwhile; ?>
		</aside>
	</div>
</div>
<?php get_footer(); ?>