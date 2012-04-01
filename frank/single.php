<?php
/**
 * @package WordPress
 * @subpackage Frank
 */
?>
<?php get_header(); ?>
<div id='content' class='single'>
	<div class="row">
	<div id='content_primary' class='nine columns'>
		<?php while(have_posts()) : the_post(); ?>
		<article itemscope itemtype="http://schema.org/BlogPosting">
			<header><h1><?php the_title(); ?></h1></header>
			<?php if($post->post_excerpt) : ?>
				<div id='excerpt'><?php the_excerpt(); ?></div>
			<?php endif; ?>
			<div id='content_main' class='row'>
				<section class='nine columns push-three'>
					<?php the_post_thumbnail( 'default-thumbnail' ); ?>
					<?php the_content(); ?>
					<?php wp_link_pages('before=<div class="pagination small"><span class="title">Pages:</span>&after=</div>'); ?>
				</section>
				<div class='three columns pull-nine post-info'>
					<ul class='metadata vertical'>
						<li class="date"><time datetime="<?php the_time('Y-m-d'); ?>" itemprop="datePublished"><?php the_time('F j, Y'); ?></time></li>
						<li class="author">By <?php the_author_link(); ?></li>
						<li class="categories"><?php the_category(', '); ?></li>
						<li class='comments'><?php comments_popup_link('No comments', '1 comment', '% comments'); ?></li>	
					</ul>
					<div class='previous'>
						<?php previous_post('%','<nav><span class="arrow">Previous Post</span></nav>', 'yes'); ?> 
					</div>
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Post Left Aside') ) : ?>
					<?php endif; ?>
				</div>
			</div>
			
			<?php if (is_active_sidebar("widget-postfooter")) : ?>
			<footer class='row'>				
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Post Footer') ) : ?>
					<?php endif; ?>
			</footer>
			<?php endif; ?>
			
		</article>
		<?php endwhile; ?>
		<?php comments_template(); ?>
	</div>
	<?php get_sidebar(); ?>	
	</div>
</div>
<?php get_footer(); ?>