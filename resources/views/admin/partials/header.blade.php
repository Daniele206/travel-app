<header>
    <nav class="br_t navbar navbar-expand-lg bg-body-tertiary d-flex justify-content-between align-items-center">
        <h1 class="title fs-2 ps-3">Travel-App</h1>
        <div class="d-flex align-items-center pe-3">
            <h2 class="name fs-3 pe-3">{{ Auth::user()->name }}</h2>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-success p_log-out text-light"><i class="fa-solid fa-right-from-bracket"></i></button>
            </form>
        </div>
    </nav>
</header>

<style lang="scss" scoped>

    .br_t{
        border-top-right-radius: 0.6rem;
        border-top-left-radius: 0.6rem;
    }

    .title{
        color: #2eaf73;
        font-weight: bold;
        margin: auto 0;
    }

    .name{
        color: #2eaf73;
        font-weight: bold;
        margin: auto 0;
    }

</style>
