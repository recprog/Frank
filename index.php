<?php
/**
 * @package WordPress
 * @subpackage Franklin_Street
 */
?>
<?php get_header(); ?>
<div id="content" class="home clear">
	<div class='span-12 last clear content oneup large'>
		<div class='nav content-header'>
			<span class='label'><?php if (function_exists("primaryColumnTitle")) primaryColumnTitle(); ?></span>
			<span class='caption'><?php if (function_exists("primaryColumnCaption")) primaryColumnCaption(); ?></span> <span class='more'><a href='<?php bloginfo('url'); ?>?cat=<?php echo getPrimaryColumnCategories(); ?>'>View Archives&hellip;</a></span> 
			
		</div>
		<div class='contents span-12 last'>	
			<?php 				
			$query = array (
			    'posts_per_page' => max(0, getPrimaryColumnPostCount()),
			    'cat' => getPrimaryColumnCategories()
			);
			$queryObject = new WP_Query($query);
			 while ( $queryObject->have_posts() ) : $queryObject->the_post(); ?>
				<article <?php post_class('post-'.($queryObject->current_post+1)); ?>>
					<?php if(showPrimaryColumnHeader()) : ?>
					<header>
						<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
					</header>
					<?php endif; ?>
					<section>
						<p><?php echo get_the_excerpt(); ?> <span class='more'><a href="<?php the_permalink(); ?>">Read On&hellip;</a></span></p>
					</section>
					<?php if(showPrimaryColumnFooter()) : ?>
					<footer>
						<ul class='metadata clear'>
							<li class='author'>By <?php the_author_link(); ?></li>	
							<li class='time'><time datetime="<?php the_time('Y-m-d'); ?>" pubdate>Posted <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></time></li>
							<li>Filed Under <?php the_category(', '); ?></li>											
							<li class='comments'><?php comments_popup_link('No comments', '1 comment', '% comments'); ?></li>
							<li class='tweet'>Retweet This Post</li>
							<?php if(!showPrimaryColumnHeader()) : ?><li class='permalink last'><a href='<?php the_permalink(); ?>'>Link</a></li><?php endif; ?>
						</ul>
					</footer>
					<?php endif; ?>
				</article>
				
			<?php endwhile; ?>
			
		</div>
	</div>
	
	
	<div class='span-12 last clear content halfandhalf'>
		<div class='nav content-header'>
			<span class='label'><?php if (function_exists("secondaryColumnTitle")) secondaryColumnTitle(); ?></span>
			<span class='caption'><?php if (function_exists("secondaryColumnCaption")) secondaryColumnCaption(); ?></span> <span class='more'><a href='<?php bloginfo('url'); ?>?cat=<?php echo getSecondaryColumnCategories(); ?>'>View Archives&hellip;</a></span>
		</div>
		<div class='contents span-9'>	
		<?php 		
		$query = array (
		    'posts_per_page' => max(0, 5),
		    'cat' => getSecondaryColumnCategories()
		);
		$queryObject = new WP_Query($query);
		 while ( $queryObject->have_posts() ) : $queryObject->the_post(); ?>
			
			<article <?php post_class('span-9 post-'.($queryObject->current_post+1)); ?>>
				<?php if(showSecondaryColumnHeader()) : ?>
				<header>
					<h1><a href="<?php the_permalink() ?>"><?php truncate_title(get_the_title(), 60); ?></a></h1>
				</header>
				<?php endif; ?>
				<div class='clear'>
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
					<?php  $content = content(80, 'Read On&hellip;', 555, 200, 70); ?>
					<?php //the_content(); ?>
				</section>
				</div>
				<?php if(showSecondaryColumnFooter()) : ?>
				<footer class='prefix-2'>
					<ul class='metadata clear'>								
						<li class='comments'><?php comments_popup_link('No comments', '1 comment', '% comments'); ?></li>	
						<li class='tweet'>Retweet This Post</li>
						<?php if(!showSecondaryColumnHeader()) : ?><li class='permalink last'><a href='<?php the_permalink(); ?>'>Link</a></li><?php endif; ?>
					</ul>
				</footer>
				<?php endif; ?>
			</article>
		<?php endwhile; ?>

		</div>
		<div class='widgets span-3 last'>
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Half and Half Aside") ) : ?>
				<p><?php bloginfo('description'); ?></p>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>