module.exports = function (grunt) {

    var path = require('path');

    require('load-grunt-config')(grunt, {
        configPath: path.join(process.cwd(), 'grunt'),
        data: {
            // import package.json
            pkg: grunt.file.readJSON('./package.json')
        }
    });

    // This module will read the dependencies/devDependencies/peerDependencies/optionalDependencies in your package.json and load grunt tasks that match the provided patterns.
    require('load-grunt-tasks')(grunt);

    grunt.registerTask('default', [
        'sass:development',
        'sass:production',
    ]);
};