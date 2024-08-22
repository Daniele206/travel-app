@extends('layouts.admin')

@section('content')
@if (!$jurney)
<div class="my_container h-100 d-flex justify-content-center align-items-center flex-column">
    <h2 class="w-50 text-center fs-2">Inizia a programmare il tuo viaggio con Travel-App</h2>
    <a href="{{route('admin.jurney.create')}}" class="btn btn-success fs-1 px-5 py-4 mt-4">Nuovo Viaggio +</a>
</div>
@else

@endif

@endsection
