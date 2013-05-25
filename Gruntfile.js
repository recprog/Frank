module.exports = function(grunt) {

    // configurable paths
    var frankConfig = {
        javascripts: 'javascripts',
        coffeescripts: 'javascripts/coffeescripts',
        stylesheets: 'stylesheets',
        scss: 'stylesheets/scss'
    };

    grunt.initConfig({
        frank: frankConfig,
        clean: {
          dist: ['frank']
        },
        copy: {
          opt: {
            'images/src/*.svg' : 'images'  //svgo doesn't support dest:src optimization, so we copy SVG files over manually
          },
          dist: {
            files: {
              'frank/': ['./**',  '!./images/src/**', '!./node_modules/**', '!./stylesheets/**', '!./javascripts/coffeescripts/**', '!./docs/**',  '!./.git/**', '!./Gruntfile.js', '!./package.json', '!./config.rb', '!./*.md']
            }
          }
        },
        jshint: {
          files: ['javascripts/frank.js']
        },
        uglify: {
          dist: {
            files: {
              'javascripts/frank.js': ['javascripts/frank.js']
            }
          }
        },
        compress: {
          dist: {
            options: {
              archive: '../frank-dist.zip'
            },
            files: [
              {src: './frank/**', dest: './../'}
            ]
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
            optimize: {
              files: 'images/*.svg'
            }
        },
        imagemin: {
          dist: {
            options: {
              optimizationLevel: 3
            },
            files: [{
                    expand: true,
                    cwd: 'images/src',
                    src: '*.{png,jpg,jpeg}',
                    dest: 'images'
                }]
          }
        },
        webp: {
          optPNG:{
            src: ['images/*.png'],
            dest: 'images',
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
            src: ['images/*.jpeg', 'images/*.jpg'],
            dest: 'images',
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
            files: {
              'style.min.css': ['style.css']
            }
          },
          restructure: {
            options: {
              restructure: true,
              report: 'gzip'
            },
            files: {
              'style.min.css': ['style.css']
            }
          }
        },
        csslint: {
          files: {
            src: ['style.css']
          }
        },
        /**
         * Uses CSSCSS to analyse any redundancies in the CSS files.
         * - http://zmoazeni.github.io/csscss/
         * - $ gem install csscss
         */
        csscss: {
          options: {
            verbose: true
          },
          files: {
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
            files: ['*.md'],
            dest: './',
            options: {
              gfm: true,
              highlight: 'manual',
              codeLines: {
                before: '<span>',
                after: '</span>'
              }
            }
          }
        },
        contributors: {
          master: {
            path: 'CONTRIBUTORS.md',
            branch: 'master',
            chronologically: true
          }
        },
        phpcs: {
          application: {
              dir: './**.php'
          },
          options: {
              bin: 'vendor/squizlabs/php_codesniffer/scripts/phpcs',
              standard: 'WordPress'
          }
        }
    });

    // load all grunt tasks
    require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);
    grunt.loadNpmTasks('svgo-grunt');

    /**
     * Grunt tasks for development.
     */
    grunt.registerTask('default', ['coffee', 'sass', 'watch']);

    /**
     * Grunt tasks that help improve code quality.
     */
    grunt.registerTask('test', ['phpcs', 'sass', 'csscss', 'csslint', 'coffee', 'jshint']);

    /*
    * Grunt tasks which build a clean theme for deployment
    */
    grunt.registerTask('dist', ['clean:dist', 'copy:dist', 'compress:dist', 'clean:dist']);
    grunt.registerTask('opt', ['copy:opt', 'svgo', 'imagemin', 'webp:optPNG', 'webp:optJPG', 'uglify:dist', 'sass', 'csso:restructure']);
    grunt.registerTask('docs', ['contributors', 'markdown']);

};