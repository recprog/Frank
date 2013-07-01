<?php
/**
 * @package Frank
 */
?>
<?php get_header(); ?>
<main id="content" class="home" role="main">
	<?php
		get_template_part( 'partials/loops/loop' );
		get_template_part( 'partials/post-pagination' );
	?>
</main>
<?php get_footer(); ?>