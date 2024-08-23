@extends('layouts.admin')

@section('content')

    @if ($errors->any())
    <div class="alert alert-danger w-75 m-auto mt-3">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form class="m-3 w-75 d-flex flex-column align-items-center m-auto" action="{{route('admin.jurney.update', $jurney)}}" method="post">
        @csrf
        @method('PUT')

        <h3 class="mt-3 fw-bold text-success">Progettazione Viaggio</h3>
        <div class="mb-1 w-75 mt-3">
            <label for="title" class="form-label fs-3 fw-bold">Titolo <i class='fs-4 fa-solid fa-star-of-life text-success'></i></label>
            <input value="{{ old('title', $jurney->title) }}" name="title" id="title" type="text" class="form-control" aria-describedby="emailHelp" >
        </div>
        <div class="mb-1 w-75">
            <label for="destination" class="form-label fs-3 fw-bold">Meta <i class='fs-4 fa-solid fa-star-of-life text-success'></i></label>
            <input value="{{ old('destination', $jurney->destination) }}" name="destination" id="destination" type="text" class="form-control" aria-describedby="emailHelp">
        </div>
        <div class="mb-1 w-75">
            <label for="leaving" class="form-label fs-3 fw-bold">Partenza <i class='fs-4 fa-solid fa-star-of-life text-success'></i></label>
            <input value="{{ old('leaving', $jurney->leaving) }}" name="leaving" id="leaving" type="date" class="form-control" aria-describedby="emailHelp">
        </div>
        <div class="mb-3 w-75">
            <label for="return" class="form-label fs-3 fw-bold">Ritorno <i class='fs-4 fa-solid fa-star-of-life text-success'></i></label>
            <input value="{{ old('return', $jurney->return) }}" name="return" id="return" type="date" class="form-control" aria-describedby="emailHelp">
        </div>
        <button type="submit" class="btn btn-outline-success">Avanti</button>
    </form>

@endsection
