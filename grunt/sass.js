module.exports = {
    development: {
        options: {
            outputStyle: 'nested',
            //sourceMap: true,
            spawn: false
        },
        files: {
            'contao/system/themes/sb-admin/css/style.css': 'sass/style.scss'
        }
    },
    production: {
        options: {
            outputStyle: 'compressed',
            spawn: false
        },
        files: {
            'contao/system/themes/sb-admin/css/style.min.css': 'sass/style.scss',
        }
    }
};
