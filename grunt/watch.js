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
    grunt: {
        files: [
            'grunt/*',
            'Gruntfile.js'
        ]
    }
};