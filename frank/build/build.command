cd `dirname $0`
echo "/* 
Theme Name:     Frank
Theme URI:      http://somerandomdude.com/work/frank 
Description:    The next step of the Franklin Street theme.  
Author:         P.J. Onori 
Author URI:     http://somerandomdude.com/hello/  
Version:        0.1.0
License:				GPL 3.0
License URI:		http://www.gnu.org/copyleft/gpl.html 
Tags: brown, red, white, two-columns, fixed-width, sticky-post, custom-menu
*/"|cat - ../style.css > /tmp/out && mv /tmp/out ../style.css