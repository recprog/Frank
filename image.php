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
			if ( $post->post_parent ) {
				echo '<p class="attachment-nav">';
					previous_image_link( false, __( '&larr; Previous', 'frank' ) );
					next_image_link( false, __( 'Next &rarr;', 'frank' ) );
				echo '</p>'; 
			}
		?>

		<div class="entry-content">
		<?php 
			printf( 
				'<p class="attachment-wrap">%s</p>', 
				wp_get_attachment_image( $post->ID, 'large' ) 
			);
		?>
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
