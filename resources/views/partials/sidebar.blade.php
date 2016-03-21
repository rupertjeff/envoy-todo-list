<div ng-controller="ShowAllTasksController as todoList">
    <h2>All Tasks</h2>
    <ul class="task-list js-task-list list-group">
        <li ng-repeat="task in todoList.tasks" class="task js-task list-group-item item-has-checkbox">
            <label class="item-label">
                <span class="item-checkbox glyphicon glyphicon-ok" ng-if="task.completed" aria-hidden="true"></span>
                <span class="task-name js-task-name">@{{ task.name }} <span class="label label-default" ng-if="task.user.name">@{{ task.user.name }}</span></span>
                <span class="task-description js-task-description small" ng-if="task.description">@{{ task.description }}</span>
            </label>
        </li>
    </ul>
</div>
