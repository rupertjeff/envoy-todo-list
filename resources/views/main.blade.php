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
    <header class="container-fluid">
        <div class="row">
            <h1 class="col-xs-12">Tasks</h1>
        </div>
    </header>
    <section id="main" class="container-fluid">
        <div class="row">
        </div>
        <div class="row">
        </div>
    </section>
    <footer>
    </footer>

    {{-- Overriding this section may not be necessary in this example. --}}
    @section('scripts-body')
    @show
</body>

</html>
