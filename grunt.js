/*global module:false*/
'use strict';

module.exports = function(grunt) {

  grunt.initConfig({
    pkg: '<json:package.json>',

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
    }
  });

  // Load tasks from NPM
  grunt.loadNpmTasks('grunt-recess');

  // Default task.
  grunt.registerTask('default', 'recess');
};
