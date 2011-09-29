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
				
					switch($display_type) {
						case 'franklin_street_loop':
							include 'templates/franklin_street_loop.php';
							break;
						case 'one_up_reg':
							$queryObject = new WP_Query(array('posts_per_page' => $num_posts, 'cat' => implode(",",array_filter($categories))));
							include 'templates/one_up_reg.php';
							break;
						case 'one_up_lg':
							$queryObject = new WP_Query(array('posts_per_page' => $num_posts, 'cat' => implode(",",array_filter($categories))));
							include 'templates/one_up_lg.php';
							break;
						case 'two_up':
							$queryObject = new WP_Query(array('posts_per_page' => $num_posts, 'cat' => implode(",",array_filter($categories))));
							include 'templates/two_up.php';
							break;
						case 'four_up':
							$queryObject = new WP_Query(array('posts_per_page' => $num_posts, 'cat' => implode(",",array_filter($categories))));
							include 'templates/four_up.php';
							break;
						case 'right_aside':
							$queryObject = new WP_Query(array('posts_per_page' => $num_posts, 'cat' => implode(",",array_filter($categories))));
							include 'templates/right_aside.php';
							break;
						default :
							include 'templates/default_loop.php';
					}
					
				}
			} else {
				//Insert default loop
				include 'templates/default_loop.php';
			}
			?>
</div>
<?php get_footer(); ?>