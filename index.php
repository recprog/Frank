<?php
/**
 * @package WordPress
 * @subpackage Franklin_Street
 */
?>
<?php get_header(); ?>
<div id="content" class="home clear">
	
			<?php
			
			$franklin_street_sections = get_option( '_franklin_street_home_sections' );
			if($franklin_street_sections) {
				foreach($franklin_street_sections as $section) {
					$display_type=$section['display_type'];
					$title=$section['title'];
					$caption=$section['caption'];
					$num_posts=$section['num_posts'];
					$categories=$section['categories'];
				
					$queryObject = new WP_Query(array('posts_per_page' => $num_posts, 'cat' => implode(",",array_filter($categories))));
					
				
					switch($display_type) {
						case 'one_up_reg':
							include 'templates/one_up_reg.php';
							break;
						case 'one_up_lg':
							include 'templates/one_up_lg.php';
							break;
						case 'two_up':
							include 'templates/two_up.php';
							break;
						case 'four_up':
							include 'templates/four_up.php';
							break;
						case 'right_aside':
							include 'templates/right_aside.php';
					}
					
				}
			} else {
				//Insert default loop
			}
			?>
</div>
<?php get_footer(); ?>