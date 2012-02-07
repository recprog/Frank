cd `dirname $0`
sass --update ../stylesheets/scss/reset.scss:../stylesheets/css/reset.css --trace
sass --update ../stylesheets/scss/grid.scss:../stylesheets/css/grid.css --trace
sass --update ../stylesheets/scss/global.scss:../stylesheets/css/global.css --trace
sass --update ../stylesheets/scss/forms.scss:../stylesheets/css/forms.css --trace
sass --update ../stylesheets/scss/widgets.scss:../stylesheets/css/widgets.css --trace
sass --update ../stylesheets/scss/sprites.scss:../stylesheets/css/sprites.css --trace
sass --update ../stylesheets/scss/transitions.scss:../stylesheets/css/transitions.css --trace
sass --update ../stylesheets/scss/header.scss:../stylesheets/css/header.css --trace
sass --update ../stylesheets/scss/index.scss:../stylesheets/css/index.css --trace
sass --update ../stylesheets/scss/single.scss:../stylesheets/css/single.css --trace
sass --update ../stylesheets/scss/archive.scss:../stylesheets/css/archive.css --trace
sass --update ../stylesheets/scss/fourohfour.scss:../stylesheets/css/fourohfour.css --trace
sass --update ../stylesheets/scss/sidebar.scss:../stylesheets/css/sidebar.css --trace
sass --update ../stylesheets/scss/comments.scss:../stylesheets/css/comments.css --trace
sass --update ../stylesheets/scss/footer.scss:../stylesheets/css/footer.css --trace
sass --update ../stylesheets/scss/pages.scss:../stylesheets/css/pages.css --trace
sass --update ../stylesheets/scss/colorbox.scss:../stylesheets/css/colorbox.css --trace
sass --update ../stylesheets/scss/hacks.scss:../stylesheets/css/hacks.css --trace
sass --update ../stylesheets/scss/custom.scss:../stylesheets/css/custom.css --trace
sass --update ../stylesheets/scss/mobile.scss:../stylesheets/css/mobile.css --trace
sass --update ../stylesheets/scss/print.scss:../stylesheets/css/print.css --trace
sass --update ../stylesheets/scss/ie.scss:../stylesheets/css/ie.css --trace
sass --update ../stylesheets/scss/ie7.scss:../stylesheets/css/ie7.css --trace
juicer merge ../stylesheets/css/main.css --force -o ../style.css -c none
juicer merge -i ../js/frank.slideshow.js ../js/simplebox.js ../js/main.js --force -o ../js/somerandomdude.js -c none -m closure_compiler
echo "/* 
Theme Name:     Frank for Some Random Dude
Theme URI:      http://somerandomdude.com/frank 
Description:    Child theme for the Frank theme  
Author:         P.J. Onori 
Author URI:     http://somerandomdude.com/hello/  
Template:       frank  
Version:        0.1.0  
*/"|cat - ../style.css > /tmp/out && mv /tmp/out ../style.css