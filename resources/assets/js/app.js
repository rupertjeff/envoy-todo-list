// Normally, I would split this into more files. For the purposes of the example,
// I’ll keep it as one file for now.

;(function (angular, undefined) {
    angular.module('todoApp', []);

    function UserService($http) {
        var uri = '/users';

        return {
            'all':      function () {
                return $http.get(uri);
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
    angular.module('todoApp').factory('userService', UserService);

    function TaskService($http, users) {
        var uri = '/tasks';

        return {
            'all':       function () {
                return $http.get(uri);
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
            'delete':    function (task) {
                return $http.delete([uri, task.id].join('/'));
            }
        };
    }

    TaskService.$inject = ['$http', 'userService'];
    angular.module('todoApp').factory('taskService', TaskService);

    function CurrentUserService(users) {
        var currentUser = null;

        return {
            'get':    function () {
                return currentUser;
            },
            'update': function (id) {
                users.get(id).then(function (response) {
                    currentUser = response.data;
                });
            }
        };
    }

    CurrentUserService.$inject = ['userService'];
    angular.module('todoApp').factory('currentUserService', CurrentUserService);

    function TodoListController($scope, tasks, currentUser) {
        var self = this;

        function updateTaskList() {
            var user = currentUser.get();
            if (null === user) {
                tasks.all().then(function (response) {
                    self.tasks = response.data;
                });
            } else {
                tasks.allByUser(user).then(function (response) {
                    self.tasks = response.data;
                });
            }
        }

        $scope.$on('tasksUpdated', updateTaskList);
        updateTaskList();
    }

    TodoListController.$inject = ['$scope', 'taskService', 'currentUserService'];
    angular.module('todoApp').controller('TodoListController', TodoListController);

    function CreateTaskController($rootScope, tasks, users) {
        this.showForm = false;
        this.task     = {};

        users.all().then(function (response) {
            self.users = response.data;
        });

        this.toggleForm = function () {
            this.showForm = !this.showForm;
        };

        this.save = function () {
            tasks.create(this.task);
            $rootScope.$broadcast('tasksUpdated');
            this.resetTask();
            this.toggleForm();
        };

        this.cancel = function () {
            this.resetTask();
            this.toggleForm();
        };

        this.resetTask = function () {
            this.task = {
                'name':        '',
                'description': '',
                'userId':      0
            };
        };

        this.resetTask();
    }

    CreateTaskController.$inject = ['$rootScope', 'taskService', 'userService'];
    angular.module('todoApp').controller('CreateTaskController', CreateTaskController);
}(window.angular));
