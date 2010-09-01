<?php
$post = $wp_query->post;

$category = get_the_category(); 

if ( in_array($category[0]->cat_ID, getTertiaryColumnCategoriesArray()) || in_array($category[0]->category_parent, getTertiaryColumnCategoriesArray()) ) {
	
include(TEMPLATEPATH . '/single_snippet.php');

} elseif ( in_array($category[0]->cat_ID, getPrimaryColumnCategoriesArray()) || in_array($category[0]->category_parent, getPrimaryColumnCategoriesArray()) ) {
include(TEMPLATEPATH . '/single_article.php');

} else {
include(TEMPLATEPATH . '/single_article.php');
}
?>