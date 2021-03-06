<h2>Create Task</h2>
<form name="createTaskForm">
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
        <select id="task-user-id" ng-model="task.user" ng-options="user.name for user in createTask.users track by user.id">
            <option value="">Select User</option>
        </select>
    </div>
    <div class="form-group form-actions">
        <button type="reset" class="btn btn-warning" ng-click="createTask.cancel()">Cancel</button>
        <button type="submit" class="btn btn-success" ng-click="createTask.save(task)">Create</button>
    </div>
</form>
