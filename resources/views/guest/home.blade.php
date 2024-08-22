@extends('layouts.guest')

@section('content')

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
        <section class="hero">
            <h1>Travel-App</h1>
            <p>La migliore soluzione per pianificare i tuoi viaggi!</p>
            <a href="{{route('login')}}" class="btn">Inizzia Ora</a>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Travell-App. Tutti i diritti riservati.</p>
    </footer>
</body>


@endsection

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
    height: 86%;
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

.hero {
    background: url('hero-image.jpg') no-repeat center center/cover;
    color: white;
    height: 85vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 0 1rem;
}

.hero h1 {
    font-size: 2.5rem;
    margin-bottom: 1rem;
}

.hero p {
    font-size: 1.2rem;
    margin-bottom: 2rem;
}

.hero .btn {
    background: #ffffff;
    color: #2eaf73;
    padding: 0.7rem 1.5rem;
    text-decoration: none;
    border-radius: 5px;
    font-size: 1.2rem;
    font-weight: bold;
}

.hero .btn:hover {
    background: #2da06a;
}




footer {
    background: #333;
    color: white;
    height: 6%;
}

footer p {
    margin: 0;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

</style>
