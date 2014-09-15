/**
 * Theme gruntfile.
 */
'use strict';

module.exports = function(grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		sass: {
			dist: {
				files: [{
					expand: true,
					cwd: 'sass',
					src: ['*.scss'],
					dest: 'css',
					ext: '.css'
				}],
				options: {
	        loadPath: require('node-neat').includePaths
	      }
			}
		},
		watch: {
			sass: {
				files: ['sass/{,*/}*.scss'],
				tasks: ['sass']
			}
		},
		livereload: {
      options: {
        livereload: true
      },
      files: ['css/{,*/}*.css']
    }
	});

	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');

	/**
	 * Grunt build taks.
	 */
	grunt.registerTask('build', [
		'sass'
	]);

	/**
	 * Grunt default task.
	 */
	grunt.registerTask('default', [
		'sass',
		'watch'
	]);
}