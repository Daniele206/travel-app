<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Travel-App</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <body>
        <header>
            <nav class="d-flex h-100">
                <div class="logo">Travel-App</div>
                <ul>
                    <li class="mt-4"><a href="{{route('login')}}">Accedi</a></li>
                    <li class="mt-4"><a href="{{route('register')}}">Registrati</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <div class="pt-5">
                @yield('content')
            </div>
        </main>
    </body>
</body>

</html>

<style lang="scss"  scoped>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
    }

    body {
        line-height: 1.6;
        height: 100vh;
    }

    header {
        background: #ffffff;
        color: #2eaf73;
        height: 8%;
    }

    main{
        background-color: #38cc87;
        height: 92%;
    }

    nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1100px;
        margin: auto;
        padding: 0 1rem;
    }

    nav .logo {
        font-size: 1.5rem;
        font-weight: bold;
    }

    nav ul {
        list-style: none;
        display: flex;
    }

    nav ul li {
        margin-left: 1rem;
    }

    nav ul li a {
        color: #2eaf73;
        font-size: 1.2rem;
        font-weight: bold;
        text-decoration: none;
        padding: 0.5rem 1rem;
    }

    nav ul li a:hover {
        background: #38cc87;
        color: #ffffff;
        border-radius: 5px;
    }
    </style>
