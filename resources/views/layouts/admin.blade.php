<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- charts --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    {{-- fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Scripts -->
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <title>Travell-App</title>
</head>

<body>
    <div class="main-wrapper d-flex">
        <div class="content">
            <main>
                @include('admin.partials.header')
                <div class="main_container">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

</body>

</html>

<style lang="scss"  scoped>

    main{
        background-color: #38cc87;
        height: 100vh;
        width: 100vw;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .main_container{
        background-color: #ecefe1;
        width: 60vw;
        height: 70vh;
        border-bottom-left-radius: 0.6rem;
        border-bottom-right-radius: 0.6rem;
        overflow: auto;
    }

</style>
