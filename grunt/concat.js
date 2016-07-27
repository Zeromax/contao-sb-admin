module.exports = {
    options: {
        spawn: false
    },
    jquery: {
        src: [
            "./components/jquery/js/jquery.min.js",
            "./components/bootstrap/js/bootstrap.min.js",
            "./components/metisMenu/js/metisMenu.min.js",
            "./js/components/j_custom.js"
        ],
        dest: './contao/system/themes/sb-admin/js/jquery.js',
        nonull: true
    },
    mootools: {
        src: [
            './js/components/contao/core-uncompressed.js',
            './js/components/m_custom.js'
        ],
        dest: './contao/system/themes/sb-admin/js/mootools.js',
        nonull: true
    },
    morris: {
        src: [
            './components/morris/raphael.min.js',
            './components/morris/morris.min.js',
            './js/components/j_log_chart.js'
        ],
        dest: './contao/system/themes/sb-admin/js/morris.js',
        nonull: true
    }
};
