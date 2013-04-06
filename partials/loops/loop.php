<?php
?>
<div class='post-group default row'>
	<div class='nine columns post-group-content'>	
	<?php 		
	if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php get_template_part('partials/posts/post'); ?>
	<?php endwhile; ?>
	<?php endif; ?>
	</div>
	<?php get_template_part('partials/sidebars/sidebar', 'index'); ?>
</div>