<a name="development-setup"></a>
##Development Setup

If you have cloned Frank from the Github repo, you will need to build the files for it to run properly. There are two different methods to do this:

###Method #1: Less Steps, Less Awesomeness

Sometimes you just need the basics. If running commands in the terminal is a little too much for you, we suggest you use a tool like [CodeKit](http://incident57.com/codekit/) to help you with the preprocessor compiling.

####Setup

CodeKit will ask you to add a project. Just select the 'frank' theme folder and CodeKit should do the rest. *Note: You're going to have much less control and ability to optimize the theme through with method. This approach is advisable if you just want to build Frank the quick-and-dirty way.*

###Method #2: More Steps, More Awesomeness

If you want to get into the nitty-gritty and really get Frank running as fast as possible, you'll need to use our Grunt tasks.

####Setup

Frank's automation tools use [Node.js](http://nodejs.org/download/), [Ruby](http://www.ruby-lang.org/en/downloads/), [Compass](http://compass-style.org/install/), [SASS](http://sass-lang.com/download.html), [CSSCSS](http://zmoazeni.github.io/csscss/), [Composer](http://getcomposer.org/download/) and [WebP](https://developers.google.com/speed/webp/download). Phew, that's a mouthful. We're constantly working to whittle this list down, but for now, this is what's necessary.

#####Install Node.js

[Download the installer](http://nodejs.org/)

If you'd prefer to use a package manager, [here's a full run-down](https://github.com/joyent/node/wiki/Installing-Node.js-via-package-manager) on all the ways to do it.

#####Install Ruby 1.90+

Many of the Grunt tasks rely on Ruby gems to do some of the heavy lifting. The gems used depend on Ruby *1.90+*. To see what version of Ruby you're running, run the following command in your terminal:

 `$ ruby -v`

#####Install Compass

We rely on Compass to make SASS preprocessing all that more awesome. Install Compass by running:

`$ gem update --system && gem install compass`


#####Install SASS

All CSS for the theme is generated from SASS. Install SASS on your machine by running:

`$ gem update --system && gem install sass`


#####Install CSSCSS
Frank uses [CSSCSS](https://github.com/zmoazeni/csscss) to check for CSS rule redundancy. Install CSSCSS by running:

`$ gem update --system && gem install csscss`

#####Install Composer
Frank also uses the PHP package manager [http://getcomposer.org/]Composer for a couple of tasks. Refer to [Composer's installation documentation](http://getcomposer.org/doc/00-intro.md#downloading-the-composer-executable) for a detailed breakdown of all options.

#####Install WebP binary
The [grunt-webp](https://github.com/somerandomdude/grunt-webp) plugin depends on Google's [WebP](https://developers.google.com/speed/webp/) binary. You'll need to [download the cwebp binary](https://developers.google.com/speed/webp/download) and install it locally.

#####Package Installations

[Full details on getting started with Grunt](http://gruntjs.com/getting-started)

Open up a terminal window, `cd` into the Frank theme folder and run the following commands:

`$ php composer.phar install`

`$ npm install`

Once that's complete, you'll need to install the [WordPress Coding Standard](https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards) for PHP_Codesniffer.

And with that, you're *finally* done.

####Use

#####General Development

For basic compilation of SASS and CoffeeScript files, run the following command in your terminal:

`$ grunt`

#####Automatic SASS/Coffeescript Compilation

If you're modifying Frank and want your SASS and CoffeeScript to build when a file is modified, run:

`$ grunt watch`

#####Testing, Linting and Code Quality

We don't have a ton of tests running just yet, but have a lot more in store for the future. To test your files, run:

`$ grunt test`

#####Optimization

Frank is all about optimization, so a lot of the magic happens here. To run all the optimization tasks, run:

`$ grunt opt`

#####Generating Documentation

To build the documentation, run:

`$ grunt docs`

#####Distribution

If you'd like a clean copy of the theme without any of the files for development or preprocessor files, run:

`$ grunt dist`