/**
 * Defines the main routes in the application.
 * The routes you see here will be anchors '#/' unless specifically configured otherwise.
 */

define(['./app'], function (app) {
    'use strict';
    return app.config(['$routeProvider', '$locationProvider', function ($routeProvider, $locationProvider) {
        $locationProvider.html5Mode(true);

        $routeProvider.when('/', {
            templateUrl: 'js/controllers/dashboard/template.html',
            controller: 'controllers.dashboard'
        });

        $routeProvider.when('/test', {
            templateUrl: 'js/controllers/test/template.html',
            controller: 'controllers.test'
        });

        $routeProvider.when('/trigger', {
            templateUrl: 'js/controllers/trigger/template.html',
            controller: 'controllers.trigger'
        });
        $routeProvider.when('/trigger/event', {
            templateUrl: 'js/controllers/trigger/templateEvent.html',
            controller: 'controllers.trigger'
        });
        $routeProvider.when('/trigger/people', {
            templateUrl: 'js/controllers/trigger/templatePeople.html',
            controller: 'controllers.trigger'
        });
        $routeProvider.when('/trigger/event/show/:triggerId', {
            templateUrl: 'js/controllers/trigger.manage/templateShowEvent.html',
            controller: 'controllers.trigger.manage'
        });
        $routeProvider.when('/trigger/people/show/:triggerId', {
            templateUrl: 'js/controllers/trigger.manage/templateShowPeople.html',
            controller: 'controllers.trigger.manage'
        });

        $routeProvider.when('/trigger/event/add', {
            templateUrl: 'js/controllers/trigger.manage/templateAddEditEvent.html',
            controller: 'controllers.trigger.manage'
        });
        $routeProvider.when('/trigger/event/edit/:triggerId', {
            templateUrl: 'js/controllers/trigger.manage/templateAddEditEvent.html',
            controller: 'controllers.trigger.manage'
        });
        $routeProvider.when('/trigger/people/add', {
            templateUrl: 'js/controllers/trigger.manage/templateAddEditPeople.html',
            controller: 'controllers.trigger.manage'
        });
        $routeProvider.when('/trigger/people/edit/:triggerId', {
            templateUrl: 'js/controllers/trigger.manage/templateAddEditPeople.html',
            controller: 'controllers.trigger.manage'
        });

        $routeProvider.when('/data/event', {
            templateUrl: 'js/controllers/data/template.html',
            controller: 'controllers.data'
        });

        $routeProvider.when('/data/people', {
            templateUrl: 'js/controllers/data/template.html',
            controller: 'controllers.data'
        });
        $routeProvider.when('/report', {
            templateUrl: 'js/controllers/report/template.html',
            controller: 'controllers.report'
        });
        $routeProvider.otherwise({
            redirectTo: '/'
        });
    }]);
});
