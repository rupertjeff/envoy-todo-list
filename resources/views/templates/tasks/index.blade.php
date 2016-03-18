<ul class="task-list js-task-list col-xs-12">
    <li ng-repeat="task in todoList.tasks" class="task js-task">
        <label>
            <input type="checkbox" ng-checked="task.completed">
            <span class="task-name js-task-name">@{{ task.name }}</span>
            <span class="task-description js-task-description small" ng-if="task.description">@{{ task.description }}</span>
        </label>
        <button class="task-remove js-task-remove" type="button">&times;</button>
    </li>
</ul>
