module.exports = function(grunt) {

    grunt.initConfig({

        coffee: {
          compile: {
            files: {
              'javascripts/defer-image-load.js': 'javascripts/coffeescripts/defer-image-load.coffee',
              'javascripts/frank.slideshow.js': 'javascripts/coffeescripts/frank.slideshow.coffee',
              'javascripts/simplebox.js': 'javascripts/coffeescripts/simplebox.coffee'
            }
          }
        },

        /**
         * This task requires Sass & Compass to be installed on your machine.
         *
         * - http://compass-style.org/install/
         * - http://sass-lang.com/download.html
         */
        sass: {
          dev: {
            options: {
                compass: true,
                style: 'expanded'
            },
            files: {
                'style.css': 'stylesheets/scss/style.scss',
                'ie.css': 'stylesheets/scss/ie.scss',
                'editor-style.css': 'stylesheets/scss/editor-style.scss',
                'print.css': 'stylesheets/scss/print.scss',
            }
          }
        },

        svgo: {
            optimize: {
                files: 'images/*.svg'
            }
        },
        webp: {
          foo:{
            src: ['images/*.jpg', 'images/*.png'],
            dest: 'webp/',
            options: {
                preset: 'photo',
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
              'style.min2.css': ['style.min.css']
            }
          },
          restructure: {
            options: {
              restructure: true,
              report: 'gzip'
            },
            files: {
              'style.min3.css': ['style.min2.css']
            }
          }
        },

        watch: {
            sass: {
                files: 'stylesheets/**/*.scss',
                tasks: ['sass:dev']
            },
            coffee: {
                files: 'javascripts/**/*.coffee',
                tasks: ['coffee:compile']
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-coffee');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('svgo-grunt');
    grunt.loadNpmTasks('grunt-csso');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-webp');

    grunt.registerTask('default', ['coffee', 'sass:dev', 'svgo', /*'csso'*/, 'webp']);

};
