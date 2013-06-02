<?php
/**
 * @package Frank
 */
?>
<?php get_header(); ?>
<div id="content" class="attachement">
	<div class="row">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<article class="post clear" id="p<?php the_ID(); ?>">
			<header class="post-header">
				<h1 class="post-title"><?php the_title(); ?></h1>
			</header>
			<section class="post-content clearfix">
				<?php echo wp_get_attachment_image( $post->ID, 'full' ); ?>
			</section>
		</article>
		<?php endwhile; endif; ?>
	</div>
</div>
<?php get_footer(); ?>