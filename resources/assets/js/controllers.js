/**
 * Name: controllers.js
 * Description:
 * Version: 0.0.1
 * Author: jeffr
 * Created: 2016-03-17
 * Last Modified: 2016-03-17
 */
;(function (angular, undefined) {
    angular.module('todoAppControllers', ['todoAppServices']);

    function TodoListController($scope, tasks, currentUser) {
        var self = this;

        function completeTask(task) {
            tasks.complete(task).then(function () {
                updateTaskList();
            });
        }
        this.completeTask = completeTask;

        function deleteTask(task) {
            tasks.delete(task).then(function () {
                updateTaskList();
            });
        }
        this.deleteTask = deleteTask;

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
    angular.module('todoAppControllers').controller('TodoListController', TodoListController);

    function CreateTaskController($location, tasks, users) {
        var self = this;

        users.all().then(function (response) {
            self.users = response.data;
        });

        this.save = function (task) {
            task.user_id = task.user.id;
            tasks.create(task).then(function () {
                self.redirect();
            });
        };

        this.cancel = function () {
            this.redirect();
        };

        this.redirect = function () {
            $location.path('/tasks');
        };
    }

    CreateTaskController.$inject = ['$location', 'taskService', 'userService'];
    angular.module('todoAppControllers').controller('CreateTaskController', CreateTaskController);

    function UserController(users) {
        var self = this;

        this.users = [];

        users.all().then(function (response) {
            self.users = response.data;
        });
    }
    UserController.$inject = ['userService'];
    angular.module('todoAppControllers').controller('UserController', UserController);

    function CreateUserController($location, users) {
        var self = this;

        this.save = function (user) {
            users.create(user).then(function () {
                self.redirect();
            });
        };

        this.cancel = function () {
            this.redirect();
        };

        this.redirect = function () {
            $location.path('/users');
        };
    }
    CreateUserController.$inject = ['$location', 'userService'];
    angular.module('todoAppControllers').controller('CreateUserController', CreateUserController);
}(window.angular));
