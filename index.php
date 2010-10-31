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
			<span class='caption'><?php if (function_exists("primaryColumnCaption")) primaryColumnCaption(); ?></span> <span class='more'><a href='<?php bloginfo('url'); ?>?cat=<?php echo getPrimaryColumnCategories(); ?>'>See more...</a></span> 
			
		</div>
		<div class='contents span-12 last'>	
			<?php 				
			add_filter('excerpt_length', 'primary_excerpt_length');
			$pri_posts_count=getPrimaryColumnPostCount();
			
			$posts = query_posts(array( 'cat' => getPrimaryColumnCategories(),  'showposts' => max(0, $pri_posts_count) ));
			if(count($posts)>0) : foreach ($posts as $post) : start_wp(); 
			?>			
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
							<li class='time iconic clock'><time datetime="<?php the_time('Y-m-d'); ?>" pubdate><?php the_time('Y-j-n'); ?></time></li>											
							<li class='comments iconic comment last'><?php comments_popup_link('No comments', '1 comment', '% comments'); ?></li>
						</ul>
					</footer>
					<?php endif; ?>
				</article>
			<?php endforeach; else : ?>
				<div class="post no-posts">
					<header>
						<h1>No Posts Yet</h1>
					</header>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<div id="content_secondary" class='span-14 last clear'>
		<div class='nav content-header span-2'>
			<span class='label'><?php if (function_exists("secondaryColumnTitle")) secondaryColumnTitle(); ?></span>
			<span class='caption'><?php if (function_exists("secondaryColumnCaption")) secondaryColumnCaption(); ?></span> <span class='more'><a href='<?php bloginfo('url'); ?>?cat=<?php echo getSecondaryColumnCategories(); ?>'>See more...</a></span>
		</div>
		<div class='contents span-12 last'>	
		<?php 
		add_filter('excerpt_length', 'secondary_excerpt_length');
		add_filter('excerpt_more', 'excerpt_read_more');
		$sec_posts_count=getSecondaryColumnPostCount();
		
		$posts = get_posts('caller_get_posts=1&category='.getSecondaryColumnCategories().'&numberposts='.$sec_posts_count.'&offset=0'); 
		if(count($posts)>0) : foreach ($posts as $post) : start_wp(); 
		?>
			<article <?php post_class('span-3'); ?>>
				<?php if(showSecondaryColumnHeader()) : ?>
				<header>
					<h1><a href="<?php the_permalink() ?>">
					<?php
					$thetitle = $post->post_title; /* or you can use get_the_title() */
					$getlength = strlen($thetitle);
					$thelength = 25;
					echo substr($thetitle, 0, $thelength);
					
					if ($getlength > $thelength) echo "...";
					?>
					</a></h1>
				</header>
				<?php endif; ?>
				<section>
					<?php 
						$content = content(80, 'Read More&hellip;');
						$content = apply_filters('the_content', $content);
						
						$pattern = '/\< *[img][^\>]* src *= *[\"\']{0,1}([^\"\'\ >]*)/i';
						$replacement = '<img src="/php/phpthumb/phpThumb.php?src=' . '$1' . '&w=190&h=120&zc=1&q=80"';
						
						$pagecontent = preg_replace($pattern, $replacement, $content);
						
						$pattern = '/height *= *[\"\']?[^\"\'\ >]*/';
						$replacement = 'height="120"';
						$pagecontent = preg_replace($pattern, $replacement, $pagecontent);
						
						$pattern = '/width *= *[\"\']?[^\"\'\ >]*/';
						$replacement = 'width="190"';
						$pagecontent = preg_replace($pattern, $replacement, $pagecontent);
						
						echo $pagecontent;					
					?>
				</section>
				<?php if(showSecondaryColumnFooter()) : ?>
				<footer>
					<ul class='metadata clear'>
						<li class='time iconic clock'><time datetime="<?php the_time('Y-m-d'); ?>" pubdate><?php the_time('Y-j-n'); ?></time></li>											
						<li class='comments last'><span class='iconic comment'></span> <?php comments_popup_link('No comments', '1 comment', '% comments'); ?></li>
					</ul>
				</footer>
				<?php endif; ?>
			</article>
		<?php endforeach; else : ?>
			<div class="post no-posts">
				<header>
					<h1>No Posts Yet</h1>
				</header>
			</div>
		<?php endif; ?>
		</div>
	</div>
	<div id="content_tertiary" class='span-14 clear last'>
		<div class="content-header nav span-2">
			<span class='label'><?php if (function_exists("tertiaryColumnTitle")) tertiaryColumnTitle(); ?></span>
			<span class='caption'><?php if (function_exists("tertiaryColumnCaption")) tertiaryColumnCaption(); ?></span> <span class='more'><a href='<?php bloginfo('url'); ?>?cat=<?php echo getTertiaryColumnCategories(); ?>'>See more...</a></span>
		</div>
		<div class='contents span-12 last'>	
		<?php 
		
		$ter_posts_count=getTertiaryColumnPostCount();
		$posts = get_posts('caller_get_posts=1&category='.getTertiaryColumnCategories().'&numberposts='.$ter_posts_count.'&offset=0'); 
				
		if(count($posts)>0) : foreach ($posts as $post) : start_wp(); 
		?>
			<article <?php post_class('span-3'); ?>>
				<?php if(showTertiaryColumnHeader()) : ?>
				<header>
					<h1><a href="<?php the_permalink() ?>">
					<?php
					$thetitle = $post->post_title; /* or you can use get_the_title() */
					$getlength = strlen($thetitle);
					$thelength = 25;
					echo substr($thetitle, 0, $thelength);
					if ($getlength > $thelength) echo "...";
					?>
					</a></h1>
				</header>
				<?php endif; ?>
				<section>
					<?php
						$content = content(80, 'Read More&hellip;');
						$content = apply_filters('the_content', $content);
					
						$pattern = '/\< *[img][^\>]* src *= *[\"\']{0,1}([^\"\'\ >]*)/i';
						$replacement = '<img src="/php/phpthumb/phpThumb.php?src=' . '$1' . '&w=190&h=120&zc=1&q=80"';
					
						$pagecontent = preg_replace($pattern, $replacement, $content);
					
						$pattern = '/height *= *[\"\']?[^\"\'\ >]*/';
						$replacement = 'height="120"';
						$pagecontent = preg_replace($pattern, $replacement, $pagecontent);
					
						$pattern = '/width *= *[\"\']?[^\"\'\ >]*/';
						$replacement = 'width="190"';
						$pagecontent = preg_replace($pattern, $replacement, $pagecontent);
					
						echo $pagecontent;
					?>
				</section>
				<?php if(showTertiaryColumnFooter()) : ?>
				<footer>
					<ul class='metadata clear'>
						<li class='time iconic clock'><time datetime="<?php the_time('Y-m-d'); ?>" pubdate><?php the_time('Y-j-n'); ?></time></li>											
						<li class='comments iconic comment last'><?php comments_popup_link('No comments', '1 comment', '% comments'); ?></li>
					</ul>
				</footer>
				<?php endif; ?>
			</article>
		<?php endforeach; else : ?>
			<div class="post no-posts">
				<header>
					<h1>No Posts Yet</h1>
				</header>
			</div>
		<?php endif; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>