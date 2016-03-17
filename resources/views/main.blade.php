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

    @section('scripts-head')
        {!! Html::script(elixir('js/app.js')) !!}
    @show
</head>

<body>
    <header>
        <h1>Tasks</h1>
    </header>
    <section id="main">
        <ul class="task-list js-task-list" ng-controller="TodoListController as todoList">
            <li ng-repeat="task in todoList.tasks" class="task js-task">
                <label>
                    <input type="checkbox" ng-checked="task.completed">
                    <span class="task-name js-task-name">@{{ task.name }}</span>
                    <span class="task-description js-task-description small" ng-if="task.description">@{{ task.description }}</span>
                </label>
                <button class="task-remove js-task-remove" type="button">&times;</button>
            </li>
        </ul>
    </section>
    <footer>
    </footer>

    @section('scripts-body')
    @show
</body>

</html>
