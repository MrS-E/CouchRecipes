<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="a recipes app">
        <meta name="keywords" content="recipes">
        <meta name="author" content="Simeon Stix">
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
        <title>@yield('title')</title>
    </head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-xl">
            <a class="navbar-brand" href="">Rezepte</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navBar" aria-controls="navBar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navBar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                </ul>
                <div>
                    <input id="search" class="form-control" type="text" placeholder="Search">
                </div>
            </div>
        </div>
    </nav>
</header>
<main>
    <div class="container-xl mt-4">
        @yield('main')
    </div>
</main>
<footer>

</footer>
<script>
    document.querySelector("a.nav-link.active").classList.remove("active");
    switch (window.location.href.split('/')[window.location.href.split('/').length-1]){
        case 'user': break;
        default:
            document.querySelector("a[href='/']").classList.add("active");
    }
    if(window.location.href.split('/')[window.location.href.split('/').length-2]==="search") document.querySelector("#search").value=window.location.href.split('/')[window.location.href.split('/').length-1];
    document.querySelector("#search").addEventListener('keydown',(e)=>{
        if(e.keyCode===13){
            if(e.target.value===""||e.target.value===" ") {
                window.location.replace("/");
            }else {
                window.location.replace("/search/" + e.target.value.toLowerCase());
            }
        }
    });
</script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
</body>
</html>
