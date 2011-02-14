<?php
/**
 * @package WordPress
 * @subpackage Franklin_Street
 */
?>
<?php get_header(); ?>
<div id="content" class="span-12 last single snippet clear">
	<div id="content_primary">
		<?php while(have_posts()) : the_post(); ?>
		<article <?php post_class(); ?>>
			<section>
				<?php the_content(); ?>
			</section>
			<footer>
				<ul class='metadata clear'>
					<li class='time clock'><time datetime="<?php the_time('Y-m-d'); ?>" pubdate><?php the_time('Y-j-n, g:i a'); ?></time></li>											
				</ul>
			</footer>
		</article>
		<?php endwhile; ?>
	</div>
</div>
<?php get_footer(); ?>