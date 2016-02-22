define(['../module'], function (controllers) {
    'use strict';
    controllers.controller('controllers.test', ['$scope', '$rootScope', 'services.user',
        function ($scope, $rootScope, user) {
            $scope.type = 'event';
            $scope.project = $rootScope.currentProject;
         

            $scope.send = function () {
                user.gate($scope.type, $scope.name, $scope.email, $scope.project, $scope.data).then(function () {
                    $('#test-notify').fadeIn(200, function () {
                        setTimeout(function () {
                            $('#test-notify').fadeOut();
                        }, 2000);
                    });
                });
            }
        }]);
});
