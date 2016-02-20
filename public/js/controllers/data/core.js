define(['../module'], function (controllers) {
    'use strict';
    controllers.controller('controllers.data',
            ['$scope', '$rootScope', '$location', 'services.user',
                function ($scope, $rootScope, $location, user) {
                    $scope.columns = [];
                    $scope.items = [];
                    $scope.query = '';
                    $scope.sort = '';
                    $scope.limit = 100;
                    var type = 'query';

                    var page = $location.path().split('/')[2];

                    var load = function () {

                        if (page == 'event') {
                            user.queryEvents($rootScope.currentProject, type, $scope.query, $scope.sort, $scope.limit).then(function (data) {
                                $scope.columns = data.columns;
                                $scope.items = data.items;
                            });

                        } else {

                        }
                    }



                    $scope.runQuery = function () {
                        type = 'query';
                        load();
                    }

                    $scope.runAggregate = function () {
                        type = 'aggregate';
                        load();
                    }

                }]);
});
