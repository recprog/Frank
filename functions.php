<?php
/*
Description: A helper plugin for the Franklin Street Wordpress Theme to make setup and alterations easier for the three-column 
*/

if(!get_option('posts_primary')) update_option( 'posts_primary', 10 );
if(!get_option('posts_secondary')) update_option( 'posts_secondary', 10 );
if(!get_option('posts_tertiary')) update_option( 'posts_tertiary', 10 );

if(!get_option('title_primary')) update_option( 'title_primary', 'Primary Column' );
if(!get_option('title_secondary')) update_option( 'title_secondary', 'Secondary Column' );
if(!get_option('title_tertiary')) update_option( 'title_tertiary', 'Tertiary Column' );

if(!get_option('caption_primary')) update_option( 'caption_primary', 'Primary Column Caption' );
if(!get_option('caption_secondary')) update_option( 'caption_secondary', 'Secondary Column Caption' );
if(!get_option('caption_tertiary')) update_option( 'caption_tertiary', 'Tertiary Column Caption' );

add_action('admin_menu', 'fs_plugin_menu');

function fs_plugin_menu() {
  add_options_page('Franklin Street Options', 'Franklin Street', 8, 'franklin-street', 'fs_options_page');
}

function fs_options_page() {

    $opt_name = 'fs_options';
    $hidden_field_name = 'mt_submit_hidden';

	$options = get_option( $opt_name );

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'

    if( $_POST[ $hidden_field_name ] == 'Y' ) {
        
		$posts_primary = $_POST['posts_primary'];
		$posts_secondary = $_POST['posts_secondary'];
		$posts_tertiary = $_POST['posts_tertiary'];
		
		$title_primary = $_POST['title_primary'];
		$title_secondary = $_POST['title_secondary'];
		$title_tertiary = $_POST['title_tertiary'];
		
		$caption_primary = $_POST['caption_primary'];
		$caption_secondary = $_POST['caption_secondary'];
		$caption_tertiary = $_POST['caption_tertiary'];

		$options = array();
		
		$categories= get_categories(); 		
		foreach ($categories as $cat) {
			$name = $cat->category_nicename;
			$options['primary'][$name]=$_POST['primary_'.$name ];
			$options['secondary'][$name]=$_POST['secondary_'.$name ];
			$options['tertiary'][$name]=$_POST['tertiary_'.$name ];
		}
		
       	update_option( 'fs_posts_primary', $posts_primary );
		update_option( 'fs_posts_secondary', $posts_secondary );
		update_option( 'fs_posts_tertiary', $posts_tertiary );
		update_option( 'fs_title_primary', $title_primary );
		update_option( 'fs_title_secondary', $title_secondary );
		update_option( 'fs_title_tertiary', $title_tertiary );
		update_option( 'fs_caption_primary', $caption_primary );
		update_option( 'fs_caption_secondary', $caption_secondary );
		update_option( 'fs_caption_tertiary', $caption_tertiary );
		update_option( $opt_name, $options );

?>
<div class="updated"><p><strong><?php _e('Options saved.', 'mt_trans_domain' ); ?></strong></p></div>
<?php

    }

    // Now display the options editing screen

    echo '<div class="wrap">';

    // header

    echo "<h2>" . __( 'Franklin Street Options', 'mt_trans_domain' ) . "</h2>";
	
    // options form
    
    ?>
<p>
This plugin interface allows you to control how your content is laid out on the home page of your site. These settings <strong>will only</strong> impact your home page.	
</p>
<p><strong>An Important Note</strong><p>
<p>The post count of the primary column is limited by the 'Blog pages show at most' option in Settings->Reading. If you input 20 as the number of posts to show in the primary column, but the 'Blog pages show at most' setting is at 5, the primary column will only show 5 posts.
</p>
<form name="form1" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
<form method="post" action="options.php">
<table class="form-table">
<tr valign="top">
<th scope="row">Primary Column (1st) Settings</th>
<th scope="row">Secondary Column (2nd) Settings</th>
<th scope="row">Tertiary Column (3rd) Settings</th>
</tr>

<tr>
	<td>
		<?php _e("Title:", 'mt_trans_domain' ); ?> <br />	
		<input type="text" name="title_primary" value="<?php echo get_option('fs_title_primary'); ?>" size="20">
	</td>
	<td>
		<?php _e("Title:", 'mt_trans_domain' ); ?> <br />	
		<input type="text" name="title_secondary" value="<?php echo get_option('fs_title_secondary'); ?>" size="20">
	</td>
	<td>
		<?php _e("Title:", 'mt_trans_domain' ); ?> <br />	
		<input type="text" name="title_tertiary" value="<?php echo get_option('fs_title_tertiary'); ?>" size="20">
	</td>
</tr>

<tr>
	<td>
		<?php _e("Caption:", 'mt_trans_domain' ); ?> <br />	
		<input type="text" name="caption_primary" value="<?php echo get_option('fs_caption_primary'); ?>" size="20">
	</td>
	<td>
		<?php _e("Caption:", 'mt_trans_domain' ); ?> <br />	
		<input type="text" name="caption_secondary" value="<?php echo get_option('fs_caption_secondary'); ?>" size="20">
	</td>
	<td>
		<?php _e("Caption:", 'mt_trans_domain' ); ?> <br />	
		<input type="text" name="caption_tertiary" value="<?php echo get_option('fs_caption_tertiary'); ?>" size="20">
	</td>
</tr>

<tr>
	<td>
		<?php _e("Number of Posts to show:", 'mt_trans_domain' ); ?> <br />	
		<input type="text" name="posts_primary" value="<?php echo get_option('fs_posts_primary'); ?>" size="20">
	</td>
	<td>
		<?php _e("Number of Posts to show:", 'mt_trans_domain' ); ?> <br />	
		<input type="text" name="posts_secondary" value="<?php echo get_option('fs_posts_secondary'); ?>" size="20">
	</td>
	<td>
		<?php _e("Number of Posts to show:", 'mt_trans_domain' ); ?> <br />	
		<input type="text" name="posts_tertiary" value="<?php echo get_option('fs_posts_tertiary'); ?>" size="20">
	</td>
</tr>

<tr>
<td>
<strong>Categories to show</strong>
<ul>	
<?php
$categories= get_categories(); 		
foreach ($categories as $cat) {
	$name = $cat->cat_name;
	$nicename = $cat->category_nicename;
?>
	<li class="required pad"><input type="checkbox" name="primary_<?php echo $nicename; ?>" id="category_<?php echo 'primary_'.$cat->cat_ID; ?>" value="<?php echo $cat->cat_ID ?>" <?php if($options['primary'][$nicename]>0) echo 'checked="checked"'; ?> /> <label for="category_'<?php echo 'primary_'.$cat->cat_ID; ?>"><?php echo $name; ?></li>
<?php
	  }	
?>
</ul>
</td>

<td>
	<strong>Categories to show</strong>
	<ul>	
<?php

$categories= get_categories(); 		
foreach ($categories as $cat) {
	$name = $cat->cat_name;
	$nicename = $cat->category_nicename;
?>
	<li class="required pad"><input type="checkbox" name="secondary_<?php echo $nicename; ?>" id="category_<?php echo 'secondary_'.$cat->cat_ID; ?>" value="<?php echo $cat->cat_ID ?>" <?php if($options['secondary'][$nicename]) echo 'checked="checked"'; ?> /> <label for="category_'<?php echo 'secondary_'.$cat->cat_ID; ?>"><?php echo $name; ?></li>
<?php
	  }	
?>
</ul>
</td>

<td>
	<strong>Categories to show</strong>
	<ul>	
<?php

$categories= get_categories(); 		
foreach ($categories as $cat) {
	$name = $cat->cat_name;
	$nicename = $cat->category_nicename;
?>
	<li class="required pad"><input type="checkbox" name="tertiary_<?php echo $nicename; ?>" id="category_<?php echo 'tertiary_'.$cat->cat_ID; ?>" value="<?php echo $cat->cat_ID ?>" <?php if($options['tertiary'][$nicename]) echo 'checked="checked"'; ?> /> <label for="category_'<?php echo 'tertiary_'.$cat->cat_ID; ?>"><?php echo $name; ?></li>
<?php
	  }	
?>
</ul>
</td>

</tr>
</table>	
<hr />

<p class="submit">
<input type="submit" name="Submit" value="<?php _e('Update Options', 'mt_trans_domain' ) ?>" />
</p>

</form>
</div>

<?php
 
}

