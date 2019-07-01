<?php 

get_header(); 

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<?php do_action( 'post_before' ); ?>

	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>" role="article">

		<?php do_action( 'post_header' ); ?>

		<?php if ( get_the_title() ) : ?>
		<h1 class="entry-title" role="heading">
			<?php the_title(); ?>
		</h1>
		<?php endif; ?>

		<?php do_action( 'post_title_after' ); ?>

		<div class="post-meta post-meta-header">
			<?php get_template_part( 'part-post-meta' ); ?>
		</div>

		<?php
			// Featured image
			if ( has_post_thumbnail() && get_theme_mod( 'frank_featured_image_header_single', true ) ) {
				printf( 
					'<div class="post-featured-header">
						%s
					</div>',
					get_the_post_thumbnail( null, 'featured-header' ) 
				);
			}
		?>

		<div class="entry-content">
			<?php get_template_part( 'content', get_post_format() );  ?>
		</div>
		
		<?php
			if ( is_single() && get_adjacent_post( false, '', false ) ) {
				echo '<p class="post-nav">';
					previous_post_link( '<span class="prev">%link</span>', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'frank' ) );
					next_post_link( '<span class="next">%link</span>', _x( '%title <span class="meta-nav">&rarr;</span>', 'Previous post link', 'frank' ) );
				echo '</p>';
			}
		?>

		<?php do_action( 'post_footer' ); ?>
	
	</article>

	<?php do_action( 'post_after' ); ?>

	<?php comments_template( false, true ); ?>

	<?php do_action( 'comments_after' ); ?>

<?php endwhile; endif;

get_footer();
