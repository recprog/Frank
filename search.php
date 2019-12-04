<?php 

get_header();

?>

<?php do_action( 'post_before' ); ?>

<article <?php post_class(); ?>>
	
	<?php do_action( 'post_header' ); ?>

	<h1 class="entry-title" role="heading">
		<?php _e( 'Search Results', 'frank' ) ?>		
	</h1>

	<?php do_action( 'post_title_after' ); ?>

	<div class="entry-content">
	<?php 
		get_search_form();

		if ( have_posts() ) : 
			$results = array();

			while ( have_posts() ) : 
				the_post(); 
				$results[] = sprintf( '<li><h1><a href="%s">%s</a></h1></li>', get_permalink(), esc_html( get_the_title() ) );
			endwhile;

			printf( '<ul class="search-results">%s</ul>', implode( '', $results ) );
		else:
			printf( '<p>%s</p>', __( 'Sorry, but nothing matched your search criteria.', 'frank' ) );
		endif;

		do_action( 'post_pagination_links', 'footer' );
	?>
	</div>

	<?php do_action( 'post_footer' ); ?>

</article>

<?php do_action( 'post_after' ); ?>

<?php 

get_footer();
