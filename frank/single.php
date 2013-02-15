<?php
/**
 * @package Frank
 */
?>
<?php get_header(); ?>
<div id='content' class='single'>
	<div class="row">
	<main id="content-primary" role="main">
		<?php while(have_posts()) : the_post(); ?>
		<article itemscope itemtype="http://schema.org/BlogPosting" class="post leftaside">
			<header class="post-header">
				<h1 class="post-title"><?php the_title(); ?></h1>
			</header>
			<?php if($post->post_excerpt) : ?>
				<div id='excerpt'><?php the_excerpt(); ?></div>
			<?php endif; ?>
			<div id='content-main' class='row'>
				<section class='post-content clearfix'>
					<?php the_post_thumbnail( 'default-thumbnail' ); ?>
					<?php the_content(); ?>
					<?php wp_link_pages('before=<div class="pagination small"><span class="title">Pages:</span>&after=</div>'); ?>
				</section>
				<div class='post-info'>
					<?php get_template_part('partials/post-metadata'); ?>
					<?php if(frank_tweet_post_button()) : ?>
					<a id="post-tweet" class="button alt small" href="https://twitter.com/share?text=<?php echo rawurlencode(strip_tags(get_the_title())); ?><?php if(frank_tweet_post_attribution()) : ?>&amp;via=<?php echo frank_tweet_post_attribution(); ?>&amp;related=<?php echo frank_tweet_post_attribution(); ?><?php endif; ?>&amp;url=<?php the_permalink(); ?>&amp;counturl=<?php the_permalink(); ?>" target="_blank">
					<?php _e('Tweet this Post', 'frank_theme'); ?>
					</a>
					<?php endif; ?>
					<div id="previous-post" class="clearfix">
						<?php previous_post_link('%link', '<nav><span class="arrow">%title</span></nav><p>%title</p>'); ?>
					</div>
					<?php if ( !dynamic_sidebar('Post Left Aside') ) : ?>
					<?php endif; ?>
				</div>
			</div>
			<?php if (is_active_sidebar("widget-postfooter")) : ?>
			<footer id="post-footer" class='row'>				
				<?php if ( !dynamic_sidebar('Post Footer') ) : ?>
				<?php endif; ?>
			</footer>
			<?php endif; ?>	
		</article>
		<?php endwhile; ?>
		<?php comments_template(); ?>
	</main>
	<?php get_template_part('partials/sidebars/sidebar', 'single'); ?>
	</div>
</div>
<?php get_footer(); ?>