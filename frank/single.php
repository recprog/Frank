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
						<li class="date"><time datetime="<?php the_time('Y-m-d'); ?>" itemprop="datePublished"><?php the_time(get_option('date_format')); ?></time></li>
						<li class="author">By <?php the_author_link(); ?></li>
						<li class="categories"><?php the_category(', '); ?></li>
						<li class="tags"><?php the_tags('', ', '); ?></li>
						<li class='comments'><?php comments_popup_link('No comments', '1 comment', '% comments'); ?></li>	
					</ul>
					<a id="post_tweet" class="button alt small" href="https://twitter.com/share?text=<?php the_title(); ?>&via=somerandomdude&related=somerandomdude&url=<?php the_permalink(); ?>&counturl=<?php the_permalink(); ?>" target="_blank">Tweet this Post</a>
					<div id="previous_post" class="clearfix">
						<?php previous_post_link('%link', '<nav><span class="arrow">%title</span></nav><p>%title</p>'); ?>
					</div>
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Post Left Aside') ) : ?>
					<?php endif; ?>
				</div>
			</div>
			
			<?php if (is_active_sidebar("widget-postfooter")) : ?>
			<footer id="post_footer" class='row'>				
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