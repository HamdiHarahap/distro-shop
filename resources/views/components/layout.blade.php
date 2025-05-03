    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{$title}}</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @vite(['resources/css/app.css', 'resources/js/navbar.js'])
    </head>
    <body>
        @unless(request()->is('login') || request()->is('register'))
            <x-header></x-header>
        @endunless
        
        <main>
            {{$slot}}
        </main>
        
        @unless(request()->is('login') || request()->is('register'))
            <x-footer></x-footer>
        @endunless

        @include('sweetalert::alert')
    </body>
</html>