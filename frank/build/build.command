cd `dirname $0`
echo "/* 
Theme Name:     Frank
Theme URI:      http://somerandomdude.com/work/frank 
Description:    The next step of the Franklin Street theme.  
Author:         P.J. Onori 
Author URI:     http://somerandomdude.com/hello/  
Version:        0.9.0
Tags: 					tan, black, tan, two-columns, fixed-width, custom-header, custom-background, threaded-comments, sticky-post, responsive, translation-ready, editor-style, custom-menu (optional)
License:				GPL 3.0
License URI:		http://www.gnu.org/copyleft/gpl.html 

*/"|cat - ../style.css > /tmp/out && mv /tmp/out ../style.css