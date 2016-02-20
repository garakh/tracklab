define(['./module'], function (services) {
    'use strict';
    /**
     * Сервис по работе с пользователями
     */
    services.factory('services.common', ['$rootScope', function ($rootScope) {
        return {
            showLoadingPage:function() {
               $rootScope.loadingPage = true;
            },
            hideLoadingPage:function() {
                $rootScope.loadingPage = false;
            },
        }
    }]);
});
