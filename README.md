#Frank is an open source WordPress theme designed for speed

##README Contents
* [About Frank](#about-frank)
* [Using Frank](#using-frank)
	* [Theme Options](#using-frank-theme-options)
	* [Theme Modification](#using-frank-theme-modification)
	* [Theme Optimization](#using-frank-theme-optimization)
* [Browser Compatibility](#browser-compatibility)
* [WordPress Compatibility](#wordpress-compatibility)
* [Credits](#credits)

<a name="about-frank"></a>
##About Frank

This theme has been the personal project of [P.J. Onori](http://somerandomdude.com) with the gracious [help of many](#credits). The theme was designed to provide a lightweight theme focused on the reading experience. Frank is the parent theme of [Frank of Some Random Dude](https://github.com/somerandomdude/Frank-somerandomdude), the theme I use on somerandomdude.com

###Frank is fast

Frank's main focus is speed. The parent theme's default home page makes 9 database queries and consists of 2 requests weighing ~29Kb (9.3Kb gzipped). Frank keeps it basic—no Javascript frameworks, no unnecessary images, just a simple, no-frills, screaming fast blog.

###Frank is flexible

Frank has several different layouts to choose from for your home page. Most layouts let you specify the number of posts to show and from what categories. Templates can be stacked by any amount and order to give you the structure you need. Additionally, there are plenty of well-placed widgets that will give you that extra level of customization.

###Frank is forward-thinking

Frank is built on HTML5 and CSS3. The theme strives for 100% valid HTML5 templates. One way Frank is so small is that it uses CSS3's effects and transitions to avoid unneeded images and Javascript. One side effect of this approach is that Frank does not support Internet Explorer 6 and *moderately* supports Internet Explorer 7 & 8. 

###Frank fits on your phone

Frank uses a subset of [Foundation](http://foundation.zurb.com/) to provide a responsive layout for desktops, tablets and phones. Add this to the theme's small footprint and you have a mobile-optimized blog. 

###Frank is for you

This theme is 100% open source and developer friendly. The parent theme (/frank) is under the [GNU Public License](http://www.gnu.org/copyleft/gpl.html). 

###Frank ain't finished

There is always more to do, but I need help. This project relies on community support, so if you find this theme helpful, please contribute.

<a name="using-frank"></a>
##Using Frank
<a name="using-frank-theme-options"></a>
###Theme Options
Frank supports all the basic WordPress theme options you expect (plus more). All basic options (Widgets, Menus, Header & Background) can be found in the *Appearance* section. Frank also comes with theme-specific options found under *Appearance > Frank Theme Options*.

####General Settings
Frank's General settings allow for small site adjustments, when you don't want to open up the hood and get your hands dirty.

#####Custom Header Code
The Custom Header Code setting allows you to add code in the `head` tag. This can be useful for adding Google Analytics/TypeKit Javascript snippets.
#####Custom Footer Code
The Custom Footer Code setting allows you to add code above the closing `body` tag. This can be used for quickly adding third-party Javascript references (e.g., Google's hosted Javascript libraries).
#####Tweet This/Twitter Handle
The Tweet This setting adds a tweet button on the left column of the single.php template. The tweet button replicates Twitter's own button without a reliance on Javascript. The Twitter Handler setting will add <em>via @[USERNAME]</em> to the end of the pre-filled tweet. 

####Home Page Settings
The Frank homepage template is set up to have customizable, modular content sections to display your posts in different ways.

#####Adding Content Sections
A new content section can be added by clicking the *Add New Section* button. This will add a blank section to the bottom of the section list. The section will not be displayed on your home page until you save the settings.

#####Removing Content Sections
Any section can be deleted by clicking the × button on the top right corner of the section pane. The section will not be removed from your home page until you save the settings.

#####Changing the Order of Content Sections
Sections can be dragged into the desired order by dragging the handle on the top left corner of any settings pane. The order will not be changed on your home page until you save the settings.

#####Display Section Header
Each section can have an individual title and caption. Checking this setting will allow you to enter a title and caption to be displayed at the top of the section.

#####Section Header
A title for the content section.

#####Section Caption
A description for the content section.

#####Display Type
Frank has various loop types for the home page, depending on your needs. 

* **Default Loop**: This loop is the basic loop found in most WordPress themes. It incorporates none of the options found in other loops, such as custom post counts, category filters etc. The Default loop also displays a sidebar on the right hand side.

* **One Up (Regular)**: The One Up loop displays one post per column with with no sidebar. The typographic size of the header and copy closely resemble that of the Default Loop.

* **One Up (Large)**: The One Up Large loop displays one post per column with with no sidebar. The typographic size of the header is much larger, making it suitable for a featured section.

* **Two Up**: The Two Up loop two posts per column with with no sidebar.

* **Three Up**: The Three Up loop two posts per column with with no sidebar.

* **Four Up**: The Four Up loop two posts per column with with no sidebar.

#####Number of Posts
This setting allows you to define how many posts you want displayed in the loop. **Note:** This setting does not work for the Default Loop as it will use the number of posts defined in by the *Blog pages show at most* setting in Settings > Reading.


#####Categories to Display
If you only want to show specific categories in a section, you can choose which to display in the checklist. **Note:** If no categories are selected, the section will default to displaying *all* categories (I know, this is a little wonky, I will be working on this in future versions). This setting will also not work for the Default Loop.

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

<a name="using-frank-theme-optimization"></a>
###Theme Optimization
The Frank theme is pretty lean by default, but there's a lot you can do to make it *faster*. Below are some simple tips for keeping Frank fast.

####Minify style.css
By default, the *style.css* file is not minified for legibility. **Minifying your stylesheet should be the first thing you do.** The easiest way to accomplish this is to change the Compass SCSS compilation setting. To do this, open the *config.rb* file and change the `output_style` variable from *:expanded* to *:compressed*.

####Use Widgets Wisely
Frank has various widget spaces for you to customize your theme. Used correctly, widgets can theoretically improve performance. The *Navigation* widget is one way to lower the amount of database queries WordPress makes (6 -7 queries in my experience). By using a text widget in the *Navigation* widget section and adding an unordered list like the example below, you can save quite a few database queries. 

	<ul id="menu-primary" class="menu">
		<li class="menu-item"><a href="/page-1">Page 1</a></li>
		<li class="menu-item"><a href="/page-2">Page 2</a></li>
		<li class="menu-item"><a href="/page-3">Page 3</a></li>
	</ul> 
	
####Avoid jQuery (or any other JS framework for that matter)
Frank comes with some simple Javascript components that do not rely on jQuery. Unless your site has heavy *web-app-ish* features, it is strongly suggested to avoid using a framework.

####Install Alternative PHP Cache (APC)
[APC](http://php.net/manual/en/book.apc.php) will provide significant performance increases if used correctly. There are plenty of guides for installing APC on [Google](https://www.google.com/search?q=Install+Alternative+PHP+Cache&aq=f&oq=Install+Alternative+PHP+Cache&aqs=chrome.0.57j0l3j62l2.1033&sugexp=chrome,mod=6&sourceid=chrome&ie=UTF-8#hl=en&tbo=d&sclient=psy-ab&q=Install+APC+for+PHP&oq=Install+APC+for+PHP&gs_l=serp.3..0l3j0i30.11068.14252.0.14581.16.11.5.0.0.0.200.1813.0j10j1.11.0.les%3Bepsugrpq1high.1.0.0...1.1.cOdurfjGwd0&pbx=1&bav=on.2,or.r_gc.r_pw.r_cp.r_qf.&fp=1ad8c242e1bf948a&bpcl=39967673&biw=1436&bih=783).

####Install W3 Total Cache (W3TC)
[W3TC](http://wordpress.org/extend/plugins/w3-total-cache/) is the easiest way to take full advantage of APC. W3TC has a wide range of features, but if you build your theme correctly, 

#####W3 Total Cache Tips
* Manually combine and minify your CSS/JS files. Relying on W3 Total Cache for this process will require extra CPU cycles.
* W3TC offers the option to connect to content delivery networks (CDNs). CDNs are great, but if you keep your site small, they become unnecessary. If your site is getting serious traffic or contains a large amount of images or video, a CDN may make sense, but for the rest of you, save your time and money.

<a name="browser-compatibility"></a>
##Browser Compatibility
Frank is focused on modern desktop and mobile browser support. Frank works *decently* on Internet Explorer 8+. No guarantees are given for any earlier IE versions.

<a name="wordpress-compatibility"></a>
##WordPress Compatibility
Frank was built and tested on WordPress 3.4.3. Any future development of the theme will be focused on supporting the most current version of WordPress.

<a name="credits"></a>
##Credits
This theme was built with significant help of some great folks. My sincere thanks to [Felix Holmgren](http://twitter.com/felixhgren), [Jon Christopher](http://twitter.com/jchristopher) and [Josh McDonald](https://twitter.com/onestepcreative) for their tremendous contributions.

