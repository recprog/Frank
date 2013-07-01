<div class='row'>
<?php
if ( is_home() && !is_paged() ) {
	$sticky = get_option( 'sticky_posts' );
	$args = array(
		'posts_per_page' => 1,
		'post__in'  => $sticky,
		'orderby' => 'date',
		'order' => 'DESC',
		'ignore_sticky_posts' => 1,
	);
	$queryObject = new WP_Query( $args );
	if ( ! empty( $sticky[0] ) ) :
	?>

		<?php
		$queryObject->the_post();
		get_template_part( 'partials/posts/post', 'oneuplarge' );
		wp_reset_postdata();
		?>
	<?php
	endif;
}
?>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php if ( is_sticky( $post->ID ) ) continue; ?>
			<?php get_template_part( 'partials/posts/post' ); ?>
		<?php endwhile; endif; ?>
</div>