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
                    'controllerAs': 'userList',
                    'resolve': ['$rootScope', function ($rootScope) {
                        $rootScope.pageTitle = 'Users';
                    }]
                })
                .when('/users/create', {
                    'templateUrl':  '/templates/users/create',
                    'controller':   'CreateUserController',
                    'controllerAs': 'createUser',
                    'resolve': ['$rootScope', function ($rootScope) {
                        $rootScope.pageTitle = 'Create User';
                    }]
                })
                .when('/tasks', {
                    'templateUrl':  '/templates/tasks',
                    'controller':   'TodoListController',
                    'controllerAs': 'todoList',
                    'resolve': ['$rootScope', function ($rootScope) {
                        $rootScope.pageTitle = 'Tasks';
                    }]
                })
                .when('/tasks/create', {
                    'templateUrl':  '/templates/tasks/create',
                    'controller':   'CreateTaskController',
                    'controllerAs': 'createTask',
                    'resolve': ['$rootScope', function ($rootScope) {
                        $rootScope.pageTitle = 'Create Task';
                    }]
                })
                .otherwise({
                    'redirectTo': '/tasks'
                });
        }
    ]);

}(window.angular));
