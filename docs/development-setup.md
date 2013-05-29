##Dev Setup

###Less Steps, Less Awesomeness

####Setup

#####CodeKit
[CodeKit](http://incident57.com/codekit/)

####Use


###More Steps, More Awesomeness

####Setup

#####Install Node.js

[Download the installer](http://nodejs.org/)

If you'd prefer to use a package manager, [here's a full run-down](https://github.com/joyent/node/wiki/Installing-Node.js-via-package-manager) on all the ways to do it.

#####Install CSSCSS
Frank uses [CSSCSS](https://github.com/zmoazeni/csscss) for one of its tasks. CSSCSS is written in Ruby, specifically for Ruby 1.90+. Make sure you have Ruby installed on your system and that it is at version **1.90+**. There's a [helpful guide](http://www.ruby-lang.org/en/downloads/) for installing Ruby on all common operating systems.

Once Ruby is installed, open up a terminal window and run the following command:

`$ gem install csscss`

#####Install Composer
Frank also uses the PHP package manager [http://getcomposer.org/]Composer for a couple of tasks. Refer to [Composer's installation documentation](http://getcomposer.org/doc/00-intro.md#downloading-the-composer-executable) for a detailed breakdown of all options.

#####Install WebP
The [grunt-webp](https://github.com/somerandomdude/grunt-webp) plugin depends on Google's [WebP](https://developers.google.com/speed/webp/) binary. You'll need to [download the binary](https://developers.google.com/speed/webp/download) and install it locally.

#####Package Installations

[Full details on getting started with Grunt](http://gruntjs.com/getting-started)

Open up a terminal window, `cd` into the Frank theme folder and run the following commands:

`$ php composer.phar install`

`$ npm install`


####Use

#####General Development

`$ grunt`

#####Testing, Linting and Code Quality

`$ grunt test`

#####Optimization

`$ grunt opt`

#####Generating Documentation

`$ grunt docs`

#####Distribution

`$ grunt dist`









I put together a pretty big list of questions while working through all of this. I'll paste them in here so I don't lose 'em but they could maybe be broken out into their own doc/discussion.

To use the current grunt tasks you have to manually install the following items:
composer
WP Standards for Code Sniffer for phpcs task
csscss gem
ruby/sass
cwebp

Just want to make sure all of that is documented. Perhaps we could package some of these up somehow?

csscss
This spits out some verbose output into STDOUT but I'm not sure what to do with it?

csslint
CSSLint runs but it fails and it only runs against style.css. Should it run against the other stylesheets?

docs
Should docs folder be compiled with docs task? Right now it only seems to compile contributors.md, readme.md and history.md.

opt/dist
Do you want all that image optimization stuff to happen as part of the dist task? Basically running opt as a step in dist.

Should uglify and csso be part of dist?

general
Should all generated files be in .gitignore? minified css/js, markdown/contrib/readme.html? optimized images?
