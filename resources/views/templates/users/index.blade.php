<div class="col-xs-12">
    <a class="btn btn-info create-user" href="#/users/create" role="button">Create User</a>
    <ul class="user-list js-user-list list-group">
        <li class="user js-user list-group-item" ng-repeat="user in userList.users">
            <span class="user-name item-label js-user-name" ng-click="userList.selectUser(user)">@{{ user.name }}</span>
            <button class="user-remove item-remove js-user-remove" type="button" ng-click="userList.deleteUser(user)"><span class="glyphicon glyphicon-remove"></span></button>
        </li>
    </ul>
</div>
