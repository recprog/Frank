<?php 

get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<?php do_action( 'post_before' ); ?>

	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>" role="article">

		<?php do_action( 'post_header' ); ?>

		<div class="entry-content">
			<?php get_template_part( 'content', 'front' );  ?>
		</div>
		
		<?php do_action( 'post_footer' ); ?>
	
	</article>

	<?php do_action( 'post_after' ); ?>

	<?php comments_template( false, true ); ?>

	<?php do_action( 'comments_after' ); ?>

<?php endwhile; endif;

get_footer();