function getPrimaryColumnPostCount() {
	return get_option('fs_posts_primary');
}

function getPrimaryColumnCategories() {
	$options = get_option('fs_options');
	if(!$options['primary']) return '';
	$str=implode(",",array_filter($options['primary']));
	return $str; 
}

function getPrimaryColumnCategoriesArray() {
	$options = get_option('fs_options');
	if(!$options['primary']) return array();
	return $options['primary']; 
}

function getSecondaryColumnPostCount() {
	return get_option('fs_posts_secondary');
}

function getSecondaryColumnCategories() {
	$options = get_option('fs_options');
	if(!$options['secondary']) return '';
	$str=implode(",",array_filter($options['secondary']));
	return $str; 
}

function getSecondaryColumnCategoriesArray() {
	$options = get_option('fs_options');
	if(!$options['secondary']) return array();
	return $options['secondary']; 
}

function getTertiaryColumnPostCount() {
	return get_option('fs_posts_tertiary');
}

function getTertiaryColumnCategories() {
	$options = get_option('fs_options');
	if(!$options['tertiary']) return '';
	$str=implode(",",array_filter($options['tertiary']));
	return $str; 
}

function getTertiaryColumnCategoriesArray() {
	$options = get_option('fs_options');
	if(!$options['tertiary']) return array();
	return $options['tertiary']; 
}

