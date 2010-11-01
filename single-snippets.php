<?php
/**
 * @package WordPress
 * @subpackage Franklin_Street
 */
?>
<?php get_header(); ?>
<div id="content" class="span-14 last single clear">
	<div id="content_primary" class='span-11 clear'>
		<?php while(have_posts()) : the_post(); ?>
		<article <?php post_class(); ?>>
			<header>
				<hgroup>
					<h1><span class='iconic document'></span><?php the_title(); ?></h1>
					<ul class='metadata clear'>
						<li class='time iconic clock'><time datetime="<?php the_time('Y-m-d'); ?>" pubdate><?php the_time('Y-j-n, g:i a'); ?></time></li>											
					</ul>
				</hgroup>
			</header>
			<section>
				<?php the_content(); ?>
			</section>
			<footer>
				<div class='pagination'>
					<?php wp_link_pages(); ?>
				</div>
				<div id='post_footer' class='clear'>
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Post Footer") ) : ?>
					<?php endif; ?>
				</div>
			</footer>
		</article>
		<?php endwhile; ?>
	</div>
</div>
<?php get_footer(); ?>