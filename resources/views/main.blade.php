<!doctype html>
<html lang="en" ng-app="todoApp">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Task List</title>

    {{-- Overriding this section may not be necessary in this example. --}}
    @section('styles')
        {!! Html::style(elixir('css/app.css')) !!}
    @show

    {{-- Overriding this section may not be necessary in this example. --}}
    @section('scripts-head')
        {!! Html::script(elixir('js/app.js')) !!}
    @show
</head>

<body>
    <header class="container-fluid">
        <div class="row">
            <h1 class="col-xs-12">Tasks</h1>
        </div>
    </header>
    <section id="main" class="container-fluid">
        <div class="row">
            <ul class="task-list js-task-list col-xs-12" ng-controller="TodoListController as todoList">
                <li ng-repeat="task in todoList.tasks" class="task js-task">
                    <label>
                        <input type="checkbox" ng-checked="task.completed">
                        <span class="task-name js-task-name">@{{ task.name }}</span>
                        <span class="task-description js-task-description small" ng-if="task.description">@{{ task.description }}</span>
                    </label>
                    <button class="task-remove js-task-remove" type="button">&times;</button>
                </li>
            </ul>
        </div>
        <div class="row">
            <form class="col-xs-12" name="createTaskForm" ng-controller="CreateTaskController as createTask">
                <button class="btn btn-info" ng-click="createTask.toggleForm()" ng-if=" ! createTask.showForm" type="button">Create New Task</button>
                <div ng-if="createTask.showForm">
                    <div class="form-group">
                        <label for="task-name" class="sr-only">Task</label>
                        <input type="text" id="task-name" class="form-control" placeholder="Task" ng-model="task.name">
                    </div>
                    <div class="form-group">
                        <label for="task-description" class="sr-only">Description</label>
                        <textarea id="task-description" class="form-control" placeholder="Description (optional)" ng-model="task.description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="task-user-id" class="sr-only">Assigned To:</label>
                        <select id="task-user-id" ng-model="task.userId" ng-options="user.name for user in createTask.users track by user.id">
                            <option value="">Select User</option>
                        </select>
                    </div>
                    <div class="form-group form-actions">
                        <button type="reset" class="btn btn-warning" ng-click="createTask.cancel()">Cancel</button>
                        <button type="submit" class="btn btn-success" ng-click="createTask.save(task)">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <footer>
    </footer>

    {{-- Overriding this section may not be necessary in this example. --}}
    @section('scripts-body')
    @show
</body>

</html>