define(['../module'], function (controllers) {
    'use strict';
    controllers.controller('controllers.base',
            ['$scope', '$rootScope', '$timeout', 'services.layout',
                '$location', 'services.user', 'services.frontendLayout',
                function ($scope, $rootScope, $timeout, Layout, $location, user, frontendLayout) {
                    
                    $rootScope.loadingPage = true;
                    $rootScope.currentProject = localStorage.getItem("projectCode");
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



                        $scope.projects_menu = [];
                        angular.forEach($scope.project, function (el) {
                            $scope.projects_menu.push({text: el.name, code: el.code});
                        })


                        $scope.menu = [
                            {text: 'Dashboard', href: '/', icon: 'icon-home'},
                            {text: 'Event triggers', href: '/trigger/event', icon: 'icon-home'},
                            {text: 'People triggers', href: '/trigger/people', icon: 'icon-home'},
                            {text: 'Event data', href: '/data/event', icon: 'icon-home'},
                            {text: 'Test', href: '/test', icon: 'icon-home'}
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
