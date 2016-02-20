define(['../module'], function (controllers) {
    'use strict';
    controllers.controller('controllers.trigger',
            ['$scope', '$rootScope', '$location', 'services.user',
                function ($scope, $rootScope, $location, user) {
                    $scope.triggers = [];
                    var page = $location.path().split('/')[2];

                    var load = function () {

                        if (page == 'event') {

                            user.getEventTriggers($rootScope.currentProject).then(function (result) {
                                $scope.triggers = result;
                            });
                        } else {
                            user.getPeopleTriggers($rootScope.currentProject).then(function (result) {
                                $scope.triggers = result;
                            });
                        }
                    }

                    $scope.deleteEvent = function (id) {
                        user.deleteEventTrigger({id: id}).then(function () {
                            load();
                        })
                    }
                    $scope.deletePeople = function (id) {
                        user.deletePeopleTrigger({id: id}).then(function () {
                            load();
                        })
                    }

                    $scope.$on('project.change', function () {
                        load();
                    });

                    load();
                }]);
});
