    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel with Vue</title>
        @vite('resources/js/app.js') {{-- Include your compiled assets --}}
        @vite('resources/css/app.css')
    </head>

    <body class="bg-gray-100 text-gray-800">
        {{-- Pasamos los posts como un atributo de datos JSON.
             La directiva @json se encarga de convertir el array de Laravel a un JSON seguro. --}}
        <div id="app" data-posts='@json($posts)'></div>
    </body>

    </html>
