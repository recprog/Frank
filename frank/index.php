<?php
/**
 * @package Frank
 */
?>
<?php get_header(); ?>
<div id="content" class="home">
	<?php
	$frank_sections = get_option( '_frank_options' );
	$frank_sections = $frank_sections['sections'];
	if($frank_sections) {
		foreach($frank_sections as $section) {
			$display_type=$section['display_type'];
			$title=$section['title'];
			$caption=$section['caption'];
			$num_posts=$section['num_posts'];
			$categories=$section['categories'];
			/* TODO: Clean this up */
			switch($display_type) {
				case 'srd_loop':
					get_template_part('partials/loops/loop', 'srd');
					break;
				case 'one_up_reg':
					$queryObject = new WP_Query(array('posts_per_page' => $num_posts, 'cat' => implode(",",array_filter($categories))));
					get_template_part('partials/loops/loop', 'oneup');
					break;
				case 'one_up_lg':
					$queryObject = new WP_Query(array('posts_per_page' => $num_posts, 'cat' => implode(",",array_filter($categories))));
					get_template_part('partials/loops/loop', 'oneuplarge');
					break;
				case 'two_up':
					$queryObject = new WP_Query(array('posts_per_page' => $num_posts, 'cat' => implode(",",array_filter($categories))));
					get_template_part('partials/loops/loop', 'twoup');
					break;
				case 'three_up':
					$queryObject = new WP_Query(array('posts_per_page' => $num_posts, 'cat' => implode(",",array_filter($categories))));
					get_template_part('partials/loops/loop', 'threeup');
					break;
				case 'four_up':
					$queryObject = new WP_Query(array('posts_per_page' => $num_posts, 'cat' => implode(",",array_filter($categories))));
					get_template_part('partials/loops/loop', 'fourup');
					break;
				default :
					get_template_part('partials/loops/loop');
			}		
		}
	} else {
		//Insert default loop
		get_template_part('partials/loops/loop');
	}
	?>
	<? get_template_part('partials/post-pagination'); ?>
</div>
<?php get_footer(); ?>