define(['./module', "jquery"], function (services, $) {
    'use strict';
    services.factory('services.user', ['services.api', function (api) {
            return {
                getProjects: function () {
                    return api.post('/user/get');
                },
                /** ------ **/
                //** Events **/
                getEventTriggers: function (project) {
                    return api.post('/trigger/getEvents', {project: project});
                },
                addEventTrigger: function (data) {
                    return api.post('/trigger/addEvent', data);
                },
                getEventTrigger: function (data) {
                    return api.post('/trigger/getEvent', data);
                },
                editEventTrigger: function (data) {
                    return api.post('/trigger/editEvent', data);
                },
                deleteEventTrigger: function (data) {
                    return api.post('/trigger/deleteEvent', data);
                },
                /** ------ **/
                //** People **/
                getPeopleTriggers: function (project) {
                    return api.post('/trigger/getPeoples', {project: project});
                },
                addPeopleTrigger: function (data) {
                    return api.post('/trigger/addPeople', data);
                },
                getPeopleTrigger: function (data) {
                    return api.post('/trigger/getPeople', data);
                },
                editPeopleTrigger: function (data) {
                    return api.post('/trigger/editPeople', data);
                },
                deletePeopleTrigger: function (data) {
                    return api.post('/trigger/deletePeople', data);
                },
                /** ------ **/
                //** Query **/
                queryEvents: function (project, type, query, sort, limit) {
                    return api.post('/query/queryEvents', {project: project, type: type, query: query, sort: sort, limit: limit});
                },
                queryPeople: function (project, type, query, sort, limit) {
                    return api.post('/query/queryPeople', {project: project, type: type, query: query, sort: sort, limit: limit});
                },                
                /** ------ **/
                //** Misc **/ 
                gate: function (type, name, email, project, json) {
                    return api.post('/gate/', {type: type, name: name, email: email, project: project, data: json});
                }
            }
        }]);
});