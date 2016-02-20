define(['../module'], function (controllers) {
    'use strict';
    controllers.controller('controllers.trigger.manage',
            ['$scope', '$rootScope', '$routeParams', '$location', 'services.user',
                function ($scope, $rootScope, $routeParams, $location, user) {
                    $scope.triggerId = $routeParams.triggerId;
                    $scope.page = $location.path().split('/')[2];



                    $scope.triggers = [];
                    $scope.name = null;
                    $scope.handler = null;


                    if ($scope.triggerId && $scope.page == "event") {
                        user.getEventTrigger({id: $scope.triggerId}).then(function (data) {
                            $scope.name = data.name;
                            $scope.trigger = data.trigger;
                            $scope.handler = data.handler;
                            $scope.data = data.data;
                        });
                    }
                    if ($scope.triggerId && $scope.page == "people") {
                        user.getPeopleTrigger({id: $scope.triggerId}).then(function (data) {
                            $scope.name = data.name;
                            $scope.trigger = data.trigger;
                            $scope.handler = data.handler;
                            $scope.data = data.data;
                        });
                    }

                    $scope.addEvent = function () {
                        var data = {
                            name: $scope.name,
                            trigger: $scope.trigger,
                            handler: $scope.handler,
                            data: $scope.data,
                            project: $rootScope.currentProject
                        }
                        user.addEventTrigger(data).then(function () {
                            $location.path("/trigger/event");
                        })
                    }
                    $scope.addPeople = function () {
                        var data = {
                            name: $scope.name,
                            trigger: $scope.trigger,
                            handler: $scope.handler,
                            data: $scope.data,
                            project: $rootScope.currentProject
                        }
                        user.addPeopleTrigger(data).then(function () {
                            $location.path("/trigger/people");
                        })
                    }
                    $scope.editEvent = function () {
                        var data = {
                            id: $scope.triggerId,
                            name: $scope.name,
                            trigger: $scope.trigger,
                            handler: $scope.handler,
                            data: $scope.data,
                            project: $rootScope.currentProject
                        }
                        user.editEventTrigger(data).then(function () {
                            $location.path("/trigger/event");
                        })
                    }
                    $scope.editPeople = function () {
                        var data = {
                            id: $scope.triggerId,
                            name: $scope.name,
                            trigger: $scope.trigger,
                            handler: $scope.handler,
                            data: $scope.data,
                            project: $rootScope.currentProject
                        }
                        user.editPeopleTrigger(data).then(function () {
                            $location.path("/trigger/people");
                        });
                    }

                }]);
});
