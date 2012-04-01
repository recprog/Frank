<?php
/**
 * @package WordPress
 * @subpackage Frank
 */
?>
<?php get_header(); ?>
<div id="content" class="home">
	<?php
	$frank_sections = get_option( '_frank_street_home_sections' );
	if($frank_sections) {
		foreach($frank_sections as $section) {
			$display_type=$section['display_type'];
			$title=$section['title'];
			$caption=$section['caption'];
			$num_posts=$section['num_posts'];
			$categories=$section['categories'];
			
			switch($display_type) {
				case 'srd_loop':
					include 'templates/srd_loop.php';
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
				case 'three_up':
					$queryObject = new WP_Query(array('posts_per_page' => $num_posts, 'cat' => implode(",",array_filter($categories))));
					include 'templates/three_up.php';
					break;
				case 'four_up':
					$queryObject = new WP_Query(array('posts_per_page' => $num_posts, 'cat' => implode(",",array_filter($categories))));
					include 'templates/four_up.php';
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
	
	<?php
	$next = get_next_posts_link();
	$prev = get_previous_posts_link();
	 ?>
	<?php if($next || $prev): ?>	
	<div class="pagination row">			
		<?php if($next): ?>
			<a href='<?php echo next_posts( $max_page, false ); ?>' class='button'>Older Entries</a>
		<?php endif; ?>
		<?php if($prev): ?>
			<a href='<?php echo previous_posts( $max_page, false ); ?>' class='button'>Newer Entries</a>
		<?php endif; ?>
	</div>
	<?php endif; ?>
</div>
<?php get_footer(); ?>