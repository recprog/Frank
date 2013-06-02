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

####Performance Settings

#####Remove WordPress version meta tag
There are potential security risks associated with exposing your version of WordPress. Removing this meta tag will also shave a few bytes off of the generated HTML.

#####Remove version URL parameter from scripts
The version URL parameter can prevent files from caching in certain browsers. If you want more reliable caching of your scripts, turn this feature on.

#####Remove version URL parameter from stylesheets
The version URL parameter can prevent files from caching in certain browsers. If you want more reliable caching of your stylesheets, turn this feature on.