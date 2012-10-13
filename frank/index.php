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
	global $frank_section_type, $frank_section_header, $frank_section_title, $frank_section_caption, $frank_section_num_posts, $frank_section_categories;
	global $foo;
	$foo = "FOO!";
	if($frank_sections) {
		foreach($frank_sections as $section) {
			$frank_section_type=$section['display_type'];
			$frank_section_header=$section['header'];
			$frank_section_title=$section['title'];
			$frank_section_caption=$section['caption'];
			$frank_section_num_posts=$section['num_posts'];
			$frank_section_categories=$section['categories'];



			/* TODO: Clean this up */
			switch($frank_section_type) {
				case 'srd_loop':
					get_template_part('partials/loops/loop', 'srd');
					break;
				case 'one_up_reg':
					$wp_query = new WP_Query(array('posts_per_page' => $frank_section_num_posts, 'cat' => implode(",",array_filter($frank_section_categories))));
					get_template_part('partials/loops/loop', 'oneup');
					break;
				case 'one_up_lg':
					$wp_query = new WP_Query(array('posts_per_page' => $frank_section_num_posts, 'cat' => implode(",",array_filter($frank_section_categories))));
					get_template_part('partials/loops/loop', 'oneuplarge');
					break;
				case 'two_up':
					$wp_query = new WP_Query(array('posts_per_page' => $frank_section_num_posts, 'cat' => implode(",",array_filter($frank_section_categories))));
					get_template_part('partials/loops/loop', 'twoup');
					break;
				case 'three_up':
					$wp_query = new WP_Query(array('posts_per_page' => $frank_section_num_posts, 'cat' => implode(",",array_filter($frank_section_categories))));
					get_template_part('partials/loops/loop', 'threeup');
					break;
				case 'four_up':
					$wp_query = new WP_Query(array('posts_per_page' => $frank_section_num_posts, 'cat' => implode(",",array_filter($frank_section_categories))));
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
	<?php get_template_part('partials/post-pagination'); ?>
</div>
<?php get_footer(); ?>