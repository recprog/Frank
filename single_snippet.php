<?php get_header(); ?>
	<?php $category = get_the_category(); ?>
	<div id="content" class="span-14 snippet <?php print($category[0]->category_nicename); ?> clearfix">
		<div id="content_primary">
			
			<?php
				switch($category[0]->category_nicename)
				{
					case "twitter" :
						$linkURL="http://www.twitter.com/somerandomdude";
						break;
					case "delicious" :
						$linkURL="http://www.delicious.com/somerandomdude";
						break;
					case "google-reader" :
						$linkURL="http://www.google.com/reader/shared/05311197965605868524";
						break;
				}	
			?>
			
			<?php while(have_posts()) : the_post(); ?>
			<hgroup class="article_header clearfix">
				<h2><a href="<?php print($linkURL) ?>"><?php print($category[0]->cat_name); ?> Post: <?php the_time('F j, Y'); ?> at <?php the_time('g:ia'); ?> </a></h2>
				<h4 class='date'>Posted <?php the_time('j F, Y g:ia'); ?></h4>		
			</hgroup>
			<section class="entry <?php print($category[0]->category_nicename); ?>">
				<?php the_content(); ?>
			</section>
			
			<?php if($linkURL) : ?>
			<h4 class='follow'>Follow my <a href="<?php print($linkURL); ?>"><?php print($category[0]->cat_name); ?></a> account</h4>
			<?php endif; ?>
			<?php endwhile; ?>
		</div>
	</div>
<?php get_footer(); ?>