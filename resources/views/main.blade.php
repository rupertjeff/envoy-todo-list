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
    <header class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <h1 class="navbar-brand">Task List</h1>
            </div>
        </div>
    </header>
    <section id="main" class="container-fluid">
        <div class="row">
            <div class="col-xs-12" ng-class="{ 'col-sm-8': showSidebar, 'col-md-7': showSidebar, 'col-md-offset-1': showSidebar, 'col-lg-6': showSidebar, 'col-lg-offset-2': showSidebar }" ng-view></div>
            <div class="col-sm-4 col-md-3 col-lg-2 hidden-xs" ng-class="{ hide: ! showSidebar }">
                @include('partials.sidebar')
            </div>
        </div>
    </section>
    <footer>
        <nav class="main-navigation js-main-navigation">
            <ul>
                <li class="nav-link">
                    <a href="#/users">Users</a>
                </li>
                <li class="nav-link">
                    <a href="#/tasks">Tasks</a>
                </li>
            </ul>
        </nav>
    </footer>

    {{-- Overriding this section may not be necessary in this example. --}}
    @section('scripts-body')
    @show
</body>

</html>
