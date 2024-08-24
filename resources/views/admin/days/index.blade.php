@extends('layouts.admin')

@section('content')
    <div class="w-75 h-100 m-auto d-flex flex-column justify-content-between">
        <div class="d-flex justify-content-between mt-3 mb-3">
            <h2>{{$jurney['title']}} - {{$jurney['destination']}}</h2>
            <a href="{{route('admin.jurney.edit', $jurney)}}" class="btn btn-warning" style="height: 2.6rem"><i class="fa-solid fa-pen"></i></a>
        </div>
        <div class=" overflow-auto">

            <ul class="list-group">
                @foreach ($days as $day)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Giorno: {{ $day->date }}
                        <a href="{{route('admin.days.show', $day)}}" class="btn btn-success">Vai al giorno</a>
                    </li>
                @endforeach
            </ul>

        </div>
        <div class="d-flex justify-content-between mt-4 mb-3">
            <span class="d-block fw-bold fs-4 me-3">{{$jurney['leaving']}} - {{$jurney['return']}}</span>
            <form onsubmit="return confirm('Sei sicuro/a di voler cancellare il tuo viaggio?')" class="d-inline-block" action="{{route('admin.jurney.destroy', $jurney)}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger "><i class="fa-solid fa-trash"></i></button>
            </form>
        </div>
    </div>

@endsection
