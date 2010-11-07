<?php
/**
 * @package WordPress
 * @subpackage Franklin_Street
 */
?>
<?php get_header(); ?>
<div id="content" class="home clear">
	<div id="content_primary" class='span-14 last clear'>
		<div class='nav content-header span-2'>
			<span class='label'><?php if (function_exists("primaryColumnTitle")) primaryColumnTitle(); ?></span>
			<span class='caption'><?php if (function_exists("primaryColumnCaption")) primaryColumnCaption(); ?></span> <span class='more'><a href='<?php bloginfo('url'); ?>?cat=<?php echo getPrimaryColumnCategories(); ?>'>See more&hellip;</a></span> 
			
		</div>
		<div class='contents span-12 last'>	
			<?php 				
			$query = array (
			    'posts_per_page' => max(0, getPrimaryColumnPostCount()),
			    'cat' => getPrimaryColumnCategories()
			);
			$queryObject = new WP_Query($query);
			 while ( $queryObject->have_posts() ) : $queryObject->the_post(); ?>
				<article <?php post_class(); ?>>
					<?php if(showPrimaryColumnHeader()) : ?>
					<header>
						<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
					</header>
					<?php endif; ?>
					<section>
						<?php the_excerpt(); ?>
					</section>
					<?php if(showPrimaryColumnFooter()) : ?>
					<footer>
						<ul class='metadata clear'>
							<li class='time iconic clock'><time datetime="<?php the_time('Y-m-d'); ?>" pubdate><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></time></li>											
							<li class='comments'><span class='iconic comment'></span> <?php comments_popup_link('No comments', '1 comment', '% comments'); ?></li>
							<?php if(!showPrimaryColumnHeader()) : ?><li class='permalink last'><span class='iconic link'></span> <a href='<?php the_permalink(); ?>'>Link</a></li><?php endif; ?>
						</ul>
					</footer>
					<?php endif; ?>
				</article>
				
			<?php endwhile; ?>
			
		</div>
	</div>
	<div id="content_secondary" class='span-14 last clear'>
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
			<article <?php post_class('span-3'); ?>>
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
						<li class='time iconic clock'><time datetime="<?php the_time('Y-m-d'); ?>" pubdate><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></time></li>											
						<li class='comments'><span class='iconic comment'></span> <?php comments_popup_link('0', '1', '%'); ?></li>
						<?php if(!showSecondaryColumnHeader()) : ?><li class='permalink last'><span class='iconic link'></span> <a href='<?php the_permalink(); ?>'>Link</a></li><?php endif; ?>
					</ul>
				</footer>
				<?php endif; ?>
			</article>
		<?php endwhile; ?>

		</div>
	</div>
	<div id="content_tertiary" class='span-14 clear last'>
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
		
			<article <?php post_class('span-3'); ?>>
				<?php if(showTertiaryColumnHeader()) : ?>
				<header>
					<h1><a href="<?php the_permalink() ?>"><?php truncate_title(get_the_title(), 25); ?></a></h1>
				</header>
				<?php endif; ?>
				<section><?php $content = content(80); ?></section>
				<?php if(showTertiaryColumnFooter()) : ?>
				<footer>
					<ul class='metadata clear'>
						<li class='time iconic clock'><time datetime="<?php the_time('Y-m-d'); ?>" pubdate><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></time></li>											
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