<div class="col-xs-12">
    <div class="filter-note js-filter-note" ng-if="todoList.isFiltered()">@{{ todoList.getFilterMessage() }}
        <button class="filter-remove" type="button" ng-click="todoList.clearFilters()"><span class="glyphicon glyphicon-remove"></span></button>
    </div>
    <ul class="task-list js-task-list list-group">
        <li ng-repeat="task in todoList.tasks" class="task js-task list-group-item item-has-checkbox">
            <label class="item-label" ng-click="todoList.completeTask(task)">
                <span class="item-checkbox glyphicon glyphicon-ok" ng-if="task.completed" aria-hidden="true"></span>
                <span class="task-name js-task-name">@{{ task.name }} <span class="label label-default" ng-if="task.user.name">@{{ task.user.name }}</span></span>
                <span class="task-description js-task-description small" ng-if="task.description">@{{ task.description }}</span>
            </label>
            <button class="task-remove item-remove js-task-remove" type="button" ng-click="todoList.deleteTask(task)"><span class="glyphicon glyphicon-remove"></span></button>
        </li>
    </ul>
    <a href="#/tasks/create" class="btn btn-block btn-info">Add New Task</a>
</div>
