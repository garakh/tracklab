/**
 * configure RequireJS
 * prefer named modules to long paths, especially for version mgt
 * or 3rd party libraries
 */
require.config({
    paths: {
        'angular': '../libs/angular/angular',
        'angular-route': '../libs/angular-route/angular-route',
        'chart': '../libs/Chart.js/Chart',
        'angular-chart': '../libs/angular-chart.js/angular-chart',
        'domReady': '../libs/requirejs-domready/domReady',
        'jquery': '../libs/jquery/dist/jquery',
        'tw-bootstrap': '../libs/bootstrap/dist/js/bootstrap',
        'jquery.slimscroll': '../libs/jquery.slimscroll/jquery.slimscroll',
    },
    /**
     * for libs that either do not support AMD out of the box, or
     * require some fine tuning to dependency mgt'
     */
    shim: {
        'angular': {
            exports: 'angular'
        },
//        'jquery.min': {
//            exports: 'jQuery'
//        },
        'angular-route': {
            deps: ['angular', 'chart']
        },
        'angular-chart': {
            deps: ['angular']
        },        
        'bootstrap': ['jquery'],
        'jquery.slimscroll': ['jquery'],
//        'angular-codemirror':['codemirror'],
//      'codemirror': ['codemirror']
//        'layout': ['metronic'],
//        'jquery-migrate.min':['jquery.min'],
//        'bootstrap-hover-dropdown.min':['jquery.min']
    },
    urlArgs: 'bust=v0.0.1',
//    waitSeconds: 50,
    deps: [
        // kick start application... see bootstrap.js
        './bootstrap'
    ]
});
