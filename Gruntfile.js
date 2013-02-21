/*global module:false*/
'use strict';

/*
watch tasks (Compass & Coffee/SCSS files)
test tasks (CSS Linting, Coffee Lintint, JS Linting)
optimize tasks (JS, CSS, SVG, images)
deploy tasks (documentation, styleguide, contributors)
*/
module.exports = function(grunt) {

  grunt.initConfig({
    pkg: '<json:package.json>',
    watch: {
      files: [ 'frank/stylesheets/scss/*.scss', 'somerandomdude/stylesheets/scss/*.scss' ],
      tasks: [ 'compass:dev', 'compass:prod' ]
    },
    phpcs: {
      application: {
          dir: 'frank/partials'
      },
      options: {
          /*bin: 'vendor/bin/phpcs',
          standard: 'Zend'*/
      }
    },
    coffeelint: {
      app: ['frank/javascripts/coffeescripts/*.coffee', 'somerandomdude/javascripts/coffeescripts/*.coffee'],
      tests: {
        files: {
          src: ['tests/*.coffee']
        },
        options: {
          'no_trailing_whitespace': {
            'level': 'error'
          }
        }
      }
    },
    recess: {
      dist: {
          src: [
              'frank/style.css',
              'somerandomdude/style.css'
          ],
          options: {
            compile: false,
            compress: false,
            noIDs: false,
            noJSPrefix: true,
            noOverqualifying: true,
            noUnderscores: true,
            noUniversalSelectors: true,
            prefixWhitespace: true,
            strictPropertyOrder: true,
            stripColors: false,
            zeroUnits: true
          }
      }
    },
    compass: {
      dev: {
          src: 'frank/stylesheets/scss',
          dest: 'frank',
          linecomments: true,
          forcecompile: true,
          require: [
            'animate-sass',
            'mylib'
          ],
          debugsass: true,
          images: '/path/to/images',
          relativeassets: true
      },
      prod: {
          src: 'frank/stylesheets/scss',
          dest: 'assets/prod/css',
          outputstyle: 'compressed',
          linecomments: false,
          forcecompile: true,
          require: [
            'animate-sass',
            'mylib'
          ],
          debugsass: false,
          images: '/path/to/images',
          relativeassets: true
      }
    }
  });

  // Load tasks from NPM
  grunt.loadNpmTasks('grunt-compass');
  grunt.loadNpmTasks('grunt-recess');
  grunt.loadNpmTasks('grunt-coffee');
  grunt.loadNpmTasks('grunt-phpcs');

  // Default task.
  grunt.registerTask('default', 'phpcs');
};