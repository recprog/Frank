module.exports = function(grunt) {

    // configurable paths
    var frankConfig = {
        javascripts: './javascripts',
        coffeescripts: './javascripts/coffeescripts',
        stylesheets: './stylesheets',
        scss: './stylesheets/scss',
        images: './images',
        dist: './dist'
    };

    grunt.initConfig({
        // create frank and pkg templates
        frank: frankConfig,
        pkg: grunt.file.readJSON('package.json'),

        clean: {
          dist: '<%= frank.dist %>'
        },

        copy: {
          //svgo doesn't support dest:src optimization, so we copy SVG files over manually
          opt: {
            expand: true,
            flatten: true,
            src: '<%= frank.images %>/src/*.svg',
            dest: '<%= frank.images %>'
          },
          dist: {
            expand: true,
            src: [
              './**',
              '!<%= frank.images %>/src/**',
              '!<%= frank.stylesheets %>/**',
              '!<%= frank.coffeescripts %>/**',
              '!./node_modules/**',
              '!./docs/**',
              '!./.git/**',
              '!./Gruntfile.js',
              '!./package.json',
              '!./config.rb',
              '!./*.md'
            ],
            dest: '<%= frank.dist %>/frank/'
          }
        },

        jshint: {
          test: {
            src: '<%= frank.javascripts %>/frank.js'
          }
        },

        uglify: {
          opt: {
            src: '<%= frank.javascripts %>/frank.js',
            dest: '<%= frank.javascripts %>/frank.min.js'
          }
        },

        compress: {
          dist: {
            options: {
              archive: '<%= frank.dist %>/frank-<%= pkg.version %>.zip'
            },
            src: '<%= frank.dist %>/frank/**',
            dest: '<%= frank.dist %>'
          }
        },

        coffee: {
          compile: {
            src:  '<%= frank.coffeescripts %>/*.coffee',
            dest: '<%= frank.javascripts %>/frank.js'
          }
        },

        /**
         * This task requires Sass & Compass to be installed on your machine.
         *
         * - http://compass-style.org/install/
         * - http://sass-lang.com/download.html
         */
        sass: {
          compile: {
            options: {
              compass: true,
              style: 'expanded'
            },
            expand: true,
            flatten: true,
            cwd: '<%= frank.scss %>',
            src: ['*.scss', '!ie7.scss'],
            dest: '.',
            ext: '.css'
          }
        },

        svgo: {
          opt: {
            files: '<%= frank.images %>/*.svg'
          }
        },

        imagemin: {
          opt: {
            options: {
              optimizationLevel: 3
            },
            expand: true,
            cwd: '<%= frank.images %>/src',
            src: '*.{png,jpg,jpeg}',
            dest: '<%= frank.images %>'
          }
        },

        webp: {
          optPNG:{
            src: '<%= frank.images %>/*.png',
            dest: '<%= frank.images %>',
            options: {
                verbose: true,
                quality: 80,
                alphaQuality: 80,
                compressionMethod: 6,
                segments: 4,
                psnr: 42,
                sns: 50,
                filterStrength: 40,
                filterSharpness: 3,
                simpleFilter: true,
                partitionLimit: 50,
                analysisPass: 6,
                multiThreading: true,
                lowMemory: false,
                alphaMethod: 0,
                alphaFilter: 'best',
                alphaCleanup: true,
                noAlpha: false,
                lossless: true
              }
          },
          optJPG:{
            src: '<%= frank.images %>/*.{jpeg,jpg}',
            dest: '<%= frank.images %>',
            options: {
                preset: 'photo',
                verbose: true,
                quality: 70,
                alphaQuality: 80,
                compressionMethod: 6,
                segments: 4,
                psnr: 42,
                sns: 50,
                filterStrength: 40,
                filterSharpness: 3,
                simpleFilter: true,
                partitionLimit: 50,
                analysisPass: 6,
                multiThreading: true,
                lowMemory: false,
                alphaMethod: 0,
                alphaFilter: 'best',
                alphaCleanup: true,
                noAlpha: true,
                lossless: false
              }
          }
        },

        csso: {
          compress: {
            options: {
              report: 'gzip'
            },
            src: 'style.css',
            dest: 'style.min.css'
          },
          restructure: {
            options: {
              restructure: true,
              report: 'gzip'
            },
            src: 'style.css',
            dest: 'style.min.css'
          }
        },

        csslint: {
          test: {
            src: 'style.css'
          }
        },

        /**
         * Uses CSSCSS to analyse any redundancies in the CSS files.
         * - http://zmoazeni.github.io/csscss/
         * - $ gem install csscss
         */
        csscss: {
          test: {
            options: {
              verbose: true
            },
            src: ['editor-style.css', 'ie.css', 'print.css', 'style.css']
          }
        },

        watch: {
          sass: {
            files: '<%= frank.scss %>/*.scss',
            tasks: ['sass']
          },
          coffee: {
            files: '<%= frank.coffeescripts %>/*.coffee',
            tasks: ['coffee']
          }
        },

        markdown: {
          docs: {
            options: {
              gfm: true,
              highlight: 'manual',
              codeLines: {
                before: '<span>',
                after: '</span>'
              }
            },
            files: ['*.md'],
            dest: './',
          }
        },

        contributors: {
          docs: {
            path: 'CONTRIBUTORS.md',
            branch: 'master',
            chronologically: true
          }
        },

        phpcs: {
          test: {
            options: {
              bin: 'vendor/squizlabs/php_codesniffer/scripts/phpcs',
              standard: 'WordPress'
            },
            dir: './**.php'
          }
        }
    });

    // load all grunt tasks
    require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);
    grunt.loadNpmTasks('svgo-grunt');

    /**
     * Grunt tasks for development.
     */
    grunt.registerTask('default', ['coffee', 'sass']);

    /**
     * Grunt tasks that help improve code quality.
     */
    grunt.registerTask('test', ['default', 'phpcs', 'csscss', 'csslint', 'jshint']);

    /*
    * Grunt tasks which build a clean theme for deployment
    */
    grunt.registerTask('release', ['default', 'clean', 'copy:dist', 'compress']);
    grunt.registerTask('opt', ['copy:opt', 'svgo', 'imagemin', 'webp', 'uglify', 'sass', 'csso:restructure']);

    /*
    * Grunt tasks for documentation
    */
    grunt.registerTask('docs', ['contributors', 'markdown']);

};