define(['../module'], function (controllers) {
    'use strict';
    controllers.controller('controllers.project', ['$scope', '$rootScope', '$routeParams',
        function ($scope, $rootScope, $routeParams) {
        $scope.projectName = $routeParams.name;

        localStorage.setItem("projectCode", $scope.projectName);
        $rootScope.$broadcast('updateMenu');
    }]);
});
