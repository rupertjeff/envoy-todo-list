<a class="btn btn-info" href="#/users/create" role="button">Create User</a>
<ul class="user-list js-user-list">
    <li class="user js-user" ng-repeat="user in userList.users">
        <span class="user-name js-user-name">@{{ user.name }}</span>
        <button class="user-remove js-user-remove" type="button">&times;</button>
    </li>
</ul>
