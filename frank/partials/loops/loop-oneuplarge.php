<?php
/*
	Template Name: One Up (Large)
*/
?>
<div class='row post-group oneup large'>
	<div class='nav post-group-header'>
		<span class='label'><?php print($title); ?></span>
		<span class='caption'><?php print($caption); ?></span> <span class='more'><?php next_posts_link('View more&hellip;'); ?></span>
	</div>
	<div class='contents'>
		<?php while ( $queryObject->have_posts() ) : $queryObject->the_post(); ?>
			<?php get_template_part('partials/posts/post', 'oneuplarge'); 	
		<?php endwhile; ?>
	</div>
</div>