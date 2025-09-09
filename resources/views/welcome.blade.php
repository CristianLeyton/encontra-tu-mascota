    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel with Vue</title>
        @vite('resources/js/app.js') {{-- Include your compiled assets --}}
        @vite('resources/css/app.css')
    </head>
    <body>
        <div id="app">
        </div> {{-- This is where your Vue app will mount --}}
    </body>
    </html>