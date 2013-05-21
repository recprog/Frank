<a name="using-frank-theme-modification"></a>
###Theme Modification
The Frank theme was always intended to be built upon. All CSS and Javascript are compiled from pre-processor languages ([SCSS](http://sass-lang.com/) &amp; [CoffeeScript](http://coffeescript.org/)). For those with less experience using pre-processor languages (especially how to compile them through the command line), I highly suggest using [CodeKit](http://incident57.com/codekit/) for managing your Frank project. It is also highly suggested that any significant modifications are built out as a [child theme](http://codex.wordpress.org/Child_Themes).

####Compass
Frank uses [Compass](http://compass-style.org/) for SCSS compilation and takes advantage of its mixins and functions. [Installing Compass](http://compass-style.org/install/) is necessary to successfully compile the theme's SCSS, but it's quite easy. The theme includes the Compass config file to make life a little easier.

####SCSS Structure
The styles for Frank are broken up by subject matter. The *style.scss* file is the only file you should compile. It takes all the SCSS files and builds it into the theme's *style.css*. All colors, typefaces, font sizes and other visual attributes can be altered in the *variables.scss* file. Site-wide styles can be found in the *global.scss* file. All template-specific styles are found in the SCSS file with its matching name.

####Foundation-based Grid
Frank uses a pared-down version of [Foundation v2](foundation.zurb.com) for its grid system. The Foundation framework was modified to remove unneeded styles and features. All Foundation code is found in *stylesheets/scss/grid.scss*.

####CoffeeScript
Frank does not depend on Javascript, but it does include some small Javascript components if you need them. All Javascript is compiled from CoffeeScript files which can be found in *javascripts/coffeescript*