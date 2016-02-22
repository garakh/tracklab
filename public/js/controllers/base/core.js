define(['../module'], function (controllers) {
    'use strict';
    controllers.controller('controllers.base',
            ['$scope', '$rootScope', '$timeout', 'services.layout',
                '$location', 'services.user', 'services.frontendLayout',
                function ($scope, $rootScope, $timeout, Layout, $location, user, frontendLayout) {

                    $rootScope.loadingPage = true;
                    $rootScope.currentProject = localStorage.getItem("projectCode");
                    if (!$rootScope.currentProject)
                        $rootScope.currentProject = 'demo';
                    $scope.triggers = {};

                    $scope.$on('$routeChangeSuccess', function () {
                        $scope.route = $location.path();
                    });
                    Layout.initSidebar(); // init sidebar
                    $timeout(function () {
                        frontendLayout.initScrollers(); // init slim scrollers
                    })


                    user.getProjects().then(function (response) {
                        $scope.project = response;
                        updateMenu();
                    });



                    var updateMenu = function () {
                        //update
                        $rootScope.currentProject = localStorage.getItem("projectCode");
                        if (!$rootScope.currentProject)
                            $rootScope.currentProject = 'demo';


                        $scope.projects_menu = [];
                        angular.forEach($scope.project, function (el) {
                            $scope.projects_menu.push({text: el.name, code: el.code});
                        })


                        $scope.menu = [
                            {text: 'About', href: '/', icon: 'icon-home'},
                            {text: 'Triggers', icon: 'icon-energy',
                                submenu: [
                                    {text: 'Events', href: '/trigger/event', icon: 'icon-energy'},
                                    {text: 'People', href: '/trigger/people', icon: 'icon-energy'},
                                ]},
                            {text: 'Query', icon: 'icon-grid',
                                submenu: [
                                    {text: 'Events', href: '/data/event', icon: 'icon-grid'},
                                    {text: 'People', href: '/data/people', icon: 'icon-grid'},
                                ]},
                            {text: 'Reports', href: '/report', icon: 'icon-graph'},
                            {text: 'Test', href: '/test', icon: 'icon-paper-plane'}
                        ]

                    }

                    $scope.changeProject = function (item) {
                        $rootScope.currentProject = item.code;
                        localStorage.setItem("projectCode", item.code);
                        $rootScope.$broadcast('project.change');
                        updateMenu();
                    }

                    $timeout(function () {
                        $rootScope.loadingPage = false;

                    }, 1000)

                }]);
});