function primaryColumnTitle() {
	echo get_option('fs_title_primary');
}

function secondaryColumnTitle() {
	echo get_option('fs_title_secondary');
}

function tertiaryColumnTitle() {
	echo get_option('fs_title_tertiary');
}

function primaryColumnCaption() {
	echo get_option('fs_caption_primary');
}

function secondaryColumnCaption() {
	echo get_option('fs_caption_secondary');
}

function tertiaryColumnCaption() {
	echo get_option('fs_caption_tertiary');
}


/**
 * @package WordPress
 * @subpackage Default_Theme
 */

//automatic_feed_links();
if ( function_exists('register_sidebar') )
	register_sidebar(array(
	'name' => 'Sub Header',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widgettitle">',
	'after_title' => '</h3>',
	));

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Article Sidebar: Column 1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));
}

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Article Sidebar: Column 2',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));
}

if ( function_exists('register_sidebar') )
	register_sidebar(array(
	'name' => 'Post Footer',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widgettitle">',
	'after_title' => '</h3>',
	));

if ( function_exists('register_sidebar') )
	register_sidebar(array(
	'name' => 'Footer',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widgettitle">',
	'after_title' => '</h3>',
	));

function myFilter($query) {  
if ($query->is_feed) {  
$query->set('cat','-4477'); //Don't forget to change the category ID =^o^=  
}  
return $query;  
}

/** 
* word-sensitive substring function with html tags awareness 
* @param text The text to cut 
* @param len The maximum length of the cut string 
* @returns string 
**/ 
function substrws( $text, $len=180 ) { 

    if( (strlen($text) > $len) ) { 

        $whitespaceposition = strpos($text," ",$len)-1; 

        if( $whitespaceposition > 0 ) 
            $text = substr($text, 0, ($whitespaceposition+1)); 

        // close unclosed html tags 
        if( preg_match_all("|<([a-zA-Z]+)>|",$text,$aBuffer) ) { 

            if( !empty($aBuffer[1]) ) { 

                preg_match_all("|</([a-zA-Z]+)>|",$text,$aBuffer2); 

                if( count($aBuffer[1]) != count($aBuffer2[1]) ) { 

                    foreach( $aBuffer[1] as $index => $tag ) { 

                        if( empty($aBuffer2[1][$index]) || $aBuffer2[1][$index] != $tag) 
                            $text .= '</'.$tag.'>'; 
                    } 
                } 
            } 
        } 
    } 

    return $text; 
}  

/**
* word-sensitive substring function with html tags awareness
* @param text The text to cut
* @param len The maximum length of the cut string
* @returns string
**/
function mb_substrws( $text, $len=180 ) {

    if( (mb_strlen($text) > $len) ) {

        $whitespaceposition = mb_strpos($text," ",$len)-1;

        if( $whitespaceposition > 0 ) {
            $chars = count_chars(mb_substr($text, 0, ($whitespaceposition+1)), 1);
            if ($chars[ord('<')] > $chars[ord('>')])
                $whitespaceposition = mb_strpos($text,">",$whitespaceposition)-1;
            $text = mb_substr($text, 0, ($whitespaceposition+1));
        }

        // close unclosed html tags
        if( preg_match_all("|<([a-zA-Z]+)|",$text,$aBuffer) ) {

            if( !empty($aBuffer[1]) ) {

                preg_match_all("|</([a-zA-Z]+)>|",$text,$aBuffer2);

                if( count($aBuffer[1]) != count($aBuffer2[1]) ) {

                    foreach( $aBuffer[1] as $index => $tag ) {

                        if( empty($aBuffer2[1][$index]) || $aBuffer2[1][$index] != $tag)
                            $text .= '</'.$tag.'>';
                    }
                }
            }
        }
    }
    return $text;
}

function primary_excerpt_length($length) {
	return 25;
}

function secondary_excerpt_length($length) {
	return 20;
}

function tertiary_excerpt_length($length) {
	return 20;
}

function new_excerpt_more($more) {
	return '...';
}

function excerpt_read_more($post) {
	return '<a href="'. get_permalink($post->ID) . '">' . 'Read the Rest...' . '</a>';
}

function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  
  if (count($content)>=$limit-3) {
    array_pop($content);
    $content = implode(" ",$content).'... <a href="'. get_permalink($post->ID) . '">' . 'Read the Rest' . '</a>';
  } else {
    $content = implode(" ",$content);
  }	

  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content); 
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}

?>