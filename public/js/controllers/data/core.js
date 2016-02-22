define(['../module'], function (controllers) {
    'use strict';
    controllers.controller('controllers.data',
            ['$scope', '$rootScope', '$location', 'services.user',
                function ($scope, $rootScope, $location, user) {
                    $scope.columns = [];
                    $scope.items = [];
                    $scope.limit = 100;
                    var type = 'query';
                    var cmQuery, cmSort;

                    var page = $location.path().split('/')[2];

                    var load = function () {

                        if (page == 'event') {
                            user.queryEvents($rootScope.currentProject, type, cmQuery.getValue(), cmSort.getValue(), $scope.limit).then(function (data) {
                                $scope.columns = data.columns;
                                $scope.items = data.items;
                            });

                        } else {
                            user.queryPeople($rootScope.currentProject, type, cmQuery.getValue(), cmSort.getValue(), $scope.limit).then(function (data) {
                                $scope.columns = data.columns;
                                $scope.items = data.items;
                            });
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

                    setTimeout(function () {
                        cmQuery = CodeMirror.fromTextArea(document.getElementById("query"), {
                            lineNumbers: true,
                            mode: "javascript"
                        });

                        cmSort = CodeMirror.fromTextArea(document.getElementById("sort"), {
                            lineNumbers: true,
                            mode: "javascript"
                        });
                    }, 10);

                }]);
});
