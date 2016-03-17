// Normally, I would split this into more files. For the purposes of the example,
// I’ll keep it as one file for now.

;(function (angular, undefined) {
    angular.module('todoApp', []);

    function TodoListController() {
        this.tasks = [
            { 'name': 'Task 1', 'description': 'Some Description', 'completed': false, 'user': {} },
            { 'name': 'Task 2', 'description': 'Another Description', 'completed': true, 'user': {} },
            { 'name': 'Task 3', 'completed': false, 'user': {} }
        ];
    }
    angular.module('todoApp').controller('TodoListController', TodoListController);
}(window.angular));
