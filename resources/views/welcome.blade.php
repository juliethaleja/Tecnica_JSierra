<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset("CSS/style.css") }}" rel="stylesheet">
    <title>Consumir Api Rick Y Morty</title>


@vite(['resources/js/app.js', 'resources/css/app.scss'])
  </head>
  <body>
  <aside>
            <div class="hero-image img-fluid text-center  col-12 px-0">
                <h1 class="text-white fw-bold banner__h1">Rick y Morty
                </h1>
                <h5 class="fw-light fs-2 baner__h5">
                    Revisa nuestro portafolio de personajes de la serie
                </h5>
                <button type="button" class="btn btn-outline-success"><a class="text-decoration-none nav__a" href="character">Personajes</a> </button>
            </div>
        </aside>
  </body>
</html>
