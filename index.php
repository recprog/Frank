<?php
/**
 * @package WordPress
 * @subpackage Franklin_Street
 */
?>
<?php get_header(); ?>
<div id="content" class="home clear">
	<div id="content_primary" class='span-14 last clear'>
		<div class='nav span-2'>
			<hgroup class='content_header'>
				<h2><?php if (function_exists("primaryColumnTitle")) primaryColumnTitle(); ?></h2>
				<h3><?php if (function_exists("primaryColumnCaption")) primaryColumnCaption(); ?> (<a href='/category/articles/'>more...</a>)</h3> 
			</hgroup>
		</div>
		<div class='contents span-12 last'>	
			<?php 				
			add_filter('excerpt_length', 'primary_excerpt_length');
			$pri_posts_count=getPrimaryColumnPostCount();
			query_posts(array( 'cat' => getPrimaryColumnCategories(),  'showposts' => max(0, $pri_posts_count) ));
			if(have_posts()) : while(have_posts()) : the_post();
			?>			
				<article <?php post_class(); ?>>
					<header>
						<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
						<ul class='metadata clear'>
							<li class='time'><time datetime="<?php the_time('Y-m-d'); ?>" pubdate><?php the_time('Y-j-n g:ia'); ?></time></li>											
							<li class='comments last'><?php comments_popup_link('No comments', '1 comment', '% comments'); ?></li>
						</ul>
					</header>
					<section>
						<?php the_excerpt(); ?>
					</section>
				</article>
			<?php endwhile; else : ?>
				<div class="post no-posts">
					<header>
						<h1>No Posts Yet</h1>
					</header>
				</div>
			<?php endif; ?>
			<?php wp_reset_query(); ?>
		</div>
	</div>
	<div id="content_secondary" class='span-14 last clear'>
		<div class='nav span-2'>
			<hgroup class='content_header'>
				<h2><?php if (function_exists("secondaryColumnTitle")) secondaryColumnTitle(); ?></h2>
				<h3><?php if (function_exists("secondaryColumnCaption")) secondaryColumnCaption(); ?> (<a href='/category/stream/'>more...</a>)</h3>
			</hgroup>
		</div>
		<div class='contents span-12 last'>	
		<?php 
		add_filter('excerpt_length', 'secondary_excerpt_length');
		add_filter('excerpt_more', 'excerpt_read_more');
		query_posts('caller_get_posts=1&cat='.getSecondaryColumnCategories().'&showposts='.getSecondaryColumnPostCount());
		
		$sec_posts_count=getSecondaryColumnPostCount();
		
		$posts = get_posts('caller_get_posts=1&category='.getSecondaryColumnCategories().'&numberposts='.$sec_posts_count.'&offset=0'); 
		if(count($posts)>0) : foreach ($posts as $post) : start_wp(); 
		?>
			<article <?php post_class('span-3'); ?>>
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
					<ul class='metadata clear'>
						<li class='time'><time datetime="<?php the_time('Y-m-d'); ?>" pubdate><?php the_time('Y-j-n g:ia'); ?></time></li>											
						<li class='comments last'><?php comments_popup_link('No comments', '1 comment', '% comments'); ?></li>
					</ul>
				</header>
				<section>
					<?php echo content(20); ?>
				</section>
			</article>
		<?php endforeach; else : ?>
			<div class="post no-posts">
				<header>
					<h1>No Posts Yet</h1>
				</header>
			</div>
		<?php endif; ?>
		<?php wp_reset_query(); ?>
		</div>
	</div>
	<div id="content_tertiary" class='span-14 clear last'>
		<div class="nav span-2">
			<hgroup class='content_header'>
				<h2><?php if (function_exists("tertiaryColumnTitle")) tertiaryColumnTitle(); ?></h2>
				<h3><?php if (function_exists("tertiaryColumnCaption")) tertiaryColumnCaption(); ?> (<a href='/category/snippets/'>more...</a>)</h3>
			</hgroup>
		</div>
		<div class='contents span-12 last'>	
		<?php 
		
		query_posts('caller_get_posts=1&cat='.getTertiaryColumnCategories().'&showposts='.getTertiaryColumnPostCount());
		
		$ter_posts_count=getTertiaryColumnPostCount();
		
		$posts = get_posts('caller_get_posts=1&category='.getTertiaryColumnCategories().'&numberposts='.$ter_posts_count.'&offset=0'); 
		if(count($posts)>0) : foreach ($posts as $post) : start_wp(); 
		?>
			<article <?php post_class('span-3'); ?>>
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
					<ul class='metadata clear'>
						<li class='time'><time datetime="<?php the_time('Y-m-d'); ?>" pubdate><?php the_time('Y-j-n g:ia'); ?></time></li>											
						<li class='comments'><?php comments_popup_link('No comments', '1 comment', '% comments'); ?></li>
					</ul>
				</header>
				<section>
					<?php echo content(20); ?>
				</section>
			</article>
		<?php endforeach; else : ?>
			<div class="post no-posts">
				<header>
					<h1>No Posts Yet</h1>
				</header>
			</div>
		<?php endif; ?>
		<?php wp_reset_query(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>