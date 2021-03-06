;(function (angular, undefined) {
    angular.module('todoAppServices', []);

    function UserService($http) {
        var uri = '/api/users';

        return {
            'all':      function () {
                return $http.get(uri);
            },
            'create':   function (data) {
                return $http.post(uri, data);
            },
            'get':      function (id) {
                return $http.get([uri, id].join('/'));
            },
            'getTasks': function (id) {
                return $http.get([uri, id, 'tasks'].join('/'));
            },
            'delete':   function (user) {
                return $http.delete([uri, user.id].join('/'));
            }
        };
    }

    UserService.$inject = ['$http'];
    angular.module('todoAppServices').factory('userService', UserService);

    function TaskService($http, users) {
        var uri = '/api/tasks';

        return {
            'all':       function (extra) {
                var path = uri;
                if (extra) {
                    path += '?with=' + extra.join(',');
                }

                return $http.get(path);
            },
            'allByUser': function (user) {
                var id = user;
                if (user.id) {
                    id = user.id;
                }

                return users.getTasks(id);
            },
            'create':    function (data) {
                return $http.post(uri, data);
            },
            'get':       function (id) {
                return $http.get([uri, id].join('/'));
            },
            'complete':  function (task) {
                return $http.put([uri, task.id, 'complete'].join('/'));
            },
            'delete':    function (task) {
                return $http.delete([uri, task.id].join('/'));
            }
        };
    }

    TaskService.$inject = ['$http', 'userService'];
    angular.module('todoAppServices').factory('taskService', TaskService);

    function CurrentUserService($rootScope, users) {
        var currentUser = null;

        $rootScope.showSidebar = false;

        return {
            'get':    function () {
                return currentUser;
            },
            'update': function (id) {
                return users.get(id).then(function (response) {
                    currentUser = response.data;
                    $rootScope.showSidebar = true;
                    $rootScope.$broadcast('sidebar.loadTasks');
                }, function () {
                    currentUser = null;
                    $rootScope.showSidebar = false;
                });
            },
            'clear':  function () {
                currentUser = null;
                $rootScope.showSidebar = false;
            }
        };
    }

    CurrentUserService.$inject = ['$rootScope', 'userService'];
    angular.module('todoAppServices').factory('currentUserService', CurrentUserService);
}(window.angular));
