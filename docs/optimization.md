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