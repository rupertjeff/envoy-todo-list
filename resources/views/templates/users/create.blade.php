<h2>Create User</h2>
<form name="createUserForm">
    <div class="form-group">
        <label for="user-name" class="sr-only">Name</label>
        <input type="text" id="user-name" class="form-control" placeholder="User Name" ng-model="user.name">
    </div>
    <div class="form-group">
        <label for="user-email" class="sr-only">Email</label>
        <input type="email" id="user-email" class="form-control" placeholder="user@email.com" ng-model="user.email">
    </div>
    <div class="form-group form-actions">
        <button type="reset" class="btn btn-warning" ng-click="createUser.cancel()">Cancel</button>
        <button type="submit" class="btn btn-success" ng-click="createUser.save(user)">Create</button>
    </div>
</form>
