// Normally, I would split this into more files. For the purposes of the example,
// I’ll keep it as one file for now.

;(function (angular, undefined) {
    angular.module('todoApp', ['ngRoute', 'todoAppServices', 'todoAppControllers']);

    angular.module('todoApp').config([
        '$routeProvider',
        function ($routeProvider) {
            $routeProvider
                .when('/users', {
                    'templateUrl':  '/templates/users',
                    'controller':   'UserController',
                    'controllerAs': 'userList'
                })
                .when('/users/create', {
                    'templateUrl':  '/templates/users/create',
                    'controller':   'CreateUserController',
                    'controllerAs': 'createUser'
                })
                .when('/tasks', {
                    'templateUrl':  '/templates/tasks',
                    'controller':   'TodoListController',
                    'controllerAs': 'todoList'
                })
                .when('/tasks/create', {
                    'templateUrl':  '/templates/tasks/create',
                    'controller':   'CreateTaskController',
                    'controllerAs': 'createTask'
                })
                .otherwise({
                    'redirectTo': '/tasks'
                });
        }
    ]);

}(window.angular));
