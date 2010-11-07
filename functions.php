<?php

/*thanks to http://www.nathanrice.net/blog/wordpress-single-post-templates/ */
/*add_filter('single_template', create_function('$t', 'foreach( (array) get_the_category() as $cat ) { if ( file_exists(TEMPLATEPATH . "/single-{$cat->category_nicename}.php") ) return TEMPLATEPATH . "/single-{$cat->category_nicename}.php"; } return $t;' ));*/

add_filter('single_template', create_function('$t', 'foreach( (array) get_the_category() as $cat ) { 
	if ( file_exists(TEMPLATEPATH . "/single-{$cat->category_nicename}.php") ) return TEMPLATEPATH . "/single-{$cat->category_nicename}.php"; 
	else if($cat->category_parent!=0){
		$pCat=$cat;
		while($pCat->cat_ID) {
			if ( file_exists(TEMPLATEPATH . "/single-{$pCat->category_nicename}.php") ) return TEMPLATEPATH . "/single-{$pCat->category_nicename}.php"; 
			$pCat=get_category($pCat->category_parent);
		}
	}
} return $t;' ));

/*
Description: A helper plugin for the Franklin Street Wordpress Theme to make setup and alterations easier for the three-column 
*/

if(!get_option('fs_posts_primary')) update_option( 'posts_primary', 10 );
if(!get_option('fs_posts_secondary')) update_option( 'posts_secondary', 10 );
if(!get_option('fs_posts_tertiary')) update_option( 'posts_tertiary', 10 );

if(!get_option('fs_title_primary')) update_option( 'title_primary', 'Primary Column' );
if(!get_option('fs_title_secondary')) update_option( 'title_secondary', 'Secondary Column' );
if(!get_option('fs_title_tertiary')) update_option( 'title_tertiary', 'Tertiary Column' );

if(!get_option('fs_caption_primary')) update_option( 'caption_primary', 'Primary Column Caption' );
if(!get_option('fs_caption_secondary')) update_option( 'caption_secondary', 'Secondary Column Caption' );
if(!get_option('fs_caption_tertiary')) update_option( 'caption_tertiary', 'Tertiary Column Caption' );

if(!get_option('fs_show_header_primary')) update_option( 'fs_show_header_primary', 'show_header' );
if(!get_option('fs_show_header_secondary')) update_option( 'fs_show_header_secondary', 'show_header' );
if(!get_option('fs_show_header_tertiary')) update_option( 'fs_show_header_tertiary', 'show_header' );

if(!get_option('fs_show_footer_primary')) update_option( 'fs_show_footer_primary', 'show_footer' );
if(!get_option('fs_show_footer_secondary')) update_option( 'fs_show_footer_secondary', 'show_footer' );
if(!get_option('fs_show_footer_tertiary')) update_option( 'fs_show_footer_tertiary', 'show_footer' );

if(!get_option('fs_comment_template_id'))
{
	$args = array(
	'post_title' => 'Comments',
	'post_content' => '',		
	'post_status' => 'publish', 
	'post_type' => 'page',
	'post_author' => 0,
	'ping_status' => get_option('default_ping_status'), 
	'post_parent' => 0,
	'menu_order' => 0,
	'to_ping' =>  '',
	'pinged' => '',
	'post_password' => '',
	'guid' => '',
	'post_content_filtered' => '',
	'post_excerpt' => '',
	'import_id' => 0);

	$comment_id = wp_insert_post( $args );
	update_option( 'fs_comment_template_id', $comment_id );
	update_post_meta($comment_id, "_wp_page_template", "comment_wrapper.php");
}

if(!get_option('fs_category_template_id'))
{
	$args = array(
	'post_title' => 'Categories',
	'post_content' => '',		
	'post_status' => 'publish', 
	'post_type' => 'page',
	'post_author' => 0,
	'ping_status' => get_option('default_ping_status'), 
	'post_parent' => 0,
	'menu_order' => 0,
	'to_ping' =>  '',
	'pinged' => '',
	'post_password' => '',
	'guid' => '',
	'post_content_filtered' => '',
	'post_excerpt' => '',
	'import_id' => 0);

	$comment_id = wp_insert_post( $args );
	update_option( 'fs_category_template_id', $comment_id );
	update_post_meta($comment_id, "_wp_page_template", "categories_wrapper.php");
}

add_action('admin_menu', 'fs_plugin_menu');
//add_action('after_setup_theme', 'fs_init');


add_action( 'init', 'fs_register_menus' );

function fs_register_menus() {
  register_nav_menus(array('primary' => __( 'Primary Navigation' )));
}

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
		
		$show_header_primary = ($_POST['show_header_primary']=='show_header')?'show_header':'hide_header';
		$show_header_secondary = ($_POST['show_header_secondary']=='show_header')?'show_header':'hide_header';
		$show_header_tertiary = ($_POST['show_header_tertiary']=='show_header')?'show_header':'hide_header';
		
		$show_footer_primary = ($_POST['show_footer_primary']=='show_footer')?'show_footer':'hide_footer';
		$show_footer_secondary = ($_POST['show_footer_secondary']=='show_footer')?'show_footer':'hide_footer';
		$show_footer_tertiary = ($_POST['show_footer_tertiary']=='show_footer')?'show_footer':'hide_footer';


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
		update_option( 'fs_show_header_primary', $show_header_primary );
		update_option( 'fs_show_header_secondary', $show_header_secondary );
		update_option( 'fs_show_header_tertiary', $show_header_tertiary );
		update_option( 'fs_show_footer_primary', $show_footer_primary );
		update_option( 'fs_show_footer_secondary', $show_footer_secondary );
		update_option( 'fs_show_footer_tertiary', $show_footer_tertiary );
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
		<input type="checkbox" name="show_header_primary" value="show_header" <?php if(get_option('fs_show_header_primary')=='show_header') echo 'checked="checked"'; ?> /> <?php _e("Display Primary Post Header", 'mt_trans_domain' ); ?>
	</td>
	<td>
		<input type="checkbox" name="show_header_secondary" value="show_header" <?php if(get_option('fs_show_header_secondary')=='show_header') echo 'checked="checked"'; ?> /> <?php _e("Display Secondary Post Header", 'mt_trans_domain' ); ?>
	</td>
	<td>
		<input type="checkbox" name="show_header_tertiary" value="show_header" <?php if(get_option('fs_show_header_tertiary')=='show_header') echo 'checked="checked"'; ?> /> <?php _e("Display Tertiary Post Header", 'mt_trans_domain' ); ?>
	</td>
</tr>

<tr>
	<td>
		<input type="checkbox" name="show_footer_primary" value="show_footer" <?php if(get_option('fs_show_footer_primary')=='show_footer') echo 'checked="checked"'; ?> /> <?php _e("Display Primary Post Footer", 'mt_trans_domain' ); ?>
	</td>
	<td>
		<input type="checkbox" name="show_footer_secondary" value="show_footer" <?php if(get_option('fs_show_footer_secondary')=='show_footer') echo 'checked="checked"'; ?> /> <?php _e("Display Secondary Post Footer", 'mt_trans_domain' ); ?>
	</td>
	<td>
		<input type="checkbox" name="show_footer_tertiary" value="show_footer" <?php if(get_option('fs_show_footer_tertiary')=='show_footer') echo 'checked="checked"'; ?> /> <?php _e("Display Tertiary Post Footer", 'mt_trans_domain' ); ?>
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

function showPrimaryColumnHeader() {
	return (get_option('fs_show_header_primary')=='show_header')?true:false;
}

function showSecondaryColumnHeader() {
	return (get_option('fs_show_header_secondary')=='show_header')?true:false;
}

function showTertiaryColumnHeader() {
	return (get_option('fs_show_header_tertiary')=='show_header')?true:false;
}

function showPrimaryColumnFooter() {
	return (get_option('fs_show_footer_primary')=='show_footer')?true:false;
}

function showSecondaryColumnFooter() {
	return (get_option('fs_show_footer_secondary')=='show_footer')?true:false;
}

function showTertiaryColumnFooter() {
	return (get_option('fs_show_footer_tertiary')=='show_footer')?true:false;
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
	
if ( function_exists('register_sidebar') )
	register_sidebar(array(
	'name' => 'Heel',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widgettitle">',
	'after_title' => '</h3>',
	));
	
if ( function_exists('register_sidebar') )
	register_sidebar(array(
	'name' => 'Sticky Footer',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widgettitle">',
	'after_title' => '</h3>',
	));

	
if ( function_exists('register_sidebar') )
	register_sidebar(array(
	'name' => '404',
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

/**
* Find and close unclosed xml tags
**/
function close_tags($text) {
    $patt_open    = "%((?<!</)(?<=<)[\s]*[^/!>\s]+(?=>|[\s]+[^>]*[^/]>)(?!/>))%";
    $patt_close    = "%((?<=</)([^>]+)(?=>))%";
    if (preg_match_all($patt_open,$text,$matches))
    {
        $m_open = $matches[1];
        if(!empty($m_open))
        {
            preg_match_all($patt_close,$text,$matches2);
            $m_close = $matches2[1];
            if (count($m_open) > count($m_close))
            {
                $m_open = array_reverse($m_open);
                foreach ($m_close as $tag) $c_tags[$tag]++;
                foreach ($m_open as $k => $tag)    if ($c_tags[$tag]--<=0) $text.='</'.$tag.'>';
            }
        }
    }
    return $text;
}

function truncate_title($title, $length, $echo=true)
{	
	if (strlen($title) > $length) $title=substr($title, 0, $length).'&hellip;';	
	if($echo) echo $title;
	return $title;
}

function content($maxLength, $read_more="Read More", $image_width=190, $image_height=120, $image_quality=80, $echo=true)
{
	$html=get_the_content(); //new
    $printedLength = 0;
    $position = 0;
    $tags = array();

	$content=''; //new
	$count=0;
	$truncated=false;
	$read_more = ' <div class="read-more"><a href="'.get_permalink().'" class="button more">'.$read_more.'</a></div>';
	
	$matches = preg_match_all('{</?([a-z]+)[^>]*>|&#?[a-zA-Z0-9]+;}', $html, $match, PREG_OFFSET_CAPTURE, $position);
	
    while ($printedLength < $maxLength && preg_match('{</?([a-z]+)[^>]*>|&#?[a-zA-Z0-9]+;}', $html, $match, PREG_OFFSET_CAPTURE, $position))
    {
		$count++;
        list($tag, $tagPosition) = $match[0];

        // Print text leading up to the tag.
        $str = substr($html, $position, $tagPosition - $position);
        if ($printedLength + strlen($str) > $maxLength)
        {
            //print(substr($str, 0, $maxLength - $printedLength));
			$content.=substr($str, 0, $maxLength - $printedLength);
			if(!$truncated) 
			{
				$content.='&hellip;'.$read_more;
				$truncated=true;
			}
            $printedLength = $maxLength;
            break;
        }

        //print($str);
		$content.=$str;
        $printedLength += strlen($str);

        if ($tag[0] == '&')
        {
            // Handle the entity.
            //print($tag);
			$content.=$tag;
            $printedLength++;
        }
        else
        {
            // Handle the tag.
            $tagName = $match[1][0];
            if ($tag[1] == '/')
            {
                // This is a closing tag.

                $openingTag = array_pop($tags);
                assert($openingTag == $tagName); // check that tags are properly nested.

                //print($tag);
				if($matches-2==$count&&$printedLength >= $maxLength&&!$truncated) 
				{
					print('[truncating]');
					$content.='&hellip;'.$read_more;
					$truncated=true;
				}
				$content.=$tag;
            }
            else if ($tag[strlen($tag) - 2] == '/')
            {
                // Self-closing tag.
                //print($tag);
				$content.=$tag;
            }
            else
            {
                // Opening tag.
                //print($tag);
				$content.=$tag;
                $tags[] = $tagName;
				
            }
        }

        // Continue after the tag.
        $position = $tagPosition + strlen($tag);
    }

    // Print any remaining text.
    if ($printedLength < $maxLength && $position < strlen($html))
        //print(substr($html, $position, $maxLength - $printedLength));
		$content.=substr($html, $position, $maxLength - $printedLength);
		if($printedLength >= $maxLength&&!$truncated) 
		{
			$content.='&hellip;'.$read_more;
			$truncated=true;
		}

    // Close any open tags.
    while (!empty($tags))
        //printf('</%s>', array_pop($tags));
		$content.='</'.array_pop($tags).'>';

	$content = apply_filters('the_content', $content); 
	
	
	$pattern = '/\< *[img][^\>]* src *= *[\"\']{0,1}([^\"\'\ >]*)/i';
	$replacement = '<img src="/php/phpthumb/phpThumb.php?src=' . '$1' . '&w=190&h=120&zc=1&q=80"';

	$pagecontent = preg_replace($pattern, $replacement, $content);

	$pattern = '/height *= *[\"\']?[^\"\'\ >]*/';
	$replacement = 'height="120"';
	$pagecontent = preg_replace($pattern, $replacement, $pagecontent);

	$pattern = '/width *= *[\"\']?[^\"\'\ >]*/';
	$replacement = 'width="190"';
	$pagecontent = preg_replace($pattern, $replacement, $pagecontent);
	
	if($echo) echo $pagecontent;
	
	return $pagecontent;
}
?>