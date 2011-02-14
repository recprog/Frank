<?php
/**
 * @package WordPress
 * @subpackage Franklin_Street
 */
?>
<?php get_header(); ?>
<div id='content' class='span-12 last single clear'>
	<div id='content_primary' class='span-9 clear'>
		<?php while(have_posts()) : the_post(); ?>
		<article <?php post_class(); ?> class='clear'>
			<header>
					<h1><?php the_title(); ?></h1>
			</header>
			<div id='excerpt'><?php the_excerpt(); ?></div>
			<div id='content_main' class='clear'>
				<div class='post-info span-2'>
					<dl class='metadata'>
						<dt class='author'>By</dt>
						<dd class='author'><?php the_author_link(); ?></dd>
						<dt class='time'>Posted</dt>
						<dd class='time'><time datetime="<?php the_time('Y-m-d'); ?>" pubdate><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></time></dd>
						<dt class='categories'>Filed Under</dt>
						<dd class='categories'><?php the_category('</dd><dd>'); ?></dd>
						<dt class='tags'>Tagged</dt>
						<dd class='tags'><?php the_tags('','<dd>','</dd>'); ?></dd>
					</dl>
				</div>
			<section class='span-7 last'>
				<?php the_content(); ?>
			</section>
			</div>
			<footer>
				<?php wp_link_pages('before=<div class="page-links"><p>Pages:&after=</p></div>'); ?>
				<div id='post_footer' class='clear'>
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Post Footer') ) : ?>
						<ul class='metadata clear'>								
							<li class='comments'><?php comments_popup_link('No comments', '1 comment', '% comments'); ?></li>	
							<li class='tweet'>Retweet This Post</li>
							<?php if(!showSecondaryColumnHeader()) : ?><li class='permalink last'><a href='<?php the_permalink(); ?>'>Link</a></li><?php endif; ?>
						</ul>
					<?php endif; ?>
				</div>
			</footer>
		</article>
		<?php endwhile; ?>
		<div id='comments_container' class='clear'>
			<header>
				<h1>The Discussion</h1>
				<h2><?php comments_number('No Comments', 'One Comment', '% Comments' );?> on &#8220;<?php the_title(); ?>&#8221; <span class='comments_toggle'><a href='#comments' rel="<?php the_ID(); ?>" rev="<?php bloginfo('url'); ?>/?page_id=<?php echo get_option('fs_comment_template_id'); ?>" id='comments_toggle'>Show comments</a></span></h2>
			</header>
			<?php comments_template(); ?>
			<div id='comments_ajax' class='clear'></div>				
		</div>
	</div>
<?php get_sidebar(); ?>	
</div>
<?php get_footer(); ?>