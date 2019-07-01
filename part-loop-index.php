
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>" role="article">
	
	<?php do_action( 'post_header' ); ?>

	<h1 class="entry-title" role="heading">
		<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
		<?php 
			if ( get_the_title() ) {
				the_title(); 
			} else { 
				printf( 
					__( 'On %1$s at %2$s', 'frank' ),
					get_the_time( get_option( 'date_format' ) ),
					get_the_time( get_option( 'time_format' ) )
				);
			}
		?>
		</a>
	</h1>

	<?php do_action( 'post_title_after' ); ?>

	<div class="post-meta post-meta-footer">
		<?php get_template_part( 'part-post-meta' ); ?>
	</div>

	<?php if ( get_the_excerpt() && get_theme_mod( 'list_index_excerpts', false ) ) : ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>
	<?php endif; ?>

	<?php do_action( 'post_footer' ); ?>

</article>