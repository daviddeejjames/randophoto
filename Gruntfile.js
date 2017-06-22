module.exports = function(grunt) {
	
	// COnfigure main project settings
	grunt.initConfig({

		// Basic settings and info about our plugins
		pkg: grunt.file.readJSON("package.json"),

		clean: {
					
			clean_generated_favicons: {
				src: ["dist/favicons"] // generally a good idea to have this run before generating new favicons
			}
			
		}, // remove

		realFavicon: {
			favicons: {
				src: './images/favicon.png',
				dest: 'dist/favicons',
				options: {
					iconsPath: '/', // TODO: need to replace this in the generated browserconfig.xml & manifest.json
					html: [ 'dist/favicons/favicons-html.php' ],
					design: {
						ios: {
							pictureAspect: 'backgroundAndMargin',
							backgroundColor: '#ffffff',
							margin: '18%',
							assets: {
								ios6AndPriorIcons: false, // optional: set true for more icons
								ios7AndLaterIcons: false, // optional: set true for more icons
								precomposedIcons: false, // optional: set true for more icons
								declareOnlyDefaultIcon: true // leave this true
							}
						},
						desktopBrowser: {},
						windows: {
							pictureAspect: 'whiteSilhouette',
							backgroundColor: '#ffc40d', // note that this is a Windows Metro approved colour (yellow)
							onConflict: 'override',
							assets: {
								windows80Ie10Tile: false, // optional: set true for more icons
								windows10Ie11EdgeTiles: {
									small: false, // optional: set true for more icons
									medium: true, // leave this true
									big: false, // optional: set true for more icons,
									rectangle: false // optional: set true for more icons
								}
							}
						},
						androidChrome: {
							pictureAspect: 'shadow',
							themeColor: '#ee6241', // TODO: need to replace this in the generated manifest.json?
							manifest: {
								name: 'a site by Chromatix', // TODO: set to site name
								display: 'standalone',
								orientation: 'notSet',
								onConflict: 'override',
								declared: true
							},
							assets: {
								legacyIcon: false, // optional: set true for more icons
								lowResolutionIcons: false // optional: set true for more icons
							}
						},
						safariPinnedTab: {
							pictureAspect: 'silhouette',
							//themeColor: '#5bbad5'
						}
					},
					settings: {
						compression: 5,
						scalingAlgorithm: 'Mitchell',
						errorOnImageTooSmall: false
					},
					versioning: {
						paramName: 'v',
						paramValue: '1.0' // this is replaced by inc/header.php; TODO: need to replace in the generated browserconfig.xml & manifest.json
					}
				}
			}
		} // realFavicon
	});

	// Load plugin
	grunt.loadNpmTasks('grunt-modernizr');
	grunt.loadNpmTasks("grunt-contrib-clean"); // grunt clean
	grunt.loadNpmTasks('grunt-real-favicon'); // favicon generator

	// Run the plugin as a task
	grunt.registerTask("custom_modernizr",["modernizr:dist"]);
	grunt.registerTask("favicons", ["clean:clean_generated_favicons", "realFavicon"]);

};