module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    banner: '/*!\n * <%= pkg.name %>\n * @author: <%= pkg.author %>\n * @date: <%= grunt.template.today("yyyy-mm-dd") %>\n */',
    usebanner: {
      production: {
        options: {
          position: 'top',
          banner: '<%= banner %>',
          linebreak: true
        },
        files: {
          src: [ 'js/all.min.js', 'css/style.css' ]
        }
      }
    },
    concat: {
      production: {
        src: [
          'vendor/jquery/jquery.js',
          'vendor/modernizr/modernizr.js',
          'js/plugins.js',
          'js/main.js',
        ],
        dest: 'js/all.js',
      }
    },
    uglify: {
      options: {
        report: 'min'
      },
      production: {
        src: 'js/all.js',
        dest: 'js/all.min.js'
      }
    },
    imagemin: {
      dynamic: {
        files: [{
          expand: true,
          cwd: 'img/',
          src: ['**/*.{png,jpg,gif}'],
          dest: 'img/'
        }]
      }
    },
    watch: {
      scripts: {
        files: ['js/*.js'],
        tasks: ['concat', 'uglify', 'notify:uglify'],
      },
      css: {
        files: ['css/*.less'],
        tasks: ['less:development', 'notify:less'],
      },
      livereload: {
        files: ['css/*.css'],
        options: { livereload: true }
      }
    },
    less: {
      development: {
        options: {
          paths: ["css"],
          // compress: false,
          dumpLineNumbers: 'comments'
        },
        files: {
          "css/style.css": "css/style.less"
        }
      },
      production: {
        options: {
          paths: ["css"],
          cleancss: true,
          keepSpecialComments: '0',
          report: 'min',
        },
        files: {
          "css/style.css": "css/style.less"
        }
      }
    },
    notify: {
      less: {
        options: {
          message: "LESS build ok"
        }
      },
      uglify: {
        options: {
          message: "Uglify build ok"
        }
      },
    },
  });

  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-imagemin');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-banner');
  grunt.loadNpmTasks('grunt-notify');

  // Default task(s).
  grunt.registerTask('default', ['watch']);
  grunt.registerTask('build', ['concat', 'uglify', 'less:production', 'usebanner', 'imagemin']);

};
