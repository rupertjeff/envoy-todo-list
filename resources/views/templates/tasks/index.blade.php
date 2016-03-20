<div class="col-xs-12">
    <div class="filter-note js-filter-note" ng-if="todoList.isFiltered()">@{{ todoList.getFilterMessage() }}
        <button class="filter-remove" type="button" ng-click="todoList.clearFilters()">&times;</button>
    </div>
    <ul class="task-list js-task-list list-group">
        <li ng-repeat="task in todoList.tasks" class="task js-task list-group-item item-has-checkbox">
            <label class="item-label">
                <input class="item-checkbox" type="checkbox" ng-checked="task.completed" ng-click="todoList.completeTask(task)">
                <span class="task-name js-task-name">@{{ task.name }}</span>
                <span class="task-description js-task-description small" ng-if="task.description">@{{ task.description }}</span>
            </label>
            <button class="task-remove item-remove js-task-remove" type="button" ng-click="todoList.deleteTask(task)">&times;</button>
        </li>
    </ul>
    <a href="#/tasks/create" class="btn btn-block btn-info">Add New Task</a>
</div>
