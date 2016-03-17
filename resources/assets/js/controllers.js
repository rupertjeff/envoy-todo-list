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
    angular.module('todoAppControllers').controller('CreateTaskController', CreateTaskController);
}(window.angular));
