define(['./module', "jquery"], function (services, $) {
    'use strict';
    services.factory('services.api', ['$http', '$q', 'services.common', function ($http, $q, common) {
        return {
            get: function ( url, dataToSent, progressBar) {
                return this._send("GET", url, dataToSent, progressBar)
            },
            post: function ( url, dataToSent, progressBar) {
                return this._send("POST", url, dataToSent, progressBar)
            },

            _send: function (method, url, dataToSent, progressBar) {
                if (progressBar == null || progressBar) common.showLoadingPage();
                return $http({method:method, url:url, data:dataToSent}).then(function(result){
                    
                    common.hideLoadingPage();
                    
                    return result.data.response;
                }, function(result) {
                    
                    
                    common.hideLoadingPage();
                    return result.data;
                    //ns.error(response.statusText);
                });
            }
        }
    }]);
});