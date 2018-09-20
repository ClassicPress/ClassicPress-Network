module.exports = function(grunt){


	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		concat: {
			dist: {
				src: [
					'header_builder/js/components/config.js',
					'header_builder/js/components/presets.js',
					'header_builder/js/vendor/disableScroll.js',
					'header_builder/js/vendor/sortable.js',
					'header_builder/js/main.js',
					'header_builder/js/components/builder.js',
					'header_builder/js/views/add_preset_view.js',
					'header_builder/js/views/preset_view.js',
					'header_builder/js/views/presets_view.js',
					'header_builder/js/components/sortable.js',
					'header_builder/js/components/helper.js',
					'header_builder/js/models/Element.js',
					'header_builder/js/models/Preset.js',
					'header_builder/js/models/Setting.js',
					'header_builder/js/collections/Elements.js',
					'header_builder/js/collections/SettingCollection.js',
					'header_builder/js/views/element_view.js',
					'header_builder/js/views/app.js',
					'header_builder/js/views/settings_view.js',
				],
				dest: 'header_builder/js_pub/uncompresed.js',
			}
		},
		uglify: {
			build: {
				src: 'header_builder/js_pub/uncompresed.js',
				dest: 'header_builder/js_pub/compresed.min.js'
			}
		},
		less: {
			development: {
			},
			production: {
				options: {
					compress: true,
					yuicompress: true,
					optimization: 2
				},
				files: {
					'header_builder/css/main.css': 'header_builder/less/main.less',
					'frontend/css/header-styles.css': 'frontend/less/header-styles.less',
				}
			},
		},
		watch: {
			scripts: {
				files: [
					'header_builder/js/*.js',
					'header_builder/js/*/*.js',
					'header_builder/less/*.less',
					'header_builder/less/*/*.less',
					'header_builder/less/*/*/*.less',
					'header_builder/less/*/*/*/*.less',
					'frontend/less/*.less',
					'frontend/less/*/*.less',
				],
				tasks: [
					'concat',
					'uglify',
					'less',
				],
				options: {
					spawn: false,
				},
			}
		}

	});

	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.registerTask('default', [
		'concat',
		'uglify',
		'less'
	]);

};