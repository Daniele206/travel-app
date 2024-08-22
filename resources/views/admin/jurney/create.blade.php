@extends('layouts.admin')

@section('content')

    <form class="m-3 w-75 d-flex flex-column align-items-center m-auto" action="{{route('admin.jurney.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <h3 class="mt-3 fw-bold text-success">Progettazione Viaggio</h3>
        <div class="mb-3 w-75 mt-3">
            <label for="title" class="form-label fs-3 fw-bold">Titolo <i class='fs-4 fa-solid fa-star-of-life text-success'></i></label>
            <input value="{{ old('title') }}" name="title" id="title" type="text" class="form-control" aria-describedby="emailHelp" >
        </div>
        <div class="mb-3 w-75">
            <label for="destination" class="form-label fs-3 fw-bold">Meta <i class='fs-4 fa-solid fa-star-of-life text-success'></i></label>
            <input value="{{ old('destination') }}" name="destination" id="destination" type="text" class="form-control" aria-describedby="emailHelp">
        </div>
        <div class="mb-3 w-75">
            <label for="leaving" class="form-label fs-3 fw-bold">Partenza <i class='fs-4 fa-solid fa-star-of-life text-success'></i></label>
            <input value="{{ old('leaving') }}" name="leaving" id="leaving" type="date" class="form-control" aria-describedby="emailHelp">
        </div>
        <div class="mb-3 w-75">
            <label for="return" class="form-label fs-3 fw-bold">Ritorno <i class='fs-4 fa-solid fa-star-of-life text-success'></i></label>
            <input value="{{ old('return') }}" name="return" id="return" type="date" class="form-control" aria-describedby="emailHelp">
        </div>
        <div class="btn_container w-75 d-flex justify-content-between">
            <button type="submit" class="btn btn-outline-warning">Salva ed esci</button>
            <button type="submit" class="btn btn-outline-success">Avanti</button>
        </div>
    </form>

@endsection
