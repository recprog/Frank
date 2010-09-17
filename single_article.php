<?php
/**
 * @package WordPress
 * @subpackage Franklin_Street
 */
?>
<?php get_header(); ?>
	<div id="content" class="span-14 last post clear">
		<div id="content_primary" class='span-11 clear'>
			<?php while(have_posts()) : the_post(); ?>
			<article <?php post_class(); ?>>
				<header>
					<hgroup>
						<h1><span class='iconic document'></span><?php the_title(); ?></h1>
						<h2><span class=' iconic clock'></span> Posted on <?php the_time('j.m.y') ?> at <?php the_time('g:i a'); ?></h2>
					</hgroup>
				</header>
				<div id='excerpt'><?php the_excerpt(); ?></div>
				<section>
					<?php the_content(); ?>
				</section>
				<footer>
					<div class='pagination'>
						<?php wp_link_pages(); ?>
					</div>
					<div id='post_footer'>
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Post Footer") ) : ?>
						<?php endif; ?>
					</div>
				</footer>
			</article>
			<?php endwhile; ?>
			<div id="comments_container" class='clearfix'>
				<hgroup>
					<h2><span class=' iconic chat'></span> The Discussion</h2>
					<h3><?php comments_number('No Comments', 'One Comment', '% Comments' );?> on &#8220;<?php the_title(); ?>&#8221;</h3>
				</hgroup>
				<?php #comments_template(); ?>
				
				
				<script type="text/javascript">
					jQuery(document).ready(function(){
					jQuery.ajaxSetup({cache:false});
					jQuery("*").click(function(){
						$("#comments_container").html("loading...");
						$("#comments_container").load("<?php bloginfo('template_directory'); ?>/comment_wrapper.php",{id:0});
						return false;
					});
				});
				</script>
				
			</div>
		</div>
	<?php get_sidebar(); ?>	
	</div>
</div>
<?php get_footer(); ?>