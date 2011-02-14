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
							<li class='time'><span class='iconic calendar'></span> <time datetime="<?php the_time('Y-m-d'); ?>" pubdate><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></time></li>											
							<li class='comments'><span class='iconic comment'></span> <?php comments_popup_link('No comments', '1 comment', '% comments'); ?></li>
							<?php if(!showPrimaryColumnHeader()) : ?><li class='permalink last'><span class='iconic link'></span> <a href='<?php the_permalink(); ?>'>Link</a></li><?php endif; ?>
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
					<dl>
						<dt>Posted</dt>
						<dd><time datetime="<?php the_time('Y-m-d'); ?>" pubdate><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></time></dd>
						<dt>Filed Under</dt>
						<dd><?php the_category('</dd><dd>'); ?></dd>
						<dt>Tagged</dt>
						<dd><?php the_tags('','<dd>','</dd>'); ?></dd>
					</dl>
				</div>
				<section class='span-7 last'>
					<?php  $content = content(80, 'Read On&hellip;', 555, 200); ?>
				</section>
				</div>
				<?php if(showSecondaryColumnFooter()) : ?>
				<footer class='prefix-2'>
					<ul class='metadata clear'>										
						<li class='comments'><span class='iconic comment'></span> <?php comments_popup_link('0', '1', '%'); ?></li>
						<?php if(!showSecondaryColumnHeader()) : ?><li class='permalink last'><span class='iconic link'></span> <a href='<?php the_permalink(); ?>'>Link</a></li><?php endif; ?>
					</ul>
				</footer>
				<?php endif; ?>
			</article>
		<?php endwhile; ?>

		</div>
		<div class='widgets span-3 last'>
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sub Header") ) : ?>
				<p><?php bloginfo('description'); ?></p>
			<?php endif; ?>
		</div>
	</div>
	
	
	<div class='span-12 last clear content twoup'>
		<div class='nav content-header span-2'>
			<span class='label'><?php if (function_exists("secondaryColumnTitle")) secondaryColumnTitle(); ?></span>
			<span class='caption'><?php if (function_exists("secondaryColumnCaption")) secondaryColumnCaption(); ?></span> <span class='more'><a href='<?php bloginfo('url'); ?>?cat=<?php echo getSecondaryColumnCategories(); ?>'>See more&hellip;</a></span>
		</div>
		<div class='contents span-12 last'>	
		<?php 		
		$query = array (
		    'posts_per_page' => max(0, 2),
		    'cat' => getSecondaryColumnCategories()
		);
		$queryObject = new WP_Query($query);
		 while ( $queryObject->have_posts() ) : $queryObject->the_post(); ?>
			<article <?php post_class('span-6 post-'.($queryObject->current_post+1)); ?>>
				<?php if(showSecondaryColumnHeader()) : ?>
				<header>
					<h1><a href="<?php the_permalink() ?>"><?php truncate_title(get_the_title(), 25); ?></a></h1>
				</header>
				<?php endif; ?>
				<section>
					<?php  $content = content(80); ?>
				</section>
				<?php if(showSecondaryColumnFooter()) : ?>
				<footer>
					<ul class='metadata clear'>
						<li class='time'><span class='iconic calendar'></span> <time datetime="<?php the_time('Y-m-d'); ?>" pubdate><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></time></li>											
						<li class='comments'><span class='iconic comment'></span> <?php comments_popup_link('0', '1', '%'); ?></li>
						<?php if(!showSecondaryColumnHeader()) : ?><li class='permalink last'><span class='iconic link'></span> <a href='<?php the_permalink(); ?>'>Link</a></li><?php endif; ?>
					</ul>
				</footer>
				<?php endif; ?>
			</article>
		<?php endwhile; ?>

		</div>
	</div>
	
	<div class='span-12 last clear content fourup'>
		<div class='nav content-header span-2'>
			<span class='label'><?php if (function_exists("secondaryColumnTitle")) secondaryColumnTitle(); ?></span>
			<span class='caption'><?php if (function_exists("secondaryColumnCaption")) secondaryColumnCaption(); ?></span> <span class='more'><a href='<?php bloginfo('url'); ?>?cat=<?php echo getSecondaryColumnCategories(); ?>'>See more&hellip;</a></span>
		</div>
		<div class='contents span-12 last'>	
		<?php 		
		$query = array (
		    'posts_per_page' => max(0, getSecondaryColumnPostCount()),
		    'cat' => getSecondaryColumnCategories()
		);
		$queryObject = new WP_Query($query);
		 while ( $queryObject->have_posts() ) : $queryObject->the_post(); ?>
			<article <?php post_class('span-3 post-'.($queryObject->current_post+1)); ?>>
				<?php if(showSecondaryColumnHeader()) : ?>
				<header>
					<h1><a href="<?php the_permalink() ?>"><?php truncate_title(get_the_title(), 25); ?></a></h1>
				</header>
				<?php endif; ?>
				<section>
					<?php  $content = content(80); ?>
				</section>
				<?php if(showSecondaryColumnFooter()) : ?>
				<footer>
					<ul class='metadata clear'>
						<li class='time'><span class='iconic calendar'></span> <time datetime="<?php the_time('Y-m-d'); ?>" pubdate><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></time></li>											
						<li class='comments'><span class='iconic comment'></span> <?php comments_popup_link('0', '1', '%'); ?></li>
						<?php if(!showSecondaryColumnHeader()) : ?><li class='permalink last'><span class='iconic link'></span> <a href='<?php the_permalink(); ?>'>Link</a></li><?php endif; ?>
					</ul>
				</footer>
				<?php endif; ?>
			</article>
		<?php endwhile; ?>

		</div>
	</div>
	<div class='span-12 clear last content fourup'>
		<div class="content-header nav span-2">
			<span class='label'><?php if (function_exists("tertiaryColumnTitle")) tertiaryColumnTitle(); ?></span>
			<span class='caption'><?php if (function_exists("tertiaryColumnCaption")) tertiaryColumnCaption(); ?></span> <span class='more'><a href='<?php bloginfo('url'); ?>?cat=<?php echo getTertiaryColumnCategories(); ?>'>See more&hellip;</a></span>
		</div>
		<div class='contents span-12 last'>	
		
		<?php 		
		$query = array (
		    'posts_per_page' => max(0, getTertiaryColumnPostCount()),
		    'cat' => getTertiaryColumnCategories()
		);
		$queryObject = new WP_Query($query);
		 while ( $queryObject->have_posts() ) : $queryObject->the_post(); ?>
		
			<article <?php post_class('span-3 post-'.($queryObject->current_post+1)); ?>>
				<?php if(showTertiaryColumnHeader()) : ?>
				<header>
					<h1><a href="<?php the_permalink() ?>"><?php truncate_title(get_the_title(), 25); ?></a></h1>
				</header>
				<?php endif; ?>
				<section><?php $content = content(80, "Read More", 190, 120, 80, true); ?></section>
				<?php if(showTertiaryColumnFooter()) : ?>
				<footer>
					<ul class='metadata clear'>
						<li class='time'><span class='iconic calendar'></span> <time datetime="<?php the_time('Y-m-d'); ?>" pubdate><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></time></li>											
						<li class='comments'><span class='iconic comment'></span> <?php comments_popup_link('0', '1', '%'); ?></li>
						<?php if(!showTertiaryColumnHeader()) : ?><li class='permalink last'><span class='iconic link'></span> <a href='<?php the_permalink(); ?>'>Link</a></li><?php endif; ?>
					</ul>
				</footer>
				<?php endif; ?>
			</article>
		<?php endwhile; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>