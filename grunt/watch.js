module.exports = {
    sass: {
        files: [
            'sass/**/*.scss',
            'components/**/*.scss'
        ],
        tasks: [
            'sass:development',
            'sass:production',
            'notify:watchScss'
        ]
    },
    js: {
        files: [
            'js/components/**/*.js'
        ],
        tasks: [
            'newer:concat:jquery',
            'newer:concat:mootools',
            'newer:concat:morris'
        ]
    },
    grunt: {
        files: [
            'grunt/*',
            'Gruntfile.js'
        ]
    }
};