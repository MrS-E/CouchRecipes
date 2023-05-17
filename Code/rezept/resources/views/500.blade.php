<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="a recipes app">
    <meta name="keywords" content="recipes">
    <meta name="author" content="Simeon Stix">
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
    <title>500</title>
    <style>
        .nothing{
            display: none;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div id="error" class="text-center">
        <p class="fs-3"><span class="text-danger">Opps!</span> Page not found.</p>
        <p class="lead">
            The page you’re looking for doesn’t exist.
        </p>
        <a href="/" class="btn btn-primary">Go Home</a>
        <br>
        <a id="game_btn" class="btn btn-secondary mt-2" onclick="document.getElementById('game_btn').classList.toggle('nothing');document.getElementById('game').classList.toggle('nothing');openFullscreen();">Or play a Game</a>

    </div>
    <div id="game" class="nothing mt-4">
        <iframe width="1" height="1" src="https://js13kgames.com/games/norman-the-necromancer/index.html" title="Norman The Necromancer" id="gameframe"></iframe>
    </div>
</div>
<script>
    function openFullscreen() {
        let elem = document.getElementById("gameframe")
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.webkitRequestFullscreen) { /* Safari */
            elem.webkitRequestFullscreen();
        } else if (elem.msRequestFullscreen) { /* IE11 */
            elem.msRequestFullscreen();
        }
    }
</script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
</body>
</html>
